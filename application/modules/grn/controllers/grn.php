<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grn extends MX_Controller
{
   	/**
	 * @author entol
	 * @see more  http://www.entol.net
	 * @email fudel.07@gmail.com 
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
	
	function __construct()
	{
		parent::__construct();
		
		// check if user logged in 
		if (!$this->ion_auth->logged_in())
	  	{
			redirect('auth/login');
	  	}
		
		$this->load->helper('url');
		$this->load->library('form_validation');
		//$this->load->model('dn_model');
		$this->load->library('session');
			$this->meta = array(
            'activeMenu' => 'maintenance',
            'activeTab' => 'grn'
			
        );	
	}
	
    public function index()
    {
		ob_start();
		$this->load->helper('xcrud');
		$xcrud = Xcrud::get_instance('xcrud_pr');
		$xcrud->connection('root','','bcspurchase_2015');
        $xcrud->table('lpb');
        $xcrud->columns('lpb_no,lpb_date,po_no,received_by');
        $xcrud->fields('lpb_no,lpb_date,po_no,received_by,user_group,no_urut,kategori');
        $xcrud->unset_title();
        $xcrud->label('user_group','');
        $xcrud->label('lpb_no','WRS No');
        $xcrud->label('lpb_date','WRS Date');
        $xcrud->label('kategori','');
        $xcrud->label('no_urut','');
        $xcrud->label('po_no','PO No.');
        $xcrud->label('project_code','Project Code');
        $xcrud->label('received_by','Received By');
		$xcrud->set_attr('po_no',array('id'=>'po')); 
		$xcrud->validation_required('lpb_no');
		$xcrud->validation_required('lpb_date');
		$usergroup =GROUPDESC;
		$kategori ="PR";
		$xcrud->where("lpb.user_group='".$usergroup."' AND lpb.kategori ='".$kategori."' ");	
		$xcrud->set_attr('user_group',array('id'=>'user_group', 'type'=>'hidden','value'=>$usergroup)); //optional ambil session
		$xcrud->set_attr('no_urut',array('id'=>'no_urut' ,'type'=>'hidden' )); //optional ambil session
		$xcrud->set_attr('kategori',array('id'=>'kategori' ,'type'=>'hidden','value'=>$kategori)); //optional ambil session
		$xcrud->set_attr('lpb_no',array('id'=>'lpb_no' ,'ReadOnly'=>'True' )); //optional ambil session
		$xcrud->set_attr('lpb_date',array('id'=>'lpb_date')); //optional ambil session
		$user =USER_NAME;

		$xcrud->set_attr('received_by',array('readOnly'=>'True','id'=>'received_by','value'=>$user)); //optional ambil session
		$xcrud->set_attr('project_code',array('readOnly'=>'True','id'=>'project_code')); //
		$xcrud->unset_remove();
		$xcrud->default_tab('WRS Header');
		$xcrud->benchmark(true);

		$sub_table = $lpbdetail = $xcrud->nested_table('WRS Detail','lpb_no','lpb_detail','lpb_no'); //  sub_table begin
		$sub_table->connection('root','', 'bcspurchase_2015'); // end sub_table 
		$lpbdetail ->columns('lpb_no,po_item_id,qty,unit'); //,trans_grn_detail_non_pr_diskon,trans_grn_detail_non_pr_ppn
		$lpbdetail ->fields('lpb_no,po_item_id,qty,unit'); //non_pr_grn_detail_brand_price ,trans_grn_detail_non_pr_diskon,trans_grn_detail_non_pr_ppn,
		$lpbdetail->label('lpb_no','WRS NO');
		$lpbdetail->unset_edit();
		$lpbdetail->unset_title();
		
		$lpbdetail->relation('po_item_id','eproc_po_item_description','po_item_id','description','po_no = (select po_no from lpb where lpb_no = "{lpb_no}")');//,
		$lpbdetail->set_attr('lpb_no',array('readOnly'=>'True','id'=>'lpb_no'));
		$lpbdetail->set_attr('po_item_id',array('id'=>'po_item_id')); //
		$lpbdetail->set_attr('qty',array('id'=>'qty')); //
		$lpbdetail->set_attr('unit',array('readOnly'=>'True','id'=>'unit'));
		$lpbdetail->before_insert('update_balance'); //RUNS UPDATE BALANCE IN FUNCTION.PHP
		
		$sub_table = $po_item = $xcrud->nested_table('PO Item','po_no','po_item','po_no'); // sub_table begin
		$sub_table->connection('root','', 'bcspurchase_2015'); // end sub_table 
		$po_item->columns('po_item_id,po_no,qty,unit,price,subtotal,discount,lpb_balance');
		$po_item->change_type('subtotal','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
		$po_item->column_class('subtotal', 'align-right');
	    $po_item->relation('po_item_id','eproc_po_item_description','po_item_id','description');
		$po_item->unset_remove();
		$po_item->unset_add();
        $po_item->unset_edit();
		$po_item->default_tab('Po details');
		$po_item->unset_title();
		
		$data['content'] = $xcrud->render();
//--------------------------------------------------------------------------------------------------------------------------------------------------------
		$this->load->helper('xcrud');
		$groupdesc =GROUPDESC;
		$view_wrs = Xcrud::get_instance('view_wrs');
		$view_wrs->connection('root','','bcspurchase_2015');
		$view_wrs->table('print_lpb'); //eproc_pr_outstanding AND `pr`.`user_group`=$group
		$view_wrs->unset_title(); 
		$view_wrs->limit(10); 
		$view_wrs->benchmark(); 
		$view_wrs->change_type('price','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
		$view_wrs->column_class('price', 'align-right');
		$view_wrs->sum('price','Total is {Price}');

		$data['content4'] = $view_wrs->render();
		
//-----------------------------------------------------------------------------------------------------------------
	
		$meta = $this->meta;	
        $this->load->view('commons/header',$meta);  
        $this->load->view('grn',$data);
        $this->load->view('commons/foot_r');
		
    }
	function get_deskripsi($trans_purchase_detail_code){
				 $this->db->select('mstr_material_data');
				 $this->db->where('material_id', $trans_purchase_detail_code);
				 $query = $this->db->get('material_data_description');
				 log_message('info', "Value of trans_purchase_detail_code was: $trans_purchase_detail_code");
				if ($query->num_rows() > 0)
				 {
					 return $query->result_array();
				 }else{
					return 'No States Found';
				 }
		}   
	function generate_wrs(){
		$DB1 = $this->load->database('default', TRUE); //ims
		$DB2 = $this->load->database('db2', TRUE); //bcspurchase_2015
		$data = $this->input->post('po');
		$query = $DB2->query("SELECT po.project As project FROM po WHERE po_no='".$data."'");
					if ($query->num_rows() > 0)
						{
						$row = $query->row_array();						
						$row['project'];
					}
					
					$proj=$row['project'];
					//echo $proj;
		$query2 = $DB2->query("SELECT bcspurchase_2015.project.project_code, bcspurchase_2015.project.site_alias, bcspurchase_2015.project.category
									FROM
									bcspurchase_2015.project
									WHERE
									bcspurchase_2015.project.project_code='".$proj."'");
			if ($query2->num_rows() > 0)
			{
				$row = $query2->row_array(); 
				$row['site_alias'];
				$row['category'];
			}
			$alias=$row['site_alias'];
			$kat=$row['category'];
			$wrs="WRS";
			$t="/";
			$proj2=("".$kat."-".$alias); //($bln,$t,$thn,$t,$tmp,$t);
			//	echo $proj2;
			$year =  date("Y"); //year
					                     
		 $q = $DB2->query("select max(cast(f_split_string(lpb_no, '/', 1) as SIGNED)) as code_max FROM lpb
							where f_split_string(lpb_no, '/', 3) = '".$proj2."' AND f_split_string(lpb_no, '/', 4) = '".$year."'");
        
		if( $q->num_rows() > 0)
		{
			$code_max = explode("/",$q->row()->code_max);
			$code_max = $code_max[0] + 1;
		}
		
		echo (str_pad("".$code_max."", 3, '0', STR_PAD_LEFT).$t.$wrs.$t.$proj2.$t.$year);
		
		// else {
		
		// echo "001".$t.$wrs.$t.$proj2.$t.$year;
		// }
			
			}
		        
	function get_project($var_po){
			
						$DB1 = $this->load->database('default', TRUE);
						$DB2 = $this->load->database('db2', TRUE); 	
						$data = $this->input->post('po');
						$query = $DB2->query("SELECT po.project As project FROM po WHERE po_no='".$data."'");
						if ($query->num_rows() > 0)
						{
							$row = $query->row_array();						
							$row['project'];
						}
						
						$proj=$row['project'];
						echo $proj;
						// echo $var_po;
	}
	function get_unit(){
			
		$DB1 = $this->load->database('default', TRUE); //ims
		$DB2 = $this->load->database('db2', TRUE); 	//bcsuprchase_2015
		$data = $this->input->post('po_item_id');
		$query = $DB2->query("SELECT unit As unit FROM lpb_detail WHERE po_item_id='".$data."'");
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();						
			$row['unit'];
		}
					
		$unit=$row['unit'];
		echo $unit;
	}	

}


//
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

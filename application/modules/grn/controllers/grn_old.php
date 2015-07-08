<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grn extends MX_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
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
		$xcrud->connection('root','root','bcspurchase_2015','10.2.2.32');
        //$xcrud->table('lpb');
		$grp=GROUPDESC;
			if($grp=='Administrator')
			{
				$xcrud->table('lpb');
			    $xcrud->where('user_group', array('Administrator','General User','Transportation','Dam Truck','Marketing','Legal Department','Maintenance_Cilegon','Finance','Maintenance_Narogong'));
			} else {
				$xcrud->table('lpb');
			    $xcrud->where('user_group', array(GROUPDESC));				
			}
		$xcrud->unset_edit();
		$xcrud->unset_remove();
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
		//$xcrud->create_action('generate_wrs','generate_wrs'); 
		//$xcrud->validation_required('kategori');
		$xcrud->validation_required('lpb_no');
		$xcrud->validation_required('lpb_date');
		//$xcrud->validation_required('non_pr_grn_no');
		$usergroup =GROUPDESC;
		$kategori ="PR";
		// echo $kategori;
		$xcrud->set_attr('user_group',array('id'=>'user_group', 'type'=>'hidden','value'=>$usergroup)); //optional ambil session
		$xcrud->set_attr('no_urut',array('id'=>'no_urut' ,'type'=>'hidden' )); //optional ambil session
		$xcrud->set_attr('kategori',array('id'=>'kategori' ,'type'=>'hidden','value'=>$kategori)); //optional ambil session
		$xcrud->set_attr('lpb_no',array('id'=>'lpb_no' ,'ReadOnly'=>'True' )); //optional ambil session
		$xcrud->set_attr('lpb_date',array('id'=>'lpb_date')); //optional ambil session
		$user =USER_NAME;
		//echo $user;
		//echo $data;
		$xcrud->set_attr('received_by',array('readOnly'=>'True','id'=>'received_by','value'=>$user)); //optional ambil session
		$xcrud->set_attr('project_code',array('readOnly'=>'True','id'=>'project_code')); //
		// $xcrud->relation('project_code','project','project_code','project');
		$xcrud->unset_remove();
		// $xcrud->unset_edit();
		$xcrud->default_tab('WRS Header');
		$xcrud->benchmark(true);
		$sub_table = $lpbdetail = $xcrud->nested_table('WRS Detail','lpb_no','lpb_detail','lpb_no'); //  sub_table begin
		$lpbdetail ->columns('lpb_no,po_item_id,qty,unit'); //,trans_grn_detail_non_pr_diskon,trans_grn_detail_non_pr_ppn
		$lpbdetail ->fields('lpb_no,po_item_id,qty'); //non_pr_grn_detail_brand_price ,trans_grn_detail_non_pr_diskon,trans_grn_detail_non_pr_ppn,
		$lpbdetail->label('lpb_no','WRS NO');
		$lpbdetail->unset_edit();
		$lpbdetail->unset_title();
		//$lpbdetail->after_insert('Update_balance_po');
		
		// $this->fb->log($po_item_id,'po_item_id_grn');
		// die;
		
		$lpbdetail->set_attr('po_item_id',array('id'=>'po_item_id')); //
		$lpbdetail->set_attr('qty',array('id'=>'qty')); //
		
		$lpbdetail->default_tab('');
		$lpbdetail->set_attr('lpb_no',array('readOnly'=>'True','id'=>'lpb_no'));
		$lpbdetail->relation('po_item_id','eproc_po_item_description','po_item_id','description','po_no = (select po_no from lpb where lpb_no = "{lpb_no}")');//,
		//$xcrud->where(‘status =’,’active’); 
		$sub_table->connection('root','root', 'bcspurchase_2015','10.2.2.32'); // end sub_table 
		$sub_table = $po_item = $xcrud->nested_table('PO Item','po_no','po_item','po_no'); // sub_table begin
		$po_item->columns('po_item_id,po_no,qty,unit,price,subtotal,discount,lpb_balance');
        //$po_item->fields('po_item_id,po_no,qty,unit,price,discount');
		$po_item->change_type('subtotal','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
		$po_item->column_class('subtotal', 'align-right');
		//$po_item->subselect('SELECT SUM(subtotal) FROM po_item '); // current table FROM trans_grn_detail_non_pr
		// $po_item->sum('subtotal','Total price is {value}');
	    $po_item->relation('po_item_id','eproc_po_item_description','po_item_id','description');
		$po_item->unset_remove();
		$po_item->unset_add();
        $po_item->unset_edit();
		$po_item->default_tab('Po details');
		$po_item->unset_title();
		$sub_table->connection('root','root', 'bcspurchase_2015','10.2.2.32'); // end sub_table 
		$data['content'] = $xcrud->render();
//--------------------------------------------------------------------------------------------------------------------------------------------------------
		$this->load->helper('xcrud');
		//$outstanding_pr = =GROUPDESC;
		$groupdesc =GROUPDESC;
		//echo $groupdesc;
		$view_wrs = Xcrud::get_instance('view_wrs');
		$view_wrs->connection('root','root','bcspurchase_2015');
		$view_wrs->table('print_lpb'); //eproc_pr_outstanding AND `pr`.`user_group`=$group
		$view_wrs->unset_title(); 
		$view_wrs->limit(10); 
		$view_wrs->benchmark(); 
		$view_wrs->change_type('price','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
		$view_wrs->column_class('price', 'align-right');
		$view_wrs->sum('price','Total is {Price}');
        //$view_wrs ->columns('pr_no,pr_date,project,status,received_by,approved,request_by');
	
		// $sub_table=
		// $outstanding_pr_detail= $xcrud->nested_table('Purchase details','pr_no','pr_detail','pr_no'); // 2nd level
		// $outstanding_pr_detail ->columns('pr_no,material_id,qty,remarks');
		// $sub_table->connection('root','root', 'bcspurchase_2015','10.2.2.32');
		$data['content4'] = $view_wrs->render();
		
		
	// //-----------------------------------------------------------------------------------------------------------------
		
	
		$meta = $this->meta;	
        $this->load->view('commons/header',$meta);  
        $this->load->view('grn',$data);
        $this->load->view('commons/foot_r');
		
    }

function update_lpb_balance()
{
		$po_item_id = $this->input->post('po_item_id');
		$qty = $this->input->post('qty');
		echo "tes berhasil";
		// $db = Xcrud_db::get_instance();
		// $db->connection('root','root','bcspurchase_2015','10.2.2.32');
		// $postdata->get('po_item_id',$po_item_id);
		// $postdata->get('qty',$qty_lpb);
		// $query = $db->query("select po_item.qty AS qty from po_item where po_item_id='".$po_item_id."'"); //".$po_item_id."
					// if ($query->num_rows() > 0)
					// {
						// $row = $query->row_array();						
						// $row['qty'];
					// }
					
					// $qty_po=$row['qty'];
					// $hasil=($qty_po-$qty_lpb);
		// $query3 = $db->query('UPDATE po_item SET lpb_balance ='.$hasil.' WHERE po_item_id ='.$po_item_id.'');			
		// //$query = $DB2->query("CALL ss_update_lpb_balance ('$po_item_id','$qty')");
	    // $db->query($query3);
		// //echo "OK";				//".$po_item_id."
					
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
		$query = $DB2->query("SELECT count(*) As running_no FROM lpb");
		if ($query->num_rows() > 0) {
			$row = $query->row_array(); //running number
			
			//running number formatting
			$running_no = $row['running_no'];
			if($running_no==0) $running_no = "001";
			else if($running_no>0 && $running_no<10) $running_no = "00".($running_no+1);
			else if($running_no>9 && $running_no<100) $running_no = "0".($running_no+1);
			
			//get user group
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
		  $proj2=("".$kat."-".$alias); //($bln,$t,$thn,$t,$tmp,$t);
		//	echo $proj2;
			$year =  date("Y"); //year
			
			//putting together
			$wrs_no = $running_no."/WRS/".$proj2."/".$year;
			echo $wrs_no;
			}
			
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

}

//
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

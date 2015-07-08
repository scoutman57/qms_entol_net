<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grn_non_pr extends MX_Controller
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
            'activeTab' => 'grn_non_pr'
			
        );	
	}
	
    public function index()
    {
        $this->load->helper('xcrud');
		$xcrud_wrs_non_pr = Xcrud::get_instance('xcrud_wrs_non_pr');
		$xcrud_wrs_non_pr->connection('root','','bcspurchase_2015');
        // $xcrud_wrs_non_pr->table('lpb');
		$grp=GROUPDESC;
		$kat ="NON_PR";
		$xcrud_wrs_non_pr->table('lpb');
			   // $xcrud_wrs_non_pr->where('user_group',$grp)->where('kategori =',$kat);				
		$xcrud_wrs_non_pr->where("lpb.user_group='".$grp."' AND lpb.kategori ='".$kat."' ");				
		
        $xcrud_wrs_non_pr->columns('lpb_no,lpb_date,vendor,project_code,received_by');
        $xcrud_wrs_non_pr->fields('lpb_no,lpb_date,project_code,vendor,received_by,transporter,mengetahui,user_group,kategori');
        $xcrud_wrs_non_pr->unset_title();
        $xcrud_wrs_non_pr->label('lpb_no','WRS No.');
        $xcrud_wrs_non_pr->label('user_group','');
        $xcrud_wrs_non_pr->label('transporter','Transporter');
        $xcrud_wrs_non_pr->label('mengetahui','Acknowledge');
        $xcrud_wrs_non_pr->label('lpb_date','WRS Date');
        $xcrud_wrs_non_pr->label('kategori','');
        $xcrud_wrs_non_pr->label('project_code','Project Code');
        $xcrud_wrs_non_pr->label('received_by','Received By');
		$xcrud_wrs_non_pr->set_attr('po_no',array('id'=>'po')); 
		
		//$xcrud_wrs_non_pr->validation_required('kategori');
		$xcrud_wrs_non_pr->validation_required('lpb_no');
		$xcrud_wrs_non_pr->validation_required('lpb_date');
		//$xcrud->validation_required('non_pr_grn_no');
		$usergroup =GROUPDESC;
		$kategori ="NON_PR";
		//$xcrud->relation('po_no','po','po_no','po_no');
		$xcrud_wrs_non_pr->set_attr('user_group',array('id'=>'user_group', 'type'=>'hidden','value'=>$usergroup)); //optional ambil session
		$xcrud_wrs_non_pr->set_attr('kategori',array('id'=>'kategori' , 'type'=>'hidden','value'=>$kategori)); //optional ambil session
		$xcrud_wrs_non_pr->set_attr('lpb_no',array('id'=>'lpb_no' ,'ReadOnly'=>'True')); //optional ambil session
		$xcrud_wrs_non_pr->set_attr('lpb_date',array('id'=>'lpb_date')); //optional ambil session
		$user =USER_NAME;
		//echo $user;
		$xcrud_wrs_non_pr->set_attr('received_by',array('readOnly'=>'True','id'=>'received_by','value'=>$user)); //optional ambil session
		$xcrud_wrs_non_pr->set_attr('project_code',array('id'=>'project_code')); //
		//$xcrud_wrs_non_pr->unset_remove();
		// $xcrud->unset_edit();
		$xcrud_wrs_non_pr->relation('project_code','eproc_service_project','project_code','project_site');
		$xcrud_wrs_non_pr->relation('mengetahui','ss_approvedby','nama1','nama1');
		$xcrud_wrs_non_pr->relation('vendor','view_vendor','vendor_id','nama'); //'eproc_service_project','project_code','project_site'
		$xcrud_wrs_non_pr->default_tab('WRS Header');
		$xcrud_wrs_non_pr->benchmark(true);
		$sub_table = $xcrud_wrs_non_pr_detail = $xcrud_wrs_non_pr->nested_table('WRS Detail','lpb_no','lpb_detail','lpb_no'); //  sub_table begin
		$xcrud_wrs_non_pr_detail ->columns('lpb_no,po_item_id,qty,unit,price'); //,trans_grn_detail_non_pr_diskon,trans_grn_detail_non_pr_ppn
		$xcrud_wrs_non_pr_detail ->fields('lpb_no,po_item_id,qty,price'); //non_pr_grn_detail_brand_price ,trans_grn_detail_non_pr_diskon,trans_grn_detail_non_pr_ppn,
		$xcrud_wrs_non_pr_detail->unset_title();
		$xcrud_wrs_non_pr_detail->label('po_item_id','Description');
		$xcrud_wrs_non_pr_detail->unset_edit();
		$xcrud_wrs_non_pr_detail->label('lpb_no','WRS No.');
		$xcrud_wrs_non_pr_detail->validation_required('po_item_id');
		$xcrud_wrs_non_pr_detail->validation_required('qty');
		$xcrud_wrs_non_pr_detail->set_attr('lpb_no',array('readOnly'=>'True'));
		$xcrud_wrs_non_pr_detail->relation('po_item_id','eproc_m_description','material_id','description');//,,'po_no = (select po_no from lpb where lpb_no = "{lpb_no}")'
		
		$sub_table->connection('root','','bcspurchase_2015');// end sub_table 
		$data['content2'] = $xcrud_wrs_non_pr->render();
	// //-
		$meta = $this->meta;	
        $this->load->view('commons/header',$meta);  
        $this->load->view('grn_non_pr',$data);
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
		$project_code = $this->input->post('project_code');
			
		$query2 = $DB2->query("SELECT bcspurchase_2015.project.project_code, bcspurchase_2015.project.site_alias, bcspurchase_2015.project.category
		FROM
		bcspurchase_2015.project
		WHERE
		bcspurchase_2015.project.project_code='".$project_code."'");
			if ($query2->num_rows() > 0)
			{
			$row = $query2->row_array(); 

		   $row['site_alias'];
		   $row['category'];
		
			   }
		  $alias=$row['site_alias'];
		  $kat=$row['category'];
		  $wrs="WRS";
		  $proj2=("".$kat."-".$alias); //($bln,$t,$thn,$t,$tmp,$t);
			//echo $proj2;
			$year =  date("Y"); //year
			$t = "/"; //year
						                     
		 $q = $DB2->query("select max(cast(f_split_string(lpb_no, '/', 1) as SIGNED)) as code_max FROM lpb
							where f_split_string(lpb_no, '/', 3) = '".$proj2."'");
        
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
			
			

}

//
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

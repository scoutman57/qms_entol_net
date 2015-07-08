<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_purchase extends MX_Controller
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
		//$this->load->model('model_pr');
		 //  $this->load->model('model_pr');
		//$this->load->model('model_pr');
		//$this->load->model('dn_model');
		$this->meta = array(
            'activeMenu' => 'maintenance',
            'activeTab' => 'trans_purchase'
			
        );
		
	}
	
    public function index()
    {
		  
			
		//---------------------------------------------------------------------------------------------------------------------------------------
		$this->load->helper('xcrud');
		//'kode'=>$this->model_mhs->create_no_pr(),
		$xcrud =Xcrud_get_instance('1');
		$xcrud->connection('root','','bcspurchase_2015');
		//$xcrud->table('pr');
		//$xcrud->where('catid =', 5);
		$grp=GROUPDESC;
			if($grp=='Administrator')
			{
				$xcrud->table('pr');
			    $xcrud->where('user_group', array('Administrator','General User','Transportation','Dam Truck','Marketing','Legal Department','Maintenance_Cilegon','Finance','Maintenance_Narogong'));
			} else {
				$xcrud->table('pr');
			    $xcrud->where('user_group', array(GROUPDESC));				
			}
		$xcrud->table_name('PR Header');
		$xcrud->modal('image,description');
		$xcrud->default_tab('Header');
		$xcrud ->columns('pr_no,pr_date,project,status,received_by,approved,request_by');
		$xcrud ->fields('no_urut,pr_no,pr_date,project,status,approved,prepared,request_by,user_group,received_by');
		$xcrud->unset_title();
		$xcrud->unset_remove();
		$xcrud->pass_var('create_user', USER_NAME, 'create');
		$xcrud->pass_var('create_date', date('Y-m-d H:i:s'), 'create');
		$xcrud->pass_var('modify_user', USER_NAME, 'edit');			
		$xcrud->pass_var('modify_date', date('Y-m-d H:i:s'), 'edit');	
		$xcrud->benchmark(true);
		$xcrud->label('received_by','');
		$xcrud->highlight('received_by', '=','SYSTEM', 'pink');
		$xcrud->highlight('received_by', '!=','SYSTEM', '#68DFF0');
		$xcrud->label('user_group','');
		$xcrud->label('approved','Approved By');
		$xcrud->label('request_by','Request By');
		$xcrud->label('prepared','Prepared By');
		$xcrud->label('pr_no','PR. No');
		$xcrud->label('no_urut','');
		$xcrud->label('pr_date','PR. Date');
		$xcrud->label('project','Project Code');
		$xcrud->label('status','PR. Status');
		$receivedby ="SYSTEM";
		$groupdesc =GROUPDESC;
		$xcrud->set_attr('received_by',array('type'=>'hidden','value'=>$receivedby)); 
		//$xcrud->column_tooltip('received_by', 'Pink = Outstanding PR');//'id'=>'received_by'
		$xcrud->set_attr('user_group',array('type'=>'hidden' , 'value'=>$groupdesc)); //,'value'=>$nopr ,'value'=>"02/2015/ES/001"
		$xcrud->set_attr('pr_no',array('id'=>'pr_no' ,'Readonly'=>'True')); //,'value'=>$nopr ,'value'=>"02/2015/ES/001"
		$xcrud->set_attr('no_urut',array('id'=>'no_urut' ,'type'=>'hidden')); 
		$xcrud->set_attr('request_by',array('id'=>'request_by' ,'type'=>'hidden')); //,'value=>{prepared}'
		$xcrud->set_attr('prepared',array('id'=>'prepared')); 
		$xcrud->set_attr('status',array('id'=>'status')); 
		$xcrud->set_attr('pr_date',array('id'=>'dated')); //,'required'=>'required'
		$xcrud->set_attr('project',array('id'=>'project')); //,'required'=>'required'
		$xcrud->validation_required('email');
		$xcrud->field_tooltip('trans_purchase_status',' Regular order, untuk order material dengan proyeksi kebutuhan selama 1 bulan, bisa berasal dari suggestion order atau diluar suggestion order
		Emergency Stock, adalah order untuk top up stock per minggu, berasal dari suggestion order
		Back order, adalah order untuk material yang dibutuhkan dan tidak ada di dalam stock, bisa berasal dari permintaan dari User dalam DN, SS, IIS, bisa juga karena ada potensi kebutuhan 
		');
		$xcrud->relation('prepared','ss_preparedby','nama1','nama1');
		$xcrud->relation('approved','ss_approvedby','nama1','nama1');
		$xcrud->relation('status','trans_purchase_status','trans_purchase_status_code','trans_purchase_status_name');
		$xcrud->relation('project','eproc_service_project','project_code','project_site');
		$xcrud->limit(8);
		$sub_table=
		//$pr_detail->connection('root','root','bcspurchase_2015','10.2.2.32','utf-8');
		//$pr_detail->connection('root','root','bcspurchase_2015','pr_detail');
		$pr_detail = $xcrud->nested_table('Details','pr_no','pr_detail','pr_no'); // 2nd level
		$pr_detail ->columns('pr_no,material_id,qty,remarks');
		$pr_detail ->fields('pr_id,pr_no,material_id,qty,remarks');
		$pr_detail->relation('material_id','eproc_m_description','material_id','description');
		$pr_detail->relation('trans_purchase_detail_description','mstr_material_data','material_id','material_data_description');
		
		$pr_detail->validation_required('material_id');
		$pr_detail->label('material_id','Description');
		$pr_detail->column_width('material_id','60%');
		$pr_detail->column_cut('250','material_id');
		$pr_detail->label('pr_no','PR. No');
		$pr_detail->unset_title();
		$pr_detail->unset_edit();
		$pr_detail->set_attr('pr_id',array('readonly'=>'readonly', 'id'=>'pr_id'));
		$pr_detail->set_attr('pr_no',array('readonly'=>'readonly'));
		$pr_detail->set_attr('material_id',array('id'=>'material_id'));
		$pr_detail->set_attr('trans_purchase_detail_description',array('disabled'=>'disabled','id'=>'description'));
	    $pr_detail->label('trans_purchase_detail_description','Description');
		$pr_detail->label('qty','Qty');
	    $pr_detail->label('remarks','Remarks');
		$pr_detail->set_attr('qty',array('id'=>'qty'));

		$pr_detail->default_tab(' ');
		$sub_table->connection('root','','bcspurchase_2015');
		$data['content'] = $xcrud->render();     

//view wrs---------------------------------------------------------------------------------------------------------------------------
		$this->load->helper('xcrud');
		//$outstanding_pr = =GROUPDESC;
		$groupdesc =GROUPDESC;
		//echo $groupdesc;
		$view_wrs = Xcrud::get_instance('view_wrs');
		$view_wrs->connection('root','','bcspurchase_2015');
		$view_wrs->table('print_lpb'); //eproc_pr_outstanding AND `pr`.`user_group`=$group
		
        //$view_wrs ->columns('pr_no,pr_date,project,status,received_by,approved,request_by');
	
		// $sub_table=
		// $outstanding_pr_detail= $xcrud->nested_table('Purchase details','pr_no','pr_detail','pr_no'); // 2nd level
		// $outstanding_pr_detail ->columns('pr_no,material_id,qty,remarks');
		// $sub_table->connection('root','','bcspurchase_2015');
		$data['content4'] = $view_wrs->render();	
 
//outstanding------------------------------------------------------------------------------------------------------------------------------------------- 
		$this->load->helper('xcrud');
		//$outstanding_pr = =GROUPDESC;
		//$groupdesc =GROUPDESC;
		//echo $groupdesc;
		$outstanding_pr = Xcrud::get_instance('outstanding_pr');
		$outstanding_pr->connection('root','','bcspurchase_2015');
		$grp=GROUPDESC;
			if($grp=='Administrator')
			{
				$outstanding_pr->table('eproc_pr_outstanding');
			    $outstanding_pr->where('user_group', array('Administrator','General User','Transportation','Dam Truck','Marketing','Legal Department','Maintenance_Cilegon','Finance','Maintenance_Narogong'));
			} else {
				$outstanding_pr->table('eproc_pr_outstanding');
			    $outstanding_pr->where('user_group', array(GROUPDESC));				
			}
		// $outstanding_pr->query("SELECT IF(EXISTS (SELECT `pr`.`pr_no` AS `pr_no`,`pr`.`pr_date` AS `pr_date`,`pr`.`project` AS `project`,`pr`.`request_by` AS `request_by`,`pr`.`approved` AS `approved`,`pr`.`prepared` AS `prepared`,`pr`.`received_by` AS `received_by`,`pr`.`status` AS `status` from `pr` WHERE `pr`.`received_by` = 'SYSTEM' AND `pr`.`user_group`='".$groupdesc."'), IF NOT EXISTS
		// (select distinct  '' AS `pr_no`,'' AS `pr_date`,'' AS `project`,'' AS `request_by`,''AS `approved`,'' AS `prepared`,'' AS `received_by`,'' AS `status` from `pr`),0)as A"); //eproc_pr_outstanding AND `pr`.`user_group`=$group
		
        $outstanding_pr ->columns('pr_no,pr_date,project,status,received_by,approved,request_by,Jumlah_Material');
	
		// $sub_table=
		// $outstanding_pr_detail= $xcrud->nested_table('Purchase details','pr_no','pr_detail','pr_no'); // 2nd level
		// $outstanding_pr_detail ->columns('pr_no,material_id,qty,remarks');
		// $sub_table->connection('root','','bcspurchase_2015');
		$data['content3'] = $outstanding_pr->render();		 	
		$meta = $this->meta;	
		$this->load->view('commons/header',$meta);
		$this->load->view('trans_purchase', $data);
		$this->load->view('commons/foot_r');
    }

  function project($project){
		$query = $this->db->query("
		SELECT bcspurchase_2015.project.project_code, bcspurchase_2015.project.site_alias, bcspurchase_2015.project.category
		FROM
		bcspurchase_2015.project
		WHERE
		bcspurchase_2015.project.project_code='".$project."'");
		   if ($query->num_rows() > 0)
		   {
		   $row = $query->row_array(); 

		   $row['site_alias'];
		   $row['category'];
		
			   }
		  $alias=$row['site_alias'];
		  $kat=$row['category'];
		  $proj=("".$alias. "-".$kat); //($bln,$t,$thn,$t,$tmp,$t);
		 echo $proj;
	 }     
	  function create_no_pr ($status,$project){
		$DB1 = $this->load->database('default', TRUE);
		$DB2 = $this->load->database('db2', TRUE); 		  
		$query = $this->db->query("
		SELECT bcspurchase_2015.project.project_code, bcspurchase_2015.project.site_alias, bcspurchase_2015.project.category
		FROM
		bcspurchase_2015.project
		WHERE
		bcspurchase_2015.project.project_code='".$project."'");
		   if ($query->num_rows() > 0)
		   {
		   $row = $query->row_array(); 

		   $row['site_alias'];
		   $row['category'];
		
			   }
		  $alias=$row['site_alias'];
		  $kat=$row['category'];
		  $proj=("".$kat."-".$alias); //($bln,$t,$thn,$t,$tmp,$t);
		 //echo $proj;
		 // echo $alias;
		 // echo $kat;
		
		 $now= date("Y/m/d");
		 $bln= date ('m');
		 $thn= date ('Y');
		 $t= "/";
		 //$q->connection('root','root','bcspurchase_2015');
		 $q = $DB2->query("SELECT Max(pr.no_urut) as code_max FROM pr");
         $code = "";		 
         if($q->num_rows()>0){
             foreach($q->result() as $cd){
                $tmp = ((int)$cd->code_max)+1;
                $code = sprintf("s", $tmp);
		//echo $tmp;
		//echo $proj;
				$dd = (str_pad("".$tmp."", 3, '0', STR_PAD_LEFT)."/".$status."/".$proj."/".$bln."/".$thn); //$alias."-".$kat."/".   //"".$tmp."",
				echo $dd;
			}
		        }
     }
  function create_id (){
		$DB1 = $this->load->database('default', TRUE);
		$DB2 = $this->load->database('db2', TRUE); 		  
		  $query = $DB2->query("select MAX(pr_detail.pr_id) as plus from pr_detail");
		   if ($query->num_rows() > 0)
		   {
		   $row = $query->row_array(); 

		   $row['plus'];
		   //$row['category'];
		
			   }
		  $idakhir=$row['plus'];
		  $plus1=($row['plus']+1);
		  echo $plus1;
}  
function no_urut (){
		$DB1 = $this->load->database('default', TRUE);
		$DB2 = $this->load->database('db2', TRUE); 		
		 $q = $DB2->query("SELECT Max(pr.no_urut) as code_max FROM pr");
         $code = "";		 
         if($q->num_rows()>0){
             foreach($q->result() as $cd){
                $tmp = ((int)$cd->code_max)+1;
                $code = sprintf("s", $tmp);
		echo $tmp;
		
										}
							}
					}

function ambilprepared ($prepared){
		$dpt="$prepared";
		//$e="eeee";
		echo $dpt;
		//echo $e;
					}								
function buat_pr_id (){
		$DB1 = $this->load->database('default', TRUE);
		$DB2 = $this->load->database('db2', TRUE); 	
		//$this->$DB2->reconnect();
		$query = $DB2->query("select MAX(pr_detail.pr_id) as plus from pr_detail");
		   if ($query->num_rows() > 0)
		   {
		   $row = $query->row_array(); 

		   $row['plus'];
		   //$row['category'];
		
			   }
		  $idakhir=$row['plus'];
		  $plus1=($row['plus']+1);
		  echo ($plus1);
					}					
							
}
//
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

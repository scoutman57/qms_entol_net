<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wo extends MX_Controller
{

   
    /**
	 * @author entol
	 * @copyright PT. BCS logistics
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
            'activeTab' => 'wo'
			
        );	
	}
	
    public function index()
    {
		
		$this->load->helper('xcrud');
		$xcrud = Xcrud::get_instance('xcrud');
       
        $xcrud->table('work_order');
        $xcrud->unset_title();
        $xcrud->default_tab('Header');
        
        $xcrud->columns('driver_name,no_rangka,nama_tipe,no_lambung,mechanic,payment_code,id,kilometer,hourmeter,problem,cause,status',true);
        $xcrud->fields('nomor_unit,project_code,wo_no,date,vendor,no_rangka,nama_tipe,no_lambung', false, 'Unit');
        $xcrud->fields('driver_name,mechanic,payment_code,kilometer,hourmeter,user_group,date_promised', false, 'Unit 2');
        $xcrud->fields('problem,cause', false, 'Problem & Cause');
        
        $xcrud->where('user_group =', GROUPDESC); //Select only this group records
        
        $xcrud->relation('nomor_unit','trans_mstr_unit','nomor_unit','nomor_unit');
        $xcrud->relation('driver_name','trans_mstr_supir','id','nama_personil',"trans_mstr_supir.aktif = 1 and trans_mstr_supir.kode = 'D'");
        $xcrud->set_attr('project_code',array('id'=>'project_code'));
        $xcrud->set_attr('project_code',array('readOnly'=>'True'));
        $xcrud->set_attr('wo_no',array('id'=>'wo_no'));
        $xcrud->set_attr('wo_no',array('readOnly'=>'True'));
        $xcrud->set_attr('nomor_unit',array('id'=>'nomor_unit'));
        $xcrud->set_attr('vendor',array('id'=>'vendor'));
        $xcrud->set_attr('vendor',array('readOnly'=>'True'));
        $xcrud->set_attr('no_rangka',array('id'=>'no_rangka'));
        $xcrud->set_attr('no_rangka',array('readOnly'=>'True'));
        $xcrud->set_attr('nama_tipe',array('id'=>'nama_tipe'));
        $xcrud->set_attr('nama_tipe',array('readOnly'=>'True'));
        $xcrud->set_attr('no_lambung',array('id'=>'no_lambung'));
        $xcrud->set_attr('no_lambung',array('readOnly'=>'True'));
        $xcrud->set_attr('user_group',array('id'=>'user_group'));
        $xcrud->set_attr('user_group',array('readOnly'=>'True'));
        $xcrud->change_type('payment_code','select','',array('values'=>array('-- Silahkan pilih --','00 = Customer','01 = Internal', '02 = Warranty')));
        $xcrud->label('vendor','Customer');
        $xcrud->label('no_rangka','Chassis No');
        $xcrud->label('nama_tipe','Type');
        $xcrud->label('no_lambung','Unit Code');
        $xcrud->label('nomor_unit','Unit No');
        $xcrud->label('date_promised','Promise Ready');
        
        $xcrud->validation_required('nomor_unit');
        $xcrud->validation_required('project_code');
        $xcrud->validation_required('wo_no');
        
        $xcrud->create_action('generate_wo','generate_wo'); //generate WO number automaticaly
        
        $wodetail = $xcrud->nested_table('Detail','wo_no','work_order_detail','wo_no'); //  sub_table begin
        $wodetail->fields('wo_no,op_number,op_description,qty,op_price,op_total,date_begin,date_end');
        $wodetail->unset_title();
        $wodetail->set_attr('wo_no',array('readOnly'=>'True'));
        $wodetail->set_attr('qty',array('id'=>'qty','class'=>'qty_price'));
        $wodetail->set_attr('op_price',array('id'=>'op_price','class'=>'qty_price'));
        $wodetail->set_attr('op_total',array('id'=>'op_total'));
        $wodetail->set_attr('op_total',array('readOnly'=>'True'));
        $wodetail->label('op_price','Time');
        $wodetail->label('op_total','Time Total');
        
		$data['content'] = $xcrud->render();
		$meta = $this->meta;	
        $this->load->view('commons/header',$meta);  
        $this->load->view('wo',$data);
        $this->load->view('commons/foot_r');
		
    }
	
	function generate_wo(){
		$DB1 = $this->load->database('default', TRUE); //ims
		$DB2 = $this->load->database('db2', TRUE); //bcspurchase_2015
		
		$nomor_unit = $this->input->post('nomor_unit'); //get ajax post data

		$query = $DB1->query("SELECT if(exists(select * FROM work_order), (select max(id) FROM work_order), 0) as running_no");
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array(); //running number
			
			//running number formatting
			$running_no = $row['running_no'];
			if($running_no==0) $running_no = "001";
			else if($running_no>=0 && $running_no<10) $running_no = "00".($running_no+1);
			else if($running_no>=9 && $running_no<100) $running_no = "0".($running_no+1);
			
			//get project category & site alias
			$query2 = $DB1->query("SELECT project_area FROM trans_mstr_unit where nomor_unit='".$nomor_unit."'");
			if ($query2->num_rows() > 0)
			{
				$row2 = $query2->row_array();						
				$project_area = $row2['project_area'];
				$query3 = $DB2->query("SELECT category, site_alias FROM project where project_code='".$project_area."'");
				if ($query3->num_rows() > 0)
				{
					$row3 = $query3->row_array();						
					$category = $row3['category'];
					$site = $row3['site_alias'];
				}
				else return false;
				
			}
			else return false;
			
			$year =  date("Y"); //year
			
			//putting together
			$wo_no = $running_no."/WO/".$category."-".$site."/".$year;
			echo $wo_no;
		}
		else return false;
	} 
	
	function get_customer(){
		$DB1 = $this->load->database('default', TRUE); //ims
		$nomor_unit = $this->input->post('nomor_unit');
		$query = $DB1->query("SELECT project_area,pemilik,no_rangka,nama_tipe,no_lambung FROM trans_mstr_unit where nomor_unit='".$nomor_unit."'");
		$array = array();
		if ($query->num_rows() > 0) {
			$row = $query->row_array(); 
			$array['pemilik'] = $row['pemilik'];
			$array['no_rangka'] = $row['no_rangka'];
			$array['nama_tipe'] = $row['nama_tipe'];
			$array['project_code'] = $row['project_area'];
			$array['no_lambung'] = $row['no_lambung'];
		}	
		else return false;
		
		echo json_encode($array);
	}
 	
}



//
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

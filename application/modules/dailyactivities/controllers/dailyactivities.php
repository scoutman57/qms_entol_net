<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dailyactivities extends MX_Controller
{

	/**
	 * @author entol
	 * @see more  http://www.entol.net
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
		$this->meta = array(
            'activeMenu' => 'master',
            'activeTab' => 'supir'
        );	
	}
	
    public function index()
    {
        $this->load->helper('xcrud');

        $xcrud = xcrud_get_instance();
        $xcrud->table('dailyactivitiest');
				// $xcrud->table_name('Profile');
				// $xcrud->default_tab('Profile');
		
		$xcrud->columns('dailyactivitiest_nik,dailyactivitiest_date,dailyactivitiest_dari,dailyactivities_sampai,dailyactivitiest_pelaksanaan_aktivitas,dailyactivitiest_hasil,dailyactivitiest_kendala,Catatan');
		$xcrud->fields('dailyactivitiest_nik,dailyactivitiest_date,dailyactivitiest_dari,dailyactivities_sampai,dailyactivitiest_pelaksanaan_aktivitas,dailyactivitiest_hasil,dailyactivitiest_kendala,Catatan');
$siapa=access;
		if ($siapa =="user")
	{
		$xcrud->highlight('Catatan', '=',NULL, 'pink');
		$xcrud->highlight('Catatan', '!=','', '#68DFF0');
		$xcrud->where('dailyactivitiest_nik=',nik);
		$xcrud->set_attr('Catatan',array('Disabled'=>'True'));
		$xcrud->set_attr('dailyactivitiest_nik',array('ReadOnly'=>'True','value'=>nik));
		$title="<h1>Daily Activities<small>User</small></h1>";
		$data['title'] = $title;
		}
else
	{
	$title="<h1>Daily Activities<small>Add Catatan</small></h1>";
	$xcrud->highlight('Catatan', '=',NULL, 'pink');
	$xcrud->highlight('Catatan', '!=','', '#68DFF0');
	$data['title'] = $title;
	$xcrud->where('group=',access_group);
	$xcrud->unset_add();
	$xcrud->unset_csv();
	$xcrud->unset_remove();
	
	//$xcrud->set_attr('dailyactivitiest_rencana',array('Disabled'=>'True'));
	$xcrud->set_attr('dailyactivitiest_date',array('Disabled'=>'True'));
	//$xcrud->set_attr('dailyactivitiest_rencana_proses',array('Disabled'=>'True'));
	$xcrud->set_attr('dailyactivitiest_pelaksanaan_aktivitas',array('Disabled'=>'True'));
	$xcrud->set_attr('dailyactivitiest_dari',array('Disabled'=>'True'));
	$xcrud->set_attr('dailyactivities_sampai',array('Disabled'=>'True'));
	$xcrud->set_attr('dailyactivitiest_hasil',array('Disabled'=>'True'));
	$xcrud->set_attr('dailyactivitiest_kendala',array('Disabled'=>'True'));
	}			// $xcrud->unset_add();
				// $xcrud->unset_pagination();
				// $xcrud->unset_print();
				// $xcrud->unset_csv();
				// $xcrud->unset_remove();
			//	echo GROUPNAME;
			//echo access;
			$xcrud->default_tab('Header');
			$ipaddress = $_SERVER['REMOTE_ADDR'];  
			$browser =@$_SERVER[HTTP_USER_AGENT];
			$xcrud->pass_var('group', GROUPNAME, 'create');
			$xcrud->pass_var('browser', $browser, 'create');
			$xcrud->pass_var('ip_address', $ipaddress, 'create');
			$xcrud->set_attr('dailyactivitiest_nik',array('ReadOnly'=>'True'));
			//$xcrud->pass_var('group_id', GROUPID);
			$xcrud->pass_var('create_user', USER_NAME, 'create');
			$xcrud->pass_var('create_date', date('Y-m-d H:i:s'), 'create');
			$xcrud->pass_var('modify_user', USER_NAME, 'edit');			
			$xcrud->pass_var('modify_date', date('Y-m-d H:i:s'), 'edit');
				 $xcrud->label('dailyactivitiest_nik','Nik');
				 $xcrud->label('dailyactivitiest_date','Date');
				 $xcrud->label('dailyactivitiest_rencana_proses','Rencana Proses');
				 $xcrud->label('dailyactivitiest_rencana','Rencana');
				 $xcrud->label('dailyactivitiest_pelaksanaan_aktivitas','Pelaksanaan');
				 $xcrud->label('dailyactivitiest_dari','Dari Pukul');
				 $xcrud->label('dailyactivities_sampai','Sampai pukul');
				 $xcrud->label('dailyactivitiest_hasil','Hasil');
				 $xcrud->label('dailyactivitiest_kendala','Kendala');
				 $xcrud->label('Catatan','Catatan');
				 $xcrud->benchmark();
				// echo nik;
				 
			$rencana = $xcrud->nested_table('Rencana','dailyactivitiest_id','dailyactivitiest_rencana','id_head'); // 2nd level
			$rencana ->columns('id_head,dari_pukul,sampai_pukul,rencana');
			$rencana ->fields('id_head,dari_pukul,sampai_pukul,rencana');
if (access=="admin"){
$rencana->unset_add();
	$rencana->unset_csv();
	$rencana->unset_remove();
	$rencana->unset_edit();
}
			$rencana->set_attr('id_head',array('ReadOnly'=>'True'));
			$ipaddress = $_SERVER['REMOTE_ADDR'];  
			$browser =@$_SERVER[HTTP_USER_AGENT];
			$rencana->pass_var('browser', $browser, 'create');
			$rencana->pass_var('ip_address', $ipaddress, 'create');
			//$xcrud->pass_var('group_id', GROUPID);
			$rencana->pass_var('create_user', USER_NAME, 'create');
			$rencana->pass_var('create_date', date('Y-m-d H:i:s'), 'create');
			$rencana->pass_var('modify_user', USER_NAME, 'edit');			
			$rencana->pass_var('modify_date', date('Y-m-d H:i:s'), 'edit');
			$rencana->unset_title();
			// $pelaksanaan = $xcrud->nested_table('Pelaksanaan ','dailyactivitiest_id','dailyactivitiest_pelaksanaan','id_head'); // 2nd level
			// $pelaksanaan ->columns('id_head,dari_pukul,sampai_pukul,pelaksanaan');
			// $pelaksanaan ->fields('id_head,dari_pukul,sampai_pukul,pelaksanaan');
			// $pelaksanaan->set_attr('id_head',array('ReadOnly'=>'True'));
			// $ipaddress = $_SERVER['REMOTE_ADDR'];  
			// $browser =@$_SERVER[HTTP_USER_AGENT];
			// $pelaksanaan->pass_var('browser', $browser, 'create');
			// $pelaksanaan->pass_var('ip_address', $ipaddress, 'create');
			// //$xcrud->pass_var('group_id', GROUPID);
			// $pelaksanaan->pass_var('create_user', USER_NAME, 'create');
			// $pelaksanaan->pass_var('create_date', date('Y-m-d H:i:s'), 'create');
			// $pelaksanaan->pass_var('modify_user', USER_NAME, 'edit');			
			// $pelaksanaan->pass_var('modify_date', date('Y-m-d H:i:s'), 'edit');
			// $pelaksanaan->unset_title();
				 // // $xcrud->set_attr('last_name',array('disabled'=>'True'));
				 // $xcrud->set_attr('default_group',array('Disabled'=>'True'));
				// $xcrud->change_type('foto','image',array('width' => 2, 'height' => 2));
		$xcrud->unset_title();
				//$xcrud->relation('jabatan','jabatan','kode_jabatan','nama_jabatan');
				
				
        $data['content'] = $xcrud->render();
		
		
				$meta = $this->meta;			
				$this->load->view('commons/header',$meta);	
				
        $this->load->view('dailyactivities', $data);
        $this->load->view('commons/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokumen_file extends MX_Controller
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
		$this->meta = array(
            'activeMenu' => 'master',
            'activeTab' => 'supir'
        );	
	}
	
    public function index()
    {
        $this->load->helper('xcrud');

        $xcrud = xcrud_get_instance();
        $xcrud->table('dokumen_file');
				$xcrud->table_name('Dokumen');
				$xcrud->default_tab('Dokumen');
				$xcrud->columns('nomor,divisi,	nama,deskripsi,dokumen');
				$xcrud->fields('nomor,divisi,	nama,deskripsi,dokumen');
				$xcrud->change_type('dokumen', 'file', '', array('not_rename'=>true));
				//$xcrud->change_type('dokumen','file',array('width' => 2, 'height' => 2));
				//
		if ( access == "user") {
				$xcrud->where('divisi=',access_group);
				//$xcrud->where('divisi=',$all);
				$xcrud->unset_add();
				$xcrud->unset_remove();
				$xcrud->unset_edit();
								}
		if ( access == "viewer" ) {
				//$xcrud->where('divisi=',access_group);
				//$xcrud->where('divisi=',$all);
				$xcrud->unset_add();
				$xcrud->unset_remove();
				$xcrud->unset_edit();
								}
		//$section ="<section class="content-header"><h1>Profile<small>Profile</small></h1><ol class="breadcrumb"></section>";
		//$data['section'];		// $xcrud->unset_add();
				//$xcrud->unset_pagination();
				//$xcrud->unset_print();
				//$xcrud->unset_limitlist();
				$xcrud->unset_csv();
				$xcrud->label('nama','Nama Dokumen');
				$xcrud->label('dokumen','Dokumen');
				//$xcrud->unset_remove();
				//$xcrud->unset_search();
				 $xcrud->benchmark();
				//$xcrud->unset_limit();
				 // $xcrud->set_attr('first_name',array('ReadOnly'=>'True'));
				 // $xcrud->set_attr('last_name',array('disabled'=>'True'));
				 // $xcrud->set_attr('default_group',array('ReadOnly'=>'True'));
				// $xcrud->change_type('foto','image',array('width' => 2, 'height' => 2));
				$xcrud->unset_title();
				$xcrud->relation('divisi','divisi','kode_divisi','nama_divisi');
				
				
        $data['content'] = $xcrud->render();
		
		
				$meta = $this->meta;			
				$this->load->view('commons/header',$meta);	
				
        $this->load->view('dokumen_file', $data);
        $this->load->view('commons/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

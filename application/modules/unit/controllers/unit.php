<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unit extends MX_Controller
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
		$this->meta = array(
            'activeMenu' => 'master',
            'activeTab' => 'unit'
        );	

	}
	
    public function index()
    {
		$this->load->helper('xcrud');
	    $xcrud = Xcrud::get_instance('instance1');
        $xcrud->table('trans_mstr_unit');
		$xcrud->table_name('Master Unit');
		$xcrud->columns('nomor_unit,
				kode_unit,
				nama_tipe,
				nama_produk,
				axle_arr ,
				no_rangka,
				no_mesin,
				project_area,
				sub_project,supir1,
				aktif'); 
		$xcrud->fields('nomor_unit,
				nama_tipe,
				pemilik,
				tahun,
				no_rangka,
				no_mesin,
				kode_unit,
				aktif',false,'Detail I');		
		$xcrud->fields('axle_arr,
				nama_produk,
				project_area,
				sub_project,
				helper',false,'Detail II');
		
		$xcrud->relation('pemilik','trans_mstr_owner','kode_owner','nama_owner');
		$xcrud->relation('tipe_unit','trans_mstr_tipe_unit','kode_tipe_unit','nama_tipe');
		$xcrud->relation('nama_tipe','trans_mstr_tipeunit','nama_tipe','nama_tipe');
		//$xcrud->relation('nama_produk','estation_product','nama','nama');
		$xcrud->relation('nama_produk','service_product_model','unit_model_id','unit_model_model_name');
		$xcrud->relation('project_area','eproc_service_project','project_code','project_site');
		$xcrud->relation('supir1','trans_mstr_supir','kode_personil','nama_personil');
		$xcrud->relation('supir2','trans_mstr_supir','kode_personil','nama_personil');
		$xcrud->relation('supir3','trans_mstr_supir','kode_personil','nama_personil');
		$xcrud->relation('supir4','trans_mstr_supir','kode_personil','nama_personil');
		$xcrud->relation('helper','trans_mstr_supir','kode_personil','nama_personil','kode="H"');
		$xcrud->change_type('bussiness_unit','radio','Transportation','Dump Truck, Transportation, Outsourcing');
		$xcrud->pass_var('create_user', USER_NAME, 'create');
		$xcrud->pass_var('create_date', date('Y-m-d H:i:s'), 'create');
		$xcrud->pass_var('modify_user', USER_NAME, 'edit');			
		$xcrud->pass_var('modify_date', date('Y-m-d H:i:s'), 'edit');	
		$xcrud->label('nama_produk','Product & Model');
		$xcrud->label('no_proyek','Project Area');
		$xcrud->label('nomor_unit','Nomor Polisi');
		$xcrud->label('nama_tipe','Type Unit');
		$xcrud->unset_remove();
		$xcrud->unset_title();
		
		$mst_unit_surat = $xcrud->nested_table('Dokumentasi','id','trans_mstr_unit_surat','id_unit');		
		$mst_unit_surat->unset_title();
		$mst_unit_surat->default_tab('Detail Information');
		$mst_unit_surat->table_name('Detail Material');
		$mst_unit_surat->columns('jenis_surat,tgl_expired,attachment');
		$mst_unit_surat->fields('jenis_surat,no_dokumen,tgl_expired,attachment,attachment_2');
		$mst_unit_surat->change_type('attachment', 'image');
		$mst_unit_surat->change_type('attachment_2', 'image');
		
		$data['content'] = $xcrud->render();
		//--------------------------------------------------------------------
		$this->load->helper('xcrud');
		$xcrud2 = Xcrud::get_instance('instance2');
		$xcrud2->table('trans_mstr_tipeunit');
		$xcrud2->columns('nama_tipe,tipeunit_no'); 
		$xcrud2->fields ('nama_tipe,tipeunit_no'); 
		$xcrud2->label('category_id','Category Code ');
		$xcrud2->label('tipeunit_no','Type No');
		$xcrud2->default_tab('Vehicle Type');
		$xcrud2->unset_title();
		
		$data['content2'] = $xcrud2->render();
        //--------------------------------------------------------------------
		$this->load->helper('xcrud');
		$modeldanproduc = Xcrud::get_instance('instance3');
        $modeldanproduc->table('trans_mstr_unit_product');
		$modeldanproduc->table_name('Product & Model'); 
		$modeldanproduc->columns('unit_product_no,nama'); 
		$modeldanproduc->fields ('unit_product_no,nama'); 
		//$modeldanproduc->set_attr('id',array('readonly'=>'True'));
		$modeldanproduc->label('nama','Product Name');
		$modeldanproduc->limit(10);
		$modeldanproduc->default_tab('Product');
		$modeldanproduc->unset_title();
		
		$trans_mstr_unit_model = $modeldanproduc->nested_table('Model','id','trans_mstr_unit_model','unit_model_product'); // 2nd level
		$trans_mstr_unit_model->columns('unit_model_id',true); 
		$trans_mstr_unit_model->fields ('unit_model_no,unit_model_product,unit_model_model_name'); 
		//$trans_mstr_unit_model->set_attr('unit_model_id',array('disabled'=>''));
		$trans_mstr_unit_model->set_attr('unit_model_product',array('disabled'=>''));
		$trans_mstr_unit_model->label('unit_model_product','Product Name');
		$trans_mstr_unit_model->label('unit_model_model_name','Model Name');
		$trans_mstr_unit_model->relation('unit_model_product','trans_mstr_unit_product','id','nama');
		$trans_mstr_unit_model->default_tab('');
		$trans_mstr_unit_model->limit(10);
		
		$data['content3'] = $modeldanproduc->render();//'create','edit',12
		//--------------------------------------------------------------------

		$meta = $this->meta;			
		$this->load->view('commons/header',$meta);			
		$this->load->view('unit', $data);
        $this->load->view('commons/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

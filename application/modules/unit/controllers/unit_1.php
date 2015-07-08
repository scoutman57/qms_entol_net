<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unit extends MX_Controller
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
	}
	
    public function index()
    {
        $this->load->helper('xcrud');

        $xcrud = xcrud_get_instance();
        $xcrud->table('trans_mstr_unit');
		$xcrud->table_name('Master Unit');
		$xcrud->default_tab('Info Kendaraan');
		// $xcrud->columns('no_surat_jalan,nomor_unit,route');
		
		// $xcrud->relation('kode_kustomer','xx_mstr_kustomer','kode_kustomer','nama_kustomer');
		$xcrud->relation('pemilik','trans_mstr_owner','kode_owner','nama_owner');
		$xcrud->relation('tipe_unit','trans_mstr_tipe_unit','kode_tipe_unit','nama_tipe');
		// $xcrud->relation('kode_bongkar2','trans_mstr_lokasi','kode_lokasi','nama_lokasi');
		// $xcrud->relation('kode_bongkar3','trans_mstr_lokasi','kode_lokasi','nama_lokasi');
	// //     $xcrud->label('kode_kustomer,Nama Kustomer');
		
		// $trans_transaksi_dn_detail = $xcrud->nested_table('Detail DN','no_surat_jalan','trans_transaksi_dn_detail','no_surat_jalan'); // 2nd level
		// $trans_transaksi_dn_detail->default_tab('Detail Information');
		// $trans_transaksi_dn_detail->table_name('Detail Delivery Notes');
		// $trans_transaksi_dn_detail->columns('nama_material,spesifikasi_material,berat,jumlah,tarif,total');
		// $trans_transaksi_dn_detail->fields('nama_material,spesifikasi_material,berat,jumlah,tarif,total');
	// //     $trans_transaksi_dn_detail->subselect('Totals','SELECT SUM(berat) FROM trans_transaksi_dn_detail'); // current table
	// //     $trans_transaksi_dn_detail->sum('creditLimit,Paid,Profit'); // sum row(), receives data from full table (ignores pagination)
	// //     $trans_transaksi_dn_detail->change_type('Profit','price','0',array('prefix'=>'$')); // number format
     
        $data['content'] = $xcrud->render();
        
        $this->load->view('commons/header');
        $this->load->view('unit', $data);
        $this->load->view('commons/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

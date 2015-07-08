<?php
phpinfo();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dn extends MX_Controller
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
            'activeMenu' => 'transportation',
            'activeTab' => 'dn'
        );	
	}
	
	public function index()
	{
			$this->load->helper('xcrud');

			$xcrud = xcrud_get_instance();
			$xcrud->table('trans_transaksi_dn_header');						
			$xcrud->default_tab('Info DN');
			$xcrud->table_name('Surat Jalan');
			$xcrud->columns('no_kontrak,no_surat_jalan,tgl_surat_jalan,nomor_unit,kode_route,total');
			$xcrud->order_by('tgl_surat_jalan','desc');
			$xcrud->subselect('total','SELECT (SELECT IFNULL(SUM(a.total),0) FROM trans_transaksi_dn_detail a where a.no_surat_jalan = {no_surat_jalan})+ (SELECT b.tarif + (b.tarif_lift_of * b.jum_lift_of) + (b.tarif_multidrop * b.jum_multidrop) FROM trans_transaksi_dn_header b where b.no_surat_jalan = {no_surat_jalan})'); // current table
			$xcrud->sum('total','Total is {total}');
			$xcrud->change_type('total','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
			$xcrud->column_class('total', 'align-right');
			$xcrud->readonly('tarif,tarif_lift_of,tarif_multidrop');
			$xcrud->set_attr('no_surat_jalan',array('id'=>'no_surat_jalan'));
			$xcrud->set_attr('no_kontrak',array('id'=>'no_kontrak'));
			$xcrud->set_attr('kode_route',array('id'=>'kode_route'));
			$xcrud->set_attr('jum_multidrop',array('id'=>'jum_multidrop'));
			$xcrud->set_attr('tarif',array('id'=>'tarif_header'));
			$xcrud->set_attr('tarif_multidrop',array('id'=>'tarif_multidrop'));
			$xcrud->set_attr('tarif_lift_of',array('id'=>'tarif_lift_of'));
			$xcrud->set_attr('opt_tarif',array('id'=>'opt_tarif','onclick'=>'fn_opt_tarif();'));
			$xcrud->set_attr('opt_kustomer',array('id'=>'opt_kustomer','onclick'=>'fn_opt_kustomer();'));
			$xcrud->set_attr('kode_kustomer',array('id'=>'kode_kustomer'));
			$xcrud->set_attr('no_dokumen',array('id'=>'no_dokumen'));
			$xcrud->set_attr('kode_produk',array('id'=>'kode_produk'));
			$xcrud->set_attr('nomor_unit',array('id'=>'nomor_unit'));
			$xcrud->set_attr('kode_supir',array('id'=>'kode_supir'));
			
			// $xcrud->create_action('my_action','my_function'); 
			
			$xcrud->fields('no_surat_jalan,tgl_surat_jalan,opt_kustomer,kode_kustomer,no_kontrak', false, 'Penomoran');			
			$xcrud->fields('opt_dokumen,no_dokumen,kode_route', false, 'Dokumen');
			$xcrud->fields('kode_bongkar1,kode_bongkar2,kode_bongkar3,opt_tarif, shift', false, 'Pembongkaran');
			$xcrud->fields('tgl_berangkat,tgl_est_tiba_di_kust,tgl_akt_tiba_di_kust,tgl_est_POD,tgl_aktual_POD,tgl_info_ke_KS', false, 'Waktu');
			$xcrud->fields('kode_produk,nomor_unit,kode_supir,nomor_kontainer,kode_kapal', false, 'Barang');
			$xcrud->fields('jum_multidrop,tarif_multidrop,jum_lift_of, tarif_lift_of,tarif,total,status_surat_jalan', false, 'Tarif');
			$xcrud->relation('no_kontrak','trans_mstr_kontrak_header','id','no_kontrak','status = "Open"','','','','','kode_kustomer','kode_kustomer');			
			//$xcrud->relation('no_kontrak','trans_mstr_kontrak_header','no_kontrak','no_kontrak');			
			$xcrud->relation('no_dokumen','trans_mstr_proyek','no_proyek','nama_proyek','','id desc');			
			
			$xcrud->relation('kode_kustomer','xx_mstr_kustomer','kode_kustomer','nama_kustomer');
			//$xcrud->relation('kode_route','trans_mstr_route','kode_route','keterangan');
			
			$xcrud->relation('kode_route','trans_mstr_route','kode_route','keterangan','','','','','','kode_kustomer','kode_kustomer');			
			$xcrud->relation('kode_bongkar1','xx_mstr_kust_ship_to','nid','plant_bongkar','','','',' ','','kode_kustomer','kode_kustomer');
			$xcrud->relation('kode_bongkar2','xx_mstr_kust_ship_to','nid','plant_bongkar','','','',' ','','kode_kustomer','kode_kustomer');
			$xcrud->relation('kode_bongkar3','xx_mstr_kust_ship_to','nid','plant_bongkar','','','',' ','','kode_kustomer','kode_kustomer');			
			$xcrud->relation('nomor_unit','trans_mstr_unit','nomor_unit','nomor_unit','','','',' -- ');
			$xcrud->relation('kode_supir','v_mstr_supir','kode_supir','nama_supir');
			$xcrud->relation('kode_kapal','trans_mstr_kapal','kode_kapal','nama_kapal');
			$xcrud->relation('kode_produk','trans_mstr_produk','kode_produk','nama_produk');
			
			$xcrud->label(array('no_kontrak' => 'No. Kontrak / No. PO'));
			$xcrud->label(array('kode_bongkar1' => 'Plant Bongkar 1'));
			$xcrud->label(array('kode_bongkar2' => 'Plant Bongkar 2'));
			$xcrud->label(array('kode_bongkar3' => 'Plant Bongkar 3'));
			$xcrud->label(array('opt_kustomer' => 'Tipe Kustomer'));
			$xcrud->label(array('opt_dokumen' => 'Tipe Dokumen'));
			$xcrud->label(array('kode_kustomer' => 'Nama Kustomer'));
			$xcrud->label(array('kode_route' => 'Route'));
			$xcrud->label(array('total' => 'Total'));
			$xcrud->change_type('opt_tarif','radio','','Tujuan,Balikan');
			$xcrud->change_type('shift','radio','','1,2,3');
			$xcrud->change_type('opt_dokumen','radio','','PO,SCF,SPK,Lainnya');
			$xcrud->change_type('opt_kustomer','radio','','KS - Import,KS - Posco,KS - Delta,KS - Domestik,Lain-lain');
			$xcrud->change_type('status_surat_jalan','radio','Open','Open,Close1,Close2');

			$trans_transaksi_dn_detail = $xcrud->nested_table('Detail Material','no_surat_jalan','trans_transaksi_dn_detail','no_surat_jalan'); // 2nd level
			$trans_transaksi_dn_detail->unset_title();
			$trans_transaksi_dn_detail->columns('nama_material,spesifikasi_material,jumlah,kode_satuan_jum,berat,kode_satuan_berat,tarif,total,keterangan');
			$trans_transaksi_dn_detail->fields('nama_material,spesifikasi_material,jumlah,kode_satuan_jum,berat,kode_satuan_berat,tarif,total,keterangan');
			$trans_transaksi_dn_detail->set_attr('jumlah',array('id'=>'jumlah'));
			$trans_transaksi_dn_detail->set_attr('berat',array('id'=>'berat'));
			$trans_transaksi_dn_detail->set_attr('tarif',array('id'=>'tarif_detail'));
			$trans_transaksi_dn_detail->set_attr('total',array('id'=>'total'));
			$trans_transaksi_dn_detail->set_attr('kode_satuan_jum',array('id'=>'kode_satuan_jum'));
			$trans_transaksi_dn_detail->set_attr('kode_satuan_berat',array('id'=>'kode_satuan_berat'));
			$trans_transaksi_dn_detail->set_attr('kode_satuan_tarif',array('id'=>'kode_satuan_tarif'));

			$trans_transaksi_dn_detail->relation('kode_satuan_jum','xx_mstr_satuan','satuan','satuan');
			$trans_transaksi_dn_detail->relation('kode_satuan_berat','xx_mstr_satuan','satuan','satuan');
			$trans_transaksi_dn_detail->relation('kode_satuan_tarif','xx_mstr_satuan','satuan','satuan');
			$trans_transaksi_dn_detail->label(array('kode_satuan_jum' => 'Satuan'));
			$trans_transaksi_dn_detail->label(array('kode_satuan_berat' => 'Satuan'));
			$trans_transaksi_dn_detail->label(array('kode_satuan_tarif' => 'Satuan'));
			$trans_transaksi_dn_detail->subselect('Total Detail','SELECT SUM(tarif) FROM trans_transaksi_dn_detail where no_surat_jalan = {no_surat_jalan}'); // current table
			$trans_transaksi_dn_detail->sum('total','Total price is {value}');
			$trans_transaksi_dn_detail->sum('berat','Total berat is {value}');
			$trans_transaksi_dn_detail->change_type('Total Detail','price','0',array('prefix'=>'$'));
			$trans_transaksi_dn_detail->change_type('total','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>',','id'=>'total'));
			$trans_transaksi_dn_detail->change_type('tarif','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>',','id'=>'tarif_detail'));
			$trans_transaksi_dn_detail->column_class('total,tarif,berat', 'align-right');
			
			$data['content'] = $xcrud->render();
			
			$meta = $this->meta;			
			$this->load->view('commons/header',$meta);			
			$this->load->view('dn', $data);
			$this->load->view('commons/footer');
	}
		
	public function getCustByKontrak($no_kontrak) 
	{
	  $this->db->select('kode_kustomer');
		$q = $this->db->get_where('trans_mstr_kontrak_header', array('id' => $no_kontrak), 1); 
		  if( $q->num_rows() > 0 )
		  {
				echo $q->row()->kode_kustomer;
		  } 	
	}	

	public function getProjByKontrak($no_kontrak) 
	{
	  $this->db->select('no_proyek');
		$this->db->join('trans_mstr_kontrak_header', 'trans_mstr_proyek.no_kontrak = trans_mstr_kontrak_header.no_kontrak');
		$q = $this->db->get_where('trans_mstr_proyek', array('trans_mstr_kontrak_header.id' => $no_kontrak), 1); 
		  if( $q->num_rows() > 0 )
		  {
				echo $q->row()->no_proyek;
		  } 	
	}	

	public function getTarif($id_kontrak,$route,$tujuan_balikan,$opt_kustomer,$kode_produk,$nomor_unit) 
	{		
		$opt_kustomer = urldecode($opt_kustomer);
		if($opt_kustomer == 'KS - Import' || $opt_kustomer == 'KS - Posco')
		{			
 			if ($tujuan_balikan == 'Tujuan'){
				$this->db->select('tarif,satuan_tarif,tarif_multidrop,tarif_lift_of');
				$this->db->join('trans_mstr_kontrak_header', 'trans_mstr_kontrak_header.no_kontrak = trans_mstr_kontrak_tujuan.no_kontrak');
				$q = $this->db->get_where('trans_mstr_kontrak_tujuan', array('trans_mstr_kontrak_header.id' => $id_kontrak,																		 
																			'trans_mstr_kontrak_tujuan.kode_route' => $route
																			), 1); 
					if( $q->num_rows() > 0 )
					{					
						echo json_encode($q->row());
					}	 				
			} elseif ($tujuan_balikan == 'Balikan'){
				$this->db->select('tarif,satuan_tarif,tarif_multidrop,tarif_lift_of');
				$this->db->join('trans_mstr_kontrak_header', 'trans_mstr_kontrak_header.no_kontrak = trans_mstr_kontrak_balikan.no_kontrak');
				$q = $this->db->get_where('trans_mstr_kontrak_balikan', array('trans_mstr_kontrak_header.id' => $id_kontrak,																		  
																			'trans_mstr_kontrak_balikan.kode_route' => $route
																			), 1); 
					if( $q->num_rows() > 0 )
					{					
						echo json_encode($q->row());
					} 				
			}
		
		} elseif($opt_kustomer == 'KS - Delta')	
		{		 			
			$tipe_unit='';
			$str = "SELECT nama_tipe FROM trans_mstr_unit WHERE nomor_unit = '$nomor_unit'";
			$hasil=$this->db->query($str);
			if($hasil->num_rows() > 0)
			{			
				foreach($hasil->result() as $rows)
				{								
					$tipe_unit=$rows->nama_tipe;				
				}
			}				
			if ($tujuan_balikan == 'Tujuan'){
				$this->db->select('tarif,satuan_tarif,tarif_multidrop,tarif_lift_of');
				$this->db->join('trans_mstr_kontrak_header', 'trans_mstr_kontrak_header.no_kontrak = trans_mstr_kontrak_tujuan.no_kontrak');
				$q = $this->db->get_where('trans_mstr_kontrak_tujuan', array('trans_mstr_kontrak_header.id' => $id_kontrak,																		 
																			'trans_mstr_kontrak_tujuan.kode_route' => $route,
																			'trans_mstr_kontrak_tujuan.tipe_unit' => $tipe_unit,
																			'trans_mstr_kontrak_tujuan.kode_produk' => $kode_produk
																			), 1); 
					if( $q->num_rows() > 0 )						
					{											
						echo json_encode($q->row());
					}	 				
			} elseif ($tujuan_balikan == 'Balikan'){
				$this->db->select('tarif,satuan_tarif,tarif_multidrop,tarif_lift_of');
				$this->db->join('trans_mstr_kontrak_header', 'trans_mstr_kontrak_header.no_kontrak = trans_mstr_kontrak_balikan.no_kontrak');
				$q = $this->db->get_where('trans_mstr_kontrak_balikan', array('trans_mstr_kontrak_header.id' => $id_kontrak,																		  
																			'trans_mstr_kontrak_balikan.kode_route' => $route
																			), 1); 
					if( $q->num_rows() > 0 )
					{					
						echo json_encode($q->row());
					} 				
			}
		}
	}	
	
	public function getNoKontrakImport($tipe_kustomer) 
	{
			$tipe_kustomer = urldecode($tipe_kustomer);
			$this->db->select('id');
			$this->db->order_by('id', 'desc');
			$this->db->limit(1);
			$q = $this->db->get_where('trans_mstr_kontrak_header', array('trans_mstr_kontrak_header.opt_kustomer' => $tipe_kustomer
																																	), 1); 
				if( $q->num_rows() > 0 )
				{
					echo $q->row()->id;
				} 				
	}	

	public function getNamaSupir($no_unit) 
	{
			$no_unit = urldecode($no_unit);
			$this->db->select('supir1');
			$this->db->limit(1);
			$q = $this->db->get_where('trans_mstr_unit', array('trans_mstr_unit.nomor_unit' => $no_unit
																																	), 1); 
				if( $q->num_rows() > 0 )
				{
					echo $q->row()->supir1;
				} 				
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

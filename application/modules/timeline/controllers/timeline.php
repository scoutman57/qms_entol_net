<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timeline extends MX_Controller
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
		
		$this->meta = array(
            'activeMenu' => 'timeline',
            'activeTab' => 'timeline'
			 );
		
       	
	}
	
    public function index()
    {
		//$this->load->model('timeline');
		//
	
		$this->load->library('lib_pagination');                         //Load the "lib_pagination" library
        $pg_config['sql']      = "
								SELECT
								news.id,
								news.judul,
								news.artikel,
								news.gambar,
								news.youtube_url,
								news.tanggal,
								news.created,
								news.icon,
								news.frame,
								news.`status`,
								news.entry_by,
								news.entry_id,
								view_users.nama_lengkap,
								view_users.nama_divisi,
								view_users.foto AS foto_penulis
								FROM
								news
								LEFT OUTER JOIN view_users ON news.entry_id = view_users.id ORDER BY news.id DESC
								";              //your SQL, don't add ";" in your SQL query
        $pg_config['per_page'] = 3;                                     //Display items per page
        $data = $this->lib_pagination->create_pagination($pg_config);   //Load function in "lib_pagination" libraryfor create pagination. 
        $this->load->helper('xcrud');
        $meta = $this->meta;			
		$this->load->view('commons/header',$data);		
        $this->load->view('timeline',$data);
        $this->load->view('commons/footer');
    }
	function baca_artikel(){
		$id= $_GET['news_id'];
		//$data['recent_news'] = $this->db->get('recent_news');
		//$data = $this->timeline->getArticle();
		$this->load->library('lib_pagination');                         //Load the "lib_pagination" library
        $pg_config['sql']      = "SELECT
								news.id,
								news.judul,
								news.artikel,
								news.gambar,
								news.youtube_url,
								news.tanggal,
								news.created,
								news.icon,
								news.frame,
								news.`status`,
								news.entry_by,
								news.entry_id,
								view_users.nama_lengkap AS author,
								view_users.nama_divisi,
								view_users.foto AS foto_penulis
								FROM
								news
								LEFT OUTER JOIN view_users ON news.entry_id = view_users.id WHERE
								news.id='".$id."'";              //your SQL, don't add ";" in your SQL query
        $pg_config['per_page'] = 1;                                     //Display items per page
        $data = $this->lib_pagination->create_pagination($pg_config);   //Load function in "lib_pagination" libraryfor create pagination. 
		$data['test']= $this->db->query('select `news`.`id` AS `id_widget`,`news`.`judul` AS `judul_widget`,`news`.`artikel` AS `artikel_widget`,`news`.`gambar` AS `gambar_widget`,`news`.`youtube_url` AS `youtube_url_widget`,`news`.`tanggal` AS `tanggal_widget`,`news`.`created` AS `created_widget`,`news`.`icon` AS `icon_widget`,`news`.`frame` AS `frame_widget`,`news`.`status` AS `status_widget`,`news`.`entry_by` AS `entry_by_widget`,`news`.`entry_id` AS `entry_id_widget`,`view_users`.`nama_lengkap` AS `nama_lengkap_widget`,`view_users`.`nama_divisi` AS `nama_divisi_widget`,`view_users`.`foto` AS `foto_penulis_widget`
										from (`news` left join `view_users` on((`news`.`entry_id` = `view_users`.`id`)))
										group by `news`.`id`
										ORDER BY
										`id_widget` ASC
										LIMIT 5');
		$data['carousel_indicators'] = $this->db->get('view_gambar');
        $this->load->view('commons/header');		
        $this->load->view('news_even',$data);
        $this->load->view('commons/footer');
	}		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

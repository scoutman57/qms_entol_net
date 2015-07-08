<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends MX_Controller
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
            //'activeMenu' => 'master',
            'activeTab' => 'news'
        );	
	}
	
    public function index()
    {
				$this->load->helper('xcrud');
				$xcrud = xcrud_get_instance();
				$xcrud->table('news');
				$xcrud->table_name(' Add News & Event');
				//$xcrud->default_tab('Text Message');
				$xcrud->columns('id,judul,artikel,gambar,tanggal,entry_by');
				$xcrud->fields('judul,artikel,gambar,status,youtube_url,icon,frame,entry_by');
				$xcrud->button('http://localhost/qms/timeline/baca_artikel?news_id={id}', 'Preview', 'glyphicon glyphicon-zoom-in');
				//$xcrud->fields('description,image,document,remark', false, 'Attachment');
				//$xcrud->change_type('artikel', 'textarea'); hi, great work so far! image upload and table linking are “killer features” for your app.
				//$xcrud->change_type('gambar','image');
				$xcrud->change_type('gambar', 'image', false, array(
									'width' => 450,
									'path' => '../uploads',
									'thumbs' => array(array(
													'height' => 55,
													'width' => 120,
													'crop' => true,
													'marker' => '_th'))));
				$xcrud->order_by('id','desc');
				 $xcrud->benchmark();
				$xcrud->pass_var('entry_by',USER_NAME,'create');
				$xcrud->pass_var('entry_id',id,'create');
				 $hari= date ('w');
					 $tgl= date ('d');
					 $bln= date ('m');
					 $thn= date ('y');
						  switch($hari){
						   case 0 :{
								 $hari='Minggu';
								 } break;
						   case 1 :{
								 $hari='Senin';
								 } break;
						   case 2 :{
								 $hari='Selasa';
								 } break;
						   case 3 :{
								 $hari='Rabu';
								 } break;
							
						   case 4 :{
								 $hari='Kamis';
								 } break;
						   case 5 :{
								$hari='Jumat';
								 } break;
						   case 6 :{
								 $hari='Sabtu';
								 } break;
						 default:{
								$hari='Unknown';
								
								 }break;
						   
						    }
					 switch($bln){
						 
						   case 1 :{
								 $bln='Januari';
								 } break;
						   case 2 :{
								 $bln='Februari';
								 } break;
						   case 3 :{
								 $bln='Maret';
								 } break;
								
						   case 4 :{
								 $bln='April';
								 } break;
						   case 5 :{
								 $bln='Mei';
								 } break;
						  case 6 :{
								 $bln='Juni';
								} break;
						  case 7 :{
							 $bln='Juli';
								 } break;
						  case 8 :{
								 $bln='Agustus';
								 } break;
						  case 9 :{
								 $bln='September';
								 } break;
								
						  case 10 :{
								$bln='Oktober';
								 } break;
						   case 11 :{
								 $bln='November';
								 } break;
						  case 12 :{
								 $bln='Desember';
								 } break;
						 default:{
								 $bln='Unknown';
								
								 }break;
						   
						    }
				$tgl_bahasaindo =($hari. ", " .$tgl." " .$bln." "."20".$thn);
				$xcrud->pass_var('tanggal',$tgl_bahasaindo,'create');
				// echo USER_NAME ;
				$xcrud->unset_view();
				
				 $xcrud->set_attr('entry_by',array('ReadOnly'=>'True'));
				 $xcrud->set_attr('icon',array('ReadOnly'=>'True','id'=>'icon'));
				 $xcrud->set_attr('frame',array('ReadOnly'=>'True','id'=>'frame'));
				 $xcrud->set_attr('youtube_url',array('id'=>'youtube_url'));
				//echo id;
        $data['content'] = $xcrud->render();
		
		
				$meta = $this->meta;			
				$this->load->view('commons/header',$meta);	
				
        $this->load->view('news', $data);
        $this->load->view('commons/footer');
    }
	function get_frame(){
			
		//$DB1 = $this->load->database('default', TRUE); //ims
		//$DB2 = $this->load->database('db2', TRUE); 	//bcsuprchase_2015
		$data = $this->input->post('youtube_url');
		IF ($data != NULL);
		{
					$a='<div class="embed-responsive embed-responsive-16by9">  &lt;iframe class="embed-responsive-item" src="'.$data.'" frameborder="0" allowfullscreen&gt;&lt;/iframe></div>';
					
					echo htmlspecialchars_decode($a);
		}
	}	
		function get_icon(){
			
		$DB1 = $this->load->database('default', TRUE); //ims
		//$DB2 = $this->load->database('db2', TRUE); 	//bcsuprchase_2015
		$data = $this->input->post('youtube_url');
		IF ($data != NULL);
		{
					echo "fa fa-video-camera bg-maroon";
		}
	}
		function edit_post($edit_post){
				$this->load->helper('xcrud');
				$xcrud = xcrud_get_instance();
				$xcrud->table('news');
				$xcrud->table_name(' Add News & Event');
				//$xcrud->default_tab('Text Message');
				$xcrud->columns('id,judul,artikel,gambar,tanggal,entry_by');
				$xcrud->fields('judul,artikel,gambar,status,youtube_url,icon,frame,entry_by');
				$xcrud->button('http://localhost/qms/timeline/baca_artikel?news_id={id}', 'Preview', 'glyphicon glyphicon-zoom-in');
				//$xcrud->fields('description,image,document,remark', false, 'Attachment');
				$xcrud->unset_view();
				//$xcrud->change_type('gambar','image');
				$xcrud->change_type('gambar', 'image', false, array(
									'width' => 450,
									'path' => '../uploads',
									'thumbs' => array(array(
													'height' => 55,
													'width' => 120,
													'crop' => true,
													'marker' => '_th'))));
				$xcrud->order_by('id','desc');
				 $xcrud->benchmark();
				$xcrud->pass_var('entry_by',USER_NAME,'create');
				$xcrud->pass_var('entry_id',id,'create');
				 $hari= date ('w');
					 $tgl= date ('d');
					 $bln= date ('m');
					 $thn= date ('y');
						  switch($hari){
						   case 0 :{
								 $hari='Minggu';
								 } break;
						   case 1 :{
								 $hari='Senin';
								 } break;
						   case 2 :{
								 $hari='Selasa';
								 } break;
						   case 3 :{
								 $hari='Rabu';
								 } break;
							
						   case 4 :{
								 $hari='Kamis';
								 } break;
						   case 5 :{
								$hari='Jumat';
								 } break;
						   case 6 :{
								 $hari='Sabtu';
								 } break;
						 default:{
								$hari='Unknown';
								
								 }break;
						   
						    }
					 switch($bln){
						 
						   case 1 :{
								 $bln='Januari';
								 } break;
						   case 2 :{
								 $bln='Februari';
								 } break;
						   case 3 :{
								 $bln='Maret';
								 } break;
								
						   case 4 :{
								 $bln='April';
								 } break;
						   case 5 :{
								 $bln='Mei';
								 } break;
						  case 6 :{
								 $bln='Juni';
								} break;
						  case 7 :{
							 $bln='Juli';
								 } break;
						  case 8 :{
								 $bln='Agustus';
								 } break;
						  case 9 :{
								 $bln='September';
								 } break;
								
						  case 10 :{
								$bln='Oktober';
								 } break;
						   case 11 :{
								 $bln='November';
								 } break;
						  case 12 :{
								 $bln='Desember';
								 } break;
						 default:{
								 $bln='Unknown';
								
								 }break;
						   
						    }
				$tgl_bahasaindo =($hari. ", " .$tgl." " .$bln." "."20".$thn);
				$xcrud->pass_var('tanggal',$tgl_bahasaindo,'create');
				// echo USER_NAME ;
				//$xcrud->unset_limit();
				
				 $xcrud->set_attr('entry_by',array('ReadOnly'=>'True'));
				 $xcrud->set_attr('icon',array('ReadOnly'=>'True','id'=>'icon'));
				 $xcrud->set_attr('frame',array('ReadOnly'=>'True','id'=>'frame'));
				 $xcrud->set_attr('youtube_url',array('id'=>'youtube_url'));
				//echo id;
        $data['content'] = $xcrud->render('edit',$edit_post);
		
		
				$meta = $this->meta;			
				$this->load->view('commons/header',$meta);	
				
        $this->load->view('news', $data);
        $this->load->view('commons/footer');	
		$DB1 = $this->load->database('default', TRUE); 
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

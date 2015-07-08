<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		
		// check if user logged in 
		if (!$this->ion_auth->logged_in())
	  	{
			header('location:'.base_url().'auth/login');	
	  	}
		$this->load->helper('url');
		$this->load->library('form_validation');
		//$this->security->csrf_verify(); 
		$this->load->model('home_model');	
		
		$this->meta = array(
            'activeMenu' => 'dashboard', // laporan
            'activeTab' => 'dashboard' //expire_unit
        );	
	}
	
   function index()
   {
		$meta = $this->meta;
	   if($this->input->get('year')){ $year = $this->input->get('year'); } else { $year = date('Y'); }
	   if($this->input->get('week')){ $week = $this->input->get('week'); } else { $week = date('W'); } 
	   if($this->input->get('month')){ $month = $this->input->get('month'); } else { $month = date('m', strtotime($year.'W'.$week)); }
	   
	   $this->form_validation->set_rules('comment', $this->lang->line("comment"), 'xss_clean');
	  
	  if ($this->form_validation->run() == true)
		{ 
			$comment = $this->ion_auth->clear_tags($this->input->post('comment'));
			//echo $comment; die('');
		}
	  
	  if ( $this->form_validation->run() == true && $this->home_model->updateComment($comment) )
		{ 
				$this->session->set_flashdata('success_message', $this->lang->line("comment_updated"));
				header('location:'.base_url().'home');	
		}
		else
		{ 

	  
	  $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	  $data['success_message'] = $this->session->flashdata('success_message');
	  $config['translated_day_names'] = array($this->lang->line("sunday"), $this->lang->line("monday"), $this->lang->line("tuesday"), $this->lang->line("wednesday"), $this->lang->line("thursday"), $this->lang->line("friday"), $this->lang->line("saturday"));
	  $config['translated_month_names'] = array('01' => $this->lang->line("january"), '02' => $this->lang->line("february"), '03' => $this->lang->line("march"), '04' => $this->lang->line("april"), '05' => $this->lang->line("may"), '06' => $this->lang->line("june"), '07' => $this->lang->line("july"), '08' => $this->lang->line("august"), '09' => $this->lang->line("september"), '10' => $this->lang->line("october"), '11' => $this->lang->line("november"), '12' => $this->lang->line("december"));
		
	  $config['template'] = '

   			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-top: 10px;">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}" style="text-align:center;">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td class="cl_wday">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}';

		
		$this->load->library('week_cal', $config);
		
		
	   $cal_data = $this->home_model->get_calendar_data($year, $month);
	   $data['calendar'] = $this->week_cal->generateWeek($week, $year, $month, $cal_data);
	   
	  $data['com'] = $this->home_model->getComment();	
		
      $meta['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";
      // $data['page_title'] = "Expired Unit Dokumentation";
	  $data['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";

      $this->load->view('commons/header', $meta);
      // $this->load->view('expire_unit', $data);
      $this->load->view('content', $data);
      $this->load->view('commons/footer-home');
   	}
   }
   
	 function expire_unit(){
		$meta = array(
            'activeMenu' => 'laporan', // laporan
            'activeTab' => 'expire_unit' //expire_unit
        );	
	   if($this->input->get('year')){ $year = $this->input->get('year'); } else { $year = date('Y'); }
	   if($this->input->get('week')){ $week = $this->input->get('week'); } else { $week = date('W'); } 
	   if($this->input->get('month')){ $month = $this->input->get('month'); } else { $month = date('m', strtotime($year.'W'.$week)); }
	   
	   $this->form_validation->set_rules('comment', $this->lang->line("comment"), 'xss_clean');
	  
	  if ($this->form_validation->run() == true)
		{ 
			$comment = $this->ion_auth->clear_tags($this->input->post('comment'));
			echo $comment; die('');
		}
	  
	  if ( $this->form_validation->run() == true && $this->home_model->updateComment($comment) )
		{ 
				$this->session->set_flashdata('success_message', $this->lang->line("comment_updated"));
				header('location:'.base_url().'home');	
		}
		else
		{ 

	  
	  $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	  $data['success_message'] = $this->session->flashdata('success_message');
	  $config['translated_day_names'] = array($this->lang->line("sunday"), $this->lang->line("monday"), $this->lang->line("tuesday"), $this->lang->line("wednesday"), $this->lang->line("thursday"), $this->lang->line("friday"), $this->lang->line("saturday"));
	  $config['translated_month_names'] = array('01' => $this->lang->line("january"), '02' => $this->lang->line("february"), '03' => $this->lang->line("march"), '04' => $this->lang->line("april"), '05' => $this->lang->line("may"), '06' => $this->lang->line("june"), '07' => $this->lang->line("july"), '08' => $this->lang->line("august"), '09' => $this->lang->line("september"), '10' => $this->lang->line("october"), '11' => $this->lang->line("november"), '12' => $this->lang->line("december"));
		
	  $config['template'] = '

   			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-top: 10px;">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}" style="text-align:center;">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td class="cl_wday">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}';

		
		$this->load->library('week_cal', $config);
		
		
	   $cal_data = $this->home_model->get_calendar_data($year, $month);
	   $data['calendar'] = $this->week_cal->generateWeek($week, $year, $month, $cal_data);
	   
	  $data['com'] = $this->home_model->getComment();	
		
      $meta['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";
      $data['page_title'] = "Expired Unit Dokumentation";
	  // $data['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";

      $this->load->view('commons/header', $meta);
      //$this->load->view('expire_unit', $data);
      // $this->load->view('content', $data);
      $this->load->view('commons/footer-home');
   	}		 
	 }

	 function expire_supir(){
		$meta = array(
            'activeMenu' => 'laporan', // laporan
            'activeTab' => 'expire_supir' //expire_unit
        );	
	   if($this->input->get('year')){ $year = $this->input->get('year'); } else { $year = date('Y'); }
	   if($this->input->get('week')){ $week = $this->input->get('week'); } else { $week = date('W'); } 
	   if($this->input->get('month')){ $month = $this->input->get('month'); } else { $month = date('m', strtotime($year.'W'.$week)); }
	   
	   $this->form_validation->set_rules('comment', $this->lang->line("comment"), 'xss_clean');
	  
	  if ($this->form_validation->run() == true)
		{ 
			$comment = $this->ion_auth->clear_tags($this->input->post('comment'));
			echo $comment; die('');
		}
	  
	  if ( $this->form_validation->run() == true && $this->home_model->updateComment($comment) )
		{ 
				$this->session->set_flashdata('success_message', $this->lang->line("comment_updated"));
				header('location:'.base_url().'home');	
		}
		else
		{ 

	  
	  $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	  $data['success_message'] = $this->session->flashdata('success_message');
	  $config['translated_day_names'] = array($this->lang->line("sunday"), $this->lang->line("monday"), $this->lang->line("tuesday"), $this->lang->line("wednesday"), $this->lang->line("thursday"), $this->lang->line("friday"), $this->lang->line("saturday"));
	  $config['translated_month_names'] = array('01' => $this->lang->line("january"), '02' => $this->lang->line("february"), '03' => $this->lang->line("march"), '04' => $this->lang->line("april"), '05' => $this->lang->line("may"), '06' => $this->lang->line("june"), '07' => $this->lang->line("july"), '08' => $this->lang->line("august"), '09' => $this->lang->line("september"), '10' => $this->lang->line("october"), '11' => $this->lang->line("november"), '12' => $this->lang->line("december"));
		
	  $config['template'] = '

   			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-top: 10px;">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}" style="text-align:center;">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td class="cl_wday">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}';

		
		$this->load->library('week_cal', $config);
		
		
	   $cal_data = $this->home_model->get_calendar_data($year, $month);
	   $data['calendar'] = $this->week_cal->generateWeek($week, $year, $month, $cal_data);
	   
	  $data['com'] = $this->home_model->getComment();	
		
      $meta['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";
      $data['page_title'] = "Expired Supir Dokumen";
	  // $data['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";

      $this->load->view('commons/header', $meta);
      $this->load->view('expire_supir', $data);
      // $this->load->view('content', $data);
      $this->load->view('commons/footer-home');
   	}		 
	 }

   function update_comment()
   {
	   $this->form_validation->set_rules('comment', $this->lang->line("comment"), 'xss_clean');
	  
	  if ($this->form_validation->run() == true)
		{ 
			$comment = $this->ion_auth->clear_tags($this->input->post('comment'));
		}
	  
	  if ( $this->form_validation->run() == true && $this->home_model->updateComment($comment) )
		{ 
				$this->session->set_flashdata('success_message', $this->lang->line("comment_updated"));
				header('location:'.base_url().'home');	
	
		}
   }
   
   function image_upload()
   {
	 
			if(DEMO) { 
				$error = array('error' => $this->lang->line('disabled_in_demo'));
				echo json_encode($error);
				exit;
			}
		
		$this->security->csrf_verify(); 	
		if(isset($_FILES['file'])){
				
		$this->load->library('upload_photo');
		
		$config['upload_path'] = 'assets/uploads/images/'; 
		$config['allowed_types'] = 'gif|jpg|png|pjpeg'; 
		$config['max_size'] = '500';
		$config['max_width'] = '800';
		$config['max_height'] = '800';
		$config['overwrite'] = FALSE; 
		
			$this->upload_photo->initialize($config);
			
			if( ! $this->upload_photo->do_upload('file')){
			
				$error = $this->upload_photo->display_errors();
				$error = array('error' => $error);
				echo json_encode($error);
				exit;

			} 
		
		$photo = $this->upload_photo->file_name;
		$array = array(
        	'filelink' => base_url().'assets/uploads/images/'.$photo
		);
	
		echo stripslashes(json_encode($array));
		exit;
		
		} else {
			$error = array('error' => 'No file selected to upload!');
			echo json_encode($error);
			exit;
		}
   	  
   }
   
   function language($lang = false){
	    if($this->input->get('lang')){ $lang = $this->input->get('lang'); }
		$this->load->helper('cookie');
		$folder = 'inv/language/';
		$languagefiles = scandir($folder);
		if(in_array($lang, $languagefiles)){
		//setcookie("sma_language", $lang, '31536000');
		$cookie = array(
                   'name'   => 'language',
                   'value'  => $lang,
                   'expire' => '31536000',
				   'prefix' => 'sma_',
				   'secure' => false
               );
 
		$this->input->set_cookie($cookie);
		}
		redirect($_SERVER["HTTP_REFERER"]); 
	}
	
   function getdatatableajax()
   {
		// if($this->_is_ajax()){
			$this->load->library('datatables'); 
			$this->datatables
			->select("nomor_unit,
					bussiness_unit,
					jenis_surat,
					maxdate,
					hari,
					status,
					warna")
			->from("v_expire_unit")
			->add_column("maxdate",
			'<center>			
				<span class="label $3 label-mini">$2</span>
			</center>', "id,status_invoice,label_type")
			->add_column("Actions", 
			'<center>			
				<a class="btn btn-success btn-xs" title="View" href="'.base_url().'inquiry/view/$1/$2"><i class="fa fa-eye"></i></a>
			</center>', "")
			->unset_column('');


			echo $this->datatables->generate();
   }

   function get_expire_supir()
   {
		// if($this->_is_ajax()){
			$this->load->library('datatables'); 
			$this->datatables
			->select("nama_supir,
					jenis_surat,
					maxdate,
					hari")
			->from("v_expire_supir")
			->add_column("maxdate",
			'<center>			
				<span class="label $3 label-mini">$2</span>
			</center>', "id,status_invoice,label_type")
			->add_column("Actions", 
			'<center>			
				<a class="btn btn-success btn-xs" title="View" href="'.base_url().'inquiry/view/$1/$2"><i class="fa fa-eye"></i></a>
			</center>', "")
			->unset_column('');


			echo $this->datatables->generate();
   }

}

/* End of file home.php */ 
/* Location: ./sma/modules/home/controllers/home.php */
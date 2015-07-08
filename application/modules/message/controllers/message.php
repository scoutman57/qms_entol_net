<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends MX_Controller
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
		$this->meta = array(
            //'activeMenu' => 'master',
            'activeTab' => 'message'
        );	
	}
	
    public function index()
    {
        $this->load->helper('xcrud');

        $xcrud = xcrud_get_instance();
        $xcrud->table('message');
				$xcrud->table_name('message');
				//$xcrud->default_tab('Text Message');
				$xcrud->columns('to,subject,message');
				$xcrud->fields('to,from,subject,message,from_id', false, 'Text Message');
				$xcrud->fields('description,image,document,remark', false, 'Attachment');
				$xcrud->change_type('image','image');
				$xcrud->column_width('message','70%');
				$xcrud->hide_button('save_return');
				$xcrud->change_type('document','file');
				$xcrud->where('from_id', array(id));
				$xcrud->order_by('date','desc');
				$xcrud->unset_edit();
				$xcrud->unset_csv();
				$xcrud->unset_search();
				 $xcrud->benchmark();
				// $xcrud->pass_var('from',USER_NAME,'create');
				// echo USER_NAME ;
				//$xcrud->unset_limit();
				$xcrud->label('from_id','');
				// $xcrud->p('first_name',array('ReadOnly'=>'True'));
				 $xcrud->set_attr('subject',array('id'=>'subject'));
				 $xcrud->set_attr('from',array('ReadOnly'=>'True' ,'value'=>USER_NAME));
				 // $xcrud->buttons_position('left');
				 $idid=id;
				 $xcrud->set_attr('from_id',array('ReadOnly'=>'True' ,'type'=>'hiddden' ,'value'=>$idid));
				// $xcrud->pass_var('from_id',id,'create'); 'type'=>'hidden'
				 // $xcrud->set_attr('last_name',array('disabled'=>'True'));
				 // $xcrud->set_attr('default_group',array('ReadOnly'=>'True'));
				// $xcrud->change_type('foto','image',array('width' => 2, 'height' => 2));
				$xcrud->unset_title();
				$xcrud->relation('to','view_users','id','nama_lengkap');
				$xcrud->hide_button('return');
				$xcrud->validation_required('to');
				$xcrud->validation_required('subject');
				//echo id;
        $data['content'] = $xcrud->render('create');
		
		
				$meta = $this->meta;			
				$this->load->view('commons/header',$meta);	
				
        $this->load->view('message', $data);
        $this->load->view('commons/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

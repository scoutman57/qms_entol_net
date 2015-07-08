<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller
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
        $xcrud->table('users');
				$xcrud->table_name('Profile');
				$xcrud->default_tab('Profile');
				$xcrud->columns('email,first_name,last_name,phone,company,default_group,foto');
				$xcrud->fields('email,first_name,last_name,phone,company,default_group,foto');
				$xcrud->where('users.id=',id);
				//echo nik;
				$xcrud->hide_button('save_return');
				$xcrud->hide_button('return');
				$xcrud->unset_add();
				$xcrud->unset_pagination();
				$xcrud->unset_print();
				$xcrud->unset_limitlist();
				$xcrud->unset_csv();
				$xcrud->unset_remove();
				$xcrud->unset_search();
				 $xcrud->benchmark();
				//$xcrud->unset_limit();
				 $xcrud->set_attr('first_name',array('ReadOnly'=>'True'));
				 $xcrud->set_attr('last_name',array('disabled'=>'True'));
				 $xcrud->set_attr('default_group',array('ReadOnly'=>'True'));
				$xcrud->change_type('foto','image',array('width' => 2, 'height' => 2));
				$xcrud->unset_title();
				//$xcrud->relation('jabatan','jabatan','kode_jabatan','nama_jabatan');
				
				
        $data['content'] = $xcrud->render('edit',id);
		
		
				$meta = $this->meta;			
				$this->load->view('commons/header',$meta);	
				
        $this->load->view('profile', $data);
        $this->load->view('commons/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

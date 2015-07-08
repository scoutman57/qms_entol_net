<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth
*
* Author: Ben Edmunds
*		  ben.edmunds@gmail.com
*         @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Ion_auth
{
	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;

	/**
	 * extra where
	 *
	 * @var array
	 **/
	public $_extra_where = array();

	/**
	 * extra set
	 *
	 * @var array
	 **/
	public $_extra_set = array();

	/**
	 * caching of users and their groups
	 *
	 * @var array
	 **/
	public $_cache_user_in_group;

	/**
	 * __construct
	 *
	 * @return void
	 * @author Ben
	 **/
	public function __construct()
	{
		$this->load->config('auth/ion_auth', TRUE);
		$this->load->library('email');
		$this->lang->load('auth/ion_auth');
		$this->load->helper('cookie');
		$this->load->helper('language');
		$this->load->helper('url');

		// Load the session, CI2 as a library, CI3 uses it as a driver
		if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->load->library('session');
		}
		else
		{
			$this->load->driver('session');
		}

		$this->load->model('auth/ion_auth_model');

		$this->_cache_user_in_group =& $this->ion_auth_model->_cache_user_in_group;

		//auto-login the user if they are remembered
		if (!$this->logged_in() && get_cookie($this->config->item('identity_cookie_name', 'ion_auth')) && get_cookie($this->config->item('remember_cookie_name', 'ion_auth')))
		{
			$this->ion_auth_model->login_remembered_user();
		}

		$email_config = $this->config->item('email_config', 'ion_auth');

		if ($this->config->item('use_ci_email', 'ion_auth') && isset($email_config) && is_array($email_config))
		{
			$this->email->initialize($email_config);
		}

		$this->ion_auth_model->trigger_events('library_constructor');

		define("DEMO", 0);
		
		// Site setting
		//$this->load->library('setting');
		$SETTING = $this->ion_auth_model->get_setting();
		define("LOGO", $SETTING->logo);
		define("LOGO2", $SETTING->logo2);
		define("SITE_NAME", $SETTING->site_name);
		define("VERSION", '2.1.3');
		define("THEME", $SETTING->theme);
		if(get_cookie('sma_language')) {
			if(file_exists('self/language/'.get_cookie('sma_language').'/sma_lang.php') && is_dir('self/language/'.get_cookie('sma_language'))) {
			$this->lang->load('sma', get_cookie('sma_language'));
			define("LANGUAGE", get_cookie('sma_language'));
			}
		} else {
			$this->lang->load('sma', $SETTING->language);
			define("LANGUAGE", $SETTING->language);
		}
				
		
		if ($this->logged_in()) {
			
		if($df = $this->ion_auth_model->getDateFormat($SETTING->dateformat)) {
			define("JS_DATE", $df->js);
			define("PHP_DATE", $df->php);
			define("MYSQL_DATE", $df->sql);
		} else {
			define("JS_DATE", 'mm-dd-yyyy');
			define("PHP_DATE", 'm-d-Y');
			define("MYSQL_DATE", '%m-%d-%Y');
		}
			
		define("DEFAULT_INVOICE", $SETTING->default_invoice_type);
		define("DEFAULT_TAX", $SETTING->default_tax_rate);
		define("DEFAULT_TAX2", $SETTING->default_tax_rate2);
		define("TAX1", $SETTING->tax1);
		define("TAX2", $SETTING->tax2);
		define("DEFAULT_WAREHOUSE", $SETTING->default_warehouse);
		define("CURRENCY_PREFIX", $SETTING->currency_prefix);
		define("NO_OF_ROWS", $SETTING->no_of_rows);
		define("TOTAL_ROWS", $SETTING->total_rows);
		define("ROWS_PER_PAGE", $SETTING->rows_per_page);
		define("PRODUCT_SERIAL", $SETTING->product_serial);
		define("DEFAULT_DISCOUNT", $SETTING->default_discount);
		define("DISCOUNT_OPTION", $SETTING->discount_option);
		define("DISCOUNT_METHOD", $SETTING->discount_method);
		define("BARCODE_SYMBOLOGY", $SETTING->barcode_symbology);
		define("SALES_REF", $SETTING->sales_prefix);
		define("QUOTE_REF", $SETTING->quote_prefix);
		define("PURCHASE_REF", $SETTING->purchase_prefix);
		define("TRANSFER_REF", $SETTING->transfer_prefix);
		//define("ALERT_NO", $this->ion_auth_model->get_total_results());
		
			$user = $this->user()->row();	
			$user_groups = $this->ion_auth_model->get_users_groups($user->id)->result_array();
			// phpinfo();
			// print_r(array_column($user_groups, 'id');
			// die();
			// print_r($first_names);
			// if (in_array_field("3","id", $user_groups)) {
					// echo "Got Irix";
			// }
			// die(implode(',', array_column($user_groups, 'id')));
			// echo("<pre>");
			// // print_r($user_groups);
			// print_r(json_decode(GROUP_AUTH));
			// echo("<pre>");
		$query = $this->db->query("SELECT
									qms.users.email AS email,
									qms.users.default_group AS default_group,
									qms.users.first_name AS first_name,
									qms.users.last_name AS last_name,
									qms.users.phone AS phone,
									qms.users.nik AS nik,
									qms.users.id AS id,
									qms.users_groups.group_id AS group_id,
									qms.users_groups.access AS access,
									qms.users_groups.access_group AS access_group,
									qms.users.foto,
									qms.groups.`name`
									FROM
									(qms.users
									LEFT JOIN qms.users_groups ON ((qms.users.id = qms.users_groups.user_id)))
									LEFT JOIN qms.groups ON qms.users_groups.group_id = qms.groups.id
									WHERE qms.users.id = '".$user->id."'
									group by `qms`.`users`.`id` ");
		   if ($query->num_rows() > 0)
		   {
		   $row = $query->row_array(); 
		   $row['id'];
		   $poto=$row['foto'];
		   $user1=$row['email'];
		   $user1=$row['username'];
			   }
						define("id",$row['id']);
			define("nik",$row['nik']);
			define("access",$row['access']);
			define("access_group",$row['access_group']);
			define("email",$row['email']);
			define("foto",$row['foto']);
			define("nik",$row['id']);
			   
			//notifikasi
			$query = $this->db->query("SELECT
										message.from_id AS from_id,
										view_users.nama_lengkap AS nama_lengkap,
										view_users.nama_divisi AS nama_divisi,
										message.`subject` AS `subject`,
										message.date AS date,
										view_users.foto AS foto,
										message.`to` AS `to`
										from (`message` left join `view_users` on((`message`.`from_id` = `view_users`.`id`)))
										where (`message`.`to` ='".$user->id."') ");
		   if ($query->num_rows() > 0)
		   {
		   $row = $query->row_array(); 
		   $row['nama_lengkap'];
			   }

			define("nama_divisi_notif",$row['nama_divisi']);
			define("subject_notif",$row['subject']);  
			define("date_notif",$row['date']);  
			define("foto_notif",$row['foto']);
			define("to",$row['to']);		
			//count
			$query = $this->db->query("SELECT
										Count(message.bool) AS message_notif_count,
										message.`to` AS `to`
										from (`message` join `view_users` on((`message`.`to` = `view_users`.`id`)))
										where ((`message`.`to` = '".$user->id."') and (`message`.`bool` = 0)) ");
		   if ($query->num_rows() > 0)
		   {
		   $row = $query->row_array(); 
		   $row['message_notif_count'];
			   }
			define("message_notif_count",$row['message_notif_count']); 
			define("FIRST_NAME", $user->first_name);
			// define("USER_NAME", $user->first_name." ".$user->last_name."<BR>".GROUPDESC);
			define("USER_NAME", $user->first_name." ".$user->last_name);
			define("USER_ID", $user->id);						
			define("USER", $user->username);						
			define("GROUPID", $user->default_group);
			define("GROUPNAME", $this->ion_auth_model->get_users_groups(USER_ID)->row()->name);
			define("GROUPDESC", $this->ion_auth_model->get_users_groups(USER_ID)->row()->description);
			define("GROUP_AUTH", "'".implode("','", array_column($user_groups, 'id'))."'");
		}				
	}

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 **/
	public function __call($method, $arguments)
	{
		if (!method_exists( $this->ion_auth_model, $method) )
		{
			throw new Exception('Undefined method Ion_auth::' . $method . '() called');
		}

		return call_user_func_array( array($this->ion_auth_model, $method), $arguments);
	}

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}


	/**
	 * forgotten password feature
	 *
	 * @return mixed  boolian / array
	 * @author Mathew
	 **/
	public function forgotten_password($identity)    //changed $email to $identity
	{
		if ( $this->ion_auth_model->forgotten_password($identity) )   //changed
		{
			// Get user information
            $user = $this->where($this->config->item('identity', 'ion_auth'), $identity)->where('active', 1)->users()->row();  //changed to get_user_by_identity from email

			if ($user)
			{
				$data = array(
					'identity'		=> $user->{$this->config->item('identity', 'ion_auth')},
					'forgotten_password_code' => $user->forgotten_password_code
				);

				if(!$this->config->item('use_ci_email', 'ion_auth'))
				{
					$this->set_message('forgot_password_successful');
					return $data;
				}
				else
				{
					$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password', 'ion_auth'), $data, true);
					$this->email->clear();
					$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
					$this->email->to($user->email);
					$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_forgotten_password_subject'));
					$this->email->message($message);

					if ($this->email->send())
					{
						$this->set_message('forgot_password_successful');
						return TRUE;
					}
					else
					{
						$this->set_error('forgot_password_unsuccessful');
						return FALSE;
					}
				}
			}
			else
			{
				$this->set_error('forgot_password_unsuccessful');
				return FALSE;
			}
		}
		else
		{
			$this->set_error('forgot_password_unsuccessful');
			return FALSE;
		}
	}

	/**
	 * forgotten_password_complete
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function forgotten_password_complete($code)
	{
		$this->ion_auth_model->trigger_events('pre_password_change');

		$identity = $this->config->item('identity', 'ion_auth');
		$profile  = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

		if (!$profile)
		{
			$this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
			$this->set_error('password_change_unsuccessful');
			return FALSE;
		}

		$new_password = $this->ion_auth_model->forgotten_password_complete($code, $profile->salt);

		if ($new_password)
		{
			$data = array(
				'identity'     => $profile->{$identity},
				'new_password' => $new_password
			);
			if(!$this->config->item('use_ci_email', 'ion_auth'))
			{
				$this->set_message('password_change_successful');
				$this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
					return $data;
			}
			else
			{
				$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password_complete', 'ion_auth'), $data, true);

				$this->email->clear();
				$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
				$this->email->to($profile->email);
				$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_new_password_subject'));
				$this->email->message($message);

				if ($this->email->send())
				{
					$this->set_message('password_change_successful');
					$this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
					return TRUE;
				}
				else
				{
					$this->set_error('password_change_unsuccessful');
					$this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
					return FALSE;
				}

			}
		}

		$this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
		return FALSE;
	}

	/**
	 * forgotten_password_check
	 *
	 * @return void
	 * @author Michael
	 **/
	public function forgotten_password_check($code)
	{
		$profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

		if (!is_object($profile))
		{
			$this->set_error('password_change_unsuccessful');
			return FALSE;
		}
		else
		{
			if ($this->config->item('forgot_password_expiration', 'ion_auth') > 0) {
				//Make sure it isn't expired
				$expiration = $this->config->item('forgot_password_expiration', 'ion_auth');
				if (time() - $profile->forgotten_password_time > $expiration) {
					//it has expired
					$this->clear_forgotten_password_code($code);
					$this->set_error('password_change_unsuccessful');
					return FALSE;
				}
			}
			return $profile;
		}
	}

	/**
	 * register
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function register($username, $password, $email, $additional_data = array(), $group_ids = array()) //need to test email activation
	{
		$this->ion_auth_model->trigger_events('pre_account_creation');

		$email_activation = $this->config->item('email_activation', 'ion_auth');

		if (!$email_activation)
		{
			$id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);
			if ($id !== FALSE)
			{
				$this->set_message('account_creation_successful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
				return $id;
			}
			else
			{
				$this->set_error('account_creation_unsuccessful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}
		}
		else
		{
			$id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);

			if (!$id)
			{
				$this->set_error('account_creation_unsuccessful');
				return FALSE;
			}

			$deactivate = $this->ion_auth_model->deactivate($id);

			if (!$deactivate)
			{
				$this->set_error('deactivate_unsuccessful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}

			$activation_code = $this->ion_auth_model->activation_code;
			$identity        = $this->config->item('identity', 'ion_auth');
			$user            = $this->ion_auth_model->user($id)->row();

			$data = array(
				'identity'   => $user->{$identity},
				'id'         => $user->id,
				'email'      => $email,
				'activation' => $activation_code,
			);
			if(!$this->config->item('use_ci_email', 'ion_auth'))
			{
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
				$this->set_message('activation_email_successful');
					return $data;
			}
			else
			{
				$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_activate', 'ion_auth'), $data, true);

				$this->email->clear();
				$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
				$this->email->to($email);
				$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
				$this->email->message($message);

				if ($this->email->send() == TRUE)
				{
					$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
					$this->set_message('activation_email_successful');
					return $id;
				}
			}

			$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
			$this->set_error('activation_email_unsuccessful');
			return FALSE;
		}
	}

	/**
	 * logout
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function logout()
	{
		$this->ion_auth_model->trigger_events('logout');

		$identity = $this->config->item('identity', 'ion_auth');
                $this->session->unset_userdata( array($identity => '', 'id' => '', 'user_id' => '') );

		//delete the remember me cookies if they exist
		if (get_cookie($this->config->item('identity_cookie_name', 'ion_auth')))
		{
			delete_cookie($this->config->item('identity_cookie_name', 'ion_auth'));
		}
		if (get_cookie($this->config->item('remember_cookie_name', 'ion_auth')))
		{
			delete_cookie($this->config->item('remember_cookie_name', 'ion_auth'));
		}

		//Destroy the session
		$this->session->sess_destroy();

		//Recreate the session
		if (substr(CI_VERSION, 0, 1) == '2')
		{
			$this->session->sess_create();
		}
		else
		{
			$this->session->sess_regenerate(TRUE);
		}

		$this->set_message('logout_successful');
		return TRUE;
	}

	/**
	 * logged_in
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function logged_in()
	{
		$this->ion_auth_model->trigger_events('logged_in');

		return (bool) $this->session->userdata('identity');
	}

	/**
	 * logged_in
	 *
	 * @return integer
	 * @author jrmadsen67
	 **/
	public function get_user_id()
	{
		$user_id = $this->session->userdata('user_id');
		if (!empty($user_id))
		{
			return $user_id;
		}
		return null;
	}


	/**
	 * is_admin
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function is_admin($id=false)
	{
		$this->ion_auth_model->trigger_events('is_admin');

		$admin_group = $this->config->item('admin_group', 'ion_auth');

		return $this->in_group($admin_group, $id);
	}

	/**
	 * in_group
	 *
	 * @param mixed group(s) to check
	 * @param bool user id
	 * @param bool check if all groups is present, or any of the groups
	 *
	 * @return bool
	 * @author Phil Sturgeon
	 **/
	public function in_group($check_group, $id=false, $check_all = false)
	{
		$this->ion_auth_model->trigger_events('in_group');

		$id || $id = $this->session->userdata('user_id');

		if (!is_array($check_group))
		{
			$check_group = array($check_group);
		}

		if (isset($this->_cache_user_in_group[$id]))
		{
			$groups_array = $this->_cache_user_in_group[$id];
		}
		else
		{
			$users_groups = $this->ion_auth_model->get_users_groups($id)->result();
			$groups_array = array();
			foreach ($users_groups as $group)
			{
				$groups_array[$group->id] = $group->name;
			}
			$this->_cache_user_in_group[$id] = $groups_array;
		}
		foreach ($check_group as $key => $value)
		{
			$groups = (is_string($value)) ? $groups_array : array_keys($groups_array);

			/**
			 * if !all (default), in_array
			 * if all, !in_array
			 */
			if (in_array($value, $groups) xor $check_all)
			{
				/**
				 * if !all (default), true
				 * if all, false
				 */
				return !$check_all;
			}
		}

		/**
		 * if !all (default), false
		 * if all, true
		 */
		return $check_all;
	}

}

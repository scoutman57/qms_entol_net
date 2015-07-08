<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_internal_issue_slip extends MX_Controller
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
            'activeMenu' => 'maintenance',
            'activeTab' => 'Trans_internal_issue_slip'
        );	
	}
	
    public function index()
    {
			$this->load->helper('xcrud');

			$xcrud = Xcrud_get_instance();
			$xcrud->table('ss_internal_issue_slip_header');
			$xcrud->columns('iis_no,iis_date,iis_to,iis_ref_no,iis_note');
			$xcrud->fields('iis_no,iis_date,iis_to,iis_ref_no,iis_note');
			$xcrud->default_tab('Internal Isseue Slip');
			$xcrud->unset_title();
			$xcrud->set_attr('iis_no',array('id'=>'iis_no','Readonly'=>'True')); 
			// $xcrud->set_attr('project',array('id'=>'project'));
			// $xcrud->relation('project','eproc_service_project','project_code','project_site');
			// $xcrud->validation_required('project');
			// $xcrud->validation_required('tanggal');
			// $xcrud->relation('picked_by','trans_mstr_supir','nama_personil',array('kode_personil','nama_personil'),'','','',' - ');
			// $xcrud->relation('received_by','trans_mstr_supir','nama_personil',array('kode_personil','nama_personil'),'','','',' - ');
			$xcrud->label('iis_no','No');
			$xcrud->label('iis_date','Date');
			$xcrud->label('iis_ref_no','Ref. No');
			$xcrud->label('iis_note','Note');
			$xcrud->label('iis_to','To');

			$xcrud2 = $xcrud->nested_table('Details','iis_no','ss_internal_issue_slip_detail','iis_detail_iis_no'); // 2nd level
			$xcrud2->unset_title();
			// $xcrud2->relation('lpb_id','eproc_lpb','lpb_id',array('lpb_no','description'),'project_code = (select project from ss_trans_material_return where id = {mr_id})','','',' - ');
		
			$data['content'] = $xcrud->render();

			$meta = $this->meta;			
			$this->load->view('commons/header',$meta);
			$this->load->view('Trans_internal_issue_slip', $data);
			$this->load->view('commons/footer');
    }
		
	function create_mr_no($project){
		$bln = date ('m');
		$thn = date ('Y');
		$t= "/";
		
		$q = $this->db->query("
		SELECT bcspurchase_2015.project.project_code, bcspurchase_2015.project.site_alias, bcspurchase_2015.project.category
		FROM
		bcspurchase_2015.project
		WHERE
		bcspurchase_2015.project.project_code='".$project."'");

		if( $q->num_rows() > 0 )
		{
			$proj = ("".$q->row()->category."-".$q->row()->site_alias);
		}
		
		$q = $this->db->query("select max(cast(f_split_string(mr_no, '/', 1) as SIGNED)) as code_max FROM ss_trans_material_return
		where f_split_string(mr_no, '/', 3) = '".$proj."' and f_split_string(mr_no, '/', 4) = '".$bln."' and f_split_string(mr_no, '/', 5) = '".$thn."'");

		if( $q->num_rows() > 0 )
		{
			$code_max = explode("/",$q->row()->code_max);
			$code_max = $code_max[0] + 1;
		}
		
		echo (str_pad("".$code_max."", 3, '0', STR_PAD_LEFT).$t."MR".$t.$proj.$t.$bln.$t.$thn);
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

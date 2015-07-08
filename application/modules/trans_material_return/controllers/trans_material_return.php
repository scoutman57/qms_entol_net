<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_material_return extends MX_Controller
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
            'activeTab' => 'trans_material_return'
        );	
	}
	
    public function index()
    {
			$this->load->helper('xcrud');

			$xcrud = Xcrud_get_instance();
			$xcrud->table('ss_trans_material_return');
			$xcrud->columns('mr_no,tanggal,project,picked_by,received_by');
			$xcrud->default_tab('Material Return');
			$xcrud->table_name('Material Return');
			$xcrud->set_attr('mr_no',array('id'=>'mr_no','Readonly'=>'True')); 
			$xcrud->set_attr('project',array('id'=>'project'));
			$xcrud->relation('project','eproc_service_project','project_code','project_site');
			$xcrud->validation_required('project');
			$xcrud->validation_required('tanggal');
			$xcrud->relation('picked_by','trans_mstr_supir','nama_personil',array('kode_personil','nama_personil'),'','','',' - ');
			$xcrud->relation('received_by','trans_mstr_supir','nama_personil',array('kode_personil','nama_personil'),'','','',' - ');
			$xcrud->label('mr_no','No');

			$xcrud2 = $xcrud->nested_table('Details','id','ss_trans_material_return_detail','mr_id'); // 2nd level
			$xcrud2->unset_title();
			$xcrud2->relation('lpb_id','eproc_lpb','lpb_id',array('lpb_no','description'),'project_code = (select project from ss_trans_material_return where id = {mr_id})','','',' - ');
			$xcrud2->columns('lpb_id,qty');
			$xcrud2->fields('lpb_id,qty,remarks');
			$xcrud2->set_attr('lpb_id',array('id'=>'lpb_id'));
			$xcrud2->set_attr('mr_id',array('id'=>'mr_id'));
			$xcrud2->column_cut(250,'lpb_id'); // separate columns
			$xcrud2->label('lpb_id','Description');
			$xcrud2->validation_required('lpb_id');
			$xcrud2->validation_required('qty');
			$xcrud2->column_class('qty', 'align-right');
			// $trans_grn_detail ->fields('mr_detail_mr_no,mr_detail_description,mr_detail_brand,mr_detail_qty,	mr_detail_remarks');
			// // $trans_grn_detail->label('grn_detail_material_code','Material Code');
			// // $trans_grn_detail->change_type('unit_price','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
			// // $trans_grn_detail->column_class('unit_price', 'align-right');
			// // $trans_grn_detail->relation('vendor_id','vendor','vendor_code','vendor');
			// // $trans_grn_detail->relation('unit','unit_of_material','nama','nama');

			// $trans_grn_detail->default_tab('Material Return Details');
			$data['content'] = $xcrud->render();

			$meta = $this->meta;			
			$this->load->view('commons/header',$meta);
			$this->load->view('trans_material_return', $data);
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

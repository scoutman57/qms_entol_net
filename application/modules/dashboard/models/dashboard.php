<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends CI_Model
{
	
	
	public function __construct()
	{
		parent::__construct();

	}
	
function dashboard(){
 $this->db->select('*');
 $this->db->from('notifikasi');
 $this->db->order_by('date', 'DESC');

 $query = $this->db->get();
 return $query->result();
}
}

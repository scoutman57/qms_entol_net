<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dn_model extends CI_Model
{
	
	
	public function __construct()
	{
		parent::__construct();

	}
	
	public function getTarifByID($id) 
	{
	  $this->db->select('tarif');
		$q = $this->db->get_where('trans_mstr_kontrak_tujuan', array('id' => $id), 1); 
		  if( $q->num_rows() > 0 )
		  {
				return $q->row()->tarif;
		  } 	
	}	
	
	public function getCustByKontrak($no_kontrak) 
	{
	  $this->db->select('kode_kustomer');
		$q = $this->db->get_where('trans_mstr_kontrak_header', array('id' => $no_kontrak), 1); 
		  if( $q->num_rows() > 0 )
		  {
				return $q->row()->kode_kustomer;
		  } 	
	}	
}

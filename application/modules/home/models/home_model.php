<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

	}
	
	// public function getAllProducts() 
	// {
		// $q = $this->db->get('products');
		// if($q->num_rows() > 0) {
			// foreach (($q->result()) as $row) {
				// $data[] = $row;
			// }
				
			// return $data;
		// }
	// }
	
	// public function getProductsQuantity($product_id, $warehouse = DEFAULT_WAREHOUSE) 
	// {
		// $q = $this->db->get_where('warehouses_products', array('product_id' => $product_id, 'warehouse_id' => $warehouse), 1); 
		  // if( $q->num_rows() > 0 )
		  // {
			// return $q->row_array();
		  // } 
		
		  // return FALSE;
		
	// }
	
	function get_calendar_data($year, $month) {
		
		$query = $this->db->select('date, data')->from('calendar')
			->like('date', "$year-$month", 'after')->get();
			
		$cal_data = array();
		
		foreach ($query->result() as $row) {
			$day = (int)substr($row->date,8,2);
			$cal_data[$day] = str_replace("|", "<br>", html_entity_decode($row->data));
		}
		
		return $cal_data;
		
	}
	
	public function updateComment($comment)
	{
			if($this->db->update('comment', array('comment' => $comment))) {
			return true;
		}
		return false;
	}
	
	public function getComment()
	{
		$q = $this->db->get('comment'); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 
		
		  return FALSE;
	}
	
	
}

/* End of file home_model.php */ 
/* Location: ./sma/modules/home/models/home_model.php */

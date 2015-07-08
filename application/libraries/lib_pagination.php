<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter pagination library v2
 *
 * A Library helper create Codeigniter pagination.
 *
 * @package         CodeIgniter
 * @author          Soyo Solution
 * @created         30th July,2014
 * @last_update     04th Dec,2014
 * @link            http://www.soyosolution.com/
 * @licensed        Licensed MIT
 */

class lib_pagination{

   private $CI;

   function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->database();
       $this->CI->load->helper("url");
       $this->CI->load->library("pagination");
   }

    function create_pagination($pg_config) {
        //Uncomment to config to your own pagination style.
        /*
        $config['first_link']      = 'First';      //The text you would like shown in the "first" link on the left. If you do not want this link rendered, you can set its value to FALSE.
        $config['first_tag_open']  = '<span>';  //The opening tag for the "first" link.
        $config['first_tag_close'] = '</span>';//The closing tag for the "first" link.

        $config['last_link']       = 'Last';        //The text you would like shown in the "last" link on the right. If you do not want this link rendered, you can set its value to FALSE.
        $config['last_tag_open']   = '<span>';   //The opening tag for the "last" link.
        $config['last_tag_close']  = '</span>'; //The closing tag for the "last" link.
        
        $config['next_link']       = '&gt;';        //The text you would like shown in the "next" page link. If you do not want this link rendered, you can set its value to FALSE.
        $config['next_tag_open']   = '<span>';   //The opening tag for the "next" link.
        $config['next_tag_close']  = '</span>'; //The closing tag for the "next" link.
        
        $config['prev_link']       = '&lt;';        //The text you would like shown in the "previous" page link. If you do not want this link rendered, you can set its value to FALSE.
        $config['prev_tag_open']   = '<span>';   //The opening tag for the "previous" link.
        $config['prev_tag_close']  = '</span>'; //The closing tag for the "previous" link.
        
        $config['cur_tag_open']    = '<b>';      //$config['cur_tag_open'] = '<b>';
        $config['cur_tag_close']   = '</b>';    //$config['cur_tag_close'] = '</b>';
        
        $config['num_tag_open']    = '<span>';    //The opening tag for the "digit" link.
        $config['num_tag_close']   = '</span>';  //The closing tag for the "digit" link.
        */
    
        //Check is that the first page, and not end with controller name
        $last_segment = $this->get_current_url_last_segment(1);
        if(empty($last_segment)){ //url end with '/',
            $config["base_url"] = $this->get_current_url_without_pagenum()."/timelinesearch".$this->get_current_url_last_segment(2);
        }else if(is_numeric($last_segment)){ //end with number , 2
            $config["base_url"] = $this->get_current_url_without_pagenum()."/timelinesearch";
        }else{ //may end with controller name
            $config["base_url"] = $this->get_current_url();
        }
        //$config["base_url"] = (empty($last_segment)?$this->get_current_url_without_pagenum()."/".$this->get_current_url_last_segment(2):$this->get_current_url_without_pagenum());
        
        //Value pass to CI pagination library class
        $config["total_rows"]       = $this->record_count($pg_config['sql']);
        $config["per_page"]         = $pg_config['per_page']; //items per page
        $config["uri_segment"]      = $this->CI->uri->total_segments();
        $config['use_page_numbers'] = TRUE;
        $this->CI->pagination->initialize($config);
        $page_no = ($this->CI->uri->segment($config["uri_segment"]))? $this->CI->uri->segment($config["uri_segment"]) : 0;
        
        //Value pass to function get_db_content()
        $todb['sql']           = $pg_config['sql']; //sql get from controller.
        $todb['limit']         = $pg_config['per_page'];
        $todb['page_no']       = $page_no;            
        
        //Value for views
        $data["results"]       = $this->get_db_content($todb);
        $data["pagination"]    = $this->CI->pagination->create_links();
        $data["result_amount"] = $config["total_rows"];
        return $data;
    }

    function record_count($sql) {
        $result = $this->CI->db->query($sql);
        return $result->num_rows();
    }

    function get_db_content($todb) {
        //calculate the first page
        $start = (($todb['page_no']-1)*$todb['limit'] > 0? ($todb['page_no']-1)* $todb['limit'] : 0 ); 
        $query = $todb['sql']." LIMIT ".$start.", ".$todb['limit'].";";
        $result = $this->CI->db->query($query);
 
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
/* ============= get_current_url() ====================
Get current url by php default function
return  $pageURL            current_url;
=================================================================== */
   function get_current_url(){
        //$pageURL = base_url().$_SERVER["REQUEST_URI"];
        $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            //$pageURL .= base_url().$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
   }

/* ============= get_current_url_without_pagenum() ====================
It's a function return urrent url without the last segment.
return  $url        url without the last segment.
=================================================================== */
   function get_current_url_without_pagenum(){
        $url = dirname($this->get_current_url());
        return $url;
   }//EOF get_current_url()
   
/* ============= get_current_url_last_segment() ====================
Get current url last segment by params int.
params  $last_n_segment         in int, for e.g. 1 is last segment, 2 is second last segment.
return  $segment_content        the segment content.
=================================================================== */
    function get_current_url_last_segment($last_n_segment){
        $pageURL = $this->get_current_url();
        $pageURL = explode('/', $pageURL);
        $segment_content = $pageURL[sizeof($pageURL)-$last_n_segment];
        return $segment_content;
    }//EOF get_current_url()   
   
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realtime_monitor_model extends CI_Model {
		
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	function get_data_monitoring() 
	{
        
       $query = $this->db->get('tbl_sessions');
        
		
        return $query;
    }
}


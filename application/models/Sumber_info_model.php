<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sumber_info_model extends CI_Model {
	var $table = 'view_sumber_info';
	var $column = array('id_sumber_info', 'nm_sumber_info', 'no_urut', 'insert_date', 'process_by'); //set column field database for order and search
	var $order = array('id_sumber_info' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	function _get_datatables_query()
	{
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	function nm_sumber_info_check($nm_sumber_info)
	{
		$this->db->select('*');
        $this->db->from('tbl_sumber_info');
        $this->db->where('nm_sumber_info', $nm_sumber_info);
        $this->db->limit(1);
		
		$query = $this->db->get();
        if($query->num_rows() == 1)
		{
            return false; //if data is true
        }
		else
		{
            return true; //if data is wrong
        }
	}
	
	function save_detail_sumber_info($data)
	{
		$this->db->insert('tbl_sumber_info', $data);
		return $this->db->insert_id();				   
	}
	
	function get_detail_sumber_info($id_sumber_info)
	{
		$sumber_info = $this->db->query('SELECT * FROM tbl_sumber_info WHERE id_sumber_info="'.$id_sumber_info.'"');
		return $sumber_info->row();						   
	}
	
	function update_detail_sumber_info($id_sumber_info, $data)
	{
		$this->db->update('tbl_sumber_info', $data, $id_sumber_info);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_sumber_info($id_sumber_info)
	{
		$this->db->where('id_sumber_info', $id_sumber_info);
		$this->db->delete('tbl_sumber_info');
	}
	
	function view_detail_sumber_info($id_sumber_info)
	{
		$sumber_info = $this->db->query('SELECT * FROM tbl_sumber_info WHERE id_sumber_info="'.$id_sumber_info.'"');
		return $sumber_info->row();									   
	}
}


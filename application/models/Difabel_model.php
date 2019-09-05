<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Difabel_model extends CI_Model {
	var $table = 'view_difabel';
	var $column = array('id_difabel', 'jenis_difabel', 'no_urut', 'insert_date', 'process_by'); //set column field database for order and search
	var $order = array('id_difabel' => 'desc'); // default order 
	
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
	
	function jenis_difabel_check($jenis_difabel)
	{
		$this->db->select('*');
        $this->db->from('tbl_difabel');
        $this->db->where('jenis_difabel', $jenis_difabel);
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
	
	function save_detail_difabel($data)
	{
		$this->db->insert('tbl_difabel', $data);
		return $this->db->insert_id();				   
	}
	
	function get_detail_difabel($id_difabel)
	{
		$difabel = $this->db->query('SELECT * FROM tbl_difabel WHERE id_difabel="'.$id_difabel.'"');
		return $difabel->row();						   
	}
	
	function update_detail_difabel($id_difabel, $data)
	{
		$this->db->update('tbl_difabel', $data, $id_difabel);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_difabel($id_difabel)
	{
		$this->db->where('id_difabel', $id_difabel);
		$this->db->delete('tbl_difabel');
	}
	
	function view_detail_difabel($id_difabel)
	{
		$difabel = $this->db->query('SELECT * FROM tbl_difabel WHERE id_difabel="'.$id_difabel.'"');
		return $difabel->row();									   
	}
}


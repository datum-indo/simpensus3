<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasus_model extends CI_Model {
	var $table = 'view_nama_kasus';
	var $column = array('id_nama_kasus', 'nama_kasus', 'jenis_kasus', 'no_urut', 'insert_date', 'process_by'); //set column field database for order and search
	var $order = array('id_nama_kasus' => 'desc'); // default order 
	
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
	
	function get_jenis_kasus()
	{
		$query = $this->db->query('SELECT * FROM tbl_jenis_kasus ORDER BY id_jenis_kasus ASC');
		$jenis_kasuss = array('' => '');
		foreach ($query->result() as $jenis_kasus)
		{
                $jenis_kasuss[$jenis_kasus->id_jenis_kasus] = $jenis_kasus->jenis_kasus;
        }
		return $jenis_kasuss;
	}
	
	function save_detail_kasus($data)
	{
		$this->db->insert('tbl_nama_kasus', $data);
		return $this->db->insert_id();				   
	}
	
	function get_detail_kasus($id_nama_kasus)
	{
		$nama_kasus = $this->db->query('SELECT * FROM tbl_nama_kasus WHERE id_nama_kasus="'.$id_nama_kasus.'"');
		return $nama_kasus->row();						   
	}
	
	function update_detail_kasus($id_nama_kasus, $data)
	{
		$this->db->update('tbl_nama_kasus', $data, $id_nama_kasus);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_kasus($id_nama_kasus)
	{
		$this->db->where('id_nama_kasus', $id_nama_kasus);
		$this->db->delete('tbl_nama_kasus');
	}
	
	function view_detail_kasus($id_nama_kasus)
	{
		$nama_kasus = $this->db->query('SELECT * FROM tbl_nama_kasus WHERE id_nama_kasus="'.$id_nama_kasus.'"');
		return $nama_kasus->row();									   
	}
}


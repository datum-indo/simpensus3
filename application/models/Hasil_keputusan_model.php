<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_keputusan_model extends CI_Model {
	var $table = 'view_hasil_keputusan';
	var $column = array('id_hasil_keputusan', 'hasil_keputusan', 'no_urut', 'insert_date', 'process_by'); //set column field database for order and search
	var $order = array('id_hasil_keputusan' => 'desc'); // default order 
	
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
	
	function hasil_keputusan_check($hasil_keputusan)
	{
		$this->db->select('*');
        $this->db->from('tbl_hasil_keputusan');
        $this->db->where('hasil_keputusan', $hasil_keputusan);
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
	
	function save_detail_hasil_keputusan($data)
	{
		$this->db->insert('tbl_hasil_keputusan', $data);
		return $this->db->insert_id();				   
	}
	
	function save_detail_jenis_kasus($id_hasil_keputusan, $id_jenis_kasus)
	{
		
		for($i = 0; $i < count($id_jenis_kasus); $i++)
		{
			$data = array('id_hasil_keputusan' => $id_hasil_keputusan, 
						  'id_jenis_kasus' =>	$id_jenis_kasus[$i]				
					);
			$this->db->insert('tbl_hasil_keputusan_jenis_kasus', $data);
			$this->db->insert_id();
		}
	}
	
	function get_detail_hasil_keputusan($id_hasil_keputusan)
	{
		$hasil_keputusan = $this->db->query('SELECT * FROM tbl_hasil_keputusan WHERE id_hasil_keputusan="'.$id_hasil_keputusan.'"');
		return $hasil_keputusan->row();						   
	}
	
	function get_detail_jenis_kasus($id_hasil_keputusan)
	{
		$query = $this->db->query('SELECT id_jenis_kasus FROM tbl_hasil_keputusan_jenis_kasus WHERE id_hasil_keputusan="'.$id_hasil_keputusan.'" ORDER BY id_jenis_kasus ASC');
		
				
		foreach ($query->result() as $row)
		{
			$jenis_kasus[$row->id_jenis_kasus] = $row->id_jenis_kasus;
		}
		
		$jenis_kasus = implode (",", $jenis_kasus);
		
		$jenis_kasus = array('jenis_kasus' => $jenis_kasus);
		
		return $jenis_kasus;						   
	}
	
	function update_detail_hasil_keputusan($id_hasil_keputusan, $data)
	{
		$this->db->update('tbl_hasil_keputusan', $data, $id_hasil_keputusan);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_jenis_kasus($id_hasil_keputusan)
	{
		
		$this->db->where('id_hasil_keputusan', $id_hasil_keputusan);
		$this->db->delete('tbl_hasil_keputusan_jenis_kasus');
	}
	
	function delete_detail_hasil_keputusan($id_hasil_keputusan)
	{
		$this->db->where('id_hasil_keputusan', $id_hasil_keputusan);
		$this->db->delete('tbl_hasil_keputusan');
	}
	
	function view_detail_hasil_keputusan($id_hasil_keputusan)
	{
		$hasil_keputusan = $this->db->query('SELECT * FROM tbl_hasil_keputusan WHERE id_hasil_keputusan="'.$id_hasil_keputusan.'"');
		return $hasil_keputusan->row();									   
	}
}


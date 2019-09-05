<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration_model extends CI_Model {
	var $table = 'view_setting';
	var $column = array('kode_cabang', 'alamat_cabang', 'kota_cabang', 'no_telp', 'website', 'email', 'initial_permohonan'); //set column field database for order and search
	var $order = array('kode_cabang' => 'desc'); // default order 
	
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
	
	function get_provinsi()
	{
		$query = $this->db->query('SELECT * FROM tbl_provinsi ORDER BY id_provinsi ASC');
		$provinsis = array('' => '');
		foreach ($query->result() as $provinsi)
		{
                $provinsis[$provinsi->id_provinsi] = $provinsi->nm_provinsi;
        }
		return $provinsis;
	}
	
	function get_kabkota_by_id_provinsi($id_provinsi)
	{
		$query = $this->db->query('SELECT * FROM tbl_kabkota WHERE id_provinsi="'.$id_provinsi.'"ORDER BY id_kabkota ASC');
		$kabkota = array();
		foreach ($query->result() as $kabkotas)
		{
                $kabkota[$kabkotas->id_kabkota] = $kabkotas->nm_kabkota;
        }
		return $kabkota;
	}
	
	function get_nm_kabkota($id_kabkota)
	{
		$query = $this->db->query('SELECT tbl_kabkota.nm_kabkota AS nm_kabkota FROM tbl_kabkota WHERE id_kabkota="'.$id_kabkota.'" ORDER BY id_kabkota ASC');
		
		$row = $query->row();
		$nm_kabkota = $row->nm_kabkota;
		
		$string = array('Kota ', 'Kab. ');
		$nm_kabkota = str_replace($string, '', $nm_kabkota);
		
		return $nm_kabkota;
	}
	
	function get_detail_configuration($kode_cabang)
	{
		$configuration = $this->db->query('SELECT * FROM tbl_setting WHERE kode_cabang="'.$kode_cabang.'"');
		return $configuration->row();						   
	}
	
	function update_detail_configuration($kode_cabang, $data)
	{
		$this->db->update('tbl_setting', $data, $kode_cabang);
		return $this->db->affected_rows();			   
	}
	
	function view_detail_configuration($kode_cabang)
	{
		$configuration = $this->db->query('SELECT * FROM tbl_setting WHERE kode_cabang="'.$kode_cabang.'"');
		return $configuration->row();									   
	}
}


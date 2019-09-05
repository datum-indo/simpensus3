<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_manager_model extends CI_Model {
	var $table = 'view_file_manager';
	var $column = array('no_reg', 'upload_date', 'nm_uploadby', 'jenis_dokumen', 'filename', 'id_permohonan'); //set column field database for order and search
	var $order = array('filename' => 'desc'); // default order 
	
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
	
	function delete_file($id_file)
	{
		$query = $this->db->query('SELECT tbl_file_attachment.id_file, tbl_file_attachment.nm_file, tbl_file_attachment.id_section_process 
								   FROM tbl_file_attachment WHERE tbl_file_attachment.id_file="'.$id_file.'"');
		$row = $query->row();
		$filename = $row->nm_file;
		$id_section_process = $row->id_section_process;
		
		if($id_section_process == 1 || $id_section_process == 2)
		{
			$destination = './media/files_permohonan/';
		}
		else if($id_section_process == 3)
		{
			$destination = './media/files_approval/';
		}
		else if($id_section_process == 4)
		{
			$destination = './media/files_progress/';
		}
		else
		{
			$destination = './media/files_analisis/';
		}
		
		@unlink($destination.$filename);
						
		$this->db->where('id_file', $id_file);
		$this->db->delete('tbl_file_attachment');	
	}	

	function get_filename($id_file)
	{
		$query = $this->db->query("SELECT nm_file AS nm_file FROM tbl_file_attachment WHERE id_file='".$id_file."'");
		$row = $query->row();
		$filename = $row->nm_file;
		
		return $filename;
	}
	
	function get_nm_baru($id_file)
	{
		$query = $this->db->query("SELECT nm_baru AS nm_baru FROM tbl_file_attachment WHERE id_file='".$id_file."'");
		$row = $query->row();
		$nm_baru = $row->nm_baru;
		
		return $nm_baru;
	}

	function get_id_section_process($id_file)
	{
		$query = $this->db->query("SELECT id_section_process AS id_section_process FROM tbl_file_attachment WHERE id_file='".$id_file."'");
		$row = $query->row();
		$id_section_process = $row->id_section_process;
		
		return $id_section_process;
	}
	
}


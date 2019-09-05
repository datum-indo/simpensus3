<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
		
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
		
	function get_datatables_ajax($page, $perPage)
	{
		if(!$page):
        $offset = 0;
        else:            
        $offset = $page;
        endif;

		$query = $this->db->query("SELECT * FROM view_user ORDER BY fullname ASC LIMIT ".$page.",".$perPage." ");

		return $query->result();
	}

	function getTotalData()
	{
		$query = $this->db->query("SELECT * FROM view_user");
      	return $query->num_rows();
    }
	
	function get_profile_info($user_id)
	{
		$query = $this->db->query("SELECT * FROM view_user WHERE user_id = '".$user_id."'");
								   
		return $query;						   
		
	}
	
	function get_profile_konsultasi($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '1'
								   AND tbl_approval.id_analis = '".$user_id."'");
		
		$row = $query->row();
		$a = $row->jumlah;
		
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '1'
								   AND tbl_approval.id_asisten = '".$user_id."'");
					
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a + $b;
		
		return $jumlah;		
	}
	
	function get_profile_negosiator($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '2'
								   AND tbl_approval.id_analis = '".$user_id."'");
		
		$row = $query->row();
		$a = $row->jumlah;
		
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '2'
								   AND tbl_approval.id_asisten = '".$user_id."'");
					
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a + $b;
		
		return $jumlah;		
	}
	
	function get_profile_pembela($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '3'
								   AND tbl_approval.id_analis = '".$user_id."'");
		
		$row = $query->row();
		$a = $row->jumlah;
		
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '3'
								   AND tbl_approval.id_asisten = '".$user_id."'");
					
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a + $b;
		
		return $jumlah;		
	}
	
	function get_total_konsultasi()
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '1'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
		
		
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
			
	}
	
	function get_jumlah_konsultasi($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '1'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_analis = '".$user_id."'");
		
		$row = $query->row();
		$a = $row->jumlah;
		
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '1'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_asisten = '".$user_id."'");
			
			
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a+$b;
		
		return $jumlah;		
			
	}
	
	function get_total_negosiator()
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '2'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
		
		
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
			
	}
	
	function get_jumlah_negosiator($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '2'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_analis = '".$user_id."'");
		
		$row = $query->row();
		$a = $row->jumlah;
		
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '2'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_asisten = '".$user_id."'");
			
			
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a+$b;
		
		return $jumlah;		
			
	}
	
	function get_total_pembela()
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '3'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
		
		
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
			
	}
	
	function get_jumlah_pembela($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '3'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_analis = '".$user_id."'");
		
		$row = $query->row();
		$a = $row->jumlah;
		
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.id_tindakan = '3'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_asisten = '".$user_id."'");
			
			
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a+$b;
		
		return $jumlah;		
			
	}
	
	function get_total_permohonan_this_year()
	{
		$query = $this->db->query("SELECT COUNT(tbl_permohonan.id_permohonan) AS jumlah 
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
								   WHERE EXISTS (SELECT tbl_approval.id_permohonan FROM tbl_approval WHERE tbl_approval.id_permohonan = tbl_permohonan.id_permohonan)
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')");
		
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;							   
	}
	
	function get_count_permohonan_this_year($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_permohonan.id_permohonan) AS jumlah 
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
								   WHERE EXISTS (SELECT tbl_approval.id_permohonan FROM tbl_approval WHERE tbl_approval.id_permohonan = tbl_permohonan.id_permohonan)
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_permohonan.insert_by = '".$user_id."'");
		
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;							   
	}
	
	function get_total_approval_this_year()
	{
		$query = $this->db->query("SELECT COUNT(tbl_permohonan.id_permohonan) AS jumlah 
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
								   WHERE EXISTS (SELECT tbl_approval.id_permohonan FROM tbl_approval WHERE tbl_approval.id_permohonan = tbl_permohonan.id_permohonan)
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')");
		
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;							   
	}
	
	function get_count_approval_this_year($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_permohonan) AS jumlah 
								   FROM tbl_approval 
								   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.insert_by = '".$user_id."'");
		
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;							   
	}
	
	function get_total_analisis_this_year($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_analis = '".$user_id."'");
								   
		$row = $query->row();
		$a = $row->jumlah;						   
							
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_asisten = '".$user_id."'");
		
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a + $b;		
		
		return $jumlah;							   
	}
	
	function get_count_analisis_this_year($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_permohonan) AS jumlah 
								   FROM tbl_approval
								   WHERE EXISTS (SELECT tbl_analisis.id_permohonan FROM tbl_analisis WHERE tbl_approval.id_permohonan = tbl_analisis.id_permohonan)
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_analis = '".$user_id."'");
								   
		$row = $query->row();
		$a = $row->jumlah;						   
							
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_permohonan) AS jumlah 
								   FROM tbl_approval
								   WHERE EXISTS (SELECT tbl_analisis.id_permohonan FROM tbl_analisis WHERE tbl_approval.id_permohonan = tbl_analisis.id_permohonan)
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_asisten = '".$user_id."'");
		
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a + $b;		
		
		return $jumlah;							   
	}
	
	function get_total_progress_this_year()
	{
		$query = $this->db->query("SELECT COUNT(tbl_progress.id_progress) AS jumlah
								   FROM tbl_progress
								   WHERE DATE_FORMAT(tbl_progress.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
								   
		$row = $query->row();
		$jumlah = $row->jumlah;
		
				
		return $jumlah;							   
	}
	
	function get_count_progress_this_year($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_progress.id_progress) AS jumlah
								   FROM tbl_progress
								   WHERE DATE_FORMAT(tbl_progress.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_progress.insert_by = '".$user_id."'");
								   
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;							   
	}
	
	function get_total_job_this_year($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_analis = '".$user_id."'");
								   
		$row = $query->row();
		$a = $row->jumlah;						   
							
		$query = $this->db->query("SELECT COUNT(tbl_tindakan.jenis_tindakan) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_asisten = '".$user_id."'");
		
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a + $b;		
		
		return $jumlah;							   
	}
	
	function get_count_job_this_year($user_id)
	{
		$id_user = $this->session->userdata('id_user');
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_permohonan) AS jumlah 
								   FROM tbl_approval
								   WHERE EXISTS (SELECT tbl_kasus_selesai.id_permohonan FROM tbl_kasus_selesai WHERE tbl_approval.id_permohonan = tbl_kasus_selesai.id_permohonan)
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_analis = '".$user_id."'");
								   
		$row = $query->row();
		$a = $row->jumlah;						   
							
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_permohonan) AS jumlah 
								   FROM tbl_approval
								   WHERE EXISTS (SELECT tbl_kasus_selesai.id_permohonan FROM tbl_kasus_selesai WHERE tbl_approval.id_permohonan = tbl_kasus_selesai.id_permohonan)
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_approval.id_asisten = '".$user_id."'");
		
		$row = $query->row();
		$b = $row->jumlah;
		
		$jumlah = $a + $b;		
		
		return $jumlah;							   
	}
	
	function get_total_upload_this_year()
	{
		$id_user = $this->session->userdata('id_user');
		$query = $this->db->query("SELECT COUNT(tbl_file_attachment.id_file) AS jumlah
								   FROM tbl_file_attachment
								   WHERE DATE_FORMAT(tbl_file_attachment.upload_date, '%Y') = DATE_FORMAT(NOW(), '%Y')");
		
		$row = $query->row();
		$jumlah = $row->jumlah;
		
			
		
		return $jumlah;							   
	}
	
	function get_count_upload_this_year($user_id)
	{
		$query = $this->db->query("SELECT COUNT(tbl_file_attachment.id_file) AS jumlah
								   FROM tbl_file_attachment
								   WHERE DATE_FORMAT(tbl_file_attachment.upload_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   AND tbl_file_attachment.upload_by = '".$user_id."'");
		
		$row = $query->row();
		$jumlah = $row->jumlah;
		
			
		
		return $jumlah;							   
	}
	
	function get_data_progress_chart_this_year($user_id)
	{
		$query = $this->db->query("SELECT tbl_bulan.id_bulan, tbl_bulan.nm_bulan, tbl_bulan.bulan, IF(selesai IS NULL, 0, selesai) AS selesai, IF(belum IS NULL, 0, belum) AS belum, IF(na IS NULL, 0, na) AS na, IF(total IS NULL, 0, total) AS total
								   FROM (
								   SELECT MONTH(tgl_approval)AS bulan, 
								   COUNT(CASE WHEN status_progress = 'Selesai' THEN 1 ELSE NULL END) AS selesai, 
								   COUNT(CASE WHEN status_progress = 'Belum Selesai' THEN 1 ELSE NULL END) AS belum,
								   COUNT(CASE WHEN status_progress = 'N/A' THEN 1 ELSE NULL END) AS na,
								   COUNT(CASE WHEN status_progress != '' THEN 1 ELSE NULL END) AS total
								   FROM (
								   SELECT tbl_approval.insert_date AS tgl_approval, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
								   FROM ( 
								   SELECT id_permohonan, status_progress
								   FROM ( 
								   SELECT tbl_progress.id_permohonan, tbl_progress.status_progress
								   FROM tbl_progress 
								   ORDER BY tbl_progress.id_progress DESC 
								   ) tbl_status GROUP BY tbl_status.id_permohonan 
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND (tbl_approval.id_analis = '".$user_id."' OR tbl_approval.id_asisten = '".$user_id."')
								   ) tbl_result
								   WHERE DATE_FORMAT(tgl_approval,'%Y') = DATE_FORMAT(NOW(), '%Y')
								   GROUP BY MONTH(tgl_approval)
								   ) tbl_jumlah
								   RIGHT JOIN tbl_bulan ON tbl_bulan.id_bulan = tbl_jumlah.bulan");

		return $query->result_array();

	}
	
}


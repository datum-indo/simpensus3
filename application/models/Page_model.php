<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {
		
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	function get_data_progress_schedule($id_user) 
	{
       	$id_role = $this->session->userdata('id_role');
		/*
		if($id_role == '1')
		{
			$query = $this->db->query("SELECT tbl_progress_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
									   FROM tbl_progress_schedule
									   LEFT JOIN tbl_approval ON tbl_progress_schedule.id_permohonan = tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_progress_schedule.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_progress_schedule.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_progress_schedule.id_permohonan = tbl_pemohon.id_permohonan
									   WHERE DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
									   OR DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d')"
			);
		}
		*/
		if($id_role == '1' || $id_role == '2' || $id_role == '3' || $id_role == '7')
		{
			$query = $this->db->query("SELECT tbl_progress_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									   tbl_approval.id_analis, 	tbl_approval.id_asisten
									   FROM tbl_progress_schedule
									   LEFT JOIN tbl_approval ON tbl_progress_schedule.id_permohonan = tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_progress_schedule.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_progress_schedule.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_progress_schedule.id_permohonan = tbl_pemohon.id_permohonan
									   WHERE (DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
									   OR DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d'))");
		}
		else if($id_role == '4')
		{
			$query = $this->db->query("SELECT tbl_progress_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									   tbl_approval.id_analis, 	tbl_approval.id_asisten
									   FROM tbl_progress_schedule
									   LEFT JOIN tbl_approval ON tbl_progress_schedule.id_permohonan = tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_progress_schedule.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_progress_schedule.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_progress_schedule.id_permohonan = tbl_pemohon.id_permohonan
									   WHERE (DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
									   OR DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d')) 
									   AND (tbl_approval.id_analis = '".$id_user."' OR tbl_approval.id_asisten = '".$id_user."')");
		}
		else
		{
			$query = $this->db->query("SELECT tbl_progress_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
									   FROM tbl_progress_schedule
									   LEFT JOIN tbl_approval ON tbl_progress_schedule.id_permohonan = tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_progress_schedule.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_progress_schedule.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_progress_schedule.id_permohonan = tbl_pemohon.id_permohonan
									   WHERE (DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
									   OR DATE_FORMAT(tbl_progress_schedule.date_schedule, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d'))
									   AND tbl_approval.id_asisten = '".$id_user."'"
			);
		}		
		
		return $query;
    }
	
	function get_data_analisis_schedule($id_user) 
	{
       	$id_role = $this->session->userdata('id_role');
		/*
		if($id_role == '1')
		{
			$query = $this->db->query("SELECT tbl_analisis_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
									   FROM tbl_analisis_schedule
									   LEFT JOIN tbl_approval ON tbl_analisis_schedule.id_permohonan = tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_analisis_schedule.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_analisis_schedule.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_analisis_schedule.id_permohonan = tbl_pemohon.id_permohonan
									   WHERE (DATE_FORMAT(tbl_analisis_schedule.date_schedule, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
									   OR DATE_FORMAT(tbl_analisis_schedule.date_schedule, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d'))
									   AND tbl_approval.id_tindakan != '1'"
			);
		}
		*/
		if($id_role == '1' || $id_role == '2' || $id_role == '3' || $id_role == '7' )
		{
			$query = $this->db->query("SELECT tbl_analisis_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									   tbl_approval.id_analis, 	tbl_approval.id_asisten	
									   FROM tbl_analisis_schedule
									   LEFT JOIN tbl_approval ON tbl_analisis_schedule.id_permohonan = tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_analisis_schedule.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_analisis_schedule.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_analisis_schedule.id_permohonan = tbl_pemohon.id_permohonan
									   WHERE (DATE_FORMAT(tbl_analisis_schedule.date_schedule, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
									   OR DATE_FORMAT(tbl_analisis_schedule.date_schedule, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d'))");
		}
		else
		{
			$query = $this->db->query("SELECT tbl_analisis_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									   tbl_approval.id_analis, 	tbl_approval.id_asisten	
									   FROM tbl_analisis_schedule
									   LEFT JOIN tbl_approval ON tbl_analisis_schedule.id_permohonan = tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_analisis_schedule.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_analisis_schedule.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_analisis_schedule.id_permohonan = tbl_pemohon.id_permohonan
									   WHERE (DATE_FORMAT(tbl_analisis_schedule.date_schedule, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
									   OR DATE_FORMAT(tbl_analisis_schedule.date_schedule, '%Y-%m-%d') < DATE_FORMAT(NOW(), '%Y-%m-%d')) 
									   AND tbl_approval.id_analis = '".$id_user."'");
		}
		
		
		return $query;
    }
	
	function get_data_approval_schedule($id_user) 
	{
       	$id_role = $this->session->userdata('id_role');
		/*
		if($id_role == '1')
		{
			$query = $this->db->query("SELECT tbl_approval_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									   tbl_tindakan.jenis_tindakan, tbl_analis.fullname AS nm_analis, tbl_asisten.fullname AS nm_asisten 
									   FROM tbl_approval_schedule
									   LEFT JOIN tbl_approval ON tbl_approval_schedule.id_permohonan= tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_approval_schedule.id_permohonan= tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_approval_schedule.id_permohonan= tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_approval_schedule.id_permohonan= tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
									   LEFT JOIN tbl_user AS tbl_analis ON tbl_approval.id_analis = tbl_analis.id_user
									   LEFT JOIN tbl_user AS tbl_asisten ON tbl_approval.id_asisten = tbl_asisten.id_user"
			);
		}
		*/
		
		if($id_role == '1' || $id_role == '2' || $id_role == '3' || $id_role == '4')
		{
			$query = $this->db->query("SELECT tbl_approval_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									   tbl_tindakan.jenis_tindakan, tbl_analis.fullname AS nm_analis, tbl_asisten.fullname AS nm_asisten 
									   FROM tbl_approval_schedule
									   LEFT JOIN tbl_approval ON tbl_approval_schedule.id_permohonan= tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_approval_schedule.id_permohonan= tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_approval_schedule.id_permohonan= tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_approval_schedule.id_permohonan= tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
									   LEFT JOIN tbl_user AS tbl_analis ON tbl_approval.id_analis = tbl_analis.id_user
									   LEFT JOIN tbl_user AS tbl_asisten ON tbl_approval.id_asisten = tbl_asisten.id_user
									   WHERE tbl_approval.id_analis = '".$id_user."'"
			);
		}
		else
		{
			$query = $this->db->query("SELECT tbl_approval_schedule.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									   tbl_tindakan.jenis_tindakan, tbl_analis.fullname AS nm_analis, tbl_asisten.fullname AS nm_asisten 
									   FROM tbl_approval_schedule
									   LEFT JOIN tbl_approval ON tbl_approval_schedule.id_permohonan= tbl_approval.id_permohonan
									   LEFT JOIN tbl_permohonan ON tbl_approval_schedule.id_permohonan= tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_approval_schedule.id_permohonan= tbl_penerima.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_approval_schedule.id_permohonan= tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
									   LEFT JOIN tbl_user AS tbl_analis ON tbl_approval.id_analis = tbl_analis.id_user
									   LEFT JOIN tbl_user AS tbl_asisten ON tbl_approval.id_asisten = tbl_asisten.id_user
									   WHERE tbl_approval.id_asisten = '".$id_user."'"
			);
		}
		
		
		return $query;
    }
	
	function get_data_permohonan() 
	{
       	
		$query = $this->db->query("SELECT tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima, tbl_permohonan.status_dokumen 
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan 
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_approval ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   WHERE tbl_approval.id_permohonan IS NULL ORDER BY tbl_permohonan.id_permohonan DESC"
		);
		
		
		
		return $query;
    }
	
	function get_total_bantuan()	
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.status_approval) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
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
	
	function get_data_bantuan_hukum_this_year()
	{
		$query = $this->db->query("SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Jan'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Feb'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Mar'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'Apr'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Jun'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Jul'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agu'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'Sep'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Okt'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'Nov'
								   ELSE 'Des' END AS bulan,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Diterima' THEN 1 ELSE NULL END) AS diterima,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Ditolak' THEN 1 ELSE NULL END) AS ditolak,
								   COUNT(CASE WHEN tbl_approval.status_approval THEN 1 ELSE NULL END) AS total
								   FROM tbl_approval
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = DATE_FORMAT(NOW(), '%Y')
								   GROUP BY MONTH(tbl_approval.insert_date)");

		return $query->result_array();

	}
	
	function get_data_bentuk_layanan_this_year()
	{
		$query = $this->db->query("SELECT tbl_approval.id_tindakan, 
								   CASE
								   WHEN tbl_approval.id_tindakan = '1' THEN 'Konsultasi Hukum'
								   WHEN tbl_approval.id_tindakan = '2' THEN 'Mediator/Negosiator'
								   ELSE 'Kuasa/Pembela Hukum' END AS label, 
								   COUNT(tbl_approval.id_tindakan) AS value
								   FROM tbl_approval 
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date,'%Y') = DATE_FORMAT(NOW(), '%Y')
								   GROUP BY tbl_approval.id_tindakan");

		return $query->result_array();

	}
	
	function get_total_pidana()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_jenis_kasus) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '1'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_perdata()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_jenis_kasus) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '2'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_tun()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_jenis_kasus) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '3'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_pelapor()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '1'
								   AND tbl_approval.id_posisi_hukum = '1'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_saksi()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '1'
								   AND tbl_approval.id_posisi_hukum = '2'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_terlapor()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '1'
								   AND tbl_approval.id_posisi_hukum = '3'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_tersangka()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '1'
								   AND tbl_approval.id_posisi_hukum = '4'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_terdakwa()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '1'
								   AND tbl_approval.id_posisi_hukum = '5'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_terpidana()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '1'
								   AND tbl_approval.id_posisi_hukum = '6'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_penggugat()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '2'
								   AND tbl_approval.id_posisi_hukum = '7'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_tergugat()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '2'
								   AND tbl_approval.id_posisi_hukum = '8'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_penggugat_tun()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '3'
								   AND tbl_approval.id_posisi_hukum = '7'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_total_tergugat_tun()
	{
		$query = $this->db->query("SELECT COUNT(tbl_approval.id_posisi_hukum) AS jumlah
								   FROM tbl_approval
								   WHERE tbl_approval.id_jenis_kasus = '3'
								   AND tbl_approval.id_posisi_hukum = '8'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   ");
			
		$row = $query->row();
		$jumlah = $row->jumlah;
		
		return $jumlah;		
	}
	
	function get_issue_ham_this_year()
	{
		$query = $this->db->query("SELECT tbl_issue_ham.id_issue_ham, 
								   tbl_issue_ham.issue_ham, 
								   IF(jumlah IS NULL, 0, jumlah) AS jumlah
								   FROM (
								   SELECT tbl_analisis_issue_ham.id_issue_ham AS id, 
								   COUNT(tbl_analisis_issue_ham.id_issue_ham) AS jumlah
								   FROM tbl_approval
								   LEFT JOIN tbl_analisis_issue_ham ON tbl_analisis_issue_ham.id_permohonan = tbl_approval.id_approval
								   WHERE tbl_analisis_issue_ham.id_issue_ham != '0'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')
								   GROUP BY tbl_analisis_issue_ham.id_issue_ham 
								   ) tbl_jumlah
								   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_jumlah.id
								   GROUP BY tbl_issue_ham.id_issue_ham");
		
		return $query->result_array();
	}
	
	function get_total_bentuk_sifat_kasus()
	{
		$query = $this->db->query("SELECT 
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Individu' THEN 1 ELSE NULL END) AS individu,
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Kelompok' THEN 1 ELSE NULL END) AS kelompok,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Non-Struktural' THEN 1 ELSE NULL END) AS nonstruktural,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Struktural' THEN 1 ELSE NULL END) AS struktural
								   FROM tbl_analisis
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = DATE_FORMAT(NOW(), '%Y')");
		
		return $query;
	}
}


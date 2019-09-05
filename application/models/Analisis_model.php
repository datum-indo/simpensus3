<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Analisis_model extends CI_Model
{
	var $table = 'view_analisis';
	var $column = array('id_analisis', 'no_reg', 'tgl_analisis', 'sifat_kasus', 'bentuk_kasus', 'nm_kabkota', 'nm_processby'); //set column field database for order and search
	var $order = array('id_analisis' => 'desc'); // default order 

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
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
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

	function get_sifat_kasus()
	{
		$table = 'tbl_analisis';
		$field = 'sifat_kasus';

		$sifat_kasus = array('' => '');
		if ($table == '' || $field == '') return $sifat_kasus;
		$CI = &get_instance();
		preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
		foreach ($matches[1] as $key => $value) {
			$sifat_kasus[$value] = $value;
		}
		return $sifat_kasus;
	}

	function get_issue_ham()
	{
		$query = $this->db->query('SELECT * FROM tbl_issue_ham ORDER BY id_issue_ham ASC');
		$issue_ham = array('' => '');
		foreach ($query->result() as $daftar_issue_ham) {
			$issue_ham[$daftar_issue_ham->id_issue_ham] = $daftar_issue_ham->issue_ham;
		}
		return $issue_ham;
	}

	function get_bentuk_kasus()
	{
		$table = 'tbl_analisis';
		$field = 'bentuk_kasus';

		$bentuk_kasus = array('' => '');
		if ($table == '' || $field == '') return $bentuk_kasus;
		$CI = &get_instance();
		preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
		foreach ($matches[1] as $key => $value) {
			$bentuk_kasus[$value] = $value;
		}
		return $bentuk_kasus;
	}

	function get_penghasilan()
	{
		$query = $this->db->query('SELECT * FROM tbl_penghasilan ORDER BY id_penghasilan ASC');
		$penghasilan = array('' => '');
		foreach ($query->result() as $daftar_penghasilan) {
			$penghasilan[$daftar_penghasilan->id_penghasilan] = $daftar_penghasilan->jml_penghasilan;
		}
		return $penghasilan;
	}

	function get_kategori_korban()
	{

		$query = $this->db->query('SELECT * FROM tbl_kategori_korban ORDER BY id_kategori_korban ASC');
		$kategori_korban = array('' => '');
		foreach ($query->result() as $data_kategori_korban) {
			$kategori_korban[$data_kategori_korban->id_kategori_korban] = $data_kategori_korban->kategori_korban;
		}
		return $kategori_korban;
	}

	function get_kategori_pelaku()
	{

		$query = $this->db->query('SELECT * FROM tbl_kategori_pelaku ORDER BY id_kategori_pelaku ASC');
		$kategori_pelaku = array('' => '');
		foreach ($query->result() as $data_kategori_pelaku) {
			$kategori_pelaku[$data_kategori_pelaku->id_kategori_pelaku] = $data_kategori_pelaku->kategori_pelaku;
		}
		return $kategori_pelaku;
	}

	function get_analisis_add()
	{
		$id_user = $this->session->userdata('id_user');
		$id_role = $this->session->userdata('id_role');
		if ($id_role == '1' || $id_role == '2' || $id_role == '3') {
			$query = $this->db->query('SELECT tbl_approval.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
									   FROM tbl_approval
									   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_analisis ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
									   WHERE tbl_analisis.id_permohonan IS NULL AND tbl_approval.status_approval = "Diterima"
									   ORDER BY tbl_approval.id_permohonan DESC');
		} else {
			$query = $this->db->query('SELECT tbl_approval.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima 
									   FROM tbl_approval
									   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_analisis ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
									   WHERE tbl_analisis.id_permohonan IS NULL AND tbl_approval.status_approval = "Diterima"
									   AND tbl_approval.id_analis ="' . $id_user . '"
									   ORDER BY tbl_approval.id_permohonan DESC');
		}

		$approval = array('' => '');
		foreach ($query->result() as $detail_approval) {
			$approval[$detail_approval->id_permohonan] = $detail_approval->no_reg . ' | ' . $detail_approval->nm_pemohon;
		}
		return $approval;
	}

	function get_id_analisis()
	{
		$query = $this->db->query("SELECT IFNULL(MAX(nomor)+1,1) AS nomor FROM tbl_analisis WHERE DATE_FORMAT(insert_date,'%Y')= DATE_FORMAT(NOW(),'%Y')");
		$row = $query->row();
		$nomor = $row->nomor;

		$tahun = date('Y');
		$id_analisis = sprintf('%s%04d', $tahun, $nomor);

		$analisis = array(
			'nomor' => $nomor,
			'id_analisis' => $id_analisis
		);

		return $analisis;
	}

	function get_case_status($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_kasus_selesai.id_permohonan FROM tbl_kasus_selesai WHERE tbl_kasus_selesai.id_permohonan = '" . $id_permohonan . "'");

		if ($query->num_rows() > 0) {
			$case_status = '2';
		} else {
			$case_status = '1';
		}

		return $case_status;
	}

	function save_detail_analisis($data)
	{
		$this->db->insert('tbl_analisis', $data);
		return $this->db->insert_id();
	}

	function save_detail_issue_ham($id_permohonan, $issue_ham)
	{

		for ($i = 0; $i < count($issue_ham); $i++) {
			$data = array(
				'id_permohonan' => $id_permohonan,
				'id_issue_ham' =>	$issue_ham[$i]
			);
			$this->db->insert('tbl_analisis_issue_ham', $data);
			$this->db->insert_id();
		}
	}

	function save_detail_hak_terdampak($id_permohonan, $hak_terdampak)
	{

		for ($i = 0; $i < count($hak_terdampak); $i++) {
			$data = array(
				'id_permohonan' => $id_permohonan,
				'id_hak_terdampak' =>	$hak_terdampak[$i]
			);
			$this->db->insert('tbl_analisis_hak', $data);
		}
	}

	function delete_detail_hak_terdampak($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_analisis_hak');
	}

	

	function delete_detail_jenis_pelaku($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_analisis_pelaku');
	}

	function save_detail_jenis_pelaku($id_permohonan, $jenis_pelaku)
	{

		for ($i = 0; $i < count($jenis_pelaku); $i++) {
			$data = array(
				'id_permohonan' => $id_permohonan,
				'id_jenis_pelaku' =>	$jenis_pelaku[$i]
			);
			$this->db->insert('tbl_analisis_pelaku', $data);
		}
	}



	function get_detail_analisis($id_permohonan)
	{
		$analisis = $this->db->query('SELECT * FROM tbl_analisis WHERE tbl_analisis.id_permohonan="' . $id_permohonan . '"');
		return $analisis->row();
	}

	function get_analisis_hak($id_permohonan)
	{
		$query = $this->db->query('SELECT id_hak_terdampak FROM tbl_analisis_hak WHERE id_permohonan="' . $id_permohonan . '" ORDER BY id_hak_terdampak ASC');

		$hak_terdampak = array();
		foreach ($query->result() as $row) {
			$hak_terdampak[] = $row->id_hak_terdampak;
		}


		return $hak_terdampak;
	}
	function get_view_analisis_hak($id_permohonan)
	{
		$query = $this->db->query('SELECT id_hak_terdampak,a.TEKS FROM tbl_analisis_hak LEFT JOIN mt_vocab AS a ON id_hak_terdampak = a.KODE WHERE id_permohonan="' . $id_permohonan . '" ORDER BY id_hak_terdampak ASC');

		$hak_terdampak = array();
		foreach ($query->result() as $row) {
			$hak_terdampak[] = $row->TEKS;
		}


		return $hak_terdampak;
	}


	function get_analisis_pelaku($id_permohonan)
	{
		$query = $this->db->query('SELECT id_jenis_pelaku FROM tbl_analisis_pelaku WHERE id_permohonan="' . $id_permohonan . '" ORDER BY id_jenis_pelaku ASC');

		$jenis_pelaku = array();
		foreach ($query->result() as $row) {
			$jenis_pelaku[] = $row->id_jenis_pelaku;
		}


		return $jenis_pelaku;
	}
	function get_view_analisis_pelaku($id_permohonan)
	{
		$query = $this->db->query('SELECT id_jenis_pelaku,a.TEKS FROM tbl_analisis_pelaku LEFT JOIN mt_vocab AS a ON id_jenis_pelaku = a.KODE WHERE id_permohonan="' . $id_permohonan . '" ORDER BY id_jenis_pelaku ASC');

		$jenis_pelaku = array();
		foreach ($query->result() as $row) {
			$jenis_pelaku[] = $row->TEKS;
		}


		return $jenis_pelaku;
	}


	function get_analisis_edit($id_permohonan)
	{
		$query = $this->db->query('SELECT tbl_permohonan.id_permohonan AS id_permohonan, tbl_permohonan.no_reg AS no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima 
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan 
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   WHERE tbl_permohonan.id_permohonan =' . $id_permohonan . '');
		//$permohonan = array('' => '');
		foreach ($query->result() as $detail_permohonan) {
			$permohonan[$detail_permohonan->id_permohonan] = $detail_permohonan->no_reg . ' | ' . $detail_permohonan->nm_pemohon;
		}
		return $permohonan;
	}

	function get_detail_issue_ham($id_permohonan)
	{
		$query = $this->db->query('SELECT id_issue_ham FROM tbl_analisis_issue_ham WHERE id_permohonan="' . $id_permohonan . '" ORDER BY id_issue_ham ASC');


		foreach ($query->result() as $row) {
			$issue_ham[$row->id_issue_ham] = $row->id_issue_ham;
		}

		$issue_ham = implode(",", $issue_ham);

		$issue = array('issue_ham' => $issue_ham);

		return $issue;
	}

	function view_detail_analisis($id_permohonan)
	{
		$analisis = $this->db->query("SELECT tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
									  DATE_FORMAT(tbl_analisis.insert_date, '%d/%m/%Y') AS tgl_analisis,
									  tbl_analisis.sifat_kasus, tbl_issue_ham.issue_ham, tbl_analisis.bentuk_kasus,										
									  DATE_FORMAT(tbl_analisis.tgl_kejadian, '%d/%m/%Y') AS tgl_kejadian, tbl_provinsi.nm_provinsi, tbl_kabkota.nm_kabkota,
									  tbl_analisis.uu_lbh, tbl_analisis.uu_lawan, 
									  tbl_analisis.lk_dewasa, tbl_analisis.pr_dewasa, tbl_analisis.lk_anak, tbl_analisis.pr_anak, tbl_analisis.total_penerima,
									  tbl_penghasilan.jml_penghasilan AS penghasilan, tbl_kategori_korban.kategori_korban, tbl_kategori_pelaku.kategori_pelaku, tbl_analisis.keterangan,mt_vocab.TEKS AS jenis_peradilan
									  FROM tbl_analisis
									  LEFT JOIN tbl_permohonan ON tbl_analisis.id_permohonan = tbl_permohonan.id_permohonan
									  LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									  LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
									  LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
									  LEFT JOIN mt_vocab ON tbl_analisis.id_jenis_peradilan = mt_vocab.KODE
									  LEFT JOIN tbl_provinsi ON tbl_analisis.id_provinsi = tbl_provinsi.id_provinsi
									  LEFT JOIN tbl_kabkota ON tbl_analisis.id_kabkota = tbl_kabkota.id_kabkota
									  LEFT JOIN tbl_penghasilan ON tbl_analisis.id_penghasilan = tbl_penghasilan.id_penghasilan
									  LEFT JOIN tbl_kategori_korban ON tbl_analisis.id_kategori_korban = tbl_kategori_korban.id_kategori_korban
									  LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
									  WHERE tbl_analisis.id_permohonan ='" . $id_permohonan . "'");
		return $analisis->row();
	}

	function view_issue_ham($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_issue_ham.issue_ham AS isi_issue_ham
								   FROM tbl_analisis_issue_ham
								   LEFT JOIN tbl_issue_ham ON tbl_analisis_issue_ham.id_issue_ham = tbl_issue_ham.id_issue_ham
								   WHERE tbl_analisis_issue_ham.id_permohonan ='" . $id_permohonan . "' ORDER BY tbl_analisis_issue_ham.id_issue_ham ASC");

		foreach ($query->result() as $row) {
			$issue_ham[$row->isi_issue_ham] = $row->isi_issue_ham;
		}

		$issue_ham = implode(",", $issue_ham);

		$issue = array('issue_ham' => $issue_ham);

		return $issue;
	}

	function delete_detail_analisis($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_analisis');
	}

	function delete_detail_issue_ham($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_analisis_issue_ham');
	}

	function delete_approval_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_approval_schedule');
	}

	function delete_analisis_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_analisis_schedule');
	}

	function update_detail_analisis($id_permohonan, $data)
	{
		$this->db->update('tbl_analisis', $data, $id_permohonan);
		return $this->db->affected_rows();
	}

	function save_analisis_schedule($schedule_data)
	{
		$this->db->insert('tbl_analisis_schedule', $schedule_data);
		return $this->db->insert_id();
	}
}

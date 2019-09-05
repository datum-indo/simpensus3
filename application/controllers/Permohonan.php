<?php defined('BASEPATH') or exit('No direct script access allowed');

class Permohonan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model', 'pages');
		$this->load->model('account_model', 'account');
		$this->load->model('permohonan_model', 'permohonan');
		$this->load->model('pemohon_model', 'pemohon');
		$this->logged_in();
	}

	function logged_in()
	{

		if ($this->session->userdata('logged_in')) {
			$this->data['csrf_token'] = $this->session->userdata('csrf_token');
			$this->data['username'] = $this->session->userdata('username');
			$account_info = $this->account->get_account_info($this->data['username']);

			foreach ($account_info->result_array() as $row) {
				$this->data['id_user'] = $row['id_user'];
				$this->data['fullname'] = $row['fullname'];
				$this->data['designation'] = $row['designation'];
				$this->data['id_role'] = $row['id_role'];
				$this->data['nm_role'] = $row['nm_role'];
				$this->data['user_pictures'] = $row['user_pictures'];
				$progress_schedule = $this->pages->get_data_progress_schedule($this->data['id_user']);
				$this->data['progress_count'] = $progress_schedule->num_rows();
				$this->data['progress_schedule'] = $progress_schedule;
				$analisis_schedule = $this->pages->get_data_analisis_schedule($this->data['id_user']);
				$this->data['analisis_count'] = $analisis_schedule->num_rows();
				$this->data['analisis_schedule'] = $analisis_schedule;
				$approval_schedule = $this->pages->get_data_approval_schedule($this->data['id_user']);
				$this->data['approval_count'] = $approval_schedule->num_rows();
				$this->data['approval_schedule'] = $approval_schedule;
				$permohonan = $this->pages->get_data_permohonan();
				$this->data['permohonan_count'] = $permohonan->num_rows();
				$this->data['permohonan_schedule'] = $permohonan;
			}
		} else {
			redirect('login', 'refresh');
		}
	}

	function index()
	{
		$this->data['page_title'] = 'Permohonan';

		$this->data['id_pemohon'] = array('' => '');
		$this->data['status_perkawinan'] = $this->pemohon->get_status_perkawinan();
		$this->data['jkel'] = $this->pemohon->get_jkel();
		$this->data['golongan_darah'] = $this->pemohon->get_golongan_darah();
		$this->data['kondisi_fisik'] = $this->pemohon->get_kondisi_fisik();
		$this->data['difabel'] = $this->pemohon->get_difabel();
		$this->data['agama'] = $this->pemohon->get_agama();
		$this->data['count_unit'] = $this->pemohon->get_count_unit();
		$this->data['pendidikan'] = $this->pemohon->get_pendidikan();
		$this->data['kewarganegaraan'] = $this->pemohon->get_kewarganegaraan();
		$this->data['negara'] = $this->pemohon->get_negara();
		$this->data['pekerjaan'] = $this->pemohon->get_pekerjaan();
		$this->data['pekerjaan2'] = $this->pemohon->get_pekerjaan2();
		$this->data['pekerjaansi'] = $this->pemohon->get_pekerjaansi();
		$this->data['penghasilan'] = $this->pemohon->get_penghasilan();
		$this->data['tanggungan_total'] = '0';
		$this->data['status_tempat_tinggal'] = $this->pemohon->get_status_tempat_tinggal();
		$this->data['provinsi'] = $this->pemohon->get_provinsi();
		$this->data['kabkota'] = array('' => '');
		$this->data['kecamatan'] = array('' => '');
		$this->data['desa'] = array('' => '');
		$this->data['jenis_kid'] = $this->pemohon->get_jenis_kid();
		$this->data['jenis_ktm'] = $this->pemohon->get_jenis_ktm();
		$this->data['status_pemohon'] = $this->pemohon->get_status_pemohon();
		$this->data['pernah_jadi_client'] = $this->pemohon->get_pernah_jadi_client();
		$this->data['sumber_info'] = $this->pemohon->get_sumber_info();
		$this->data['rekomendasi_lbh'] = $this->pemohon->get_rekomendasi_lbh();
		$this->data['jarak_tempuh'] = $this->pemohon->get_jarak_tempuh();
		$this->data['waktu_tempuh'] = $this->pemohon->get_waktu_tempuh();
		$this->data['penanganan_pihak_lain'] = $this->permohonan->get_penanganan_pihak_lain();
		$this->data['tahap_penanganan_pihak_lain'] = $this->permohonan->get_tahap_penanganan_pihak_lain();
		$this->data['status_dokumen'] = $this->permohonan->get_status_dokumen();
		$this->load->view('main/wizard_list', $this->data);
	}

	public function ajax_list()
	{
		$list = $this->permohonan->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $permohonan) {
			//$no++;
			$row = array();
			$row[] = $permohonan->id_permohonan;
			$row[] = $permohonan->no_reg;
			$row[] = $permohonan->tgl_reg;
			$row[] = $permohonan->nm_pemohon;
			$row[] = $permohonan->nm_kabkota;
			//$row[] = $permohonan->no_hp;
			if ($permohonan->status_approval == 'Accepted') {

				$row[] = '<span class="label label-success">' . $permohonan->status_approval . '</span>';
			} else if ($permohonan->status_approval == 'Rejected') {
				$row[] = '<span class="label label-danger">' . $permohonan->status_approval . '</span>';
			} else {
				$row[] = '<span class="label label-warning">' . $permohonan->status_approval . '</span>';
			}
			$row[] = $permohonan->nm_analis_kasus;
			$row[] = $permohonan->nm_petugas_wawancara;

			if ($permohonan->status_permohonan == '1') /*Permohonan telah diapproval*/ {
				if ($this->data['id_role'] == '1') //Administrator
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Permohonan" onclick="edit(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '2') //Direktur
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Permohonan" onclick="edit(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '3' || $this->data['id_role'] == '4') //Manager & Pembela
				{
					if ($this->data['id_user'] == $permohonan->id_analis_kasus) {
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>';

						$data[] = $row;
					} else {
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>';

						$data[] = $row;
					}
				} else if ($this->data['id_role'] == '5' || $this->data['id_role'] == '6') //Asisten PU & Petugas Wawancara
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '7') {
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>';

					$data[] = $row;
				} else {
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>';

					$data[] = $row;
				}
			} else if ($permohonan->status_permohonan == '2') /*Kasus telah Selesai*/ {
				if ($this->data['id_role'] == '1') //Administrator
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Permohonan" onclick="edit(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
					$data[] = $row;
				} else if ($this->data['id_role'] == '2') //Direktur
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Permohonan" onclick="edit(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '7') //Arsiparis
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>';

					$data[] = $row;
				} else {
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>';

					$data[] = $row;
				}
			} else /*Permohonan belum diapproval*/ {
				if ($this->data['id_role'] == '1') //Administrator
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Permohonan" onclick="edit(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '2') //Direktur
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Permohonan" onclick="edit(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '7') //Arsiparis
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-upload"></i></a>';

					$data[] = $row;
				} else {
					if ($this->data['id_user'] == $permohonan->id_petugas_wawancara) {
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Permohonan" onclick="edit(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit Kronologi" onclick="edit_kronologi(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-edit"></i></a>';

						$data[] = $row;
					} else {
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Formulir Permohonan" onclick="pdf_formulir(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Bukti Permohonan" onclick="pdf_bukti(' . "'" . $permohonan->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-file"></i></a>';

						$data[] = $row;
					}
				}
			}
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->permohonan->count_all(),
			"recordsFiltered" => $this->permohonan->count_filtered(),
			"data" => $data
		);

		//output to json format
		echo json_encode($output);
	}

	function get_kabkota($id_provinsi)
	{
		header('Content-Type: application/x-json; charset=utf-8');
		echo (json_encode($this->pemohon->get_kabkota_by_id_provinsi($id_provinsi)));
	}

	function get_kecamatan($id_kabkota)
	{
		header('Content-Type: application/x-json; charset=utf-8');
		echo (json_encode($this->pemohon->get_kecamatan_by_id_kabkota($id_kabkota)));
	}

	function get_desa($id_kecamatan)
	{
		header('Content-Type: application/x-json; charset=utf-8');
		echo (json_encode($this->pemohon->get_desa_by_id_kecamatan($id_kecamatan)));
	}

	function ajax_new()
	{
		if ($this->session->userdata('logged_in')) {
			if ($_GET['type'] == 'permohonan') {
				$data = array(
					'id_permohonan' => '',
					'id_pemohon' => '',
					'judul' => '',
					'uraian_singkat' => '',
					'kronologi_kasus' => '',
					'penanganan_pihak_lain' => 'Tidak',
					'tahap_penanganan_pihak_lain' => '',
					'desc_tahap_penanganan_pihak_lain' => '',
					'jkel' => 'Perempuan'
				);

				//$pemohon = $this->permohonan->get_pemohon_add();
			}
			echo json_encode(array($data));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function _convert_date_to_sql_date($date)
	{
		$date = substr($date, 0, 10);
		$date_array = preg_split('/[-\.\/ ]/', $date);
		$date = date('Y-m-d', mktime(0, 0, 0, $date_array[1], $date_array[0], $date_array[2]));

		return $date;
	}

	function ajax_upload_kid()
	{

		$file_doc_kid = sizeof($_FILES['doc_kid']['tmp_name']);

		$files = $_FILES['doc_kid'];

		for ($i = 0; $i < $file_doc_kid; $i++) {

			$_FILES['doc_kid']['name'] = $files['name'][$i];
			$_FILES['doc_kid']['type'] = $files['type'][$i];
			$_FILES['doc_kid']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['doc_kid']['error'] = $files['error'][$i];
			$_FILES['doc_kid']['size'] = $files['size'][$i];


			$this->load->library('upload');
			$config = array(
				'encrypt_name' 	=> TRUE,
				'allowed_types' => 'jpg|jpeg|pdf',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);

			$this->upload->initialize($config);
			if ($this->upload->do_upload('doc_kid')) {
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];

				$source = './tmp_upload/' . $filename;
				$destination = 'media/files_permohonan';
				copy($source, './' . $destination . '/' . $filename);
				@unlink('./tmp_upload/' . $filename);
				$img1 = $destination . '/' . $filename;

				$data_file = array(
					'upload_by' => $this->data['id_user'],
					'upload_date' => date('Y-m-d H:i:s'),
					'id_section_process' => '1',
					'nm_file' => $filename,
					'nm_asli' => $_FILES['doc_kid']['name'],
					'ukuran' => $_FILES['doc_kid']['size']
				);


				$id_file = $this->pemohon->save_detail_file($data_file);

				$file_uploaded = array( //'link' => '<li class="list-group-item list-group-item-success">'.$_FILES['doc_kid']['name'].'<a class="" href="javascript:void(0)" onclick="delete_file()" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $id_file . "'" . ')" title="Download">' . $_FILES['doc_kid']['name'] . '<a id="' . $id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $id_file,
					'filename' => $_FILES['doc_kid']['name'],
					'fileuploaded' => $filename,
					'status' => TRUE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			} else {
				$file_uploaded = array(
					'link' => '<li class="list-group-item list-group-item-danger">' . $_FILES['doc_kid']['name'] . '</a><a id="error' . $i . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="0"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'filename' => $_FILES['doc_kid']['name'],
					'fileuploaded' => 'Unknown file extension',
					'status' => FALSE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			}
		}
		//echo json_encode(array($this->uploaded));
		echo json_encode($this->uploaded);
	}

	function ajax_upload_ktm()
	{
		$file_doc_ktm = sizeof($_FILES['doc_ktm']['tmp_name']);

		$files = $_FILES['doc_ktm'];

		for ($i = 0; $i < $file_doc_ktm; $i++) {

			$_FILES['doc_ktm']['name'] = $files['name'][$i];
			$_FILES['doc_ktm']['type'] = $files['type'][$i];
			$_FILES['doc_ktm']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['doc_ktm']['error'] = $files['error'][$i];
			$_FILES['doc_ktm']['size'] = $files['size'][$i];


			$this->load->library('upload');
			$config = array(
				'encrypt_name' 	=> TRUE,
				'allowed_types' => 'jpg|jpeg|pdf',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);

			$this->upload->initialize($config);
			if ($this->upload->do_upload('doc_ktm')) {
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];

				$source = './tmp_upload/' . $filename;
				$destination = 'media/files_permohonan';
				copy($source, './' . $destination . '/' . $filename);
				@unlink('./tmp_upload/' . $filename);
				$img1 = $destination . '/' . $filename;

				$data_file = array(
					'upload_by' => $this->data['id_user'],
					'upload_date' => date('Y-m-d H:i:s'),
					'id_section_process' => '1',
					'nm_file' => $filename,
					'nm_asli' => $_FILES['doc_ktm']['name'],
					'ukuran' => $_FILES['doc_ktm']['size']
				);


				$id_file = $this->pemohon->save_detail_file($data_file);

				$file_uploaded = array( //'link' => '<li class="list-group-item list-group-item-success">'.$_FILES['doc_ktm']['name'].'<a class="" href="javascript:void(0)" onclick="delete_file()" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $id_file . "'" . ')" title="Download">' . $_FILES['doc_ktm']['name'] . '<a id="' . $id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $id_file,
					'filename' => $_FILES['doc_ktm']['name'],
					'fileuploaded' => $filename,
					'status' => TRUE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			} else {
				$file_uploaded = array(
					'link' => '<li class="list-group-item list-group-item-danger">' . $_FILES['doc_ktm']['name'] . '</a><a id="error' . $i . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="0"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'filename' => $_FILES['doc_ktm']['name'],
					'fileuploaded' => 'Unknown file extension',
					'status' => FALSE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			}
		}
		//echo json_encode(array($this->uploaded));
		echo json_encode($this->uploaded);
	}

	function ajax_delete_attachment()
	{
		$id_file = $_POST['xid_file'];
		$this->pemohon->delete_detail_attachment($id_file);
		echo json_encode(array("status" => TRUE));
	}

	function ajax_save()
	{
		if ($this->session->userdata('logged_in')) {
			if ($_POST['validate'] == '1') {
				$this->_validate1();
				echo json_encode(array("status" => TRUE));
			} else if ($_POST['validate'] == '2') {
				$this->_validate2();
				echo json_encode(array("status" => TRUE));
			} else if ($_POST['validate'] == '3') {
				$this->_validate3();
				echo json_encode(array("status" => TRUE));
			} else if ($_POST['validate'] == '1b') {
				$this->_validate1b();
				echo json_encode(array("status" => TRUE));
			} else if ($_POST['validate'] == '2b') {
				$this->_validate2b();
				echo json_encode(array("status" => TRUE));
			} else if ($_POST['validate'] == '3b') {
				$this->_validate3b();
				echo json_encode(array("status" => TRUE));
			} else if ($_POST['validate'] == '4') {
				$this->_validate4();
				echo json_encode(array("status" => TRUE));
			} else if ($_POST['validate'] == '5') {
				$this->_validate5();
				echo json_encode(array("status" => TRUE));
			} else {
				$this->_validate6();

				if ($_POST['csrf_token'] == $this->data['csrf_token']) {

					$register = $this->permohonan->get_no_reg();

					$data_permohonan = array(
						'id_permohonan' => $register['id_permohonan'],
						'insert_date' => date('Y-m-d H:i:s'),
						'insert_by' => $this->data['id_user'],
						'update_date' => '0000-00-00 00:00:00',
						'update_by' => '0',
						'nomor' => $register['nomor'],
						'no_reg' => $register['no_reg'],
						'uraian_singkat' => $this->input->post('uraian_singkat'),
						//'kronologi_kasus' => $this->input->post('kronologi_kasus'),
						'penanganan_pihak_lain' => $this->input->post('penanganan_pihak_lain'),
						'tahap_penanganan_pihak_lain' => $this->input->post('tahap_penanganan_pihak_lain'),
						'desc_tahap_penanganan_pihak_lain' => $this->input->post('desc_tahap_penanganan_pihak_lain')
					);

					$insert = $this->permohonan->save_detail_permohonan($data_permohonan);

					$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahir'));

					$data_pemohon = array(
						'id_permohonan' => $register['id_permohonan'],
						'insert_date' => date('Y-m-d H:i:s'),
						'insert_by' => $this->data['id_user'],
						'update_date' => '0000-00-00 00:00:00',
						'update_by' => '0',
						'nm_lengkap' => $this->input->post('nm_lengkap'),
						'nm_panggilan' => $this->input->post('nm_panggilan'),
						'tmp_lahir' => $this->input->post('tmp_lahir'),
						'tgl_lahir' => $tgl_lahir,
						'suku' => $this->input->post('suku'),
						'count_unit' => $this->input->post('id_count_unit'),
						'umur' => $this->pemohon->get_umur_pemohon($tgl_lahir),
						'jkel' => $this->input->post('jkel'),
						'id_golongan_darah' => $this->input->post('id_golongan_darah'),
						'kondisi_fisik' => $this->input->post('kondisi_fisik'),
						'id_difabel' => $this->input->post('id_difabel'),
						'status_perkawinan' => $this->input->post('status_perkawinan'),
						'id_pendidikan' => $this->input->post('id_pendidikan'),
						'pendidikan_desc' => $this->input->post('pendidikan_desc'),
						'id_agama' => $this->input->post('id_agama'),
						'agama_desc' => $this->input->post('agama_desc'),
						'kewarganegaraan' => $this->input->post('kewarganegaraan'),
						'id_negara' => $this->input->post('id_negara'),

						'id_pekerjaan' => $this->input->post('id_pekerjaan'),
						'pekerjaan_desc' => $this->input->post('pekerjaan_desc'),
						'pekerjaan2' => $this->input->post('pekerjaan2'),
						'pekerjaan2_desc' => $this->input->post('pekerjaan2_desc'),
						'pekerjaansi' => $this->input->post('pekerjaansi'),
						'id_pekerjaansi' => $this->input->post('id_pekerjaansi'),
						'pekerjaansi_desc' => $this->input->post('pekerjaansi_desc'),
						'id_penghasilan' => $this->input->post('id_penghasilan'),
						'jml_anak' => $this->input->post('jml_anak'),
						'tanggungan_total' => $this->input->post('tanggungan_total'),
						'harta_rumah' => $this->input->post('harta_rumah'),
						'harta_tanah' => $this->input->post('harta_tanah'),
						'harta_bangunan' => $this->input->post('harta_bangunan'),
						'harta_mobil' => $this->input->post('harta_mobil'),
						'harta_motor' => $this->input->post('harta_motor'),
						'harta_toko' => $this->input->post('harta_toko'),
						'harta_tabungan' => $this->input->post('harta_tabungan'),
						'harta_handphone' => $this->input->post('harta_handphone'),
						//'harta_lain' => $this->input->post('harta_lain'),
						'status_tempat_tinggal' => $this->input->post('status_tempat_tinggal'),

						'alm_jalan' => $this->input->post('alm_jalan'),
						'alm_rt' => $this->input->post('alm_rt'),
						'alm_rw' => $this->input->post('alm_rw'),
						'kodepos' => $this->input->post('kodepos'),
						'id_provinsi' => $this->input->post('id_provinsi'),
						'id_kabkota' => $this->input->post('id_kabkota'),
						'id_kecamatan' => $this->input->post('id_kecamatan'),
						'id_desa' => $this->input->post('id_desa'),
						'no_telp' => $this->input->post('no_telp'),
						'no_hp' => $this->input->post('no_hp'),
						'nm_hp' => $this->input->post('nm_hp'),
						'email' => $this->input->post('email'),
						'facebook' => '',
						'twitter' => '',
						'sosial_media' => '',

						'jenis_kid' => $this->input->post('jenis_kid'),
						'nomor_kid' => $this->input->post('nomor_kid'),
						'jenis_ktm' => $this->input->post('jenis_ktm'),
						'nomor_ktm' => $this->input->post('nomor_ktm'),
						'status_pemohon' => $this->input->post('status_pemohon'),

						'id_jarak_tempuh' => $this->input->post('id_jarak_tempuh'),
						'id_waktu_tempuh' => $this->input->post('id_waktu_tempuh'),
						'pernah_jadi_client' => $this->input->post('pernah_jadi_client'),
						'id_sumber_info' => $this->input->post('id_sumber_info'),
						'sumber_info_desc' => $this->input->post('sumber_info_desc'),
						'rekomendasi_lbh' => $this->input->post('rekomendasi_lbh'),
						'nm_rekomendasi' => $this->input->post('nm_rekomendasi'),
						'alm_rekomendasi' => $this->input->post('alm_rekomendasi'),
						'pekerjaan_rekomendasi' => $this->input->post('pekerjaan_rekomendasi')
					);

					$insert = $this->pemohon->save_detail_pemohon($data_pemohon);

					if ($this->input->post('status_pemohon') == 'Ya') {
						$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahir'));

						$data_penerima = array(
							'id_permohonan' => $register['id_permohonan'],
							'insert_date' => date('Y-m-d H:i:s'),
							'insert_by' => $this->data['id_user'],
							'update_date' => '0000-00-00 00:00:00',
							'update_by' => '0',
							'nm_lengkap' => $this->input->post('nm_lengkap'),
							'nm_panggilan' => $this->input->post('nm_panggilan'),
							'tmp_lahir' => $this->input->post('tmp_lahir'),
							'tgl_lahir' => $tgl_lahir,
							'suku' => $this->input->post('suku'),
							'count_unit' => $this->input->post('id_count_unit'),
							'umur' => $this->pemohon->get_umur_pemohon($tgl_lahir),
							'jkel' => $this->input->post('jkel'),
							'id_golongan_darah' => $this->input->post('id_golongan_darah'),
							'kondisi_fisik' => $this->input->post('kondisi_fisik'),
							'id_difabel' => $this->input->post('id_difabel'),
							'status_perkawinan' => $this->input->post('status_perkawinan'),
							'id_pendidikan' => $this->input->post('id_pendidikan'),
							'pendidikan_desc' => $this->input->post('pendidikan_desc'),
							'id_agama' => $this->input->post('id_agama'),
							'agama_desc' => $this->input->post('agama_desc'),
							'kewarganegaraan' => $this->input->post('kewarganegaraan'),
							'id_negara' => $this->input->post('id_negara'),

							'id_pekerjaan' => $this->input->post('id_pekerjaan'),
							'pekerjaan_desc' => $this->input->post('pekerjaan_desc'),
							'pekerjaan2' => $this->input->post('pekerjaan2'),
							'pekerjaan2_desc' => $this->input->post('pekerjaan2_desc'),
							'pekerjaansi' => $this->input->post('pekerjaansi'),
							'id_pekerjaansi' => $this->input->post('id_pekerjaansi'),
							'pekerjaansi_desc' => $this->input->post('pekerjaansi_desc'),
							'id_penghasilan' => $this->input->post('id_penghasilan'),
							'jml_anak' => $this->input->post('jml_anak'),
							'tanggungan_total' => $this->input->post('tanggungan_total'),
							'harta_rumah' => $this->input->post('harta_rumah'),
							'harta_tanah' => $this->input->post('harta_tanah'),
							'harta_bangunan' => $this->input->post('harta_bangunan'),
							'harta_mobil' => $this->input->post('harta_mobil'),
							'harta_motor' => $this->input->post('harta_motor'),
							'harta_toko' => $this->input->post('harta_toko'),
							'harta_tabungan' => $this->input->post('harta_tabungan'),
							'harta_handphone' => $this->input->post('harta_handphone'),
							//'harta_lain' => $this->input->post('harta_lain'),
							'status_tempat_tinggal' => $this->input->post('status_tempat_tinggal'),

							'alm_jalan' => $this->input->post('alm_jalan'),
							'alm_rt' => $this->input->post('alm_rt'),
							'alm_rw' => $this->input->post('alm_rw'),
							'kodepos' => $this->input->post('kodepos'),
							'id_provinsi' => $this->input->post('id_provinsi'),
							'id_kabkota' => $this->input->post('id_kabkota'),
							'id_kecamatan' => $this->input->post('id_kecamatan'),
							'id_desa' => $this->input->post('id_desa'),
							'no_telp' => $this->input->post('no_telp'),
							'no_hp' => $this->input->post('no_hp'),
							'nm_hp' => $this->input->post('nm_hp'),
							'email' => $this->input->post('email'),
							'facebook' => '',
							'twitter' => '',
							'sosial_media' => '',

							'jenis_kid' => $this->input->post('jenis_kid'),
							'nomor_kid' => $this->input->post('nomor_kid'),
							'jenis_ktm' => $this->input->post('jenis_ktm'),
							'nomor_ktm' => $this->input->post('nomor_ktm'),
							'hubungan_penerima' => ''
						);

						$insert = $this->pemohon->save_detail_penerima($data_penerima);
					} else {
						$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahirb'));

						$data_penerima = array(
							'id_permohonan' => $register['id_permohonan'],
							'insert_date' => date('Y-m-d H:i:s'),
							'insert_by' => $this->data['id_user'],
							'update_date' => '0000-00-00 00:00:00',
							'update_by' => '0',
							'nm_lengkap' => $this->input->post('nm_lengkapb'),
							'nm_panggilan' => $this->input->post('nm_panggilanb'),
							'tmp_lahir' => $this->input->post('tmp_lahirb'),
							'tgl_lahir' => $tgl_lahir,
							'suku' => $this->input->post('suku'),
							'count_unit' => $this->input->post('id_count_unitb'),
							'umur' => $this->pemohon->get_umur_pemohon($tgl_lahir),
							'jkel' => $this->input->post('jkelb'),
							'id_golongan_darah' => $this->input->post('id_golongan_darahb'),
							'kondisi_fisik' => $this->input->post('kondisi_fisikb'),
							'id_difabel' => $this->input->post('id_difabelb'),
							'status_perkawinan' => $this->input->post('status_perkawinanb'),
							'id_pendidikan' => $this->input->post('id_pendidikanb'),
							'pendidikan_desc' => $this->input->post('pendidikan_descb'),
							'id_agama' => $this->input->post('id_agamab'),
							'agama_desc' => $this->input->post('agama_descb'),
							'kewarganegaraan' => $this->input->post('kewarganegaraanb'),
							'id_negara' => $this->input->post('id_negarab'),

							'id_pekerjaan' => $this->input->post('id_pekerjaanb'),
							'pekerjaan_desc' => $this->input->post('pekerjaan_descb'),
							'pekerjaan2' => $this->input->post('pekerjaan2b'),
							'pekerjaan2_desc' => $this->input->post('pekerjaan2_descb'),
							'pekerjaansi' => $this->input->post('pekerjaansib'),
							'id_pekerjaansi' => $this->input->post('id_pekerjaansib'),
							'pekerjaansi_desc' => $this->input->post('pekerjaansi_descb'),
							'id_penghasilan' => $this->input->post('id_penghasilanb'),
							'jml_anak' => $this->input->post('jml_anakb'),
							'tanggungan_total' => $this->input->post('tanggungan_totalb'),
							'harta_rumah' => $this->input->post('harta_rumahb'),
							'harta_tanah' => $this->input->post('harta_tanahb'),
							'harta_bangunan' => $this->input->post('harta_bangunanb'),
							'harta_mobil' => $this->input->post('harta_mobilb'),
							'harta_motor' => $this->input->post('harta_motorb'),
							'harta_toko' => $this->input->post('harta_tokob'),
							'harta_tabungan' => $this->input->post('harta_tabunganb'),
							'harta_handphone' => $this->input->post('harta_handphoneb'),
							//'harta_lain' => $this->input->post('harta_lainb'),
							'status_tempat_tinggal' => $this->input->post('status_tempat_tinggalb'),

							'alm_jalan' => $this->input->post('alm_jalanb'),
							'alm_rt' => $this->input->post('alm_rtb'),
							'alm_rw' => $this->input->post('alm_rwb'),
							'kodepos' => $this->input->post('kodeposb'),
							'id_provinsi' => $this->input->post('id_provinsib'),
							'id_kabkota' => $this->input->post('id_kabkotab'),
							'id_kecamatan' => $this->input->post('id_kecamatanb'),
							'id_desa' => $this->input->post('id_desab'),
							'no_telp' => $this->input->post('no_telpb'),
							'no_hp' => $this->input->post('no_hpb'),
							'nm_hp' => $this->input->post('nm_hpb'),
							'email' => $this->input->post('emailb'),
							'facebook' => '',
							'twitter' => '',
							'sosial_media' => '',

							'jenis_kid' => $this->input->post('jenis_kidb'),
							'nomor_kid' => $this->input->post('nomor_kidb'),
							'jenis_ktm' => $this->input->post('jenis_ktmb'),
							'nomor_ktm' => $this->input->post('nomor_ktmb'),
							'hubungan_penerima' => $this->input->post('hubungan_penerima')
						);

						$insert = $this->pemohon->save_detail_penerima($data_penerima);
					}

					if (isset($_POST['file_kid'])) {
						$file_attachment = $_POST['file_kid'];
						$id_jenis_dokumen = '1';
						$id_permohonan = $register['id_permohonan'];
						$id_process = $register['id_permohonan'];
						$id_section_process = '1';
						$update_file = $this->pemohon->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
					}

					if (isset($_POST['file_ktm'])) {
						$file_attachment = $_POST['file_ktm'];
						$id_jenis_dokumen = '2';
						$id_permohonan = $register['id_permohonan'];
						$id_process = $register['id_permohonan'];
						$id_section_process = '1';
						$update_file = $this->pemohon->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
					}

					$csrf_token = $this->session->userdata('csrf_token');
					$csrf_token = sha1(mt_rand());
					$this->session->set_userdata('csrf_token', $csrf_token);

					echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
				} else {
					echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
				}
			}
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function get_detail_permohonan($id_permohonan)
	{
		if ($this->session->userdata('logged_in')) {
			$permohonan = $this->permohonan->get_detail_permohonan($id_permohonan);
			$pemohon = $this->pemohon->get_detail_pemohon($id_permohonan);
			$pemohon->tgl_lahir = date('d/m/Y', strtotime($pemohon->tgl_lahir));
			$kabkota = $this->pemohon->get_kabkota_by_id_provinsi($pemohon->id_provinsi);
			$kecamatan = $this->pemohon->get_kecamatan_by_id_kabkota($pemohon->id_kabkota);
			$desa = $this->pemohon->get_desa_by_id_kecamatan($pemohon->id_kecamatan);
			$penerima = $this->pemohon->get_detail_penerima($id_permohonan);
			$penerima->tgl_lahir = date('d/m/Y', strtotime($penerima->tgl_lahir));
			$kabkotab = $this->pemohon->get_kabkota_by_id_provinsi($penerima->id_provinsi);
			$kecamatanb = $this->pemohon->get_kecamatan_by_id_kabkota($penerima->id_kabkota);
			$desab = $this->pemohon->get_desa_by_id_kecamatan($penerima->id_kecamatan);

			$id_process = $id_permohonan;
			$id_section_progress = '1';
			$id_jenis_dokumen = '1';
			$filekid = $this->pemohon->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

			if ($filekid->num_rows() > 0) {
				foreach ($filekid->result() as $row) {
					$detail_kid[] = array(
						'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" title="Download">' . $row->nm_baru . '</a><a id="' . $row->id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
						'id_file' => $row->id_file,
						'fileuploaded' => $row->nm_file,
						'filename' => $row->nm_asli,
						'nm_baru' => $row->nm_baru,
						'status' => TRUE
					);
				}

				$file_kid = $detail_kid;
			} else {
				$file_kid = array('' => '');
			}

			$id_jenis_dokumen = '2';
			$filektm = $this->pemohon->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

			if ($filektm->num_rows() > 0) {
				foreach ($filektm->result() as $row) {
					$detail_ktm[] = array(
						'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" title="Download">' . $row->nm_baru . '</a><a id="' . $row->id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
						'id_file' => $row->id_file,
						'fileuploaded' => $row->nm_file,
						'filename' => $row->nm_asli,
						'nm_baru' => $row->nm_baru,
						'status' => TRUE
					);
				}

				$file_ktm = $detail_ktm;
			} else {
				$file_ktm = array('' => '');
			}

			echo json_encode(array($permohonan, $pemohon, $kabkota, $kecamatan, $desa, $penerima, $kabkotab, $kecamatanb, $desab, $file_kid, $file_ktm));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function ajax_update()
	{
		if ($this->session->userdata('logged_in')) {
			if ($_POST['validate'] == '1') {
				$this->_validate1();
			} else if ($_POST['validate'] == '2') {
				$this->_validate2();
			} else if ($_POST['validate'] == '3') {
				$this->_validate3();
			} else if ($_POST['validate'] == '1b') {
				$this->_validate1b();
			} else if ($_POST['validate'] == '2b') {
				$this->_validate2b();
			} else if ($_POST['validate'] == '3b') {
				$this->_validate3b();
			} else if ($_POST['validate'] == '4') {
				$this->_validate4();
			} else if ($_POST['validate'] == '5') {
				$this->_validate5();
			} else {
				$this->_validate6();

				$data_permohonan = array(
					'update_date' => date('Y-m-d H:i:s'),
					'update_by' => $this->data['id_user'],
					'uraian_singkat' => $this->input->post('uraian_singkat'),
					//'kronologi_kasus' => $this->input->post('kronologi_kasus'),
					'penanganan_pihak_lain' => $this->input->post('penanganan_pihak_lain'),
					'tahap_penanganan_pihak_lain' => $this->input->post('tahap_penanganan_pihak_lain'),
					'desc_tahap_penanganan_pihak_lain' => $this->input->post('desc_tahap_penanganan_pihak_lain')
				);

				$this->permohonan->update_detail_permohonan(array('id_permohonan' => $this->input->post('id_permohonan')), $data_permohonan);

				$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahir'));

				$data_pemohon = array(
					'update_date' => date('Y-m-d H:i:s'),
					'update_by' => $this->data['id_user'],
					'nm_lengkap' => $this->input->post('nm_lengkap'),
					'nm_panggilan' => $this->input->post('nm_panggilan'),
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'tgl_lahir' => $tgl_lahir,
					'suku' => $this->input->post('suku'),
					'count_unit' => $this->input->post('id_count_unit'),
					'umur' => $this->pemohon->get_umur_pemohon($tgl_lahir),
					'jkel' => $this->input->post('jkel'),
					'id_golongan_darah' => $this->input->post('id_golongan_darah'),
					'kondisi_fisik' => $this->input->post('kondisi_fisik'),
					'id_difabel' => $this->input->post('id_difabel'),
					'status_perkawinan' => $this->input->post('status_perkawinan'),
					'id_pendidikan' => $this->input->post('id_pendidikan'),
					'pendidikan_desc' => $this->input->post('pendidikan_desc'),
					'id_agama' => $this->input->post('id_agama'),
					'agama_desc' => $this->input->post('agama_desc'),
					'kewarganegaraan' => $this->input->post('kewarganegaraan'),
					'id_negara' => $this->input->post('id_negara'),

					'id_pekerjaan' => $this->input->post('id_pekerjaan'),
					'pekerjaan_desc' => $this->input->post('pekerjaan_desc'),
					'pekerjaan2' => $this->input->post('pekerjaan2'),
					'pekerjaan2_desc' => $this->input->post('pekerjaan2_desc'),
					'pekerjaansi' => $this->input->post('pekerjaansi'),
					'id_pekerjaansi' => $this->input->post('id_pekerjaansi'),
					'pekerjaansi_desc' => $this->input->post('pekerjaansi_desc'),
					'id_penghasilan' => $this->input->post('id_penghasilan'),
					'jml_anak' => $this->input->post('jml_anak'),
					'tanggungan_total' => $this->input->post('tanggungan_total'),
					'harta_rumah' => $this->input->post('harta_rumah'),
					'harta_tanah' => $this->input->post('harta_tanah'),
					'harta_bangunan' => $this->input->post('harta_bangunan'),
					'harta_mobil' => $this->input->post('harta_mobil'),
					'harta_motor' => $this->input->post('harta_motor'),
					'harta_toko' => $this->input->post('harta_toko'),
					'harta_tabungan' => $this->input->post('harta_tabungan'),
					'harta_handphone' => $this->input->post('harta_handphone'),
					//'harta_lain' => $this->input->post('harta_lain'),
					'status_tempat_tinggal' => $this->input->post('status_tempat_tinggal'),

					'alm_jalan' => $this->input->post('alm_jalan'),
					'alm_rt' => $this->input->post('alm_rt'),
					'alm_rw' => $this->input->post('alm_rw'),
					'kodepos' => $this->input->post('kodepos'),
					'id_provinsi' => $this->input->post('id_provinsi'),
					'id_kabkota' => $this->input->post('id_kabkota'),
					'id_kecamatan' => $this->input->post('id_kecamatan'),
					'id_desa' => $this->input->post('id_desa'),
					'no_telp' => $this->input->post('no_telp'),
					'no_hp' => $this->input->post('no_hp'),
					'nm_hp' => $this->input->post('nm_hp'),
					'email' => $this->input->post('email'),
					'facebook' => '',
					'twitter' => '',
					'sosial_media' => '',

					'jenis_kid' => $this->input->post('jenis_kid'),
					'nomor_kid' => $this->input->post('nomor_kid'),
					'jenis_ktm' => $this->input->post('jenis_ktm'),
					'nomor_ktm' => $this->input->post('nomor_ktm'),
					'status_pemohon' => $this->input->post('status_pemohon'),

					'id_jarak_tempuh' => $this->input->post('id_jarak_tempuh'),
					'id_waktu_tempuh' => $this->input->post('id_waktu_tempuh'),
					'pernah_jadi_client' => $this->input->post('pernah_jadi_client'),
					'id_sumber_info' => $this->input->post('id_sumber_info'),
					'sumber_info_desc' => $this->input->post('sumber_info_desc'),
					'rekomendasi_lbh' => $this->input->post('rekomendasi_lbh'),
					'nm_rekomendasi' => $this->input->post('nm_rekomendasi'),
					'alm_rekomendasi' => $this->input->post('alm_rekomendasi'),
					'pekerjaan_rekomendasi' => $this->input->post('pekerjaan_rekomendasi')
				);

				$this->pemohon->update_detail_pemohon(array('id_permohonan' => $this->input->post('id_permohonan')), $data_pemohon);

				if ($this->input->post('status_pemohon') == 'Ya') {
					$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahir'));

					$data_penerima = array(
						'update_date' => date('Y-m-d H:i:s'),
						'update_by' => $this->data['id_user'],
						'nm_lengkap' => $this->input->post('nm_lengkap'),
						'nm_panggilan' => $this->input->post('nm_panggilan'),
						'tmp_lahir' => $this->input->post('tmp_lahir'),
						'tgl_lahir' => $tgl_lahir,
						'suku' => $this->input->post('suku'),
						'count_unit' => $this->input->post('id_count_unit'),
						'umur' => $this->pemohon->get_umur_pemohon($tgl_lahir),
						'jkel' => $this->input->post('jkel'),
						'id_golongan_darah' => $this->input->post('id_golongan_darah'),
						'kondisi_fisik' => $this->input->post('kondisi_fisik'),
						'id_difabel' => $this->input->post('id_difabel'),
						'status_perkawinan' => $this->input->post('status_perkawinan'),
						'id_pendidikan' => $this->input->post('id_pendidikan'),
						'pendidikan_desc' => $this->input->post('pendidikan_desc'),
						'id_agama' => $this->input->post('id_agama'),
						'agama_desc' => $this->input->post('agama_desc'),
						'kewarganegaraan' => $this->input->post('kewarganegaraan'),
						'id_negara' => $this->input->post('id_negara'),

						'id_pekerjaan' => $this->input->post('id_pekerjaan'),
						'pekerjaan_desc' => $this->input->post('pekerjaan_desc'),
						'pekerjaan2' => $this->input->post('pekerjaan2'),
						'pekerjaan2_desc' => $this->input->post('pekerjaan2_desc'),
						'pekerjaansi' => $this->input->post('pekerjaansi'),
						'id_pekerjaansi' => $this->input->post('id_pekerjaansi'),
						'pekerjaansi_desc' => $this->input->post('pekerjaansi_desc'),
						'id_penghasilan' => $this->input->post('id_penghasilan'),
						'jml_anak' => $this->input->post('jml_anak'),
						'tanggungan_total' => $this->input->post('tanggungan_total'),
						'harta_rumah' => $this->input->post('harta_rumah'),
						'harta_tanah' => $this->input->post('harta_tanah'),
						'harta_bangunan' => $this->input->post('harta_bangunan'),
						'harta_mobil' => $this->input->post('harta_mobil'),
						'harta_motor' => $this->input->post('harta_motor'),
						'harta_toko' => $this->input->post('harta_toko'),
						'harta_tabungan' => $this->input->post('harta_tabungan'),
						'harta_handphone' => $this->input->post('harta_handphone'),
						//'harta_lain' => $this->input->post('harta_lain'),
						'status_tempat_tinggal' => $this->input->post('status_tempat_tinggal'),

						'alm_jalan' => $this->input->post('alm_jalan'),
						'alm_rt' => $this->input->post('alm_rt'),
						'alm_rw' => $this->input->post('alm_rw'),
						'kodepos' => $this->input->post('kodepos'),
						'id_provinsi' => $this->input->post('id_provinsi'),
						'id_kabkota' => $this->input->post('id_kabkota'),
						'id_kecamatan' => $this->input->post('id_kecamatan'),
						'id_desa' => $this->input->post('id_desa'),
						'no_telp' => $this->input->post('no_telp'),
						'no_hp' => $this->input->post('no_hp'),
						'nm_hp' => $this->input->post('nm_hp'),
						'email' => $this->input->post('email'),
						'facebook' => '',
						'twitter' => '',
						'sosial_media' => '',

						'jenis_kid' => $this->input->post('jenis_kid'),
						'nomor_kid' => $this->input->post('nomor_kid'),
						'jenis_ktm' => $this->input->post('jenis_ktm'),
						'nomor_ktm' => $this->input->post('nomor_ktm'),
						'hubungan_penerima' => ''
					);

					$this->pemohon->update_detail_penerima(array('id_permohonan' => $this->input->post('id_permohonan')), $data_penerima);
				} else {
					$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahirb'));

					$data_penerima = array(
						'update_date' => date('Y-m-d H:i:s'),
						'update_by' => $this->data['id_user'],
						'nm_lengkap' => $this->input->post('nm_lengkapb'),
						'nm_panggilan' => $this->input->post('nm_panggilanb'),
						'tmp_lahir' => $this->input->post('tmp_lahirb'),
						'tgl_lahir' => $tgl_lahir,
						'suku' => $this->input->post('sukub'),
						'count_unit' => $this->input->post('id_count_unitb'),
						'umur' => $this->pemohon->get_umur_pemohon($tgl_lahir),
						'jkel' => $this->input->post('jkelb'),
						'id_golongan_darah' => $this->input->post('id_golongan_darahb'),
						'kondisi_fisik' => $this->input->post('kondisi_fisikb'),
						'id_difabel' => $this->input->post('id_difabelb'),
						'status_perkawinan' => $this->input->post('status_perkawinanb'),
						'id_pendidikan' => $this->input->post('id_pendidikanb'),
						'pendidikan_desc' => $this->input->post('pendidikan_descb'),
						'id_agama' => $this->input->post('id_agamab'),
						'agama_desc' => $this->input->post('agama_descb'),
						'kewarganegaraan' => $this->input->post('kewarganegaraanb'),
						'id_negara' => $this->input->post('id_negarab'),

						'id_pekerjaan' => $this->input->post('id_pekerjaanb'),
						'pekerjaan_desc' => $this->input->post('pekerjaan_descb'),
						'pekerjaan2' => $this->input->post('pekerjaan2b'),
						'pekerjaan2_desc' => $this->input->post('pekerjaan2_descb'),
						'pekerjaansi' => $this->input->post('pekerjaansib'),
						'id_pekerjaansi' => $this->input->post('id_pekerjaansib'),
						'pekerjaansi_desc' => $this->input->post('pekerjaansi_descb'),
						'id_penghasilan' => $this->input->post('id_penghasilanb'),
						'jml_anak' => $this->input->post('jml_anakb'),
						'tanggungan_total' => $this->input->post('tanggungan_totalb'),
						'harta_rumah' => $this->input->post('harta_rumahb'),
						'harta_tanah' => $this->input->post('harta_tanahb'),
						'harta_bangunan' => $this->input->post('harta_bangunanb'),
						'harta_mobil' => $this->input->post('harta_mobilb'),
						'harta_motor' => $this->input->post('harta_motorb'),
						'harta_toko' => $this->input->post('harta_tokob'),
						'harta_tabungan' => $this->input->post('harta_tabunganb'),
						'harta_handphone' => $this->input->post('harta_handphoneb'),
						//'harta_lain' => $this->input->post('harta_lainb'),
						'status_tempat_tinggal' => $this->input->post('status_tempat_tinggalb'),

						'alm_jalan' => $this->input->post('alm_jalanb'),
						'alm_rt' => $this->input->post('alm_rtb'),
						'alm_rw' => $this->input->post('alm_rwb'),
						'kodepos' => $this->input->post('kodeposb'),
						'id_provinsi' => $this->input->post('id_provinsib'),
						'id_kabkota' => $this->input->post('id_kabkotab'),
						'id_kecamatan' => $this->input->post('id_kecamatanb'),
						'id_desa' => $this->input->post('id_desab'),
						'no_telp' => $this->input->post('no_telpb'),
						'no_hp' => $this->input->post('no_hpb'),
						'nm_hp' => $this->input->post('nm_hpb'),
						'email' => $this->input->post('emailb'),
						'facebook' => '',
						'twitter' => '',
						'sosial_media' => '',

						'jenis_kid' => $this->input->post('jenis_kidb'),
						'nomor_kid' => $this->input->post('nomor_kidb'),
						'jenis_ktm' => $this->input->post('jenis_ktmb'),
						'nomor_ktm' => $this->input->post('nomor_ktmb'),
						'hubungan_penerima' => $this->input->post('hubungan_penerima')
					);

					$this->pemohon->update_detail_penerima(array('id_permohonan' => $this->input->post('id_permohonan')), $data_penerima);
				}

				if (isset($_POST['file_kid'])) {
					$file_attachment = $_POST['file_kid'];
					$id_jenis_dokumen = '1';
					$id_permohonan = $this->input->post('id_permohonan');
					$id_process = $this->input->post('id_permohonan');
					$id_section_process = '1';
					$update_file = $this->pemohon->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
				}

				if (isset($_POST['file_ktm'])) {
					$file_attachment = $_POST['file_ktm'];
					$id_jenis_dokumen = '2';
					$id_permohonan = $this->input->post('id_permohonan');
					$id_process = $this->input->post('id_permohonan');
					$id_section_process = '1';
					$update_file = $this->pemohon->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
				}
			}
			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function get_kronologi($id_permohonan)
	{
		$data = $this->permohonan->get_kronologi($id_permohonan);
		echo json_encode(array($data));
	}

	function ajax_update_kronologi()
	{
		$kronologi = array('kronologi_kasus' => $this->input->post('kronologi_kasus'));
		$this->permohonan->update_kronologi(array('id_permohonan' => $this->input->post('id_permohonan')), $kronologi);
		echo json_encode(array("status" => TRUE));
	}

	function ajax_delete()
	{
		$id_permohonan = $_POST['id_permohonan'];
		$this->permohonan->delete_detail_permohonan($id_permohonan);
		$this->pemohon->delete_detail_pemohon($id_permohonan);
		$this->pemohon->delete_detail_penerima($id_permohonan);
		$this->pemohon->delete_attachment_pemohon($id_permohonan);
		echo json_encode(array("status" => TRUE));
	}

	function view_detail_permohonan($id_permohonan)
	{
		if ($this->session->userdata('logged_in')) {

			$data_permohonan = $this->permohonan->view_detail_permohonan($id_permohonan);
			$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$data_permohonan->bln_lahir = $bulan[intval($data_permohonan->bln_lahir)];
			$data_permohonan->bln_lahirb = $bulan[intval($data_permohonan->bln_lahirb)];

			$id_process = $id_permohonan;
			$id_section_progress = '1';
			$id_jenis_dokumen = '1';
			$filekid = $this->pemohon->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

			if ($filekid->num_rows() > 0) {
				foreach ($filekid->result() as $row) {
					$detail_kid[] = array(
						'link' => '<li class="list-group-item">' . $row->nm_baru . '<a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" style="float: right;" title="Download"><span class="glyphicon glyphicon-save"></span></a></li>',
						'id_file' => $row->id_file,
						'fileuploaded' => $row->nm_file,
						'filename' => $row->nm_asli,
						'nm_baru' => $row->nm_baru,
						'status' => TRUE
					);
				}

				$file_kid = $detail_kid;
			} else {
				$file_kid = array('' => '');
			}

			$id_jenis_dokumen = '2';
			$filektm = $this->pemohon->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

			if ($filektm->num_rows() > 0) {
				foreach ($filektm->result() as $row) {
					$detail_ktm[] = array(
						'link' => '<li class="list-group-item">' . $row->nm_baru . '<a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" style="float: right;" title="Download"><span class="glyphicon glyphicon-save"></span></a></li>',
						'id_file' => $row->id_file,
						'fileuploaded' => $row->nm_file,
						'filename' => $row->nm_asli,
						'nm_baru' => $row->nm_baru,
						'status' => TRUE
					);
				}

				$file_ktm = $detail_ktm;
			} else {
				$file_ktm = array('' => '');
			}

			$id_section_progress = '2';
			$id_jenis_dokumen = '3';
			$file_list = $this->permohonan->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

			if ($file_list->num_rows() > 0) {
				foreach ($file_list->result() as $row) {
					$detail_file[] = array(
						'link' => '<li class="list-group-item">' . $row->nm_baru . '<a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" style="float: right;" title="Download"><span class="glyphicon glyphicon-save"></span></a></li>',
						'id_file' => $row->id_file,
						'fileuploaded' => $row->nm_file,
						'filename' => $row->nm_asli,
						'nm_baru' => $row->nm_baru,
						'status' => TRUE
					);
				}


				$file_attachment = $detail_file;
			} else {
				$file_attachment = array('' => '');
			}

			echo json_encode(array($data_permohonan, $file_kid, $file_ktm, $file_attachment));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function get_file_permohonan($id_permohonan)
	{
		$id_process = $id_permohonan;

		$id_section_progress = '1';
		$id_jenis_dokumen = '1';
		$filekid = $this->pemohon->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

		if ($filekid->num_rows() > 0) {
			foreach ($filekid->result() as $row) {
				$detail_kid[] = array(
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" title="Download">' . $row->nm_baru . '</a><a id="' . $row->id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $row->id_file,
					'fileuploaded' => $row->nm_file,
					'filename' => $row->nm_asli,
					'nm_baru' => $row->nm_baru,
					'status' => TRUE
				);
			}

			$file_kid = $detail_kid;
		} else {
			$file_kid = array('' => '');
		}

		$id_jenis_dokumen = '2';
		$filektm = $this->pemohon->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

		if ($filektm->num_rows() > 0) {
			foreach ($filektm->result() as $row) {
				$detail_ktm[] = array(
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" title="Download">' . $row->nm_baru . '</a><a id="' . $row->id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $row->id_file,
					'fileuploaded' => $row->nm_file,
					'filename' => $row->nm_asli,
					'nm_baru' => $row->nm_baru,
					'status' => TRUE
				);
			}

			$file_ktm = $detail_ktm;
		} else {
			$file_ktm = array('' => '');
		}

		$id_section_progress = '2';
		$id_jenis_dokumen = '3';
		$file_list = $this->permohonan->get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen);

		if ($file_list->num_rows() > 0) {
			foreach ($file_list->result() as $row) {
				$detail_file[] = array(
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $row->id_file . "'" . ')" title="Download">' . $row->nm_baru . '</a><a id="' . $row->id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $row->id_file,
					'fileuploaded' => $row->nm_file,
					'filename' => $row->nm_asli,
					'nm_baru' => $row->nm_baru,
					'status' => TRUE
				);
			}


			$file_attachment = $detail_file;
		} else {
			$file_attachment = array('' => '');
		}

		$dokumen_status = $this->permohonan->get_dokumen_status($id_permohonan);

		echo json_encode(array($file_kid, $file_ktm, $file_attachment, $dokumen_status));
	}

	function ajax_upload_kidx()
	{

		$file_doc_kid = sizeof($_FILES['doc_kidx']['tmp_name']);

		$files = $_FILES['doc_kidx'];

		for ($i = 0; $i < $file_doc_kid; $i++) {

			$_FILES['doc_kidx']['name'] = $files['name'][$i];
			$_FILES['doc_kidx']['type'] = $files['type'][$i];
			$_FILES['doc_kidx']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['doc_kidx']['error'] = $files['error'][$i];
			$_FILES['doc_kidx']['size'] = $files['size'][$i];


			$this->load->library('upload');
			$config = array(
				'encrypt_name' 	=> TRUE,
				'allowed_types' => 'jpg|jpeg|pdf',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);

			$this->upload->initialize($config);
			if ($this->upload->do_upload('doc_kidx')) {
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];

				$source = './tmp_upload/' . $filename;
				$destination = 'media/files_permohonan';
				copy($source, './' . $destination . '/' . $filename);
				@unlink('./tmp_upload/' . $filename);
				$img1 = $destination . '/' . $filename;

				$data_file = array(
					'upload_by' => $this->data['id_user'],
					'upload_date' => date('Y-m-d H:i:s'),
					'id_section_process' => '1',
					'nm_file' => $filename,
					'nm_asli' => $_FILES['doc_kidx']['name'],
					'ukuran' => $_FILES['doc_kidx']['size']
				);


				$id_file = $this->pemohon->save_detail_file($data_file);

				$file_uploaded = array( //'link' => '<li class="list-group-item list-group-item-success">'.$_FILES['doc_kid']['name'].'<a class="" href="javascript:void(0)" onclick="delete_file()" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $id_file . "'" . ')" title="Download">' . $_FILES['doc_kidx']['name'] . '<a id="' . $id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $id_file,
					'filename' => $_FILES['doc_kidx']['name'],
					'fileuploaded' => $filename,
					'status' => TRUE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			} else {
				$file_uploaded = array(
					'link' => '<li class="list-group-item list-group-item-danger">' . $_FILES['doc_kidx']['name'] . '</a><a id="error' . $i . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="0"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'filename' => $_FILES['doc_kidx']['name'],
					'fileuploaded' => 'Unknown file extension',
					'status' => FALSE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			}
		}
		//echo json_encode(array($this->uploaded));
		echo json_encode($this->uploaded);
	}

	function ajax_upload_ktmx()
	{
		$file_doc_ktm = sizeof($_FILES['doc_ktmx']['tmp_name']);

		$files = $_FILES['doc_ktmx'];

		for ($i = 0; $i < $file_doc_ktm; $i++) {

			$_FILES['doc_ktmx']['name'] = $files['name'][$i];
			$_FILES['doc_ktmx']['type'] = $files['type'][$i];
			$_FILES['doc_ktmx']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['doc_ktmx']['error'] = $files['error'][$i];
			$_FILES['doc_ktmx']['size'] = $files['size'][$i];


			$this->load->library('upload');
			$config = array(
				'encrypt_name' 	=> TRUE,
				'allowed_types' => 'jpg|jpeg|pdf',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);

			$this->upload->initialize($config);
			if ($this->upload->do_upload('doc_ktmx')) {
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];

				$source = './tmp_upload/' . $filename;
				$destination = 'media/files_permohonan';
				copy($source, './' . $destination . '/' . $filename);
				@unlink('./tmp_upload/' . $filename);
				$img1 = $destination . '/' . $filename;

				$data_file = array(
					'upload_by' => $this->data['id_user'],
					'upload_date' => date('Y-m-d H:i:s'),
					'id_section_process' => '1',
					'nm_file' => $filename,
					'nm_asli' => $_FILES['doc_ktmx']['name'],
					'ukuran' => $_FILES['doc_ktmx']['size']
				);


				$id_file = $this->pemohon->save_detail_file($data_file);

				$file_uploaded = array( //'link' => '<li class="list-group-item list-group-item-success">'.$_FILES['doc_ktm']['name'].'<a class="" href="javascript:void(0)" onclick="delete_file()" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $id_file . "'" . ')" title="Download">' . $_FILES['doc_ktmx']['name'] . '<a id="' . $id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $id_file,
					'filename' => $_FILES['doc_ktmx']['name'],
					'fileuploaded' => $filename,
					'status' => TRUE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			} else {
				$file_uploaded = array(
					'link' => '<li class="list-group-item list-group-item-danger">' . $_FILES['doc_ktmx']['name'] . '</a><a id="error' . $i . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="0"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'filename' => $_FILES['doc_ktmx']['name'],
					'fileuploaded' => 'Unknown file extension',
					'status' => FALSE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			}
		}
		//echo json_encode(array($this->uploaded));
		echo json_encode($this->uploaded);
	}

	function ajax_upload_permohonan()
	{

		$file_lampiran = sizeof($_FILES['lampiran']['tmp_name']);

		$files = $_FILES['lampiran'];

		for ($i = 0; $i < $file_lampiran; $i++) {

			$_FILES['lampiran']['name'] = $files['name'][$i];
			$_FILES['lampiran']['type'] = $files['type'][$i];
			$_FILES['lampiran']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['lampiran']['error'] = $files['error'][$i];
			$_FILES['lampiran']['size'] = $files['size'][$i];


			$this->load->library('upload');
			$config = array(
				'encrypt_name' 	=> TRUE,
				'allowed_types' => 'jpg|jpeg|pdf',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);

			$this->upload->initialize($config);
			if ($this->upload->do_upload('lampiran')) {
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];

				$source = './tmp_upload/' . $filename;
				$destination = 'media/files_permohonan';
				copy($source, './' . $destination . '/' . $filename);
				@unlink('./tmp_upload/' . $filename);
				$img1 = $destination . '/' . $filename;

				$data_file = array(
					'upload_by' => $this->data['id_user'],
					'upload_date' => date('Y-m-d H:i:s'),
					'id_section_process' => '2',
					'nm_file' => $filename,
					'nm_asli' => $_FILES['lampiran']['name'],
					'ukuran' => $_FILES['lampiran']['size']
				);


				$id_file = $this->permohonan->save_detail_file($data_file);

				$file_uploaded = array( //'link' => '<li class="list-group-item list-group-item-success">'.$_FILES['lampiran']['name'].'<a class="" href="javascript:void(0)" onclick="delete_file()" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file(' . "'" . $id_file . "'" . ')" title="Download">' . $_FILES['lampiran']['name'] . '<a id="' . $id_file . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'id_file' => $id_file,
					'filename' => $_FILES['lampiran']['name'],
					'fileuploaded' => $filename,
					'status' => TRUE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			} else {
				$file_uploaded = array(
					'link' => '<li class="list-group-item list-group-item-danger">' . $_FILES['lampiran']['name'] . '</a><a id="error' . $i . '" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="0"><span class="glyphicon glyphicon-remove"></span></a></li>',
					'filename' => $_FILES['lampiran']['name'],
					'fileuploaded' => 'Unknown file extension',
					'status' => FALSE
				);

				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			}
		}
		//echo json_encode(array($this->uploaded));
		echo json_encode($this->uploaded);
	}

	function ajax_save_file_permohonan()
	{
		$this->_validate_status_dokumen();

		if (isset($_POST['file_kid'])) {
			$file_attachment = $_POST['file_kid'];
			$id_jenis_dokumen = '1';
			$id_permohonan = $this->input->post('id_permohonan');
			$id_process = $this->input->post('id_permohonan');
			$id_section_process = '1';
			$update_file = $this->pemohon->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
		}

		if (isset($_POST['file_ktm'])) {
			$file_attachment = $_POST['file_ktm'];
			$id_jenis_dokumen = '2';
			$id_permohonan = $this->input->post('id_permohonan');
			$id_process = $this->input->post('id_permohonan');
			$id_section_process = '1';
			$update_file = $this->pemohon->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
		}

		if (isset($_POST['file_permohonan'])) {
			$file_attachment = $_POST['file_permohonan'];
			$id_permohonan = $this->input->post('id_permohonan');
			$id_process = $this->input->post('id_permohonan');
			$id_section_process = '2';
			$id_jenis_dokumen = '3';
			$update_file = $this->permohonan->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
		}

		$status_dokumen = array('status_dokumen' => $this->input->post('status_dokumen'));

		$this->permohonan->update_dokumen_status(array('id_permohonan' => $this->input->post('id_permohonan')), $status_dokumen);

		echo json_encode(array("status" => TRUE));
	}

	function get_file_attachment()
	{
		$id_file = $this->uri->segment(3);
		$filename = $this->pemohon->get_filename($id_file);
		$nm_baru = $this->pemohon->get_nm_baru($id_file);

		$server = base_url();
		$path = './media/files_permohonan/';
		$url = $path . '/' . $filename;

		//if(@getimagesize($url))
		if (is_file($url)) {

			// required for IE
			if (ini_get('zlib.output_compression')) {
				ini_set('zlib.output_compression', 'Off');
			}

			// get the file mime type using the file extension
			$this->load->helper('file');
			$mime = get_mime_by_extension($path);

			header('Pragma: public');     // required
			header('Expires: 0');         // no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($url)) . ' GMT');
			header('Cache-Control: private', false);
			header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
			header('Content-Disposition: attachment; filename="' . basename($nm_baru) . '"');  // Add the file name
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: ' . filesize($url)); // provide file size
			header('Connection: close');
			readfile($url); // push it out
			exit();
		}
	}

	function get_output_formulir_permohonan()
	{
		//$id_permohonan = $_POST['id_permohonan'];
		$id_permohonan = $this->uri->segment(3);
		$permohonan = $this->permohonan->get_data_formulir($id_permohonan);

		foreach ($permohonan->result_array() as $row) {
			$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$this->content_data['id_permohonan'] = $row['id_permohonan'];
			$this->content_data['no_reg'] = $row['no_reg'];
			$this->content_data['tgl_reg'] = $row['tgl_reg'] . ' ' . $bulan[intval($row['bln_reg'])] . ' ' . $row['thn_reg'];
			$this->content_data['nm_pemohon'] = $row['nm_lengkap'];
			$this->content_data['tmp_lahir'] = $row['tmp_lahir'];
			$this->content_data['tgl_lahir'] = 'Tanggal ' . $row['tgl_lahir'] . ' Bulan ' . $bulan[intval($row['bln_lahir'])] . ' Tahun ' . $row['thn_lahir'];
			$this->content_data['umur'] = $row['umur'];
			$this->content_data['jkel'] = $row['jkel'];
			$this->content_data['alm_jalan'] = $row['alm_jalan'];
			$this->content_data['alm_rt'] = $row['alm_rt'];
			$this->content_data['alm_rw'] = $row['alm_rw'];
			$this->content_data['nm_provinsi'] = $row['nm_provinsi'];
			$this->content_data['nm_kabkota'] = $row['nm_kabkota'];
			$this->content_data['nm_kecamatan'] = $row['nm_kecamatan'];
			$this->content_data['nm_desa'] = $row['nm_desa'];
			$this->content_data['no_hp'] = $row['no_hp'];
			$this->content_data['nm_hp'] = $row['nm_hp'];

			if ($row['id_pekerjaan'] == '45') {
				$this->content_data['pekerjaan'] = $row['pekerjaan_desc'];
			} else {
				$this->content_data['pekerjaan'] = $row['jenis_pekerjaan'];
			}

			$this->content_data['jml_anak'] = $row['jml_anak'];
			$this->content_data['tanggungan_total'] = $row['tanggungan_total'];

			$this->content_data['jenis_kid'] = $row['jenis_kid'];
			if ($row['jenis_kid'] == 'Tidak Ada') {
				$this->content_data['nomor_kid'] = '-';
			} else {
				$this->content_data['nomor_kid'] = $row['nomor_kid'];
			}

			$this->content_data['jenis_ktm'] = $row['jenis_ktm'];
			if ($row['jenis_ktm'] == 'Tidak Ada') {
				$this->content_data['nomor_ktm'] = '-';
			} else {
				$this->content_data['nomor_ktm'] = $row['nomor_ktm'];
			}


			if ($row['kondisi_fisik'] == 'Ya') {
				$this->content_data['kondisi_fisik'] = $row['jenis_difabel'];
			} else {
				$this->content_data['kondisi_fisik'] = 'Tidak Ada';
			}

			$this->content_data['uraian_singkat'] = $row['uraian_singkat'];
		}

		$header = $this->permohonan->get_detail_setting();

		foreach ($header->result_array() as $data) {
			$this->content_data['kota_cabang'] = $data['kota_cabang'];
			//$this->content_data['line1'] = $data['alamat_cabang'].' '.$data['kota_cabang'].' '.$data['kodepos'].' Telp. '.$data['no_telp'].' Fax. '.$data['no_fax'];
			//$this->content_data['line1'] = $data['alamat_cabang'].' '.$data['kota_cabang'].' '.$data['kodepos'].' Telp. '.$data['no_telp'];
			$this->content_data['line1'] = 'Jl. Dipenogoro No. 74, Lantai 2, Jakarta Pusat, ' . $data['kodepos'] . ' Telp. ' . $data['no_telp'] . ' Fax. ' . $data['no_fax'];
			$this->content_data['line2'] = 'Website: ' . $data['website'] . ', Email: ' . $data['email'];
		}

		$filename = 'Permohonan_' . $id_permohonan;
		$pdfFilePath = FCPATH . "/downloads/reports/$filename.pdf";

		//$this->load->library('fpdf');
		$html = $this->load->view('main/wizard_formulir', $this->content_data, true);

		$this->load->library('MPDF60/mpdf');
		$mpdf = new mPDF('', 'legal', 0, '', 10, 10, 10, 10, 0, 0, 'L');
		//$mpdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
		//$mpdf->AddPage('P', 'en-GB-x', 'F4', '', '', 10, 10, 10, 10, 0, 0);
		$mpdf->SetTitle('Print Out Permohonan Nomor : ' . $this->content_data['no_reg']);
		$mpdf->SetAuthor('Simpensus');
		$mpdf->SetSubject('Dokumen Permohonan Nomor : ' . $this->content_data['no_reg']);
		$mpdf->WriteHTML($html); // write the HTML into the PDF
		//$mpdf->Output($pdfFilePath, 'F'); // save to file because we can
		$mpdf->Output($filename . '.pdf', 'I'); // save to file because we can

		redirect("/downloads/reports/$filename.pdf");
		//echo json_encode(array("status" => TRUE));
	}

	function get_output_bukti_permohonan()
	{
		//$id_permohonan = $_POST['id_permohonan'];
		$id_permohonan = $this->uri->segment(3);
		$permohonan = $this->permohonan->get_data_bukti($id_permohonan);

		foreach ($permohonan->result_array() as $row) {
			$bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$this->content_data['id_permohonan'] = $row['id_permohonan'];
			$this->content_data['no_reg'] = $row['no_reg'];
			$this->content_data['tgl_reg'] = $row['tgl_reg'] . ' ' . $bulan[intval($row['bln_reg'])] . ' ' . $row['thn_reg'];
			$this->content_data['nm_pemohon'] = $row['nm_pemohon'];
			$this->content_data['tmp_lahir'] = $row['tmp_lahir'];
			$this->content_data['tgl_lahir'] = 'Tanggal ' . $row['tgl_lahir'] . ' Bulan ' . $bulan[intval($row['bln_lahir'])] . ' Tahun ' . $row['thn_lahir'];
			$this->content_data['umur'] = $row['umur'];
			$this->content_data['jkel'] = $row['jkel'];
			$this->content_data['alm_jalan'] = $row['alm_jalan'];
			$this->content_data['alm_rt'] = $row['alm_rt'];
			$this->content_data['alm_rw'] = $row['alm_rw'];
			$this->content_data['nm_provinsi'] = $row['nm_provinsi'];
			$this->content_data['nm_kabkota'] = $row['nm_kabkota'];
			$this->content_data['nm_kecamatan'] = $row['nm_kecamatan'];
			$this->content_data['nm_desa'] = $row['nm_desa'];
			$this->content_data['no_hp'] = $row['no_hp'];
			$this->content_data['nm_hp'] = $row['nm_hp'];

			if ($row['id_pekerjaan'] == '45') {
				$this->content_data['pekerjaan'] = $row['pekerjaan_desc'];
			} else {
				$this->content_data['pekerjaan'] = $row['jenis_pekerjaan'];
			}

			$this->content_data['nm_penerima'] = $row['nm_penerima'];
			$this->content_data['tmp_lahirb'] = $row['tmp_lahirb'];
			$this->content_data['tgl_lahirb'] = 'Tanggal ' . $row['tgl_lahirb'] . ' Bulan ' . $bulan[intval($row['bln_lahirb'])] . ' Tahun ' . $row['thn_lahirb'];
			$this->content_data['umurb'] = $row['umurb'];
			$this->content_data['jkelb'] = $row['jkelb'];
			$this->content_data['alm_jalanb'] = $row['alm_jalanb'];
			$this->content_data['alm_rtb'] = $row['alm_rtb'];
			$this->content_data['alm_rwb'] = $row['alm_rwb'];
			$this->content_data['nm_provinsib'] = $row['nm_provinsib'];
			$this->content_data['nm_kabkotab'] = $row['nm_kabkotab'];
			$this->content_data['nm_kecamatanb'] = $row['nm_kecamatanb'];
			$this->content_data['nm_desab'] = $row['nm_desab'];
			$this->content_data['no_hpb'] = $row['no_hpb'];
			$this->content_data['nm_hpb'] = $row['nm_hpb'];

			if ($row['id_pekerjaanb'] == '45') {
				$this->content_data['pekerjaanb'] = $row['pekerjaan_descb'];
			} else {
				$this->content_data['pekerjaanb'] = $row['jenis_pekerjaanb'];
			}

			$this->content_data['hubungan_penerima'] = $row['hubungan_penerima'];
			$this->content_data['nm_petugas_wawancara'] = $row['nm_petugas_wawancara'];
		}

		$header = $this->permohonan->get_detail_setting();
		foreach ($header->result_array() as $data) {
			$this->content_data['kota_cabang'] = $data['kota_cabang'];
			//$this->content_data['line1'] = $data['alamat_cabang'].' '.$data['kota_cabang'].' '.$data['kodepos'].' Telp. '.$data['no_telp'].' Fax. '.$data['no_fax'];
			//$this->content_data['line1'] = $data['alamat_cabang'].' '.$data['kota_cabang'].' '.$data['kodepos'].' Telp. '.$data['no_telp'];
			$this->content_data['line1'] = 'Jl. Dipenogoro No. 74, Lantai 2, Jakarta Pusat, ' . $data['kodepos'] . ' Telp. ' . $data['no_telp'] . ' Fax. ' . $data['no_fax'];
			$this->content_data['line2'] = 'Website: ' . $data['website'] . ', Email: ' . $data['email'];
		}

		$filename = 'Permohonan_' . $id_permohonan;
		$pdfFilePath = FCPATH . "/downloads/reports/$filename.pdf";

		//$this->load->library('fpdf');
		$html = $this->load->view('main/wizard_bukti', $this->content_data, true);

		$this->load->library('MPDF60/mpdf');
		$mpdf = new mPDF('', 'legal', 0, '', 10, 10, 10, 10, 0, 10, 'L');

		$footer = '
		<table id="footer" style="font-family: "Times New Roman", Times, serif;">
			<tr>
				<td colspan="2" style="font-size: 11px; font-weight: bold; font-style: italic;">Catatan:</td>
			</tr>
			<tr>
				<td width="15" style="vertical-align:baseline; font-style: italic;">-</td>
				<td style="font-size: 11px; font-style: italic;">Pemohon Layanan Bantuan Hukum wajib diajukan langsung oleh Calon Penerima Bantuan Hukum Kecuali Tersangka/Terdakwa dalam status masa tahanan atau Terpidana sementara menjalani masa hukuman dalam Kasus Pidana, dapat diwakili oleh Keluarga/Kerabat terdekat.</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size: 5px;"></td>
			</tr>
			<tr>
				<td width="15" style="vertical-align:baseline; font-size: 11px; font-style: italic;">-</td>
				<td style="font-size: 11px; font-style: italic;">Lembaga Bantuan Hukum Makassar akan menyampaikan kepada Pemohon mengenai Diterima atau Ditolaknya Permohonan Bantuan Hukum tersebut, paling lama 3 (tiga) hari kerja sejak semua dokumen dan berkas yang dipersyaratkan telah diterima dan dinyatakan telah lengkap..</td>
			</tr>
         </table>';

		$mpdf->SetFooter($footer);
		//$mpdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
		//$mpdf->AddPage('P', 'en-GB-x', 'F4', '', '', 10, 10, 10, 10, 0, 0);
		$mpdf->SetTitle('Print Out Bukti Permohonan Nomor : ' . $this->content_data['no_reg']);
		$mpdf->SetAuthor('Simpensus');
		$mpdf->SetSubject('Dokumen Bukti Permohonan Nomor : ' . $this->content_data['no_reg']);
		$mpdf->WriteHTML($html); // write the HTML into the PDF
		//$mpdf->Output($pdfFilePath, 'F'); // save to file because we can
		$mpdf->Output($filename . '.pdf', 'I'); // save to file because we can


		redirect("/downloads/reports/$filename.pdf");
		//echo json_encode(array("status" => TRUE));
	}

	function _validate1()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nm_lengkap') == '') {
			$data['inputerror'][] = 'nm_lengkap';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nm_panggilan') == '') {
			$data['inputerror'][] = 'nm_panggilan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tmp_lahir') == '') {
			$data['inputerror'][] = 'tmp_lahir';
			//$data['error_string'][] = 'Tempat Lahir is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tgl_lahir') == '') {
			$data['inputerror'][] = 'tgl_lahir';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		if ($this->input->post('id_count_unit') == '') {
			$data['inputerror'][] = 'id_count_unit';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		if ($this->input->post('jkel') == '') {
			$data['inputerror'][] = 'jkel';
			//$data['error_string'][] = 'Status Perkewinan is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('kondisi_fisik') == 'Ya') {
			if ($this->input->post('id_difabel') == '') {
				$data['inputerror'][] = 'id_difabel';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('status_perkawinan') == '') {
			$data['inputerror'][] = 'status_perkawinan';
			//$data['error_string'][] = 'Status Perkewinan is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_pendidikan') == '') {
			$data['inputerror'][] = 'id_pendidikan';
			//$data['error_string'][] = 'Agama is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_pendidikan') == '9') {
			if ($this->input->post('pendidikan_desc') == '') {
				$data['inputerror'][] = 'pendidikan_desc';
				//$data['error_string'][] = 'pendidikan Lain is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('id_agama') == '') {
			$data['inputerror'][] = 'id_agama';
			//$data['error_string'][] = 'Agama is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_agama') == '9') {
			if ($this->input->post('agama_desc') == '') {
				$data['inputerror'][] = 'agama_desc';
				//$data['error_string'][] = 'Agama Lain is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('kewarganegaraan') == '') {
			$data['inputerror'][] = 'kewarganegaraan';
			//$data['error_string'][] = 'Kewarganegaraan is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('kewarganegaraan') == 'WNA') {
			if ($this->input->post('id_negara') == '') {
				$data['inputerror'][] = 'id_negara';
				//$data['error_string'][] = 'Negara is required';
				$data['status'] = FALSE;
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate2()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_pekerjaan') == '') {
			$data['inputerror'][] = 'id_pekerjaan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_pekerjaan') == '45') {
			if ($this->input->post('pekerjaan_desc') == '') {
				$data['inputerror'][] = 'pekerjaan_desc';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('pekerjaan2') == 'Ya') {
			if ($this->input->post('pekerjaan2_desc') == '') {
				$data['inputerror'][] = 'pekerjaan2_desc';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('pekerjaansi') == 'Ya') {
			if ($this->input->post('id_pekerjaansi') == '') {
				$data['inputerror'][] = 'id_pekerjaansi';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('id_pekerjaansi') == '45') {
			if ($this->input->post('pekerjaansi_desc') == '') {
				$data['inputerror'][] = 'pekerjaansi_desc';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('id_penghasilan') == '') {
			$data['inputerror'][] = 'id_penghasilan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jml_anak') == '') {
			$data['inputerror'][] = 'jml_anak';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggungan_total') == '') {
			$data['inputerror'][] = 'tanggungan_total';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_rumah') == '') {
			$data['inputerror'][] = 'harta_rumah';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_tanah') == '') {
			$data['inputerror'][] = 'harta_tanah';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_bangunan') == '') {
			$data['inputerror'][] = 'harta_bangunan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_mobil') == '') {
			$data['inputerror'][] = 'harta_mobil';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_motor') == '') {
			$data['inputerror'][] = 'harta_motor';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_toko') == '') {
			$data['inputerror'][] = 'harta_toko';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_tabungan') == '') {
			$data['inputerror'][] = 'harta_tabungan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_handphone') == '') {
			$data['inputerror'][] = 'harta_handphone';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		/*
		if($this->input->post('harta_lain') == '')
		{
			$data['inputerror'][] = 'harta_lain';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}
		*/

		if ($this->input->post('status_tempat_tinggal') == '') {
			$data['inputerror'][] = 'status_tempat_tinggal';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate3()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('alm_jalan') == '') {
			$data['inputerror'][] = 'alm_jalan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_provinsi') == '') {
			$data['inputerror'][] = 'id_provinsi';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_kabkota') == '') {
			$data['inputerror'][] = 'id_kabkota';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_kecamatan') == '') {
			$data['inputerror'][] = 'id_kecamatan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_desa') == '') {
			$data['inputerror'][] = 'id_desa';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('no_hp') == '') {
			$data['inputerror'][] = 'no_hp';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nm_hp') == '') {
			$data['inputerror'][] = 'nm_hp';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jenis_kid') == '') {
			$data['inputerror'][] = 'jenis_kid';
			//$data['error_string'][] = 'Jenis Kartu Identitas Diri is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jenis_kid') != 'Tidak Ada' && $this->input->post('jenis_kid') != '') {
			if ($this->input->post('nomor_kid') == '') {
				$data['inputerror'][] = 'nomor_kid';
				//$data['error_string'][] = 'Nomor Kartu Identitas is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('jenis_ktm') == '') {
			$data['inputerror'][] = 'jenis_ktm';
			//$data['error_string'][] = 'Jenis Ket. Tidak Mampu is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jenis_ktm') != 'Tidak Ada' && $this->input->post('jenis_ktm') != '') {
			if ($this->input->post('nomor_ktm') == '') {
				$data['inputerror'][] = 'nomor_ktm';
				//$data['error_string'][] = 'Nomor Ket. tidak Mampu is required';
				$data['status'] = FALSE;
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate1b()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nm_lengkapb') == '') {
			$data['inputerror'][] = 'nm_lengkapb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nm_panggilanb') == '') {
			$data['inputerror'][] = 'nm_panggilanb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tmp_lahirb') == '') {
			$data['inputerror'][] = 'tmp_lahirb';
			//$data['error_string'][] = 'Tempat Lahir is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tgl_lahirb') == '') {
			$data['inputerror'][] = 'tgl_lahirb';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		if ($this->input->post('id_count_unitb') == '') {
			$data['inputerror'][] = 'id_count_unitb';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jkelb') == '') {
			$data['inputerror'][] = 'jkelb';
			//$data['error_string'][] = 'Status Perkewinan is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('kondisi_fisikb') == 'Ya') {
			if ($this->input->post('id_difabelb') == '') {
				$data['inputerror'][] = 'id_difabelb';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('status_perkawinanb') == '') {
			$data['inputerror'][] = 'status_perkawinanb';
			//$data['error_string'][] = 'Status Perkewinan is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_pendidikanb') == '') {
			$data['inputerror'][] = 'id_pendidikanb';
			//$data['error_string'][] = 'Agama is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_pendidikanb') == '9') {
			if ($this->input->post('pendidikan_descb') == '') {
				$data['inputerror'][] = 'pendidikan_descb';
				//$data['error_string'][] = 'pendidikan Lain is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('id_agamab') == '') {
			$data['inputerror'][] = 'id_agamab';
			//$data['error_string'][] = 'Agama is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_agamab') == '9') {
			if ($this->input->post('agama_descb') == '') {
				$data['inputerror'][] = 'agama_descb';
				//$data['error_string'][] = 'Agama Lain is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('kewarganegaraanb') == '') {
			$data['inputerror'][] = 'kewarganegaraanb';
			//$data['error_string'][] = 'Kewarganegaraan is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('kewarganegaraanb') == 'WNA') {
			if ($this->input->post('id_negarab') == '') {
				$data['inputerror'][] = 'id_negarab';
				//$data['error_string'][] = 'Negara is required';
				$data['status'] = FALSE;
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate2b()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_pekerjaanb') == '') {
			$data['inputerror'][] = 'id_pekerjaanb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_pekerjaanb') == '45') {
			if ($this->input->post('pekerjaan_descb') == '') {
				$data['inputerror'][] = 'pekerjaan_descb';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('pekerjaan2b') == 'Ya') {
			if ($this->input->post('pekerjaan2_descb') == '') {
				$data['inputerror'][] = 'pekerjaan2_descb';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('pekerjaansib') == 'Ya') {
			if ($this->input->post('id_pekerjaansib') == '') {
				$data['inputerror'][] = 'id_pekerjaansib';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('id_pekerjaansib') == '45') {
			if ($this->input->post('pekerjaansi_descb') == '') {
				$data['inputerror'][] = 'pekerjaansi_descb';
				//$data['error_string'][] = 'Status Perkewinan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('id_penghasilanb') == '') {
			$data['inputerror'][] = 'id_penghasilanb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jml_anakb') == '') {
			$data['inputerror'][] = 'jml_anakb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('tanggungan_totalb') == '') {
			$data['inputerror'][] = 'tanggungan_totalb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_rumahb') == '') {
			$data['inputerror'][] = 'harta_rumahb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_tanahb') == '') {
			$data['inputerror'][] = 'harta_tanahb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_bangunanb') == '') {
			$data['inputerror'][] = 'harta_bangunanb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_mobilb') == '') {
			$data['inputerror'][] = 'harta_mobilb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_motorb') == '') {
			$data['inputerror'][] = 'harta_motorb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_tokob') == '') {
			$data['inputerror'][] = 'harta_tokob';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_tabunganb') == '') {
			$data['inputerror'][] = 'harta_tabunganb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harta_handphoneb') == '') {
			$data['inputerror'][] = 'harta_handphoneb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		/*
		if($this->input->post('harta_lainb') == '')
		{
			$data['inputerror'][] = 'harta_lainb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}
		*/

		if ($this->input->post('status_tempat_tinggalb') == '') {
			$data['inputerror'][] = 'status_tempat_tinggalb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate3b()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('alm_jalanb') == '') {
			$data['inputerror'][] = 'alm_jalanb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_provinsib') == '') {
			$data['inputerror'][] = 'id_provinsib';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_kabkotab') == '') {
			$data['inputerror'][] = 'id_kabkotab';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_kecamatanb') == '') {
			$data['inputerror'][] = 'id_kecamatanb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_desab') == '') {
			$data['inputerror'][] = 'id_desab';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('no_hpb') == '') {
			$data['inputerror'][] = 'no_hpb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('nm_hpb') == '') {
			$data['inputerror'][] = 'nm_hpb';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jenis_kidb') == '') {
			$data['inputerror'][] = 'jenis_kidb';
			//$data['error_string'][] = 'Jenis Kartu Identitas Diri is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jenis_kidb') != 'Tidak Ada' && $this->input->post('jenis_kidb') != '') {
			if ($this->input->post('nomor_kidb') == '') {
				$data['inputerror'][] = 'nomor_kidb';
				//$data['error_string'][] = 'Nomor Kartu Identitas is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('jenis_ktmb') == '') {
			$data['inputerror'][] = 'jenis_ktmb';
			//$data['error_string'][] = 'Jenis Ket. Tidak Mampu is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('jenis_ktmb') != 'Tidak Ada' && $this->input->post('jenis_ktmb') != '') {
			if ($this->input->post('nomor_ktmb') == '') {
				$data['inputerror'][] = 'nomor_ktmb';
				//$data['error_string'][] = 'Nomor Ket. tidak Mampu is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('hubungan_penerima') == '') {
			$data['inputerror'][] = 'hubungan_penerima';
			//$data['error_string'][] = 'Hubungan dengan Pemohon';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate4()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		/*
		if(isset($_POST['file_kid']))
		{
			if($this->input->post('jenis_kid') == 'Tidak Ada' || $this->input->post('jenis_kid') == '')
			{
				$data['inputerror'][] = 'jenis_kid';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}	
		}
		
		if(isset($_POST['file_ktm']))
		{
			if($this->input->post('jenis_ktm') == 'Tidak Ada' || $this->input->post('jenis_ktm') == '')
			{
				$data['inputerror'][] = 'jenis_ktm';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}	
		}
		*/

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate5()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_jarak_tempuh') == '') {
			$data['inputerror'][] = 'id_jarak_tempuh';
			//$data['error_string'][] = 'Jenis Kartu Identitas Diri is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('id_waktu_tempuh') == '') {
			$data['inputerror'][] = 'id_waktu_tempuh';
			//$data['error_string'][] = 'Jenis Kartu Identitas Diri is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('pernah_jadi_client') == 'Belum') {
			if ($this->input->post('id_sumber_info') == '') {
				$data['inputerror'][] = 'id_sumber_info';
				//$data['error_string'][] = 'Nomor Kartu Identitas is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('id_sumber_info') == '9') {
			if ($this->input->post('sumber_info_desc') == '') {
				$data['inputerror'][] = 'sumber_info_desc';
				//$data['error_string'][] = 'Nomor Kartu Identitas is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('rekomendasi_lbh') == 'Ya') {
			if ($this->input->post('nm_rekomendasi') == '') {
				$data['inputerror'][] = 'nm_rekomendasi';
				//$data['error_string'][] = 'Nomor Kartu Identitas is required';
				$data['status'] = FALSE;
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate6()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if ($this->input->post('uraian_singkat') != '') {
			if (strlen(trim($this->input->post('uraian_singkat'))) > 1800) {
				$data['inputerror'][] = 'uraian_singkat';
				//$data['error_string'][] = 'Uraian singkat melebihi 1000 karakter';
				$data['status'] = FALSE;
			}
		} else {
			$data['inputerror'][] = 'uraian_singkat';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		/*
		if($this->input->post('kronologi_kasus') == '')
		{
			$data['inputerror'][] = 'kronologi_kasus';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}
		*/

		if ($this->input->post('penanganan_pihak_lain') == 'Ya') {
			if ($this->input->post('tahap_penanganan_pihak_lain') == '') {
				$data['inputerror'][] = 'tahap_penanganan_pihak_lain';
				//$data['error_string'][] = 'Pekerjaan Tambahan is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('tahap_penanganan_pihak_lain') != '') {
			if ($this->input->post('desc_tahap_penanganan_pihak_lain') == '') {
				$data['inputerror'][] = 'desc_tahap_penanganan_pihak_lain';
				//$data['error_string'][] = 'Pekerjaan Tambahan is required';
				$data['status'] = FALSE;
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	function _validate_status_dokumen()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if ($this->input->post('status_dokumen') == '') {
			$data['inputerror'][] = 'status_dokumen';
			//$data['error_string'][] = 'Pekerjaan Tambahan is required';
			$data['status'] = FALSE;
		}


		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}

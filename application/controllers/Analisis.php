<?php defined('BASEPATH') or exit('No direct script access allowed');

class Analisis extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model', 'pages');
		$this->load->model('account_model', 'account');
		$this->load->model('analisis_model', 'analisis');
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
		$this->data['page_title'] = 'Analisis';
		$this->data['permohonan'] = array('' => '');
		$this->data['issue_ham_utama'] = $this->analisis->get_issue_ham();
		$this->data['issue_ham'] = $this->analisis->get_issue_ham();
		$this->data['nama_kasus'] = array('' => '');
		$this->data['provinsi'] = $this->pemohon->get_provinsi();
		$this->data['kabkota'] = array('' => '');
		$this->data['bentuk_kasus'] = $this->analisis->get_bentuk_kasus();
		$this->data['sifat_kasus'] = $this->analisis->get_sifat_kasus();
		$this->data['penghasilan'] = $this->analisis->get_penghasilan();
		$this->data['kategori_korban'] = $this->analisis->get_kategori_korban();
		$this->data['kategori_pelaku'] = $this->analisis->get_kategori_pelaku();
		$this->data['keterangan'] = '';

		//$this->data['jenis_kasus'] = $this->analisis->get_sifat_kasus();


		$this->load->view('main/analisis_list', $this->data);
	}

	public function ajax_list()
	{
		$list = $this->analisis->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $analisis) {
			//$no++;
			$row = array();
			$row[] = $analisis->id_analisis;
			$row[] = $analisis->no_reg;
			$row[] = $analisis->tgl_analisis;
			$row[] = $analisis->bentuk_kasus;
			$row[] = $analisis->sifat_kasus;
			$row[] = $analisis->nm_kabkota;
			$row[] = $analisis->kategori_korban;
			$row[] = $analisis->total_penerima;
			$row[] = $analisis->nm_processby;

			if ($analisis->case_status == '1') {
				if ($this->data['id_role'] == '1') {
					//add html for action
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '2') {
					//add html for action
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '3' || $this->data['id_role'] == '4') {
					if ($this->data['id_user'] == $analisis->id_processby || $this->data['id_user'] == $analisis->id_analis) {
						//add html for action
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>';

						$data[] = $row;
					} else {
						//add html for action
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>';

						$data[] = $row;
					}
				} else {
					//add html for action
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>';

					$data[] = $row;
				}
			} else {
				if ($this->data['id_role'] == '1') {
					//add html for action
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';

					$data[] = $row;
				} else if ($this->data['id_role'] == '2') {
					//add html for action
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>';

					$data[] = $row;
				} else {
					//add html for action
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view(' . "'" . $analisis->id_permohonan . "'" . ')"><i class="glyphicon glyphicon-eye-open"></i></a>';

					$data[] = $row;
				}
			}
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->analisis->count_all(),
			"recordsFiltered" => $this->analisis->count_filtered(),
			"data" => $data
		);


		echo json_encode($output);
	}

	function ajax_new()
	{
		if ($this->session->userdata('logged_in')) {
			if ($_GET['type'] == 'analisis') {
				$analisis = array(
					'id_permohonan' => '',
					'sifat_kasus' => '',
					'id_issue_ham' => '',
					'issue_ham' => '',
					'uu_lbh' => '',
					'uu_lawan' => '',
					'bentuk_kasus' => '',
					'lk_dewasa' => '',
					'pr_dewasa' => '',
					'lk_anak' => '',
					'pr_anak' => '',
					'total_penerima' => '0',
					'id_penghasilan' => '',
					'id_kategori_korban' => '',
					'id_kategori_pelaku' => '',
					'keterangan' => ''
				);

				$approval = $this->analisis->get_analisis_add();
			}
			echo json_encode(array($analisis, $approval));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function get_kabkota($id_provinsi)
	{
		header('Content-Type: application/x-json; charset=utf-8');
		echo (json_encode($this->pemohon->get_kabkota_by_id_provinsi($id_provinsi)));
	}

	function _convert_date_to_sql_date($date)
	{
		$date = substr($date, 0, 10);
		$date_array = preg_split('/[-\.\/ ]/', $date);
		$date = date('Y-m-d', mktime(0, 0, 0, $date_array[1], $date_array[0], $date_array[2]));

		return $date;
	}

	function ajax_save()
	{
		if ($this->session->userdata('logged_in')) {
			$this->_validate();

			if ($_POST['csrf_token'] == $this->data['csrf_token']) {

				if ($this->input->post('sifat_kasus') == 'Struktural') {
					$id_permohonan = $this->input->post('id_permohonan');
					$issue_ham = $_POST['issue_ham'];
					$insert = $this->analisis->save_detail_issue_ham($id_permohonan, $issue_ham);
				}

				if ($this->input->post("id_hak_terdampak")) {
					$id_permohonan = $this->input->post('id_permohonan');
					$issue_hak_terdampak = $this->input->post('id_hak_terdampak');
					$insert2 = $this->analisis->save_detail_hak_terdampak($id_permohonan, $issue_hak_terdampak);
				}

				if ($this->input->post("id_jenis_pelaku")) {
					$id_permohonan = $this->input->post('id_permohonan');
					$issue_jenis_pelaku = $this->input->post('id_jenis_pelaku');
					$insert2 = $this->analisis->save_detail_jenis_pelaku($id_permohonan, $issue_jenis_pelaku);
				}

				$this->analisis->delete_approval_schedule($this->input->post('id_permohonan'));
				$this->analisis->delete_analisis_schedule($this->input->post('id_permohonan'));

				$analisis = $this->analisis->get_id_analisis();
				$case_status = $this->analisis->get_case_status($this->input->post('id_permohonan'));

				$tgl_kejadian = $this->_convert_date_to_sql_date($this->input->post('tgl_kejadian'));

				$data = array(
					'id_analisis' => $analisis['id_analisis'],
					'id_permohonan' => $this->input->post('id_permohonan'),
					'insert_date' => date('Y-m-d H:i:s'),
					'insert_by' => $this->data['id_user'],
					'update_date' => '0000-00-00 00:00:00',
					'update_by' => '0',
					'nomor' => $analisis['nomor'],
					'bentuk_kasus' => $this->input->post('bentuk_kasus'),
					'sifat_kasus' => $this->input->post('sifat_kasus'),
					'id_issue_ham' => $this->input->post('id_issue_ham'),
					'tgl_kejadian' => $tgl_kejadian,
					'id_provinsi' => $this->input->post('id_provinsi'),
					'id_jenis_peradilan' => $this->input->post("id_jenis_peradilan"),
					'id_kabkota' => $this->input->post('id_kabkota'),
					'uu_lbh' => $this->input->post('uu_lbh'),
					'uu_lawan' => $this->input->post('uu_lawan'),
					'lk_dewasa' => $this->input->post('lk_dewasa'),
					'pr_dewasa' => $this->input->post('pr_dewasa'),
					'lk_anak' => $this->input->post('lk_anak'),
					'pr_anak' => $this->input->post('pr_anak'),
					'total_penerima' => $this->input->post('total_penerima'),
					'id_penghasilan' => $this->input->post('id_penghasilan'),
					'id_kategori_korban' => $this->input->post('id_kategori_korban'),
					'id_kategori_pelaku' => $this->input->post('id_kategori_pelaku'),
					'keterangan' => $this->input->post('keterangan'),
					'case_status' => $case_status
				);

				$insert = $this->analisis->save_detail_analisis($data);

				echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
			} else {
				echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
			}
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function get_detail_analisis($id_permohonan)
	{
		if ($this->session->userdata('logged_in')) {
			$analisis = $this->analisis->get_detail_analisis($id_permohonan);
			$analisis->tgl_kejadian = date('d/m/Y', strtotime($analisis->tgl_kejadian));
			$kabkota = $this->pemohon->get_kabkota_by_id_provinsi($analisis->id_provinsi);
			$permohonan = $this->analisis->get_analisis_edit($analisis->id_permohonan);
			$analisis_hak = $this->analisis->get_analisis_hak($id_permohonan);
			$analisis_pelaku = $this->analisis->get_analisis_pelaku($id_permohonan);

			if ($analisis->sifat_kasus == 'Struktural') {
				$issue_ham = $this->analisis->get_detail_issue_ham($id_permohonan);
			} else {
				$issue_ham = '';
			}

			echo json_encode(array($analisis, $permohonan, $issue_ham, $kabkota, $analisis_hak, $analisis_pelaku));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function ajax_update()
	{
		if ($this->session->userdata('logged_in')) {
			$this->_validate();

			if ($this->input->post('sifat_kasus') == 'Struktural') {
				$id_permohonan = $this->input->post('id_permohonan');
				$issue_ham = $_POST['issue_ham'];
				$this->analisis->delete_detail_issue_ham($id_permohonan);
				$this->analisis->save_detail_issue_ham($id_permohonan, $issue_ham);
			} else {
				$id_permohonan = $this->input->post('id_permohonan');
				$this->analisis->delete_detail_issue_ham($id_permohonan);
			}

			if ($this->input->post("id_hak_terdampak")) {
				$id_permohonan = $this->input->post('id_permohonan');
				$issue_hak_terdampak = $this->input->post('id_hak_terdampak');
				$this->analisis->delete_detail_hak_terdampak($id_permohonan);
				$this->analisis->save_detail_hak_terdampak($id_permohonan, $issue_hak_terdampak);
			} else {
				$id_permohonan = $this->input->post('id_permohonan');
				$this->analisis->delete_detail_hak_terdampak($id_permohonan);
			}

			if ($this->input->post("id_jenis_pelaku")) {
				$id_permohonan = $this->input->post('id_permohonan');
				$issue_jenis_pelaku = $this->input->post('id_jenis_pelaku');
				$this->analisis->delete_detail_jenis_pelaku($id_permohonan);
				$this->analisis->save_detail_jenis_pelaku($id_permohonan, $issue_jenis_pelaku);
			} else {
				$id_permohonan = $this->input->post('id_permohonan');
				$this->analisis->delete_detail_jenis_pelaku($id_permohonan);
			}


			// if ($this->input->post("id_hak_terdampak")) {
			// 	$id_permohonan = $this->input->post('id_permohonan');
			// 	$issue_hak_terdampak = $this->input->post('id_hak_terdampak');
			// 	$insert2 = $this->analisis->save_detail_hak_terdampak($id_permohonan, $issue_hak_terdampak);
			// }


			$tgl_kejadian = $this->_convert_date_to_sql_date($this->input->post('tgl_kejadian'));
			$case_status = $this->analisis->get_case_status($this->input->post('id_permohonan'));

			$data = array(
				'id_analisis' => $this->input->post('id_analisis'),
				'update_date' => date('Y-m-d H:i:s'),
				'update_by' => $this->data['id_user'],
				'sifat_kasus' => $this->input->post('sifat_kasus'),
				'id_issue_ham' => $this->input->post('id_issue_ham'),
				'bentuk_kasus' => $this->input->post('bentuk_kasus'),
				'tgl_kejadian' => $tgl_kejadian,
				'id_provinsi' => $this->input->post('id_provinsi'),
				'id_kabkota' => $this->input->post('id_kabkota'),
				'uu_lbh' => $this->input->post('uu_lbh'),
				'id_jenis_peradilan' => $this->input->post('id_jenis_peradilan'),
				'uu_lawan' => $this->input->post('uu_lawan'),
				'lk_dewasa' => $this->input->post('lk_dewasa'),
				'pr_dewasa' => $this->input->post('pr_dewasa'),
				'lk_anak' => $this->input->post('lk_anak'),
				'pr_anak' => $this->input->post('pr_anak'),
				'total_penerima' => $this->input->post('total_penerima'),
				'id_penghasilan' => $this->input->post('id_penghasilan'),
				'id_kategori_korban' => $this->input->post('id_kategori_korban'),
				'id_kategori_pelaku' => $this->input->post('id_kategori_pelaku'),
				'keterangan' => $this->input->post('keterangan'),
				'case_status' => $case_status
			);

			$this->analisis->update_detail_analisis(array('id_permohonan' => $this->input->post('id_permohonan')), $data);

			echo json_encode(array("status" => TRUE));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function view_detail_analisis($id_permohonan)
	{
		if ($this->session->userdata('logged_in')) {
			$analisis = $this->analisis->view_detail_analisis($id_permohonan);
			if ($analisis->sifat_kasus == 'Struktural') {
				$issue_ham = $this->analisis->view_issue_ham($id_permohonan);
			} else {
				$issue_ham = array('' => '');
			}
			$hak_terdampak =	$this->analisis->get_view_analisis_hak($id_permohonan);
			$jenis_pelaku =	$this->analisis->get_view_analisis_pelaku($id_permohonan);
			echo json_encode(array($analisis, $issue_ham, $hak_terdampak, $jenis_pelaku));
		} else {
			echo json_encode(array('success' => FALSE));
		}
	}

	function ajax_delete()
	{
		$id_permohonan = $_POST['id_permohonan'];
		$this->analisis->delete_detail_analisis($id_permohonan);
		$this->analisis->delete_detail_issue_ham($id_permohonan);

		$schedule_data = array(
			'id_permohonan' => $id_permohonan,
			'date_schedule' => date('Y-m-d')
		);

		$this->analisis->save_analisis_schedule($schedule_data);

		echo json_encode(array("status" => TRUE));
	}

	function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('id_permohonan') == '') {
			$data['inputerror'][] = 'id_permohonan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('sifat_kasus') == '') {
			$data['inputerror'][] = 'sifat_kasus';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('sifat_kasus') == 'Struktural') {
			if ($this->input->post('id_issue_ham') == '') {
				$data['inputerror'][] = 'id_issue_ham';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}

			if (count($_POST['issue_ham']) < 2) {
				$data['inputerror'][] = 'issue_ham[]';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}

			if ($this->input->post('id_kategori_pelaku') == '') {
				$data['inputerror'][] = 'id_kategori_pelaku';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('tgl_kejadian') == '') {
			$data['inputerror'][] = 'tgl_kejadian';
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

		if ($this->input->post('uu_lbh') == '') {
			$data['inputerror'][] = 'uu_lbh';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('uu_lawan') == '') {
			$data['inputerror'][] = 'uu_lawan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('bentuk_kasus') == 'Kelompok') {
			if ($this->input->post('id_penghasilan') == '') {
				$data['inputerror'][] = 'id_penghasilan';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('bentuk_kasus') == '') {
			$data['inputerror'][] = 'bentuk_kasus';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('lk_dewasa') == '') {
			$data['inputerror'][] = 'lk_dewasa';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('pr_dewasa') == '') {
			$data['inputerror'][] = 'pr_dewasa';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('lk_anak') == '') {
			$data['inputerror'][] = 'lk_anak';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('pr_anak') == '') {
			$data['inputerror'][] = 'pr_anak';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}



		if ($this->input->post('id_kategori_korban') == '') {
			$data['inputerror'][] = 'id_kategori_korban';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}



		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}

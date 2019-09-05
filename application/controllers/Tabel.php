<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Tabel extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');	
		$this->load->model('account_model','account');
		$this->load->model('pekerjaan_model','pekerjaan');
		$this->load->model('agama_model','agama');
		$this->load->model('penghasilan_model','penghasilan');
		$this->load->model('pendidikan_model','pendidikan');
		$this->load->model('difabel_model','difabel');
		$this->load->model('sumber_info_model','sumber_info');
		$this->load->model('kasus_model','kasus');
		$this->load->model('alasan_model','alasan');
		$this->load->model('advokat_model','advokat');
		$this->load->model('tahap_progress_model','tahap_progress');
		$this->load->model('hasil_keputusan_model','hasil_keputusan');
		$this->load->model('issue_ham_model','issue_ham');
		$this->load->model('kategori_korban_model','kategori_korban');
		$this->load->model('kategori_pelaku_model','kategori_pelaku');
		$this->load->model('jenis_dokumen_model','jenis_dokumen');
		$this->logged_in();
	}
	
	function logged_in()
	{
		if($this->session->userdata('logged_in'))
        {
			$this->data['csrf_token'] = $this->session->userdata('csrf_token');
			$this->data['username'] = $this->session->userdata('username');
			$account_info = $this->account->get_account_info($this->data['username']);
			foreach ($account_info->result_array() as $row)
			{
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
						
			if($this->data['id_role'] != '1' && $this->data['id_role'] != '2')
			{
				redirect('','refresh');
			}	
		}
		else
		{
			redirect('login','refresh');
		}		
	}
	
	function index()
	{
		//$this->data['page_title'] = 'pekerjaan';
						
		//$this->load->view('main/pekerjaan_list', $this->data);
		redirect('tabel/pekerjaan','refresh');
	}
	
	function pekerjaan()
	{
		$this->data['page_title'] = 'Pekerjaan';
						
		$this->load->view('main/pekerjaan_list', $this->data);
	}
	
	public function ajax_list_pekerjaan()
	{
		$list = $this->pekerjaan->get_datatables();
		$data = array();
		
		foreach ($list as $pekerjaan) 
		{
			$row = array();
			$row[] = $pekerjaan->id_pekerjaan;
			$row[] = $pekerjaan->jenis_pekerjaan;
			$row[] = $pekerjaan->no_urut;
			$row[] = $pekerjaan->insert_date;
			$row[] = $pekerjaan->process_by;
			
			/*
			$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$pekerjaan->id_pekerjaan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
						<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$pekerjaan->id_pekerjaan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$pekerjaan->id_pekerjaan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			*/
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$pekerjaan->id_pekerjaan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$pekerjaan->id_pekerjaan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pekerjaan->count_all(),
						"recordsFiltered" => $this->pekerjaan->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_pekerjaan()
	{
		$this->_validate_pekerjaan();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->pekerjaan->save_detail_pekerjaan($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_pekerjaan($id_pekerjaan)
	{
		$pekerjaan = $this->pekerjaan->get_detail_pekerjaan($id_pekerjaan);
						
		echo json_encode($pekerjaan);
	}
	
	function ajax_update_pekerjaan()
	{
		//$this->_uvalidate_pekerjaan();
		$this->_validate_pekerjaan();
		
		$data = array('jenis_pekerjaan' => $this->input->post('jenis_pekerjaan'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->pekerjaan->update_detail_pekerjaan(array('id_pekerjaan' => $this->input->post('id_pekerjaan')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_pekerjaan($id_pekerjaan)
	{
		$pekerjaan = $this->pekerjaan->view_detail_pekerjaan($id_pekerjaan);
						
		echo json_encode($pekerjaan);
	}
	
	function ajax_delete_pekerjaan()
	{
		$id_pekerjaan = $_POST['id_pekerjaan'];
		$this->pekerjaan->delete_detail_pekerjaan($id_pekerjaan);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_pekerjaan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('jenis_pekerjaan') != '')
		{
			if(!($this->pekerjaan->jenis_pekerjaan_check($this->input->post('jenis_pekerjaan'))))
			{
				$data['inputerror'][] = 'jenis_pekerjaan';
				$data['error_string'][] = 'Jenis Pekerjaan already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'jenis_pekerjaan';
			$data['error_string'][] = 'Jenis Pekerjaan is required';
			$data['status'] = FALSE;
		}		
		*/
		
		if($this->input->post('jenis_pekerjaan') == '')
		{
			$data['inputerror'][] = 'jenis_pekerjaan';
			$data['error_string'][] = 'Jenis Pekerjaan is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_pekerjaan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function agama()
	{
		$this->data['page_title'] = 'Agama';
						
		$this->load->view('main/agama_list', $this->data);
	}
	
	public function ajax_list_agama()
	{
		$list = $this->agama->get_datatables();
		$data = array();
		
		foreach ($list as $agama) 
		{
			$row = array();
			$row[] = $agama->id_agama;
			$row[] = $agama->nm_agama;
			$row[] = $agama->no_urut;
			$row[] = $agama->insert_date;
			$row[] = $agama->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$agama->id_agama."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$agama->id_agama."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->agama->count_all(),
						"recordsFiltered" => $this->agama->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_agama()
	{
		$this->_validate_agama();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'nm_agama' => $this->input->post('nm_agama'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->agama->save_detail_agama($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_agama($id_agama)
	{
		$agama = $this->agama->get_detail_agama($id_agama);
						
		echo json_encode($agama);
	}
	
	function ajax_update_agama()
	{
		//$this->_uvalidate_agama();
		$this->_validate_agama();
		
		$data = array('nm_agama' => $this->input->post('nm_agama'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->agama->update_detail_agama(array('id_agama' => $this->input->post('id_agama')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_agama($id_agama)
	{
		$agama = $this->agama->view_detail_agama($id_agama);
						
		echo json_encode($agama);
	}
	
	function ajax_delete_agama()
	{
		$id_agama = $_POST['id_agama'];
		$this->agama->delete_detail_agama($id_agama);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_agama()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('nm_agama') != '')
		{
			if(!($this->agama->nm_agama_check($this->input->post('nm_agama'))))
			{
				$data['inputerror'][] = 'nm_agama';
				$data['error_string'][] = 'Agama already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'nm_agama';
			$data['error_string'][] = 'Agama is required';
			$data['status'] = FALSE;
		}
		*/
		
		if($this->input->post('nm_agama') == '')
		{
			$data['inputerror'][] = 'nm_agama';
			$data['error_string'][] = 'Agama is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_agama()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
		function pendidikan()
	{
		$this->data['page_title'] = 'Pendidikan';
						
		$this->load->view('main/pendidikan_list', $this->data);
	}
	
	public function ajax_list_pendidikan()
	{
		$list = $this->pendidikan->get_datatables();
		$data = array();
		
		foreach ($list as $pendidikan) 
		{
			$row = array();
			$row[] = $pendidikan->id_pendidikan;
			$row[] = $pendidikan->nm_pendidikan;
			$row[] = $pendidikan->no_urut;
			$row[] = $pendidikan->insert_date;
			$row[] = $pendidikan->process_by;
			
			/*
			$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$pendidikan->id_pendidikan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
						<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$pendidikan->id_pendidikan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$pendidikan->id_pendidikan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			*/
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$pendidikan->id_pendidikan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$pendidikan->id_pendidikan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pendidikan->count_all(),
						"recordsFiltered" => $this->pendidikan->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_pendidikan()
	{
		$this->_validate_pendidikan();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'nm_pendidikan' => $this->input->post('nm_pendidikan'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->pendidikan->save_detail_pendidikan($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_pendidikan($id_pendidikan)
	{
		$pendidikan = $this->pendidikan->get_detail_pendidikan($id_pendidikan);
						
		echo json_encode($pendidikan);
	}
	
	function ajax_update_pendidikan()
	{
		$this->_validate_pendidikan();
		
		$data = array('nm_pendidikan' => $this->input->post('nm_pendidikan'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->pendidikan->update_detail_pendidikan(array('id_pendidikan' => $this->input->post('id_pendidikan')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_pendidikan($id_pendidikan)
	{
		$pendidikan = $this->pendidikan->view_detail_pendidikan($id_pendidikan);
						
		echo json_encode($pendidikan);
	}
	
	function ajax_delete_pendidikan()
	{
		$id_pendidikan = $_POST['id_pendidikan'];
		$this->pendidikan->delete_detail_pendidikan($id_pendidikan);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_pendidikan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('nm_pendidikan') == '')
		{
			$data['inputerror'][] = 'nm_pendidikan';
			$data['error_string'][] = 'Pendidikan is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
		function penghasilan()
	{
		$this->data['page_title'] = 'Penghasilan';
						
		$this->load->view('main/penghasilan_list', $this->data);
	}
	
	public function ajax_list_penghasilan()
	{
		$list = $this->penghasilan->get_datatables();
		$data = array();
		
		foreach ($list as $penghasilan) 
		{
			$row = array();
			$row[] = $penghasilan->id_penghasilan;
			$row[] = $penghasilan->jml_penghasilan;
			$row[] = $penghasilan->no_urut;
			$row[] = $penghasilan->insert_date;
			$row[] = $penghasilan->process_by;
			
			/*
			$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$penghasilan->id_penghasilan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
						<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$penghasilan->id_penghasilan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$penghasilan->id_penghasilan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			*/
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$penghasilan->id_penghasilan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$penghasilan->id_penghasilan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->penghasilan->count_all(),
						"recordsFiltered" => $this->penghasilan->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_penghasilan()
	{
		$this->_validate_penghasilan();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'jml_penghasilan' => $this->input->post('jml_penghasilan'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->penghasilan->save_detail_penghasilan($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_penghasilan($id_penghasilan)
	{
		$penghasilan = $this->penghasilan->get_detail_penghasilan($id_penghasilan);
						
		echo json_encode($penghasilan);
	}
	
	function ajax_update_penghasilan()
	{
		$this->_validate_penghasilan();
		
		$data = array('jml_penghasilan' => $this->input->post('jml_penghasilan'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->penghasilan->update_detail_penghasilan(array('id_penghasilan' => $this->input->post('id_penghasilan')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_penghasilan($id_penghasilan)
	{
		$penghasilan = $this->penghasilan->view_detail_penghasilan($id_penghasilan);
						
		echo json_encode($penghasilan);
	}
	
	function ajax_delete_penghasilan()
	{
		$id_penghasilan = $_POST['id_penghasilan'];
		$this->penghasilan->delete_detail_penghasilan($id_penghasilan);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_penghasilan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('jml_penghasilan') == '')
		{
			$data['inputerror'][] = 'jml_penghasilan';
			$data['error_string'][] = 'Jumlah Penghasilan is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function difabel()
	{
		$this->data['page_title'] = 'Difabel';
						
		$this->load->view('main/difabel_list', $this->data);
	}
	
	public function ajax_list_difabel()
	{
		$list = $this->difabel->get_datatables();
		$data = array();
		
		foreach ($list as $difabel) 
		{
			$row = array();
			$row[] = $difabel->id_difabel;
			$row[] = $difabel->jenis_difabel;
			$row[] = $difabel->no_urut;
			$row[] = $difabel->insert_date;
			$row[] = $difabel->process_by;
			
			/*
			$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$difabel->id_difabel."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
						<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$difabel->id_difabel."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$difabel->id_difabel."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			*/
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$difabel->id_difabel."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$difabel->id_difabel."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->difabel->count_all(),
						"recordsFiltered" => $this->difabel->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_difabel()
	{
		$this->_validate_difabel();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'jenis_difabel' => $this->input->post('jenis_difabel'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->difabel->save_detail_difabel($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_difabel($id_difabel)
	{
		$difabel = $this->difabel->get_detail_difabel($id_difabel);
						
		echo json_encode($difabel);
	}
	
	function ajax_update_difabel()
	{
		$this->_validate_difabel();
		
		$data = array('jenis_difabel' => $this->input->post('jenis_difabel'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->difabel->update_detail_difabel(array('id_difabel' => $this->input->post('id_difabel')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_difabel($id_difabel)
	{
		$difabel = $this->difabel->view_detail_difabel($id_difabel);
						
		echo json_encode($difabel);
	}
	
	function ajax_delete_difabel()
	{
		$id_difabel = $_POST['id_difabel'];
		$this->difabel->delete_detail_difabel($id_difabel);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_difabel()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('jenis_difabel') == '')
		{
			$data['inputerror'][] = 'jenis_difabel';
			$data['error_string'][] = 'Jenis difabel is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function sumber_info()
	{
		$this->data['page_title'] = 'Sumber Informasi Pemohon';
						
		$this->load->view('main/sumber_info_list', $this->data);
	}
	
	public function ajax_list_sumber_info()
	{
		$list = $this->sumber_info->get_datatables();
		$data = array();
		
		foreach ($list as $sumber_info) 
		{
			$row = array();
			$row[] = $sumber_info->id_sumber_info;
			$row[] = $sumber_info->nm_sumber_info;
			$row[] = $sumber_info->no_urut;
			$row[] = $sumber_info->insert_date;
			$row[] = $sumber_info->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$sumber_info->id_sumber_info."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$sumber_info->id_sumber_info."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->sumber_info->count_all(),
						"recordsFiltered" => $this->sumber_info->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_sumber_info()
	{
		$this->_validate_sumber_info();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'nm_sumber_info' => $this->input->post('nm_sumber_info'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->sumber_info->save_detail_sumber_info($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_sumber_info($id_sumber_info)
	{
		$sumber_info = $this->sumber_info->get_detail_sumber_info($id_sumber_info);
						
		echo json_encode($sumber_info);
	}
	
	function ajax_update_sumber_info()
	{
		//$this->_uvalidate_sumber_info();
		$this->_validate_sumber_info();
		
		$data = array('nm_sumber_info' => $this->input->post('nm_sumber_info'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->sumber_info->update_detail_sumber_info(array('id_sumber_info' => $this->input->post('id_sumber_info')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_sumber_info($id_sumber_info)
	{
		$sumber_info = $this->sumber_info->view_detail_sumber_info($id_sumber_info);
						
		echo json_encode($sumber_info);
	}
	
	function ajax_delete_sumber_info()
	{
		$id_sumber_info = $_POST['id_sumber_info'];
		$this->sumber_info->delete_detail_sumber_info($id_sumber_info);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_sumber_info()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('nm_sumber_info') != '')
		{
			if(!($this->sumber_info->nm_sumber_info_check($this->input->post('nm_sumber_info'))))
			{
				$data['inputerror'][] = 'nm_sumber_info';
				$data['error_string'][] = 'Sumber Informasi already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'nm_sumber_info';
			$data['error_string'][] = 'Sumber Informasi is required';
			$data['status'] = FALSE;
		}
		*/

		if($this->input->post('nm_sumber_info') == '')
		{
			$data['inputerror'][] = 'nm_sumber_info';
			$data['error_string'][] = 'Sumber Informasi is required';
			$data['status'] = FALSE;
		}	
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_sumber_info()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	function kasus()
	{
		$this->data['page_title'] = 'Kasus';
		$this->data['jenis_kasus'] = $this->kasus->get_jenis_kasus();
						
		$this->load->view('main/kasus_list', $this->data);
	}
	
	public function ajax_list_kasus()
	{
		$list = $this->kasus->get_datatables();
		$data = array();
		
		foreach ($list as $kasus) 
		{
			$row = array();
			$row[] = $kasus->id_nama_kasus;
			$row[] = $kasus->nama_kasus;
			$row[] = $kasus->jenis_kasus;
			$row[] = $kasus->no_urut;
			$row[] = $kasus->insert_date;
			$row[] = $kasus->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$kasus->id_nama_kasus."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$kasus->id_nama_kasus."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kasus->count_all(),
						"recordsFiltered" => $this->kasus->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_kasus()
	{
		$this->_validate_kasus();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'nama_kasus' => $this->input->post('nama_kasus'),
						  'id_jenis_kasus' => $this->input->post('id_jenis_kasus'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->kasus->save_detail_kasus($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_kasus($id_nama_kasus)
	{
		$kasus = $this->kasus->get_detail_kasus($id_nama_kasus);
						
		echo json_encode($kasus);
	}
	
	function ajax_update_kasus()
	{
		$this->_validate_kasus();
		
		$data = array('nama_kasus' => $this->input->post('nama_kasus'),
					  'id_jenis_kasus' => $this->input->post('id_jenis_kasus'),	
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->kasus->update_detail_kasus(array('id_nama_kasus' => $this->input->post('id_nama_kasus')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_kasus($id_nama_kasus)
	{
		$kasus = $this->kasus->view_detail_kasus($id_nama_kasus);
						
		echo json_encode($kasus);
	}
	
	function ajax_delete_kasus()
	{
		$id_nama_kasus = $_POST['id_nama_kasus'];
		$this->kasus->delete_detail_kasus($id_nama_kasus);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_kasus()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('nama_kasus') == '')
		{
			$data['inputerror'][] = 'nama_kasus';
			$data['error_string'][] = 'Kasus is required';
			$data['status'] = FALSE;
		}	
		
		if($this->input->post('id_jenis_kasus') == '')
		{
			$data['inputerror'][] = 'id_jenis_kasus';
			$data['error_string'][] = 'Jenis Kasus is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function alasan()
	{
		$this->data['page_title'] = 'Alasan Penolakan';
		$this->load->view('main/alasan_list', $this->data);
	}
	
	public function ajax_list_alasan()
	{
		$list = $this->alasan->get_datatables();
		$data = array();
		
		foreach ($list as $alasan) 
		{
			$row = array();
			$row[] = $alasan->id_alasan_penolakan;
			$row[] = $alasan->isi_alasan_penolakan;
			$row[] = $alasan->no_urut;
			$row[] = $alasan->insert_date;
			$row[] = $alasan->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$alasan->id_alasan_penolakan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$alasan->id_alasan_penolakan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->alasan->count_all(),
						"recordsFiltered" => $this->alasan->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_alasan()
	{
		$this->_validate_alasan();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'isi_alasan_penolakan' => $this->input->post('isi_alasan_penolakan'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->alasan->save_detail_alasan($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_alasan($id_alasan_penolakan)
	{
		$alasan = $this->alasan->get_detail_alasan($id_alasan_penolakan);
						
		echo json_encode($alasan);
	}
	
	function ajax_update_alasan()
	{
		$this->_validate_alasan();
		
		$data = array('isi_alasan_penolakan' => $this->input->post('isi_alasan_penolakan'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->alasan->update_detail_alasan(array('id_alasan_penolakan' => $this->input->post('id_alasan_penolakan')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_alasan($id_alasan_penolakan)
	{
		$alasan = $this->alasan->view_detail_alasan($id_alasan_penolakan);
						
		echo json_encode($alasan);
	}
	
	function ajax_delete_alasan()
	{
		$id_alasan_penolakan = $_POST['id_alasan_penolakan'];
		$this->alasan->delete_detail_alasan($id_alasan_penolakan);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_alasan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('isi_alasan_penolakan') == '')
		{
			$data['inputerror'][] = 'isi_alasan_penolakan';
			$data['error_string'][] = 'Alasan Penolakan is required';
			$data['status'] = FALSE;
		}	
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function advokat()
	{
		$this->data['page_title'] = 'Advokat';
		$this->load->view('main/advokat_list', $this->data);
	}
	
	public function ajax_list_advokat()
	{
		$list = $this->advokat->get_datatables();
		$data = array();
		
		foreach ($list as $advokat) 
		{
			$row = array();
			$row[] = $advokat->id_advokat;
			$row[] = $advokat->nama_advokat;
			$row[] = $advokat->alamat_advokat;
			$row[] = $advokat->telp_advokat;
			$row[] = $advokat->insert_date;
			$row[] = $advokat->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$advokat->id_advokat."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$advokat->id_advokat."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->advokat->count_all(),
						"recordsFiltered" => $this->advokat->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_advokat()
	{
		$this->_validate_advokat();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'nama_advokat' => $this->input->post('nama_advokat'),
						  'alamat_advokat' => $this->input->post('alamat_advokat'),
						  'telp_advokat' => $this->input->post('telp_advokat'),
						  'fax_advokat' => $this->input->post('fax_advokat')
			);
			
			$insert = $this->advokat->save_detail_advokat($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_advokat($id_advokat)
	{
		$advokat = $this->advokat->get_detail_advokat($id_advokat);
						
		echo json_encode($advokat);
	}
	
	function ajax_update_advokat()
	{
		$this->_validate_advokat();
		
		$data = array('nama_advokat' => $this->input->post('nama_advokat'),
					  'alamat_advokat' => $this->input->post('alamat_advokat'),
					  'telp_advokat' => $this->input->post('telp_advokat'),
					  'fax_advokat' => $this->input->post('fax_advokat'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->advokat->update_detail_advokat(array('id_advokat' => $this->input->post('id_advokat')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_advokat($id_advokat)
	{
		$advokat = $this->advokat->view_detail_advokat($id_advokat);
						
		echo json_encode($advokat);
	}
	
	function ajax_delete_advokat()
	{
		$id_advokat = $_POST['id_advokat'];
		$this->advokat->delete_detail_advokat($id_advokat);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_advokat()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('nama_advokat') == '')
		{
			$data['inputerror'][] = 'nama_advokat';
			$data['error_string'][] = 'Nama Advokat is required';
			$data['status'] = FALSE;
		}	
		
		if($this->input->post('alamat_advokat') == '')
		{
			$data['inputerror'][] = 'alamat_advokat';
			$data['error_string'][] = 'Alamat Advokat is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('telp_advokat') == '')
		{
			$data['inputerror'][] = 'telp_advokat';
			$data['error_string'][] = 'Telp Advokat is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function tahap_perkembangan()
	{
		$this->data['page_title'] = 'Tahap Perkembangan';
		$this->load->view('main/tahap_progress_list', $this->data);
	}
	
	public function ajax_list_tahap_progress()
	{
		$list = $this->tahap_progress->get_datatables();
		$data = array();
		
		foreach ($list as $tahap_progress) 
		{
			$row = array();
			$row[] = $tahap_progress->id_tahap_progress;
			$row[] = $tahap_progress->tahap_progress;
			$row[] = $tahap_progress->no_urut;
			$row[] = $tahap_progress->insert_date;
			$row[] = $tahap_progress->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$tahap_progress->id_tahap_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$tahap_progress->id_tahap_progress."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tahap_progress->count_all(),
						"recordsFiltered" => $this->tahap_progress->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_tahap_progress()
	{
		$this->_validate_tahap_progress();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'tahap_progress' => $this->input->post('tahap_progress'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->tahap_progress->save_detail_tahap_progress($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_tahap_progress($id_tahap_progress)
	{
		$tahap_progress = $this->tahap_progress->get_detail_tahap_progress($id_tahap_progress);
						
		echo json_encode($tahap_progress);
	}
	
	function ajax_update_tahap_progress()
	{
		//$this->_uvalidate_tahap_progress();
		$this->_validate_tahap_progress();
		
		$data = array('tahap_progress' => $this->input->post('tahap_progress'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->tahap_progress->update_detail_tahap_progress(array('id_tahap_progress' => $this->input->post('id_tahap_progress')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_tahap_progress($id_tahap_progress)
	{
		$tahap_progress = $this->tahap_progress->view_detail_tahap_progress($id_tahap_progress);
						
		echo json_encode($tahap_progress);
	}
	
	function ajax_delete_tahap_progress()
	{
		$id_tahap_progress = $_POST['id_tahap_progress'];
		$this->tahap_progress->delete_detail_tahap_progress($id_tahap_progress);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_tahap_progress()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('tahap_progress') != '')
		{
			if(!($this->tahap_progress->tahap_progress_check($this->input->post('tahap_progress'))))
			{
				$data['inputerror'][] = 'tahap_progress';
				$data['error_string'][] = 'Tahap Perkembangan already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'tahap_progress';
			$data['error_string'][] = 'Tahap Perkembangan is required';
			$data['status'] = FALSE;
		}
		*/

		if($this->input->post('tahap_progress') == '')
		{
			$data['inputerror'][] = 'tahap_progress';
			$data['error_string'][] = 'Tahap Perkembangan is required';
			$data['status'] = FALSE;
		}	
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_tahap_progress()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function hasil_keputusan()
	{
		$this->data['page_title'] = 'Hasil Keputusan';
		$this->data['jenis_kasus_hasil'] = $this->hasil_keputusan->get_jenis_kasus();
		$this->load->view('main/hasil_keputusan_list', $this->data);
	}
	
	public function ajax_list_hasil_keputusan()
	{
		$list = $this->hasil_keputusan->get_datatables();
		$data = array();
		
		foreach ($list as $hasil_keputusan) 
		{
			$row = array();
			$row[] = $hasil_keputusan->id_hasil_keputusan;
			$row[] = $hasil_keputusan->hasil_keputusan;
			$row[] = $hasil_keputusan->no_urut;
			$row[] = $hasil_keputusan->insert_date;
			$row[] = $hasil_keputusan->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$hasil_keputusan->id_hasil_keputusan."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$hasil_keputusan->id_hasil_keputusan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->hasil_keputusan->count_all(),
						"recordsFiltered" => $this->hasil_keputusan->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_hasil_keputusan()
	{
		$this->_validate_hasil_keputusan();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'hasil_keputusan' => $this->input->post('hasil_keputusan'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->hasil_keputusan->save_detail_hasil_keputusan($data);
			
			$id_hasil_keputusan = $insert;
			$id_jenis_kasus = $_POST['id_jenis_kasus_hasil'];
			
			$insert = $this->hasil_keputusan->save_detail_jenis_kasus($id_hasil_keputusan, $id_jenis_kasus);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_hasil_keputusan($id_hasil_keputusan)
	{
		$hasil_keputusan = $this->hasil_keputusan->get_detail_hasil_keputusan($id_hasil_keputusan);
		$jenis_kasus = $this->hasil_keputusan->get_detail_jenis_kasus($hasil_keputusan->id_hasil_keputusan);
						
		echo json_encode(array($hasil_keputusan, $jenis_kasus));
	}
	
	function ajax_update_hasil_keputusan()
	{
		//$this->_uvalidate_hasil_keputusan();
		$this->_validate_hasil_keputusan();
		
		$data = array('hasil_keputusan' => $this->input->post('hasil_keputusan'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		$this->hasil_keputusan->update_detail_hasil_keputusan(array('id_hasil_keputusan' => $this->input->post('id_hasil_keputusan')), $data);
		
		$id_hasil_keputusan = $this->input->post('id_hasil_keputusan');
		$id_jenis_kasus = $_POST['id_jenis_kasus_hasil'];
		$delete = $this->hasil_keputusan->delete_detail_jenis_kasus($id_hasil_keputusan);
		$insert = $this->hasil_keputusan->save_detail_jenis_kasus($id_hasil_keputusan, $id_jenis_kasus);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_hasil_keputusan($id_hasil_keputusan)
	{
		$hasil_keputusan = $this->hasil_keputusan->view_detail_hasil_keputusan($id_hasil_keputusan);
						
		echo json_encode($hasil_keputusan);
	}
	
	function ajax_delete_hasil_keputusan()
	{
		$id_hasil_keputusan = $_POST['id_hasil_keputusan'];
		$this->hasil_keputusan->delete_detail_hasil_keputusan($id_hasil_keputusan);
		$this->hasil_keputusan->delete_detail_jenis_kasus($id_hasil_keputusan);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_hasil_keputusan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('hasil_keputusan') != '')
		{
			if(!($this->hasil_keputusan->hasil_keputusan_check($this->input->post('hasil_keputusan'))))
			{
				$data['inputerror'][] = 'hasil_keputusan';
				$data['error_string'][] = 'Tahap Perkembangan already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'hasil_keputusan';
			$data['error_string'][] = 'Tahap Perkembangan is required';
			$data['status'] = FALSE;
		}
		*/
		
		if($this->input->post('hasil_keputusan') == '')
		{
			$data['inputerror'][] = 'hasil_keputusan';
			$data['error_string'][] = 'Tahap Perkembangan is required';
			$data['status'] = FALSE;
		}			
		
		if(count($_POST['id_jenis_kasus_hasil']) < 2)	
		{
			$data['inputerror'][] = 'id_jenis_kasus_hasil[]';
			//$data['error_string'][] = 'Jenis Kasus is required';
			$data['status'] = FALSE;
		}
			
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_hasil_keputusan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if(count($_POST['id_jenis_kasus_hasil']) < 2)	
		{
			$data['inputerror'][] = 'id_jenis_kasus_hasil[]';
			//$data['error_string'][] = 'Jenis Kasus is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function issue_ham()
	{
		$this->data['page_title'] = 'Issue HAM';
		$this->load->view('main/issue_ham_list', $this->data);
	}
	
	public function ajax_list_issue_ham()
	{
		$list = $this->issue_ham->get_datatables();
		$data = array();
		
		foreach ($list as $issue_ham) 
		{
			$row = array();
			$row[] = $issue_ham->id_issue_ham;
			$row[] = $issue_ham->issue_ham;
			$row[] = $issue_ham->no_urut;
			$row[] = $issue_ham->insert_date;
			$row[] = $issue_ham->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$issue_ham->id_issue_ham."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$issue_ham->id_issue_ham."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->issue_ham->count_all(),
						"recordsFiltered" => $this->issue_ham->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_issue_ham()
	{
		$this->_validate_issue_ham();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'issue_ham' => $this->input->post('issue_ham'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->issue_ham->save_detail_issue_ham($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_issue_ham($id_issue_ham)
	{
		$issue_ham = $this->issue_ham->get_detail_issue_ham($id_issue_ham);
						
		echo json_encode($issue_ham);
	}
	
	function ajax_update_issue_ham()
	{
		//$this->_uvalidate_issue_ham();
		$this->_validate_issue_ham();
		
		$data = array('issue_ham' => $this->input->post('issue_ham'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->issue_ham->update_detail_issue_ham(array('id_issue_ham' => $this->input->post('id_issue_ham')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_issue_ham($id_issue_ham)
	{
		$issue_ham = $this->issue_ham->view_detail_issue_ham($id_issue_ham);
						
		echo json_encode($issue_ham);
	}
	
	function ajax_delete_issue_ham()
	{
		$id_issue_ham = $_POST['id_issue_ham'];
		$this->issue_ham->delete_detail_issue_ham($id_issue_ham);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_issue_ham()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('issue_ham') != '')
		{
			if(!($this->issue_ham->issue_ham_check($this->input->post('issue_ham'))))
			{
				$data['inputerror'][] = 'issue_ham';
				$data['error_string'][] = 'Issue HAM already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'issue_ham';
			$data['error_string'][] = 'Issue HAM is required';
			$data['status'] = FALSE;
		}
		*/
		
		if($this->input->post('issue_ham') == '')
		{
			$data['inputerror'][] = 'issue_ham';
			$data['error_string'][] = 'Issue HAM is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_issue_ham()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function kategori_korban()
	{
		$this->data['page_title'] = 'Kategori Korban';
		$this->load->view('main/kategori_korban_list', $this->data);
	}
	
	public function ajax_list_kategori_korban()
	{
		$list = $this->kategori_korban->get_datatables();
		$data = array();
		
		foreach ($list as $kategori_korban) 
		{
			$row = array();
			$row[] = $kategori_korban->id_kategori_korban;
			$row[] = $kategori_korban->kategori_korban;
			$row[] = $kategori_korban->no_urut;
			$row[] = $kategori_korban->insert_date;
			$row[] = $kategori_korban->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$kategori_korban->id_kategori_korban."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$kategori_korban->id_kategori_korban."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategori_korban->count_all(),
						"recordsFiltered" => $this->kategori_korban->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_kategori_korban()
	{
		$this->_validate_kategori_korban();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'kategori_korban' => $this->input->post('kategori_korban'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->kategori_korban->save_detail_kategori_korban($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_kategori_korban($id_kategori_korban)
	{
		$kategori_korban = $this->kategori_korban->get_detail_kategori_korban($id_kategori_korban);
						
		echo json_encode($kategori_korban);
	}
	
	function ajax_update_kategori_korban()
	{
		//$this->_uvalidate_kategori_korban();
		$this->_validate_kategori_korban();
		
		$data = array('kategori_korban' => $this->input->post('kategori_korban'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->kategori_korban->update_detail_kategori_korban(array('id_kategori_korban' => $this->input->post('id_kategori_korban')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_kategori_korban($id_kategori_korban)
	{
		$kategori_korban = $this->kategori_korban->view_detail_kategori_korban($id_kategori_korban);
						
		echo json_encode($kategori_korban);
	}
	
	function ajax_delete_kategori_korban()
	{
		$id_kategori_korban = $_POST['id_kategori_korban'];
		$this->kategori_korban->delete_detail_kategori_korban($id_kategori_korban);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_kategori_korban()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('kategori_korban') != '')
		{
			if(!($this->kategori_korban->kategori_korban_check($this->input->post('kategori_korban'))))
			{
				$data['inputerror'][] = 'kategori_korban';
				$data['error_string'][] = 'Kategori Korban already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'kategori_korban';
			$data['error_string'][] = 'Kategori Korban is required';
			$data['status'] = FALSE;
		}			
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		*/
		
		if($this->input->post('kategori_korban') == '')
		{
			$data['inputerror'][] = 'kategori_korban';
			$data['error_string'][] = 'Kategori Korban is required';
			$data['status'] = FALSE;
		}			
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_kategori_korban()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function kategori_pelaku()
	{
		$this->data['page_title'] = 'Kategori Pelaku';
		$this->load->view('main/kategori_pelaku_list', $this->data);
	}
	
	public function ajax_list_kategori_pelaku()
	{
		$list = $this->kategori_pelaku->get_datatables();
		$data = array();
		
		foreach ($list as $kategori_pelaku) 
		{
			$row = array();
			$row[] = $kategori_pelaku->id_kategori_pelaku;
			$row[] = $kategori_pelaku->kategori_pelaku;
			$row[] = $kategori_pelaku->no_urut;
			$row[] = $kategori_pelaku->insert_date;
			$row[] = $kategori_pelaku->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$kategori_pelaku->id_kategori_pelaku."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$kategori_pelaku->id_kategori_pelaku."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategori_pelaku->count_all(),
						"recordsFiltered" => $this->kategori_pelaku->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_kategori_pelaku()
	{
		$this->_validate_kategori_pelaku();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'kategori_pelaku' => $this->input->post('kategori_pelaku'),
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->kategori_pelaku->save_detail_kategori_pelaku($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_kategori_pelaku($id_kategori_pelaku)
	{
		$kategori_pelaku = $this->kategori_pelaku->get_detail_kategori_pelaku($id_kategori_pelaku);
						
		echo json_encode($kategori_pelaku);
	}
	
	function ajax_update_kategori_pelaku()
	{
		//$this->_uvalidate_kategori_pelaku();
		$this->_validate_kategori_pelaku();
		
		$data = array('kategori_pelaku' => $this->input->post('kategori_pelaku'),
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->kategori_pelaku->update_detail_kategori_pelaku(array('id_kategori_pelaku' => $this->input->post('id_kategori_pelaku')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_kategori_pelaku($id_kategori_pelaku)
	{
		$kategori_pelaku = $this->kategori_pelaku->view_detail_kategori_pelaku($id_kategori_pelaku);
						
		echo json_encode($kategori_pelaku);
	}
	
	function ajax_delete_kategori_pelaku()
	{
		$id_kategori_pelaku = $_POST['id_kategori_pelaku'];
		$this->kategori_pelaku->delete_detail_kategori_pelaku($id_kategori_pelaku);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_kategori_pelaku()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('kategori_pelaku') != '')
		{
			if(!($this->kategori_pelaku->kategori_pelaku_check($this->input->post('kategori_pelaku'))))
			{
				$data['inputerror'][] = 'kategori_pelaku';
				$data['error_string'][] = 'Kategori Pelaku already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'kategori_pelaku';
			$data['error_string'][] = 'Kategori Pelaku is required';
			$data['status'] = FALSE;
		}			
		*/
		
		if($this->input->post('kategori_pelaku') == '')
		{
			$data['inputerror'][] = 'kategori_pelaku';
			$data['error_string'][] = 'Kategori Pelaku is required';
			$data['status'] = FALSE;
		}			
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_kategori_pelaku()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function jenis_dokumen()
	{
		$this->data['page_title'] = 'Jenis Dokumen';
		$this->load->view('main/jenis_dokumen_list', $this->data);
	}
	
	public function ajax_list_jenis_dokumen()
	{
		$list = $this->jenis_dokumen->get_datatables();
		$data = array();
		
		foreach ($list as $jenis_dokumen) 
		{
			$row = array();
			$row[] = $jenis_dokumen->id_jenis_dokumen;
			$row[] = $jenis_dokumen->jenis_dokumen;
			$row[] = $jenis_dokumen->no_urut;
			$row[] = $jenis_dokumen->insert_date;
			$row[] = $jenis_dokumen->process_by;
			
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$jenis_dokumen->id_jenis_dokumen."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$jenis_dokumen->id_jenis_dokumen."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jenis_dokumen->count_all(),
						"recordsFiltered" => $this->jenis_dokumen->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function ajax_save_jenis_dokumen()
	{
		$this->_validate_jenis_dokumen();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$data = array('insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'jenis_dokumen' => $this->input->post('jenis_dokumen'),
						  'id_section_process' => '4',
						  'no_urut' => $this->input->post('no_urut')
			);
			
			$insert = $this->jenis_dokumen->save_detail_jenis_dokumen($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_jenis_dokumen($id_jenis_dokumen)
	{
		$jenis_dokumen = $this->jenis_dokumen->get_detail_jenis_dokumen($id_jenis_dokumen);
						
		echo json_encode($jenis_dokumen);
	}
	
	function ajax_update_jenis_dokumen()
	{
		//$this->_uvalidate_jenis_dokumen();
		$this->_validate_jenis_dokumen();
		
		$data = array('jenis_dokumen' => $this->input->post('jenis_dokumen'),
					  'id_section_process' => '4',
					  'no_urut' => $this->input->post('no_urut'),
					  'update_date' => date('Y-m-d H:i:s'),
					  'update_by' => $this->data['id_user']
		);
		
		
		$this->jenis_dokumen->update_detail_jenis_dokumen(array('id_jenis_dokumen' => $this->input->post('id_jenis_dokumen')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_jenis_dokumen($id_jenis_dokumen)
	{
		$jenis_dokumen = $this->jenis_dokumen->view_detail_jenis_dokumen($id_jenis_dokumen);
						
		echo json_encode($jenis_dokumen);
	}
	
	function ajax_delete_jenis_dokumen()
	{
		$id_jenis_dokumen = $_POST['id_jenis_dokumen'];
		$this->jenis_dokumen->delete_detail_jenis_dokumen($id_jenis_dokumen);
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_jenis_dokumen()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		/*
		if($this->input->post('jenis_dokumen') != '')
		{
			if(!($this->jenis_dokumen->jenis_dokumen_check($this->input->post('jenis_dokumen'))))
			{
				$data['inputerror'][] = 'jenis_dokumen';
				$data['error_string'][] = 'Jenis Dokumen already exist';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'jenis_dokumen';
			$data['error_string'][] = 'Jenis Dokumen is required';
			$data['status'] = FALSE;
		}			
		*/
		
		if($this->input->post('jenis_dokumen') == '')
		{
			$data['inputerror'][] = 'jenis_dokumen';
			$data['error_string'][] = 'Jenis Dokumen is required';
			$data['status'] = FALSE;
		}			
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _uvalidate_jenis_dokumen()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('no_urut') == '')
		{
			$data['inputerror'][] = 'no_urut';
			$data['error_string'][] = 'Nomor Urut is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
			
}
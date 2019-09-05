<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Approval extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');	
		$this->load->model('account_model','account');
		$this->load->model('approval_model','approval');
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
		}
		else
		{
			redirect('login','refresh');
		}		
	}
	
	function index()
	{
		$this->data['page_title'] = 'Approval';
		$this->data['permohonan'] = array('' => '');
		$this->data['jenis_kasus'] = $this->approval->get_jenis_kasus();
		$this->data['nama_kasus'] = array('' => '');
		$this->data['posisi_hukum'] = array('' => '');
		$this->data['status_approval'] = $this->approval->get_status_approval();
		$this->data['status_rekomendasi'] = $this->approval->get_status_rekomendasi();
		$this->data['advokat'] = $this->approval->get_advokat();
		$this->data['tindakan'] = $this->approval->get_tindakan();
		$this->data['alasan_penolakan'] = $this->approval->get_alasan_penolakan();
		$this->data['analis'] = $this->approval->get_analis();
		$this->data['asisten'] = $this->approval->get_asisten();
		
		$this->load->view('main/approval_list', $this->data);
	}
	
	public function ajax_list()
	{
		$list = $this->approval->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $approval) {
			//$no++;
			$row = array();
			$row[] = $approval->id_approval;
			$row[] = $approval->no_reg;
			$row[] = $approval->tgl_approval;
			$row[] = $approval->status_approval;
			$row[] = $approval->jenis_kasus;
			$row[] = $approval->jenis_tindakan;
			$row[] = $approval->nm_analis;
			$row[] = $approval->nm_asisten;
			$row[] = $approval->nm_processby;
			
			if($approval->case_status == '1')
			{
				if($this->data['id_role'] == '1')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$approval->id_permohonan."'".','."'".$this->data['id_role']."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			
					$data[] = $row;
				}
				else if($this->data['id_role'] == '2')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$approval->id_permohonan."'".','."'".$this->data['id_role']."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
					
					$data[] = $row;
					
				}
				else if($this->data['id_role'] == '3')
				{
					if($this->data['id_user'] == $approval->id_processby)
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$approval->id_permohonan."'".','."'".$this->data['id_role']."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
				
						$data[] = $row;
					}
					else
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>';
				
						$data[] = $row;
					}		
				}
				else if($this->data['id_role'] == '7')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
				
					$data[] = $row;
					
				}
				else
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>';
			
					$data[] = $row;
				}		
			}
			else
			{
				if($this->data['id_role'] == '1')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$approval->id_permohonan."'".','."'".$this->data['id_role']."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			
					$data[] = $row;
				}
				else if($this->data['id_role'] == '2')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$approval->id_permohonan."'".','."'".$this->data['id_role']."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
			
					$data[] = $row;
				}
				else if($this->data['id_role'] == '3')
				{
					if($this->data['id_user'] == $approval->id_processby)
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
									<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
				
						$data[] = $row;
					}
					else
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>';
				
						$data[] = $row;
					}		
				}
				else if($this->data['id_role'] == '7')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$approval->id_approval."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
				
					$data[] = $row;
					
				}
				else
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Surat Persetujuan/Penolakan" onclick="pdf_approval('."'".$approval->id_permohonan."'".')"><i class="glyphicon glyphicon-file"></i></a>';
			
					$data[] = $row;
				}		
			}		
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->approval->count_all(),
						"recordsFiltered" => $this->approval->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	
	function get_nama_kasus($id_jenis_kasus)
	{
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->approval->get_nama_kasus_by_id_jenis_kasus($id_jenis_kasus)));
	}
	
	
	function get_posisi_hukum($id_jenis_kasus)
	{
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->approval->get_posisi_hukum_by_id_jenis_kasus($id_jenis_kasus)));
	}
	
	function ajax_new()
	{
		if($this->session->userdata('logged_in'))
        {	
			if($_GET['type'] == 'approval')
			{
				$data = array('id_approval' => '',
							  'id_permohonan' => '',
							  'id_jenis_kasus' => '',
							  'id_nama_kasus' => '',
							  'id_posisi_hukum' => '',
							  'id_tindakan' => '',
							  'id_analis' => '',
							  'id_asisten' => '',
							  'status_approval' => '',
							  'alasan_penolakan' => '',
							  'desc_lain' => '',
							  'status_rekomendasi' => '',
							  'id_advokat' => '',
							  'alasan_rekomendasi' => ''
				);
				
				$permohonan = $this->approval->get_approval_add();
			}
			echo json_encode(array($data, $permohonan));
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}	
	}
	
	function ajax_save()
	{
		if($this->session->userdata('logged_in'))
        {
			$this->_validate();
			
			if($_POST['csrf_token'] == $this->data['csrf_token'])
			{	
						
				if($this->input->post('status_approval') == 'Ditolak')
				{
					$case_status = '2';
					$id_permohonan = $this->input->post('id_permohonan');
					$alasan_penolakan = $_POST['alasan_penolakan'];
					$this->approval->save_detail_alasan_penolakan($id_permohonan, $alasan_penolakan);
				}
				else
				{
					$case_status = '1';
					$now = date('Y-m-d');
					
					/*progress schedule*/
					$date_schedule = date('Y-m-d', strtotime($now. '+1 week'));
					$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
											'date_schedule' => $date_schedule
					);
					
					$this->approval->save_progress_schedule($schedule_data);
					
					/*analisis schedule*/
					$date_schedule = date('Y-m-d', strtotime($now. '+1 week'));
					$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
											'date_schedule' => $date_schedule
					);
						
					$this->approval->save_analisis_schedule($schedule_data);
					
					//approval schedule
					$date_schedule = $now;
					$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
											'date_schedule' => $date_schedule
					);
					
					$this->approval->save_approval_schedule($schedule_data);
					
				}	
				
				$approval = $this->approval->get_id_approval();
				
				$data = array('id_approval' => $approval['id_approval'],
							  'id_permohonan' => $this->input->post('id_permohonan'),
							  'insert_date' => date('Y-m-d H:i:s'),
							  'insert_by' => $this->data['id_user'],
							  'update_date' => '0000-00-00 00:00:00',
							  'update_by' => '0',
							  'nomor' => $approval['nomor'],
							  'status_approval' => $this->input->post('status_approval'),
							  'id_jenis_kasus' => $this->input->post('id_jenis_kasus'),
							  'id_nama_kasus' => $this->input->post('id_nama_kasus'),
							  'id_posisi_hukum' => $this->input->post('id_posisi_hukum'),
							  'id_tindakan' => $this->input->post('id_tindakan'),
							  'id_analis' => $this->input->post('id_analis'),
							  'id_asisten' => $this->input->post('id_asisten'),
							  'desc_lain' => $this->input->post('desc_lain'),
							  'status_rekomendasi' => $this->input->post('status_rekomendasi'),
							  'id_advokat' => $this->input->post('id_advokat'),
							  'alasan_rekomendasi' => $this->input->post('alasan_rekomendasi'),
							  'case_status' => $case_status
				);
				
				$insert = $this->approval->save_detail_approval($data);
				
				if($this->input->post('status_approval') == 'Ditolak')
				{
					$permohonan = array('status_permohonan' => '2', 'id_analis_kasus' => $this->input->post('id_analis'));
				}
				else
				{
					$permohonan = array('status_permohonan' => '1', 'id_analis_kasus' => $this->input->post('id_analis'));
				}	
						
				$this->approval->update_permohonan(array('id_permohonan' => $this->input->post('id_permohonan')), $permohonan);	
				
				echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
			}
			else
			{
				echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
			}
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}	
	}
	
	function get_detail_approval($id_permohonan)
	{
		if($this->session->userdata('logged_in'))
        {
			$approval = $this->approval->get_detail_approval($id_permohonan);
			$permohonan = $this->approval->get_approval_edit($approval->id_permohonan);
			$nama_kasus = $this->approval->get_nama_kasus_by_id_jenis_kasus($approval->id_jenis_kasus);
			$posisi_hukum = $this->approval->get_posisi_hukum_by_id_jenis_kasus($approval->id_jenis_kasus);
			
			if($approval->status_approval == 'Ditolak')
			{	
				$alasan_penolakan = $this->approval->get_detail_alasan_penolakan($approval->id_permohonan);
			}
			else
			{
				$alasan_penolakan = '';	
			}
			
			echo json_encode(array($approval, $permohonan, $nama_kasus ,$posisi_hukum, $alasan_penolakan));
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}		
	}

	function ajax_update()
	{
		if($this->session->userdata('logged_in'))
        {
			$this->_validate();
			
			if($this->input->post('status_approval') == 'Ditolak')
			{
				$case_status = '2';
				$id_permohonan = $this->input->post('id_permohonan');
				$alasan_penolakan = $_POST['alasan_penolakan'];
				$this->approval->delete_detail_alasan_penolakan($id_permohonan);
				$this->approval->save_detail_alasan_penolakan($id_permohonan, $alasan_penolakan);
				$this->approval->delete_schedule($id_permohonan);
			}
			else
			{
				$case_status = '1';
				$id_permohonan = $this->input->post('id_permohonan');
				$this->approval->delete_detail_alasan_penolakan($id_permohonan);
				
				$now = date('Y-m-d');
				
				//progress schedule
				$status_progress = $this->approval->check_status_progress($id_permohonan);
				if($status_progress == FALSE)
				{
					$this->approval->delete_progress_schedule($id_permohonan);
					
					$date_schedule = date('Y-m-d', strtotime($now. '+1 week'));
					$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
											'date_schedule' => $date_schedule
					);
					
					$this->approval->save_progress_schedule($schedule_data);
				}
				
				//analisis schedule
				$status_analisis = $this->approval->check_status_analisis($id_permohonan);
				if($status_analisis == FALSE)
				{
					$this->approval->delete_analisis_schedule($id_permohonan);
					
					$date_schedule = date('Y-m-d', strtotime($now. '+1 week'));
					$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
										'date_schedule' => $date_schedule
					);
					
					$this->approval->save_analisis_schedule($schedule_data);	
				}	
				
				//approval schedule
				if($status_progress == FALSE || $status_analisis == FALSE)
				{
					$this->approval->delete_approval_schedule($id_permohonan);
					
					$date_schedule = $now;
					$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
											'date_schedule' => $date_schedule
					);
					
					$this->approval->save_approval_schedule($schedule_data);
				}
			}	
			
			$data = array('id_approval' => $this->input->post('id_approval'),
						  'update_date' => date('Y-m-d H:i:s'),
						  'update_by' => $this->data['id_user'],
						  'status_approval' => $this->input->post('status_approval'),
						  'id_jenis_kasus' => $this->input->post('id_jenis_kasus'),
						  'id_nama_kasus' => $this->input->post('id_nama_kasus'),
						  'id_posisi_hukum' => $this->input->post('id_posisi_hukum'),
						  'id_tindakan' => $this->input->post('id_tindakan'),
						  'id_analis' => $this->input->post('id_analis'),
						  'id_asisten' => $this->input->post('id_asisten'),
						  'desc_lain' => $this->input->post('desc_lain'),
						  'status_rekomendasi' => $this->input->post('status_rekomendasi'),
						  'id_advokat' => $this->input->post('id_advokat'),
						  'alasan_rekomendasi' => $this->input->post('alasan_rekomendasi'),
						  'case_status' => $case_status
			);
					
			$this->approval->update_detail_approval(array('id_permohonan' => $this->input->post('id_permohonan')), $data);
			
			if($this->input->post('status_approval') == 'Ditolak')
			{
				$permohonan = array('status_permohonan' => '2', 'id_analis_kasus' => $this->input->post('id_analis'));
			}
			else
			{
				$permohonan = array('status_permohonan' => '1', 'id_analis_kasus' => $this->input->post('id_analis'));
			}
			
			$this->approval->update_permohonan(array('id_permohonan' => $this->input->post('id_permohonan')), $permohonan);		
			
			echo json_encode(array("status" => TRUE));	
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}			
	}	
	
	function view_detail_approval($id_permohonan)
	{
		if($this->session->userdata('logged_in'))
        {
			$approval = $this->approval->view_detail_approval($id_permohonan);
			if($approval->status_approval == 'Ditolak')
			{
				$alasan_penolakan = $this->approval->view_alasan_penolakan($approval->id_permohonan);
			}
			else
			{
				$alasan_penolakan = array('' => '');
			}		
			
			echo json_encode(array($approval, $alasan_penolakan));
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}		
	}
	
	function ajax_delete()
	{
		$id_permohonan = $_POST['id_permohonan'];
		$this->approval->delete_attachment_approval($this->approval->get_id_approval_by_id_permohonan($id_permohonan));
		$this->approval->delete_detail_approval($id_permohonan);
		$this->approval->delete_detail_alasan_penolakan($id_permohonan);
		$this->approval->delete_schedule($id_permohonan);
		
		$permohonan = array('status_permohonan' => '0',
							'id_analis_kasus' => '0'
		);
		
		$this->approval->update_permohonan(array('id_permohonan' => $id_permohonan), $permohonan);
		
		echo json_encode(array("status" => TRUE));
	}
	
	function get_file_approval($id_approval)
	{
		$id_process = $id_approval;
		
		$id_section_process = '3';
		$id_jenis_dokumen = '4';
		$file_list = $this->approval->get_detail_file_attachment($id_section_process, $id_process, $id_jenis_dokumen);
		
		if($file_list->num_rows() > 0)
		{
			foreach ($file_list->result() as $row)
			{
				$detail_file[] = array('link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file('."'".$row->id_file."'".')" title="Download">'.$row->nm_baru.'</a><a id="'.$row->id_file.'" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',	
									   'id_file' => $row->id_file,
									   'fileuploaded' => $row->nm_file,
									   'filename' => $row->nm_asli,
									   'nm_baru' => $row->nm_baru,
									   'status' => TRUE
				);
			}
			
			
			$file_attachment = $detail_file;
		}
		else
		{
			$file_attachment = array('' => '');
		}	
		
		echo json_encode($file_attachment);
	}
	
	function ajax_upload_approval()
	{
			
		$file_lampiran = sizeof($_FILES['lampiran']['tmp_name']);
		
		$files = $_FILES['lampiran'];
		
		for ($i = 0; $i < $file_lampiran; $i++)
		{
			
			$_FILES['lampiran']['name'] = $files['name'][$i];
			$_FILES['lampiran']['type'] = $files['type'][$i];
			$_FILES['lampiran']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['lampiran']['error'] = $files['error'][$i];
			$_FILES['lampiran']['size'] = $files['size'][$i];
			
			
			$this->load->library('upload');
			$config = array(
				'encrypt_name' 	=> TRUE,
				'allowed_types' => 'jpg|jpeg|png|pdf',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);
			
			$this->upload->initialize($config);
			if ($this->upload->do_upload('lampiran'))
			{
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];
			
				$source = './tmp_upload/'.$filename;
				$destination = 'media/files_approval';
				copy($source, './'.$destination.'/'.$filename);
				@unlink('./tmp_upload/'.$filename);
				$img1 = $destination.'/'.$filename;
				
				$data_file = array( 'upload_by' => $this->data['id_user'],
									'upload_date' => date('Y-m-d H:i:s'),
									'id_section_process' => '3',
									'nm_file' => $filename,
									'nm_asli' => $_FILES['lampiran']['name'],
									'ukuran' => $_FILES['lampiran']['size']
				);
				
				
				$id_file = $this->approval->save_detail_file($data_file);
							
				$file_uploaded = array(//'link' => '<li class="list-group-item list-group-item-success">'.$_FILES['lampiran']['name'].'<a class="" href="javascript:void(0)" onclick="delete_file()" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>',
									   'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file('."'".$id_file."'".')" title="Download">'.$_FILES['lampiran']['name'].'<a id="'.$id_file.'" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',	
									   'id_file' => $id_file,
									   'filename' => $_FILES['lampiran']['name'],
									   'fileuploaded' => $filename,
									   'status' => TRUE
				);
				
				$this->uploaded[$i] = $file_uploaded;
				//echo json_encode(array($this->uploaded[$i]));
				//echo json_encode($this->uploaded[$i]);
			}
			else
			{
				$file_uploaded = array('link'=> '<li class="list-group-item list-group-item-danger">'.$_FILES['lampiran']['name'].'</a><a id="error'.$i.'" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="0"><span class="glyphicon glyphicon-remove"></span></a></li>',
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
	
	function ajax_delete_attachment()
	{
		$id_file = $_POST['xid_file'];
		$this->approval->delete_detail_attachment($id_file);
		echo json_encode(array("status" => TRUE));	
	}	
	
	function ajax_save_file_approval()
	{
				
		if(isset($_POST['file_approval']))
		{
			$file_attachment = $_POST['file_approval'];
			$id_permohonan = $this->approval->get_id_permohonan($this->input->post('id_approval'));
			$id_process = $this->input->post('id_approval');
			$id_section_process = '3';
			$id_jenis_dokumen = '4';
			$update_file = $this->approval->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
		}
		
		echo json_encode(array("status" => TRUE));	
	}
	
	function get_file_attachment()
	{
		$id_file = $this->uri->segment(3);
		$filename = $this->approval->get_filename($id_file);
		$nm_baru = $this->approval->get_nm_baru($id_file);
		
		$server = base_url();
		$path = './media/files_approval/';
		$url = $path.'/'.$filename; 
		
		//if(@getimagesize($url))
		if(is_file($url))	
		{
			
			// required for IE
			if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

			// get the file mime type using the file extension
			$this->load->helper('file');
			$mime = get_mime_by_extension($path);

			header('Pragma: public');     // required
			header('Expires: 0');         // no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($url)).' GMT');
			header('Cache-Control: private',false);
			header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
			header('Content-Disposition: attachment; filename="'.basename($nm_baru).'"');  // Add the file name
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($url)); // provide file size
			header('Connection: close');
			readfile($url); // push it out
			exit();
	
		}
	}
	
	function get_pdf_approval()
	{
		//$id_approval = $_POST['id_approval'];
		$id_permohonan = $this->uri->segment(3);
		$approval = $this->approval->get_data_approval($id_permohonan);
		
		foreach ($approval->result_array() as $row)
		{
			$bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$this->content_data['id_permohonan'] = $row['id_permohonan'];
			$this->content_data['no_reg'] = $row['no_reg'];
			$this->content_data['tgl_reg'] = $row['tgl_reg'].' '.$bulan[intval($row['bln_reg'])].' '.$row['thn_reg'];
			$this->content_data['nm_pemohon'] = $row['nm_pemohon'];
			$this->content_data['tmp_lahir'] = $row['tmp_lahir'];
			$this->content_data['tgl_lahir'] = 'Tanggal '.$row['tgl_lahir'].' Bulan '.$bulan[intval($row['bln_lahir'])].' Tahun '.$row['thn_lahir'];
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
			
			if($row['id_pekerjaan'] == '45')
			{	
				$this->content_data['pekerjaan'] = $row['pekerjaan_desc'];
			}
			else
			{
				$this->content_data['pekerjaan'] = $row['jenis_pekerjaan'];
			}		
			
			$this->content_data['tgl_approval'] = $row['tgl_approval'].' '.$bulan[intval($row['bln_approval'])].' '.$row['thn_approval'];
			$this->content_data['status_approval'] = $row['status_approval'];
			$this->content_data['nm_approval'] = $row['nm_approval'];
			$this->content_data['jabatan_approval'] = $row['jabatan_approval'];
			$this->content_data['alasan_lain'] = $row['desc_lain'];
		}
		
		$header = $this->approval->get_detail_setting();
		foreach ($header->result_array() as $data)
		{
			$this->content_data['kota_cabang'] = $data['kota_cabang'];
			//$this->content_data['line1'] = $data['alamat_cabang'].' '.$data['kota_cabang'].' '.$data['kodepos'].' Telp. '.$data['no_telp'].' Fax. '.$data['no_fax'];
			//$this->content_data['line1'] = $data['alamat_cabang'].' '.$data['kota_cabang'].' '.$data['kodepos'].' Telp. '.$data['no_telp'];
			$this->content_data['line1'] = 'Jl. Dipenogoro No. 74, Lantai 2, Jakarta Pusat, '.$data['kodepos'].' Telp. '.$data['no_telp'].' Fax. '.$data['no_fax'];
			$this->content_data['line2'] = 'Website: '.$data['website'].', Email: '.$data['email'];
			$this->content_data['alm_lengkap'] = $data['alamat_lengkap'];
		}
		
		if($this->content_data['status_approval'] == 'Ditolak')
		{
			$alasan = $this->approval->get_detail_alasan($id_permohonan);
			$this->content_data['alasan'] = $alasan;	
		}	
				
		$filename = 'Approval_'.$id_permohonan;
		$pdfFilePath = FCPATH."/downloads/reports/$filename.pdf";
		
		//$this->load->library('fpdf');
		$html = $this->load->view('main/approval_formulir', $this->content_data, true);
		
		$this->load->library('MPDF60/mpdf');
		$mpdf = new mPDF('','legal', 0, '', 10, 10, 10, 10, 0, 0, 'L');
		//$mpdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
		//$mpdf->AddPage('P', 'en-GB-x', 'F4', '', '', 10, 10, 10, 10, 0, 0);
		$mpdf->SetTitle('Print Out Approval Nomor : '.$this->content_data['no_reg']);
		$mpdf->SetAuthor('Simpensus');
		$mpdf->SetSubject('Dokumen Approval Nomor : '.$this->content_data['no_reg']);
		$mpdf->WriteHTML($html); // write the HTML into the PDF
		//$mpdf->Output($pdfFilePath, 'F'); // save to file because we can
		$mpdf->Output($filename.'.pdf', 'I'); // save to file because we can
		
		
		redirect("/downloads/reports/$filename.pdf"); 
		//echo json_encode(array("status" => TRUE));
		
	}
	
	function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_permohonan') == '')
		{
			$data['inputerror'][] = 'id_permohonan';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('status_approval') == 'Diterima')
		{
			if($this->input->post('id_jenis_kasus') == '')
			{
				$data['inputerror'][] = 'id_jenis_kasus';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('id_nama_kasus') == '')
			{
				$data['inputerror'][] = 'id_nama_kasus';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('id_posisi_hukum') == '')
			{
				$data['inputerror'][] = 'id_posisi_hukum';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('id_tindakan') == '')
			{
				$data['inputerror'][] = 'id_tindakan';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('id_analis') == '')
			{
				$data['inputerror'][] = 'id_analis';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('id_asisten') == '')
			{
				$data['inputerror'][] = 'id_asisten';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
		}
		else if($this->input->post('status_approval') == 'Ditolak')
		{
			if(count($_POST['alasan_penolakan']) < 2)	
			{
				$data['inputerror'][] = 'alasan_penolakan[]';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			else
			{
				$alasan = $_POST['alasan_penolakan'];
				if(in_array('8', $alasan) && $this->input->post('desc_lain') == '') 
				{	
					$data['inputerror'][] = 'desc_lain';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}				
			}	
			
			if($this->input->post('status_rekomendasi') == 'Ya')
			{
				if($this->input->post('id_advokat') == '')
				{
					$data['inputerror'][] = 'id_advokat';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
			}
			else if($this->input->post('status_rekomendasi') == 'Tidak')
			{
				if($this->input->post('alasan_rekomendasi') == '')
				{
					$data['inputerror'][] = 'alasan_rekomendasi';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
			}
			else
			{
				$data['inputerror'][] = 'status_rekomendasi';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
		}
		else
		{
			$data['inputerror'][] = 'status_approval';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}	
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}	
}
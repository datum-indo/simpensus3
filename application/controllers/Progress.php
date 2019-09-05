<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Progress extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');	
		$this->load->model('account_model','account');
		$this->load->model('progress_model','progress');
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
		$this->data['page_title'] = 'Progress';
		$this->data['permohonan'] = array('' => '');
		$this->data['status_progress'] = $this->progress->get_status_progress();
		$this->data['hasil_keputusan'] = array('' => '');
		$this->data['status_hasil'] = $this->progress->get_status_hasil();
		$this->data['status_sepakat'] = $this->progress->get_status_sepakat();
		$this->data['status_norma'] = $this->progress->get_status_norma();
		$this->data['status_aparat'] = $this->progress->get_status_aparat();
		$this->data['status_pencari'] = $this->progress->get_status_pencari();
		$this->data['status_kembali'] = $this->progress->get_status_kembali();
		$this->data['tahap_progress'] = $this->progress->get_tahap_progress();
		$this->data['status_klien'] = $this->progress->get_status_klien();
		$this->data['tahap_progress_next'] = $this->progress->get_tahap_progress();
		$this->data['jenis_dokumen'] = $this->progress->get_jenis_dokumen();
		
		
		
		$this->load->view('main/progress_list', $this->data);
	}
	
	public function ajax_list()
	{
		$list = $this->progress->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		
		foreach ($list as $progress) {
			//$no++;
			$row = array();
			$row[] = $progress->id_progress;
			$row[] = $progress->no_reg;
			$row[] = $progress->tgl_progress;
			$row[] = $progress->status_progress;
			$row[] = $progress->tahap_progress;
			$row[] = $progress->hasil_keputusan;
			$row[] = $progress->jenis_dokumen;
			$row[] = $progress->nm_processby;
			
			if($progress->case_status == '1')
			{
				if($this->data['id_role'] == '1')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			
					$data[] = $row;
				}
				else if($this->data['id_role'] == '2')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
			
					$data[] = $row;
				}
				else if($this->data['id_role'] == '3' || $this->data['id_role'] == '4')
				{
					if($this->data['id_user'] == $progress->id_analis)
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
			
						$data[] = $row;
					}
					else if($this->data['id_user'] == $progress->id_asisten)
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
			
						$data[] = $row;
					}
					else if($this->data['id_user'] == $progress->id_processby)
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
			
						$data[] = $row;
					}
					else
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>';
			
						$data[] = $row;
					}		
				}
				else if($this->data['id_role'] == '5')
				{
					if($this->data['id_user'] == $progress->id_processby)
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
									<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
			
						$data[] = $row;
					}
					else
					{
						$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>';
			
						$data[] = $row;
					}		
				}
				else if($this->data['id_role'] == '7')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
			
					$data[] = $row;
				}	
				else
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>';
			
					$data[] = $row;
				}
			}
			else
			{
				if($this->data['id_role'] == '1')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-upload"></i></a>
								<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			
					$data[] = $row;
				}
				else if($this->data['id_role'] == '2')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
			
					$data[] = $row;
				}
				else if($this->data['id_role'] == '7')
				{
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
								<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Upload" onclick="up('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-upload"></i></a>';
			
					$data[] = $row;
				}
				else
				{
					//add html for action
					$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$progress->id_progress."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>';
			
					$data[] = $row;
				}		
			}		
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->progress->count_all(),
						"recordsFiltered" => $this->progress->count_filtered(),
						"data" => $data
		);
				
		//output to json format
		echo json_encode($output);
	}
	
	function get_hasil_keputusan($id_permohonan)
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$hasil_keputusan = $this->progress->get_hasil_keputusan_by_id_permohonan($id_permohonan); 
		$tindakan = $this->progress->get_id_tindakan_by_id_permohonan($id_permohonan);
		echo(json_encode(array($hasil_keputusan, $tindakan)));
	}
	
	function ajax_new()
	{
		if($this->session->userdata('logged_in'))
        {
           	if($_GET['type'] == 'progress')
			{
				$progress = array('id_progress' => '',
								  'id_permohonan' => '',
								  'id_tindakan' => '',		
								  'status_progress' => '',
								  'tgl_progress' => '',
								  'id_hasil_keputusan' => '',
								  'uraian_keputusan' => '',
								  'status_hasil' => '',
								  'status_sepakat' => '',
								  'note_progress' => '',
								  'status_norma' => '',
								  'uraian_norma' => '',
								  'status_aparat' => '',
								  'uraian_aparat' => '',
								  'status_pencari' => '',
								  'uraian_pencari' => '',
								  'status_kembali' => '',
								  'id_tahap_progress' => '',
								  'uraian_progress' => '',
								  'status_klien' => '',
								  'uraian_klien' => '',
								  'tgl_progress_next' => '',
								  'id_tahap_progress_next' => '',
								  'uraian_progress_next' => '',
								  'id_jenis_dokumen' => ''
				);
				
				$approval = $this->progress->get_progress_add();
			}
			
			echo json_encode(array($progress, $approval));
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}	
	}
	
	function ajax_upload()
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
				'allowed_types' => 'jpg|jpeg|pdf|mp3|amr|mp4|mov',
				'max_size' => '524288',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);
			
			$this->upload->initialize($config);
			if ($this->upload->do_upload('lampiran'))
			{
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];
			
				$source = './tmp_upload/'.$filename;
				$destination = 'media/files_progress';
				copy($source, './'.$destination.'/'.$filename);
				@unlink('./tmp_upload/'.$filename);
				$img1 = $destination.'/'.$filename;
				
				$data_file = array( 'upload_by' => $this->data['id_user'],
									'upload_date' => date('Y-m-d H:i:s'),
									'id_section_process' => '4',
									'nm_file' => $filename,
									'nm_asli' => $_FILES['lampiran']['name'],
									'ukuran' => $_FILES['lampiran']['size']
				);
				
				
				$id_file = $this->progress->save_detail_file($data_file);
							
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
	
	function _convert_date_to_sql_date($date)
	{
		$date = substr($date,0,10);
		$date_array = preg_split( '/[-\.\/ ]/', $date);
		$date = date('Y-m-d',mktime(0,0,0,$date_array[1],$date_array[0],$date_array[2]));
  
		return $date;
	}
	
	function ajax_save()
	{
		if($this->session->userdata('logged_in'))
        {	
			$this->_validate();
			
			if($_POST['csrf_token'] == $this->data['csrf_token'])
			{	
				$tgl_progress = $this->_convert_date_to_sql_date($this->input->post('tgl_progress'));
				
				if($this->input->post('status_progress') == 'Selesai' || $this->input->post('status_progress') == 'Gugur')
				{
					$tgl_progress_next = '0000-00-00';
					$id_permohonan = $this->input->post('id_permohonan');
					$kasus_selesai = $this->progress->save_kasus_selesai($id_permohonan);
					$schedule = $this->progress->delete_schedule($this->input->post('id_permohonan'));
					$approval_schedule = $this->progress->delete_approval_schedule($this->input->post('id_permohonan'));
				}
				else
				{
					$schedule = $this->progress->delete_schedule($this->input->post('id_permohonan'));
					$approval_schedule = $this->progress->delete_approval_schedule($this->input->post('id_permohonan'));
					$tgl_progress_next = $this->_convert_date_to_sql_date($this->input->post('tgl_progress_next'));	
					$date_schedule = date('Y-m-d', strtotime($tgl_progress_next. '+1 days'));
					$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
											'date_schedule' => $date_schedule
					);
					$schedule = $this->progress->save_schedule($schedule_data);
				}
				
				if(isset($_POST['file_attachment']))
				{
					$id_jenis_dokumen = $this->input->post('id_jenis_dokumen');
					$status_attachment = TRUE;
				}
				else
				{
					$id_jenis_dokumen = '';
					$status_attachment = FALSE;
				}	
				
				$progress = $this->progress->get_id_progress();
				
				$data = array('id_progress' => $progress['id_progress'],
							  'id_permohonan' => $this->input->post('id_permohonan'),
							  'insert_date' => date('Y-m-d H:i:s'),
							  'insert_by' => $this->data['id_user'],
							  'update_date' => '0000-00-00 00:00:00',
							  'update_by' => '0',
							  'nomor' => $progress['nomor'],
							  'status_progress' => $this->input->post('status_progress'),
							  'tgl_progress' => $tgl_progress,
							  'id_hasil_keputusan' => $this->input->post('id_hasil_keputusan'),
							  'uraian_keputusan' => $this->input->post('uraian_keputusan'),
							  'status_hasil' => $this->input->post('status_hasil'),
							  'status_sepakat' => $this->input->post('status_sepakat'),
							  'note_progress' => $this->input->post('note_progress'),
							  'status_norma' => $this->input->post('status_norma'),
							  'uraian_norma' => $this->input->post('uraian_norma'),
							  'status_aparat' => $this->input->post('status_aparat'),
							  'uraian_aparat' => $this->input->post('uraian_aparat'),
							  'status_pencari' => $this->input->post('status_pencari'),
							  'uraian_pencari' => $this->input->post('uraian_pencari'),
							  'status_kembali' => $this->input->post('status_kembali'),
							  'id_tahap_progress' => $this->input->post('id_tahap_progress'),
							  'uraian_progress' => $this->input->post('uraian_progress'),
							  'status_klien' => $this->input->post('status_klien'),
							  'uraian_klien' => $this->input->post('uraian_klien'),
							  'tgl_progress_next' => $tgl_progress_next,  
							  'id_tahap_progress_next' => $this->input->post('id_tahap_progress_next'),
							  'uraian_progress_next' => $this->input->post('uraian_progress_next'),
							  'id_jenis_dokumen' => $id_jenis_dokumen
				);
				
				$insert_id = $this->progress->save_detail_progress($data);
				
				if($status_attachment)
				{
					$file_attachment = $_POST['file_attachment'];
					$id_jenis_dokumen = $this->input->post('id_jenis_dokumen');
					$id_permohonan = $this->input->post('id_permohonan');
					$id_process = $insert_id;
					$id_section_process = '4';
					$update_file = $this->progress->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
				}
				
				if($this->input->post('status_progress') == 'Selesai' || $this->input->post('status_progress') == 'Gugur')
				{
					$case_status = array('case_status' => '2');
					$status_permohonan = array('status_permohonan' => '2');
					
					$this->progress->update_analisis(array('id_permohonan' => $this->input->post('id_permohonan')), $case_status);
					$this->progress->update_progress(array('id_permohonan' => $this->input->post('id_permohonan')), $case_status);
					$this->progress->update_approval(array('id_permohonan' => $this->input->post('id_permohonan')), $case_status);	
					$this->progress->update_permohonan(array('id_permohonan' => $this->input->post('id_permohonan')), $status_permohonan);
				}
				
				$csrf_token = $this->session->userdata('csrf_token');
				$csrf_token = sha1(mt_rand());
				$this->session->set_userdata('csrf_token', $csrf_token);
								
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
	
	function get_detail_progress($id_progress)
	{
		if($this->session->userdata('logged_in'))
        {
			$progress = $this->progress->get_detail_progress($id_progress);
			//$progress->tgl_progress = ($progress->tgl_progress == 'dd/mm/yyyy') ? '' : $progress->tgl_progress;
			$progress->tgl_progress = date('d/m/Y', strtotime($progress->tgl_progress));
			$progress->tgl_progress_next = date('d/m/Y', strtotime($progress->tgl_progress_next));
			$permohonan = $this->progress->get_progress_edit($progress->id_permohonan);
			$hasil_keputusan = $this->progress->get_hasil_keputusan_by_id_permohonan($progress->id_permohonan);
			
			$id_process = $id_progress;
			$id_section_process = '4';
			$id_jenis_dokumen = $progress->id_jenis_dokumen;
			$file_list = $this->progress->get_detail_file_attachment($id_section_process, $id_process, $id_jenis_dokumen);
				
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
			
			echo json_encode(array($progress, $permohonan, $hasil_keputusan, $file_attachment));
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
			
			$tgl_progress = $this->_convert_date_to_sql_date($this->input->post('tgl_progress'));
			
			if($this->input->post('status_progress') == 'Selesai' || $this->input->post('status_progress') == 'Gugur')
			{
				$tgl_progress_next = '0000-00-00';
				$id_permohonan = $this->input->post('id_permohonan');
				$kasus_selesai = $this->progress->delete_kasus_selesai($id_permohonan);
				$kasus_selesai = $this->progress->save_kasus_selesai($id_permohonan);
				$schedule = $this->progress->delete_schedule($this->input->post('id_permohonan'));
			}
			else
			{
				$tgl_progress_next = $this->_convert_date_to_sql_date($this->input->post('tgl_progress_next'));	
				$schedule = $this->progress->delete_schedule($this->input->post('id_permohonan'));
				$date_schedule = date('Y-m-d', strtotime($tgl_progress_next. '+1 days'));
				$schedule_data = array ('id_permohonan' => $this->input->post('id_permohonan'), 
										'date_schedule' => $date_schedule
				);
				$schedule = $this->progress->save_schedule($schedule_data);
			}
			
			if(isset($_POST['file_attachment']))
			{
				$id_jenis_dokumen = $this->input->post('id_jenis_dokumen');
				$status_attachment = TRUE;
			}
			else
			{
				$id_jenis_dokumen = '';
				$status_attachment = FALSE;
			}	
			
			$data = array('id_permohonan' => $this->input->post('id_permohonan'),
						  'update_date' => date('Y-m-d H:i:s'),
						  'update_by' => $this->data['id_user'],
						  'status_progress' => $this->input->post('status_progress'),
						  'tgl_progress' => $tgl_progress,
						  'id_hasil_keputusan' => $this->input->post('id_hasil_keputusan'),
						  'uraian_keputusan' => $this->input->post('uraian_keputusan'),
						  'status_hasil' => $this->input->post('status_hasil'),
						  'status_sepakat' => $this->input->post('status_sepakat'),
						  'note_progress' => $this->input->post('note_progress'),
						  'status_norma' => $this->input->post('status_norma'),
						  'uraian_norma' => $this->input->post('uraian_norma'),
						  'status_aparat' => $this->input->post('status_aparat'),
						  'uraian_aparat' => $this->input->post('uraian_aparat'),
						  'status_pencari' => $this->input->post('status_pencari'),
						  'uraian_pencari' => $this->input->post('uraian_pencari'),
						  'status_kembali' => $this->input->post('status_kembali'),
						  'id_tahap_progress' => $this->input->post('id_tahap_progress'),
						  'uraian_progress' => $this->input->post('uraian_progress'),
						  'status_klien' => $this->input->post('status_klien'),
						  'uraian_klien' => $this->input->post('uraian_klien'),
						  'tgl_progress_next' => $tgl_progress_next,  
						  'id_tahap_progress_next' => $this->input->post('id_tahap_progress_next'),
						  'uraian_progress_next' => $this->input->post('uraian_progress_next'),
						  'id_jenis_dokumen' => $id_jenis_dokumen
			);
					
			$this->progress->update_detail_progress(array('id_progress' => $this->input->post('id_progress')), $data);	
			
			if($status_attachment)
			{
				$file_attachment = $_POST['file_attachment'];
				$id_jenis_dokumen = $this->input->post('id_jenis_dokumen');
				$id_permohonan = $this->input->post('id_permohonan');
				$id_process = $this->input->post('id_progress');
				$id_section_process = '4';
				$update_file = $this->progress->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
			}	
			
			if($this->input->post('status_progress') == 'Selesai' || $this->input->post('status_progress') == 'Gugur')
			{
				$case_status = array('case_status' => '2');
				$status_permohonan = array('status_permohonan' => '2');
				
				$this->progress->update_analisis(array('id_permohonan' => $this->input->post('id_permohonan')), $case_status);
				$this->progress->update_progress(array('id_permohonan' => $this->input->post('id_permohonan')), $case_status);
				$this->progress->update_approval(array('id_permohonan' => $this->input->post('id_permohonan')), $case_status);	
				$this->progress->update_permohonan(array('id_permohonan' => $this->input->post('id_permohonan')), $status_permohonan);
			}
			
			echo json_encode(array("status" => TRUE));		
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}	
	}
	
	function view_detail_progress($id_progress)
	{
		if($this->session->userdata('logged_in'))
        {
			$progress = $this->progress->view_detail_progress($id_progress);
			$id_process = $id_progress;
			$id_section_process = '4';
			$id_jenis_dokumen = $progress->id_jenis_dokumen;
			$file_list = $this->progress->get_detail_file_attachment($id_section_process, $id_process, $id_jenis_dokumen);
			
			if($file_list->num_rows() > 0)
			{
				foreach ($file_list->result() as $row)
				{
					$detail_file[] = array('link' => '<li class="list-group-item">'.$row->nm_baru.'<a href="javascript:void(0)" onclick="view_file('."'".$row->id_file."'".')" style="float: right;" title="Download"><span class="glyphicon glyphicon-save"></span></a></li>',	
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
			
			echo json_encode(array($progress, $file_attachment));
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}	
	}
	
	function ajax_delete()
	{
		$id_progress = $_POST['id_progress'];
		$this->progress->delete_detail_progress($id_progress);
		$this->progress->delete_attachment_progress($id_progress);
		echo json_encode(array("status" => TRUE));
	}
	
	function ajax_delete_attachment()
	{
		$id_file = $_POST['xid_file'];
		$this->progress->delete_detail_attachment($id_file);
		echo json_encode(array("status" => TRUE));	
		
	}
	
	function get_file_progress($id_progress)
	{
		$progress = $this->progress->get_detail_progress($id_progress);
			
		$id_process = $id_progress;
		$id_section_process = '4';
		$id_jenis_dokumen = $progress->id_jenis_dokumen;
		$file_list = $this->progress->get_detail_file_attachment($id_section_process, $id_process, $id_jenis_dokumen);
				
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
			
		echo json_encode(array($progress, $file_attachment));
		
	}
	
	function ajax_upload_progress()
	{
			
		$file_lampiran = sizeof($_FILES['lampiranx']['tmp_name']);
		
		$files = $_FILES['lampiranx'];
		
		for ($i = 0; $i < $file_lampiran; $i++)
		{
			
			$_FILES['lampiranx']['name'] = $files['name'][$i];
			$_FILES['lampiranx']['type'] = $files['type'][$i];
			$_FILES['lampiranx']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['lampiranx']['error'] = $files['error'][$i];
			$_FILES['lampiranx']['size'] = $files['size'][$i];
			
			
			$this->load->library('upload');
			$config = array(
				'encrypt_name' 	=> TRUE,
				'allowed_types' => 'jpg|jpeg|pdf|mp3|amr|mp4|mov',
				'max_size' => '524288',
				'overwrite'     => FALSE,
				'upload_path' 	=> FCPATH . 'tmp_upload/'
			);
			
			$this->upload->initialize($config);
			if ($this->upload->do_upload('lampiranx'))
			{
				$upload_data = $this->upload->data();
				$filename = $upload_data['file_name'];
			
				$source = './tmp_upload/'.$filename;
				$destination = 'media/files_progress';
				copy($source, './'.$destination.'/'.$filename);
				@unlink('./tmp_upload/'.$filename);
				$img1 = $destination.'/'.$filename;
				
				$data_file = array( 'upload_by' => $this->data['id_user'],
									'upload_date' => date('Y-m-d H:i:s'),
									'id_section_process' => '4',
									'nm_file' => $filename,
									'nm_asli' => $_FILES['lampiranx']['name'],
									'ukuran' => $_FILES['lampiranx']['size']
				);
				
				
				$id_file = $this->progress->save_detail_file($data_file);
							
				$file_uploaded = array(//'link' => '<li class="list-group-item list-group-item-success">'.$_FILES['lampiran']['name'].'<a class="" href="javascript:void(0)" onclick="delete_file()" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>',
									   'link' => '<li class="list-group-item list-group-item-success"><a href="javascript:void(0)" onclick="view_file('."'".$id_file."'".')" title="Download">'.$_FILES['lampiranx']['name'].'<a id="'.$id_file.'" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="1"><span class="glyphicon glyphicon-remove"></span></a></li>',	
									   'id_file' => $id_file,
									   'filename' => $_FILES['lampiranx']['name'],
									   'fileuploaded' => $filename,
									   'status' => TRUE
				);
				
				$this->uploaded[$i] = $file_uploaded;
				
			}
			else
			{
				$file_uploaded = array('link'=> '<li class="list-group-item list-group-item-danger">'.$_FILES['lampiranx']['name'].'</a><a id="error'.$i.'" class="delete" href="javascript:void(0)" style="float: right;" title="Delete" status="0"><span class="glyphicon glyphicon-remove"></span></a></li>',
									   'filename' => $_FILES['lampiranx']['name'],
									   'fileuploaded' => 'Unknown file extension',		
									   'status' => FALSE
				);
				
				$this->uploaded[$i] = $file_uploaded;
				
			}
		}
		
		echo json_encode($this->uploaded);
	}
	
	function ajax_save_file_progress()
	{
		$this->_validatex();
			
		if(isset($_POST['file_attachment']))
		{
			$id_jenis_dokumen = $this->input->post('id_jenis_dokumenx');
			$status_attachment = TRUE;
		}
		else
		{
			$id_jenis_dokumen = '';
			$status_attachment = FALSE;
		}	
			
		$data = array('id_jenis_dokumen' => $id_jenis_dokumen);
					
		$this->progress->update_detail_progress(array('id_progress' => $this->input->post('id_progressx')), $data);	
			
		if($status_attachment)
		{
			$file_attachment = $_POST['file_attachment'];
			$id_jenis_dokumen = $this->input->post('id_jenis_dokumenx');
			$id_permohonan = $this->progress->get_id_permohonan($this->input->post('id_progressx'));
			$id_process = $this->input->post('id_progressx');
			$id_section_process = '4';
			$update_file = $this->progress->update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process);
		}	
			
		echo json_encode(array("status" => TRUE));		
	}
	
	function get_file_attachment()
	{
		$id_file = $this->uri->segment(3);
		$filename = $this->progress->get_filename($id_file);
		$nm_baru = $this->progress->get_nm_baru($id_file);
		
		$server = base_url();
		$path = './media/files_progress/';
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
		
		if($this->input->post('tgl_progress') == '')
		{
			$data['inputerror'][] = 'tgl_progress';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}
			
		if($this->input->post('status_progress') == 'Selesai')
		{
						
			if($this->input->post('id_tindakan') == '1')
			{
				if($this->input->post('status_hasil') == '')
				{
					$data['inputerror'][] = 'status_hasil';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if($this->input->post('note_progress') == '')
				{
					$data['inputerror'][] = 'note_progress';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if(isset($_POST['file_attachment']))
				{
					if($this->input->post('id_jenis_dokumen') == '')
					{
						$data['inputerror'][] = 'id_jenis_dokumen';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}	
				}	
			}
			else if($this->input->post('id_tindakan') == '2')
			{
				if($this->input->post('status_hasil') == '')
				{
					$data['inputerror'][] = 'status_hasil';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if($this->input->post('status_sepakat') == '')
				{
					$data['inputerror'][] = 'status_sepakat';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if($this->input->post('note_progress') == '')
				{
					$data['inputerror'][] = 'note_progress';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if(isset($_POST['file_attachment']))
				{
					if($this->input->post('id_jenis_dokumen') == '')
					{
						$data['inputerror'][] = 'id_jenis_dokumen';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}	
				}	
			}
			else
			{
				if($this->input->post('id_hasil_keputusan') == '')
				{
					$data['inputerror'][] = 'id_hasil_keputusan';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				else
				{
					if($this->input->post('uraian_keputusan') == '')
					{
						$data['inputerror'][] = 'uraian_keputusan';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}
				}
				
				if($this->input->post('status_hasil') == '')
				{
					$data['inputerror'][] = 'status_hasil';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if($this->input->post('status_norma') == 'Tidak Sesuai')
				{
					if($this->input->post('uraian_norma') == '')
					{
						$data['inputerror'][] = 'uraian_norma';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}
				}

				if($this->input->post('status_norma') == '')
				{
					$data['inputerror'][] = 'status_norma';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if($this->input->post('status_aparat') == 'Tidak Sesuai')
				{
					if($this->input->post('uraian_aparat') == '')
					{
						$data['inputerror'][] = 'uraian_aparat';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}
				}

				if($this->input->post('status_aparat') == '')
				{
					$data['inputerror'][] = 'status_aparat';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if($this->input->post('status_pencari') == 'Tidak Sesuai')
				{
					if($this->input->post('uraian_pencari') == '')
					{
						$data['inputerror'][] = 'uraian_pencari';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}
				}

				if($this->input->post('status_pencari') == '')
				{
					$data['inputerror'][] = 'status_pencari';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}

				if($this->input->post('status_klien') == '')
				{
					$data['inputerror'][] = 'status_klien';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				
				if($this->input->post('status_klien') == 'Ya')
				{
					if($this->input->post('uraian_klien') == '')
					{
						$data['inputerror'][] = 'uraian_klien';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}
				}
				
				/*
				if($this->input->post('status_kembali') == '')
				{
					$data['inputerror'][] = 'status_kembali';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}
				*/
				
				if(isset($_POST['file_attachment']))
				{
					if($this->input->post('id_jenis_dokumen') == '')
					{
						$data['inputerror'][] = 'id_jenis_dokumen';
						//$data['error_string'][] = 'Nama Lengkap is required';
						$data['status'] = FALSE;
					}	
				}	
			}		
		}
		else if($this->input->post('status_progress') == 'Belum Selesai')
		{
			if($this->input->post('id_tahap_progress') == '')
			{
				$data['inputerror'][] = 'id_tahap_progress';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('uraian_progress') == '')
			{
				$data['inputerror'][] = 'uraian_progress';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('tgl_progress_next') == '')
			{
				$data['inputerror'][] = 'tgl_progress_next';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			else
			{
				$date1=date_create($this->_convert_date_to_sql_date($this->input->post('tgl_progress')));
				$date2=date_create($this->_convert_date_to_sql_date($this->input->post('tgl_progress_next')));
				
				$diff=date_diff($date1,$date2);
				
				if($diff->format("%R%a") < 0)
				{
					$data['inputerror'][] = 'tgl_progress_next';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}	
			}	
			
			if($this->input->post('id_tahap_progress_next') == '')
			{
				$data['inputerror'][] = 'id_tahap_progress_next';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('uraian_progress_next') == '')
			{
				$data['inputerror'][] = 'uraian_progress_next';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if(isset($_POST['file_attachment']))
			{
				if($this->input->post('id_jenis_dokumen') == '')
				{
					$data['inputerror'][] = 'id_jenis_dokumen';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}	
			}	
		}
		else if($this->input->post('status_progress') == 'Gugur')
		{
			if($this->input->post('note_progress') == '')
			{
				$data['inputerror'][] = 'note_progress';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}
			
			if(isset($_POST['file_attachment']))
			{
				if($this->input->post('id_jenis_dokumen') == '')
				{
					$data['inputerror'][] = 'id_jenis_dokumen';
					//$data['error_string'][] = 'Nama Lengkap is required';
					$data['status'] = FALSE;
				}	
			}	
		}
		else
		{
			$data['inputerror'][] = 'status_progress';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}	
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function _validatex()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if(isset($_POST['file_attachment']))
		{
			if($this->input->post('id_jenis_dokumenx') == '')
			{
				$data['inputerror'][] = 'id_jenis_dokumenx';
				//$data['error_string'][] = 'Nama Lengkap is required';
				$data['status'] = FALSE;
			}	
		}	
		
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
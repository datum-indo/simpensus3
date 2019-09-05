<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Setting extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');	
		$this->load->model('account_model','account');
		$this->load->model('configuration_model','configuration');
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
		redirect('setting/account','refresh');
	}
	
	function account()
	{
		$this->data['page_title'] = 'Account';
		$this->data['jkel'] = $this->account->get_jkel();
		$this->data['role'] = $this->account->get_role();
		$this->data['user_status'] = $this->account->get_user_status();
				
		$this->load->view('main/account_list', $this->data);
	}
	
	public function ajax_list_account()
	{
		$list = $this->account->get_datatables();
		$data = array();
		
		foreach ($list as $account) {
			//$no++;
			$row = array();
			$row[] = $account->id_user;
			$row[] = $account->fullname;
			$row[] = $account->designation;
			$row[] = $account->tgl_lahir;
			$row[] = $account->no_hp;
			$row[] = $account->email;
			$row[] = $account->nm_role;
			$row[] = $account->user_status;
			$row[] = $account->nm_processby;
			
			if($account->id_user == '201609000')
			{
				$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$account->id_user."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$account->id_user."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';	
			}
			else
			{
				$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$account->id_user."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$account->id_user."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
							<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$account->id_user."'".')"><i class="glyphicon glyphicon-trash"></i></a>';	
			}		
			
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->account->count_all(),
						"recordsFiltered" => $this->account->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function _convert_date_to_sql_date($date)
	{
		$date = substr($date,0,10);
		$date_array = preg_split( '/[-\.\/ ]/', $date);
		$date = date('Y-m-d',mktime(0,0,0,$date_array[1],$date_array[0],$date_array[2]));
  
		return $date;
	}
	
	function ajax_save_account()
	{
		$this->_validate_account();
		
		if($_POST['csrf_token'] == $this->data['csrf_token'])
		{	
			$account = $this->account->get_id_user();
			
			$tgl_signin = $this->_convert_date_to_sql_date($this->input->post('tgl_signin'));
			
			$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahir'));
			
			$data = array('id_user' => $account['id_user'],
						  'insert_date' => date('Y-m-d H:i:s'),
						  'insert_by' => $this->data['id_user'],
						  'update_date' => '0000-00-00 00:00:00',
						  'update_by' => '0',
						  'nomor' => $account['nomor'],
						  'username' => $this->input->post('username'),
						  'password' => MD5(trim($this->input->post('password'))),
						  'fullname' => $this->input->post('fullname'),
						  'tgl_signin' => $tgl_signin,
						  'designation' => $this->input->post('designation'),
						  'tmp_lahir' => $this->input->post('tmp_lahir'),
						  'tgl_lahir' => $tgl_lahir,
						  'jkel' => $this->input->post('jkel'),
						  'no_hp' => $this->input->post('no_hp'),
						  'email' => $this->input->post('email'),
						  'user_pictures' => $this->input->post('user_pictures'),
						  'id_role' => $this->input->post('id_role'),
						  'user_status' => $this->input->post('user_status')
			);
			
			$insert = $this->account->save_detail_account($data);
			
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
		else
		{
			echo json_encode(array('csrf_token' => $this->session->userdata('csrf_token'), 'status' => TRUE));
		}
	}
	
	function get_detail_account($id_user)
	{
		$account = $this->account->get_detail_account($id_user);
		$account->tgl_signin = date('d/m/Y', strtotime($account->tgl_signin));
		$account->tgl_lahir = date('d/m/Y', strtotime($account->tgl_lahir));
				
		echo json_encode($account);
	}

	function ajax_update_account()
	{
		$this->_uvalidate_account();
		
		$tgl_signin = $this->_convert_date_to_sql_date($this->input->post('tgl_signin'));
		
		$tgl_lahir = $this->_convert_date_to_sql_date($this->input->post('tgl_lahir'));
		
		if($this->input->post('password') != '')
		{
			$data = array('update_date' => date('Y-m-d H:i:s'),
						  'update_by' => $this->data['id_user'],
						  'username' => $this->input->post('username'),
						  'password' => MD5(trim($this->input->post('password'))),
						  'fullname' => $this->input->post('fullname'),
						  'designation' => $this->input->post('designation'),
						  'tgl_signin' => $tgl_signin,
						  'tmp_lahir' => $this->input->post('tmp_lahir'),
						  'tgl_lahir' => $tgl_lahir,
						  'jkel' => $this->input->post('jkel'),
						  'no_hp' => $this->input->post('no_hp'),
						  'email' => $this->input->post('email'),
						  'user_pictures' => $this->input->post('user_pictures'),
						  'id_role' => $this->input->post('id_role'),
						  'user_status' => $this->input->post('user_status')
			);
		}
		else
		{
			$data = array('update_date' => date('Y-m-d H:i:s'),
						  'update_by' => $this->data['id_user'],
						  'username' => $this->input->post('username'),
						  'fullname' => $this->input->post('fullname'),
						  'designation' => $this->input->post('designation'),
						  'tgl_signin' => $tgl_signin,
						  'tmp_lahir' => $this->input->post('tmp_lahir'),
						  'tgl_lahir' => $tgl_lahir,
						  'jkel' => $this->input->post('jkel'),
						  'no_hp' => $this->input->post('no_hp'),
						  'email' => $this->input->post('email'),
						  'user_pictures' => $this->input->post('user_pictures'),
						  'id_role' => $this->input->post('id_role'),
						  'user_status' => $this->input->post('user_status')
			);
		}
		
		$this->account->update_detail_account(array('id_user' => $this->input->post('id_user')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}
	
		
	function ajax_upload_photo()
	{
		
		$files = $_FILES['image_upload'];
		
		$_FILES['image_upload']['name'] = $files['name'];
		$_FILES['image_upload']['type'] = $files['type'];
		$_FILES['image_upload']['tmp_name'] = $files['tmp_name'];
		$_FILES['image_upload']['error'] = $files['error'];
		$_FILES['image_upload']['size'] = $files['size'];
		
		
		
		$this->load->library('upload');
		$config = array(
			'encrypt_name' 	=> TRUE,
			'allowed_types' => 'jpg',
			'max_size'      => 1024,
			'max_width'     => 128,
            'max_height'    => 128,
			'overwrite'     => FALSE,
			'upload_path' 	=> FCPATH . 'tmp_upload/'
		);

		$this->upload->initialize($config);
		if ($this->upload->do_upload('image_upload'))
		{	
			$upload_data = $this->upload->data();
			$filename = $upload_data['file_name'];
			
			$source = './tmp_upload/'.$filename;
			$destination = 'media/user_pictures';
			copy($source, './'.$destination.'/'.$filename);
			@unlink('./tmp_upload/'.$filename);
			$user_pictures = $destination.'/'.$filename;
			
			$data = array('user_pictures' => $user_pictures,
						  'status' => TRUE	);
			
			echo json_encode($data);
		}
		else
		{
			$filename = 'default_avatar.png';
			$destination = 'media/user_pictures';
			$user_pictures = $destination.'/'.$filename;
			
			$data = array('user_pictures' => $user_pictures,
						  'status' => FALSE	);
			
			echo json_encode($data);
		}
		
	}

	function view_detail_account($id_user)
	{
		$account = $this->account->view_detail_account($id_user);
		$bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$account->tgl_signin = $account->tgl_signin.' '.$bulan[intval($account->bln_signin)].' '.$account->thn_signin;
		$account->tgl_lahir = $account->tgl_lahir.' '.$bulan[intval($account->bln_lahir)].' '.$account->thn_lahir;
				
		echo json_encode($account);
	}
	
	function ajax_delete_account()
	{
		$id_user = $_POST['id_user'];
		$this->account->delete_detail_account($id_user);
		echo json_encode(array("status" => TRUE));
	}
	
		
	function _validate_account()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('username') != '')
		{
			if(strlen(trim($this->input->post('username'))) < 4)	
			{
				$data['inputerror'][] = 'username';
				$data['error_string'][] = 'Username is too short, use more than 3 character';
				$data['status'] = FALSE;
			}
			else
			{
				if(preg_match('/^[a-z0-9._]+$/', $this->input->post('username')))
				{
					$username = trim($this->input->post('username'));
					if(!($this->account->username_check($username)))
					{
						$data['inputerror'][] = 'username';
						$data['error_string'][] = 'Username already exist';
						$data['status'] = FALSE;
					}	
				}
				else
				{
					$data['inputerror'][] = 'username';
					$data['error_string'][] = 'Please use only letters (a-z), numbers, underscore and periods.';
					$data['status'] = FALSE;
				}		
				
			}
		}
		else
		{
			$data['inputerror'][] = 'username';
			//$data['error_string'][] = 'Username is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('password') != '')
		{
			if(strlen(trim($this->input->post('password'))) < 4)	
			{
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Password is too short, use more than 3 character';
				$data['status'] = FALSE;
			}
		}	
		else
		{
			$data['inputerror'][] = 'password';
			//$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		
		}	
		
		if($this->input->post('fullname') == '')
		{
			$data['inputerror'][] = 'fullname';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('designation') == '')
		{
			$data['inputerror'][] = 'designation';
			//$data['error_string'][] = 'Jabatan is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tgl_signin') == '')
		{
			$data['inputerror'][] = 'tgl_signin';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('id_role') == '')
		{
			$data['inputerror'][] = 'id_role';
			//$data['error_string'][] = 'Role is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('user_status') == '')
		{
			$data['inputerror'][] = 'user_status';
			//$data['error_string'][] = 'Status is required';
			$data['status'] = FALSE;
		}
				
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}	
	
	function _uvalidate_account()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('password') != '')
		{
			if(strlen(trim($this->input->post('password'))) < 4)	
			{
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Password is too short, use more than 3 character';
				$data['status'] = FALSE;
			}
		}	
				
		if($this->input->post('fullname') == '')
		{
			$data['inputerror'][] = 'fullname';
			//$data['error_string'][] = 'Nama Lengkap is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('designation') == '')
		{
			$data['inputerror'][] = 'designation';
			//$data['error_string'][] = 'Jabatan is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tgl_signin') == '')
		{
			$data['inputerror'][] = 'tgl_signin';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('id_role') == '')
		{
			$data['inputerror'][] = 'id_role';
			//$data['error_string'][] = 'Role is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('user_status') == '')
		{
			$data['inputerror'][] = 'user_status';
			//$data['error_string'][] = 'Status is required';
			$data['status'] = FALSE;
		}
				
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
	function configuration()
	{
		if($this->data['id_user'] == '201600000')
		{
			$this->data['provinsi'] = $this->configuration->get_provinsi();
			$this->data['kabkota'] = array('' => '');
			$this->data['page_title'] = 'Configuration';
			$this->load->view('main/configuration_list', $this->data);	
		}
		else
		{
			redirect('', 'refresh');
		}		
		
	}
	
	public function ajax_list_configuration()
	{
		$list = $this->configuration->get_datatables();
		$data = array();
		
		foreach ($list as $configuration) {
			
			$row = array();
			$row[] = $configuration->kode_cabang;
			$row[] = $configuration->alamat_cabang;
			$row[] = $configuration->kota_cabang;
			$row[] = $configuration->kodepos;
			$row[] = $configuration->no_telp;
			$row[] = $configuration->website;
			$row[] = $configuration->email;
			$row[] = $configuration->initial_permohonan;
			
			/*
			$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view('."'".$configuration->kode_cabang."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>
						<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$configuration->kode_cabang."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
			
			*/
			
			$row[] = '	<a class="btn btn-sm btn-warning" href="javascript:void(0)" title="Edit" onclick="edit('."'".$configuration->kode_cabang."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
						
			$data[] = $row;
			
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->configuration->count_all(),
						"recordsFiltered" => $this->configuration->count_filtered(),
						"data" => $data
		);
				
		echo json_encode($output);
	}
	
	function get_kabkota($id_provinsi)
	{
		header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->configuration->get_kabkota_by_id_provinsi($id_provinsi)));
	}
	
	function get_detail_configuration($kode_cabang)
	{
		$configuration = $this->configuration->get_detail_configuration($kode_cabang);
		$kabkota = $this->configuration->get_kabkota_by_id_provinsi($configuration->id_provinsi);
						
		echo json_encode(array($configuration, $kabkota));
	}
	
	function ajax_update_configuration()
	{
		$this->_validate_configuration();
		
		$data = array('id_provinsi' => $this->input->post('id_provinsi'),
					  'id_kabkota' => $this->input->post('id_kabkota'),
					  'alamat_cabang' => $this->input->post('alamat_cabang'),
					  'alamat_lengkap' => $this->input->post('alamat_lengkap'),
					  'kota_cabang' => $this->configuration->get_nm_kabkota($this->input->post('id_kabkota')),
					  'kodepos' => $this->input->post('kodepos'),
					  'no_telp' => $this->input->post('no_telp'),
					  'no_fax' => $this->input->post('no_fax'),
					  'website' => $this->input->post('website'),
					  'email' => $this->input->post('email'),
					  'initial_permohonan' => $this->input->post('initial_permohonan')
		);
		
		
		$this->configuration->update_detail_configuration(array('kode_cabang' => $this->input->post('kode_cabang')), $data);
		
		echo json_encode(array("status" => TRUE));		
	}	
	
	function view_detail_configuration($kode_cabang)
	{
		$configuration = $this->configuration->view_detail_configuration($kode_cabang);
						
		echo json_encode($configuration);
	}
	
	function _validate_configuration()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('id_provinsi') == '')
		{
			$data['inputerror'][] = 'id_provinsi';
			//$data['error_string'][] = 'alamat_cabang is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('id_kabkota') == '')
		{
			$data['inputerror'][] = 'id_kabkota';
			//$data['error_string'][] = 'alamat_cabang is required';
			$data['status'] = FALSE;
		}			
		
		if($this->input->post('alamat_cabang') == '')
		{
			$data['inputerror'][] = 'alamat_cabang';
			//$data['error_string'][] = 'alamat_cabang is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('alamat_lengkap') == '')
		{
			$data['inputerror'][] = 'alamat_lengkap';
			//$data['error_string'][] = 'alamat_cabang is required';
			$data['status'] = FALSE;
		}		
		
		if($this->input->post('kodepos') == '')
		{
			$data['inputerror'][] = 'kodepos';
			//$data['error_string'][] = 'Jabatan is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('no_telp') == '')
		{
			$data['inputerror'][] = 'no_telp';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('website') == '')
		{
			$data['inputerror'][] = 'website';
			//$data['error_string'][] = 'Role is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			//$data['error_string'][] = 'Role is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('initial_permohonan') == '')
		{
			$data['inputerror'][] = 'initial_permohonan';
			//$data['error_string'][] = 'Status is required';
			$data['status'] = FALSE;
		}
				
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}	
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Page extends CI_Controller {
	
	//private $_uploaded;
	//public $_uploaded;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');	
		$this->load->model('account_model','account');
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
				
				/* Notification */
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
		$this->data['page_title'] = 'Home';
		
		$total_bantuan = $this->pages->get_total_bantuan();
		$this->data['total_bantuan'] = $total_bantuan;
				
		$total_konsultasi = $this->pages->get_total_konsultasi();
		$this->data['total_konsultasi'] = $total_konsultasi;
		if($total_konsultasi != 0)
		{
			$this->data['percent_konsultasi'] = round((float)($total_konsultasi/$total_bantuan) * 100 ) . '%';
		}
		else
		{
			$this->data['percent_konsultasi'] = '0%';	
		}	
				
		$total_negosiator = $this->pages->get_total_negosiator();
		$this->data['total_negosiator'] = $total_negosiator;
		if($total_negosiator != 0)
		{
			$this->data['percent_negosiator'] = round((float)($total_negosiator/$total_bantuan) * 100 ) . '%';
		}
		else
		{
			$this->data['percent_negosiator'] = '0%';	
		}	
				
		$total_pembela = $this->pages->get_total_pembela();
		$this->data['total_pembela'] = $total_pembela;
		if($total_pembela != 0)
		{
			$this->data['percent_pembela'] = round((float)($total_pembela/$total_bantuan) * 100 ) . '%';
		}
		else
		{
			$this->data['percent_pembela'] = '0%';	
		}
				
		$this->data['bantuan_hukum'] = $this->pages->get_data_bantuan_hukum_this_year();
		$this->data['bentuk_layanan'] = $this->pages->get_data_bentuk_layanan_this_year();
				
		$total_pidana = $this->pages->get_total_pidana();
		if($total_pidana != 0)
		{
			$this->data['percent_pidana'] = round((float)($total_pidana/$total_bantuan) * 100 );
		}
		else
		{
			$this->data['percent_pidana'] = '0';	
		}
				
		$total_perdata = $this->pages->get_total_perdata();
		if($total_perdata != 0)
		{
			$this->data['percent_perdata'] = round((float)($total_perdata/$total_bantuan) * 100 );
		}
		else
		{
			$this->data['percent_perdata'] = '0';	
		}
				
		$total_tun = $this->pages->get_total_tun();
		if($total_tun != 0)
		{
			$this->data['percent_tun'] = round((float)($total_tun/$total_bantuan) * 100 );
		}
		else
		{
			$this->data['percent_tun'] = '0';	
		}
		
		$this->data['total_pidana'] = $total_pidana;
		$this->data['total_perdata'] = $total_perdata;
		$this->data['total_tun'] = $total_tun;
				
		$total_pelapor = $this->pages->get_total_pelapor();
		$this->data['total_pelapor'] = $total_pelapor;
		if($total_pelapor != 0)
		{
			$this->data['percent_pelapor'] = round((float)($total_pelapor/$total_pidana) * 100 ). '%';
		}
		else
		{
			$this->data['percent_pelapor'] = '0%';	
		}
				
		$total_saksi = $this->pages->get_total_saksi();
		$this->data['total_saksi'] = $total_saksi;
		if($total_saksi != 0)
		{
			$this->data['percent_saksi'] = round((float)($total_saksi/$total_pidana) * 100 ). '%';
		}
		else
		{
			$this->data['percent_saksi'] = '0%';	
		}
		
		$total_terlapor = $this->pages->get_total_terlapor();
		$this->data['total_terlapor'] = $total_terlapor;
		if($total_terlapor != 0)
		{
			$this->data['percent_terlapor'] = round((float)($total_terlapor/$total_pidana) * 100 ). '%';
		}
		else
		{
			$this->data['percent_terlapor'] = '0%';	
		}
		
		$total_tersangka = $this->pages->get_total_tersangka();
		$this->data['total_tersangka'] = $total_tersangka;
		if($total_tersangka != 0)
		{
			$this->data['percent_tersangka'] = round((float)($total_tersangka/$total_pidana) * 100 ). '%';
		}
		else
		{
			$this->data['percent_tersangka'] = '0%';	
		}
		
		$total_terdakwa = $this->pages->get_total_terdakwa();
		$this->data['total_terdakwa'] = $total_terdakwa;
		if($total_terdakwa != 0)
		{
			$this->data['percent_terdakwa'] = round((float)($total_terdakwa/$total_pidana) * 100 ). '%';
		}
		else
		{
			$this->data['percent_terdakwa'] = '0%';	
		}
		
		$total_terpidana = $this->pages->get_total_terpidana();
		$this->data['total_terpidana'] = $total_terpidana;
		if($total_terpidana != 0)
		{
			$this->data['percent_terpidana'] = round((float)($total_terpidana/$total_pidana) * 100 ). '%';
		}
		else
		{
			$this->data['percent_terpidana'] = '0%';	
		}
		
		$total_penggugat = $this->pages->get_total_penggugat();
		$this->data['total_penggugat'] = $total_penggugat;
		if($total_penggugat != 0)
		{
			$this->data['percent_penggugat'] = round((float)($total_penggugat/$total_perdata) * 100 ). '%';
		}
		else
		{
			$this->data['percent_penggugat'] = '0%';	
		}
		
		$total_tergugat = $this->pages->get_total_tergugat();
		$this->data['total_tergugat'] = $total_tergugat;
		if($total_tergugat != 0)
		{
			$this->data['percent_tergugat'] = round((float)($total_tergugat/$total_perdata) * 100 ). '%';
		}
		else
		{
			$this->data['percent_tergugat'] = '0%';	
		}
		
		$total_penggugat_tun = $this->pages->get_total_penggugat_tun();
		$this->data['total_penggugat_tun'] = $total_penggugat_tun;
		if($total_penggugat_tun != 0)
		{
			$this->data['percent_penggugat_tun'] = round((float)($total_penggugat_tun/$total_tun) * 100 ). '%';
		}
		else
		{
			$this->data['percent_penggugat_tun'] = '0%';	
		}
		
		$total_tergugat_tun = $this->pages->get_total_tergugat_tun();
		$this->data['total_tergugat_tun'] = $total_tergugat_tun;
		if($total_tergugat_tun != 0)
		{
			$this->data['percent_tergugat_tun'] = round((float)($total_tergugat_tun/$total_tun) * 100 ). '%';
		}
		else
		{
			$this->data['percent_tergugat_tun'] = '0%';	
		}
		
		$total_bentuk_sifat_kasus = $this->pages->get_total_bentuk_sifat_kasus();
		
		foreach($total_bentuk_sifat_kasus->result_array() AS $row)
		{
			$this->data['individu'] = $row['individu'];
			$this->data['kelompok'] = $row['kelompok'];
			$this->data['nonstruktural'] = $row['nonstruktural'];
			$this->data['struktural'] = $row['struktural'];
		}
			
		$this->data['issue_ham'] = $this->pages->get_issue_ham_this_year();
		
		$this->load->view('main/dashboard', $this->data);
	}
	
	function get_detail_account($id_user)
	{
		if($id_user == $this->session->userdata('id_user'))
		{
			$account = $this->account->get_detail_account($id_user);
			$account->tgl_lahir = date('d/m/Y', strtotime($account->tgl_lahir));
					
			echo json_encode($account);
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}		
	}
	
	function _convert_date_to_sql_date($date)
	{
		$date = substr($date,0,10);
		$date_array = preg_split( '/[-\.\/ ]/', $date);
		$date = date('Y-m-d',mktime(0,0,0,$date_array[1],$date_array[0],$date_array[2]));
  
		return $date;
	}
	
	function ajax_update_profile()
	{
		if($this->input->post('xid_user') == $this->session->userdata('id_user'))
		{	
			$this->_uvalidate_profile();
			
			$xtgl_lahir = $this->_convert_date_to_sql_date($this->input->post('xtgl_lahir'));
			
			if($this->input->post('con_password') != '')
			{
				$data = array('update_date' => date('Y-m-d H:i:s'),
							  'update_by' => $this->data['id_user'],
							  'password' => MD5(trim($this->input->post('con_password'))),
							  'tmp_lahir' => $this->input->post('xtmp_lahir'),
							  'tgl_lahir' => $xtgl_lahir,
							  'no_hp' => $this->input->post('xno_hp'),
							  'email' => $this->input->post('xemail'),
							  'user_pictures' => $this->input->post('xuser_pictures')
				);
			}
			else
			{
				$data = array('update_date' => date('Y-m-d H:i:s'),
							  'update_by' => $this->data['id_user'],
							  'tmp_lahir' => $this->input->post('xtmp_lahir'),
							  'tgl_lahir' => $xtgl_lahir,
							  'no_hp' => $this->input->post('xno_hp'),
							  'email' => $this->input->post('xemail'),
							  'user_pictures' => $this->input->post('xuser_pictures')
				);
			}
			
			$this->account->update_detail_account(array('id_user' => $this->input->post('xid_user')), $data);
			
			echo json_encode(array("status" => TRUE));	
		}
		else
		{
			echo json_encode(array('success' => FALSE));
		}		
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
	
	function _uvalidate_profile()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		
		if($this->input->post('old_password') != '' || $this->input->post('new_password') != '' || $this->input->post('con_password') != '')
		{
			$id_user = $this->input->post('xid_user');
			$password = MD5(trim($this->input->post('old_password')));
			
			if(!($this->account->password_check($password, $id_user)))
			{
				$data['inputerror'][] = 'old_password';
				$data['error_string'][] = 'Invalid old password.';
				$data['status'] = FALSE;
			}
			else
			{
				if(strlen(trim($this->input->post('new_password'))) < 4)	
				{
					$data['inputerror'][] = 'new_password';
					$data['error_string'][] = 'Password is too short, use more than 3 character.';
					$data['status'] = FALSE;
				}
				else
				{
					if(trim($this->input->post('con_password')) != trim($this->input->post('new_password')))
					{
						$data['inputerror'][] = 'con_password';
						$data['error_string'][] = 'Your passwords do not match. Please try again.';
						$data['status'] = FALSE;
					}	
				}		
			}		
			
		}	
		
		if($this->input->post('xtmp_lahir') == '')
		{
			$data['inputerror'][] = 'xtmp_lahir';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('xtgl_lahir') == '')
		{
			$data['inputerror'][] = 'xtgl_lahir';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('xno_hp') == '')
		{
			$data['inputerror'][] = 'xno_hp';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('xemail') == '')
		{
			$data['inputerror'][] = 'xemail';
			//$data['error_string'][] = 'Tanggal Lahir is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}	
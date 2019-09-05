<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class File_manager extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');	
		$this->load->model('account_model','account');
		$this->load->model('file_manager_model','file_manager');
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
		$this->data['page_title'] = 'File Manager';
				
		$this->load->view('main/file_manager_list', $this->data);
	}
	
	public function ajax_list()
	{
		$list = $this->file_manager->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		foreach ($list as $file_manager) {
			//$no++;
			$row = array();
			$string = array('.jpg', '.jpeg','.png', '.pdf');
			$row[] = str_replace($string, '', $file_manager->fake_id);
			$row[] = $file_manager->no_reg;
			$row[] = $file_manager->filename;
			$row[] = $file_manager->jenis_dokumen;
			$row[] = $file_manager->upload_date;
			$row[] = $file_manager->nm_uploadby;
			$row[] = $file_manager->ukuran;
			
			if($this->data['id_role'] == '1' || $this->data['id_role'] == '2' || $this->data['id_role'] == '7')
			{
				//add html for action
				$row[] = '	<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Download" onclick="get('."'".$file_manager->id_file."'".')"><i class="glyphicon glyphicon-save"></i></a>
							<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="del('."'".$file_manager->id_file."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
				$data[] = $row;
			}
			else
			{
				//add html for action
				$row[] = '	<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Download" onclick="get('."'".$file_manager->id_file."'".')"><i class="glyphicon glyphicon-save"></i></a>';
		
				$data[] = $row;
			}		
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->file_manager->count_all(),
						"recordsFiltered" => $this->file_manager->count_filtered(),
						"data" => $data
		);
				
		
		echo json_encode($output);
	}
	
	function ajax_delete()
	{
		$id_file = $_POST['id_file'];
		$this->file_manager->delete_file($id_file);
		echo json_encode(array("status" => TRUE));
	}	
	
	function get_file_attachment()
	{
		$id_file = $this->uri->segment(3);
		$filename = $this->file_manager->get_filename($id_file);
		$nm_baru = $this->file_manager->get_nm_baru($id_file);
		$id_section_process = $this->file_manager->get_id_section_process($id_file);
		
		$server = base_url();
				
		if($id_section_process == 1 || $id_section_process == 2)
		{
			$path = './media/files_permohonan/';
		}
		else if($id_section_process == 3)
		{
			$path = './media/files_approval/';
		}
		else if($id_section_process == 4)
		{
			$path = './media/files_progress/';
		}
		else
		{
			$path = './media/files_analisis/';
		}

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
	
	
}
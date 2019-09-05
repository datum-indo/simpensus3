<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends CI_Controller {
	
	//private $_uploaded;
	//public $_uploaded;
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');	
		$this->load->model('account_model','account');
		$this->load->model('user_model','user');
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
		$this->data['page_title'] = 'Users';
		
		$this->load->view('main/user_list', $this->data);
	}
	
	function ajax_list($offset = 0)
	{
		//$list = $this->user->get_datatables();
		$limit = 20;
		$perPage = $limit;
		
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$offset = $offset > 0 ? (($offset - 1) * $perPage) : $offset;
		
		$list = $this->user->get_datatables_ajax($offset, $limit);
		$data = array();
		
		foreach ($list as $user) 
		{
			$row = array();
			
			$row = '
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" id="userbox">
				<a href="'.site_url('users/show_profile').'/'.$user->user_id.'">
					<div class="box box-widget widget-user-2">
						<div class="widget-user-header bg-aqua-active">
							<div class="widget-user-image">
								<img class="img-circle" src="'.base_url().$user->user_pictures.'">
							</div>
							<h4 class="widget-user-username" id="fullname" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$user->fullname.'</h4>
							<h5 class="widget-user-desc" id="designation" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">'.$user->designation.'</h5>
						</div>
					</div>
				</a>	
			</div>';
									
			$data[] = $row;
		}

		$total = $this->user->getTotalData();
		
		$this->load->library('paging');
		$config = array();
		$config['base_url'] = base_url('user/ajax_list/index');
        $config['total_rows'] = $this->user->getTotalData();
        $config['per_page'] = $perPage;
        $config['uri_segment'] = 4;
		
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination pagination-md no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
			
		$config['use_page_numbers'] = TRUE;
		
		$this->paging->initialize($config);
        $paginator = $this->paging->create_links();
		
		echo json_encode(array($total, $perPage, $paginator ,$data));
	}
	
	function show_profile($user_id)
	{
		/* Profile Info */
		$profile = $this->user->get_profile_info($user_id);
		if($profile->num_rows() > 0 )
		{
			foreach($profile->result_array() as $row)
			{
				$this->data['nama_lengkap'] = $row['fullname'];
				$this->data['jabatan'] = $row['designation'];
				$bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
				$this->data['tgl_signin'] = $row['tgl_signin'].' '.$bulan[intval($row['bln_signin'])].' '.$row['thn_signin'];
				$this->data['ytmp_lahir'] = $row['tmp_lahir'];
				$this->data['ytgl_lahir'] = $row['tgl_lahir'].' '.$bulan[intval($row['bln_lahir'])].' '.$row['thn_lahir'];
				$this->data['yjkel'] = $row['jkel'];
				$this->data['yno_hp'] = $row['no_hp'];
				$this->data['yemail'] = $row['email'];
				$this->data['photo'] = $row['user_pictures'];
			}
			
			$count_konsultasi = $this->user->get_profile_konsultasi($user_id);
			$this->data['total_konsultasi'] = $count_konsultasi;
			$count_negosiator = $this->user->get_profile_negosiator($user_id);
			$this->data['total_negosiator'] = $count_negosiator;
			$count_pembela = $this->user->get_profile_pembela($user_id);
			$this->data['total_pembela'] = $count_pembela;
			
			/* Job This Year */	
			$jml_konsultasi = $this->user->get_jumlah_konsultasi($user_id);
			$this->data['jml_konsultasi'] = $jml_konsultasi;
			$total_konsultasi = $this->pages->get_total_konsultasi();
			if($jml_konsultasi != 0)
			{
				$this->data['percent_konsultasi'] = round((float)($jml_konsultasi/$total_konsultasi) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_konsultasi'] = '0%';	
			}		
			
			$jml_negosiator = $this->user->get_jumlah_negosiator($user_id);
			$this->data['jml_negosiator'] = $jml_negosiator;
			$total_negosiator = $this->pages->get_total_negosiator();
			if($jml_negosiator != 0)
			{
				$this->data['percent_negosiator'] = round((float)($jml_negosiator/$total_negosiator) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_negosiator'] = '0%';	
			}

			$jml_pembela = $this->user->get_jumlah_pembela($user_id);
			$this->data['jml_pembela'] = $jml_pembela;
			$total_pembela = $this->pages->get_total_pembela();
			if($jml_pembela != 0)
			{
				$this->data['percent_pembela'] = round((float)($jml_pembela/$total_pembela) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_pembela'] = '0%';	
			}	

			$total_permohonan = $this->user->get_total_permohonan_this_year();	
			$count_permohonan = $this->user->get_count_permohonan_this_year($user_id);
			$this->data['total_permohonan'] = $count_permohonan.'/'.$total_permohonan;
			if($count_permohonan != 0)
			{
				$this->data['percent_permohonan'] = round((float)($count_permohonan/$total_permohonan) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_permohonan'] = '0%';	
			}

			$total_approval = $this->user->get_total_approval_this_year();	
			$count_approval = $this->user->get_count_approval_this_year($user_id);
			$this->data['total_approval'] = $count_approval.'/'.$total_approval;
			if($count_approval != 0)
			{
				$this->data['percent_approval'] = round((float)($count_approval/$total_approval) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_approval'] = '0%';	
			}	
			
			$total_analisis = $this->user->get_total_analisis_this_year($user_id);	
			$count_analisis = $this->user->get_count_analisis_this_year($user_id);
			$this->data['total_analisis'] = $count_analisis.'/'.$total_analisis;
			if($count_analisis != 0)
			{
				$this->data['percent_analisis'] = round((float)($count_analisis/$total_analisis) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_analisis'] = '0%';	
			}	
			
			$total_progress = $this->user->get_total_progress_this_year();	
			$count_progress = $this->user->get_count_progress_this_year($user_id);
			$this->data['total_progress'] = $count_progress.'/'.$total_progress;
			if($count_progress != 0)
			{
				$this->data['percent_progress'] = round((float)($count_progress/$total_progress) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_progress'] = '0%';	
			}	
			
			$total_job = $this->user->get_total_job_this_year($user_id);
			$count_job = $this->user->get_count_job_this_year($user_id);
			$this->data['total_job'] = $count_job.'/'.$total_job;
			if($count_job != 0)
			{
				$this->data['percent_job'] = round((float)($count_job/$total_job) * 100 ) . '%';	
			}
			else
			{
				$this->data['percent_job'] = '0%';	
			}

			$total_upload = $this->user->get_total_upload_this_year();
			$count_upload = $this->user->get_count_upload_this_year($user_id);
			$this->data['total_upload'] = $count_upload.'/'.$total_upload;
			if($count_upload != 0)
			{
				$this->data['percent_upload'] = round((float)($count_upload/$total_upload) * 100 ) . '%';		
			}
			else
			{
				$this->data['percent_upload'] = '0%';		
			}		
			
			$this->data['progress_chart'] = $this->user->get_data_progress_chart_this_year($user_id);
					
			$this->data['page_title'] = $this->data['nama_lengkap'];
			
			$this->load->view('main/user_show', $this->data);
		}
		else
		{
			$this->data['page_title'] = 'Profile not found';
			$this->load->view('main/user_not_found', $this->data);
		}		
	}

}	
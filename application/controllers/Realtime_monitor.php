<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Realtime_monitor extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('account_model','account');
		$this->load->model('realtime_monitor_model','realtime_monitor');
		//$this->logged_in();
			
	}
	
	function logged_in()
	{
				
		if($this->session->userdata('logged_in'))
        {
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
			}
		}
		else
		{
			redirect('login','refresh');
		}
		
	}
	
	function index()
	{
		$this->data['page_title'] = 'Real Time Monitor';
		
		$session = $this->realtime_monitor->get_data_monitoring();
				
		$no = 0;
		/*
		echo '<table>';
 		echo '<tr>';
		echo '<th width="10%">datetime</th>';
		echo '<th width="10%">username</th>';
		echo '<th width="10%">ip_address</th>';
		echo '<th width="10%">browser</th>';
		echo '<th width="10%">platform</th>';
		echo '</tr>';
		*/
		
		foreach ($session->result() as $row)
		{
			$session_data = $row->data;
            $return_data = array();
            $offset = 0;
			
			
            while ($offset < strlen($session_data)) 
			{
				if (!strstr(substr($session_data, $offset), '|')) 
				{
                    throw new Exception('invalid data, remaining: ' . substr($session_data, $offset));
                }
				
                $pos = strpos($session_data, '|', $offset);
                $num = $pos - $offset;
                $varname = substr($session_data, $offset, $num);
                $offset += $num + 1;
                $data = unserialize(substr($session_data, $offset));
                $return_data[$varname] = $data;
                $offset += strlen(serialize($data));
            }
			
			//echo '<pre>';
			//print_r($return_data);
			
			//var_dump([$return_data->id_user]);
			
			if(!empty($return_data['logged_in']))
			{
                
				/*
				echo '<tr>';
                echo '<td width="10%" style="text-align: center;">'.date('d-m-Y H:i:s',$return_data['__ci_last_regenerate']).'</td>';
                echo '<td width="10%" style="text-align: center;">'.$return_data['username'].'</td>';
                echo '<td width="10%" style="text-align: center;">'.$row->ip_address.'</td>';
                echo '<td width="10%" style="text-align: center;">'.$return_data['browser'].'</td>';
                echo '<td width="10%" style="text-align: center;">'.$return_data['platform'].'</td>';
                echo '</tr>'; 
				*/		
				
				$no++;
				
				$baris[] = array('datetime' 	=> date('d-m-Y H:i:s',$return_data['__ci_last_regenerate']),
								 'username' 	=> $return_data['username'],
								 'ip_address' => $row->ip_address,
								 'browser' 	=> $return_data['browser'],
							     'platform' 	=> $return_data['platform'] );
				
			}
		}
		
		//echo '</table>';
		//echo '<br/>';
		echo $no;
		
		echo '<br/>';
		echo '<pre>';
		if(!empty($baris))
		{
			print_r($baris);	
		}	
	}
	
	
	
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Report extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('page_model','pages');
		$this->load->model('account_model','account');
		$this->load->model('report_model','report');
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
		$this->data['page_title'] = 'Report';
		$this->data['extract_periode'] = array('Semua' => 'Semua', 'Tahun' => 'Tahun');
		
		$this->data['freq_type'] = array('1' => 'Kabupaten',	
										 '2' => 'Jenis Kelamin',
										 '3' => 'Umur',
										 '4' => 'Agama',
										 '5' => 'Pendidikan',
										 '6' => 'Pekerjaan Pokok',
										 '7' => 'Penghasilan',
										 '8' => 'Jarak Rumah',
										 '9' => 'Lama Perjalanan',
										 '10' => 'Status Tempat Tinggal',
										 '11' => 'Pernah jadi Klien',
										 '12' => 'Tahu LBH',
										 '13' => 'Punya Telepon Rumah',
										 '14' => 'Punya HP',
										 '15' => 'Punya Email',
										 '16' => 'Kelainan Fisik & Mental',
										 '17' => 'Jenis Kelainan Fisik & Mental',
										 '18' => 'Punya Tanda Pengenal',
										 '19' => 'Punya KTM',
										 '20' => 'Pernah ke Pihak Lain',
										 '21' => 'Status Permohonan',
										 '22' => 'Jenis Masalah Hukum',
										 '23' => 'Jenis Kasus Pidana',
										 '24' => 'Jenis Kasus Perdata',
										 '25' => 'Jenis Kasus TUN',
										 '26' => 'Posisi Hukum Klien',
										 '27' => 'Sifat Kasus',
										 '28' => 'Bentuk Layanan yang diberikan',
										 '29' => 'Status Kasus',
										 '30' => 'Hasil untuk Klien',
										 /*'31' => 'Masalah eksekusi Pidana',*/
										 '32' => 'Masalah eksekusi Perdata',
										 '33' => 'Masalah eksekusi TUN',
										 '34' => 'Keadaan Klien',
										 '35' => 'Bentuk Kasus',
										 '36' => 'Jenis Issue HAM Pokok',
										 '37' => 'Jenis Issue HAM',
										 '38' => 'Jumlah Penerima Bantuan',
										 '39' => 'Kategori Korban',
										 '40' => 'Kategori Pelaku',
										 '41' => 'Rata-rata Penghasilan Kelompok Klien'
										 
		);
		
		$this->data['freq_periode'] = array('Semua' => 'Semua', 'Tahun' => 'Tahun');
		
		$this->data['cross_type'] = array('' => '',
										  '1' => 'Kabupaten',	
										  '2' => 'Jenis Kelamin',
										  '3' => 'Umur',
										  '4' => 'Agama',
										  '5' => 'Pendidikan',
										  '6' => 'Pekerjaan Pokok',
										  '7' => 'Penghasilan',
										  '8' => 'Ada SKTM',
										  '9' => 'Status Permohonan',
										  '10' => 'Jenis Masalah Hukum',
										  '11' => 'Jenis Kasus Pidana',
										  '12' => 'Jenis Kasus Perdata',
										  '13' => 'Jenis Kasus TUN',
										  '14' => 'Sifat Kasus',
										  '15' => 'Bentuk Layanan yang diberikan',
										  '16' => 'Status Kasus',
										  '17' => 'Hasil untuk Klien',
										  '18' => 'Bentuk Kasus',
										  '19' => 'Jenis Issue HAM',
										  '20' => 'Kategori Pelaku'
										  
										 
		);
		

		$this->data['cross_periode'] = array('Semua' => 'Semua', 'Tahun' => 'Tahun');
		
		$this->data['tahun'] = '';
		//$this->data['frequency'] = $this->report->get_empty_frequency();
		
		$this->load->view('main/report_list', $this->data);
	}
	
	function ajax_get_extract_all_data()
	{
		$this->_validate_extract_data();
		
		$periode = $this->input->post('extract_periode');
		$tahun = $this->input->post('extract_tahun');
		
		$result = $this->report->get_extract_all_data($periode, $tahun);
		
		$this->load->library('PHPExcel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("title")
					->setDescription("description");
		//name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Result');			
		//activate worksheet number 1
		$objPHPExcel->setActiveSheetIndex(0);
		// read data to active sheet
		$objPHPExcel->getActiveSheet()->fromArray($result);
				
		$filename='report_result_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
		header('Content-Type: application/vnd.ms-excel'); //mime type
        //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
		header('Content-Disposition: attachment;filename="'.$filename.'"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
		
		echo json_encode(array("status" => TRUE));
	}
	
	function _validate_extract_data()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('extract_periode') == 'Tahun')
		{
			if($this->input->post('extract_tahun') == '')
			{
				$data['inputerror'][] = 'extract_tahun';
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
	
	function get_extract_all_data()
	{
		if($_POST)
		{
			$periode = $this->input->post('extract_periode');
			$tahun = $this->input->post('extract_tahun');
					
					
			$result = $this->report->get_extract_all_data($periode, $tahun);
			
			if($periode == 'Semua')
			{
				$filename='extract_result_all_period_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
				$title = 'Extract Result All Period';
				$description = 'extract data result all period from simpensus application';
			}
			else
			{
				$filename='extract_result_by_year_'.$tahun.'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
				$title = 'Extract Result by Year '.$tahun;
				$description = 'extract data result by year '.$tahun.' from simpensus application';
			}		
			
			$this->load->library('PHPExcel');
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle($title)
						->setDescription($description);
			//name the worksheet
			$objPHPExcel->getActiveSheet()->setTitle($title);			
			//activate worksheet number 1
			$objPHPExcel->setActiveSheetIndex(0);
			// read data to active sheet
			$objPHPExcel->getActiveSheet()->fromArray($result);
					
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header('Content-Type: application/vnd.ms-excel'); //mime type
			//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
			
		}
		else
		{
			redirect('report','refresh');
		}	
	}
	
	function get_data_by_frequency()
	{
		if($_POST)
		{
			$freq_type = $this->input->post('freq_type');
			$freq_periode = $this->input->post('freq_periode');
			$freq_tahun = $this->input->post('freq_tahun');
			
			$frequency = $this->report->get_frequency_result($freq_type, $freq_periode, $freq_tahun);
		}
		else
		{
			redirect('report','refresh');
		}	
	}
	
	function ajax_get_data_by_frequency()
	{
		if($_POST)
		{
			$freq_type = $this->input->post('freq_type');
			$freq_periode = $this->input->post('freq_periode');
			$freq_tahun = $this->input->post('freq_tahun');
				
			$frequency = $this->report->get_frequency_result($freq_type, $freq_periode, $freq_tahun);
						
			if($frequency->num_rows() > 0)
			{
				$tot = 0; $freq = 0;
				foreach($frequency->result() as $row)	
				{
					$result[] = array('baris' => '<tr><td class="col-lg-6">'.$row->description.'</td><td style="text-align:right">'.$row->jumlah.'</td><td class="col-lg-3" style="text-align:right">'.$row->freq.'</td></tr>');
					$tot += $row->jumlah;
					$freq += (float)$row->freq; 
				}
				
				if($tot > 0)
				{
					$freq_result = $result;	
					$total = '<tr><td class="col-lg-6"><b>Total</b></td><td style="text-align:right"><b>'.$tot.'</b></td><td class="col-lg-3" style="text-align:right"><b>'.round($freq).'</b></td></tr>';
				}
				else
				{
					$freq_result[] = array('baris' => '<tr><td colspan="3" class="col-lg-12" style="text-align:center"><br/>no record found.<br/><br/></td></tr>');
					$total = '<tr><td class="col-lg-6"><b>Total</b></td><td style="text-align:right"><b>0</b></td><td class="col-lg-3" style="text-align:right"><b>0</b></td></tr>';
				}	
			}
			else
			{
				$freq_result[] = array('baris' => '<tr><td colspan="3" class="col-lg-12" style="text-align:center"><br/>no record found.<br/><br/></td></tr>');
				$total = '<tr><td class="col-lg-6"><b>Total</b></td><td style="text-align:right"><b>0</b></td><td class="col-lg-3" style="text-align:right"><b>0</b></td></tr>';
			}	
						
			echo json_encode(array($freq_result, $total));
		}	
		else
		{
			redirect('report','refresh');
		}				
	}
	
	function get_data_by_crosstab()
	{
		if($_POST)
		{
			$y = $this->input->post('cross_type1');
			$x = $this->input->post('cross_type2');
			$cross_periode = $this->input->post('cross_periode');
			$cross_tahun = $this->input->post('cross_tahun');
			
			if($y == '1')
			{
				$rowname = 'kab_kota'; 
				$rowtitle = 'Kota/Kabupaten';
			}
			else if($y == '2')
			{
				$rowname = 'jenis_kelamin';
				$rowtitle = 'Jenis Kelamin';
			}
			else if($y == '3')
			{
				$rowname = 'umur';
				$rowtitle = 'Umur';
			}
			else if($y == '4')
			{
				$rowname = 'agama';
				$rowtitle = 'Agama';
			}
			else if($y == '5')
			{
				$rowname = 'tingkat_pendidikan';
				$rowtitle = 'Pendidikan';
			}
			else if($y == '6')
			{
				$rowname = 'pekerjaan_pokok';
				$rowtitle = 'Pekerjaan Pokok';
			}
			else if($y == '7')
			{
				$rowname = 'penghasilan';
				$rowtitle = 'Penghasilan';
			}
			else if($y == '8')
			{
				$rowname = 'ada_sktm';
				$rowtitle = 'Ada SKTM';
			}
			else if($y == '9')
			{
				$rowname = 'status_permohonan';
				$rowtitle = 'Status Permohonan';
			}
			else if($y == '10')
			{
				$rowname = 'jenis_masalah_hukum';
				$rowtitle = 'Jenis Masalah Hukum';
			}
			else if($y == '11')
			{
				$rowname = 'jenis_kasus_pidana';
				$rowtitle = 'Jenis Kasus Pidana';
			}
			else if($y == '12')
			{
				$rowname = 'jenis_kasus_perdata';
				$rowtitle = 'Jenis Kasus Perdata';
			}
			else if($y == '13')
			{
				$rowname = 'jenis_kasus_tun';
				$rowtitle = 'Jenis Kasus TUN';
			}
			else if($y == '14')
			{
				$rowname = 'sifat_kasus';
				$rowtitle = 'Sifat Kasus';
			}
			else if($y == '15')
			{
				$rowname = 'jenis_layanan_yg_diberikan';
				$rowtitle = 'Bentuk Layanan';
			}
			else if($y == '16')
			{
				$rowname = 'status_kasus';
				$rowtitle = 'Status Kasus';
			}
			else if($y == '17')
			{
				$rowname = 'hasil_baik_buat_klien';
				$rowtitle = 'Baik Untuk Klien';
			}
			else if($y == '18')
			{
				$rowname = 'bentuk_kasus';
				$rowtitle = 'Bentuk Kasus';
			}
			else if($y == '19')
			{
				$rowname = 'issue_ham_pokok';
				$rowtitle = 'Issue HAM Utama';
			}
			else if($y == '20')
			{
				$rowname = 'kategori_pelaku';
				$rowtitle = 'Kategori Pelaku';
			}
			else
			{
				$rowname = '';
				$rowtitle = '';
			}
			
			if($x == '1')
			{
				$colname = 'kab_kota'; 
				$coltitle = 'Kota/Kabupaten';
			}
			else if($x == '2')
			{
				$colname = 'jenis_kelamin';
				$coltitle = 'Jenis Kelamin';
			}
			else if($x == '3')
			{
				$colname = 'umur';
				$coltitle = 'Umur';
			}
			else if($x == '4')
			{
				$colname = 'agama';
				$coltitle = 'Agama';
			}
			else if($x == '5')
			{
				$colname = 'tingkat_pendidikan';
				$coltitle = 'Pendidikan';
			}
			else if($x == '6')
			{
				$colname = 'pekerjaan_pokok';
				$coltitle = 'Pekerjaan Pokok';
			}
			else if($x == '7')
			{
				$colname = 'penghasilan';
				$coltitle = 'Penghasilan';
			}
			else if($x == '8')
			{
				$colname = 'ada_sktm';
				$coltitle = 'Ada SKTM';
			}
			else if($x == '9')
			{
				$colname = 'status_permohonan';
				$coltitle = 'Status Permohonan';
			}
			else if($x == '10')
			{
				$colname = 'jenis_masalah_hukum';
				$coltitle = 'Jenis Masalah Hukum';
			}
			else if($x == '11')
			{
				$colname = 'jenis_kasus_pidana';
				$coltitle = 'Jenis Kasus Pidana';
			}
			else if($x == '12')
			{
				$colname = 'jenis_kasus_perdata';
				$coltitle = 'Jenis Kasus Perdata';
			}
			else if($x == '13')
			{
				$colname = 'jenis_kasus_tun';
				$coltitle = 'Jenis Kasus TUN';
			}
			else if($x == '14')
			{
				$colname = 'sifat_kasus';
				$coltitle = 'Sifat Kasus';
			}
			else if($x == '15')
			{
				$colname = 'jenis_layanan_yg_diberikan';
				$coltitle = 'Bentuk Layanan';
			}
			else if($x == '16')
			{
				$colname = 'status_kasus';
				$coltitle = 'Status Kasus';
			}
			else if($x == '17')
			{
				$colname = 'hasil_baik_buat_klien';
				$coltitle = 'Baik Untuk Klien';
			}
			else if($x == '18')
			{
				$colname = 'bentuk_kasus';
				$coltitle = 'Bentuk Kasus';
			}
			else if($x == '19')
			{
				$colname = 'issue_ham_pokok';
				$coltitle = 'Issue HAM Utama';
			}
			else if($x == '20')
			{
				$colname = 'kategori_pelaku';
				$coltitle = 'Kategori Pelaku';
			}
			else
			{
				$colname = '';
				$coltitle = '';
			}
			
			//$title = $rowtitle.' & '.$coltitle;
			
			
			if($cross_periode == 'Semua')
			{
				$crosstab = $this->report->get_crosstab_result($y, $x, $cross_periode, $cross_tahun);
				
				
				$title = 'Result All';
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("Cross Tabulation Report")
							->setDescription("Cross Tabulation Report ".$rowtitle." * ".$coltitle." All");
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($crosstab);
						
						
				$filename='crosstab_result_'.$rowname.'+'.$colname.'_all_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
				
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');	
				
			}
			else
			{
				$crosstab = $this->report->get_crosstab_result($y, $x, $cross_periode, $cross_tahun);
				$title = 'Result by Year '. $cross_tahun;
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("Cross Tabulation Report")
							->setDescription("Cross Tabulation Report ".$rowtitle." * ".$coltitle." by Year ".$cross_tahun);
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($crosstab);
						
						
				$filename='crosstab_result_'.$rowname.'+'.$colname.'_by_year_'.$cross_tahun.'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
				
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');				
			}		
						
			
		}	
		else
		{
			redirect('report','refresh');
		}				
	}
	
	function cross_tabulation()
	{
		$this->data['page_title'] = 'Report';
		
		$this->data['cross_type'] = array(
										  '1' => 'Kabupaten',	
										  '2' => 'Jenis Kelamin',
										  '3' => 'Umur',
										  '4' => 'Agama',
										  '5' => 'Pendidikan',
										  '6' => 'Pekerjaan Pokok',
										  '7' => 'Penghasilan',
										  '8' => 'Ada SKTM',
										  '9' => 'Status Permohonan',
										  '10' => 'Jenis Masalah Hukum',
										  '11' => 'Jenis Kasus Pidana',
										  '12' => 'Jenis Kasus Perdata',
										  '13' => 'Jenis Kasus TUN',
										  '14' => 'Sifat Kasus',
										  '15' => 'Bentuk Layanan yang diberikan',
										  '16' => 'Status Kasus',
										  '17' => 'Hasil untuk Klien',
										  '18' => 'Bentuk Kasus',
										  '19' => 'Jenis Issue HAM',
										  '20' => 'Kategori Pelaku'
										  
										 
		);
		

		$this->data['cross_periode'] = array('Semua' => 'Semua', 'Tahun' => 'Tahun');
		
		if($_POST)
		{
			$y = $this->input->post('cross_type1');
			$x = $this->input->post('cross_type2');
			$cross_periode = $this->input->post('cross_periode');
			$cross_tahun = $this->input->post('cross_tahun');
			
			if($y == '1')
			{
				$rowname = 'kab_kota'; 
				$rowtitle = 'Kota/Kabupaten';
			}
			else if($y == '2')
			{
				$rowname = 'jenis_kelamin';
				$rowtitle = 'Jenis Kelamin';
			}
			else if($y == '3')
			{
				$rowname = 'umur';
				$rowtitle = 'Umur';
			}
			else if($y == '4')
			{
				$rowname = 'agama';
				$rowtitle = 'Agama';
			}
			else if($y == '5')
			{
				$rowname = 'tingkat_pendidikan';
				$rowtitle = 'Pendidikan';
			}
			else if($y == '6')
			{
				$rowname = 'pekerjaan_pokok';
				$rowtitle = 'Pekerjaan Pokok';
			}
			else if($y == '7')
			{
				$rowname = 'penghasilan';
				$rowtitle = 'Penghasilan';
			}
			else if($y == '8')
			{
				$rowname = 'ada_sktm';
				$rowtitle = 'Ada SKTM';
			}
			else if($y == '9')
			{
				$rowname = 'status_permohonan';
				$rowtitle = 'Status Permohonan';
			}
			else if($y == '10')
			{
				$rowname = 'jenis_masalah_hukum';
				$rowtitle = 'Jenis Masalah Hukum';
			}
			else if($y == '11')
			{
				$rowname = 'jenis_kasus_pidana';
				$rowtitle = 'Jenis Kasus Pidana';
			}
			else if($y == '12')
			{
				$rowname = 'jenis_kasus_perdata';
				$rowtitle = 'Jenis Kasus Perdata';
			}
			else if($y == '13')
			{
				$rowname = 'jenis_kasus_tun';
				$rowtitle = 'Jenis Kasus TUN';
			}
			else if($y == '14')
			{
				$rowname = 'sifat_kasus';
				$rowtitle = 'Sifat Kasus';
			}
			else if($y == '15')
			{
				$rowname = 'jenis_layanan_yg_diberikan';
				$rowtitle = 'Bentuk Layanan';
			}
			else if($y == '16')
			{
				$rowname = 'status_kasus';
				$rowtitle = 'Status Kasus';
			}
			else if($y == '17')
			{
				$rowname = 'hasil_baik_buat_klien';
				$rowtitle = 'Baik Untuk Klien';
			}
			else if($y == '18')
			{
				$rowname = 'bentuk_kasus';
				$rowtitle = 'Bentuk Kasus';
			}
			else if($y == '19')
			{
				$rowname = 'issue_ham_pokok';
				$rowtitle = 'Issue HAM Utama';
			}
			else if($y == '20')
			{
				$rowname = 'kategori_pelaku';
				$rowtitle = 'Kategori Pelaku';
			}
			else
			{
				$rowname = '';
				$rowtitle = '';
			}
			
			if($x == '1')
			{
				$colname = 'kab_kota'; 
				$coltitle = 'Kota/Kabupaten';
			}
			else if($x == '2')
			{
				$colname = 'jenis_kelamin';
				$coltitle = 'Jenis Kelamin';
			}
			else if($x == '3')
			{
				$colname = 'umur';
				$coltitle = 'Umur';
			}
			else if($x == '4')
			{
				$colname = 'agama';
				$coltitle = 'Agama';
			}
			else if($x == '5')
			{
				$colname = 'tingkat_pendidikan';
				$coltitle = 'Pendidikan';
			}
			else if($x == '6')
			{
				$colname = 'pekerjaan_pokok';
				$coltitle = 'Pekerjaan Pokok';
			}
			else if($x == '7')
			{
				$colname = 'penghasilan';
				$coltitle = 'Penghasilan';
			}
			else if($x == '8')
			{
				$colname = 'ada_sktm';
				$coltitle = 'Ada SKTM';
			}
			else if($x == '9')
			{
				$colname = 'status_permohonan';
				$coltitle = 'Status Permohonan';
			}
			else if($x == '10')
			{
				$colname = 'jenis_masalah_hukum';
				$coltitle = 'Jenis Masalah Hukum';
			}
			else if($x == '11')
			{
				$colname = 'jenis_kasus_pidana';
				$coltitle = 'Jenis Kasus Pidana';
			}
			else if($x == '12')
			{
				$colname = 'jenis_kasus_perdata';
				$coltitle = 'Jenis Kasus Perdata';
			}
			else if($x == '13')
			{
				$colname = 'jenis_kasus_tun';
				$coltitle = 'Jenis Kasus TUN';
			}
			else if($x == '14')
			{
				$colname = 'sifat_kasus';
				$coltitle = 'Sifat Kasus';
			}
			else if($x == '15')
			{
				$colname = 'jenis_layanan_yg_diberikan';
				$coltitle = 'Bentuk Layanan';
			}
			else if($x == '16')
			{
				$colname = 'status_kasus';
				$coltitle = 'Status Kasus';
			}
			else if($x == '17')
			{
				$colname = 'hasil_baik_buat_klien';
				$coltitle = 'Baik Untuk Klien';
			}
			else if($x == '18')
			{
				$colname = 'bentuk_kasus';
				$coltitle = 'Bentuk Kasus';
			}
			else if($x == '19')
			{
				$colname = 'issue_ham_pokok';
				$coltitle = 'Issue HAM Utama';
			}
			else if($x == '20')
			{
				$colname = 'kategori_pelaku';
				$coltitle = 'Kategori Pelaku';
			}
			else
			{
				$colname = '';
				$coltitle = '';
			}
			
			if($this->input->post('report_type') == 'preview')
			{
				if($cross_periode == 'Semua')
				{
					$this->data['report'] = $this->report->get_crosstab_result($y, $x, $cross_periode, $cross_tahun);
					$this->data['crosstype1'] = $this->input->post('cross_type1');
					$this->data['crosstype2'] = $this->input->post('cross_type2');
					$this->data['crossperiode'] = $this->input->post('cross_periode');
					$this->data['crosstahun'] = $this->input->post('cross_tahun');
					$this->load->view('main/report_by_crosstab_result_list', $this->data);
				}
				else
				{
					$this->data['report'] = $this->report->get_crosstab_result($y, $x, $cross_periode, $cross_tahun);
					$this->data['crosstype1'] = $this->input->post('cross_type1');
					$this->data['crosstype2'] = $this->input->post('cross_type2');
					$this->data['crossperiode'] = $this->input->post('cross_periode');
					$this->data['crosstahun'] = $this->input->post('cross_tahun');
					$this->load->view('main/report_by_crosstab_result_list', $this->data);
				}		
			
			}
			else
			{
				if($cross_periode == 'Semua')
				{
					$crosstab = $this->report->get_crosstab_result($y, $x, $cross_periode, $cross_tahun);
					
					$title = 'Result All';
					
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setTitle("Cross Tabulation Report")
								->setDescription("Cross Tabulation Report ".$rowtitle." * ".$coltitle." All");
					//name the worksheet
					$objPHPExcel->getActiveSheet()->setTitle($title);			
					//activate worksheet number 1
					$objPHPExcel->setActiveSheetIndex(0);
					// read data to active sheet
					$objPHPExcel->getActiveSheet()->fromArray($crosstab);
							
							
					$filename='crosstab_result_'.$rowname.'+'.$colname.'_all_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.ms-excel'); //mime type
					//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
					header('Content-Disposition: attachment;filename="'.$filename.'"');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
					//force user to download the Excel file without writing it to server's HD
					$objWriter->save('php://output');				
				}
				else
				{
					$crosstab = $this->report->get_crosstab_result($y, $x, $cross_periode, $cross_tahun);
					$title = 'Result by Year '. $cross_tahun;
					
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setTitle("Cross Tabulation Report")
								->setDescription("Cross Tabulation Report ".$rowtitle." * ".$coltitle." by Year ".$cross_tahun);
					//name the worksheet
					$objPHPExcel->getActiveSheet()->setTitle($title);			
					//activate worksheet number 1
					$objPHPExcel->setActiveSheetIndex(0);
					// read data to active sheet
					$objPHPExcel->getActiveSheet()->fromArray($crosstab);
							
							
					$filename='crosstab_result_'.$rowname.'+'.$colname.'_by_year_'.$cross_tahun.'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.ms-excel'); //mime type
					//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
					header('Content-Disposition: attachment;filename="'.$filename.'"');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
					//force user to download the Excel file without writing it to server's HD
					$objWriter->save('php://output');				
				}			
			}	
		}	
		else
		{
			$this->data['crosstype1'] = '1';
			$this->data['crosstype2'] = '2';
			$this->data['crossperiode'] = 'Semua';
			$this->data['crosstahun'] = '';
			$this->load->view('main/report_by_crosstab_list', $this->data);
		}				
	}

	function frequency_tabulation()
	{
		$this->data['page_title'] = 'Report';
				
		$this->data['freq_type'] = array('1' => 'Kabupaten',	
										 '2' => 'Jenis Kelamin',
										 '3' => 'Umur',
										 '4' => 'Agama',
										 '5' => 'Pendidikan',
										 '6' => 'Pekerjaan Pokok',
										 '7' => 'Penghasilan',
										 '8' => 'Jarak Rumah',
										 '9' => 'Lama Perjalanan',
										 '10' => 'Status Tempat Tinggal',
										 '11' => 'Pernah jadi Klien',
										 '12' => 'Tahu LBH',
										 '13' => 'Punya Telepon Rumah',
										 '14' => 'Punya HP',
										 '15' => 'Punya Email',
										 '16' => 'Kelainan Fisik & Mental',
										 '17' => 'Jenis Kelainan Fisik & Mental',
										 '18' => 'Punya Tanda Pengenal',
										 '19' => 'Punya KTM',
										 '20' => 'Pernah ke Pihak Lain',
										 '21' => 'Status Permohonan',
										 '22' => 'Jenis Masalah Hukum',
										 '23' => 'Jenis Kasus Pidana',
										 '24' => 'Jenis Kasus Perdata',
										 '25' => 'Jenis Kasus TUN',
										 '26' => 'Posisi Hukum Klien',
										 '27' => 'Sifat Kasus',
										 '28' => 'Bentuk Layanan yang diberikan',
										 '29' => 'Status Kasus',
										 '30' => 'Hasil untuk Klien',
										 /*'31' => 'Masalah eksekusi Pidana',*/
										 '32' => 'Masalah eksekusi Perdata',
										 '33' => 'Masalah eksekusi TUN',
										 '34' => 'Keadaan Klien',
										 '35' => 'Bentuk Kasus',
										 '36' => 'Jenis Issue HAM Pokok',
										 '37' => 'Jenis Issue HAM',
										 '38' => 'Jumlah Penerima Bantuan',
										 '39' => 'Kategori Korban',
										 '40' => 'Kategori Pelaku',
										 '41' => 'Rata-rata Penghasilan Kelompok Korban'
										 
		);
		
		$this->data['freq_periode'] = array('Semua' => 'Semua', 'Tahun' => 'Tahun');
		
		if($_POST)
		{
			if($this->input->post('report_type') == 'preview')
			{
				$freq_type = $this->input->post('freq_type');
				$freq_periode = $this->input->post('freq_periode');
				$freq_tahun = $this->input->post('freq_tahun');
				$this->data['report'] = $this->report->get_frequency_result($freq_type, $freq_periode, $freq_tahun);
				$this->data['judul'] = $this->data['freq_type'][$this->input->post('freq_type')];
				$this->data['freqtype'] = $this->input->post('freq_type');
				$this->data['freqperiode'] = $this->input->post('freq_periode');
				$this->data['freqtahun'] = $this->input->post('freq_tahun');
				$this->load->view('main/report_by_frequency_result_list', $this->data);
			}
			else
			{
				$freq_type = $this->input->post('freq_type');
				$freq_periode = $this->input->post('freq_periode');
				$freq_tahun = $this->input->post('freq_tahun');
				$report = $this->report->get_frequency_result($freq_type, $freq_periode, $freq_tahun);
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				
				$judul = $this->data['freq_type'][$this->input->post('freq_type')];
				
				if($freq_periode = 'Semua')
				{
					$title = 'All ';
					$objPHPExcel->getProperties()->setTitle("Tabel Frequency")
												 ->setDescription("Tabel Frequency ".$judul);	
												 
					$filename='tabel_frequency_'.$judul.'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name							 
				}
				else
				{
					$title = 'Tahun '.$this->input->post('freq_tahun');	
					$objPHPExcel->getProperties()->setTitle("Tabel Frequency")
												 ->setDescription("Tabel Frequency ".$judul.' Tahun '.$this->input->post('freq_tahun'));
												 
					$filename='tabel_frequency_'.$judul.'_tahun_'.$this->input->post('freq_tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name							 
				}		
				
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($report->result_array());
						
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');				
			}	
		}
		else
		{
			$this->data['freqtype'] = '1';
			$this->data['freqperiode'] = 'Semua';
			$this->data['freqtahun'] = '';
			$this->load->view('main/report_by_frequency_list', $this->data);
		}	
		
	}

	function layanan_bantuan_hukum()
	{
		$this->data['page_title'] = 'Report';
		$this->data['periode_type'] = array('1' => 'Tahun', '2' => 'Bulan');
		$this->data['bulan'] = array('01' => 'Januari', 
									 '02' => 'Februari',
									 '03' => 'Maret',
									 '04' => 'April',
									 '05' => 'Mei',
									 '06' => 'Juni',
									 '07' => 'Juli',
									 '08' => 'Agustus',
									 '09' => 'September',
									 '10' => 'Oktober',
									 '11' => 'November',
									 '12' => 'Desember');

		$this->data['filter'] = array('1' => 'Semua', '2' => 'Diterima', '3' => 'Ditolak');

		if($_POST)
		{
			if($this->input->post('periode_type') == '1')
			{
				if($this->input->post('report_type') == 'preview')
				{
					$this->data['report'] = $this->report->get_data_layanan_bantuan_hukum_pertahun($this->input->post('tahun'));
					$this->data['tahun'] = $this->input->post('tahun');
					$this->data['periode'] = $this->input->post('periode_type');
					$this->data['xbulan'] = $this->input->post('bulan');
					$this->data['xfilter'] = $this->input->post('filter');

					$this->load->view('main/report_by_layanan_bantuan_result_tahun_list', $this->data);
				}
				else
				{
					$report = $this->report->get_data_layanan_bantuan_hukum_pertahun_file($this->input->post('tahun'));

					$title = 'Tahun '.$this->input->post('tahun');
				
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setTitle("Data Layanan Bantuan Hukum")
								->setDescription("Data Layanan Bantuan Hukum Tahun ".$this->input->post('tahun'));
					//name the worksheet
					$objPHPExcel->getActiveSheet()->setTitle($title);			
					//activate worksheet number 1
					$objPHPExcel->setActiveSheetIndex(0);
					// read data to active sheet
					$objPHPExcel->getActiveSheet()->fromArray($report);
							
							
					$filename='data_layanan_bantuan_hukum_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.ms-excel'); //mime type
					//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
					header('Content-Disposition: attachment;filename="'.$filename.'"');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
					//force user to download the Excel file without writing it to server's HD
					$objWriter->save('php://output');				
				}
					
			}
			else
			{
				$month = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

				if($this->input->post('report_type') == 'preview')
				{
					$periode = $this->input->post('tahun').$this->input->post('bulan');
					$this->data['report'] = $this->report->get_data_layanan_bantuan_hukum_perbulan($periode, $this->input->post('filter'));
					$this->data['tahun'] = $this->input->post('tahun');
					$this->data['periode'] = $this->input->post('periode_type');
					$this->data['xbulan'] = $this->input->post('bulan');
					$this->data['xfilter'] = $this->input->post('filter');
					$this->data['month'] = $month[intval($this->input->post('bulan'))];
					
					$this->load->view('main/report_by_layanan_bantuan_result_bulan_list', $this->data);
				}
				else
				{
					$periode = $this->input->post('tahun').$this->input->post('bulan');
					$report = $this->report->get_data_layanan_bantuan_hukum_perbulan_file($periode, $this->input->post('filter'));

					$title = 'Bulan '.$month[intval($this->input->post('bulan'))].'Tahun '.$this->input->post('tahun');
				
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setTitle("Data Layanan Bantuan Hukum")
								->setDescription("Data Layanan Bantuan Hukum Bulan ".$month[intval($this->input->post('bulan'))]." Tahun ".$this->input->post('tahun'));
					//name the worksheet
					$objPHPExcel->getActiveSheet()->setTitle($title);			
					//activate worksheet number 1
					$objPHPExcel->setActiveSheetIndex(0);
					// read data to active sheet
					$objPHPExcel->getActiveSheet()->fromArray($report);
							
							
					$filename='data_layanan_bantuan_hukum_bulan_'.$month[intval($this->input->post('bulan'))].'_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.ms-excel'); //mime type
					//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
					header('Content-Disposition: attachment;filename="'.$filename.'"');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
					//force user to download the Excel file without writing it to server's HD
					$objWriter->save('php://output');				
				}	
			}
		}
		else
		{
			$this->data['tahun'] = '';
			$this->data['periode'] = '1';
			$this->data['xbulan'] = '01';
			$this->data['xfilter'] = '1';
			$this->load->view('main/report_by_layanan_bantuan_list', $this->data);
		}
	}

	function pendidikan_kelamin_usia()
	{
		$this->data['page_title'] = 'Report';
		

		if($_POST)
		{
			if($this->input->post('report_type') == 'preview')
			{
				$this->data['report'] = $this->report->get_data_penerima_by_pku_pertahun($this->input->post('tahun'));
				$this->data['tahun'] = $this->input->post('tahun');
				
				$this->load->view('main/report_by_pendidikan_result_tahun_list', $this->data);
			}
			else
			{
				$report = $this->report->get_data_penerima_by_pku_pertahun_file($this->input->post('tahun'));

				$title = 'Tahun '.$this->input->post('tahun');
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("Data Penerima Bantuan Hukum")
							->setDescription("Berdasarkan Pendidikan, Kelamin & Kategori Usia Tahun ".$this->input->post('tahun'));
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($report);
						
					
				$filename='data_pendidikan_kelamin_usia_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');				
			}
		}
		else
		{
			$this->data['tahun'] = '';
			
			$this->load->view('main/report_by_pendidikan_list', $this->data);
		}
	}

	function bentuk_layanan_jenis_kasus()
	{
		$this->data['page_title'] = 'Report';
		

		if($_POST)
		{
			if($this->input->post('report_type') == 'preview')
			{
				$this->data['report'] = $this->report->get_data_bentuk_layanan_jenis_kasus_pertahun($this->input->post('tahun'));
				$this->data['tahun'] = $this->input->post('tahun');
				
				$this->load->view('main/report_by_bentuk_layanan_result_tahun_list', $this->data);
			}
			else
			{
				$report = $this->report->get_data_bentuk_layanan_jenis_kasus_pertahun_file($this->input->post('tahun'));

				$title = 'Tahun '.$this->input->post('tahun');
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("Data Penerima Bantuan Hukum")
							->setDescription("Berdasarkan Bentuk Layanan & Jenis Masalah Hukum Tahun ".$this->input->post('tahun'));
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($report);
						
					
				$filename='data_bentuk_layanan_jenis_kasus_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');				
			}
		}
		else
		{
			$this->data['tahun'] = '';
			
			$this->load->view('main/report_by_bentuk_layanan_list', $this->data);
		}
	}

	function sifat_bentuk_kasus()
	{
		$this->data['page_title'] = 'Report';
		

		if($_POST)
		{
			if($this->input->post('report_type') == 'preview')
			{
				$this->data['report'] = $this->report->get_data_sifat_bentuk_kasus_pertahun($this->input->post('tahun'));
				$this->data['tahun'] = $this->input->post('tahun');
				
				$this->load->view('main/report_by_sifat_bentuk_kasus_result_tahun_list', $this->data);
			}
			else
			{
				$report = $this->report->get_data_sifat_bentuk_kasus_pertahun_file($this->input->post('tahun'));

				$title = 'Tahun '.$this->input->post('tahun');
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("Data Layanan Bantuan Hukum")
							->setDescription("Berdasarkan Sifat & Bentuk Kasus Tahun ".$this->input->post('tahun'));
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($report);
						
					
				$filename='data_sifat_bentuk_kasus_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');				
			}
		}
		else
		{
			$this->data['tahun'] = '';
			
			$this->load->view('main/report_by_sifat_bentuk_kasus_list', $this->data);
		}
	}

	function issue_ham()
	{
		$this->data['page_title'] = 'Report';
		

		if($_POST)
		{
			if($this->input->post('report_type') == 'preview')
			{
				$this->data['report'] = $this->report->get_data_issue_ham_pertahun($this->input->post('tahun'));
				$this->data['tahun'] = $this->input->post('tahun');
				
				$this->load->view('main/report_by_issue_ham_result_tahun_list', $this->data);
			}
			else
			{
				$report = $this->report->get_data_issue_ham_pertahun_file($this->input->post('tahun'));

				$title = 'Tahun '.$this->input->post('tahun');
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("Data Layanan Bantuan Hukum")
							->setDescription("Berdasarkan Issue HAM Tahun ".$this->input->post('tahun'));
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($report);
						
					
				$filename='data_issue_ham_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');				
			}
		}
		else
		{
			$this->data['tahun'] = '';
			
			$this->load->view('main/report_by_issue_ham_list', $this->data);
		}
	}

	function perkembangan_kasus()
	{
		$this->data['page_title'] = 'Report';
		$this->data['periode_type'] = array('1' => 'Tahun', '2' => 'Bulan');
		$this->data['bulan'] = array('01' => 'Januari', 
									 '02' => 'Februari',
									 '03' => 'Maret',
									 '04' => 'April',
									 '05' => 'Mei',
									 '06' => 'Juni',
									 '07' => 'Juli',
									 '08' => 'Agustus',
									 '09' => 'September',
									 '10' => 'Oktober',
									 '11' => 'November',
									 '12' => 'Desember');

		if($_POST)
		{
			if($this->input->post('periode_type') == '1')
			{
				if($this->input->post('report_type') == 'preview')
				{
					$this->data['report'] = $this->report->get_data_perkembangan_kasus_pertahun($this->input->post('tahun'));
					$this->data['tahun'] = $this->input->post('tahun');
					$this->data['periode'] = $this->input->post('periode_type');
					$this->data['xbulan'] = $this->input->post('bulan');
					
					$this->load->view('main/report_by_perkembangan_kasus_result_tahun_list', $this->data);
				}
				else
				{
					$report = $this->report->get_data_perkembangan_kasus_pertahun_file($this->input->post('tahun'));

					$title = 'Tahun '.$this->input->post('tahun');
				
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setTitle("Data Layanan Bantuan Hukum Tahun")
								->setDescription("Berdasarkan Perkembangan Kasus Tahun ".$this->input->post('tahun'));
					//name the worksheet
					$objPHPExcel->getActiveSheet()->setTitle($title);			
					//activate worksheet number 1
					$objPHPExcel->setActiveSheetIndex(0);
					// read data to active sheet
					$objPHPExcel->getActiveSheet()->fromArray($report);
							
							
					$filename='data_perkembangan_kasus_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.ms-excel'); //mime type
					//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
					header('Content-Disposition: attachment;filename="'.$filename.'"');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
					//force user to download the Excel file without writing it to server's HD
					$objWriter->save('php://output');				
				}
					
			}
			else
			{
				$month = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

				if($this->input->post('report_type') == 'preview')
				{
					$periode = $this->input->post('tahun').$this->input->post('bulan');
					$this->data['report'] = $this->report->get_data_perkembangan_kasus_perbulan($periode);
					$this->data['tahun'] = $this->input->post('tahun');
					$this->data['periode'] = $this->input->post('periode_type');
					$this->data['xbulan'] = $this->input->post('bulan');
					$this->data['month'] = $month[intval($this->input->post('bulan'))];
					
					$this->load->view('main/report_by_perkembangan_kasus_result_bulan_list', $this->data);
				}
				else
				{
					$periode = $this->input->post('tahun').$this->input->post('bulan');
					$report = $this->report->get_data_perkembangan_kasus_perbulan_file($periode);

					$title = 'Bulan '.$month[intval($this->input->post('bulan'))].'Tahun '.$this->input->post('tahun');
				
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
					$objPHPExcel->getProperties()->setTitle("Data Layanan Bantuan Hukum")
								->setDescription("Berdasarkan Perkembangan Kasus Bulan ".$month[intval($this->input->post('bulan'))]." Tahun ".$this->input->post('tahun'));
					//name the worksheet
					$objPHPExcel->getActiveSheet()->setTitle($title);			
					//activate worksheet number 1
					$objPHPExcel->setActiveSheetIndex(0);
					// read data to active sheet
					$objPHPExcel->getActiveSheet()->fromArray($report);
							
							
					$filename='data_perkembangan_kasus_bulan_'.$month[intval($this->input->post('bulan'))].'_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");
					header('Content-Type: application/vnd.ms-excel'); //mime type
					//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
					header('Content-Disposition: attachment;filename="'.$filename.'"');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
					//force user to download the Excel file without writing it to server's HD
					$objWriter->save('php://output');				
				}	
			}
		}
		else
		{
			$this->data['tahun'] = '';
			$this->data['periode'] = '1';
			$this->data['xbulan'] = '01';
			$this->load->view('main/report_by_perkembangan_kasus_list', $this->data);
		}
	}

	function perkembangan_kasus_by_noreg()
	{
		$this->data['page_title'] = 'Report';
		
		if($_POST)
		{
			$this->data['report'] = $this->report->get_data_perkembangan_kasus_pernoreg($this->input->post('no_reg'));
			$this->data['progress'] = $this->report->get_data_progress_pernoreg($this->input->post('no_reg'));
			$this->data['no_reg'] = $this->input->post('no_reg');
									
			$this->load->view('main/report_by_perkembangan_kasus_noreg_result_list', $this->data);
			
		}
		else
		{
			$this->data['no_reg'] = '';
			$this->load->view('main/report_by_perkembangan_kasus_noreg_list', $this->data);
		}
	}
	
	function data_belum_dianalisis()
	{
		$this->data['page_title'] = 'Report';
		

		if($_POST)
		{
			if($this->input->post('report_type') == 'preview')
			{
				$this->data['report'] = $this->report->get_data_belum_dianalisis_pertahun($this->input->post('tahun'));
				$this->data['tahun'] = $this->input->post('tahun');
				
				$this->load->view('main/report_by_belum_dianalisis_result_tahun_list', $this->data);
			}
			else
			{
				$report = $this->report->get_data_belum_dianalisis_pertahun_file($this->input->post('tahun'));

				$title = 'Tahun '.$this->input->post('tahun');
				
				$this->load->library('PHPExcel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setTitle("Data Layanan Bantuan Hukum Yang Belum Dianalisis")
							->setDescription("Periode Tahun ".$this->input->post('tahun'));
				//name the worksheet
				$objPHPExcel->getActiveSheet()->setTitle($title);			
				//activate worksheet number 1
				$objPHPExcel->setActiveSheetIndex(0);
				// read data to active sheet
				$objPHPExcel->getActiveSheet()->fromArray($report);
						
					
				$filename='data_kasus_belum_dianalisis_tahun_'.$this->input->post('tahun').'_runtime_'.date('Y-m-d_H-i-s').'.xls'; //save our workbook as this file name
					
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0", false);
				header("Pragma: no-cache");
				header('Content-Type: application/vnd.ms-excel'); //mime type
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');				
			}
		}
		else
		{
			$this->data['tahun'] = '';
			
			$this->load->view('main/report_by_belum_dianalisis_list', $this->data);
		}
	}
	
	function penanganan_layanan_bantuan_hukum()
	{
		$this->data['page_title'] = 'Report';
		$this->data['periode_type'] = array('Semua' => 'Semua', 'Tahun' => 'Tahun');
		$this->data['users'] =  $this->report->get_user_list();

		if($_POST)
		{
			if($this->input->post('periode_type') == 'Semua')
			{
				$this->data['petugas'] =  $this->report->get_data_petugas($this->input->post('id_petugas'));
				$this->data['report'] = $this->report->get_data_penanganan_kasus_semua($this->input->post('id_petugas'));
				$this->data['tahun'] = $this->input->post('tahun');
				$this->data['periode'] = $this->input->post('periode_type');
				$this->data['id_petugas'] = $this->input->post('id_petugas');
					
				$this->load->view('main/report_by_penanganan_kasus_result_list', $this->data);
			}
			else
			{
				$this->data['petugas'] =  $this->report->get_data_petugas($this->input->post('id_petugas'));
				$this->data['report'] = $this->report->get_data_penanganan_kasus_pertahun($this->input->post('id_petugas'), $this->input->post('tahun'));
				$this->data['tahun'] = $this->input->post('tahun');
				$this->data['periode'] = $this->input->post('periode_type');
				$this->data['id_petugas'] = $this->input->post('id_petugas');
					
				$this->load->view('main/report_by_penanganan_kasus_result_list', $this->data);
			}
		}
		else
		{
			$this->data['tahun'] = '';
			$this->data['periode'] = 'Tahun';
			$this->data['id_petugas'] = '';
			$this->load->view('main/report_by_penanganan_kasus_list', $this->data);
		}
	}
}
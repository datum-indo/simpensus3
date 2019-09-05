<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress_model extends CI_Model {
	var $table = 'view_progress';
	var $column = array('id_progress','no_reg','tgl_progress','status_progress', 'tahap_progress', 'hasil_keputusan', 'jenis_dokumen', 'nm_processby', ); //set column field database for order and search
	var $order = array('id_progress' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	function _get_datatables_query()
	{
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$column[$i] = $item; // set column array variable to order processing
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	function get_status_progress()
	{
		$table = 'tbl_progress';
		$field = 'status_progress';
		
		$status_progress = array('' => '');
        if ($table == '' || $field == '') return $status_approval;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_progress[$value] = $value; 
        }
        return $status_progress;
	}
	
	function get_status_hasil()
	{
		$table = 'tbl_progress';
		$field = 'status_hasil';
		
		$status_hasil = array('' => '');
        if ($table == '' || $field == '') return $status_hasil;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_hasil[$value] = $value; 
        }
        return $status_hasil;
	}
	
	function get_status_sepakat()
	{
		$table = 'tbl_progress';
		$field = 'status_sepakat';
		
		$status_sepakat = array('' => '');
        if ($table == '' || $field == '') return $status_sepakat;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_sepakat[$value] = $value; 
        }
        return $status_sepakat;
	}
	
	function get_status_norma()
	{
		$table = 'tbl_progress';
		$field = 'status_norma';
		
		$status_norma = array('' => '');
        if ($table == '' || $field == '') return $status_norma;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_norma[$value] = $value; 
        }
        return $status_norma;
	}
	
	function get_status_aparat()
	{
		$table = 'tbl_progress';
		$field = 'status_aparat';
		
		$status_aparat = array('' => '');
        if ($table == '' || $field == '') return $status_aparat;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_aparat[$value] = $value; 
        }
        return $status_aparat;
	}
	
	function get_status_pencari()
	{
		$table = 'tbl_progress';
		$field = 'status_pencari';
		
		$status_pencari = array('' => '');
        if ($table == '' || $field == '') return $status_pencari;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_pencari[$value] = $value; 
        }
        return $status_pencari;
	}
	
	function get_status_kembali()
	{
		$table = 'tbl_progress';
		$field = 'status_kembali';
		
		$status_kembali = array('' => '');
        if ($table == '' || $field == '') return $status_kembali;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_kembali[$value] = $value; 
        }
        return $status_kembali;
	}
	
	function get_status_klien()
	{
		$table = 'tbl_progress';
		$field = 'status_klien';
		
		$status_klien = array('' => '');
        if ($table == '' || $field == '') return $status_klien;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_klien[$value] = $value; 
        }
        return $status_klien;
	}
	
	function get_tahap_progress()
	{
		$query = $this->db->query('SELECT * FROM tbl_tahap_progress ORDER BY no_urut ASC');
		$tahap_progress = array('' => '');
		foreach ($query->result() as $detail_tahap_progress)
		{
                $tahap_progress[$detail_tahap_progress->id_tahap_progress] = $detail_tahap_progress->tahap_progress;
        }
		return $tahap_progress;
	}
	
	
	function get_jenis_dokumen()
	{
		$query = $this->db->query('SELECT * FROM tbl_jenis_dokumen WHERE id_section_process="4" ORDER BY no_urut ASC');
		$jenis_dokumen = array('' => '');
		foreach ($query->result() as $detail_jenis_dokumen)
		{
                $jenis_dokumen[$detail_jenis_dokumen->id_jenis_dokumen] = $detail_jenis_dokumen->jenis_dokumen;
        }
		return $jenis_dokumen;
	}
	
	function get_progress_add()
	{
		$id_user = $this->session->userdata('id_user');
		$id_role = $this->session->userdata('id_role');
		if($id_role == '1' || $id_role == '2' || $id_role == '3')
		{
			$query = $this->db->query('SELECT tbl_approval.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
									   FROM tbl_approval
									   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_kasus_selesai ON tbl_approval.id_permohonan = tbl_kasus_selesai.id_permohonan
									   WHERE tbl_kasus_selesai.id_permohonan IS NULL AND tbl_approval.status_approval = "Diterima"
									   ORDER BY tbl_approval.id_permohonan ASC');
		}
		else if($id_role == '4')
		{
			$query = $this->db->query('SELECT tbl_approval.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
									   FROM tbl_approval
									   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_kasus_selesai ON tbl_approval.id_permohonan = tbl_kasus_selesai.id_permohonan
									   WHERE tbl_kasus_selesai.id_permohonan IS NULL AND tbl_approval.status_approval = "Diterima"
									   AND (tbl_approval.id_analis ="'.$id_user.'" OR tbl_approval.id_asisten ="'.$id_user.'")
									   ORDER BY tbl_approval.id_permohonan ASC');
		}
		else 
		{
			$query = $this->db->query('SELECT tbl_approval.id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
									   FROM tbl_approval
									   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
									   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
									   LEFT JOIN tbl_kasus_selesai ON tbl_approval.id_permohonan = tbl_kasus_selesai.id_permohonan
									   WHERE tbl_kasus_selesai.id_permohonan IS NULL AND tbl_approval.status_approval = "Diterima"
									   AND tbl_approval.id_asisten ="'.$id_user.'"
									   ORDER BY tbl_approval.id_permohonan ASC');
		}
		
		$approval = array('' => '');
		foreach ($query->result() as $detail_approval)
		{
            $approval[$detail_approval->id_permohonan] = $detail_approval->no_reg. ' | '. $detail_approval->nm_pemohon;
		}
		return $approval;
	}
	
	function get_id_tindakan_by_id_permohonan($id_permohonan)
	{
		$query = $this->db->query('SELECT tbl_approval.id_tindakan FROM tbl_approval WHERE id_permohonan="'.$id_permohonan.'"');
				
		return $id_tindakan = $query->row();
	}
	
	function get_hasil_keputusan_by_id_permohonan($id_permohonan)
	{
		$query = $this->db->query('SELECT tbl_hasil_keputusan.id_hasil_keputusan, tbl_hasil_keputusan.hasil_keputusan
								   FROM tbl_hasil_keputusan
								   LEFT JOIN tbl_hasil_keputusan_jenis_kasus ON tbl_hasil_keputusan.id_hasil_keputusan = tbl_hasil_keputusan_jenis_kasus.id_hasil_keputusan
								   LEFT JOIN tbl_approval ON tbl_approval.id_jenis_kasus = tbl_hasil_keputusan_jenis_kasus.id_jenis_kasus
								   WHERE tbl_approval.id_permohonan ="'.$id_permohonan.'" 
								   ORDER BY id_hasil_keputusan ASC');
		$hasil_keputusan = array();
		foreach ($query->result() as $detail_hasil_keputusan)
		{
                $hasil_keputusan[$detail_hasil_keputusan->id_hasil_keputusan] = $detail_hasil_keputusan->hasil_keputusan;
        }
		return $hasil_keputusan;
	}
	
	function get_detail_progress($id_progress)
	{
		$progress = $this->db->query('SELECT tbl_progress.*, tbl_approval.id_tindakan 
									  FROM tbl_progress LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
									  WHERE tbl_progress.id_progress ="'.$id_progress.'"');
		return $progress->row();						   
	}
	
	function get_progress_edit($id_permohonan)
	{
		$query = $this->db->query('SELECT tbl_permohonan.id_permohonan AS id_permohonan, tbl_permohonan.no_reg AS no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   WHERE tbl_permohonan.id_permohonan ='.$id_permohonan.'');
		foreach ($query->result() as $detail_permohonan)
		{
            $permohonan[$detail_permohonan->id_permohonan] = $detail_permohonan->no_reg.' | '.$detail_permohonan->nm_pemohon;
		}
		return $permohonan;						   
	}
	
	
	function get_detail_file_attachment($id_section_process, $id_process, $id_jenis_dokumen)
	{
		$query = $this->db->query('SELECT tbl_file_attachment.id_file, tbl_file_attachment.nm_file, tbl_file_attachment.nm_asli, tbl_file_attachment.nm_baru
								   FROM tbl_file_attachment
								   WHERE
								   tbl_file_attachment.id_section_process = "'.$id_section_process.'" AND
								   tbl_file_attachment.id_process = "'.$id_process.'" AND
								   tbl_file_attachment.id_jenis_dokumen = "'.$id_jenis_dokumen.'"
								   ORDER BY tbl_file_attachment.id_file ASC');
		
		$file_attachment = $query;
		
		
		return $file_attachment;	
	}
	
	function get_id_progress()
	{
		$query = $this->db->query("SELECT IFNULL(MAX(nomor)+1,1) AS nomor FROM tbl_progress WHERE DATE_FORMAT(insert_date,'%Y%M')= DATE_FORMAT(NOW(),'%Y%M')");
		$row = $query->row();
		$nomor = $row->nomor;
				
		$tahun = date ('Ym');
		$id_progress = sprintf( '%s%04d' , $tahun , $nomor );
		
		$progress = array('nomor' => $nomor,
						  'id_progress' => $id_progress
		);
		
		return $progress;
	}
	
	function save_detail_file($data_file)
	{
		$this->db->insert('tbl_file_attachment', $data_file);
		$id_file = $this->db->insert_id();
		return $id_file;				   
	}
	
	function delete_detail_attachment($id_file)
	{
		$query = $this->db->query('SELECT tbl_file_attachment.nm_file FROM tbl_file_attachment WHERE tbl_file_attachment.id_file="'.$id_file.'"');
		$row = $query->row();
		$filename = $row->nm_file;
		
		$destination = './media/files_progress/';
		@unlink($destination.$filename);
						
		$this->db->where('id_file', $id_file);
		$this->db->delete('tbl_file_attachment');
	}
	
	function save_kasus_selesai($id_permohonan)
	{
		$data = array ('id_permohonan'=> $id_permohonan);
		$this->db->insert('tbl_kasus_selesai',$data);			   
	}
	
	function save_schedule($schedule_data)
	{
		$this->db->insert('tbl_progress_schedule', $schedule_data);
		return $this->db->insert_id();				   
	}
	
	function save_detail_progress($data)
	{
		$this->db->insert('tbl_progress', $data);
		return $this->db->insert_id();				   
	}
	
	function update_detail_file($file_attachment, $id_jenis_dokumen, $id_permohonan, $id_process, $id_section_process)
	{
		for($i = 0; $i < count($file_attachment); $i++)
		{
			$query = $this->db->query("SELECT nomor AS nomor FROM tbl_file_attachment WHERE tbl_file_attachment.id_file ='".$file_attachment[$i]."'");
			$row = $query->row();
			$nomor = $row->nomor;
			
			if($nomor == 0)
			{
				$query = $this->db->query("SELECT IFNULL(MAX(nomor)+1,1) AS nomor FROM tbl_file_attachment WHERE DATE_FORMAT(upload_date,'%Y%m')= DATE_FORMAT(NOW(),'%Y%m')");
				$row = $query->row();
				$nomor = $row->nomor;
				
				$query = $this->db->query("SELECT nm_file AS nm_file FROM tbl_file_attachment WHERE tbl_file_attachment.id_file ='".$file_attachment[$i]."'");
				$row = $query->row();
				$nm_file = $row->nm_file;

				$ext = pathinfo($nm_file, PATHINFO_EXTENSION);
				
				$date = date('mdHis');
		
				$nm_baru = sprintf('ATT-%s-%s-%02d%03d.%s', $id_permohonan, $date, $id_jenis_dokumen, $nomor, $ext);
				
				$data = array('id_jenis_dokumen' => $id_jenis_dokumen,
							  'id_permohonan' => $id_permohonan,	
							  'id_process' => $id_process,
							  'id_section_process' => $id_section_process,
							  'nomor' => $nomor,
							  'nm_baru' => $nm_baru
				);	
			}
			else
			{
				$data = array('id_jenis_dokumen' => $id_jenis_dokumen,
							  'id_permohonan' => $id_permohonan,	
							  'id_process' => $id_process,
							  'id_section_process' => $id_section_process
				);	
			}		
			
			$this->db->update('tbl_file_attachment', $data, array('id_file' => $file_attachment[$i]));
		}
	}
	
	function delete_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_progress_schedule');  
	}
	
	function delete_approval_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_approval_schedule');  
	}
	
	function delete_detail_progress($id_progress)
	{
		$query = $this->db->query('SELECT tbl_progress.status_progress FROM tbl_progress WHERE tbl_progress.id_progress="'.$id_progress.'"');
		$status_progress = $query->row('status_progress');
		
		$query = $this->db->query('SELECT tbl_progress.id_permohonan FROM tbl_progress WHERE tbl_progress.id_progress="'.$id_progress.'"');
		$id_permohonan = $query->row('id_permohonan');
			
		if($status_progress == 'Selesai' || $status_progress == 'Gugur')
		{
			$this->delete_schedule($id_permohonan);
			$schedule_data = array ('id_permohonan' => $id_permohonan, 
									'date_schedule' => date('Y-m-d')
			);
			$this->save_schedule($schedule_data);
			
			$case_status = array('case_status' => '1');
			$status_permohonan = array('status_permohonan' => '1');
			
			$this->update_analisis(array('id_permohonan' => $id_permohonan), $case_status);
			$this->update_progress(array('id_permohonan' => $id_permohonan), $case_status);
			$this->update_approval(array('id_permohonan' => $id_permohonan), $case_status);	
			$this->update_permohonan(array('id_permohonan' => $id_permohonan), $status_permohonan);
						
			$this->db->where('id_progress', $id_progress);
			$this->db->delete('tbl_progress');
					
			$this->db->where('id_permohonan', $id_permohonan);
			$this->db->delete('tbl_kasus_selesai');
				
		}
		else
		{
			$this->db->where('id_progress', $id_progress);
			$this->db->delete('tbl_progress');	
			
			/*	
			$this->db->where('id_permohonan', $id_permohonan);
			$this->db->delete('tbl_progress_schedule'); 	
			*/
		}		
	}
	
	function delete_kasus_selesai($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_kasus_selesai');  
	}
	
	function delete_attachment_progress($id_progress)
	{
		$query = $this->db->query('SELECT tbl_file_attachment.id_file, tbl_file_attachment.nm_file
								   FROM tbl_file_attachment
								   WHERE tbl_file_attachment.id_process = "'.$id_progress.'" 
								   ORDER BY tbl_file_attachment.id_file ASC');
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$id_file = $row->id_file;
				$nm_file = $row->nm_file;
								
				$destination = './media/files_progress/';
				@unlink($destination.$nm_file);
		
				$this->db->where('id_file', $id_file);
				$this->db->delete('tbl_file_attachment');
			}	
		}	
	}
	
	function update_detail_progress($id_progress, $data)
	{
		$this->db->update('tbl_progress', $data, $id_progress);
		return $this->db->affected_rows();			   
	}
	
	function get_filename($id_file)
	{
		$query = $this->db->query("SELECT nm_file AS nm_file FROM tbl_file_attachment WHERE id_file='".$id_file."'");
		$row = $query->row();
		$filename = $row->nm_file;
		
		return $filename;
	}
	
	function get_nm_baru($id_file)
	{
		$query = $this->db->query("SELECT nm_baru AS nm_baru FROM tbl_file_attachment WHERE id_file='".$id_file."'");
		$row = $query->row();
		$nm_baru = $row->nm_baru;
		
		return $nm_baru;
	}
	
	function view_detail_progress($id_progress)
	{
		$progress = $this->db->query("SELECT tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress,
									  tbl_approval.id_tindakan, tbl_hasil_keputusan.hasil_keputusan, tbl_progress.uraian_keputusan, tbl_progress.status_hasil, tbl_progress.status_sepakat, tbl_progress.note_progress, tbl_progress.status_norma, tbl_progress.uraian_norma,
									  tbl_progress.status_aparat, tbl_progress.uraian_aparat, tbl_progress.status_pencari, tbl_progress.uraian_pencari, tbl_progress.status_kembali, 
									  tbl_tahap_progress.tahap_progress, tbl_progress.uraian_progress, tbl_progress.status_klien, tbl_progress.uraian_klien, 
									  DATE_FORMAT(tbl_progress.tgl_progress_next, '%d/%m/%Y') AS tgl_progress_next, tbl_tahap_progress_next.tahap_progress AS tahap_progress_next, tbl_progress.uraian_progress_next,
									  tbl_progress.id_jenis_dokumen, tbl_jenis_dokumen.jenis_dokumen
									  FROM tbl_progress 
									  LEFT JOIN tbl_permohonan ON tbl_progress.id_permohonan = tbl_permohonan.id_permohonan 
									  LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									  LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan	
									  LEFT JOIN tbl_approval ON tbl_progress.id_permohonan = tbl_approval.id_permohonan 
									  LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan 
									  LEFT JOIN tbl_tahap_progress ON tbl_progress.id_tahap_progress = tbl_tahap_progress.id_tahap_progress
									  LEFT JOIN tbl_tahap_progress AS tbl_tahap_progress_next ON tbl_progress.id_tahap_progress_next = tbl_tahap_progress_next.id_tahap_progress
									  LEFT JOIN tbl_jenis_dokumen ON tbl_progress.id_jenis_dokumen = tbl_jenis_dokumen.id_jenis_dokumen
									  WHERE tbl_progress.id_progress ='".$id_progress."'");
		return $progress->row();						   
	}
	
	function update_analisis($id_permohonan, $case_status)
	{
		$this->db->update('tbl_analisis', $case_status, $id_permohonan);
		return $this->db->affected_rows();				   
	}
	
	function update_progress($id_permohonan, $case_status)
	{
		$this->db->update('tbl_progress', $case_status, $id_permohonan);
		return $this->db->affected_rows();				   
	}
	
	function update_approval($id_permohonan, $case_status)
	{
		$this->db->update('tbl_approval', $case_status, $id_permohonan);
		return $this->db->affected_rows();				   
	}
	
	function update_permohonan($id_permohonan, $status_permohonan)
	{
		$this->db->update('tbl_permohonan', $status_permohonan, $id_permohonan);
		return $this->db->affected_rows();				   
	}
	
	function get_id_permohonan($id_progress)
	{
		$query = $this->db->query("SELECT tbl_progress.id_permohonan AS id_permohonan FROM tbl_progress WHERE tbl_progress.id_progress ='".$id_progress."'");
		$row = $query->row();
		$id_permohonan = $row->id_permohonan;
		
		return $id_permohonan;
	}
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_jkel()
	{
		$table = 'tbl_pemohon';
		$field = 'jkel';
		
		//$jkel = array('' => '');
        if ($table == '' || $field == '') return $jkel;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $jkel[$value] = $value; 
		}
		$jkel=array("Laki-laki"=>"Laki-laki","Perempuan"=>"Perempuan","Lainnya"=>"Lainnya");
        return $jkel;
	}
	
	function get_golongan_darah()
	{
		$query = $this->db->query('SELECT * FROM tbl_golongan_darah ORDER BY id_golongan_darah ASC');
		$golongan_darah = array('' => '');
		foreach ($query->result() as $detail_golongan_darah)
		{
                $golongan_darah[$detail_golongan_darah->id_golongan_darah] = $detail_golongan_darah->golongan_darah;
        }
		return $golongan_darah;
		
	}
	
	function get_kondisi_fisik()
	{
		$table = 'tbl_pemohon';
		$field = 'kondisi_fisik';
		
		//$kondisi_fisik = array('' => '');
        if ($table == '' || $field == '') return $kondisi_fisik;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $kondisi_fisik[$value] = $value; 
        }
        return $kondisi_fisik;
	}
	
	function get_difabel()
	{
		$query = $this->db->query('SELECT * FROM tbl_difabel ORDER BY no_urut ASC');
		$difabels = array('' => '');
		foreach ($query->result() as $difabel)
		{
                $difabels[$difabel->id_difabel] = $difabel->jenis_difabel;
        }		
		return $difabels;
	}
	
	function get_status_perkawinan()
	{
		$table = 'tbl_pemohon';
		$field = 'status_perkawinan';
		
		$status_perkawinan = array('' => '');
        if ($table == '' || $field == '') return $status_perkawinan;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_perkawinan[$value] = $value; 
        }
        return $status_perkawinan;
	}
	
	function get_pendidikan()
	{
		$query = $this->db->query('SELECT * FROM tbl_pendidikan ORDER BY no_urut ASC');
		$pendidikan = array('' => '');
		foreach ($query->result() as $data_pendidikan)
		{
                $pendidikan[$data_pendidikan->id_pendidikan] = $data_pendidikan->nm_pendidikan;
        }
		
        return $pendidikan;
	}
	
	function get_agama()
	{
		$query = $this->db->query('SELECT * FROM tbl_agama ORDER BY no_urut ASC');
		$agamas = array('' => '');
		foreach ($query->result() as $agama)
		{
                $agamas[$agama->id_agama] = $agama->nm_agama;
        }
		return $agamas;
		
	}

	function get_count_unit()
	{
		$query = $this->db->query('SELECT * FROM mt_vocab where KODE_LIST=7 ORDER BY URUTAN ASC');
		$count_units = array('' => '');
		foreach ($query->result() as $count_unit)
		{
                $count_units[$count_unit->KODE] = $count_unit->TEKS;
        }
		return $count_units;
		
	}
	
	function get_kewarganegaraan()
	{
		$table = 'tbl_pemohon';
		$field = 'kewarganegaraan';
		
		$kewarganegaraan = array('' => '');
        if ($table == '' || $field == '') return $kewarganegaraan;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $kewarganegaraan[$value] = $value; 
        }
        return $kewarganegaraan;
	}
	
	function get_negara()
	{
		$query = $this->db->query('SELECT * FROM tbl_negara ORDER BY id_negara ASC');
		$negaras = array('' => '');
		foreach ($query->result() as $negara)
		{
                $negaras[$negara->id_negara] = $negara->nm_negara;
        }
		return $negaras;
	}
	
	function get_pekerjaan()
	{
		$query = $this->db->query('SELECT * FROM tbl_pekerjaan ORDER BY no_urut ASC');
		$pekerjaans = array('' => '');
		foreach ($query->result() as $pekerjaan)
		{
                $pekerjaans[$pekerjaan->id_pekerjaan] = $pekerjaan->jenis_pekerjaan;
        }
		return $pekerjaans;		
	}
	
	function get_pekerjaan2()
	{
		$table = 'tbl_pemohon';
		$field = 'pekerjaan2';
		
		//$pekerjaan2 = array('' => '');
        if ($table == '' || $field == '') return $pekerjaan2;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $pekerjaan2[$value] = $value; 
        }
        return $pekerjaan2;
	}
	
	function get_pekerjaansi()
	{
		$table = 'tbl_pemohon';
		$field = 'pekerjaansi';
		
		//$pekerjaansi = array('' => '');
        if ($table == '' || $field == '') return $pekerjaansi;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $pekerjaansi[$value] = $value; 
        }
        return $pekerjaansi;
	}
	
	function get_penghasilan()
	{
		$query = $this->db->query('SELECT * FROM tbl_penghasilan ORDER BY no_urut ASC');
		$penghasilan = array('' => '');
		foreach ($query->result() as $daftar_penghasilan)
		{
                $penghasilan[$daftar_penghasilan->id_penghasilan] = $daftar_penghasilan->jml_penghasilan;
        }
		return $penghasilan;
	}
	
	function get_status_tempat_tinggal()
	{
		$table = 'tbl_pemohon';
		$field = 'status_tempat_tinggal';
		
		$status_tempat_tinggal = array('' => '');
        if ($table == '' || $field == '') return $status_tempat_tinggal;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_tempat_tinggal[$value] = $value; 
        }
        return $status_tempat_tinggal;
	}
	
	function get_provinsi()
	{
		$query = $this->db->query('SELECT * FROM tbl_provinsi ORDER BY id_provinsi ASC');
		$provinsis = array('' => '');
		foreach ($query->result() as $provinsi)
		{
                $provinsis[$provinsi->id_provinsi] = $provinsi->nm_provinsi;
        }
		return $provinsis;
	}
	
	function get_kabkota()
	{
		$query = $this->db->query('SELECT * FROM tbl_kabkota ORDER BY id_kabkota ASC');
		$kabkotas = array('' => '');
		foreach ($query->result() as $kabkota)
		{
                $kabkotas[$kabkota->id_kabkota] = $kabkota->nm_kabkota;
        }
		return $kabkotas;
	}
	
	function get_kecamatan()
	{
		$query = $this->db->query('SELECT * FROM tbl_kecamatan ORDER BY id_kecamatan ASC');
		$kecamatans = array('' => '');
		foreach ($query->result() as $kecamatan)
		{
                $kecamatans[$kecamatan->id_kecamatan] = $kecamatan->nm_kecamatan;
        }
		return $kecamatans;
	}
	
	function get_desa()
	{
		$query = $this->db->query('SELECT * FROM tbl_desa ORDER BY id_desa ASC');
		$desas = array('' => '');
		foreach ($query->result() as $desa)
		{
                $desas[$desa->id_desa] = $desa->nm_desa;
        }
		return $desas;
	}
		
	function get_jarak_tempuh()
	{
		$query = $this->db->query('SELECT * FROM tbl_jarak_tempuh ORDER BY id_jarak_tempuh ASC');
		$jarak_tempuh = array('' => '');
		foreach ($query->result() as $data_jarak_tempuh)
		{
                $jarak_tempuh[$data_jarak_tempuh->id_jarak_tempuh] = $data_jarak_tempuh->jarak_tempuh;
        }
        return $jarak_tempuh;
	}
	
	function get_waktu_tempuh()
	{
		$query = $this->db->query('SELECT * FROM tbl_waktu_tempuh ORDER BY id_waktu_tempuh ASC');
		$waktu_tempuh = array('' => '');
		foreach ($query->result() as $data_waktu_tempuh)
		{
                $waktu_tempuh[$data_waktu_tempuh->id_waktu_tempuh] = $data_waktu_tempuh->waktu_tempuh;
        }
        return $waktu_tempuh;
	}
	
	function get_pernah_jadi_client()
	{
		$table = 'tbl_pemohon';
		$field = 'pernah_jadi_client';
		
		//$pernah_jadi_client = array('' => '');
        if ($table == '' || $field == '') return $pernah_jadi_client;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $pernah_jadi_client[$value] = $value; 
        }
        return $pernah_jadi_client;
	}
	
	function get_sumber_info()
	{
		$query = $this->db->query('SELECT * FROM tbl_sumber_info ORDER BY no_urut ASC');
		$sumber_infos = array('' => '');
		foreach ($query->result() as $sumber_info)
		{
                $sumber_infos[$sumber_info->id_sumber_info] = $sumber_info->nm_sumber_info;
        }		
		return $sumber_infos;
	}
	
	function get_rekomendasi_lbh()
	{
		$table = 'tbl_pemohon';
		$field = 'rekomendasi_lbh';
		
		//$rekomendasi_lbh = array('' => '');
        if ($table == '' || $field == '') return $rekomendasi_lbh;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $rekomendasi_lbh[$value] = $value; 
        }
        return $rekomendasi_lbh;
	}
	
	function get_jenis_kid()
	{
		$table = 'tbl_pemohon';
		$field = 'jenis_kid';
		
		$jenis_kid = array('' => '');
        if ($table == '' || $field == '') return $jenis_kid;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $jenis_kid[$value] = $value; 
        }
        return $jenis_kid;
	}
	
	function get_jenis_ktm()
	{
		$table = 'tbl_pemohon';
		$field = 'jenis_ktm';
		
		$jenis_ktm = array('' => '');
        if ($table == '' || $field == '') return $jenis_ktm;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $jenis_ktm[$value] = $value; 
        }
        return $jenis_ktm;
	}
	
	function get_status_pemohon()
	{
		$table = 'tbl_pemohon';
		$field = 'status_pemohon';
		
		//$status_pemohon = array('' => '');
        if ($table == '' || $field == '') return $status_pemohon;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_pemohon[$value] = $value; 
        }
        return $status_pemohon;
	}
	
	function get_kabkota_by_id_provinsi($id_provinsi)
	{
		$query = $this->db->query('SELECT * FROM tbl_kabkota WHERE id_provinsi="'.$id_provinsi.'"ORDER BY id_kabkota ASC');
		$kabkota = array();
		foreach ($query->result() as $kabkotas)
		{
                $kabkota[$kabkotas->id_kabkota] = $kabkotas->nm_kabkota;
        }
		return $kabkota;
	}
	
	function get_kecamatan_by_id_kabkota($id_kabkota)
	{
		$query = $this->db->query('SELECT * FROM tbl_kecamatan WHERE id_kabkota="'.$id_kabkota.'"ORDER BY id_kecamatan ASC');
		$kecamatan = array();
		foreach ($query->result() as $kecamatans)
		{
                $kecamatan[$kecamatans->id_kecamatan] = $kecamatans->nm_kecamatan;
        }
		return $kecamatan;
	}
	
	function get_desa_by_id_kecamatan($id_kecamatan)
	{
		$query = $this->db->query('SELECT * FROM tbl_desa WHERE id_kecamatan="'.$id_kecamatan.'"ORDER BY id_desa ASC');
		$desa = array();
		foreach ($query->result() as $desas)
		{
               $desa[$desas->id_desa] = $desas->nm_desa;
        }
		return $desa;
	}
	
	function get_umur_pemohon($tgl_lahir)
	{
		$birthDate = $tgl_lahir;
		//explode the date to get month, day and year
		$birthDate = explode("-", $birthDate);
		//get age from date or birthdate
		$umur = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
		? ((date("Y") - $birthDate[0]) - 1)
		: (date("Y") - $birthDate[0]));
		
		return $umur;						   
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
		
		$destination = './media/files_permohonan/';
		@unlink($destination.$filename);
						
		$this->db->where('id_file', $id_file);
		$this->db->delete('tbl_file_attachment');
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
	
	function save_detail_pemohon($data_pemohon)
	{
		$this->db->insert('tbl_pemohon', $data_pemohon);
		return $this->db->insert_id();				   
	}
	
	function save_detail_penerima($data_penerima)
	{
		$this->db->insert('tbl_penerima', $data_penerima);
		return $this->db->insert_id();				   
	}
	
	function get_detail_pemohon($id_permohonan)
	{
		$detail_pemohon = $this->db->query('SELECT * FROM tbl_pemohon WHERE id_permohonan="'.$id_permohonan.'"');
		return $detail_pemohon->row();						   
	}
	
	function get_detail_penerima($id_permohonan)
	{
		$detail_penerima = $this->db->query('SELECT * FROM tbl_penerima WHERE id_permohonan="'.$id_permohonan.'"');
		return $detail_penerima->row();						   
	}
	
	function get_detail_file_attachment($id_section_progress, $id_process, $id_jenis_dokumen)
	{
		$query = $this->db->query('SELECT tbl_file_attachment.id_file, tbl_file_attachment.nm_file, tbl_file_attachment.nm_asli, tbl_file_attachment.nm_baru
								   FROM tbl_file_attachment
								   WHERE
								   tbl_file_attachment.id_section_process = "'.$id_section_progress.'" AND
								   tbl_file_attachment.id_process = "'.$id_process.'" AND
								   tbl_file_attachment.id_jenis_dokumen = "'.$id_jenis_dokumen.'"
								   ORDER BY tbl_file_attachment.id_file ASC');
		$file_attachment = $query;
		
		return $file_attachment;	
	}
	
	function update_detail_pemohon($id_permohonan, $data_pemohon)
	{
		$this->db->update('tbl_pemohon', $data_pemohon, $id_permohonan);
		return $this->db->affected_rows();			   
	}
	
	function update_detail_penerima($id_permohonan, $data_penerima)
	{
		$this->db->update('tbl_penerima', $data_penerima, $id_permohonan);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_pemohon($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_pemohon');
	}
	
	function delete_detail_penerima($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_penerima');
	}
	
	function delete_attachment_pemohon($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_file_attachment.id_file, tbl_file_attachment.nm_file
								   FROM tbl_file_attachment
								   WHERE tbl_file_attachment.id_process = '".$id_permohonan."'
								   AND tbl_file_attachment.id_section_process != '3'	
								   ORDER BY tbl_file_attachment.id_file ASC");
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$id_file = $row->id_file;
				$nm_file = $row->nm_file;
								
				$destination = './media/files_permohonan/';
				@unlink($destination.$nm_file);
		
				$this->db->where('id_file', $id_file);
				$this->db->delete('tbl_file_attachment');
			}	
		}	
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
}

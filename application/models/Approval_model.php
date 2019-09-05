<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model {
	var $table = 'view_approval';
	var $column = array('id_approval', 'id_permohonan', 'no_reg', 'tgl_approval', 'status_approval', 'jenis_kasus', 'jenis_tindakan', 'nm_analis', 'nm_asisten', 'nm_processby'); //set column field database for order and search
	var $order = array('id_approval' => 'desc'); // default order 
	
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
	
	
	function get_jenis_kasus()
	{
		$query = $this->db->query('SELECT * FROM tbl_jenis_kasus ORDER BY id_jenis_kasus ASC');
		$jenis_kasuss = array('' => '');
		foreach ($query->result() as $jenis_kasus)
		{
                $jenis_kasuss[$jenis_kasus->id_jenis_kasus] = $jenis_kasus->jenis_kasus;
        }
		return $jenis_kasuss;
	}
	
	
	function get_nama_kasus_by_id_jenis_kasus($id_jenis_kasus)
	{
		$query = $this->db->query('SELECT * FROM tbl_nama_kasus WHERE id_jenis_kasus="'.$id_jenis_kasus.'"ORDER BY no_urut ASC');
		$nama_kasus = array();
		foreach ($query->result() as $nama_kasuss)
		{
                $nama_kasus[$nama_kasuss->id_nama_kasus] = $nama_kasuss->nama_kasus;
        }
		return $nama_kasus;
	}
	
	
	function get_posisi_hukum_by_id_jenis_kasus($id_jenis_kasus)
	{
		//$query = $this->db->query('SELECT * FROM tbl_posisi_hukum WHERE id_jenis_kasus="'.$id_jenis_kasus.'"ORDER BY id_posisi_hukum ASC');
		
		if($id_jenis_kasus == '1')
		{
			$query = $this->db->query("SELECT * FROM tbl_posisi_hukum WHERE id_posisi_hukum != '7' AND id_posisi_hukum != '8' ORDER BY id_posisi_hukum ASC");		
		}
		else
		{
			$query = $this->db->query("SELECT * FROM tbl_posisi_hukum WHERE id_posisi_hukum = '7' OR id_posisi_hukum = '8' ORDER BY id_posisi_hukum ASC");		
		}		
		
		$posisi_hukum = array();
		foreach ($query->result() as $posisi_hukums)
		{
                $posisi_hukum[$posisi_hukums->id_posisi_hukum] = $posisi_hukums->posisi_hukum;
        }
		return $posisi_hukum;
	}
	
	function get_status_approval()
	{
		$table = 'tbl_approval';
		$field = 'status_approval';
		
		$status_approval = array('' => '');
        if ($table == '' || $field == '') return $status_approval;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_approval[$value] = $value; 
        }
        return $status_approval;
	}
	
	function get_status_rekomendasi()
	{
		$table = 'tbl_approval';
		$field = 'status_rekomendasi';
		
		$status_rekomendasi = array('' => '');
        if ($table == '' || $field == '') return $status_rekomendasi;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_rekomendasi[$value] = $value; 
        }
        return $status_rekomendasi;
	}
	
	function get_tindakan()
	{
		$query = $this->db->query('SELECT * FROM tbl_tindakan ORDER BY id_tindakan ASC');
		$tindakans = array('' => '');
		foreach ($query->result() as $tindakan)
		{
                $tindakans[$tindakan->id_tindakan] = $tindakan->jenis_tindakan;
        }
		return $tindakans;
	}
	
	function get_alasan_penolakan()
	{
		//$alasan_penolakans = $this->db->query('SELECT * FROM tbl_alasan_penolakan ORDER BY no_urut ASC');
		//return $alasan_penolakans;
		
		$query = $this->db->query('SELECT * FROM tbl_alasan_penolakan ORDER BY no_urut ASC');
		$alasan_penolakans = array('' => '');
		foreach ($query->result() as $alasan_penolakan)
		{
                $alasan_penolakans[$alasan_penolakan->id_alasan_penolakan] = $alasan_penolakan->isi_alasan_penolakan;
        }
		return $alasan_penolakans;
	}
	
	function get_advokat()
	{
		$query = $this->db->query('SELECT * FROM tbl_advokat  ORDER BY id_advokat ASC');
		$advokat = array('' => '');
		foreach ($query->result() as $detail_advokat)
		{
                $advokat[$detail_advokat->id_advokat] = $detail_advokat->nama_advokat;
        }
		return $advokat;
	}
	
	function get_analis()
	{
		$id_role = $this->session->userdata('id_role');
		$id_user = $this->session->userdata('id_user');
		
		if($id_role == '1')
		{
			$query = $this->db->query("SELECT * FROM tbl_user WHERE id_role = 2 OR id_role = 3 OR id_role = 4 OR id_user = '".$id_user."' AND (id_user != '201600000' AND id_user != '201609000') AND user_status = 'Aktif' ORDER BY id_user ASC ");
		}
		else if($id_role == '2')
		{
			$query = $this->db->query("SELECT * FROM tbl_user WHERE id_role = 3 OR id_role = 4 OR id_user = '".$id_user."' AND user_status = 'Aktif' ORDER BY id_user ASC ");
		}
		else
		{
			$query = $this->db->query("SELECT * FROM tbl_user WHERE id_role = 4 OR id_user = '".$id_user."' AND user_status = 'Aktif' ORDER BY id_user ASC");
		}
		
		$analis = array('' => '');
		foreach ($query->result() as $detail_analis)
		{
                $analis[$detail_analis->id_user] = $detail_analis->fullname;
        }
		return $analis;
	}
	
	function get_asisten()
	{
		$query = $this->db->query("SELECT * FROM tbl_user WHERE id_role = 5 AND user_status = 'Aktif' ORDER BY id_user ASC");
		$asisten = array('' => '');
		foreach ($query->result() as $detail_asisten)
		{
                $asisten[$detail_asisten->id_user] = $detail_asisten->fullname;
        }
		return $asisten;
	}
	
	function get_approval_add()
	{
		$query = $this->db->query('SELECT tbl_permohonan.id_permohonan AS id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima 
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan 
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_approval ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   WHERE tbl_approval.id_permohonan IS NULL ORDER BY tbl_permohonan.id_permohonan DESC');
								   
		$permohonans = array('' => '');
		foreach ($query->result() as $permohonan)
		{
            $permohonans[$permohonan->id_permohonan] = $permohonan->no_reg.' | '.$permohonan->nm_pemohon;
		}
		return $permohonans;
	}
	
	function get_id_approval()
	{
		$query = $this->db->query("SELECT IFNULL(MAX(nomor)+1,1) AS nomor FROM tbl_approval WHERE DATE_FORMAT(insert_date,'%Y')= DATE_FORMAT(NOW(),'%Y')");
		$row = $query->row();
		$nomor = $row->nomor;
				
		$tahun = date ('Y');
		$id_approval = sprintf( '%s%04d' , $tahun , $nomor );
		
		$approval = array('nomor' => $nomor,
						  'id_approval' => $id_approval
		);
		
		return $approval;
	}
	
	function get_detail_approval($id_permohonan)
	{
		$approval = $this->db->query('SELECT * FROM tbl_approval WHERE id_permohonan="'.$id_permohonan.'"');
		return $approval->row();						   
	}
	
	function get_approval_edit($id_permohonan)
	{
		$query = $this->db->query('SELECT tbl_permohonan.id_permohonan AS id_permohonan, tbl_permohonan.no_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima 
								   FROM tbl_permohonan 
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan 
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_approval ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   WHERE tbl_permohonan.id_permohonan ='.$id_permohonan.'');
		//$permohonan = array('' => '');
		foreach ($query->result() as $detail_permohonan)
		{
            $permohonan[$detail_permohonan->id_permohonan] = $detail_permohonan->no_reg.' | '.$detail_permohonan->nm_pemohon;
		}
		return $permohonan;						   
	}
	
	function get_detail_alasan_penolakan($id_permohonan)
	{
		$query = $this->db->query('SELECT id_alasan_penolakan FROM tbl_approval_alasan_penolakan WHERE id_permohonan="'.$id_permohonan.'" ORDER BY id_alasan_penolakan ASC');
		
				
		foreach ($query->result() as $row)
		{
			$alasan_penolakan[$row->id_alasan_penolakan] = $row->id_alasan_penolakan;
		}
		
		$alasan_penolakan = implode (",", $alasan_penolakan);
		
		$alasan = array('alasan_penolakan' => $alasan_penolakan);
		
		return $alasan;						   
	}
	
	function save_detail_approval($data)
	{
		$this->db->insert('tbl_approval', $data);
		return $this->db->insert_id();				   
	}
	
	function save_approval_schedule($schedule_data)
	{
		$this->db->insert('tbl_approval_schedule', $schedule_data);
		return $this->db->insert_id();				   
	}
	
	function save_progress_schedule($schedule_data)
	{
		$this->db->insert('tbl_progress_schedule', $schedule_data);
		return $this->db->insert_id();				   
	}
	
	function save_analisis_schedule($schedule_data)
	{
		$this->db->insert('tbl_analisis_schedule', $schedule_data);
		return $this->db->insert_id();				   
	}
	
	function check_status_progress($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_kasus_selesai.id_permohonan FROM tbl_kasus_selesai WHERE tbl_kasus_selesai.id_permohonan = '".$id_permohonan."'");
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}
	
	function check_status_analisis($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_analisis.id_permohonan FROM tbl_analisis WHERE tbl_analisis.id_permohonan = '".$id_permohonan."'");
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}		
	}
	
	function delete_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_approval_schedule'); 
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_progress_schedule');  
		
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_analisis_schedule');
	}
	
	function delete_approval_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_approval_schedule');
	}
	
	function delete_progress_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_progress_schedule');
	}
	
	function delete_analisis_schedule($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_analisis_schedule');
	}
	
	function update_permohonan($id_permohonan, $permohonan)
	{
		$this->db->update('tbl_permohonan', $permohonan, $id_permohonan);
		return $this->db->affected_rows();				   
	}
	
	function save_detail_alasan_penolakan($id_permohonan, $alasan_penolakan)
	{
		for($i = 0; $i < count($alasan_penolakan); $i++)
		{
			$data = array('id_permohonan' => $id_permohonan, 
						  'id_alasan_penolakan' =>	$alasan_penolakan[$i]				
			);
			
			$this->db->insert('tbl_approval_alasan_penolakan', $data);
			$this->db->insert_id();
		}
	}
	
	function delete_detail_alasan_penolakan($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_approval_alasan_penolakan');
	}
	
	function update_detail_approval($id_permohonan, $data)
	{
		$this->db->update('tbl_approval', $data, $id_permohonan);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_approval($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_approval');
	}
	
	function view_detail_approval($id_permohonan)
	{
		$approval = $this->db->query("SELECT tbl_permohonan.id_permohonan, tbl_permohonan.no_reg AS no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg, tbl_pemohon.nm_lengkap AS nm_pemohon,
									  DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y') AS tgl_approval, tbl_jenis_kasus.jenis_kasus AS jenis_kasus, tbl_nama_kasus.nama_kasus AS nama_kasus, tbl_posisi_hukum.posisi_hukum AS posisi_hukum, 
									  tbl_approval.status_approval AS status_approval,
									  tbl_approval.desc_lain AS desc_lain, tbl_tindakan.jenis_tindakan AS tindakan, tbl_analis.fullname AS nm_analis, tbl_asisten.fullname AS nm_asisten, tbl_approval.status_rekomendasi AS status_rekomendasi,
									  tbl_advokat.nama_advokat AS nm_advokat, tbl_approval.alasan_rekomendasi AS alasan_rekomendasi 
									  FROM tbl_approval
									  LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
									  LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
									  LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
									  LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
									  LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
									  LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
									  LEFT JOIN tbl_user AS tbl_analis ON tbl_approval.id_analis = tbl_analis.id_user
									  LEFT JOIN tbl_user AS tbl_asisten ON tbl_approval.id_asisten = tbl_asisten.id_user
									  LEFT JOIN tbl_advokat ON tbl_approval.id_advokat = tbl_advokat.id_advokat
									  WHERE tbl_approval.id_permohonan ='".$id_permohonan."'");
		return $approval->row();						   
	}
	
	function view_alasan_penolakan($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_alasan_penolakan.isi_alasan_penolakan
								   FROM tbl_approval_alasan_penolakan
								   LEFT JOIN tbl_alasan_penolakan ON tbl_approval_alasan_penolakan.id_alasan_penolakan = tbl_alasan_penolakan.id_alasan_penolakan
								   WHERE tbl_approval_alasan_penolakan.id_permohonan ='".$id_permohonan."' ORDER BY tbl_approval_alasan_penolakan.id_alasan_penolakan ASC");
		foreach ($query->result() as $row)
		{
			$alasan_penolakan[$row->isi_alasan_penolakan] = $row->isi_alasan_penolakan;
		}
		
		$alasan_penolakan = implode (",", $alasan_penolakan);
		
		$alasan = array('alasan_penolakan' => $alasan_penolakan);
		
		return $alasan;						   						   
	}
	
	function get_detail_setting()
	{
		$query = $this->db->query('SELECT * FROM tbl_setting');
		return $query;
	}
	
	function get_data_approval($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_approval.id_permohonan, DATE_FORMAT(tbl_approval.insert_date, '%d') AS tgl_approval, DATE_FORMAT(tbl_approval.insert_date, '%m') AS bln_approval, DATE_FORMAT(tbl_approval.insert_date, '%Y') AS thn_approval,
								   tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d') AS tgl_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%m') AS bln_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%Y') AS thn_reg, 
								   tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_pemohon.tmp_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%d') AS tgl_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%m') AS bln_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%Y') AS thn_lahir,
								   tbl_pemohon.umur, tbl_pemohon.jkel, tbl_pemohon.alm_jalan, tbl_pemohon.alm_rt, tbl_pemohon.alm_rw, tbl_pemohon.kodepos, tbl_provinsi.nm_provinsi, tbl_kabkota.nm_kabkota, tbl_kecamatan.nm_kecamatan, tbl_desa.nm_desa, 
								   tbl_pemohon.no_hp, tbl_pemohon.nm_hp, tbl_pemohon.id_pekerjaan, tbl_pekerjaan.jenis_pekerjaan, tbl_pemohon.pekerjaan_desc, 
								   tbl_penerima.nm_lengkap AS nm_penerima, tbl_penerima.tmp_lahir AS tmp_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%d') AS tgl_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%m') AS bln_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%Y') AS thn_lahirb,
								   tbl_penerima.umur AS umurb, tbl_penerima.jkel AS jkelb, tbl_penerima.alm_jalan AS alm_jalanb, tbl_penerima.alm_rt AS alm_rtb, tbl_penerima.alm_rw AS alm_rwb, tbl_penerima.kodepos AS kodeposb, tbl_provinsib.nm_provinsi AS nm_provinsib,
								   tbl_kabkotab.nm_kabkota AS nm_kabkotab, tbl_kecamatanb.nm_kecamatan AS nm_kecamatanb, tbl_desab.nm_desa AS nm_desab,  
								   tbl_penerima.no_hp AS no_hpb, tbl_penerima.nm_hp AS nm_hpb, tbl_penerima.id_pekerjaan AS id_pekerjaanb, tbl_pekerjaanb.jenis_pekerjaan AS jenis_pekerjaanb, tbl_penerima.pekerjaan_desc AS pekerjaan_descb, tbl_penerima.hubungan_penerima,
								   tbl_jenis_kasus.jenis_kasus, tbl_posisi_hukum.posisi_hukum, tbl_approval.status_approval, tbl_approval.desc_lain, tbl_tindakan.jenis_tindakan, tbl_approval.status_rekomendasi,
								   tbl_advokat.nama_advokat, tbl_advokat.alamat_advokat, tbl_advokat.telp_advokat, tbl_analis.fullname AS nm_analis, tbl_asisten.fullname AS nm_asisten, tbl_user.fullname AS nm_approval, tbl_user.designation AS jabatan_approval
								   FROM tbl_approval
								   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
								   LEFT JOIN tbl_provinsi ON tbl_pemohon.id_provinsi = tbl_provinsi.id_provinsi
								   LEFT JOIN tbl_kabkota ON tbl_pemohon.id_kabkota = tbl_kabkota.id_kabkota
								   LEFT JOIN tbl_kecamatan ON tbl_pemohon.id_kecamatan = tbl_kecamatan.id_kecamatan
								   LEFT JOIN tbl_desa ON tbl_pemohon.id_desa = tbl_desa.id_desa
								   LEFT JOIN tbl_pekerjaan ON tbl_pemohon.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_provinsi AS tbl_provinsib ON tbl_penerima.id_provinsi = tbl_provinsib.id_provinsi
								   LEFT JOIN tbl_kabkota AS tbl_kabkotab ON tbl_penerima.id_kabkota = tbl_kabkotab.id_kabkota
								   LEFT JOIN tbl_kecamatan AS tbl_kecamatanb ON tbl_penerima.id_kecamatan = tbl_kecamatanb.id_kecamatan
								   LEFT JOIN tbl_desa AS tbl_desab ON tbl_penerima.id_desa = tbl_desab.id_desa
								   LEFT JOIN tbl_pekerjaan AS tbl_pekerjaanb ON tbl_penerima.id_pekerjaan = tbl_pekerjaanb.id_pekerjaan
								   LEFT JOIN tbl_user ON tbl_approval.insert_by = tbl_user.id_user 
								   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
								   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
								   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
								   LEFT JOIN tbl_advokat ON tbl_approval.id_advokat = tbl_advokat.id_advokat
								   LEFT JOIN tbl_user AS tbl_analis ON tbl_approval.id_analis = tbl_analis.id_user
								   LEFT JOIN tbl_user AS tbl_asisten ON tbl_approval.id_asisten = tbl_asisten.id_user
								   WHERE tbl_approval.id_permohonan = '".$id_permohonan."'");
		return $query;							
	}
	
	function get_detail_alasan($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_alasan_penolakan.id_alasan_penolakan, tbl_alasan_penolakan.isi_alasan_penolakan
								   FROM tbl_approval_alasan_penolakan
								   LEFT JOIN tbl_alasan_penolakan ON tbl_approval_alasan_penolakan.id_alasan_penolakan = tbl_alasan_penolakan.id_alasan_penolakan
								   WHERE tbl_approval_alasan_penolakan.id_permohonan ='".$id_permohonan."' 
								   AND tbl_approval_alasan_penolakan.id_alasan_penolakan !='0'
								   ORDER BY tbl_alasan_penolakan.no_urut ASC");
		/*
		foreach ($query->result() as $row)
		{
			$alasan_penolakan[$row->isi_alasan_penolakan] = $row->isi_alasan_penolakan;
		}
		
		$alasan_penolakan = implode (",", $alasan_penolakan);
		
		$alasan = array('alasan_penolakan' => $alasan_penolakan);
		*/
		return $query;						   						   
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
		
		$destination = './media/files_approval/';
		@unlink($destination.$filename);
						
		$this->db->where('id_file', $id_file);
		$this->db->delete('tbl_file_attachment');
	}
	
	function get_id_permohonan($id_approval)
	{
		$query = $this->db->query('SELECT tbl_approval.id_permohonan FROM tbl_approval WHERE tbl_approval.id_approval="'.$id_approval.'"');
		$row = $query->row();
		$id_permohonan = $row->id_permohonan;
		
		return $id_permohonan;
	}
	
	function get_id_approval_by_id_permohonan($id_permohonan)
	{
		$query = $this->db->query('SELECT tbl_approval.id_approval FROM tbl_approval WHERE tbl_approval.id_permohonan ="'.$id_permohonan.'"');
		$row = $query->row();
		$id_approval = $row->id_approval;
		
		return $id_approval;
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
	
	function delete_attachment_approval($id_approval)
	{
		$query = $this->db->query("SELECT tbl_file_attachment.id_file, tbl_file_attachment.nm_file
								   FROM tbl_file_attachment
								   WHERE tbl_file_attachment.id_process = '".$id_approval."' 
								   AND tbl_file_attachment.id_section_process = '3'
								   ORDER BY tbl_file_attachment.id_file ASC");
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$id_file = $row->id_file;
				$nm_file = $row->nm_file;
								
				$destination = './media/files_approval/';
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


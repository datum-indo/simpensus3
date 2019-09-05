<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_model extends CI_Model {
	var $table = 'view_permohonan';
	var $column = array('id_permohonan', 'no_reg','tgl_reg', 'nm_kabkota', 'nm_pemohon', 'no_hp', 'status_approval', 'nm_analis_kasus', 'nm_petugas_wawancara'); //set column field database for order and search
	var $order = array('id_permohonan' => 'desc'); // default order 
	
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
	
	function get_penanganan_pihak_lain()
	{
		$table = 'tbl_permohonan';
		$field = 'penanganan_pihak_lain';
		
		//$penanganan_pihak_lain = array('' => '');
        if ($table == '' || $field == '') return $penanganan_pihak_lain;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $penanganan_pihak_lain[$value] = $value; 
        }
        return $penanganan_pihak_lain;
	}
	
	function get_tahap_penanganan_pihak_lain()
	{
		$table = 'tbl_permohonan';
		$field = 'tahap_penanganan_pihak_lain';
		
		$tahap_penanganan_pihak_lain = array('' => '');
        if ($table == '' || $field == '') return $tahap_penanganan_pihak_lain;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $tahap_penanganan_pihak_lain[$value] = $value; 
        }
        return $tahap_penanganan_pihak_lain;
	}
	
	function get_status_dokumen()
	{
		$table = 'tbl_permohonan';
		$field = 'status_dokumen';
		
		$status_dokumen = array('' => '');
        if ($table == '' || $field == '') return $status_dokumen;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value)
		{
            $status_dokumen[$value] = $value; 
        }
        return $status_dokumen;
	}
	
	
	function get_initial_permohonan()
	{
		$query = $this->db->query('SELECT initial_permohonan FROM tbl_setting');
		$row = $query->row();
		$initial_permohonan = $row->initial_permohonan;
		
		return $initial_permohonan;	
	}
	
	function get_no_reg()
	{
		$query = $this->db->query("SELECT IFNULL(MAX(nomor)+1,1) AS nomor FROM tbl_permohonan WHERE DATE_FORMAT(insert_date,'%Y')= DATE_FORMAT(NOW(),'%Y')");
		$row = $query->row();
		$nomor = $row->nomor;
				
		$tahun = date ('Y');
		$bulan = intval(date('m'));
		//$romawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII');
		$romawi = array('','01','02','03','04','05','06','07','08','09','10','11','12');
		$id_permohonan = sprintf( '%s%04d' , $tahun , $nomor );
		$no_reg = sprintf( '%04d/%s/%s/%04d' , $nomor , $this->get_initial_permohonan(), $romawi[$bulan] , $tahun );
		
		$register = array('nomor' => $nomor,
						  'id_permohonan' => $id_permohonan,
						  'no_reg' => $no_reg		
		);
		
		return $register;	
	}
	
	function save_detail_permohonan($data)
	{
		$this->db->insert('tbl_permohonan', $data);
		return $this->db->insert_id();				   
	}
	
	function get_detail_permohonan($id_permohonan)
	{
		$permohonan = $this->db->query('SELECT * FROM tbl_permohonan WHERE id_permohonan="'.$id_permohonan.'"');
		return $permohonan->row();						   
	}
	
	function update_detail_permohonan($id_permohonan, $data_permohonan)
	{
		$this->db->update('tbl_permohonan', $data_permohonan, $id_permohonan);
		return $this->db->affected_rows();			   
	}
	
	function delete_detail_permohonan($id_permohonan)
	{
		$this->db->where('id_permohonan', $id_permohonan);
		$this->db->delete('tbl_permohonan');
	}
	
	function view_detail_permohonan($id_permohonan)
	{
		$permohonan = $this->db->query("SELECT tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg, 
										tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_pemohon.nm_panggilan, tbl_pemohon.tmp_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%d') AS tgl_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%m') AS bln_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%Y') AS thn_lahir, mtVocabCountUnit.TEKS AS count_unit,
										tbl_pemohon.umur, tbl_pemohon.jkel, tbl_golongan_darah.golongan_darah, tbl_pemohon.kondisi_fisik, tbl_pemohon.id_difabel, tbl_difabel.jenis_difabel, tbl_pemohon.status_perkawinan,tbl_pemohon.suku,tbl_pemohon.id_pendidikan, tbl_pendidikan.nm_pendidikan, tbl_pemohon.pendidikan_desc,
										tbl_pemohon.id_agama, tbl_agama.nm_agama, tbl_pemohon.agama_desc, tbl_pemohon.kewarganegaraan, tbl_pemohon.id_negara, tbl_negara.nm_negara, tbl_pemohon.id_pekerjaan, mtVocabPekerjaan.TEKS AS jenis_pekerjaan, tbl_pemohon.pekerjaan_desc, 
										tbl_pemohon.pekerjaan2, tbl_pemohon.pekerjaan2_desc, tbl_pemohon.pekerjaansi, tbl_pemohon.id_pekerjaansi, tbl_pekerjaansi.TEKS AS jenis_pekerjaansi, tbl_pemohon.pekerjaansi_desc, tbl_penghasilan.jml_penghasilan, tbl_pemohon.jml_anak, tbl_pemohon.tanggungan_total,
										tbl_pemohon.harta_rumah, tbl_pemohon.harta_tanah, tbl_pemohon.harta_bangunan, tbl_pemohon.harta_mobil, tbl_pemohon.harta_motor, tbl_pemohon.harta_toko, tbl_pemohon.harta_tabungan, tbl_pemohon.harta_handphone, tbl_pemohon.status_tempat_tinggal, 
										tbl_pemohon.alm_jalan, tbl_pemohon.alm_rt, tbl_pemohon.alm_rw, tbl_pemohon.kodepos, tbl_provinsi.nm_provinsi, tbl_kabkota.nm_kabkota, tbl_kecamatan.nm_kecamatan, tbl_desa.nm_desa, tbl_pemohon.no_telp, tbl_pemohon.no_hp, tbl_pemohon.nm_hp, tbl_pemohon.email,
										tbl_pemohon.facebook, tbl_pemohon.twitter, tbl_pemohon.sosial_media, tbl_pemohon.jenis_kid, tbl_pemohon.nomor_kid, tbl_pemohon.jenis_ktm, tbl_pemohon.nomor_ktm, tbl_pemohon.status_pemohon, 
										/*Penerima */
										tbl_penerima.nm_lengkap AS nm_penerima, tbl_penerima.nm_panggilan AS nm_panggilanb, tbl_penerima.tmp_lahir AS tmp_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%d') AS tgl_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%m') AS bln_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%Y') AS thn_lahirb,
										tbl_penerima.umur AS umurb, tbl_penerima.jkel AS jkelb, tbl_golongan_darahb.golongan_darah AS golongan_darahb, tbl_penerima.kondisi_fisik AS kondisi_fisikb, tbl_penerima.id_difabel AS id_difabelb, tbl_difabelb.jenis_difabel AS jenis_difabelb, tbl_penerima.status_perkawinan AS status_perkawinanb,mtVocabCountUnitb.TEKS AS count_unitb,
										tbl_penerima.id_pendidikan AS id_pendidikanb,
										tbl_pendidikanb.nm_pendidikan AS nm_pendidikanb,
										tbl_penerima.pendidikan_desc AS pendidikan_descb, 
										tbl_penerima.id_agama AS id_agamab, 
										tbl_agamab.nm_agama AS nm_agamab, 
										tbl_penerima.agama_desc AS agama_descb,
										 tbl_penerima.kewarganegaraan AS kewarganegaraanb, tbl_penerima.id_negara AS id_negarab,
										tbl_negarab.nm_negara AS nm_negarab, tbl_penerima.id_pekerjaan AS id_pekerjaanb, tbl_pekerjaanb.TEKS AS jenis_pekerjaanb, tbl_penerima.pekerjaan_desc AS pekerjaan_descb, tbl_penerima.pekerjaan2 AS pekerjaan2b, tbl_penerima.pekerjaan2_desc AS pekerjaan2_descb,
										tbl_penerima.pekerjaansi AS pekerjaansib, tbl_penerima.id_pekerjaansi AS id_pekerjaansib, tbl_pekerjaansib.TEKS AS jenis_pekerjaansib, tbl_penerima.pekerjaansi_desc AS pekerjaansi_descb, tbl_penghasilanb.jml_penghasilan AS jml_penghasilanb, tbl_penerima.jml_anak AS jml_anakb,
										tbl_penerima.tanggungan_total AS tanggungan_totalb, tbl_penerima.harta_rumah AS harta_rumahb, tbl_penerima.harta_tanah AS harta_tanahb, tbl_penerima.harta_bangunan AS harta_bangunanb, tbl_penerima.harta_mobil AS harta_mobilb, tbl_penerima.harta_motor AS harta_motorb, tbl_penerima.harta_toko AS harta_tokob,
										tbl_penerima.harta_tabungan AS harta_tabunganb, tbl_penerima.harta_handphone AS harta_handphoneb, tbl_penerima.status_tempat_tinggal AS status_tempat_tinggalb, tbl_penerima.alm_jalan AS alm_jalanb,
										tbl_penerima.alm_rt AS alm_rtb, tbl_penerima.alm_rw AS alm_rwb, tbl_penerima.kodepos AS kodeposb, tbl_provinsib.nm_provinsi AS nm_provinsib, tbl_kabkotab.nm_kabkota AS nm_kabkotab, tbl_kecamatanb.nm_kecamatan nm_kecamatanb, tbl_desab.nm_desa AS nm_desab,
										tbl_penerima.no_telp AS no_telpb, tbl_penerima.no_hp AS no_hpb, tbl_penerima.nm_hp AS nm_hpb, tbl_penerima.email AS emailb, tbl_penerima.facebook AS facebookb, tbl_penerima.twitter AS twitterb, tbl_penerima.sosial_media AS sosial_mediab,
										tbl_penerima.jenis_kid AS jenis_kidb, tbl_penerima.nomor_kid AS nomor_kidb, tbl_penerima.jenis_ktm AS jenis_ktmb, tbl_penerima.nomor_ktm AS nomor_ktmb, tbl_penerima.hubungan_penerima,
										/*End Penerima */
										tbl_jarak_tempuh.jarak_tempuh, tbl_waktu_tempuh.waktu_tempuh, tbl_pemohon.pernah_jadi_client, tbl_pemohon.id_sumber_info, tbl_sumber_info.nm_sumber_info, tbl_pemohon.sumber_info_desc, 
										tbl_pemohon.rekomendasi_lbh, tbl_pemohon.nm_rekomendasi, tbl_pemohon.alm_rekomendasi, tbl_pemohon.pekerjaan_rekomendasi, tbl_permohonan.uraian_singkat, tbl_permohonan.kronologi_kasus, 
										tbl_permohonan.penanganan_pihak_lain, tbl_permohonan.tahap_penanganan_pihak_lain, tbl_permohonan.desc_tahap_penanganan_pihak_lain  
										FROM tbl_permohonan
										LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
										LEFT JOIN tbl_golongan_darah ON tbl_pemohon.id_golongan_darah = tbl_golongan_darah.id_golongan_darah
										LEFT JOIN tbl_difabel ON tbl_pemohon.id_difabel = tbl_difabel.id_difabel
										LEFT JOIN tbl_pendidikan ON tbl_pemohon.id_pendidikan = tbl_pendidikan.id_pendidikan
										LEFT JOIN mt_vocab AS mtVocabPekerjaan ON tbl_pemohon.id_pekerjaan = mtVocabPekerjaan.KODE
										LEFT JOIN mt_vocab AS mtVocabCountUnit ON tbl_pemohon.count_unit = mtVocabCountUnit.KODE
										LEFT JOIN tbl_agama ON tbl_pemohon.id_agama = tbl_agama.id_agama
										LEFT JOIN tbl_negara ON tbl_pemohon.id_negara = tbl_negara.id_negara
										-- LEFT JOIN tbl_pekerjaan ON tbl_pemohon.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
										LEFT JOIN mt_vocab AS tbl_pekerjaansi ON tbl_pemohon.id_pekerjaansi = tbl_pekerjaansi.KODE
										LEFT JOIN tbl_penghasilan ON tbl_pemohon.id_penghasilan = tbl_penghasilan.id_penghasilan
										LEFT JOIN tbl_provinsi ON tbl_pemohon.id_provinsi = tbl_provinsi.id_provinsi
										LEFT JOIN tbl_kabkota ON tbl_pemohon.id_kabkota = tbl_kabkota.id_kabkota
										LEFT JOIN tbl_kecamatan ON tbl_pemohon.id_kecamatan = tbl_kecamatan.id_kecamatan
										LEFT JOIN tbl_desa ON tbl_pemohon.id_desa = tbl_desa.id_desa
										LEFT JOIN tbl_jarak_tempuh ON tbl_pemohon.id_jarak_tempuh = tbl_jarak_tempuh.id_jarak_tempuh
										LEFT JOIN tbl_waktu_tempuh ON tbl_pemohon.id_waktu_tempuh = tbl_waktu_tempuh.id_waktu_tempuh
										LEFT JOIN tbl_sumber_info ON tbl_pemohon.id_sumber_info = tbl_sumber_info.id_sumber_info
										LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
										LEFT JOIN mt_vocab AS mtVocabCountUnitb ON tbl_penerima.count_unit = mtVocabCountUnitb.KODE
										LEFT JOIN tbl_golongan_darah AS tbl_golongan_darahb ON tbl_penerima.id_golongan_darah = tbl_golongan_darahb.id_golongan_darah
										LEFT JOIN tbl_difabel AS tbl_difabelb ON tbl_penerima.id_difabel = tbl_difabelb.id_difabel
										LEFT JOIN tbl_pendidikan AS tbl_pendidikanb ON tbl_penerima.id_pendidikan = tbl_pendidikanb.id_pendidikan
										LEFT JOIN tbl_agama AS tbl_agamab ON tbl_penerima.id_agama = tbl_agamab.id_agama
										LEFT JOIN tbl_negara AS tbl_negarab ON tbl_penerima.id_negara = tbl_negarab.id_negara
										LEFT JOIN mt_vocab AS tbl_pekerjaanb ON tbl_penerima.id_pekerjaan = tbl_pekerjaanb.KODE
										LEFT JOIN mt_vocab AS tbl_pekerjaansib ON tbl_penerima.id_pekerjaansi = tbl_pekerjaansib.KODE
										LEFT JOIN tbl_penghasilan AS tbl_penghasilanb ON tbl_penerima.id_penghasilan = tbl_penghasilanb.id_penghasilan
										LEFT JOIN tbl_provinsi AS tbl_provinsib ON tbl_penerima.id_provinsi = tbl_provinsib.id_provinsi
										LEFT JOIN tbl_kabkota AS tbl_kabkotab ON tbl_penerima.id_kabkota = tbl_kabkotab.id_kabkota
										LEFT JOIN tbl_kecamatan AS tbl_kecamatanb ON tbl_penerima.id_kecamatan = tbl_kecamatanb.id_kecamatan
										LEFT JOIN tbl_desa AS tbl_desab ON tbl_penerima.id_desa = tbl_desab.id_desa
										WHERE tbl_permohonan.id_permohonan ='".$id_permohonan."'");
		return $permohonan->row();						   
	}
	
	function get_detail_setting()
	{
		$query = $this->db->query('SELECT * FROM tbl_setting');
		return $query;
	}
	
	function get_data_formulir($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_permohonan.id_permohonan, tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d') AS tgl_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%m') AS bln_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%Y') AS thn_reg,
								   tbl_permohonan.uraian_singkat, tbl_permohonan.kronologi_kasus, tbl_pemohon.nm_lengkap, tbl_pemohon.tmp_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%d') AS tgl_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%m') AS bln_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%Y') AS thn_lahir,
								   tbl_pemohon.umur, tbl_pemohon.jkel, tbl_pemohon.alm_jalan, tbl_pemohon.alm_rt, tbl_pemohon.alm_rw, tbl_pemohon.kodepos, tbl_provinsi.nm_provinsi, tbl_kabkota.nm_kabkota, tbl_kecamatan.nm_kecamatan, tbl_desa.nm_desa, 
								   tbl_pemohon.no_hp, tbl_pemohon.nm_hp, tbl_pemohon.id_pekerjaan, tbl_pekerjaan.jenis_pekerjaan, tbl_pemohon.pekerjaan_desc, tbl_pemohon.jml_anak, tbl_pemohon.tanggungan_total, tbl_pemohon.jenis_kid, tbl_pemohon.nomor_kid, tbl_pemohon.jenis_ktm, tbl_pemohon.nomor_ktm, 
								   tbl_pemohon.kondisi_fisik, tbl_difabel.jenis_difabel
								   FROM tbl_permohonan
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
								   LEFT JOIN tbl_provinsi ON tbl_pemohon.id_provinsi = tbl_provinsi.id_provinsi
								   LEFT JOIN tbl_kabkota ON tbl_pemohon.id_kabkota = tbl_kabkota.id_kabkota
								   LEFT JOIN tbl_kecamatan ON tbl_pemohon.id_kecamatan = tbl_kecamatan.id_kecamatan
								   LEFT JOIN tbl_desa ON tbl_pemohon.id_desa = tbl_desa.id_desa
								   LEFT JOIN tbl_pekerjaan ON tbl_pemohon.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
								   LEFT JOIN tbl_difabel ON tbl_pemohon.id_difabel = tbl_difabel.id_difabel
								   WHERE tbl_permohonan.id_permohonan ='".$id_permohonan."'");
		return $query;							
	}
	
	function get_data_bukti($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_permohonan.id_permohonan, tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d') AS tgl_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%m') AS bln_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%Y') AS thn_reg,
								   tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_pemohon.tmp_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%d') AS tgl_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%m') AS bln_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%Y') AS thn_lahir,
								   tbl_pemohon.umur, tbl_pemohon.jkel, tbl_pemohon.alm_jalan, tbl_pemohon.alm_rt, tbl_pemohon.alm_rw, tbl_pemohon.kodepos, tbl_provinsi.nm_provinsi, tbl_kabkota.nm_kabkota, tbl_kecamatan.nm_kecamatan, tbl_desa.nm_desa AS nm_desa,
								   tbl_pemohon.no_hp, tbl_pemohon.nm_hp, tbl_pemohon.id_pekerjaan, tbl_pekerjaan.jenis_pekerjaan, tbl_pemohon.pekerjaan_desc, 
								   tbl_penerima.nm_lengkap AS nm_penerima, tbl_penerima.tmp_lahir AS tmp_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%d') AS tgl_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%m') AS bln_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%Y') AS thn_lahirb,
								   tbl_penerima.umur AS umurb, tbl_penerima.jkel AS jkelb, tbl_penerima.alm_jalan AS alm_jalanb, tbl_penerima.alm_rt AS alm_rtb, tbl_penerima.alm_rw AS alm_rwb, tbl_penerima.kodepos AS kodeposb, tbl_provinsib.nm_provinsi AS nm_provinsib,
								   tbl_kabkotab.nm_kabkota AS nm_kabkotab, tbl_kecamatanb.nm_kecamatan nm_kecamatanb, tbl_desab.nm_desa AS nm_desab, 
								   tbl_penerima.no_hp AS no_hpb, tbl_penerima.nm_hp AS nm_hpb, tbl_penerima.id_pekerjaan AS id_pekerjaanb, tbl_pekerjaanb.jenis_pekerjaan AS jenis_pekerjaanb, tbl_penerima.pekerjaan_desc AS pekerjaan_descb, tbl_penerima.hubungan_penerima,
								   tbl_user.fullname AS nm_petugas_wawancara
								   FROM tbl_permohonan
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
								   LEFT JOIN tbl_user ON tbl_permohonan.insert_by = tbl_user.id_user
								   WHERE tbl_permohonan.id_permohonan ='".$id_permohonan."'");
		return $query;							
	}
	
	function get_kronologi($id_permohonan)
	{
		$query = $this->db->query("SELECT tbl_permohonan.id_permohonan, tbl_permohonan.uraian_singkat, tbl_permohonan.kronologi_kasus
								   FROM tbl_permohonan
								   WHERE tbl_permohonan.id_permohonan ='".$id_permohonan."'");
		return $query->row();							
	}
	
	function update_kronologi($id_permohonan, $kronologi)
	{
		$this->db->update('tbl_permohonan', $kronologi, $id_permohonan);
		return $this->db->affected_rows();			   
	}
	
	function get_dokumen_status($id_permohonan)
	{
		$query = $this->db->query("SELECT status_dokumen
								   FROM tbl_permohonan
								   WHERE tbl_permohonan.id_permohonan ='".$id_permohonan."'");
		return $query->row();							
	}
	
	function update_dokumen_status($id_permohonan, $status_dokumen)
	{
		$this->db->update('tbl_permohonan', $status_dokumen, $id_permohonan);
		return $this->db->affected_rows();			   
	}
	
	function save_detail_file($data_file)
	{
		$this->db->insert('tbl_file_attachment', $data_file);
		$id_file = $this->db->insert_id();
		return $id_file;				   
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
}

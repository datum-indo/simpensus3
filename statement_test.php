<?php

	$mysqli = new mysqli("localhost", "root", "", "simpensus2");
	
	$y = '1';
	$x = '3';
	$cross_periode = 'Tahun';
	$cross_tahun = '2013';

		if($y == '1')
		{
			$rowname = 'kab_kota'; 
			$rowtitle = 'Kota/Kabupaten';
			$rowwhere = '';
		}
		else if($y == '2')
		{
			$rowname = 'jenis_kelamin';
			$rowtitle = 'Jenis Kelamin';
			$rowwhere = '';
		}
		else if($y == '3')
		{
			$rowname = 'umur';
			$rowtitle = 'Umur';
			$rowwhere = '';
		}
		else if($y == '4')
		{
			$rowname = 'agama';
			$rowtitle = 'Agama';
			$rowwhere = '';
		}
		else if($y == '5')
		{
			$rowname = 'tingkat_pendidikan';
			$rowtitle = 'Pendidikan';
			$rowwhere = '';
		}
		else if($y == '6')
		{
			$rowname = 'pekerjaan_pokok';
			$rowtitle = 'Pekerjaan Pokok';
			$rowwhere = '';
		}
		else if($y == '7')
		{
			$rowname = 'penghasilan';
			$rowtitle = 'Penghasilan';
			$rowwhere = '';
		}
		else if($y == '8')
		{
			$rowname = 'ada_sktm';
			$rowtitle = 'Ada SKTM';
			$rowwhere = '';
		}
		else if($y == '9')
		{
			$rowname = 'status_permohonan';
			$rowtitle = 'Status Permohonan';
			$rowwhere = '';
		}
		else if($y == '10')
		{
			$rowname = 'jenis_masalah_hukum';
			$rowtitle = 'Jenis Masalah Hukum';
			$rowwhere = "WHERE jenis_masalah_hukum != ''N/A''";
		}
		else if($y == '11')
		{
			$rowname = 'jenis_kasus_pidana';
			$rowtitle = 'Jenis Kasus Pidana';
			$rowwhere = "WHERE jenis_kasus_pidana != ''N/A''";
		}
		else if($y == '12')
		{
			$rowname = 'jenis_kasus_perdata';
			$rowtitle = 'Jenis Kasus Perdata';
			$rowwhere = "WHERE jenis_kasus_perdata != ''N/A''";
		}
		else if($y == '13')
		{
			$rowname = 'jenis_kasus_tun';
			$rowtitle = 'Jenis Kasus TUN';
			$rowwhere = "WHERE jenis_kasus_tun != ''N/A''";
		}
		else if($y == '14')
		{
			$rowname = 'sifat_kasus';
			$rowtitle = 'Sifat Kasus';
			$rowwhere = "WHERE sifat_kasus != ''N/A''";
		}
		else if($y == '15')
		{
			$rowname = 'jenis_layanan_yg_diberikan';
			$rowtitle = 'Bentuk Layanan';
			$rowwhere = "WHERE jenis_layanan_yg_diberikan != ''N/A''";
		}
		else if($y == '16')
		{
			$rowname = 'status_kasus';
			$rowtitle = 'Status Kasus';
			$rowwhere = "";
		}
		else if($y == '17')
		{
			$rowname = 'hasil_baik_buat_klien';
			$rowtitle = 'Baik Untuk Klien';
			$rowwhere = "WHERE hasil_baik_buat_klien != ''N/A''";
		}
		else if($y == '18')
		{
			$rowname = 'bentuk_kasus';
			$rowtitle = 'Bentuk Kasus';
			$rowwhere = "WHERE bentuk_kasus != ''N/A''";
		}
		else if($y == '19')
		{
			$rowname = 'issue_ham_pokok';
			$rowtitle = 'Issue HAM Utama';
			$rowwhere = "WHERE issue_ham_pokok != ''N/A''";
		}
		else
		{
			$rowname = 'kategori_pelaku';
			$rowtitle = 'Kategori Pelaku';
			$rowwhere = "WHERE kategori_pelaku != ''N/A''";
		}

		if($x == '1')
		{
			$colname = 'kab_kota'; 
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '2')
		{
			$colname = 'jenis_kelamin';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '3')
		{
			$colname = 'umur';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '4')
		{
			$colname = 'agama';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '5')
		{
			$colname = 'tingkat_pendidikan';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '6')
		{
			$colname = 'pekerjaan_pokok';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '7')
		{
			$colname = 'penghasilan';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '8')
		{
			$colname = 'ada_sktm';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '9')
		{
			$colname = 'status_permohonan';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '10')
		{
			$colname = 'jenis_masalah_hukum';
			$colwhere = "WHERE jenis_masalah_hukum != 'N/A'";
			$colwherex = "WHERE jenis_masalah_hukum != ''N/A''";
			$colwherey = "AND jenis_masalah_hukum != ''N/A''";
		}
		else if($x == '11')
		{
			$colname = 'jenis_kasus_pidana';
			$colwhere = "WHERE jenis_kasus_pidana != 'N/A'";
			$colwherex = "WHERE jenis_kasus_pidana != ''N/A''";
			$colwherey = "AND jenis_kasus_pidana != ''N/A''";
		}
		else if($x == '12')
		{
			$colname = 'jenis_kasus_perdata';
			$colwhere = "WHERE jenis_kasus_perdata != 'N/A'";
			$colwherex = "WHERE jenis_kasus_perdata != ''N/A''";
			$colwherey = "AND jenis_kasus_perdata != ''N/A''";
		}
		else if($x == '13')
		{
			$colname = 'jenis_kasus_tun';
			$colwhere = "WHERE jenis_kasus_tun != 'N/A'";
			$colwherex = "WHERE jenis_kasus_tun != ''N/A''";
			$colwherey = "AND jenis_kasus_tun != ''N/A''";
		}
		else if($x == '14')
		{
			$colname = 'sifat_kasus';
			$colwhere = "WHERE sifat_kasus != 'N/A'";
			$colwherex = "WHERE sifat_kasus != ''N/A''";
			$colwherey = "AND sifat_kasus != ''N/A''";
		}
		else if($x == '15')
		{
			$colname = 'jenis_layanan_yg_diberikan';
			$colwhere = "WHERE jenis_layanan_yg_diberikan != 'N/A'";
			$colwherex = "WHERE jenis_layanan_yg_diberikan != ''N/A''";
			$colwherey = "AND jenis_layanan_yg_diberikan != ''N/A''";
		}
		else if($x == '16')
		{
			$colname = 'status_kasus';
			$colwhere = '';
			$colwherex = '';
			$colwherey = '';
		}
		else if($x == '17')
		{
			$colname = 'hasil_baik_buat_klien';
			$colwhere = "WHERE hasil_baik_buat_klien != 'N/A'";
			$colwherex = "WHERE hasil_baik_buat_klien != ''N/A''";
			$colwherey = "AND hasil_baik_buat_klien != ''N/A''";
		}
		else if($x == '18')
		{
			$colname = 'bentuk_kasus';
			$colwhere = "WHERE bentuk_kasus != 'N/A'";
			$colwherex = "WHERE bentuk_kasus != ''N/A''";
			$colwherey = "AND bentuk_kasus != ''N/A''";
		}
		else if($x == '19')
		{
			$colname = 'issue_ham_pokok';
			$colwhere = "WHERE issue_ham_pokok != 'N/A'";
			$colwherex = "WHERE issue_ham_pokok != ''N/A''";
			$colwherey = "AND issue_ham_pokok != ''N/A''";
		}
		else
		{
			$colname = 'kategori_pelaku';
			$colwhere = "WHERE kategori_pelaku != 'N/A'";
			$colwherex = "WHERE kategori_pelaku != ''N/A''";
			$colwherey = "AND kategori_pelaku != ''N/A''";
		}
		
		$tglwherex = "WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$cross_tahun."'";
		$tglwherey = "WHERE DATE_FORMAT(tbl_approval.insert_date, ''%Y'') = ''".$cross_tahun."''";
		
		if($rowwhere == '')
		{
			$colwherey = $colwherex;	
		}
		
		if($cross_periode == 'Semua')
		{
			$query = "SET @coltitle := NULL;";
			$query .= "SELECT GROUP_CONCAT(DISTINCT CONCAT( '''', ".$colname.", ''' AS `', ".$colname.", '`') ORDER BY ".$colname." ASC ) INTO @coltitle 
					   FROM ( 
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '73', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN 'Laki-laki' THEN tbl_penerima.jkel WHEN 'Perempuan' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN 'Tidak Ada' THEN 'Tidak' ELSE 'Ya' END AS ada_sktm,
					   IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '', 'N/A', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
					   CASE status_hasil WHEN 'Ya' THEN status_hasil WHEN 'Tidak' THEN status_hasil ELSE 'N/A' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien 
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien
					   FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   GROUP BY tbl_approval.id_permohonan ) tbl_coltitle 
					   ".$colwhere.";";
			$query .= "SET @colresult := NULL;";
			$query .= "SELECT GROUP_CONCAT(DISTINCT CONCAT( 'COUNT(CASE WHEN ".$colname." = ''', ".$colname.", ''' THEN 1 ELSE NULL END) AS `',  ".$colname.", '`') ORDER BY ".$colname." ASC ) INTO @colresult 
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '73', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN 'Laki-laki' THEN tbl_penerima.jkel WHEN 'Perempuan' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan, 
					   CASE tbl_penerima.jenis_ktm WHEN 'Tidak Ada' THEN 'Tidak' ELSE 'Ya' END AS ada_sktm, 
					   IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '', 'N/A', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
					   CASE status_hasil WHEN 'Ya' THEN status_hasil WHEN 'Tidak' THEN status_hasil ELSE 'N/A' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien 
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   GROUP BY tbl_approval.id_permohonan ) tbl_colresult
					   ".$colwhere.";";
			$query .= "SET @total := NULL;";
			$query .= "SELECT GROUP_CONCAT(DISTINCT CONCAT( 'SUM(IF(".$colname." = ''', ".$colname.", ''', 1, 0 )) AS `', ".$colname.", '`') ORDER BY ".$colname." ASC ) INTO @total 
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '73', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN 'Laki-laki' THEN tbl_penerima.jkel WHEN 'Perempuan' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN 'Tidak Ada' THEN 'Tidak' ELSE 'Ya' END AS ada_sktm, 
					   IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '', 'N/A', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
					   CASE status_hasil WHEN 'Ya' THEN status_hasil WHEN 'Tidak' THEN status_hasil ELSE 'N/A' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien 
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien
					   FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   GROUP BY tbl_approval.id_permohonan ) tbl_total
					   ".$colwhere.";"; 
			$query .= "SET @sql = CONCAT(' SELECT ''".$rowtitle."'' AS ".$rowname.", ', @coltitle, ',''Total'' AS total UNION ALL 
					   SELECT ".$rowname.", ', @colresult, ', COUNT(".$colname.") AS jumlah
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''73'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN ''Laki-laki'' THEN tbl_penerima.jkel WHEN ''Perempuan'' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN ''Tidak Ada'' THEN ''Tidak'' ELSE ''Ya'' END AS ada_sktm, 
					   IF(tbl_approval.insert_date IS NULL , ''N/A'' , DATE_FORMAT(tbl_approval.insert_date, ''%d/%m/%Y'')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , ''N/A'', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, ''N/A'', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Pidana'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Perdata'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Tata Usaha Negara'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, ''N/A'', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '''', ''N/A'', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, ''N/A'', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, ''N/A'', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, ''N/A'', status_progress) AS status_kasus,
					   CASE status_hasil WHEN ''Ya'' THEN status_hasil WHEN ''Tidak'' THEN status_hasil ELSE ''N/A'' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, ''N/A'', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, ''N/A'', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '''', tbl_kategori_pelaku.kategori_pelaku, ''N/A'') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, ''%d/%m/%Y'') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien 
					   FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_difabel ON tbl_penerima.id_difabel = tbl_difabel.id_difabel
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jarak_tempuh ON tbl_pemohon.id_jarak_tempuh = tbl_jarak_tempuh.id_jarak_tempuh
					   LEFT JOIN tbl_waktu_tempuh ON tbl_pemohon.id_waktu_tempuh = tbl_waktu_tempuh.id_waktu_tempuh
					   LEFT JOIN tbl_sumber_info ON tbl_pemohon.id_sumber_info = tbl_sumber_info.id_sumber_info
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_provinsi AS tbl_provinsi_kejadian ON tbl_analisis.id_provinsi = tbl_provinsi_kejadian.id_provinsi
					   LEFT JOIN tbl_kabkota AS tbl_kabkota_kejadian ON tbl_analisis.id_kabkota = tbl_kabkota_kejadian.id_kabkota
					   LEFT JOIN tbl_kategori_korban ON tbl_analisis.id_kategori_korban = tbl_kategori_korban.id_kategori_korban
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   LEFT JOIN tbl_penghasilan AS tbl_penghasilan_analisis ON tbl_analisis.id_penghasilan = tbl_penghasilan_analisis.id_penghasilan 
					   GROUP BY tbl_approval.id_permohonan ) tbl_result
					   ".$rowwhere."
					   ".$colwherey."
					   GROUP BY ".$rowname." UNION ALL
					   SELECT ''Total'' AS ".$rowname.", ', @total, ', COUNT(".$colname.") AS total 
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''73'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN ''Laki-laki'' THEN tbl_penerima.jkel WHEN ''Perempuan'' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN ''Tidak Ada'' THEN ''Tidak'' ELSE ''Ya'' END AS ada_sktm,
					   IF(tbl_approval.insert_date IS NULL , ''N/A'' , DATE_FORMAT(tbl_approval.insert_date, ''%d/%m/%Y'')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , ''N/A'', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, ''N/A'', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Pidana'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Perdata'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Tata Usaha Negara'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, ''N/A'', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '''', ''N/A'', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, ''N/A'', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, ''N/A'', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, ''N/A'', status_progress) AS status_kasus,
					   CASE status_hasil WHEN ''Ya'' THEN status_hasil WHEN ''Tidak'' THEN status_hasil ELSE ''N/A'' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, ''N/A'', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, ''N/A'', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '''', tbl_kategori_pelaku.kategori_pelaku, ''N/A'') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, ''%d/%m/%Y'') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien
					   FROM tbl_progress 
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   GROUP BY tbl_approval.id_permohonan
					   ) tbl_total
					   ".$rowwhere." ".$colwherey."');";
			$query .= "PREPARE stmt FROM @sql;";
			$query .= "EXECUTE stmt;";
			$query .= "DEALLOCATE PREPARE stmt;";
		}
		else
		{
			$query = "SET @coltitle := NULL;";
			$query .= "SELECT GROUP_CONCAT(DISTINCT CONCAT( '''', ".$colname.", ''' AS `', ".$colname.", '`') ORDER BY ".$colname." ASC ) INTO @coltitle 
					   FROM ( 
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '73', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN 'Laki-laki' THEN tbl_penerima.jkel WHEN 'Perempuan' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN 'Tidak Ada' THEN 'Tidak' ELSE 'Ya' END AS ada_sktm,
					   IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '', 'N/A', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
					   CASE status_hasil WHEN 'Ya' THEN status_hasil WHEN 'Tidak' THEN status_hasil ELSE 'N/A' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien 
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien
					   FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   ".$tglwherex."
					   GROUP BY tbl_approval.id_permohonan ) tbl_coltitle 
					   ".$colwhere.";";
			$query .= "SET @colresult := NULL;";
			$query .= "SELECT GROUP_CONCAT(DISTINCT CONCAT( 'COUNT(CASE WHEN ".$colname." = ''', ".$colname.", ''' THEN 1 ELSE NULL END) AS `',  ".$colname.", '`') ORDER BY ".$colname." ASC ) INTO @colresult 
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '73', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN 'Laki-laki' THEN tbl_penerima.jkel WHEN 'Perempuan' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan, 
					   CASE tbl_penerima.jenis_ktm WHEN 'Tidak Ada' THEN 'Tidak' ELSE 'Ya' END AS ada_sktm, 
					   IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '', 'N/A', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
					   CASE status_hasil WHEN 'Ya' THEN status_hasil WHEN 'Tidak' THEN status_hasil ELSE 'N/A' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien 
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   ".$tglwherex."
					   GROUP BY tbl_approval.id_permohonan ) tbl_colresult
					   ".$colwhere.";";
			$query .= "SET @total := NULL;";
			$query .= "SELECT GROUP_CONCAT(DISTINCT CONCAT( 'SUM(IF(".$colname." = ''', ".$colname.", ''', 1, 0 )) AS `', ".$colname.", '`') ORDER BY ".$colname." ASC ) INTO @total 
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '73', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN 'Laki-laki' THEN tbl_penerima.jkel WHEN 'Perempuan' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN 'Tidak Ada' THEN 'Tidak' ELSE 'Ya' END AS ada_sktm, 
					   IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '', 'N/A', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
					   CASE status_hasil WHEN 'Ya' THEN status_hasil WHEN 'Tidak' THEN status_hasil ELSE 'N/A' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien 
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien
					   FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   ".$tglwherex."
					   GROUP BY tbl_approval.id_permohonan ) tbl_total
					   ".$colwhere.";"; 
			$query .= "SET @sql = CONCAT(' SELECT ''".$rowtitle."'' AS ".$rowname.", ', @coltitle, ',''Total'' AS total UNION ALL 
					   SELECT ".$rowname.", ', @colresult, ', COUNT(".$colname.") AS jumlah
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''73'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN ''Laki-laki'' THEN tbl_penerima.jkel WHEN ''Perempuan'' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN ''Tidak Ada'' THEN ''Tidak'' ELSE ''Ya'' END AS ada_sktm, 
					   IF(tbl_approval.insert_date IS NULL , ''N/A'' , DATE_FORMAT(tbl_approval.insert_date, ''%d/%m/%Y'')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , ''N/A'', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, ''N/A'', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Pidana'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Perdata'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Tata Usaha Negara'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, ''N/A'', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '''', ''N/A'', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, ''N/A'', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, ''N/A'', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, ''N/A'', status_progress) AS status_kasus,
					   CASE status_hasil WHEN ''Ya'' THEN status_hasil WHEN ''Tidak'' THEN status_hasil ELSE ''N/A'' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, ''N/A'', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, ''N/A'', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '''', tbl_kategori_pelaku.kategori_pelaku, ''N/A'') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, ''%d/%m/%Y'') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien 
					   FROM tbl_progress
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_difabel ON tbl_penerima.id_difabel = tbl_difabel.id_difabel
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jarak_tempuh ON tbl_pemohon.id_jarak_tempuh = tbl_jarak_tempuh.id_jarak_tempuh
					   LEFT JOIN tbl_waktu_tempuh ON tbl_pemohon.id_waktu_tempuh = tbl_waktu_tempuh.id_waktu_tempuh
					   LEFT JOIN tbl_sumber_info ON tbl_pemohon.id_sumber_info = tbl_sumber_info.id_sumber_info
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_provinsi AS tbl_provinsi_kejadian ON tbl_analisis.id_provinsi = tbl_provinsi_kejadian.id_provinsi
					   LEFT JOIN tbl_kabkota AS tbl_kabkota_kejadian ON tbl_analisis.id_kabkota = tbl_kabkota_kejadian.id_kabkota
					   LEFT JOIN tbl_kategori_korban ON tbl_analisis.id_kategori_korban = tbl_kategori_korban.id_kategori_korban
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   LEFT JOIN tbl_penghasilan AS tbl_penghasilan_analisis ON tbl_analisis.id_penghasilan = tbl_penghasilan_analisis.id_penghasilan 
					   ".$tglwherey."
					   GROUP BY tbl_approval.id_permohonan ) tbl_result
					   ".$rowwhere."
					   ".$colwherey."
					   GROUP BY ".$rowname." UNION ALL
					   SELECT ''Total'' AS ".$rowname.", ', @total, ', COUNT(".$colname.") AS total 
					   FROM (
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''73'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
					   CASE tbl_penerima.jkel WHEN ''Laki-laki'' THEN tbl_penerima.jkel WHEN ''Perempuan'' THEN tbl_penerima.jkel ELSE tbl_penerima.jkel END AS jenis_kelamin,
					   tbl_pendidikan.nm_pendidikan AS tingkat_pendidikan, tbl_agama.nm_agama AS agama, tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok, tbl_penghasilan.jml_penghasilan AS penghasilan,
					   CASE tbl_penerima.jenis_ktm WHEN ''Tidak Ada'' THEN ''Tidak'' ELSE ''Ya'' END AS ada_sktm,
					   IF(tbl_approval.insert_date IS NULL , ''N/A'' , DATE_FORMAT(tbl_approval.insert_date, ''%d/%m/%Y'')) AS tgl_approval,
					   IF(tbl_approval.status_approval IS NULL , ''N/A'', tbl_approval.status_approval) AS status_permohonan,
					   IF(tbl_jenis_kasus.jenis_kasus IS NULL, ''N/A'', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Pidana'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_pidana,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Perdata'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_perdata,
					   IF(tbl_jenis_kasus.jenis_kasus = ''Tata Usaha Negara'' , tbl_nama_kasus.nama_kasus , ''N/A'') AS jenis_kasus_tun,
					   IF(tbl_posisi_hukum.posisi_hukum IS NULL, ''N/A'', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
					   IF(tbl_approval.sifat_kasus IS NULL OR tbl_approval.sifat_kasus = '''', ''N/A'', tbl_approval.sifat_kasus) AS sifat_kasus,
					   IF(tbl_tindakan.jenis_tindakan IS NULL, ''N/A'', tbl_tindakan.jenis_tindakan) AS jenis_layanan_yg_diberikan,
					   IF(tgl_progress IS NULL, ''N/A'', tgl_progress) AS tgl_update,
					   IF(status_progress IS NULL, ''N/A'', status_progress) AS status_kasus,
					   CASE status_hasil WHEN ''Ya'' THEN status_hasil WHEN ''Tidak'' THEN status_hasil ELSE ''N/A'' END AS hasil_baik_buat_klien,
					   IF(tbl_issue_ham.issue_ham IS NULL, ''N/A'', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
					   IF(tbl_analisis.bentuk_kasus IS NULL, ''N/A'', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
					   IF(tbl_kategori_pelaku.kategori_pelaku != '''', tbl_kategori_pelaku.kategori_pelaku, ''N/A'') AS kategori_pelaku
					   FROM (SELECT id_permohonan, status_progress, tgl_progress, status_hasil, status_klien
					   FROM (SELECT tbl_progress.id_permohonan, tbl_progress.status_progress, DATE_FORMAT(tbl_progress.tgl_progress, ''%d/%m/%Y'') AS tgl_progress, tbl_hasil_keputusan.hasil_keputusan,
					   tbl_progress.status_hasil, tbl_progress.status_norma, tbl_progress.status_aparat, tbl_progress.status_pencari, tbl_progress.status_kembali, tbl_progress.status_klien
					   FROM tbl_progress 
					   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
					   ORDER BY tbl_progress.id_progress DESC ) tbl_status GROUP BY tbl_status.id_permohonan ) tbl_status_progress
					   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
					   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
					   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
					   LEFT JOIN tbl_provinsi ON tbl_penerima.id_provinsi = tbl_provinsi.id_provinsi
					   LEFT JOIN tbl_kabkota ON tbl_penerima.id_kabkota = tbl_kabkota.id_kabkota
					   LEFT JOIN tbl_pendidikan ON tbl_penerima.id_pendidikan = tbl_pendidikan.id_pendidikan
					   LEFT JOIN tbl_agama ON tbl_penerima.id_agama = tbl_agama.id_agama
					   LEFT JOIN tbl_pekerjaan ON tbl_penerima.id_pekerjaan = tbl_pekerjaan.id_pekerjaan
					   LEFT JOIN tbl_penghasilan ON tbl_penerima.id_penghasilan = tbl_penghasilan.id_penghasilan
					   LEFT JOIN tbl_jenis_kasus ON tbl_approval.id_jenis_kasus = tbl_jenis_kasus.id_jenis_kasus
					   LEFT JOIN tbl_nama_kasus ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
					   LEFT JOIN tbl_posisi_hukum ON tbl_approval.id_posisi_hukum = tbl_posisi_hukum.id_posisi_hukum
					   LEFT JOIN tbl_tindakan ON tbl_approval.id_tindakan = tbl_tindakan.id_tindakan
					   LEFT JOIN tbl_analisis ON tbl_permohonan.id_permohonan = tbl_analisis.id_permohonan
					   LEFT JOIN tbl_issue_ham ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
					   LEFT JOIN tbl_kategori_pelaku ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
					   ".$tglwherey."
					   GROUP BY tbl_approval.id_permohonan
					   ) tbl_total
					   ".$rowwhere." ".$colwherey."');";
			$query .= "PREPARE stmt FROM @sql;";
			$query .= "EXECUTE stmt;";
			$query .= "DEALLOCATE PREPARE stmt;";
		}
		
		
		if (!$mysqli->multi_query($query)) 
		{
			echo "Multi query failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}

		do 
		{
			if ($res = $mysqli->store_result()) 
			{
				$result = $res->fetch_all(MYSQLI_ASSOC);
				$res->free();
			}
		} while ($mysqli->more_results() && $mysqli->next_result());

		mysqli_close($mysqli);
		
		
		if(empty($result))
		{
			//$result[] = array('status' => 'record not found');
			$result[] = array('coltitle' => 'Judul Kolom', 'rowtitle' => 'Judul Baris');
			$result[] = array('coltitle' => '0', 'rowtitle' => '0');
			$result[] = array('coltitle' => 'Total', 'rowtitle' => '0');
			echo '<pre>';
			print_r($result);
			echo '</pre>';
		}
		else
		{
			echo '<pre>';
			print_r($result);		
			echo '</pre>';
		}		
		
		echo '<br/>'	;
		
		$arr = $result;
		$width = '100%';
		$count = count($arr);
		$index = 0;	
		
		if($count > 0)
		{
			reset($arr);
			$num = count(current($arr));
			$column =0;
			foreach(current($arr) as $key => $value)
			{
				$column++;
			} 
			echo "<table align=\"center\" border=\"1\"cellpadding=\"5\" cellspacing=\"0\" width=\"$width\">\n";
			echo "<tr>\n";

			foreach(current($arr) as $key => $value)
			{
				echo "<th>";
				echo $value."&nbsp;";
				echo "</th>\n";  
			} 
			
			$curr_row = next($arr);
					
			echo "</tr>\n";
			while ($curr_row = current($arr)) 
			{
				$index++;
				
				if($index != $count-1)
				{
					echo "<tr>\n";
					$col = 1;
					while (false !== ($curr_field = current($curr_row))) 
					{
					   echo "<td>";
					   echo $curr_field."&nbsp;";
					   echo "</td>\n";
					   next($curr_row);
					   $col++;
					}
					
					while($col <= $num)
					{
						echo "<td>&nbsp;</td>\n";
						$col++;      
					}
					
					echo "</tr>\n";	
					next($arr);			
				}
				else
				{
					
					
					echo "<tr>\n";
					
					foreach(end($arr) as $key => $value)
					{
						echo "<th>";
						echo $value."&nbsp;";
						echo "</th>\n";  
					} 
					
					
					
					echo "</tr>\n";	
					break;
										
				}
				
			}
		}
		
		echo "</table>\n";
		echo '<br/>';
		echo $index;	
		echo '<br/>';
		echo $column;
		exit;		
		
		
		
		
		
		




?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
		
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	function get_id_provinsi()
	{
		$query = $this->db->query("SELECT tbl_setting.id_provinsi AS id_provinsi FROM tbl_setting")	;
		$row = $query->row();
		$id_provinsi = $row->id_provinsi;
		return $id_provinsi;
	}
	
	function get_extract_all_data($periode, $tahun)
	{
		
		if($periode == 'Semua')
		{
			$query = $this->db->query	("SELECT 'nomor_permohonan', 'tgl_permohonan', 'provinsi', 'kab_kota', 'umur', 'kategori_umur', 'jenis_kelamin', 'kelainan_fisik', 'jenis_kelainan', 'status_perkawinan', 'pendidikan','pendidikan_lain', 'agama', 'agama_lain', 
										'pekerjaan_pokok', 'pekerjaan_lain', 'pekerjaan_tambahan', 'jenis_pekerjaan_tambahan', 'jumlah_penghasilan', 'jumlah_tanggunan', 'status_tempat_tinggal', 'jumlah_rumah', ' luas_tanah', 'jumlah_bangunan', 'jumlah_mobil', 'jumlah_motor', 'jumlah_toko', 'jumlah_tabungan', 'jumlah_handphone', 
										'ada_tanda_pengenal', 'ada_sktm', 'jarak_perjalanan_ke_kantor_lbh', 'lama_perjalanan_ke_kantor_lbh', 'pernah_jadi_client_lbh', 'tahu_lbh_dari', 'ada_anjuran_ke_lbh', 'punya_telepon', 'punya_hp', 'punya_email', 'pernah_ke_pihak_lain', 'tahap_penanganan_pihak_lain', 
										'tgl_approval', 'status_permohonan', 'jenis_masalah_hukum', 'jenis_kasus_pidana', 'jenis_kasus_perdata', 'jenis_kasus_tun', 'posisi_hukum', 'bentuk_layanan', 'rekomendasi_ke_advokat_lain', 
										'tgl_update', 'status_kasus', 'hasil_keputusan_pidana', 'hasil_keputusan_perdata', 'hasil_keputusan_tun', 'uraian_hasil_keputusan', 'baik_untuk_klien', 
										'penerapan_norma_hukum', 'perilaku_penegak_hukum', 'perilaku_pencari_keadilan', 'ada_masalah_eksekusi_pidana', 'ada_masalah_eksekusi_perdata', 'ada_masalah_eksekusi_tun', 'klien_dalam_bahaya', 'terjadi_kesepakatan', 'note', 
										'tgl_analisis', 'bentuk_kasus', 'sifat_kasus', 'issue_ham_pokok', 'tgl_kejadian', 'provinsi_tempat_kejadian', 'kabkota_tempat_kejadian', 'kategori_korban', 'kategori_pelaku', 'penghasilan_kelompok_korban', 
										'lk_dewasa', 'pr_dewasa', 'anak_lk', 'anak_pr', 'total_penerima', 'uu_yang_digunakan_lbh', 'uu_yang_digunakan_lawan' UNION ALL
										SELECT tbl_permohonan.no_reg as nomor_permohonan,
										DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m-%Y') AS tgl_permohonan,
										tbl_provinsi.nm_provinsi AS provinsi,
										tbl_kabkota.nm_kabkota AS kab_kota,
										tbl_penerima.umur AS umur,
										IF(tbl_penerima.umur < 17 , 'Anak-anak', 'Dewasa') AS kategori_umur,
										CASE tbl_penerima.jkel
										WHEN 'Laki-laki' THEN tbl_penerima.jkel
										WHEN 'Perempuan' THEN tbl_penerima.jkel
										ELSE tbl_penerima.jkel
										END AS jenis_kelamin,
										IF(tbl_penerima.kondisi_fisik = 'Ya', 'Ada' ,'Tidak') AS kelainan_fisik,
										IF(tbl_difabel.jenis_difabel IS NULL, 'N/A' , tbl_difabel.jenis_difabel) AS jenis_kelainan,
										CASE tbl_penerima.status_perkawinan
										WHEN 'Belum Kawin' THEN 'Belum Menikah'
										WHEN 'Kawin' THEN 'Menikah'
										WHEN 'Cerai Mati' AND tbl_penerima.jkel = 'Laki-laki' THEN 'Janda/Duda'
										WHEN 'Cerai Hidup' AND tbl_penerima.jkel = 'Laki-laki' THEN 'Janda/Duda'
										WHEN 'Cerai Mati' AND tbl_penerima.jkel = 'Perempuan' THEN 'Janda/Duda'
										WHEN 'Cerai Hidup' AND tbl_penerima.jkel = 'Perempuan' THEN 'Janda/Duda'
										WHEN 'Cerai Mati' AND tbl_penerima.jkel = 'Lainnya' THEN 'Janda/Duda'
										WHEN 'Cerai Hidup' AND tbl_penerima.jkel = 'Lainnya' THEN 'Janda/Duda'
										ELSE 'N/A'
										END AS status_perkawinan,
										tbl_pendidikan.nm_pendidikan AS pendidikan,
										CASE 
										WHEN tbl_penerima.pendidikan_desc = '' THEN 'N/A'
										WHEN tbl_penerima.pendidikan_desc IS NULL THEN 'N/A'
										ELSE tbl_penerima.pendidikan_desc END AS pendidikan_lain,
										tbl_agama.nm_agama AS agama,
										CASE 
										WHEN tbl_penerima.agama_desc = '' THEN 'N/A'
										WHEN tbl_penerima.agama_desc IS NULL THEN 'N/A'
										ELSE tbl_penerima.agama_desc END AS agama_lain,
										tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok,
										CASE 
										WHEN tbl_penerima.pekerjaan_desc = '' THEN 'N/A'
										WHEN tbl_penerima.pekerjaan_desc IS NULL THEN 'N/A'
										ELSE  tbl_penerima.pekerjaan_desc 
										END AS pekerjaan_lain,
										IF(tbl_penerima.pekerjaan2 = 'Ya', 'Ada', 'Tidak') as pekerjaan_tambahan,
										CASE 
										WHEN tbl_penerima.pekerjaan2_desc = '' THEN 'N/A'
										WHEN tbl_penerima.pekerjaan2_desc IS NULL THEN 'N/A'
										ELSE  tbl_penerima.pekerjaan2_desc 
										END AS jenis_pekerjaan_tambahan,
										tbl_penghasilan.jml_penghasilan AS jumlah_penghasilan,
										tbl_penerima.tanggungan_total AS jumlah_tanggunan,
										tbl_penerima.status_tempat_tinggal AS status_tempat_tinggal,
										tbl_penerima.harta_rumah as jumlah_rumah, 
										tbl_penerima.harta_tanah as luas_tanah,
										tbl_penerima.harta_bangunan as jumlah_bangunan,
										tbl_penerima.harta_mobil as jumlah_mobil,
										tbl_penerima.harta_motor as jumlah_motor,
										tbl_penerima.harta_toko as jumlah_toko,
										tbl_penerima.harta_tabungan as jumlah_tabungan,
										tbl_penerima.harta_handphone as jumlah_handphone,
										CASE tbl_penerima.jenis_kid
										WHEN 'Tidak Ada' THEN 'Tidak'
										ELSE 'Ya'
										END AS ada_tanda_pengenal,
										CASE tbl_penerima.jenis_ktm
										WHEN 'Tidak Ada' THEN 'Tidak'
										ELSE 'Ya'
										END AS ada_sktm,
										tbl_jarak_tempuh.jarak_tempuh AS jarak_perjalanan_ke_kantor_lbh,
										tbl_waktu_tempuh.waktu_tempuh AS lama_perjalanan_ke_kantor_lbh,
										IF(tbl_pemohon.pernah_jadi_client = 'Pernah', 'Ya', 'Tidak') as pernah_jadi_client_lbh,
										CASE tbl_pemohon.id_sumber_info
										WHEN 0 THEN 'N/A'
										ELSE tbl_sumber_info.nm_sumber_info
										END AS tahu_lbh_dari,
										IF(tbl_pemohon.rekomendasi_lbh = 'Ya', 'Ya', 'Tidak') as ada_anjuran_ke_lbh,
										IF(tbl_penerima.no_telp = '-', 'Tidak', 'Ya') as punya_telepon,
										IF(tbl_penerima.no_hp = '-', 'Tidak', 'Ya') as punya_hp,
										CASE tbl_penerima.email
										WHEN '' THEN 'Tidak'
										WHEN '-' THEN 'Tidak'
										ELSE 'Ya'
										END AS punya_email,
										tbl_permohonan.penanganan_pihak_lain AS pernah_ke_pihak_lain,
										IF(tbl_permohonan.tahap_penanganan_pihak_lain = '', 'N/A', tbl_permohonan.tahap_penanganan_pihak_lain) AS tahap_penanganan_pihak_lain,
										IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
										IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
										IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
										IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
										IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
										IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
										IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
										IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS bentuk_layanan,
										CASE tbl_approval.status_rekomendasi 
										WHEN 'Ya' THEN 'Ya'
										WHEN 'Tidak' THEN 'Tidak'
										ELSE  'N/A'
										END AS rekomendasi_ke_advokat_lain,
										IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
										IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
										CASE 
										WHEN hasil_keputusan != 'N/A' AND tbl_jenis_kasus.jenis_kasus = 'Pidana' THEN hasil_keputusan
										ELSE 'N/A'
										END AS hasil_keputusan_pidana,
										CASE 
										WHEN hasil_keputusan != 'N/A' AND tbl_jenis_kasus.jenis_kasus = 'Perdata' THEN hasil_keputusan
										ELSE 'N/A'
										END AS hasil_keputusan_perdata,
										CASE 
										WHEN hasil_keputusan != 'N/A' AND tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' THEN hasil_keputusan
										ELSE 'N/A'
										END AS hasil_keputusan_tun,
										IF(uraian_keputusan = '' OR  uraian_keputusan IS NULL, 'N/A', uraian_keputusan) AS uraian_hasil_keputusan,
										CASE status_hasil 
										WHEN 'Ya' THEN status_hasil
										WHEN 'Tidak' THEN status_hasil
										ELSE 'N/A'
										END AS baik_untuk_klien,
										CASE status_norma 
										WHEN 'Sesuai' THEN 'Sesuai'
										WHEN 'Tidak Sesuai' THEN 'Tidak'
										ELSE 'N/A'
										END AS penerapan_norma_hukum,
										CASE status_aparat 
										WHEN 'Sesuai' THEN 'Sesuai'
										WHEN 'Tidak Sesuai' THEN 'Tidak'
										ELSE 'N/A'
										END AS perilaku_penegak_hukum,
										CASE status_pencari 
										WHEN 'Sesuai' THEN 'Sesuai'
										WHEN 'Tidak Sesuai' THEN 'Tidak'
										ELSE 'N/A'
										END AS perilaku_pencari_keadilan,
										CASE 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Pidana' AND status_kembali = 'Ya' THEN 'Ya' 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Pidana' AND status_kembali = 'Tidak' THEN 'Tidak' 
										ELSE 'N/A'
										END AS ada_masalah_eksekusi_pidana,
										CASE 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Perdata' AND status_kembali = 'Ya' THEN 'Ya' 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Perdata' AND status_kembali = 'Tidak' THEN 'Tidak' 
										ELSE 'N/A'
										END AS ada_masalah_eksekusi_perdata,
										CASE 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' AND status_kembali = 'Ya' THEN 'Ya' 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' AND status_kembali = 'Tidak' THEN 'Tidak' 
										ELSE 'N/A'
										END AS ada_masalah_eksekusi_tun,
										IF(status_klien IS NULL OR status_klien = '', 'N/A',  status_klien) AS klien_dalam_bahaya,
										CASE status_sepakat 
										WHEN 'Ya' THEN status_sepakat
										WHEN 'Tidak' THEN status_sepakat
										ELSE 'N/A'
										END AS terjadi_kesepakatan,
										IF(keterangan_tambahan IS NULL OR keterangan_tambahan = '', 'N/A',  keterangan_tambahan) AS note,
										IF(tbl_analisis.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_analisis.insert_date, '%d/%m/%Y')) AS tgl_analisis,
										IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
										IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
										IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
										IF(tbl_analisis.tgl_kejadian IS NULL , 'N/A' , DATE_FORMAT(tbl_analisis.tgl_kejadian, '%d/%m/%Y')) AS tgl_kejadian,
										IF(tbl_provinsi_kejadian.nm_provinsi IS NULL, 'N/A', tbl_provinsi_kejadian.nm_provinsi) AS provinsi_tempat_kejadian,
										IF(tbl_kabkota_kejadian.nm_kabkota IS NULL, 'N/A', tbl_kabkota_kejadian.nm_kabkota) AS kabkota_tempat_kejadian,
										IF(tbl_kategori_korban.kategori_korban != '', tbl_kategori_korban.kategori_korban, 'N/A') AS kategori_korban,
										IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku,
										IF(tbl_penghasilan_analisis.jml_penghasilan != '', tbl_penghasilan_analisis.jml_penghasilan, 'N/A') AS penghasilan_kelompok_korban,
										IF(tbl_analisis.lk_dewasa IS NULL, 0, tbl_analisis.lk_dewasa) AS lk_dewasa,
										IF(tbl_analisis.pr_dewasa IS NULL, 0, tbl_analisis.pr_dewasa) AS pr_dewasa,
										IF(tbl_analisis.lk_anak IS NULL, 0, tbl_analisis.lk_anak) AS anak_lk,
										IF(tbl_analisis.pr_anak IS NULL, 0, tbl_analisis.pr_anak) AS anak_pr,
										IF(tbl_analisis.total_penerima IS NULL, 0, tbl_analisis.total_penerima) AS total_penerima,
										IF(tbl_analisis.uu_lbh IS NULL, 'N/A', tbl_analisis.uu_lbh) AS uu_yang_digunakan_lbh,
										IF(tbl_analisis.uu_lawan IS NULL, 'N/A', tbl_analisis.uu_lawan) AS uu_yang_digunakan_lawan
										FROM (
										SELECT
										id_permohonan,
										status_progress,
										tgl_progress,
										hasil_keputusan,
										uraian_keputusan,
										status_hasil,
										status_sepakat,
										status_norma,
										status_aparat,
										status_pencari,
										status_kembali,
										status_klien,
										keterangan_tambahan
										FROM (
										SELECT tbl_progress.id_permohonan,
										tbl_progress.status_progress,
										DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress,
										tbl_hasil_keputusan.hasil_keputusan,
										tbl_progress.uraian_keputusan,
										tbl_progress.status_hasil,
										tbl_progress.status_sepakat,
										tbl_progress.status_norma,
										tbl_progress.status_aparat,
										tbl_progress.status_pencari,
										tbl_progress.status_kembali,
										tbl_progress.status_klien,
										tbl_progress.note_progress AS keterangan_tambahan
										FROM tbl_progress
										LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
										ORDER BY tbl_progress.id_progress DESC
										) tbl_status
										GROUP BY tbl_status.id_permohonan
										) tbl_status_progress
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
										GROUP BY tbl_approval.id_permohonan");
		}
		else
		{
			$query = $this->db->query	("SELECT 'nomor_permohonan', 'tgl_permohonan', 'provinsi', 'kab_kota', 'umur', 'kategori_umur', 'jenis_kelamin', 'kelainan_fisik', 'jenis_kelainan', 'status_perkawinan', 'pendidikan','pendidikan_lain', 'agama', 'agama_lain', 
										'pekerjaan_pokok', 'pekerjaan_lain', 'pekerjaan_tambahan', 'jenis_pekerjaan_tambahan', 'jumlah_penghasilan', 'jumlah_tanggunan', 'status_tempat_tinggal', 'jumlah_rumah', ' luas_tanah', 'jumlah_bangunan', 'jumlah_mobil', 'jumlah_motor', 'jumlah_toko', 'jumlah_tabungan', 'jumlah_handphone', 
										'ada_tanda_pengenal', 'ada_sktm', 'jarak_perjalanan_ke_kantor_lbh', 'lama_perjalanan_ke_kantor_lbh', 'pernah_jadi_client_lbh', 'tahu_lbh_dari', 'ada_anjuran_ke_lbh', 'punya_telepon', 'punya_hp', 'punya_email', 'pernah_ke_pihak_lain', 'tahap_penanganan_pihak_lain', 
										'tgl_approval', 'status_permohonan', 'jenis_masalah_hukum', 'jenis_kasus_pidana', 'jenis_kasus_perdata', 'jenis_kasus_tun', 'posisi_hukum', 'bentuk_layanan', 'rekomendasi_ke_advokat_lain', 
										'tgl_update', 'status_kasus', 'hasil_keputusan_pidana', 'hasil_keputusan_perdata', 'hasil_keputusan_tun', 'uraian_hasil_keputusan', 'baik_untuk_klien', 
										'penerapan_norma_hukum', 'perilaku_penegak_hukum', 'perilaku_pencari_keadilan', 'ada_masalah_eksekusi_pidana', 'ada_masalah_eksekusi_perdata', 'ada_masalah_eksekusi_tun', 'klien_dalam_bahaya', 'terjadi_kesepakatan', 'note', 
										'tgl_analisis', 'bentuk_kasus', 'sifat_kasus', 'issue_ham_pokok', 'tgl_kejadian', 'provinsi_tempat_kejadian', 'kabkota_tempat_kejadian', 'kategori_korban', 'kategori_pelaku', 'penghasilan_kelompok_korban', 
										'lk_dewasa', 'pr_dewasa', 'anak_lk', 'anak_pr', 'total_penerima', 'uu_yang_digunakan_lbh', 'uu_yang_digunakan_lawan' UNION ALL
										SELECT tbl_permohonan.no_reg as nomor_permohonan,
										DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m-%Y') AS tgl_permohonan,
										tbl_provinsi.nm_provinsi AS provinsi,
										tbl_kabkota.nm_kabkota AS kab_kota,
										tbl_penerima.umur AS umur,
										IF(tbl_penerima.umur < 17 , 'Anak-anak', 'Dewasa') AS kategori_umur,
										CASE tbl_penerima.jkel
										WHEN 'Laki-laki' THEN tbl_penerima.jkel
										WHEN 'Perempuan' THEN tbl_penerima.jkel
										ELSE tbl_penerima.jkel
										END AS jenis_kelamin,
										IF(tbl_penerima.kondisi_fisik = 'Ya', 'Ada' ,'Tidak') AS kelainan_fisik,
										IF(tbl_difabel.jenis_difabel IS NULL, 'N/A' , tbl_difabel.jenis_difabel) AS jenis_kelainan,
										CASE tbl_penerima.status_perkawinan
										WHEN 'Belum Kawin' THEN 'Belum Menikah'
										WHEN 'Kawin' THEN 'Menikah'
										WHEN 'Cerai Mati' AND tbl_penerima.jkel = 'Laki-laki' THEN 'Janda/Duda'
										WHEN 'Cerai Hidup' AND tbl_penerima.jkel = 'Laki-laki' THEN 'Janda/Duda'
										WHEN 'Cerai Mati' AND tbl_penerima.jkel = 'Perempuan' THEN 'Janda/Duda'
										WHEN 'Cerai Hidup' AND tbl_penerima.jkel = 'Perempuan' THEN 'Janda/Duda'
										WHEN 'Cerai Mati' AND tbl_penerima.jkel = 'Lainnya' THEN 'Janda/Duda'
										WHEN 'Cerai Hidup' AND tbl_penerima.jkel = 'Lainnya' THEN 'Janda/Duda'
										ELSE 'N/A'
										END AS status_perkawinan,
										tbl_pendidikan.nm_pendidikan AS pendidikan,
										CASE 
										WHEN tbl_penerima.pendidikan_desc = '' THEN 'N/A'
										WHEN tbl_penerima.pendidikan_desc IS NULL THEN 'N/A'
										ELSE tbl_penerima.pendidikan_desc END AS pendidikan_lain,
										tbl_agama.nm_agama AS agama,
										CASE 
										WHEN tbl_penerima.agama_desc = '' THEN 'N/A'
										WHEN tbl_penerima.agama_desc IS NULL THEN 'N/A'
										ELSE tbl_penerima.agama_desc END AS agama_lain,
										tbl_pekerjaan.jenis_pekerjaan AS pekerjaan_pokok,
										CASE 
										WHEN tbl_penerima.pekerjaan_desc = '' THEN 'N/A'
										WHEN tbl_penerima.pekerjaan_desc IS NULL THEN 'N/A'
										ELSE  tbl_penerima.pekerjaan_desc 
										END AS pekerjaan_lain,
										IF(tbl_penerima.pekerjaan2 = 'Ya', 'Ada', 'Tidak') as pekerjaan_tambahan,
										CASE 
										WHEN tbl_penerima.pekerjaan2_desc = '' THEN 'N/A'
										WHEN tbl_penerima.pekerjaan2_desc IS NULL THEN 'N/A'
										ELSE  tbl_penerima.pekerjaan2_desc 
										END AS jenis_pekerjaan_tambahan,
										tbl_penghasilan.jml_penghasilan AS jumlah_penghasilan,
										tbl_penerima.tanggungan_total AS jumlah_tanggunan,
										tbl_penerima.status_tempat_tinggal AS status_tempat_tinggal,
										tbl_penerima.harta_rumah as jumlah_rumah, 
										tbl_penerima.harta_tanah as luas_tanah,
										tbl_penerima.harta_bangunan as jumlah_bangunan,
										tbl_penerima.harta_mobil as jumlah_mobil,
										tbl_penerima.harta_motor as jumlah_motor,
										tbl_penerima.harta_toko as jumlah_toko,
										tbl_penerima.harta_tabungan as jumlah_tabungan,
										tbl_penerima.harta_handphone as jumlah_handphone,
										CASE tbl_penerima.jenis_kid
										WHEN 'Tidak Ada' THEN 'Tidak'
										ELSE 'Ya'
										END AS ada_tanda_pengenal,
										CASE tbl_penerima.jenis_ktm
										WHEN 'Tidak Ada' THEN 'Tidak'
										ELSE 'Ya'
										END AS ada_sktm,
										tbl_jarak_tempuh.jarak_tempuh AS jarak_perjalanan_ke_kantor_lbh,
										tbl_waktu_tempuh.waktu_tempuh AS lama_perjalanan_ke_kantor_lbh,
										IF(tbl_pemohon.pernah_jadi_client = 'Pernah', 'Ya', 'Tidak') as pernah_jadi_client_lbh,
										CASE tbl_pemohon.id_sumber_info
										WHEN 0 THEN 'N/A'
										ELSE tbl_sumber_info.nm_sumber_info
										END AS tahu_lbh_dari,
										IF(tbl_pemohon.rekomendasi_lbh = 'Ya', 'Ya', 'Tidak') as ada_anjuran_ke_lbh,
										IF(tbl_penerima.no_telp = '-', 'Tidak', 'Ya') as punya_telepon,
										IF(tbl_penerima.no_hp = '-', 'Tidak', 'Ya') as punya_hp,
										CASE tbl_penerima.email
										WHEN '' THEN 'Tidak'
										WHEN '-' THEN 'Tidak'
										ELSE 'Ya'
										END AS punya_email,
										tbl_permohonan.penanganan_pihak_lain AS pernah_ke_pihak_lain,
										IF(tbl_permohonan.tahap_penanganan_pihak_lain = '', 'N/A', tbl_permohonan.tahap_penanganan_pihak_lain) AS tahap_penanganan_pihak_lain,
										IF(tbl_approval.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_approval.insert_date, '%d/%m/%Y')) AS tgl_approval,
										IF(tbl_approval.status_approval IS NULL , 'N/A', tbl_approval.status_approval) AS status_permohonan,
										IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_masalah_hukum,
										IF(tbl_jenis_kasus.jenis_kasus = 'Pidana' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_pidana,
										IF(tbl_jenis_kasus.jenis_kasus = 'Perdata' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_perdata,
										IF(tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' , tbl_nama_kasus.nama_kasus , 'N/A') AS jenis_kasus_tun,
										IF(tbl_posisi_hukum.posisi_hukum IS NULL, 'N/A', tbl_posisi_hukum.posisi_hukum) AS posisi_hukum,
										IF(tbl_tindakan.jenis_tindakan IS NULL, 'N/A', tbl_tindakan.jenis_tindakan) AS bentuk_layanan,
										CASE tbl_approval.status_rekomendasi 
										WHEN 'Ya' THEN 'Ya'
										WHEN 'Tidak' THEN 'Tidak'
										ELSE  'N/A'
										END AS rekomendasi_ke_advokat_lain,
										IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_update,
										IF(status_progress IS NULL, 'N/A', status_progress) AS status_kasus,
										CASE 
										WHEN hasil_keputusan != 'N/A' AND tbl_jenis_kasus.jenis_kasus = 'Pidana' THEN hasil_keputusan
										ELSE 'N/A'
										END AS hasil_keputusan_pidana,
										CASE 
										WHEN hasil_keputusan != 'N/A' AND tbl_jenis_kasus.jenis_kasus = 'Perdata' THEN hasil_keputusan
										ELSE 'N/A'
										END AS hasil_keputusan_perdata,
										CASE 
										WHEN hasil_keputusan != 'N/A' AND tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' THEN hasil_keputusan
										ELSE 'N/A'
										END AS hasil_keputusan_tun,
										IF(uraian_keputusan = '' OR  uraian_keputusan IS NULL, 'N/A', uraian_keputusan) AS uraian_hasil_keputusan,
										CASE status_hasil 
										WHEN 'Ya' THEN status_hasil
										WHEN 'Tidak' THEN status_hasil
										ELSE 'N/A'
										END AS baik_untuk_klien,
										CASE status_norma 
										WHEN 'Sesuai' THEN 'Sesuai'
										WHEN 'Tidak Sesuai' THEN 'Tidak'
										ELSE 'N/A'
										END AS penerapan_norma_hukum,
										CASE status_aparat 
										WHEN 'Sesuai' THEN 'Sesuai'
										WHEN 'Tidak Sesuai' THEN 'Tidak'
										ELSE 'N/A'
										END AS perilaku_penegak_hukum,
										CASE status_pencari 
										WHEN 'Sesuai' THEN 'Sesuai'
										WHEN 'Tidak Sesuai' THEN 'Tidak'
										ELSE 'N/A'
										END AS perilaku_pencari_keadilan,
										CASE 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Pidana' AND status_kembali = 'Ya' THEN 'Ya' 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Pidana' AND status_kembali = 'Tidak' THEN 'Tidak' 
										ELSE 'N/A'
										END AS ada_masalah_eksekusi_pidana,
										CASE 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Perdata' AND status_kembali = 'Ya' THEN 'Ya' 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Perdata' AND status_kembali = 'Tidak' THEN 'Tidak' 
										ELSE 'N/A'
										END AS ada_masalah_eksekusi_perdata,
										CASE 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' AND status_kembali = 'Ya' THEN 'Ya' 
										WHEN tbl_jenis_kasus.jenis_kasus = 'Tata Usaha Negara' AND status_kembali = 'Tidak' THEN 'Tidak' 
										ELSE 'N/A'
										END AS ada_masalah_eksekusi_tun,
										IF(status_klien IS NULL OR status_klien = '', 'N/A',  status_klien) AS klien_dalam_bahaya,
										CASE status_sepakat 
										WHEN 'Ya' THEN status_sepakat
										WHEN 'Tidak' THEN status_sepakat
										ELSE 'N/A'
										END AS terjadi_kesepakatan,
										IF(keterangan_tambahan IS NULL OR keterangan_tambahan = '', 'N/A',  keterangan_tambahan) AS note,
										IF(tbl_analisis.insert_date IS NULL , 'N/A' , DATE_FORMAT(tbl_analisis.insert_date, '%d/%m/%Y')) AS tgl_analisis,
										IF(tbl_analisis.bentuk_kasus IS NULL, 'N/A', tbl_analisis.bentuk_kasus) AS bentuk_kasus,
										IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
										IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham_pokok,
										IF(tbl_analisis.tgl_kejadian IS NULL , 'N/A' , DATE_FORMAT(tbl_analisis.tgl_kejadian, '%d/%m/%Y')) AS tgl_kejadian,
										IF(tbl_provinsi_kejadian.nm_provinsi IS NULL, 'N/A', tbl_provinsi_kejadian.nm_provinsi) AS provinsi_tempat_kejadian,
										IF(tbl_kabkota_kejadian.nm_kabkota IS NULL, 'N/A', tbl_kabkota_kejadian.nm_kabkota) AS kabkota_tempat_kejadian,
										IF(tbl_kategori_korban.kategori_korban != '', tbl_kategori_korban.kategori_korban, 'N/A') AS kategori_korban,
										IF(tbl_kategori_pelaku.kategori_pelaku != '', tbl_kategori_pelaku.kategori_pelaku, 'N/A') AS kategori_pelaku,
										IF(tbl_penghasilan_analisis.jml_penghasilan != '', tbl_penghasilan_analisis.jml_penghasilan, 'N/A') AS penghasilan_kelompok_korban,
										IF(tbl_analisis.lk_dewasa IS NULL, 0, tbl_analisis.lk_dewasa) AS lk_dewasa,
										IF(tbl_analisis.pr_dewasa IS NULL, 0, tbl_analisis.pr_dewasa) AS pr_dewasa,
										IF(tbl_analisis.lk_anak IS NULL, 0, tbl_analisis.lk_anak) AS anak_lk,
										IF(tbl_analisis.pr_anak IS NULL, 0, tbl_analisis.pr_anak) AS anak_pr,
										IF(tbl_analisis.total_penerima IS NULL, 0, tbl_analisis.total_penerima) AS total_penerima,
										IF(tbl_analisis.uu_lbh IS NULL, 'N/A', tbl_analisis.uu_lbh) AS uu_yang_digunakan_lbh,
										IF(tbl_analisis.uu_lawan IS NULL, 'N/A', tbl_analisis.uu_lawan) AS uu_yang_digunakan_lawan
										FROM (
										SELECT
										id_permohonan,
										status_progress,
										tgl_progress,
										hasil_keputusan,
										uraian_keputusan,
										status_hasil,
										status_sepakat,
										status_norma,
										status_aparat,
										status_pencari,
										status_kembali,
										status_klien,
										keterangan_tambahan
										FROM (
										SELECT tbl_progress.id_permohonan,
										tbl_progress.status_progress,
										DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress,
										tbl_hasil_keputusan.hasil_keputusan,
										tbl_progress.uraian_keputusan,
										tbl_progress.status_hasil,
										tbl_progress.status_sepakat,
										tbl_progress.status_norma,
										tbl_progress.status_aparat,
										tbl_progress.status_pencari,
										tbl_progress.status_kembali,
										tbl_progress.status_klien,
										tbl_progress.note_progress AS keterangan_tambahan
										FROM tbl_progress
										LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
										ORDER BY tbl_progress.id_progress DESC
										) tbl_status
										GROUP BY tbl_status.id_permohonan
										) tbl_status_progress
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
										WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') ='".$tahun."'
										GROUP BY tbl_approval.id_permohonan");
		}
		
		return $query->result_array();	
	}
	
	function get_empty_frequency()
	{
		$query = $this->db->query("SELECT 'description' AS description, '0' AS jumlah, '0' AS freq");
		
		return $query;
		
	}
	
	
	function get_frequency_result($freq_type, $freq_periode, $freq_tahun)
	{
		if($freq_periode == 'Semua')
		{
			if($freq_type == '1') /*Kabupaten*/
			{
				$query = $this->db->query("SET @totalx := (SELECT COUNT(tbl_penerima.id_provinsi) AS totalx FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE tbl_penerima.id_provinsi = '".$this->get_id_provinsi()."' 
										   /**/
										   )"); 
				$query = $this->db->query("SET @totaly := (SELECT COUNT(tbl_penerima.id_provinsi) AS totaly FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."' 
										   /**/
										   )"); 
				$query = $this->db->query("SET @total := @totalx + @totaly"); 
				$query = $this->db->query("SELECT 'Luar Propinsi' AS description, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT IF(COUNT(tbl_penerima.id_kabkota) IS NULL, 0, COUNT(tbl_penerima.id_kabkota)) AS jumlah
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."'
										   ) tbl_jumlah 
										   UNION ALL
										   SELECT tbl_kabkota.nm_kabkota AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_penerima.id_kabkota AS id, 
										   IF(COUNT(tbl_penerima.id_kabkota) IS NULL, 0, COUNT(tbl_penerima.id_kabkota)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE tbl_penerima.id_provinsi = '".$this->get_id_provinsi()."' 
										   GROUP BY tbl_penerima.id_kabkota 
										   /**/
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_kabkota ON tbl_kabkota.id_kabkota = tbl_result.id
										   WHERE tbl_kabkota.id_provinsi = '".$this->get_id_provinsi()."'");
				
			} 
			else if($freq_type == '2') /*Jkel*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.jkel) AS total 
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   /**/
										   )");
				$query = $this->db->query("SELECT IF(jkel = 'Lainnya', 'Lainnya', jkel) AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (SELECT tbl_penerima.jkel,  COUNT(tbl_penerima.jkel) AS jumlah FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   GROUP BY tbl_penerima.jkel ) tbl_jumlah GROUP BY tbl_jumlah.jkel");
			}
			else if($freq_type == '3') /*Umur*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(id_umur) AS total 
										   FROM (SELECT CASE 
										   WHEN umur < 17 THEN '2'
										   WHEN umur < 26 THEN '3'
										   WHEN umur < 36 THEN '4'
										   WHEN umur < 46 THEN '5'
										   WHEN umur < 56 THEN '6'
										   WHEN umur < 66 THEN '7'
										   ELSE '8' END AS id_umur
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_total)"); 
				$query = $this->db->query("SELECT tbl_kategori_usia.jarak_usia AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id_umur, jumlah, ROUND(SUM(jumlah/@total * 100), 2) as freq 
										   FROM (
										   SELECT id_umur, COUNT(id_umur) AS jumlah
										   FROM (
										   SELECT CASE 
										   WHEN umur < 17 THEN '2'
										   WHEN umur < 26 THEN '3'
										   WHEN umur < 36 THEN '4'
										   WHEN umur < 46 THEN '5'
										   WHEN umur < 56 THEN '6'
										   WHEN umur < 66 THEN '7'
										   ELSE '8' END AS id_umur
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   /**/
										   ) tbl_jumlah GROUP BY tbl_jumlah.id_umur 
										   ) tbl_freq GROUP BY tbl_freq.id_umur 
										   ) tbl_result
										   RIGHT JOIN tbl_kategori_usia ON tbl_kategori_usia.id_kategori_usia = tbl_result.id_umur
										   ORDER BY tbl_kategori_usia.no_urut");
			}
			else if($freq_type == '4') /*Agama*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_agama) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_penerima.id_agama
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_agama.nm_agama AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_agama.id_agama AS id, 
										   IF(COUNT(tbl_penerima.id_agama) IS NULL, 0, COUNT(tbl_penerima.id_agama)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_penerima.id_agama
										   /**/
										   GROUP BY tbl_agama.id_agama 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_agama ON tbl_agama.id_agama = tbl_freq.id
										   ORDER BY tbl_agama.no_urut ASC");
			}
			else if($freq_type == '5') /*Pendidikan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_pendidikan) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pendidikan ON tbl_pendidikan.id_pendidikan = tbl_penerima.id_pendidikan
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_pendidikan.nm_pendidikan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_pendidikan.id_pendidikan AS id, 
										   IF(COUNT(tbl_penerima.id_pendidikan) IS NULL, 0, COUNT(tbl_penerima.id_pendidikan)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pendidikan ON tbl_pendidikan.id_pendidikan = tbl_penerima.id_pendidikan
										   /**/
										   GROUP BY tbl_pendidikan.id_pendidikan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_pendidikan ON tbl_pendidikan.id_pendidikan = tbl_freq.id
										   ORDER BY tbl_pendidikan.id_pendidikan ASC");
			}
			else if($freq_type == '6') /*Pekerjaan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_pekerjaan) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pekerjaan ON tbl_pekerjaan.id_pekerjaan = tbl_penerima.id_pekerjaan
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_pekerjaan.jenis_pekerjaan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_pekerjaan.id_pekerjaan AS id, 
										   IF(COUNT(tbl_penerima.id_pekerjaan) IS NULL, 0, COUNT(tbl_penerima.id_pekerjaan)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pekerjaan ON tbl_pekerjaan.id_pekerjaan = tbl_penerima.id_pekerjaan
										   /**/
										   GROUP BY tbl_pekerjaan.id_pekerjaan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_pekerjaan ON tbl_pekerjaan.id_pekerjaan = tbl_freq.id
										   ORDER BY tbl_pekerjaan.no_urut ASC");
			}
			else if($freq_type == '7') /*Penghasilan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_penghasilan) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_penerima.id_penghasilan
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_penghasilan.jml_penghasilan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_penghasilan.id_penghasilan AS id, 
										   IF(COUNT(tbl_penerima.id_penghasilan) IS NULL, 0, COUNT(tbl_penerima.id_penghasilan)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_penerima.id_penghasilan
										   /**/
										   GROUP BY tbl_penghasilan.id_penghasilan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_freq.id
										   ORDER BY tbl_penghasilan.id_penghasilan ASC");
			}
			else if($freq_type == '8') /*Jarak Tempuh*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.id_jarak_tempuh) AS total FROM tbl_approval 
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_jarak_tempuh ON tbl_jarak_tempuh.id_jarak_tempuh = tbl_pemohon.id_jarak_tempuh
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_jarak_tempuh.jarak_tempuh AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_jarak_tempuh.id_jarak_tempuh AS id, 
										   IF(COUNT(tbl_pemohon.id_jarak_tempuh) IS NULL, 0, COUNT(tbl_pemohon.id_jarak_tempuh)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_jarak_tempuh ON tbl_jarak_tempuh.id_jarak_tempuh = tbl_pemohon.id_jarak_tempuh
										   /**/
										   GROUP BY tbl_jarak_tempuh.id_jarak_tempuh 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_jarak_tempuh ON tbl_jarak_tempuh.id_jarak_tempuh = tbl_freq.id
										   ORDER BY tbl_jarak_tempuh.id_jarak_tempuh ASC");
			}
			else if($freq_type == '9') /*Waktu Tempuh*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.id_waktu_tempuh) AS total FROM tbl_approval 
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_waktu_tempuh ON tbl_waktu_tempuh.id_waktu_tempuh = tbl_pemohon.id_waktu_tempuh
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_waktu_tempuh.waktu_tempuh AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_waktu_tempuh.id_waktu_tempuh AS id, 
										   IF(COUNT(tbl_pemohon.id_waktu_tempuh) IS NULL, 0, COUNT(tbl_pemohon.id_waktu_tempuh)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_waktu_tempuh ON tbl_waktu_tempuh.id_waktu_tempuh = tbl_pemohon.id_waktu_tempuh
										   /**/
										   GROUP BY tbl_waktu_tempuh.id_waktu_tempuh 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_waktu_tempuh ON tbl_waktu_tempuh.id_waktu_tempuh = tbl_freq.id
										   ORDER BY tbl_waktu_tempuh.id_waktu_tempuh ASC");
			}
			else if($freq_type == '10') /*Tempat Tinggal*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_penerima.status_tempat_tinggal) AS total
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_status_tempat_tinggal.status_tempat_tinggal AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_penerima.status_tempat_tinggal+0 AS id, 
										   COUNT(tbl_penerima.status_tempat_tinggal) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   GROUP BY id 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id
										   ) tbl_result
										   RIGHT JOIN tbl_status_tempat_tinggal ON tbl_status_tempat_tinggal.id_status_tempat_tinggal = tbl_result.id
										   GROUP BY tbl_status_tempat_tinggal.id_status_tempat_tinggal
										   ORDER BY tbl_status_tempat_tinggal.id_status_tempat_tinggal ASC");
			}
			else if($freq_type == '11') /*Pernah Jadi Klien*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.pernah_jadi_client) AS total 
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   )");
				$query = $this->db->query("SELECT pernah_jadi_client AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_pemohon.pernah_jadi_client, COUNT(tbl_pemohon.pernah_jadi_client) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   GROUP BY tbl_pemohon.pernah_jadi_client
										   ) tbl_freq GROUP BY pernah_jadi_client");
			}
			else if($freq_type == '12') /*Tahu LBH*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.id_sumber_info) AS total FROM tbl_approval 
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_sumber_info ON tbl_sumber_info.id_sumber_info = tbl_pemohon.id_sumber_info
										   /**/
										   WHERE tbl_pemohon.pernah_jadi_client = 'Belum')");
				$query = $this->db->query("SELECT tbl_sumber_info.nm_sumber_info AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_sumber_info.id_sumber_info AS id, 
										   IF(COUNT(tbl_pemohon.id_sumber_info) IS NULL, 0, COUNT(tbl_pemohon.id_sumber_info)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_sumber_info ON tbl_sumber_info.id_sumber_info = tbl_pemohon.id_sumber_info
										   /**/
										   WHERE tbl_pemohon.pernah_jadi_client = 'Belum'
										   GROUP BY tbl_sumber_info.id_sumber_info 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_sumber_info ON tbl_sumber_info.id_sumber_info = tbl_freq.id
										   ORDER BY tbl_sumber_info.no_urut ASC");
			}
			else if($freq_type == '13') /*Punya Telp Rumah*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_no_telp) AS total 
										   FROM (SELECT CASE no_telp
										   WHEN '-' THEN 'Tidak Punya Telepon'
										   WHEN '' THEN 'Tidak Punya Telepon'
										   ELSE 'Punya Telepon' END AS status_no_telp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   )tbl_total)");
				$query = $this->db->query("SELECT status_no_telp AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT status_no_telp, 
										   COUNT(status_no_telp) AS jumlah
										   FROM (
										   SELECT CASE no_telp
										   WHEN '-' THEN 'Tidak Punya Telepon'
										   WHEN '' THEN 'Tidak Punya Telepon'
										   ELSE 'Punya Telepon' END AS status_no_telp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_jumlah GROUP BY status_no_telp
										   ) tbl_freq GROUP BY status_no_telp");
			}
			else if($freq_type == '14') /*Punya HP*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_no_hp) AS total 
										   FROM (SELECT CASE no_hp
										   WHEN '-' THEN 'Tidak Punya HP'
										   WHEN '' THEN 'Tidak Punya HP'
										   ELSE 'Punya HP' END AS status_no_hp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   )tbl_total)");
				$query = $this->db->query("SELECT status_no_hp AS description, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (SELECT status_no_hp, COUNT(status_no_hp) AS jumlah
										   FROM (SELECT CASE no_hp
										   WHEN '-' THEN 'Tidak Punya HP'
										   WHEN '' THEN 'Tidak Punya HP'
										   ELSE 'Punya HP' END AS status_no_hp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_jumlah GROUP BY status_no_hp
										   ) tbl_freq GROUP BY status_no_hp");
			}
			else if($freq_type == '15') /*Punya Email*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_email) AS total 
										   FROM (SELECT CASE email
										   WHEN '-' THEN 'Tidak Punya Email'
										   WHEN '' THEN 'Tidak Punya Email'
										   ELSE 'Punya Email' END AS status_email
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   )tbl_total)");
				$query = $this->db->query("SELECT status_email AS description, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (SELECT status_email, COUNT(status_email) AS jumlah
										   FROM (SELECT CASE email
										   WHEN '-' THEN 'Tidak Punya Email'
										   WHEN '' THEN 'Tidak Punya Email'
										   ELSE 'Punya Email' END AS status_email
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_jumlah GROUP BY status_email
										   ) tbl_freq GROUP BY status_email");
			}
			else if($freq_type == '16') /*Kelainan Fisik*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_kondisi_fisik) AS total 
										   FROM (SELECT IF(kondisi_fisik = 'Tidak', 'Tidak Ada Kelainan', 'Ada Kelainan') AS status_kondisi_fisik
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   )tbl_total)");
				$query = $this->db->query("SELECT status_kondisi_fisik AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kondisi_fisik, 
										   COUNT(status_kondisi_fisik) AS jumlah 
										   FROM (
										   SELECT IF(kondisi_fisik = 'Tidak', 'Tidak Ada Kelainan', 'Ada Kelainan') AS status_kondisi_fisik
										   FROM  tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_jumlah GROUP BY status_kondisi_fisik ) tbl_freq GROUP BY status_kondisi_fisik");
			}
			else if($freq_type == '17') /*Jenis Kelainan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_difabel) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_penerima.id_difabel
										   WHERE tbl_penerima.kondisi_fisik = 'Ya'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_difabel.jenis_difabel AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_difabel.id_difabel AS id, 
										   IF(COUNT(tbl_penerima.id_difabel) IS NULL, 0, COUNT(tbl_penerima.id_difabel)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_penerima.id_difabel
										   WHERE tbl_penerima.kondisi_fisik = 'Ya'
										   /**/
										   GROUP BY tbl_difabel.id_difabel 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_freq.id
										   ORDER BY tbl_difabel.no_urut ASC");
			}
			else if($freq_type == '18') /*Tanda Pengenal*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_jenis_kid) AS total 
										   FROM (SELECT IF(jenis_kid = 'Tidak Ada', 'Tidak Punya Tanda Pengenal', 'Punya Tanda Pengenal') AS status_jenis_kid
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_jenis_kid AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_jenis_kid, 
										   COUNT(status_jenis_kid) AS jumlah 
										   FROM (
										   SELECT IF(jenis_kid = 'Tidak Ada', 'Tidak Punya Tanda Pengenal', 'Punya Tanda Pengenal') AS status_jenis_kid
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_jumlah GROUP BY status_jenis_kid 
										   ) tbl_freq GROUP BY status_jenis_kid");
			}
			else if($freq_type == '19') /*KTM*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_jenis_ktm) AS total 
										   FROM (SELECT IF(jenis_ktm = 'Tidak Ada', 'Tidak Punya KTM', 'Punya KTM') AS status_jenis_ktm
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_jenis_ktm AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_jenis_ktm, 
										   COUNT(status_jenis_ktm) AS jumlah 
										   FROM (
										   SELECT IF(jenis_ktm = 'Tidak Ada', 'Tidak Punya KTM', 'Punya KTM') AS status_jenis_ktm
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_jumlah GROUP BY status_jenis_ktm 
										   ) tbl_freq GROUP BY status_jenis_ktm");
			}
			else if($freq_type == '20') /*Pernah ke Pihak Lain*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_penanganan) AS total
										   FROM (SELECT IF(penanganan_pihak_lain = 'Tidak', 'Tidak pernah ke pihak lain', 'Pernah ke pihak lain') AS status_penanganan
										   FROM tbl_approval 
										   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_penanganan AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_penanganan, 
										   COUNT(status_penanganan) AS jumlah
										   FROM (
										   SELECT IF(penanganan_pihak_lain = 'Tidak', 'Tidak pernah ke pihak lain', 'Pernah ke pihak lain') AS status_penanganan
										   FROM tbl_approval
										   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
										   /**/
										   ) tbl_jumlah GROUP BY status_penanganan 
										   ) tbl_freq GROUP BY status_penanganan");
			}
			else if($freq_type == '21') /*Status Permohonan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.status_approval) AS total
										   FROM tbl_approval
										   /**/
										   )");
				$query = $this->db->query("SELECT status_approval AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_approval.status_approval, 
										   COUNT(tbl_approval.status_approval) AS jumlah
										   FROM tbl_approval
										   /**/
										   GROUP BY tbl_approval.status_approval 
										   ) tbl_freq GROUP BY status_approval");
			}
			else if($freq_type == '22') /*Jenis Masalah Hukum*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_approval.id_jenis_kasus) AS total 
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_jenis_kasus.jenis_kasus AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_approval.id_jenis_kasus AS id, 
										   COUNT(tbl_approval.id_jenis_kasus) AS jumlah
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   /**/
										   GROUP BY tbl_approval.id_jenis_kasus
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_freq.id
										   GROUP BY tbl_jenis_kasus.id_jenis_kasus");
			}
			else if($freq_type == '23') /*Jenis Kasus Pidana*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.id_nama_kasus) AS total 
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '1'
										   AND tbl_approval.status_approval = 'Diterima'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_nama_kasus.nama_kasus AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) as freq
										   FROM (
										   SELECT tbl_nama_kasus.id_nama_kasus as id, 
										   IF(COUNT(tbl_approval.id_nama_kasus) IS NULL, 0, 
										   COUNT(tbl_approval.id_nama_kasus)) AS jumlah
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '1'
										   AND tbl_approval.status_approval = 'Diterima'
										   /**/
										   GROUP BY tbl_nama_kasus.id_nama_kasus 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_nama_kasus ON tbl_nama_kasus.id_nama_kasus = tbl_result.id
										   WHERE tbl_nama_kasus.id_jenis_kasus = '1'
										   ORDER BY tbl_nama_kasus.no_urut ASC");
			}
			else if($freq_type == '24') /*Jenis Kasus Perdata*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.id_nama_kasus) AS total 
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '2'
										   AND tbl_approval.status_approval = 'Diterima'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_nama_kasus.nama_kasus AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_nama_kasus.id_nama_kasus as id, 
										   IF(COUNT(tbl_approval.id_nama_kasus) IS NULL, 0, COUNT(tbl_approval.id_nama_kasus)) AS jumlah
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '2'
										   AND tbl_approval.status_approval = 'Diterima'
										   /**/
										   GROUP BY tbl_nama_kasus.id_nama_kasus 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_nama_kasus ON tbl_nama_kasus.id_nama_kasus = tbl_result.id
										   WHERE tbl_nama_kasus.id_jenis_kasus = '2'
										   ORDER BY tbl_nama_kasus.no_urut ASC");
			}
			else if($freq_type == '25') /*Jenis Kasus TUN*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.id_nama_kasus) AS total 
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '3'
										   AND tbl_approval.status_approval = 'Diterima'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_nama_kasus.nama_kasus AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) as freq
										   FROM (
										   SELECT tbl_nama_kasus.id_nama_kasus as id, 
										   IF(COUNT(tbl_approval.id_nama_kasus) IS NULL, 0, COUNT(tbl_approval.id_nama_kasus)) AS jumlah
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '3'
										   AND tbl_approval.status_approval = 'Diterima'
										   /**/
										   GROUP BY tbl_nama_kasus.id_nama_kasus 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_nama_kasus ON tbl_nama_kasus.id_nama_kasus = tbl_result.id
										   WHERE tbl_nama_kasus.id_jenis_kasus = '3'
										   ORDER BY tbl_nama_kasus.no_urut ASC");
			}
			else if($freq_type == '26') /*Posisi Hukum*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_approval.id_posisi_hukum) AS total 
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_posisi_hukum.posisi_hukum AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_approval.id_posisi_hukum AS id, 
										   COUNT(tbl_approval.id_posisi_hukum) AS jumlah
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   /**/
										   GROUP BY tbl_approval.id_posisi_hukum 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_posisi_hukum ON tbl_posisi_hukum.id_posisi_hukum = tbl_freq.id
										   GROUP BY tbl_posisi_hukum.id_posisi_hukum");
			}
			else if($freq_type == '27') /*Sifat Kasus*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.sifat_kasus) AS total
										   FROM tbl_analisis
										   /**/
										   )");
				$query = $this->db->query("SELECT sifat_kasus AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.sifat_kasus, COUNT(tbl_analisis.sifat_kasus) AS jumlah
										   FROM tbl_analisis
										   /**/
										   GROUP BY tbl_analisis.sifat_kasus 
										   ) tbl_freq GROUP BY sifat_kasus");
			}
			else if($freq_type == '28') /*Jenis Layanan*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_approval.id_tindakan) AS total
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_tindakan.jenis_tindakan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_approval.id_tindakan AS id, 
										   COUNT(tbl_approval.id_tindakan) AS jumlah
										   FROM tbl_approval WHERE tbl_approval.status_approval = 'Diterima'
										   /**/
										   GROUP BY tbl_approval.id_tindakan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_freq.id
										   GROUP BY tbl_tindakan.id_tindakan");
			}
			else if($freq_type == '29') /*Status Kasus*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(status_progress) AS total
										   FROM (
										   SELECT tbl_approval.id_permohonan, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
										   FROM (
										   SELECT id_permohonan, 
										   status_progress
										   FROM (
										   SELECT tbl_progress.id_permohonan, 
										   tbl_progress.status_progress
										   FROM tbl_progress 
										   ORDER BY tbl_progress.id_progress DESC 
										   ) tbl_status
										   GROUP BY tbl_status.id_permohonan) tbl_status_progress
										   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
										   WHERE tbl_approval.status_approval = 'Diterima'
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_progress  AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_progress, 
										   COUNT(status_progress) AS jumlah
										   FROM (
										   SELECT tbl_approval.id_permohonan, 
										   IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
										   FROM (
										   SELECT id_permohonan,
										   status_progress
										   FROM (
										   SELECT tbl_progress.id_permohonan, 
										   tbl_progress.status_progress
										   FROM tbl_progress 
										   ORDER BY tbl_progress.id_progress DESC 
										   ) tbl_status
										   GROUP BY tbl_status.id_permohonan) tbl_status_progress
										   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
										   WHERE tbl_approval.status_approval = 'Diterima'
										   ) tbl_jumlah GROUP BY tbl_jumlah.status_progress 
										   ) tbl_freq GROUP BY tbl_freq.status_progress");
			}
			else if($freq_type == '30') /*Hasil untuk Klien*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_hasil) AS total 
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   /**/
										   )");
				$query = $this->db->query("SELECT status_hasil AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_hasil, 
										   COUNT(status_hasil) AS jumlah
										   FROM (
										   SELECT IF(status_hasil = 'Ya', 'Baik', 'Tidak Baik') AS status_hasil
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   /**/
										   ) tbl_status_hasil GROUP BY tbl_status_hasil.status_hasil 
										   ) tbl_freq GROUP BY tbl_freq.status_hasil");
			}
			else if($freq_type == '31') /*Masalah Pidana*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_kembali) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '1'
										   /**/
										   )");
				$query = $this->db->query("SELECT status_kembali AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kembali, 
										   COUNT(status_kembali) AS jumlah
										   FROM (
										   SELECT IF(status_kembali = 'Ya', 'Ada Masalah Eksekusi Pidana', 'Tidak Ada Masalah Eksekusi Pidana') AS status_kembali
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '1'
										   /**/
										   ) tbl_status_kembali GROUP BY tbl_status_kembali.status_kembali 
										   ) tbl_freq GROUP BY tbl_freq.status_kembali");
			}
			else if($freq_type == '32') /*Masalah Perdata*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_kembali) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '2'
										   /**/
										   )");
				$query = $this->db->query("SELECT status_kembali AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kembali, 
										   COUNT(status_kembali) AS jumlah
										   FROM (
										   SELECT IF(status_kembali = 'Ya', 'Ada Masalah Eksekusi Perdata', 'Tidak Ada Masalah Eksekusi Perdata') AS status_kembali
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '2'
										   /**/
										   ) tbl_status_kembali GROUP BY tbl_status_kembali.status_kembali 
										   ) tbl_freq GROUP BY tbl_freq.status_kembali");
			}
			else if($freq_type == '33') /*Masalah TUN*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_kembali) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '3'
										   /**/
										   )");
				$query = $this->db->query("SELECT status_kembali AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kembali, 
										   COUNT(status_kembali) AS jumlah
										   FROM (
										   SELECT IF(status_kembali = 'Ya', 'Ada Masalah Eksekusi TUN', 'Tidak Ada Masalah Eksekusi TUN') AS status_kembali
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '3'
										   /**/
										   ) tbl_status_kembali GROUP BY tbl_status_kembali.status_kembali 
										   ) tbl_freq GROUP BY tbl_freq.status_kembali");
			}
			else if($freq_type == '34') /*Keadaan Klien*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_klien) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_tindakan != '1'
										   /**/
										   )");
				$query = $this->db->query("SELECT status_klien AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_klien, 
										   COUNT(status_klien) AS jumlah
										   FROM (
										   SELECT IF(status_klien = 'Ya', 'Dalam Bahaya', 'Tidak dalam Bahaya') AS status_klien
										   FROM tbl_progress 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_tindakan != '1'
										   /**/
										   ) tbl_status_klien GROUP BY tbl_status_klien.status_klien 
										   ) tbl_freq GROUP BY tbl_freq.status_klien");
			}
			else if($freq_type == '35') /*Bentuk Kasus*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.bentuk_kasus) AS total
										   FROM tbl_analisis
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   )");
				$query = $this->db->query("SELECT bentuk_kasus AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.bentuk_kasus, 
										   COUNT(tbl_analisis.bentuk_kasus) AS jumlah
										   FROM tbl_analisis
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   GROUP BY tbl_analisis.bentuk_kasus 
										   ) tbl_jumlah GROUP BY bentuk_kasus");
			}
			else if($freq_type == '36') /*Issue HAM Pokok*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_issue_ham) AS total 
										   FROM tbl_issue_ham
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_issue_ham.issue_ham  AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT  tbl_analisis.id_issue_ham AS id, 
										   COUNT(tbl_analisis.id_issue_ham) AS jumlah
										   FROM tbl_issue_ham
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   /**/
										   GROUP BY tbl_analisis.id_issue_ham 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_result.id
										   GROUP BY tbl_issue_ham.id_issue_ham
										   ORDER BY tbl_issue_ham.no_urut ASC");
			}
			else if($freq_type == '37') /*Issue HAM Tambahan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis_issue_ham.id_issue_ham) AS total
										   FROM tbl_approval
										   LEFT JOIN tbl_analisis_issue_ham ON tbl_analisis_issue_ham.id_permohonan = tbl_approval.id_approval
										   WHERE tbl_analisis_issue_ham.id_issue_ham != '0'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_issue_ham.issue_ham AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_analisis_issue_ham.id_issue_ham AS id, 
										   COUNT(tbl_analisis_issue_ham.id_issue_ham) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_analisis_issue_ham ON tbl_analisis_issue_ham.id_permohonan = tbl_approval.id_approval
										   WHERE tbl_analisis_issue_ham.id_issue_ham != '0'
										   /**/
										   GROUP BY tbl_analisis_issue_ham.id_issue_ham 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_freq.id
										   GROUP BY tbl_issue_ham.id_issue_ham
										   ORDER BY tbl_issue_ham.no_urut ASC");
			}
			else if($freq_type == '38') /*Penerima Bantuan*/
			{
				$query = $this->db->query("SET @total := (SELECT SUM(total_penerima) AS total 
										   FROM tbl_analisis
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   )");
				$query = $this->db->query("SELECT 'Laki-laki Dewasa' AS description, SUM(lk_dewasa) AS jumlah, ROUND(SUM(lk_dewasa/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   UNION ALL
										   SELECT 'Perempuan Dewasa' AS description, SUM(pr_dewasa) AS jumlah, ROUND(SUM(pr_dewasa/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   UNION ALL
										   SELECT 'Anak Laki-laki' AS description, SUM(lk_anak) AS jumlah, ROUND(SUM(lk_anak/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   UNION ALL
										   SELECT 'Anak Perempuan' AS description, SUM(pr_anak) AS jumlah, ROUND(SUM(pr_anak/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/");
			}
			else if($freq_type == '39') /*Kategori Korban*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_kategori_korban) AS total
										   FROM tbl_kategori_korban
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_korban = tbl_kategori_korban.id_kategori_korban
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_kategori_korban.kategori_korban AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_analisis.id_kategori_korban AS id, 
										   COUNT(tbl_analisis.id_kategori_korban) AS jumlah
										   FROM tbl_kategori_korban 
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_korban = tbl_kategori_korban.id_kategori_korban
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   GROUP BY tbl_analisis.id_kategori_korban 
										   ) tbl_freq
										   GROUP BY tbl_freq.id 
										   ) tbl_result 
										   RIGHT JOIN tbl_kategori_korban ON tbl_kategori_korban.id_kategori_korban = tbl_result.id
										   GROUP BY tbl_kategori_korban.id_kategori_korban
										   ORDER BY tbl_kategori_korban.no_urut ASC");
			}
			else if($freq_type == '40') /*Kategori Pelaku*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_kategori_pelaku) AS total
										   FROM tbl_kategori_pelaku
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   /**/
										   )");
				$query = $this->db->query("SELECT tbl_kategori_pelaku.kategori_pelaku AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.id_kategori_pelaku AS id, 
										   COUNT(tbl_analisis.id_kategori_pelaku) AS jumlah
										   FROM tbl_kategori_pelaku
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   /**/
										   GROUP BY tbl_analisis.id_kategori_pelaku
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_kategori_pelaku ON tbl_kategori_pelaku.id_kategori_pelaku = tbl_result.id
										   GROUP BY tbl_kategori_pelaku.id_kategori_pelaku
										   ORDER BY tbl_kategori_pelaku.no_urut ASC");
			}
			else /*Penghasilan Kelompok*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_penghasilan) AS total
										   FROM tbl_penghasilan
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_penghasilan = tbl_penghasilan.id_penghasilan
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   /*AND tbl_analisis.bentuk_kasus = 'Kelompok'*/
										   )");
				$query = $this->db->query("SELECT tbl_penghasilan.jml_penghasilan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.id_penghasilan AS id, 
										   COUNT(tbl_analisis.id_penghasilan) AS jumlah
										   FROM tbl_penghasilan
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_penghasilan = tbl_penghasilan.id_penghasilan
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   /**/
										   /*AND tbl_analisis.bentuk_kasus = 'Kelompok'*/
										   GROUP BY tbl_analisis.id_penghasilan 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_result.id
										   GROUP BY tbl_penghasilan.id_penghasilan
										   ORDER BY tbl_penghasilan.id_penghasilan ASC");
			}		
		}	
		else
		{
			if($freq_type == '1') /*Kabupaten*/
			{
				$query = $this->db->query("SET @totalx := (SELECT COUNT(tbl_penerima.id_provinsi) AS totalx 
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE tbl_penerima.id_provinsi = '".$this->get_id_provinsi()."' 
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."')"); 
				$query = $this->db->query("SET @totaly := (SELECT COUNT(tbl_penerima.id_provinsi) AS totaly 
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."' 
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."')"); 
				$query = $this->db->query("SET @total := @totalx + @totaly"); 
				$query = $this->db->query("SELECT 'Luar Propinsi' AS description, jumlah, ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT IF(COUNT(tbl_penerima.id_kabkota) IS NULL, 0, COUNT(tbl_penerima.id_kabkota)) AS jumlah
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."' 
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah 
										   UNION ALL
										   SELECT tbl_kabkota.nm_kabkota AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_penerima.id_kabkota AS id, 
										   IF(COUNT(tbl_penerima.id_kabkota) IS NULL, 0, 
										   COUNT(tbl_penerima.id_kabkota)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE tbl_penerima.id_provinsi = '".$this->get_id_provinsi()."' 
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_penerima.id_kabkota 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_kabkota ON tbl_kabkota.id_kabkota = tbl_result.id
										   WHERE tbl_kabkota.id_provinsi = '".$this->get_id_provinsi()."'");
				
			}
			else if($freq_type == '2') /*Jkel*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.jkel) AS total 
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."')");
				$query = $this->db->query("SELECT IF(jkel = 'Lainnya', 'Lainnya', jkel) AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_penerima.jkel,  
										   COUNT(tbl_penerima.jkel) AS jumlah FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_penerima.jkel 
										   ) tbl_jumlah GROUP BY tbl_jumlah.jkel");
			}
			else if($freq_type == '3') /*Umur*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(id_umur) AS total 
										   FROM (SELECT CASE 
										   WHEN umur < 17 THEN '2'
										   WHEN umur < 26 THEN '3'
										   WHEN umur < 36 THEN '4'
										   WHEN umur < 46 THEN '5'
										   WHEN umur < 56 THEN '6'
										   WHEN umur < 66 THEN '7'
										   ELSE '8' END AS id_umur
										   FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_total)"); 
				$query = $this->db->query("SELECT tbl_kategori_usia.jarak_usia AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id_umur, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) as freq 
										   FROM (
										   SELECT id_umur, 
										   COUNT(id_umur) AS jumlah
										   FROM (
										   SELECT CASE 
										   WHEN umur < 17 THEN '2'
										   WHEN umur < 26 THEN '3'
										   WHEN umur < 36 THEN '4'
										   WHEN umur < 46 THEN '5'
										   WHEN umur < 56 THEN '6'
										   WHEN umur < 66 THEN '7'
										   ELSE '8' END AS id_umur
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan 
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY tbl_jumlah.id_umur 
										   ) tbl_freq GROUP BY tbl_freq.id_umur 
										   ) tbl_result
										   RIGHT JOIN tbl_kategori_usia ON tbl_kategori_usia.id_kategori_usia = tbl_result.id_umur
										   ORDER BY tbl_kategori_usia.no_urut");
			}
			else if($freq_type == '4') /*Agama*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_agama) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_penerima.id_agama
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_agama.nm_agama AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_agama.id_agama AS id, 
										   IF(COUNT(tbl_penerima.id_agama) IS NULL, 0, COUNT(tbl_penerima.id_agama)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_agama ON tbl_agama.id_agama = tbl_penerima.id_agama
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_agama.id_agama 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_agama ON tbl_agama.id_agama = tbl_freq.id
										   ORDER BY tbl_agama.no_urut ASC");
			}
			else if($freq_type == '5') /*Pendidikan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_pendidikan) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pendidikan ON tbl_pendidikan.id_pendidikan = tbl_penerima.id_pendidikan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_pendidikan.nm_pendidikan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_pendidikan.id_pendidikan AS id, 
										   IF(COUNT(tbl_penerima.id_pendidikan) IS NULL, 0, COUNT(tbl_penerima.id_pendidikan)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pendidikan ON tbl_pendidikan.id_pendidikan = tbl_penerima.id_pendidikan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_pendidikan.id_pendidikan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_pendidikan ON tbl_pendidikan.id_pendidikan = tbl_freq.id
										   ORDER BY tbl_pendidikan.id_pendidikan ASC");
			}
			else if($freq_type == '6') /*Pekerjaan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_pekerjaan) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pekerjaan ON tbl_pekerjaan.id_pekerjaan = tbl_penerima.id_pekerjaan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_pekerjaan.jenis_pekerjaan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_pekerjaan.id_pekerjaan AS id, 
										   IF(COUNT(tbl_penerima.id_pekerjaan) IS NULL, 0, COUNT(tbl_penerima.id_pekerjaan)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_pekerjaan ON tbl_pekerjaan.id_pekerjaan = tbl_penerima.id_pekerjaan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_pekerjaan.id_pekerjaan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_pekerjaan ON tbl_pekerjaan.id_pekerjaan = tbl_freq.id
										   ORDER BY tbl_pekerjaan.no_urut ASC");
			}
			else if($freq_type == '7') /*Penghasilan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_penghasilan) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_penerima.id_penghasilan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_penghasilan.jml_penghasilan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_penghasilan.id_penghasilan AS id, 
										   IF(COUNT(tbl_penerima.id_penghasilan) IS NULL, 0, COUNT(tbl_penerima.id_penghasilan)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_penerima.id_penghasilan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_penghasilan.id_penghasilan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_freq.id
										   ORDER BY tbl_penghasilan.id_penghasilan ASC");
			}
			else if($freq_type == '8') /*Jarak Tempuh*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.id_jarak_tempuh) AS total FROM tbl_approval 
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_jarak_tempuh ON tbl_jarak_tempuh.id_jarak_tempuh = tbl_pemohon.id_jarak_tempuh
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_jarak_tempuh.jarak_tempuh AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_jarak_tempuh.id_jarak_tempuh AS id, 
										   IF(COUNT(tbl_pemohon.id_jarak_tempuh) IS NULL, 0, COUNT(tbl_pemohon.id_jarak_tempuh)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_jarak_tempuh ON tbl_jarak_tempuh.id_jarak_tempuh = tbl_pemohon.id_jarak_tempuh
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_jarak_tempuh.id_jarak_tempuh 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_jarak_tempuh ON tbl_jarak_tempuh.id_jarak_tempuh = tbl_freq.id
										   ORDER BY tbl_jarak_tempuh.id_jarak_tempuh ASC");
			}
			else if($freq_type == '9') /*Waktu Tempuh*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.id_waktu_tempuh) AS total FROM tbl_approval 
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_waktu_tempuh ON tbl_waktu_tempuh.id_waktu_tempuh = tbl_pemohon.id_waktu_tempuh
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_waktu_tempuh.waktu_tempuh AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_waktu_tempuh.id_waktu_tempuh AS id, 
										   IF(COUNT(tbl_pemohon.id_waktu_tempuh) IS NULL, 0, COUNT(tbl_pemohon.id_waktu_tempuh)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_waktu_tempuh ON tbl_waktu_tempuh.id_waktu_tempuh = tbl_pemohon.id_waktu_tempuh
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_waktu_tempuh.id_waktu_tempuh 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_waktu_tempuh ON tbl_waktu_tempuh.id_waktu_tempuh = tbl_freq.id
										   ORDER BY tbl_waktu_tempuh.id_waktu_tempuh ASC");
			}
			else if($freq_type == '10') /*Tempat Tinggal*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_penerima.status_tempat_tinggal) AS total
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_status_tempat_tinggal.status_tempat_tinggal AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_penerima.status_tempat_tinggal+0 AS id, 
										   COUNT(tbl_penerima.status_tempat_tinggal) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY id 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_result
										   RIGHT JOIN tbl_status_tempat_tinggal ON tbl_status_tempat_tinggal.id_status_tempat_tinggal = tbl_result.id
										   GROUP BY tbl_status_tempat_tinggal.id_status_tempat_tinggal
										   ORDER BY tbl_status_tempat_tinggal.id_status_tempat_tinggal ASC");
			}
			else if($freq_type == '11') /*Pernah Jadi Klien*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.pernah_jadi_client) AS total 
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT pernah_jadi_client AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_pemohon.pernah_jadi_client, 
										   COUNT(tbl_pemohon.pernah_jadi_client) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_pemohon.pernah_jadi_client
										   ) tbl_freq GROUP BY pernah_jadi_client");
			}
			else if($freq_type == '12') /*Tahu LBH*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_pemohon.id_sumber_info) AS total FROM tbl_approval 
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_sumber_info ON tbl_sumber_info.id_sumber_info = tbl_pemohon.id_sumber_info
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   AND tbl_pemohon.pernah_jadi_client = 'Belum'
										   )");
				$query = $this->db->query("SELECT tbl_sumber_info.nm_sumber_info AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_sumber_info.id_sumber_info AS id, 
										   IF(COUNT(tbl_pemohon.id_sumber_info) IS NULL, 0, COUNT(tbl_pemohon.id_sumber_info)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_pemohon ON tbl_pemohon.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_sumber_info ON tbl_sumber_info.id_sumber_info = tbl_pemohon.id_sumber_info
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   AND tbl_pemohon.pernah_jadi_client = 'Belum'
										   GROUP BY tbl_sumber_info.id_sumber_info 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_sumber_info ON tbl_sumber_info.id_sumber_info = tbl_freq.id
										   ORDER BY tbl_sumber_info.no_urut ASC");
			}
			else if($freq_type == '13') /*Punya Telp Rumah*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_no_telp) AS total 
										   FROM (SELECT CASE no_telp
										   WHEN '-' THEN 'Tidak Punya Telepon'
										   WHEN '' THEN 'Tidak Punya Telepon'
										   ELSE 'Punya Telepon' END AS status_no_telp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )tbl_total)");
				$query = $this->db->query("SELECT status_no_telp AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT status_no_telp, 
										   COUNT(status_no_telp) AS jumlah
										   FROM (
										   SELECT CASE no_telp
										   WHEN '-' THEN 'Tidak Punya Telepon'
										   WHEN '' THEN 'Tidak Punya Telepon'
										   ELSE 'Punya Telepon' END AS status_no_telp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY status_no_telp
										   ) tbl_freq GROUP BY status_no_telp");
			}
			else if($freq_type == '14') /*Punya HP*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_no_hp) AS total 
										   FROM (SELECT CASE no_hp
										   WHEN '-' THEN 'Tidak Punya HP'
										   WHEN '' THEN 'Tidak Punya HP'
										   ELSE 'Punya HP' END AS status_no_hp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )tbl_total)");
				$query = $this->db->query("SELECT status_no_hp AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT status_no_hp, 
										   COUNT(status_no_hp) AS jumlah
										   FROM (
										   SELECT CASE no_hp
										   WHEN '-' THEN 'Tidak Punya HP'
										   WHEN '' THEN 'Tidak Punya HP'
										   ELSE 'Punya HP' END AS status_no_hp
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY status_no_hp
										   ) tbl_freq GROUP BY status_no_hp");
			}
			else if($freq_type == '15') /*Punya Email*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_email) AS total 
										   FROM (SELECT CASE email
										   WHEN '-' THEN 'Tidak Punya Email'
										   WHEN '' THEN 'Tidak Punya Email'
										   ELSE 'Punya Email' END AS status_email
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )tbl_total)");
				$query = $this->db->query("SELECT status_email AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT status_email, 
										   COUNT(status_email) AS jumlah
										   FROM (
										   SELECT CASE email
										   WHEN '-' THEN 'Tidak Punya Email'
										   WHEN '' THEN 'Tidak Punya Email'
										   ELSE 'Punya Email' END AS status_email
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY status_email
										   ) tbl_freq GROUP BY status_email");
			}
			else if($freq_type == '16') /*Kelainan Fisik*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_kondisi_fisik) AS total 
										   FROM (SELECT IF(kondisi_fisik = 'Tidak', 'Tidak Ada Kelainan', 'Ada Kelainan') AS status_kondisi_fisik
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )tbl_total)");
				$query = $this->db->query("SELECT status_kondisi_fisik AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kondisi_fisik, 
										   COUNT(status_kondisi_fisik) AS jumlah 
										   FROM (
										   SELECT IF(kondisi_fisik = 'Tidak', 'Tidak Ada Kelainan', 'Ada Kelainan') AS status_kondisi_fisik
										   FROM  tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY status_kondisi_fisik 
										   ) tbl_freq GROUP BY status_kondisi_fisik");
			}
			else if($freq_type == '17') /*Jenis Kelainan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_penerima.id_difabel) AS total FROM tbl_approval 
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_penerima.id_difabel
										   WHERE tbl_penerima.kondisi_fisik = 'Ya'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_difabel.jenis_difabel AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_difabel.id_difabel AS id, 
										   IF(COUNT(tbl_penerima.id_difabel) IS NULL, 0, COUNT(tbl_penerima.id_difabel)) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   LEFT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_penerima.id_difabel
										   WHERE tbl_penerima.kondisi_fisik = 'Ya'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_difabel.id_difabel 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_freq.id
										   ORDER BY tbl_difabel.no_urut ASC");
			}
			else if($freq_type == '18') /*Tanda Pengenal*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_jenis_kid) AS total 
										   FROM (SELECT IF(jenis_kid = 'Tidak Ada', 'Tidak Punya Tanda Pengenal', 'Punya Tanda Pengenal') AS status_jenis_kid
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_jenis_kid AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_jenis_kid, 
										   COUNT(status_jenis_kid) AS jumlah 
										   FROM (
										   SELECT IF(jenis_kid = 'Tidak Ada', 'Tidak Punya Tanda Pengenal', 'Punya Tanda Pengenal') AS status_jenis_kid
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY status_jenis_kid 
										   ) tbl_freq GROUP BY status_jenis_kid");
			}
			else if($freq_type == '19') /*KTM*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_jenis_ktm) AS total 
										   FROM (SELECT IF(jenis_ktm = 'Tidak Ada', 'Tidak Punya KTM', 'Punya KTM') AS status_jenis_ktm
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_jenis_ktm AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_jenis_ktm, 
										   COUNT(status_jenis_ktm) AS jumlah 
										   FROM (
										   SELECT IF(jenis_ktm = 'Tidak Ada', 'Tidak Punya KTM', 'Punya KTM') AS status_jenis_ktm
										   FROM tbl_approval
										   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY status_jenis_ktm 
										   ) tbl_freq GROUP BY status_jenis_ktm");
			}
			else if($freq_type == '20') /*Pernah ke Pihak Lain*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(status_penanganan) AS total
										   FROM (SELECT IF(penanganan_pihak_lain = 'Tidak', 'Tidak pernah ke pihak lain', 'Pernah ke pihak lain') AS status_penanganan
										   FROM tbl_approval 
										   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_penanganan AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_penanganan, 
										   COUNT(status_penanganan) AS jumlah
										   FROM (SELECT IF(penanganan_pihak_lain = 'Tidak', 'Tidak pernah ke pihak lain', 'Pernah ke pihak lain') AS status_penanganan
										   FROM tbl_approval
										   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY status_penanganan 
										   ) tbl_freq GROUP BY status_penanganan");
			}
			else if($freq_type == '21') /*Status Permohonan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.status_approval) AS total
										   FROM tbl_approval
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT status_approval AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_approval.status_approval, 
										   COUNT(tbl_approval.status_approval) AS jumlah
										   FROM tbl_approval
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_approval.status_approval 
										   ) tbl_freq GROUP BY status_approval");
			}
			else if($freq_type == '22') /*Jenis Masalah Hukum*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_approval.id_jenis_kasus) AS total 
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_jenis_kasus.jenis_kasus AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_approval.id_jenis_kasus AS id, 
										   COUNT(tbl_approval.id_jenis_kasus) AS jumlah
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_approval.id_jenis_kasus
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_freq.id
										   GROUP BY tbl_jenis_kasus.id_jenis_kasus");
			}
			else if($freq_type == '23') /*Jenis Kasus Pidana*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.id_nama_kasus) AS total 
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '1'
										   AND tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_nama_kasus.nama_kasus  AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) as freq
										   FROM (
										   SELECT tbl_nama_kasus.id_nama_kasus as id, 
										   IF(COUNT(tbl_approval.id_nama_kasus) IS NULL, 0, COUNT(tbl_approval.id_nama_kasus)) AS jumlah
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '1'
										   AND tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_nama_kasus.id_nama_kasus 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_nama_kasus ON tbl_nama_kasus.id_nama_kasus = tbl_result.id
										   WHERE tbl_nama_kasus.id_jenis_kasus = '1'
										   ORDER BY tbl_nama_kasus.no_urut ASC");
			}
			else if($freq_type == '24') /*Jenis Kasus Perdata*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.id_nama_kasus) AS total 
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '2'
										   AND tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_nama_kasus.nama_kasus  AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) as freq
										   FROM (
										   SELECT tbl_nama_kasus.id_nama_kasus as id, 
										   IF(COUNT(tbl_approval.id_nama_kasus) IS NULL, 0, COUNT(tbl_approval.id_nama_kasus)) AS jumlah
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '2'
										   AND tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_nama_kasus.id_nama_kasus 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_nama_kasus ON tbl_nama_kasus.id_nama_kasus = tbl_result.id
										   WHERE tbl_nama_kasus.id_jenis_kasus = '2'
										   ORDER BY tbl_nama_kasus.no_urut ASC");
			}
			else if($freq_type == '25') /*Jenis Kasus TUN*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_approval.id_nama_kasus) AS total 
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '3'
										   AND tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_nama_kasus.nama_kasus  AS description, 
										   IF(jumlah IS NULL, 0, jumlah) as jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2) , ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) as freq
										   FROM (
										   SELECT tbl_nama_kasus.id_nama_kasus as id, 
										   IF(COUNT(tbl_approval.id_nama_kasus) IS NULL, 0, COUNT(tbl_approval.id_nama_kasus)) AS jumlah
										   FROM tbl_nama_kasus
										   LEFT JOIN tbl_approval ON tbl_approval.id_nama_kasus = tbl_nama_kasus.id_nama_kasus
										   WHERE tbl_approval.id_jenis_kasus = '3'
										   AND tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_nama_kasus.id_nama_kasus 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_nama_kasus ON tbl_nama_kasus.id_nama_kasus = tbl_result.id
										   WHERE tbl_nama_kasus.id_jenis_kasus = '3'
										   ORDER BY tbl_nama_kasus.no_urut ASC");
			}
			else if($freq_type == '26') /*Posisi Hukum*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_approval.id_posisi_hukum) AS total 
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_posisi_hukum.posisi_hukum AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_approval.id_posisi_hukum AS id, 
										   COUNT(tbl_approval.id_posisi_hukum) AS jumlah
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_approval.id_posisi_hukum 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_posisi_hukum ON tbl_posisi_hukum.id_posisi_hukum = tbl_freq.id
										   GROUP BY tbl_posisi_hukum.id_posisi_hukum");
			}
			else if($freq_type == '27') /*Sifat Kasus*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.sifat_kasus) AS total
										   FROM tbl_analisis
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT sifat_kasus AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.sifat_kasus, 
										   COUNT(tbl_analisis.sifat_kasus) AS jumlah
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_analisis.sifat_kasus 
										   ) tbl_freq GROUP BY sifat_kasus");
			}
			else if($freq_type == '28') /*Jenis Layanan*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_approval.id_tindakan) AS total
										   FROM tbl_approval
										   WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_tindakan.jenis_tindakan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_approval.id_tindakan AS id, 
										   COUNT(tbl_approval.id_tindakan) AS jumlah
										   FROM tbl_approval WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_approval.id_tindakan 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_freq.id
										   GROUP BY tbl_tindakan.id_tindakan");
			}
			else if($freq_type == '29') /*Status Kasus*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(status_progress) AS total
										   FROM (
										   SELECT tbl_approval.id_permohonan, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
										   FROM (
										   SELECT id_permohonan, 
										   status_progress
										   FROM (
										   SELECT tbl_progress.id_permohonan, 
										   tbl_progress.status_progress
										   FROM tbl_progress 
										   ORDER BY tbl_progress.id_progress DESC 
										   ) tbl_status
										   GROUP BY tbl_status.id_permohonan) tbl_status_progress
										   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
										   WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_total)");
				$query = $this->db->query("SELECT status_progress  AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_progress, 
										   COUNT(status_progress) AS jumlah
										   FROM (
										   SELECT tbl_approval.id_permohonan, 
										   IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
										   FROM (
										   SELECT id_permohonan,
										   status_progress
										   FROM (
										   SELECT tbl_progress.id_permohonan, 
										   tbl_progress.status_progress
										   FROM tbl_progress 
										   ORDER BY tbl_progress.id_progress DESC 
										   ) tbl_status
										   GROUP BY tbl_status.id_permohonan) tbl_status_progress
										   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
										   WHERE tbl_approval.status_approval = 'Diterima'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_jumlah GROUP BY tbl_jumlah.status_progress 
										   ) tbl_freq GROUP BY tbl_freq.status_progress");
			}
			else if($freq_type == '30') /*Hasil untuk Klien*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_hasil) AS total 
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT status_hasil AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_hasil, 
										   COUNT(status_hasil) AS jumlah
										   FROM (
										   SELECT IF(status_hasil = 'Ya', 'Baik', 'Tidak Baik') AS status_hasil
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_status_hasil GROUP BY tbl_status_hasil.status_hasil 
										   ) tbl_freq GROUP BY tbl_freq.status_hasil");
			}
			else if($freq_type == '31') /*Masalah Pidana*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_kembali) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '1'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT status_kembali AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kembali, 
										   COUNT(status_kembali) AS jumlah
										   FROM (
										   SELECT IF(status_kembali = 'Ya', 'Ada Masalah Eksekusi Pidana', 'Tidak Ada Masalah Eksekusi Pidana') AS status_kembali
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '1'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_status_kembali GROUP BY tbl_status_kembali.status_kembali 
										   ) tbl_freq GROUP BY tbl_freq.status_kembali");
			}
			else if($freq_type == '32') /*Masalah Perdata*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_kembali) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '2'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT status_kembali AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kembali, 
										   COUNT(status_kembali) AS jumlah
										   FROM (
										   SELECT IF(status_kembali = 'Ya', 'Ada Masalah Eksekusi Perdata', 'Tidak Ada Masalah Eksekusi Perdata') AS status_kembali
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '2'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_status_kembali GROUP BY tbl_status_kembali.status_kembali 
										   ) tbl_freq GROUP BY tbl_freq.status_kembali");
			}
			else if($freq_type == '33') /*Masalah TUN*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_kembali) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '3'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT status_kembali AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_kembali, 
										   COUNT(status_kembali) AS jumlah
										   FROM (
										   SELECT IF(status_kembali = 'Ya', 'Ada Masalah Eksekusi TUN', 'Tidak Ada Masalah Eksekusi TUN') AS status_kembali
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_jenis_kasus = '3'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_status_kembali GROUP BY tbl_status_kembali.status_kembali 
										   ) tbl_freq GROUP BY tbl_freq.status_kembali");
			}
			else if($freq_type == '34') /*Keadaan Klien*/
			{
				$query = $this->db->query("SET @total:= (SELECT COUNT(tbl_progress.status_klien) AS total
										   FROM tbl_progress
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_tindakan != '1'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT status_klien AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT status_klien, 
										   COUNT(status_klien) AS jumlah
										   FROM (
										   SELECT IF(status_klien = 'Ya', 'Dalam Bahaya', 'Tidak dalam Bahaya') AS status_klien
										   FROM tbl_progress 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
										   WHERE tbl_progress.status_progress = 'Selesai'
										   AND tbl_approval.id_tindakan != '1'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   ) tbl_status_klien GROUP BY tbl_status_klien.status_klien 
										   ) tbl_freq GROUP BY tbl_freq.status_klien");
			}
			else if($freq_type == '35') /*Bentuk Kasus*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.bentuk_kasus) AS total
										   FROM tbl_analisis
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT bentuk_kasus AS description, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.bentuk_kasus, 
										   COUNT(tbl_analisis.bentuk_kasus) AS jumlah
										   FROM tbl_analisis
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_analisis.bentuk_kasus 
										   ) tbl_jumlah GROUP BY bentuk_kasus");
			}
			else if($freq_type == '36') /*Issue HAM Pokok*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_issue_ham) AS total 
										   FROM tbl_issue_ham
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_issue_ham.issue_ham AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT  tbl_analisis.id_issue_ham AS id, 
										   COUNT(tbl_analisis.id_issue_ham) AS jumlah
										   FROM tbl_issue_ham
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_analisis.id_issue_ham 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_result.id
										   GROUP BY tbl_issue_ham.id_issue_ham
										   ORDER BY tbl_issue_ham.no_urut ASC");
			}
			else if($freq_type == '37') /*Issue HAM Tambahan*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis_issue_ham.id_issue_ham) AS total
										   FROM tbl_approval
										   LEFT JOIN tbl_analisis_issue_ham ON tbl_analisis_issue_ham.id_permohonan = tbl_approval.id_approval
										   WHERE tbl_analisis_issue_ham.id_issue_ham != '0'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_issue_ham.issue_ham AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT tbl_analisis_issue_ham.id_issue_ham AS id, 
										   COUNT(tbl_analisis_issue_ham.id_issue_ham) AS jumlah
										   FROM tbl_approval
										   LEFT JOIN tbl_analisis_issue_ham ON tbl_analisis_issue_ham.id_permohonan = tbl_approval.id_approval
										   WHERE tbl_analisis_issue_ham.id_issue_ham != '0'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_analisis_issue_ham.id_issue_ham 
										   ) tbl_jumlah GROUP BY tbl_jumlah.id 
										   ) tbl_freq
										   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_freq.id
										   GROUP BY tbl_issue_ham.id_issue_ham
										   ORDER BY tbl_issue_ham.no_urut ASC");
			}
			else if($freq_type == '38') /*Penerima Bantuan*/
			{
				$query = $this->db->query("SET @total := (SELECT SUM(total_penerima) AS total 
										   FROM tbl_analisis
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT 'Laki-laki Dewasa' AS description, SUM(lk_dewasa) AS jumlah, ROUND(SUM(lk_dewasa/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   UNION ALL
										   SELECT 'Perempuan Dewasa' AS description, SUM(pr_dewasa) AS jumlah, ROUND(SUM(pr_dewasa/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   UNION ALL
										   SELECT 'Anak Laki-laki' AS description, SUM(lk_anak) AS jumlah, ROUND(SUM(lk_anak/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   UNION ALL
										   SELECT 'Anak Perempuan' AS description, SUM(pr_anak) AS jumlah, ROUND(SUM(pr_anak/@total * 100), 2) AS freq 
										   FROM tbl_analisis 
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'");
			}
			else if($freq_type == '39') /*Kategori Korban*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_kategori_korban) AS total
										   FROM tbl_kategori_korban
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_korban = tbl_kategori_korban.id_kategori_korban
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_kategori_korban.kategori_korban AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq 
										   FROM (
										   SELECT  tbl_analisis.id_kategori_korban AS id, 
										   COUNT(tbl_analisis.id_kategori_korban) AS jumlah
										   FROM tbl_kategori_korban LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_korban = tbl_kategori_korban.id_kategori_korban
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_analisis.id_kategori_korban 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result 
										   RIGHT JOIN tbl_kategori_korban ON tbl_kategori_korban.id_kategori_korban = tbl_result.id
										   GROUP BY tbl_kategori_korban.id_kategori_korban
										   ORDER BY tbl_kategori_korban.no_urut ASC");
			}
			else if($freq_type == '40') /*Kategori Pelaku*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_kategori_pelaku) AS total
										   FROM tbl_kategori_pelaku
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   )");
				$query = $this->db->query("SELECT tbl_kategori_pelaku.kategori_pelaku AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.id_kategori_pelaku AS id, 
										   COUNT(tbl_analisis.id_kategori_pelaku) AS jumlah
										   FROM tbl_kategori_pelaku
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_kategori_pelaku = tbl_kategori_pelaku.id_kategori_pelaku
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE tbl_analisis.sifat_kasus = 'Struktural'
										   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   GROUP BY tbl_analisis.id_kategori_pelaku
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_kategori_pelaku ON tbl_kategori_pelaku.id_kategori_pelaku = tbl_result.id
										   GROUP BY tbl_kategori_pelaku.id_kategori_pelaku
										   ORDER BY tbl_kategori_pelaku.no_urut ASC");
			}
			else /*Penghasilan Kelompok*/
			{
				$query = $this->db->query("SET @total := (SELECT COUNT(tbl_analisis.id_penghasilan) AS total
										   FROM tbl_penghasilan
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_penghasilan = tbl_penghasilan.id_penghasilan
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   /*AND tbl_analisis.bentuk_kasus = 'Kelompok'*/
										   )");
				$query = $this->db->query("SELECT tbl_penghasilan.jml_penghasilan AS description, 
										   IF(jumlah IS NULL, 0, jumlah) AS jumlah, 
										   IF(freq IS NULL, ROUND(0/@total * 100, 2), ROUND(freq, 2)) AS freq
										   FROM (
										   SELECT id, 
										   jumlah, 
										   ROUND(SUM(jumlah/@total * 100), 2) AS freq
										   FROM (
										   SELECT tbl_analisis.id_penghasilan AS id, 
										   COUNT(tbl_analisis.id_penghasilan) AS jumlah
										   FROM tbl_penghasilan
										   LEFT JOIN tbl_analisis ON tbl_analisis.id_penghasilan = tbl_penghasilan.id_penghasilan
										   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
										   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$freq_tahun."'
										   /*AND tbl_analisis.bentuk_kasus = 'Kelompok'*/
										   GROUP BY tbl_analisis.id_penghasilan 
										   ) tbl_freq GROUP BY tbl_freq.id 
										   ) tbl_result
										   RIGHT JOIN tbl_penghasilan ON tbl_penghasilan.id_penghasilan = tbl_result.id
										   GROUP BY tbl_penghasilan.id_penghasilan
										   ORDER BY tbl_penghasilan.id_penghasilan ASC");
			}
		}	
								   
		return $query;
	}
	
	function get_crosstab_result($y, $x, $cross_periode, $cross_tahun)
	{
		$CI =& get_instance();
        $CI->load->database();
        	
		$mysqli = new mysqli($CI->db->hostname, $CI->db->username, $CI->db->password, $CI->db->database);
		
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
		else if($y == '20')
		{
			$rowname = 'kategori_pelaku';
			$rowtitle = 'Kategori Pelaku';
			$rowwhere = "WHERE kategori_pelaku != ''N/A''";
		}
		else
		{
			$rowname = '';
			$rowtitle = '';
			$rowwhere = "";
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
		else if($x == '20')
		{
			$colname = 'kategori_pelaku';
			$colwhere = "WHERE kategori_pelaku != 'N/A'";
			$colwherex = "WHERE kategori_pelaku != ''N/A''";
			$colwherey = "AND kategori_pelaku != ''N/A''";
		}
		else
		{
			$colname = '';
			$colwhere = "";
			$colwherex = "";
			$colwherey = "";
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''".$this->get_id_provinsi()."'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '''', ''N/A'', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''".$this->get_id_provinsi()."'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '''', ''N/A'', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != '".$this->get_id_provinsi()."', 'Luar Propinsi', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '', 'N/A', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''".$this->get_id_provinsi()."'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '''', ''N/A'', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
					   SELECT tbl_provinsi.nm_provinsi AS provinsi, IF(tbl_penerima.id_provinsi != ''".$this->get_id_provinsi()."'', ''Luar Propinsi'', tbl_kabkota.nm_kabkota) as kab_kota, tbl_penerima.umur AS umur,
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
					   IF(tbl_analisis.sifat_kasus IS NULL OR tbl_analisis.sifat_kasus = '''', ''N/A'', tbl_analisis.sifat_kasus) AS sifat_kasus,
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
				/* //Use For PHP 5.4. 
				while ($row = $res->fetch_assoc())
				{
					$result[] = $row;
				}
				*/
				$res->free();
			}
		} 
		while ($mysqli->more_results() && $mysqli->next_result());

		mysqli_close($mysqli);
		
		if(empty($result))
		{
			$result[] = array('coltitle' => $rowtitle, 'rowtitle' => $colname);
			$result[] = array('coltitle' => 'No Query Record Found', 'rowtitle' => '0');
			$result[] = array('coltitle' => 'Total', 'rowtitle' => '0');
		}

		return $result;	
	}

	function get_data_layanan_bantuan_hukum_pertahun($tahun)
	{
		$query = $this->db->query("SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Diterima' THEN 1 ELSE NULL END) AS diterima,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Ditolak' THEN 1 ELSE NULL END) AS ditolak,
								   COUNT(CASE WHEN tbl_approval.status_approval THEN 1 ELSE NULL END) AS total
								   FROM tbl_approval
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)");

		return $query;

	}

	function get_data_layanan_bantuan_hukum_perbulan($periode, $filter)
	{
		if($filter == '1')
		{
			$filter = "";
		}
		else if($filter == '2')
		{
			$filter = "AND tbl_approval.status_approval = 'Diterima'";
		}
		else
		{
			$filter = "AND tbl_approval.status_approval = 'Ditolak'";
		}

		$query = $this->db->query("SELECT tbl_approval.id_permohonan, tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg,
								   tbl_penerima.nm_lengkap AS nm_penerima, tbl_penerima.jkel, 
								   IF(tbl_difabel.jenis_difabel IS NULL, 'N/A', tbl_difabel.jenis_difabel) AS kondisi_fisik,
								   tbl_approval.status_approval,
								   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_kasus,
								   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham
								   FROM tbl_approval
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_penerima.id_difabel
								   LEFT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_approval.id_jenis_kasus
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_analisis.id_issue_ham
								   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y%m') = '".$periode."' ".$filter."
								   ORDER BY tbl_approval.id_permohonan ASC");

		return $query;

	}

	function get_data_layanan_bantuan_hukum_pertahun_file($tahun)
	{
		$query = $this->db->query("SELECT 'Bulan' AS bulan, 'Diterima' AS diterima, 'Ditolak' AS ditolak, 'Total' AS total UNION ALL
								   SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Diterima' THEN 1 ELSE NULL END) AS diterima,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Ditolak' THEN 1 ELSE NULL END) AS ditolak,
								   COUNT(CASE WHEN tbl_approval.status_approval THEN 1 ELSE NULL END) AS total
								   FROM tbl_approval
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)
								   UNION ALL
								   SELECT 'Total' AS bulan, SUM(diterima) AS diterima, SUM(ditolak) AS ditolak, SUM(total) AS total
								   FROM (
								   SELECT MONTH(tbl_approval.insert_date) AS bulan,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Diterima' THEN 1 ELSE NULL END) AS diterima,
								   COUNT(CASE WHEN tbl_approval.status_approval = 'Ditolak' THEN 1 ELSE NULL END) AS ditolak,
								   COUNT(CASE WHEN tbl_approval.status_approval THEN 1 ELSE NULL END) AS total
								   FROM tbl_approval
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)
								   ) tbl_jumlah");

		return $query->result_array();

	}

	function get_data_layanan_bantuan_hukum_perbulan_file($periode, $filter)
	{
		if($filter == '1')
		{
			$filter = "";
		}
		else if($filter == '2')
		{
			$filter = "AND tbl_approval.status_approval = 'Diterima'";
		}
		else
		{
			$filter = "AND tbl_approval.status_approval = 'Ditolak'";
		}

		$query = $this->db->query("SELECT 'No', 'Nomor Permohonan', 'Tanggal', 'Penerima Bantuan', 'Kelamin', 'Kelainan Fisik', 'Status', 'Jenis Masalah Hukum', 'Issue HAM' UNION ALL
								   SELECT @curRow := @curRow + 1 AS row_number, 
								   no_reg, tgl_reg, nm_penerima, jkel, kondisi_fisik, status_approval, jenis_kasus, issue_ham
								   FROM (
								   SELECT tbl_approval.id_permohonan, tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg,
								   tbl_penerima.nm_lengkap AS nm_penerima, tbl_penerima.jkel, 
								   IF(tbl_difabel.jenis_difabel IS NULL, 'N/A', tbl_difabel.jenis_difabel) AS kondisi_fisik,
								   tbl_approval.status_approval,
								   IF(tbl_jenis_kasus.jenis_kasus IS NULL, 'N/A', tbl_jenis_kasus.jenis_kasus) AS jenis_kasus,
								   IF(tbl_issue_ham.issue_ham IS NULL, 'N/A', tbl_issue_ham.issue_ham) AS issue_ham
								   FROM tbl_approval
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_difabel ON tbl_difabel.id_difabel = tbl_penerima.id_difabel
								   LEFT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_approval.id_jenis_kasus
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_analisis.id_issue_ham
								   WHERE DATE_FORMAT(tbl_approval.insert_date, '%Y%m') = '".$periode."' ".$filter."
								   ORDER BY tbl_approval.id_permohonan ASC) tbl_result
								   JOIN (SELECT @curRow := 0) r");

		return $query->result_array();

	}

	function get_data_penerima_by_pku_pertahun($tahun)
	{
		$query = $this->db->query("SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '1' OR tbl_penerima.id_pendidikan = '2' THEN 1 ELSE NULL END) AS ts,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '3' THEN 1 ELSE NULL END) AS sd,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '4' THEN 1 ELSE NULL END) AS smp,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '5' THEN 1 ELSE NULL END) AS sma,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '6' OR tbl_penerima.id_pendidikan = '7' THEN 1 ELSE NULL END) AS diploma,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '8' OR tbl_penerima.id_pendidikan = '9' OR tbl_penerima.id_pendidikan = '10' THEN 1 ELSE NULL END) AS sarjana,
								   IF(SUM(tbl_analisis.lk_dewasa) IS NULL, 0,  SUM(tbl_analisis.lk_dewasa)) AS lk_dewasa,
								   IF(SUM(tbl_analisis.lk_anak) IS NULL, 0,  SUM(tbl_analisis.lk_anak)) AS lk_anak,
								   IF(SUM(tbl_analisis.pr_dewasa) IS NULL, 0,  SUM(tbl_analisis.pr_dewasa)) AS pr_dewasa,
								   IF(SUM(tbl_analisis.pr_anak) IS NULL, 0,  SUM(tbl_analisis.pr_anak)) AS pr_anak
								   FROM tbl_approval
								   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_permohonan = tbl_approval.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)");

		return $query;

	}

	function get_data_penerima_by_pku_pertahun_file($tahun)
	{
		$query = $this->db->query("SELECT 'Bulan', 'Tidak Sekolah', 'SD', 'SMP', 'SMA', 'D1/D2/D3', 'D4/S1/S2/S3', 'Laki-laki Dewasa', 'Perempuan Dewasa', 'Anak Laki-laki', 'Anak Perempuan' UNION ALL
								   SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '1' OR tbl_penerima.id_pendidikan = '2' THEN 1 ELSE NULL END) AS ts,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '3' THEN 1 ELSE NULL END) AS sd,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '4' THEN 1 ELSE NULL END) AS smp,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '5' THEN 1 ELSE NULL END) AS sma,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '6' OR tbl_penerima.id_pendidikan = '7' THEN 1 ELSE NULL END) AS diploma,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '8' OR tbl_penerima.id_pendidikan = '9' OR tbl_penerima.id_pendidikan = '10' THEN 1 ELSE NULL END) AS sarjana,
								   IF(SUM(tbl_analisis.lk_dewasa) IS NULL, 0,  SUM(tbl_analisis.lk_dewasa)) AS lk_dewasa,
								   IF(SUM(tbl_analisis.lk_anak) IS NULL, 0,  SUM(tbl_analisis.lk_anak)) AS lk_anak,
								   IF(SUM(tbl_analisis.pr_dewasa) IS NULL, 0,  SUM(tbl_analisis.pr_dewasa)) AS pr_dewasa,
								   IF(SUM(tbl_analisis.pr_anak) IS NULL, 0,  SUM(tbl_analisis.pr_anak)) AS pr_anak
								   FROM tbl_approval
								   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_permohonan = tbl_approval.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)
								   UNION ALL
								   SELECT 'Total' AS bulan,
								   SUM(ts) AS ts, SUM(sd) AS sd, SUM(smp) AS smp, SUM(sma) AS sma, SUM(diploma) AS diploma, SUM(sarjana) AS sarjana,
								   SUM(lk_dewasa) AS lk_dewasa, SUM(pr_dewasa) AS pr_dewasa, SUM(lk_anak) AS lk_anak, SUM(pr_anak) AS pr_anak
								   FROM (
								   SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '1' OR tbl_penerima.id_pendidikan = '2' THEN 1 ELSE NULL END) AS ts,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '3' THEN 1 ELSE NULL END) AS sd,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '4' THEN 1 ELSE NULL END) AS smp,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '5' THEN 1 ELSE NULL END) AS sma,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '6' OR tbl_penerima.id_pendidikan = '7' THEN 1 ELSE NULL END) AS diploma,
								   COUNT(CASE WHEN tbl_penerima.id_pendidikan = '8' OR tbl_penerima.id_pendidikan = '9' OR tbl_penerima.id_pendidikan = '10' THEN 1 ELSE NULL END) AS sarjana,
								   IF(SUM(tbl_analisis.lk_dewasa) IS NULL, 0,  SUM(tbl_analisis.lk_dewasa)) AS lk_dewasa,
								   IF(SUM(tbl_analisis.lk_anak) IS NULL, 0,  SUM(tbl_analisis.lk_anak)) AS lk_anak,
								   IF(SUM(tbl_analisis.pr_dewasa) IS NULL, 0,  SUM(tbl_analisis.pr_dewasa)) AS pr_dewasa,
								   IF(SUM(tbl_analisis.pr_anak) IS NULL, 0,  SUM(tbl_analisis.pr_anak)) AS pr_anak
								   FROM tbl_approval
								   LEFT JOIN tbl_penerima ON tbl_penerima.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_permohonan = tbl_approval.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)
								   )tbl_result");

		return $query->result_array();
	}

	function get_data_bentuk_layanan_jenis_kasus_pertahun($tahun)
	{
		$query = $this->db->query("SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 1 THEN 1 ELSE NULL END) as konsultasi,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 2 THEN 1 ELSE NULL END) as non_litigasi,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 3 THEN 1 ELSE NULL END) as litigasi,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 1 THEN 1 ELSE NULL END) as pelapor,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 2 THEN 1 ELSE NULL END) as saksi_korban,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 3 THEN 1 ELSE NULL END) as terlapor,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 4 THEN 1 ELSE NULL END) as tersangka,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 5 THEN 1 ELSE NULL END) as terdakwa,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 6 THEN 1 ELSE NULL END) as terpidana,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 THEN 1 ELSE NULL END) as pidana,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 AND tbl_approval.id_posisi_hukum = 7 THEN 1 ELSE NULL END) as penggugat,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 AND tbl_approval.id_posisi_hukum = 8 THEN 1 ELSE NULL END) as tergugat,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 THEN 1 ELSE NULL END) as perdata,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 AND tbl_approval.id_posisi_hukum = 7 THEN 1 ELSE NULL END) as penggugat_tun,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 AND tbl_approval.id_posisi_hukum = 8 THEN 1 ELSE NULL END) as tergugat_tun,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 THEN 1 ELSE NULL END) as tun
								   FROM tbl_approval
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)");

		return $query;
	}

	function get_data_bentuk_layanan_jenis_kasus_pertahun_file($tahun)
	{
		$query = $this->db->query("SELECT 'Bulan', 'Konsultasi', 'Non-Litigasi', 'Litigasi',
								   'Pelapor', 'Saksi Korban', 'Terlapor', 'Tersangka', 'Terdakwa', 'Terpidana', 'Pidana',
								   'Penggugat', 'Tergugat', 'Pedata', 'Penggugat TUN', 'Tergugat TUN', 'Tata Usaha Negara' UNION ALL
								   SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 1 THEN 1 ELSE NULL END) as konsultasi,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 2 THEN 1 ELSE NULL END) as non_litigasi,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 3 THEN 1 ELSE NULL END) as litigasi,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 1 THEN 1 ELSE NULL END) as pelapor,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 2 THEN 1 ELSE NULL END) as saksi_korban,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 3 THEN 1 ELSE NULL END) as terlapor,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 4 THEN 1 ELSE NULL END) as tersangka,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 5 THEN 1 ELSE NULL END) as terdakwa,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 6 THEN 1 ELSE NULL END) as terpidana,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 THEN 1 ELSE NULL END) as pidana,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 AND tbl_approval.id_posisi_hukum = 7 THEN 1 ELSE NULL END) as penggugat,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 AND tbl_approval.id_posisi_hukum = 8 THEN 1 ELSE NULL END) as tergugat,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 THEN 1 ELSE NULL END) as perdata,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 AND tbl_approval.id_posisi_hukum = 7 THEN 1 ELSE NULL END) as penggugat_tun,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 AND tbl_approval.id_posisi_hukum = 8 THEN 1 ELSE NULL END) as tergugat_tun,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 THEN 1 ELSE NULL END) as tun
								   FROM tbl_approval
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date) 
								   UNION ALL
								   SELECT 'Total' AS bulan, SUM(konsultasi) AS konsultasi, SUM(non_litigasi) AS non_litigasi, SUM(litigasi) AS litigasi,
								   SUM(pelapor) AS pelapor, SUM(saksi_korban) AS saksi_korban, SUM(terlapor) AS terlapor, SUM(tersangka) AS tersangka,
								   SUM(terdakwa) AS terdakwa, SUM(terpidana) AS terpidana, SUM(pidana) AS pidana,
								   SUM(penggugat) AS penggugat, SUM(tergugat) AS tergugat, SUM(perdata) AS perdata,
								   SUM(penggugat_tun) AS penggugat_tun, SUM(tergugat_tun) AS tergugat_tun, SUM(tun) AS tun
								   FROM (
								   SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 1 THEN 1 ELSE NULL END) as konsultasi,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 2 THEN 1 ELSE NULL END) as non_litigasi,
								   COUNT(CASE WHEN tbl_approval.id_tindakan = 3 THEN 1 ELSE NULL END) as litigasi,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 1 THEN 1 ELSE NULL END) as pelapor,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 2 THEN 1 ELSE NULL END) as saksi_korban,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 3 THEN 1 ELSE NULL END) as terlapor,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 4 THEN 1 ELSE NULL END) as tersangka,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 5 THEN 1 ELSE NULL END) as terdakwa,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 AND tbl_approval.id_posisi_hukum = 6 THEN 1 ELSE NULL END) as terpidana,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 1 THEN 1 ELSE NULL END) as pidana,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 AND tbl_approval.id_posisi_hukum = 7 THEN 1 ELSE NULL END) as penggugat,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 AND tbl_approval.id_posisi_hukum = 8 THEN 1 ELSE NULL END) as tergugat,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 2 THEN 1 ELSE NULL END) as perdata,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 AND tbl_approval.id_posisi_hukum = 7 THEN 1 ELSE NULL END) as penggugat_tun,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 AND tbl_approval.id_posisi_hukum = 8 THEN 1 ELSE NULL END) as tergugat_tun,
								   COUNT(CASE WHEN tbl_approval.id_jenis_kasus = 3 THEN 1 ELSE NULL END) as tun
								   FROM tbl_approval
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)
								   ) tbl_result");

		return $query->result_array();

	}

	function get_data_sifat_bentuk_kasus_pertahun($tahun)
	{
		$query = $this->db->query("SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Non-Struktural' THEN 1 ELSE NULL END) as non_struktural,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Struktural' THEN 1 ELSE NULL END) as struktural,
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Individu' THEN 1 ELSE NULL END) as individu,
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Kelompok' THEN 1 ELSE NULL END) as kelompok
								   FROM tbl_analisis
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)");

		return $query;
	}

	function get_data_sifat_bentuk_kasus_pertahun_file($tahun)
	{
		$query = $this->db->query("SELECT 'Bulan', 'Non-Struktural', 'Struktural', 'Individu', 'Kelompok' UNION ALL
								   SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Non-Struktural' THEN 1 ELSE NULL END) as non_struktural,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Struktural' THEN 1 ELSE NULL END) as struktural,
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Individu' THEN 1 ELSE NULL END) as individu,
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Kelompok' THEN 1 ELSE NULL END) as kelompok
								   FROM tbl_analisis
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date)
								   UNION ALL
								   SELECT 'Total' AS bulan, SUM(non_struktural) AS non_struktural, SUM(struktural) AS struktural, SUM(individu) AS individu, SUM(kelompok) AS kelompok
								   FROM (
								   SELECT CASE
								   WHEN MONTH(tbl_approval.insert_date) = 1 THEN 'Januari'
								   WHEN MONTH(tbl_approval.insert_date) = 2 THEN 'Februari'
								   WHEN MONTH(tbl_approval.insert_date) = 3 THEN 'Maret'
								   WHEN MONTH(tbl_approval.insert_date) = 4 THEN 'April'
								   WHEN MONTH(tbl_approval.insert_date) = 5 THEN 'Mei'
								   WHEN MONTH(tbl_approval.insert_date) = 6 THEN 'Juni'
								   WHEN MONTH(tbl_approval.insert_date) = 7 THEN 'Juli'
								   WHEN MONTH(tbl_approval.insert_date) = 8 THEN 'Agustus'
								   WHEN MONTH(tbl_approval.insert_date) = 9 THEN 'September'
								   WHEN MONTH(tbl_approval.insert_date) = 10 THEN 'Oktober'
								   WHEN MONTH(tbl_approval.insert_date) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Non-Struktural' THEN 1 ELSE NULL END) as non_struktural,
								   COUNT(CASE WHEN tbl_analisis.sifat_kasus = 'Struktural' THEN 1 ELSE NULL END) as struktural,
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Individu' THEN 1 ELSE NULL END) as individu,
								   COUNT(CASE WHEN tbl_analisis.bentuk_kasus = 'Kelompok' THEN 1 ELSE NULL END) as kelompok
								   FROM tbl_analisis
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tbl_approval.insert_date))
								   tbl_result");

		return $query->result_array();

	}

	function get_data_issue_ham_pertahun($tahun)
	{
		$query = $this->db->query("SELECT tbl_issue_ham.issue_ham,
								   SUM(CASE WHEN bulan = 1 THEN jumlah ELSE 0 END) AS januari,
								   SUM(CASE WHEN bulan = 2 THEN jumlah ELSE 0 END) AS februari,
								   SUM(CASE WHEN bulan = 3 THEN jumlah ELSE 0 END) AS maret,
								   SUM(CASE WHEN bulan = 4 THEN jumlah ELSE 0 END) AS april,
								   SUM(CASE WHEN bulan = 5 THEN jumlah ELSE 0 END) AS mei,
								   SUM(CASE WHEN bulan = 6 THEN jumlah ELSE 0 END) AS juni,
								   SUM(CASE WHEN bulan = 7 THEN jumlah ELSE 0 END) AS juli,
								   SUM(CASE WHEN bulan = 8 THEN jumlah ELSE 0 END) AS agustus,
								   SUM(CASE WHEN bulan = 9 THEN jumlah ELSE 0 END) AS september,
								   SUM(CASE WHEN bulan = 10 THEN jumlah ELSE 0 END) AS oktober,
								   SUM(CASE WHEN bulan = 11 THEN jumlah ELSE 0 END) AS november,
								   SUM(CASE WHEN bulan = 12 THEN jumlah ELSE 0 END) AS desember,
								   SUM(coalesce(jumlah,0)) AS total
								   FROM (
								   SELECT MONTH(tbl_approval.insert_date) AS bulan,
								   tbl_issue_ham.id_issue_ham AS id,
								   COUNT(tbl_analisis.id_issue_ham) AS jumlah
								   FROM tbl_issue_ham
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY tbl_issue_ham.id_issue_ham, MONTH(tbl_approval.insert_date)
								   ) tbl_result
								   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_result.id
								   GROUP BY tbl_issue_ham.id_issue_ham
								   ORDER BY tbl_issue_ham.id_issue_ham ASC");

		return $query;
	}

	function get_data_issue_ham_pertahun_file($tahun)
	{
		$query = $this->db->query("SELECT 'Issue HAM', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Total' UNION ALL
								   SELECT tbl_issue_ham.issue_ham,
								   SUM(CASE WHEN bulan = 1 THEN jumlah ELSE 0 END) AS januari,
								   SUM(CASE WHEN bulan = 2 THEN jumlah ELSE 0 END) AS februari,
								   SUM(CASE WHEN bulan = 3 THEN jumlah ELSE 0 END) AS maret,
								   SUM(CASE WHEN bulan = 4 THEN jumlah ELSE 0 END) AS april,
								   SUM(CASE WHEN bulan = 5 THEN jumlah ELSE 0 END) AS mei,
								   SUM(CASE WHEN bulan = 6 THEN jumlah ELSE 0 END) AS juni,
								   SUM(CASE WHEN bulan = 7 THEN jumlah ELSE 0 END) AS juli,
								   SUM(CASE WHEN bulan = 8 THEN jumlah ELSE 0 END) AS agustus,
								   SUM(CASE WHEN bulan = 9 THEN jumlah ELSE 0 END) AS september,
								   SUM(CASE WHEN bulan = 10 THEN jumlah ELSE 0 END) AS oktober,
								   SUM(CASE WHEN bulan = 11 THEN jumlah ELSE 0 END) AS november,
								   SUM(CASE WHEN bulan = 12 THEN jumlah ELSE 0 END) AS desember,
								   SUM(coalesce(jumlah,0)) AS total
								   FROM (
								   SELECT MONTH(tbl_approval.insert_date) AS bulan,
								   tbl_issue_ham.id_issue_ham AS id,
								   COUNT(tbl_analisis.id_issue_ham) AS jumlah
								   FROM tbl_issue_ham
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY tbl_issue_ham.id_issue_ham, MONTH(tbl_approval.insert_date)
								   ) tbl_result
								   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_result.id
								   GROUP BY tbl_issue_ham.id_issue_ham
								   UNION ALL
								   SELECT 'Total' AS issue_ham,
								   SUM(januari) AS januari, SUM(februari) AS februari, SUM(maret) AS maret, SUM(april) AS april, SUM(mei) AS mei, SUM(juni) AS juni,
								   SUM(juli) AS juli, SUM(agustus) AS agustus, SUM(september) AS september, SUM(oktober) AS oktober, SUM(november) AS november, SUM(desember) AS desember,
								   SUM(total) AS total
								   FROM (
								   SELECT tbl_issue_ham.issue_ham,
								   SUM(CASE WHEN bulan = 1 THEN jumlah ELSE 0 END) AS januari,
								   SUM(CASE WHEN bulan = 2 THEN jumlah ELSE 0 END) AS februari,
								   SUM(CASE WHEN bulan = 3 THEN jumlah ELSE 0 END) AS maret,
								   SUM(CASE WHEN bulan = 4 THEN jumlah ELSE 0 END) AS april,
								   SUM(CASE WHEN bulan = 5 THEN jumlah ELSE 0 END) AS mei,
								   SUM(CASE WHEN bulan = 6 THEN jumlah ELSE 0 END) AS juni,
								   SUM(CASE WHEN bulan = 7 THEN jumlah ELSE 0 END) AS juli,
								   SUM(CASE WHEN bulan = 8 THEN jumlah ELSE 0 END) AS agustus,
								   SUM(CASE WHEN bulan = 9 THEN jumlah ELSE 0 END) AS september,
								   SUM(CASE WHEN bulan = 10 THEN jumlah ELSE 0 END) AS oktober,
								   SUM(CASE WHEN bulan = 11 THEN jumlah ELSE 0 END) AS november,
								   SUM(CASE WHEN bulan = 12 THEN jumlah ELSE 0 END) AS desember,
								   SUM(coalesce(jumlah,0)) AS total
								   FROM (
								   SELECT MONTH(tbl_approval.insert_date) AS bulan,
								   tbl_issue_ham.id_issue_ham AS id,
								   COUNT(tbl_analisis.id_issue_ham) AS jumlah
								   FROM tbl_issue_ham
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_issue_ham = tbl_issue_ham.id_issue_ham
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   WHERE DATE_FORMAT(tbl_approval.insert_date,'%Y') = '".$tahun."'
								   GROUP BY tbl_issue_ham.id_issue_ham, MONTH(tbl_approval.insert_date)
								   ) tbl_result
								   RIGHT JOIN tbl_issue_ham ON tbl_issue_ham.id_issue_ham = tbl_result.id
								   GROUP BY tbl_issue_ham.id_issue_ham
								   ) tbl_hasil");

		return $query->result_array();

	}

	function get_data_perkembangan_kasus_pertahun($tahun)
	{
		$query = $this->db->query("SELECT CASE
								   WHEN MONTH(tgl_approval) = 1 THEN 'Januari'
								   WHEN MONTH(tgl_approval) = 2 THEN 'Februari'
								   WHEN MONTH(tgl_approval) = 3 THEN 'Maret'
								   WHEN MONTH(tgl_approval) = 4 THEN 'April'
								   WHEN MONTH(tgl_approval) = 5 THEN 'Mei'
								   WHEN MONTH(tgl_approval) = 6 THEN 'Juni'
								   WHEN MONTH(tgl_approval) = 7 THEN 'Juli'
								   WHEN MONTH(tgl_approval) = 8 THEN 'Agustus'
								   WHEN MONTH(tgl_approval) = 9 THEN 'September'
								   WHEN MONTH(tgl_approval) = 10 THEN 'Oktober'
								   WHEN MONTH(tgl_approval) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN status_progress = 'Selesai' THEN 1 ELSE NULL END) AS selesai,
								   COUNT(CASE WHEN status_progress = 'Belum Selesai' THEN 1 ELSE NULL END) AS belum,
								   COUNT(CASE WHEN status_progress = 'Gugur' THEN 1 ELSE NULL END) AS gugur,	
								   COUNT(CASE WHEN status_progress = 'N/A' THEN 1 ELSE NULL END) AS na,
								   COUNT(CASE WHEN status_progress != '' THEN 1 ELSE NULL END) AS total
								   FROM (
								   SELECT tbl_approval.insert_date AS tgl_approval, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
								   FROM ( 
								   SELECT id_permohonan, status_progress
								   FROM ( 
								   SELECT tbl_progress.id_permohonan, tbl_progress.status_progress
								   FROM tbl_progress 
								   ORDER BY tbl_progress.id_progress DESC 
								   ) tbl_status GROUP BY tbl_status.id_permohonan 
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   ) tbl_result
								   WHERE DATE_FORMAT(tgl_approval,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tgl_approval)");

		return $query;
	}

	function get_data_perkembangan_kasus_pertahun_file($tahun)
	{
		$query = $this->db->query("SELECT 'Bulan', 'Selesai', 'Belum Selesai', 'Gugur', 'N/A', 'Total' UNION ALL
								   SELECT CASE
								   WHEN MONTH(tgl_approval) = 1 THEN 'Januari'
								   WHEN MONTH(tgl_approval) = 2 THEN 'Februari'
								   WHEN MONTH(tgl_approval) = 3 THEN 'Maret'
								   WHEN MONTH(tgl_approval) = 4 THEN 'April'
								   WHEN MONTH(tgl_approval) = 5 THEN 'Mei'
								   WHEN MONTH(tgl_approval) = 6 THEN 'Juni'
								   WHEN MONTH(tgl_approval) = 7 THEN 'Juli'
								   WHEN MONTH(tgl_approval) = 8 THEN 'Agustus'
								   WHEN MONTH(tgl_approval) = 9 THEN 'September'
								   WHEN MONTH(tgl_approval) = 10 THEN 'Oktober'
								   WHEN MONTH(tgl_approval) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN status_progress = 'Selesai' THEN 1 ELSE NULL END) AS selesai,
								   COUNT(CASE WHEN status_progress = 'Belum Selesai' THEN 1 ELSE NULL END) AS belum,
								   COUNT(CASE WHEN status_progress = 'Gugur' THEN 1 ELSE NULL END) AS gugur,	
								   COUNT(CASE WHEN status_progress = 'N/A' THEN 1 ELSE NULL END) AS na,
								   COUNT(CASE WHEN status_progress != '' THEN 1 ELSE NULL END) AS total
								   FROM (
								   SELECT tbl_approval.insert_date AS tgl_approval, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
								   FROM (
								   SELECT id_permohonan, status_progress
								   FROM (
								   SELECT tbl_progress.id_permohonan, tbl_progress.status_progress
								   FROM tbl_progress 
								   ORDER BY tbl_progress.id_progress DESC
								   ) tbl_status GROUP BY tbl_status.id_permohonan
								   ) tbl_status_progress 
								   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   ) tbl_result
								   WHERE DATE_FORMAT(tgl_approval,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tgl_approval)
								   UNION ALL
								   SELECT 'Total' AS bulan, SUM(selesai) AS selesai, SUM(belum) AS belum, SUM(gugur) AS gugur, SUM(na) AS na, SUM(total) AS total
								   FROM (
								   SELECT CASE
								   WHEN MONTH(tgl_approval) = 1 THEN 'Januari'
								   WHEN MONTH(tgl_approval) = 2 THEN 'Februari'
								   WHEN MONTH(tgl_approval) = 3 THEN 'Maret'
								   WHEN MONTH(tgl_approval) = 4 THEN 'April'
								   WHEN MONTH(tgl_approval) = 5 THEN 'Mei'
								   WHEN MONTH(tgl_approval) = 6 THEN 'Juni'
								   WHEN MONTH(tgl_approval) = 7 THEN 'Juli'
								   WHEN MONTH(tgl_approval) = 8 THEN 'Agustus'
								   WHEN MONTH(tgl_approval) = 9 THEN 'September'
								   WHEN MONTH(tgl_approval) = 10 THEN 'Oktober'
								   WHEN MONTH(tgl_approval) = 11 THEN 'November'
								   ELSE 'Desember' END AS bulan,
								   COUNT(CASE WHEN status_progress = 'Selesai' THEN 1 ELSE NULL END) AS selesai,
								   COUNT(CASE WHEN status_progress = 'Belum Selesai' THEN 1 ELSE NULL END) AS belum,
								   COUNT(CASE WHEN status_progress = 'Gugur' THEN 1 ELSE NULL END) AS gugur,	
								   COUNT(CASE WHEN status_progress = 'N/A' THEN 1 ELSE NULL END) AS na,
								   COUNT(CASE WHEN status_progress != '' THEN 1 ELSE NULL END) AS total
								   FROM (
								   SELECT tbl_approval.insert_date AS tgl_approval, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
								   FROM (
								   SELECT id_permohonan, status_progress
								   FROM (
								   SELECT tbl_progress.id_permohonan, tbl_progress.status_progress
								   FROM tbl_progress
								   ORDER BY tbl_progress.id_progress DESC
								   ) tbl_status GROUP BY tbl_status.id_permohonan
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_status_progress.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   ) tbl_result
								   WHERE DATE_FORMAT(tgl_approval,'%Y') = '".$tahun."'
								   GROUP BY MONTH(tgl_approval)
								   ) tbl_hasil");

		return $query->result_array();
	}

	function get_data_perkembangan_kasus_perbulan($periode)
	{
		$query = $this->db->query("SELECT tbl_permohonan.no_reg,
								   DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m%Y') AS tgl_reg,
								   tbl_penerima.nm_lengkap AS nm_penerima,
								   tbl_tindakan.jenis_tindakan AS bentuk_layanan,
								   tbl_user.fullname AS nm_pembela,
								   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_progress,
								   IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress,
								   IF(tahap_progress IS NULL, 'N/A', tahap_progress) AS tahap_progress,
								   IF(hasil_keputusan IS NULL, 'N/A', hasil_keputusan) AS hasil_keputusan
								   FROM ( 
								   SELECT id_permohonan,
								   tgl_progress,
								   status_progress,
								   tahap_progress,
								   hasil_keputusan
								   FROM (
								   SELECT tbl_progress.id_permohonan,
								   DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress,
								   tbl_progress.status_progress,
								   tbl_tahap_progress.tahap_progress,
								   tbl_hasil_keputusan.hasil_keputusan
								   FROM tbl_progress
								   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
								   LEFT JOIN tbl_tahap_progress ON tbl_tahap_progress.id_tahap_progress = tbl_progress.id_tahap_progress
								   ORDER BY tbl_progress.id_progress DESC
								   ) tbl_status
								   GROUP BY tbl_status.id_permohonan
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   LEFT JOIN tbl_user ON tbl_user.id_user = tbl_approval.id_analis
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y%m') = '".$periode."'
								   ORDER BY tbl_approval.id_permohonan ASC");

		return $query;
	}

	function get_data_perkembangan_kasus_perbulan_file($periode)
	{
		$query = $this->db->query("SELECT 'No', 'Nomor Permohonan', 'Tanggal', 'Penerima Bantuan', 'Bentuk Layanan', 'Pembela Umum', 'Tanggal Progress', 'Status','Tahap Progress Akhir', 'Hasil Keputusan' UNION ALL
								   SELECT @curRow := @curRow + 1 AS row_number, no_reg, tgl_reg, nm_penerima, bentuk_layanan, nm_pembela, tgl_progress, status_progress, tahap_progress, hasil_keputusan
								   FROM (
								   SELECT tbl_permohonan.no_reg, 
								   DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m%Y') AS tgl_reg, 
								   tbl_penerima.nm_lengkap AS nm_penerima,
								   tbl_tindakan.jenis_tindakan AS bentuk_layanan,
								   tbl_user.fullname AS nm_pembela,
								   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_progress,
								   IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress,
								   IF(tahap_progress IS NULL, 'N/A', tahap_progress) AS tahap_progress,
								   IF(hasil_keputusan IS NULL, 'N/A', hasil_keputusan) AS hasil_keputusan
								   FROM (
								   SELECT id_permohonan, tgl_progress, status_progress, tahap_progress, hasil_keputusan
								   FROM (
								   SELECT tbl_progress.id_permohonan, 
								   DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, 
								   tbl_progress.status_progress,
								   tbl_tahap_progress.tahap_progress,
								   tbl_hasil_keputusan.hasil_keputusan
								   FROM tbl_progress
								   LEFT JOIN tbl_hasil_keputusan ON tbl_progress.id_hasil_keputusan = tbl_hasil_keputusan.id_hasil_keputusan
								   LEFT JOIN tbl_tahap_progress ON tbl_tahap_progress.id_tahap_progress = tbl_progress.id_tahap_progress
								   ORDER BY tbl_progress.id_progress DESC
								   ) tbl_status GROUP BY tbl_status.id_permohonan
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   LEFT JOIN tbl_user ON tbl_user.id_user = tbl_approval.id_analis
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y%m') = '".$periode."'
								   ORDER BY tbl_approval.id_permohonan ASC
								   ) tbl_result
								   JOIN (SELECT @curRow := 0) r");

		return $query->result_array();
	}


	function get_data_perkembangan_kasus_pernoreg($no_reg)
	{
		$query = $this->db->query("SELECT tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d') AS tgl_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%m') AS bln_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%Y') AS thn_reg,
								   tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_pemohon.jkel AS jkel, tbl_pemohon.tmp_lahir AS tmp_lahir,
								   DATE_FORMAT(tbl_pemohon.tgl_lahir, '%d') AS tgl_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%m') AS bln_lahir, DATE_FORMAT(tbl_pemohon.tgl_lahir, '%Y') AS thn_lahir,
								   tbl_pemohon.umur AS umur, tbl_pemohon.alm_jalan AS alm_jalan, tbl_pemohon.alm_rt AS alm_rt, tbl_pemohon.alm_rw AS alm_rw,
								   tbl_provinsi.nm_provinsi AS provinsi, tbl_kabkota.nm_kabkota AS kabkota, tbl_kecamatan.nm_kecamatan AS kecamatan, tbl_desa.nm_desa AS desa,
								   IF(tbl_penerima.id_pekerjaan = '45', tbl_penerima.pekerjaan_desc, tbl_pekerjaan.jenis_pekerjaan) AS pekerjaan, tbl_pemohon.no_hp AS no_hp,
								   tbl_pemohon.status_pemohon,
								   tbl_penerima.nm_lengkap AS nm_penerima, tbl_penerima.jkel AS jkelb, tbl_penerima.tmp_lahir AS tmp_lahirb,
								   DATE_FORMAT(tbl_penerima.tgl_lahir, '%d') AS tgl_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%m') AS bln_lahirb, DATE_FORMAT(tbl_penerima.tgl_lahir, '%Y') AS thn_lahirb,
								   tbl_penerima.umur AS umurb, tbl_penerima.alm_jalan AS alm_jalanb, tbl_penerima.alm_rt AS alm_rtb, tbl_penerima.alm_rw AS alm_rwb,
								   tbl_provinsib.nm_provinsi AS provinsib, tbl_kabkotab.nm_kabkota AS kabkotab, tbl_kecamatanb.nm_kecamatan AS kecamatanb, tbl_desab.nm_desa AS desab,
								   IF(tbl_penerima.id_pekerjaan = '45', tbl_penerima.pekerjaan_desc, tbl_pekerjaanb.jenis_pekerjaan) AS pekerjaanb,
								   tbl_penerima.no_hp AS no_hpb,
								   tbl_jenis_kasus.jenis_kasus, tbl_nama_kasus.nama_kasus, tbl_posisi_hukum.posisi_hukum, tbl_tindakan.jenis_tindakan AS bentuk_layanan,
								   tbl_pembela.fullname AS nm_pembela, tbl_asisten.fullname AS nm_asisten,
								   tbl_analisis.sifat_kasus, tbl_analisis.bentuk_kasus,
								   tbl_analisis.total_penerima, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
								   FROM ( 
								   SELECT id_permohonan, status_progress
								   FROM ( 
								   SELECT tbl_progress.id_permohonan, tbl_progress.status_progress
								   FROM tbl_progress ORDER BY tbl_progress.id_progress DESC
								   ) tbl_status GROUP BY tbl_status.id_permohonan
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
								   LEFT JOIN tbl_provinsi ON tbl_provinsi.id_provinsi = tbl_pemohon.id_provinsi
								   LEFT JOIN tbl_kabkota ON tbl_kabkota.id_kabkota = tbl_pemohon.id_kabkota
								   LEFT JOIN tbl_kecamatan ON tbl_kecamatan.id_kecamatan = tbl_pemohon.id_kecamatan
								   LEFT JOIN tbl_desa ON tbl_desa.id_desa = tbl_pemohon.id_desa
								   LEFT JOIN tbl_pekerjaan ON tbl_pekerjaan.id_pekerjaan = tbl_pemohon.id_pekerjaan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_provinsi AS tbl_provinsib ON tbl_provinsib.id_provinsi = tbl_penerima.id_provinsi
								   LEFT JOIN tbl_kabkota AS tbl_kabkotab ON tbl_kabkotab.id_kabkota = tbl_penerima.id_kabkota
								   LEFT JOIN tbl_kecamatan AS tbl_kecamatanb ON tbl_kecamatanb.id_kecamatan = tbl_penerima.id_kecamatan
								   LEFT JOIN tbl_desa AS tbl_desab ON tbl_desab.id_desa = tbl_penerima.id_desa
								   LEFT JOIN tbl_pekerjaan AS tbl_pekerjaanb ON tbl_pekerjaanb.id_pekerjaan = tbl_penerima.id_pekerjaan
								   LEFT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_approval.id_jenis_kasus
								   LEFT JOIN tbl_posisi_hukum ON tbl_posisi_hukum.id_posisi_hukum = tbl_approval.id_posisi_hukum
								   LEFT JOIN tbl_nama_kasus ON tbl_nama_kasus.id_nama_kasus = tbl_approval.id_nama_kasus
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   LEFT JOIN tbl_user AS tbl_pembela ON tbl_pembela.id_user = tbl_approval.id_analis
								   LEFT JOIN tbl_user AS tbl_asisten ON tbl_asisten.id_user = tbl_approval.id_asisten
								   LEFT JOIN tbl_analisis ON tbl_analisis.id_permohonan = tbl_approval.id_permohonan
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND tbl_permohonan.no_reg = '".$no_reg."'");

		return $query;
	}

	function get_data_progress_pernoreg($no_reg)
	{
		$query = $this->db->query("SELECT DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') as tgl_progress,
								   tbl_progress.status_progress,
								   tbl_tahap_progress.tahap_progress,
								   CASE
								   WHEN tbl_progress.status_progress = 'Belum Selesai' THEN tbl_progress.uraian_progress
								   WHEN tbl_progress.status_progress = 'Selesai' AND tbl_approval.id_tindakan = '1' THEN tbl_progress.note_progress
								   WHEN tbl_progress.status_progress = 'Selesai' AND tbl_approval.id_tindakan = '2' THEN tbl_progress.note_progress
								   WHEN tbl_progress.status_progress = 'Selesai' AND tbl_approval.id_tindakan = '3' THEN tbl_progress.uraian_keputusan
								   ELSE tbl_progress.note_progress END AS description
								   FROM tbl_progress
								   LEFT JOIN tbl_tahap_progress ON tbl_tahap_progress.id_tahap_progress = tbl_progress.id_tahap_progress
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_progress.id_permohonan
								   LEFT JOIN tbl_approval ON tbl_approval.id_permohonan = tbl_progress.id_permohonan
								   WHERE tbl_permohonan.no_reg = '".$no_reg."'
								   ORDER BY tbl_progress.id_progress ASC");

		return $query;						   
	}
	
	function get_data_belum_dianalisis_pertahun($periode)
	{
		$query = $this->db->query("SELECT tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg, tbl_pemohon.nm_lengkap AS nm_pemohon, tbl_penerima.nm_lengkap AS nm_penerima,
								   tbl_jenis_kasus.jenis_kasus, tbl_posisi_hukum.posisi_hukum, tbl_tindakan.jenis_tindakan, tbl_analis.fullname AS nm_analis, tbl_asisten.fullname AS nm_asisten
								   FROM tbl_approval
								   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_analisis ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   LEFT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_approval.id_jenis_kasus
								   LEFT JOIN tbl_posisi_hukum ON tbl_posisi_hukum.id_posisi_hukum = tbl_approval.id_posisi_hukum
								   LEFT JOIN tbl_user AS tbl_analis ON tbl_analis.id_user = tbl_approval.id_analis
								   LEFT JOIN tbl_user AS tbl_asisten ON tbl_asisten.id_user = tbl_approval.id_asisten
								   WHERE 
								   tbl_analisis.id_permohonan IS NULL 
								   AND tbl_approval.status_approval = 'Diterima' 
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$periode."'
								   ORDER BY tbl_approval.id_permohonan ASC ");
		
		return $query;
		
	}
	
	function get_data_belum_dianalisis_pertahun_file($periode)
	{
		$query = $this->db->query("SELECT 'No', 'Nomor Permohonan', 'Tanggal', 'Penerima Bantuan', 'Jenis Masalah Hukum', 'Posisi Hukum', 'Bentuk Layanan', 'Pembela Umum', 'Asisten PU' UNION ALL
								   SELECT @curRow := @curRow + 1 AS row_number, no_reg, tgl_reg, nm_penerima, jenis_kasus, posisi_hukum, jenis_tindakan, nm_analis, nm_asisten
								   FROM (
								   SELECT tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg, tbl_penerima.nm_lengkap AS nm_penerima, 
								   tbl_jenis_kasus.jenis_kasus, tbl_posisi_hukum.posisi_hukum, tbl_tindakan.jenis_tindakan, tbl_analis.fullname AS nm_analis, tbl_asisten.fullname AS nm_asisten
								   FROM tbl_approval
								   LEFT JOIN tbl_permohonan ON tbl_approval.id_permohonan = tbl_permohonan.id_permohonan
								   LEFT JOIN tbl_pemohon ON tbl_permohonan.id_permohonan = tbl_pemohon.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_analisis ON tbl_approval.id_permohonan = tbl_analisis.id_permohonan
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   LEFT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_approval.id_jenis_kasus
								   LEFT JOIN tbl_posisi_hukum ON tbl_posisi_hukum.id_posisi_hukum = tbl_approval.id_posisi_hukum
								   LEFT JOIN tbl_user AS tbl_analis ON tbl_analis.id_user = tbl_approval.id_analis
								   LEFT JOIN tbl_user AS tbl_asisten ON tbl_asisten.id_user = tbl_approval.id_asisten
								   WHERE tbl_analisis.id_permohonan IS NULL 
								   AND tbl_approval.status_approval = 'Diterima' 
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$periode."'
								   ORDER BY tbl_approval.id_permohonan ASC
								   ) tbl_result
								   JOIN (SELECT @curRow := 0) r");
		
		return $query->result_array();
		
	}
	
	function get_user_list()
	{
		$query = $this->db->query("SELECT tbl_user.id_user, tbl_user.fullname FROM tbl_user WHERE tbl_user.id_user != '201600000' AND tbl_user.id_user != '201609000' ORDER BY tbl_user.fullname ASC");
		$users = array('' => '');
		foreach ($query->result() as $detail_user)
		{
                $users[$detail_user->id_user] = $detail_user->fullname;
        }
		return $users;
	}
	
	function get_data_petugas($id_user)
	{
		$query = $this->db->query("SELECT tbl_user.fullname, tbl_user.designation, DATE_FORMAT(tbl_user.tgl_signin, '%d/%m/%Y') AS tgl_signin
								   FROM tbl_user 
								   WHERE tbl_user.id_user = '".$id_user."'");
		
		return $query;
	}
	
	function get_data_penanganan_kasus_semua($id_user)
	{
		$query = $this->db->query("SELECT tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg, tbl_penerima.nm_lengkap AS nm_penerima, 
								   tbl_jenis_kasus.jenis_kasus, tbl_posisi_hukum.posisi_hukum, tbl_tindakan.jenis_tindakan, 
								   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_progress, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
								   FROM (
								   SELECT id_permohonan, tgl_progress, status_progress
								   FROM (
								   SELECT tbl_progress.id_permohonan, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_progress.status_progress
								   FROM tbl_progress ORDER BY tbl_progress.id_progress DESC
								   ) tbl_status GROUP BY tbl_status.id_permohonan
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   LEFT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_approval.id_jenis_kasus
								   LEFT JOIN tbl_posisi_hukum ON tbl_posisi_hukum.id_posisi_hukum = tbl_approval.id_posisi_hukum
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND (tbl_approval.id_analis = '".$id_user."' OR tbl_approval.id_asisten = '".$id_user."')
								   ORDER BY tbl_approval.id_permohonan ASC");
		return $query;
	}
	
	function get_data_penanganan_kasus_pertahun($id_user, $tahun)
	{
		$query = $this->db->query("SELECT tbl_permohonan.no_reg, DATE_FORMAT(tbl_permohonan.insert_date, '%d/%m/%Y') AS tgl_reg, tbl_penerima.nm_lengkap AS nm_penerima, 
								   tbl_jenis_kasus.jenis_kasus, tbl_posisi_hukum.posisi_hukum, tbl_tindakan.jenis_tindakan, 
								   IF(tgl_progress IS NULL, 'N/A', tgl_progress) AS tgl_progress, IF(status_progress IS NULL, 'N/A', status_progress) AS status_progress
								   FROM (
								   SELECT id_permohonan, tgl_progress, status_progress
								   FROM (
								   SELECT tbl_progress.id_permohonan, DATE_FORMAT(tbl_progress.tgl_progress, '%d/%m/%Y') AS tgl_progress, tbl_progress.status_progress
								   FROM tbl_progress ORDER BY tbl_progress.id_progress DESC
								   ) tbl_status GROUP BY tbl_status.id_permohonan
								   ) tbl_status_progress
								   RIGHT JOIN tbl_approval ON tbl_status_progress.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_permohonan ON tbl_permohonan.id_permohonan = tbl_approval.id_permohonan
								   LEFT JOIN tbl_penerima ON tbl_permohonan.id_permohonan = tbl_penerima.id_permohonan
								   LEFT JOIN tbl_tindakan ON tbl_tindakan.id_tindakan = tbl_approval.id_tindakan
								   LEFT JOIN tbl_jenis_kasus ON tbl_jenis_kasus.id_jenis_kasus = tbl_approval.id_jenis_kasus
								   LEFT JOIN tbl_posisi_hukum ON tbl_posisi_hukum.id_posisi_hukum = tbl_approval.id_posisi_hukum
								   WHERE tbl_approval.status_approval = 'Diterima'
								   AND DATE_FORMAT(tbl_approval.insert_date, '%Y') = '".$tahun."'
								   AND (tbl_approval.id_analis = '".$id_user."' OR tbl_approval.id_asisten = '".$id_user."')
								   ORDER BY tbl_approval.id_permohonan ASC");
		return $query;
	}


}


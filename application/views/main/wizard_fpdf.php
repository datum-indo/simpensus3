<?php

class PDF extends FPDF
{
	public $content_data;
	//Page header
	
	function Header()
	{
        $this->setFont('Times','',10);
        $this->setFillColor(255,255,255);
        //$this->Image(base_url().'assets/dist/img/user7-128x128.jpg', 10, 25,'20','20','jpeg');
		
		//$this->Ln(12);
        $this->setFont('Arial','',9);
		$this->setFillColor(255,255,255);
		$this->cell(25,6,'',0,0,'C',0); 
		$this->cell(100,6,'Laporan daftar pegawai gubugkoding.com',0,1,'L',1); 
		$this->cell(25,6,'',0,0,'C',0); 
		$this->cell(100,6,"Periode : ".date('M Y'),0,1,'L',1); 
		$this->cell(25,6,'',0,0,'C',0); 
		$this->cell(100,6,'Lokasi : Semarang, Jawa Tengah',0,1,'L',1); 
                
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
                
	}
 
	function Content($no_reg, $tgl_reg, $nm_pemohon, $tmp_lahir, $tgl_lahir, $umur, $alm_jalan, $alm_rt, $alm_rw, $nm_desa, $nm_kecamatan, $nm_kabkota, $nm_provinsi, $no_hp, $nm_hp, $pekerjaan, $tanggungan_total, $jenis_kid, $nomor_kid, $jenis_ktm, $nomor_ktm, $kondisi_fisik, $uraian_singkat)
	{
		$this->setFillColor(258,258,255);
		$this->setFont('Times', 'B', 14);
		$this->cell( 0, 6, "FORMULIR PERMOHONAN BANTUAN HUKUM", 0, 1, 'C', 1);
		$this->setFont('Times','',12);
		$this->cell( 0, 6, "Nomor Permohonan : ". $no_reg, 0, 1, 'C', 1);
		$this->cell( 0, 6, "Tanggal Permohonan : ". $tgl_reg, 0, 1, 'C', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);	
		$this->cell( 8, 6, "I.", 0, 0, 'L', 1);
		$this->cell( 50, 6, "IDENTITAS PEMOHON", 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->setFont('Times','B',12);
		$this->cell( 50, 6, "Data Pribadi", 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->setFont('Times','',12);
		$this->cell( 50, 6, "Nama Pemohon", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$nm_pemohon, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Tempat Lahir", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$tmp_lahir, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Tanggal Lahir", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$tgl_lahir, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Umur", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$umur.' Tahun', 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Alamat", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$alm_jalan, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "", 0, 0, 'L', 1);
		$this->cell( 100, 6, '  RT : '.$alm_rt.' RW : '.$alm_rw, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "", 0, 0, 'L', 1);
		$this->cell( 200, 6, '  Desa/Kelurahan : '.$nm_desa.',  Kecamatan : '.$nm_kecamatan, 0, 0, 'L', 1);	
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "", 0, 0, 'L', 1);
		$this->cell( 200, 6, '  Kabupaten/Kotamadya : '.$nm_kabkota.',  Provinsi : '.$nm_provinsi, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Nomor Handphone", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$no_hp.' ('.$nm_hp.')', 0, 0, 'L', 1);	
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Pekerjaan", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$pekerjaan, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Jumlah Tanggungan", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$tanggungan_total.' Orang', 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->setFont('Times','B',12);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Data Tambahan", 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->setFont('Times','',12);
		$this->cell( 50, 6, "Identitas Pengenal", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$jenis_kid.',  Nomor : '.$nomor_kid, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Keterangan Tidak Mampu", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$jenis_ktm.',  Nomor : '.$nomor_ktm, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 50, 6, "Kelainan Fisik & Mental", 0, 0, 'L', 1);
		$this->cell( 100, 6, ': '.$kondisi_fisik, 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);	
		$this->cell( 8, 6, "II.", 0, 0, 'L', 1);
		$this->cell( 80, 6, "URAIAN SINGKAT POKOK PERSOALAN", 0, 0, 'L', 1);
		$this->cell( 0, 6, "", 0, 1, 'C', 1);
		$this->cell( 8, 6, "", 0, 0, 'L', 1);
		$this->cell( 200, 6, $uraian_singkat, 0, 0, 'L', 1);
	}
	
	function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-15);
		//buat garis horizontal
		$this->Line(10,$this->GetY(),210,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
                $this->Cell(0,10,'copyright gubugkoding.com Semarang ' . date('Y'),0,0,'L');
		//nomor halaman
		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}

$pdf = new PDF('P','mm','legal');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content($no_reg, $tgl_reg, $nm_pemohon, $tmp_lahir, $tgl_lahir, $umur, $alm_jalan, $alm_rt, $alm_rw, $nm_desa, $nm_kecamatan, $nm_kabkota, $nm_provinsi,  $no_hp, $nm_hp, $pekerjaan, $tanggungan_total, $jenis_kid, $nomor_kid, $jenis_ktm, $nomor_ktm, $kondisi_fisik, $uraian_singkat);
$pdf->Output();



<html>
<head>
	<title></title>
	
</head>
<style>
body { 
	font-family: "Times New Roman", Times, serif; 
	font-size: 13px;
}

table {
   width:100%;
   border-collapse: collapse;
}

tr,td {
	border-collapse: collapse;
	/*border: 1px solid black;*/
}

.title1 {
	font-size: 12px;
}

.title2 {
	font-size: 12px;
	font-weight: bold;
}

.title3 {
	font-size: 11px;
}

.title4 {
	font-size: 11px;
}

.judul {
	font-weight: bold;
	font-family: "Times New Roman", Times, serif;
	text-align: center;
	font-size: 16px;
}

.registrasi {
	text-align: center;
	font-family: "Times New Roman", Times, serif;
}

.valign {
	vertical-align:baseline;
}

.center {
	text-align: center;	
}

</style>
<body>
	<table>
		
		<tr>
			<td colspan="2"><img src="<?php echo base_url()?>assets/img/logo_report.png" alt="" width="60" height="59" /></td>
			<td colspan="7">
							<span class="title1">YAYASAN LEMBAGA BANTUAN HUKUM INDONESIA </span><br>
							<span class="title2">LEMBAGA BANTUAN HUKUM (LBH) JAKARTA</span><br>
							<span class="title3"><?php echo $line1; ?></span><br>
							<span class="title4"><?php echo $line2; ?></span>
			</td>	
		</tr>
		
		<tr>
			<td width="30">&nbsp;</td>
			<td width="35">&nbsp;</td>
			<td colspan="7">&nbsp;</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td colspan="9" class="judul">BUKTI PERMOHONAN</td>
		</tr>
		<tr>
			<td colspan="9" class="judul">LAYANAN BANTUAN HUKUM</td>
		</tr>
		<tr>
			<td colspan="9" class="registrasi">Nomor Permohonan : <?php echo $no_reg; ?></td>
		</tr>
		<tr>
			<td colspan="9" class="registrasi">Tanggal : <?php echo $tgl_reg; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="150">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td>I.</td>
			<td colspan="8">IDENTITAS PEMOHON BANTUAN HUKUM</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td></td>
			<td colspan="2">Nama</td>
			<td width="10px">:</td>
			<td colspan="5"><?php echo $nm_pemohon; ?></td>
		</tr>
		
		<tr>
			<td></td>
			<td colspan="2">Tempat Lahir</td>
			<td>:</td>
			<td colspan="5"><?php echo $tmp_lahir; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Tanggal Lahir</td>
			<td>:</td>
			<td colspan="5"><?php echo $tgl_lahir; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Umur</td>
			<td>:</td>
			<td colspan="5"><?php echo $umur.' Tahun'; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Jenis Kelamin</td>
			<td>:</td>
			<td colspan="5"><?php echo $jkel; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Alamat</td>
			<td>:</td>
			<td colspan="5"><?php echo $alm_jalan; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"></td>
			<td></td>
			<td colspan="5"><?php echo 'RT : '.$alm_rt.'  RW : '.$alm_rw ; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"></td>
			<td></td>
			<td colspan="5"><?php echo 'Desa/Kelurahan : '.$nm_desa.',  Kecamatan : '.$nm_kecamatan ; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"></td>
			<td></td>
			<td colspan="5"><?php echo 'Kabupaten/Kotamadya : '.$nm_kabkota.',  Provinsi : '.$nm_provinsi ; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Pekerjaan</td>
			<td>:</td>
			<td colspan="5"><?php echo $pekerjaan; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Nomor Handphone</td>
			<td>:</td>
			<td colspan="5"><?php echo $no_hp.'  ('.$nm_hp.')'; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Jumlah Orang yang diwakili</td>
			<td>:</td>
			<td colspan="5"><?php echo '............. Orang'; ?></td>
		</tr>
		
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td>II.</td>
			<td colspan="8">IDENTITAS CALON PENERIMA BANTUAN HUKUM :</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td></td>
			<td colspan="2">Nama</td>
			<td width="10px">:</td>
			<td colspan="5"><?php echo $nm_penerima; ?></td>
		</tr>
		
		<tr>
			<td></td>
			<td colspan="2">Tempat Lahir</td>
			<td>:</td>
			<td colspan="5"><?php echo $tmp_lahirb; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Tanggal Lahir</td>
			<td>:</td>
			<td colspan="5"><?php echo $tgl_lahirb; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Umur</td>
			<td>:</td>
			<td colspan="5"><?php echo $umurb.' Tahun'; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Jenis Kelamin</td>
			<td>:</td>
			<td colspan="5"><?php echo $jkelb; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Alamat</td>
			<td>:</td>
			<td colspan="5"><?php echo $alm_jalanb; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"></td>
			<td></td>
			<td colspan="5"><?php echo 'RT : '.$alm_rtb.'  RW : '.$alm_rwb; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"></td>
			<td></td>
			<td colspan="5"><?php echo 'Desa/Kelurahan : '.$nm_desab.',  Kecamatan : '.$nm_kecamatanb; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"></td>
			<td></td>
			<td colspan="5"><?php echo 'Kabupaten/Kotamadya : '.$nm_kabkotab.',  Provinsi : '.$nm_provinsib; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Pekerjaan</td>
			<td>:</td>
			<td colspan="5"><?php echo $pekerjaanb; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Nomor Handphone</td>
			<td>:</td>
			<td colspan="5"><?php echo $no_hpb.'  ('.$nm_hpb.')'; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Hubungan dengan Pemohon</td>
			<td>:</td>
			<td colspan="5"><?php echo $hubungan_penerima; ?></td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td class="valign">III.</td>
			<td colspan="8">Dengan ini saya sebagai Petugas Wawancara menyatakan bahwa semua informasi yang saya tulis sesuai dengan yang disampaikan oleh Pemohon Bantuan Hukum.</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td class="valign">IV.</td>
			<td colspan="8">Dengan ini saya sebagai Pemohon Bantuan Hukum menyatakan bahwa semua informasi yang saya sampaikan adalah benar adanya dan saya mengizinkan YLBHI/LBH untuk menggunakan informasi tersebut untuk keperluan penelitian, analisa dan advokasi kebijakan, dengan tetap merahasiakan identitas saya.</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td class="center" colspan="6" width="">Nama & Tandatangan</td>
			<td width="20%"></td>
			<td class="center" colspan="2" width="35%">Nama & Tandatangan</td>
		</tr>
		<tr>
			<td class="center" colspan="6" width="">Petugas Wawancara</td>
			<td width="20%"></td>
			<td class="center" colspan="2" width="35%">Pemohon</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td class="center" colspan="6" width=""><?php echo $nm_petugas_wawancara?></td>
			<td width="20%"></td>
			<td class="center" colspan="2" width="35%"><?php echo $nm_pemohon?></td>
		</tr>
	</table>
</body>
</html>
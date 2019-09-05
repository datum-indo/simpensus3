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
		<tr>
			<td colspan="9" class="judul"><?php if($status_approval == 'Diterima'){ echo 'SURAT PERSETUJUAN'; }else{ echo 'SURAT PENOLAKAN'; }?></td>
		</tr>
		<tr>
			<td colspan="9" class="judul">PERMOHONAN LAYANAN BANTUAN HUKUM</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td colspan="9">Yang bertandatangan dibawah ini Pimpinan Lembaga Bantuan Hukum (LBH) Makassar, berkedudukan di <?php echo $alm_lengkap; ?>. Sesuai dengan Permohonan Layanan Bantuan Hukum :</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
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
		<tr>
			<td>I.</td>
			<td colspan="8">IDENTITAS PEMOHON BANTUAN HUKUM</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>		
		<tr>
			<td></td>
			<td colspan="2">Nama Pemohon</td>
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
			<td colspan="2">Nomor Handphone</td>
			<td>:</td>
			<td colspan="5"><?php echo $no_hp.'  ('.$nm_hp.')'; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Pekerjaan</td>
			<td>:</td>
			<td colspan="5"><?php echo $pekerjaan; ?></td>
		</tr>
		
		
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td class="valign">II.</td>
			<td colspan="8">Dengan ini menyatakan <b><?php if($status_approval == 'Diterima'){ echo 'Menerima'; }else{ echo 'Menolak'; }?></b> permohonan layanan bantuan hukum dengan pertimbangan menurut syarat-syarat yang ditentukan.
			<?php //if($status_approval == 'Ditolak') { echo ' Permohonan ditolak, dengan alasan sebagai berikut :'; }?></td>
		</tr>
		
		<tr>
			<td></td>
			<td colspan="8"><?php //echo $uraian_singkat; ?></td>
		</tr>
		
		<?php if($status_approval == 'Ditolak')
		{
			
			echo '<tr>';
			echo '<td></td>';
			echo '<td colspan="8">'.'Permohonan ditolak, dengan alasan sebagai berikut : '.'</td>';
			echo '</td>';
			echo '</tr>';
			
			echo '<tr>';
			echo '<td></td>';
			echo '<td colspan="8">';
			echo '<ul>';
			
			foreach($alasan->result_array() as $row)
			{
				if($row['id_alasan_penolakan'] == '8')
				{
					echo '<li>'.$alasan_lain.'</li>';
				}
				else
				{
					echo '<li>'.$row['isi_alasan_penolakan'].'</li>';
				}	
			}
			
			echo '</ul>';				
			echo '</td>';
			echo '</tr>';
		}?>
		
		
		
		<tr>
			<td></td>
			<td colspan="8"><?php //echo $uraian_singkat; ?></td>
		</tr>
		
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		
		<tr>
			<td></td>
			<td colspan="8"><?php echo $kota_cabang; ?>, <?php echo $tgl_approval; ?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="8"><b>LEMBAGA BANTUAN HUKUM (LBH) <?php echo strtoupper($kota_cabang); ?></b></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="8">A.n Direktur</td>
		</tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr><td colspan="9">&nbsp;</td></tr>
		<tr>
			<td></td>
			<td colspan="8"><b><?php echo $nm_approval; ?></b></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="8"><?php echo $jabatan_approval; ?></td>
		</tr>
		
	</table>
</body>
</html>
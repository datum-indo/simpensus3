<!-- Bootstrap modal -->
<div class="modal fade" id="view-wizard" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
			<div class="modal-body" id="view_wizard">
				<!-- Step-1 !-->
				<div class="row" data-step="1" data-title="Click next please" id="view-1">
					<div class="">
						<div class="col-lg-6">
							<!--
							<dl>
								<dt>Nomor Permohonan:</dt>
								<dd id="dd_no_reg"></dd>	
							</dl>
							<dl>
								<dt>Tanggal Registrasi:</dt>
								<dd id="dd_tgl_reg"></dd>	
							</dl>
							-->
							<dl>
								<dt>Nama Lengkap:</dt>
								<dd id="dd_nm_pemohon"></dd>	
							</dl>
							<dl>
								<dt>Nama Panggilan:</dt>
								<dd id="dd_nm_panggilan"></dd>	
							</dl>
							<dl>
								<dt>Tempat dan Tanggal Lahir:</dt>
								<dd id="dd_tmp_lahir"></dd>	
							</dl>
							<dl>
								<dt>Count Unit:</dt>
								<dd id="dd_count_unit"></dd>	
							</dl>
							<!--
							<dl>
								<dt>Tanggal Lahir:</dt>
								<dd id="dd_tgl_lahir"></dd>	
							</dl>
							<dl>
								<dt>Umur:</dt>
								<dd id="dd_umur"></dd>	
							</dl>
							-->
							<dl>
								<dt>Jenis Kelamin:</dt>
								<dd id="dd_jkel"></dd>	
							</dl>
							<dl>
								<dt>Golongan Darah:</dt>
								<dd id="dd_golongan_darah"></dd>	
							</dl>
						</div>
						<div class="col-lg-6">
							<dl>
								<dt>Kelainan Fisik dan Mental:</dt>
								<dd id="dd_kondisi_fisik"></dd>	
							</dl>
							<dl>
								<dt>Status Perkawinan:</dt>
								<dd id="dd_status_perkawinan"></dd>	
							</dl>
							<dl>
								<dt>Pendidikan:</dt>
								<dd id="dd_nm_pendidikan"></dd>	
							</dl>
							<dl>
								<dt>Agama:</dt>
								<dd id="dd_nm_agama"></dd>	
							</dl>
							<dl>
								<dt>Suku:</dt>
								<dd id="dd_suku"></dd>	
							</dl>
							<dl>
								<dt>Kewarganegaraan:</dt>
								<dd id="dd_kewarganegaraan"></dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-1 !-->
				<!-- Step-2 !-->
				<div class="row" data-step="2" data-title="Click next please" id="view-2">
					<div class="">
						<div class="col-lg-6">
							
							<dl>
								<dt>Pekerjaan Pokok:</dt>
								<dd id="dd_jenis_pekerjaan"></dd>	
							</dl>
							<dl>
								<dt>Pekerjaan Tambahan:</dt>
								<dd id="dd_pekerjaan2"></dd>	
							</dl>
							<dl>
								<dt>Pekerjaan Istri/Suami:</dt>
								<dd id="dd_pekerjaansi"></dd>	
							</dl>
							
							<dl>
								<dt>Rata-rata Penghasilan Keluarga (Istri & Suami) dalam Sebulan:</dt>
								<dd id="dd_penghasilan"></dd>	
							</dl>
							
							<dl>
								<dt>Jumlah Anak:</dt>
								<dd id="dd_jml_anak"></dd>	
							</dl>
							
							<dl>
								<dt>Jumlah orang yang menjadi tanggungan:</dt>
								<dd id="dd_tanggungan_total"></dd>	
							</dl>
						</div>
						<div class="col-lg-6">
							<dl style="border-bottom: 1px solid black; padding:0; margin:0  0 10px 0;">
								<dt>Jenis & jumlah harta yang dimiliki:</dt>
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Rumah:</dt>
								<dd id="dd_harta_rumah" style="float: left; width: 50%; "></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Tanah:</dt>
								<dd id="dd_harta_tanah" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Bangunan:</dt>
								<dd id="dd_harta_bangunan" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Mobil:</dt>
								<dd id="dd_harta_mobil" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Motor:</dt>
								<dd id="dd_harta_motor" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Toko:</dt>
								<dd id="dd_harta_toko" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Tabungan:</dt>
								<dd id="dd_harta_tabungan" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Handphone:</dt>
								<dd id="dd_harta_handphone" style="float: left; width: 50%;"></dd>	
							</dl>
							<!--
							<dl style="">
								<dt style="float: left; width: 50%;">Lain-lain:</dt>
								<dd id="dd_harta_lain" style="float: left; width: 50%;"></dd>	
							</dl>
							-->
							&nbsp;
							<dl style="border-top: 1px solid black;"></dl>
							<dl>
								<dt>Status Tempat Tinggal:</dt>
								<dd id="dd_status_tempat_tinggal"></dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-2 !-->
				<!-- Step-3 !-->
				<div class="row" data-step="3" data-title="Click next please" id="view-3">
					<div class="">
						<div class="col-lg-6">
							<dl>
								<dt>Alamat:</dt>
								<dd id="dd_alm_jalan"></dd>	
							</dl>
							<div class="col-lg-4" style="padding: 0; margin:0;">
							<dl>
								<dt>RT:</dt>
								<dd id="dd_alm_rt"></dd>	
							</dl>
							</div>
							<div class="col-lg-4" style="padding: 0; margin:0;">
							<dl>
								<dt>RW:</dt>
								<dd id="dd_alm_rw"></dd>	
							</dl>
							</div>
							<div class="col-lg-4" style="padding: 0; margin:0;">
							<dl>
								<dt>Kodepos:</dt>
								<dd id="dd_kodepos"></dd>	
							</dl>
							</div>
							<dl>
								<dt>Provinsi:</dt>
								<dd id="dd_nm_provinsi"></dd>	
							</dl>
							<dl>
								<dt>Kota/Kabupaten:</dt>
								<dd id="dd_nm_kabkota"></dd>	
							</dl>
							<dl>
								<dt>Kecamatan:</dt>
								<dd id="dd_nm_kecamatan"></dd>	
							</dl>
							<dl>
								<dt>Desa/Kelurahan:</dt>
								<dd id="dd_nm_desa"></dd>	
							</dl>
							<dl>
								<dt>Nomor Telepon:</dt>
								<dd id="dd_no_telp"></dd>	
							</dl>
						</div>
						<div class="col-lg-6">
							<dl>
								<dt>Nomor Handphone:</dt>
								<dd id="dd_no_hp"></dd>	
							</dl>
							<dl>
								<dt>Pemilik Nomor Handphone:</dt>
								<dd id="dd_nm_hp"></dd>	
							</dl>
							<!--
							<dl>
								<dt>Email:</dt>
								<dd id="dd_email"></dd>	
							</dl>
							<dl>
								<dt>Facebook:</dt>
								<dd id="dd_facebook"></dd>	
							</dl>
							<dl>
								<dt>Twitter:</dt>
								<dd id="dd_twitter"></dd>	
							</dl>
							<dl>
								<dt>Sosial Media Lainnya:</dt>
								<dd id="dd_sosial_media"></dd>	
							</dl>
							-->
							<dl>
								<dt>Jenis Kartu Identitas:</dt>
								<dd id="dd_jenis_kid"></dd>	
							</dl>
							<dl>
								<dt>Nomor:</dt>
								<dd id="dd_nomor_kid"></dd>	
							</dl>
							<dl>
								<dt>Jenis Keterangan Tidak Mampu:</dt>
								<dd id="dd_jenis_ktm"></dd>	
							</dl>
							<dl>
								<dt>Nomor:</dt>
								<dd id="dd_nomor_ktm"></dd>	
							</dl>
							<dl>
								<dt>Data Pemohon sama dengan Data Penerima Bantuan:</dt>
								<dd id="dd_status_pemohon"></dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-3 !-->
				<!-- Step-1 Penerima !-->
				<div class="row" data-step="1b" data-title="Click next please" id="view-1b">
					<div class="">
						<div class="col-lg-6">
							<dl>
								<dt>Nama Lengkap:</dt>
								<dd id="dd_nm_penerima"></dd>	
							</dl>
							<dl>
								<dt>Nama Panggilan:</dt>
								<dd id="dd_nm_panggilanb"></dd>	
							</dl>
							<dl>
								<dt>Tempat dan Tanggal Lahir:</dt>
								<dd id="dd_tmp_lahirb"></dd>	
							</dl>
							<dl>
								<dt>Count Unit:</dt>
								<dd id="dd_count_unitb"></dd>	
							</dl>
							<!--
							<dl>
								<dt>Tanggal Lahir:</dt>
								<dd id="dd_tgl_lahirb"></dd>	
							</dl>
							<dl>
								<dt>Umur:</dt>
								<dd id="dd_umurb"></dd>	
							</dl>
							-->
							<dl>
								<dt>Jenis Kelamin:</dt>
								<dd id="dd_jkelb"></dd>	
							</dl>
							<dl>
								<dt>Golongan Darah:</dt>
								<dd id="dd_golongan_darahb"></dd>	
							</dl>
						</div>
						<div class="col-lg-6">
							<dl>
								<dt>Kelainan Fisik dan Mental:</dt>
								<dd id="dd_kondisi_fisikb"></dd>	
							</dl>
							<dl>
								<dt>Status Perkawinan:</dt>
								<dd id="dd_status_perkawinanb"></dd>	
							</dl>
							<dl>
								<dt>Pendidikan:</dt>
								<dd id="dd_nm_pendidikanb"></dd>	
							</dl>
							<dl>
								<dt>Agama:</dt>
								<dd id="dd_nm_agamab"></dd>	
							</dl>
							<dl>
								<dt>Suku:</dt>
								<dd id="dd_sukub"></dd>	
							</dl>
							<dl>
								<dt>Kewarganegaraan:</dt>
								<dd id="dd_kewarganegaraanb"></dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-1 Penerima -->
				<!-- Step-2 Penerima !-->
				<div class="row" data-step="2b" data-title="Click next please" id="view-2b">
					<div class="">
						<div class="col-lg-6">
							
							<dl>
								<dt>Pekerjaan Pokok:</dt>
								<dd id="dd_jenis_pekerjaanb"></dd>	
							</dl>
							<dl>
								<dt>Pekerjaan Tambahan:</dt>
								<dd id="dd_pekerjaan2b"></dd>	
							</dl>
							<dl>
								<dt>Pekerjaan Istri/Suami:</dt>
								<dd id="dd_pekerjaansib"></dd>	
							</dl>
							
							<dl>
								<dt>Rata-rata Penghasilan Keluarga (Istri & Suami) dalam Sebulan:</dt>
								<dd id="dd_penghasilanb"></dd>	
							</dl>
							
							<dl>
								<dt>Jumlah Anak:</dt>
								<dd id="dd_jml_anakb"></dd>	
							</dl>
							
							<dl>
								<dt>Jumlah orang yang menjadi tanggungan:</dt>
								<dd id="dd_tanggungan_totalb"></dd>	
							</dl>
						</div>
						<div class="col-lg-6">
							<dl style="border-bottom: 1px solid black; padding:0; margin:0  0 10px 0;">
								<dt>Jenis & jumlah harta yang dimiliki:</dt>
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Rumah:</dt>
								<dd id="dd_harta_rumahb" style="float: left; width: 50%; "></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Tanah:</dt>
								<dd id="dd_harta_tanahb" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Bangunan:</dt>
								<dd id="dd_harta_bangunanb" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Mobil:</dt>
								<dd id="dd_harta_mobilb" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Motor:</dt>
								<dd id="dd_harta_motorb" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Toko:</dt>
								<dd id="dd_harta_tokob" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Tabungan:</dt>
								<dd id="dd_harta_tabunganb" style="float: left; width: 50%;"></dd>	
							</dl>
							<dl>
								<dt style="float: left; width: 50%;">Handphone:</dt>
								<dd id="dd_harta_handphoneb" style="float: left; width: 50%;"></dd>	
							</dl>
							<!--
							<dl style="">
								<dt style="float: left; width: 50%;">Lain-lain:</dt>
								<dd id="dd_harta_lainb" style="float: left; width: 50%;"></dd>	
							</dl>
							-->
							&nbsp;
							<dl style="border-top: 1px solid black;"></dl>
							<dl>
								<dt>Status Tempat Tinggal:</dt>
								<dd id="dd_status_tempat_tinggalb"></dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-2 Penerima -->
				<!-- Step-3 Penerima -->
				<div class="row" data-step="3b" data-title="Click next please" id="view-3b">
					<div class="">
						<div class="col-lg-6">
							<dl>
								<dt>Alamat:</dt>
								<dd id="dd_alm_jalanb"></dd>	
							</dl>
							<div class="col-lg-4" style="padding: 0; margin:0;">
							<dl>
								<dt>RT:</dt>
								<dd id="dd_alm_rtb"></dd>	
							</dl>
							</div>
							<div class="col-lg-4" style="padding: 0; margin:0;">
							<dl>
								<dt>RW:</dt>
								<dd id="dd_alm_rwb"></dd>	
							</dl>
							</div>
							<div class="col-lg-4" style="padding: 0; margin:0;">
							<dl>
								<dt>Kodepos:</dt>
								<dd id="dd_kodeposb"></dd>	
							</dl>
							</div>
							<dl>
								<dt>Provinsi:</dt>
								<dd id="dd_nm_provinsib"></dd>	
							</dl>
							<dl>
								<dt>Kota/Kabupaten:</dt>
								<dd id="dd_nm_kabkotab"></dd>	
							</dl>
							<dl>
								<dt>Kecamatan:</dt>
								<dd id="dd_nm_kecamatanb"></dd>	
							</dl>
							<dl>
								<dt>Desa/Kelurahan:</dt>
								<dd id="dd_nm_desab"></dd>	
							</dl>
							<dl>
								<dt>Nomor Telepon:</dt>
								<dd id="dd_no_telpb"></dd>	
							</dl>
						</div>
						<div class="col-lg-6">
							<dl>
								<dt>Nomor Handphone:</dt>
								<dd id="dd_no_hpb"></dd>	
							</dl>
							<dl>
								<dt>Pemilik Nomor Handphone:</dt>
								<dd id="dd_nm_hpb"></dd>	
							</dl>
							<!--
							<dl>
								<dt>Email:</dt>
								<dd id="dd_emailb"></dd>	
							</dl>
							<dl>
								<dt>Facebook:</dt>
								<dd id="dd_facebookb"></dd>	
							</dl>
							<dl>
								<dt>Twitter:</dt>
								<dd id="dd_twitterb"></dd>	
							</dl>
							<dl>
								<dt>Sosial Media Lainnya:</dt>
								<dd id="dd_sosial_mediab"></dd>	
							</dl>
							-->
							<dl>
								<dt>Jenis Kartu Identitas:</dt>
								<dd id="dd_jenis_kidb"></dd>	
							</dl>
							<dl>
								<dt>Nomor:</dt>
								<dd id="dd_nomor_kidb"></dd>	
							</dl>
							<dl>
								<dt>Jenis Keterangan Tidak Mampu:</dt>
								<dd id="dd_jenis_ktmb"></dd>	
							</dl>
							<dl>
								<dt>Nomor:</dt>
								<dd id="dd_nomor_ktmb"></dd>	
							</dl>
							<dl>
								<dt>Hubungan dengan Pemohon :</dt>
								<dd id="dd_hubungan_penerima"></dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-3 Penerima-->					
				<!-- Step-4 !-->
				<div class="row" data-step="4" data-title="Click next please" id="view-4">
					<div class="">
						<div class="col-lg-4">
							<dl id="dd_list_kid_box">
								<dt>Identitas Pengenal:</dt>
								<dt></dt>
								<dd id="dd_list_kid">
									<ul id="list_kid" class="list-group">
										<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									</ul>
								</dd>	
							</dl>
						</div>
						<div class="col-lg-4">
							<dl id="dd_list_ktm_box">
								<dt>Keterangan tidak Mampu:</dt>
								<dt></dt>
								<dd id="dd_list_ktm">
									<ul id="list_ktm" class="list-group">
										<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									</ul>
								</dd>	
							</dl>
						</div>
						<div class="col-lg-4">
							<dl id="dd_list_permohonan_box">
								<dt>Dokumen Permohonan:</dt>
								<dt></dt>
								<dd id="dd_list_permohonan">
									<ul id="list_permohonan" class="list-group">
										<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
										<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									</ul>
								</dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-4 !-->	
				<!-- Step-5 !-->
				<div class="row" data-step="5" data-title="Click next please" id="view-5">
					<div class="">
						<div class="col-lg-6">
							<dl>
								<dt>Jarak tempat tinggal Pemohon dari Kantor LBH:</dt>
								<dd id="dd_jarak_tempuh"></dd>	
							</dl>
							<dl>
								<dt>Lama perjalanan dari tempat tinggal Pemohon ke Kantor LBH:</dt>
								<dd id="dd_waktu_tempuh"></dd>	
							</dl>
							<dl>
								<dt>Apakah Pemohon pernah menjadi Klien LBH sebelumnya?</dt>
								<dd id="dd_pernah_jadi_client"></dd>	
							</dl>
							<dl id="dl_sumber_info">
								<dt>Darimanakah Pemohon pertama kali mengetahui LBH?</dt>
								<dd id="dd_sumber_info"></dd>	
							</dl>
						</div>
						<div class="col-lg-6">
							<dl>
								<dt>Adakah yang menganjurkan Pemohon untuk datang ke LBH?</dt>
								<dd id="dd_rekomendasi_lbh"></dd>	
							</dl>
							<dl id="dl_nm_rekomendasi">
								<dt>Nama:</dt>
								<dd id="dd_nm_rekomendasi"></dd>	
							</dl>
							<dl id="dl_alm_rekomendasi">
								<dt>Alamat:</dt>
								<dd id="dd_alm_rekomendasi"></dd>	
							</dl>
							<dl id="dl_pekerjaan_rekomendasi">
								<dt>Pekerjaan:</dt>
								<dd id="dd_pekerjaan_rekomendasi"></dd>	
							</dl>
						</div>
					</div>	
				</div><!-- End Step-5 !-->	
				<!-- Step-6 !-->
				<div class="row" data-step="6" data-title="Click next please" id="view-6">
					<div class="">
						<div class="col-lg-12">
							<dl>
								<dt>Uraian Singkat Pokok Permasalahan:</dt>
								<dd id="dd_uraian_singkat"></dd>	
							</dl>
							
							<dl>
								<dt>Kronologi :</dt>
								<dd id="dd_kronologi_kasus"></dd>	
							</dl>
							
							<dl>
								<dt>Apakah masalah tersebut pernah dibawa atau ditangani pihak yang lain?</dt>
								<dd id="dd_penanganan_pihak_lain"></dd>	
							</dl>
							
							<dl id="dd_tahap_penanganan_pihak_lain_box">
								<dt>Tahap penanganan:</dt>
								<dd id="dd_tahap_penanganan_pihak_lain"></dd>	
							</dl>
							
							<dl id="dd_desc_tahap_penanganan_pihak_lain_box">
								<dt>Uraian tahapan penanganan:</dt>
								<dd id="dd_desc_tahap_penanganan_pihak_lain"></dd>	
							</dl>
						</div>	
					</div>	
				</div><!-- End Step-6 !-->
            </div>
			<div class="modal-footer">
				<!--Step 1-->
				<button type="button" id="btn-vnext1" onclick="vnext1()" class="btn btn-primary">Lanjut</button>
				<!--Step 2-->	
				<button type="button" id="btn-vprev2" onclick="vprev2()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext2" onclick="vnext2()" class="btn btn-primary">Lanjut</button>
				<!--Step 3-->	
				<button type="button" id="btn-vprev3" onclick="vprev3()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext3" onclick="vnext3()" class="btn btn-primary">Lanjut</button>
				<!--Step 1 Penerima -->
				<button type="button" id="btn-vprev1b" onclick="vprev1b()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext1b" onclick="vnext1b()" class="btn btn-primary">Lanjut</button>
				<!--Step 2 Penerima -->	
				<button type="button" id="btn-vprev2b" onclick="vprev2b()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext2b" onclick="vnext2b()" class="btn btn-primary">Lanjut</button>
				<!--Step 3 Penerima -->	
				<button type="button" id="btn-vprev3b" onclick="vprev3b()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext3b" onclick="vnext3b()" class="btn btn-primary">Lanjut</button>
				<!--Step 4-->	
				<button type="button" id="btn-vprev4" onclick="vprev4()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext4" onclick="vnext4()" class="btn btn-primary">Lanjut</button>
				<!--Step 5-->	
				<button type="button" id="btn-vprev5" onclick="vprev5()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext5" onclick="vnext5()" class="btn btn-primary">Lanjut</button>
				<!--Step 6-->	
				<button type="button" id="btn-vprev6" onclick="vprev6()" class="btn btn-warning">Kembali</button>
				<button type="button" id="btn-vnext6" onclick="vnext6()" class="btn btn-primary">Finish</button>
            </div>
		</div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
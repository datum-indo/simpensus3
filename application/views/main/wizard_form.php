<!-- Bootstrap modal -->
<style>
	fieldset.group1 {
		border: 1px groove #ddd !important;
		padding: 1em 0 0 0 !important;
		margin: 0 0 0.5em 0 !important;
		-webkit-box-shadow: 0px 0px 0px 0px #000;
		box-shadow: 0px 0px 0px 0px #000;
	}
</style>
<div class="modal fade" id="form-wizard" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
			<div class="modal-body">
				<?php echo form_open('#', 'id="formWizard" class="" enctype="multipart/form-data"'); ?>
				<?php echo form_hidden('id_permohonan', ''); ?>
				<!--Step 1 -->
				<div class="row" data-step="1" data-title="Click next please" id="step-1">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Nama Lengkap</label>
								<?php echo form_input('nm_lengkap', '', 'id="nm_lengkap" placeholder="Nama Lengkap" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Nama Panggilan</label>
								<?php echo form_input('nm_panggilan', '', 'id="nm_panggilan" placeholder="Alias" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Tempat Lahir</label>
								<?php echo form_input('tmp_lahir', '', 'id="tmp_lahir" placeholder="Tempat Lahir" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Tanggal Lahir</label>(dd/mm/yyyy)
								<?php echo form_input('tgl_lahir', '', 'id="tgl_lahir" placeholder="" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Count Unit</label>
								<?php echo form_dropdown('id_count_unit', $count_unit, '', 'id="id_count_unit" class="form-control chosen-select-deselect" data-placeholder="Count Unit"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Jenis Kelamin</label>
								<div class="">
									<div id="_jkel" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($jkel);
										foreach ($jkel as $value) {
											$count = $count - 1;
											echo '<label id="_jkel' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('jkel', $value, '', 'id="jkel' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
								</div>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Status Perkawinan</label>
								<?php echo form_dropdown('status_perkawinan', $status_perkawinan, '', 'id="status_perkawinan" class="form-control chosen-select-deselect" data-placeholder="Status Perkawinan"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Pendidikan</label>
								<?php echo form_dropdown('id_pendidikan', $pendidikan, '', 'id="id_pendidikan" class="form-control chosen-select-deselect" data-placeholder="Pendidikan"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="pendidikan_desc_info" class="form-group">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('pendidikan_desc', '', 'id="pendidikan_desc" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Agama</label>
								<?php echo form_dropdown('id_agama', $agama, '', 'id="id_agama" class="form-control chosen-select-deselect" data-placeholder="Agama"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="agama_desc_info" class="form-group">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('agama_desc', '', 'id="agama_desc" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="suku_info" class="form-group">
								<label class="control-label">Suku</label>
								<?php echo form_input('suku', '', 'id="suku" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kewarganegaraan</label>
								<?php echo form_dropdown('kewarganegaraan', $kewarganegaraan, '', 'id="kewarganegaraan" class="form-control chosen-select-deselect" data-placeholder="Kewarganegaraan"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="negara_info" class="form-group">
								<label class="control-label">Negara</label>
								<?php echo form_dropdown('id_negara', $negara, '', 'id="id_negara" class="form-control chosen-select-deselect" data-placeholder="Negara"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Golongan Darah</label>
								<?php echo form_dropdown('id_golongan_darah', $golongan_darah, '', 'id="id_golongan_darah" class="form-control chosen-select-deselect" data-placeholder="Golongan Darah"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kelainan Fisik dan Mental</label>
								<div class="">
									<div id="_kondisi_fisik" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($kondisi_fisik);
										foreach ($kondisi_fisik as $value) {
											$count = $count - 1;
											echo '<label id="_kondisi_fisik' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('kondisi_fisik', $value, '', 'id="kondisi_fisik' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
								</div>
								<span class="help-block"></span>
							</div>
							<div id="difabel_info" class="form-group">
								<label class="control-label">Penyandang</label>
								<?php echo form_dropdown('id_difabel', $difabel, '', 'id="id_difabel" class="form-control chosen-select-deselect" data-placeholder="Jenis Kelainan Fisik dan Mental"'); ?>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</div>
				<!--End Step 1 -->
				<!--Step 2-->
				<div class="row" data-step="2" data-title="Callback on second step" id="step-2">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Pekerjaan Pokok</label>
								<select class="easyui-combotree" id="id_pekerjaan" name="id_pekerjaan" data-options="url:'<?php echo base_url(); ?>/assets/js/jquery-easyui/pekerjaan.json'" style="width:420px;"></select>
							</div>
							<!-- <div class="form-group">
									<label class="control-label">Pekerjaan Pokok</label>
			
									<span class="help-block"></span>
								</div> -->
							<div id="pekerjaan_desc_info" class="form-group">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('pekerjaan_desc', '', 'id="pekerjaan_desc" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Ada Pekerjaan Tambahan?</label>
								<div class="">
									<div id="_pekerjaan2" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($pekerjaan2);
										foreach ($pekerjaan2 as $value) {
											$count = $count - 1;
											echo '<label id="_pekerjaan2' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('pekerjaan2', $value, '', 'id="pekerjaan2' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group" id="pekerjaan2_info">
								<label class="control-label">Pekerjaan Tambahan</label>
								<?php //echo form_dropdown('id_pekerjaan2', $pekerjaan, '', 'id="id_pekerjaan2" class="form-control chosen-select-deselect" data-placeholder="Pekerjaan Tambahan"'); 
								?>
								<?php echo form_input('pekerjaan2_desc', '', 'id="pekerjaan2_desc" placeholder="Pekerjaan Tambahan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Apakah Istri/Suami bekerja?</label>
								<div class="">
									<div id="_pekerjaansi" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($pekerjaansi);
										foreach ($pekerjaansi as $value) {
											$count = $count - 1;
											echo '<label id="_pekerjaansi' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('pekerjaansi', $value, '', 'id="pekerjaansi' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
									<span class="help-block"></span>
								</div>
							</div>

							<div class="form-group" id="pekerjaansi_info">
								<label class="control-label">Pekerjaan Istri/Suami</label>
								<select class="easyui-combotree" id="id_pekerjaansi" name="id_pekerjaansi" data-options="url:'<?php echo base_url(); ?>/assets/js/jquery-easyui/pekerjaan.json'" style="width:420px;"></select>
							</div>
							<div class="form-group" id="pekerjaansi_desc_info">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('pekerjaansi_desc', '', 'id="pekerjaansi_desc" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Rata-rata Penghasilan Keluarga (Istri & Suami) dalam Sebulan</label>
								<?php echo form_dropdown('id_penghasilan', $penghasilan, '', 'id="id_penghasilan" class="form-control chosen-select-deselect" data-placeholder="Rata-rata Penghasilan Keluarga"'); ?>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="col-lg-6">
							<div id="" class="form-group">
								<label class="control-label">Jumlah Anak</label>
								<?php echo form_input('jml_anak', '', 'id="jml_anak" placeholder="" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="" class="form-group">
								<label class="control-label">Jumlah orang yang menjadi tanggungan</label>
								<?php echo form_input('tanggungan_total', '', 'id="tanggungan_total" placeholder="" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="" class="form-group">
								<label class="control-label">Status Tempat Tinggal</label>
								<?php echo form_dropdown('status_tempat_tinggal', $status_tempat_tinggal, '', 'id="status_tempat_tinggal" class="form-control chosen-select-deselect" data-placeholder="Status Tempat Tinggal"'); ?>
								<span class="help-block"></span>
							</div>
							<label class="control-label">Jenis & jumlah harta yang dimiliki</label>
							<fieldset class="group1">
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Rumah</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_rumah', '', 'id="harta_rumah" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Tanah</label>&nbsp;<em>(m<sup>2</sup>)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_tanah', '', 'id="harta_tanah" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Bangunan</label>&nbsp;<em>(buah)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_bangunan', '', 'id="harta_bangunan" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Mobil</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_mobil', '', 'id="harta_mobil" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Motor</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_motor', '', 'id="harta_motor" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Toko</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_toko', '', 'id="harta_toko" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Tabungan</label>&nbsp;<em>(Rp)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_tabungan', '', 'id="harta_tabungan" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Handphone</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_handphone', '', 'id="harta_handphone" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<!--
									<div id="" class="form-group">
										<div class="col-md-4"><label class="control-label">Lain-lain</label></div>
										<div id="harta" class="col-md-8">
											<?php
											// echo form_input('harta_lain', '', 'id="harta_lain" placeholder="" class="form-control numeric"'); 
											?>
											<span class="help-block"></span>
										</div>
									</div>
									-->
							</fieldset>


						</div>
					</div>
				</div>
				<!--End Step 2 -->
				<!--Step 3-->
				<div class="row" data-step="3" data-title="Callback on third step" id="step-3">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Alamat</label>&nbsp;<em>(Jalan/Kampung)</em>
								<textarea name="alm_jalan" placeholder="Alamat" class="form-control" style="width: 100%; height: 110px; min-height: 110px; max-height: 110px;"></textarea>
								<span class="help-block"></span>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">RT</label>
									<?php echo form_input('alm_rt', '', 'id="alm_rt" placeholder="RT" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">RW</label>
									<?php echo form_input('alm_rw', '', 'id="alm_rw" placeholder="RW" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Kodepos</label>
									<?php echo form_input('kodepos', '', 'id="kodepos" placeholder="Kodepos" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Provinsi</label>
								<?php echo form_dropdown('id_provinsi', $provinsi, '', 'id="id_provinsi" class="form-control chosen-select-deselect" data-placeholder="Provinsi"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kota/Kabupaten</label>
								<?php echo form_dropdown('id_kabkota', $kabkota, '', 'id="id_kabkota" class="form-control chosen-select-deselect" data-placeholder="Kota/Kabupaten"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kecamatan</label>
								<?php echo form_dropdown('id_kecamatan', $kecamatan, '', 'id="id_kecamatan" class="form-control chosen-select-deselect" data-placeholder="Kecamatan"'); ?>
								<?php //echo form_input('id_kecamatan', '', 'id="id_kecamatan" placeholder="Kecamatan" class="form-control capitalize"'); 
								?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Desa/Kelurahan</label>
								<?php echo form_dropdown('id_desa', $desa, '', 'id="id_desa" class="form-control chosen-select-deselect" data-placeholder="Desa/Kelurahan"'); ?>
								<?php //echo form_input('id_desa', '', 'id="id_desa" placeholder="Desa/Kekelurahan" class="form-control capitalize"'); 
								?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Nomor Telepon</label>
								<?php echo form_input('no_telp', '', 'id="no_telp" placeholder="Telepon" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>

						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Nomor Handphone</label>
								<?php echo form_input('no_hp', '', 'id="no_hp" placeholder="HP" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Pemilik Nomor Handphone</label>
								<?php echo form_input('nm_hp', '', 'id="nm_hp" placeholder="Pemilik Nomor Handphone" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<?php echo form_input('email', '', 'id="email" placeholder="Email" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<!--
								<div class="form-group">
									<label class="control-label">Facebook</label>
									<?php //echo form_input('facebook', '', 'id="facebook" placeholder="Facebook" class="form-control"'); 
									?>
									<span class="help-block"></span>
								</div>
								<div class="form-group">
									<label class="control-label">Twitter</label>
									<?php //echo form_input('twitter', '', 'id="twitter" placeholder="Twitter" class="form-control"'); 
									?>
									<span class="help-block"></span>
								</div>
								<div class="form-group">
									<label class="control-label">Sosial Media lainnya</label>
									<?php //echo form_input('sosmed', '', 'id="sosmed" placeholder="Sosial Media" class="form-control"'); 
									?>
									<span class="help-block"></span>
								</div>
								-->
							<div class="form-group">
								<label class="control-label">Jenis Identitas Pengenal</label>
								<?php echo form_dropdown('jenis_kid', $jenis_kid, '', 'id="jenis_kid" class="form-control chosen-select-deselect" data-placeholder="Jenis Kartu Identitas"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="xnomor_kid" class="form-group">
								<label class="control-label">Nomor Identitas Pengenal</label>
								<?php echo form_input('nomor_kid', '', 'id="nomor_kid" placeholder="Nomor Kartu Identitas" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Jenis Keterangan Tidak Mampu</label>
								<?php echo form_dropdown('jenis_ktm', $jenis_ktm, '', 'id="jenis_ktm" class="form-control chosen-select-deselect" data-placeholder="Jenis Ket. tidak Mampu"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="xnomor_ktm" class="form-group">
								<label class="control-label">Nomor Keterangan Tidak Mampu</label>
								<?php echo form_input('nomor_ktm', '', 'id="nomor_ktm" placeholder="Nomor Ket. tidak Mampu" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>

							<div class="form-group">
								<label class="control-label">Apakah Data Pemohon sama dengan Penerima Bantuan?</label>
								<div class="">
									<div id="_status_pemohon" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($status_pemohon);
										foreach ($status_pemohon as $value) {
											$count = $count - 1;
											echo '<label id="_status_pemohon' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('status_pemohon', $value, '', 'id="status_pemohon' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
								</div>
								<span class="help-block"></span>
							</div>

						</div>
					</div>
				</div>
				<!--End Step 3 -->
				<!--Step 1 Penerima -->
				<div class="row" data-step="1b" data-title="Click next please" id="step-1b">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Nama Lengkap</label>
								<?php echo form_input('nm_lengkapb', '', 'id="nm_lengkapb" placeholder="Nama Lengkap" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Nama Panggilan</label>
								<?php echo form_input('nm_panggilanb', '', 'id="nm_panggilanb" placeholder="Alias" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Tempat Lahir</label>
								<?php echo form_input('tmp_lahirb', '', 'id="tmp_lahirb" placeholder="Tempat Lahir" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Tanggal Lahir</label>(dd/mm/yyyy)
								<?php echo form_input('tgl_lahirb', '', 'id="tgl_lahirb" placeholder="" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Count Unit</label>
								<?php echo form_dropdown('id_count_unitb', $count_unit, '', 'id="id_count_unitb" class="form-control chosen-select-deselect" data-placeholder="Count Unit"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Jenis Kelamin</label>
								<div class="">
									<div id="_jkelb" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($jkel);
										foreach ($jkel as $value) {
											$count = $count - 1;
											echo '<label id="_jkelb' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('jkelb', $value, '', 'id="jkelb' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
								</div>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Status Perkawinan</label>
								<?php echo form_dropdown('status_perkawinanb', $status_perkawinan, '', 'id="status_perkawinanb" class="form-control chosen-select-deselect" data-placeholder="Status Perkawinan"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Pendidikan</label>
								<?php echo form_dropdown('id_pendidikanb', $pendidikan, '', 'id="id_pendidikanb" class="form-control chosen-select-deselect" data-placeholder="Pendidikan"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="pendidikan_desc_info" class="form-group">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('pendidikan_descb', '', 'id="pendidikan_descb" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Agama</label>
								<?php echo form_dropdown('id_agamab', $agama, '', 'id="id_agamab" class="form-control chosen-select-deselect" data-placeholder="Agama"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="agama_desc_info" class="form-group">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('agama_descb', '', 'id="agama_descb" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="suku_info" class="form-group">
								<label class="control-label">Suku</label>
								<?php echo form_input('sukub', '', 'id="sukub" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kewarganegaraan</label>
								<?php echo form_dropdown('kewarganegaraanb', $kewarganegaraan, '', 'id="kewarganegaraanb" class="form-control chosen-select-deselect" data-placeholder="Kewarganegaraan"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="negara_info" class="form-group">
								<label class="control-label">Negara</label>
								<?php echo form_dropdown('id_negarab', $negara, '', 'id="id_negarab" class="form-control chosen-select-deselect" data-placeholder="Negara"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Golongan Darah</label>
								<?php echo form_dropdown('id_golongan_darahb', $golongan_darah, '', 'id="id_golongan_darahb" class="form-control chosen-select-deselect" data-placeholder="Golongan Darah"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kelainan Fisik dan Mental</label>
								<div class="">
									<div id="_kondisi_fisikb" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($kondisi_fisik);
										foreach ($kondisi_fisik as $value) {
											$count = $count - 1;
											echo '<label id="_kondisi_fisikb' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('kondisi_fisikb', $value, '', 'id="kondisi_fisikb' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
								</div>
								<span class="help-block"></span>
							</div>
							<div id="difabel_info" class="form-group">
								<label class="control-label">Penyandang</label>
								<?php echo form_dropdown('id_difabelb', $difabel, '', 'id="id_difabelb" class="form-control chosen-select-deselect" data-placeholder="Jenis Kelainan Fisik dan Mental"'); ?>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</div>
				<!--End Step 1 Penerima -->
				<!-- Step 2 Penerima -->
				<div class="row" data-step="2b" data-title="Callback on second step" id="step-2b">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Pekerjaan Pokok</label>
								<select class="easyui-combotree" id="id_pekerjaanb" name="id_pekerjaanb" data-options="url:'<?php echo base_url(); ?>/assets/js/jquery-easyui/pekerjaan.json'" style="width:420px;"></select>
							</div>
							<div id="pekerjaan_desc_info" class="form-group">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('pekerjaan_descb', '', 'id="pekerjaan_descb" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Ada Pekerjaan Tambahan?</label>
								<div class="">
									<div id="_pekerjaan2b" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($pekerjaan2);
										foreach ($pekerjaan2 as $value) {
											$count = $count - 1;
											echo '<label id="_pekerjaan2b' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('pekerjaan2b', $value, '', 'id="pekerjaan2b' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group" id="pekerjaan2_info">
								<label class="control-label">Pekerjaan Tambahan</label>
								<?php //echo form_dropdown('id_pekerjaan2b', $pekerjaan, '', 'id="id_pekerjaan2b" class="form-control chosen-select-deselect" data-placeholder="Pekerjaan Tambahan"'); 
								?>
								<?php echo form_input('pekerjaan2_descb', '', 'id="pekerjaan2_descb" placeholder="Pekerjaan Tambahan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Apakah Istri/Suami bekerja?</label>
								<div class="">
									<div id="_pekerjaansib" class="btn-group" data-toggle="buttons">
										<?php
										$count = count($pekerjaansi);
										foreach ($pekerjaansi as $value) {
											$count = $count - 1;
											echo '<label id="_pekerjaansib' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('pekerjaansib', $value, '', 'id="pekerjaansib' . $count . '"') . $value;
											echo '</label>';
										}
										?>
									</div>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group" id="pekerjaansi_info">
								<label class="control-label">Pekerjaan Istri/Suami</label>
								<select class="easyui-combotree" id="id_pekerjaansib" name="id_pekerjaansib" data-options="url:'<?php echo base_url(); ?>/assets/js/jquery-easyui/pekerjaan.json'" style="width:420px;"></select>
							</div>
							<div class="form-group" id="pekerjaansi_desc_info">
								<label class="control-label">Lainnya</label>
								<?php echo form_input('pekerjaansi_descb', '', 'id="pekerjaansi_descb" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Rata-rata Penghasilan Keluarga (Istri & Suami) dalam Sebulan</label>
								<?php echo form_dropdown('id_penghasilanb', $penghasilan, '', 'id="id_penghasilanb" class="form-control chosen-select-deselect" data-placeholder="Rata-rata Penghasilan Keluarga"'); ?>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="col-lg-6">
							<div id="" class="form-group">
								<label class="control-label">Jumlah Anak</label>
								<?php echo form_input('jml_anakb', '', 'id="jml_anakb" placeholder="" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="" class="form-group">
								<label class="control-label">Jumlah orang yang menjadi tanggungan</label>
								<?php echo form_input('tanggungan_totalb', '', 'id="tanggungan_totalb" placeholder="" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="" class="form-group">
								<label class="control-label">Status Tempat Tinggal</label>
								<?php echo form_dropdown('status_tempat_tinggalb', $status_tempat_tinggal, '', 'id="status_tempat_tinggalb" class="form-control chosen-select-deselect" data-placeholder="Status Tempat Tinggal"'); ?>
								<span class="help-block"></span>
							</div>
							<label class="control-label">Jenis & jumlah harta yang dimiliki</label>
							<fieldset class="group1">
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Rumah</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_rumahb', '', 'id="harta_rumahb" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Tanah</label>&nbsp;<em>(m<sup>2</sup>)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_tanahb', '', 'id="harta_tanahb" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Bangunan</label>&nbsp;<em>(buah)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_bangunanb', '', 'id="harta_bangunanb" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Mobil</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_mobilb', '', 'id="harta_mobilb" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Motor</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_motorb', '', 'id="harta_motorb" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Toko</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_tokob', '', 'id="harta_tokob" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Tabungan</label>&nbsp;<em>(Rp)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_tabunganb', '', 'id="harta_tabunganb" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<div id="" class="form-group">
									<div class="col-md-4"><label class="control-label">Handphone</label>&nbsp;<em>(unit)</em></div>
									<div id="harta" class="col-md-8">
										<?php echo form_input('harta_handphoneb', '', 'id="harta_handphoneb" placeholder="" class="form-control numeric"'); ?>
										<span class="help-block"></span>
									</div>
								</div>
								<!--
									<div id="" class="form-group">
										<div class="col-md-4"><label class="control-label">Lain-lain</label></div>
										<div id="harta" class="col-md-8">
											<?php //echo form_input('harta_lainb', '', 'id="harta_lainb" placeholder="" class="form-control numeric"'); 
											?>
											<span class="help-block"></span>
										</div>
									</div>
									-->
							</fieldset>
						</div>
					</div>
				</div>
				<!--End Step 2 Penerima -->
				<!-- Step 3 Penerima -->
				<div class="row" data-step="3b" data-title="Callback on third step" id="step-3b">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Alamat</label>&nbsp;<em>(Jalan/Kampung)</em>
								<textarea name="alm_jalanb" placeholder="Alamat" class="form-control" style="width: 100%; height: 110px; min-height: 110px; max-height: 110px;"></textarea>
								<span class="help-block"></span>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">RT</label>
									<?php echo form_input('alm_rtb', '', 'id="alm_rtb" placeholder="RT" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">RW</label>
									<?php echo form_input('alm_rwb', '', 'id="alm_rwb" placeholder="RW" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Kodepos</label>
									<?php echo form_input('kodeposb', '', 'id="kodeposb" placeholder="Kodepos" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Provinsi</label>
								<?php echo form_dropdown('id_provinsib', $provinsi, '', 'id="id_provinsib" class="form-control chosen-select-deselect" data-placeholder="Provinsi"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kota/Kabupaten</label>
								<?php echo form_dropdown('id_kabkotab', $kabkota, '', 'id="id_kabkotab" class="form-control chosen-select-deselect" data-placeholder="Kota/Kabupaten"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Kecamatan</label>
								<?php echo form_dropdown('id_kecamatanb', $kecamatan, '', 'id="id_kecamatanb" class="form-control chosen-select-deselect" data-placeholder="Kecamatan"'); ?>
								<?php //echo form_input('id_kecamatanb', '', 'id="id_kecamatanb" placeholder="Kecamatan" class="form-control capitalize"'); 
								?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Desa/Kelurahan</label>
								<?php echo form_dropdown('id_desab', $desa, '', 'id="id_desab" class="form-control chosen-select-deselect" data-placeholder="Desa/Kelurahan"'); ?>
								<?php //echo form_input('id_desab', '', 'id="id_desab" placeholder="Desa/Kekelurahan" class="form-control capitalize"'); 
								?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Nomor Telepon</label>
								<?php echo form_input('no_telpb', '', 'id="no_telpb" placeholder="Telepon" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>

						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Nomor Handphone</label>
								<?php echo form_input('no_hpb', '', 'id="no_hpb" placeholder="HP" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Pemilik Nomor Handphone</label>
								<?php echo form_input('nm_hpb', '', 'id="nm_hpb" placeholder="Pemilik Nomor Handphone" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Email</label>
								<?php echo form_input('emailb', '', 'id="emailb" placeholder="Email" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Jenis Identitas Pengenal</label>
								<?php echo form_dropdown('jenis_kidb', $jenis_kid, '', 'id="jenis_kidb" class="form-control chosen-select-deselect" data-placeholder="Jenis Kartu Identitas"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="xnomor_kid" class="form-group">
								<label class="control-label">Nomor Identitas Pengenal</label>
								<?php echo form_input('nomor_kidb', '', 'id="nomor_kidb" placeholder="Nomor Kartu Identitas" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Jenis Keterangan Tidak Mampu</label>
								<?php echo form_dropdown('jenis_ktmb', $jenis_ktm, '', 'id="jenis_ktmb" class="form-control chosen-select-deselect" data-placeholder="Jenis Ket. tidak Mampu"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="xnomor_ktm" class="form-group">
								<label class="control-label">Nomor Keterangan Tidak Mampu</label>
								<?php echo form_input('nomor_ktmb', '', 'id="nomor_ktmb" placeholder="Nomor Ket. tidak Mampu" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>

							<div class="form-group">
								<label class="control-label">Hubungan dengan Pemohon</label>
								<?php echo form_input('hubungan_penerima', '', 'id="hubungan_penerima" placeholder="Hubungan dengan Pemohon" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>

						</div>
					</div>
				</div>
				<!--End Step 3 Penerima -->

				<!--Step 4-->
				<div class="row" data-step="4" data-title="Callback on fourth step" id="step-4">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Identitas Pengenal</label>
							</div>
							<div id="upload_kid_box" class="form-group">
								<?php echo form_upload('doc_kid[]', '', 'id="doc_kid" multiple'); ?>
								<?php echo form_hidden('form-kid', '', 'id="form-kid" class="form-control" enctype="multipart/form-data"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="preview_kid_box" class="form-group">
								<ul id="list_kid" class="list-group">
									<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Keterangan Tidak Mampu</label>
							</div>
							<div id="upload_ktm_box" class="form-group">
								<?php echo form_upload('doc_ktm[]', '', 'id="doc_ktm" multiple'); ?>
								<?php echo form_hidden('form-ktm', '', 'id="form-ktm" class="form-control" enctype="multipart/form-data"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="preview_ktm_box" class="form-group">
								<ul id="list_ktm" class="list-group">
									<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
									<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!--End Step 4 -->
				<!--Step 5-->
				<div class="row" data-step="5" data-title="Callback on fifth step" id="step-5">
					<div class="">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Jarak tempat tinggal Pemohon dari Kantor LBH</label>
								<?php echo form_dropdown('id_jarak_tempuh', $jarak_tempuh, '', 'id="id_jarak_tempuh" class="form-control chosen-select-deselect" data-placeholder="Jarak yang ditempuh"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Lama perjalanan dari tempat tinggal Pemohon ke Kantor LBH</label>
								<?php echo form_dropdown('id_waktu_tempuh', $waktu_tempuh, '', 'id="id_waktu_tempuh" class="form-control chosen-select-deselect" data-placeholder="Waktu yang ditempuh"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Apakah Pemohon pernah menjadi Klien LBH sebelumnya?</label>
								<div id="pernah_jadi_client" class="btn-group" data-toggle="buttons">
									<?php
									$count = count($pernah_jadi_client);
									foreach ($pernah_jadi_client as $value) {
										$count = $count - 1;
										echo '<label id="_pernah_jadi_client' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
										echo form_radio('pernah_jadi_client', $value, '', 'id="pernah_jadi_client' . $count . '"') . $value;
										echo '</label>';
									}
									?>
									<span class="help-block"></span>
								</div>
							</div>
							<div id="sumber_info" class="form-group">
								<label class="control-label">Darimanakah Pemohon pertama kali mengetahui LBH?</label>
								<?php echo form_dropdown('id_sumber_info', $sumber_info, '', 'id="id_sumber_info" class="form-control chosen-select-deselect" data-placeholder="Sumber Informasi"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="sumber_info_desc_info" class="form-group">
								<label class="control-label">Sumber Lainnya</label>
								<?php echo form_input('sumber_info_desc', '', 'id="sumber_info_desc" placeholder="Sebutkan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">Adakah yang menganjurkan Pemohon untuk datang ke LBH?</label>
								<div id="_rekomendasi_lbh" class="btn-group" data-toggle="buttons">
									<?php
									$count = count($rekomendasi_lbh);
									foreach ($rekomendasi_lbh as $value) {
										$count = $count - 1;
										echo '<label id="_rekomendasi_lbh' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
										echo form_radio('rekomendasi_lbh', $value, '', 'id="rekomendasi_lbh' . $count . '"') . $value;
										echo '</label>';
									}
									?>
								</div>
								<span class="help-block"></span>
							</div>

							<div id="" class="form-group">
								<label class="control-label">Nama</label>
								<?php echo form_input('nm_rekomendasi', '', 'id="nm_rekomendasi" placeholder="Nama" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
							<div id="" class="form-group">
								<label class="control-label">Alamat</label>
								<textarea name="alm_rekomendasi" placeholder="Alamat" class="form-control" style="width: 100%; height: 110px; min-height: 110px; max-height: 110px;"></textarea>
								<span class="help-block"></span>
							</div>
							<div id="" class="form-group">
								<label class="control-label">Pekerjaan</label>
								<?php echo form_input('pekerjaan_rekomendasi', '', 'id="pekerjaan_rekomendasi" placeholder="Pekerjaan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</div>
				<!--End Step 5 -->
				<!--Step 6-->
				<div class="row" data-step="5" data-title="Callback on fifth step" id="step-6">
					<div class="">
						<div class="col-lg-12">
							<div class="form-group" id="uraian_singkat_box">
								<label class="control-label">Kronologi (Uraian Singkat):</label>&nbsp;<em>(max: 1800 character)</em>
								<textarea name="uraian_singkat" id="uraian_singkat" placeholder="Uraian Singkat" class="form-control" style="width: 100%; height: 300px; min-height: 200px;"></textarea>
								<span class="help-block"></span>
							</div>

							<!--
								<div class="form-group" id="kronologi_kasus_box">
									<label class="control-label">Kronologi (Uraian Lengkap):</label>&nbsp;<em></em>
									<textarea name="kronologi_kasus" id="kronologi_kasus" placeholder="Uraian Lengkap" class="form-control" style="width: 100%; height: 200px; min-height: 200px;"></textarea>
									<span class="help-block"></span>
								</div>
								-->

							<div class="form-group">
								<label class="control-label">Apakah masalah/kasus tersebut pernah dibawa atau ditangani pihak yang lain?</label>&nbsp;
								<div id="penanganan_pihak_lain" class="btn-group" data-toggle="buttons">
									<?php
									$count = count($penanganan_pihak_lain);
									foreach ($penanganan_pihak_lain as $value) {
										$count = $count - 1;
										echo '<label id="_penanganan_pihak_lain' . $count . '" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
										echo form_radio('penanganan_pihak_lain', $value, '', 'id="penanganan_pihak_lain' . $count . '"') . $value;
										echo '</label>';
									}
									?>
								</div>
								<span class="help-block"></span>
							</div>

							<div class="form-group" id="tahap_penanganan_pihak_lain_box">
								<label class="control-label">Sampai dimanakah penanganan masalah/kasus tersebut? </label>
								<?php echo form_dropdown('tahap_penanganan_pihak_lain', $tahap_penanganan_pihak_lain, '', 'id="tahap_penanganan_pihak_lain" class="form-control chosen-select-deselect" data-placeholder="Tahap penanganan pihak lain"'); ?>
								<span class="help-block"></span>
							</div>
							<div class="form-group" id="desc_tahap_penanganan_pihak_lain_box">
								<label class="control-label">Uraikan sejauh mana hasil penanganan malasah/kasus tersebut</label>
								<textarea name="desc_tahap_penanganan_pihak_lain" placeholder="Uraian singkat tahap penanganan tersebut" class="form-control" style="width: 100%; height: 100px; min-height: 100px;"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
					</div>
				</div>
				<!--End Step 6 -->

				<?php echo form_close(); ?>
			</div>

			<div class="modal-footer">
				<!--Step 1-->
				<button type="button" id="btn-next1" onclick="next1()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 2-->
				<button type="button" id="btn-prev2" onclick="prev2()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next2" onclick="next2()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 3-->
				<button type="button" id="btn-prev3" onclick="prev3()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next3" onclick="next3()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 1 Penerima -->
				<button type="button" id="btn-prev1b" onclick="prev1b()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next1b" onclick="next1b()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 2 Penerima -->
				<button type="button" id="btn-prev2b" onclick="prev2b()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next2b" onclick="next2b()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 3 Penerima -->
				<button type="button" id="btn-prev3b" onclick="prev3b()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next3b" onclick="next3b()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 4-->
				<button type="button" id="btn-prev4" onclick="prev4()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next4" onclick="next4()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 5-->
				<button type="button" id="btn-prev5" onclick="prev5()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next5" onclick="next5()" class="btn btn-primary hide">Lanjut</button>
				<!--Step 6-->
				<button type="button" id="btn-prev6" onclick="prev6()" class="btn btn-warning hide">Kembali</button>
				<button type="button" id="btn-next6" onclick="next6()" class="btn btn-primary hide">Ajukan Permohanan</button>
				<!--
				<button type="button" class="btn btn-default js-btn-step pull-left" data-orientation="cancel" data-dismiss="modal"></button>
                <button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
                <button type="button" class="btn btn-success js-btn-step" data-orientation="next"></button>
				-->
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script type="text/javascript">

</script>
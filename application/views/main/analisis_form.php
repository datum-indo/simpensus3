<!-- Bootstrap modal -->
<style>
	fieldset.group1 {
		border: 1px groove #ddd !important;
		padding: 1em 1em 0 1em !important;
		margin: 0 0 0.5em 0 !important;
		-webkit-box-shadow: 0px 0px 0px 0px #000;
		box-shadow: 0px 0px 0px 0px #000;
	}

	fieldset.group2 {
		border: 1px groove #ddd !important;
		padding: 1em 0 0 0 !important;
		margin: 0 0 0.5em 0 !important;
		-webkit-box-shadow: 0px 0px 0px 0px #000;
		box-shadow: 0px 0px 0px 0px #000;
	}
</style>
<div class="modal fade" id="form-analisis" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>

			<div class="modal-body">
				<?php echo form_open('#', 'id="formAnalisis" class="" enctype="multipart/form-data"'); ?>
				<?php echo form_hidden('id_analisis', ''); ?>
				<div class="form-body">
					<div class="row">
						<div class="">
							<div class="col-lg-12">

							</div>
						</div>
					</div>
					<div class="row">
						<div class="">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="control-label">Nomor Permohonan: </label>
									<?php echo form_dropdown('id_permohonan', $permohonan, '', 'id="id_permohonan" class="form-control chosen-select-deselect" data-placeholder="Nomor Permohonan"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Bentuk Kasus: </label>
									<?php echo form_dropdown('bentuk_kasus', $bentuk_kasus, '', 'id="bentuk_kasus" class="form-control chosen-select-deselect" data-placeholder="Bentuk Kasus"'); ?>
									<span class="help-block"></span>
								</div>

								<?php //echo form_hidden('sifat_kasus', ''); 
								?>
								<div class="form-group" id="sifat_kasus_box">
									<label class="control-label">Sifat Kasus: </label>
									<?php echo form_dropdown('sifat_kasus', $sifat_kasus, '', 'id="sifat_kasus" class="form-control chosen-select-deselect" data-placeholder="Sifat Kasus"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group" id="id_issue_ham_box">
									<label class="control-label">Issue HAM Pokok: </label>
									<?php echo form_dropdown('id_issue_ham', $issue_ham_utama, '', 'id="id_issue_ham" class="form-control chosen-select-deselect" data-placeholder="Issue HAM Pokok"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group" id="issue_ham_box">
									<label class="control-label">Issue HAM Tambahan: </label>
									<?php echo form_dropdown('issue_ham[]', $issue_ham, '', 'id="issue_ham" class="form-control chosen-select-deselect" multiple data-placeholder="Issue HAM Tambahan"'); ?>
									<span class="help-block"></span>
								</div>
								<div class="form-group" id="id_hak_terdampak_box">
									<label class="control-label">Hak Terdampak</label>
									<input class="easyui-combotree" id="id_hak_terdampak" name="id_hak_terdampak" data-options="url:'<?php echo base_url(); ?>/assets/js/jquery-easyui/hakterdampak.json',method:'get',multiple:true,cascadeCheck:false" style="width:420px;">
								</div>

								<div class="" style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;">
									<label class="control-label">Waktu & Lokasi Kejadian Peristiwa</label>
								</div>

								<div class="form-group">
									<label class="control-label">Tanggal: </label>
									<?php echo form_input('tgl_kejadian', '', 'id="tgl_kejadian" placeholder="" class="form-control"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Provinsi: </label>
									<?php echo form_dropdown('id_provinsi', $provinsi, '', 'id="id_provinsi" class="form-control chosen-select-deselect" data-placeholder="Provinsi"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Kabupaten/Kota: </label>
									<?php echo form_dropdown('id_kabkota', $kabkota, '', 'id="id_kabkota" class="form-control chosen-select-deselect" data-placeholder="Kota/Kabupaten"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="" style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;"></div>

								<div class="form-group" id="kategori_korban_box">
									<label class="control-label">Kategori Korban: </label>
									<?php echo form_dropdown('id_kategori_korban', $kategori_korban, '', 'id="id_kategori_korban" class="form-control chosen-select-deselect" data-placeholder="Kategori Korban"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group" id="kategori_pelaku_box">
									<label class="control-label">Kategori Pelaku: </label>
									<?php echo form_dropdown('id_kategori_pelaku', $kategori_pelaku, '', 'id="id_kategori_pelaku" class="form-control chosen-select-deselect" data-placeholder="Kategori Pelaku"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group" id="id_jenis_pelaku_box">
									<label class="control-label">Jenis Pelaku</label>
									<input class="easyui-combotree" id="id_jenis_pelaku" name="id_jenis_pelaku" data-options="url:'<?php echo base_url(); ?>/assets/js/jquery-easyui/jenispelaku.json',method:'get',multiple:true,cascadeCheck:false" style="width:420px;">
								</div>

								<div class="form-group">
									<label class="control-label">Rata-rata penghasilan kelompok korban: </label>
									<?php echo form_dropdown('id_penghasilan', $penghasilan, '', 'id="id_penghasilan" class="form-control chosen-select-deselect" data-placeholder="Rata-rata Penghasilan"'); ?>
									<span class="help-block"></span>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="" style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;">
									<label class="control-label">Jumlah Penerima Bantuan</label>
								</div>

								<div class="form-group">
									<label class="control-label">Laki-laki Dewasa: </label>
									<?php echo form_input('lk_dewasa', '', 'id="lk_dewasa" placeholder="Laki-laki Dewasa" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Perempuan Dewasa: </label>
									<?php echo form_input('pr_dewasa', '', 'id="pr_dewasa" placeholder="Perempuan Dewasa" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Anak Laki-laki: </label>
									<?php echo form_input('lk_anak', '', 'id="lk_anak" placeholder="Anak Laki-laki" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Anak Perempuan: </label>
									<?php echo form_input('pr_anak', '', 'id="pr_anak" placeholder="Anak Perempuan" class="form-control numeric"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Total Penerima: </label>
									<?php echo form_input('total_penerima', '', 'id="total_penerima" placeholder="Total Penerima" class="form-control"'); ?>
									<span class="help-block"></span>
								</div>

								<div class="" style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;"></div>

								<div class="form-group">
									<label class="control-label">Jenis Peradilan</label>
									<select class="easyui-combotree" id="id_jenis_peradilan" name="id_jenis_peradilan" data-options= "url:'<?php echo base_url(); ?>/assets/js/jquery-easyui/peradilan.json'" style="width:420px;"></select>
								</div>
						
						

								<div class="form-group">
									<label class="control-label">Undang-undang dan Pasal yang digunakan oleh LBH: </label>
									<textarea name="uu_lbh" placeholder="Nama perundang-undangan dan Pasal yang digunakan oleh LBH" class="form-control" style="width: 100%; height: 80px; min-height: 80px; max-height: 80px;"></textarea>
									<span class="help-block"></span>
								</div>

								<div class="form-group">
									<label class="control-label">Undang-undang dan Pasal yang digunakan oleh Pihak Lawan: </label>
									<textarea name="uu_lawan" placeholder="Nama perundang-undangan dan Pasal yang digunakan oleh Lawan" class="form-control" style="width: 100%; height: 80px; min-height: 80px; max-height: 80px;"></textarea>
									<span class="help-block"></span>
								</div>

								<div class="form-group" id="keterangan_box">
									<label class="control-label">Catatan: </label><br />
									<textarea name="keterangan" placeholder="Catatan" class="form-control" style="width: 100%; height: 90px; min-height: 90px; max-height: 90px;"></textarea>
								</div>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="">
							<div class="col-lg-12">

							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>



			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-danger">Save</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script type="text/javascript">

</script>
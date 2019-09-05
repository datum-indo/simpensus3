<!-- Bootstrap modal -->
<style>
fieldset.group1 {
	border: 1px 0 1px 0 #ddd !important;
	padding: 0 0 0 0 !important;
    margin: 0 0 0.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div class="modal fade" id="form-analisis" role="dialog">
    <div class="modal-dialog">
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
						<div class="form-group">
                            <label class="control-label">Nomor Permohonan: </label>
							<?php echo form_dropdown('id_permohonan', $permohonan, '', 'id="id_permohonan" class="form-control chosen-select-deselect" data-placeholder="Nomor Permohonan"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<?php echo form_hidden('sifat_kasus', ''); ?>	
						
						<div class="form-group" id="issue_ham_box">
                            <label class="control-label">Issue HAM: </label>
							<?php echo form_dropdown('issue_ham[]', $issue_ham, '', 'id="issue_ham" class="form-control chosen-select-deselect" multiple data-placeholder="Issue HAM"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="nama_kasus_box">
                            <label class="control-label">Kasus: </label>
							<?php echo form_dropdown('id_nama_kasus', $nama_kasus, '', 'id="id_nama_kasus" class="form-control chosen-select-deselect" data-placeholder="Kasus"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group">
                            <label class="control-label">Bentuk Kasus: </label>
							<?php echo form_dropdown('bentuk_kasus', $bentuk_kasus, '', 'id="bentuk_kasus" class="form-control chosen-select-deselect" data-placeholder="Bentuk Kasus"'); ?>
                            <span class="help-block"></span>
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
						
						
						<div class="form-group">
							<label class="control-label">Nama perundang-undangan dan Pasal yang digunakan oleh LBH: </label>
							<textarea name="uu_lbh" placeholder="Nama perundang-undangan dan Pasal yang digunakan oleh LBH" class="form-control" style="width: 100%; height: 50px; min-height: 50px;"></textarea>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
							<label class="control-label">Nama perundang-undangan dan Pasal yang digunakan oleh Pihak Lawan: </label>
							<textarea name="uu_lawan" placeholder="Nama perundang-undangan dan Pasal yang digunakan oleh Lawan" class="form-control" style="width: 100%; height: 50px; min-height: 50px;"></textarea>
							<span class="help-block"></span>
						</div>
						
						
							<div class="form-group">
								<label class="control-label">Laki-laki Dewasa: </label>
								<?php echo form_input('lk_dewasa', '', 'id="lk_dewasa" placeholder="Laki-laki Dewasa" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							
							<div class="form-group">
								<label class="control-label">Perempuan Dewasa: </label>
								<?php echo form_input('pr_dewasa', '', 'id="pr_dewasa" placeholder="Perempuan Dewasa" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							
							<div class="form-group">
								<label class="control-label">Anak Laki-laki: </label>
								<?php echo form_input('lk_anak', '', 'id="lk_anak" placeholder="Anak Laki-laki" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							
							<div class="form-group">
								<label class="control-label">Anak Perempuan: </label>
								<?php echo form_input('pr_anak', '', 'id="pr_anak" placeholder="Anak Perempuan" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
							
							<div class="form-group">
								<label class="control-label">Total Penerima: </label>
								<?php echo form_input('total_penerima', '', 'id="total_penerima" placeholder="Total Penerima" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
						
												
						<div class="form-group">
                            <label class="control-label">Rata-rata penghasilan kelompok: </label>
							<?php echo form_dropdown('id_penghasilan', $penghasilan, '', 'id="id_penghasilan" class="form-control chosen-select-deselect" data-placeholder="Rata-rata Penghasilan"'); ?>
                            <span class="help-block"></span>
                        </div>
						
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
						
						<div class="form-group" id="keterangan_box">
							<label class="control-label">Catatan: </label><br/>
							<textarea name="keterangan" placeholder="Catatan" class="form-control" style="width: 100%; height: 100px; min-height: 100px;"></textarea>
						</div>
					</div>
                <?php echo form_close();?>	
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
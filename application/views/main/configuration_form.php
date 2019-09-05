<!-- Bootstrap modal -->
<div class="modal fade" id="form-setting" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formSetting" class="form-vertical" enctype="multipart/form-data"'); ?>
					<div class="form-body">
						<div class="form-group">
                            <label class="control-label">Kode Kantor</label>
							<?php echo form_input('kode_cabang', '', 'id="kode_cabang" placeholder="Kode Cabang" class="form-control"'); ?>
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
                            <label class="control-label">Alamat Kantor</label>
							<textarea name="alamat_cabang" placeholder="Alamat" class="form-control" style="width: 100%; height: 110px; min-height: 110px; max-height: 110px;" ></textarea>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Alamat Lengkap</label>
							<textarea name="alamat_lengkap" placeholder="Alamat Lengkap" class="form-control" style="width: 100%; height: 110px; min-height: 110px; max-height: 110px;" ></textarea>
							<span class="help-block"></span>
						</div>
												
						<div class="form-group">
                            <label class="control-label">Kodepos</label>
							<?php echo form_input('kodepos', '', 'id="kodepos" placeholder="Kodepos" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Telepon</label>
							<?php echo form_input('no_telp', '', 'id="no_telp" placeholder="Telepon" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Fax</label>
							<?php echo form_input('no_fax', '', 'id="no_fax" placeholder="Fax" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Website</label>
							<?php echo form_input('website', '', 'id="website" placeholder="Website" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Email</label>
							<?php echo form_input('email', '', 'id="email" placeholder="Email" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Kode Permohonan</label>
							<?php echo form_input('initial_permohonan', '', 'id="initial_permohonan" placeholder="Initial Permohonan" class="form-control"'); ?>
							<span class="help-block"></span>
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
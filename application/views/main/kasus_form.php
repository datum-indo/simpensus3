<!-- Bootstrap modal -->
<div class="modal fade" id="form-kasus" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formKasus" class="form-vertical" enctype="multipart/form-data"'); ?>
					<div class="form-body">
						<?php echo form_hidden('id_nama_kasus', ''); ?>	
						
						<div class="form-group">
                            <label class="control-label">Kasus</label>
							<?php echo form_input('nama_kasus', '', 'id="nama_kasus" placeholder="Kasus" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Jenis Kasus: </label>
							<?php echo form_dropdown('id_jenis_kasus', $jenis_kasus, '', 'id="id_jenis_kasus" class="form-control chosen-select-deselect" data-placeholder="Jenis Kasus"'); ?>
							<span class="help-block"></span>
                        </div>
						
						<div class="form-group">
                            <label class="control-label">Nomor Urut</label>
							<?php echo form_input('no_urut', '', 'id="no_urut" placeholder="Nomor Urut" class="form-control numeric" maxlength="4"'); ?>
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
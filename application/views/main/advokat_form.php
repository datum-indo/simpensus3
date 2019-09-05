<!-- Bootstrap modal -->
<div class="modal fade" id="form-advokat" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formAdvokat" class="form-vertical" enctype="multipart/form-data"'); ?>
					<div class="form-body">
						<?php echo form_hidden('id_advokat', ''); ?>	
						
						<div class="form-group">
                            <label class="control-label">Nama Advokat</label>
							<?php echo form_input('nama_advokat', '', 'id="nama_advokat" placeholder="Nama Advokat" class="form-control capitalize"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Alamat</label>
							<textarea name="alamat_advokat" placeholder="Alamat" class="form-control" style="width: 100%; height: 100px; min-height: 100px; max-height: 100px;"></textarea>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Telepon</label>
							<?php echo form_input('telp_advokat', '', 'id="telp_advokat" placeholder="Telepon" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Fax</label>
							<?php echo form_input('fax_advokat', '', 'id="fax_advokat" placeholder="Fax" class="form-control"'); ?>
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
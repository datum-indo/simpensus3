<!-- Bootstrap modal -->
<div class="modal fade" id="form-agama" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formAgama" class="form-vertical" enctype="multipart/form-data"'); ?>
					<div class="form-body">
						<?php echo form_hidden('id_agama', ''); ?>						
						<div class="form-group">
                            <label class="control-label">Agama</label>
							<?php echo form_input('nm_agama', '', 'id="nm_agama" placeholder="Agama" class="form-control"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Nomor Urut</label>
							<?php echo form_input('no_urut', '', 'id="no_urut" placeholder="Nomor Urut" class="form-control numeric" maxlength="3"'); ?>
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
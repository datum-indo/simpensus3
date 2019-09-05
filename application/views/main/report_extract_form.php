<!-- Bootstrap modal -->
<div class="modal fade" id="form-extract" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('report/get_extract_all_data', 'id="form_extract" class="form-vertical" enctype="multipart/form-data"'); ?>
					<div class="form-body">
						<div class="form-group">
                            <label class="control-label">Periode</label>
							<?php echo form_dropdown('extract_periode', $extract_periode, '', 'id="extract_periode" class="form-control chosen-select-deselect" data-placeholder="Periode"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group">
                            <label class="control-label">Tahun</label>
							<?php echo form_input('extract_tahun', '', 'id="extract_tahun" placeholder="Tahun" class="form-control numeric" maxlength="4"'); ?>
							<span class="help-block"></span>
						</div>
                    </div>
                <?php echo form_close();?>	
            </div>
			
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="submit_extract()" class="btn btn-danger">Generate & Download</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
<!-- Bootstrap modal -->
<div class="modal fade" id="form-cross" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<?php echo form_open('report/get_data_by_crosstab', 'id="form_cross" class="" enctype="multipart/form-data"'); ?>
					<?php //echo form_open('#', 'id="form_cross" class="" enctype="multipart/form-data"'); ?>
						<div class=""> 
							<div class="col-lg-6">
								<div class="form-group" id="cross_type">
									<label class="control-label">First Variable</label>
									<?php echo form_dropdown('cross_type1', $cross_type, '', 'id="cross_type1" class="form-control chosen-select-deselect" data-placeholder="First Variable"'); ?>
									<span class="help-block"></span>
								</div>
								
								<div class="form-group">
									<label class="control-label">Second Variable</label>
									<?php echo form_dropdown('cross_type2', $cross_type, '', 'id="cross_type2" class="form-control chosen-select-deselect" data-placeholder="Second Variable"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					
						<div class="">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="control-label">Periode</label>
									<?php echo form_dropdown('cross_periode', $extract_periode, '', 'id="cross_periode" class="form-control chosen-select-deselect" data-placeholder="Periode"'); ?>
									<span class="help-block"></span>
								</div>
								
								<div class="form-group">
									<label class="control-label">Tahun</label>
									<?php echo form_input('cross_tahun', '', 'id="cross_tahun" placeholder="Tahun" class="form-control numeric" maxlength="4"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					<?php echo form_close();?>
				</div>
            </div>
			
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="submit_cross()" class="btn btn-danger">Generate</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
<!-- Bootstrap modal -->
<div class="modal fade" id="form-kronologi" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
			<div class="modal-body">
				<?php echo form_open('#', 'id="formKronologi" class="" enctype="multipart/form-data"'); ?>
				<?php echo form_hidden('id_permohonan_kronologi', ''); ?>
					<!--Step 6--> 
					<div class="row" id="kronologi">
						<div class="">
							<div class="col-lg-12">
								<div class="form-group" id="kronologi_kasus_box">
									<label class="control-label">Kronologi (Uraian Lengkap):</label>&nbsp;<em></em>
									<textarea name="kronologi_kasus" id="kronologi_kasus" placeholder="Uraian Lengkap" class="form-control" style="width: 100%; height: 400px; min-height: 200px;"></textarea>
									<span class="help-block"></span>
								</div>
							</div>		
						</div>
					</div>	<!--End Step 6 -->
				
				<?php echo form_close();?>	
            </div>
			
            <div class="modal-footer">
				<button type="button" id="btn-save_kronologi" onclick="update_kronologi()" class="btn btn-primary">Update Kronologi</button>
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
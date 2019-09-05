<!-- Bootstrap modal -->
<div class="modal fade" id="form-upload_progress" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formUpload_Progress" class="" enctype="multipart/form-data"'); ?>
					<?php echo form_hidden('id_progressx', ''); ?>	
                    <div class="form-body">
						<div class="form-group" id="jenis_dokumenx_box">
                            <label class="control-label">Jenis Dokumen: </label>
							<?php echo form_dropdown('id_jenis_dokumenx', $jenis_dokumen, '', 'id="id_jenis_dokumenx" class="form-control chosen-select-deselect" data-placeholder="Jenis Dokumen Hukum"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="upload_lampiranx_box">
                            <label class="control-label">Dokumen </label>
							<?php echo form_upload('lampiranx[]', '', 'id="lampiranx" multiple'); ?>
							<?php echo form_hidden('form-lampiranx', '', 'id="form-lampiranx" class="form-control" enctype="multipart/form-data"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="list_lampiranx_box">
                            <ul id="list_lampiranx" class="list-group">
								<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
							</ul>
                        </div>
						
                    </div>
                <?php echo form_close();?>	
            </div>
			
            <div class="modal-footer">
				<button type="button" id="btnSave" onclick="save_upload()" class="btn btn-danger">Save</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
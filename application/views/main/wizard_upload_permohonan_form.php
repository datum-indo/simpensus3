<!-- Bootstrap modal -->
<div class="modal fade" id="form-upload_permohonan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formUpload_Permohonan" class="" enctype="multipart/form-data"'); ?>
					<?php echo form_hidden('id_permohonanx', ''); ?>	
                    <div class="form-body">
						
						<div id="upload_kid_box" class="form-group">
							<label class="control-label">Lampiran Identitas Pengenal</label>
							<?php echo form_upload('doc_kidx[]', '', 'id="doc_kidx" multiple'); ?>
							<?php echo form_hidden('form-kidx', '', 'id="form-kidx" class="form-control" enctype="multipart/form-data"'); ?>
							<span class="help-block"></span>
						</div>
						<div id="preview_kid_box" class="form-group">
							<ul id="list_kidx" class="list-group">
								<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
							</ul>
						</div>
								
						<div id="upload_ktm_box" class="form-group">
							<label class="control-label">Lampiran Keterangan Tidak Mampu</label>
							<?php echo form_upload('doc_ktmx[]', '', 'id="doc_ktmx" multiple'); ?>
							<?php echo form_hidden('form-ktmx', '', 'id="form-ktmx" class="form-control" enctype="multipart/form-data"'); ?>
							<span class="help-block"></span>
						</div>
						<div id="preview_ktm_box" class="form-group">
							<ul id="list_ktmx" class="list-group">
								<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
							</ul>
						</div>
								
						<div class="form-group" id="upload_lampiran_box">
                            <label class="control-label">Lampiran Dokumen Permohonan</label>
							<?php echo form_upload('lampiran[]', '', 'id="lampiran" multiple'); ?>
							<?php echo form_hidden('form-lampiran', '', 'id="form-lampiran" class="form-control" enctype="multipart/form-data"'); ?>
                            <span class="help-block"></span>
                        </div>
						<div class="form-group" id="list_lampiran_box">
                            <ul id="list_lampiran" class="list-group">
								<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
							</ul>
                        </div>
						
						<div class="form-group">
                            <label class="control-label">Status: </label>
							<?php echo form_dropdown('status_dokumen', $status_dokumen, '', 'id="status_dokumen" class="form-control chosen-select-deselect" data-placeholder="Status"'); ?>
                            <span class="help-block"></span>
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
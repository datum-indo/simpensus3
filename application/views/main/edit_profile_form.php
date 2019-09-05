<!-- Bootstrap modal -->
<div class="modal fade" id="form-edit_profile" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="form_edit_profile" class="form-horizontal" enctype="multipart/form-data"'); ?>
					<?php echo form_hidden('xid_user', ''); ?>	
                    <div class="form-body">
						<div class="form-group">
                            <label class="control-label col-md-3">Username</label>
							<div class="col-md-9">
								<?php echo form_input('xusername', '', 'id="xusername" placeholder="Username" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Old Password</label>
							<div class="col-md-9">
								<?php echo form_password('old_password', '', 'id="old_password" placeholder="Old Password" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">New Password</label>
							<div class="col-md-9">
								<?php echo form_password('new_password', '', 'id="new_password" placeholder="New Password" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Confirm Password</label>
							<div class="col-md-9">
								<?php echo form_password('con_password', '', 'id="con_password" placeholder="Confirm Password" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
							<div class="col-md-9">
								<?php echo form_input('xfullname', '', 'id="xfullname" placeholder="Nama Lengkap" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
							<div class="col-md-9">
								<?php echo form_input('xdesignation', '', 'id="xdesignation" placeholder="Jabatan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Tempat Lahir</label>
							<div class="col-md-9">
								<?php echo form_input('xtmp_lahir', '', 'id="xtmp_lahir" placeholder="Tempat Lahir" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir</label>
							<div class="col-md-9">
								<?php echo form_input('xtgl_lahir', '', 'id="xtgl_lahir" placeholder="" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Handphone</label>
							<div class="col-md-9">
								<?php echo form_input('xno_hp', '', 'id="xno_hp" placeholder="Handphone" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Email</label>
							<div class="col-md-9">
								<?php echo form_input('xemail', '', 'id="xemail" placeholder="Email Address" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group" id="pictures">
                            <label class="control-label col-md-3">Pictures</label>
							<div class="col-md-9">
								
								<div onclick="document.getElementById('image_upload').click(); return false" class="widget-user-image" id="xuser_images">
									<img class="img-circle" src="<?php echo base_url(); ?>media/user_pictures/default_avatar.png" alt="User Image">
								</div>
								
								<?php echo form_upload('image_upload', '', 'id="image_upload" style="visibility: hidden;"'); ?>
								<?php echo form_hidden('xuser_pictures', '', 'id="xuser_pictures"'); ?>	
							</div>	
                        </div>
						
						
                    </div>
                <?php echo form_close();?>	
            </div>
			
            
			
            <div class="modal-footer">
				<button type="button" id="btnSave" onclick="save_profile()" class="btn btn-danger">Save</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
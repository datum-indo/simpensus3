<!-- Bootstrap modal -->
<div class="modal fade" id="form-account" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formAccount" class="form-horizontal" enctype="multipart/form-data"'); ?>
					<?php echo form_hidden('id_user', ''); ?>	
                    <div class="form-body">
						<div class="form-group">
                            <label class="control-label col-md-3">Username</label>
							<div class="col-md-9">
								<?php echo form_input('username', '', 'id="username" placeholder="Username" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Password</label>
							<div class="col-md-9">
								<?php echo form_password('password', '', 'id="password" placeholder="Password" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
							<div class="col-md-9">
								<?php echo form_input('fullname', '', 'id="fullname" placeholder="Nama Lengkap" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
							<div class="col-md-9">
								<?php echo form_input('designation', '', 'id="designation" placeholder="Jabatan" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Tanggal Masuk</label>
							<div class="col-md-9">
								<?php echo form_input('tgl_signin', '', 'id="tgl_signin" placeholder="" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Tempat Lahir</label>
							<div class="col-md-9">
								<?php echo form_input('tmp_lahir', '', 'id="tmp_lahir" placeholder="Tempat Lahir" class="form-control capitalize"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir</label>
							<div class="col-md-9">
								<?php echo form_input('tgl_lahir', '', 'id="tgl_lahir" placeholder="" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
							<label class="control-label  col-md-3">Jenis Kelamin</label>
							<div class="col-md-9">
								<div id="_jkel" class="btn-group" data-toggle="buttons">
									<?php
										$count = count($jkel);
										foreach($jkel as $value)
										{
											$count = $count-1;
											echo '<label id="_jkel'.$count.'" class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">';
											echo form_radio('jkel', $value, '','id="jkel'.$count.'"'). $value;
											echo '</label>';	
										}
									?>
								</div>
							</div>
							<span class="help-block"></span>
						</div>
								
						<div class="form-group">
                            <label class="control-label col-md-3">Handphone</label>
							<div class="col-md-9">
								<?php echo form_input('no_hp', '', 'id="no_hp" placeholder="Handphone" class="form-control numeric"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Email</label>
							<div class="col-md-9">
								<?php echo form_input('email', '', 'id="Email" placeholder="Email Address" class="form-control"'); ?>
								<span class="help-block"></span>
							</div>	
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Pictures</label>
							<div class="col-md-9">
								<div class="widget-user-image" id="user_images">
									<img class="img-circle" src="<?php echo base_url(); ?>media/user_pictures/default_avatar.png" alt="User Image">
								</div>
								<?php echo form_hidden('user_pictures', ''); ?>	
							</div>	
                        </div>
						
						<div class="form-group" id="">
                            <label class="control-label col-md-3">Role</label>
							<div class="col-md-9">
								<?php echo form_dropdown('id_role', $role, '', 'id="id_role" class="form-control chosen-select-deselect" data-placeholder="Role"'); ?>
								<span class="help-block"></span>
							</div>
                        </div>
						
						<div class="form-group" id="">
                            <label class="control-label col-md-3">Status</label>
							<div class="col-md-9">
								<?php echo form_dropdown('user_status', $user_status, '', 'id="user_status" class="form-control chosen-select-deselect" data-placeholder="Status"'); ?>
								<span class="help-block"></span>
							</div>
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
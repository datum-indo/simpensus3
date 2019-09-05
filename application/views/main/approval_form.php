<!-- Bootstrap modal -->
<div class="modal fade" id="form-approval" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formApproval" class="form-vertical" enctype="multipart/form-data"'); ?>
					<?php echo form_hidden('id_approval', ''); ?>	
                    <div class="form-body">
						<div class="form-group">
                            <label class="control-label">Nomor Permohonan: </label>
							<?php echo form_dropdown('id_permohonan', $permohonan, '', 'id="id_permohonan" class="form-control chosen-select-deselect" data-placeholder="Nomor Permohonan"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group">
                            <label class="control-label">Status: </label>
							<?php echo form_dropdown('status_approval', $status_approval, '', 'id="status_approval" class="form-control chosen-select-deselect" data-placeholder="Status"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="jenis_kasus_box">
                            <label class="control-label">Jenis Kasus: </label>
							<?php echo form_dropdown('id_jenis_kasus', $jenis_kasus, '', 'id="id_jenis_kasus" class="form-control chosen-select-deselect" data-placeholder="Jenis Jenis Kasus"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="nama_kasus_box">
							<label class="control-label">Kasus: </label>
							<?php echo form_dropdown('id_nama_kasus', $nama_kasus, '', 'id="id_nama_kasus" class="form-control chosen-select-deselect" data-placeholder="Kasus"'); ?>
							<span class="help-block"></span>
						</div>
						
						<div class="form-group" id="posisi_hukum_box">
                            <label class="control-label">Posisi Hukum: </label>
							<?php echo form_dropdown('id_posisi_hukum', $posisi_hukum, '', 'id="id_posisi_hukum" class="form-control chosen-select-deselect" data-placeholder="Posisi Hukum"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="tindakan_box">
                            <label class="control-label">Tindakan: </label>
							<?php echo form_dropdown('id_tindakan', $tindakan, '', 'id="id_tindakan" class="form-control chosen-select-deselect" data-placeholder="Tindakan"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="analis_box">
                            <label class="control-label">Pembela Umum: </label>
							<?php echo form_dropdown('id_analis', $analis, '', 'id="id_analis" class="form-control chosen-select-deselect" data-placeholder="Pembela Umum"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="asisten_box">
                            <label class="control-label">Asisten Pembela Umum: </label>
							<?php echo form_dropdown('id_asisten', $asisten, '', 'id="id_asisten" class="form-control chosen-select-deselect" data-placeholder="Asisten Pembela Umum"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="alasan_penolakan_box">
							<label class="control-label">Alasan Penolakan: </label><br/>
							<?php echo form_dropdown('alasan_penolakan[]', $alasan_penolakan, '', 'id="alasan_penolakan" class="form-control alasan_penolakan chosen-select-deselect" multiple data-placeholder="Alasan Penolakan"'); ?>
						</div>	
						
						<div class="form-group" id="desc_lain_box">
							<label class="control-label">Alasan Lain: </label><br/>
							<?php echo form_input('desc_lain', '', 'id="desc_lain" placeholder="Alasan Lain" class="form-control"'); ?>
							<!--
							<textarea name="desc_lain" placeholder="Alasan Lain" class="form-control" style="width: 100%; height: 100px; min-height: 100px;"></textarea>
							-->
						</div>
						
						<div class="form-group" id="status_rekomendasi_box">
							<label class="control-label">Apakah bisa direkomendasikan ke advokat yang lain? </label><br/>
							<?php echo form_dropdown('status_rekomendasi', $status_rekomendasi, '', 'id="status_rekomendasi" class="form-control chosen-select-deselect" data-placeholder="Status Rekomendasi"'); ?>
                            <span class="help-block"></span>
						</div>
						
						<div class="form-group" id="advokat_box">
                            <label class="control-label">Nama Advokat: </label>
							<?php echo form_dropdown('id_advokat', $advokat, '', 'id="id_advokat" class="form-control chosen-select-deselect" data-placeholder="Advokat"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="alasan_rekomendasi_box">
							<label class="control-label">Alasan: </label><br/>
							<textarea name="alasan_rekomendasi" placeholder="Alasan" class="form-control" style="width: 100%; height: 100px; min-height: 100px;"></textarea>
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
<!-- Bootstrap modal -->
<div class="modal fade" id="form-progress" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
			
			<div class="modal-body">
				<?php echo form_open('#', 'id="formProgress" class="" enctype="multipart/form-data"'); ?>
					<?php echo form_hidden('id_progress', ''); ?>
					<div class="form-body">
						<div class="form-group">
                            <label class="control-label">Nomor Permohonan: </label>
							<?php echo form_dropdown('id_permohonan', $permohonan, '', 'id="id_permohonan" class="form-control chosen-select-deselect" data-placeholder="Nomor Permohonan"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="tgl_progress_box">
                            <label class="control-label">Tanggal Proses: </label> (dd/mm/yyyy)
							<?php echo form_input('tgl_progress', '', 'id="tgl_progress" placeholder="" class="form-control"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<?php echo form_hidden('id_tindakan', ''); ?>
						
						<div class="form-group">
                            <label class="control-label">Status: </label>
							<?php echo form_dropdown('status_progress', $status_progress, '', 'id="status_progress" class="form-control chosen-select-deselect" data-placeholder="Status"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="hasil_keputusan_box">
                            <label class="control-label">Hasil keputusan yang dicapai:</label>
							<?php echo form_dropdown('id_hasil_keputusan', $hasil_keputusan, '', 'id="id_hasil_keputusan" class="form-control chosen-select-deselect" data-placeholder="Hasil Keputusan"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="uraian_keputusan_box">
                            <label class="control-label">Uraian hasil keputusan:</label>
							<textarea name="uraian_keputusan" placeholder="Uraian hasil keputusan yang dicapai" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="status_hasil_box">
                            <label class="control-label">Apakah hasil keputusan baik untuk klien?</label>
							<?php echo form_dropdown('status_hasil', $status_hasil, '', 'id="status_hasil" class="form-control chosen-select-deselect" data-placeholder="Apakah hasil keputusan baik untuk klien?"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="status_sepakat_box">
                            <label class="control-label">Apakah terjadi Kesepakatan?</label>
							<?php echo form_dropdown('status_sepakat', $status_sepakat, '', 'id="status_sepakat" class="form-control chosen-select-deselect" data-placeholder="Apakah terjadi kesepakatan?"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="note_progress_box">
							<label class="control-label">Uraian: </label><br/>
							<textarea name="note_progress" placeholder="Uraian" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
						</div>
						
						<div id="catatan_penting_box">
						<dl style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;">
							<dt>Catatan penting dalam proses hukum</dt>
						</dl>							
							<div class="form-group" id="status_norma_box">
								<label class="control-label">Penerapan Norma Hukum:</label>
								<?php echo form_dropdown('status_norma', $status_norma, '', 'id="status_norma" class="form-control chosen-select-deselect" data-placeholder="Penerapan Norma Hukum"'); ?>
								<span class="help-block"></span>
							</div>
							
							<div class="form-group" id="uraian_norma_box">
								<label class="control-label">Uraian penerapan norma hukum: </label><br/>
								<textarea name="uraian_norma" placeholder="Uraian penerapan norma hukum" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
							</div>
							
							<div class="form-group" id="status_aparat_box">
								<label class="control-label">Perilaku Aparat Penegak Hukum:</label>
								<?php echo form_dropdown('status_aparat', $status_aparat, '', 'id="status_aparat" class="form-control chosen-select-deselect" data-placeholder="Perilaku Aparat Penegak Hukum"'); ?>
								<span class="help-block"></span>
							</div>
							
							<div class="form-group" id="uraian_aparat_box">
								<label class="control-label">Uraian perilaku aparat hukum: </label><br/>
								<textarea name="uraian_aparat" placeholder="Uraian perilaku aparat hukum" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
							</div>
							
							<div class="form-group" id="status_pencari_box">
								<label class="control-label">Perilaku Pencari Keadilan:</label>
								<?php echo form_dropdown('status_pencari', $status_pencari, '', 'id="status_pencari" class="form-control chosen-select-deselect" data-placeholder="Perilaku Pencari Keadilan"'); ?>
								<span class="help-block"></span>
							</div>
							
							<div class="form-group" id="uraian_pencari_box">
								<label class="control-label">Uraian perilaku pencari keadilan: </label><br/>
								<textarea name="uraian_pencari" placeholder="Uraian perilaku pencari keadilan" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
							</div>
						<dl style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;"></dl>	
						</div>
						
						<div class="form-group" id="status_klien_box">
                            <label class="control-label">Apakah klien dalam bahaya?</label>
							<?php echo form_dropdown('status_klien', $status_klien, '', 'id="status_klien" class="form-control chosen-select-deselect" data-placeholder="Apakah klien dalam bahaya?"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="uraian_klien_box">
							<label class="control-label">Uraian: </label><br/>
							<textarea name="uraian_klien" placeholder="Uraian" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
						</div>
						
						<div class="form-group" id="status_kembali_box">
                            <label class="control-label">Apakah klien kembali lagi karena ada masalah dalam pelaksanaan hasil keputusan?</label>
							<?php echo form_dropdown('status_kembali', $status_kembali, '', 'id="status_kembali" class="form-control chosen-select-deselect" data-placeholder="Apakah klien kembali lagi karena ada masalah dalam pelaksanaan hasil keputusan?"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="tahap_progress_box">
                            <label class="control-label">Tahap proses perkembangan kasus: </label>
							<?php echo form_dropdown('id_tahap_progress', $tahap_progress, '', 'id="id_tahap_progress" class="form-control chosen-select-deselect" data-placeholder="Tahap proses perkembangan kasus"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="uraian_progress_box">
							<label class="control-label">Uraian proses perkembangan kasus: </label><br/>
							<textarea name="uraian_progress" placeholder="Uraian proses perkembangan kasus" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
						</div>
						
						<div class="form-group" id="tgl_progress_next_box">
                            <label class="control-label">Tanggal Proses Selanjutnya: </label>
							<?php echo form_input('tgl_progress_next', '', 'id="tgl_progress_next" placeholder="" class="form-control"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="tahap_progress_next_box">
                            <label class="control-label">Tahap Proses Selanjutnya: </label>
							<?php echo form_dropdown('id_tahap_progress_next', $tahap_progress_next, '', 'id="id_tahap_progress_next" class="form-control chosen-select-deselect" data-placeholder="Tahap Proses Selanjutnya"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="uraian_progress_next_box">
							<label class="control-label">Rekomendasi yang perlu dilakukan: </label><br/>
							<textarea name="uraian_progress_next" placeholder="Rekomendasi yang perlu dilakukan" class="form-control" style="width: 100%; height: 80px; min-height: 80px;"></textarea>
						</div>
						
						<div class="form-group" id="jenis_dokumen_box">
                            <label class="control-label">Jenis Dokumen: </label>
							<?php echo form_dropdown('id_jenis_dokumen', $jenis_dokumen, '', 'id="id_jenis_dokumen" class="form-control chosen-select-deselect" data-placeholder="Jenis Dokumen Hukum"'); ?>
                            <span class="help-block"></span>
                        </div>
						
						<div class="form-group" id="upload_lampiran_box">
                            <label class="control-label">Lampiran: </label>
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
<!-- Bootstrap modal -->
<div class="modal fade" id="view-progress" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
				<h5 class="modal-subtitle">Person Form</h5>
			</div>
						
			<!-- Form Permohonan -->
			<div class="modal-body" id="view_progress">
				<div class="form-body">
					<dl>
                        <dt>Nomor Permohonan:</dt>
						<dd id="dd_no_reg"></dd>	
                    </dl>
					
					<dl>
                        <dt>Nama Pemohon:</dt>
						<dd id="dd_id_pemohon"></dd>	
                    </dl>
					
					<dl>
                        <dt>Tanggal Progress:</dt>
						<dd id="dd_tgl_progress"></dd>	
                    </dl>
					
					<dl>
                        <dt>Status:</dt>
						<dd id="dd_status_progress"></dd>	
                    </dl>
										
					<dl id="dd_hasil_keputusan_box">
                        <dt>Hasil Keputusan:</dt>
						<dd id="dd_hasil_keputusan"></dd>	
                    </dl>
					
					<dl id="dd_uraian_keputusan_box">
                        <dt>Uraian Hasil Keputusan:</dt>
						<dd id="dd_uraian_keputusan"></dd>	
                    </dl>
					
					<dl id="dd_status_hasil_box">
                        <dt>Apakah hasil keputusan baik untuk klien?</dt>
						<dd id="dd_status_hasil"></dd>	
                    </dl>
					
					<dl id="dd_status_sepakat_box">
                        <dt>Apakah terjadi Kesepakatan?</dt>
						<dd id="dd_status_sepakat"></dd>	
                    </dl>
					
					<dl id="dd_note_progress_box">
                        <dt>Uraian:</dt>
						<dd id="dd_note_progress"></dd>	
                    </dl>
					
					<div id="dd_catatan_penting_box">

					<dl style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;">
						<dt>Catatan penting dalam proses hukum</dt>
					</dl>
					
					<dl id="dd_status_norma_box">
						<dt>Penerapan Norma Hukum:</dt>
						<dd id="dd_status_norma"></dd>	
					</dl>
						
					<dl id="dd_uraian_norma_box">
						<dt>Uraian penerapan norma hukum:</dt>
						<dd id="dd_uraian_norma"></dd>	
					</dl>
						
					<dl id="dd_status_aparat_box">
						<dt>Perilaku Aparat Penegak Hukum:</dt>
						<dd id="dd_status_aparat"></dd>	
					</dl>
						
					<dl id="dd_uraian_aparat_box">
						<dt>Uraian perilaku aparat penegak hukum:</dt>
						<dd id="dd_uraian_aparat"></dd>	
					</dl>
						
					<dl id="dd_status_pencari_box">
						<dt>Perilaku Pencari Keadilan:</dt>
						<dd id="dd_status_pencari"></dd>	
					</dl>
						
					<dl id="dd_uraian_pencari_box">
						<dt>Uraian Perilaku pencari keadilan:</dt>
						<dd id="dd_uraian_pencari"></dd>	
					</dl>

					<dl style="border-bottom-color: #f4f4f4; border-bottom: 1px solid #e5e5e5; padding:0; margin:0  0 15px 0;"></dl>
					
					</div>
					<dl id="dd_status_klien_box">
                        <dt>Apakah klien dalam bahaya?</dt>
						<dd id="dd_status_klien"></dd>
					</dl>
					
					<dl id="dd_uraian_klien_box">
						<dt>Uraian:</dt>
						<dd id="dd_uraian_klien"></dd>	
					</dl>	
					
					<dl id="dd_status_kembali_box">
                        <dt>Apakah klien kembali lagi karena ada masalah dalam pelaksanaan hasil keputusan?</dt>
						<dd id="dd_status_kembali"></dd>	
                    </dl>
					
					<dl id="dd_tahap_progress_box">
                        <dt>Tahap proses perkembangan kasus:</dt>
						<dd id="dd_tahap_progress"></dd>	
                    </dl>
					
					<dl id="dd_uraian_progress_box">
                        <dt>Uraian proses perkembangan kasus:</dt>
						<dd id="dd_uraian_progress"></dd>	
                    </dl>
					
					<dl id="dd_tgl_progress_next_box">
                        <dt>Tanggal Proses Selanjutnya:</dt>
						<dd id="dd_tgl_progress_next"></dd>	
                    </dl>
					
					<dl id="dd_tahap_progress_next_box">
                        <dt>Tahap Proses Selanjutnya</dt>
						<dd id="dd_tahap_progress_next"></dd>	
                    </dl>
					
					<dl id="dd_uraian_progress_next_box">
                        <dt>Rekomendasi yang perlu dilakukan:</dt>
						<dd id="dd_uraian_progress_next"></dd>	
                    </dl>
					
					<dl id="dd_jenis_dokumen_box">
                        <dt>Jenis Dokumen:</dt>
						<dd id="dd_jenis_dokumen"></dd>	
                    </dl>
					
					<dl id="dd_list_lampiran_box">
                        <dt>Lampiran:</dt>
						<dt></dt>
						<dd id="dd_list_lampiran">
							<ul id="list_lampiran" class="list-group">
								<li class="list-group-item list-group-item-success">1<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">2<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">3<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">4<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
								<li class="list-group-item list-group-item-success">5<a class="" href="javascript:void(0)" style="float: right;" title="Delete"><span class="glyphicon glyphicon-remove"></span></a></li>
							</ul>
						</dd>	
                    </dl>
                </div>
            </div>
			
            <div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
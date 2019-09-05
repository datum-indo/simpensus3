<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Progress = $('#Tbl_Progress').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],

		"ajax": {
			"url": "<?php echo site_url('progress/ajax_list'); ?>",
			"type": "POST"
		},
		
		"columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
				
        }
        ],
	});
	
	$('#btnClear').click(function()
	{
		$('input[type=search]').val('');
		Tbl_Progress.search( '' ) .columns().search( '' ) .draw();
	});
	
	file_attachment = new Array();
	
	$('#tgl_progress').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	
	$('#tgl_progress_next').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	
	$(".chosen-select").chosen();
	$(".chosen-select-deselect").chosen({ allow_single_deselect: true, width: '100%'});
	
	$(".chosen-select").val('').trigger("chosen:updated");
	$(".chosen-select-deselect").val('').trigger("chosen:updated");
	
	$("input").change(function()
	{
		$(this).parent().removeClass('has-error');
		$(this).next().empty();
	});
    
	$("textarea").change(function()
	{
		$(this).parent().removeClass('has-error');
		$(this).next().empty();
	});
	
		
	$("select").change(function()
	{
		$(this).parent().removeClass('has-error');
		//$(this).next().empty();
	});
	
	var _status_progress = $('#status_progress');
	var _tgl_progress = $('#tgl_progress');
	var _id_hasil_keputusan = $('#id_hasil_keputusan');	
	
	$('[name="id_permohonan"]').change(function ()
	{
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
			
		var id_permohonan = $('[name="id_permohonan"]').val();
		if(id_permohonan != "")
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('progress/get_hasil_keputusan'); ?>/" + id_permohonan,
				success: function(response) 
				{
					var daftar_hasil_keputusan = response[0];
					var tindakan = response[1];
					
					$('#id_hasil_keputusan').empty();
					_id_hasil_keputusan.append('<option value=""></option>');
					$.each(daftar_hasil_keputusan, function(id_hasil_keputusan, hasil_keputusan) {
						var opt = $('<option />'); 
						opt.val(id_hasil_keputusan);
						opt.text(hasil_keputusan);
						_id_hasil_keputusan.append(opt); 
					});
					_id_hasil_keputusan.trigger('chosen:updated');
					
					$('[name="id_tindakan"]').val(tindakan.id_tindakan);
				}
			});		
			
			_tgl_progress.prop({disabled: false});
			$('#tgl_progress_box').show();
			$('[name="tgl_progress"]').val('');
			
			_status_progress.prop({disabled: false});
			$('#status_progress').chosen().chosenReadonly(false);
			$('[name="status_progress"]').val('').trigger('chosen:updated');
			
			$('#hasil_keputusan_box').hide();
			$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
			
			$('#uraian_keputusan_box').hide();
			$('[name="uraian_keputusan"]').val('');
			
			$('#status_hasil_box').hide();
			$('[name="status_hasil"]').val('').trigger('chosen:updated');
			
			$('#status_sepakat_box').hide();
			$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
			$('#note_progress_box').hide();
			$('[name="note_progress"]').val('');
			
			$('#catatan_penting_box').hide();
			
			$('#status_norma_box').hide();
			$('[name="status_norma"]').val('').trigger('chosen:updated');
			
			$('#uraian_norma_box').hide();
			$('[name="uraian_norma"]').val('');
			
			$('#status_aparat_box').hide();
			$('[name="status_aparat"]').val('').trigger('chosen:updated');
			
			$('#uraian_aparat_box').hide();
			$('[name="uraian_aparat"]').val('');
			
			$('#status_pencari_box').hide();
			$('[name="status_pencari"]').val('').trigger('chosen:updated');
			
			$('#uraian_pencari_box').hide();
			$('[name="uraian_pencari"]').val('');
			
			$('#status_kembali_box').hide();
			$('[name="status_kembali"]').val('').trigger('chosen:updated');
			
			$('#tahap_progress_box').hide();
			$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_box').hide();
			$('[name="uraian_progress"]').val('');
			
			$('#status_klien_box').hide();
			$('[name="status_klien"]').val('').trigger('chosen:updated');
			
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val('');
			
			$('#tgl_progress_next_box').hide();
			$('[name="tgl_progress_next"]').val('');
			
			$('#tahap_progress_next_box').hide();
			$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_next_box').hide();
			$('[name="uraian_progress_next"]').val('');
			
			$('#jenis_dokumen_box').hide();
			$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
			
			$('#upload_lampiran_box').hide();
			$('#lampiran').val('');
			$('#list_lampiran_box').hide();
		}
		else
		{
			_tgl_progress.prop({disabled: true});
			$('#tgl_progress_box').show();
			$('[name="tgl_progress"]').val('');
			
			$('[name="id_tindakan"]').val('');
			
			_status_progress.prop({disabled: true});
			$('[name="status_progress"]').val('').trigger('chosen:updated');
			
			$('#hasil_keputusan_box').hide();
			$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
			
			$('#uraian_keputusan_box').hide();
			$('[name="uraian_keputusan"]').val('');
			
			$('#status_hasil_box').hide();
			$('[name="status_hasil"]').val('').trigger('chosen:updated');
			
			$('#status_sepakat_box').hide();
			$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
			$('#note_progress_box').hide();
			$('[name="note_progress"]').val('');
			
			$('#catatan_penting_box').hide();
			
			$('#status_norma_box').hide();
			$('[name="status_norma"]').val('').trigger('chosen:updated');
			
			$('#uraian_norma_box').hide();
			$('[name="uraian_norma"]').val('');
			
			$('#status_aparat_box').hide();
			$('[name="status_aparat"]').val('').trigger('chosen:updated');
			
			$('#uraian_aparat_box').hide();
			$('[name="uraian_aparat"]').val('');
			
			$('#status_pencari_box').hide();
			$('[name="status_pencari"]').val('').trigger('chosen:updated');
			
			$('#uraian_pencari_box').hide();
			$('[name="uraian_pencari"]').val('');
			
			$('#status_klien_box').hide();
			$('[name="status_klien"]').val('').trigger('chosen:updated');
			
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val('');
			
			$('#status_kembali_box').hide();
			$('[name="status_kembali"]').val('').trigger('chosen:updated');
			
			$('#tahap_progress_box').hide();
			$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_box').hide();
			$('[name="uraian_progress"]').val('');
			
			$('#tgl_progress_next_box').hide();
			$('[name="tgl_progress_next"]').val('');
			
			$('#tahap_progress_next_box').hide();
			$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_next_box').hide();
			$('[name="uraian_progress_next"]').val('');
			
			$('#jenis_dokumen_box').hide();
			$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
			
			$('#upload_lampiran_box').hide();
			$('#lampiran').val('');
			$('#list_lampiran_box').hide();
		}		
	});
	
	$('[name="status_progress"]').change(function ()
	{
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		
		if($(this).val() == "Belum Selesai")
		{
			$('#hasil_keputusan_box').hide();
			$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
			
			$('#uraian_keputusan_box').hide();
			$('[name="uraian_keputusan"]').val('');
			
			$('#status_hasil_box').hide();
			$('[name="status_hasil"]').val('').trigger('chosen:updated');
			
			$('#status_sepakat_box').hide();
			$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
			$('#note_progress_box').hide();
			$('[name="note_progress"]').val('');
			
			$('#catatan_penting_box').hide();
			
			$('#status_norma_box').hide();
			$('[name="status_norma"]').val('').trigger('chosen:updated');
			
			$('#uraian_norma_box').hide();
			$('[name="uraian_norma"]').val('');
			
			$('#status_aparat_box').hide();
			$('[name="status_aparat"]').val('').trigger('chosen:updated');
			
			$('#uraian_aparat_box').hide();
			$('[name="uraian_aparat"]').val('');
			
			$('#status_pencari_box').hide();
			$('[name="status_pencari"]').val('').trigger('chosen:updated');
			
			$('#uraian_pencari_box').hide();
			$('[name="uraian_pencari"]').val('');
			
			$('#status_klien_box').hide();
			$('[name="status_klien"]').val('').trigger('chosen:updated');
			
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val('');
			
			$('#status_kembali_box').hide();
			$('[name="status_kembali"]').val('').trigger('chosen:updated');
			
			$('#tahap_progress_box').show();
			$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_box').hide();
			$('[name="uraian_progress"]').val('');
			
			$('#tgl_progress_next_box').show();
			$('[name="tgl_progress_next"]').val('');
			
			$('#tahap_progress_next_box').show();
			$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_next_box').hide();
			$('[name="uraian_progress_next"]').val('');
			
			$('#jenis_dokumen_box').show();
			$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
			
			$('#lampiran').val('');
			$('#upload_lampiran_box').show();
			$('#list_lampiran_box').show();
		}
		else if($(this).val() == "Selesai")
		{
			//$('#tgl_progress_box').show();
			//$('[name="tgl_progress"]').val('');
			
			var id_tindakan = $('[name="id_tindakan"]').val();
			if(id_tindakan == '1')
			{
				$('#hasil_keputusan_box').hide();
				$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
				
				$('#uraian_keputusan_box').hide();
				$('[name="uraian_keputusan"]').val('');
				
				$('#status_hasil_box').show();
				$('[name="status_hasil"]').val('').trigger('chosen:updated');
				
				$('#status_sepakat_box').hide();
				$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
				$('#note_progress_box').show();
				$('[name="note_progress"]').val('');
				
				$('#catatan_penting_box').hide();
				
				$('#status_norma_box').hide();
				$('[name="status_norma"]').val('').trigger('chosen:updated');
				
				$('#uraian_norma_box').hide();
				$('[name="uraian_norma"]').val('');
				
				$('#status_aparat_box').hide();
				$('[name="status_aparat"]').val('').trigger('chosen:updated');
				
				$('#uraian_aparat_box').hide();
				$('[name="uraian_aparat"]').val('');
				
				$('#status_pencari_box').hide();
				$('[name="status_pencari"]').val('').trigger('chosen:updated');
				
				$('#uraian_pencari_box').hide();
				$('[name="uraian_pencari"]').val('');
				
				$('#status_klien_box').hide();
				$('[name="status_klien"]').val('').trigger('chosen:updated');
				
				$('#uraian_klien_box').hide();
				$('[name="uraian_klien"]').val('');
				
				$('#status_kembali_box').hide();
				$('[name="status_kembali"]').val('').trigger('chosen:updated');
				
				$('#tahap_progress_box').hide();
				$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
				
				$('#uraian_progress_box').hide();
				$('[name="uraian_progress"]').val('');
				
				$('#tgl_progress_next_box').hide();
				$('[name="tgl_progress_next"]').val('');
				
				$('#tahap_progress_next_box').hide();
				$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
				
				$('#uraian_progress_next_box').hide();
				$('[name="uraian_progress_next"]').val('');
				
				$('#jenis_dokumen_box').show();
				$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
				
				$('#lampiran').val('');
				$('#upload_lampiran_box').show();
				$('#list_lampiran_box').show();
			}
			else if(id_tindakan == '2')
			{
				$('#hasil_keputusan_box').hide();
				$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
				
				$('#uraian_keputusan_box').hide();
				$('[name="uraian_keputusan"]').val('');
				
				$('#status_hasil_box').show();
				$('[name="status_hasil"]').val('').trigger('chosen:updated');
				
				$('#status_sepakat_box').show();
				$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
				$('#note_progress_box').show();
				$('[name="note_progress"]').val('');
				
				$('#catatan_penting_box').hide();
				
				$('#status_norma_box').hide();
				$('[name="status_norma"]').val('').trigger('chosen:updated');
				
				$('#uraian_norma_box').hide();
				$('[name="uraian_norma"]').val('');
				
				$('#status_aparat_box').hide();
				$('[name="status_aparat"]').val('').trigger('chosen:updated');
				
				$('#uraian_aparat_box').hide();
				$('[name="uraian_aparat"]').val('');
				
				$('#status_pencari_box').hide();
				$('[name="status_pencari"]').val('').trigger('chosen:updated');
				
				$('#uraian_pencari_box').hide();
				$('[name="uraian_pencari"]').val('');
				
				$('#status_klien_box').hide();
				$('[name="status_klien"]').val('').trigger('chosen:updated');
				
				$('#uraian_klien_box').hide();
				$('[name="uraian_klien"]').val('');
				
				$('#status_kembali_box').hide();
				$('[name="status_kembali"]').val('').trigger('chosen:updated');
				
				$('#tahap_progress_box').hide();
				$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
				
				$('#uraian_progress_box').hide();
				$('[name="uraian_progress"]').val('');
				
				$('#tgl_progress_next_box').hide();
				$('[name="tgl_progress_next"]').val('');
				
				$('#tahap_progress_next_box').hide();
				$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
				
				$('#uraian_progress_next_box').hide();
				$('[name="uraian_progress_next"]').val('');
				
				$('#jenis_dokumen_box').show();
				$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
				
				$('#lampiran').val('');
				$('#upload_lampiran_box').show();
				$('#list_lampiran_box').show();
			}
			else
			{
				$('#hasil_keputusan_box').show();
				$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
				
				$('#uraian_keputusan_box').hide();
				$('[name="uraian_keputusan"]').val('');
				
				$('#status_hasil_box').show();
				$('[name="status_hasil"]').val('').trigger('chosen:updated');
				
				$('#status_sepakat_box').hide();
				$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
				$('#note_progress_box').hide();
				$('[name="note_progress"]').val('');
				
				$('#catatan_penting_box').show();
				
				$('#status_norma_box').show();
				$('[name="status_norma"]').val('').trigger('chosen:updated');
				
				$('#uraian_norma_box').hide();
				$('[name="uraian_norma"]').val('');
				
				$('#status_aparat_box').show();
				$('[name="status_aparat"]').val('').trigger('chosen:updated');
				
				$('#uraian_aparat_box').hide();
				$('[name="uraian_aparat"]').val('');
				
				$('#status_pencari_box').show();
				$('[name="status_pencari"]').val('').trigger('chosen:updated');
				
				$('#uraian_pencari_box').hide();
				$('[name="uraian_pencari"]').val('');
				
				$('#status_klien_box').show();
				$('[name="status_klien"]').val('').trigger('chosen:updated');
				
				$('#uraian_klien_box').hide();
				$('[name="uraian_klien"]').val('');
				
				$('#status_kembali_box').show();
				$('[name="status_kembali"]').val('').trigger('chosen:updated');
				
				$('#tahap_progress_box').hide();
				$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
				
				$('#uraian_progress_box').hide();
				$('[name="uraian_progress"]').val('');
								
				$('#tgl_progress_next_box').hide();
				$('[name="tgl_progress_next"]').val('');
				
				$('#tahap_progress_next_box').hide();
				$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
				
				$('#uraian_progress_next_box').hide();
				$('[name="uraian_progress_next"]').val('');
				
				$('#jenis_dokumen_box').show();
				$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
				
				$('#lampiran').val('');
				$('#upload_lampiran_box').show();
				$('#list_lampiran_box').show();
			}		
		}
		else if($(this).val() == "Gugur")
		{
			$('#hasil_keputusan_box').hide();
			$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
			
			$('#uraian_keputusan_box').hide();
			$('[name="uraian_keputusan"]').val('');
			
			$('#status_hasil_box').hide();
			$('[name="status_hasil"]').val('').trigger('chosen:updated');
			
			$('#status_sepakat_box').hide();
			$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
			$('#note_progress_box').show();
			$('[name="note_progress"]').val('');
			
			$('#catatan_penting_box').hide();
			
			$('#status_norma_box').hide();
			$('[name="status_norma"]').val('').trigger('chosen:updated');
			
			$('#uraian_norma_box').hide();
			$('[name="uraian_norma"]').val('');
			
			$('#status_aparat_box').hide();
			$('[name="status_aparat"]').val('').trigger('chosen:updated');
			
			$('#uraian_aparat_box').hide();
			$('[name="uraian_aparat"]').val('');
			
			$('#status_pencari_box').hide();
			$('[name="status_pencari"]').val('').trigger('chosen:updated');
			
			$('#uraian_pencari_box').hide();
			$('[name="uraian_pencari"]').val('');
			
			$('#status_klien_box').hide();
			$('[name="status_klien"]').val('').trigger('chosen:updated');
			
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val('');
						
			$('#status_kembali_box').hide();
			$('[name="status_kembali"]').val('').trigger('chosen:updated');
			
			$('#tahap_progress_box').hide();
			$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_box').hide();
			$('[name="uraian_progress"]').val('');
			
			$('#tgl_progress_next_box').hide();
			$('[name="tgl_progress_next"]').val('');
			
			$('#tahap_progress_next_box').hide();
			$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_next_box').hide();
			$('[name="uraian_progress_next"]').val('');
			
			$('#jenis_dokumen_box').show();
			$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
			
			$('#lampiran').val('');
			$('#upload_lampiran_box').show();
			$('#list_lampiran_box').show();
		}
		else
		{
			$('#hasil_keputusan_box').hide();
			$('[name="id_hasil_keputusan"]').val('').trigger('chosen:updated');
			
			$('#uraian_keputusan_box').hide();
			$('[name="uraian_keputusan"]').val('');
			
			$('#status_hasil_box').hide();
			$('[name="status_hasil"]').val('').trigger('chosen:updated');
			
			$('#status_sepakat_box').hide();
			$('[name="status_sepakat"]').val('').trigger('chosen:updated');
			
			$('#note_progress_box').hide();
			$('[name="note_progress"]').val('');
			
			$('#catatan_penting_box').hide();
			
			$('#status_norma_box').hide();
			$('[name="status_norma"]').val('').trigger('chosen:updated');
			
			$('#uraian_norma_box').hide();
			$('[name="uraian_norma"]').val('');
			
			$('#status_aparat_box').hide();
			$('[name="status_aparat"]').val('').trigger('chosen:updated');
			
			$('#uraian_aparat_box').hide();
			$('[name="uraian_aparat"]').val('');
			
			$('#status_pencari_box').hide();
			$('[name="status_pencari"]').val('').trigger('chosen:updated');
			
			$('#uraian_pencari_box').hide();
			$('[name="uraian_pencari"]').val('');
			
			$('#status_klien_box').hide();
			$('[name="status_klien"]').val('').trigger('chosen:updated');
			
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val('');
						
			$('#status_kembali_box').hide();
			$('[name="status_kembali"]').val('').trigger('chosen:updated');
			
			$('#tahap_progress_box').hide();
			$('[name="id_tahap_progress"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_box').hide();
			$('[name="uraian_progress"]').val('');
			
			$('#tgl_progress_next_box').hide();
			$('[name="tgl_progress_next"]').val('');
			
			$('#tahap_progress_next_box').hide();
			$('[name="id_tahap_progress_next"]').val('').trigger('chosen:updated');
			
			$('#uraian_progress_next_box').hide();
			$('[name="uraian_progress_next"]').val('');
			
			$('#jenis_dokumen_box').hide();
			$('[name="id_jenis_dokumen"]').val('').trigger('chosen:updated');
			
			$('#lampiran').val('');
			$('#upload_lampiran_box').hide();
			$('#list_lampiran_box').hide();
		}		
			
	});
	
	$('[name="id_hasil_keputusan"]').change(function ()
	{
		if($(this).val() == '')
		{
			$('#uraian_keputusan_box').hide();
			$('[name="uraian_keputusan"]').val('');
		}
		else
		{
			$('#uraian_keputusan_box').show();
			$('[name="uraian_keputusan"]').val('');
		}
	});
	
	$('[name="status_norma"]').change(function ()
	{
		if($(this).val() == '' || $(this).val() == 'Sesuai')
		{
			$('#uraian_norma_box').hide();
			$('[name="uraian_norma"]').val('');
		}
		else
		{
			$('#uraian_norma_box').show();
			$('[name="uraian_norma"]').val('');
		}
	});
	
	$('[name="status_aparat"]').change(function ()
	{
		if($(this).val() == '' || $(this).val() == 'Sesuai')
		{
			$('#uraian_aparat_box').hide();
			$('[name="uraian_aparat"]').val('');
		}
		else
		{
			$('#uraian_aparat_box').show();
			$('[name="uraian_aparat"]').val('');
		}
	});
	
	$('[name="status_pencari"]').change(function ()
	{
		if($(this).val() == '' || $(this).val() == 'Sesuai')
		{
			$('#uraian_pencari_box').hide();
			$('[name="uraian_pencari"]').val('');
		}
		else
		{
			$('#uraian_pencari_box').show();
			$('[name="uraian_pencari"]').val('');
		}
	});		
	
	$('[name="id_tahap_progress"]').change(function ()
	{
		if($(this).val() == '')
		{
			$('#uraian_progress_box').hide();
			$('[name="uraian_progress"]').val('');
		}
		else
		{
			$('#uraian_progress_box').show();
			$('[name="uraian_progress"]').val('');
		}	
	});	
	
	$('[name="status_klien"]').change(function ()
	{
		if($(this).val() == 'Tidak')
		{
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val('');
		}
		else if($(this).val() == 'Ya')
		{
			$('#uraian_klien_box').show();
			$('[name="uraian_klien"]').val('');
		}	
		else
		{
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val('');
		}
	});		
	
	$('[name="id_tahap_progress_next"]').change(function ()
	{
		if($(this).val() == '')
		{
			$('#uraian_progress_next_box').hide();
			$('[name="uraian_progress_next"]').val('');
		}
		else
		{
			$('#uraian_progress_next_box').show();
			$('[name="uraian_progress_next"]').val('');
		}	
	});	
	
	
	
	$('#lampiran').change(function(e)
	{
				
		e.preventDefault();
				
		var ajaxData = new FormData();
	
		ajaxData.append('lampiran', 'form-lampiran');
		$.each($("input[type=file]"), function(i, obj)
		{
			$.each(obj.files,function(j,file)
			{
				ajaxData.append('lampiran[]', file);
			})
		});
		
		$.ajax({
			url: "<?php echo site_url('progress/ajax_upload/')?>/",
			type: "POST",
			data: ajaxData,
			dataType: "JSON",
			cache: false,
            contentType: false,
            processData: false,
			success: function(response)
			{
				$.each(response, function(i, item){
					$('#list_lampiran').append(response[i].link);
					
					if(response[i].status)
					{
						file_attachment.push(response[i].id_file);
					}	
				});
				
				$('#lampiran').val('');
			}
		});
	});
	
	$('#list_lampiran').on('click', 'a.delete', function() {
		
		var status_file = $(this).attr('status');
		var id_file = $(this).attr('id');
		var elem = $(this);
		var index = file_attachment.indexOf(id_file);
				
		if(status_file == '0')
		{
			elem.closest('li').remove();
		}
		else
		{
			if(confirm('Are you sure delete this file?'))
			{
				var formData = {
					xid_file: id_file
				}
				
				$.ajax({
					url : "<?php echo site_url('progress/ajax_delete_attachment')?>/",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_attachment.splice(index,1);	
						elem.closest('li').remove();
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting file');
					}
					
				});	
			}
		}		
	});
	
	$('#lampiranx').change(function(e)
	{
				
		e.preventDefault();
				
		var ajaxData = new FormData();
	
		ajaxData.append('lampiranx', 'form-lampiranx');
		$.each($("input[type=file]"), function(i, obj)
		{
			$.each(obj.files,function(j,file)
			{
				ajaxData.append('lampiranx[]', file);
			})
		});
		
		$.ajax({
			url: "<?php echo site_url('progress/ajax_upload_progress/')?>/",
			type: "POST",
			data: ajaxData,
			dataType: "JSON",
			cache: false,
            contentType: false,
            processData: false,
			success: function(response)
			{
				$.each(response, function(i, item){
					$('#list_lampiranx').append(response[i].link);
					
					if(response[i].status)
					{
						file_attachment.push(response[i].id_file);
					}	
				});
				
				$('#lampiranx').val('');
			}
		});
	});
	
	$('#list_lampiranx').on('click', 'a.delete', function() {
		
		var status_file = $(this).attr('status');
		var id_file = $(this).attr('id');
		var elem = $(this);
		var index = file_attachment.indexOf(id_file);
				
		if(status_file == '0')
		{
			elem.closest('li').remove();
		}
		else
		{
			if(confirm('Are you sure delete this file?'))
			{
				var formData = {
					xid_file: id_file
				}
				
				$.ajax({
					url : "<?php echo site_url('progress/ajax_delete_attachment')?>/",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_attachment.splice(index,1);	
						elem.closest('li').remove();
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting file');
					}
					
				});	
			}
		}		
	});
});	


function add()
{
	save_method = 'add';
	
	var formData = {
		type: 'progress'
	}
	$.ajax({
        url : "<?php echo site_url('progress/ajax_new/')?>/",
        type: "GET",
        dataType: "JSON",
		data: formData,
        success: function(response)
        {
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string
			
			var progress = response[0];
			var approval = response[1];
			
			var _id_permohonan = $('[name="id_permohonan"]');
			var _status_progress = $('#status_progress');
			
			var _tgl_progress = $('#tgl_progress');
			
			file_attachment = new Array();
			
			$('#id_permohonan').empty();
			_id_permohonan.append('<option value=""></option>');
			$.each(approval, function(id_permohonan, no_reg) {
				var opt = $('<option />'); 
				opt.val(id_permohonan);
				opt.text(no_reg);
				_id_permohonan.append(opt); 
			});
			_id_permohonan.chosen().chosenReadonly(false);
			_id_permohonan.trigger('chosen:updated');	
			
			$('[name="id_progress"]').val(progress.id_progress);	
			$('[name="id_permohonan"]').val(progress.id_permohonan).trigger('chosen:updated');
			
			_tgl_progress.prop({disabled: true});
			$('#tgl_progress_box').show();
			$('[name="tgl_progress"]').val(progress.tgl_progress);
			
			_status_progress.prop({disabled: true});
			$('[name="status_progress"]').val(progress.status_progress).trigger('chosen:updated');
			
			$('[name="id_tindakan"]').val(progress.id_tindakan);
			
			$('#hasil_keputusan_box').hide();
			$('[name="id_hasil_keputusan"]').val(progress.status_progress).trigger('chosen:updated');
			
			$('#uraian_keputusan_box').hide();
			$('[name="uraian_keputusan"]').val(progress.uraian_keputusan);
			
			$('#status_hasil_box').hide();
			$('[name="status_hasil"]').val(progress.status_hasil).trigger('chosen:updated');
			
			$('#status_sepakat_box').hide();
			$('[name="status_sepakat"]').val(progress.status_sepakat).trigger('chosen:updated');
			
			$('#note_progress_box').hide();
			$('[name="note_progress"]').val(progress.note_progress).trigger('chosen:updated');
			
			$('#catatan_penting_box').hide();
			
			$('#status_norma_box').hide();
			$('[name="status_norma"]').val(progress.status_norma).trigger('chosen:updated');
			
			$('#uraian_norma_box').hide();
			$('[name="uraian_norma"]').val(progress.uraian_norma);
			
			$('#status_aparat_box').hide();
			$('[name="status_aparat"]').val(progress.status_aparat).trigger('chosen:updated');
			
			$('#uraian_aparat_box').hide();
			$('[name="uraian_aparat"]').val(progress.uraian_aparat);
			
			$('#status_pencari_box').hide();
			$('[name="status_pencari"]').val(progress.status_pencari).trigger('chosen:updated');
			
			$('#uraian_pencari_box').hide();
			$('[name="uraian_pencari"]').val(progress.uraian_pencari);
			
			$('#status_kembali_box').hide();
			$('[name="status_kembali"]').val(progress.status_kembali).trigger('chosen:updated');
			
			$('#tahap_progress_box').hide();
			$('[name="id_tahap_progress"]').val(progress.id_tahap_progress).trigger('chosen:updated');
			
			$('#uraian_progress_box').hide();
			$('[name="uraian_progress"]').val(progress.uraian_progress);
			
			$('#status_klien_box').hide();
			$('[name="status_klien"]').val(progress.status_klien).trigger('chosen:updated');
			
			$('#uraian_klien_box').hide();
			$('[name="uraian_klien"]').val(progress.uraian_klien);
			
			$('#tgl_progress_next_box').hide();
			$('[name="tgl_progress_next"]').val(progress.tgl_progress_next);
			
			$('#tahap_progress_next_box').hide();
			$('[name="id_tahap_progress_next"]').val(progress.id_tahap_progress_next).trigger('chosen:updated');
			
			$('#uraian_progress_next_box').hide();
			$('[name="uraian_progress_next"]').val(progress.uraian_progress_next);
			
			$('#jenis_dokumen_box').hide();
			$('[name="id_jenis_dokumen"]').val(progress.id_jenis_dokumen).trigger('chosen:updated');
			
			$('#lampiran').val('');
			$('#upload_lampiran_box').hide();
			$('#list_lampiran_box').hide();
			$('#list_lampiran').empty();
			
			$('#form-progress').modal({backdrop: 'static', keyboard: false})  
			$('#form-progress').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Progress'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Data Proses Perkembangan Bantuan Hukum'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = '<?php echo site_url(''); ?>';
        }
    });
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	//$('#btnSave').attr('disabled', true);
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_progress: $('[name="id_progress"]').val(),
		id_permohonan: $('[name="id_permohonan"]').val(),
		status_progress: $('[name="status_progress"]').val(),
		id_tindakan: $('[name="id_tindakan"]').val(),
		tgl_progress: $('[name="tgl_progress"]').val(),
		id_hasil_keputusan:  $('[name="id_hasil_keputusan"]').val(),
		uraian_keputusan:  $('[name="uraian_keputusan"]').val(),
		status_hasil:  $('[name="status_hasil"]').val(),
		status_sepakat:  $('[name="status_sepakat"]').val(),
		note_progress:  $('[name="note_progress"]').val(),
		status_norma:  $('[name="status_norma"]').val(),
		uraian_norma:  $('[name="uraian_norma"]').val(),
		status_aparat:  $('[name="status_aparat"]').val(),
		uraian_aparat:  $('[name="uraian_aparat"]').val(),
		status_pencari:  $('[name="status_pencari"]').val(),
		uraian_pencari:  $('[name="uraian_pencari"]').val(),
		status_kembali:  $('[name="status_kembali"]').val(),
		id_tahap_progress: $('[name="id_tahap_progress"]').val(),
		uraian_progress: $('[name="uraian_progress"]').val(),
		status_klien: $('[name="status_klien"]').val(),
		uraian_klien: $('[name="uraian_klien"]').val(),
		tgl_progress_next: $('[name="tgl_progress_next"]').val(),
		id_tahap_progress_next: $('[name="id_tahap_progress_next"]').val(),
		uraian_progress_next: $('[name="uraian_progress_next"]').val(),
		id_jenis_dokumen: $('[name="id_jenis_dokumen"]').val(),
		file_attachment: file_attachment
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('progress/ajax_save'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('progress/ajax_update'); ?>";
    };
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData,
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('#form-progress').modal('hide');
				reload_table();	
				$('[name="csrf_token"]').val(data.csrf_token);
			}
			else
			{
				for (var i = 0; i < data.inputerror.length; i++) 
				{
					$('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
					//$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
				}
			}		
		},
		complete: function() 
		{
			
        },
		error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = '<?php echo site_url(''); ?>';
        }
	});		
}	

function edit(id_progress)
{
	$('#formProgress')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('progress/get_detail_progress')?>/" + id_progress,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var progress = response[0];
			$('[name="id_progress"]').val(progress.id_progress).trigger('chosen:updated');
			
			$('[name="id_permohonan"]').val(progress.id_permohonan).trigger('chosen:updated');
			var permohonan = response[1];
			var _id_permohonan = $('[name="id_permohonan"]');
						
			$('#id_permohonan').empty();
			$.each(permohonan, function(id_permohonan, detail_permohonan) {
				var opt = $('<option />'); 
				opt.val(id_permohonan);
				opt.text(detail_permohonan);
				_id_permohonan.append(opt); 
			});
			
			_id_permohonan.chosen().chosenReadonly(true);
			_id_permohonan.trigger('chosen:updated');
			
			$('[name="status_progress"]').val(progress.status_progress).trigger('chosen:updated');
			$('#status_progress').chosen().chosenReadonly(true);
			
			$('[name="id_tindakan"]').val(progress.id_tindakan);
			$('[name="tgl_progress"]').val(progress.tgl_progress).trigger('chosen:updated');
			
			var daftar_hasil_keputusan = response[2];
			var _id_hasil_keputusan = $('[name="id_hasil_keputusan"]');
						
			$('#id_hasil_keputusan').empty();
			//_id_hasil_keputusan.append('<option value=""></option>');
			$.each(daftar_hasil_keputusan, function(id_hasil_keputusan, hasil_keputusan) {
				var opt = $('<option />'); 
				opt.val(id_hasil_keputusan);
				opt.text(hasil_keputusan);
				_id_hasil_keputusan.append(opt); 
			});
			_id_hasil_keputusan.trigger('chosen:updated');
			
			$('[name="id_hasil_keputusan"]').val(progress.id_hasil_keputusan).trigger('chosen:updated');
						
			$('[name="uraian_keputusan"]').val(progress.uraian_keputusan);
			$('[name="status_hasil"]').val(progress.status_hasil).trigger('chosen:updated');
			$('[name="status_sepakat"]').val(progress.status_sepakat).trigger('chosen:updated');
			$('[name="note_progress"]').val(progress.note_progress);
			$('[name="status_norma"]').val(progress.status_norma).trigger('chosen:updated');
			$('[name="uraian_norma"]').val(progress.uraian_norma);
			$('[name="status_aparat"]').val(progress.status_aparat).trigger('chosen:updated');
			$('[name="uraian_aparat"]').val(progress.uraian_aparat);
			$('[name="status_pencari"]').val(progress.status_pencari).trigger('chosen:updated');
			$('[name="status_klien"]').val(progress.status_klien).trigger('chosen:updated');
			$('[name="uraian_klien"]').val(progress.uraian_klien);
			$('[name="uraian_pencari"]').val(progress.uraian_pencari);
			$('[name="status_kembali"]').val(progress.status_kembali).trigger('chosen:updated');
			$('[name="id_tahap_progress"]').val(progress.id_tahap_progress).trigger('chosen:updated');
			$('[name="uraian_progress"]').val(progress.uraian_progress);
			$('[name="tgl_progress_next"]').val(progress.tgl_progress_next);
			$('[name="id_tahap_progress_next"]').val(progress.id_tahap_progress_next).trigger('chosen:updated');
			$('[name="uraian_progress_next"]').val(progress.uraian_progress_next);
			$('[name="id_jenis_dokumen"]').val(progress.id_jenis_dokumen).trigger('chosen:updated');
			
						
			if(progress.status_progress == 'Selesai')
			{
				if(progress.id_tindakan == '1')
				{
					$('#hasil_keputusan_box').hide();
					$('#uraian_keputusan_box').hide();
					$('#status_hasil_box').show();
					$('#status_sepakat_box').hide();
					$('#note_progress_box').show();
					$('#catatan_penting_box').hide();
					$('#status_norma_box').hide();
					$('#uraian_norma_box').hide();
					$('#status_aparat_box').hide();
					$('#uraian_aparat_box').hide();
					$('#status_pencari_box').hide();
					$('#uraian_pencari_box').hide();
					$('#status_klien_box').hide();
					$('#uraian_klien_box').hide();
					$('#status_kembali_box').hide();
				}
				else if(progress.id_tindakan == '2')
				{
					$('#hasil_keputusan_box').hide();
					$('#uraian_keputusan_box').hide();
					$('#status_hasil_box').show();
					$('#status_sepakat_box').show();
					$('#note_progress_box').show();
					$('#catatan_penting_box').hide();
					$('#status_norma_box').hide();
					$('#uraian_norma_box').hide();
					$('#status_aparat_box').hide();
					$('#uraian_aparat_box').hide();
					$('#status_pencari_box').hide();
					$('#uraian_pencari_box').hide();
					$('#status_klien_box').hide();
					$('#uraian_klien_box').hide();
					$('#status_kembali_box').hide();
				}
				else
				{
					$('#hasil_keputusan_box').show();
					$('#uraian_keputusan_box').show();
					$('#status_hasil_box').show();
					$('#status_sepakat_box').hide();
					$('#note_progress_box').hide();
					$('#catatan_penting_box').show();
					$('#status_norma_box').show();
					$('#uraian_norma_box').show();
					$('#status_aparat_box').show();
					$('#uraian_aparat_box').show();
					$('#status_pencari_box').show();
					$('#uraian_pencari_box').show();
					$('#status_klien_box').show();
					$('#status_kembali_box').show();	
				}		

				if(progress.status_norma == 'Tidak Sesuai')
				{
					$('#uraian_norma_box').show();	
				}
				else
				{
					$('#uraian_norma_box').hide();
				}

				if(progress.status_aparat == 'Tidak Sesuai')
				{
					$('#uraian_aparat_box').show();	
				}
				else
				{
					$('#uraian_aparat_box').hide();
				}

				if(progress.status_pencari == 'Tidak Sesuai')
				{
					$('#uraian_pencari_box').show();	
				}
				else
				{
					$('#uraian_pencari_box').hide();
				}

				if(progress.status_klien == 'Ya')
				{
					$('#uraian_klien_box').show();	
				}
				else
				{
					$('#uraian_klien_box').hide();
				}	
				
				$('#tahap_progress_box').hide();
				$('#uraian_progress_box').hide();
				$('#tgl_progress_next_box').hide();
				$('#tahap_progress_next_box').hide();
				$('#uraian_progress_next_box').hide();
				$('#jenis_dokumen_box').show();
			}
			else if(progress.status_progress == 'Gugur')
			{
				$('#hasil_keputusan_box').hide();
				$('#uraian_keputusan_box').hide();
				$('#status_hasil_box').hide();
				$('#status_sepakat_box').hide();
				$('#note_progress_box').show();
				$('#catatan_penting_box').hide();
				$('#status_norma_box').hide();
				$('#uraian_norma_box').hide();
				$('#status_aparat_box').hide();
				$('#uraian_aparat_box').hide();
				$('#status_pencari_box').hide();
				$('#uraian_pencari_box').hide();
				$('#status_klien_box').hide();
				$('#uraian_klien_box').hide();
				$('#status_kembali_box').hide();
				$('#tahap_progress_box').hide();
				$('#uraian_progress_box').hide();
				$('#tgl_progress_next_box').hide();
				$('#tahap_progress_next_box').hide();
				$('#uraian_progress_next_box').hide();
				$('#jenis_dokumen_box').show();
			}
			else
			{
				$('#hasil_keputusan_box').hide();
				$('#uraian_keputusan_box').hide();
				$('#status_hasil_box').hide();
				$('#status_sepakat_box').hide();
				$('#note_progress_box').hide();
				$('#catatan_penting_box').hide();
				$('#status_norma_box').hide();
				$('#uraian_norma_box').hide();
				$('#status_aparat_box').hide();
				$('#uraian_aparat_box').hide();
				$('#status_pencari_box').hide();
				$('#uraian_pencari_box').hide();
				$('#status_klien_box').hide();
				$('#uraian_klien_box').hide();
				$('#status_kembali_box').hide();
				$('#tahap_progress_box').show();
				$('#uraian_progress_box').show();
				$('#tgl_progress_next_box').show();
				$('#tahap_progress_next_box').show();
				$('#uraian_progress_next_box').show();
				$('#jenis_dokumen_box').show();
			}
			
			file_attachment = new Array();
			var files = response[3];
			
			if(!$.isArray(files) || !files.length)
			{
				$('#upload_lampiran_box').show();
				$('#lampiran').val('');
				$('#list_lampiran_box').show();
				$('#list_lampiran').empty();
			}
			else
			{
				$('#lampiran').val('');
				$('#upload_lampiran_box').show();
				$('#list_lampiran_box').show();
				$('#list_lampiran').empty();
				
				$.each(files, function(i, item){
					$('#list_lampiran').append(files[i].link);
					
					if(files[i].status)
					{
						file_attachment.push(files[i].id_file);
					}	
				});
			}
			
			$('#form-progress').modal({backdrop: 'static', keyboard: false})  
			$('#form-progress').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Progress'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Data Proses Perkembangan Bantuan Hukum');
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = '<?php echo site_url(''); ?>';
        }
    });	
}

function view(id_progress)
{
	$('#dd_no_reg').empty();
	$('#dd_id_pemohon').empty();
	$('#dd_tgl_progress').empty();
	$('#dd_status_progress').empty();
	$('#dd_hasil_keputusan').empty();
	$('#dd_uraian_keputusan').empty();
	$('#dd_status_hasil').empty();
	$('#dd_status_sepakat').empty();
	$('#dd_note_progress').empty();
	$('#dd_status_norma').empty();
	$('#dd_uraian_norma').empty();
	$('#dd_status_aparat').empty();
	$('#dd_uraian_aparat').empty();
	$('#dd_status_pencari').empty();
	$('#dd_uraian_pencari').empty();
	$('#dd_status_kembali').empty();
	$('#dd_tahap_progress').empty();
	$('#dd_uraian_progress').empty();
	$('#dd_status_klien').empty();
	$('#dd_uraian_klien').empty();
	$('#dd_tgl_progress_next').empty();
	$('#dd_tahap_progress_next').empty();
	$('#dd_uraian_progress_next').empty();
	$('#dd_jenis_dokumen').empty();
	$('ul#list_lampiran').empty();
	
	$.ajax({
        url : "<?php echo site_url('progress/view_detail_progress')?>/" + id_progress,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var progress = response[0];
			
			var files = response[1];
			
			$('#dd_no_reg').append(progress.no_reg);
			$('#dd_id_pemohon').append(progress.nm_pemohon);
			$('#dd_status_progress').append(progress.status_progress);
			$('#dd_tgl_progress').append(progress.tgl_progress);		
			
			if(progress.status_progress == 'Selesai')
			{
				if(progress.id_tindakan == '1')
				{
					$('#dd_hasil_keputusan_box').hide();
					$('#dd_uraian_keputusan_box').hide();
					$('#dd_status_hasil_box').show();
					$('#dd_status_sepakat_box').hide();
					$('#dd_note_progress_box').show();
					$('#dd_catatan_penting_box').hide();
					$('#dd_status_klien_box').hide();
					$('#dd_status_kembali_box').hide();
				}
				if(progress.id_tindakan == '2')
				{
					$('#dd_hasil_keputusan_box').hide();
					$('#dd_uraian_keputusan_box').hide();
					$('#dd_status_hasil_box').show();
					$('#dd_status_sepakat_box').show();
					$('#dd_note_progress_box').show();
					$('#dd_catatan_penting_box').hide();
					$('#dd_status_klien_box').hide();
					$('#dd_status_kembali_box').hide();
				}
				else
				{
					$('#dd_hasil_keputusan_box').show();
					$('#dd_uraian_keputusan_box').show();
					$('#dd_status_hasil_box').show();
					$('#dd_status_sepakat_box').hide();
					$('#dd_note_progress_box').hide();
					$('#dd_catatan_penting_box').show();
					$('#dd_status_klien_box').show();
					$('#dd_status_kembali_box').show();
				}		
				
				$('#dd_tahap_progress_box').hide();
				$('#dd_uraian_progress_box').hide();
				$('#dd_tgl_progress_next_box').hide();
				$('#dd_tahap_progress_next_box').hide();
				$('#dd_uraian_progress_next_box').hide();
				
				$('#dd_hasil_keputusan').append(progress.hasil_keputusan);
				$('#dd_uraian_keputusan').append(progress.uraian_keputusan);
				$('#dd_status_hasil').append(progress.status_hasil);
				$('#dd_status_sepakat').append(progress.status_sepakat);
				$('#dd_note_progress').append(progress.note_progress);
				$('#dd_status_norma').append(progress.status_norma);
				$('#dd_uraian_norma').append(progress.uraian_norma);

				if(progress.status_norma == 'Tidak Sesuai')
				{
					$('#dd_uraian_norma_box').show();	
				}
				else
				{
					$('#dd_uraian_norma_box').hide();
				}

				$('#dd_status_aparat').append(progress.status_aparat);
				$('#dd_uraian_aparat').append(progress.uraian_aparat);

				if(progress.status_aparat == 'Tidak Sesuai')
				{
					$('#dd_uraian_aparat_box').show();	
				}
				else
				{
					$('#dd_uraian_aparat_box').hide();
				}

				$('#dd_status_pencari').append(progress.status_pencari);
				$('#dd_uraian_pencari').append(progress.uraian_pencari);

				if(progress.status_pencari == 'Tidak Sesuai')
				{
					$('#dd_uraian_pencari_box').show();	
				}
				else
				{
					$('#dd_uraian_pencari_box').hide();
				}

				$('#dd_status_klien').append(progress.status_klien);
				$('#dd_uraian_klien').append(progress.uraian_klien);

				if(progress.status_klien == 'Ya')
				{
					$('#dd_uraian_klien_box').show();	
				}
				else
				{
					$('#dd_uraian_klien_box').hide();
				}

				$('#dd_status_kembali').append(progress.status_kembali);
				$('#dd_tahap_progress').append(progress.tahap_progress);
				$('#dd_uraian_progress').append(progress.uraian_progress);
				$('#dd_tgl_progress_next').append(progress.tgl_progress_next);
				$('#dd_tahap_progress_next').append(progress.tahap_progress_next);
				$('#dd_uraian_progress_next').append(progress.uraian_progress_next);
				$('#dd_jenis_dokumen').append(progress.jenis_dokumen);
			}
			else if(progress.status_progress == 'Gugur')
			{
				$('#dd_hasil_keputusan_box').hide();
				$('#dd_uraian_keputusan_box').hide();
				$('#dd_status_hasil_box').hide();
				$('#dd_status_sepakat_box').hide();
				$('#dd_note_progress_box').show();
				$('#dd_catatan_penting_box').hide();
				$('#dd_status_klien_box').hide();
				$('#dd_uraian_klien_box').hide();
				$('#dd_status_kembali_box').hide();
				$('#dd_tahap_progress_box').hide();
				$('#dd_uraian_progress_box').hide();
				$('#dd_tgl_progress_next_box').hide();
				$('#dd_tahap_progress_next_box').hide();
				$('#dd_uraian_progress_next_box').hide();
				
				$('#dd_hasil_keputusan').append(progress.hasil_keputusan);
				$('#dd_uraian_keputusan').append(progress.uraian_keputusan);
				$('#dd_status_hasil').append(progress.status_hasil);
				$('#dd_status_sepakat').append(progress.status_sepakat);
				$('#dd_note_progress').append(progress.note_progress);
				$('#dd_status_norma').append(progress.status_norma);
				$('#dd_uraian_norma').append(progress.uraian_norma);
				$('#dd_status_aparat').append(progress.status_aparat);
				$('#dd_uraian_aparat').append(progress.uraian_aparat);
				$('#dd_status_pencari').append(progress.status_pencari);
				$('#dd_uraian_pencari').append(progress.uraian_pencari);
				$('#dd_status_kembali').append(progress.status_kembali);
				$('#dd_tahap_progress').append(progress.tahap_progress);
				$('#dd_uraian_progress').append(progress.uraian_progress);
				$('#dd_status_klien').append(progress.status_klien);
				$('#dd_uraian_klien').append(progress.uraian_klien);
				$('#dd_tgl_progress_next').append(progress.tgl_progress_next);
				$('#dd_tahap_progress_next').append(progress.tahap_progress_next);
				$('#dd_uraian_progress_next').append(progress.uraian_progress_next);
				$('#dd_jenis_dokumen').append(progress.jenis_dokumen);
			}
			else
			{
				$('#dd_hasil_keputusan_box').hide();
				$('#dd_uraian_keputusan_box').hide();
				$('#dd_status_hasil_box').hide();
				$('#dd_status_sepakat_box').hide();
				$('#dd_note_progress_box').hide();
				$('#dd_catatan_penting_box').hide();
				$('#dd_status_klien_box').hide();
				$('#dd_uraian_klien_box').hide();
				$('#dd_status_kembali_box').hide();
				$('#dd_tahap_progress_box').show();
				$('#dd_uraian_progress_box').show();
				$('#dd_tgl_progress_next_box').show();
				$('#dd_tahap_progress_next_box').show();
				$('#dd_uraian_progress_next_box').show();
				
				$('#dd_hasil_keputusan').append(progress.hasil_keputusan);
				$('#dd_uraian_keputusan').append(progress.uraian_keputusan);
				$('#dd_status_hasil').append(progress.status_hasil);
				$('#dd_status_sepakat').append(progress.status_sepakat);
				$('#dd_note_progress').append(progress.note_progress);
				$('#dd_status_norma').append(progress.status_norma);
				$('#dd_uraian_norma').append(progress.uraian_norma);
				$('#dd_status_aparat').append(progress.status_aparat);
				$('#dd_uraian_aparat').append(progress.uraian_aparat);
				$('#dd_status_pencari').append(progress.status_pencari);
				$('#dd_uraian_pencari').append(progress.uraian_pencari);
				$('#dd_status_kembali').append(progress.status_kembali);
				$('#dd_tahap_progress').append(progress.tahap_progress);
				$('#dd_uraian_progress').append(progress.uraian_progress);
				$('#dd_status_klien').append(progress.status_klien);
				$('#dd_uraian_klien').append(progress.uraian_klien);
				$('#dd_tgl_progress_next').append(progress.tgl_progress_next);
				$('#dd_tahap_progress_next').append(progress.tahap_progress_next);
				$('#dd_uraian_progress_next').append(progress.uraian_progress_next);
				$('#dd_jenis_dokumen').append(progress.jenis_dokumen);
			}
			
			if(!$.isArray(files) || !files.length)
			{
				$('ul#list_lampiran').empty();
				$('ul#list_lampiran').append('<li class="list-group-item">Tidak ada lampiran</li>');
			}
			else
			{		
				$('ul#list_lampiran').empty();
				$.each(files, function(i, item){
					$('ul#list_lampiran').append(files[i].link);
				});
			}	
			
			
			$('#view-progress').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Progress'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Data Proses Perkembangan Bantuan Hukum');
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = '<?php echo site_url(''); ?>';
        }
    });	
	
}

function del(id_progress)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_progress: id_progress
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('progress/ajax_delete')?>",
            type: "POST",
			data: formData,
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#form-progress').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
	
    }
}

function up(id_progress)
{
    $('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$.ajax({
		url : "<?php echo site_url('progress/get_file_progress')?>/" + id_progress,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			$('[name="id_progressx"]').val(id_progress);
			
			var data = response[0];
			
			$('[name="id_jenis_dokumenx"]').val(data.id_jenis_dokumen).trigger('chosen:updated');
			
			var files = response[1];
			
			file_attachment = new Array();
			if(!$.isArray(files) || !files.length)
			{
				$('#upload_lampiranx_box').show();
				$('#lampiranx').val('');
				$('#list_lampiranx_box').show();
				$('#list_lampiranx').empty();
			}
			else
			{
				$('#lampiranx').val('');
				$('#upload_lampiranx_box').show();
				$('#list_lampiranx_box').show();
				$('#list_lampiranx').empty();
				
				$.each(files, function(i, item){
					$('#list_lampiranx').append(files[i].link);
					
					if(files[i].status)
					{
						file_attachment.push(files[i].id_file);
					}	
				});
			}
			
			$('#form-upload_progress').modal({backdrop: 'static', keyboard: false})  
			$('#form-upload_progress').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Upload'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Upload Dokumen'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function save_upload()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		id_progressx: $('[name="id_progressx"]').val(),
		id_jenis_dokumenx: $('[name="id_jenis_dokumenx"]').val(),
		file_attachment: file_attachment
	};
	
	url = "<?php echo site_url('progress/ajax_save_file_progress'); ?>";
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData,
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				
				$('#form-upload_progress').modal('hide');
				reload_table();	
			}
			else
			{
				for (var i = 0; i < data.inputerror.length; i++) 
				{
					$('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
					//$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
				}
			}		
		}
		
	});		
	
}

function view_file(id_file)
{
	//alert(id_file);
	url = "<?php echo site_url('progress/get_file_attachment')?>/"+id_file;
	window.open(url);
}

function reload_table()
{
    var Tbl_Progress = $('#Tbl_Progress').DataTable();
	Tbl_Progress.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
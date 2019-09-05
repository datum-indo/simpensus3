<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Approval = $('#Tbl_Approval').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('approval/ajax_list'); ?>",
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
		Tbl_Approval.search( '' ) .columns().search( '' ) .draw();
	});
	
	$(".chosen-select").chosen();
	$(".chosen-select-deselect").chosen({ allow_single_deselect: true, width: '100%'});
	
	$(".chosen-select").val('').trigger("chosen:updated");
	$(".chosen-select-deselect").val('').trigger("chosen:updated");
	
	$("input").change(function()
	{
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});
    
	$("textarea").change(function()
	{
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});
	
		
	$("select").change(function()
	{
		$(this).parent().parent().removeClass('has-error');
		//$(this).next().empty();
	});
	
		
	var _id_nama_kasus = $('#id_nama_kasus');
	_id_nama_kasus.val('');
	_id_nama_kasus.prop({disabled: true});
	_id_nama_kasus.trigger('chosen:updated');
	
	var _id_posisi_hukum = $('#id_posisi_hukum');
	_id_posisi_hukum.val('');
	_id_posisi_hukum.prop({disabled: true});
	_id_posisi_hukum.trigger('chosen:updated');
	
	var _status_approval = $('#status_approval');
	_status_approval.val('');
	_status_approval.prop({disabled: true});
	_status_approval.trigger('chosen:updated');
	
	$('[name="id_permohonan"]').change(function ()
	{
		var id_permohonan = $('[name="id_permohonan"]').val();
		if(id_permohonan != "")
		{
			_status_approval.val('');
			_status_approval.prop({disabled: false});
			_status_approval.trigger('chosen:updated');
				
		}	
		else
		{
			_status_approval.val('');
			_status_approval.prop({disabled: true});
			_status_approval.trigger('chosen:updated');
			
			$('#jenis_kasus_box').hide();
			$('[name="id_jenis_kasus"]').val('').trigger('chosen:updated');
			
			$('#id_nama_kasus').empty();
			_id_nama_kasus.prop({disabled: true});
			$('#id_nama_kasus').append('<option value=""></option>');
			$('#id_nama_kasus').trigger('chosen:updated');
			
			$('#id_posisi_hukum').empty();
			_id_posisi_hukum.prop({disabled: true});
			$('#id_posisi_hukum').append('<option value=""></option>');
			$('#id_posisi_hukum').trigger('chosen:updated');
			
			$('#nama_kasus_box').hide();
			$('[name="id_nama_kasus"]').val('').trigger('chosen:updated');
			
			$('#posisi_hukum_box').hide();
			$('[name="id_posisi_hukum"]').val('').trigger('chosen:updated');
			
			$('#tindakan_box').hide();
			$('[name="id_tindakan"]').val('').trigger('chosen:updated');
			
			$('#analis_box').hide();
			$('[name="id_analis"]').val('').trigger('chosen:updated');
			
			$('#asisten_box').hide();
			$('[name="id_asisten"]').val('').trigger('chosen:updated');
			
			$('#alasan_penolakan_box').hide();
			$('[name="alasan_penolakan[]"]').val('').trigger('chosen:updated');
						
			$('[name="desc_lain"]').val('');
			$('#desc_lain_box').hide();
			
			$('#status_rekomendasi_box').hide();
			$('[name="status_rekomendasi"]').val('').trigger('chosen:updated');
						
			$('#alasan_rekomendasi_box').hide();
			$('#alasan_rekomendasi').val('');
			
			$('#advokat_box').hide();
			$('[name="id_advokat"]').val('').trigger('chosen:updated');
		}	
	});
	
	$('[name="id_jenis_kasus"]').change(function ()
	{
		var id_jenis_kasus = $('[name="id_jenis_kasus"]').val();
		if(id_jenis_kasus != "")
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('approval/get_nama_kasus'); ?>/" + id_jenis_kasus,
				success: function(daftar_kasus) 
				{
					$('#id_nama_kasus').empty();
					_id_nama_kasus.append('<option value=""></option>');
					$.each(daftar_kasus, function(id_nama_kasus, nm_nama_kasus) {
						var opt = $('<option />'); 
						opt.val(id_nama_kasus);
						opt.text(nm_nama_kasus);
						_id_nama_kasus.append(opt); 
					});
					_id_nama_kasus.prop({disabled: false});
					_id_nama_kasus.trigger('chosen:updated');
					
				}
			});		
			
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('approval/get_posisi_hukum'); ?>/" + id_jenis_kasus,
				success: function(posisi_hukum) 
				{
					$('#id_posisi_hukum').empty();
					_id_posisi_hukum.append('<option value=""></option>');
					$.each(posisi_hukum, function(id_posisi_hukum, nm_posisi_hukum) {
						var opt = $('<option />'); 
						opt.val(id_posisi_hukum);
						opt.text(nm_posisi_hukum);
						_id_posisi_hukum.append(opt); 
					});
					_id_posisi_hukum.prop({disabled: false});
					_id_posisi_hukum.trigger('chosen:updated');
				}	 
			});	
		}	
		else
		{
			$('#id_nama_kasus').empty();
			_id_nama_kasus.prop({disabled: true});
			$('#id_nama_kasus').append('<option value=""></option>');
			$('#id_nama_kasus').trigger('chosen:updated');
			
			$('#id_posisi_hukum').empty();
			_id_posisi_hukum.prop({disabled: true});
			$('#id_posisi_hukum').append('<option value=""></option>');
			$('#id_posisi_hukum').trigger('chosen:updated');
		}	
	});
	
	
	$('[name="status_approval"]').change(function ()
	{
		if($(this).val() == "Ditolak")
		{
			$('#jenis_kasus_box').hide();
			$('[name="id_jenis_kasus"]').val('').trigger('chosen:updated');
			
			$('#nama_kasus_box').hide();
			$('[name="id_nama_kasus"]').val('').trigger('chosen:updated');
			
			$('#posisi_hukum_box').hide();
			$('[name="id_posisi_hukum"]').val('').trigger('chosen:updated');
			
			$('#tindakan_box').hide();
			$('[name="id_tindakan"]').val('').trigger('chosen:updated');
			
			$('#analis_box').hide();
			$('[name="id_analis"]').val('').trigger('chosen:updated');
			
			$('#asisten_box').hide();
			$('[name="id_asisten"]').val('').trigger('chosen:updated');
			
			$('#alasan_penolakan_box').show();
			$('[name="alasan_penolakan[]"]').val('').trigger('chosen:updated');
			
			$('[name="desc_lain"]').val('');
			$('#desc_lain_box').hide();
			
			$('#status_rekomendasi_box').show();
			$('[name="status_rekomendasi"]').val('').trigger('chosen:updated');
			
			$('#advokat_box').hide();
			$('[name="id_advokat"]').val('').trigger('chosen:updated');
			
			$('#alasan_rekomendasi_box').hide();
			$('#alasan_rekomendasi').val('');
		}
		else if($(this).val() == "Diterima")
		{
			$('#jenis_kasus_box').show();
			$('[name="id_jenis_kasus"]').val('').trigger('chosen:updated');
			
			$('#id_nama_kasus').empty();
			_id_nama_kasus.prop({disabled: true});
			$('#id_nama_kasus').append('<option value=""></option>');
			$('#id_nama_kasus').trigger('chosen:updated');
			
			$('#id_posisi_hukum').empty();
			_id_posisi_hukum.prop({disabled: true});
			$('#id_posisi_hukum').append('<option value=""></option>');
			$('#id_posisi_hukum').trigger('chosen:updated');
			
			$('#nama_kasus_box').show();
			$('[name="id_nama_kasus"]').val('').trigger('chosen:updated');
			
			$('#posisi_hukum_box').show();
			$('[name="id_posisi_hukum"]').val('').trigger('chosen:updated');
			
			$('#tindakan_box').show();
			$('[name="id_tindakan"]').val('').trigger('chosen:updated');
			
			$('#analis_box').show();
			$('[name="id_analis"]').val('').trigger('chosen:updated');
			
			$('#asisten_box').show();
			$('[name="id_asisten"]').val('').trigger('chosen:updated');
			
			$('#alasan_penolakan_box').hide();
			$('[name="alasan_penolakan[]"]').val('').trigger('chosen:updated');
						
			$('[name="desc_lain"]').val('');
			$('#desc_lain_box').hide();
			
			$('#status_rekomendasi_box').hide();
			$('[name="status_rekomendasi"]').val('').trigger('chosen:updated');
						
			$('#alasan_rekomendasi_box').hide();
			$('#alasan_rekomendasi').val('');
			
			$('#advokat_box').hide();
			$('[name="id_advokat"]').val('').trigger('chosen:updated');
		}	
		else
		{
			$('#jenis_kasus_box').hide();
			$('[name="id_jenis_kasus"]').val('').trigger('chosen:updated');
			
			$('#nama_kasus_box').hide();
			$('[name="id_nama_kasus"]').prop({disabled: false});
			$('[name="id_nama_kasus"]').val('').trigger('chosen:updated');
			
			$('#posisi_hukum_box').hide();
			$('[name="id_posisi_hukum"]').prop({disabled: false});
			$('[name="id_posisi_hukum"]').val('').trigger('chosen:updated');
			
			$('#tindakan_box').hide();
			$('[name="id_tindakan"]').val('').trigger('chosen:updated');
			
			$('#analis_box').hide();
			$('[name="id_analis"]').val('').trigger('chosen:updated');
			
			$('#asisten_box').hide();
			$('[name="id_asisten"]').val('').trigger('chosen:updated');
			
			$('#alasan_penolakan_box').hide();
			$('[name="alasan_penolakan[]"]').val('').trigger('chosen:updated');
						
			$('[name="desc_lain"]').val('');
			$('#desc_lain_box').hide();
			
			$('#status_rekomendasi_box').hide();
			$('[name="status_rekomendasi"]').val('').trigger('chosen:updated');
						
			$('#alasan_rekomendasi_box').hide();
			$('#alasan_rekomendasi').val('');
			
			$('#advokat_box').hide();
			$('[name="id_advokat"]').val('').trigger('chosen:updated');
		}	
	});
	
	$('.alasan_penolakan').chosen().change(function (e, params)
	{
		var alasan_lain = '8';
		var alasan = $('.alasan_penolakan').chosen().val();
		var a = alasan.indexOf(alasan_lain);
		if(a > -1)
		{
			$('#desc_lain_box').show();
			$('[name="desc_lain"]').val('');
		}
		else
		{
			$('#desc_lain_box').hide();
			$('[name="desc_lain"]').val('');
		}		
		
	});
	
	$('[name="status_rekomendasi"]').change(function ()
	{
		var status_rekomendasi = $('[name="status_rekomendasi"]').val();
		if(status_rekomendasi == "Ya")
		{
			$('#alasan_rekomendasi_box').hide();
			$('[name="alasan_rekomendasi"]').val('');
			
			$('#advokat_box').show();
			$('[name="id_advokat"]').val('').trigger('chosen:updated');
					
		}
		else if(status_rekomendasi == "Tidak")
		{
			$('#alasan_rekomendasi_box').show();
			$('[name="alasan_rekomendasi"]').val('');
			
			$('#advokat_box').hide();
			$('[name="id_advokat"]').val('').trigger('chosen:updated');
					
		}		
		else
		{
			$('#alasan_rekomendasi_box').hide();
			$('[name="alasan_rekomendasi"]').val('');
			
			$('#advokat_box').hide();
			$('[name="id_advokat"]').val('').trigger('chosen:updated');
		}	
	});
	
	file_approval = new Array();
	
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
			url: "<?php echo site_url('approval/ajax_upload_approval/')?>/",
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
						file_approval.push(response[i].id_file);
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
		var index = file_approval.indexOf(id_file);
				
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
					url : "<?php echo site_url('approval/ajax_delete_attachment')?>/",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_approval.splice(index,1);	
						elem.closest('li').remove();
						//alert(file_approval);	
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
		type: 'approval'
	}
	$.ajax({
        url : "<?php echo site_url('approval/ajax_new/')?>/",
        type: "GET",
        dataType: "JSON",
		data: formData,
        success: function(response)
        {
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string
			
			var data = response[0];
			var permohonan = response[1];
			
			$('[name="id_approval"]').val(data.id_approval);
			$('[name="id_permohonan"]').val(data.id_permohonan);
			var _id_permohonan = $('[name="id_permohonan"]');
						
			$('#id_permohonan').empty();
			_id_permohonan.append('<option value=""></option>');
			$.each(permohonan, function(id_permohonan, detail_permohonan) {
				var opt = $('<option />'); 
				opt.val(id_permohonan);
				opt.text(detail_permohonan);
				_id_permohonan.append(opt); 
			});
			_id_permohonan.chosen().chosenReadonly(false);
			_id_permohonan.trigger('chosen:updated');
			
			$('#jenis_kasus_box').hide();
			$('[name="id_jenis_kasus"]').val(data.id_jenis_kasus).trigger('chosen:updated');
			
			$('#nama_kasus_box').hide();
			$('[name="id_nama_kasus"]').val(data.id_nama_kasus).trigger('chosen:updated');
			
			$('#posisi_hukum_box').hide();
			$('[name="id_posisi_hukum"]').val(data.id_posisi_hukum).trigger('chosen:updated');
			
			$('#tindakan_box').hide();
			$('[name="id_tindakan"]').val(data.id_tindakan).trigger('chosen:updated');
			
			$('#analis_box').hide();
			$('[name="id_analis"]').val(data.id_analis).trigger('chosen:updated');
			
			$('#asisten_box').hide();
			$('[name="id_asisten"]').val(data.id_asisten).trigger('chosen:updated');
			
			$('#alasan_penolakan_box').hide();
			$('[name="alasan_penolakan[]"]').val(data.alasan_penolakan).trigger('chosen:updated');
						
			$('[name="desc_lain"]').val(data.desc_lain);
			$('#desc_lain_box').hide();
			
			$('#status_rekomendasi_box').hide();
			$('[name="status_rekomendasi"]').val(data.status_rekomendasi).trigger('chosen:updated');
						
			$('#alasan_rekomendasi_box').hide();
			$('#alasan_rekomendasi').val(data.alasan_rekomendasi);
			
			$('#advokat_box').hide();
			$('[name="id_advokat"]').val(data.id_advokat).trigger('chosen:updated');
			
			$('#form-approval').modal({backdrop: 'static', keyboard: false})  
			$('#form-approval').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Approval'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Data Persetujuan Bantuan Hukum'); // Set title to Bootstrap modal title
					
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
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_approval: $('[name="id_approval"]').val(),
		id_permohonan: $('[name="id_permohonan"]').val(),
		status_approval: $('[name="status_approval"]').val(),
		id_jenis_kasus: $('[name="id_jenis_kasus"]').val(),
		id_nama_kasus: $('[name="id_nama_kasus"]').val(),
		id_posisi_hukum: $('[name="id_posisi_hukum"]').val(),
		id_tindakan: $('[name="id_tindakan"]').val(),
		id_analis: $('[name="id_analis"]').val(),
		id_asisten: $('[name="id_asisten"]').val(),
		alasan_penolakan: $('[name="alasan_penolakan[]"]').val(),
		desc_lain: $('[name="desc_lain"]').val(),
		status_rekomendasi: $('[name="status_rekomendasi"]').val(),
		id_advokat: $('[name="id_advokat"]').val(),
		alasan_rekomendasi: $('[name="alasan_rekomendasi"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('approval/ajax_save'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('approval/ajax_update'); ?>";
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
				
				$('#form-approval').modal('hide');
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

function edit(id_permohonan, id_role)
{
	$('#formApproval')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('approval/get_detail_approval')?>/" + id_permohonan,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var approval = response[0];
			$('[name="id_approval"]').val(approval.id_approval);
			$('[name="id_permohonan"]').val(approval.id_permohonan).trigger('chosen:updated');
			$('[name="status_approval"]').val(approval.status_approval).trigger('chosen:updated');
			
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
			
			var nama_kasus = response[2];
			var _id_nama_kasus = $('[name="id_nama_kasus"]');
						
			$('#id_nama_kasus').empty();
			_id_nama_kasus.append('<option value=""></option>');
			$.each(nama_kasus, function(id_nama_kasus, nm_nama_kasus) {
				var opt = $('<option />'); 
				opt.val(id_nama_kasus);
				opt.text(nm_nama_kasus);
				_id_nama_kasus.append(opt); 
			});
			_id_nama_kasus.trigger('chosen:updated');
						
			var posisi_hukum = response[3];
			var _id_posisi_hukum = $('[name="id_posisi_hukum"]');
						
			$('#id_posisi_hukum').empty();
			_id_posisi_hukum.append('<option value=""></option>');
			$.each(posisi_hukum, function(id_posisi_hukum, nm_posisi_hukum) {
				var opt = $('<option />'); 
				opt.val(id_posisi_hukum);
				opt.text(nm_posisi_hukum);
				_id_posisi_hukum.append(opt); 
			});
			_id_posisi_hukum.trigger('chosen:updated');
						
			var alasan_penolakan = response[4];
			var alasan = alasan_penolakan.alasan_penolakan;
						
			if(approval.status_approval == 'Diterima')
			{
				$('#jenis_kasus_box').show();
				$('[name="id_jenis_kasus"]').val(approval.id_jenis_kasus).trigger('chosen:updated');
				
				$('#nama_kasus_box').show();
				$('[name="id_nama_kasus"]').prop({disabled: false});
				$('[name="id_nama_kasus"]').val(approval.id_nama_kasus).trigger('chosen:updated');
				
				$('#posisi_hukum_box').show();
				$('[name="id_posisi_hukum"]').prop({disabled: false});
				$('[name="id_posisi_hukum"]').val(approval.id_posisi_hukum).trigger('chosen:updated');
				
				$('#tindakan_box').show();
				$('[name="id_tindakan"]').val(approval.id_tindakan).trigger('chosen:updated');
				
				$('#analis_box').show();
				$('[name="id_analis"]').val(approval.id_analis).trigger('chosen:updated');
				
				$('#asisten_box').show();
				$('[name="id_asisten"]').val(approval.id_asisten).trigger('chosen:updated');
				
				$('#alasan_penolakan_box').hide();
				$('[name="alasan_penolakan[]"]').val('').trigger('chosen:updated');
							
				$('[name="desc_lain"]').val('');
				$('#desc_lain_box').hide();
				
				$('#status_rekomendasi_box').hide();
				$('[name="status_rekomendasi"]').val(approval.status_rekomendasi).trigger('chosen:updated');
							
				$('#alasan_rekomendasi_box').hide();
				$('#alasan_rekomendasi').val(approval.alasan_rekomendasi);
				
				$('#advokat_box').hide();
				$('[name="id_advokat"]').val(approval.id_advokat).trigger('chosen:updated');
			}
			else
			{
				$('#jenis_kasus_box').hide();
				$('[name="id_jenis_kasus"]').val(approval.id_jenis_kasus).trigger('chosen:updated');
				
				$('#nama_kasus_box').hide();
				$('[name="id_nama_kasus"]').prop({disabled: false});
				$('[name="id_nama_kasus"]').val(approval.id_nama_kasus).trigger('chosen:updated');
				
				$('#posisi_hukum_box').hide();
				$('[name="id_posisi_hukum"]').prop({disabled: false});
				$('[name="id_posisi_hukum"]').val(approval.id_posisi_hukum).trigger('chosen:updated');
				
				$('#tindakan_box').hide();
				$('[name="id_tindakan"]').val(approval.id_tindakan).trigger('chosen:updated');
				
				$('#analis_box').hide();
				$('[name="id_analis"]').val(approval.id_analis).trigger('chosen:updated');
				
				$('#asisten_box').hide();
				$('[name="id_asisten"]').val(approval.id_asisten).trigger('chosen:updated');
				
				var alasan = alasan.replace(/0/g, "");
				$('#alasan_penolakan_box').show();
				$('[name="alasan_penolakan[]"]').val(alasan.split(','));
				$('[name="alasan_penolakan[]"]').trigger('chosen:updated');
				
				var alasan_lain = '8';
				var a = alasan.indexOf(alasan_lain);
				if(a > -1)
				{
					$('[name="desc_lain"]').val(approval.desc_lain);
					$('#desc_lain_box').show();
				}
				else
				{
					$('[name="desc_lain"]').val(approval.desc_lain);
					$('#desc_lain_box').hide();
				}		
				
				$('#status_rekomendasi_box').show();
				$('[name="status_rekomendasi"]').val(approval.status_rekomendasi).trigger('chosen:updated');
				
				if(approval.status_rekomendasi == 'Ya')
				{
					$('#advokat_box').show();
					$('[name="id_advokat"]').val(approval.id_advokat).trigger('chosen:updated');
					
					$('#alasan_rekomendasi_box').hide();
					$('[name="alasan_rekomendasi"]').val(approval.alasan_rekomendasi);
				}
				else
				{
					$('#advokat_box').hide();
					$('[name="id_advokat"]').val(approval.id_advokat).trigger('chosen:updated');
					
					$('#alasan_rekomendasi_box').show();
					$('[name="alasan_rekomendasi"]').val(approval.alasan_rekomendasi);	
				}	
			}		
			
			if(id_role == '1' || id_role == '2')
			{
				var _status_approval = $('#status_approval');
				_status_approval.prop({disabled: false});
				_status_approval.trigger('chosen:updated');	
			}
			else
			{
				var _status_approval = $('#status_approval');
				_status_approval.prop({disabled: true});
				_status_approval.trigger('chosen:updated');	
			}		
			
			$('#form-approval').modal({backdrop: 'static', keyboard: false})  		
			$('#form-approval').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Approval'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Data Persetujuan Bantuan Hukum');
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = '<?php echo site_url(''); ?>';
        }
    });	
}

function view(id_permohonan)
{
	$('#dd_no_reg').empty();
	$('#dd_tgl_reg').empty();
	$('#dd_id_pemohon').empty();
	$('#dd_tgl_approval').empty();
	$('#dd_status_approval').empty();
	$('#dd_jenis_kasus').empty();
	$('#dd_nama_kasus').empty();
	$('#dd_posisi_hukum').empty();
	$('#dd_tindakan').empty();
	$('#dd_analis').empty();
	$('#dd_asisten').empty();
	$('#dd_alasan_penolakan').empty();
	$('#dd_desc_lain').empty();
	$('#dd_status_rekomendasi').empty();
	$('#dd_advokat').empty();
	$('#dd_alasan_rekomendasi').empty();		
	
	$.ajax({
        url : "<?php echo site_url('approval/view_detail_approval')?>/" + id_permohonan,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var approval = response[0];
			
			var alasan_penolakan = response[1];
			
			$('#dd_no_reg').append(approval.no_reg);
			$('#dd_tgl_reg').append(approval.tgl_reg);
			$('#dd_id_pemohon').append(approval.nm_pemohon);
			$('#dd_tgl_approval').append(approval.tgl_approval);
			$('#dd_status_approval').append(approval.status_approval);
					
				
			if(approval.status_approval == 'Diterima')
			{
				$('#dd_jenis_kasus_box').show();
				$('#dd_nama_kasus_box').show();
				$('#dd_posisi_hukum_box').show();
				$('#dd_tindakan_box').show();
				$('#dd_analis_box').show();
				$('#dd_asisten_box').show();
				$('#dd_alasan_penolakan_box').hide();
				$('#dd_desc_lain_box').hide();
				$('#dd_status_rekomendasi_box').hide();
				$('#dd_advokat_box').hide();
				$('#dd_alasan_rekomendasi_box').hide();
				
				$('#dd_jenis_kasus').append(approval.jenis_kasus);
				$('#dd_nama_kasus').append(approval.nama_kasus);
				$('#dd_posisi_hukum').append(approval.posisi_hukum);
				$('#dd_tindakan').append(approval.tindakan);
				$('#dd_analis').append(approval.nm_analis);
				$('#dd_asisten').append(approval.nm_asisten);
				
				$('#dd_alasan_penolakan').empty();
				$('#dd_desc_lain').empty();
				$('#dd_status_rekomendasi').empty();
				$('#dd_advokat').empty();
				$('#dd_alasan_rekomendasi').empty();
				
			}
			else
			{
				$('#dd_jenis_kasus_box').hide();
				$('#dd_nama_kasus_box').hide();
				$('#dd_posisi_hukum_box').hide();
				$('#dd_tindakan_box').hide();
				$('#dd_analis_box').hide();
				$('#dd_asisten_box').hide();
				$('#dd_alasan_penolakan_box').show();
				$('#dd_status_rekomendasi_box').show();
				
				$('#dd_jenis_kasus').empty();
				$('#dd_nama_kasus').empty();
				$('#dd_posisi_hukum').empty();
				$('#dd_tindakan').empty();
				$('#dd_analis').empty();
				$('#dd_asisten').empty();
				
				var alasan = alasan_penolakan.alasan_penolakan;
				var alasan = alasan.replace(",", "\n");
				//var alasany = alasanx.replace(/,/g, "<br>");
				
				$('#dd_alasan_penolakan').append(alasan.replace(/,/g, "<br>"));
				
				var alasan_lain = 'Lain-lain';
				var a = alasan.indexOf(alasan_lain);
				if(a > -1)
				{
					$('#dd_desc_lain').append(approval.desc_lain);
					$('#dd_desc_lain_box').show();
				}
				else
				{
					$('#dd_desc_lain').empty();
					$('#dd_desc_lain_box').hide();
				}		
				
				//
				$('#dd_status_rekomendasi').append(approval.status_rekomendasi);
				
				
				if(approval.status_rekomendasi == 'Ya')
				{
					$('#dd_advokat_box').show();
					$('#dd_alasan_rekomendasi_box').hide();
					
					$('#dd_advokat').append(approval.nm_advokat);
					$('#dd_alasan_rekomendasi').empty();	
				}
				else
				{
					$('#dd_advokat_box').hide();
					$('#dd_alasan_rekomendasi_box').show();
					
					$('#dd_advokat').empty();
					$('#dd_alasan_rekomendasi').append(approval.alasan_rekomendasi);
				}		
				
			}
			
			
			$('#view-approval').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Approval'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Data Persetujuan Bantuan Hukum');
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = '<?php echo site_url(''); ?>';
        }
    });	
	
}

function del(id_permohonan)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_permohonan: id_permohonan
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('approval/ajax_delete')?>",
            type: "POST",
			data: formData,
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#form-approval').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function up(id_approval)
{
    $('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$.ajax({
		url : "<?php echo site_url('approval/get_file_approval')?>/" + id_approval,
        type: "GET",
        dataType: "JSON",
        success: function(files)
        {
			$('[name="id_approvalx"]').val(id_approval);
			
			file_approval = new Array();
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
						file_approval.push(files[i].id_file);
					}	
				});
			}
			
			$('#form-upload_approval').modal({backdrop: 'static', keyboard: false})  
			$('#form-upload_approval').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Upload'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Upload Dokumen Approval'); // Set title to Bootstrap modal title
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
		id_approval: $('[name="id_approvalx"]').val(),
		file_approval: file_approval
	};
	
	url = "<?php echo site_url('approval/ajax_save_file_approval'); ?>";
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData,//$('#formApproval').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				
				$('#form-upload_approval').modal('hide');
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
	url = "<?php echo site_url('approval/get_file_attachment')?>/"+id_file;
	window.open(url);
}

function pdf_approval(id_permohonan)
{
	url = "<?php echo site_url('approval/get_pdf_approval')?>/"+id_permohonan;
	window.open(url);
}

function reload_table()
{
    var Tbl_Approval = $('#Tbl_Approval').DataTable();
	Tbl_Approval.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
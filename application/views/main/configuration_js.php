<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Setting = $('#Tbl_Setting').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('setting/ajax_list_configuration'); ?>",
			"type": "POST"
		},
		
		"columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
				
        }
        ],
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
	
	var _id_provinsi = $('select[name="id_provinsi"]');
	var _id_kabkota = $('select[name="id_kabkota"]');
	_id_kabkota.children().remove().end();
	_id_kabkota.prop({disabled: true});
	_id_kabkota.trigger('chosen:updated');
	
	$('#id_provinsi').change(function ()
	{
		var id_provinsi = $('#id_provinsi').val();
		if(id_provinsi != "")
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('setting/get_kabkota'); ?>/" + id_provinsi,
				success: function(kabkota) 
				{
					$('#id_kabkota').empty();
					_id_kabkota.append('<option value=""></option>');
					$.each(kabkota, function(id_kabkota, nm_kabkota) {
						var opt = $('<option />'); 
						opt.val(id_kabkota);
						opt.text(nm_kabkota);
						_id_kabkota.append(opt); 
					});
					_id_kabkota.prop({disabled: false});
					_id_kabkota.trigger('chosen:updated');
				}	 
			});	
		}	
		else
		{
			$('#id_kabkota').empty();
			_id_kabkota.prop({disabled: true});
			$('#id_kabkota').append('<option value=""></option>');
			$('#id_kabkota').trigger('chosen:updated');
		}
	});		
});	

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		kode_cabang: $('[name="kode_cabang"]').val(),
		id_provinsi: $('[name="id_provinsi"]').val(),
		id_kabkota: $('[name="id_kabkota"]').val(),
		alamat_cabang: $('[name="alamat_cabang"]').val(),
		alamat_lengkap: $('[name="alamat_lengkap"]').val(),
		kodepos: $('[name="kodepos"]').val(),
		no_telp: $('[name="no_telp"]').val(),
		no_fax: $('[name="no_fax"]').val(),
		website: $('[name="website"]').val(),
		email: $('[name="email"]').val(),
		initial_permohonan: $('[name="initial_permohonan"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('setting/ajax_save_configuration'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('setting/ajax_update_configuration'); ?>";
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
				$('#form-setting').modal('hide');
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

function edit(kode_cabang)
{
	$('#formSetting')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('setting/get_detail_configuration')?>/" + kode_cabang,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var kabkota = data = response[1];
			var _id_kabkota = $('select[name="id_kabkota"]');
			$('#id_kabkota').empty();
			_id_kabkota.append('<option value=""></option>');
			$.each(kabkota, function(id_kabkota, nm_kabkota) {
				var opt = $('<option />'); 
				opt.val(id_kabkota);
				opt.text(nm_kabkota);
				_id_kabkota.append(opt); 
			});
			_id_kabkota.prop({disabled: false});
			_id_kabkota.trigger('chosen:updated');
			
			var data = response[0];
			$('[name="kode_cabang"]').val(data.kode_cabang);
			$('[name="id_provinsi"]').val(data.id_provinsi).trigger('chosen:updated');
			$('[name="id_kabkota"]').val(data.id_kabkota).trigger('chosen:updated');
			$('[name="alamat_cabang"]').val(data.alamat_cabang);
			$('[name="alamat_lengkap"]').val(data.alamat_lengkap);			
			$('[name="kodepos"]').val(data.kodepos);
			$('[name="no_telp"]').val(data.no_telp);
			$('[name="no_fax"]').val(data.no_fax);
			$('[name="website"]').val(data.website);
			$('[name="email"]').val(data.email);
			$('[name="initial_permohonan"]').val(data.initial_permohonan);
						
			$('[name="kode_cabang"]').prop({disabled: true});
				
			$('#form-setting').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Application Setting'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(kode_cabang)
{
	
	$('#dd_kode_cabang').empty();
	$('#dd_alamat_cabang').empty();
	$('#dd_kota_cabang').empty();
	$('#dd_kodepos').empty();
	$('#dd_no_telp').empty();
	$('#dd_no_fax').empty();
	$('#dd_email').empty();
	$('#dd_website').empty();
	$('#dd_initial_permohonan').empty();
	
	
	$.ajax({
        url : "<?php echo site_url('setting/view_detail_configuration')?>/" + kode_cabang,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_kode_cabang').append(data.kode_cabang);
			$('#dd_alamat_cabang').append(data.alamat_cabang);
			$('#dd_kota_cabang').append(data.kota_cabang);
			$('#dd_kodepos').append(data.kodepos);
			$('#dd_no_telp').append(data.no_telp);
			$('#dd_no_fax').append(data.no_fax);
			$('#dd_email').append(data.email);
			$('#dd_website').append(data.website);
			$('#dd_initial_permohonan').append(data.initial_permohonan);
			
			$('#view-setting').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Application Setting'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function reload_table()
{
    var Tbl_Setting = $('#Tbl_Setting').DataTable();
	Tbl_Setting.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
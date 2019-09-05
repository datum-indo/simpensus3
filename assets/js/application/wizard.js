$(document).ready(function() {
	
	var Tbl_Permohonan = $('#Tbl_Permohonan').DataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "permohonan/ajax_list",
			"type": "POST"
		},
		
		"columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
				
        }
        ],
	});
	
	$('#uraian_singkat').wysihtml5({
		lang: "id",
		toolbar: {
			"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
			"emphasis": true, //Italics, bold, etc. Default true
			//"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
			"html": false, //Button which allows you to edit the generated HTML. Default false
			"link": false, //Button to insert a link. Default true
			"image": false, //Button to insert an image. Default true,
			"color": false, //Button to change color of font  
			"blockquote": false, //Blockquote
		}
		
	});
	
	$('#kronologi_kasus').wysihtml5({
		lang: "id",
		toolbar: {
			"font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
			"emphasis": true, //Italics, bold, etc. Default true
			//"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
			"html": false, //Button which allows you to edit the generated HTML. Default false
			"link": false, //Button to insert a link. Default true
			"image": false, //Button to insert an image. Default true,
			"color": false, //Button to change color of font  
			"blockquote": false, //Blockquote
		}
		
	});
	
	$(".chosen-select").chosen();
	$(".chosen-select-deselect").chosen({ allow_single_deselect: true, width: '100%'});
	
	$(".chosen-select").val('').trigger("chosen:updated");
	$(".chosen-select-deselect").val('').trigger("chosen:updated");
	
	$('.capitalize').capitalize();
	
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
	
	file_kid = new Array();
	file_ktm = new Array();
		
	$('#btnClear').click(function()
	{
		$('input[type=search]').val('');
		Tbl_Permohonan.search( '' ) .columns().search( '' ) .draw();
	});
	
	$('#tgl_lahir').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	
	$('#_jkel2').addClass('active');
	$('#_jkel2').removeClass('btn-default');
	$('#_jkel2').addClass('btn-primary');
	$('#_jkel1').removeClass('btn-primary');
	$('#_jkel1').addClass('btn-default');
	$('#_jkel0').removeClass('btn-primary');
	$('#_jkel0').addClass('btn-default');
			
	$('input[name="jkel"][value="Laki-laki"]').attr('checked', 'checked');
	$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
	$('input[name="jkel"][value="Lainnya"]').removeAttr('checked');
	
	$('input[name="jkel"]').change(function ()
	{
		if ($(this).val() == 'Laki-laki')
		{
			$('#_jkel2').removeClass('btn-default');
			$('#_jkel2').addClass('btn-primary');
			$('#_jkel1').removeClass('btn-primary');
			$('#_jkel1').addClass('btn-default');
			$('#_jkel0').removeClass('btn-primary');
			$('#_jkel0').addClass('btn-default');
			
			$('input[name="jkel"][value="Laki-laki"]').attr('checked', 'checked');
			$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
			$('input[name="jkel"][value="Lainnya"]').removeAttr('checked');
		}
		else if ($(this).val() == 'Perempuan')
		{
			$('#_jkel1').removeClass('btn-default');
			$('#_jkel1').addClass('btn-primary');
			$('#_jkel2').removeClass('btn-primary');
			$('#_jkel2').addClass('btn-default');
			$('#_jkel0').removeClass('btn-primary');
			$('#_jkel0').addClass('btn-default');
			
			$('input[name="jkel"][value="Laki-laki"]').removeAttr('checked');
			$('input[name="jkel"][value="Perempuan"]').attr('checked', 'checked');
			$('input[name="jkel"][value="Lainnya"]').removeAttr('checked');
		}
		else 
		{
			$('#_jkel0').removeClass('btn-default');
			$('#_jkel0').addClass('btn-primary');
			$('#_jkel1').removeClass('btn-primary');
			$('#_jkel1').addClass('btn-default');
			$('#_jkel2').removeClass('btn-primary');
			$('#_jkel2').addClass('btn-default');
			
			$('input[name="jkel"][value="Laki-laki"]').removeAttr('checked');
			$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
			$('input[name="jkel"][value="Lainnya"]').attr('checked', 'checked');
		}	
	});
	
	$('#_kondisi_fisik1').addClass('active');
	$('#_kondisi_fisik1').removeClass('btn-default');
	$('#_kondisi_fisik1').addClass('btn-primary');
	$('#_kondisi_fisik0').removeClass('btn-primary');
	$('#_kondisi_fisik0').addClass('btn-default');
	$('input[name="kondisi_fisik"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="kondisi_fisik"][value="Ya"]').removeAttr('checked');
	$('#id_difabel').chosen().chosenReadonly(true);
	$('[name="id_difabel"]').val('').trigger("chosen:updated");
	$('input[name=kondisi_fisik]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_kondisi_fisik1').removeClass('btn-default');
			$('#_kondisi_fisik1').addClass('btn-primary');
			$('#_kondisi_fisik0').removeClass('btn-primary');
			$('#_kondisi_fisik0').addClass('btn-default');
			
			$('input[name="kondisi_fisik"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="kondisi_fisik"][value="Ya"]').removeAttr('checked');
			$('#id_difabel').chosen().chosenReadonly(true);
			$('[name="id_difabel"]').val('').trigger("chosen:updated");
		}
		else
		{
			$('#_kondisi_fisik0').removeClass('btn-default');
			$('#_kondisi_fisik0').addClass('btn-primary');
			$('#_kondisi_fisik1').removeClass('btn-primary');
			$('#_kondisi_fisik1').addClass('btn-default');
			
			$('input[name="kondisi_fisik"][value="Ya"]').attr('checked', 'checked');
			$('input[name="kondisi_fisik"][value="Tidak"]').removeAttr('checked');
			$('#id_difabel').chosen().chosenReadonly(false);
			$('[name="id_difabel"]').val('').trigger("chosen:updated");
		}					
	});
	
	$('#id_agama').val('').trigger('chosen:updated');
	$('[name="agama_desc"]').prop({disabled: true});	
	
	$('[name="id_agama"]').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="agama_desc"]').val('');
			$('[name="agama_desc"]').prop({disabled:true});
		}
		else if ($(this).val() == '9')
		{
			$('[name="agama_desc"]').prop({disabled:false});
		}
		else
		{
			$('[name="agama_desc"]').val('');
			$('[name="agama_desc"]').prop({disabled:true});	
		}		
	});	
	
	var _id_negara = $('#id_negara');
	_id_negara.chosen().chosenReadonly(true);
	_id_negara.val('').trigger('chosen:updated');
		
	$('[name="kewarganegaraan"]').change(function ()
	{
		if ($(this).val() == 'WNI')
		{
			_id_negara.chosen().chosenReadonly(true);
			_id_negara.val('107').trigger('chosen:updated');
		}
		else if ($(this).val() == 'WNA')
		{
			_id_negara.chosen().chosenReadonly(false);
			_id_negara.trigger('chosen:updated');
		}
		else
		{
			_id_negara.chosen().chosenReadonly(true);
			_id_negara.val('').trigger('chosen:updated');
		}		
	});
	
	$('[name="id_pekerjaan"]').val('').trigger('chosen:updated');
	$('[name="pekerjaan_desc"]').val('');
	$('[name="pekerjaan_desc"]').prop({disabled: true});
	$('[name="id_pekerjaan"]').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="pekerjaan_desc"]').val('');
			$('[name="pekerjaan_desc"]').prop({disabled: true});
		}
		else if ($(this).val() == '45')
		{
			$('[name="pekerjaan_desc"]').val('');
			$('[name="pekerjaan_desc"]').prop({disabled: false});
		}
		else
		{
			$('[name="pekerjaan_desc"]').val('');
			$('[name="pekerjaan_desc"]').prop({disabled: true});
		}					
	});
	
	$('#_pekerjaan21').addClass('active');
	$('#_pekerjaan21').removeClass('btn-default');
	$('#_pekerjaan21').addClass('btn-primary');
	$('#_pekerjaan20').removeClass('btn-primary');
	$('#_pekerjaan20').addClass('btn-default');
			
	$('input[name="pekerjaan2"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="pekerjaan2"][value="Ya"]').removeAttr('checked');
	$('[name="pekerjaan2_desc"]').val('');	
	$('[name="pekerjaan2_desc"]').prop({disabled: true});
	
	$('input[name=pekerjaan2]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_pekerjaan21').removeClass('btn-default');
			$('#_pekerjaan21').addClass('btn-primary');
			$('#_pekerjaan20').removeClass('btn-primary');
			$('#_pekerjaan20').addClass('btn-default');
			
			$('input[name="pekerjaan2"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaan2"][value="Ya"]').removeAttr('checked');
			$('[name="pekerjaan2_desc"]').val('');	
			$('[name="pekerjaan2_desc"]').prop({disabled: true});
		}
		else
		{
			$('#_pekerjaan20').removeClass('btn-default');
			$('#_pekerjaan20').addClass('btn-primary');
			$('#_pekerjaan21').removeClass('btn-primary');
			$('#_pekerjaan21').addClass('btn-default');
			
			$('input[name="pekerjaan2"][value="Tidak"]').removeAttr('checked');
			$('input[name="pekerjaan2"][value="Ya"]').attr('checked', 'checked');
			$('[name="pekerjaan2_desc"]').val('');	
			$('[name="pekerjaan2_desc"]').prop({disabled: false});	
		}					
	});
	
	$('#_pekerjaansi1').addClass('active');
	$('#_pekerjaansi1').removeClass('btn-default');
	$('#_pekerjaansi1').addClass('btn-primary');
	$('#_pekerjaansi0').removeClass('btn-primary');
	$('#_pekerjaansi0').addClass('btn-default');
	$('input[name="pekerjaansi"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="pekerjaansi"][value="Ya"]').removeAttr('checked');
	$('#id_pekerjaansi').chosen().chosenReadonly(true);
	$('[name="id_pekerjaansi"]').val('').trigger("chosen:updated");
	$('[name="pekerjaansi_desc"]').val('');	
	$('[name="pekerjaansi_desc"]').prop({disabled: true});
	$('input[name=pekerjaansi]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_pekerjaansi1').removeClass('btn-default');
			$('#_pekerjaansi1').addClass('btn-primary');
			$('#_pekerjaansi0').removeClass('btn-primary');
			$('#_pekerjaansi0').addClass('btn-default');
			
			$('input[name="pekerjaansi"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaansi"][value="Ya"]').removeAttr('checked');
			$('#id_pekerjaansi').chosen().chosenReadonly(true);
			$('[name="id_pekerjaansi"]').val('').trigger("chosen:updated");
			$('[name="pekerjaansi_desc"]').val('');	
			$('[name="pekerjaansi_desc"]').prop({disabled: true});
		}
		else
		{
			$('#_pekerjaansi0').removeClass('btn-default');
			$('#_pekerjaansi0').addClass('btn-primary');
			$('#_pekerjaansi1').removeClass('btn-primary');
			$('#_pekerjaansi1').addClass('btn-default');
			
			$('input[name="pekerjaansi"][value="Tidak"]').removeAttr('checked');
			$('input[name="pekerjaansi"][value="Ya"]').attr('checked', 'checked');
			$('#id_pekerjaansi').chosen().chosenReadonly(false);
			$('[name="id_pekerjaansi"]').val('').trigger("chosen:updated");
		}					
	});
	
	$('[name="id_pekerjaansi"]').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="pekerjaansi_desc"]').val('');
			$('[name="pekerjaansi_desc"]').prop({disabled: true});
		}
		else if ($(this).val() == '45')
		{
			$('[name="pekerjaansi_desc"]').val('');
			$('[name="pekerjaansi_desc"]').prop({disabled: false});
		}
		else
		{
			$('[name="pekerjaansi_desc"]').val('');
			$('[name="pekerjaansi_desc"]').prop({disabled: true});
		}					
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
				url: "permohonan/get_kabkota/" + id_provinsi,
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
					/*
					_id_kecamatan.empty();
					_id_kecamatan.prop({disabled: true});
					_id_kecamatan.append('<option value=""></option>');
					$('#id_kecamatan').trigger('chosen:updated');
					_id_desa.empty();
					_id_desa.prop({disabled: true});
					_id_desa.append('<option value=""></option>');
					$('#id_desa').trigger('chosen:updated');
					*/
				}	 
			});	
		}	
		else
		{
			$('#id_kabkota').empty();
			_id_kabkota.prop({disabled: true});
			$('#id_kabkota').append('<option value=""></option>');
			$('#id_kabkota').trigger('chosen:updated');
			/*
			$('#id_kecamatan').empty();
			_id_kecamatan.prop({disabled: true});
			_id_kecamatan.append('<option value=""></option>');
			$('#id_kecamatan').trigger('chosen:updated');
			$('#id_desa').empty();
			_id_desa.prop({disabled: true});
			_id_desa.append('<option value=""></option>');
			$('#id_desa').trigger('chosen:updated');
			*/
		}	
	});
	
	$('[name="nomor_kid"]').val('');
	$('[name="nomor_kid"]').prop({disabled: true});
	$('#jenis_kid').change(function()
	{
		if($(this).val() == 'Tidak Ada' || $(this).val() == '')
		{
			$('[name="nomor_kid"]').val('');
			$('[name="nomor_kid"]').prop({disabled: true});
		}
		else
		{
			$('[name="nomor_kid"]').val('');
			$('[name="nomor_kid"]').prop({disabled: false});
		}		
	});
	
	$('[name="nomor_ktm"]').val('');
	$('[name="nomor_ktm"]').prop({disabled: true});
	$('#jenis_ktm').change(function()
	{
		if($(this).val() == 'Tidak Ada' || $(this).val() == '')
		{
			$('[name="nomor_ktm"]').val('');
			$('[name="nomor_ktm"]').prop({disabled: true});
		}
		else
		{
			$('[name="nomor_ktm"]').val('');
			$('[name="nomor_ktm"]').prop({disabled: false});
		}		
	});	
	
	$('#_status_pemohon1').addClass('active');
	$('#_status_pemohon1').removeClass('btn-default');
	$('#_status_pemohon1').addClass('btn-primary');
	$('#_status_pemohon0').removeClass('btn-primary');
	$('#_status_pemohon0').addClass('btn-default');
	$('input[name="status_pemohon"][value="Ya"]').attr('checked', 'checked');
	$('input[name="status_pemohon"][value="Tidak"]').removeAttr('checked');
	$('input[name=status_pemohon]').change(function ()
	{
		if ($(this).val() == 'Ya')
		{
			$('#_status_pemohon1').removeClass('btn-default');
			$('#_status_pemohon1').addClass('btn-primary');
			$('#_status_pemohon0').removeClass('btn-primary');
			$('#_status_pemohon0').addClass('btn-default');
			
			$('input[name="status_pemohon"][value="Ya"]').attr('checked', 'checked');
			$('input[name="status_pemohon"][value="Tidak"]').removeAttr('checked');
			
		}
		else
		{
			$('#_status_pemohon0').removeClass('btn-default');
			$('#_status_pemohon0').addClass('btn-primary');
			$('#_status_pemohon1').removeClass('btn-primary');
			$('#_status_pemohon1').addClass('btn-default');
			
			$('input[name="status_pemohon"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="status_pemohon"][value="Ya"]').removeAttr('checked');
		}					
	});
	
	/* Penerima */
	
	$('#tgl_lahirb').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	
	$('#_jkelb2').addClass('active');
	$('#_jkelb2').removeClass('btn-default');
	$('#_jkelb2').addClass('btn-primary');
	$('#_jkelb1').removeClass('btn-primary');
	$('#_jkelb1').addClass('btn-default');
	$('#_jkelb0').removeClass('btn-primary');
	$('#_jkelb0').addClass('btn-default');
			
	$('input[name="jkelb"][value="Laki-laki"]').attr('checked', 'checked');
	$('input[name="jkelb"][value="Perempuan"]').removeAttr('checked');
	$('input[name="jkelb"][value="Lainnya"]').removeAttr('checked');
	
	$('input[name="jkelb"]').change(function ()
	{
		if ($(this).val() == 'Laki-laki')
		{
			$('#_jkelb2').removeClass('btn-default');
			$('#_jkelb2').addClass('btn-primary');
			$('#_jkelb1').removeClass('btn-primary');
			$('#_jkelb1').addClass('btn-default');
			$('#_jkelb0').removeClass('btn-primary');
			$('#_jkelb0').addClass('btn-default');
			
			$('input[name="jkelb"][value="Laki-laki"]').attr('checked', 'checked');
			$('input[name="jkelb"][value="Perempuan"]').removeAttr('checked');
			$('input[name="jkelb"][value="Lainnya"]').removeAttr('checked');
		}
		else if ($(this).val() == 'Perempuan')
		{
			$('#_jkelb1').removeClass('btn-default');
			$('#_jkelb1').addClass('btn-primary');
			$('#_jkelb2').removeClass('btn-primary');
			$('#_jkelb2').addClass('btn-default');
			$('#_jkelb0').removeClass('btn-primary');
			$('#_jkelb0').addClass('btn-default');
			
			$('input[name="jkelb"][value="Laki-laki"]').removeAttr('checked');
			$('input[name="jkelb"][value="Perempuan"]').attr('checked', 'checked');
			$('input[name="jkelb"][value="Lainnya"]').removeAttr('checked');
		}
		else 
		{
			$('#_jkelb0').removeClass('btn-default');
			$('#_jkelb0').addClass('btn-primary');
			$('#_jkelb1').removeClass('btn-primary');
			$('#_jkelb1').addClass('btn-default');
			$('#_jkelb2').removeClass('btn-primary');
			$('#_jkelb2').addClass('btn-default');
			
			$('input[name="jkelb"][value="Laki-laki"]').removeAttr('checked');
			$('input[name="jkelb"][value="Perempuan"]').removeAttr('checked');
			$('input[name="jkelb"][value="Lainnya"]').attr('checked', 'checked');
		}	
	});
	
	$('#_kondisi_fisikb1').addClass('active');
	$('#_kondisi_fisikb1').removeClass('btn-default');
	$('#_kondisi_fisikb1').addClass('btn-primary');
	$('#_kondisi_fisikb0').removeClass('btn-primary');
	$('#_kondisi_fisikb0').addClass('btn-default');
	$('input[name="kondisi_fisikb"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="kondisi_fisikb"][value="Ya"]').removeAttr('checked');
	$('#id_difabelb').chosen().chosenReadonly(true);
	$('[name="id_difabelb"]').val('').trigger("chosen:updated");
	$('input[name=kondisi_fisikb]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_kondisi_fisikb1').removeClass('btn-default');
			$('#_kondisi_fisikb1').addClass('btn-primary');
			$('#_kondisi_fisikb0').removeClass('btn-primary');
			$('#_kondisi_fisikb0').addClass('btn-default');
			
			$('input[name="kondisi_fisikb"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="kondisi_fisikb"][value="Ya"]').removeAttr('checked');
			$('#id_difabelb').chosen().chosenReadonly(true);
			$('[name="id_difabelb"]').val('').trigger("chosen:updated");
		}
		else
		{
			$('#_kondisi_fisikb0').removeClass('btn-default');
			$('#_kondisi_fisikb0').addClass('btn-primary');
			$('#_kondisi_fisikb1').removeClass('btn-primary');
			$('#_kondisi_fisikb1').addClass('btn-default');
			
			$('input[name="kondisi_fisikb"][value="Ya"]').attr('checked', 'checked');
			$('input[name="kondisi_fisikb"][value="Tidak"]').removeAttr('checked');
			$('#id_difabelb').chosen().chosenReadonly(false);
			$('[name="id_difabelb"]').val('').trigger("chosen:updated");
		}					
	});
	
	$('#id_agamab').val('').trigger('chosen:updated');
	$('[name="agama_descb"]').prop({disabled: true});	
	
	$('[name="id_agamab"]').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="agama_descb"]').val('');
			$('[name="agama_descb"]').prop({disabled:true});
		}
		else if ($(this).val() == '9')
		{
			$('[name="agama_descb"]').prop({disabled:false});
		}
		else
		{
			$('[name="agama_descb"]').val('');
			$('[name="agama_descb"]').prop({disabled:true});	
		}		
	});	
	
	var _id_negarab = $('#id_negarab');
	_id_negarab.chosen().chosenReadonly(true);
	_id_negarab.val('').trigger('chosen:updated');
		
	$('[name="kewarganegaraanb"]').change(function ()
	{
		if ($(this).val() == 'WNI')
		{
			_id_negarab.chosen().chosenReadonly(true);
			_id_negarab.val('107').trigger('chosen:updated');
		}
		else if ($(this).val() == 'WNA')
		{
			_id_negarab.chosen().chosenReadonly(false);
			_id_negarab.trigger('chosen:updated');
		}
		else
		{
			_id_negarab.chosen().chosenReadonly(true);
			_id_negarab.val('').trigger('chosen:updated');
		}		
	});
	
	$('[name="id_pekerjaanb"]').val('').trigger('chosen:updated');
	$('[name="pekerjaan_descb"]').val('');
	$('[name="pekerjaan_descb"]').prop({disabled: true});
	$('[name="id_pekerjaanb"]').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="pekerjaan_descb"]').val('');
			$('[name="pekerjaan_descb"]').prop({disabled: true});
		}
		else if ($(this).val() == '45')
		{
			$('[name="pekerjaan_descb"]').val('');
			$('[name="pekerjaan_descb"]').prop({disabled: false});
		}
		else
		{
			$('[name="pekerjaan_descb"]').val('');
			$('[name="pekerjaan_descb"]').prop({disabled: true});
		}					
	});
	
	$('#_pekerjaan2b1').addClass('active');
	$('#_pekerjaan2b1').removeClass('btn-default');
	$('#_pekerjaan2b1').addClass('btn-primary');
	$('#_pekerjaan2b0').removeClass('btn-primary');
	$('#_pekerjaan2b0').addClass('btn-default');
			
	$('input[name="pekerjaan2b"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="pekerjaan2b"][value="Ya"]').removeAttr('checked');
	$('[name="pekerjaan2_descb"]').val('');	
	$('[name="pekerjaan2_descb"]').prop({disabled: true});
	
	$('input[name=pekerjaan2b]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_pekerjaan2b1').removeClass('btn-default');
			$('#_pekerjaan2b1').addClass('btn-primary');
			$('#_pekerjaan2b0').removeClass('btn-primary');
			$('#_pekerjaan2b0').addClass('btn-default');
			
			$('input[name="pekerjaan2b"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaan2b"][value="Ya"]').removeAttr('checked');
			$('[name="pekerjaan2_descb"]').val('');	
			$('[name="pekerjaan2_descb"]').prop({disabled: true});
		}
		else
		{
			$('#_pekerjaan2b0').removeClass('btn-default');
			$('#_pekerjaan2b0').addClass('btn-primary');
			$('#_pekerjaan2b1').removeClass('btn-primary');
			$('#_pekerjaan2b1').addClass('btn-default');
			
			$('input[name="pekerjaan2b"][value="Tidak"]').removeAttr('checked');
			$('input[name="pekerjaan2b"][value="Ya"]').attr('checked', 'checked');
			$('[name="pekerjaan2_descb"]').val('');	
			$('[name="pekerjaan2_descb"]').prop({disabled: false});	
		}					
	});
	
	$('#_pekerjaansib1').addClass('active');
	$('#_pekerjaansib1').removeClass('btn-default');
	$('#_pekerjaansib1').addClass('btn-primary');
	$('#_pekerjaansib0').removeClass('btn-primary');
	$('#_pekerjaansib0').addClass('btn-default');
	$('input[name="pekerjaansib"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="pekerjaansib"][value="Ya"]').removeAttr('checked');
	$('#id_pekerjaansib').chosen().chosenReadonly(true);
	$('[name="id_pekerjaansib"]').val('').trigger("chosen:updated");
	$('[name="pekerjaansi_descb"]').val('');	
	$('[name="pekerjaansi_descb"]').prop({disabled: true});
	$('input[name=pekerjaansib]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_pekerjaansib1').removeClass('btn-default');
			$('#_pekerjaansib1').addClass('btn-primary');
			$('#_pekerjaansib0').removeClass('btn-primary');
			$('#_pekerjaansib0').addClass('btn-default');
			
			$('input[name="pekerjaansib"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaansib"][value="Ya"]').removeAttr('checked');
			$('#id_pekerjaansib').chosen().chosenReadonly(true);
			$('[name="id_pekerjaansib"]').val('').trigger("chosen:updated");
			$('[name="pekerjaansi_descb"]').val('');	
			$('[name="pekerjaansi_descb"]').prop({disabled: true});
		}
		else
		{
			$('#_pekerjaansib0').removeClass('btn-default');
			$('#_pekerjaansib0').addClass('btn-primary');
			$('#_pekerjaansib1').removeClass('btn-primary');
			$('#_pekerjaansib1').addClass('btn-default');
			
			$('input[name="pekerjaansib"][value="Tidak"]').removeAttr('checked');
			$('input[name="pekerjaansib"][value="Ya"]').attr('checked', 'checked');
			$('#id_pekerjaansib').chosen().chosenReadonly(false);
			$('[name="id_pekerjaansib"]').val('').trigger("chosen:updated");
		}					
	});
	
	$('[name="id_pekerjaansib"]').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="pekerjaansi_descb"]').val('');
			$('[name="pekerjaansi_descb"]').prop({disabled: true});
		}
		else if ($(this).val() == '45')
		{
			$('[name="pekerjaansi_descb"]').val('');
			$('[name="pekerjaansi_descb"]').prop({disabled: false});
		}
		else
		{
			$('[name="pekerjaansi_descb"]').val('');
			$('[name="pekerjaansi_descb"]').prop({disabled: true});
		}					
	});
	
	var _id_provinsib = $('select[name="id_provinsib"]');
	var _id_kabkotab = $('select[name="id_kabkotab"]');
	_id_kabkotab.children().remove().end();
	_id_kabkotab.prop({disabled: true});
	_id_kabkotab.trigger('chosen:updated');
	
	$('#id_provinsib').change(function ()
	{
		var id_provinsib = $('#id_provinsib').val();
		if(id_provinsib != "")
		{
			$.ajax({
				type: "POST",
				url: "permohonan/get_kabkota/" + id_provinsib,
				success: function(kabkota) 
				{
					$('#id_kabkotab').empty();
					_id_kabkotab.append('<option value=""></option>');
					$.each(kabkota, function(id_kabkotab, nm_kabkota) {
						var opt = $('<option />'); 
						opt.val(id_kabkotab);
						opt.text(nm_kabkota);
						_id_kabkotab.append(opt); 
					});
					_id_kabkotab.prop({disabled: false});
					_id_kabkotab.trigger('chosen:updated');
					/*
					_id_kecamatanb.empty();
					_id_kecamatanb.prop({disabled: true});
					_id_kecamatanb.append('<option value=""></option>');
					$('#id_kecamatanb').trigger('chosen:updated');
					_id_desab.empty();
					_id_desab.prop({disabled: true});
					_id_desab.append('<option value=""></option>');
					$('#id_desab').trigger('chosen:updated');
					*/
				}	 
			});	
		}	
		else
		{
			$('#id_kabkotab').empty();
			_id_kabkotab.prop({disabled: true});
			$('#id_kabkotab').append('<option value=""></option>');
			$('#id_kabkotab').trigger('chosen:updated');
			/*
			$('#id_kecamatanb').empty();
			_id_kecamatanb.prop({disabled: true});
			_id_kecamatanb.append('<option value=""></option>');
			$('#id_kecamatanb').trigger('chosen:updated');
			$('#id_desab').empty();
			_id_desab.prop({disabled: true});
			_id_desab.append('<option value=""></option>');
			$('#id_desab').trigger('chosen:updated');
			*/
		}	
	});
	
	$('[name="nomor_kidb"]').val('');
	$('[name="nomor_kidb"]').prop({disabled: true});
	$('#jenis_kidb').change(function()
	{
		if($(this).val() == 'Tidak Ada' || $(this).val() == '')
		{
			$('[name="nomor_kidb"]').val('');
			$('[name="nomor_kidb"]').prop({disabled: true});
		}
		else
		{
			$('[name="nomor_kidb"]').val('');
			$('[name="nomor_kidb"]').prop({disabled: false});
		}		
	});
	
	$('[name="nomor_ktmb"]').val('');
	$('[name="nomor_ktmb"]').prop({disabled: true});
	$('#jenis_ktmb').change(function()
	{
		if($(this).val() == 'Tidak Ada' || $(this).val() == '')
		{
			$('[name="nomor_ktmb"]').val('');
			$('[name="nomor_ktmb"]').prop({disabled: true});
		}
		else
		{
			$('[name="nomor_ktmb"]').val('');
			$('[name="nomor_ktmb"]').prop({disabled: false});
		}		
	});	
	/* End Penerima */
	
	$('#_pernah_jadi_client1').addClass('active');
	$('#_pernah_jadi_client1').removeClass('btn-default');
	$('#_pernah_jadi_client1').addClass('btn-primary');
	$('#_pernah_jadi_client0').removeClass('btn-primary');
	$('#_pernah_jadi_client0').addClass('btn-default');
	$('input[name="pernah_jadi_client"][value="Belum"]').attr('checked', 'checked');
	$('input[name="pernah_jadi_client"][value="Pernah"]').removeAttr('checked');
	$('#id_sumber_info').chosen().chosenReadonly(false);
	$('[name="id_sumber_info"]').val('').trigger("chosen:updated");
	$('[name="sumber_info_desc"]').val('');
	$('[name="sumber_info_desc"]').prop({disabled: true});
	
	$('input[name=pernah_jadi_client]').change(function ()
	{
		if ($(this).val() == 'Belum')
		{
			$('#_pernah_jadi_client1').removeClass('btn-default');
			$('#_pernah_jadi_client1').addClass('btn-primary');
			$('#_pernah_jadi_client0').removeClass('btn-primary');
			$('#_pernah_jadi_client0').addClass('btn-default');
			
			$('input[name="pernah_jadi_client"][value="Belum"]').attr('checked', 'checked');
			$('input[name="pernah_jadi_client"][value="Pernah"]').removeAttr('checked');
			$('#id_sumber_info').chosen().chosenReadonly(false);
			$('[name="id_sumber_info"]').val('').trigger("chosen:updated");
			$('[name="sumber_info_desc"]').val('');	
		}
		else
		{
			$('#_pernah_jadi_client0').removeClass('btn-default');
			$('#_pernah_jadi_client0').addClass('btn-primary');
			$('#_pernah_jadi_client1').removeClass('btn-primary');
			$('#_pernah_jadi_client1').addClass('btn-default');
			
			$('input[name="pernah_jadi_client"][value="Belum"]').removeAttr('checked');
			$('input[name="pernah_jadi_client"][value="Pernah"]').attr('checked', 'checked');
			$('#id_sumber_info').chosen().chosenReadonly(true);
			$('[name="id_sumber_info"]').val('').trigger("chosen:updated");
			$('[name="sumber_info_desc"]').val('');	
			$('[name="sumber_info_desc"]').prop({disabled: true});	
		}					
	});
	
	$('[name="id_sumber_info"]').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="sumber_info_desc"]').val('');	
			$('[name="sumber_info_desc"]').prop({disabled: true});
		}
		else if ($(this).val() == '9')
		{
			$('[name="sumber_info_desc"]').val('');	
			$('[name="sumber_info_desc"]').prop({disabled: false});
		}
		else
		{
			$('[name="sumber_info_desc"]').val('');	
			$('[name="sumber_info_desc"]').prop({disabled: true});		
		}					
	});
	
	$('#_rekomendasi_lbh1').addClass('active');
	$('#_rekomendasi_lbh1').removeClass('btn-default');
	$('#_rekomendasi_lbh1').addClass('btn-primary');
	$('#_rekomendasi_lbh0').removeClass('btn-primary');
	$('#_rekomendasi_lbh0').addClass('btn-default');
	$('input[name="rekomendasi_lbh"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="rekomendasi_lbh"][value="Ada"]').removeAttr('checked');
	
	$('[name="nm_rekomendasi"]').val('');
	$('[name="alm_rekomendasi"]').val('');
	$('[name="pekerjaan_rekomendasi"]').val('');
	$('[name="nm_rekomendasi"]').prop({disabled: true});
	$('[name="alm_rekomendasi"]').prop({disabled: true});
	$('[name="pekerjaan_rekomendasi"]').prop({disabled: true});
				
	$('input[name=rekomendasi_lbh]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_rekomendasi_lbh1').removeClass('btn-default');
			$('#_rekomendasi_lbh1').addClass('btn-primary');
			$('#_rekomendasi_lbh0').removeClass('btn-primary');
			$('#_rekomendasi_lbh0').addClass('btn-default');
			
			$('input[name="rekomendasi_lbh"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="rekomendasi_lbh"][value="Ya"]').removeAttr('checked');
						
			$('[name="nm_rekomendasi"]').val('');
			$('[name="alm_rekomendasi"]').val('');
			$('[name="pekerjaan_rekomendasi"]').val('');
			$('[name="nm_rekomendasi"]').prop({disabled: true});
			$('[name="alm_rekomendasi"]').prop({disabled: true});
			$('[name="pekerjaan_rekomendasi"]').prop({disabled: true});
		}
		else
		{
			$('#_rekomendasi_lbh0').removeClass('btn-default');
			$('#_rekomendasi_lbh0').addClass('btn-primary');
			$('#_rekomendasi_lbh1').removeClass('btn-primary');
			$('#_rekomendasi_lbh1').addClass('btn-default');
			
			$('input[name="rekomendasi_lbh"][value="Ya"]').attr('checked', 'checked');
			$('input[name="rekomendasi_lbh"][value="Tidak"]').removeAttr('checked');
			
			$('[name="nm_rekomendasi"]').val('');
			$('[name="alm_rekomendasi"]').val('');
			$('[name="pekerjaan_rekomendasi"]').val('');
			$('[name="nm_rekomendasi"]').prop({disabled: false});
			$('[name="alm_rekomendasi"]').prop({disabled: false});
			$('[name="pekerjaan_rekomendasi"]').prop({disabled: false});
		}					
	});
	
	
	$('#_penanganan_pihak_lain1').addClass('active');
	$('#_penanganan_pihak_lain1').removeClass('btn-default');
	$('#_penanganan_pihak_lain1').addClass('btn-primary');
	$('#_penanganan_pihak_lain0').removeClass('btn-primary');
	$('#_penanganan_pihak_lain0').addClass('btn-default');
	$('input[name="penanganan_pihak_lain"][value="Tidak"]').attr('checked', 'checked');
	$('input[name="penanganan_pihak_lain"][value="Ya"]').removeAttr('checked');
	$('[name="tahap_penanganan_pihak_lain"]').val('').trigger("chosen:updated");
	$('[name="desc_tahap_penanganan_pihak_lain"]').val('');
	$('#tahap_penanganan_pihak_lain_box').hide();
	$('#desc_tahap_penanganan_pihak_lain_box').hide();
			
	$('input[name="penanganan_pihak_lain"]').change(function ()
	{
		if ($(this).val() == 'Tidak')
		{
			$('#_penanganan_pihak_lain1').removeClass('btn-default');
			$('#_penanganan_pihak_lain1').addClass('btn-primary');
			$('#_penanganan_pihak_lain0').removeClass('btn-primary');
			$('#_penanganan_pihak_lain0').addClass('btn-default');
			$('input[name="penanganan_pihak_lain"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="penanganan_pihak_lain"][value="Ya"]').removeAttr('checked');
			$('[name="tahap_penanganan_pihak_lain"]').val('').trigger("chosen:updated");
			$('[name="desc_tahap_penanganan_pihak_lain"]').val('');
			$('#tahap_penanganan_pihak_lain_box').hide();
			$('#desc_tahap_penanganan_pihak_lain_box').hide();
		}
		else
		{
			$('#_penanganan_pihak_lain0').removeClass('btn-default');
			$('#_penanganan_pihak_lain0').addClass('btn-primary');
			$('#_penanganan_pihak_lain1').removeClass('btn-primary');
			$('#_penanganan_pihak_lain1').addClass('btn-default');
			$('input[name="penanganan_pihak_lain"][value="Ya"]').attr('checked', 'checked');
			$('input[name="penanganan_pihak_lain"][value="Tidak"]').removeAttr('checked');
			$('[name="tahap_penanganan_pihak_lain"]').val('').trigger("chosen:updated");
			$('[name="desc_tahap_penanganan_pihak_lain"]').val('');
			$('#tahap_penanganan_pihak_lain_box').show();
		}					
	});
	
	$('#tahap_penanganan_pihak_lain').change(function ()
	{
		if ($(this).val() == '')
		{
			$('[name="desc_tahap_penanganan_pihak_lain"]').val('');
			$('#desc_tahap_penanganan_pihak_lain_box').hide();
		}
		else
		{
			$('[name="desc_tahap_penanganan_pihak_lain"]').val('');
			$('#desc_tahap_penanganan_pihak_lain_box').show();
		}		
	});
	
	$('#list_kid').empty();
	
	$('#doc_kid').change(function(e)
	{
		e.preventDefault();
				
		var ajaxData = new FormData();
		
		ajaxData.append('doc_kid', 'form-kid');
		$.each($("input[type=file]"), function(i, obj)
		{
			$.each(obj.files,function(j,file)
			{
				ajaxData.append('doc_kid[]', file);
			})
		});
		
		$.ajax({
			url: "permohonan/ajax_upload_kid",
			type: "POST",
			data: ajaxData,
			dataType: "JSON",
			cache: false,
            contentType: false,
            processData: false,
			success: function(response)
			{
				$.each(response, function(i, item){
					$('#list_kid').append(response[i].link);
					
					if(response[i].status)
					{
						file_kid.push(response[i].id_file);
					}	
				});
				
				$('#doc_kid').val('');
				//alert(file_permohonan);
			}
		});
	});
	
	$('#list_kid').on('click', 'a.delete', function() {
		
		var status_file = $(this).attr('status');
		var id_file = $(this).attr('id');
		var elem = $(this);
		var index = file_kid.indexOf(id_file);
				
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
					url : "permohonan/ajax_delete_attachment",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_kid.splice(index,1);	
						elem.closest('li').remove();
						//alert(file_permohonan);	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting file');
					}
					
				});	
			}
		}		
	});
	
	$('#list_ktm').empty();
	
	$('#doc_ktm').change(function(e)
	{
		e.preventDefault();
				
		var ajaxData = new FormData();
		
		ajaxData.append('doc_ktm', 'form-ktm');
		$.each($("input[type=file]"), function(i, obj)
		{
			$.each(obj.files,function(j,file)
			{
				ajaxData.append('doc_ktm[]', file);
			})
		});
		
		$.ajax({
			url: "permohonan/ajax_upload_ktm",
			type: "POST",
			data: ajaxData,
			dataType: "JSON",
			cache: false,
            contentType: false,
            processData: false,
			success: function(response)
			{
				$.each(response, function(i, item){
					$('#list_ktm').append(response[i].link);
					
					if(response[i].status)
					{
						file_ktm.push(response[i].id_file);
					}	
				});
				
				$('#doc_ktm').val('');
			}
		});
	});
	
	$('#list_ktm').on('click', 'a.delete', function() {
		
		var status_file = $(this).attr('status');
		var id_file = $(this).attr('id');
		var elem = $(this);
		var index = file_ktm.indexOf(id_file);
				
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
					url : "permohonan/ajax_delete_attachment",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_ktm.splice(index,1);	
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
	
	$('#list_kidx').empty();
	
	$('#doc_kidx').change(function(e)
	{
		e.preventDefault();
				
		var ajaxData = new FormData();
		
		ajaxData.append('doc_kidx', 'form-kidx');
		$.each($("input[type=file]"), function(i, obj)
		{
			$.each(obj.files,function(j,file)
			{
				ajaxData.append('doc_kidx[]', file);
			})
		});
		
		$.ajax({
			url: "permohonan/ajax_upload_kidx",
			type: "POST",
			data: ajaxData,
			dataType: "JSON",
			cache: false,
            contentType: false,
            processData: false,
			success: function(response)
			{
				$.each(response, function(i, item){
					$('#list_kidx').append(response[i].link);
					
					if(response[i].status)
					{
						file_kid.push(response[i].id_file);
					}	
				});
				
				$('#doc_kidx').val('');
				//alert(file_permohonan);
			}
		});
	});
	
	$('#list_kidx').on('click', 'a.delete', function() {
		
		var status_file = $(this).attr('status');
		var id_file = $(this).attr('id');
		var elem = $(this);
		var index = file_kid.indexOf(id_file);
				
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
					url : "permohonan/ajax_delete_attachment",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_kid.splice(index,1);	
						elem.closest('li').remove();
						//alert(file_permohonan);	
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting file');
					}
					
				});	
			}
		}		
	});
	
	$('#list_ktmx').empty();
	
	$('#doc_ktmx').change(function(e)
	{
		e.preventDefault();
				
		var ajaxData = new FormData();
		
		ajaxData.append('doc_ktmx', 'form-ktmx');
		$.each($("input[type=file]"), function(i, obj)
		{
			$.each(obj.files,function(j,file)
			{
				ajaxData.append('doc_ktmx[]', file);
			})
		});
		
		$.ajax({
			url: "permohonan/ajax_upload_ktmx",
			type: "POST",
			data: ajaxData,
			dataType: "JSON",
			cache: false,
            contentType: false,
            processData: false,
			success: function(response)
			{
				$.each(response, function(i, item){
					$('#list_ktmx').append(response[i].link);
					
					if(response[i].status)
					{
						file_ktm.push(response[i].id_file);
					}	
				});
				
				$('#doc_ktmx').val('');
			}
		});
	});
	
	$('#list_ktmx').on('click', 'a.delete', function() {
		
		var status_file = $(this).attr('status');
		var id_file = $(this).attr('id');
		var elem = $(this);
		var index = file_ktm.indexOf(id_file);
				
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
					url : "permohonan/ajax_delete_attachment",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_ktm.splice(index,1);	
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
	
	file_permohonan = new Array();
	
	$('#lampiran').change(function(e)
	{
		/*
		var files = e.target.files;
		var fileCollection = new Array();
						
		$.each(files, function(i, file)
		{
			fileCollection.push(file);
		});
		*/
				
		e.preventDefault();
				
		var ajaxData = new FormData();
		//ajaxData.append('lampiran', fileCollection);
		ajaxData.append('lampiran', 'form-lampiran');
		$.each($("input[type=file]"), function(i, obj)
		{
			$.each(obj.files,function(j,file)
			{
				ajaxData.append('lampiran[]', file);
			})
		});
		
		$.ajax({
			url: "permohonan/ajax_upload_permohonan",
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
						file_permohonan.push(response[i].id_file);
					}	
				});
				
				$('#lampiran').val('');
				//alert(file_permohonan);
			}
		});
	});
	
	$('#list_lampiran').on('click', 'a.delete', function() {
		
		var status_file = $(this).attr('status');
		var id_file = $(this).attr('id');
		var elem = $(this);
		var index = file_permohonan.indexOf(id_file);
				
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
					url : "permohonan/ajax_delete_attachment",
					type: "POST",
					dataType: "JSON",
					data: formData,
					success: function(data)
					{
						file_permohonan.splice(index,1);	
						elem.closest('li').remove();
						//alert(file_permohonan);	
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
		type: 'permohonan'
	}
	
	$.ajax({
        url : "permohonan/ajax_new",
        type: "GET",
        dataType: "JSON",
		data: formData,
        success: function(response)
        {
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string
			$('#harta').removeClass('has-error'); // clear error class
	
			$('[name="id_permohonan"]').val('');
						
			$('[name="nm_lengkap"]').val('');
			$('[name="nm_panggilan"]').val('');
			$('[name="tmp_lahir"]').val('');
			$('[name="tgl_lahir"]').val('');
					
			$('#_jkel2').removeClass('btn-default');
			$('#_jkel2').addClass('btn-primary');
			$('#_jkel1').removeClass('btn-primary');
			$('#_jkel1').addClass('btn-default');
			$('#_jkel0').removeClass('btn-primary');
			$('#_jkel0').addClass('btn-default');
					
			$('input[name="jkel"][value="Laki-laki"]').attr('checked', 'checked');
			$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
			$('input[name="jkel"][value="Lainnya"]').removeAttr('checked');
						
			$('#_jkel2').addClass('active');
			$('#_jkel1').removeClass('active');
			$('#_jkel0').removeClass('active');
					
			$('[name="id_golongan_darah"]').val('').trigger("chosen:updated");
					
			$('#_kondisi_fisik1').removeClass('btn-default');
			$('#_kondisi_fisik1').addClass('btn-primary');
			$('#_kondisi_fisik0').removeClass('btn-primary');
			$('#_kondisi_fisik0').addClass('btn-default');
						
			$('input[name="kondisi_fisik"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="kondisi_fisik"][value="Ya"]').removeAttr('checked');
			$('#id_difabel').chosen().chosenReadonly(true);
			$('[name="id_difabel"]').val('').trigger("chosen:updated");
						
			$('#_kondisi_fisik1').addClass('active');
			$('#_kondisi_fisik0').removeClass('active');
					
			$('[name="status_perkawinan"]').val('').trigger("chosen:updated");
			$('[name="id_pendidikan"]').val('').trigger("chosen:updated");
					
			$('[name="id_agama"]').val('').trigger("chosen:updated");
					
			$('[name="agama_desc"]').val('');
			$('[name="agama_desc"]').prop({disabled:true});
			
			$('[name="kewarganegaraan"]').val('').trigger("chosen:updated");
			$('#id_negara').chosen().chosenReadonly(true);
			$('[name="id_negara"]').val('').trigger("chosen:updated");
			
			$('[name="id_pekerjaan"]').val('').trigger("chosen:updated");
			$('[name="pekerjaan_desc"]').val('');
			$('[name="pekerjaan_desc"]').prop({disabled: true});
					
			$('#_pekerjaan21').removeClass('btn-default');
			$('#_pekerjaan21').addClass('btn-primary');
			$('#_pekerjaan20').removeClass('btn-primary');
			$('#_pekerjaan20').addClass('btn-default');
			$('#_pekerjaan21').addClass('active');
			$('#_pekerjaan20').removeClass('active');
			
			$('input[name="pekerjaan2"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaan2"][value="Ya"]').removeAttr('checked');
			$('[name="pekerjaan2_desc"]').val('');	
			$('[name="pekerjaan2_desc"]').prop({disabled: true});
					
			$('#_pekerjaansi1').removeClass('btn-default');
			$('#_pekerjaansi1').addClass('btn-primary');
			$('#_pekerjaansi0').removeClass('btn-primary');
			$('#_pekerjaansi0').addClass('btn-default');
			$('#_pekerjaansi1').addClass('active');
			$('#_pekerjaansi0').removeClass('active');
						
			$('input[name="pekerjaansi"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaansi"][value="Ya"]').removeAttr('checked');
			$('#id_pekerjaansi').chosen().chosenReadonly(true);
			$('[name="id_pekerjaansi"]').val('').trigger("chosen:updated");
					
			$('[name="pekerjaansi_desc"]').val('');
			$('[name="pekerjaansi_desc"]').prop({disabled: true});
					
			$('[name="id_penghasilan"]').val('').trigger("chosen:updated");
			$('[name="jml_anak"]').val('');
			$('[name="tanggungan_total"]').val('');
			$('[name="harta_rumah"]').val('');
			$('[name="harta_tanah"]').val('');
			$('[name="harta_bangunan"]').val('');
			$('[name="harta_mobil"]').val('');
			$('[name="harta_motor"]').val('');
			$('[name="harta_toko"]').val('');
			$('[name="harta_tabungan"]').val('');
			$('[name="harta_handphone"]').val('');
			$('[name="harta_lain"]').val('');
			$('[name="status_tempat_tinggal"]').val('').trigger("chosen:updated");
					
			$('[name="alm_jalan"]').val('');
			$('[name="alm_rt"]').val('');
			$('[name="alm_rw"]').val('');
			$('[name="kodepos"]').val('');
			$('[name="id_provinsi"]').val('').trigger("chosen:updated");
					
			var _id_kabkota = $('select[name="id_kabkota"]');
			$('#id_kabkota').empty();
			_id_kabkota.prop({disabled: false});
			_id_kabkota.trigger('chosen:updated');
					
			$('[name="id_kabkota"]').val('').trigger("chosen:updated");
			//$('[name="id_kecamatan"]').val('').trigger("chosen:updated");
			$('[name="id_kecamatan"]').val('');
			//$('[name="id_desa"]').val('').trigger("chosen:updated");
			$('[name="id_desa"]').val('');
			$('[name="no_telp"]').val('');
			$('[name="no_hp"]').val('');
			$('[name="nm_hp"]').val('');
			$('[name="email"]').val('');
			/*
			$('[name="facebook"]').val('');
			$('[name="twitter"]').val('');
			$('[name="sosial_media"]').val('');
			*/
					
			$('[name="jenis_kid"]').val('').trigger("chosen:updated");
			$('[name="nomor_kid"]').val('');
			$('[name="nomor_kid"]').prop({disabled: true});
					
			$('[name="jenis_ktm"]').val('').trigger("chosen:updated");
			$('[name="nomor_ktm"]').val('');
			$('[name="nomor_ktm"]').prop({disabled: true});
					
			$('#_status_pemohon1').removeClass('btn-default');
			$('#_status_pemohon1').addClass('btn-primary');
			$('#_status_pemohon0').removeClass('btn-primary');
			$('#_status_pemohon0').addClass('btn-default');
						
			$('input[name="status_pemohon"][value="Ya"]').attr('checked', 'checked');
			$('input[name="status_pemohon"][value="Tidak"]').removeAttr('checked');
										
			$('#_status_pemohon1').addClass('active');
			$('#_status_pemohon0').removeClass('active');
					
			/* PENERIMA */
			
			$('[name="nm_lengkapb"]').val('');
			$('[name="nm_panggilanb"]').val('');
			$('[name="tmp_lahirb"]').val('');
			$('[name="tgl_lahirb"]').val('');
						
			$('#_jkelb2').removeClass('btn-default');
			$('#_jkelb2').addClass('btn-primary');
			$('#_jkelb1').removeClass('btn-primary');
			$('#_jkelb1').addClass('btn-default');
			$('#_jkelb0').removeClass('btn-primary');
			$('#_jkelb0').addClass('btn-default');
						
			$('input[name="jkelb"][value="Laki-laki"]').attr('checked', 'checked');
			$('input[name="jkelb"][value="Perempuan"]').removeAttr('checked');
			$('input[name="jkelb"][value="Lainnya"]').removeAttr('checked');
							
			$('#_jkelb2').addClass('active');
			$('#_jkelb1').removeClass('active');
			$('#_jkelb0').removeClass('active');
						
			$('[name="id_golongan_darahb"]').val('').trigger("chosen:updated");
			
			$('#_kondisi_fisikb1').removeClass('btn-default');
			$('#_kondisi_fisikb1').addClass('btn-primary');
			$('#_kondisi_fisikb0').removeClass('btn-primary');
			$('#_kondisi_fisikb0').addClass('btn-default');
							
			$('input[name="kondisi_fisikb"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="kondisi_fisikb"][value="Ya"]').removeAttr('checked');
			$('#id_difabelb').chosen().chosenReadonly(true);
			$('[name="id_difabelb"]').val('').trigger("chosen:updated");
							
			$('#_kondisi_fisikb1').addClass('active');
			$('#_kondisi_fisikb0').removeClass('active');
						
			$('[name="status_perkawinanb"]').val('').trigger("chosen:updated");
			$('[name="id_pendidikanb"]').val('').trigger("chosen:updated");
			$('[name="id_agamab"]').val('').trigger("chosen:updated");
			$('[name="agama_descb"]').val('');
			$('[name="agama_descb"]').prop({disabled:true});
						
			$('[name="kewarganegaraanb"]').val('').trigger("chosen:updated");
			$('#id_negarab').chosen().chosenReadonly(true);
			$('[name="id_negarab"]').val('').trigger("chosen:updated");
						
			$('[name="id_pekerjaanb"]').val('').trigger("chosen:updated");
			$('[name="pekerjaan_descb"]').val('');
			$('[name="pekerjaan_descb"]').prop({disabled: true});
						
			$('#_pekerjaan2b1').removeClass('btn-default');
			$('#_pekerjaan2b1').addClass('btn-primary');
			$('#_pekerjaan2b0').removeClass('btn-primary');
			$('#_pekerjaan2b0').addClass('btn-default');
			$('#_pekerjaan2b1').addClass('active');
			$('#_pekerjaan2b0').removeClass('active');
							
			$('input[name="pekerjaan2b"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaan2b"][value="Ya"]').removeAttr('checked');
			$('[name="pekerjaan2_descb"]').val('');	
			$('[name="pekerjaan2_descb"]').prop({disabled: true});
						
			$('#_pekerjaansib1').removeClass('btn-default');
			$('#_pekerjaansib1').addClass('btn-primary');
			$('#_pekerjaansib0').removeClass('btn-primary');
			$('#_pekerjaansib0').addClass('btn-default');
			$('#_pekerjaansib1').addClass('active');
			$('#_pekerjaansib0').removeClass('active');
							
			$('input[name="pekerjaansib"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="pekerjaansib"][value="Ya"]').removeAttr('checked');
			$('#id_pekerjaansib').chosen().chosenReadonly(true);
			$('[name="id_pekerjaansib"]').val('').trigger("chosen:updated");
						
			$('[name="pekerjaansi_descb"]').val('');
			$('[name="pekerjaansi_descb"]').prop({disabled: true});
						
			$('[name="id_penghasilanb"]').val('').trigger("chosen:updated");
			$('[name="jml_anakb"]').val('');
			$('[name="tanggungan_totalb"]').val('');
			$('[name="harta_rumahb"]').val('');
			$('[name="harta_tanahb"]').val('');
			$('[name="harta_bangunanb"]').val('');
			$('[name="harta_mobilb"]').val('');
			$('[name="harta_motorb"]').val('');
			$('[name="harta_tokob"]').val('');
			$('[name="harta_tabunganb"]').val('');
			$('[name="harta_handphoneb"]').val('');
			$('[name="harta_lainb"]').val('');
			$('[name="status_tempat_tinggalb"]').val('').trigger("chosen:updated");
						
			$('[name="alm_jalanb"]').val('');
			$('[name="alm_rtb"]').val('');
			$('[name="alm_rwb"]').val('');
			$('[name="kodeposb"]').val('');
			$('[name="id_provinsib"]').val('').trigger("chosen:updated");
			
			var _id_kabkotab = $('select[name="id_kabkotab"]');
			$('#id_kabkotab').empty();
			_id_kabkotab.prop({disabled: false});
			_id_kabkotab.trigger('chosen:updated');
						
			$('[name="id_kabkotab"]').val('').trigger("chosen:updated");
			//$('[name="id_kecamatanb"]').val('').trigger("chosen:updated");
			$('[name="id_kecamatanb"]').val('');
			//$('[name="id_desab"]').val('').trigger("chosen:updated");
			$('[name="id_desab"]').val('');
			$('[name="no_telpb"]').val('');
			$('[name="no_hpb"]').val('');
			$('[name="nm_hpb"]').val('');
			$('[name="emailb"]').val('');
			/*
			$('[name="facebookb"]').val('');
			$('[name="twitter"]').val('');
			$('[name="sosial_media"]').val('');
			*/
						
			$('[name="jenis_kidb"]').val('').trigger("chosen:updated");
			$('[name="nomor_kidb"]').val('');
			$('[name="nomor_kidb"]').prop({disabled: true});
			
			$('[name="jenis_ktmb"]').val('').trigger("chosen:updated");
			$('[name="nomor_ktmb"]').val('');
			$('[name="nomor_ktmb"]').prop({disabled: true});
						
			$('[name="hubungan_penerima"]').val('');	
			
			file_kid = new Array();
			$('#list_kid').empty();				
					
			file_ktm = new Array();
			$('#list_ktm').empty();
					
			$('[name="id_jarak_tempuh"]').val('').trigger("chosen:updated");
			$('[name="id_waktu_tempuh"]').val('').trigger("chosen:updated");
					
			$('#_pernah_jadi_client1').removeClass('btn-default');
			$('#_pernah_jadi_client1').addClass('btn-primary');
			$('#_pernah_jadi_client0').removeClass('btn-primary');
			$('#_pernah_jadi_client0').addClass('btn-default');
			$('#_pernah_jadi_client1').addClass('active');
			$('#_pernah_jadi_client0').removeClass('active');
						
			$('input[name="pernah_jadi_client"][value="Belum"]').attr('checked', 'checked');
			$('input[name="pernah_jadi_client"][value="Pernah"]').removeAttr('checked');
			$('#id_sumber_info').chosen().chosenReadonly(false);
			$('[name="id_sumber_info"]').val('').trigger("chosen:updated");
					
			$('[name="sumber_info_desc"]').val('');
			$('[name="sumber_info_desc"]').prop({disabled: true});
			
			$('#_rekomendasi_lbh1').removeClass('btn-default');
			$('#_rekomendasi_lbh1').addClass('btn-primary');
			$('#_rekomendasi_lbh0').removeClass('btn-primary');
			$('#_rekomendasi_lbh0').addClass('btn-default');
			$('#_rekomendasi_lbh1').addClass('active');
			$('#_rekomendasi_lbh0').removeClass('active');
						
			$('input[name="rekomendasi_lbh"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="rekomendasi_lbh"][value="Ya"]').removeAttr('checked');
			
			$('[name="nm_rekomendasi"]').val('');
			$('[name="alm_rekomendasi"]').val('');
			$('[name="pekerjaan_rekomendasi"]').val('');
			$('[name="nm_rekomendasi"]').prop({disabled: true});
			$('[name="alm_rekomendasi"]').prop({disabled: true});
			$('[name="pekerjaan_rekomendasi"]').prop({disabled: true});
			
			$('[name="uraian_singkat"]').val('');
			$('#uraian_singkat_box').parent().find('.wysihtml5-sandbox').contents().find('body').html('');
					
			$('input[name="penanganan_pihak_lain"][value="Tidak"]').attr('checked', 'checked');
			$('input[name="penanganan_pihak_lain"][value="Ya"]').removeAttr('checked');
			$('#_penanganan_pihak_lain0').removeClass('btn-primary');
			$('#_penanganan_pihak_lain0').addClass('btn-default');
			$('#_penanganan_pihak_lain1').removeClass('btn-default');
			$('#_penanganan_pihak_lain1').addClass('btn-primary');
			$('#_penanganan_pihak_lain1').addClass('active');
			$('#tahap_penanganan_pihak_lain_box').hide();
			$('#desc_tahap_penanganan_pihak_lain_box').hide();
								
			$('[name="tahap_penanganan_pihak_lain"]').val('').trigger("chosen:updated");
					
			$('#desc_tahap_penanganan_pihak_lain_box').hide();
			$('[name="desc_tahap_penanganan_pihak_lain"]').val('');
			
			$('#form-wizard').modal({backdrop: 'static', keyboard: false})  
			$('#form-wizard').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Permohonan Bantuan Hukum'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Identitas Pemohon Bantuan Hukum'); // Set title to Bootstrap modal title
			$('#step-1').removeClass('hide');
			$('#btn-next1').removeClass('hide');
			$('#step-2').addClass('hide');
			$('#btn-next2').addClass('hide');
			$('#btn-prev2').addClass('hide');
			$('#step-3').addClass('hide');
			$('#btn-next3').addClass('hide');
			$('#btn-prev3').addClass('hide');
			/* Penerima */
			$('#step-1b').addClass('hide');
			$('#btn-next1b').addClass('hide');
			$('#btn-prev1b').addClass('hide');
			$('#step-2b').addClass('hide');
			$('#btn-next2b').addClass('hide');
			$('#btn-prev2b').addClass('hide');
			$('#step-3b').addClass('hide');
			$('#btn-next3b').addClass('hide');
			$('#btn-prev3b').addClass('hide');
			/* End Penerima */
			$('#step-4').addClass('hide');
			$('#btn-next4').addClass('hide');
			$('#btn-prev4').addClass('hide');
			$('#step-5').addClass('hide');
			$('#btn-next5').addClass('hide');
			$('#btn-prev5').addClass('hide');
			$('#step-6').addClass('hide');
			$('#btn-next6').addClass('hide');
			$('#btn-prev6').addClass('hide');
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = "";
        }
    });	
}

function next1()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
	
	var formData = {
		validate: '1',
		id_permohonan: $('[name="id_permohonan"]').val(),
		nm_lengkap: $('[name="nm_lengkap"]').val(),
		nm_panggilan: $('[name="nm_panggilan"]').val(),
		tmp_lahir: $('[name="tmp_lahir"]').val(),
		tgl_lahir: $('[name="tgl_lahir"]').val(),
		jkel: $('[name="jkel"][checked="checked"]').val(),
		id_golongan_darah: $('[name="id_golongan_darah"]').val(),
		kondisi_fisik: $('[name="kondisi_fisik"][checked="checked"]').val(),
		id_difabel: $('[name="id_difabel"]').val(),
		status_perkawinan: $('[name="status_perkawinan"]').val(),
		id_pendidikan: $('[name="id_pendidikan"]').val(),
		id_agama: $('[name="id_agama"]').val(),
		agama_desc: $('[name="agama_desc"]').val(),
		kewarganegaraan: $('[name="kewarganegaraan"]').val(),
		id_negara: $('[name="id_negara"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Pemohon Bantuan)'); // Set title to Bootstrap modal title
				$('#step-1').addClass('hide');
				$('#btn-next1').addClass('hide');
				$('#step-2').removeClass('hide');
				$('#btn-next2').removeClass('hide');
				$('#btn-prev2').removeClass('hide');
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
            window.location = "";
        }
	});
	
	
}

function prev2()
{
	$('.modal-subtitle').text('Identitas Pemohon Bantuan Hukum'); // Set title to Bootstrap modal title
	$('#step-1').removeClass('hide');
	$('#btn-next1').removeClass('hide');
	$('#step-2').addClass('hide');
	$('#btn-next2').addClass('hide');
	$('#btn-prev2').addClass('hide');
}

function next2()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
	
	var formData = {
		validate: '2',
		id_pekerjaan: $('[name="id_pekerjaan"]').val(),
		pekerjaan_desc: $('[name="pekerjaan_desc"]').val(),
		pekerjaan2: $('[name="pekerjaan2"][checked="checked"]').val(),
		pekerjaan2_desc: $('[name="pekerjaan2_desc"]').val(),
		pekerjaansi: $('[name="pekerjaansi"][checked="checked"]').val(),
		id_pekerjaansi: $('[name="id_pekerjaansi"]').val(),
		pekerjaansi_desc: $('[name="pekerjaansi_desc"]').val(),
		id_penghasilan: $('[name="id_penghasilan"]').val(),
		jml_anak: $('[name="jml_anak"]').val(),
		tanggungan_total: $('[name="tanggungan_total"]').val(),
		harta_rumah: $('[name="harta_rumah"]').val(),
		harta_tanah: $('[name="harta_tanah"]').val(),
		harta_bangunan: $('[name="harta_bangunan"]').val(),
		harta_mobil: $('[name="harta_mobil"]').val(),
		harta_motor: $('[name="harta_motor"]').val(),
		harta_toko: $('[name="harta_toko"]').val(),
		harta_tabungan: $('[name="harta_tabungan"]').val(),
		harta_handphone: $('[name="harta_handphone"]').val(),
		harta_lain: $('[name="harta_lain"]').val(),
		status_tempat_tinggal: $('[name="status_tempat_tinggal"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('.modal-subtitle').text('Alamat & Contact Person (Pemohon Bantuan)'); // Set title to Bootstrap modal title
				$('#step-2').addClass('hide');
				$('#btn-next2').addClass('hide');
				$('#btn-prev2').addClass('hide');
				$('#step-3').removeClass('hide');
				$('#btn-next3').removeClass('hide');
				$('#btn-prev3').removeClass('hide');
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
            window.location = "";
        }
	});
}

function prev3()
{
	$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Pemohon Bantuan)'); // Set title to Bootstrap modal title
	$('#step-2').removeClass('hide');
	$('#btn-next2').removeClass('hide');
	$('#btn-prev2').removeClass('hide');
	$('#step-3').addClass('hide');
	$('#btn-next3').addClass('hide');
	$('#btn-prev3').addClass('hide');
}

function next3()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	status_pemohon = $('[name="status_pemohon"][checked="checked"]').val();
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
	
	var formData = {
		validate: '3',
		alm_jalan: $('[name="alm_jalan"]').val(),
		alm_rt: $('[name="alm_rt"]').val(),
		alm_rw: $('[name="alm_rw"]').val(),
		kodepos: $('[name="kodepos"]').val(),
		id_provinsi: $('[name="id_provinsi"]').val(),
		id_kabkota: $('[name="id_kabkota"]').val(),
		id_kecamatan: $('[name="id_kecamatan"]').val(),
		id_desa: $('[name="id_desa"]').val(),
		no_telp: $('[name="no_telp"]').val(),
		no_hp: $('[name="no_hp"]').val(),
		nm_hp: $('[name="nm_hp"]').val(),
		email: $('[name="email"]').val(),
		facebook: $('[name="facebook"]').val(),
		twitter: $('[name="twitter"]').val(),
		sosial_media: $('[name="sosial_media"]').val(),
		jenis_kid: $('[name="jenis_kid"]').val(),
		nomor_kid: $('[name="nomor_kid"]').val(),
		jenis_ktm: $('[name="jenis_ktm"]').val(),
		nomor_ktm: $('[name="nomor_ktm"]').val(),
		status_pemohon: $('[name="status_pemohon"][checked="checked"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				
				if(status_pemohon == 'Tidak')
				{
					$('.modal-subtitle').text('Identitas Penerima Bantuan Hukum'); // Set title to Bootstrap modal title
					$('#step-3').addClass('hide');
					$('#btn-next3').addClass('hide');
					$('#btn-prev3').addClass('hide');
					$('#step-1b').removeClass('hide');
					$('#btn-next1b').removeClass('hide');
					$('#btn-prev1b').removeClass('hide');
					
				}
				else
				{
					$('.modal-subtitle').text('Lampiran'); // Set title to Bootstrap modal title
					$('#step-3').addClass('hide');
					$('#btn-next3').addClass('hide');
					$('#btn-prev3').addClass('hide');
					$('#step-4').removeClass('hide');
					$('#btn-next4').removeClass('hide');
					$('#btn-prev4').removeClass('hide');
				}		
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
            window.location = "";
        }
	});
}

function prev1b()
{
	$('.modal-subtitle').text('Alamat & Contact Person (Pemohon Bantuan)'); // Set title to Bootstrap modal title
	$('#step-1b').addClass('hide');
	$('#btn-next1b').addClass('hide');
	$('#btn-prev1b').addClass('hide');
	$('#step-3').removeClass('hide');
	$('#btn-next3').removeClass('hide');
	$('#btn-prev3').removeClass('hide');
	
}

function next1b()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
	
	var formData = {
		validate: '1b',
		nm_lengkapb: $('[name="nm_lengkapb"]').val(),
		nm_panggilanb: $('[name="nm_panggilanb"]').val(),
		tmp_lahirb: $('[name="tmp_lahirb"]').val(),
		tgl_lahirb: $('[name="tgl_lahirb"]').val(),
		jkelb: $('[name="jkelb"][checked="checked"]').val(),
		id_golongan_darahb: $('[name="id_golongan_darahb"]').val(),
		kondisi_fisikb: $('[name="kondisi_fisikb"][checked="checked"]').val(),
		id_difabelb: $('[name="id_difabelb"]').val(),
		status_perkawinanb: $('[name="status_perkawinanb"]').val(),
		id_pendidikanb: $('[name="id_pendidikanb"]').val(),
		id_agamab: $('[name="id_agamab"]').val(),
		agama_descb: $('[name="agama_descb"]').val(),
		kewarganegaraanb: $('[name="kewarganegaraanb"]').val(),
		id_negarab: $('[name="id_negarab"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Penerima Bantuan)'); // Set title to Bootstrap modal title
				$('#step-1b').addClass('hide');
				$('#btn-next1b').addClass('hide');
				$('#btn-prev1b').addClass('hide');
				$('#step-2b').removeClass('hide');
				$('#btn-next2b').removeClass('hide');
				$('#btn-prev2b').removeClass('hide');
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
            window.location = "";
        }
	});
}

function prev2b()
{
	$('.modal-subtitle').text('Identitas Penerima Bantuan Hukum'); // Set title to Bootstrap modal title
	$('#step-1b').removeClass('hide');
	$('#btn-next1b').removeClass('hide');
	$('#btn-prev1b').removeClass('hide');
	$('#step-2b').addClass('hide');
	$('#btn-next2b').addClass('hide');
	$('#btn-prev2b').addClass('hide');
}

function next2b()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
	
	var formData = {
		validate: '2b',
		id_pekerjaanb: $('[name="id_pekerjaanb"]').val(),
		pekerjaan_descb: $('[name="pekerjaan_descb"]').val(),
		pekerjaan2b: $('[name="pekerjaan2b"][checked="checked"]').val(),
		pekerjaan2_descb: $('[name="pekerjaan2_descb"]').val(),
		pekerjaansib: $('[name="pekerjaansib"][checked="checked"]').val(),
		id_pekerjaansib: $('[name="id_pekerjaansib"]').val(),
		pekerjaansi_descb: $('[name="pekerjaansi_descb"]').val(),
		id_penghasilanb: $('[name="id_penghasilanb"]').val(),
		jml_anakb: $('[name="jml_anakb"]').val(),
		tanggungan_totalb: $('[name="tanggungan_totalb"]').val(),
		harta_rumahb: $('[name="harta_rumahb"]').val(),
		harta_tanahb: $('[name="harta_tanahb"]').val(),
		harta_bangunanb: $('[name="harta_bangunanb"]').val(),
		harta_mobilb: $('[name="harta_mobilb"]').val(),
		harta_motorb: $('[name="harta_motorb"]').val(),
		harta_tokob: $('[name="harta_tokob"]').val(),
		harta_tabunganb: $('[name="harta_tabunganb"]').val(),
		harta_handphoneb: $('[name="harta_handphoneb"]').val(),
		harta_lainb: $('[name="harta_lainb"]').val(),
		status_tempat_tinggalb: $('[name="status_tempat_tinggalb"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('.modal-subtitle').text('Alamat & Contact Person (Penerima Bantuan)'); // Set title to Bootstrap modal title
				$('#step-2b').addClass('hide');
				$('#btn-next2b').addClass('hide');
				$('#btn-prev2b').addClass('hide');
				$('#step-3b').removeClass('hide');
				$('#btn-next3b').removeClass('hide');
				$('#btn-prev3b').removeClass('hide');
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
            window.location = "";
        }
	});
}


function prev3b()
{
	$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Penerima Bantuan)'); // Set title to Bootstrap modal title
	$('#step-2b').removeClass('hide');
	$('#btn-next2b').removeClass('hide');
	$('#btn-prev2b').removeClass('hide');
	$('#step-3b').addClass('hide');
	$('#btn-next3b').addClass('hide');
	$('#btn-prev3b').addClass('hide');
}

function next3b()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
	
	var formData = {
		validate: '3b',
		alm_jalanb: $('[name="alm_jalanb"]').val(),
		alm_rtb: $('[name="alm_rtb"]').val(),
		alm_rwb: $('[name="alm_rwb"]').val(),
		kodeposb: $('[name="kodeposb"]').val(),
		id_provinsib: $('[name="id_provinsib"]').val(),
		id_kabkotab: $('[name="id_kabkotab"]').val(),
		id_kecamatanb: $('[name="id_kecamatanb"]').val(),
		id_desab: $('[name="id_desab"]').val(),
		no_telpb: $('[name="no_telpb"]').val(),
		no_hpb: $('[name="no_hpb"]').val(),
		nm_hpb: $('[name="nm_hpb"]').val(),
		emailb: $('[name="emailb"]').val(),
		facebookb: $('[name="facebookb"]').val(),
		twitterb: $('[name="twitterb"]').val(),
		sosial_mediab: $('[name="sosial_mediab"]').val(),
		jenis_kidb: $('[name="jenis_kidb"]').val(),
		nomor_kidb: $('[name="nomor_kidb"]').val(),
		jenis_ktmb: $('[name="jenis_ktmb"]').val(),
		nomor_ktmb: $('[name="nomor_ktmb"]').val(),
		hubungan_penerima: $('[name="hubungan_penerima"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				
				$('.modal-subtitle').text('Lampiran'); // Set title to Bootstrap modal title
				$('#step-3b').addClass('hide');
				$('#btn-next3b').addClass('hide');
				$('#btn-prev3b').addClass('hide');
				$('#step-4').removeClass('hide');
				$('#btn-next4').removeClass('hide');
				$('#btn-prev4').removeClass('hide');
				
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
            window.location = "";
        }
	});
}

function prev4()
{
	if(status_pemohon == 'Ya')
	{
		$('.modal-subtitle').text('Alamat & Contact Person (Pemohon Bantuan)'); // Set title to Bootstrap modal title
		$('#step-3').removeClass('hide');
		$('#btn-next3').removeClass('hide');
		$('#btn-prev3').removeClass('hide');
		$('#step-4').addClass('hide');
		$('#btn-next4').addClass('hide');
		$('#btn-prev4').addClass('hide');	
	}
	else
	{
		$('.modal-subtitle').text('Alamat & Contact Person (Penerima Bantuan)'); // Set title to Bootstrap modal title
		$('#step-3b').removeClass('hide');
		$('#btn-next3b').removeClass('hide');
		$('#btn-prev3b').removeClass('hide');
		$('#step-4').addClass('hide');
		$('#btn-next4').addClass('hide');
		$('#btn-prev4').addClass('hide');
	}		
}

function next4()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
    
	var formData = {
		validate: '4',
		file_kid: file_kid,
		file_ktm: file_ktm
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('.modal-subtitle').text('Kuesioner'); // Set title to Bootstrap modal title
				$('#step-4').addClass('hide');
				$('#btn-next4').addClass('hide');
				$('#btn-prev4').addClass('hide');
				$('#step-5').removeClass('hide');
				$('#btn-next5').removeClass('hide');
				$('#btn-prev5').removeClass('hide');
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
            window.location = "";
        }
	});
}

function prev5()
{
	$('.modal-subtitle').text('Lampiran'); // Set title to Bootstrap modal title
	$('#step-4').removeClass('hide');
	$('#btn-next4').removeClass('hide');
	$('#btn-prev4').removeClass('hide');
	$('#step-5').addClass('hide');
	$('#btn-next5').addClass('hide');
	$('#btn-prev5').addClass('hide');
}

function next5()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
    
	var formData = {
		validate: '5',
		id_jarak_tempuh: $('[name="id_jarak_tempuh"]').val(),
		id_waktu_tempuh: $('[name="id_waktu_tempuh"]').val(),
		pernah_jadi_client: $('[name="pernah_jadi_client"][checked="checked"]').val(),
		id_sumber_info: $('[name="id_sumber_info"]').val(),
		sumber_info_desc: $('[name="sumber_info_desc"]').val(),
		rekomendasi_lbh: $('[name="rekomendasi_lbh"][checked="checked"]').val(),
		nm_rekomendasi: $('[name="nm_rekomendasi"]').val(),
		alm_rekomendasi: $('[name="alm_rekomendasi"]').val(),
		pekerjaan_rekomendasi: $('[name="pekerjaan_rekomendasi"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('.modal-subtitle').text('Kronologi Pokok Permasalahan'); // Set title to Bootstrap modal title
				$('#step-5').addClass('hide');
				$('#btn-next5').addClass('hide');
				$('#btn-prev5').addClass('hide');
				$('#step-6').removeClass('hide');
				$('#btn-next6').removeClass('hide');
				$('#btn-prev6').removeClass('hide');
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
            window.location = "";
        }
	});
}

function prev6()
{
	$('.modal-subtitle').text('Kuesioner'); // Set title to Bootstrap modal title
	$('#step-5').removeClass('hide');
	$('#btn-next5').removeClass('hide');
	$('#btn-prev5').removeClass('hide');
	$('#step-6').addClass('hide');
	$('#btn-next6').addClass('hide');
	$('#btn-prev6').addClass('hide');
}

function next6()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	if(save_method == 'add') 
	{
        url = "permohonan/ajax_save";
    } 
	else 
	{
        url = "permohonan/ajax_update";
    };
	
	var formData = {
		validate: '6',
		csrf_token: $('[name="csrf_token"]').val(),
		id_permohonan: $('[name="id_permohonan"]').val(),
		nm_lengkap: $('[name="nm_lengkap"]').val(),
		nm_panggilan: $('[name="nm_panggilan"]').val(),
		tmp_lahir: $('[name="tmp_lahir"]').val(),
		tgl_lahir: $('[name="tgl_lahir"]').val(),
		jkel: $('[name="jkel"][checked="checked"]').val(),
		id_golongan_darah: $('[name="id_golongan_darah"]').val(),
		kondisi_fisik: $('[name="kondisi_fisik"][checked="checked"]').val(),
		id_difabel: $('[name="id_difabel"]').val(),
		status_perkawinan: $('[name="status_perkawinan"]').val(),
		id_pendidikan: $('[name="id_pendidikan"]').val(),
		id_agama: $('[name="id_agama"]').val(),
		agama_desc: $('[name="agama_desc"]').val(),
		kewarganegaraan: $('[name="kewarganegaraan"]').val(),
		id_negara: $('[name="id_negara"]').val(),
		id_pekerjaan: $('[name="id_pekerjaan"]').val(),
		pekerjaan_desc: $('[name="pekerjaan_desc"]').val(),
		pekerjaan2: $('[name="pekerjaan2"][checked="checked"]').val(),
		pekerjaan2_desc: $('[name="pekerjaan2_desc"]').val(),
		pekerjaansi: $('[name="pekerjaansi"][checked="checked"]').val(),
		id_pekerjaansi: $('[name="id_pekerjaansi"]').val(),
		pekerjaansi_desc: $('[name="pekerjaansi_desc"]').val(),
		id_penghasilan: $('[name="id_penghasilan"]').val(),
		jml_anak: $('[name="jml_anak"]').val(),
		tanggungan_total: $('[name="tanggungan_total"]').val(),
		harta_rumah: $('[name="harta_rumah"]').val(),
		harta_tanah: $('[name="harta_tanah"]').val(),
		harta_bangunan: $('[name="harta_bangunan"]').val(),
		harta_mobil: $('[name="harta_mobil"]').val(),
		harta_motor: $('[name="harta_motor"]').val(),
		harta_toko: $('[name="harta_toko"]').val(),
		harta_tabungan: $('[name="harta_tabungan"]').val(),
		harta_handphone: $('[name="harta_handphone"]').val(),
		harta_lain: $('[name="harta_lain"]').val(),
		status_tempat_tinggal: $('[name="status_tempat_tinggal"]').val(),
		alm_jalan: $('[name="alm_jalan"]').val(),
		alm_rt: $('[name="alm_rt"]').val(),
		alm_rw: $('[name="alm_rw"]').val(),
		kodepos: $('[name="kodepos"]').val(),
		id_provinsi: $('[name="id_provinsi"]').val(),
		id_kabkota: $('[name="id_kabkota"]').val(),
		id_kecamatan: $('[name="id_kecamatan"]').val(),
		id_desa: $('[name="id_desa"]').val(),
		no_telp: $('[name="no_telp"]').val(),
		no_hp: $('[name="no_hp"]').val(),
		nm_hp: $('[name="nm_hp"]').val(),
		email: $('[name="email"]').val(),
		/*
		facebook: $('[name="facebook"]').val(),
		twitter: $('[name="twitter"]').val(),
		sosial_media: $('[name="sosial_media"]').val(),
		*/
		jenis_kid: $('[name="jenis_kid"]').val(),
		nomor_kid: $('[name="nomor_kid"]').val(),
		jenis_ktm: $('[name="jenis_ktm"]').val(),
		nomor_ktm: $('[name="nomor_ktm"]').val(),
		status_pemohon: $('[name="status_pemohon"][checked="checked"]').val(),
		/*Penerima */
		nm_lengkapb: $('[name="nm_lengkapb"]').val(),
		nm_panggilanb: $('[name="nm_panggilanb"]').val(),
		tmp_lahirb: $('[name="tmp_lahirb"]').val(),
		tgl_lahirb: $('[name="tgl_lahirb"]').val(),
		jkelb: $('[name="jkelb"][checked="checked"]').val(),
		id_golongan_darahb: $('[name="id_golongan_darahb"]').val(),
		kondisi_fisikb: $('[name="kondisi_fisikb"][checked="checked"]').val(),
		id_difabelb: $('[name="id_difabelb"]').val(),
		status_perkawinanb: $('[name="status_perkawinanb"]').val(),
		id_pendidikanb: $('[name="id_pendidikanb"]').val(),
		id_agamab: $('[name="id_agamab"]').val(),
		agama_descb: $('[name="agama_descb"]').val(),
		kewarganegaraanb: $('[name="kewarganegaraanb"]').val(),
		id_negarab: $('[name="id_negarab"]').val(),
		id_pekerjaanb: $('[name="id_pekerjaanb"]').val(),
		pekerjaan_descb: $('[name="pekerjaan_descb"]').val(),
		pekerjaan2b: $('[name="pekerjaan2b"][checked="checked"]').val(),
		pekerjaan2_descb: $('[name="pekerjaan2_descb"]').val(),
		pekerjaansib: $('[name="pekerjaansib"][checked="checked"]').val(),
		id_pekerjaansib: $('[name="id_pekerjaansib"]').val(),
		pekerjaansi_descb: $('[name="pekerjaansi_descb"]').val(),
		id_penghasilanb: $('[name="id_penghasilanb"]').val(),
		jml_anakb: $('[name="jml_anakb"]').val(),
		tanggungan_totalb: $('[name="tanggungan_totalb"]').val(),
		harta_rumahb: $('[name="harta_rumahb"]').val(),
		harta_tanahb: $('[name="harta_tanahb"]').val(),
		harta_bangunanb: $('[name="harta_bangunanb"]').val(),
		harta_mobilb: $('[name="harta_mobilb"]').val(),
		harta_motorb: $('[name="harta_motorb"]').val(),
		harta_tokob: $('[name="harta_tokob"]').val(),
		harta_tabunganb: $('[name="harta_tabunganb"]').val(),
		harta_handphoneb: $('[name="harta_handphoneb"]').val(),
		harta_lainb: $('[name="harta_lainb"]').val(),
		status_tempat_tinggalb: $('[name="status_tempat_tinggalb"]').val(),
		alm_jalanb: $('[name="alm_jalanb"]').val(),
		alm_rtb: $('[name="alm_rtb"]').val(),
		alm_rwb: $('[name="alm_rwb"]').val(),
		kodeposb: $('[name="kodeposb"]').val(),
		id_provinsib: $('[name="id_provinsib"]').val(),
		id_kabkotab: $('[name="id_kabkotab"]').val(),
		id_kecamatanb: $('[name="id_kecamatanb"]').val(),
		id_desab: $('[name="id_desab"]').val(),
		no_telpb: $('[name="no_telpb"]').val(),
		no_hpb: $('[name="no_hpb"]').val(),
		nm_hpb: $('[name="nm_hpb"]').val(),
		emailb: $('[name="emailb"]').val(),
		/*
		facebookb: $('[name="facebookb"]').val(),
		twitterb: $('[name="twitterb"]').val(),
		sosial_mediab: $('[name="sosial_mediab"]').val(),
		*/
		jenis_kidb: $('[name="jenis_kidb"]').val(),
		nomor_kidb: $('[name="nomor_kidb"]').val(),
		jenis_ktmb: $('[name="jenis_ktmb"]').val(),
		nomor_ktmb: $('[name="nomor_ktmb"]').val(),
		hubungan_penerima: $('[name="hubungan_penerima"]').val(),
		/* End Penerima */
		file_kid: file_kid,
		file_ktm: file_ktm,
		id_jarak_tempuh: $('[name="id_jarak_tempuh"]').val(),
		id_waktu_tempuh: $('[name="id_waktu_tempuh"]').val(),
		pernah_jadi_client: $('[name="pernah_jadi_client"][checked="checked"]').val(),
		id_sumber_info: $('[name="id_sumber_info"]').val(),
		sumber_info_desc: $('[name="sumber_info_desc"]').val(),
		rekomendasi_lbh: $('[name="rekomendasi_lbh"][checked="checked"]').val(),
		nm_rekomendasi: $('[name="nm_rekomendasi"]').val(),
		alm_rekomendasi: $('[name="alm_rekomendasi"]').val(),
		pekerjaan_rekomendasi: $('[name="pekerjaan_rekomendasi"]').val(),
		uraian_singkat: $('[name="uraian_singkat"]').val(),
		//kronologi_kasus: $('[name="kronologi_kasus"]').val(),
		penanganan_pihak_lain: $('[name="penanganan_pihak_lain"][checked="checked"]').val(),
		tahap_penanganan_pihak_lain: $('[name="tahap_penanganan_pihak_lain"]').val(),
		desc_tahap_penanganan_pihak_lain: $('[name="desc_tahap_penanganan_pihak_lain"]').val()
	};
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('#form-wizard').modal('hide');
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
            window.location = "";
        }
		
	});
}



function edit(id_permohonan)
{
	$('#formWizard')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	$('#harta').removeClass('has-error'); // clear error class
	
	save_method = 'update';
	
	$.ajax({
        url : "permohonan/get_detail_permohonan/" + id_permohonan,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var permohonan = response[0];
			$('[name="id_permohonan"]').val(permohonan.id_permohonan);
			$('[name="uraian_singkat"]').val(permohonan.uraian_singkat);
			$('#uraian_singkat_box').parent().find('.wysihtml5-sandbox').contents().find('body').html(permohonan.uraian_singkat);
			//$('[name="kronologi_kasus"]').val(permohonan.kronologi_kasus);
			//$('#kronologi_kasus_box').parent().find('.wysihtml5-sandbox').contents().find('body').html(permohonan.kronologi_kasus);
						
			if(permohonan.penanganan_pihak_lain == 'Tidak')
			{
				$('input[name="penanganan_pihak_lain"][value="Tidak"]').attr('checked', 'checked');
				$('input[name="penanganan_pihak_lain"][value="Ya"]').removeAttr('checked');
				$('#_penanganan_pihak_lain0').removeClass('btn-primary');
				$('#_penanganan_pihak_lain0').addClass('btn-default');
				$('#_penanganan_pihak_lain1').removeClass('btn-default');
				$('#_penanganan_pihak_lain1').addClass('btn-primary');
				$('#_penanganan_pihak_lain1').addClass('active');
				$('#tahap_penanganan_pihak_lain_box').hide();
				$('#desc_tahap_penanganan_pihak_lain_box').hide();
			}
			else
			{
				$('input[name="penanganan_pihak_lain"][value="Ya"]').attr('checked', 'checked');
				$('input[name="penanganan_pihak_lain"][value="Tidak"]').removeAttr('checked');
				$('#_penanganan_pihak_lain1').removeClass('btn-primary');
				$('#_penanganan_pihak_lain1').addClass('btn-default');
				$('#_penanganan_pihak_lain0').removeClass('btn-default');
				$('#_penanganan_pihak_lain0').addClass('btn-primary');
				$('#_penanganan_pihak_lain0').addClass('active');
				$('#tahap_penanganan_pihak_lain_box').show();
			}
			
			$('[name="tahap_penanganan_pihak_lain"]').val(permohonan.tahap_penanganan_pihak_lain).trigger("chosen:updated");
			
			if(permohonan.tahap_penanganan_pihak_lain == '')
			{
				$('#desc_tahap_penanganan_pihak_lain_box').hide();
				$('[name="desc_tahap_penanganan_pihak_lain"]').val(permohonan.desc_tahap_penanganan_pihak_lain);	
			}
			else
			{
				$('#desc_tahap_penanganan_pihak_lain_box').show();
				$('[name="desc_tahap_penanganan_pihak_lain"]').val(permohonan.desc_tahap_penanganan_pihak_lain);
			}
			
			var pemohon = response[1];
			$('[name="nm_lengkap"]').val(pemohon.nm_lengkap);
			$('[name="nm_panggilan"]').val(pemohon.nm_panggilan);
			$('[name="tmp_lahir"]').val(pemohon.tmp_lahir);
			$('[name="tgl_lahir"]').val(pemohon.tgl_lahir);
			
			if(pemohon.jkel == 'Laki-laki')
			{
				$('#_jkel2').removeClass('btn-default');
				$('#_jkel2').addClass('btn-primary');
				$('#_jkel1').removeClass('btn-primary');
				$('#_jkel1').addClass('btn-default');
				$('#_jkel0').removeClass('btn-primary');
				$('#_jkel0').addClass('btn-default');
			
				$('input[name="jkel"][value="Laki-laki"]').attr('checked', 'checked');
				$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
				$('input[name="jkel"][value="Lainnya"]').removeAttr('checked');
				
				$('#_jkel2').addClass('active');
				$('#_jkel1').removeClass('active');
				$('#_jkel0').removeClass('active');
			}
			else if(pemohon.jkel == 'Perempuan')
			{
				$('#_jkel1').removeClass('btn-default');
				$('#_jkel1').addClass('btn-primary');
				$('#_jkel2').removeClass('btn-primary');
				$('#_jkel2').addClass('btn-default');
				$('#_jkel0').removeClass('btn-primary');
				$('#_jkel0').addClass('btn-default');
				
				$('input[name="jkel"][value="Laki-laki"]').removeAttr('checked');
				$('input[name="jkel"][value="Perempuan"]').attr('checked', 'checked');
				$('input[name="jkel"][value="Lainnya"]').removeAttr('checked');
				
				$('#_jkel1').addClass('active');
				$('#_jkel2').removeClass('active');
				$('#_jkel0').removeClass('active');
			}
			else
			{
				$('#_jkel0').removeClass('btn-default');
				$('#_jkel0').addClass('btn-primary');
				$('#_jkel1').removeClass('btn-primary');
				$('#_jkel1').addClass('btn-default');
				$('#_jkel2').removeClass('btn-primary');
				$('#_jkel2').addClass('btn-default');
				
				$('input[name="jkel"][value="Laki-laki"]').removeAttr('checked');
				$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
				$('input[name="jkel"][value="Lainnya"]').attr('checked', 'checked');
				
				$('#_jkel0').addClass('active');
				$('#_jkel1').removeClass('active');
				$('#_jkel2').removeClass('active');
			}
			
			$('[name="id_golongan_darah"]').val(pemohon.id_golongan_darah).trigger("chosen:updated");
			
			if(pemohon.kondisi_fisik == 'Tidak')
			{
				$('#_kondisi_fisik1').removeClass('btn-default');
				$('#_kondisi_fisik1').addClass('btn-primary');
				$('#_kondisi_fisik0').removeClass('btn-primary');
				$('#_kondisi_fisik0').addClass('btn-default');
				
				$('input[name="kondisi_fisik"][value="Tidak"]').attr('checked', 'checked');
				$('input[name="kondisi_fisik"][value="Ya"]').removeAttr('checked');
				$('#id_difabel').chosen().chosenReadonly(true);
				$('[name="id_difabel"]').val(pemohon.id_difabel).trigger("chosen:updated");
				
				$('#_kondisi_fisik1').addClass('active');
				$('#_kondisi_fisik0').removeClass('active');
			}
			else
			{
				
				$('#_kondisi_fisik0').removeClass('btn-default');
				$('#_kondisi_fisik0').addClass('btn-primary');
				$('#_kondisi_fisik1').removeClass('btn-primary');
				$('#_kondisi_fisik1').addClass('btn-default');
				
				$('input[name="kondisi_fisik"][value="Ya"]').attr('checked', 'checked');
				$('input[name="kondisi_fisik"][value="Tidak"]').removeAttr('checked');
				$('#id_difabel').chosen().chosenReadonly(false);
				$('[name="id_difabel"]').val(pemohon.id_difabel).trigger("chosen:updated");
				
				$('#_kondisi_fisik0').addClass('active');
				$('#_kondisi_fisik1').removeClass('active');
			}
			
			$('[name="status_perkawinan"]').val(pemohon.status_perkawinan).trigger("chosen:updated");
			$('[name="id_pendidikan"]').val(pemohon.id_pendidikan).trigger("chosen:updated");
			
			$('[name="id_agama"]').val(pemohon.id_agama).trigger("chosen:updated");
			if(pemohon.id_agama == '9')
			{
				$('[name="agama_desc"]').val(pemohon.agama_desc);
				$('[name="agama_desc"]').prop({disabled:false});
			}
			else
			{
				$('[name="agama_desc"]').val(pemohon.agama_desc);
				$('[name="agama_desc"]').prop({disabled:true});
			}	
			
			$('[name="kewarganegaraan"]').val(pemohon.kewarganegaraan).trigger("chosen:updated");
			if(pemohon.kewarganegaraan == 'WNA')
			{
				$('#id_negara').chosen().chosenReadonly(false);
				$('[name="id_negara"]').val(pemohon.id_negara).trigger("chosen:updated");
			}
			else 
			{
				$('#id_negara').chosen().chosenReadonly(true);
				$('[name="id_negara"]').val(pemohon.id_negara).trigger("chosen:updated");
			}
			
			$('[name="id_pekerjaan"]').val(pemohon.id_pekerjaan).trigger("chosen:updated");
			if(pemohon.id_pekerjaan == '45')
			{
				$('[name="pekerjaan_desc"]').val(pemohon.pekerjaan_desc);
				$('[name="pekerjaan_desc"]').prop({disabled: false});
			}
			else
			{
				$('[name="pekerjaan_desc"]').val(pemohon.pekerjaan_desc);
				$('[name="pekerjaan_desc"]').prop({disabled: true});
			}
			
			if(pemohon.pekerjaan2 == 'Tidak')
			{
				$('#_pekerjaan21').removeClass('btn-default');
				$('#_pekerjaan21').addClass('btn-primary');
				$('#_pekerjaan20').removeClass('btn-primary');
				$('#_pekerjaan20').addClass('btn-default');
				$('#_pekerjaan21').addClass('active');
				$('#_pekerjaan20').removeClass('active');
				
				$('input[name="pekerjaan2"][value="Tidak"]').attr('checked', 'checked');
				$('input[name="pekerjaan2"][value="Ya"]').removeAttr('checked');
				$('[name="pekerjaan2_desc"]').val(pemohon.pekerjaan2_desc);	
				$('[name="pekerjaan2_desc"]').prop({disabled: true});
			}
			else
			{
				$('#_pekerjaan20').removeClass('btn-default');
				$('#_pekerjaan20').addClass('btn-primary');
				$('#_pekerjaan21').removeClass('btn-primary');
				$('#_pekerjaan21').addClass('btn-default');
				$('#_pekerjaan20').addClass('active');
				$('#_pekerjaan21').removeClass('active');
				
				$('input[name="pekerjaan2"][value="Tidak"]').removeAttr('checked');
				$('input[name="pekerjaan2"][value="Ya"]').attr('checked', 'checked');
				$('[name="pekerjaan2_desc"]').val(pemohon.pekerjaan2_desc);	
				$('[name="pekerjaan2_desc"]').prop({disabled: false});	
			}	
			
			if(pemohon.pekerjaansi == 'Tidak')
			{
				$('#_pekerjaansi1').removeClass('btn-default');
				$('#_pekerjaansi1').addClass('btn-primary');
				$('#_pekerjaansi0').removeClass('btn-primary');
				$('#_pekerjaansi0').addClass('btn-default');
				$('#_pekerjaansi1').addClass('active');
				$('#_pekerjaansi0').removeClass('active');
				
				$('input[name="pekerjaansi"][value="Tidak"]').attr('checked', 'checked');
				$('input[name="pekerjaansi"][value="Ya"]').removeAttr('checked');
				$('#id_pekerjaansi').chosen().chosenReadonly(true);
				$('[name="id_pekerjaansi"]').val(pemohon.id_pekerjaansi).trigger("chosen:updated");
			}
			else
			{
				$('#_pekerjaansi0').removeClass('btn-default');
				$('#_pekerjaansi0').addClass('btn-primary');
				$('#_pekerjaansi1').removeClass('btn-primary');
				$('#_pekerjaansi1').addClass('btn-default');
				$('#_pekerjaansi0').addClass('active');
				$('#_pekerjaansi1').removeClass('active');
				
				$('input[name="pekerjaansi"][value="Tidak"]').removeAttr('checked');
				$('input[name="pekerjaansi"][value="Ya"]').attr('checked', 'checked');
				$('#id_pekerjaansi').chosen().chosenReadonly(false);
				$('[name="id_pekerjaansi"]').val(pemohon.id_pekerjaansi).trigger("chosen:updated");
			}
			
			if(pemohon.id_pekerjaansi == '45')
			{
				$('[name="pekerjaansi_desc"]').val(pemohon.pekerjaansi_desc);
				$('[name="pekerjaansi_desc"]').prop({disabled: false});
			}
			else
			{
				$('[name="pekerjaansi_desc"]').val(pemohon.pekerjaansi_desc);
				$('[name="pekerjaansi_desc"]').prop({disabled: true});
			}	
			
			$('[name="id_penghasilan"]').val(pemohon.id_penghasilan).trigger("chosen:updated");
			$('[name="jml_anak"]').val(pemohon.jml_anak);
			$('[name="jml_anak"]').val(pemohon.jml_anak);
			$('[name="tanggungan_total"]').val(pemohon.tanggungan_total);
			$('[name="harta_rumah"]').val(pemohon.harta_rumah);
			$('[name="harta_tanah"]').val(pemohon.harta_tanah);
			$('[name="harta_bangunan"]').val(pemohon.harta_bangunan);
			$('[name="harta_mobil"]').val(pemohon.harta_mobil);
			$('[name="harta_motor"]').val(pemohon.harta_motor);
			$('[name="harta_toko"]').val(pemohon.harta_toko);
			$('[name="harta_tabungan"]').val(pemohon.harta_tabungan);
			$('[name="harta_handphone"]').val(pemohon.harta_handphone);
			$('[name="harta_lain"]').val(pemohon.harta_lain);
			$('[name="status_tempat_tinggal"]').val(pemohon.status_tempat_tinggal).trigger("chosen:updated");
			
			$('[name="alm_jalan"]').val(pemohon.alm_jalan);
			$('[name="alm_rt"]').val(pemohon.alm_rt);
			$('[name="alm_rw"]').val(pemohon.alm_rw);
			$('[name="kodepos"]').val(pemohon.kodepos);
			$('[name="id_provinsi"]').val(pemohon.id_provinsi).trigger("chosen:updated");
			
			var kabkota = response[2];
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
			
			$('[name="id_kabkota"]').val(pemohon.id_kabkota).trigger("chosen:updated");
			//$('[name="id_kecamatan"]').val(pemohon.id_kecamatan).trigger("chosen:updated");
			$('[name="id_kecamatan"]').val(pemohon.kecamatan);
			//$('[name="id_desa"]').val(pemohon.id_desa).trigger("chosen:updated");
            $('[name="id_desa"]').val(pemohon.desa);
			$('[name="no_telp"]').val(pemohon.no_telp);
			$('[name="no_hp"]').val(pemohon.no_hp);
			$('[name="nm_hp"]').val(pemohon.nm_hp);
			$('[name="email"]').val(pemohon.email);
			/*
			$('[name="facebook"]').val(pemohon.facebook);
			$('[name="twitter"]').val(pemohon.twitter);
			$('[name="sosial_media"]').val(pemohon.sosial_media);
			*/
			
			
			$('[name="jenis_kid"]').val(pemohon.jenis_kid).trigger("chosen:updated");
			if(pemohon.jenis_kid == 'Tidak Ada')
			{
				$('[name="nomor_kid"]').val(pemohon.nomor_kid);
				$('[name="nomor_kid"]').prop({disabled: true});
			}
			else
			{
				$('[name="nomor_kid"]').val(pemohon.nomor_kid);
				$('[name="nomor_kid"]').prop({disabled: false});
			}
			
			$('[name="jenis_ktm"]').val(pemohon.jenis_ktm).trigger("chosen:updated");
			if(pemohon.jenis_ktm == 'Tidak Ada')
			{
				$('[name="nomor_ktm"]').val(pemohon.nomor_ktm);
				$('[name="nomor_ktm"]').prop({disabled: true});
			}
			else
			{
				$('[name="nomor_ktm"]').val(pemohon.nomor_ktm);
				$('[name="nomor_ktm"]').prop({disabled: false});
			}		
			
			if(pemohon.status_pemohon == 'Ya')
			{
				$('#_status_pemohon1').removeClass('btn-default');
				$('#_status_pemohon1').addClass('btn-primary');
				$('#_status_pemohon0').removeClass('btn-primary');
				$('#_status_pemohon0').addClass('btn-default');
				
				$('input[name="status_pemohon"][value="Ya"]').attr('checked', 'checked');
				$('input[name="status_pemohon"][value="Tidak"]').removeAttr('checked');
								
				$('#_status_pemohon1').addClass('active');
				$('#_status_pemohon0').removeClass('active');
			}
			else
			{
				
				$('#_status_pemohon0').removeClass('btn-default');
				$('#_status_pemohon0').addClass('btn-primary');
				$('#_status_pemohon1').removeClass('btn-primary');
				$('#_status_pemohon1').addClass('btn-default');
				
				$('input[name="status_pemohon"][value="Tidak"]').attr('checked', 'checked');
				$('input[name="status_pemohon"][value="Ya"]').removeAttr('checked');
								
				$('#_status_pemohon0').addClass('active');
				$('#_status_pemohon1').removeClass('active');
			}
			
			var penerima = response[3];
			var kabkotab = response[4];
			
			status_pemohon = pemohon.status_pemohon;
			
			if(status_pemohon == 'Tidak')
			{
				$('[name="nm_lengkapb"]').val(penerima.nm_lengkap);
				$('[name="nm_panggilanb"]').val(penerima.nm_panggilan);
				$('[name="tmp_lahirb"]').val(penerima.tmp_lahir);
				$('[name="tgl_lahirb"]').val(penerima.tgl_lahir);
				
				if(penerima.jkel == 'Laki-laki')
				{
					$('#_jkelb2').removeClass('btn-default');
					$('#_jkelb2').addClass('btn-primary');
					$('#_jkelb1').removeClass('btn-primary');
					$('#_jkelb1').addClass('btn-default');
					$('#_jkelb0').removeClass('btn-primary');
					$('#_jkelb0').addClass('btn-default');
				
					$('input[name="jkelb"][value="Laki-laki"]').attr('checked', 'checked');
					$('input[name="jkelb"][value="Perempuan"]').removeAttr('checked');
					$('input[name="jkelb"][value="Lainnya"]').removeAttr('checked');
					
					$('#_jkelb2').addClass('active');
					$('#_jkelb1').removeClass('active');
					$('#_jkelb0').removeClass('active');
				}
				else if(penerima.jkel == 'Perempuan')
				{
					$('#_jkelb1').removeClass('btn-default');
					$('#_jkelb1').addClass('btn-primary');
					$('#_jkelb2').removeClass('btn-primary');
					$('#_jkelb2').addClass('btn-default');
					$('#_jkelb0').removeClass('btn-primary');
					$('#_jkelb0').addClass('btn-default');
					
					$('input[name="jkelb"][value="Laki-laki"]').removeAttr('checked');
					$('input[name="jkelb"][value="Perempuan"]').attr('checked', 'checked');
					$('input[name="jkelb"][value="Lainnya"]').removeAttr('checked');
					
					$('#_jkelb1').addClass('active');
					$('#_jkelb2').removeClass('active');
					$('#_jkelb0').removeClass('active');
				}
				else
				{
					$('#_jkelb0').removeClass('btn-default');
					$('#_jkelb0').addClass('btn-primary');
					$('#_jkelb1').removeClass('btn-primary');
					$('#_jkelb1').addClass('btn-default');
					$('#_jkelb2').removeClass('btn-primary');
					$('#_jkelb2').addClass('btn-default');
					
					$('input[name="jkelb"][value="Laki-laki"]').removeAttr('checked');
					$('input[name="jkelb"][value="Perempuan"]').removeAttr('checked');
					$('input[name="jkelb"][value="Lainnya"]').attr('checked', 'checked');
					
					$('#_jkelb0').addClass('active');
					$('#_jkelb1').removeClass('active');
					$('#_jkelb2').removeClass('active');
				}
				
				$('[name="id_golongan_darahb"]').val(penerima.id_golongan_darah).trigger("chosen:updated");
				
				if(penerima.kondisi_fisik == 'Tidak')
				{
					$('#_kondisi_fisikb1').removeClass('btn-default');
					$('#_kondisi_fisikb1').addClass('btn-primary');
					$('#_kondisi_fisikb0').removeClass('btn-primary');
					$('#_kondisi_fisikb0').addClass('btn-default');
					
					$('input[name="kondisi_fisikb"][value="Tidak"]').attr('checked', 'checked');
					$('input[name="kondisi_fisikb"][value="Ya"]').removeAttr('checked');
					$('#id_difabelb').chosen().chosenReadonly(true);
					$('[name="id_difabelb"]').val(penerima.id_difabel).trigger("chosen:updated");
					
					$('#_kondisi_fisikb1').addClass('active');
					$('#_kondisi_fisikb0').removeClass('active');
				}
				else
				{
					
					$('#_kondisi_fisikb0').removeClass('btn-default');
					$('#_kondisi_fisikb0').addClass('btn-primary');
					$('#_kondisi_fisikb1').removeClass('btn-primary');
					$('#_kondisi_fisikb1').addClass('btn-default');
					
					$('input[name="kondisi_fisikb"][value="Ya"]').attr('checked', 'checked');
					$('input[name="kondisi_fisikb"][value="Tidak"]').removeAttr('checked');
					$('#id_difabelb').chosen().chosenReadonly(false);
					$('[name="id_difabelb"]').val(penerima.id_difabel).trigger("chosen:updated");
					
					$('#_kondisi_fisikb0').addClass('active');
					$('#_kondisi_fisikb1').removeClass('active');
				}
				
				$('[name="status_perkawinanb"]').val(penerima.status_perkawinan).trigger("chosen:updated");
				$('[name="id_pendidikanb"]').val(penerima.id_pendidikan).trigger("chosen:updated");
				
				$('[name="id_agamab"]').val(penerima.id_agama).trigger("chosen:updated");
				if(penerima.id_agama == '9')
				{
					$('[name="agama_descb"]').val(penerima.agama_desc);
					$('[name="agama_descb"]').prop({disabled:false});
				}
				else
				{
					$('[name="agama_descb"]').val(penerima.agama_desc);
					$('[name="agama_descb"]').prop({disabled:true});
				}	
				
				$('[name="kewarganegaraanb"]').val(penerima.kewarganegaraan).trigger("chosen:updated");
				if(penerima.kewarganegaraan == 'WNA')
				{
					$('#id_negarab').chosen().chosenReadonly(false);
					$('[name="id_negarab"]').val(penerima.id_negara).trigger("chosen:updated");
				}
				else 
				{
					$('#id_negarab').chosen().chosenReadonly(true);
					$('[name="id_negarab"]').val(penerima.id_negara).trigger("chosen:updated");
				}
				
				$('[name="id_pekerjaanb"]').val(penerima.id_pekerjaan).trigger("chosen:updated");
				if(penerima.id_pekerjaan == '45')
				{
					$('[name="pekerjaan_descb"]').val(penerima.pekerjaan_desc);
					$('[name="pekerjaan_descb"]').prop({disabled: false});
				}
				else
				{
					$('[name="pekerjaan_descb"]').val(penerima.pekerjaan_desc);
					$('[name="pekerjaan_descb"]').prop({disabled: true});
				}
				
				if(penerima.pekerjaan2 == 'Tidak')
				{
					$('#_pekerjaan2b1').removeClass('btn-default');
					$('#_pekerjaan2b1').addClass('btn-primary');
					$('#_pekerjaan2b0').removeClass('btn-primary');
					$('#_pekerjaan2b0').addClass('btn-default');
					$('#_pekerjaan2b1').addClass('active');
					$('#_pekerjaan2b0').removeClass('active');
					
					$('input[name="pekerjaan2b"][value="Tidak"]').attr('checked', 'checked');
					$('input[name="pekerjaan2b"][value="Ya"]').removeAttr('checked');
					$('[name="pekerjaan2_descb"]').val(penerima.pekerjaan2_desc);	
					$('[name="pekerjaan2_descb"]').prop({disabled: true});
				}
				else
				{
					$('#_pekerjaan2b0').removeClass('btn-default');
					$('#_pekerjaan2b0').addClass('btn-primary');
					$('#_pekerjaan2b1').removeClass('btn-primary');
					$('#_pekerjaan2b1').addClass('btn-default');
					$('#_pekerjaan2b0').addClass('active');
					$('#_pekerjaan2b1').removeClass('active');
					
					$('input[name="pekerjaan2b"][value="Tidak"]').removeAttr('checked');
					$('input[name="pekerjaan2b"][value="Ya"]').attr('checked', 'checked');
					$('[name="pekerjaan2_descb"]').val(penerima.pekerjaan2_desc);	
					$('[name="pekerjaan2_descb"]').prop({disabled: false});	
				}	
				
				if(penerima.pekerjaansi == 'Tidak')
				{
					$('#_pekerjaansib1').removeClass('btn-default');
					$('#_pekerjaansib1').addClass('btn-primary');
					$('#_pekerjaansib0').removeClass('btn-primary');
					$('#_pekerjaansib0').addClass('btn-default');
					$('#_pekerjaansib1').addClass('active');
					$('#_pekerjaansib0').removeClass('active');
					
					$('input[name="pekerjaansib"][value="Tidak"]').attr('checked', 'checked');
					$('input[name="pekerjaansib"][value="Ya"]').removeAttr('checked');
					$('#id_pekerjaansib').chosen().chosenReadonly(true);
					$('[name="id_pekerjaansib"]').val(penerima.id_pekerjaansi).trigger("chosen:updated");
				}
				else
				{
					$('#_pekerjaansib0').removeClass('btn-default');
					$('#_pekerjaansib0').addClass('btn-primary');
					$('#_pekerjaansib1').removeClass('btn-primary');
					$('#_pekerjaansib1').addClass('btn-default');
					$('#_pekerjaansib0').addClass('active');
					$('#_pekerjaansib1').removeClass('active');
					
					$('input[name="pekerjaansib"][value="Tidak"]').removeAttr('checked');
					$('input[name="pekerjaansib"][value="Ya"]').attr('checked', 'checked');
					$('#id_pekerjaansib').chosen().chosenReadonly(false);
					$('[name="id_pekerjaansib"]').val(penerima.id_pekerjaansi).trigger("chosen:updated");
				}
				
				if(penerima.id_pekerjaansi == '45')
				{
					$('[name="pekerjaansi_descb"]').val(penerima.pekerjaansi_desc);
					$('[name="pekerjaansi_descb"]').prop({disabled: false});
				}
				else
				{
					$('[name="pekerjaansi_descb"]').val(penerima.pekerjaansi_desc);
					$('[name="pekerjaansi_descb"]').prop({disabled: true});
				}	
				
				$('[name="id_penghasilanb"]').val(penerima.id_penghasilan).trigger("chosen:updated");
				$('[name="jml_anakb"]').val(penerima.jml_anak);
				$('[name="tanggungan_totalb"]').val(penerima.tanggungan_total);
				$('[name="harta_rumahb"]').val(penerima.harta_rumah);
				$('[name="harta_tanahb"]').val(penerima.harta_tanah);
				$('[name="harta_bangunanb"]').val(penerima.harta_bangunan);
				$('[name="harta_mobilb"]').val(penerima.harta_mobil);
				$('[name="harta_motorb"]').val(penerima.harta_motor);
				$('[name="harta_tokob"]').val(penerima.harta_toko);
				$('[name="harta_tabunganb"]').val(penerima.harta_tabungan);
				$('[name="harta_handphoneb"]').val(penerima.harta_handphone);
				$('[name="harta_lainb"]').val(penerima.harta_lain);
				$('[name="status_tempat_tinggalb"]').val(penerima.status_tempat_tinggal).trigger("chosen:updated");
				
				$('[name="alm_jalanb"]').val(penerima.alm_jalan);
				$('[name="alm_rtb"]').val(penerima.alm_rt);
				$('[name="alm_rwb"]').val(penerima.alm_rw);
				$('[name="kodeposb"]').val(penerima.kodepos);
				$('[name="id_provinsib"]').val(penerima.id_provinsi).trigger("chosen:updated");
				
				
				var _id_kabkotab = $('select[name="id_kabkotab"]');
				$('#id_kabkotab').empty();
				_id_kabkotab.append('<option value=""></option>');
				$.each(kabkotab, function(id_kabkotab, nm_kabkotab) {
					var opt = $('<option />'); 
					opt.val(id_kabkotab);
					opt.text(nm_kabkotab);
					_id_kabkotab.append(opt); 
				});
				_id_kabkotab.prop({disabled: false});
				_id_kabkotab.trigger('chosen:updated');
				
				$('[name="id_kabkotab"]').val(penerima.id_kabkota).trigger("chosen:updated");
				//$('[name="id_kecamatanb"]').val(penerima.id_kecamatan).trigger("chosen:updated");
				$('[name="id_kecamatanb"]').val(penerima.kecamatan);
				//$('[name="id_desab"]').val(penerima.id_desa).trigger("chosen:updated");
				$('[name="id_desab"]').val(penerima.desa);
				$('[name="no_telpb"]').val(penerima.no_telp);
				$('[name="no_hpb"]').val(penerima.no_hp);
				$('[name="nm_hpb"]').val(penerima.nm_hp);
				$('[name="emailb"]').val(penerima.email);
				/*
				$('[name="facebookb"]').val(penerima.facebook);
				$('[name="twitter"]').val(penerima.twitter);
				$('[name="sosial_media"]').val(penerima.sosial_media);
				*/
				
				$('[name="jenis_kidb"]').val(penerima.jenis_kid).trigger("chosen:updated");
				if(penerima.jenis_kid == 'Tidak Ada')
				{
					$('[name="nomor_kidb"]').val(penerima.nomor_kid);
					$('[name="nomor_kidb"]').prop({disabled: true});
				}
				else
				{
					$('[name="nomor_kidb"]').val(penerima.nomor_kid);
					$('[name="nomor_kidb"]').prop({disabled: false});
				}
				
				$('[name="jenis_ktmb"]').val(penerima.jenis_ktm).trigger("chosen:updated");
				if(penerima.jenis_ktm == 'Tidak Ada')
				{
					$('[name="nomor_ktmb"]').val(penerima.nomor_ktm);
					$('[name="nomor_ktmb"]').prop({disabled: true});
				}
				else
				{
					$('[name="nomor_ktmb"]').val(penerima.nomor_ktm);
					$('[name="nomor_ktmb"]').prop({disabled: false});
				}
				
				$('[name="hubungan_penerima"]').val(penerima.hubungan_penerima);	
			}
			
			file_kid = new Array();
			var filekid = response[5];
			
			if(!$.isArray(filekid) || !filekid.length)
			{
				$('#list_kid').empty();				
			}
			else
			{		
				$('#list_kid').empty();				
				$.each(filekid, function(i, item){
					$('#list_kid').append(filekid[i].link);
					
					if(filekid[i].status)
					{
						file_kid.push(filekid[i].id_file);
					}	
				});
			}
					
			file_ktm = new Array();
			var filektm = response[6];
			if(!$.isArray(filektm) || !filektm.length)
			{
				$('#list_ktm').empty();
			}
			else
			{	
				$('#list_ktm').empty();				
				
				$.each(filektm, function(i, item){
					$('#list_ktm').append(filektm[i].link);
					
					if(filektm[i].status)
					{
						file_ktm.push(filektm[i].id_file);
					}	
				});
			}
				
			$('[name="id_jarak_tempuh"]').val(pemohon.id_jarak_tempuh).trigger("chosen:updated");
			$('[name="id_waktu_tempuh"]').val(pemohon.id_waktu_tempuh).trigger("chosen:updated");
			
			if(pemohon.pernah_jadi_client == 'Belum')
			{
				$('#_pernah_jadi_client1').removeClass('btn-default');
				$('#_pernah_jadi_client1').addClass('btn-primary');
				$('#_pernah_jadi_client0').removeClass('btn-primary');
				$('#_pernah_jadi_client0').addClass('btn-default');
				$('#_pernah_jadi_client1').addClass('active');
				$('#_pernah_jadi_client0').removeClass('active');
				
				$('input[name="pernah_jadi_client"][value="Belum"]').attr('checked', 'checked');
				$('input[name="pernah_jadi_client"][value="Pernah"]').removeAttr('checked');
				$('#id_sumber_info').chosen().chosenReadonly(false);
				$('[name="id_sumber_info"]').val(pemohon.id_sumber_info).trigger("chosen:updated");
			}
			else
			{
				$('#_pernah_jadi_client0').removeClass('btn-default');
				$('#_pernah_jadi_client0').addClass('btn-primary');
				$('#_pernah_jadi_client1').removeClass('btn-primary');
				$('#_pernah_jadi_client1').addClass('btn-default');
				$('#_pernah_jadi_client0').addClass('active');
				$('#_pernah_jadi_client1').removeClass('active');
				
				$('input[name="pernah_jadi_client"][value="Belum"]').removeAttr('checked');
				$('input[name="pernah_jadi_client"][value="Pernah"]').attr('checked', 'checked');
				$('#id_sumber_info').chosen().chosenReadonly(true);
				$('[name="id_sumber_info"]').val(pemohon.id_sumber_info).trigger("chosen:updated");
			}
			
			if(pemohon.id_sumber_info == '9')
			{
				$('[name="sumber_info_desc"]').val(pemohon.sumber_info_desc);
				$('[name="sumber_info_desc"]').prop({disabled: false});
			}
			else
			{
				$('[name="sumber_info_desc"]').val(pemohon.sumber_info_desc);
				$('[name="sumber_info_desc"]').prop({disabled: true});
			}

			if(pemohon.rekomendasi_lbh == 'Tidak')
			{
				$('#_rekomendasi_lbh1').removeClass('btn-default');
				$('#_rekomendasi_lbh1').addClass('btn-primary');
				$('#_rekomendasi_lbh0').removeClass('btn-primary');
				$('#_rekomendasi_lbh0').addClass('btn-default');
				$('#_rekomendasi_lbh1').addClass('active');
				$('#_rekomendasi_lbh0').removeClass('active');
				
				$('input[name="rekomendasi_lbh"][value="Tidak"]').attr('checked', 'checked');
				$('input[name="rekomendasi_lbh"][value="Ya"]').removeAttr('checked');
				
				$('[name="nm_rekomendasi"]').val(pemohon.nm_rekomendasi);
				$('[name="alm_rekomendasi"]').val(pemohon.alm_rekomendasi);
				$('[name="pekerjaan_rekomendasi"]').val(pemohon.pekerjaan_rekomendasi);
				$('[name="nm_rekomendasi"]').prop({disabled: true});
				$('[name="alm_rekomendasi"]').prop({disabled: true});
				$('[name="pekerjaan_rekomendasi"]').prop({disabled: true});
			}
			else
			{
				$('#_rekomendasi_lbh0').removeClass('btn-default');
				$('#_rekomendasi_lbh0').addClass('btn-primary');
				$('#_rekomendasi_lbh1').removeClass('btn-primary');
				$('#_rekomendasi_lbh1').addClass('btn-default');
				$('#_rekomendasi_lbh0').addClass('active');
				$('#_rekomendasi_lbh1').removeClass('active');
				
				$('input[name="rekomendasi_lbh"][value="Ya"]').attr('checked', 'checked');
				$('input[name="rekomendasi_lbh"][value="Tidak"]').removeAttr('checked');
			
				$('[name="nm_rekomendasi"]').val(pemohon.nm_rekomendasi);
				$('[name="alm_rekomendasi"]').val(pemohon.alm_rekomendasi);
				$('[name="pekerjaan_rekomendasi"]').val(pemohon.pekerjaan_rekomendasi);
				$('[name="nm_rekomendasi"]').prop({disabled: false});
				$('[name="alm_rekomendasi"]').prop({disabled: false});
				$('[name="pekerjaan_rekomendasi"]').prop({disabled: false});
			}	
			
			$('#form-wizard').modal({backdrop: 'static', keyboard: false})  
			$('#form-wizard').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Permohonan Bantuan Hukum'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Identitas Pemohon Bantuan Hukum'); // Set title to Bootstrap modal title
			$('#step-1').removeClass('hide');
			$('#btn-next1').removeClass('hide');
			$('#step-2').addClass('hide');
			$('#btn-next2').addClass('hide');
			$('#btn-prev2').addClass('hide');
			$('#step-3').addClass('hide');
			$('#btn-next3').addClass('hide');
			$('#btn-prev3').addClass('hide');
			/* Penerima */
			$('#step-1b').addClass('hide');
			$('#btn-next1b').addClass('hide');
			$('#btn-prev1b').addClass('hide');
			$('#step-2b').addClass('hide');
			$('#btn-next2b').addClass('hide');
			$('#btn-prev2b').addClass('hide');
			$('#step-3b').addClass('hide');
			$('#btn-next3b').addClass('hide');
			$('#btn-prev3b').addClass('hide');
			/* End Penerima */
			$('#step-4').addClass('hide');
			$('#btn-next4').addClass('hide');
			$('#btn-prev4').addClass('hide');
			$('#step-5').addClass('hide');
			$('#btn-next5').addClass('hide');
			$('#btn-prev5').addClass('hide');
			$('#step-6').addClass('hide');
			$('#btn-next6').addClass('hide');
			$('#btn-prev6').addClass('hide');
			
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error get data from ajax');
			window.location = "";
        }
    });	
		
}

function edit_kronologi(id_permohonan)
{
	$('#formWizard')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
			
	$.ajax({
        url : "permohonan/get_kronologi" + id_permohonan,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var detail_kronologi = response[0];
			
			$('[name="id_permohonan_kronologi"]').val(detail_kronologi.id_permohonan);
			
			if(detail_kronologi.kronologi_kasus == '' || detail_kronologi.kronologi_kasus == null)
			{
				$('[name="kronologi_kasus"]').val(detail_kronologi.uraian_singkat);
				$('#kronologi_kasus_box').parent().find('.wysihtml5-sandbox').contents().find('body').html(detail_kronologi.uraian_singkat);	
			}
			else
			{
				$('[name="kronologi_kasus"]').val(detail_kronologi.kronologi_kasus);
				$('#kronologi_kasus_box').parent().find('.wysihtml5-sandbox').contents().find('body').html(detail_kronologi.kronologi_kasus);
			}
			
			$('#form-kronologi').modal({backdrop: 'static', keyboard: false})  
			$('#form-kronologi').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Permohonan Bantuan Hukum'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Edit Kronologi Kasus'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });		
}

function update_kronologi()
{
	var formData = {
		id_permohonan: $('[name="id_permohonan_kronologi"]').val(),
		kronologi_kasus: $('[name="kronologi_kasus"]').val()
	};		
	
	$.ajax({
		url : "permohonan/ajax_update_kronologi",
		type: "POST",
		data: formData, //$('#formPemohon').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				//$('#step-6').addClass('hide');
				//$('#btn-next6').addClass('hide');
				//$('#btn-prev6').addClass('hide');
				$('#form-kronologi').modal('hide');
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
	
function view(id_permohonan)
{
	$('#dd_no_reg').empty();
	$('#dd_tgl_reg').empty();
	$('#dd_nm_pemohon').empty();
	$('#dd_nm_panggilan').empty();
	$('#dd_tmp_lahir').empty();
	$('#dd_jkel').empty();
	$('#dd_golongan_darah').empty();
	$('#dd_kondisi_fisik').empty();	
	$('#dd_status_perkawinan').empty();	
	$('#dd_nm_pendidikan').empty();	
	$('#dd_nm_agama').empty();	
	$('#dd_kewarganegaraan').empty();	
	$('#dd_jenis_pekerjaan').empty();	
	$('#dd_pekerjaan2').empty();	
	$('#dd_pekerjaansi').empty();	
	$('#dd_penghasilan').empty();
	$('#dd_jml_anak').empty();	
	$('#dd_tanggungan_total').empty();	
	$('#dd_harta_rumah').empty();	
	$('#dd_harta_tanah').empty();	
	$('#dd_harta_bangunan').empty();	
	$('#dd_harta_mobil').empty();		
	$('#dd_harta_motor').empty();		
	$('#dd_harta_toko').empty();		
	$('#dd_harta_tabungan').empty();		
	$('#dd_harta_handphone').empty();		
	$('#dd_harta_lain').empty();	
	$('#dd_status_tempat_tinggal').empty();	
	$('#dd_alm_jalan').empty();	
	$('#dd_alm_rt').empty();	
	$('#dd_alm_rw').empty();	
	$('#dd_kodepos').empty();	
	$('#dd_nm_provinsi').empty();	
	$('#dd_nm_kabkota').empty();	
	$('#dd_nm_kecamatan').empty();	
	$('#dd_nm_desa').empty();	
	$('#dd_no_telp').empty();	
	$('#dd_no_hp').empty();	
	$('#dd_nm_hp').empty();	
	$('#dd_email').empty();	
	$('#dd_facebook').empty();	
	$('#dd_twitter').empty();	
	$('#dd_sosial_media').empty();	
	$('#dd_jenis_kid').empty();	
	$('#dd_nomor_kid').empty();
	$('#dd_jenis_ktm').empty();	
	$('#dd_nomor_ktm').empty();
	$('#dd_status_pemohon').empty();	
	/* Penerima */
	$('#dd_nm_penerima').empty();
	$('#dd_nm_panggilanb').empty();
	$('#dd_tmp_lahirb').empty();
	$('#dd_jkelb').empty();
	$('#dd_golongan_darahb').empty();
	$('#dd_kondisi_fisikb').empty();	
	$('#dd_status_perkawinanb').empty();	
	$('#dd_nm_pendidikanb').empty();	
	$('#dd_nm_agamab').empty();	
	$('#dd_kewarganegaraanb').empty();	
	$('#dd_jenis_pekerjaanb').empty();	
	$('#dd_pekerjaan2b').empty();	
	$('#dd_pekerjaansib').empty();	
	$('#dd_penghasilanb').empty();	
	$('#dd_jml_anakb').empty();
	$('#dd_tanggungan_totalb').empty();	
	$('#dd_harta_rumahb').empty();	
	$('#dd_harta_tanahb').empty();	
	$('#dd_harta_bangunanb').empty();	
	$('#dd_harta_mobilb').empty();		
	$('#dd_harta_motorb').empty();		
	$('#dd_harta_tokob').empty();		
	$('#dd_harta_tabunganb').empty();		
	$('#dd_harta_handphoneb').empty();		
	$('#dd_harta_lainb').empty();	
	$('#dd_status_tempat_tinggalb').empty();	
	$('#dd_alm_jalanb').empty();	
	$('#dd_alm_rtb').empty();	
	$('#dd_alm_rwb').empty();	
	$('#dd_kodeposb').empty();	
	$('#dd_nm_provinsib').empty();	
	$('#dd_nm_kabkotab').empty();	
	$('#dd_nm_kecamatanb').empty();	
	$('#dd_nm_desab').empty();	
	$('#dd_no_telpb').empty();	
	$('#dd_no_hpb').empty();	
	$('#dd_nm_hpb').empty();	
	$('#dd_emailb').empty();	
	$('#dd_facebookb').empty();	
	$('#dd_twitterb').empty();	
	$('#dd_sosial_mediab').empty();	
	$('#dd_jenis_kidb').empty();	
	$('#dd_nomor_kidb').empty();
	$('#dd_jenis_ktmb').empty();	
	$('#dd_nomor_ktmb').empty();
	$('#dd_hubungan_penerima').empty();	
	/* End Penerima */
	$('ul#list_kid').empty();	
	$('ul#list_ktm').empty();
	$('#dd_jarak_tempuh').empty();	
	$('#dd_waktu_tempuh').empty();	
	$('#dd_pernah_jadi_client').empty();	
	$('#dd_sumber_info').empty();	
	$('#dd_rekomendasi_lbh').empty();	
	$('#dd_nm_rekomendasi').empty();	
	$('#dd_alm_rekomendasi').empty();	
	$('#dd_pekerjaan_rekomendasi').empty();	
	$('#dd_uraian_singkat').empty();	
	$('#dd_kronologi_kasus').empty();	
	$('#dd_penanganan_pihak_lain').empty();	
	$('#dd_tahap_penanganan_pihak_lain').empty();	
	$('#dd_desc_tahap_penanganan_pihak_lain').empty();	
				
	$.ajax({
        url : "permohonan/view_detail_permohonan" + id_permohonan,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var permohonan = response[0];
			
			$('#dd_no_reg').append(permohonan.no_reg);
			$('#dd_tgl_reg').append(permohonan.tgl_reg);
			$('#dd_nm_pemohon').append(permohonan.nm_pemohon);
			$('#dd_nm_panggilan').append(permohonan.nm_panggilan);
			$('#dd_tmp_lahir').append(permohonan.tmp_lahir, ', ', permohonan.tgl_lahir, ' ', permohonan.bln_lahir, ' ', permohonan.thn_lahir, ' (', permohonan.umur, ' Tahun)');
			$('#dd_jkel').append(permohonan.jkel);
			$('#dd_golongan_darah').append(permohonan.golongan_darah);
			
			if(permohonan.kondisi_fisik == 'Tidak')
			{
				$('#dd_kondisi_fisik').append('Tidak Ada');	
			}
			else
			{
				$('#dd_kondisi_fisik').append(permohonan.jenis_difabel);
			}
			
			$('#dd_status_perkawinan').append(permohonan.status_perkawinan);
			if(permohonan.id_pendidikan == '9')
			{
				$('#dd_nm_pendidikan').append(permohonan.pendidikan_desc);	
			}
			else
			{
				$('#dd_nm_pendidikan').append(permohonan.nm_pendidikan);	
			}
			
			if(permohonan.id_agama == '9')
			{
				$('#dd_nm_agama').append(permohonan.agama_desc);	
			}
			else
			{
				$('#dd_nm_agama').append(permohonan.nm_agama);	
			}
			
			$('#dd_kewarganegaraan').append(permohonan.kewarganegaraan,' (',permohonan.nm_negara, ')');
			
			if(permohonan.id_pekerjaan == '45')
			{
				$('#dd_jenis_pekerjaan').append(permohonan.pekerjaan_desc);	
			}
			else
			{
				$('#dd_jenis_pekerjaan').append(permohonan.jenis_pekerjaan);
			}
			
			if(permohonan.pekerjaan2 == 'Ya')
			{
				$('#dd_pekerjaan2').append(permohonan.pekerjaan2_desc);	
			}
			else
			{
				$('#dd_pekerjaan2').append('Tidak Ada');
			}
			
			if(permohonan.pekerjaansi == 'Ya')
			{
				if(permohonan.id_pekerjaansi == '45')
				{
					$('#dd_pekerjaansi').append(permohonan.pekerjaansi_desc);
				}	
				else
				{
					$('#dd_pekerjaansi').append(permohonan.jenis_pekerjaansi);
				}		
			}
			else
			{
				$('#dd_pekerjaansi').append('Tidak Ada');
			}
			
			$('#dd_penghasilan').append(permohonan.jml_penghasilan);
			$('#dd_jml_anak').append(permohonan.jml_anak, ' Orang');
			$('#dd_tanggungan_total').append(permohonan.tanggungan_total, ' Orang');
			
			if(permohonan.harta_rumah == '0' || permohonan.harta_rumah < '0')
			{
				$('#dd_harta_rumah').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_rumah').append(permohonan.harta_rumah, ' Unit');	
			}		
			
			if(permohonan.harta_tanah == '0' || permohonan.harta_tanah < '0')
			{
				$('#dd_harta_tanah').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_tanah').append(permohonan.harta_tanah, ' m<sup>2</sup>');	
			}
			
			if(permohonan.harta_bangunan == '0' || permohonan.harta_bangunan < '0')
			{
				$('#dd_harta_bangunan').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_bangunan').append(permohonan.harta_bangunan, ' Buah');	
			}
			
			if(permohonan.harta_mobil == '0' || permohonan.harta_mobil < '0')
			{
				$('#dd_harta_mobil').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_mobil').append(permohonan.harta_mobil, ' Unit');	
			}
			
			if(permohonan.harta_motor == '0' || permohonan.harta_motor < '0')
			{
				$('#dd_harta_motor').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_motor').append(permohonan.harta_motor, ' Unit');	
			}
			
			if(permohonan.harta_toko == '0' || permohonan.harta_toko < '0')
			{
				$('#dd_harta_toko').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_toko').append(permohonan.harta_toko, ' Buah');	
			}
			
			if(permohonan.harta_tabungan == '0' || permohonan.harta_tabungan < '0')
			{
				$('#dd_harta_tabungan').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_tabungan').append('Rp ', permohonan.harta_tabungan);	
			}
			
			if(permohonan.harta_handphone == '0' || permohonan.harta_handphone < '0')
			{
				$('#dd_harta_handphone').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_handphone').append(permohonan.harta_handphone, ' Unit');	
			}
			
			if(permohonan.harta_lain == '0' || permohonan.harta_lain < '0')
			{
				$('#dd_harta_lain').append('Tidak Ada');	
			}
			else
			{
				$('#dd_harta_lain').append(permohonan.harta_lain);	
			}
			
			$('#dd_status_tempat_tinggal').append(permohonan.status_tempat_tinggal);
			
			$('#dd_alm_jalan').append(permohonan.alm_jalan);
			$('#dd_alm_rt').append(permohonan.alm_rt);
			$('#dd_alm_rw').append(permohonan.alm_rw);
			$('#dd_kodepos').append(permohonan.kodepos);
			$('#dd_nm_provinsi').append(permohonan.nm_provinsi);
			$('#dd_nm_kabkota').append(permohonan.nm_kabkota);
			$('#dd_nm_kecamatan').append(permohonan.kecamatan);
			$('#dd_nm_desa').append(permohonan.desa);
			$('#dd_no_telp').append(permohonan.no_telp);
			$('#dd_no_hp').append(permohonan.no_hp);
			$('#dd_nm_hp').append(permohonan.nm_hp);
			$('#dd_email').append(permohonan.email);
			/*
			$('#dd_facebook').append(permohonan.facebook);
			$('#dd_twitter').append(permohonan.twitter);
			$('#dd_sosial_media').append(permohonan.sosial_media);
			*/
			$('#dd_jenis_kid').append(permohonan.jenis_kid);
			$('#dd_nomor_kid').append(permohonan.nomor_kid);
			$('#dd_jenis_ktm').append(permohonan.jenis_ktm);
			$('#dd_nomor_ktm').append(permohonan.nomor_ktm);
			$('#dd_status_pemohon').append(permohonan.status_pemohon);
			
			vstatus_pemohon = permohonan.status_pemohon;
			
			if(vstatus_pemohon == 'Tidak')
			{
				$('#dd_nm_penerima').append(permohonan.nm_penerima);
				$('#dd_nm_panggilanb').append(permohonan.nm_panggilanb);
				$('#dd_tmp_lahirb').append(permohonan.tmp_lahirb, ', ', permohonan.tgl_lahirb, ' ', permohonan.bln_lahirb, ' ', permohonan.thn_lahirb, ' (', permohonan.umurb, ' Tahun)');
				$('#dd_jkelb').append(permohonan.jkelb);
				$('#dd_golongan_darahb').append(permohonan.golongan_darahb);
				
				if(permohonan.kondisi_fisikb == 'Tidak')
				{
					$('#dd_kondisi_fisikb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_kondisi_fisikb').append(permohonan.jenis_difabelb);
				}
				
				$('#dd_status_perkawinanb').append(permohonan.status_perkawinanb);
				$('#dd_nm_pendidikanb').append(permohonan.nm_pendidikanb);
				
				if(permohonan.id_agamab == '9')
				{
					$('#dd_nm_agamab').append(permohonan.agama_descb);	
				}
				else
				{
					$('#dd_nm_agamab').append(permohonan.nm_agamab);	
				}
				
				$('#dd_kewarganegaraanb').append(permohonan.kewarganegaraanb,' (',permohonan.nm_negarab, ')');
				
				if(permohonan.id_pekerjaanb == '45')
				{
					$('#dd_jenis_pekerjaanb').append(permohonan.pekerjaan_descb);	
				}
				else
				{
					$('#dd_jenis_pekerjaanb').append(permohonan.jenis_pekerjaanb);
				}
				
				if(permohonan.pekerjaan2b == 'Ya')
				{
					$('#dd_pekerjaan2b').append(permohonan.pekerjaan2_descb);	
				}
				else
				{
					$('#dd_pekerjaan2b').append('Tidak Ada');
				}
				
				if(permohonan.pekerjaansib == 'Ya')
				{
					if(permohonan.id_pekerjaansib == '45')
					{
						$('#dd_pekerjaansib').append(permohonan.pekerjaansi_descb);
					}	
					else
					{
						$('#dd_pekerjaansib').append(permohonan.jenis_pekerjaansib);
					}		
				}
				else
				{
					$('#dd_pekerjaansib').append('Tidak Ada');
				}
				
				$('#dd_penghasilanb').append(permohonan.jml_penghasilanb);
				$('#dd_jml_anakb').append(permohonan.jml_anakb, ' Orang');
				$('#dd_tanggungan_totalb').append(permohonan.tanggungan_totalb, ' Orang');
				
				if(permohonan.harta_rumahb == '0' || permohonan.harta_rumahb < '0')
				{
					$('#dd_harta_rumahb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_rumahb').append(permohonan.harta_rumahb, ' Unit');	
				}		
				
				if(permohonan.harta_tanahb == '0' || permohonan.harta_tanahb < '0')
				{
					$('#dd_harta_tanahb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_tanahb').append(permohonan.harta_tanahb, ' m<sup>2</sup>');	
				}
				
				if(permohonan.harta_bangunanb == '0' || permohonan.harta_bangunanb < '0')
				{
					$('#dd_harta_bangunanb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_bangunanb').append(permohonan.harta_bangunanb, ' Buah');	
				}
				
				if(permohonan.harta_mobilb == '0' || permohonan.harta_mobilb < '0')
				{
					$('#dd_harta_mobilb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_mobilb').append(permohonan.harta_mobilb, ' Unit');	
				}
				
				if(permohonan.harta_motorb == '0' || permohonan.harta_motorb < '0')
				{
					$('#dd_harta_motorb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_motorb').append(permohonan.harta_motorb, ' Unit');	
				}
				
				if(permohonan.harta_tokob == '0' || permohonan.harta_tokob < '0')
				{
					$('#dd_harta_tokob').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_tokob').append(permohonan.harta_tokob, ' Buah');	
				}
				
				if(permohonan.harta_tabunganb == '0' || permohonan.harta_tabunganb < '0')
				{
					$('#dd_harta_tabunganb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_tabunganb').append('Rp ', permohonan.harta_tabunganb);	
				}
				
				if(permohonan.harta_handphoneb == '0' || permohonan.harta_handphoneb < '0')
				{
					$('#dd_harta_handphoneb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_handphoneb').append(permohonan.harta_handphoneb, ' Unit');	
				}
				
				if(permohonan.harta_lainb == '0' || permohonan.harta_lainb < '0')
				{
					$('#dd_harta_lainb').append('Tidak Ada');	
				}
				else
				{
					$('#dd_harta_lainb').append(permohonan.harta_lainb);	
				}
				
				$('#dd_status_tempat_tinggalb').append(permohonan.status_tempat_tinggalb);
				
				$('#dd_alm_jalanb').append(permohonan.alm_jalanb);
				$('#dd_alm_rtb').append(permohonan.alm_rtb);
				$('#dd_alm_rwb').append(permohonan.alm_rwb);
				$('#dd_kodeposb').append(permohonan.kodeposb);
				$('#dd_nm_provinsib').append(permohonan.nm_provinsib);
				$('#dd_nm_kabkotab').append(permohonan.nm_kabkotab);
				$('#dd_nm_kecamatanb').append(permohonan.kecamatanb);
				$('#dd_nm_desab').append(permohonan.desab);
				$('#dd_no_telpb').append(permohonan.no_telpb);
				$('#dd_no_hpb').append(permohonan.no_hpb);
				$('#dd_nm_hpb').append(permohonan.nm_hpb);
				$('#dd_emailb').append(permohonan.emailb);
				/*
				$('#dd_facebookb').append(permohonan.facebookb);
				$('#dd_twitterb').append(permohonan.twitterb);
				$('#dd_sosial_mediab').append(permohonan.sosial_mediab);
				*/
				$('#dd_jenis_kidb').append(permohonan.jenis_kidb);
				$('#dd_nomor_kidb').append(permohonan.nomor_kidb);
				$('#dd_jenis_ktmb').append(permohonan.jenis_ktmb);
				$('#dd_nomor_ktmb').append(permohonan.nomor_ktmb);
				$('#dd_hubungan_penerima').append(permohonan.hubungan_penerima);
			}
			
			var filekid = response[1];
			
			if(!$.isArray(filekid) || !filekid.length)
			{
				$('ul#list_kid').empty();
				$('ul#list_kid').append('<li class="list-group-item">Tidak ada lampiran</li>');
			}
			else
			{		
				$('ul#list_kid').empty();
				$.each(filekid, function(i, item){
					$('ul#list_kid').append(filekid[i].link);
				});
			}
				
			var filektm = response[2];
			
			if(!$.isArray(filektm) || !filektm.length)
			{
				$('ul#list_ktm').empty();
				$('ul#list_ktm').append('<li class="list-group-item">Tidak ada lampiran</li>');
			}
			else
			{		
				$('ul#list_ktm').empty();
				$.each(filektm, function(i, item){
					$('ul#list_ktm').append(filektm[i].link);
				});
			}
			
			var filepermohonan = response[3];
			
			if(!$.isArray(filepermohonan) || !filepermohonan.length)
			{
				$('ul#list_permohonan').empty();
				$('ul#list_permohonan').append('<li class="list-group-item">Tidak ada lampiran</li>');
			}
			else
			{		
				$('ul#list_permohonan').empty();
				$.each(filepermohonan, function(i, item){
					$('ul#list_permohonan').append(filepermohonan[i].link);
				});
			}
			
			$('#dd_jarak_tempuh').append(permohonan.jarak_tempuh);
			$('#dd_waktu_tempuh').append(permohonan.waktu_tempuh);
						
			if(permohonan.pernah_jadi_client == 'Pernah')
			{
				$('#dd_pernah_jadi_client').append('Pernah');
				$('#dl_sumber_info').show();
				$('#dd_sumber_info').append('-');
			}
			else
			{
				$('#dd_pernah_jadi_client').append('Belum Pernah');
				$('#dl_sumber_info').show();
			}

			if(permohonan.id_sumber_info == '9')
			{
				$('#dd_sumber_info').append(permohonan.sumber_info_desc);
			}
			else
			{
				$('#dd_sumber_info').append(permohonan.nm_sumber_info);
			}
			
			if(permohonan.rekomendasi_lbh == 'Ya')
			{
				$('#dd_rekomendasi_lbh').append('Ada');	
				$('#dd_nm_rekomendasi').append(permohonan.nm_rekomendasi);
				$('#dd_alm_rekomendasi').append(permohonan.alm_rekomendasi);	
				$('#dd_pekerjaan_rekomendasi').append(permohonan.pekerjaan_rekomendasi);
				$('#dl_nm_rekomendasi').show();	
				$('#dl_alm_rekomendasi').show();	
				$('#dl_pekerjaan_rekomendasi').show();
			}
			else
			{
				$('#dd_rekomendasi_lbh').append('Tidak Ada');	
				$('#dd_nm_rekomendasi').append('-');
				$('#dd_alm_rekomendasi').append('-');	
				$('#dd_pekerjaan_rekomendasi').append('-');
				$('#dl_nm_rekomendasi').show();	
				$('#dl_alm_rekomendasi').show();	
				$('#dl_pekerjaan_rekomendasi').show();
			}		
			
			$('#dd_uraian_singkat').append(permohonan.uraian_singkat);
			$('#dd_kronologi_kasus').append(permohonan.kronologi_kasus);
			
						
			if(permohonan.penanganan_pihak_lain == 'Tidak')
			{
				$('#dd_penanganan_pihak_lain').append('Tidak Pernah');
				$('#dd_tahap_penanganan_pihak_lain_box').hide();
				$('#dd_desc_tahap_penanganan_pihak_lain_box').hide();
				$('#dd_tahap_penanganan_pihak_lain').append(permohonan.tahap_penanganan_pihak_lain);
				$('#dd_desc_tahap_penanganan_pihak_lain').append(permohonan.desc_tahap_penanganan_pihak_lain);
			}
			else
			{
				$('#dd_penanganan_pihak_lain').append('Pernah');
				$('#dd_tahap_penanganan_pihak_lain_box').show();
				$('#dd_desc_tahap_penanganan_pihak_lain_box').show();
				$('#dd_tahap_penanganan_pihak_lain').append(permohonan.tahap_penanganan_pihak_lain);
				$('#dd_desc_tahap_penanganan_pihak_lain').append(permohonan.desc_tahap_penanganan_pihak_lain);
			}
			
			$('#view-wizard').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Permohonan Bantuan Hukum'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Identitas Pemohon Bantuan Hukum'); // Set title to Bootstrap modal title
			$('#view-1').removeClass('hide');
			$('#btn-vnext1').removeClass('hide');
			$('#view-2').addClass('hide');
			$('#btn-vnext2').addClass('hide');
			$('#btn-vprev2').addClass('hide');
			$('#view-3').addClass('hide');
			$('#btn-vnext3').addClass('hide');
			$('#btn-vprev3').addClass('hide');
			
			$('#view-1b').addClass('hide');
			$('#btn-vnext1b').addClass('hide');
			$('#btn-vprev1b').addClass('hide');
			$('#view-2b').addClass('hide');
			$('#btn-vnext2b').addClass('hide');
			$('#btn-vprev2b').addClass('hide');
			$('#view-3b').addClass('hide');
			$('#btn-vnext3b').addClass('hide');
			$('#btn-vprev3b').addClass('hide');
			
			$('#view-4').addClass('hide');
			$('#btn-vnext4').addClass('hide');
			$('#btn-vprev4').addClass('hide');
			$('#view-5').addClass('hide');
			$('#btn-vnext5').addClass('hide');
			$('#btn-vprev5').addClass('hide');
			$('#view-6').addClass('hide');
			$('#btn-vnext6').addClass('hide');
			$('#btn-vprev6').addClass('hide');	
			
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = "";
        }
    });	
}

function vnext1()
{
	$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Pemohon Bantuan)'); // Set title to Bootstrap modal title
	$('#view-1').addClass('hide');
	$('#btn-vnext1').addClass('hide');
	$('#view-2').removeClass('hide');
	$('#btn-vnext2').removeClass('hide');
	$('#btn-vprev2').removeClass('hide');
}

function vprev2()
{
	$('.modal-subtitle').text('Identitas Pemohon Bantuan Hukum'); // Set title to Bootstrap modal title
	$('#view-1').removeClass('hide');
	$('#btn-vnext1').removeClass('hide');
	$('#view-2').addClass('hide');
	$('#btn-vnext2').addClass('hide');
	$('#btn-vprev2').addClass('hide');
}

function vnext2()
{
	$('.modal-subtitle').text('Alamat & Contact Person (Pemohon Bantuan)'); // Set title to Bootstrap modal title
	$('#view-2').addClass('hide');
	$('#btn-vnext2').addClass('hide');
	$('#btn-vprev2').addClass('hide');
	$('#view-3').removeClass('hide');
	$('#btn-vnext3').removeClass('hide');
	$('#btn-vprev3').removeClass('hide');
}

function vprev3()
{
	$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Pemohon Bantuan)'); // Set title to Bootstrap modal title
	$('#view-2').removeClass('hide');
	$('#btn-vnext2').removeClass('hide');
	$('#btn-vprev2').removeClass('hide');
	$('#view-3').addClass('hide');
	$('#btn-vnext3').addClass('hide');
	$('#btn-vprev3').addClass('hide');
}

function vnext3()
{
	if(vstatus_pemohon == 'Ya')
	{
		$('.modal-subtitle').text('Lampiran'); // Set title to Bootstrap modal title
		$('#view-3').addClass('hide');
		$('#btn-vnext3').addClass('hide');
		$('#btn-vprev3').addClass('hide');
		$('#view-4').removeClass('hide');
		$('#btn-vnext4').removeClass('hide');
		$('#btn-vprev4').removeClass('hide');	
	}
	else
	{
		$('.modal-subtitle').text('Identitas Penerima Bantuan Hukum');
		$('#view-3').addClass('hide');
		$('#btn-vnext3').addClass('hide');
		$('#btn-vprev3').addClass('hide');
		$('#view-1b').removeClass('hide');
		$('#btn-vnext1b').removeClass('hide');
		$('#btn-vprev1b').removeClass('hide');	
	}		
	
}

function vprev1b()
{
	$('.modal-subtitle').text('Alamat & Contact Person (Pemohon Bantuan)'); // Set title to Bootstrap modal title
	$('#view-1b').addClass('hide');
	$('#btn-vnext1b').addClass('hide');
	$('#btn-vprev1b').addClass('hide');
	$('#view-3').removeClass('hide');
	$('#btn-vnext3').removeClass('hide');
	$('#btn-vprev3').removeClass('hide');
}

function vnext1b()
{
	$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Penerima Bantuan)'); // Set title to Bootstrap modal title
	$('#view-1b').addClass('hide');
	$('#btn-vnext1b').addClass('hide');
	$('#btn-vprev1b').addClass('hide');
	$('#view-2b').removeClass('hide');
	$('#btn-vnext2b').removeClass('hide');
	$('#btn-vprev2b').removeClass('hide');
}

function vprev2b()
{
	$('.modal-subtitle').text('Identitas Penerima Bantuan Hukum'); // Set title to Bootstrap modal title
	$('#view-1b').removeClass('hide');
	$('#btn-vnext1b').removeClass('hide');
	$('#btn-vprev1b').removeClass('hide');
	$('#view-2b').addClass('hide');
	$('#btn-vnext2b').addClass('hide');
	$('#btn-vprev2b').addClass('hide');
}

function vnext2b()
{
	$('.modal-subtitle').text('Alamat & Contact Person (Penerima Bantuan)'); // Set title to Bootstrap modal title
	$('#view-2b').addClass('hide');
	$('#btn-vnext2b').addClass('hide');
	$('#btn-vprev2b').addClass('hide');
	$('#view-3b').removeClass('hide');
	$('#btn-vnext3b').removeClass('hide');
	$('#btn-vprev3b').removeClass('hide');
}

function vprev3b()
{
	$('.modal-subtitle').text('Pekerjaan, Penghasilan & Jenis Harta (Penerima Bantuan)'); // Set title to Bootstrap modal title
	$('#view-2b').removeClass('hide');
	$('#btn-vnext2b').removeClass('hide');
	$('#btn-vprev2b').removeClass('hide');
	$('#view-3b').addClass('hide');
	$('#btn-vnext3b').addClass('hide');
	$('#btn-vprev3b').addClass('hide');
}

function vnext3b()
{
	$('.modal-subtitle').text('Lampiran'); // Set title to Bootstrap modal title
	$('#view-3b').addClass('hide');
	$('#btn-vnext3b').addClass('hide');
	$('#btn-vprev3b').addClass('hide');
	$('#view-4').removeClass('hide');
	$('#btn-vnext4').removeClass('hide');
	$('#btn-vprev4').removeClass('hide');
}

function vprev4()
{
	if(vstatus_pemohon == 'Ya')
	{
		$('.modal-subtitle').text('Alamat & Contact Person (Pemohon Bantuan)'); // Set title to Bootstrap modal title
		$('#view-3').removeClass('hide');
		$('#btn-vnext3').removeClass('hide');
		$('#btn-vprev3').removeClass('hide');
		$('#view-4').addClass('hide');
		$('#btn-vnext4').addClass('hide');
		$('#btn-vprev4').addClass('hide');	
	}
	else	
	{
		$('.modal-subtitle').text('Alamat & Contact Person (Penerima Bantuan)'); // Set title to Bootstrap modal title
		$('#view-3b').removeClass('hide');
		$('#btn-vnext3b').removeClass('hide');
		$('#btn-vprev3b').removeClass('hide');
		$('#view-4').addClass('hide');
		$('#btn-vnext4').addClass('hide');
		$('#btn-vprev4').addClass('hide');	
	}
}

function vnext4()
{
	$('.modal-subtitle').text('Kuesioner'); // Set title to Bootstrap modal title
	$('#view-4').addClass('hide');
	$('#btn-vnext4').addClass('hide');
	$('#btn-vprev4').addClass('hide');
	$('#view-5').removeClass('hide');
	$('#btn-vnext5').removeClass('hide');
	$('#btn-vprev5').removeClass('hide');
}

function vprev5()
{
	$('.modal-subtitle').text('Kartu Identitas, SKTM & Lampiran'); // Set title to Bootstrap modal title
	$('#view-4').removeClass('hide');
	$('#btn-vnext4').removeClass('hide');
	$('#btn-vprev4').removeClass('hide');
	$('#view-5').addClass('hide');
	$('#btn-vnext5').addClass('hide');
	$('#btn-vprev5').addClass('hide');
}

function vnext5()
{
	$('.modal-subtitle').text('Kronologi Pokok Permasalahan'); // Set title to Bootstrap modal title
	$('#view-5').addClass('hide');
	$('#btn-vnext5').addClass('hide');
	$('#btn-vprev5').addClass('hide');
	$('#view-6').removeClass('hide');
	$('#btn-vnext6').removeClass('hide');
	$('#btn-vprev6').removeClass('hide');
}

function vprev6()
{
	$('.modal-subtitle').text('Kusioner'); // Set title to Bootstrap modal title
	$('#view-5').removeClass('hide');
	$('#btn-vnext5').removeClass('hide');
	$('#btn-vprev5').removeClass('hide');
	$('#view-6').addClass('hide');
	$('#btn-vnext6').addClass('hide');
	$('#btn-vprev6').addClass('hide');
}

function vnext6()
{
	$('#view-wizard').modal('hide');
	reload_table();	
}	

function view_file(id_file)
{
	//alert(id_file);	
	url = "permohonan/get_file_attachment"+id_file;
	window.open(url);
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
            url : "permohonan/ajax_delete",
            type: "POST",
			data: formData,
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#form-modal').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function up(id_permohonan)
{
    $('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$.ajax({
		url : "permohonan/get_file_permohonan/" + id_permohonan,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			$('[name="id_permohonanx"]').val(id_permohonan);
			
			file_kid = new Array();
			var filekid = response[0];
			
			if(!$.isArray(filekid) || !filekid.length)
			{
				$('#list_kidx').empty();				
			}
			else
			{		
				$('#list_kidx').empty();				
				$.each(filekid, function(i, item){
					$('#list_kidx').append(filekid[i].link);
					
					if(filekid[i].status)
					{
						file_kid.push(filekid[i].id_file);
					}	
				});
			}
					
			file_ktm = new Array();
			var filektm = response[1];
			if(!$.isArray(filektm) || !filektm.length)
			{
				$('#list_ktmx').empty();
			}
			else
			{	
				$('#list_ktmx').empty();				
				
				$.each(filektm, function(i, item){
					$('#list_ktmx').append(filektm[i].link);
					
					if(filektm[i].status)
					{
						file_ktm.push(filektm[i].id_file);
					}	
				});
			}
			
			file_permohonan = new Array();
			var files = response[2];
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
						file_permohonan.push(files[i].id_file);
					}	
				});
			}
			
			$('#form-upload_permohonan').modal({backdrop: 'static', keyboard: false})  
			$('#form-upload_permohonan').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Upload'); // Set title to Bootstrap modal title
			$('.modal-subtitle').text('Upload Dokumen Permohonan'); // Set title to Bootstrap modal title
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
		id_permohonan: $('[name="id_permohonanx"]').val(),
		file_kid: file_kid,
		file_ktm: file_ktm,
		file_permohonan: file_permohonan
	};
	
	url = "permohonan/ajax_save_file_permohonan";
	
	$.ajax({
		url : url,
		type: "POST",
		data: formData,//$('#formApproval').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				
				$('#form-upload_permohonan').modal('hide');
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


function pdf_formulir(id_permohonan)
{
	url = "permohonan/get_output_formulir_permohonan/"+id_permohonan;
	window.open(url);
}

function pdf_bukti(id_permohonan)
{
	url = "permohonan/get_output_bukti_permohonan/"+id_permohonan;
	window.open(url);
}

function reload_table()
{
    var Tbl_Permohonan = $('#Tbl_Permohonan').DataTable();
	Tbl_Permohonan.ajax.reload(null,false); //reload datatable ajax 
}

	
     
$(document).ready(function() {
	
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
		$(this).parent().parent().removeClass('has-error');
		//$(this).next().empty();
	});
	
	$('[name="extract_periode"]').change(function ()
	{
		if ($(this).val() == 'Semua')
		{
			$('[name="extract_tahun"]').val('');
			$('[name="extract_tahun"]').prop({disabled: true});
		}
		else
		{
			$('[name="extract_tahun"]').val('');
			$('[name="extract_tahun"]').prop({disabled: false});
		}
		
	});
	
	$('[name="freq_periode"]').change(function ()
	{
		if ($(this).val() == 'Semua')
		{
			$('[name="freq_tahun"]').val('');
			$('[name="freq_tahun"]').prop({disabled: true});
		}
		else
		{
			$('[name="freq_tahun"]').val('');
			$('[name="freq_tahun"]').prop({disabled: false});
		}
		
	});
	
	$('[name="cross_periode"]').change(function ()
	{
		if ($(this).val() == 'Semua')
		{
			$('[name="cross_tahun"]').val('');
			$('[name="cross_tahun"]').prop({disabled: true});
		}
		else
		{
			$('[name="cross_tahun"]').val('');
			$('[name="cross_tahun"]').prop({disabled: false});
		}
	});
	
	$('[name="cross_type2"]').prop({disabled:true});
	
	$('#cross_type1_chosen').click(function()
	{
		previous = $('[name="cross_type1"]').val();
		
		$('[name="cross_type1"]').change(function()
		{
			if ($(this).val() != '')
			{
				selected = $(this).val();
				
				$('[name="cross_type2"] option[value="'+previous+'"]').removeAttr('disabled');
				$('[name="cross_type2"] option[value="'+selected+'"]').attr('disabled', 'disabled');
				$('[name="cross_type2"]').prop({disabled:false});
				$('[name="cross_type2"]').val('').trigger("chosen:updated");
				
			}
			else
			{
				$('[name="cross_type2"] option[value="'+previous+'"]').removeAttr('disabled');
				$('[name="cross_type2"]').prop({disabled:true});
				$('[name="cross_type2"]').val('').trigger("chosen:updated");
			}
		});	
		
	});	
	
	$('[name="tahun"]').val(tahun);
	
	$('[name="report_type"]').val('preview');

});	

function view_form_extract()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="extract_periode"]').val('Semua').trigger("chosen:updated");
	$('[name="extract_tahun"]').val('');
	$('[name="extract_tahun"]').prop({disabled: true});
			
	$('#form-extract').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Extract All Data'); // Set title to Bootstrap modal title
	
}

function submit_extract()
{
	document.getElementById("form_extract").submit();
}

function view_form_freq()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="freq_type"]').val('1').trigger("chosen:updated");
	$('[name="freq_periode"]').val('Semua').trigger("chosen:updated");
	$('[name="freq_tahun"]').val('');
	$('[name="freq_tahun"]').prop({disabled: true});
	
	$('#freq_result_box').hide();
	$('#freq_result').empty();
				
	$('#form-freq').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Frequency'); // Set title to Bootstrap modal title
	
}

function submit_freq()
{
	/*document.getElementById("form_freq").submit();*/
	
	var formData = {
		freq_type: $('[name="freq_type"]').val(),
		freq_periode: $('[name="freq_periode"]').val(),
		freq_tahun: $('[name="freq_tahun"]').val()
	}
	
	$.ajax({
        url : "<?php echo site_url('report/ajax_get_data_by_frequency')?>",
        type: "POST",
		data: formData,
        dataType: "JSON",
        success: function(response)
		{
			var report = response[0];
			
			if(!$.isArray(report) || !report.length)
			{
				$('#freq_result').empty();
				$('#freq_result').append('<tr><td colspan="3" class="col-lg-12" style="text-align:center"><br/>no record found from this period.<br/><br/></td></tr>');
				$('#freq_total').empty();
			}
			else
			{
				$('#freq_result').empty();
				$.each(report, function(i, item){
					$('#freq_result').append(report[i].baris);
				});
				
				$('#freq_result_box').show();
			}
			
			var total = response[1];
			$('#freq_total').empty();
			$('#freq_result').append(total);
			
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error generating data');
        }
    });
}

function view_form_cross()
{
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="cross_type1"]').val('').trigger("chosen:updated");
	$('[name="cross_type2"]').val('').trigger("chosen:updated");
	$('[name="cross_periode"]').val('Semua').trigger("chosen:updated");
	$('[name="cross_tahun"]').val('');
	$('[name="cross_tahun"]').prop({disabled: true});
	
	$('#cross_result_box').hide();
	$('#cross_result').empty();
				
	$('#form-cross').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Crosstab'); // Set title to Bootstrap modal title
	
	
}

function submit_cross()
{
	/*
	var formData = {
		extract_periode: $('[name="extract_periode"]').val(),
		extract_tahun: $('[name="extract_tahun"]').val()
	}
	
	$.ajax({
        url : "<?php echo site_url('report/ajax_get_extract_all_data')?>",
        type: "POST",
		data: formData,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
			{
				
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
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error generating data');
        }
    });
	*/
	
	document.getElementById("form_cross").submit();
}

function submit_form()
{
	$('[name="report_type"]').val('preview');
	document.getElementById("thisform").submit();
}

function PrintElem(elem)
{
	Popup($(elem).html());
}

function Popup(data) 
{
	var preview_window = window.open('', 'Report', 'height=300, width=600');
    preview_window.document.write('<html><head><title>Report</title>');
    /*optional stylesheet*/ 
	preview_window.document.write('<link href="<?php echo base_url(); ?>assets/css/print_report_layout.css" rel="stylesheet" type="text/css" />');
	preview_window.document.write('</head><body >');
    preview_window.document.write(data);
    preview_window.document.write('</body></html>');

    preview_window.document.close(); // necessary for IE >= 10
    preview_window.focus(); // necessary for IE >= 10

    preview_window.print();
    preview_window.close();

    return true;
}

function generate_xls()
{
	$('[name="report_type"]').val('file');
	document.getElementById("thisform").submit();
}
	
     
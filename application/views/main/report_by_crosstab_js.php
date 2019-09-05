<script type="text/javascript">
$(document).ready(function() {
	
	$(".chosen-select").chosen();
	$(".chosen-select-deselect").chosen({ allow_single_deselect: true, width: '100%'});
	
	$(".chosen-select").val('').trigger("chosen:updated");
	$(".chosen-select-deselect").val('').trigger("chosen:updated");
	
	
	$('[name="cross_type1"]').chosen().chosenReadonly(false);
	$('[name="cross_type1"]').val('<?php echo $crosstype1; ?>').trigger("chosen:updated");
	
	if ($('[name="cross_type1"]').val() != '')
	{
		selected = $('[name="cross_type1"]').val();
				
		$('[name="cross_type2"] option[value="'+selected+'"]').attr('disabled', 'disabled');
		$('[name="cross_type2"]').chosen().chosenReadonly(false);
		$('[name="cross_type2"]').val('<?php echo $crosstype2; ?>').trigger("chosen:updated");
	}
	else
	{
		$('[name="cross_type2"]').chosen().chosenReadonly(true);
		$('[name="cross_type2"]').val('<?php echo $crosstype2; ?>').trigger("chosen:updated");
	}
			
	
	//$('[name="cross_type2"]').chosen().chosenReadonly(true);
	//$('[name="cross_type2"]').val('<?php echo $crosstype2; ?>').trigger("chosen:updated");
	
    $('[name="cross_periode"]').val('<?php echo $crossperiode; ?>').trigger('chosen:updated');

    $('[name="cross_tahun"]').val('<?php echo $crosstahun; ?>');
	
	if($('[name="cross_periode"]').val() == 'Semua' )
	{
		$('[name="cross_tahun"]').val('<?php echo $crosstahun; ?>');
        $('[name="cross_tahun"]').attr('readonly', true);
	}
	else
	{
		$('[name="cross_tahun"]').val('<?php echo $crosstahun; ?>');
         $('[name="cross_tahun"]').attr('readonly', false);
	}
	
    $('[name="report_type"]').val('preview');
	
    $('[name="cross_periode"]').change(function ()
	{
		if ($(this).val() == 'Semua')
		{
			$('[name="cross_tahun"]').val('');
			$('[name="cross_tahun"]').attr('readonly', true);
		}
		else
		{
			$('[name="cross_tahun"]').val('');
			$('[name="cross_tahun"]').attr('readonly', false);
		}
	});
	
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
				$('[name="cross_type2"]').chosen().chosenReadonly(false);
				$('[name="cross_type2"]').val('').trigger("chosen:updated");
				
			}
			else
			{
				$('[name="cross_type2"] option[value="'+previous+'"]').removeAttr('disabled');
				$('[name="cross_type2"]').chosen().chosenReadonly(true);
				$('[name="cross_type2"]').val('').trigger("chosen:updated");
			}
		});	
		
	});	
	
});	


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

</script>
	
     
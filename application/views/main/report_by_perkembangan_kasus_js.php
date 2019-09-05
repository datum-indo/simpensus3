<script type="text/javascript">
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
	
    $('[name="periode_type"]').val('<?php echo $periode; ?>').trigger('chosen:updated');

    $('[name="tahun"]').val('<?php echo $tahun; ?>');
	
	if($('[name="periode_type"]').val() == 1 )
	{
		$('[name="bulan"]').chosen().chosenReadonly(true);
		$('[name="bulan"]').val('01').trigger('chosen:updated');

	}
	else
	{
		$('[name="bulan"]').chosen().chosenReadonly(false);
		$('[name="bulan"]').val('<?php echo $xbulan; ?>').trigger('chosen:updated');
	}

	$('[name="periode_type"]').change(function ()
	{
		if ($(this).val() == '1')
		{
			$('[name="bulan"]').chosen().chosenReadonly(true);
			$('[name="bulan"]').val('01').trigger('chosen:updated');
            
		}
		else
		{
			$('[name="bulan"]').chosen().chosenReadonly(false);
			$('[name="bulan"]').val('01').trigger('chosen:updated');
		}
		
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
	
     
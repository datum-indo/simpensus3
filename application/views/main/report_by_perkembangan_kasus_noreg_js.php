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
	
    $('[name="no_reg"]').val('<?php echo $no_reg; ?>');
	
	
});	


function submit_form()
{
	document.getElementById("thisform").submit();
}

function PrintElem(elem)
{
	Popup($(elem).html());
}

function Popup(data) 
{
	var preview_window = window.open('', '', 'height=300, width=600');
    preview_window.document.write('<html><head><title></title>');
    /*optional stylesheet*/ 
	preview_window.document.write('<link href="<?php echo base_url(); ?>assets/css/print_report_layout_progress.css" rel="stylesheet" type="text/css" />');
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
	
     
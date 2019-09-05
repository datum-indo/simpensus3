<script type="text/javascript">
  
$(document).ready(function() {
	var Tbl_File_Manager = $('#Tbl_File_Manager').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('file_manager/ajax_list'); ?>",
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
		Tbl_File_Manager.search( '' ) .columns().search( '' ) .draw();
	});
	
	$('#tgl_kejadian').datetimepicker({
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
	
	
});	



function del(id_file)
{
    if(confirm('Are you sure delete this file?'))
    {
        var formData = {
			id_file: id_file
		}
		
		$.ajax({
            url : "<?php echo site_url('file_manager/ajax_delete')?>",
            type: "POST",
			data: formData,
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting file');
            }
        });

    }
}

function get(id_file)
{
	//alert(id_file);
	url = "<?php echo site_url('file_manager/get_file_attachment')?>/"+id_file;
	window.open(url);
}

function reload_table()
{
    var Tbl_File_Manager = $('#Tbl_File_Manager').DataTable();
	Tbl_File_Manager.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
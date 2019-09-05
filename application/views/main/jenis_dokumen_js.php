<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Jenis_dokumen = $('#Tbl_Jenis_dokumen').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 2, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_jenis_dokumen'); ?>",
			"type": "POST"
		},
		
		"columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
				
        }
        ],
	});
		
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
		$(this).next().empty();
	});
	
	$('#btnClear').click(function()
	{
		$('input[type=search]').val('');
		Tbl_Jenis_dokumen.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_jenis_dokumen"]').val('');
	$('[name="jenis_dokumen"]').val('');
	$('[name="no_urut"]').val('');
		
	//$('[name="jenis_dokumen"]').prop({disabled: false});
	
	$('#form-jenis_dokumen').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Jenis Dokumen'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_jenis_dokumen: $('[name="id_jenis_dokumen"]').val(),
		jenis_dokumen: $('[name="jenis_dokumen"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_jenis_dokumen'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_jenis_dokumen'); ?>";
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
				$('#form-jenis_dokumen').modal('hide');
				reload_table();	
				$('[name="csrf_token"]').val(data.csrf_token);
			}
			else
			{
				for (var i = 0; i < data.inputerror.length; i++) 
				{
					$('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
					$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
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

function edit(id_jenis_dokumen)
{
	$('#formJenis_dokumen')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_jenis_dokumen')?>/" + id_jenis_dokumen,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_jenis_dokumen"]').val(data.id_jenis_dokumen);
			$('[name="jenis_dokumen"]').val(data.jenis_dokumen);
			$('[name="no_urut"]').val(data.no_urut);
												
			//$('[name="jenis_dokumen"]').prop({disabled: true});
				
			$('#form-jenis_dokumen').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Jenis Dokumen'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_jenis_dokumen)
{
	
	$('#dd_id_jenis_dokumen').empty();
	$('#dd_jenis_dokumen').empty();
	$('#dd_no_urut').empty();
		
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_jenis_dokumen')?>/" + id_jenis_dokumen,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_jenis_dokumen').append(data.id_jenis_dokumen);
			$('#dd_jenis_dokumen').append(data.jenis_dokumen);
			$('#dd_no_urut').append(data.no_urut);
									
			$('#view-jenis_dokumen').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Jenis Dokumen'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_jenis_dokumen)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_jenis_dokumen: id_jenis_dokumen
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_jenis_dokumen')?>",
            type: "POST",
			data: formData,
            dataType: "JSON",
            success: function(data)
            {
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function reload_table()
{
    var Tbl_Jenis_dokumen = $('#Tbl_Jenis_dokumen').DataTable();
	Tbl_Jenis_dokumen.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Pekerjaan = $('#Tbl_Pekerjaan').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_pekerjaan'); ?>",
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
		$(this).parent().parent().removeClass('has-error');
		//$(this).next().empty();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_pekerjaan"]').val('');
	$('[name="jenis_pekerjaan"]').val('');
	$('[name="no_urut"]').val('');
	
	//$('[name="jenis_pekerjaan"]').prop({disabled: false});
	
	$('#form-pekerjaan').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Pekerjaan'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_pekerjaan: $('[name="id_pekerjaan"]').val(),
		jenis_pekerjaan: $('[name="jenis_pekerjaan"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_pekerjaan'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_pekerjaan'); ?>";
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
				$('#form-pekerjaan').modal('hide');
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

function edit(id_pekerjaan)
{
	$('#formPekerjaan')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_pekerjaan')?>/" + id_pekerjaan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_pekerjaan"]').val(data.id_pekerjaan);
			$('[name="jenis_pekerjaan"]').val(data.jenis_pekerjaan);
			$('[name="no_urut"]').val(data.no_urut);
									
			//$('[name="jenis_pekerjaan"]').prop({disabled: true});
				
			$('#form-pekerjaan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Pekerjaan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_pekerjaan)
{
	
	$('#dd_id_pekerjaan').empty();
	$('#dd_jenis_pekerjaan').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_pekerjaan')?>/" + id_pekerjaan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_pekerjaan').append(data.id_pekerjaan);
			$('#dd_jenis_pekerjaan').append(data.jenis_pekerjaan);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-pekerjaan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Pekerjaan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_pekerjaan)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_pekerjaan: id_pekerjaan
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_pekerjaan')?>",
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
    var Tbl_Pekerjaan = $('#Tbl_Pekerjaan').DataTable();
	Tbl_Pekerjaan.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
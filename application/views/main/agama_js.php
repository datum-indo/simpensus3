<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Agama = $('#Tbl_Agama').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_agama'); ?>",
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
	
	$('[name="id_agama"]').val('');
	$('[name="nm_agama"]').val('');
	$('[name="no_urut"]').val('');
	
	//$('[name="nm_agama"]').prop({disabled: false});
	
	$('#form-agama').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Agama'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_agama: $('[name="id_agama"]').val(),
		nm_agama: $('[name="nm_agama"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_agama'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_agama'); ?>";
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
				$('#form-agama').modal('hide');
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

function edit(id_agama)
{
	$('#formAgama')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_agama')?>/" + id_agama,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_agama"]').val(data.id_agama);
			$('[name="nm_agama"]').val(data.nm_agama);
			$('[name="no_urut"]').val(data.no_urut);
									
			//$('[name="nm_agama"]').prop({disabled: true});
				
			$('#form-agama').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Agama'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_agama)
{
	
	$('#dd_id_agama').empty();
	$('#dd_nm_agama').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_agama')?>/" + id_agama,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_agama').append(data.id_agama);
			$('#dd_nm_agama').append(data.nm_agama);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-agama').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('agama'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_agama)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_agama: id_agama
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_agama')?>",
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
    var Tbl_Agama = $('#Tbl_Agama').DataTable();
	Tbl_Agama.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
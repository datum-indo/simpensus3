<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Pendidikan = $('#Tbl_Pendidikan').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_pendidikan'); ?>",
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
	
	$('[name="id_pendidikan"]').val('');
	$('[name="nm_pendidikan"]').val('');
	$('[name="no_urut"]').val('');
	
	$('#form-pendidikan').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Pendidikan'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_pendidikan: $('[name="id_pendidikan"]').val(),
		nm_pendidikan: $('[name="nm_pendidikan"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_pendidikan'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_pendidikan'); ?>";
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
				$('#form-pendidikan').modal('hide');
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

function edit(id_pendidikan)
{
	$('#formPendidikan')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_pendidikan')?>/" + id_pendidikan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_pendidikan"]').val(data.id_pendidikan);
			$('[name="nm_pendidikan"]').val(data.nm_pendidikan);
			$('[name="no_urut"]').val(data.no_urut);
							
			$('#form-pendidikan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Pendidikan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_pendidikan)
{
	
	$('#dd_id_pendidikan').empty();
	$('#dd_nm_pendidikan').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_pendidikan')?>/" + id_pendidikan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_pendidikan').append(data.id_pendidikan);
			$('#dd_nm_pendidikan').append(data.nm_pendidikan);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-pendidikan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Pendidikan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_pendidikan)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_pendidikan: id_pendidikan
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_pendidikan')?>",
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
    var Tbl_Pendidikan = $('#Tbl_Pendidikan').DataTable();
	Tbl_Pendidikan.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
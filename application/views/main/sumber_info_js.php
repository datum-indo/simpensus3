<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Sumber_info = $('#Tbl_Sumber_info').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_sumber_info'); ?>",
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
		//$(this).next().empty();
	});
	
	$('#btnClear').click(function()
	{
		$('input[type=search]').val('');
		Tbl_Sumber_info.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_sumber_info"]').val('');
	$('[name="nm_sumber_info"]').val('');
	$('[name="no_urut"]').val('');
	
	//$('[name="nm_sumber_info"]').prop({disabled: false});
	
	$('#form-sumber_info').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Sumber Informasi Pemohon'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_sumber_info: $('[name="id_sumber_info"]').val(),
		nm_sumber_info: $('[name="nm_sumber_info"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_sumber_info'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_sumber_info'); ?>";
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
				$('#form-sumber_info').modal('hide');
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

function edit(id_sumber_info)
{
	$('#formSumber_info')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_sumber_info')?>/" + id_sumber_info,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_sumber_info"]').val(data.id_sumber_info);
			$('[name="nm_sumber_info"]').val(data.nm_sumber_info);
			$('[name="no_urut"]').val(data.no_urut);
									
			//$('[name="nm_sumber_info"]').prop({disabled: true});
				
			$('#form-sumber_info').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Sumber Informasi Pemohon'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_sumber_info)
{
	
	$('#dd_id_sumber_info').empty();
	$('#dd_nm_sumber_info').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_sumber_info')?>/" + id_sumber_info,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_sumber_info').append(data.id_sumber_info);
			$('#dd_nm_sumber_info').append(data.nm_sumber_info);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-sumber_info').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Sumber Informasi Pemohon'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_sumber_info)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_sumber_info: id_sumber_info
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_sumber_info')?>",
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
    var Tbl_Sumber_info = $('#Tbl_Sumber_info').DataTable();
	Tbl_Sumber_info.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
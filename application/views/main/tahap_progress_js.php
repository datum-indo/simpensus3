<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Tahap_progress = $('#Tbl_Tahap_progress').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_tahap_progress'); ?>",
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
		Tbl_Tahap_progress.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_tahap_progress"]').val('');
	$('[name="tahap_progress"]').val('');
	$('[name="no_urut"]').val('');
		
	//$('[name="tahap_progress"]').prop({disabled: false});
	
	$('#form-tahap_progress').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Tahap Perkembangan'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_tahap_progress: $('[name="id_tahap_progress"]').val(),
		tahap_progress: $('[name="tahap_progress"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_tahap_progress'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_tahap_progress'); ?>";
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
				$('#form-tahap_progress').modal('hide');
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

function edit(id_tahap_progress)
{
	$('#formTahap_progress')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_tahap_progress')?>/" + id_tahap_progress,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_tahap_progress"]').val(data.id_tahap_progress);
			$('[name="tahap_progress"]').val(data.tahap_progress);
			$('[name="no_urut"]').val(data.no_urut);
												
			//$('[name="tahap_progress"]').prop({disabled: true});
				
			$('#form-tahap_progress').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Tahap Perkembangan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_tahap_progress)
{
	
	$('#dd_id_tahap_progress').empty();
	$('#dd_tahap_progress').empty();
	$('#dd_no_urut').empty();
		
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_tahap_progress')?>/" + id_tahap_progress,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_tahap_progress').append(data.id_tahap_progress);
			$('#dd_tahap_progress').append(data.tahap_progress);
			$('#dd_no_urut').append(data.no_urut);
									
			$('#view-tahap_progress').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Tahap Perkembangan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_tahap_progress)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_tahap_progress: id_tahap_progress
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_tahap_progress')?>",
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
    var Tbl_Tahap_progress = $('#Tbl_Tahap_progress').DataTable();
	Tbl_Tahap_progress.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Difabel = $('#Tbl_Difabel').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_difabel'); ?>",
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
	
	$('[name="id_difabel"]').val('');
	$('[name="jenis_difabel"]').val('');
	$('[name="no_urut"]').val('');
	
	$('#form-difabel').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Difabel'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_difabel: $('[name="id_difabel"]').val(),
		jenis_difabel: $('[name="jenis_difabel"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_difabel'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_difabel'); ?>";
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
				$('#form-difabel').modal('hide');
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

function edit(id_difabel)
{
	$('#formDifabel')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_difabel')?>/" + id_difabel,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_difabel"]').val(data.id_difabel);
			$('[name="jenis_difabel"]').val(data.jenis_difabel);
			$('[name="no_urut"]').val(data.no_urut);
							
			$('#form-difabel').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Difabel'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_difabel)
{
	
	$('#dd_id_difabel').empty();
	$('#dd_jenis_difabel').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_difabel')?>/" + id_difabel,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_difabel').append(data.id_difabel);
			$('#dd_jenis_difabel').append(data.jenis_difabel);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-difabel').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Difabel'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_difabel)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_difabel: id_difabel
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_difabel')?>",
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
    var Tbl_Difabel = $('#Tbl_Difabel').DataTable();
	Tbl_Difabel.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
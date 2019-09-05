<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Penghasilan = $('#Tbl_Penghasilan').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_penghasilan'); ?>",
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
	
	$('[name="id_penghasilan"]').val('');
	$('[name="jml_penghasilan"]').val('');
	$('[name="no_urut"]').val('');
	
	$('#form-penghasilan').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Penghasilan'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_penghasilan: $('[name="id_penghasilan"]').val(),
		jml_penghasilan: $('[name="jml_penghasilan"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_penghasilan'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_penghasilan'); ?>";
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
				$('#form-penghasilan').modal('hide');
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

function edit(id_penghasilan)
{
	$('#formPenghasilan')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_penghasilan')?>/" + id_penghasilan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_penghasilan"]').val(data.id_penghasilan);
			$('[name="jml_penghasilan"]').val(data.jml_penghasilan);
			$('[name="no_urut"]').val(data.no_urut);
							
			$('#form-penghasilan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Penghasilan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_penghasilan)
{
	
	$('#dd_id_penghasilan').empty();
	$('#dd_jml_penghasilan').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_penghasilan')?>/" + id_penghasilan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_penghasilan').append(data.id_penghasilan);
			$('#dd_jml_penghasilan').append(data.jml_penghasilan);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-pendidikan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Penghasilan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_penghasilan)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_penghasilan: id_penghasilan
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_penghasilan')?>",
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
    var Tbl_Penghasilan = $('#Tbl_Penghasilan').DataTable();
	Tbl_Penghasilan.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
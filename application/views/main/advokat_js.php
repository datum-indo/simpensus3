<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Advokat = $('#Tbl_Advokat').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_advokat'); ?>",
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
		Tbl_Advokat.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_advokat"]').val('');
	$('[name="nama_advokat"]').val('');
	$('[name="alamat_advokat"]').val('');
	$('[name="telp_advokat"]').val('');
	$('[name="fax_advokat"]').val('');
	
	$('[name="nama_advokat"]').prop({disabled: false});
	
	$('#form-advokat').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Advokat'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_advokat: $('[name="id_advokat"]').val(),
		nama_advokat: $('[name="nama_advokat"]').val(),
		alamat_advokat: $('[name="alamat_advokat"]').val(),
		telp_advokat: $('[name="telp_advokat"]').val(),
		fax_advokat: $('[name="fax_advokat"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_advokat'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_advokat'); ?>";
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
				$('#form-advokat').modal('hide');
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

function edit(id_advokat)
{
	$('#formAdvokat')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_advokat')?>/" + id_advokat,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_advokat"]').val(data.id_advokat);
			$('[name="nama_advokat"]').val(data.nama_advokat);
			$('[name="alamat_advokat"]').val(data.alamat_advokat);
			$('[name="telp_advokat"]').val(data.telp_advokat);
			$('[name="fax_advokat"]').val(data.fax_advokat);
									
			$('[name="nama_advokat"]').prop({disabled: false});
				
			$('#form-advokat').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Advokat'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_advokat)
{
	
	$('#dd_id_advokat').empty();
	$('#dd_nama_advokat').empty();
	$('#dd_alamat_advokat').empty();
	$('#dd_telp_advokat').empty();
	$('#dd_fax_advokat').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_advokat')?>/" + id_advokat,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_advokat').append(data.id_advokat);
			$('#dd_nama_advokat').append(data.nama_advokat);
			$('#dd_alamat_advokat').append(data.alamat_advokat);
			$('#dd_telp_advokat').append(data.telp_advokat);
			$('#dd_fax_advokat').append(data.fax_advokat);
						
			$('#view-alasan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Advokat'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_advokat)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_advokat: id_advokat
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_advokat')?>",
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
    var Tbl_Advokat = $('#Tbl_Advokat').DataTable();
	Tbl_Advokat.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
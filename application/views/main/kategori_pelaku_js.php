<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Kategori_pelaku = $('#Tbl_Kategori_pelaku').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_kategori_pelaku'); ?>",
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
		Tbl_Kategori_pelaku.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_kategori_pelaku"]').val('');
	$('[name="kategori_pelaku"]').val('');
	$('[name="no_urut"]').val('');
		
	//$('[name="kategori_pelaku"]').prop({disabled: false});
	
	$('#form-kategori_pelaku').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Kategori Pelaku'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_kategori_pelaku: $('[name="id_kategori_pelaku"]').val(),
		kategori_pelaku: $('[name="kategori_pelaku"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_kategori_pelaku'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_kategori_pelaku'); ?>";
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
				$('#form-kategori_pelaku').modal('hide');
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

function edit(id_kategori_pelaku)
{
	$('#formKategori_pelaku')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_kategori_pelaku')?>/" + id_kategori_pelaku,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_kategori_pelaku"]').val(data.id_kategori_pelaku);
			$('[name="kategori_pelaku"]').val(data.kategori_pelaku);
			$('[name="no_urut"]').val(data.no_urut);
												
			//$('[name="kategori_pelaku"]').prop({disabled: true});
				
			$('#form-kategori_pelaku').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Kategori Pelaku'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_kategori_pelaku)
{
	
	$('#dd_id_kategori_pelaku').empty();
	$('#dd_kategori_pelaku').empty();
	$('#dd_no_urut').empty();
		
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_kategori_pelaku')?>/" + id_kategori_pelaku,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_kategori_pelaku').append(data.id_kategori_pelaku);
			$('#dd_kategori_pelaku').append(data.kategori_pelaku);
			$('#dd_no_urut').append(data.no_urut);
									
			$('#view-kategori_pelaku').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Kategori Pelaku'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_kategori_pelaku)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_kategori_pelaku: id_kategori_pelaku
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_kategori_pelaku')?>",
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
    var Tbl_Kategori_pelaku = $('#Tbl_Kategori_pelaku').DataTable();
	Tbl_Kategori_pelaku.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
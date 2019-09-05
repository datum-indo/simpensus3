<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Kategori_korban = $('#Tbl_Kategori_korban').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_kategori_korban'); ?>",
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
		Tbl_Kategori_korban.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_kategori_korban"]').val('');
	$('[name="kategori_korban"]').val('');
	$('[name="no_urut"]').val('');
		
	//$('[name="kategori_korban"]').prop({disabled: false});
	
	$('#form-kategori_korban').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Kategori Korban'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_kategori_korban: $('[name="id_kategori_korban"]').val(),
		kategori_korban: $('[name="kategori_korban"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_kategori_korban'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_kategori_korban'); ?>";
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
				$('#form-kategori_korban').modal('hide');
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

function edit(id_kategori_korban)
{
	$('#formKategori_korban')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_kategori_korban')?>/" + id_kategori_korban,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_kategori_korban"]').val(data.id_kategori_korban);
			$('[name="kategori_korban"]').val(data.kategori_korban);
			$('[name="no_urut"]').val(data.no_urut);
												
			//$('[name="kategori_korban"]').prop({disabled: true});
				
			$('#form-kategori_korban').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Kategori Korban'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_kategori_korban)
{
	
	$('#dd_id_kategori_korban').empty();
	$('#dd_kategori_korban').empty();
	$('#dd_no_urut').empty();
		
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_kategori_korban')?>/" + id_kategori_korban,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_kategori_korban').append(data.id_kategori_korban);
			$('#dd_kategori_korban').append(data.kategori_korban);
			$('#dd_no_urut').append(data.no_urut);
									
			$('#view-kategori_korban').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Kategori Korban'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_kategori_korban)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_kategori_korban: id_kategori_korban
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_kategori_korban')?>",
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
    var Tbl_Kategori_korban = $('#Tbl_Kategori_korban').DataTable();
	Tbl_Kategori_korban.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
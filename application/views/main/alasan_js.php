<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Alasan = $('#Tbl_Alasan').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_alasan'); ?>",
			"type": "POST"
		},
		
		"columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
				
        }
        ],
	});
		
	//$('.capitalize').capitalize();
	
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
		Tbl_Alasan.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_alasan_penolakan"]').val('');
	$('[name="isi_alasan_penolakan"]').val('');
	$('[name="no_urut"]').val('');
	
	$('[name="isi_alasan_penolakan"]').prop({disabled: false});
	
	$('#form-alasan').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Alasan Penolakan'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_alasan_penolakan: $('[name="id_alasan_penolakan"]').val(),
		isi_alasan_penolakan: $('[name="isi_alasan_penolakan"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_alasan'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_alasan'); ?>";
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
				$('#form-alasan').modal('hide');
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

function edit(id_alasan_penolakan)
{
	$('#formAlasan')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_alasan')?>/" + id_alasan_penolakan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_alasan_penolakan"]').val(data.id_alasan_penolakan);
			$('[name="isi_alasan_penolakan"]').val(data.isi_alasan_penolakan);
			$('[name="no_urut"]').val(data.no_urut);
									
			$('[name="isi_alasan_penolakan"]').prop({disabled: false});
				
			$('#form-alasan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Alasan Penolakan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_alasan_penolakan)
{
	
	$('#dd_id_alasan_penolakan').empty();
	$('#dd_isi_alasan_penolakan').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_alasan')?>/" + id_alasan_penolakan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_alasan_penolakan').append(data.id_alasan_penolakan);
			$('#dd_isi_alasan_penolakan').append(data.isi_alasan_penolakan);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-alasan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Alasan Penolakan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_alasan_penolakan)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_alasan_penolakan: id_alasan_penolakan
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_alasan')?>",
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
    var Tbl_Alasan = $('#Tbl_Alasan').DataTable();
	Tbl_Alasan.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
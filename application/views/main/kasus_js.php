<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Kasus = $('#Tbl_Kasus').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_kasus'); ?>",
			"type": "POST"
		},
		
		"columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
				
        }
        ],
	});
		
	$(".chosen-select").chosen();
	$(".chosen-select-deselect").chosen({ allow_single_deselect: true, width: '100%'});
	
	$(".chosen-select").val('').trigger("chosen:updated");
	$(".chosen-select-deselect").val('').trigger("chosen:updated");
	
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
		Tbl_Kasus.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_nama_kasus"]').val('');
	$('[name="nama_kasus"]').val('');
	$('[name="id_jenis_kasus"]').val('').trigger("chosen:updated");
	$('[name="no_urut"]').val('');
	
	$('[name="nama_kasus"]').prop({disabled: false});
	
	$('#form-kasus').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Kasus'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_nama_kasus: $('[name="id_nama_kasus"]').val(),
		nama_kasus: $('[name="nama_kasus"]').val(),
		id_jenis_kasus: $('[name="id_jenis_kasus"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_kasus'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_kasus'); ?>";
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
				$('#form-kasus').modal('hide');
				reload_table();	
				$('[name="csrf_token"]').val(data.csrf_token);
			}
			else
			{
				for (var i = 0; i < data.inputerror.length; i++) 
				{
					$('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
					//$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
				}
			}		
		}
		,
		complete: function() 
		{
			
        },
		error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = '<?php echo site_url(''); ?>';
        }
		
	});		
}	

function edit(id_nama_kasus)
{
	$('#formKasus')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_kasus')?>/" + id_nama_kasus,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_nama_kasus"]').val(data.id_nama_kasus);
			$('[name="nama_kasus"]').val(data.nama_kasus);
			$('[name="id_jenis_kasus"]').val(data.id_jenis_kasus).trigger("chosen:updated");
			$('[name="no_urut"]').val(data.no_urut);
									
			$('[name="nama_kasus"]').prop({disabled: false});
				
			$('#form-kasus').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Kasus'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_nama_kasus)
{
	
	$('#dd_id_nama_kasus').empty();
	$('#dd_nama_kasus').empty();
	$('#dd_jenis_kasus').empty();
	$('#dd_no_urut').empty();
	
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_kasus')?>/" + id_nama_kasus,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_nama_kasus').append(data.id_nama_kasus);
			$('#dd_nama_kasus').append(data.nama_kasus);
			$('#dd_jenis_kasus').append(data.jenis_kasus);
			$('#dd_no_urut').append(data.no_urut);
						
			$('#view-sumber_info').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Kasus'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_nama_kasus)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_nama_kasus: id_nama_kasus
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_kasus')?>",
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
    var Tbl_Kasus = $('#Tbl_Kasus').DataTable();
	Tbl_Kasus.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Hasil_keputusan = $('#Tbl_Hasil_keputusan').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_hasil_keputusan'); ?>",
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
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});
    
	$("textarea").change(function()
	{
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});
			
	$("select").change(function()
	{
		$(this).parent().parent().removeClass('has-error');
		//$(this).next().empty();
	});
	
	$('#btnClear').click(function()
	{
		$('input[type=search]').val('');
		Tbl_Hasil_keputusan.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_hasil_keputusan"]').val('');
	$('[name="hasil_keputusan"]').val('');
	$('[name="id_jenis_kasus_hasil[]"]').val('').trigger('chosen:updated');
	$('[name="no_urut"]').val('');
		
	//$('[name="hasil_keputusan"]').prop({disabled: false});
	
	$('#form-hasil_keputusan').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Hasil Keputusan'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_hasil_keputusan: $('[name="id_hasil_keputusan"]').val(),
		hasil_keputusan: $('[name="hasil_keputusan"]').val(),
		id_jenis_kasus_hasil: $('[name="id_jenis_kasus_hasil[]"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_hasil_keputusan'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_hasil_keputusan'); ?>";
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
				$('#form-hasil_keputusan').modal('hide');
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

function edit(id_hasil_keputusan)
{
	$('#formHasil_keputusan')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_hasil_keputusan')?>/" + id_hasil_keputusan,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
			var data = response[0];
						
			$('[name="id_hasil_keputusan"]').val(data.id_hasil_keputusan);
			$('[name="hasil_keputusan"]').val(data.hasil_keputusan);
			$('[name="no_urut"]').val(data.no_urut);
			
			var jenis_kasus = response[1];
			var jenis_kasus_hasil = jenis_kasus.jenis_kasus;
			var jenis_kasus_hasil = jenis_kasus_hasil.replace(/0/g, "");
			$('[name="id_jenis_kasus_hasil[]"]').val(jenis_kasus_hasil.split(','));
			$('[name="id_jenis_kasus_hasil[]"]').trigger('chosen:updated');
															
			//$('[name="hasil_keputusan"]').prop({disabled: true});
				
			$('#form-hasil_keputusan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Hasil Keputusan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_hasil_keputusan)
{
	
	$('#dd_id_hasil_keputusan').empty();
	$('#dd_hasil_keputusan').empty();
	$('#dd_no_urut').empty();
		
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_hasil_keputusan')?>/" + id_hasil_keputusan,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_hasil_keputusan').append(data.id_hasil_keputusan);
			$('#dd_hasil_keputusan').append(data.hasil_keputusan);
			$('#dd_no_urut').append(data.no_urut);
									
			$('#view-hasil_keputusan').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Hasil Keputusan'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_hasil_keputusan)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_hasil_keputusan: id_hasil_keputusan
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_hasil_keputusan')?>",
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
    var Tbl_Hasil_keputusan = $('#Tbl_Hasil_keputusan').DataTable();
	Tbl_Hasil_keputusan.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
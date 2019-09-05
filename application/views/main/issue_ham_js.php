<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Issue_ham = $('#Tbl_Issue_ham').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('tabel/ajax_list_issue_ham'); ?>",
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
		Tbl_Issue_ham.search( '' ) .columns().search( '' ) .draw();
	});
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_issue_ham"]').val('');
	$('[name="issue_ham"]').val('');
	$('[name="no_urut"]').val('');
		
	//$('[name="issue_ham"]').prop({disabled: false});
	
	$('#form-issue_ham').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Issue HAM'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_issue_ham: $('[name="id_issue_ham"]').val(),
		issue_ham: $('[name="issue_ham"]').val(),
		no_urut: $('[name="no_urut"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('tabel/ajax_save_issue_ham'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('tabel/ajax_update_issue_ham'); ?>";
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
				$('#form-issue_ham').modal('hide');
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

function edit(id_issue_ham)
{
	$('#formIssue_ham')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('tabel/get_detail_issue_ham')?>/" + id_issue_ham,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_issue_ham"]').val(data.id_issue_ham);
			$('[name="issue_ham"]').val(data.issue_ham);
			$('[name="no_urut"]').val(data.no_urut);
												
			//$('[name="issue_ham"]').prop({disabled: true});
				
			$('#form-issue_ham').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Issue HAM'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_issue_ham)
{
	
	$('#dd_id_issue_ham').empty();
	$('#dd_issue_ham').empty();
	$('#dd_no_urut').empty();
		
	$.ajax({
        url : "<?php echo site_url('tabel/view_detail_issue_ham')?>/" + id_issue_ham,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('#dd_id_issue_ham').append(data.id_issue_ham);
			$('#dd_issue_ham').append(data.issue_ham);
			$('#dd_no_urut').append(data.no_urut);
									
			$('#view-issue_ham').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Issue HAM'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_issue_ham)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_issue_ham: id_issue_ham
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('tabel/ajax_delete_issue_ham')?>",
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
    var Tbl_Issue_ham = $('#Tbl_Issue_ham').DataTable();
	Tbl_Issue_ham.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
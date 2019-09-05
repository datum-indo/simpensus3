<script type="text/javascript">
$(document).ready(function() {
		
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
	
	$('.capitalize').capitalize();
	
	$('#xtgl_lahir').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	
	$('#image_upload').change(function(e)
	{
		e.preventDefault();
		var formData = new FormData();
		var fileData = $('#image_upload').prop('files')[0]; 
		formData.append('image_upload', fileData);
		
		$.ajax({
			url: "<?php echo site_url('page/ajax_upload_photo/')?>/",
			type: "POST",
			data: formData,
			dataType: "JSON",
			cache: false,
            contentType: false,
            processData: false,
			success: function(data)
			{
				if(data.status)
				{
					$('#xuser_images').empty().append('<img class="img-circle" src="<?php echo base_url(); ?>'+ data.user_pictures + '" alt="User Image">');
					$('[name="xuser_pictures"]').val(data.user_pictures);
					$('#image_upload').val('');
				}
				else
				{
					//$('#xuser_images').empty().append('<img class="img-circle" src="<?php echo base_url(); ?>'+ data.user_pictures + '" alt="User Image">');
					//$('[name="xuser_pictures"]').val(data.user_pictures);
					$('#image_upload').val('');
					alert('Invalid filetype, size or resolution\n(Filetype = jpg | Max Size = 1024kb | Resolution = 128x128px)');
				}		
			}
		});
	});		
});	

function save_profile()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		xid_user: $('[name="xid_user"]').val(),
		old_password: $('[name="old_password"]').val(),
		new_password: $('[name="new_password"]').val(),
		con_password: $('[name="con_password"]').val(),
		xtmp_lahir: $('[name="xtmp_lahir"]').val(),
		xtgl_lahir: $('[name="xtgl_lahir"]').val(),
		xno_hp: $('[name="xno_hp"]').val(),
		xemail: $('[name="xemail"]').val(),
		xuser_pictures: $('[name="xuser_pictures"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('page/ajax_save_profile'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('page/ajax_update_profile'); ?>";
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
				
				$('#form-edit_profile').modal('hide');
			}
			else
			{
				for (var i = 0; i < data.inputerror.length; i++) 
				{
					$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
					$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
				}
			}		
		},
		complete: function() 
		{
			
        },
		error: function (jqXHR, textStatus, errorThrown)
        {
            window.location = "<?php echo site_url(''); ?>";
        }
		
	});		
}	

function edit_profile(id_user)
{
	$('#form_edit_profile')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('page/get_detail_account')?>/" + id_user,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="xid_user"]').val(data.id_user);
			$('[name="xusername"]').val(data.username);		
			$('[name="old_password"]').val('');		
			$('[name="new_password"]').val('');		
			$('[name="con_password"]').val('');		
			$('[name="xfullname"]').val(data.fullname);
			$('[name="xdesignation"]').val(data.designation);
			$('[name="xtmp_lahir"]').val(data.tmp_lahir);
			$('[name="xtgl_lahir"]').val(data.tgl_lahir);
			$('[name="xno_hp"]').val(data.no_hp);
			$('[name="xemail"]').val(data.email);
			$('#xuser_images').empty().append('<img class="img-circle" src="<?php echo base_url(); ?>'+ data.user_pictures + '" alt="User Image">');
			$('[name="xuser_pictures"]').val(data.user_pictures);
				
			
			$('[name="xusername"]').prop({disabled: true});
			$('[name="xfullname"]').prop({disabled: true});
			$('[name="xdesignation"]').prop({disabled: true});
				
			$('#form-edit_profile').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Account'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

</script>
	
     
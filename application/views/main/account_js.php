<script type="text/javascript">
$(document).ready(function() {
	var Tbl_Account = $('#Tbl_Account').DataTable({ 
		"processing": true, //Feature control the processing indicator.
        "serverSide": true,
		
		"order": [[ 0, "desc" ]],
		"ajax": {
			"url": "<?php echo site_url('setting/ajax_list_account'); ?>",
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
	
	$('#tgl_signin').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	
	$('#tgl_lahir').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	
	$('.capitalize').capitalize();
	
	$('#_jkel1').addClass('active');
	$('#_jkel1').removeClass('btn-default');
	$('#_jkel1').addClass('btn-primary');
	$('#_jkel0').removeClass('btn-primary');
	$('#_jkel0').addClass('btn-default');
			
	$('input[name="jkel"][value="Laki-laki"]').attr('checked', 'checked');
	$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
	
	
	$('input[name="jkel"]').change(function ()
	{
		if ($(this).val() == 'Laki-laki')
		{
			$('#_jkel1').removeClass('btn-default');
			$('#_jkel1').addClass('btn-primary');
			$('#_jkel0').removeClass('btn-primary');
			$('#_jkel0').addClass('btn-default');
			
			$('input[name="jkel"][value="Laki-laki"]').attr('checked', 'checked');
			$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
		}
		else 
		{
			$('#_jkel1').removeClass('btn-primary');
			$('#_jkel1').addClass('btn-default');
			$('#_jkel0').removeClass('btn-default');
			$('#_jkel0').addClass('btn-primary');
			
			$('input[name="jkel"][value="Laki-laki"]').removeAttr('checked');
			$('input[name="jkel"][value="Perempuan"]').attr('checked', 'checked');
		}
	});
	
	$('#btnClear').click(function()
	{
		$('input[type=search]').val('');
		Tbl_Account.search( '' ) .columns().search( '' ) .draw();
	});
	
});	

function add()
{
	save_method = 'add';
	
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	$('[name="id_user"]').val('');
	$('[name="username"]').val('');
	$('[name="password"]').val('welcome');
	$('[name="fullname"]').val('');
	$('[name="tgl_signin"]').val('');
	$('[name="designation"]').val('');
	$('[name="tmp_lahir"]').val('');
	$('[name="tgl_lahir"]').val('');
	$('[name="no_hp"]').val('');
	$('[name="email"]').val('');
	$('#user_images').empty().append('<img class="img-circle" src="<?php echo base_url(); ?>media/user_pictures/default_avatar.png" alt="User Image">');
	$('[name="user_pictures"]').val('media/user_pictures/default_avatar.png');
	$('[name="id_role"]').val('').trigger("chosen:updated");
	$('[name="user_status"]').val('').trigger("chosen:updated");
	
	$('[name="username"]').prop({disabled: false});
	$('[name="fullname"]').prop({disabled: false});
	$('[name="id_role"]').chosen().chosenReadonly(false);
	
	$('#form-account').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Account'); // Set title to Bootstrap modal title
	
}

function save()
{
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	var url;
	
	var formData = {
		csrf_token: $('[name="csrf_token"]').val(),
		id_user: $('[name="id_user"]').val(),
		username: $('[name="username"]').val(),
		password: $('[name="password"]').val(),
		fullname: $('[name="fullname"]').val(),
		tgl_signin: $('[name="tgl_signin"]').val(),
		designation: $('[name="designation"]').val(),
		tmp_lahir: $('[name="tmp_lahir"]').val(),
		tgl_lahir: $('[name="tgl_lahir"]').val(),
		jkel: $('[name="jkel"][checked="checked"]').val(),
		no_hp: $('[name="no_hp"]').val(),
		email: $('[name="email"]').val(),
		user_pictures: $('[name="user_pictures"]').val(),
		id_role: $('[name="id_role"]').val(),
		user_status: $('[name="user_status"]').val()
	};
	
    if(save_method == 'add') 
	{
        url = "<?php echo site_url('setting/ajax_save_account'); ?>";
    } 
	else 
	{
        url = "<?php echo site_url('setting/ajax_update_account'); ?>";
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
				
				$('#form-account').modal('hide');
				reload_table();	
				$('[name="csrf_token"]').val(data.csrf_token);
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
            window.location = '<?php echo site_url(''); ?>';
        }
	});		
}	

function edit(id_user)
{
	$('#formAccount')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string
	
	save_method = 'update';
	
	$.ajax({
        url : "<?php echo site_url('setting/get_detail_account')?>/" + id_user,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id_user"]').val(data.id_user);
			$('[name="username"]').val(data.username);
			$('[name="password"]').val('');		
			$('[name="fullname"]').val(data.fullname);
			$('[name="tgl_signin"]').val(data.tgl_signin);
			$('[name="designation"]').val(data.designation);
			$('[name="tmp_lahir"]').val(data.tmp_lahir);
			$('[name="tgl_lahir"]').val(data.tgl_lahir);
			
			if(data.jkel == 'Laki-laki')
			{
				$('#_jkel1').removeClass('btn-default');
				$('#_jkel1').addClass('btn-primary');
				$('#_jkel0').removeClass('btn-primary');
				$('#_jkel0').addClass('btn-default');
			
				$('input[name="jkel"][value="Laki-laki"]').attr('checked', 'checked');
				$('input[name="jkel"][value="Perempuan"]').removeAttr('checked');
								
				$('#_jkel1').addClass('active');
				$('#_jkel0').removeClass('active');
			}
			else
			{
				$('#_jkel0').removeClass('btn-default');
				$('#_jkel0').addClass('btn-primary');
				$('#_jkel1').removeClass('btn-primary');
				$('#_jkel1').addClass('btn-default');
								
				$('input[name="jkel"][value="Laki-laki"]').removeAttr('checked');
				$('input[name="jkel"][value="Perempuan"]').attr('checked', 'checked');
								
				$('#_jkel0').addClass('active');
				$('#_jkel1').removeClass('active');
			}
						
			$('[name="no_hp"]').val(data.no_hp);
			$('[name="email"]').val(data.email);
			$('#user_images').empty().append('<img class="img-circle" src="<?php echo base_url(); ?>'+ data.user_pictures + '" alt="User Image">');
			$('[name="user_pictures"]').val(data.user_pictures);
			$('[name="id_role"]').val(data.id_role).trigger("chosen:updated");
			$('[name="user_status"]').val(data.user_status).trigger("chosen:updated");			
			
			$('[name="username"]').prop({disabled: true});
			
			if(data.username == 'admin')
			{
				$('[name="fullname"]').prop({disabled: true});
				$('[name="id_role"]').chosen().chosenReadonly(true);	
			}
			else
			{
				$('[name="fullname"]').prop({disabled: false});
				$('[name="id_role"]').chosen().chosenReadonly(false);	
			}		
				
			$('#form-account').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Account'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
}

function view(id_user)
{
	
	$('#dd_username').empty();
	$('#dd_fullname').empty();
	$('#dd_designation').empty();
	$('#dd_tgl_signin').empty();
	$('#dd_tmp_lahir').empty();
	$('#dd_tgl_lahir').empty();
	$('#dd_jkel').empty();
	$('#dd_no_hp').empty();
	$('#dd_email').empty();
	$('#dd_user_pictures').empty().append('<img class="img-circle" src="<?php echo base_url(); ?>media/user_pictures/default_avatar.png" alt="User Image">');
	$('#dd_nm_role').empty();
	$('#dd_user_status').empty();
	
	
	$.ajax({
        url : "<?php echo site_url('setting/view_detail_account')?>/" + id_user,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			user_images = data.user_pictures;
			$('#dd_username').append(data.username);
			$('#dd_fullname').append(data.fullname);
			$('#dd_designation').append(data.designation);
			$('#dd_tgl_signin').append(data.tgl_signin);
			$('#dd_tmp_lahir').append(data.tmp_lahir);
			$('#dd_tgl_lahir').append(data.tgl_lahir);
			$('#dd_jkel').append(data.jkel);
			$('#dd_no_hp').append(data.no_hp);
			$('#dd_email').append(data.email);
			$('#dd_user_pictures').empty().append('<img class="img-circle" src="<?php echo base_url(); ?>'+ data.user_pictures + '" alt="User Image">');
			$('#dd_nm_role').append(data.nm_role);
			$('#dd_user_status').append(data.user_status);
			
			$('#view-account').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Account'); // Set title to Bootstrap modal title
		},
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
	
}

function del(id_user)
{
    if(confirm('Are you sure delete this data?'))
    {
        var formData = {
			id_user: id_user
		}
		// ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('setting/ajax_delete_account')?>",
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
    var Tbl_Account = $('#Tbl_Account').DataTable();
	Tbl_Account.ajax.reload(null,false); //reload datatable ajax 
}

</script>
	
     
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo 'Simpensus | '; echo $page_title; ?></title>
	<meta name="description" content="Simpensus LBH">
	<meta name="author" content="DATUM">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link href="<?php echo base_url(); ?>assets/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Font Awesome -->
	<link href="<?php echo base_url(); ?>assets/adminlte/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
	<link href="<?php echo base_url(); ?>assets/adminlte/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
	<link href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="hold-transition login-page">
	
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Simpensus </b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        
		
		<?php echo form_open('login','id="form" class="form-vertical" role="form"');?>
			<div class="form-group has-feedback">
            <?php echo form_input('username', '', 'id="username" class="form-control" placeholder="Username"'); ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
			<span class="help-block" style="color:#a94442;"><?php echo form_error('username'); ?></span>
          </div>
          
		  <div class="form-group has-feedback">
			<?php echo form_password('password', '', 'id="password" class="form-control" placeholder="Password"'); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			<span class="help-block" style="color:#a94442;"><?php echo form_error('password'); ?></span>
          </div>
		  
		  <div class="form-group">
			<span class="help-block" style="color:#a94442;"><?php echo $this->session->flashdata("invalid_password"); ?></span>
		  </div>
		  
          <div class="row">
              <div class="col-xs-offset-8 col-xs-4">
			  <!--
              <div id="login" class="btn btn-primary btn-block btn-flat">Sign In</div>
			  -->
			  <?php echo form_submit('login','Sign In', 'id="login" class="btn btn-primary btn-block btn-flat"');  ?>
            </div><!-- /.col -->
          </div>
        
		
		
		<?php echo form_close();?>
	  </div><!-- /.login-box-body -->
	</div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- Bootstrap 3.3.5 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/bootstrap/js/bootstrap.min.js"></script>
	
    <script type="text/javascript">
	
	$(document).ready(function() {
		
		/*
		$('#login').click(function() {
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string
			
			var url = "<?php echo base_url(); ?>login";
			$.ajax({
				url : url,
				type: "POST",
				data: $('#form').serialize(),
				dataType: "JSON",
				success: function(data)
				{
					if(data.status) //if success close modal and reload ajax table
					{
							
					}
					else
					{
						for (var i = 0; i < data.inputerror.length; i++) 
						{
							$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
							//$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
						}
					}		
				}
				
			});	
			
			return false;
		});
		*/		
	});
	
    
    </script>
  </body>
</html>

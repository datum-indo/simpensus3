<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo 'Simpensus | '; echo $page_title; ?></title>
	<meta name="description" content="Sistem Informasi Pendataan Kasus">
	<meta name="author" content="DATUM">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<!-- Bootstrap 3.3.5 -->
	<link href="<?php echo base_url(); ?>assets/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Font Awesome -->
	<link href="<?php echo base_url(); ?>assets/adminlte/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="<?php echo base_url(); ?>assets/adminlte/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	
	<!-- DataTables -->
	<link href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/js/Responsive-2.0.2/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!--Select2-->
	<link href="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
	<!--Chosen-->
	<link href="<?php echo base_url(); ?>assets/js/chosen-alxlit/bootstrap-chosen.css" rel="stylesheet" type="text/css" />
	<!--Datepicker-->  
	<link href="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
	
	<!--SimpleTree-->  
	<link href="<?php echo base_url(); ?>assets/js/simpleTree/simpleTree.css" rel="stylesheet" type="text/css" />
	

	<!--Morris-->
	<link href="<?php echo base_url(); ?>assets/adminlte/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
	
	<!-- Theme style -->
	<link href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. Choose a skin from the css/skins 
	folder instead of downloading all of them to reduce the load. -->
	<link href="<?php echo base_url(); ?>assets/adminlte/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	
	<!-- jQuery 2.1.4 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/jQueryUI/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
	<!-- Bootstrap 3.3.5 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/js/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="assets/js/jquery-easyui/themes/icon.css">
	
	<!-- DataTables -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/js/Responsive-2.0.2/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/js/Responsive-2.0.2/js/responsive.bootstrap.min.js"></script>    
	
	<!--Select2-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
	<!--Chosen-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chosen-alxlit/chosen.jquery.js"></script>
	<!--Datepicker-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment-with-locales.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<!--Numeric-->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/numeric/jquery.numeric.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/numeric/jquery.numeric.config.js"></script>
	<!-- Chosen Readonly -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chosen-readonly/chosen-readonly.min.js"></script>
	<!-- Capitalize -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/capitalize/jquery.capitalize.js"></script>	
	<!-- Slimscroll -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/fastclick/fastclick.min.js"></script>
	<!-- Raphael -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/raphael/raphael-min.js"></script>
	<!-- Morris.js -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/morris/morris.min.js"></script>
	<!-- Sparkline -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/knob/jquery.knob.js"></script>
	<!-- ChartJS 1.0.1 -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/chartjs/Chart.min.js"></script>
	<!-- AdminLTE App -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/dist/js/app.min.js"></script>
	<!-- simpleTree -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/simpleTree/simpleTree.js"></script>
		<!-- ComboTree Actions -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-easyui/jquery.easyui.min.js"></script>

	
        
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php echo form_hidden('csrf_token', $csrf_token); ?>	
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo site_url(''); ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini">LB<b>H</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Simpensus</b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
					
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
								<span class="label label-primary">0</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">Tidak ada pesan terbaru</li>
							</ul>
						</li>
						
					<?php if($id_role == '1' || $id_role == '2' || $id_role == '3') { ?>	
						<!-- Penanganan -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i> <!--<i class="fa fa-bell-o"></i>-->
								<?php 
								
								$total = $permohonan_count + $approval_count;
								if($total > 0)
								{
									echo '<span class="label label-warning">'.$total.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$total.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									<?php if($permohonan_count > 0)
									{
										echo $permohonan_count.' permohonan yang belum diproses.';
									}	
									else
									{
										echo '0 permohonan yang belum diproses.';
									}		
									?>
									<br/>
									<?php if($approval_count > 0)
									{
										echo $approval_count.' kasus baru.';
									}	
									else
									{
										echo '0 kasus baru.';
									}		
									?>
								</li>
								<?php if($permohonan_count > 0 && $approval_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($permohonan_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#" title="Permohonan Baru">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/petition_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										if ($row['status_dokumen'] == 'Verified')
										{
											echo '<small>';
											echo '<i class="fa fa-check-circle text-green"></i>';	
											echo '</small>';
										}	
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									
									foreach($approval_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#" title="Kasus Baru">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/case_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								}
								else if($permohonan_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($permohonan_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#" title="Permohonan Baru">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/petition_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										if ($row['status_dokumen'] == 'Verified')
										{
											echo '<small>';
											echo '<i class="fa fa-check-circle text-green"></i>';	
											echo '</small>';
										}	
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									
									echo '</ul>';
									echo '</li>';
								}
								else if($approval_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($approval_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#" title="Kasus Baru">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/case_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
								}	
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>
							</ul>
						</li>
						
						<!-- Notifications: style can be found in dropdown.less -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-stethoscope"></i> <!--<i class="fa fa-bell-o"></i>-->
								<?php if($analisis_count > 0)
								{
									echo '<span class="label label-warning">'.$analisis_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$analisis_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									<?php if($analisis_count > 0)
									{
										echo $analisis_count.' kasus yang belum dianalisis.';
									}	
									else
									{
										echo '0 kasus yang belum dianalisis.';
									}		
									?>
								</li>
								<?php if($analisis_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($analisis_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/analist_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										if ($row['id_analis'] == $id_user || $row['id_asisten'] == $id_user)
										{
											echo '<small>';
											echo '<i class="fa fa-asterisk text-red"></i>';	
											echo '</small>';
										}
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>
							</ul>
						</li>
						
						<!-- Progress -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<?php if($progress_count > 0)
								{
									echo '<span class="label label-danger">'.$progress_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$progress_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
								<?php if($progress_count > 0)
								{
									echo $progress_count.' kasus yang perlu diupdate.';
								}
								else
								{
									echo '0 kasus yang perlu diupdate.';
								}		
								?>
								</li>
								<?php if($progress_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($progress_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/progress_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										if ($row['id_analis'] == $id_user || $row['id_asisten'] == $id_user)
										{
											echo '<small>';
											echo '<i class="fa fa-asterisk text-red"></i>';	
											echo '</small>';
										}	
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>

							</ul>
						</li>	
					<?php } else if($id_role == '7') { ?>	
						<!-- Penanganan -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i> <!--<i class="fa fa-bell-o"></i>-->
								<?php 
								
								$total = $permohonan_count + $approval_count;
								if($total > 0)
								{
									echo '<span class="label label-warning">'.$total.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$total.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									<?php if($permohonan_count > 0)
									{
										echo $permohonan_count.' permohonan yang belum diproses.';
									}	
									else
									{
										echo '0 permohonan yang belum diproses.';
									}		
									?>
								</li>
								<?php if($permohonan_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($permohonan_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/petition_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										if ($row['status_dokumen'] == 'Verified')
										{
											echo '<small>';
											echo '<i class="fa fa-check-circle" style="color: #4F8A10;"></i>';	
											echo '</small>';
										}	
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>
								
							</ul>
						</li>
						
						<!-- Notifications: style can be found in dropdown.less -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-stethoscope"></i> <!--<i class="fa fa-bell-o"></i>-->
								<?php if($analisis_count > 0)
								{
									echo '<span class="label label-warning">'.$analisis_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$analisis_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									<?php if($analisis_count > 0)
									{
										echo $analisis_count.' kasus yang belum dianalisis.';
									}	
									else
									{
										echo '0 kasus yang belum dianalisis.';
									}		
									?>
								</li>
								<?php if($analisis_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($analisis_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/analist_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										if ($row['id_analis'] == $id_user || $row['id_asisten'] == $id_user)
										{
											echo '<small>';
											echo '<i class="fa fa-asterisk text-red"></i>';	
											echo '</small>';
										}
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>
							</ul>
						</li>
						
						<!-- Progress -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<?php if($progress_count > 0)
								{
									echo '<span class="label label-danger">'.$progress_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$progress_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
								<?php if($progress_count > 0)
								{
									echo $progress_count.' kasus yang perlu diupdate.';
								}
								else
								{
									echo '0 kasus yang perlu diupdate.';
								}		
								?>
								</li>
								<?php if($progress_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($progress_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/progress_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										if ($row['id_analis'] == $id_user || $row['id_asisten'] == $id_user)
										{
											echo '<small>';
											echo '<i class="fa fa-asterisk text-red"></i>';	
											echo '</small>';
										}	
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>

							</ul>
						</li>	
						<!--
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-stethoscope"></i><span class="label label-primary">0</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									Tidak ada informasi.
								</li>
							</ul>
						</li>
						
						
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i><span class="label label-primary">0</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									Tidak ada informasi.
								</li>
							</ul>
						</li>
						-->	
					<?php } else { ?>
						<?php if($id_role == '4') {?>
						<!-- Penanganan -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i> <!--<i class="fa fa-bell-o"></i>-->
								<?php if($approval_count > 0)
								{
									echo '<span class="label label-warning">'.$approval_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$approval_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									<?php if($approval_count > 0)
									{
										echo $approval_count.' kasus baru.';
									}	
									else
									{
										echo '0 kasus baru.';
									}		
									?>
								</li>
								<?php if($approval_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($approval_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/case_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>
							</ul>
						</li>
						
						<!-- Analisis -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-stethoscope"></i> <!--<i class="fa fa-bell-o"></i>-->
								<?php if($analisis_count > 0)
								{
									echo '<span class="label label-warning">'.$analisis_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$analisis_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									<?php if($analisis_count > 0)
									{
										echo $analisis_count.' kasus yang belum dianalisis.';
									}	
									else
									{
										echo 'Tidak ada kasus yang belum dianalisis.';
									}		
									?>
								</li>
								<?php if($analisis_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($analisis_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/analist_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>
							</ul>
						</li>
						
						<!-- Progress -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<?php if($progress_count > 0)
								{
									echo '<span class="label label-danger">'.$progress_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$progress_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
								<?php if($progress_count > 0)
								{
									echo $progress_count.' kasus yang perlu diupdate.';
								}
								else
								{
									echo 'Tidak ada kasus yang perlu diupdate.';
								}		
								?>
								</li>
								<?php if($progress_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($progress_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/progress_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>

							</ul>
						</li>	
						<?php } else { ?>
						
						<!-- Penanganan -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i> <!--<i class="fa fa-bell-o"></i>-->
								<?php if($approval_count > 0)
								{
									echo '<span class="label label-warning">'.$approval_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$approval_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									<?php if($approval_count > 0)
									{
										echo $approval_count.' kasus baru.';
									}	
									else
									{
										echo '0 kasus baru.';
									}		
									?>
								</li>
								<?php if($approval_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($approval_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/case_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>
							</ul>
						</li>
						
						<!-- Analisis -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-stethoscope"></i> <!--<i class="fa fa-bell-o"></i>-->
								<span class="label label-primary">0</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header">
									Tidak ada informasi.
								</li>
							</ul>
						</li>	
						
						<!-- Progress -->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<?php if($progress_count > 0)
								{
									echo '<span class="label label-danger">'.$progress_count.'</span>';
								}
								else
								{
									echo '<span class="label label-primary">'.$progress_count.'</span>';
								}	
								?>	
							</a>
							<ul class="dropdown-menu">
								<li class="header">
								<?php if($progress_count > 0)
								{
									echo $progress_count.' kasus yang perlu diupdate.';
								}
								else
								{
									echo '0 kasus yang perlu diupdate.';
								}		
								?>
								</li>
								<?php if($progress_count > 0)
								{
									echo '<li>';
									echo '<ul class="menu">';
									foreach($progress_schedule->result_array() as $row)
									{
										echo '<li>';
										echo '<a href="#">';
										echo '<div class="pull-left">';
										echo '<img src="'.base_url().'assets/img/progress_icon.png" class="img-circle" alt="User Image">';
										echo '</div>';
										echo '<h4>';
										echo $row['no_reg'];
										echo '</h4>';
										echo '<p>'.$row['nm_pemohon'].'</p>';
										echo '</a>';
										echo '</li>';
									}  
									echo '</ul>';
									echo '</li>';
									/*
									echo '<li class="footer">';
									echo '<a href="#">View all</a>';
									echo '</li>';
									*/
								} 
								else
								{
									echo '<li>';
									echo '</li>';	
								}	
								?>

							</ul>
						</li>
						<?php } ?>		
					<?php } ?>	
					
						
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url().$user_pictures; ?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php echo $fullname; ?></span>
							</a>
							<ul class="dropdown-menu">
							<!-- User image -->
								<li class="user-header">
									<img src="<?php echo base_url().$user_pictures; ?>" class="img-circle" alt="User Image">
									<p>
										<?php echo $fullname; ?>
										<!--
											<small>Member since Nov. 2012</small>
										-->
										<small><?php echo $designation; ?></small>
									</p>
								</li>
								<!-- Menu Body --
								<li class="user-body">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</li>
								-->
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="javascript:void(0)" onclick="edit_profile('<?php echo $id_user; ?>')" class="btn btn-default btn-flat">Edit Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url().$user_pictures; ?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $fullname; ?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
          
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
			
			
			


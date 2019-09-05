<?php
	include('header.php');
?>
				
			<li class=""><a href="<?php echo site_url(''); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
							
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class=""><a href="<?php echo site_url('permohonan'); ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Permohonan</span></a></li>
				<li class=""><a href="<?php echo site_url('approval'); ?>"><i class="fa fa-circle-o text-red"></i> <span>Approval</span></a></li>
				<li class=""><a href="<?php echo site_url('progress'); ?>"><i class="fa fa-circle-o text-yellow"></i> <span>Progress</span></a></li>
				<li class=""><a href="<?php echo site_url('analisis'); ?>"><i class="fa fa-circle-o text-green"></i> <span>Analisis</span></a></li>
              </ul>
            </li>
			
			<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Report</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class=""><a href="<?php echo site_url('report'); ?>"><i class="fa fa-circle-o"></i>General</a></li>
              </ul>
            </li>
			
			<li class="active"><a href="<?php echo site_url('users'); ?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
			
			<?php if($id_role == '1' || $id_role == '2') {?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tabel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class=""><a href="<?php echo site_url('tabel/pekerjaan'); ?>"><i class="fa fa-circle-o"></i>Pekerjaan</a></li>
				<li class=""><a href="<?php echo site_url('tabel/agama'); ?>"><i class="fa fa-circle-o"></i>Agama</a></li>
				<li class=""><a href="<?php echo site_url('tabel/sumber_info'); ?>"><i class="fa fa-circle-o"></i>Sumber Informasi</a></li>
				
				<li class=""><a href="<?php echo site_url('tabel/kasus'); ?>"><i class="fa fa-circle-o"></i>Kasus</a></li>
				<li class=""><a href="<?php echo site_url('tabel/alasan'); ?>"><i class="fa fa-circle-o"></i>Alasan Penolakan</a></li>
				<li class=""><a href="<?php echo site_url('tabel/advokat'); ?>"><i class="fa fa-circle-o"></i>Advokat</a></li>
				
				<li class=""><a href="<?php echo site_url('tabel/tahap_perkembangan'); ?>"><i class="fa fa-circle-o"></i>Tahap Perkembangan</a></li>
				<li class=""><a href="<?php echo site_url('tabel/hasil_keputusan'); ?>"><i class="fa fa-circle-o"></i>Hasil Keputusan</a></li>
								
				<li class=""><a href="<?php echo site_url('tabel/issue_ham'); ?>"><i class="fa fa-circle-o"></i>Issue HAM</a></li>
                <li class=""><a href="<?php echo site_url('tabel/kategori_korban'); ?>"><i class="fa fa-circle-o"></i>Kategori Korban</a></li>
                <li class=""><a href="<?php echo site_url('tabel/kategori_pelaku'); ?>"><i class="fa fa-circle-o"></i>Kategori Pelaku</a></li>
				
				<li class=""><a href="<?php echo site_url('tabel/jenis_dokumen'); ?>"><i class="fa fa-circle-o"></i>Jenis Dokumen</a></li>
              </ul>
            </li>
			<?php } ?>
			
      		<li class=""><a href="<?php echo site_url('file_manager'); ?>"><i class="fa fa-briefcase"></i> <span>File Manager</span></a></li>
      
			<?php if($id_role == '1' || $id_role == '2') {?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i> <span>Setting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class=""><a href="<?php echo site_url('setting/account'); ?>"><i class="fa fa-user"></i>Account</a></li>
				<?php if($id_user == '201600000') { ?>
				          <li><a href="<?php echo site_url('setting/configuration'); ?>"><i class="fa fa-gear"></i>Configuration</a></li>
                <?php } ?>  
              </ul>
            </li>
			<?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
	  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>
				<?php echo $nama_lengkap; ?>
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('users')?>"><i class="fa fa-user"></i>Users</a></li>
			</ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-3">
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">
							<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url().$photo; ?>" alt="User profile picture">
							<h3 class="profile-username text-center"><?php echo $nama_lengkap; ?></h3>
							<p class="text-muted text-center"><?php echo $jabatan; ?></p>
							<p class="text-muted text-center">Since <?php echo $tgl_signin; ?></p>

							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Konsultasi</b> <a class="pull-right"><?php echo $total_konsultasi; ?></a>
								</li>
								<li class="list-group-item">
									<b>Mediator/Negosiator</b> <a class="pull-right"><?php echo $total_negosiator; ?></a>
								</li>
								<li class="list-group-item">
									<b>Kuasa Hukum/Pembela Hukum</b> <a class="pull-right"><?php echo $total_pembela; ?></a>
								</li>
							</ul>
							<a href="#" class="btn btn-primary btn-block"><b>More</b></a>
						</div><!-- /.box-body -->
					</div><!-- /.box -->

					<!-- About Me Box -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">About Me</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<strong><i class="fa fa-map-o margin-r-5"></i>  Place of Birth</strong>
							<p class="text-muted"><?php echo $ytmp_lahir; ?></p>
							<hr>
							
							<strong><i class="fa fa-birthday-cake margin-r-5"></i>  Date of Birth</strong>
							<p class="text-muted"><?php echo $ytgl_lahir; ?></p>
							<hr>
							
							<strong><i class="fa  fa-circle margin-r-5"></i>  Sex</strong>
							<p class="text-muted"><?php if($yjkel == 'Laki-laki') { echo 'Male'; } else { echo 'Female'; }  ?></p>
							<hr>

							<strong><i class="fa fa-mobile margin-r-5"></i> Mobile</strong>
							<p class="text-muted"><?php echo $yno_hp; ?></p>
							<hr>

							<strong><i class="fa fa-envelope-o margin-r-5"></i> Email</strong>
							<p><?php echo $yemail; ?></p>
							<hr>

						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!-- /.col -->
				
				<div class="col-md-3">
					<div class="info-box">
						<span class="info-box-icon bg-aqua"><i class="ion ion-android-chat"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Konsultasi</span>
							<span class="info-box-number"><?php echo $jml_konsultasi; ?></span>
							<div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
							<span class=""><?php echo $percent_konsultasi; ?></span>
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div><!-- /.col -->

				<div class="col-md-3">
					<div class="info-box">
						<span class="info-box-icon bg-green"><i class="ion ion-umbrella"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Mediator/Negosiator</span>
							<span class="info-box-number"><?php echo $jml_negosiator; ?></span>
							<div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
							<span class=""><?php echo $percent_negosiator; ?></span>
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div><!-- /.col -->
           
				<div class="col-md-3">
					<div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Kuasa Hukum/Pembela Hukum</span>
							<span class="info-box-number"><?php echo $jml_pembela; ?></span>
							<div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
							<span class=""><?php echo $percent_pembela; ?></span>
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div><!-- /.col -->
				
				<div class="col-md-9">
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title">Progress Report</h3>
							<div class="box-tools pull-right">
								
							</div>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="progress-chart" style="height: 230px;"></div>
						</div>
						
					</div>
				</div>
				
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-3">
							<div class="info-box" style="background-color: #3c8dbc;">
								<span class="info-box-icon"><i class="ion ion-bag"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Permohonan</span>
									<span class="info-box-number"><?php echo $total_permohonan; ?></span>
									<div class="progress">
										<div class="progress-bar" style="width: <?php echo $percent_permohonan; ?>"></div>
									</div>
									<span class="progress-description">
										<?php echo $percent_permohonan; ?> 
									</span>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->
						
						<div class="col-md-3">
							<div class="info-box" style="background-color: #7bc576;">
								<span class="info-box-icon"><i class="fa fa-legal"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Approval</span>
									<span class="info-box-number"><?php echo $total_approval; ?></span>
									<div class="progress">
										<div class="progress-bar" style="width: <?php echo $percent_approval; ?>"></div>
									</div>
									<span class="progress-description">
										<?php echo $percent_approval; ?> 
									</span>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->
						
						
						
						<div class="col-md-3">
							<div class="info-box" style="background-color: #39CCCC;">
								<span class="info-box-icon"><i class="fa fa-cog"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Progress</span>
									<span class="info-box-number"><?php echo $total_progress; ?></span>
									<div class="progress">
										<div class="progress-bar" style="width: <?php echo $percent_progress; ?>"></div>
									</div>
									<span class="progress-description">
										<?php echo $percent_progress; ?> 
									</span>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->
						
						
						
						<div class="col-md-3">
							<div class="info-box" style="background-color: #f56954;">
								<span class="info-box-icon"><i class="fa fa-files-o"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Upload</span>
									<span class="info-box-number"><?php echo $total_upload; ?></span>
									<div class="progress">
										<div class="progress-bar" style="width: <?php echo $percent_upload; ?>"></div>
									</div>
									<span class="progress-description">
										<?php echo $percent_upload; ?> 
									</span>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->	
					</div>
				</div>	

				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<div class="info-box bg-green">
								<span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Analisis</span>
									<span class="info-box-number"><?php echo $total_analisis; ?></span>
									<div class="progress">
										<div class="progress-bar" style="width: <?php echo $percent_analisis; ?>"></div>
									</div>
									<span class="progress-description">
										<?php echo $percent_analisis; ?> 
									</span>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->	
				
						<div class="col-md-6">
							<div class="info-box bg-yellow">
								<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Kasus Selesai</span>
									<span class="info-box-number"><?php echo $total_job; ?></span>
									<div class="progress">
										<div class="progress-bar" style="width: <?php echo $percent_job; ?>"></div>
									</div>
									<span class="progress-description">
										<?php echo $percent_job; ?>
									</span>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</div><!-- /.col -->	
					</div>
				</div>	
			</div><!-- /.row --> 
			
		
		</section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
	include('user_show_js.php');
	include('footer.php');
?>	
<?php
	include('header.php');
?>
				
			<li class="active"><a href="<?php echo site_url(''); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
							
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
			
			<li class=""><a href="<?php echo site_url('users'); ?>"><i class="fa fa-user"></i> <span>Users</span></a></li>
			
			<?php if($id_role == '1' || $id_role == '2') {?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tabel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class=""><a href="<?php echo site_url('tabel/pekerjaan'); ?>"><i class="fa fa-circle-o"></i>Pekerjaan</a></li>
				<li class=""><a href="<?php echo site_url('tabel/agama'); ?>"><i class="fa fa-circle-o"></i>Agama</a></li>
				<li class=""><a href="<?php echo site_url('tabel/pendidikan'); ?>"><i class="fa fa-circle-o"></i>Pendidikan</a></li>
				<li class=""><a href="<?php echo site_url('tabel/penghasilan'); ?>"><i class="fa fa-circle-o"></i>Penghasilan</a></li>
				<li class=""><a href="<?php echo site_url('tabel/difabel'); ?>"><i class="fa fa-circle-o"></i>Jenis Difabel</a></li>
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
				Home
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
			</ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-4">
					<div class="info-box">
						<span class="info-box-icon bg-aqua"><i class="ion ion-android-chat"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Konsultasi</span>
							<span class="info-box-number"><?php echo $total_konsultasi; ?></span>
							<div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
							<span class=""><?php echo $percent_konsultasi; ?></span>
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div><!-- /.col -->

				<div class="col-md-4">
					<div class="info-box">
						<span class="info-box-icon bg-green"><i class="ion ion-umbrella"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Mediator/Negosiator</span>
							<span class="info-box-number"><?php echo $total_negosiator; ?></span>
							<div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
							<span class=""><?php echo $percent_negosiator; ?></span>
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div><!-- /.col -->
           
				<div class="col-md-4">
					<div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Kuasa Hukum/Pembela Hukum</span>
							<span class="info-box-number"><?php echo $total_pembela; ?></span>
							<div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
							<span class=""><?php echo $percent_pembela; ?></span>
						</div><!-- /.info-box-content -->
					</div><!-- /.info-box -->
				</div><!-- /.col -->
				
				<div class="col-md-8">
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title">Layanan Bantuan Hukum</h3>
							<div class="box-tools pull-right">
								<!--
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								-->
							</div>
						</div>
						<div class="box-body chart-responsive">
							<div class="chart" id="layanan-bantuan" style="height: 393px;"></div>
						</div>
						<div class="box-footer with-border">
							<div class="row">
								<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
									<input type="text" class="knob" data-readonly="true" value="<?php echo $percent_pidana; ?>" data-width="60" data-height="60" data-fgColor="#00c0ef">
									<div class="knob-label">Pidana</div>
								</div>
								<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
									<input type="text" class="knob" data-readonly="true" value="<?php echo $percent_perdata; ?>" data-width="60" data-height="60" data-fgColor="#3c8dbc">
									<div class="knob-label">Perdata</div>
								</div>
								<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
									<input type="text" class="knob" data-readonly="true" value="<?php echo $percent_tun; ?>" data-width="60" data-height="60" data-fgColor="#39CCCC">
									<div class="knob-label">Tata Usaha Negara</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="box box-default" >
						<div class="box-header with-border">
							<h3 class="box-title">Posisi Hukum</h3>
							<div class="box-tools pull-right">
								<!--
								<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								-->
							</div>
						</div>
						<div class="box-body" >
							<div class="progress-group">
								<span class="progress-text">Pelapor</span>
								<span class="progress-number"><b><?php echo $total_pelapor; ?></b>/<?php echo $total_pidana; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_pelapor; ?>; background-color: #39CCCC;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Saksi Korban</span>
								<span class="progress-number"><b><?php echo $total_saksi; ?></b>/<?php echo $total_pidana; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_saksi; ?>; background-color: #728f99;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Terlapor</span>
								<span class="progress-number"><b><?php echo $total_terlapor; ?></b>/<?php echo $total_pidana; ?></span>
								<div class="progress sm">
									<div class="progress-bar progress-bar-warning" style="width: <?php echo $percent_terlapor; ?>;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Tersangka</span>
								<span class="progress-number"><b><?php echo $total_tersangka; ?></b>/<?php echo $total_pidana; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_tersangka; ?>; background-color: #D58665;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Terdakwa</span>
								<span class="progress-number"><b><?php echo $total_terdakwa; ?></b>/<?php echo $total_pidana; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_terdakwa; ?>; background-color: #f56954;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Terpidana</span>
								<span class="progress-number"><b><?php echo $total_terpidana; ?></b>/<?php echo $total_pidana; ?></span>
								<div class="progress sm">
									<div class="progress-bar progress-bar-red" style="width: <?php echo $percent_terpidana; ?>"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Penggugat</span>
								<span class="progress-number"><b><?php echo $total_penggugat; ?></b>/<?php echo $total_perdata; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_penggugat; ?>; background-color: #7bc576;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Tergugat</span>
								<span class="progress-number"><b><?php echo $total_tergugat; ?></b>/<?php echo $total_perdata; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_tergugat; ?>; background-color: #00a65a;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Penggugat (TUN)</span>
								<span class="progress-number"><b><?php echo $total_penggugat_tun; ?></b>/<?php echo $total_tun; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_penggugat_tun; ?>; background-color: #00c0ef;"></div>
								</div>
							</div><!-- /.progress-group -->
							<div class="progress-group">
								<span class="progress-text">Tergugat (TUN)</span>
								<span class="progress-number"><b><?php echo $total_tergugat_tun; ?></b>/<?php echo $total_perdata; ?></span>
								<div class="progress sm">
									<div class="progress-bar" style="width: <?php echo $percent_tergugat_tun; ?>; background-color: #3c8dbc;"></div>
								</div>
							</div><!-- /.progress-group -->
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="box">
						 <div class="box-header with-border">
							<h3 class="box-title">Analisis</h3>
							<div class="box-tools pull-right">
							</div>
						 </div>
						 <div class="box-body chart-responsive">
							<div class="row">
								<div class="col-md-8 ">
									<div class="chart" id="issue-ham" style="height: 250px;"></div>
								</div>
								<div class="col-md-2">
									<div class="row">&nbsp;</div>
									<p class="text-center">
										<strong>Bentuk Kasus</strong>
									</p>
									<div class="chart-responsive" style="text-align: center;">
										<canvas id="bentuk_kasus" height="150"></canvas>
									</div><!-- ./chart-responsive -->
									<div class="row">&nbsp;</div>
									<div class="chart-legend clearfix" style="text-align: center;">
										<span><i class="fa fa-circle-o text-aqua"></i> Individu</span>
										<span><i class="fa fa-circle-o text-light-blue"></i> Kelompok</span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="row">&nbsp;</div>
									<p class="text-center">
										<strong>Sifat Kasus</strong>
									</p>
									<div class="chart-responsive" style="text-align: center;">
										<canvas id="sifat_kasus" height="150"></canvas>
									</div><!-- ./chart-responsive -->
									<div class="row">&nbsp;</div>
									<div class="chart-legend clearfix" style="text-align: center;">
										<span><i class="fa fa-circle-o text-green"></i> Non-Struktural</span>
										<span><i class="fa fa-circle-o text-yellow"></i> Struktural</span>
									</div>
								</div>
							</div>
						 </div>
					</div>
				</div>
			</div><!-- /.row --> 
			
		
		</section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
	include('dashboard_js.php');
	include('footer.php');
?>	
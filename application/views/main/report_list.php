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

            
			
			<li class="treeview active">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Report</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class="active"><a href="<?php echo site_url('report'); ?>"><i class="fa fa-circle-o"></i>General</a></li>
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
					<li class=""><a href="<?php echo site_url('setting/configuration'); ?>"><i class="fa fa-gear"></i>Configuration</a></li>
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
            Report
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-text-o"></i>Report</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Extract</h3>
                  <p>Extract Data</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-folder"></i>
                </div>
				<?php if($id_role == '1' || $id_role == '2') {?>
					<a href="#" class="small-box-footer" onclick="view_form_extract()">More Info <i class="fa fa-arrow-circle-right"></i></a>
				<?php } else { ?>
					<a href="#" class="small-box-footer">#</a>
				<?php } ?>	
              </div>
            </div><!-- ./col -->
            
			<div class="col-lg-4 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Frequency</sup></h3>
                  <p>Frequency Tabulation Report</p>
                </div>
                <div class="icon">
                  <i class="ion ion-speedometer"></i>
                </div>
				<!--
				<a href="#" class="small-box-footer" onclick="view_form_freq()">More info <i class="fa fa-arrow-circle-right"></i></a>
				-->
                <a href="<?php echo site_url('report/frequency_tabulation'); ?>" class="small-box-footer" >More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
			<div class="col-lg-4 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Crosstab</h3>
                  <p>Cross Tabulation Report</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <!--
				<a href="#" class="small-box-footer" onclick="view_form_cross()">More info <i class="fa fa-arrow-circle-right"></i></a>
				-->
				<a href="<?php echo site_url('report/cross_tabulation'); ?>" class="small-box-footer" >More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            

          </div><!-- /.row -->
          
          <div class="row">
              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Layanan Bantuan Hukum</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Periode Bulan & Tahun</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/layanan_bantuan_hukum'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->

              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Penerima Bantuan Hukum</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Pendidikan, Kelamin & Kategori Usia</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <!--
					<span class=""><a href="<?php //echo site_url('report/pendidikan_kelamin_usia'); ?>">More info </a></span>
					-->
					<span class=""><a href="#"># </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->

              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Layanan Bantuan Hukum</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Bentuk Layanan & Jenis Masalah Hukum</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/bentuk_layanan_jenis_kasus'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->  
          </div>
          
           <div class="row">
              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Layanan Bantuan Hukum</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Sifat & Bentuk Kasus</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/sifat_bentuk_kasus'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->

              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Layanan Bantuan Hukum</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Issue HAM</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/issue_ham'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->

              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Perkembangan Kasus</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Periode Bulan & Tahun</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/perkembangan_kasus'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->  
          </div>

          <div class="row">
              <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Perkembangan Kasus</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Nomor Permohonan</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/perkembangan_kasus_by_noreg'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->  
			  
			  <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Layanan Bantuan Yang Belum Dianalisis</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Periode Tahun</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/data_belum_dianalisis'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->  
			  
			  <div class="col-md-4">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-grid-view-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Data Penanganan Layanan Bantuan</span>
                    <span class="" style="display: block; padding: 3px 0 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Berdasarkan Pembela Umum/Asisten PU</span>
                    <div class="" style="margin: 5px -10px 5px -10px; height: 2px; border-bottom: 1px solid #f4f4f4;"></div>
                    <span class=""><a href="<?php echo site_url('report/penanganan_layanan_bantuan_hukum'); ?>">More info </a></span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->  
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
	include('report_js.php');
	include('report_extract_form.php');
	//include('report_frequency_form.php');
	//include('report_cross_form.php');
	include('footer.php');
?>	
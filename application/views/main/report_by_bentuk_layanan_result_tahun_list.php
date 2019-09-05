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
            Report Data Layanan Bantuan Hukum 
            <small>Berdasarkan Bentuk Layanan & Jenis Masalah Hukum</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('report'); ?>"><i class="fa fa-file-text-o"></i>Report</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          
          
          <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <div class="row">
                            <?php echo form_open('report/bentuk_layanan_jenis_kasus', 'id="thisform" class="" enctype="multipart/form-data"'); ?>
                            <?php echo form_hidden('report_type', ''); ?>
                            <div class="col-md-1">
                                    <div class="form-group">
                                        <label class="control-label">Tahun</label>
                                        <?php echo form_input('tahun', '', 'id="tahun" placeholder="Tahun" class="form-control numeric" maxlength="4"'); ?>
                                        <span class="help-block"></span>
                                    </div> 
                            </div>
                            
                            <div class="col-md-1">
                                    <label style="width: 100%;" class="control-label pull-right" >&nbsp;</label>
                                    <div class="">	
                                        <button type="button" id="btnSave" onclick="submit_form()" class="btn btn-danger pull-right">Generate</button>
                                    </div>	
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    <div class="box-body" id="print_area">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><strong>Data Layanan Bantuan Hukum</strong></h4>
                                <h4><strong>Berdasarkan Bentuk Layanan & Jenis Masalah Hukum</strong></h4>
                                <h4><strong>Periode Tahun <?php echo $tahun; ?></strong></h4>
                            </div>
                        </div>    
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th rowspan="2" class="">Bulan</th>
                                          <th colspan="3" class="" style="text-align: center;">Bentuk Layanan</th>
                                          <th colspan="7" class="" style="text-align: center;">Pidana</th>
                                          <th colspan="3" class="" style="text-align: center;">Perdata</th>
                                          <th colspan="3" class="" style="text-align: center;">Tata Usaha Negara</th>
                                      </tr>  
                                      <tr>
                                          
                                          <th class="">Konsultasi</th>
                                          <th class="">Non-Litigasi</th>
                                          <th class="">Litigasi</th>
                                          <th class="">Pelapor</th>
                                          <th class="">Saksi Korban</th>
                                          <th class="">Terlapor</th>
                                          <th class="">Tersangka</th>
                                          <th class="">Terdakwa</th>
                                          <th class="">Terpidana</th>
                                          <th class="">Jumlah</th>
                                          <th class="">Penggugat</th>
                                          <th class="">Tergugat</th>
                                          <th class="">Jumlah</th>
                                          <th class="">Penggugat</th>
                                          <th class="">Tergugat</th>
                                          <th class="">Jumlah</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                          $konsultasi = 0; $non_litigasi = 0; $litigasi = 0; 
                                          $pelapor = 0; $saksi_korban = 0; 
                                          $terlapor = 0; $tersangka = 0; $terdakwa = 0; $terpidana = 0; $pidana = 0;
                                          $penggugat = 0; $tergugat = 0; $perdata = 0;
                                          $penggugat_tun = 0; $tergugat_tun = 0; $tun = 0;
                                          foreach($report->result_array() as $row)
                                          {
                                            echo '<tr>';
                                            echo '<td class="">'.$row['bulan'].'</td>'; 
                                            echo '<td class="tengah">'.$row['konsultasi'].'</td>'; 
                                            echo '<td class="tengah">'.$row['non_litigasi'].'</td>'; 
                                            echo '<td class="tengah">'.$row['litigasi'].'</td>';
                                            echo '<td class="tengah">'.$row['pelapor'].'</td>';
                                            echo '<td class="tengah">'.$row['saksi_korban'].'</td>';
                                            echo '<td class="tengah">'.$row['terlapor'].'</td>';
                                            echo '<td class="tengah">'.$row['tersangka'].'</td>';
                                            echo '<td class="tengah">'.$row['terdakwa'].'</td>';
                                            echo '<td class="tengah">'.$row['terpidana'].'</td>';
                                            echo '<td class="tengah">'.$row['pidana'].'</td>';
                                            echo '<td class="tengah">'.$row['penggugat'].'</td>';
                                            echo '<td class="tengah">'.$row['tergugat'].'</td>';
                                            echo '<td class="tengah">'.$row['perdata'].'</td>';
                                            echo '<td class="tengah">'.$row['penggugat_tun'].'</td>';
                                            echo '<td class="tengah">'.$row['tergugat_tun'].'</td>';
                                            echo '<td class="tengah">'.$row['tun'].'</td>';
                                            echo '</tr>';

                                            $konsultasi += $row['konsultasi']; $non_litigasi += $row['non_litigasi']; $litigasi += $row['litigasi']; 
                                            $pelapor += $row['pelapor']; $saksi_korban += $row['saksi_korban']; 
                                            $terlapor += $row['terlapor']; $tersangka += $row['tersangka']; $terdakwa += $row['terdakwa']; $terpidana += $row['terpidana']; 
                                            $pidana += $row['pidana'];
                                            $penggugat += $row['penggugat']; $tergugat += $row['tergugat']; $perdata += $row['perdata'];
                                            $penggugat_tun += $row['penggugat_tun']; $tergugat_tun += $row['tergugat_tun']; $tun += $row['tun'];
                                          }
                                      ?> 
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th class="">Total</th>
                                          <th class=""><?php echo $konsultasi; ?></th>
                                          <th class=""><?php echo $non_litigasi; ?></th>
                                          <th class=""><?php echo $litigasi; ?></th>
                                          <th class=""><?php echo $pelapor; ?></th>
                                          <th class=""><?php echo $saksi_korban; ?></th>
                                          <th class=""><?php echo $terlapor; ?></th>
                                          <th class=""><?php echo $tersangka; ?></th>
                                          <th class=""><?php echo $terdakwa; ?></th>
                                          <th class=""><?php echo $terpidana; ?></th>
                                          <th class=""><?php echo $pidana; ?></th>
                                          <th class=""><?php echo $penggugat; ?></th>
                                          <th class=""><?php echo $tergugat; ?></th>
                                          <th class=""><?php echo $perdata; ?></th>
                                          <th class=""><?php echo $penggugat_tun; ?></th>
                                          <th class=""><?php echo $tergugat_tun; ?></th>
                                          <th class=""><?php echo $tun; ?></th>
                                      </tr>
                                  </thead>  
                              </table>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <div class "row no-print">
                            <button class="btn btn-default" onclick="PrintElem('#print_area')"><i class="fa fa-print"></i> Print</button>
                            <button class="btn btn-primary pull-right" onclick="generate_xls()"><i class="fa fa-file-excel-o"></i> Generate XLS</button>
                        </div>
                    </div>
              </div>
            </div>  
          </div>
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
	include('report_js.php');
	include('footer.php');
?>	
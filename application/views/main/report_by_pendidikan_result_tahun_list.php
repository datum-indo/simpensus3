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
            Report Data Penerima Bantuan Hukum 
            <small>Berdasarkan Pendidikan, Kelamin & Kategori Usia</small>
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
                            <?php echo form_open('report/pendidikan_kelamin_usia', 'id="thisform" class="" enctype="multipart/form-data"'); ?>
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
                                <h4><strong>Data Penerima Bantuan Hukum</strong></h4>
                                <h4><strong>Berdasarkan Pendidikan, Kelamin & Kategori Usia</strong></h4>
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
                                          <th colspan="6" class="" style="text-align: center;">Pendidikan</th>
                                          <th colspan="2" class="" style="text-align: center;">Kategori Dewasa</th>
                                          <th colspan="2" class="" style="text-align: center;">Kategori Anak-anak</th>
                                      </tr>  
                                      <tr>
                                          
                                          <th class="">Tidak Sekolah</th>
                                          <th class="">SD</th>
                                          <th class="">SMP</th>
                                          <th class="">SMA</th>
                                          <th class="">D1/D2/D3</th>
                                          <th class="">D4/S1/S2/S3</th>
                                          <th class="">Laki-laki</th>
                                          <th class="">Perempuan</th>
                                          <th class="">Laki-laki</th>
                                          <th class="">Perempuan</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                          $ts = 0; $sd = 0; $smp = 0; $sma = 0; $diploma = 0; $sarjana = 0;
                                          $lk_dewasa = 0; $pr_dewasa = 0; $lk_anak = 0; $pr_anak = 0;
                                          foreach($report->result_array() as $row)
                                          {
                                            echo '<tr>';
                                            echo '<td class="">'.$row['bulan'].'</td>'; 
                                            echo '<td class="tengah">'.$row['ts'].'</td>'; 
                                            echo '<td class="tengah">'.$row['sd'].'</td>'; 
                                            echo '<td class="tengah">'.$row['smp'].'</td>';
                                            echo '<td class="tengah">'.$row['sma'].'</td>';
                                            echo '<td class="tengah">'.$row['diploma'].'</td>';
                                            echo '<td class="tengah">'.$row['sarjana'].'</td>';
                                            echo '<td class="tengah">'.$row['lk_dewasa'].'</td>';
                                            echo '<td class="tengah">'.$row['pr_dewasa'].'</td>';
                                            echo '<td class="tengah">'.$row['lk_anak'].'</td>';
                                            echo '<td class="tengah">'.$row['pr_anak'].'</td>';
                                            echo '</tr>';

                                            $ts += $row['ts']; $sd += $row['sd']; $smp += $row['smp']; $sma += $row['sma']; $diploma += $row['diploma']; $sarjana += $row['sarjana'];
                                            $lk_dewasa += $row['lk_dewasa']; $pr_dewasa += $row['pr_dewasa']; $lk_anak += $row['lk_anak']; $pr_anak += $row['pr_anak'];
                                          }
                                      ?> 
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th class="">Total</th>
                                          <th class=""><?php echo $ts; ?></th>
                                          <th class=""><?php echo $sd; ?></th>
                                          <th class=""><?php echo $smp; ?></th>
                                          <th class=""><?php echo $sma; ?></th>
                                          <th class=""><?php echo $diploma; ?></th>
                                          <th class=""><?php echo $sarjana; ?></th>
                                          <th class=""><?php echo $lk_dewasa; ?></th>
                                          <th class=""><?php echo $pr_dewasa; ?></th>
                                          <th class=""><?php echo $lk_anak; ?></th>
                                          <th class=""><?php echo $pr_anak; ?></th>
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
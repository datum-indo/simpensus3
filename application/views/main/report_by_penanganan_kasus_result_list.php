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
            Report Data Penanganan Layanan Bantuan Hukum
            <small></small>
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
                        <?php echo form_open('report/penanganan_layanan_bantuan_hukum', 'id="thisform" class="" enctype="multipart/form-data"'); ?>
                        <?php echo form_hidden('report_type', ''); ?>
                        <div class="col-md-2">
                               <div class="form-group">
                                    <label class="control-label">Pembela Umum/Asisten PU</label>
                                    <?php echo form_dropdown('id_petugas', $users, '', 'id="id_petugas" class="form-control chosen-select-deselect" data-placeholder="Pembela Umum/Asisten PU"'); ?>
                                    <span class="help-block"></span>
                               </div>
                        </div>
						<div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Periode</label>
                                    <?php echo form_dropdown('periode_type', $periode_type, '', 'id="periode_type" class="form-control chosen-select-deselect" data-placeholder="Periode"'); ?>
                                    <span class="help-block"></span>
                                </div>
                                 
                        </div>
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
                                <h4><strong>Report Penanganan Layanan Bantuan Hukum</strong></h4>
								<?php if($periode == 'Tahun') { ?>
                                <h4><strong>Periode Tahun <?php echo $tahun; ?></strong></h4>
								<?php } ?>
                            </div>
							<div class="col-md-12">
								&nbsp;
							</div>
							<div class="col-md-12">
								<table class="table" id="identity">
									 <?php foreach($petugas->result_array() as $row) { ?>
										<tr class="tr-identity">
											<td width="150px">Nama Lengkap</td>
											<td colspan="8"><?php echo ':   '.$row['fullname']; ?></td>
										</tr>
										<tr class="tr-identity">
											<td width="150px">Jabatan</td>
											<td colspan="8"><?php echo ':   '.$row['designation']; ?></td>
										</tr>
										<tr class="tr-identity">
											<td width="150px">Tanggal Masuk</td>
											<td colspan="8"><?php echo ':   '.$row['tgl_signin']; ?></td>
										</tr>
									 <?php } ?>
                                </table>
                            </div>
                        </div>    
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <table class="table table-bordered list">
                                  <thead>
                                      <tr>
                                          <th class="th-list">No</th>
                                          <th class="th-list">Nomor Permohonan</th>
                                          <th class="th-list">Tanggal</th>
										  <th class="th-list">Penerima Bantuan</th>
                                          <th class="th-list">Jenis Masalah Hukum</th>
                                          <th class="th-list">Posisi Hukum</th>
                                          <th class="th-list">Bentuk Layanan</th>
                                          <th class="th-list">Tanggal Progress</th>
                                          <th class="th-list">Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                          $no = 1;
										  $pidana = 0; $perdata = 0; $tun = 0;
										  $konsultasi = 0; $negosiator = 0; $pembela = 0;
										  $selesai = 0; $belum = 0; $gugur = 0; $na = 0;
										  if($report->num_rows() > 0 )
										  {
											foreach($report->result_array() as $row)
                                            {
												echo '<tr>';
												echo '<td class="td-list kanan">'.$no++.'</td>'; 
												echo '<td class="td-list tengah">'.$row['no_reg'].'</td>'; 
												echo '<td class="td-list tengah">'.$row['tgl_reg'].'</td>'; 
												echo '<td class="td-list">'.$row['nm_penerima'].'</td>'; 
												echo '<td class="td-list">'.$row['jenis_kasus'].'</td>';
												echo '<td class="td-list">'.$row['posisi_hukum'].'</td>';
												echo '<td class="td-list">'.$row['jenis_tindakan'].'</td>';
												echo '<td class="td-list tengah">'.$row['tgl_progress'].'</td>';
												echo '<td class="td-list tengah">'.$row['status_progress'].'</td>';
												echo '</tr>';
												
												if($row['jenis_kasus'] == 'Pidana')
												{
													$pidana++;
												}
												else if($row['jenis_kasus'] == 'Perdata')
												{
													$perdata++;
												}
												else
												{
													$tun++;
												}
												
												if($row['jenis_tindakan'] == 'Jasa Konsultasi')
												{
													$konsultasi++;
												}
												else if($row['jenis_tindakan'] == 'Jasa Mediator/Negosiator')
												{
													$negosiator++;
												}
												else
												{
													$pembela++;
												}
												
												if($row['status_progress'] == 'Selesai')
												{
													$selesai++;
												}
												else if($row['status_progress'] == 'Belum Selesai')
												{
													$belum++;
												}
												else if($row['status_progress'] == 'Gugur')
												{
													$gugur++;
												}
												else
												{
													$na++;
												}
											}  
										  }
										  else
										  {
											echo '<tr>';
											echo '<td class="" colspan="9">No Query Record Found</td>'; 
											echo '</tr>';
										  }	
                                          
                                      ?> 
                                  </tbody>
                                  
                              </table>
                            </div>
                        </div>
						<div class="row">
                            &nbsp;
                        </div>
						<div class="row">
                            <div class="col-md-12">
								<table class="table" id="identity">
									 <?php foreach($petugas->result_array() as $row) { ?>
										<tr class="tr-identity">
											<td width="200px">Pidana</td><td width="50px"><?php echo ':   '.$pidana; ?></td>
											<td width="200px">Perdata</td><td width="50px"><?php echo ':   '.$perdata; ?></td>
											<td width="200px">Tata Usaha Negara</td><td colspan="4"><?php echo ':   '.$tun; ?></td>
										</tr>
										<tr class="tr-identity">
											<td width="200px">Jasa Konsultasi</td><td width="50px"><?php echo ':   '.$konsultasi; ?></td>
											<td width="200px">Jasa Mediator/Negosiator</td><td width="50px"><?php echo ':   '.$negosiator; ?></td>
											<td width="200px">Jasa Kuasa/Pembela Hukum</td><td colspan="4"><?php echo ':   '.$pembela; ?></td>
										</tr>
										<tr class="tr-identity">
											<td width="200px">Selesai</td><td width="50px"><?php echo ':   '.$selesai; ?></td>
											<td width="200px">Belum Selesai</td><td width="50px"><?php echo ':   '.$belum; ?></td>
											<td width="200px">Gugur</td><td width="50px"><?php echo ':   '.$gugur; ?></td>
											<td width="200px">N/A (Belum Diproses)</td><td colspan="3"><?php echo ':   '.$na; ?></td>
										</tr>
										<tr class="tr-identity">
											<td width="200px">Total yang ditangani</td><td colspan="8">: <?php echo $no-1; ?></td>
										</tr>
									 <?php } ?>
                                </table>
							</div>
                        </div>    
                        
                    </div>
                    <div class="box-footer clearfix">
                        <div class "row no-print">
                            <button class="btn btn-default" onclick="PrintElem('#print_area')"><i class="fa fa-print"></i> Print</button>
							<!--
                            <button class="btn btn-primary pull-right" onclick="generate_xls()"><i class="fa fa-file-excel-o"></i> Generate XLS</button>
							-->
                        </div>
                    </div>
				</div>
            </div>  
          </div>
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
	include('report_by_penanganan_kasus_js.php');
	include('footer.php');
?>	
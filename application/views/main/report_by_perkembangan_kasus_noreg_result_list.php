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
            Report Data Perkembangan Kasus
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
                            <?php echo form_open('report/perkembangan_kasus_by_noreg', 'id="thisform" class="" enctype="multipart/form-data"'); ?>
                            <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Nomor Permohonan</label>
                                        <?php echo form_input('no_reg', '', 'id="no_reg" placeholder="Nomor Permohonan" class="form-control" maxlength="23"'); ?>
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
                                <table class="table" id="identity">
                                <?php foreach($report->result_array() as $row) { 
                                    $month = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                                    ?>
                                    <tr>
                                        <td class="" colspan="5"><strong>REPORT PERKEMBANGAN KASUS</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="" colspan="5"><strong>Nomor Permohonan : </strong><?php echo $row['no_reg']; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><strong>Tanggal Permohonan : </strong><?php echo $row['tgl_reg'].' '.$month[intval($row['bln_reg'])].' '.$row['thn_reg']; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td  width="20px">I.</td>
                                        <td colspan="4">IDENTITAS PEMOHON BANTUAN</td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td class="td-col-2">Nama Lengkap</td>
                                        <td colspan="3"><?php echo $row['nm_pemohon']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Jenis Kelamin</td>
                                        <td colspan="3"><?php echo $row['jkel']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Tempat & Tanggal Lahir</td>
                                        <td colspan="3"><?php echo $row['tmp_lahir'].', '.$row['tgl_lahir'].' '.$month[intval($row['bln_lahir'])].' '.$row['thn_lahir']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Alamat</td>
                                        <td colspan="3"><?php echo $row['alm_jalan'].' RT : '.$row['alm_rt'].' RW : '.$row['alm_rw']; ?></td>
                                    </tr> 
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width=""></td>
                                        <td colspan="3"><?php echo 'Desa/Kelurahan : '.$row['desa'].' Kecamatan : '.$row['kecamatan']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width=""></td>
                                        <td colspan="3"><?php echo 'Kabupaten/Kota : '.$row['kabkota'].' Provinsi : '.$row['provinsi']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Pekerjaan</td>
                                        <td colspan="3"><?php echo $row['pekerjaan']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Nomor HP</td>
                                        <td colspan="3"><?php echo $row['no_hp']; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td width="20px">II.</td>
                                        <td colspan="4">IDENTITAS PENERIMA BANTUAN</td>
                                    </tr >
                                    <?php if($row['status_pemohon'] == 'Ya') { ?> 
                                    <tr class="tr-identity">
                                        <td width=""></td>
                                        <td colspan="4">Pemohon adalah Penerima Bantuan</td>
                                    </tr>
                                    <?php } else {?>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Nama Lengkap</td>
                                        <td colspan="3"><?php echo $row['nm_penerima']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Jenis Kelamin</td>
                                        <td colspan="3"><?php echo $row['jkelb']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Tempat & Tanggal Lahir</td>
                                        <td colspan="3"><?php echo $row['tmp_lahirb'].', '.$row['tgl_lahirb'].' '.$month[intval($row['bln_lahirb'])].' '.$row['thn_lahirb']; ?></td>
                                    </tr class="tr-identity">
                                    <tr>
                                        <td></td>
                                        <td width="">Alamat</td>
                                        <td colspan="3"><?php echo $row['alm_jalanb'].' RT : '.$row['alm_rtb'].' RW : '.$row['alm_rwb']; ?></td>
                                    </tr> 
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width=""></td>
                                        <td colspan="3"><?php echo 'Desa/Kelurahan : '.$row['desab'].' Kecamatan : '.$row['kecamatanb']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width=""></td>
                                        <td colspan="3"><?php echo 'Kabupaten/Kota : '.$row['kabkotab'].' Provinsi : '.$row['provinsib']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Pekerjaan</td>
                                        <td colspan="3"><?php echo $row['pekerjaanb']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td width="">Nomor HP</td>
                                        <td colspan="3"><?php echo $row['no_hpb']; ?></td>
                                    </tr>
                                    <?php } ?>
                                     <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td>III.</td>
                                        <td colspan="4">IDENTITAS KASUS</td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td>Jenis Masalah Hukum</td>
                                        <td class="td-col-3"><?php echo $row['jenis_kasus']; ?></td>
                                        <td class="td-col-4">Kasus</td>
                                        <td colspan=""><?php echo $row['nama_kasus']; ?></td>
                                        
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td>Posisi Hukum</td>
                                        <td><?php echo $row['posisi_hukum']; ?></td>
                                        <td>Sifat Kasus</td>
                                        <td><?php echo $row['sifat_kasus']; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td>Betuk Layanan</td>
                                        <td><?php echo $row['bentuk_layanan']; ?></td>
                                        <td>Bentuk Kasus</td>
                                        <td><?php echo $row['bentuk_kasus']; ?></td>
                                    </tr> 
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td>Pembela Umum</td>
                                        <td><?php echo $row['nm_pembela']; ?></td>
                                        <td>Total Penerima Bantuan</td>
                                        <td><?php echo $row['total_penerima'].' Orang'; ?></td>
                                    </tr>
                                    <tr class="tr-identity">
                                        <td></td>
                                        <td>Asisten PU</td>
                                        <td><?php echo $row['nm_asisten']; ?></td>
                                        <td>Status</td>
                                        <td><?php echo $row['status_progress']; ?></td>
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
                              <?php if($progress->num_rows() > 0) {?>   
                              <table class="table table-bordered list">
                                  <thead>
                                      <tr>
                                          <th class="th-list">No</th>
                                          <th class="th-list">Tanggal</th>
                                          <th class="th-list">Status</th>
                                          <th class="th-list">Tahap Progress Akhir</th>
                                          <th class="th-list">Uraian</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                          $no = 1;
                                          foreach($progress->result_array() as $row)
                                          {
                                            echo '<tr>';
                                            echo '<td class="td-list kanan">'.$no++.'</td>'; 
                                            echo '<td class="td-list tengah">'.$row['tgl_progress'].'</td>'; 
                                            echo '<td class="td-list tengah">'.$row['status_progress'].'</td>'; 
                                            echo '<td class="td-list">'.$row['tahap_progress'].'</td>'; 
                                            echo '<td class="td-list">'.$row['description'].'</td>';
                                            echo '</tr>';
                                          }
                                      ?> 
                                  </tbody>
                                    
                              </table>
                              <?php } ?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <div class "row no-print">
                            <button class="btn btn-default" onclick="PrintElem('#print_area')"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
              </div>
            </div>  
          </div>
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
	include('report_by_perkembangan_kasus_noreg_js.php');
	include('footer.php');
?>	
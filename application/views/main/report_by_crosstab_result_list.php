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
            Cross Tabulation Report
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
                        <?php echo form_open('report/cross_tabulation', 'id="thisform" class="" enctype="multipart/form-data"'); ?>
                        <?php echo form_hidden('report_type', ''); ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">First Variable</label>
                                <?php echo form_dropdown('cross_type1', $cross_type, '', 'id="cross_type1" class="form-control chosen-select-deselect" data-placeholder="First Variable"'); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Second Variable</label>
                                <?php echo form_dropdown('cross_type2', $cross_type, '', 'id="cross_type2" class="form-control chosen-select-deselect" data-placeholder="Second Variable"'); ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-1">
                               <div class="form-group">
                                    <label class="control-label">Periode</label>
                                    <?php echo form_dropdown('cross_periode', $cross_periode, '', 'id="cross_periode" class="form-control chosen-select-deselect" data-placeholder="Periode"'); ?>
                                    <span class="help-block"></span>
                               </div>
                        </div>
                        
                        <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Tahun</label>
                                    <?php echo form_input('cross_tahun', '', 'id="cross_tahun" placeholder="Tahun" class="form-control numeric" maxlength="4"'); ?>
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
                                <h4><strong><?php //echo $judul; ?></strong></h4>
                            </div>
                        </div>    
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
									$arr = $report;
									$width = '100%';
									$count = count($arr);
									$index = 0;	
									
									if($count > 0)
									{
										reset($arr);
										$num = count(current($arr));
										
										$column =0;
										foreach(current($arr) as $key => $value)
										{
											$column++;
										}
										
										echo '<table class="table table-bordered">';
										echo '<thead>';
										/*
										echo '<tr>';
										echo '<th></th>';
										echo '<th colspan="'.($column-1).'">Test</th>';
										echo '</tr>';
										*/
										echo '<tr>';
			
										foreach(current($arr) as $key => $value)
										{
											echo '<th>';
											echo $value.'&nbsp;';
											echo '</th>';  
										} 
										echo '</tr></thead>';
										
										$curr_row = next($arr);
										
										echo '<tbody>';
										while ($curr_row = current($arr)) 
										{
											$index++;
										
											if($index == $count-1)
											{
												break;
											}
											else
											{
												echo '<tr>';
												$col = 1;
												while (false !== ($curr_field = current($curr_row))) 
												{
												   echo '<td class="tengah">';
												   echo $curr_field."&nbsp;";
												   echo "</td>\n";
												   next($curr_row);
												   $col++;
												}
												
												while($col <= $num)
												{
													echo '<td class="tengah">&nbsp;</td>';
													$col++;      
												}
												
												echo '</tr>';	
												next($arr);			
											}
										}
										echo '</tbody>';
										echo '<tfoot><tr>';
												
										foreach(end($arr) as $key => $value)
										{
											echo '<th>';
											echo $value.'&nbsp;';
											echo '</th>';  
										} 
												
										echo '</tr></tfoot>';
										
										echo '</table>';
										echo '<br/>';
									}
								?>
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
	include('report_by_crosstab_js.php');
	include('footer.php');
?>	
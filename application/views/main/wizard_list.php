<?php
	include('header.php');
?>	
	
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

<style>
	textarea { resize: vertical; }
</style>

<!-- Bootstrap WYSIHTML5 -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

			<li class=""><a href="<?php echo site_url(''); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
			
				
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li class="active"><a href="<?php echo site_url('permohonan'); ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Permohonan</span></a></li>
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
			
            <li class=""><a href="<?php echo site_url('file_manager'); ?>"><i class="fa fa-briefcase"></i> <span>Files Manager</span></a></li>
      
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
            Permohonan
            <small>Data Permohonan Bantuan Hukum</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Permohonan</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
					<?php if($id_role == 1 || $id_role == 2 || $id_role == 3 || $id_role == 4 || $id_role == 5 ) { ?>
						<button id="view_form_add" class="btn btn-primary" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Permohonan</button>
					<?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="Tbl_Permohonan" class="table table-bordered table-striped dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nomor Permohonan</th>
                        <th>Tanggal</th>
                        <th>Nama Pemohon</th>
						<th>Kabupaten/Kota</th>
						<!--
						<th>No. Handphone</th>
						-->
						<th>Status</th>
						<th>Pembela Umum</th>
                        <th>Process By</th>
						<th>Action</th>
                      </tr>
					  
                    </thead>
                    <tbody>
                      
                    </tbody>
                    <tfoot>
                      <tr>
						<!--
                        <th><input type="search" class="form-control" style="width:100%; padding: 3px; box-sizing: border-box;" placeholder="" /></th>
                        <th><input type="search" class="form-control" style="width:100%; padding: 3px; box-sizing: border-box;" placeholder="" /></th>
                        <th><input type="search" class="form-control" style="width:100%; padding: 3px; box-sizing: border-box;" placeholder="" /></th>
                        <th><input type="search" class="form-control" style="width:100%; padding: 3px; box-sizing: border-box;" placeholder="" /></th>
                        <th><input type="search" class="form-control" style="width:100%; padding: 3px; box-sizing: border-box;" placeholder="" /></th>
						-->
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<!--
						<th></th>
						-->
						<th></th>
						<th></th>
						<th></th>
						<th><a id="btnClear" class="btn">Clear Filtering</a></th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php
	include('wizard_js.php');
	include('wizard_form.php');
	include('wizard_upload_permohonan_form.php');
	include('wizard_view.php');
	include('wizard_kronologi.php');
	include('footer.php');
?>	
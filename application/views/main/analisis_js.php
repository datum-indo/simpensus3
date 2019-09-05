<script type="text/javascript">
	$(document).ready(function() {
		var Tbl_Analisis = $('#Tbl_Analisis').DataTable({
			"processing": true, //Feature control the processing indicator.
			"serverSide": true,

			"order": [
				[0, "desc"]
			],
			"ajax": {
				"url": "<?php echo site_url('analisis/ajax_list'); ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": [-1], //last column
				"orderable": false, //set not orderable

			}],
		});

		$('#btnClear').click(function() {
			$('input[type=search]').val('');
			Tbl_Analisis.search('').columns().search('').draw();
		});

		$('#tgl_kejadian').datetimepicker({
			format: 'DD/MM/YYYY'
		});

		$(".chosen-select").chosen();
		$(".chosen-select-deselect").chosen({
			allow_single_deselect: true,
			width: '100%'
		});



		$(".chosen-select").val('').trigger("chosen:updated");
		$(".chosen-select-deselect").val('').trigger("chosen:updated");

		$("input").change(function() {
			$(this).parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("textarea").change(function() {
			$(this).parent().removeClass('has-error');
			$(this).next().empty();
		});


		$("select").change(function() {
			$(this).parent().removeClass('has-error');
			//$(this).next().empty();
		});


		$('#total_penerima').prop('readonly', 'readonly');

		$('[name="id_permohonan"]').change(function() {
			$('.form-group').removeClass('has-error'); // clear error class
			$('.help-block').empty(); // clear error string

			var id_permohonan = $('[name="id_permohonan"]').val();
			if (id_permohonan != "") {
				$('[name="bentuk_kasus"]').chosen().chosenReadonly(false);
				$('[name="bentuk_kasus"]').val('').trigger('chosen:updated');

				$('[name="sifat_kasus"]').chosen().chosenReadonly(false);
				$('[name="sifat_kasus"]').val('').trigger('chosen:updated');

				$('#id_hak_terdampak').combotree('setValue', []);
				$('#id_hak_terdampak').combotree('enable');


				$('[name="id_issue_ham"]').chosen().chosenReadonly(true);
				$('[name="id_issue_ham"]').val('').trigger('chosen:updated');

				$('[name="issue_ham[]"]').chosen().chosenReadonly(true);
				$('[name="issue_ham[]"]').val('').trigger('chosen:updated');

				$('[name="tgl_kejadian"]').val('');
				$('[name="tgl_kejadian"]').prop({
					disabled: false
				});

				$('[name="id_provinsi"]').chosen().chosenReadonly(false);
				$('[name="id_provinsi"]').val('').trigger('chosen:updated');

				$('[name="id_penghasilan"]').chosen().chosenReadonly(true);
				$('[name="id_penghasilan"]').val('').trigger('chosen:updated');

				$('[name="id_kategori_korban"]').chosen().chosenReadonly(false);
				$('[name="id_kategori_korban"]').val('').trigger('chosen:updated');

				$('[name="id_kategori_pelaku"]').chosen().chosenReadonly(true);
				$('#id_jenis_pelaku').combotree('setValue', []);
				$('[name="id_kategori_pelaku"]').val('').trigger('chosen:updated');

				$('[name="lk_dewasa"]').val('');
				$('[name="lk_dewasa"]').prop({
					disabled: false
				});

				$('[name="pr_dewasa"]').val('');
				$('[name="pr_dewasa"]').prop({
					disabled: false
				});

				$('[name="lk_anak"]').val('');
				$('[name="lk_anak"]').prop({
					disabled: false
				});

				$('[name="pr_anak"]').val('');
				$('[name="pr_anak"]').prop({
					disabled: false
				});

				$('[name="total_penerima"]').val('0');

				$('[name="uu_lbh"]').val('');
				$('[name="uu_lbh"]').prop({
					disabled: false
				});

				$('[name="uu_lawan"]').val('');
				$('[name="uu_lawan"]').prop({
					disabled: false
				});

				$('[name="keterangan"]').val('');
				$('[name="keterangan"]').prop({
					disabled: false
				});

			} else {
				$('[name="bentuk_kasus"]').chosen().chosenReadonly(true);
				$('[name="bentuk_kasus"]').val('').trigger('chosen:updated');

				$('[name="sifat_kasus"]').chosen().chosenReadonly(true);
				$('[name="sifat_kasus"]').val('').trigger('chosen:updated');

				$('#id_hak_terdampak').combotree('setValue', []);


				$('[name="id_issue_ham"]').chosen().chosenReadonly(true);
				$('[name="id_issue_ham"]').val('').trigger('chosen:updated');

				$('[name="issue_ham[]"]').chosen().chosenReadonly(true);
				$('[name="issue_ham[]"]').val('').trigger('chosen:updated');

				$('[name="tgl_kejadian"]').val('');
				$('[name="tgl_kejadian"]').prop({
					disabled: true
				});

				$('[name="id_provinsi"]').chosen().chosenReadonly(true);
				$('[name="id_provinsi"]').val('').trigger('chosen:updated');

				var _id_kabkota = $('select[name="id_kabkota"]');
				$('#id_kabkota').empty();
				_id_kabkota.prop({
					disabled: true
				});
				$('#id_kabkota').append('<option value=""></option>');
				$('#id_kabkota').trigger('chosen:updated');

				$('[name="id_kategori_korban"]').chosen().chosenReadonly(true);
				$('[name="id_kategori_korban"]').val('').trigger('chosen:updated');

				$('[name="id_kategori_pelaku"]').chosen().chosenReadonly(true);
				$('[name="id_kategori_pelaku"]').val('').trigger('chosen:updated');

				$('[name="id_penghasilan"]').chosen().chosenReadonly(true);
				$('[name="id_penghasilan"]').val('').trigger('chosen:updated');

				$('[name="lk_dewasa"]').val('');
				$('[name="lk_dewasa"]').prop({
					disabled: true
				});

				$('[name="pr_dewasa"]').val('');
				$('[name="pr_dewasa"]').prop({
					disabled: true
				});

				$('[name="lk_anak"]').val('');
				$('[name="lk_anak"]').prop({
					disabled: true
				});

				$('[name="pr_anak"]').val('');
				$('[name="pr_anak"]').prop({
					disabled: true
				});

				$('[name="total_penerima"]').val('0');

				$('[name="uu_lbh"]').val('');
				$('[name="uu_lbh"]').prop({
					disabled: true
				});

				$('[name="uu_lawan"]').val('');
				$('[name="uu_lawan"]').prop({
					disabled: true
				});

				$('[name="keterangan"]').val('');
				$('[name="keterangan"]').prop({
					disabled: true
				});
			}
		});

		var _id_provinsi = $('select[name="id_provinsi"]');
		var _id_kabkota = $('select[name="id_kabkota"]');
		_id_kabkota.children().remove().end();
		_id_kabkota.prop({
			disabled: true
		});
		_id_kabkota.trigger('chosen:updated');

		$('#id_provinsi').change(function() {
			var id_provinsi = $('#id_provinsi').val();
			if (id_provinsi != "") {
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('analisis/get_kabkota'); ?>/" + id_provinsi,
					success: function(kabkota) {
						$('#id_kabkota').empty();
						_id_kabkota.append('<option value=""></option>');
						$.each(kabkota, function(id_kabkota, nm_kabkota) {
							var opt = $('<option />');
							opt.val(id_kabkota);
							opt.text(nm_kabkota);
							_id_kabkota.append(opt);
						});
						_id_kabkota.prop({
							disabled: false
						});
						_id_kabkota.trigger('chosen:updated');

					}
				});
			} else {
				$('#id_kabkota').empty();
				_id_kabkota.prop({
					disabled: true
				});
				$('#id_kabkota').append('<option value=""></option>');
				$('#id_kabkota').trigger('chosen:updated');

			}
		});

		$('[name="bentuk_kasus"]').change(function() {
			if ($(this).val() == "Kelompok") {
				$('[name="id_penghasilan"]').prop({
					disabled: false
				});
				$('[name="id_penghasilan"]').chosen().chosenReadonly(false);
				$('[name="id_penghasilan"]').val('').trigger('chosen:updated');
			} else if ($(this).val() == "Individu") {
				$('[name="id_penghasilan"]').prop({
					disabled: false
				});
				$('[name="id_penghasilan"]').chosen().chosenReadonly(true);
				$('[name="id_penghasilan"]').val('').trigger('chosen:updated');
			} else {
				$('[name="id_penghasilan"]').prop({
					disabled: false
				});
				$('[name="id_penghasilan"]').chosen().chosenReadonly(true);
				$('[name="id_penghasilan"]').val('').trigger('chosen:updated');
			}
		});

		$('[name="sifat_kasus"]').change(function() {
			if ($(this).val() == "Non-Struktural") {
				$('[name="id_issue_ham"]').chosen().chosenReadonly(true);
				$('[name="id_issue_ham"]').val('').trigger('chosen:updated');

				$('[name="issue_ham[]"]').chosen().chosenReadonly(true);
				$('[name="issue_ham[]"]').val('').trigger('chosen:updated');

				$('[name="id_kategori_pelaku"]').chosen().chosenReadonly(true);
				$('[name="id_kategori_pelaku"]').val('').trigger('chosen:updated');
			} else if ($(this).val() == "Struktural") {
				$('[name="id_issue_ham"]').chosen().chosenReadonly(false);
				$('[name="id_issue_ham"]').val('').trigger('chosen:updated');

				$('[name="issue_ham[]"]').chosen().chosenReadonly(false);
				$('[name="issue_ham[]"]').val('').trigger('chosen:updated');

				$('[name="id_kategori_pelaku"]').chosen().chosenReadonly(false);
				$('[name="id_kategori_pelaku"]').val('').trigger('chosen:updated');
			} else {
				$('[name="id_issue_ham"]').chosen().chosenReadonly(true);
				$('[name="id_issue_ham"]').val('').trigger('chosen:updated');

				$('[name="issue_ham[]"]').chosen().chosenReadonly(true);
				$('[name="issue_ham[]"]').val('').trigger('chosen:updated');

				$('[name="id_kategori_pelaku"]').chosen().chosenReadonly(true);
				$('[name="id_kategori_pelaku"]').val('').trigger('chosen:updated');
			}
		});


		$('#lk_dewasa').on('input', function() {
			var total = (+$('#lk_dewasa').val()) + (+$('#pr_dewasa').val()) + (+$('#lk_anak').val()) + (+$('#pr_anak').val());
			$('#total_penerima').val(total);
		});

		$('#pr_dewasa').on('input', function() {
			var total = (+$('#lk_dewasa').val()) + (+$('#pr_dewasa').val()) + (+$('#lk_anak').val()) + (+$('#pr_anak').val());
			$('#total_penerima').val(total);
		});

		$('#lk_anak').on('input', function() {
			var total = (+$('#lk_dewasa').val()) + (+$('#pr_dewasa').val()) + (+$('#lk_anak').val()) + (+$('#pr_anak').val());
			$('#total_penerima').val(total);
		});

		$('#pr_anak').on('input', function() {
			var total = (+$('#lk_dewasa').val()) + (+$('#pr_dewasa').val()) + (+$('#lk_anak').val()) + (+$('#pr_anak').val());
			$('#total_penerima').val(total);
		});

	});

	function add() {
		save_method = 'add';

		var formData = {
			type: 'analisis'
		}
		$.ajax({
			url: "<?php echo site_url('analisis/ajax_new/') ?>/",
			type: "GET",
			dataType: "JSON",
			data: formData,
			success: function(response) {
				$('.form-group').removeClass('has-error'); // clear error class
				$('.help-block').empty(); // clear error string

				var _id_permohonan = $('[name="id_permohonan"]');
				var analisis = response[0];
				var approval = response[1];

				$('#id_permohonan').empty();
				_id_permohonan.append('<option value=""></option>');
				$.each(approval, function(id_permohonan, no_reg) {
					var opt = $('<option />');
					opt.val(id_permohonan);
					opt.text(no_reg);
					_id_permohonan.append(opt);
				});
				_id_permohonan.chosen().chosenReadonly(false);
				_id_permohonan.trigger('chosen:updated');

				$('[name="id_permohonan"]').val(analisis.id_permohonan).trigger('chosen:updated');

				$('[name="bentuk_kasus"]').chosen().chosenReadonly(true);
				$('[name="bentuk_kasus"]').val(analisis.bentuk_kasus).trigger('chosen:updated');

				$('[name="sifat_kasus"]').chosen().chosenReadonly(true);
				$('[name="sifat_kasus"]').val(analisis.sifat_kasus).trigger('chosen:updated');

				$('[name="id_issue_ham"]').chosen().chosenReadonly(true);
				$('[name="id_issue_ham"]').val(analisis.id_issue_ham).trigger('chosen:updated');

				$('#id_hak_terdampak').combotree('setValue', []);




				$('[name="issue_ham[]"]').chosen().chosenReadonly(true);
				$('[name="issue_ham[]"]').val(analisis.issue_ham).trigger('chosen:updated');

				$('[name="tgl_kejadian"]').val('');
				$('[name="tgl_kejadian"]').prop({
					disabled: true
				});

				$('[name="id_provinsi"]').chosen().chosenReadonly(true);
				$('[name="id_provinsi"]').val('').trigger('chosen:updated');

				var _id_kabkota = $('select[name="id_kabkota"]');
				$('#id_kabkota').empty();
				_id_kabkota.prop({
					disabled: true
				});
				$('#id_kabkota').append('<option value=""></option>');
				$('#id_kabkota').trigger('chosen:updated');

				$('[name="id_kategori_korban"]').chosen().chosenReadonly(true);
				$('[name="id_kategori_korban"]').val(analisis.id_kategori_korban).trigger('chosen:updated');

				$('[name="id_kategori_pelaku"]').chosen().chosenReadonly(true);
				$('[name="id_kategori_pelaku"]').val(analisis.id_kategori_pelaku).trigger('chosen:updated');


				$('[name="id_penghasilan"]').chosen().chosenReadonly(true);
				$('[name="id_penghasilan"]').val(analisis.id_penghasilan).trigger('chosen:updated');

				$('[name="lk_dewasa"]').val(analisis.lk_dewasa);
				$('[name="lk_dewasa"]').prop({
					disabled: true
				});

				$('[name="pr_dewasa"]').val(analisis.pr_dewasa);
				$('[name="pr_dewasa"]').prop({
					disabled: true
				});

				$('[name="lk_anak"]').val(analisis.lk_anak);
				$('[name="lk_anak"]').prop({
					disabled: true
				});

				$('[name="pr_anak"]').val(analisis.pr_anak);
				$('[name="pr_anak"]').prop({
					disabled: true
				});

				$('[name="total_penerima"]').val(analisis.total_penerima);

				$('[name="uu_lbh"]').val(analisis.uu_lbh);
				$('[name="uu_lbh"]').prop({
					disabled: true
				});

				$('[name="uu_lawan"]').val(analisis.uu_lawan);
				$('[name="uu_lawan"]').prop({
					disabled: true
				});

				$('[name="keterangan"]').val(analisis.keterangan);
				$('[name="keterangan"]').prop({
					disabled: true
				});

				$('#form-analisis').modal({
					backdrop: 'static',
					keyboard: false
				})
				$('#form-analisis').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Analisis'); // Set title to Bootstrap modal title
				$('.modal-subtitle').text('Data Analisis Bantuan Hukum'); // Set title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				window.location = '<?php echo site_url(''); ?>';
			}
		});
	}

	function save() {
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		var url;

		var formData = {
			csrf_token: $('[name="csrf_token"]').val(),
			id_analisis: $('[name="id_analisis"]').val(),
			id_permohonan: $('[name="id_permohonan"]').val(),
			sifat_kasus: $('[name="sifat_kasus"]').val(),
			id_issue_ham: $('[name="id_issue_ham"]').val(),
			issue_ham: $('[name="issue_ham[]"]').val(),
			tgl_kejadian: $('[name="tgl_kejadian"]').val(),
			id_provinsi: $('[name="id_provinsi"]').val(),
			id_kabkota: $('[name="id_kabkota"]').val(),
			uu_lbh: $('[name="uu_lbh"]').val(),
			id_hak_terdampak: $('#id_hak_terdampak').combotree('getValues'),
			id_jenis_pelaku: $('#id_jenis_pelaku').combotree('getValues'),
			id_jenis_peradilan: $('#id_jenis_peradilan').combotree('getValue'),
			uu_lawan: $('[name="uu_lawan"]').val(),
			bentuk_kasus: $('[name="bentuk_kasus"]').val(),
			lk_dewasa: $('[name="lk_dewasa"]').val(),
			pr_dewasa: $('[name="pr_dewasa"]').val(),
			lk_anak: $('[name="lk_anak"]').val(),
			pr_anak: $('[name="pr_anak"]').val(),
			total_penerima: $('[name="total_penerima"]').val(),
			id_penghasilan: $('[name="id_penghasilan"]').val(),
			id_kategori_korban: $('[name="id_kategori_korban"]').val(),
			id_kategori_pelaku: $('[name="id_kategori_pelaku"]').val(),
			keterangan: $('[name="keterangan"]').val()
		};


		if (save_method == 'add') {
			url = "<?php echo site_url('analisis/ajax_save'); ?>";
		} else {
			url = "<?php echo site_url('analisis/ajax_update'); ?>";
		};

		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			dataType: "JSON",
			success: function(data) {
				if (data.status) //if success close modal and reload ajax table
				{

					$('#form-analisis').modal('hide');
					reload_table();
					$('[name="csrf_token"]').val(data.csrf_token);
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						//$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}
			},
			complete: function() {

			},
			error: function(jqXHR, textStatus, errorThrown) {
				window.location = '<?php echo site_url('analisis'); ?>';
			}
		});

	}

	function edit(id_permohonan) {
		$('#formAnalisis')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		save_method = 'update';

		$.ajax({
			url: "<?php echo site_url('analisis/get_detail_analisis') ?>/" + id_permohonan,
			type: "GET",
			dataType: "JSON",
			success: function(response) {
				var analisis = response[0];
				$('[name="id_analisis"]').val(analisis.id_analisis);
				$('[name="id_permohonan"]').val(analisis.id_permohonan).trigger('chosen:updated');

				$('#id_jenis_peradilan').combotree().click();
				$('#id_jenis_peradilan').combotree('setValue', analisis.id_jenis_peradilan);
				var permohonan = response[1];
				var _id_permohonan = $('[name="id_permohonan"]');

				$('#id_permohonan').empty();

				$.each(permohonan, function(id_permohonan, detail_permohonan) {
					var opt = $('<option />');
					opt.val(id_permohonan);
					opt.text(detail_permohonan);
					_id_permohonan.append(opt);
				});

				_id_permohonan.chosen().chosenReadonly(true);
				_id_permohonan.trigger('chosen:updated');

				var issue_ham = response[2];
				var issue = issue_ham.issue_ham;

				if (response[4].length > 0) {
					$('#id_hak_terdampak').combotree('enable');
				}


				$('#id_hak_terdampak').combotree().click();
				console.log(response[4])
				$('#id_hak_terdampak').combotree('setValue', response[4])

				$('#id_jenis_pelaku').combotree().click();
				console.log(response[5])
				$('#id_jenis_pelaku').combotree('setValue', response[5])

				$('[name="bentuk_kasus"]').chosen().chosenReadonly(false);
				$('[name="bentuk_kasus"]').val(analisis.bentuk_kasus).trigger('chosen:updated');

				$('[name="sifat_kasus"]').chosen().chosenReadonly(false);
				$('[name="sifat_kasus"]').val(analisis.sifat_kasus).trigger('chosen:updated');

				if (analisis.sifat_kasus == 'Non-Struktural') {

					$('[name="id_issue_ham"]').chosen().chosenReadonly(true);
					$('[name="id_issue_ham"]').val(analisis.id_issue_ham).trigger('chosen:updated');

					$('[name="issue_ham[]"]').chosen().chosenReadonly(true);
					$('[name="issue_ham[]"]').val('').trigger('chosen:updated');

					$('[name="id_kategori_pelaku"]').chosenReadonly(true);
					$('[name="id_kategori_pelaku"]').val(analisis.id_kategori_pelaku).trigger('chosen:updated');
				} else {
					$('[name="id_issue_ham"]').chosen().chosenReadonly(false);
					$('[name="id_issue_ham"]').val(analisis.id_issue_ham).trigger('chosen:updated');

					var issue = issue.replace(/0/g, "");

					$('#issue_ham').val(issue.split(','));
					$('#issue_ham').chosen().chosenReadonly(false);
					$('#issue_ham').trigger('chosen:updated');

					$('[name="id_kategori_pelaku"]').chosenReadonly(false);
					$('[name="id_kategori_pelaku"]').val(analisis.id_kategori_pelaku).trigger('chosen:updated');
				}

				$('[name="tgl_kejadian"]').prop({
					disabled: false
				});
				$('[name="tgl_kejadian"]').val(analisis.tgl_kejadian);

				$('[name="id_provinsi"]').chosenReadonly(false);
				$('[name="id_provinsi"]').val(analisis.id_provinsi).trigger('chosen:updated');

				var kabkota = response[3];
				var _id_kabkota = $('select[name="id_kabkota"]');
				$('#id_kabkota').empty();
				_id_kabkota.append('<option value=""></option>');
				$.each(kabkota, function(id_kabkota, nm_kabkota) {
					var opt = $('<option />');
					opt.val(id_kabkota);
					opt.text(nm_kabkota);
					_id_kabkota.append(opt);
				});
				_id_kabkota.prop({
					disabled: false
				});
				_id_kabkota.trigger('chosen:updated');

				$('[name="id_kabkota"]').val(analisis.id_kabkota).trigger("chosen:updated");

				if (analisis.bentuk_kasus == 'Kelompok') {
					$('[name="id_penghasilan"]').chosen().chosenReadonly(false);
					$('[name="id_penghasilan"]').val(analisis.id_penghasilan).trigger('chosen:updated');
				} else {
					$('[name="id_penghasilan"]').chosen().chosenReadonly(true);
					$('[name="id_penghasilan"]').val(analisis.id_penghasilan).trigger('chosen:updated');
				}


				$('[name="id_kategori_korban"]').chosen().chosenReadonly(false);
				$('[name="id_kategori_korban"]').val(analisis.id_kategori_korban).trigger('chosen:updated');

				$('[name="lk_dewasa"]').val(analisis.lk_dewasa);
				$('[name="lk_dewasa"]').prop({
					disabled: false
				});

				$('[name="pr_dewasa"]').val(analisis.pr_dewasa);
				$('[name="pr_dewasa"]').prop({
					disabled: false
				});

				$('[name="lk_anak"]').val(analisis.lk_anak);
				$('[name="lk_anak"]').prop({
					disabled: false
				});

				$('[name="pr_anak"]').val(analisis.pr_anak);
				$('[name="pr_anak"]').prop({
					disabled: false
				});

				$('[name="total_penerima"]').val(analisis.total_penerima);

				$('[name="uu_lbh"]').val(analisis.uu_lbh);
				$('[name="uu_lbh"]').prop({
					disabled: false
				});

				$('[name="uu_lawan"]').val(analisis.uu_lawan);
				$('[name="uu_lawan"]').prop({
					disabled: false
				});

				$('[name="keterangan"]').val(analisis.keterangan);
				$('[name="keterangan"]').prop({
					disabled: false
				});

				$('#form-analisis').modal({
					backdrop: 'static',
					keyboard: false
				})
				$('#form-analisis').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Analisis'); // Set title to Bootstrap modal title
				$('.modal-subtitle').text('Data Analisis Bantuan Hukum');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				window.location = '<?php echo site_url(''); ?>';
			}
		});
	}

	function view(id_permohonan) {
		$('#dd_no_reg').empty();
		$('#dd_tgl_reg').empty();
		$('#dd_id_pemohon').empty();
		$('#dd_tgl_analisis').empty();
		$('#dd_sifat_kasus').empty();
		$('#dd_id_issue_ham').empty();
		$('#dd_issue_ham').empty();
		$('#dd_tgl_kejadian').empty();
		$('#dd_nm_provinsi').empty();
		$('#dd_nm_kabkota').empty();
		$('#dd_uu_lbh').empty();
		$('#dd_uu_lawan').empty();
		$('#dd_bentuk_kasus').empty();
		$('#dd_id_hak_terdampak').empty();
		$('#dd_jenis_peradilan').empty();
		$('#dd_id_jenis_pelaku').empty();
		$('#dd_lk_dewasa').empty();
		$('#dd_pr_dewasa').empty();
		$('#dd_lk_anak').empty();
		$('#dd_pr_anak').empty();
		$('#dd_total_penerima').empty();
		$('#dd_penghasilan').empty();
		$('#dd_kategori_korban').empty();
		$('#dd_kategori_pelaku').empty();
		$('#dd_keterangan').empty();

		$.ajax({
			url: "<?php echo site_url('analisis/view_detail_analisis') ?>/" + id_permohonan,
			type: "GET",
			dataType: "JSON",
			success: function(response) {
				var analisis = response[0];

				var issue_ham = response[1];

				$('#dd_no_reg').append(analisis.no_reg);
				$('#dd_tgl_reg').append(analisis.tgl_reg);
				$('#dd_id_pemohon').append(analisis.nm_pemohon);
				$('#dd_tgl_analisis').append(analisis.tgl_analisis);
				$('#dd_sifat_kasus').append(analisis.sifat_kasus);

				if (analisis.jenis_peradilan) {
					$('#dd_jenis_peradilan').append(analisis.jenis_peradilan);
				}

				if (analisis.sifat_kasus == 'Non-Struktural') {
					$('#dd_id_issue_ham_box').hide();
					$('#dd_id_issue_ham').empty();

					$('#dd_issue_ham_box').hide();
					$('#dd_issue_ham').empty();
				} else {
					$('#dd_id_issue_ham_box').show();
					$('#dd_id_issue_ham').append(analisis.issue_ham);

					var issue = issue_ham.issue_ham;
					var issue = issue.replace(",", "\n");
					//var issuey = issuex.replace(/,/g, "<br>");

					$('#dd_issue_ham_box').show();
					$('#dd_issue_ham').append(issue.replace(/,/g, "<br>"));
				}

				if (response[2].length != 0) {
					console.log(response[2])
					var appendText = ""
					let b = 1
					for (let a of response[2]) {

						appendText += (b.toString() + ". " + a + "\n" + " <br>")
						b++
					}
					$('#dd_id_hak_terdampak').show()
					$('#dd_id_hak_terdampak').append(appendText);
				} else {
					$('#dd_hak_box').hide()
				}

				if (response[3].length != 0) {
					console.log(response[3])
					var appendText = ""
					let b = 1
					for (let a of response[2]) {

						appendText += (b.toString() + ". " + a + "\n" + " <br>")
						b++
					}
					$('#dd_id_jenis_pelaku').show()
					$('#dd_id_jenis_pelaku').append(appendText);
				} else {
					$('#dd_pelaku_box').hide()
				}

				$('#dd_tgl_kejadian').append(analisis.tgl_kejadian);
				$('#dd_nm_provinsi').append(analisis.nm_provinsi);
				$('#dd_nm_kabkota').append(analisis.nm_kabkota);

				$('#dd_uu_lbh').append(analisis.uu_lbh);
				$('#dd_uu_lawan').append(analisis.uu_lawan);
				$('#dd_bentuk_kasus').append(analisis.bentuk_kasus);
				$('#dd_lk_dewasa').append(analisis.lk_dewasa + ' Orang');
				$('#dd_pr_dewasa').append(analisis.pr_dewasa + ' Orang');
				$('#dd_lk_anak').append(analisis.lk_anak + ' Orang');
				$('#dd_pr_anak').append(analisis.pr_anak + ' Orang');
				$('#dd_total_penerima').append(analisis.total_penerima + ' Orang');
				$('#dd_penghasilan').append(analisis.penghasilan);
				$('#dd_kategori_korban').append(analisis.kategori_korban);
				$('#dd_kategori_pelaku').append(analisis.kategori_pelaku);
				$('#dd_keterangan').append(analisis.keterangan);

				$('#view-analisis').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Analisis'); // Set title to Bootstrap modal title
				$('.modal-subtitle').text('Data Analisis Bantuan Hukum');
			},
			error: function(jqXHR, textStatus, errorThrown) {
				window.location = '<?php echo site_url(''); ?>';
			}
		});

	}

	function del(id_permohonan) {
		if (confirm('Are you sure delete this data?')) {
			var formData = {
				id_permohonan: id_permohonan
			}

			$.ajax({
				url: "<?php echo site_url('analisis/ajax_delete') ?>",
				type: "POST",
				data: formData,
				dataType: "JSON",
				success: function(data) {
					//if success reload ajax table
					$('#form-analisis').modal('hide');
					reload_table();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error deleting data');
				}
			});

		}
	}

	function reload_table() {
		var Tbl_Analisis = $('#Tbl_Analisis').DataTable();
		Tbl_Analisis.ajax.reload(null, false); //reload datatable ajax 
	}
</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="form-freq" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<div class="form-body">
						<?php echo form_open('#', 'id="form_freq" class="" enctype="multipart/form-data"'); ?>
							<div class="col-lg-5">
								<div class="form-group">
									<label class="control-label">Berdasarkan</label>
									<?php echo form_dropdown('freq_type', $freq_type, '', 'id="freq_type" class="form-control chosen-select-deselect" data-placeholder="Periode"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label class="control-label">Periode</label>
									<?php echo form_dropdown('freq_periode', $extract_periode, '', 'id="freq_periode" class="form-control chosen-select-deselect" data-placeholder="Periode"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group">
									<label class="control-label">Tahun</label>
									<?php echo form_input('freq_tahun', '', 'id="freq_tahun" placeholder="Tahun" class="form-control numeric" maxlength="4"'); ?>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="col-lg-2">
								<label style="width: 100%;" class="control-label pull-right" >&nbsp;</label>
								<div class="">	
									<button type="button" id="btnSave" onclick="submit_freq()" class="btn btn-danger pull-right">Generate</button>
								</div>	
							</div>
						<?php echo form_close();?>
					</div>
				</div>
				<div class="row" style="border-top: 1px solid #f4f4f4;" id="freq_result_box">
					<div class="col-lg-12">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th class="col-lg-6">Description</th>
									<th style="text-align:right">Count</th>
									<th class="col-lg-3" style="text-align:right">Frequency</th>
								</tr>
							</thead>
							<tbody id="freq_result">
								<?php /*
								foreach($frequency->result_array() as $row)
								{
									echo '<tr>';
									echo '<td class="col-lg-6">'.$row['description'].'</td>';
									echo '<td class="">'.$row['jumlah'].'</td>';
									echo '<td class="col-lg-3">'.$row['freq'].'</td>';
									echo '</tr>';
								} */
								?>
								<tr>
									<td class="col-lg-6">Name</td>
									<td>Count</td>
									<td class="col-lg-3">Frequency</td>
								</tr>
							</tbody>
							<tfoot id="freq_total">
								<tr>
									<td class="col-lg-6">Total</td>
									<td></td>
									<td class="col-lg-3">100.000%</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>	
            </div>
			
			<div class="modal-footer">
				<!--
				<button type="button" id="btnSave" onclick="submit_freq()" class="btn btn-danger">Generate & Download</button>
				-->
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
			
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->		
<script type="text/javascript">

</script>		
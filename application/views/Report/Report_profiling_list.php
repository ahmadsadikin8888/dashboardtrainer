<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('datatables,icheck,selectize,multiselect') ?>
<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">FILTER
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">

					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Mulai Dari</label>
							<input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Sampai </label>
							<input type='date' min="<?php echo date("Y-m-d", strtotime("-" . (date('d') + 15) . " days")); ?>" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Agent </label>
							<select name='agentid[]' id="agentid" class="form-control custom-select" multiple="multiple">
								<?php
								if ($user_categori != 8) {
								?>
									<option value="0">--Semua Agent--</option>
								<?php
								}
								if ($list_agent['num'] > 0) {
									foreach ($list_agent['results'] as $d_agent) {
										$selected = "";
										if (isset($_GET['agentid'])) {

											if (count($_GET['agentid']) > 1) {

												foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
													if ($v_agentid == $d_agent->agentid) {
														$selected = 'selected';
													}
												}
											} else {
												$selected = ($d_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
											}
										}
										echo "<option value='" . $d_agent->agentid . "' " . $selected . ">" . $d_agent->agentid . "-" . $d_agent->nama . "</option>";
									}
								}
								?>

							</select>
						</div>
					</div>


					<div class='col-md-12 col-xl-12'>

						<div class='form-group'>
							<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
						</div>

					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?php

if (isset($_GET['start']) && isset($_GET['end'])) {


?>
	<div class='col-md-6 col-xl-6'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table' style="text-align:center;">
					<small>
						<table width="100%">
							<thead>
								<tr>
									<th colspan='6' style="background-color:green;color:white;">CONTACTED</th>
								</tr>
								<tr>
									<th>LAYANAN</th>
									<th>JML AGENT</th>
									<th>AGREE</th>
									<th>FU</th>
									<th>DECLINE</th>
									<th>PPA</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th style="text-align:left;">CT-0</th>
									<th><?php echo number_format($total['cto']['duty']) ?></th>
									<th><?php echo number_format($total['cto']['agree']) ?></th>
									<th><?php echo number_format($total['cto']['followup']) ?></th>
									<th><?php echo number_format($total['cto']['decline']) ?></th>
									<th><?php echo number_format($total['cto']['agree'] / $total['cto']['duty']) ?></th>
								</tr>
								<tr>
									<th style="text-align:left;">PraNPC</th>
									<th><?php echo number_format($total['pranpc']['duty']) ?></th>
									<th><?php echo number_format($total['pranpc']['agree']) ?></th>
									<th><?php echo number_format($total['pranpc']['followup']) ?></th>
									<th><?php echo number_format($total['pranpc']['decline']) ?></th>
									<th><?php echo number_format($total['pranpc']['agree'] / $total['pranpc']['duty']) ?></th>
								</tr>
								<tr>
									<th style="text-align:left;">ALL</th>
									<th><?php echo number_format($total['duty']) ?></th>
									<th><?php echo number_format($total['agree']) ?></th>
									<th><?php echo number_format($total['followup']) ?></th>
									<th><?php echo number_format($total['decline']) ?></th>
									<th><?php echo number_format($total['agree'] / $total['duty']) ?></th>

								</tr>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>
	<div class='col-md-6 col-xl-6'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class='box-body table-responsive' id='box-table' style="text-align:center;">
					<small>
						<table width="100%">
							<thead>
								<tr>
									<th colspan='6' style="background-color:red;color:white;">NOT CONTACTED</th>
								</tr>
								<tr>
									<th>RNA</th>
									<th>Invalid Number</th>
									<th>Line Busy</th>
									<th>Mail Box</th>
									<th>Other</th>
									<th>Order call</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th><?php echo number_format($total['dc1']) ?></th>
									<th><?php echo number_format($total['dc3']) ?></th>
									<th><?php echo number_format($total['dc2']) ?></th>
									<th><?php echo number_format($total['dc5']) ?></th>
									<th><?php echo number_format($total['dc4'] + $total['dc6'] + $total['dc7'] + $total['dc8'] + $total['dc9']) ?></th>
									<th><?php echo number_format($total['contacted'] + $total['uncontacted']) ?></th>
								</tr>

							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>
	<?php
	if ($level != 8) {


	?>
		<div class='col-md-12 col-xl-12'>
			<div class="card">
				<div class="card-status bg-orange"></div>
				<div class="card-header">
					<div class="card-options">
						<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class='box-body table-responsive' id='box-table' style="text-align:center;">
						<small>
							<table width="100%">
								<thead>
									<tr>
										<th colspan='7' style="background-color:blue;color:white;">REGIONAL</th>
									</tr>
									<tr>
										<th>Reg 1</th>
										<th>Reg 2</th>
										<th>Reg 3</th>
										<th>Reg 4</th>
										<th>Reg 5</th>
										<th>Reg 6</th>
										<th>Reg 7</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th><?php echo number_format($regional['I']) ?></th>
										<th><?php echo number_format($regional['II']) ?></th>
										<th><?php echo number_format($regional['III']) ?></th>
										<th><?php echo number_format($regional['IV']) ?></th>
										<th><?php echo number_format($regional['V']) ?></th>
										<th><?php echo number_format($regional['VI']) ?></th>
										<th><?php echo number_format($regional['VII']) ?></th>
									</tr>
								</tbody>
							</table>
						</small>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report Call Periode <?php echo $_GET['start'] . " sd " . $_GET['start'] ?>

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<table width="100%">
					<tr>
						<td width="50%">

						</td>
						<td width="50%">

						</td>
					</tr>
				</table>


				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table' id="report_table_reg">
							<thead>
								<tr>
									<th><b>No</b></th>
									<th nowrap><b>Nama Agent</b></th>
									<th nowrap><b>User ID</b></th>
									<!-- <th nowrap><b>Kategori</b></th> -->
									<th style="background-color:green;color:white;"><b>Agree</b></th>
									<th style="background-color:green;color:white;"><b>FU</b></th>
									<th style="background-color:green;color:white;"><b>Decline</b></th>
									<th style="background-color:red;color:white;"><b>RNA</b></th>
									<th style="background-color:red;color:white;"><b>Busy</b></th>
									<th style="background-color:red;color:white;"><b>Invalid</b></th>
									<th style="background-color:red;color:white;"><b>Rejected</b></th>
									<th style="background-color:red;color:white;"><b>MB</b></th>
									<th style="background-color:red;color:white;"><b>Fax</b></th>
									<th style="background-color:red;color:white;"><b>Isolir</b></th>
									<th style="background-color:red;color:white;"><b>SS</b></th>
									<th style="background-color:red;color:white;"><b>NOU</b></th>
									<th style="background-color:blue;color:white;"><b>TOTAL</b></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								if ($agent > 0) {

									foreach ($agent as $agentid => $ag) {
										if ($ag['data']->agentid != "") {


								?>
											<tr>
												<td><?php echo $no; ?></td>
												<td style="text-align:left;" nowrap><?php echo $ag['data']->nama; ?></td>
												<td style="text-align:left;"><?php echo $ag['data']->agentid; ?></td>
												<td><?php echo number_format($ag['agree']); ?></td>
												<td><?php echo number_format($ag['followup']); ?></td>
												<td><?php echo number_format($ag['decline']); ?></td>
												<td><?php echo number_format($ag['dc1']); ?></td>
												<td><?php echo number_format($ag['dc2']); ?></td>
												<td><?php echo number_format($ag['dc3']); ?></td>
												<td><?php echo number_format($ag['dc4']); ?></td>
												<td><?php echo number_format($ag['dc5']); ?></td>
												<td><?php echo number_format($ag['dc6']); ?></td>
												<td><?php echo number_format($ag['dc7']); ?></td>
												<td><?php echo number_format($ag['dc8']); ?></td>
												<td><?php echo number_format($ag['dc9']); ?></td>
												<td><?php echo number_format($ag['sub_total_contacted'] + $ag['sub_total_uncontacted']); ?></td>


											</tr>
								<?php
										}
										$no++;
									}
								}

								?>

							</tbody>
							<tfoot>
								<tr>
									<th colspan="3" style="text-align:right;">TOTAL</th>
									<th style="background-color:green;color:white;"><?php echo number_format($total['agree']); ?></th>
									<th style="background-color:green;color:white;"><?php echo number_format($total['followup']); ?></th>
									<th style="background-color:green;color:white;"><?php echo number_format($total['decline']); ?></th>

									<th style="background-color:red;color:white;"><?php echo number_format($total['dc1']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc2']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc3']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc4']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc5']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc6']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc7']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc8']); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total['dc8']); ?></th>
									<th style="background-color:blue;color:white;"><?php echo number_format($total['contacted'] + $total['uncontacted']); ?></th>


								</tr>
							</tfoot>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>

<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#agentid').selectize({});
		$("#report_table_reg").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>
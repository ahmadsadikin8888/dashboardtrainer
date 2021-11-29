<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('datatables,icheck,selectize,multiselect') ?>
<style>
	.blink_me {
		animation: blinker 1s linear infinite;
	}

	/* .blink_me_veri {
		animation: blinker 5s linear infinite;
	} */

	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}

	table.timecard {
		border-width: 1px;
		border-style: solid;
		border-color: black;
		border-collapse: collapse;
	}

	table.timecard thead th {
		text-align: center;
		border-width: 1px;
		padding: 3px;
		border-style: solid;
		border-color: black;
		background-color: #6495ED;
	}

	table.timecard td {
		text-align: center;
		border-width: 1px;
		padding: 3px;
		border-style: solid;
		border-color: black;
	}

	table.timecard th {
		text-align: center;
		border-width: 1px;
		padding: 3px;
		border-style: solid;
		border-color: black;
		background-color: #6495ED;
	}
</style>

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
					<div class="row">
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Mulai Dari</label>
								<input type='date' class='form-control data-sending focus-color' id='start' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
							</div>
						</div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Sampai </label>
								<input type='date' class='form-control data-sending focus-color' id='end' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Agent </label>
								<select name='agentid[]' id="agentid" class="form-control custom-select" multiple="multiple">
									
									<?php
									if($user_categori != 8){
										?>
										<option value="0">--Semua Agent--</option>
										<?php
									}
									if ($list_agent_d['num'] > 0) {
										foreach ($list_agent_d['results'] as $list_agent) {
											$selected = "";
											if (isset($_GET['agentid'])) {

												if(count($_GET['agentid']) > 1){
													
													foreach($_GET['agentid'] as $k_agentid=>$v_agentid){
														if($v_agentid == $list_agent->login){
															$selected = 'selected';
														}
													}
												}else{
													$selected = ($list_agent->login == $_GET['agentid'][0]) ? 'selected' : '';
												}

												
											}
											echo "<option value='" . $list_agent->login . "' " . $selected . ">" . $list_agent->agentid . "-" . $list_agent->nama . "</option>";
										}
									}
									?>

								</select>
							</div>
						</div>
						<!-- <div class='col-md-6 col-xl-6'>
							<div class='form-group'>
								<label class='form-label'>Regional </label>
								<select name='regionalid' id="regionalid" class="form-control" >
									<option value="0">--Semua Regional--</option>
									<?php
									// if ($list_agent_d['num'] > 0) {
									// 	foreach ($list_agent_d['results'] as $list_agent) {
									// 		$selected = "";
									// 		if (isset($_GET['agentid'])) {
									// 			$selected = ($list_agent->agentid == $_GET['agentid']) ? 'selected' : '';
									// 		}
									// 		echo "<option value='" . $list_agent->agentid . "' " . $selected . ">" . $list_agent->agentid . "-" . $list_agent->nama . "</option>";
									// 	}
									// }
									?>

								</select>
							</div>
						</div> -->


						<div class='col-md-12 col-xl-12'>

							<div class='form-group'>
								<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
								<?php
								if (isset($_GET['start']) && isset($_GET['end'])) {
								?>
									<a href="<?php echo base_url()."Report_profiling/Report_profiling/download_excel?start=".$_GET['start']."&end=".$_GET['end']."&agentid[]=".implode("&agentid[]=",$_GET['agentid']);?>" target='_blank' class='btn btn-success' style="color:white;"><i class="fe fe-download"></i> Download Excel</a>
								<?php
								} 
								?>
							</div>

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
									<th></th>
									<th>Order Call</th>
									<th>Contacted</th>
									<th>Verified</th>
									<th>PPA</th>
									<th>Agent On Duty</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th style="text-align:left;">REGULER</th>
									<th><?php echo number_format($total['reg']['contacted'] + $total['reg']['uncontacted']) ?></th>
									<th><?php echo number_format($total['reg']['contacted']) ?></th>
									<th><?php echo number_format($total['reg'][13]) ?></th>
									<th><?php echo number_format($total['reg'][13] / $total['reg']['duty']) ?></th>
									<th><?php echo number_format($total['reg']['duty']) ?></th>
								</tr>
								<tr>
									<th style="text-align:left;">MOSS</th>
									<th><?php echo number_format($total['moss']['contacted'] + $total['moss']['uncontacted']) ?></th>
									<th><?php echo number_format($total['moss']['contacted']) ?></th>
									<th><?php echo number_format($total['moss'][13]) ?></th>
									<th><?php echo number_format($total['moss'][13] / $total['moss']['duty']) ?></th>
									<th><?php echo number_format($total['moss']['duty']) ?></th>
								</tr>
								<tr>
									<th style="text-align:left;">ALL</th>
									<th><?php echo number_format($total['contacted'] + $total['uncontacted']) ?></th>
									<th><?php echo number_format($total['contacted']) ?></th>
									<th><?php echo number_format($total[13]) ?></th>
									<th><?php echo number_format($total[13] / ($total['reg']['duty']+$total['moss']['duty'])) ?></th>
									<th><?php echo number_format($total['reg']['duty']+$total['moss']['duty']) ?></th>
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
									<th></th>
									<th>Order Call</th>
									<th>Contacted</th>
									<th>Verified</th>
									<th>PPA</th>
									<th>AUX</th>
									<th>Agent On Duty</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th style="text-align:left;">WFO</th>
									<th><?php echo number_format($agent_wfo['contacted'] + $agent_wfo['uncontacted']) ?></th>
									<th><?php echo number_format($agent_wfo['contacted']) ?></th>
									<th><?php echo number_format($agent_wfo['verified']) ?></th>
									<th><?php echo number_format($agent_wfo['verified'] / $num_wfo) ?></th>
									<th><?php echo number_format(($agent_wfo['aux'] / $num_wfo) / 60) ?></th>
									<th><?php echo number_format($num_wfo) ?></th>
								</tr>
								<tr>
									<th style="text-align:left;">WFH</th>
									<th><?php echo number_format($agent_wfh['contacted'] + $agent_wfh['uncontacted']) ?></th>
									<th><?php echo number_format($agent_wfh['contacted']) ?></th>
									<th><?php echo number_format($agent_wfh['verified']) ?></th>
									<th><?php echo number_format($agent_wfh['verified'] / $num_wfh) ?></th>
									<th><?php echo number_format(($agent_wfh['aux'] / $num_wfh) / 60) ?></th>
									<th><?php echo number_format($num_wfh) ?></th>
								</tr>
								<tr>
									<th style="text-align:left;">ALL</th>
									<th><?php echo number_format(($agent_wfh['contacted'] + $agent_wfh['uncontacted']) + ($agent_wfo['contacted'] + $agent_wfo['uncontacted'])) ?></th>
									<th><?php echo number_format($agent_wfh['contacted'] + $agent_wfo['contacted']) ?></th>
									<th><?php echo number_format($agent_wfh['verified'] + $agent_wfo['verified']) ?></th>
									<th><?php echo number_format(($agent_wfh['verified'] + $agent_wfo['verified']) / ($num_wfh + $num_wfo)) ?></th>
									<th><?php echo number_format(((($agent_wfh['aux'] + $agent_wfo['aux'])) / ($num_wfo + $num_wfh)) / 60) ?></th>
									<th><?php echo number_format($num_wfo + $num_wfh) ?></th>
								</tr>
							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>
	<?php
	if($level != 8){

	
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
									<th><?php echo number_format($regional[1]) ?></th>
									<th><?php echo number_format($regional[2]) ?></th>
									<th><?php echo number_format($regional[3]) ?></th>
									<th><?php echo number_format($regional[4]) ?></th>
									<th><?php echo number_format($regional[5]) ?></th>
									<th><?php echo number_format($regional[6]) ?></th>
									<th><?php echo number_format($regional[7]) ?></th>
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
									<th style="background-color:green;color:white;"><b>BP</b></th>
									<th style="background-color:green;color:white;"><b>Verified</b></th>
									<th style="background-color:green;color:white;"><b>TBP</b></th>
									<th style="background-color:green;color:white;"><b>FLUP</b></th>

									<th style="background-color:red;color:white;"><b>LC</b></th>
									<th style="background-color:red;color:white;"><b>RNA</b></th>
									<th style="background-color:red;color:white;"><b>SS</b></th>
									<th style="background-color:red;color:white;"><b>Isolir</b></th>
									<th style="background-color:red;color:white;"><b>Decline</b></th>
									<th style="background-color:red;color:white;"><b>Reject</b></th>
									<th style="background-color:red;color:white;"><b>LR</b></th>
									<th style="background-color:blue;color:white;"><b>TOTAL</b></th>
									<th style="background-color:blue;color:white;"><b>HPE</b></th>
									<th style="background-color:blue;color:white;"><b>HPO</b></th>
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
												<td><?php echo number_format($ag[1]); ?></td>
												<td><?php echo number_format($ag[13]); ?></td>
												<td><?php echo number_format($ag[3]); ?></td>
												<td><?php echo number_format($ag[12]); ?></td>

												<td><?php echo number_format(0); ?></td>
												<td><?php echo number_format($ag[2]); ?></td>
												<td><?php echo number_format($ag[4]); ?></td>
												<td><?php echo number_format($ag[7]); ?></td>
												<td><?php echo number_format($ag[11]); ?></td>
												<td><?php echo number_format($ag[10]); ?></td>
												<td><?php echo number_format($ag[14]); ?></td>
												<td><?php echo number_format($ag['total']); ?></td>
												<td><?php echo number_format($ag['hp_email']); ?></td>
												<td><?php echo number_format($ag['hp_only']); ?></td>


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
									<th style="background-color:green;color:white;"><?php echo number_format($total[1]); ?></th>
									<th style="background-color:green;color:white;"><?php echo number_format($total[13]); ?></th>
									<th style="background-color:green;color:white;"><?php echo number_format($total[3]); ?></th>
									<th style="background-color:green;color:white;"><?php echo number_format($total[12]); ?></th>

									<th style="background-color:red;color:white;"><?php echo 0; ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total[2]); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total[4]); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total[7]); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total[11]); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total[10]); ?></th>
									<th style="background-color:red;color:white;"><?php echo number_format($total[14]); ?></th>
									<th style="background-color:blue;color:white;"><?php echo number_format($total['total']); ?></th>
									<th style="background-color:blue;color:white;"><?php echo number_format($total['hp_email']); ?></th>
									<th style="background-color:blue;color:white;"><?php echo number_format($total['hp_only']); ?></th>



									</th>
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
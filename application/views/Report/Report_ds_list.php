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
							<label class='form-label'>Start</label>
							<input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>End</label>
							<input type='date' min="<?php echo date("Y-m-d", strtotime("-" . (date('d') + 15) . " days")); ?>" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Campaign</label>
							<select name='campaign_id' id="campaign_id" class="form-control custom-select">
								<option value="all">All Campaign</option>
								<?php

								if (count($campaign_list) > 0) {
									foreach ($campaign_list as $d_produk) {
										$selected = "";
										if (isset($_GET['campaign_id'])) {


											$selected = ($_GET['campaign_id'] == $d_produk->id) ? 'selected' : '';
										}
										echo "<option value='" . $d_produk->id . "' " . $selected . ">" . $d_produk->nama_campaign . "</option>";
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


	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report DS Periode <?php echo $_GET['start'] . " sd " . $_GET['end'] ?>

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
						<table class='table' id="report_table_reg" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Campaign</th>
									<th>SND</th>
									<th>Nama</th>
									<th>No.Handphone</th>
									<th>Email</th>
									<th nowrap>Channel_1</th>
									<th>Status_1</th>
									<th nowrap>Channel_2</th>
									<th>Status_2</th>
									<th nowrap>Channel_3</th>
									<th>Status_3</th>
								</tr>

							</thead>
							<tbody>
								<?php
								$no = 1;
								if ($raw > 0) {

									foreach ($raw as $dt) {

								?>
										<tr>
											<td><?php echo $no; ?></td>
											<td nowrap><?php echo $dt->nama_campaign; ?></td>
											<td nowrap><?php echo $dt->snd; ?></td>
											<td nowrap><?php echo $dt->nama; ?></td>
											<td nowrap><?php echo $dt->no_gsm; ?></td>
											<td nowrap><?php echo $dt->email; ?></td>
											<td nowrap><?php echo $dt->channel_value; ?></td>
											<td nowrap><?php echo $dt->status_value; ?></td>
											<td nowrap><?php echo $dt->channel_value_2; ?></td>
											<td nowrap><?php echo $dt->status_value_2; ?></td>
											<td nowrap><?php echo $dt->channel_value_3; ?></td>
											<td nowrap><?php echo $dt->status_value_3; ?></td>
										</tr>
								<?php
										$no++;
									}
								}

								?>

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

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#produk').selectize({});
		$("#report_table_reg").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>
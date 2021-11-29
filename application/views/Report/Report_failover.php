<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('datatables,icheck,selectize,multiselect') ?>

<?php

// if (isset($_GET['start']) && isset($_GET['end'])) {


?>

<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-orange"></div>
		<div class="card-header">
			<h3 class="card-title">Report Digital Sales 

			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">


			<div class='box-body table-responsive' id='box-table'>
				<small>
					<table class="table" id="report_table_reg" width="100%" style="text-align:center;vertical-align: middle;">
						<thead>
							<tr>
								<th colspan=2>Opsi Channel</th>
								<th colspan=2>Failover 1</th>
								<th colspan=2>Failover 2</th>
							</tr>
							<tr>

								<th>Channel</th>
								<th>Status</th>
								<th>Channel</th>
								<th>Status</th>
								<th>Channel</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td rowspan='2'>WA</td>
								<td class='text-success'><?php echo number_format($opsi_channel["channel_11"]); ?></td>
								<td rowspan='2'>SMS</td>
								<td class='text-success'><?php echo number_format($opsi_channel_2["channel_121"]); ?></td>
								<td rowspan='2'>E-MAIL</td>
								<td class='text-success'><?php echo number_format($opsi_channel_3["channel_131"]); ?></td>
							</tr>
							<tr>
								<td class='text-danger'><?php echo number_format($opsi_channel["channel_12"]); ?></td>
								<td class='text-danger'><?php echo number_format($opsi_channel_2["channel_122"]); ?></td>
								<td class='text-danger'><?php echo number_format($opsi_channel_3["channel_132"]); ?></td>
							</tr>
							<tr>
								<td rowspan='2'>SMS</td>
								<td class='text-success'><?php echo number_format($opsi_channel["channel_21"]); ?></td>
								<td rowspan='2'>E-MAIL</td>
								<td class='text-success'><?php echo number_format($opsi_channel_2["channel_231"]); ?></td>
								<td rowspan='2'></td>
								<td></td>
							</tr>
							<tr>
								<td class='text-danger'><?php echo number_format($opsi_channel["channel_22"]); ?></td>
								<td class='text-danger'><?php echo number_format($opsi_channel_2["channel_232"]); ?></td>
								<td></td>
							</tr>
							<tr>
								<td rowspan='2'>EMAIL</td>
								<td class='text-success'><?php echo number_format($opsi_channel["channel_31"]); ?></td>
								<td rowspan='2'>WA</td>
								<td class='text-success'><?php echo number_format($opsi_channel_2["channel_311"]); ?></td>
								<td rowspan='2'>SMS</td>
								<td class='text-success'><?php echo number_format($opsi_channel_3["channel_321"]); ?></td>
							</tr>
							<tr>
								<td class='text-danger'><?php echo number_format($opsi_channel["channel_32"]); ?></td>
								<td class='text-danger'><?php echo number_format($opsi_channel_2["channel_312"]); ?></td>
								<td class='text-danger'><?php echo number_format($opsi_channel_3["channel_322"]); ?></td>
							</tr>
						</tbody>

					</table>
				</small>
			</div>
		</div>
	</div>
</div>

<?php
// }

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#produk').selectize({});
		// $("#report_table_reg").DataTable({
		// 	dom: 'Bfrtip',
		// 	buttons: [
		// 		'copy', 'csv', 'excel', 'pdf'
		// 	]
		// });
	});
</script>
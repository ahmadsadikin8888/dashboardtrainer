<?php echo _css('datatables,icheck') ?>
<?php
if (isset($_GET['success'])) {
	if ($_GET['success'] == 1) {
		$color = "green";
		$icon = "check";
		$status = "Berhasil";
	} else {
		$color = "red";
		$icon = "cross";
		$status = "Gagal";
	}
?>
	<div class="col-lg-12 col-xs-12 blink_me_veri">
		<div class="small-box bg-<?php echo $color; ?>">
			<div class="inner">
				<p>Data Content <?php echo $status; ?> Disubmit</p>
			</div>
			<div class="icon-counter">
				<i class="fa fa-<?php echo $icon; ?>-square-o"></i>
			</div>
		</div>
	</div>
<?php
}
?>

<?php echo card_open('List of Campaign', 'bg-teal', true) ?>


<div class='box-body table-responsive' id='box-table'>
	<small>
		<table class='display nowrap' id="example" style="width: 100%;">
			<thead>
				<tr>
					<th><b>No</b></th>
					<th><b>Option</b></th>
					<th><b>Campaign</b></th>
					<th><b>Status</b></th>
					<th><b>Date Create</b></th>
					<!-- <th><b>Keterangan</b></th> -->

				</tr>
			</thead>
			<tbody>
				<?php
				$nomor = 1;
				foreach ($list as $datana) {
					$paket = array(0 => 'Belum Diproses', 1 => 'Approve', 2 => 'Decline',3=>'Pending Approval');
				?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td>

							<a href="<?php echo base_url() . 'Approve/Approve/edit/' . $datana['id'] ?>" class="btn btn-default text-primary btn-sm " title="update">Update Status Approve</a>
							<a target="_blank" href="<?php echo base_url() . 'Approve/Approve/preview/' . $datana['id'] ?>" class="btn btn-default text-primary btn-sm " title="preview">Preview</a>
						</td>
						<td><?php echo $datana['nama_campaign']; ?></td>
						<td><?php echo $paket[$datana['status_approve']]; ?></td>
						<td><?php echo $datana['tgl_insert']; ?></td>
					</tr>
				<?php
					$nomor++;
				}
				?>
			</tbody>
		</table>

		<div hidden>
			<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal-danger' id='button_delete_single'></button>
		</div>
	</small>
</div>




<?php echo card_close() ?>

<?php echo _js('datatables,icheck') ?>

<script>
	var page_version = "1.0.8"
</script>
<script>
	$(document).ready(function() {
		$('#example').DataTable();


	});

	function deleteItem() {
		if (confirm("anda ingin hapus data ini?")) {
			// your deletion code
		}
		return false;
	}
</script>
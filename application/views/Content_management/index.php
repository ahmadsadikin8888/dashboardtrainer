<?php echo _css("selectize,datatables") ?>
<link href="<?php echo base_url(); ?>assets/progress_bar/css/static.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/progress_bar/js/jquery.progresstimer.js"></script>
<script src="<?php echo base_url(); ?>assets/progress_bar/js/static.min.js"></script>

<?php echo card_open('Isi Nama & Pilih Produk', 'bg-green', true) ?>
<div class="container-fluid site">
	<!-- START: Breadcrumbs-->
	<!-- END: Breadcrumbs-->

	<!-- START: Card Data-->
	<form id='form-a' methode="GET">
		<div class="form-group">
			<label for="inputState">Nama Campaign</label>
			<input type="text" class="form-control" id="nama_campaign" placeholder="Nama Campaign" value="<?php if (isset($_GET['nama_campaign'])) {
																												echo $_GET['nama_campaign'];
																											} ?>" required name="nama_campaign" />
		</div>
		<div class="form-group">
			<label for="inputState">Pilih Produk</label>
			<select class="form-control custom-select" id="nama_produk" name="nama_produk">
				<?php
				foreach ($nama_produk->result() as $produk) {
					echo "<option value='$produk->produk_key'>$produk->produk_description</option>";
				}
				?>

			</select>
			<!-- <input type="text" class="form-control" id="produk_asli" placeholder="Nama Produk" value="" required name="name_produk" /> -->
		</div>
		<input type="submit" class="btn btn-primary pull-right mb-3" value="Isi Template">

		<!-- END: Card DATA-->
</div>
<?php echo card_close() ?>
<div class='col-md-12 col-xl-12' id="list_area">
	<div class="loading-progress" style="width:100%;"></div>
</div>


<?php echo _js("selectize,datatables") ?>
<script type="text/javascript">
	$('#nama_produk').selectize({});
</script>

<?php

if (isset($_GET['nama_produk']) && isset($_GET['nama_campaign'])) {


?>


	<script type="text/javascript">
		var progress = $(".loading-progress").progressTimer({
			timeLimit: 90,
			onFinish: function() {
				// alert('completed!');
			}
		});



		function update_base_list_area() {
			var nama_campaign = $("#nama_campaign").val();
			var nama_produk = $("#nama_produk").val();
			$.ajax({
				url: "<?php echo base_url() . "Content_management/Content_management/get_data_list" ?>",
				data: {
					nama_campaign: nama_campaign,
					nama_produk: nama_produk
				},
				methode: "get",
				success: function(response) {
					$("#list_area").html(response);
					progress.progressTimer('complete');
				},
				error: function() {
					progress.progressTimer('error', {
						errorText: 'ERROR!',
						onFinish: function() {
							alert('There was an error processing your information!');
						}
					});
				}
			});
		}

		$(document).ready(function() {
			update_base_list_area();
			// update_base_num_hp_email_area();
			// update_base_num_area();
		});
	</script>
<?php
}

?>
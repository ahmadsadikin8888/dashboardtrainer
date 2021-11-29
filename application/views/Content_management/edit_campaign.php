<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/quill/quill.snow.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/summernote/summernote-lite.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/custom/custom_style.css" />
<script src="<?php echo base_url(); ?>assets/summernote/summernote-lite.min.js"></script>
<?php echo _css('datatables,selectize,multiselect') ?>

<script type="text/javascript">
	function countChar(val) {
		var len = val.value.length;
		if (len >= 160) {
			val.value = val.value.substring(0, 160);
		} else {
			$('#charNum').text(160 - len);
		}
	};

	function change_type_wa() {
		var content_type = $("#type_content_wa").val();
		switch (content_type) {
			case "1":
				$("#wa_image_form").hide();
				$("#wa_video_form").hide();
				$("#wa_image_preview").hide();
				$("#wa_video_preview").hide();
				break;
			case "2":
				$("#wa_image_form").show();
				$("#wa_video_form").hide();
				$("#wa_image_preview").show();
				$("#wa_video_preview").hide();
				break;
			case "3":
				$("#wa_image_form").hide();
				$("#wa_video_form").show();
				$("#wa_image_preview").hide();
				$("#wa_video_preview").show();
				break;
		}
	}
</script>

<?php echo card_open('Isi Nama & Pilih Produk', 'bg-green', true) ?>
<form action="<?php echo base_url('Content_Management/Content_Management/save'); ?>" method="post" enctype="multipart/form-data" id="generator_template_email">

	<div class="container-fluid site">
		<?php
		if ($data->feedback != "") {
		?>
			<p>
			<div class="alert alert-warning " role="alert">
				Feedback Approval : <br>
				<?php echo $data->feedback; ?>
			</div>
			</p>
		<?php
		}
		?>
		<div class="form-group">
			<label for="inputState">Nama Campaign</label>
			<input required type="text" class="form-control" id="nama_campaign" placeholder="Nama Campaign" value="<?php echo $data->nama_campaign; ?>" required name="nama_campaign" />
		</div>
		<div class="form-group">
			<label for="inputState">Pilih Landing Page</label>
			<select required class="form-control custom-select" id="landing_page_key" name="landing_page_key">
				<?php
				foreach ($landing_page->result() as $lp) {
					$selected = "";
					if ($lp->landing_page_key == $data->landing_page_key) {
						$selected = "selected";
					}
					echo "<option value='$lp->landing_page_key' $selected>$lp->campaign_name</option>";
				}
				?>

			</select>
			<!-- <input type="text" class="form-control" id="produk_asli" placeholder="Nama Produk" value="" required name="name_produk" /> -->
		</div>
		<div class="form-group">
			<label for="inputState">Pilih Produk yang akan dicampaign</label>
			<select required class="form-control custom-select" id="nama_produk" name="nama_produk[]" multiple="multiple">
				<?php
				foreach ($nama_produk->result() as $produk) {
					$selected = "";
					$list_selpro = explode('|', $data->id_produk);
					if (in_array($produk->produk_value, $list_selpro)) {
						$selected = "selected";
					}
					echo "<option value='$produk->produk_value' $selected>$produk->produk_description</option>";
				}
				?>

			</select>
			<!-- <input type="text" class="form-control" id="produk_asli" placeholder="Nama Produk" value="" required name="name_produk" /> -->
		</div>

	</div>
	<?php echo card_close() ?>
	<?php echo card_open('Template', 'bg-green', true) ?>
	<div class="col-12">
		<div class="row">
			<div class="col-6">
				<?php echo card_open('Template Email', 'bg-green', true) ?>
				<div class="form-group">
					<label for="validationCustomUsername">Choose Image Email</label>

					<!-- choose file hanya muncul ketika dropdown wording di pilih wa -->
					<div class="custom-file">
						<input type="file" accept="image/*" class="custom-file-input" id="validatedCustomFile" name="image_email" onchange="emailImagePreview(this);">
						<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
						<div class="invalid-feedback">Example invalid custom file feedback</div>
					</div>
				</div>
				<div class="form-group">
					<!-- disini load snow container quill textarea -->
					<!-- <div id="snow-container1" class="height-175 snow-container"></div> -->
					<textarea required class="form-control" id="contentemail" name="contentemail" onchange="emailContentPreview();"><?php echo $data->email_content; ?></textarea>
				</div>
				<?php echo card_close() ?>
			</div>
			<div class="col-6">
				<?php echo card_open('Email Preview', 'bg-green', true) ?>
				<table width='100%' border="0">
					<tr style='border-collapse:collapse'>
						<td align='left' style='padding:0;Margin:0'>
							<table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
								<tbody>
									<tr style='border-collapse:collapse'>
										<td valign='top' align='center' style='padding:0;Margin:0'>
											<table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
												<tbody>
													<tr style='border-collapse:collapse'>
														<td align='center' style='padding:0;Margin:0;font-size:0'>
															<a href='<?php echo $link_lp; ?>'><img class='adapt-img' src='<?php echo base_url() . "assets/images/campaign/" . $data->email_image; ?>' alt='indihome' id='email_image_preview' style='display:block;border:0;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic' width='100%' title='indihome'></a>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr style='border-collapse:collapse'>
						<td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:20px'>
							<table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
								<tbody>
									<tr style='border-collapse:collapse'>
										<td width='560' align='center' valign='top' style='padding:0;Margin:0'>
											<table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
												<tbody>
													<tr style='border-collapse:collapse'>
														<td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
															<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Halo, Pelanggan Setia IndiHome!</p>
														</td>
													</tr>
													<tr style='border-collapse:collapse'>
														<td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
															<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000' id='email_content_preview'><?php echo $data->email_content; ?></p>
														</td>
													</tr>

													<tr style='border-collapse:collapse'>
														<td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
															<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Untuk berlangganan <a class='' target='_blank' href='<?php echo $link_lp; ?>'>klik di sini</a>
															</p>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
				<?php echo card_close() ?>
			</div>
			<div class="col-6">
				<?php echo card_open('Template Whatsapp', 'bg-green', true) ?>
				<div class="form-group">
					<!-- disini load snow container quill textarea -->
					<label for="inputState">Template Content Whatsapp</label>
					<select class="form-control" id="type_content_wa" name="type_content_wa" onchange="change_type_wa();">
						<option value='1' <?php echo ($data->type_content_wa == '1') ? 'selected' : ''; ?>>Text and Link</option>
						<option value='2' <?php echo ($data->type_content_wa == '2') ? 'selected' : ''; ?>>Image,Text and Link</option>
						<option value='3' <?php echo ($data->type_content_wa == '3') ? 'selected' : ''; ?>>Video,Text and Link</option>
					</select>
					<!-- <div id="snow-container2" class="height-175 snow-container"></div> -->
				</div>
				<div class="form-group" id='wa_image_form' style="<?php echo ($data->type_content_wa == '2') ? '' : 'display:none;'; ?>">
					<label for="validationCustomUsername">Choose Image Whatsapp</label>

					<!-- choose file hanya muncul ketika dropdown wording di pilih wa -->
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="validatedCustomFile" name="image_whatsapp" onchange="waImagePreview(this);">
						<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
						<div class="invalid-feedback">Example invalid custom file feedback</div>
					</div>
				</div>
				<div class="form-group" id='wa_video_form' style="<?php echo ($data->type_content_wa == '3') ? '' : 'display:none;'; ?>">
					<label for="validationCustomUsername">Choose Video Whatsapp</label>

					<!-- choose file hanya muncul ketika dropdown wording di pilih wa -->
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="validatedCustomFile" onchange="waVideoPreview(this);" name="video_whatsapp">
						<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
						<div class="invalid-feedback">Example invalid custom file feedback</div>
					</div>
				</div>

				<div class="form-group">
					<!-- disini load snow container quill textarea -->
					<!-- <div id="snow-container1" class="height-175 snow-container"></div> -->
					<textarea required class="form-control" id="wa_desc" onchange="waContentPreview();" name="wa_desc"><?php echo $data->wa_des; ?></textarea>
				</div>


				<?php echo card_close() ?>
			</div>
			<div class="col-6">
				<?php echo card_open('Whatsapp Preview', 'bg-green', true) ?>
				<div class="scrollerchat p-3">

					<div class="media d-flex  mb-4">
						<div class="p-3 ml-auto speech-bubble">

							<img id='wa_image_preview' src='<?php echo base_url() . "assets/images/campaign/" . $data->wa_image; ?>' style='<?php echo ($data->type_content_wa == '2') ? '' : 'display:none;'; ?>'>
							<video controls id='wa_video_preview' style='<?php echo ($data->type_content_wa == '3') ? '' : 'display:none;'; ?>'>
								<source src="<?php echo base_url() . "assets/images/campaign/" . $data->wa_video; ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
							Pelanggan setia indihome<br>
							<p id='content_wa_preview'><?php echo $data->wa_des; ?></p>
							Saatnya tambah Hybrid Bocx sekarang dengan klik <?php echo $link_lp; ?>. Info @IndiHomeCare. myIndiHome app & 147.
						</div>
					</div>
				</div>
				<?php echo card_close() ?>
			</div>
			<div class="col-6">
				<?php echo card_open('Template SMS', 'bg-green', true) ?>
				<div class="form-group">
					<!-- disini load snow container quill textarea -->
					<label for="inputState">SMS Desc</label>
					<textarea required class="form-control" onkeyup="countChar(this)" onchange="smsContentPreview();" id="sms_desc" name="sms_desc"><?php echo $data->sms_desc; ?></textarea>
					<div id="charNum"></div>
					<!-- <div id="snow-container2" class="height-175 snow-container"></div> -->
				</div>


				<?php echo card_close() ?>
			</div>
			<div class="col-6">
				<?php echo card_open('SMS Preview', 'bg-green', true) ?>
				<div class="scrollerchat p-3">

					<div class="media d-flex  mb-4">
						<div class="p-3 speech-bubble">

							<p id='content_sms_preview'><?php echo $data->sms_desc; ?></p>
						</div>
					</div>
				</div>
				<?php echo card_close() ?>
			</div>
		</div>

	</div>


	<?php echo card_close() ?>
	<?php echo card_open('Set Rule', 'bg-green', true) ?>
	<div class="form-group">
		<label for="inputState">Area</label>
		<select class="form-control  custom-select" id="area" name="area[]" multiple="multiple">
			<?php
			foreach ($area as $dataarea) {
				$selected = "";
				$list_selpro = explode(',', $data->r_area);
				if (in_array($dataarea->regional_key, $list_selpro)) {
					$selected = "selected";
				}
				echo "<option value='$dataarea->regional_key' $selected>$dataarea->regional_value</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="inputState">Paket</label>
		<select class="form-control custom-select" id="paket" name="paket[]" multiple="multiple">
			<?php
			$paket = array('Paket Entry', 'Paket Intro', 'Paket Basic');
			foreach ($paket as $pk) {
				$selected = "";
				$list_selpro = explode(',', $data->r_paket);
				if (in_array($pk, $list_selpro)) {
					$selected = "selected";
				}
				echo "<option value='$pk' $selected>$pk</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="inputState">Historical View Channel</label>
		<select class="form-control custom-select" id="history" name="history[]" multiple="multiple">
			<?php
			foreach ($nama_produk->result() as $datana) {
				$list_selpro = explode(',', $data->r_history);
				if (in_array($datana->produk_key, $list_selpro)) {
					$selected = "selected";
				}
				echo "<option value='$datana->produk_key' $selected>$datana->produk_description</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="inputState">Subscribe Minipack RNA / Not PS</label><br>
		<input type="radio" id="yes" name="subscribe" value="1" <?php echo ($data->r_subscribe == 1 ? 'checked' : ''); ?>>
		<label for="male">Yes</label><br>
		<input type="radio" id="no" name="subscribe" value="0" <?php echo ($data->r_subscribe == 0 ? 'checked' : ''); ?>>
		<label for="female">No</label><br>
	</div>
	<div class="form-group">
		<label for="inputState">Waktu Blast Terakhir Dikirim</label>
		<input type="date" id="last_timesend" name="last_timesend" class="form-control col-3" value="<?php echo $data->r_waktu_blast; ?>">
	</div>
	<div class="form-group">
		<label for="inputState">Campaign terakhir dikirim</label>
		<select class="form-control custom-select" id="last_campaign" name="last_campaign[]" multiple="multiple">
			<?php
			foreach ($nama_produk->result() as $datana) {
				$list_selpro = explode(',', $data->r_campaign_last);
				if (in_array($datana->produk_key, $list_selpro)) {
					$selected = "selected";
				}
				echo "<option value='$datana->produk_key' $selected>$datana->produk_description</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="inputState">Informasi Paket Melalui Channel</label>
		<select class="form-control custom-select" id="infoctp" name="infoctp[]" multiple="multiple">
			<?php
			$paket = array(1 => 'Informasi', 2 => 'Complain', 5 => 'Registrasi');
			foreach ($paket as $pk => $val) {
				$selected = "";
				$list_selpro = explode(',', $data->r_infopaket);
				if (in_array($pk, $list_selpro)) {
					$selected = "selected";
				}
				echo "<option value='$pk' $selected>$val</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label for="inputState">Keyword</label>
		<input type='hidden' id='id' name='id' value='<?php echo $data->id; ?>'>
		<input required type="text" class="form-control" id="keyword" name="keyword" value="<?php echo $data->r_keyword; ?>">
	</div>
	<button class="btn btn-info btn-block" type="submit">Submit</button>
</form>
<?php echo card_close() ?>

<?php echo _js('datatables,selectize,multiselect') ?>

<!-- START: Template JS-->
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->

<!-- START: Page JS-->
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.filemanager.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/quill/quill.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/mail.script.js"></script> -->
<!-- END: Page JS-->
<script type="text/javascript">
	$(document).ready(function() {
		$("#table_data").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
		$('#summernote_email').summernote({
			callbacks: {
				onChange: function() {
					document.getElementById('previewEmail').innerHTML = $("#summernote_email").summernote('code');
				}
			},
		});
	});
</script>
<script type="text/javascript">
	var quill = new Quill('#snow-container', {
		theme: 'snow'
	});

	var quill1 = new Quill('#snow-container1', {
		theme: 'snow'
	});

	var quill2 = new Quill('#snow-container2', {
		theme: 'snow'
	});

	// On Form Submit nambahin hasil text Editor
	// $("#generator_template_email").on("submit", function() {
	// 	var hvalue = quill.container.firstChild.innerHTML;
	// 	$(this).append("<textarea name='contentemail' style='display:none'>" + hvalue + "</textarea>");
	// 	return true;
	// });
	$('form').submit(function() {

		var paket = $.trim($('#paket').val());
		var area = $.trim($('#area').val());
		var history = $.trim($('#history').val());
		var last_campaign = $.trim($('#last_campaign').val());
		var infoctp = $.trim($('#infoctp').val());
		var landing_page_key = $.trim($('#landing_page_key').val());
		var contentemail = $("#summernote_email").summernote('code');
		$(this).append("<textarea name='contentemail' style='display:none'>" + contentemail + "</textarea>");
		jQuery.fn.preventDoubleSubmission = function() {
			$(this).on('submit', function(e) {
				var $form = $(this);

				if ($form.data('submitted') === true) {
					// Previously submitted - don't submit again
					e.preventDefault();
				} else {
					// Mark it so that the next submit can be ignored
					$form.data('submitted', true);

				}
			});
			return this;
		};


	});

	// Ketika ada perubahan tab active bikin preview nya jadi default wording
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		// newly activated tab
		// e.target 
		// previous active tab
		// e.relatedTarget 
		console.log(e.target.hash)
		$('#preview_campaign_image').attr("src", '');
		$('#preview_content').html('');
		$('#preview_button_link').attr("href", '');
	})

	// Ketika ada Event pada Quill di form
	quill.on('text-change', function(t) {
		// $("#preview_campaign_image").html('');
		console.log('ada yg berubah')
		$('#preview_content').html(quill.root.innerHTML);
	});
	quill1.on('text-change', function() {
		// $("#preview_campaign_image").html('');
		console.log('ada yg berubah 1')
		$('#preview_content').html(quill1.root.innerHTML);
	});
	quill2.on('text-change', function() {
		// $("#preview_campaign_image").html('');
		console.log('ada yg berubah 2')
		$('#preview_content').html(quill2.root.innerHTML);
	});


	// Ketika ada perubahan pada input button for link
	$("input[name=button_for_link]").change(function() {
		$('#preview_button_link').attr("href", $(this).val());
	});



	// Func untuk Preview Image

	// Func untuk Preview Image
	function emailImagePreview(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#email_image_preview')
					.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	function waImagePreview(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#wa_image_preview')
					.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	function waVideoPreview(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			const video = document.getElementById('wa_video_preview');
			const videoSource = document.createElement('source');


			reader.onload = function(e) {
				videoSource.setAttribute('src', e.target.result);
				video.appendChild(videoSource);
				video.load();
				// video.play();
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	function emailContentPreview() {
		var contentna = $("#contentemail").val();
		$("#email_content_preview").text(contentna);
	}

	function waContentPreview() {
		var contentna = $("#wa_desc").val();
		$("#content_wa_preview").text(contentna);
	}

	function smsContentPreview() {
		var contentna = $("#sms_desc").val();
		$("#content_sms_preview").text(contentna);
	}
</script>
<script type="text/javascript">
	$('#paket').selectize({});
	$('#area').selectize({});
	$('#history').selectize({});
	$('#last_campaign').selectize({});
	$('#infoctp').selectize({});
	$('#nama_produk').selectize({});
</script>
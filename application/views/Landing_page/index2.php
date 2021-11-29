<link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/bootstrap/css/bootstrap.min.css" />
<!-- <script src="<?php echo base_url(); ?>assets/temp_1/vendors/bootstrap/js/bootstrap.min.js"></script> -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/summernote/summernote-lite.min.css" />
<script src="<?php echo base_url(); ?>assets/summernote/summernote-lite.min.js"></script>
<div class="container-fluid site">
	<div class="row">
		<div class="col-12 align-self-center">
			<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
				<div class="w-sm-100 mr-auto">
					<h4 class="mb-0">Landing Page</h4>
				</div>
				<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
					<li class="breadcrumb-item">Home</li>
					<li class="breadcrumb-item">App</li>
					<li class="breadcrumb-item active">
						<a href="#">Landing Page</a>
					</li>
				</ol>
			</div>
		</div>
	</div>

	<form action="<?php echo base_url('Landing_page/Landing_page/save_landing_page_template'); ?>" method="post" enctype="multipart/form-data" id="generator_template_email">
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<div class="form-group row">
							<label for="inputState" class="col-sm-12 col-form-label">Nama Campaign</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="validationCustom01" placeholder="Nama Campaign" value="" required name="nama_campaign" />
							</div>
							<br>
							<div class="col-sm-12">
								<button id="saveButton" class="btn btn-info btn-block" type="submit">Save</button>
							</div>
						</div>
						<nav>
							<div class="nav nav-tabs font-weight-bold flex-column flex-sm-row" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-landing_page-tab" data-toggle="tab" href="#nav-landing-page" role="tab" aria-controls="nav-landing-page" aria-selected="false">Landing Page</a>
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-landing-page" role="tabpanel" aria-labelledby="nav-landing-page-tab">
								<div id="summernote_landingpage">
									<a id="unique_link" href="#" target="_blank">Link Unik Pelanggan</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">
						<div class="card mb-2">
							<div class="card-header">
								<h5 class="card-title">Preview Landing Page</h5>
							</div>
							<div class="card-body">
								<div id="previewLandingPage">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>

	<script>
		$(document).ready(function() {
			$('#summernote_email').summernote({
				callbacks: {
					onChange: function() {
						document.getElementById('previewEmail').innerHTML = $("#summernote_email").summernote('code');
					}
				},
			});
			$('#summernote_landingpage').summernote({
				callbacks: {
					onChange: function() {
						document.getElementById('previewLandingPage').innerHTML = $("#summernote_landingpage").summernote('code');
					}
				},
			});
			$('#smsTextArea').bind('input propertychange', function() {
				let page = Math.floor(this.value.length / 160);
				let remaining = this.value.length % 160;
				document.getElementById('labelSmsTextArea').innerHTML = 'Char Count ' + remaining + '/160 (' + page + ')';
				document.getElementById('previewSms').innerHTML = "";
				for (let index = 0; index < page + 1; index++) {
					let newParagraph = document.createElement('p');
					newParagraph.innerHTML = document.getElementById("smsTextArea").value.substring((160 * index), (160 * index) + 160);
					document.getElementById('previewSms').appendChild(newParagraph);
				}
			});

			$('form').submit(function() {


				// var nama_campaign = $.trim($('#nama_campaign').val());
				var contentemail = $("#summernote_landingpage").summernote('code');
				$(this).append("<textarea name='contentlandingpage' style='display:none'>" + contentemail + "</textarea>");
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
		});
	</script>
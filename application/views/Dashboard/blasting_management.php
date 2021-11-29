<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
  <meta charset="UTF-8" />
  <title>Blast Management</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/new_theme/dist/images/favicon.ico" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />

  <!-- START: Template CSS-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css" />

  <!-- END Template CSS-->

  <!-- START: Page CSS-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/select2/css/select2.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/select2/css/select2-bootstrap.min.css" />
  <!-- END: Page CSS-->

  <!-- START: Custom CSS-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css" />
  <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">
  <!-- START: Pre Loader-->
  <div class="se-pre-con">
    <div class="loader"></div>
  </div>
  <!-- END: Pre Loader-->

  <!-- START: Header-->

  <!-- END: Header-->

  <!-- START: Main Menu-->

  <!-- END: Main Menu-->

  <!-- START: Main Content-->
  <main>
    <div class="container-fluid site-width">
      <!-- START: Breadcrumbs-->
      
      <div class="row">
        <div class="col-12 align-self-center">
          <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto">
              <h4 class="mb-0">Blasting Management</h4>
            </div>

            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item">App</li>
              <li class="breadcrumb-item active">
                <a href="#">Blasting Management</a>
              </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- END: Breadcrumbs-->

      <!-- START: Card Data-->
      <div class="row row-eq-height">
        <div class="col-12 mt-3">
          <div class="card mb-3">
            <div class="card-content">
              <div class="card-body">
                <div class="d-flex">
                  <div class="media-body pt-1 ">
                    <span class="mb-0 h5 font-w-600">Summary Targetted Campaign</span>
                  </div>
                  <!-- <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0">$</span></div> -->
                  <form method="POST">
                    <div class="form-group row">
                      <div class="col-12">
                        <select style="width:100%;" required>
                          <option label="Choose on thing">Choose Rules</option>
                          <option>Social Media</option>
                          <option>147</option>
                          <option>Aplikasi MyindiHome</option>
                          <option>Plaza</option>
                        </select>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- akan muncul secara default jika belum memilih rules, setelah pemilihan rules langsung muncul matrix dari data rules yg dipilih -->
                <!-- <p>
                <div class="alert alert-danger text-center" role="alert">
                  <h5>Silahkan pilih rules terlebih dahulu</h5>
                </div> -->
                </p>

                <!-- <div class="row">
                  <div class="col-md-3">
                    <div class="border-0 outline-badge-info p-2 rounded text-center">
                      <span class="h5 mb-0">
                        Total Channel
                      </span>
                      <br />
                      78.600
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="border-0 outline-badge-success p-2 rounded ml-2 text-center">
                      <span class="h5 mb-0">
                        Whatsapp</span>
                      <br />
                      12.600
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="border-0 outline-badge-primary p-2 rounded text-center">
                      <span class="h5 mb-0">
                        Email
                      </span>
                      <br />
                      4.600
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="border-0 outline-badge-warning p-2 rounded ml-2 text-center">
                      <span class="h5 mb-0">
                        SMS
                      </span>
                      <br />
                      2.600
                    </div>
                  </div>
                </div> -->

                <hr>

                <!-- <div class="table-responsive">
                  <table id="example" class="display table dataTable table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center align-items-center" rowspan="2">No</th>
                        <th class="text-center align-items-center" rowspan="2">NCLI</th>
                        <th class="text-center align-items-center" rowspan="2">Internet</th>
                        <th class="text-center align-items-center" rowspan="2">PSTN</th>
                        <th class="text-center align-items-center" rowspan="2">NAMA</th>
                        <th class="text-center align-items-center" colspan="2">Targetted Product</th>
                        <th class="text-center align-items-center" colspan="9">Customer Criteria</th>
                      </tr>
                      <tr>
                        <td class="font-weight-bold text-center">Cat Product</td>
                        <td class="font-weight-bold text-center">Product</td>
                        <td class="font-weight-bold text-center">Package</td>
                        <td class="font-weight-bold text-center">Area</td>
                        <td class="font-weight-bold text-center">Last View Channel</td>
                        <td class="font-weight-bold text-center">Subscription</td>
                        <td class="font-weight-bold text-center">Last Campaign Time</td>
                        <td class="font-weight-bold text-center">Last Campaign Topic</td>
                        <td class="font-weight-bold text-center">Info Package</td>
                        <td class="font-weight-bold text-center">Blast Via</td>
                        <td class="font-weight-bold text-center">Status</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>INDIKIDS10</td>
                        <td>Indimovie Kids</td>
                        <td>35.000</td>
                        <td>Paket Minipack indihome movie kids</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>INDIKIDS10</td>
                        <td>
                          Whatsapp
                        </td>
                        <td>
                          Waitting..
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div> -->

                <!-- START: Card Data-->
                <div class="row">


                  <!-- matrix status blasting hidden default dan akan muncul ketika tombol blast di clik -->
                  <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class='p-4 align-self-center'>
                          <h2>22.390</h2>
                          <h6 class="card-liner-subtitle">Total Blasting</h6>
                        </div>
                        <div class="barfiller" data-color="#1e3d73">
                          <div class="tipWrap">
                            <span class="tip rounded primary">
                              <span class="tip-arrow"></span>
                            </span>
                          </div>
                          <span class="fill" data-percentage="80"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class='p-4 align-self-center'>
                          <h2>54.768</h2>
                          <h6 class="card-liner-subtitle">Whatsapp</h6>
                        </div>
                        <div class="barfiller" data-color="#17a2b8">
                          <div class="tipWrap">
                            <span class="tip rounded info">
                              <span class="tip-arrow"></span>
                            </span>
                          </div>
                          <span class="fill" data-percentage="92"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class='p-4 align-self-center'>
                          <h2>4.236</h2>
                          <h6 class="card-liner-subtitle">Email</h6>
                        </div>
                        <div class="barfiller" data-color="#1ee0ac">
                          <div class="tipWrap">
                            <span class="tip rounded success">
                              <span class="tip-arrow"></span>
                            </span>
                          </div>
                          <span class="fill" data-percentage="67"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-xl-3 mt-3">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class='p-4 align-self-center'>
                          <h2>236</h2>
                          <h6 class="card-liner-subtitle">SMS</h6>
                        </div>
                        <div class="barfiller" data-color="#ffc107">
                          <div class="tipWrap">
                            <span class="tip rounded warning">
                              <span class="tip-arrow"></span>
                            </span>
                          </div>
                          <span class="fill" data-percentage="67"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 mb-4 mt-4">
                    <button class="btn btn-success btn-lg btn-block" type="submit">Blast</button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- END: Card DATA-->
      </div>
  </main>
  <!-- END: Content-->

  <!-- START: Footer-->
  <footer class="site-footer">2020 © PICK</footer>
  <!-- END: Footer-->

  <!-- START: Back to top-->
  <a href="#" class="scrollup text-center">
    <i class="icon-arrow-up"></i>
  </a>
  <!-- END: Back to top-->

  <!-- START: Template JS-->
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>

  <!-- END: Template JS-->

  <!-- START: APP JS-->
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script>
  <!-- END: APP JS-->

  <!-- START: Page Vendor JS-->
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>
  <!-- END: Page Vendor JS-->

  <!-- START: Page Script JS-->
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/select2.script.js"></script>
  <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script>
  <!-- END: Page Script JS-->
</body>
<!-- END: Body-->

</html>
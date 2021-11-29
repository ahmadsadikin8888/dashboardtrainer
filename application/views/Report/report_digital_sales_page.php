<!-- START: Template CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.theme.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/simple-line-icons/css/simple-line-icons.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/flags-icon/css/flag-icon.min.css" />
<!-- END Template CSS-->

<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/vendors/datatable/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/select2/css/select2-bootstrap.min.css" />

<!-- START: Custom CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/css/main2.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/quill/quill.snow.css" />
<!-- START: Pre Loader-->
<!-- START: Main Content-->
<div class="container-fluid site">
    <!-- START: Breadcrumbs-->
    <div class="row">
        <div class="col-10 align-self-center">
            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto">
                    <h4 class="mb-0">Report Digital Sales</h4>
                </div>
            </div>
        </div>
        <div class="col-2 align-self-center">
            <button class="btn btn-success float-right" type="submit">
                Back
            </button>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <!-- START: Card Data-->
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-add-rules" role="tabpanel" aria-labelledby="nav-add-rules-tab">
                                <div class="py-3 border-bottom border-primary">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="needs-validation" novalidate>
                                                <div class="form-inline">
                                                    <label for="validationCustom01 col-sm-2">Showing From</label>
                                                    <div class="col-sm-2">
                                                        <input type="date" class="form-control input-sm" id="dt" required />
                                                    </div>
                                                    <label for="validationCustom02 col-sm-2">to</label>
                                                    <div class="col-sm-2">
                                                        <input type="date" class="form-control input-sm" id="dt" required />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button class="btn btn-primary float-left" type="submit">
                                                            process
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Card DATA-->


    <!-- START: Card Data-->
    <div class="row">
        <div class="col-12 col-lg-6 mt-3">
            <div class="card">
                <div class="card-content">
                    <div class="card-header justify-content-between align-items-center">
                        <h6 class="card-title">Summary Report</h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table font-w-600">
                            <thead>
                                <tr>
                                    <th>Channel</th>
                                    <th>Blast</th>
                                    <th>Deliver</th>
                                    <th>Read</th>
                                    <th>Clicked</th>
                                    <th>Actived</th>
                                    <th>PS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="zoom">
                                    <td>Email</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                </tr>
                                <tr class="zoom">
                                    <td>WA</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                </tr>
                                <tr class="zoom">
                                    <td>SMS</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                </tr>
                                <tr class="zoom">
                                    <td>Total</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>100</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mt-3">
            <div class="card">
                <div class="card-content">
                    <div class="card-header  justify-content-between align-items-center">
                        <h6 class="card-title">Top 5 Product</h6>
                    </div>
                    <div class="card-body">
                        <div id="apex_bar_chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 mt-3">
            <div class="card">
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td style="cursor: default;">
                                        <div class="hdrcell">No</div>
                                    </td>
                                    <td style="cursor: default;">
                                        <div class="hdrcell">NCLI</div>
                                    </td>
                                    <td style="cursor: default;">
                                        <div class="hdrcell">No Internet</div>
                                    </td>
                                    <td>
                                        <div class="hdrcell">PSTN</div>
                                    </td>
                                    <td style="cursor: default;">
                                        <div class="hdrcell">Nama</div>
                                    </td>
                                    <td style="cursor: default;">
                                        <div class="hdrcell">Channel</div>
                                    </td>
                                    <td>
                                        <div class="hdrcell">Deliver</div>
                                    </td>
                                    <td style="cursor: default;">
                                        <div class="hdrcell">Read</div>
                                    </td>
                                    <td>
                                        <div class="hdrcell">Clicked</div>
                                    </td>
                                    <td>
                                        <div class="hdrcell">Actived</div>
                                    </td>
                                    <td>
                                        <div class="hdrcell">PS</div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class=" ev_dhx_skyblue rowselected">
                                    <td align="left" valign="middle">ahmadsadikin8888@gmail.com</td>
                                    <td align="left" valign="middle"><a href="#"><i class="fe fe-mail"></i> Send</a></td>
                                    <td align="left" valign="middle" title="9014010340927" class=" cellselected">9014010340927</td>
                                    <td align="left" valign="middle" title="51589599">51589599</td>
                                    <td align="left" valign="middle" title="131159124293">131159124293</td>
                                    <td align="left" valign="middle">02220669951</td>
                                    <td align="left" valign="middle" title="AHMAD SADIKIN">AHMAD SADIKIN</td>
                                    <td align="left" valign="middle">CIDAHU, NO. 5/1, DS TANIMULYA KAB BANDUNG 40552</td>
                                    <td align="left" valign="middle">R319</td>
                                    <td align="left" valign="middle">-87</td>
                                    <td align="left" valign="middle">-87</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    <!-- END: Card DATA-->
</div>
<!-- END: Content-->

<!-- START: Template JS-->
<script src="<?php echo base_url() ?>assets/temp_1/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/temp_1/vendors/moment/moment.js"></script>
<script src="<?php echo base_url() ?>assets/temp_1/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->

<script src="<?php echo base_url() ?>assets/temp_1/js/app.js"></script>
<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="<?php echo base_url() ?>assets/temp_1/vendors/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo base_url() ?>assets/temp_1/js/home.script.js"></script>
<script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/datatable/buttons/js/buttons.print.min.js"></script>

<!-- END: Page Vendor JS-->

  <!-- START: Page JS-->

  <script src="<?php echo base_url()?>assets/temp_1/js/datatable.script.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/vendors/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url()?>assets/temp_1/js/select2.script.js"></script>
<!-- END: Content-->
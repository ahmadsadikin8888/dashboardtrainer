<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title>Pick Admin</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/new_theme/dist/images/favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/new_theme/dist/css/main.css">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->
<!-- START: Body-->

<body id="main-container" class="default compact-menu" style="margin-top:-60px; margin-left:-60px;">
    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0">Dashboard Monitoring</h4>
                        </div>

                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <div class="row" style="margin-top:-15px;">
                <div class="col-12 col-lg-3  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order (today)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="height-200">
                                    <canvas id="chartjs-other-pie"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order by Channels (Today)</h6>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Channel</th>
                                        <th>Progress</th>
                                        <th>Success</th>
                                        <th>UnSuccess</th>
                                        <th>Total Order</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="zoom">
                                        <td>Email</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>SMS</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Whatsapp</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>OVR</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>OBC</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>TVMS</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>CTB</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Total</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Unique Customer (today)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="height-200">
                                    <div id="apex_bar_chart" class="height-400"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-3  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Unique Customer (today)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="height-200">
                                    <canvas id="chartjs-other-pie"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order by Regionial (Today)</h6>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Channel</th>
                                        <th>Progress</th>
                                        <th>Success</th>
                                        <th>UnSuccess</th>
                                        <th>Total Order</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="zoom">
                                        <td>Regional 1</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Regional 2</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Regional 3</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Regional 4</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Regional 5</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Regional 6</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Regional 7</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Regional 8</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                    <tr class="zoom">
                                        <td>Total</td>
                                        <td>20.000</td>
                                        <td class="text-success">20.000 </td>
                                        <td class="text-danger">20.000 </td>
                                        <td>20.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Unique Customer (today)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                    <li class="p-4 border-bottom">
                                        <div class="w-100">
                                            <a href="#">Total Success</a>
                                            <div class="barfiller h-7 rounded" data-color="#1ee0ac">
                                                <div class="tipWrap">
                                                    <span class="tip rounded success">
                                                        <span class="tip-arrow"></span>
                                                    </span>
                                                </div>
                                                <span class="fill" data-percentage="78"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-4 border-bottom">
                                        <div class="w-100">
                                            <a href="#">Total Unsuccess</a>
                                            <div class="barfiller h-7" data-color="#ffc107">
                                                <div class="tipWrap">
                                                    <span class="tip rounded warning">
                                                        <span class="tip-arrow"></span>
                                                    </span>
                                                </div>
                                                <span class="fill" data-percentage="45"></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="p-4 border-bottom">
                                        <div class="w-100">
                                            <a href="#">Sisa Order/Progress</a>
                                            <div class="barfiller h-7" data-color="#17a2b8">
                                                <div class="tipWrap">
                                                    <span class="tip rounded info">
                                                        <span class="tip-arrow"></span>
                                                    </span>
                                                </div>
                                                <span class="fill" data-percentage="56"></span>
                                            </div>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Pencairan H-1</h6>
                        </div>
                        <div class="card-content">
                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Unique Customer</th>
                                        <th>Total Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th>1.098</th>
                                    <th>650.090.000</th>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Pencairan Minggu ini</h6>
                        </div>
                        <div class="card-content">
                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Unique Customer</th>
                                        <th>Total Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th>1.098</th>
                                    <th>650.090.000</th>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Pencairan Bulan ini</h6>
                        </div>
                        <div class="card-content">
                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Unique Customer</th>
                                        <th>Total Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th>1.098</th>
                                    <th>650.090.000</th>
                                </tbody>
                            </table>
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
    <footer class="site-footer">
        2020 &copy; PICK
    </footer>
    <!-- END: Footer-->


    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>
    <!-- END: Back to top-->


    <!-- START: Template JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- END: Template JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/js/app.js"></script>
    <!-- END: APP JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/starrr/starrr.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="<?php echo base_url();?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <script src="<?php echo base_url();?>assets/new_theme/dist/js/home.script.js"></script>
    <!-- END: Page JS-->
</body>
<!-- END: Body-->

</html>
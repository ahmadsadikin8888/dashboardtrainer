<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title><?php echo $this->_appinfo['template_title_bar'] ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/flags-icon/css/flag-icon.min.css">
    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <!-- END: Page CSS-->

    <!--dibutuhkan-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/c3/c3.min.css">
    <link href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.min.css" rel="stylesheet">
    <!--end dibutuhkan-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
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
                            <h4 class="mb-0"><?php echo $title_page_big; ?></h4>
                        </div>
<!-- 
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
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
                                	<?php
                                	$total= ['progress'=>0,'success'=>0,'unsuccess'=>0,'all'=>0];
                                	if (count($total_order_by_channel) > 0) {
                                		for ($i=0; $i < count($total_order_by_channel); $i++) { 
	                                		$total['progress'] += $total_order_by_channel[$i]['counting_progress'];
	                                		$total['success'] += $total_order_by_channel[$i]['counting_success'];
	                                		$total['unsuccess'] += $total_order_by_channel[$i]['counting_unsuccess'];
	                                		$temp_total_channel = ($total_order_by_channel[$i]['counting_progress']+$total_order_by_channel[$i]['counting_success']+$total_order_by_channel[$i]['counting_unsuccess']);
	                                		$total['all'] += $temp_total_channel;
	                                		echo '<tr class="zoom">
	                                		<td>'.$total_order_by_channel[$i]['label_channel'].'</td>
	                                		<td>'.$total_order_by_channel[$i]['counting_progress'].'</td>
	                                		<td class="text-success">'.$total_order_by_channel[$i]['counting_success'].'</td>
	                                		<td class="text-danger">'.$total_order_by_channel[$i]['counting_unsuccess'].'</td>
	                                		<td>'.$temp_total_channel.'</td>
	                                		</tr>';
	                                	}
	                                	echo '<tr class="zoom">';
	                                	echo '<td>Total</td>';
	                                	echo '<td>'.$total['progress'].'</td>';
	                                	echo '<td class="text-success">'.$total['success'].'</td>';
	                                	echo '<td class="text-danger">'.$total['unsuccess'].'</td>';
	                                	echo '<td>'.$total['all'].'</td>';
	                                	echo '</tr>';
                                	}
                                	else{
                                		echo '<tr class="zoom"><td colspan="5" rowspan="2" class="text-center">Tidak ada data.</td></tr>';
                                	}
                                	?>
                                    <!-- <tr class="zoom">
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
                                    </tr> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Success by Channel (today)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div>
                                    <div id="apex_bar_chart"></div>
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
                                    <canvas id="chartjs-other-pie2"></canvas>
                                </div>
                                <table width="100%">
                                	<?php 
                                	if (count($summary_unique_customer) > 0) {
	                                	for ($i=0; $i < count($summary_unique_customer); $i++) { 
	                                		echo '<tr>
	                                		<td>'.$summary_unique_customer[$i]['label'].'</td>
	                                		<td>:</td>
	                                		<td>Rp.'.$summary_unique_customer[$i]['sum_bayar'].',-</td>
	                                		</tr>';
	                                	}
                                	}
                                	else{
                                		echo '<tr>
                                		<td colspan="3">Tidak ada Data.</td>
                                		</tr>';
                                	}
                                	?>
                                    <!-- <tr>
                                        <td>Lancar</td>
                                        <td>:</td>
                                        <td>Rp.20.000.000.000,-</td>
                                    </tr>
                                    <tr>
                                        <td>Tdk Lancar</td>
                                        <td>:</td>
                                        <td>Rp.20.000.000.000,-</td>
                                    </tr>
                                    <tr>
                                        <td>Menunggak</td>
                                        <td>:</td>
                                        <td>Rp.20.000.000.000,-</td>
                                    </tr> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-5 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order by Regional (Today)</h6>
                        </div>
                        <div class="card-body table-responsive p-0">

                            <table class="table font-w-600 mb-0">
                                <thead>
                                    <tr>
                                        <th>Regional</th>
                                        <th>Progress</th>
                                        <th>Success</th>
                                        <th>UnSuccess</th>
                                        <th>Total Order</th>

                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                	$total= ['progress'=>0,'success'=>0,'unsuccess'=>0,'all'=>0];
                                	if (count($total_order_by_regional) > 0) {
                                		for ($i=0; $i < count($total_order_by_regional); $i++) { 
	                                		$total['progress'] += $total_order_by_regional[$i]['counting_progress'];
	                                		$total['success'] += $total_order_by_regional[$i]['counting_success'];
	                                		$total['unsuccess'] += $total_order_by_regional[$i]['counting_unsuccess'];
	                                		$temp_total_channel = ($total_order_by_regional[$i]['counting_progress']+$total_order_by_regional[$i]['counting_success']+$total_order_by_regional[$i]['counting_unsuccess']);
	                                		$total['all'] += $temp_total_channel;
	                                		echo '<tr class="zoom">
	                                		<td>'.$total_order_by_regional[$i]['label_regional'].'</td>
	                                		<td>'.$total_order_by_regional[$i]['counting_progress'].'</td>
	                                		<td class="text-success">'.$total_order_by_regional[$i]['counting_success'].'</td>
	                                		<td class="text-danger">'.$total_order_by_regional[$i]['counting_unsuccess'].'</td>
	                                		<td>'.$temp_total_channel.'</td>
	                                		</tr>';
	                                	}
	                                	echo '<tr class="zoom">';
	                                	echo '<td>Total</td>';
	                                	echo '<td>'.$total['progress'].'</td>';
	                                	echo '<td class="text-success">'.$total['success'].'</td>';
	                                	echo '<td class="text-danger">'.$total['unsuccess'].'</td>';
	                                	echo '<td>'.$total['all'].'</td>';
	                                	echo '</tr>';
                                	}
                                	else{
                                		echo '<tr class="zoom"><td colspan="5" rowspan="2" class="text-center">Tidak ada data.</td></tr>';
                                	}
                                	?>
                                    <!-- <tr class="zoom">
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
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4  mt-3">
                    <div class="card">
                        <!-- <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Total Order (Today)</h6>
                        </div> -->
                        <div class="card-content">
                            <div class="card-body p-0">
                                <ul class="list-group list-unstyled">
                                	<?php
                                	$total_success = array_sum(array_map(function($item) { 
                                		return $item['count_order']; 
                                	}, $summary_order_by_unique_customer));
                                	$color_class = ['#1ee0ac', '#ffc107', '#17a2b8'];
                                	$color_class1 = ['success', 'warning', 'info'];
                                	if (count($summary_order_by_unique_customer) > 0) {
	                                	for ($i=0; $i < count($summary_order_by_unique_customer); $i++) { 
	                                		echo '<li class="p-4 border-bottom">
	                                		<div class="w-100">
	                                		<a href="#">Total Success '.$summary_order_by_unique_customer[$i]['label_2'].'</a>
	                                		<div class="barfiller h-7 rounded" data-color="'.$color_class[$i].'">
	                                		<div class="tipWrap">
	                                		<span class="tip rounded '.$color_class1[$i].'">
	                                		<span class="tip-arrow"></span>
	                                		</span>
	                                		</div>
	                                		<span class="fill" data-percentage="'.round(($summary_order_by_unique_customer[$i]['count_order']/$total_success)*100).'"></span>
	                                		</div>
	                                		</div>
	                                		</li>';
	                                	}
                                	}
                                	else{
                                		echo '<span class="text-center"> Tidak ada Data. </span>';
                                	}
                                	?>
                                    <!-- <li class="p-4 border-bottom">
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
                                    </li> -->


                                </ul>
                            </div>
                            <div class="card-footer text-muted">
                            	Total Order Success: <span><?php echo $total_success; ?></span>
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
                                    <th><?php echo $pencairan_h1[0]['unique_customer'] > 0 ? $pencairan_h1[0]['unique_customer'] : '-' ?></th>
                                    <th><?php echo !is_null($pencairan_h1[0]['total_tagihan']) ? $pencairan_h1[0]['total_tagihan'] : '-' ?></th>
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
                                    <th><?php echo $pencairan_seminggu[0]['unique_customer'] > 0 ? $pencairan_seminggu[0]['unique_customer'] : '-' ?></th>
									<th><?php echo !is_null($pencairan_seminggu[0]['total_tagihan']) ? $pencairan_seminggu[0]['total_tagihan'] : '-' ?></th>
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
                                    <th><?php echo $pencairan_sebulan[0]['unique_customer'] > 0 ? $pencairan_sebulan[0]['unique_customer'] : '-' ?></th>
									<th><?php echo !is_null($pencairan_sebulan[0]['total_tagihan']) ? $pencairan_sebulan[0]['total_tagihan'] : '-' ?></th>
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
        <?php echo $this->_appinfo['template_footer_right'] ?>
    </footer>
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
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.js"></script> -->
    <!-- END: APP JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/starrr/starrr.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!--dibutuhkan-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/c3/d3.v5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/c3/c3.min.js"></script>


    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>

    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-knob/jquery.knob.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/knob.script.js"></script>
    <!-- START: Page JS-->

    <!-- <script src="dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->
    <script>
        var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
        var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');
        var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
        var theme = 'light';
        if ($('body').hasClass('dark')) {
            theme = 'dark';
        }
        if ($('body').hasClass('dark-alt')) {
            theme = 'dark';
        }

        if ($('.barfiller').length > 0) {
        	$(".barfiller").each(function () {
        		$(this).barfiller({
        			barColor: $(this).data('color')
        		});
        	});
        }

        <?php  
        $dataset = array_column($summary_order, 'status_count');
        $datalabel = array_column($summary_order, 'label');
        ?>
        var config = {
        	type: 'doughnut',
        	data: {
        		datasets: [{
        			data: /*[3, 28, 67]*/<?php echo json_encode($dataset); ?>,
        			backgroundColor: [
        			'#1e3d73',
        			'#17a2b8',
        			'#ffc107'
        			],
        			label: 'Dataset 1'
        		}],
        		labels: /*[
        		'Progress',
        		'Success',
        		'Unsuccess'
        		]*/<?php echo json_encode($datalabel); ?>
        	},
        	options: {
        		responsive: true,
        		maintainAspectRatio: false,
        		legend: {
        			display: true,
        			position: 'bottom',
        			labels: {
        				fontColor: bodycolor
        			}
        		},
        		animation: {
        			animateScale: true,
        			animateRotate: true
        		},
        	}
        };

        <?php  
        $dataset = array_column($summary_unique_customer, 'count_status');
        $datalabel = array_column($summary_unique_customer, 'label');
        ?>
        var config2 = {
        	type: 'doughnut',
        	data: {
        		datasets: [{
        			data: /*[3, 28, 67]*/<?php echo json_encode($dataset); ?>,
        			backgroundColor: [
        			'#1e3d73',
        			'#17a2b8',
        			'#ffc107'
        			],
        			label: 'Dataset 1'
        		}],
        		labels: /*[
        		'Progress',
        		'Success',
        		'Unsuccess'
        		]*/<?php echo json_encode($datalabel); ?>
        	},
        	options: {
        		responsive: true,
        		maintainAspectRatio: false,
        		legend: {
        			display: true,
        			position: 'bottom',
        			labels: {
        				fontColor: bodycolor
        			}
        		},
        		animation: {
        			animateScale: true,
        			animateRotate: true
        		},
        	}
        };
        var chartjs_other_pie = document.getElementById("chartjs-other-pie");
        if (chartjs_other_pie) {
        	var ctx = document.getElementById('chartjs-other-pie').getContext('2d');
        	window.myDoughnut = new Chart(ctx, config);
        }
        var chartjs_other_pie2 = document.getElementById("chartjs-other-pie2");
        if (chartjs_other_pie) {
        	var ctx = document.getElementById('chartjs-other-pie2').getContext('2d');
        	window.myDoughnut = new Chart(ctx, config2);
        }

        <?php  
        $dataset = array_column($summary_success_by_channel, 'channel_count');
        $datalabel = array_column($summary_success_by_channel, 'label');
        ?>
        if ($("#apex_bar_chart").length > 0) {
        	options = {
        		theme: {
        			mode: theme
        		},
        		grid: {

        			yaxis: {
        				lines: {
        					show: false
        				}
        			}
        		},
        		chart: {
        			height: 318,
        			type: 'bar',
        		},
        		plotOptions: {
        			bar: {
        				horizontal: true,
        				columnWidth: '10',
        			}
        		},
        		dataLabels: {
        			enabled: false
        		},
        		colors: ['#1e3d73'],
        		series: [{
        			// data: [400, 430, 448, 470, 540, 580]
        			data: <?php echo json_encode($dataset); ?>
        		}],
        		xaxis: {
        			// categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France']
        			categories: <?php echo json_encode($datalabel); ?>

        		}
        	}

        	var chart = new ApexCharts(
        		document.querySelector("#apex_bar_chart"),
        		options
        		);
        	chart.render();
        }

        
    </script>
</body>
<!-- END: Body-->

</html>
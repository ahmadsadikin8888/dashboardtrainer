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
                <div class="col-12">

                    <form method="POST" action="<?php echo base_url('Dashboard/SmartCollection/Perfomance'); ?>">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <select class="form-control" name="template" id="template">
                                    <option value="monthly">Monthly</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="daily" selected="">Daily</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input class="form-control" type="date" name="datena" id="datena" value="<?php echo $sel_date; ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" id="filter" class="btn btn-primary">Filter</button>
                            </div>
                        </div>

                    </form>
                    <br>

                </div>

            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <div class="row" style="margin-top:-15px;">
                <div class="col-12 col-lg-3 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order (Month: <?php echo date('m-Y', strtotime($sel_date)); ?>)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body p-0">
                                <!-- Start Summary Order -->
                                <ul class="list-group list-unstyled">
                                    <?php 
                                    // $color_class = ['success', 'warning', 'info', 'primary', 'default'];
                                    if (count($summary_order_by_date) > 0) {
                                        $total_all_status = array_sum(array_map(function($item) { 
                                            return $item['status_count']; 
                                        }, $summary_order_by_date));
                                        for ($i=0; $i < count($summary_order_by_date); $i++) { 
                                            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                            echo '<li class="p-2 border-bottom">
                                            <div class="w-100">
                                            <a href="#">Total '.$summary_order_by_date[$i]['label'].'</a>
                                            <div class="barfiller h-7 rounded" data-color="'.$color.'">
                                            <div class="tipWrap">
                                            <span class="tip rounded " style="background:'.$color.'">
                                            <span class="tip-arrow"></span>
                                            </span>
                                            </div>
                                            <span class="fill" data-percentage="'.round( ($summary_order_by_date[$i]['status_count']/$total_all_status)*100 ).'"></span>
                                            </div>
                                            </div>
                                            </li>';
                                        }
                                    ?>
                                        <!-- <li class="p-2 border-bottom">
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
                                        <li class="p-2 border-bottom">
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
                                        <li class="p-2 border-bottom">
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
                                    <?php
                                    }
                                    else{ ?>
                                        <li class="p-2 border-bottom">
                                            <div class="w-100">
                                                <a href="#">Tidak ada data</a>
                                                <div class="barfiller h-7" data-color="red">
                                                    <div class="tipWrap">
                                                        <span class="tip rounded danger">
                                                            <span class="tip-arrow"></span>
                                                        </span>
                                                    </div>
                                                    <span class="fill" data-percentage="0"></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php 
                                    }
                                    ?>
                                </ul>
                                <!-- End Summary Order -->
                                <br>
                                <h6>Total Unique Customer : <?php echo count($summary_unique_customer_by_date) > 0 && isset($summary_unique_customer_by_date[0]['count_pay']) ? $summary_unique_customer_by_date[0]['count_customer'] : 0; ?> </h6>
                                <!-- Start Unique Customer -->
                                <ul class="list-group list-unstyled">
                                    <?php  
                                    if (count($summary_unique_customer_by_date) > 0 && isset($summary_unique_customer_by_date[0]['count_pay'])) { 

                                        $count_customer = $summary_unique_customer_by_date[0]['count_customer'] > 0 ? $summary_unique_customer_by_date[0]['count_customer'] : 1;
                                        ?>
                                        <li class="p-2 border-bottom">
                                            <div class="w-100">
                                                <a href="#">Cust Payment</a>
                                                <div class="barfiller h-7 rounded" data-color="#1ee0ac">
                                                    <div class="tipWrap">
                                                        <span class="tip rounded success">
                                                            <span class="tip-arrow"></span>
                                                        </span>
                                                    </div>
                                                    <span class="fill" data-percentage="<?php echo round(($summary_unique_customer_by_date[0]['count_pay']/$count_customer)*100) ; ?>"></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="w-100">
                                                <a href="#">Cust NoPayment</a>
                                                <div class="barfiller h-7" data-color="#ffc107">
                                                    <div class="tipWrap">
                                                        <span class="tip rounded warning">
                                                            <span class="tip-arrow"></span>
                                                        </span>
                                                    </div>
                                                    <span class="fill" data-percentage="<?php echo round(($summary_unique_customer_by_date[0]['count_nopay']/$count_customer)*100) ; ?>"></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    else{ ?>
                                        <li class="p-2 border-bottom">
                                            <div class="w-100">
                                                <a href="#">Tidak ada data</a>
                                                <div class="barfiller h-7" data-color="red">
                                                    <div class="tipWrap">
                                                        <span class="tip rounded danger">
                                                            <span class="tip-arrow"></span>
                                                        </span>
                                                    </div>
                                                    <span class="fill" data-percentage="0"></span>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                                <h6>Total Payment : Rp.<?php echo count($summary_unique_customer_by_date) > 0  && isset($summary_unique_customer_by_date[0]['count_pay']) ? $summary_unique_customer_by_date[0]['sum_payment'] : 0; ?>,- </h6>
                                <!-- End Unique Customer -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-9 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Order by date (Month: <?php echo date('m-Y', strtotime($sel_date)); ?>)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div>
                                    <div id="c3_bar_chart"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <h6 class="card-title">Summary Payment by Regional (Month: <?php echo date('m-Y', strtotime($sel_date)); ?>)</h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <table width="100%">
                                    <tr>
                                        <!-- Start Summary Payment by Regional -->
                                        <?php 
                                        if (count($summary_payment_by_regional) > 0) { 
                                            // cari total all payment
                                            $total_all_sum_payment = array_sum(array_map(function($item) { 
                                                return $item['sum_payment']; 
                                            }, $summary_payment_by_regional));
                                            $total_all_count_order = array_sum(array_map(function($item) { 
                                                return $item['count_order']; 
                                            }, $summary_payment_by_regional));
                                            $total_all_sum_payment = array_sum(array_map(function($item) { 
                                                return $item['count_success']; 
                                            }, $summary_payment_by_regional));

                                            for ($i=0; $i < count($summary_payment_by_regional); $i++) { 
                                                $percentage_order = floor(($summary_payment_by_regional[$i]['count_order']/$total_all_count_order)*100);
                                                $percentage_success = floor(($summary_payment_by_regional[$i]['count_success']/$total_all_sum_payment)*100);

                                            ?>
                                                <td>
                                                    <div class="card m-2">
                                                        <div class="card-header">
                                                            <h6 class="card-title"><?php echo $summary_payment_by_regional[$i]['label_regional']; ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="card-content mt-3">
                                                        <table width="100%">
                                                            <tr align="center">
                                                                <td>
                                                                    <input class="knob" data-width="150" readonly
                                                                    data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                    data-skin="tron" data-thickness=".1" value="<?php echo floor(($summary_payment_by_regional[$i]['sum_payment']/$total_all_sum_payment)*100); ?>">

                                                                </td>
                                                            </tr>
                                                            <tr align="center">
                                                                <td>
                                                                    <div class="btn btn-primary mb-2">Rp. <?php echo $summary_payment_by_regional[$i]['sum_payment']; ?>,-</div>
                                                                </td>
                                                            </tr>
                                                            <tr align="center">
                                                                <td>
                                                                    <h3><i class="icon-people"></i></h3>
                                                                </td>
                                                            </tr>
                                                            <tr align="center">
                                                                <td>
                                                                    <h4><?php echo $summary_payment_by_regional[$i]['count_customer']; ?></h4>
                                                                </td>
                                                            </tr>
                                                            <tr align="left">
                                                                <td>
                                                                    Total Order : <?php echo $percentage_order; ?>%
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated "
                                                                        role="progressbar" aria-valuenow="<?php echo $percentage_order; ?>"
                                                                        aria-valuemin="0" aria-valuemax="100"><?php echo $summary_payment_by_regional[$i]['count_order']; ?></div>
                                                                    </div>
                                                                    Total Success : <?php echo $percentage_success; ?>%
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated "
                                                                        role="progressbar" aria-valuenow="<?php echo $percentage_success; ?>"
                                                                        aria-valuemin="0" aria-valuemax="100"><?php echo $summary_payment_by_regional[$i]['count_success']; ?></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                </td>
                                            <?php
                                            }
                                        ?>
                                            <!-- <td>
                                                <div class="card m-2">
                                                    <div class="card-header">
                                                        <h6 class="card-title">Regional-2</h6>
                                                    </div>
                                                </div>
                                                <div class="card-content mt-3">
                                                    <table width="100%">
                                                        <tr align="center">
                                                            <td>
                                                                <input class="knob" data-width="150" readonly
                                                                data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                data-skin="tron" data-thickness=".1" value="75">
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <div class="btn btn-primary mb-2">Rp. 2.600.000.000,-</div>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h3><i class="icon-people"></i></h3>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h4>11.151</h4>
                                                            </td>
                                                        </tr>
                                                        <tr align="left">
                                                            <td>
                                                                Total Order : 100%
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                                Total Success : 75%
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated w-75"
                                                                        role="progressbar" aria-valuenow="75"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="card m-2">
                                                    <div class="card-header">
                                                        <h6 class="card-title">Regional-3</h6>
                                                    </div>
                                                </div>
                                                <div class="card-content mt-3">
                                                    <table width="100%">
                                                        <tr align="center">
                                                            <td>
                                                                <input class="knob" data-width="150" readonly
                                                                data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                data-skin="tron" data-thickness=".1" value="75">
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <div class="btn btn-primary mb-2">Rp. 2.600.000.000,-</div>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h3><i class="icon-people"></i></h3>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h4>11.151</h4>
                                                            </td>
                                                        </tr>
                                                        <tr align="left">
                                                            <td>
                                                                Total Order : 100%
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                                Total Success : 75%
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated w-75"
                                                                        role="progressbar" aria-valuenow="75"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="card m-2">
                                                    <div class="card-header">
                                                        <h6 class="card-title">Regional-4</h6>
                                                    </div>
                                                </div>
                                                <div class="card-content mt-3">
                                                    <table width="100%">
                                                        <tr align="center">
                                                            <td>
                                                                <input class="knob" data-width="150" readonly
                                                                    data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                    data-skin="tron" data-thickness=".1" value="75">
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <div class="btn btn-primary mb-2">Rp. 2.600.000.000,-</div>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h3><i class="icon-people"></i></h3>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h4>11.151</h4>
                                                            </td>
                                                        </tr>
                                                        <tr align="left">
                                                            <td>
                                                                Total Order : 100%
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                                Total Success : 75%
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated w-75"
                                                                        role="progressbar" aria-valuenow="75"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="card m-2">
                                                    <div class="card-header">
                                                        <h6 class="card-title">Regional-5</h6>
                                                    </div>
                                                </div>
                                                <div class="card-content mt-3">
                                                    <table width="100%">
                                                        <tr align="center">
                                                            <td>
                                                                <input class="knob" data-width="150" readonly
                                                                data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                data-skin="tron" data-thickness=".1" value="75">
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <div class="btn btn-primary mb-2">Rp. 2.600.000.000,-</div>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h3><i class="icon-people"></i></h3>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h4>11.151</h4>
                                                            </td>
                                                        </tr>
                                                        <tr align="left">
                                                            <td>
                                                                Total Order : 100%
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                                Total Success : 75%
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated w-75"
                                                                        role="progressbar" aria-valuenow="75"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="card m-2">
                                                    <div class="card-header">
                                                        <h6 class="card-title">Regional-6</h6>
                                                    </div>
                                                </div>
                                                <div class="card-content mt-3">
                                                    <table width="100%">
                                                        <tr align="center">
                                                            <td>
                                                                <input class="knob" data-width="150" readonly
                                                                data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                data-skin="tron" data-thickness=".1" value="75">
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <div class="btn btn-primary mb-2">Rp. 2.600.000.000,-</div>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h3><i class="icon-people"></i></h3>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h4>11.151</h4>
                                                            </td>
                                                        </tr>
                                                        <tr align="left">
                                                            <td>
                                                                Total Order : 100%
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                                Total Success : 75%
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated w-75"
                                                                        role="progressbar" aria-valuenow="75"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="card m-2">
                                                    <div class="card-header">
                                                        <h6 class="card-title">Regional-7</h6>
                                                    </div>
                                                </div>
                                                <div class="card-content mt-3">
                                                    <table width="100%">
                                                        <tr align="center">
                                                            <td>
                                                                <input class="knob" data-width="150" readonly
                                                                data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                data-skin="tron" data-thickness=".1" value="75">
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <div class="btn btn-primary mb-2">Rp. 2.600.000.000,-</div>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h3><i class="icon-people"></i></h3>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h4>11.151</h4>
                                                            </td>
                                                        </tr>
                                                        <tr align="left">
                                                            <td>
                                                                Total Order : 100%
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated w-100"
                                                                        role="progressbar" aria-valuenow="100"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                                Total Success : 75%
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated w-75"
                                                                        role="progressbar" aria-valuenow="75"
                                                                        aria-valuemin="0" aria-valuemax="100">500.000</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td> -->
                                        <?php
                                        }
                                        else{ ?>
                                            <td>
                                                <div class="card m-2">
                                                    <div class="card-header">
                                                        <h6 class="card-title">Tidak Ada Data</h6>
                                                    </div>
                                                </div>
                                                <div class="card-content mt-3">
                                                    <table width="100%">
                                                        <tr align="center">
                                                            <td>
                                                                <input class="knob" data-width="150" readonly
                                                                    data-displayPrevious=true data-fgColor="#0bb2d4"
                                                                    data-skin="tron" data-thickness=".1" value="0">

                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <div class="btn btn-primary mb-2">Rp. 0,-</div>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h3><i class="icon-people"></i></h3>
                                                            </td>
                                                        </tr>
                                                        <tr align="center">
                                                            <td>
                                                                <h4>-</h4>
                                                            </td>
                                                        </tr>
                                                        <tr align="left">
                                                            <td>
                                                                Total Order : 0%
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                        role="progressbar" aria-valuenow="0"
                                                                        aria-valuemin="0" aria-valuemax="100">-</div>
                                                                </div>
                                                                Total Success : 0%
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                                                        role="progressbar" aria-valuenow="0"
                                                                        aria-valuemin="0" aria-valuemax="100">-</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                        <!-- End Summary Payment by Regional -->
                                    </tr>
                                </table>
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
        $( document ).ready(function() {

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

            if ($('#c3_bar_chart').length > 0) {
                <?php
                if (count($summary_order_by_date_chart) > 0) {
                    $data_xAxis = array_column($summary_order_by_date_chart, 'label_date');
                    // Prepend ke index awal
                    array_unshift($data_xAxis,'x');
                    $data_Order = array_column($summary_order_by_date_chart, 'count_order');
                    // Prepend ke index awal
                    array_unshift($data_Order,'Order');
                    $data_Success = array_column($summary_order_by_date_chart, 'count_success');
                    // Prepend ke index awal
                    array_unshift($data_Success,'Success');
                    $data_Payment = array_column($summary_order_by_date_chart, 'count_pay');
                    // Prepend ke index awal
                    array_unshift($data_Payment,'Payment');
                }
                else{
                    $data_xAxis = ['x'];
                    $data_Order = ['Order'];
                    $data_Success = ['Success'];
                    $data_Payment = ['Payment'];
                }
                ?>
                var chart = c3.generate({
                    bindto: '#c3_bar_chart',
                    data: {
                        x: 'x',
                        columns: [
                        // ['x', '2010-01-01', '2011-01-01', '2012-01-01', '2013-01-01', '2014-01-01', '2015-01-01'],
                        <?php echo json_encode($data_xAxis); ?>,
                        // Start Data
                        /*['Order', 30, 200, 100, 400, 150, 250, 400, 150, 250, 30, 200, 100, 400,
                        150, 250, 400, 150, 250, 250, 30, 200, 100, 400, 150, 250, 400, 150,
                        250, 250, 400, 150, 250
                        ],
                        ['Success', 130, 100, 140, 200, 150, 50, 30, 200, 100, 400, 150, 250,
                        400, 150, 250, 400, 150, 250, 250, 30, 200, 100, 400, 150, 250, 400,
                        150, 250, 250, 400, 150, 250
                        ],
                        ['Payment', 90, 81, 120, 173, 120, 31, 5, 99, 26, 387, 123, 201,
                        300, 120, 160, 392, 76, 86, 144, 25, 54, 39, 86, 121, 146, 201,
                        106, 90, 89, 300, 150, 222
                        ]*/
                        <?php echo json_encode($data_Order); ?>,
                        <?php echo json_encode($data_Success); ?>,
                        <?php echo json_encode($data_Payment); ?>,
                        // End Data
                        ],
                        type: 'bar',
                        types: {
                            'Payment': 'line'
                        },
                        colors: {
                            'Order': '#9999ff', 
                            'Success': '#ff8c1a', 
                            'Payment': '#ffc34d' 
                        },
                    },
                    axis: {
                        x: {
                            type: 'timeseries',
                            tick: {
                                format: '%m-%d'
                            }
                        }
                    },
                    bar: {
                        width: {
                                ratio: 0.5 // this makes bar width 50% of length between ticks
                            }
                            // or
                            //width: 100 // this makes bar width 100px
                        }
                    });
            }

            // Isi value
            $('#template').val('<?php echo $sel_template; ?>');
        });

    </script>
</body>
<!-- END: Body-->

</html>
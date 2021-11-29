<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <?php
    if (isset($_GET['start'])) {
    } else {
    ?>
        <!-- <meta http-equiv="refresh" content="300"> -->
    <?php
    }
    function nice_number($n)
    {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n / 1000000000000), 2) . ' T';
        elseif ($n > 1000000000) return round(($n / 1000000000), 2) . ' B';
        elseif ($n > 1000000) return round(($n / 1000000), 2) . ' M';
        elseif ($n > 1000) return $n;

        return number_format($n);
    }

    ?>

    <meta charset="UTF-8">
    <title>Dashboard</title>
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
    <link href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.min.css" rel="stylesheet">

    <!-- END: Page CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.css">
    <!-- END: Page CSS-->
    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/css/main.css">
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/jquery-knob/jquery.knob.min.js" type="text/javascript"></script> -->
    <!-- END: Page CSS-->
    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bundle.js"></script>
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
    <div id="header-fix" class="header fixed-top">
        <div class="site-width">
            <nav class="navbar navbar-expand-lg  p-0">
                <img src="<?php echo base_url("api/Public_Access/get_logo_template") ?>" class="header-brand-img h-<?php echo $this->_appinfo['template_logo_size'] ?>" alt="ybs logo">

            </nav>
        </div>
    </div>
    <!-- END: Header-->
    <!-- START: Main Menu-->
    <div class="sidebar">
        <div class="site-width">

            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li>
                    <a href="<?php echo base_url(); ?>"><i class="icon-home mr-1"></i> Home</a>
                </li>
                <li class="active">
                    <a href="<?php echo base_url() . "Dc/Dc/dashboard" ?>"><i class="icon-chart mr-1"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/agent" ?>"><i class="icon-chart mr-1"></i> Agent</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/kandidat" ?>"><i class="icon-chart mr-1"></i> Kandidat</a>
                </li>


            </ul>
            <!-- END: Menu-->

        </div>
    </div>
    <!-- END: Main Menu-->


    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <!-- <h4 class="mb-0">Dashboard</h4>
                            <i>*Last Update at <?php echo  date("d F Y h:i A", strtotime($last_update)); ?></i> -->
                        </div>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">M O R E N A</h6>
                            <h3 class="card-title">Monitoring Recruitment dan Initial Training</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader text-center">CAPLAN</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($caplan); ?></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader text-center">CV MASUK VIA EMAIL</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($status_kandidat['email']) ?></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader text-center">TOTAL AGENT EKSISTING</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($total_agent); ?></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="subheader text-center">PROSES RESIGN</div>
                                            <div class="h4 mb-3 text-center"><?php echo number_format($status_agent['PENGAJUAN RESIGN']); ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="card-title">INITIAL TRAINING BATCH 30 TAM BANDUNG </h6>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">

                                                <div id="apex_bar_chart" class="height-500"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="card-title">PERSENTASE KELULUSAN </h6>
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
                            </div>
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="card-title">KOMPOSISI UNDER TEAM </h6>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">

                                                <div id="apex_bar_chart_2" class="height-500"></div>
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

    </main>
    <!-- END: Content-->
    <!-- START: Footer-->
    <footer class="site-footer">
        2020 © Sy-ANIDA
    </footer>
    <!-- END: Footer-->



    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>


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
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.lineProgressbar.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/lineprogressbar/jquery.barfiller.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- START: Page JS-->
    <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
    <!-- END: Page JS-->

    <!---- START page datatable--->
    <!-- END: Page Vendor JS-->

    <!---- END page datatable--->

    <!-- END: Back to top-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <script type="text/javascript">
        (function($) {
            "use strict";
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
            /////////////////////////////////// Analytic Chart /////////////////////
            if ($("#apex_bar_chart").length > 0) {
                var options = {
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
                        height: 185,
                        type: 'bar',
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '10',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: ['#1e3d73'],
                    series: [{
                        data: [<?php echo number_format($status_kandidat['SORTIR CV'], 0) ?>, <?php echo number_format($status_kandidat['INTERVIEW'], 0) ?>, <?php echo number_format($status_kandidat['SOFTSKILL'], 0) ?>]
                    }],
                    xaxis: {
                        categories: ['SORTIR CV', 'INTERVIEW', 'SOFTSKILL']

                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#apex_bar_chart"),
                    options
                );
                chart.render();
            }
            if ($("#apex_bar_chart_2").length > 0) {
                var options = {
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
                        height: 300,
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
                        data: [<?php
                                if (count($status_tl) > 0) {
                                    foreach ($status_tl as $tl => $jml) {
                                        echo number_format($jml, 0) . ",";
                                    }
                                }
                                ?>]
                    }],
                    xaxis: {
                        categories: [<?php
                                        if (count($status_tl) > 0) {
                                            foreach ($status_tl as $tl => $jml) {
                                                echo "'" . $tl . "',";
                                            }
                                        }
                                        ?>]

                    }
                }

                var chart = new ApexCharts(
                    document.querySelector("#apex_bar_chart_2"),
                    options
                );
                chart.render();
            }
            var config = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [<?php echo number_format($status_kelulusan['ProsesTraining'], 0) ?>, <?php echo number_format($status_kelulusan['Buffer'], 0) ?>],
                        backgroundColor: [
                            '#1e3d73',
                            '#17a2b8'
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'ProsesTraining',
                        'Buffer'
                    ]
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

        })(jQuery);
    </script>

</body>
<!-- END: Body-->

</html>
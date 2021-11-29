<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <title>Profiling - WALLBOARD VERIFIED</title>
    <script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
    <script>
        var data_token = "<?php echo  $this->_token ?>";
        var sec_val = "<?php echo $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() ?>&";
        var xax = "<?php echo $fparent ?>"
    </script>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fw/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/tabler/bower_components/Ionicons/css/ionicons.min.css" />

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/toastr-master/toastr.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.css">

    <script src="<?php echo base_url() ?>assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vendors/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>
    <script src="<?php echo base_url() ?>assets/js/core.js"></script>
    <script src="<?php echo base_url() ?>assets/toastr-master/toastr.js"></script>


    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.css" />
    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Resources/MooTools-Core-1.6.0.js"></script>


    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/EnlighterJS/Build/EnlighterJS.min.js"></script>
    <meta name="EnlighterJS" content="Advanced javascript based syntax highlighting" data-language="javascript" data-indent="2" data-selector-block="pre" data-selector-inline="code" />

    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/chartjs/Chart.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/chartjs/utils.js"></script>

</head>


<!-- <body style="background-color:#202938;color:#efeef0; font-family:'Open Sans',Helvetica,Arial,sans-serif;"> -->


<body style="background-color:#202938;color:#efeef0; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%">
        <tr>
            <td width="33%">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">
                <br>
                <form method="GET" action="#">
                    From <input type="date" name="start" id="start" value="<?php echo $start; ?>"> To <input type="date" name="end" id="end" value="<?php echo $end; ?>"><button type="submit" id="filter"><i class="fa fa-search"></i></button><br>
                </form>
            </td>
            <td width="34%" style="text-align:center;">
                <h1>PROFILING WALLBOARD VERIFIED</h1>
            </td>
            <td width="33%" style="text-align:right;">
                <img src="<?php echo base_url('api/Public_Access/get_logo_login') ?>" class="fontlogo" alt="" width="200px">

            </td>

        </tr>
    </table>
    <table width="100%">
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;" width="40%" colspan='2'><i class="fa fa-cog"></i> VERIFIED</td>
            <td rowspan='4' width="30%">
                <table width="95%" style="text-align:center;">
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">INFOMEDIA_MOS</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_reguler"><?php echo number_format($sumber_all['INFOMEDIA_MOS']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">MYCX-147</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_rate"><?php echo number_format($sumber_all['MYCX-147']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">MYCX-OTHERS</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_rate"><?php echo number_format($sumber_all['MYCX-OTHERS']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">MYCX-PLASA</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_rate"><?php echo number_format($sumber_all['MYCX-PLASA']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">MYCX-SOCMED</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_reguler"><?php echo number_format($sumber_all['MYCX-SOCMED']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">MYINDIHOME</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_rate"><?php echo number_format($sumber_all['MYINDIHOME']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">infomedia by etl</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_reguler"><?php echo number_format($sumber_all['infomedia by etl']) ?></td>
                    </tr>
                </table>

            </td>
            <td rowspan='4' width="30%">
                <table width="95%" style="text-align:center;">
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">SALPER</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_reguler"><?php echo number_format($sumber_all['SALPER']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">SC FCC</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_rate"><?php echo number_format($sumber_all['SC FCC']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ff8e35;" valign="bottom">SelfProfiling</td>
                        <td style="text-align:right;font-size: 50px;color:#ff8e35;border-bottom:4px solid #ff8e35;" valign="bottom" id="connected_rate"><?php echo number_format($sumber_all['SelfProfiling']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">TIKET-KOMPLAIN</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_rate"><?php echo number_format($sumber_all['TIKET-KOMPLAIN']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">infomedia</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_reguler"><?php echo number_format($sumber_all['infomedia']) ?></td>
                    </tr>

                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;border-bottom:4px solid #ce2f4f;" valign="bottom">ideas</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;border-bottom:4px solid #ce2f4f;" valign="bottom" id="notconnected_rate"><?php echo number_format($sumber_all['ideas']) ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;color:#a3a8ac;font-size:25px;" valign="bottom">&nbsp;</td>
                        <td style="text-align:right;font-size: 50px;color:#ce2f4f;" valign="bottom" id="notconnected_reguler">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="color:#a0bc2e;font-size:150px;text-align:center;" id="verified_mos" colspan='2'><?php echo number_format($total); ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;"><i class="fa fa-cog"></i> CHANNEL</td>
            <td style="color:#a3a8ac;font-size:25px;text-align:center;"><i class="fa fa-cog"></i> REGIONAL</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="color:#fff;font-size:150px;text-align:center;"><?php echo 13; ?></td>
            <td style="color:#fff;font-size:150px;text-align:center;"><?php echo 7; ?></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table width="100%" style="color:#a0bc2e;">
        <tr>
            <td>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-status bg-red"></div>
                                <div class="card-header">
                                    <h3 class="card-title">ALL REGIONAL</h3>

                                </div>
                                <div class="card-body">
                                    <canvas id="chart_regional"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-status bg-red"></div>
                                <div class="card-header">
                                    <h3 class="card-title">VERIFIED PERIODE <?php echo $start . " - " . $end; ?></h3>

                                </div>
                                <div class="card-body">
                                    <canvas id="chart_all"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-status bg-red"></div>
                                <div class="card-header">
                                    <h3 class="card-title">SC FCC</h3>

                                </div>
                                <div class="card-body">
                                    <canvas id="chart_scfcc"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-status bg-red"></div>
                                <div class="card-header">
                                    <h3 class="card-title">INFOMEDIA</h3>

                                </div>
                                <div class="card-body">
                                    <canvas id="chart_infomedia"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-status bg-red"></div>
                                <div class="card-header">
                                    <h3 class="card-title">CUSTOMER TOUCH POIN</h3>

                                </div>
                                <div class="card-body">
                                    <canvas id="chart_ctp"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-status bg-red"></div>
                                <div class="card-header">
                                    <h3 class="card-title">SALPER, Tiket-Komplain,SELPRO,ideas</h3>

                                </div>
                                <div class="card-body">
                                    <canvas id="chart_salper"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <script>
        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var color = Chart.helpers.color;
        window.onload = function() {

            var barChartData_all = {
                labels: [
                    <?php
                    $total_reg = 0;

                    if (count($periode) > 0) {
                        foreach ($periode as $nama_periode => $data_periode) {
                            echo '"' . $nama_periode . '",';
                        }
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Verified BAR',
                    type: 'bar',
                    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.red,
                    borderWidth: 1,
                    data: [
                        <?php
                        $total_reg = 0;

                        if (count($periode) > 0) {
                            foreach ($periode as $nama_periode => $data_periode) {
                                echo $data_periode . ',';
                            }
                        }
                        ?>
                    ]
                }, {
                    label: 'Verified LINE',
                    type: 'line',
                    // backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.blue,
                    fill: false,
                    borderWidth: 2,
                    data: [
                        <?php
                        $total_reg = 0;

                        if (count($periode) > 0) {
                            foreach ($periode as $nama_periode => $data_periode) {
                                echo $data_periode . ',';
                            }
                        }
                        ?>
                    ]
                }]

            };

            var ctx_all = document.getElementById('chart_all').getContext('2d');
            window.myBar = new Chart(ctx_all, {
                type: 'bar',
                data: barChartData_all,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: ' '
                    }
                }
            });

            var barChartData_regional = {
                labels: ['Regional 1', 'Regional 2', 'Regional 3', 'Regional 4', 'Regional 5', 'Regional 6', 'Regional 7'],
                datasets: [{
                    label: 'Regional',
                    // backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.red,
                    borderWidth: 1,
                    data: [
                        <?php echo $regional['R1'] ?>,
                        <?php echo $regional['R2'] ?>,
                        <?php echo $regional['R3'] ?>,
                        <?php echo $regional['R4'] ?>,
                        <?php echo $regional['R5'] ?>,
                        <?php echo $regional['R6'] ?>,
                        <?php echo $regional['R7'] ?>,
                    ],
                    backgroundColor: [
                        color(chartColors.red).alpha(0.5).rgbString(),
                        color(chartColors.orange).alpha(0.5).rgbString(),
                        color(chartColors.yellow).alpha(0.5).rgbString(),
                        color(chartColors.green).alpha(0.5).rgbString(),
                        color(chartColors.blue).alpha(0.5).rgbString(),
                        color(chartColors.purple).alpha(0.5).rgbString(),
                        color(chartColors.grey).alpha(0.5).rgbString(),
                    ],
                }]

            };

            var ctx_regional = document.getElementById('chart_regional').getContext('2d');
            window.myBar = new Chart(ctx_regional, {
                type: 'polarArea',
                data: barChartData_regional,
                options: {
                    responsive: true,
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: ' '
                    }
                }
            });




            var barChartData_scfcc = {
                labels: [
                    <?php
                    $total_reg = 0;

                    if (count($sumber['SC FCC']['periode']) > 0) {
                        foreach ($sumber['SC FCC']['periode'] as $nama_periode => $data_periode) {
                            echo '"' . $nama_periode . '",';
                        }
                    }
                    ?>
                ],
                datasets: [{
                        label: ['Verified'],
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            <?php
                            $total_reg = 0;

                            if (count($sumber['SC FCC']['periode']) > 0) {
                                foreach ($sumber['SC FCC']['periode'] as $nama_periode => $data_periode) {
                                    echo $data_periode . ',';
                                }
                            }
                            ?>
                        ]
                    }

                ]

            };

            var ctx_scfcc = document.getElementById('chart_scfcc').getContext('2d');
            window.myBar = new Chart(ctx_scfcc, {
                type: 'bar',
                data: barChartData_scfcc,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: ' '
                    }
                }
            });


            /* GRAF INFOMEDIA*/
            var barChartData_infomedia = {
                labels: [
                    <?php
                    $total_reg = 0;
                    foreach ($list_periode as $key => $value) {
                        $tgl = $value->format('Y-m-d');
                        echo "'" . $tgl . "',";
                    }

                    ?>
                ],
                datasets: [
                    {
                        label: ['infomedia'],
                        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.blue,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['infomedia']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['Server infomedia'],
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $server_infomedia[$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: [' '],
                        backgroundColor: color(window.chartColors.white).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.white,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                echo  ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['infomedia by etl'],
                        backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.orange,
                        borderWidth: 1,
                        data: [,
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['infomedia by etl']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['INFOMEDIA_MOS'],
                        backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.purple,
                        borderWidth: 1,
                        data: [,
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['INFOMEDIA_MOS']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    }

                ]

            };

            var ctx_infomedia = document.getElementById('chart_infomedia').getContext('2d');
            window.myBar = new Chart(ctx_infomedia, {
                type: 'bar',
                data: barChartData_infomedia,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: ' '
                    }
                }
            });
            /*  END GRAF INFOMEDIA */

            /* GRAF CTP*/
            var barChartData_ctp = {
                labels: [
                    <?php
                    $total_reg = 0;
                    foreach ($list_periode as $key => $value) {
                        $tgl = $value->format('Y-m-d');
                        echo "'" . $tgl . "',";
                    }

                    ?>
                ],
                datasets: [{
                        label: ['MYCX-147'],
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['MYCX-147']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['MYCX-OTHERS'],
                        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.blue,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['MYCX-OTHERS']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['MYCX-PLASA'],
                        backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.orange,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['MYCX-PLASA']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['MYCX-SOCMED'],
                        backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.purple,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['MYCX-SOCMED']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['MYINDIHOME'],
                        backgroundColor: color(window.chartColors.grey).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.grey,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['MYINDIHOME']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    }


                ]

            };

            var ctx_ctp = document.getElementById('chart_ctp').getContext('2d');
            window.myBar = new Chart(ctx_ctp, {
                type: 'bar',
                data: barChartData_ctp,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: ' '
                    }
                }
            });
            /*  END GRAF CTP */

            /* GRAF OTHER*/
            var barChartData_salper = {
                labels: [
                    <?php
                    $total_reg = 0;
                    foreach ($list_periode as $key => $value) {
                        $tgl = $value->format('Y-m-d');
                        echo "'" . $tgl . "',";
                    }

                    ?>
                ],
                datasets: [{
                        label: ['SALPER'],
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['SALPER']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['TIKET-KOMPLAIN'],
                        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.blue,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['TIKET-KOMPLAIN']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['SelfProfiling'],
                        backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.orange,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['SelfProfiling']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    },
                    {
                        label: ['ideas'],
                        backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.purple,
                        borderWidth: 1,
                        data: [
                            <?php
                            foreach ($list_periode as $key => $value) {
                                $tgl = $value->format('Y-m-d');
                                echo $sumber['ideas']['periode'][$tgl] . ",";
                            }
                            ?>
                        ]
                    }



                ]

            };

            var ctx_salper = document.getElementById('chart_salper').getContext('2d');
            window.myBar = new Chart(ctx_salper, {
                type: 'bar',
                data: barChartData_salper,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: ' '
                    }
                }
            });
            /*  END GRAF OTHER */

        };
    </script>
    <script id="src_ybs" src="<?php echo base_url() ?>assets/ybs.js"></script>
    <script src="<?php echo base_url() ?>assets/ybs-slider/ybs-slider.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/input-mask/js/jquery.mask.min.js"></script>

</body>

</html>
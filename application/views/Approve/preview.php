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
    <title>Digital Sales - Preview</title>
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />

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
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/datalead" ?>"><i class="icon-chart mr-1"></i> Data Lead</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/campaign" ?>"><i class="icon-chart mr-1"></i> Monitoring Campaign</a>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url() . "Dc/Dc" ?>"><i class="icon-chart mr-1"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/dalalead" ?>"><i class="icon-chart mr-1"></i> Data Lead</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . "Dc/Dc/engine" ?>"><i class="icon-chart mr-1"></i> Engine</a>
                </li> -->
                <li class="active">
                    <a href="#"><i class="icon-chart mr-1"></i> PREVIEW</a>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url() . "Dc/Dc/report" ?>"><i class="icon-chart mr-1"></i> Report</a>
                </li> -->


            </ul>

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
                            <h4 class="mb-0"><?php echo $data->nama_campaign; ?></h4>
                        </div>


                    </div>
                </div>
            </div>

            <!-- END: Breadcrumbs-->
            <div class="row">
                <div class="col-6  align-self-center">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">Whatsapp Preview</h6>
                        </div>
                        <div class="card-body">


                            <div class="scrollerchat p-3">

                                <div class="media d-flex  mb-4">
                                    <div class="p-3 ml-auto speech-bubble">

                                        <?php
                                        switch ($type_content_wa) {
                                            case '2':
                                        ?>
                                                <img src='https://sy-anida.com/image_public/<?php echo $wa_image; ?>'>
                                            <?php
                                                break;
                                            case '3':
                                            ?>
                                                <video controls>
                                                    <source src="https://sy-anida.com/image_public/<?php echo $wa_video; ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <br>

                                        <?php
                                                break;
                                        }
                                        ?>
                                        Pelanggan setia indihome<br><br>
                                        <?php echo $wa; ?><br><br>
                                        Saatnya tambah Hybrid Bocx sekarang dengan klik <?php echo $link_lp; ?>. Info @IndiHomeCare. myIndiHome app & 147.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6  align-self-center">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">SMS Preview</h6>
                        </div>
                        <div class="card-body">


                            <div class="scrollerchat p-3">

                                <div class="media d-flex  mb-4">
                                    <div class="p-3 ml-auto speech-bubble">
                                        <?php echo $sms; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12  align-self-center">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title">EMAIL Preview</h6>
                        </div>
                        <!-- <div class="view-email"> -->
                        <div class="card-body">
                            <a href="#" class="bg-primary float-left mr-3  py-1 px-2 rounded text-white back-to-email">
                                Back
                            </a>
                            <h5 class="view-subject mb-3">Mail Subject</h5>
                            <div class="media mb-5 mt-5">
                                <div class="align-self-center">
                                    <img src="dist/images/author1.jpg" alt="" class="img-fluid rounded-circle d-flex mr-3" width="40">
                                </div>
                                <div class="media-body">
                                    <h6 class="mb-0 view-author">Indihome</h6>
                                    <small class="view-date">Today at 10:31 Pm</small>
                                </div>
                            </div>
                            <table width="900" border="0">
                                <tr style='border-collapse:collapse'>
                                    <td align='left' style='padding:0;Margin:0'>
                                        <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
                                            <tbody>
                                                <tr style='border-collapse:collapse'>
                                                    <td width='600' valign='top' align='center' style='padding:0;Margin:0'>
                                                        <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
                                                            <tbody>
                                                                <tr style='border-collapse:collapse'>
                                                                    <td align='center' style='padding:0;Margin:0;font-size:0'>
                                                                        <a href='<?php echo $link_lp;?>'><img class='adapt-img' src='<?php echo $email_image;?>' alt='indihome' style='display:block;border:0;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic' width='100%' title='indihome'></a>
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
                                                                        <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'><?php echo $email;?></p>
                                                                    </td>
                                                                </tr>

                                                                <tr style='border-collapse:collapse'>
                                                                    <td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
                                                                        <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Untuk berlangganan <a class='' target='_blank' href='<?php echo $link_lp;?>'>klik di sini</a>
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


                            <!-- </div> -->
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
    <!-- END: Page Vendor JS-->

    <!-- START: Page Script JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/datatable.script.js"></script>
    <!-- END: Page Script JS-->

    <!-- START: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/chartjs-plugin-datalabels.min.js"></script>

    <!---- END page datatable--->

    <!-- END: Back to top-->
    <script type="text/javascript">
        $(document).ready(function() {

            $('#datalist').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                responsive: true
            });
        });
    </script>
</body>
<!-- END: Body-->

</html>
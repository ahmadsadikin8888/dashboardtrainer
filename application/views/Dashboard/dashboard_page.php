<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
  <meta http-equiv="refresh" content="300">
  <meta charset="UTF-8">
  <title>Digital Sales Dashboard</title>
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
<?php
$thn = array("januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$data_lm = array(100, 80, 70, 80, 100, 80, 70, 80, 100, 80, 70, 80);
$data_lk = array(90, 100, 80, 60, 100, 80, 70, 80, 100, 80, 70, 80);
$data_ld = array(110, 78, 67, 90, 100, 80, 70, 80, 100, 80, 70, 80);
$data_sp2hp = array(87, 65, 98, 65, 100, 80, 70, 80, 100, 80, 70, 80);
$lap = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15');

?>

<body id="main-container" class="default dark horizontal-menu">

  <!-- START: Pre Loader-->
  <div class="se-pre-con">
    <div class="loader"></div>
  </div>
  <!-- END: Pre Loader-->

  <!-- START: Header-->
  <div id="header-fix" class="header fixed-top">
    <div class="site-width">
      <nav class="navbar navbar-expand-lg  p-0">
        <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
          <a href="<?php echo base_url();?>" class="horizontal-logo text-left">
            <span class="h6 font-weight-bold align-self-center mb-0 ml-auto"><?php $t = time();
                                                                              echo (date("H:i A", $t)); ?></span>
          </a>
        </div>
        <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
          <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
        </div>
        <form class="float-left d-none d-lg-block search-form">
          <div class="form-group mb-0 position-relative">
            Digital Sales Wallboard
          </div>
        </form>
        <div class="navbar-right ml-auto h-100">

          <div class="media">
            <img src="<?php echo base_url(); ?>assets/new_theme/dist/images/logo2.png" alt="" class="d-flex img-fluid mt-1" width="150">
          </div>

        </div>

      </nav>
    </div>
  </div>
  <!-- END: Header-->



  <!-- START: Main Content-->
  <main>
    <div class="container-fluid site-width">
      <!-- START: Card Data-->
      <div class="row">
        <div class="col-8">
          <div class="row">
            <div class="col-12 col-lg-5  mt-3">
              <div class="card overflow-hidden">
                <div class="card-content">
                  <div class="card-body p-0">
                    <div class="row">
                      <div class="col-12 col-md-12  col-lg-12 mt-3">
                        <div class="p-2">

                          <div class="d-flex mt-0">
                            <div class="border-0 outline-badge-success w-100 p-3 rounded text-center">
                              <span class="h1 mb-0" id='verified_reguler'><?php echo $wo; ?></span><br>
                              Total Data Prospect
                            </div>
                          </div>
                          <ul class="list-group list-unstyled">
                            <li class="p-2 border-bottom zoom">
                              <div class="media d-flex w-100">
                                <div class="media-body align-self-center pl-2">
                                  <h6 class="mb-0 ">Top 3 Campaign Blast</h6>
                                  <?php
                                  foreach ($jml_prdct_prospect as $datanya) {
                                  ?>
                                    <p class="mb-0 font-w-500 tx-s-12"><?php echo $controller->get_namacampaign($datanya->campaign_id); ?></p>
                                  <?php
                                  }
                                  ?>
                                  <!-- <p class="mb-0 font-w-500 tx-s-12">Product 1</p>
                                  <p class="mb-0 font-w-500 tx-s-12">Product 2</p>
                                  <p class="mb-0 font-w-500 tx-s-12">Product 3</p> -->
                                </div>
                                <div class="ml-auto my-auto font-weight-bold text-right text-success">
                                  <p class="mb-3 font-w-500 tx-s-12"></p>
                                  <?php
                                  foreach ($jml_prdct_prospect as $datanya) {
                                  ?>
                                    <p class="mb-0 font-w-500 tx-s-12" id="contacted_verified"><?php echo $datanya->jml; ?></p>
                                  <?php
                                  }
                                  ?>
                                  <!-- <p class="mb-0 font-w-500 tx-s-12" id="contacted_verified">-</p>
                                  <p class="mb-0 font-w-500 tx-s-12" id="contacted_decline">-</p>
                                  <p class="mb-0 font-w-500 tx-s-12" id="contacted_followup">-</p> -->
                                </div>

                              </div>
                            </li>
                            <li class="p-2 border-bottom zoom">
                              <div class="media d-flex w-100">

                                <div class="card-body text-center p-2 d-flex">
                                  <div class="align-self-center text-center w-100">
                                    <div class="progress">
                                      <?php
                                      $persen = $jml_blast / $wo * 100;
                                      ?>
                                      <div class="progress-bar" style="width: <?php echo number_format($persen, 0); ?>%"></div>
                                    </div>
                                    <span class="progress-description" style="color:#fff">
                                      <?php echo number_format($persen, 2); ?>% Processed Blast
                                    </span>
                                    <h6 class="card-title text-center"></h6>
                                  </div>
                                </div>

                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md mt-3">
              <div class="card overflow-hidden mt-10">
                <div class="card card-header">Channel Blasting Monitoring</div>
                <div class="card-content">
                  <div class="card-body p-0">
                    <table class="table font-w-600 mb-0">
                      <tbody>
                        <tr class="zoom">
                          <td>&nbsp;</td>
                          <td>WA</td>
                          <td>Email</td>
                          <td>SMS</td>
                          <td>Total</td>
                        </tr>
                        <tr class="zoom">
                          <td>Sent</td>
                          <td style='color:#cd7f32;text-align:center;' id=""><?php echo number_format($summary_channel['channel11']); ?></td>
                          <td style='color:#c0c0c0;text-align:center;' id=""><?php echo number_format($summary_channel['channel31']); ?></td>
                          <td style='color:#ffd700;text-align:center;' id=""><?php echo number_format($summary_channel['channel21']); ?></td>
                          <td style='color:#a8a7ae;text-align:center;' id=""><?php echo number_format(($summary_channel['channel11'] + $summary_channel['channel21'] + $summary_channel['channel31'])); ?></td>
                        </tr>
                        <tr class="zoom">
                          <td>Read</td>
                          <td style='color:#cd7f32;text-align:center;' id=""><?php echo number_format($status_read['wa']->read_status); ?></td>
                          <td style='color:#c0c0c0;text-align:center;' id=""><?php echo number_format($status_read['email']->read_status); ?></td>
                          <td style='color:#ffd700;text-align:center;' id=""><?php echo number_format($status_read['sms']->read_status); ?></td>
                          <td style='color:#a8a7ae;text-align:center;' id=""><?php echo number_format($status_read['wa']->read_status + $status_read['sms']->read_status + $status_read['email']->read_status); ?></td>
                        </tr>
                        <tr class="zoom">
                          <td>Clicked</td>
                          <td style='color:#cd7f32;text-align:center;' id=""><?php echo number_format($status_read['wa']->click); ?></td>
                          <td style='color:#c0c0c0;text-align:center;' id=""><?php echo number_format($status_read['email']->click); ?></td>
                          <td style='color:#ffd700;text-align:center;' id=""><?php echo number_format($status_read['sms']->click); ?></td>
                          <td style='color:#a8a7ae;text-align:center;' id=""><?php echo number_format($status_read['wa']->click + $status_read['sms']->click + $status_read['email']->click); ?></td>
                        </tr>
                        <tr class="zoom">
                          <td>Activated</td>
                          <td style='color:#cd7f32;text-align:center;' id=""><?php echo number_format($status_read['wa']->activated); ?></td>
                          <td style='color:#c0c0c0;text-align:center;' id=""><?php echo number_format($status_read['email']->activated); ?></td>
                          <td style='color:#ffd700;text-align:center;' id=""><?php echo number_format($status_read['sms']->activated); ?></td>
                          <td style='color:#a8a7ae;text-align:center;' id=""><?php echo number_format($status_read['wa']->activated + $status_read['sms']->activated + $status_read['email']->activated); ?></td>
                        </tr>
                        <tr class="zoom">
                          <td>PS</td>
                          <td style='color:#cd7f32;text-align:center;' id=""><?php echo number_format($status_read['wa']->ps); ?></td>
                          <td style='color:#c0c0c0;text-align:center;' id=""><?php echo number_format($status_read['email']->ps); ?></td>
                          <td style='color:#ffd700;text-align:center;' id=""><?php echo number_format($status_read['sms']->ps); ?></td>
                          <td style='color:#a8a7ae;text-align:center;' id=""><?php echo number_format($status_read['wa']->ps + $status_read['sms']->ps + $status_read['email']->ps); ?></td>
                        </tr>
                        <tr class="zoom">
                          <td>FAILED</td>
                          <td style='color:#cd7f32;text-align:center;' id=""><?php echo number_format($summary_channel['channel12']); ?></td>
                          <td style='color:#c0c0c0;text-align:center;' id=""><?php echo number_format($summary_channel['channel32']); ?></td>
                          <td style='color:#ffd700;text-align:center;' id=""><?php echo number_format($summary_channel['channel22']); ?></td>
                          <td style='color:#a8a7ae;text-align:center;' id=""><?php echo number_format(($summary_channel['channel12'] + $summary_channel['channel22'] + $summary_channel['channel32'])); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-8 col-lg-12 mt-3">
              <div class="card">
                <!-- <div class="card-header  justify-content-between align-items-center">
                  <h6 class="card-title">Failover </h6>
                </div> -->
                <div class="card-body table-responsive p-0">

                  <table class="table font-w-600 mb-0">
                    <thead>
                      <tr>
                        <th colspan='3' class='text-center'>Preference Channel</th>
                        <th colspan='3' class='text-center'>Failover 1</th>
                        <th colspan='3' class='text-center'>Failover 2</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Whatsapp</td>
                        <td class="text-success"><?php echo number_format($opsi_channel["channel_11"]); ?> </td>
                        <td class="text-danger"><?php echo number_format($opsi_channel["channel_12"]); ?></td>
                        <td>SMS</td>
                        <td class="text-success"><?php echo number_format($opsi_channel_2["channel_121"]); ?> </td>
                        <td class="text-danger"><?php echo number_format($opsi_channel_2["channel_122"]); ?></td>
                        <td>Email</td>
                        <td class="text-success"><?php echo number_format($opsi_channel_3["channel_131"]); ?> </td>
                        <td class="text-danger"><?php echo number_format($opsi_channel_3["channel_132"]); ?></td>
                      </tr>
                      <tr>
                        <td>SMS</td>
                        <td class="text-success"><?php echo number_format($opsi_channel["channel_21"]); ?></td>
                        <td class="text-danger"><?php echo number_format($opsi_channel["channel_22"]); ?></td>
                        <td>Email</td>
                        <td class="text-success"><?php echo number_format($opsi_channel_2["channel_231"]); ?></td>
                        <td class="text-danger"><?php echo number_format($opsi_channel_2["channel_232"]); ?></td>
                        <td></td>
                        <td class="text-success"> </td>
                        <td class="text-danger"></td>
                      </tr>

                      <tr>
                        <td>Email</td>
                        <td class="text-success"><?php echo number_format($opsi_channel["channel_31"]); ?></td>
                        <td class="text-danger"><?php echo number_format($opsi_channel["channel_32"]); ?></td>
                        <td>Whatsapp</td>
                        <td class="text-success"><?php echo number_format($opsi_channel_2["channel_311"]); ?></td>
                        <td class="text-danger"><?php echo number_format($opsi_channel_2["channel_312"]); ?></td>
                        <td>SMS</td>
                        <td class="text-success"><?php echo number_format($opsi_channel_3["channel_321"]); ?></td>
                        <td class="text-danger"><?php echo number_format($opsi_channel_3["channel_322"]); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-4">
          <div class="row">
            <div class="col-12 col-md mt-3">
              <div class="col">
                <div class="row card overflow-hidden mt-10">
                  <div class="card card-header">DS to TAM OBC</div>
                  <div class="card-content">
                    <div class="card-body p-0 row">
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='WO'>-</span>
                        <br>WO
                      </div>
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='Consume'>-</span>
                        <br>Consume
                      </div>
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='Agree'>-</span>
                        <br>Agree
                      </div>
                      <div class="col border-0 outline-badge-warning col-md p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='PS'>-</span>
                        <br>PS
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col mt-3">
                <div class="row card overflow-hidden mt-10">
                  <div class="card card-header">DS to Profiling</div>
                  <div class="card-content">
                    <div class="card-body p-0 row">
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='WO'>-</span>
                        <br>WO
                      </div>
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='Consume'>-</span>
                        <br>Consume
                      </div>
                      <div class="col border-0 outline-badge-warning col-md p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='Agree'>-</span>
                        <br>Verified
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col mt-3">
                <div class="row card overflow-hidden mt-10">
                  <div class="card card-header">DS to Helpdesk</div>
                  <div class="card-content">
                    <div class="card-body p-0 row">
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='WO'>-</span>
                        <br>WO
                      </div>
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='Consume'>-</span>
                        <br>Consume
                      </div>
                      <div class="col border-0 outline-badge-warning col-3 p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='Agree'>-</span>
                        <br>Agree
                      </div>
                      <div class="col border-0 outline-badge-warning col-md p-3 rounded mt-2 ml-1 text-center">
                        <span class="h6 mb-0" id='PS'>-</span>
                        <br>PS
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">

        </div>
      </div>





    </div>
    <!-- END: Card DATA-->
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

  <!-- START: Page JS-->
  <!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/home.script.js"></script> -->
  <!-- END: Page JS-->

  <!---- CUSTOM JS ---->
  <input type="hidden" id="agent_online_reg" value="0">
  <input type="hidden" id="agent_online_moss" value="0">
  <input type="hidden" id="daily_status" value="0">
  <input type="hidden" id="mos_status" value="0">
  <input type="hidden" id="reguler_status" value="0">
  <input type="hidden" id="grafik_status" value="0">
  <input type="hidden" id="best_agent_status" value="0">
  <script>
    $(function() {


    });
  </script>
</body>
<!-- END: Body-->

</html>
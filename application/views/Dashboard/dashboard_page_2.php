<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/temp_1/images/favicon.ico" />
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- START: Template CSS-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/jquery-ui/jquery-ui.theme.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/flags-icon/css/flag-icon.min.css">
  <!-- END Template CSS-->

  <!-- START: Page CSS-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
  <!-- END: Page CSS-->

  <!-- START: Custom CSS-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temp_1/css/main.css">
  <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default horizontal-menu">



  <div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row">
      <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
          <div class="w-sm-100 mr-auto">
            <h4 class="mb-0">Dashboard</h4>
            <p>Welcome to Digital Sales Dashboard</p>
          </div>

          <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
            <button type="submit" class="btn btn-success">Back</button>
          </ol>
        </div>
      </div>
    </div>
    <!-- END: Breadcrumbs-->

    <!-- START: Card Data-->
    <div class="row">
      <div class="col-md-3 col-lg-3 mt-3">
        <div class="card overflow-hidden">
          <div class="card-content">
            <div class="card-body p-0">
              <ul class="list-group list-unstyled">

                <li class="p-2 border-bottom zoom">
                  <div class="media d-flex w-100">


                    <div class="card-body text-center p-0 d-flex">
                      <div class="align-self-center text-center w-100">
                        <h3 class="card-title font-weight-bold"><?php echo $tot_prospect; ?></h3>
                        <h6 class="card-title text-center">Total Data Prospect</h6>
                      </div>
                    </div>


                  </div>
                </li>
                <li class="p-2 border-bottom zoom text-center">
                  Top 5 Product
                </li>

                <li class="p-2 border-bottom zoom">
                  <div class="transaction-date d-flex w-100">
                    <div class="date text-center rounded text-primary p-2">
                      <span class="mb-0 font-w-600">Product</span>
                    </div>
                    <div class="ml-auto my-auto font-weight-bold text-right text-primary">
                      <span class="mb-0 font-w-600">Jumlah Prospek</span>
                    </div>
                  </div>
                </li>
                <?php
                foreach ($jml_prdct_prospect as $datanya) {
                ?>
                  <li class="p-2 border-bottom zoom">
                    <div class="transaction-date d-flex w-100">
                      <div class="date text-center rounded text-primary p-2">
                        <span class="mb-0 font-w-600"><?php echo $datanya->produk_value; ?></span>
                      </div>
                      <div class="ml-auto my-auto font-weight-bold text-right text-primary">
                        <span class="mb-0 font-w-600"><?php echo $datanya->jml; ?></span>
                      </div>
                    </div>
                  </li>

                <?php
                }
                ?>

                <li class="p-2 border-bottom zoom">
                  <div class="media d-flex w-100">

                    <div class="card-body text-center p-2 d-flex">
                      <div class="align-self-center text-center w-100">
                        <div class="progress mb-2">
                          <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                        </div>
                        <h6 class="card-title text-center">Processed Blast</h6>
                      </div>
                    </div>

                  </div>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4  mt-3">

        <div class="card">
          <div class="card-header justify-content-between align-items-center">
            <h4 class="card-title">Channel Blasting Monitoring</h4>
          </div>
          <div class="card-body">

            <table class="table layout-dark" width="100%">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Whatsapp</th>
                  <th scope="col">Email</th>
                  <th scope="col">SMS</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Deliver</th>
                  <td><?php echo $perchannelblast['wa']->jmldeliver; ?></td>
                  <td><?php echo $perchannelblast['email']->jmldeliver; ?></td>
                  <td><?php echo $perchannelblast['sms']->jmldeliver; ?></td>
                  <td><?php echo $perchannelblast['total']->jmldeliver; ?></td>
                </tr>
                <tr>
                  <th scope="row">Read</th>
                  <td><?php echo $perchannelblast['wa']->tgl_read; ?></td>
                  <td><?php echo $perchannelblast['email']->tgl_read; ?></td>
                  <td><?php echo $perchannelblast['sms']->tgl_read; ?></td>
                  <td><?php echo $perchannelblast['total']->tgl_read; ?></td>
                </tr>
                <tr>
                  <th scope="row">Clicked</th>
                  <td><?php echo $perchannelblast['wa']->jml_klicked; ?></td>
                  <td><?php echo $perchannelblast['email']->jml_klicked; ?></td>
                  <td><?php echo $perchannelblast['sms']->jml_klicked; ?></td>
                  <td><?php echo $perchannelblast['total']->jml_klicked; ?></td>
                </tr>
                <tr>
                  <th scope="row">Activated</th>
                  <td><?php echo $perchannelblast['wa']->tgl_activated; ?></td>
                  <td><?php echo $perchannelblast['email']->tgl_activated; ?></td>
                  <td><?php echo $perchannelblast['sms']->tgl_activated; ?></td>
                  <td><?php echo $perchannelblast['total']->tgl_activated; ?></td>
                </tr>
                <tr>
                  <th scope="row">PS</th>
                  <td><?php echo $perchannelblast['wa']->tgl_ps; ?></td>
                  <td><?php echo $perchannelblast['email']->tgl_ps; ?></td>
                  <td><?php echo $perchannelblast['sms']->tgl_ps; ?></td>
                  <td><?php echo $perchannelblast['total']->tgl_ps; ?></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div class="col-md-12 col-lg-5 mt-3">
        <div class="card overflow-hidden">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="card-title">DS to TAM OBC</h6>
          </div>
          <div class="card-content">

            <div class="d-flex mt-4">
              <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h6 mb-0">100</span><br>
                WO
              </div>
              <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                Consume
              </div>
              <div class="border-0 outline-badge-dark w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                Agree
              </div>
              <div class="border-0 outline-badge-primary w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                PS
              </div>
            </div>

          </div>
        </div>

        <div class="card overflow-hidden mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="card-title">DS to Profiling</h6>
          </div>
          <div class="card-content">
            <div class="d-flex mt-4">
              <div class="border-0 outline-badge-success w-50 p-3 rounded text-center"><span class="h6 mb-0">100</span><br>
                WO
              </div>
              <div class="border-0 outline-badge-dark w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                Consume
              </div>
              <div class="border-0 outline-badge-primary w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                Verifiec
              </div>
            </div>
          </div>
        </div>

        <div class="card overflow-hidden mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="card-title">Helpdesk</h6>
          </div>
          <div class="card-content">
            <div class="d-flex mt-4">
              <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h6 mb-0">100</span><br>
                WO
              </div>
              <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                Consume
              </div>
              <div class="border-0 outline-badge-dark w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                Agree
              </div>
              <div class="border-0 outline-badge-primary w-50 p-3 rounded ml-2 text-center"><span class="h6 mb-0">100</span><br>
                PS
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- END: Card DATA-->
  </div>
  <div class="row">
    <div class="col-12 col-md-12 mt-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="card-title">Line Chart</h6>
        </div>
        <div class="card-body text-center">
          <div id="apex_line_chart" class="height-500"></div>
        </div>
      </div>
    </div>

  </div>
  <!-- END: Content-->
  <!-- START: Footer-->
  <footer class="site-footer">
    Digital Sales
  </footer>
  <!-- END: Footer-->



  <!-- START: Back to top-->
  <a href="#" class="scrollup text-center">
    <i class="icon-arrow-up"></i>
  </a>
  <!-- END: Back to top-->


  <!-- START: Template JS-->
  <script src="<?php echo base_url(); ?>assets/temp_1/vendors/jquery/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/temp_1/vendors/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/temp_1/vendors/moment/moment.js"></script>
  <script src="<?php echo base_url(); ?>assets/temp_1/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/temp_1/vendors/slimscroll/jquery.slimscroll.min.js"></script>
  <!-- END: Template JS-->

  <!-- START: APP JS-->
  <script src="<?php echo base_url(); ?>assets/temp_1/js/app.js"></script>
  <!-- END: APP JS-->

  <!-- START: Page Vendor JS-->
  <script src="<?php echo base_url(); ?>assets/temp_1/vendors/apexcharts/apexcharts.min.js"></script>
  <!-- END: Page Vendor JS-->

  <!-- START: Page JS-->
  <script src="<?php echo base_url(); ?>assets/temp_1/js/home.script.js"></script>
  <!-- END: Page JS-->

  <!-- START: Page Script JS-->
  <script>
    $(function() {
      ////////////////////////////////// LIne Chart /////////////////////////////
      var colors = ['#51a0e1', '#f9bb39', '#99f83a', '#3c53f7', '#d337fb', '#f43e83', '#b08d82', '#6794cb', '#51a0e1', '#f9bb39', '#99f83a', '#3c53f7'];
      var theme = 'light';
      if ($('body').hasClass('dark')) {
        theme = 'dark';
      }
      if ($('body').hasClass('dark-alt')) {
        theme = 'dark';
      }

      var options = {
        theme: {
          mode: theme
        },
        chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          },
          dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
          },
        },
        colors: colors,
        series: [{
          name: "Blast",
          data: [
            <?php
            foreach ($line_chart['blast'] as $ktanggal => $vtanggal) {
              echo "'" . $vtanggal . "',";
            }
            ?>

          ]
        }, {
          name: "Deliver",
          data: [
            <?php
            foreach ($line_chart['deliver'] as $ktanggal => $vtanggal) {
              echo "'" . $vtanggal . "',";
            }
            ?>
          ]
        }, {
          name: "Klicked",
          data: [
            <?php
            foreach ($line_chart['klicked'] as $ktanggal => $vtanggal) {
              echo "'" . $vtanggal . "',";
            }
            ?>
          ]
        }, {
          name: "Read",
          data: [
            <?php
            foreach ($line_chart['read'] as $ktanggal => $vtanggal) {
              echo "'" . $vtanggal . "',";
            }
            ?>
          ]
        }, {
          name: "Activated",
          data: [
            <?php
            foreach ($line_chart['activated'] as $ktanggal => $vtanggal) {
              echo "'" . $vtanggal . "',";
            }
            ?>
          ]
        }, {
          name: "PS",
          data: [
            <?php
            foreach ($line_chart['ps'] as $ktanggal => $vtanggal) {
              echo "'" . $vtanggal . "',";
            }
            ?>
          ]
        }],
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {

          align: 'left',
          style: {
            color: '#51a0e1'

          }
        },
        grid: {
          row: {
            colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: [
            <?php
            foreach ($line_chart['blast'] as $ktanggal => $vtanggal) {
              echo "'" . $ktanggal . "',";
            }
            ?>
          ],
          // labels: {
          //     style: {
          //         colors: ['#51a0e1', '#51a0e1', '#51a0e1', '#51a0e1', '#51a0e1', '#51a0e1', '#51a0e1', '#51a0e1', '#51a0e1']

          //     }
          // }
        },
        yaxis: [{
            title: {
              text: "Jumlah"
            },
          }
          // {
          //     opposite: true,
          //     title: {
          //     text: "Series B"
          //     }
          // }
        ],
      }

      var chart = new ApexCharts(
        document.querySelector("#apex_line_chart"),
        options
      );

      chart.render();

    });
  </script>
  <!-- END: Page Script JS-->
</body>
<!-- END: Body-->

</html>
<body>
    <table width="100%">
        <?php
        if ($input_absen || isset($_GET['pulang'])) {
        ?>
            <tr style="display:none;" id="camera_area">
                <td width="15%">

                </td>
                <td width="35%"><video id="video" width="420px" height="313px"></video></td>
                <td width="35%"><canvas id="canvas" width="420px" height="313px"></canvas></td>
                <td width="15%">

                </td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td width="15%"></td>
            <td colspan="2" width="70%">
                <div class="card-body">

                    <div class="row">
                        <?php
                        if ($input_absen) {
                        ?>
                            <div class="col-sm-6">
                                <button id="snap" class="card p-3 btn btn-danger btn-card">
                                    <div class="d-flex align-items-center">
                                        <span class="stamp stamp-md bg-red mr-3">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                        <div class="text-left">
                                            <p class="m-0 text-red">Check In</p>
                                            <small class="text-muted">Click tombol absen!</small>
                                        </div>
                                    </div>

                                </button>
                            </div>
                        <?php
                        }
                        ?>




                        <?php
                        if (!$input_absen) {
                        ?>
                            <div class="col-sm-6">
                                <?php
                                if (isset($_GET['pulang'])) {
                                ?>
                                    <button id="snap" class="card p-3 btn btn-danger btn-card">
                                        <div class="d-flex align-items-center">
                                            <span class="stamp stamp-md bg-red mr-3">
                                                <i class="fe fe-camera"></i>
                                            </span>
                                            <div class="text-left">
                                                <p class="m-0 text-red">Proses Check Out</p>
                                                <small class="text-muted">Click tombol absen pulang!</small>
                                            </div>
                                        </div>

                                    </button>

                                <?php
                                } else {
                                ?>
                                    <a href="<?php echo base_url() . "Home?pulang=1" ?>" class="card p-3 btn btn-danger btn-card">
                                        <div class="d-flex align-items-center">
                                            <span class="stamp stamp-md bg-red mr-3">
                                                <i class="fe fe-camera"></i>
                                            </span>
                                            <div class="text-left">
                                                <p class="m-0 text-red">Check Out</p>
                                                <small class="text-muted">Click tombol absen pulang!</small>
                                            </div>
                                        </div>

                                    </a>

                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-status bg-green"></div>
                                <div class="card-header">
                                    <h3 class="card-title">Quick Link</h3>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                        if ($userdata->opt_level != 8) {
                                        ?>

                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url() . "Dashboard/Dashboard"; ?>" class="card p-3 btn btn-danger btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-red mr-3">
                                                            <i class="fe fe-bar-chart"></i>
                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-red">DASHBOARD</p>
                                                            <small class="text-muted">Dashboard Monitoring</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="<?php echo base_url() . "Report/report_digital_sales"; ?>" class="card p-3 btn btn-success btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-green mr-3">
                                                            <i class="fe fe-bar-chart"></i>
                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-green">REPORT</p>
                                                            <small class="text-muted">Report By Date</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-sm-12">
                                                <a href="<?php echo base_url() . "Outbound/Outbound/"; ?>" class="card p-3 btn btn-success btn-card">
                                                    <div class="d-flex align-items-center">
                                                        <span class="stamp stamp-md bg-success mr-3">
                                                            <i class="fe fe-bar"></i>
                                                        </span>
                                                        <div class="text-left">
                                                            <p class="m-0 text-red">WORK ORDER</p>
                                                            <small class="text-muted">List of Work Order</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-12">
                            <div class="card">
                                <div class="card-status bg-orange"></div>
                                <div class="card-header">
                                    <h3 class="card-title">Break</h3>

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Break"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Lunch</p>
                                                        <small class="text-muted">Jika anda akan istirahat makan siang</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Pray"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Pray</p>
                                                        <small class="text-muted">Jika anda akan melakukan ibadah</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Toilet"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Toilet</p>
                                                        <small class="text-muted">Jika anda akan ke Kamar Kecil</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=Handsup"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Hands Up</p>
                                                        <small class="text-muted">Jika anda akan melakukan koordinasi ke Team Leader</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> -->
                    </div>
                </div>
            </td>
            <td width="15%"></td>
        </tr>
    </table>
    <?php
    if ($_GET['pulang']) {
        echo "<input type='hidden' id='pulang' value='1'>";
    } else {
        echo "<input type='hidden' id='pulang' value='0'>";
    }
    echo "<input type='hidden' id='latitude' value='0'>";
    echo "<input type='hidden' id='longitude' value='0'>";
    ?>
    <?php
    if ($input_absen || $_GET['pulang']) {
    ?>
        <script type="text/javascript">
            // Grab elements, create settings, etc.
            $("#camera_area").show();
            var video = document.getElementById('video');

            // Get access to the camera!
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Not adding `{ audio: true }` since we only want video now
                navigator.mediaDevices.getUserMedia({
                    video: true
                }).then(function(stream) {
                    //video.src = window.URL.createObjectURL(stream);
                    video.srcObject = stream;
                    video.play();
                });
            }
            // Elements for taking the snapshot
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');

            // Trigger photo take
            document.getElementById("snap").addEventListener("click", function() {
                var latitude = $("#latitude").val();
                var longitude = $("#longitude").val();
                var pulang = $("#pulang").val();
                if (pulang == 0) {
                    uri = "<?php echo base_url() . "sistem/Profile/prepare_absen"; ?>";
                } else {
                    uri = "<?php echo base_url() . "sistem/Profile/prepare_absen_pulang"; ?>";
                }
                context.drawImage(video, 0, 0, 420, 313);
                var dataURL = canvas.toDataURL();
                $.ajax({
                    type: "POST",
                    url: uri,
                    data: {
                        imgBase64: dataURL,
                        longitude: longitude,
                        latitude: latitude
                    }
                }).done(function(o) {
                    console.log('saved');
                    alert("Data Absensi Berhasil Disimpan.!");
                    <?php
                    if ($_GET['pulang']) {
                    ?>
                        window.location.assign("<?php echo base_url() ?>sistem/logout");
                    <?php
                    }
                    if ($input_absen) {
                    ?>
                        window.location.assign("<?php echo base_url() ?>");
                    <?php
                    } ?>
                });
            });

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.watchPosition(showPosition);
                }
            }

            function showPosition(position) {
                $("#latitude").val(position.coords.latitude);
                $("#longitude").val(position.coords.longitude);
            }
            getLocation();
        </script>
    <?php
    }
    ?>
</body>
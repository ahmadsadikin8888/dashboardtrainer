<table width="100%">

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

                                    <!-- <div class="col-sm-6">
                                        <a href="<?php echo base_url() . "dashboard_v2/wallboard_wfh_v2"; ?>" class="card p-3 btn btn-danger btn-card">
                                            <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-red mr-3">
                                                    <i class="fe fe-users"></i>
                                                </span>
                                                <div class="text-left">
                                                    <p class="m-0 text-red">MONITORING AGENT</p>
                                                    <small class="text-muted">Daily Agent Monitoring Activity</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div> -->
                                    <div class="col-sm-6">
                                        <a href="<?php echo base_url() . "Multi_contact/Multi_contact"; ?>" class="card p-3 btn btn-success btn-card">
                                            <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-green mr-3">
                                                    <i class="fe fe-user"></i>
                                                </span>
                                                <div class="text-left">
                                                    <p class="m-0 text-green">CHECK DATA PELANGGAN</p>
                                                    <small class="text-muted">Update Data DBPROFILE</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo base_url() . "Dashboard/wallboard"; ?>" class="card p-3 btn btn-success btn-card">
                                            <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-green mr-3">
                                                    <i class="fe fe-user"></i>
                                                </span>
                                                <div class="text-left">
                                                    <p class="m-0 text-green">WALLBOARD</p>
                                                    <small class="text-muted">Wallboard daily CT0</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-12">
                                        <a href="<?php echo base_url() . "Wallboard"; ?>" class="card p-3 btn btn-success btn-card">
                                            <div class="d-flex align-items-center">
                                                <span class="stamp stamp-md bg-green mr-3">
                                                    <i class="fe fe-user"></i>
                                                </span>
                                                <div class="text-left">
                                                    <p class="m-0 text-green">MONITORING DAN EVALUASI</p>
                                                    <small class="text-muted">Monitoring dan Evaluasi Agent Activity</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
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
                                                        <p class="m-0 text-red">Break Launch</p>
                                                        <small class="text-muted">Jika anda akan istirahat makan siang!</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=aux"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">AUX</p>
                                                        <small class="text-muted">Jika anda akan meninggalkan tempat duduk!</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div> -->
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=ibadah"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Break Pray</p>
                                                        <small class="text-muted">Jika anda akan melakukan ibadah!</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=toilet"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Break Toilet</p>
                                                        <small class="text-muted">Jika anda akan ke Kamar Kecil!</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo base_url() . "lockscreen?ket=koordinasi"; ?>" class="card p-3 btn btn-danger btn-card">
                                                <div class="d-flex align-items-center">
                                                    <span class="stamp stamp-md bg-red mr-3">
                                                        <i class="fe fe-log-out"></i>

                                                    </span>
                                                    <div class="text-left">
                                                        <p class="m-0 text-red">Break Koordinasi</p>
                                                        <small class="text-muted">Jika anda akan melakukan koordinasi ke Team Leader!</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>
            </div>
        </td>
        <td width="15%"></td>
    </tr>
</table>
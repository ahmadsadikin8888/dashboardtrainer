<?php echo _css('datatables,icheck') ?>


<div class="col-md-12 col-xl-12">
    <div class="form-group">
        <div class="selectgroup selectgroup-pills">
            <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="1" class="selectgroup-input" checked="">
                <span class="selectgroup-button selectgroup-button-icon" title="Agent CT-0"><i class="fe fe-shield"></i> CT-0</span>
            </label>
            <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="2" class="selectgroup-input">
                <span class="selectgroup-button selectgroup-button-icon" title="Agent PRANPC"><i class="fe fe-home"></i> PRANPC</span>
            </label>
        </div>
    </div>
</div>

<div class="col-md-12 col-xl-12" id="panel-form-reguler">
    <div class="card">
        <div class="card-status bg-orange"></div>
        <div class="card-header">
            <h3 class="card-title">Report Call CT-0 Periode <?php echo date('Y-m-d'); ?>

            </h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class='box-body table-responsive' id='box-table'>
                <small>
                    <table class='timecard' id="report_table_reg" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><b>No</b></th>
                                <th nowrap><b>Nama Agent</b></th>
                                <th nowrap><b>User ID</b></th>
                                <th style="background-color:green;color:white;"><b>Agree</b></th>
                                <th style="background-color:green;color:white;"><b>FU</b></th>
                                <th style="background-color:green;color:white;"><b>Decline</b></th>
                                <th style="background-color:red;color:white;"><b>RNA</b></th>
                                <th style="background-color:red;color:white;"><b>Busy</b></th>
                                <th style="background-color:red;color:white;"><b>Invalid</b></th>
                                <th style="background-color:red;color:white;"><b>Rejected</b></th>
                                <th style="background-color:red;color:white;"><b>MB</b></th>
                                <th style="background-color:red;color:white;"><b>Fax</b></th>
                                <th style="background-color:red;color:white;"><b>Isolir</b></th>
                                <th style="background-color:red;color:white;"><b>SS</b></th>
                                <th style="background-color:red;color:white;"><b>NOU</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total = array();
                            $total['contacted'] = 0;
                            $total['uncontacted'] = 0;
                            $total['agent_online'] = 0;
                            $data_profiling = $query_trans_profiling_ct0->result_array();
                            // $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();
                            // $check_veri = count($controller->filter_by_value($data_profiling, 'veri_call', '13'));
                            if ($agent_reg['num'] > 0) {
                                $sub_total_contacted = 0;
                                $sub_total_uncontacted = 0;
                                foreach ($agent_reg['results'] as $ag) {

                                    $data_agent = $controller->filter_by_value($data_profiling, 'login', $ag->login);
                                    // $verified = $controller->filter_by_value($data_profiling_verifikasi, 'update_by', $ag->agentid);
                                    // $verified = $controller->filter_by_value(array(), 'update_by', $ag->agentid);
                                    // $verified = $data_varified;

                                    $contacted = $controller->filter_by_value($data_agent, 'status', 'Contacted');
                                    $uncontacted = $controller->filter_by_value($data_agent, 'status', 'Not Contacted');
                                    $agree = $controller->filter_by_value($contacted, 'kategori', 'Agree');
                                    $followup = $controller->filter_by_value($contacted, 'kategori', 'Follow UP');
                                    $decline = $controller->filter_by_value($contacted, 'kategori', 'Decline');
                                    $dc1 = $controller->filter_by_value($uncontacted, 'kategori', 'Telepon Tidak Diangkat - RNA');
                                    $dc2 = $controller->filter_by_value($uncontacted, 'kategori', 'Line Busy');
                                    $dc3 = $controller->filter_by_value($uncontacted, 'kategori', 'Invalid Phone Number');
                                    $dc4 = $controller->filter_by_value($uncontacted, 'kategori', 'Call Rejected');
                                    $dc5 = $controller->filter_by_value($uncontacted, 'kategori', 'Mail Box - Memo');
                                    $dc6 = $controller->filter_by_value($uncontacted, 'kategori', 'Fax - Modem');
                                    $dc7 = $controller->filter_by_value($uncontacted, 'kategori', 'Telepon Isolir');
                                    $dc8 = $controller->filter_by_value($uncontacted, 'kategori', 'Telepon salah sambung');
                                    $dc9 = $controller->filter_by_value($uncontacted, 'kategori', 'NO USAGE (TIDAK AKAN DIMASUKKAN PROSPEK KEMUDIAN)');
                                    if ($userdata->opt_level == 8) {
                                        if ($userdata->agentid == $ag->agentid) {
                                            $sub_total_contacted = count($contacted);
                                            $sub_total_uncontacted = count($uncontacted);
                                            $total['contacted'] = $total['contacted'] + $sub_total_contacted;
                                            $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
                                            $total['agree'] = $total['agree'] + count($agree);
                                            $total['followup'] = $total['followup'] + count($followup);
                                            $total['decline'] = $total['decline'] + count($decline);
                                            $total['dc1'] = $total['dc1'] + count($dc1);
                                            $total['dc2'] = $total['dc2'] + count($dc2);
                                            $total['dc3'] = $total['dc3'] + count($dc3);
                                            $total['dc4'] = $total['dc4'] + count($dc4);
                                            $total['dc5'] = $total['dc5'] + count($dc5);
                                            $total['dc6'] = $total['dc6'] + count($dc6);
                                            $total['dc7'] = $total['dc7'] + count($dc7);
                                            $total['dc8'] = $total['dc8'] + count($dc8);
                                            $total['dc9'] = $total['dc9'] + count($dc9);
                                            $total[$ag->tl] = $total[$ag->tl] + count($agree);
                                        }
                                    } else {

                                        $sub_total_contacted = count($contacted);
                                        $sub_total_uncontacted = count($uncontacted);
                                        $total['contacted'] = $total['contacted'] + $sub_total_contacted;
                                        $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
                                        $total['agree'] = $total['agree'] + count($agree);
                                        $total['followup'] = $total['followup'] + count($followup);
                                        $total['decline'] = $total['decline'] + count($decline);
                                        $total['dc1'] = $total['dc1'] + count($dc1);
                                        $total['dc2'] = $total['dc2'] + count($dc2);
                                        $total['dc3'] = $total['dc3'] + count($dc3);
                                        $total['dc4'] = $total['dc4'] + count($dc4);
                                        $total['dc5'] = $total['dc5'] + count($dc5);
                                        $total['dc6'] = $total['dc6'] + count($dc6);
                                        $total['dc7'] = $total['dc7'] + count($dc7);
                                        $total['dc8'] = $total['dc8'] + count($dc8);
                                        $total['dc9'] = $total['dc9'] + count($dc9);
                                        $total[$ag->tl] = $total[$ag->tl] + count($agree);
                                    }
                            ?>

                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td style="text-align:left;"><?php echo $ag->nama; ?></td>
                                        <td style="text-align:left;"><?php echo $ag->agentid; ?></td>
                                        <td><?php echo number_format(count($agree)); ?></td>
                                        <td><?php echo number_format(count($followup)); ?></td>
                                        <td><?php echo number_format(count($decline)); ?></td>
                                        <td><?php echo number_format(count($dc1)); ?></td>
                                        <td><?php echo number_format(count($dc2)); ?></td>
                                        <td><?php echo number_format(count($dc3)); ?></td>
                                        <td><?php echo number_format(count($dc4)); ?></td>
                                        <td><?php echo number_format(count($dc5)); ?></td>
                                        <td><?php echo number_format(count($dc6)); ?></td>
                                        <td><?php echo number_format(count($dc7)); ?></td>
                                        <td><?php echo number_format(count($dc8)); ?></td>
                                        <td><?php echo number_format(count($dc9)); ?></td>

                                    </tr>
                            <?php
                                    if ($sub_total_contacted > 0 || $sub_total_uncontacted > 0) {
                                        $total['agent_online']++;
                                    }
                                    $no++;
                                }
                            }

                            ?>
                        </tbody>
                    </table>

                </small>
            </div>
        </div>
    </div>
</div>


<div class="col-md-12 col-xl-12" id="panel-form-moss">
    <div class="card">
        <div class="card-status bg-orange"></div>
        <div class="card-header">
            <h3 class="card-title">Report Call PRANPC Periode <?php echo date('Y-m-d'); ?>

            </h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class='box-body table-responsive' id='box-table'>
                <small>
                    <table class='timecard' id="report_table_moss" style="width: 100%;">
                        <thead>
                            <tr>
                                <th><b>No</b></th>
                                <th nowrap><b>Nama Agent</b></th>
                                <th nowrap><b>User ID</b></th>
                                <th style="background-color:green;color:white;"><b>Agree</b></th>
                                <th style="background-color:green;color:white;"><b>FU</b></th>
                                <th style="background-color:green;color:white;"><b>Decline</b></th>
                                <th style="background-color:red;color:white;"><b>RNA</b></th>
                                <th style="background-color:red;color:white;"><b>Busy</b></th>
                                <th style="background-color:red;color:white;"><b>Invalid</b></th>
                                <th style="background-color:red;color:white;"><b>Rejected</b></th>
                                <th style="background-color:red;color:white;"><b>MB</b></th>
                                <th style="background-color:red;color:white;"><b>Fax</b></th>
                                <th style="background-color:red;color:white;"><b>Isolir</b></th>
                                <th style="background-color:red;color:white;"><b>SS</b></th>
                                <th style="background-color:red;color:white;"><b>NOU</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data_profiling = $query_trans_profiling_pranpc->result_array();
                            // $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();
                            // $check_veri = count($controller->filter_by_value($data_profiling, 'veri_call', '13'));
                            if ($agent_moss['num'] > 0) {
                                foreach ($agent_moss['results'] as $ag) {

                                    $data_agent = $controller->filter_by_value($data_profiling, 'login', $ag->login);
                                    // $verified = $controller->filter_by_value($data_profiling_verifikasi, 'update_by', $ag->agentid);
                                    // $verified = $controller->filter_by_value(array(), 'update_by', $ag->agentid);
                                    // $verified = $data_varified;

                                    $contacted = $controller->filter_by_value($data_agent, 'status', 'Contacted');
                                    $uncontacted = $controller->filter_by_value($data_agent, 'status', 'Not Contacted');
                                    $agree = $controller->filter_by_value($contacted, 'kategori', 'Agree');
                                    $followup = $controller->filter_by_value($contacted, 'kategori', 'Follow UP');
                                    $decline = $controller->filter_by_value($contacted, 'kategori', 'Decline');
                                    $dc1 = $controller->filter_by_value($uncontacted, 'kategori', 'Telepon Tidak Diangkat - RNA');
                                    $dc2 = $controller->filter_by_value($uncontacted, 'kategori', 'Line Busy');
                                    $dc3 = $controller->filter_by_value($uncontacted, 'kategori', 'Invalid Phone Number');
                                    $dc4 = $controller->filter_by_value($uncontacted, 'kategori', 'Call Rejected');
                                    $dc5 = $controller->filter_by_value($uncontacted, 'kategori', 'Mail Box - Memo');
                                    $dc6 = $controller->filter_by_value($uncontacted, 'kategori', 'Fax - Modem');
                                    $dc7 = $controller->filter_by_value($uncontacted, 'kategori', 'Telepon Isolir');
                                    $dc8 = $controller->filter_by_value($uncontacted, 'kategori', 'Telepon salah sambung');
                                    $dc9 = $controller->filter_by_value($uncontacted, 'kategori', 'NO USAGE (TIDAK AKAN DIMASUKKAN PROSPEK KEMUDIAN)');
                                    if ($userdata->opt_level == 8) {
                                        if ($userdata->agentid == $ag->agentid) {
                                            $sub_total_contacted = count($contacted);
                                            $sub_total_uncontacted = count($uncontacted);
                                            $total['contacted'] = $total['contacted'] + $sub_total_contacted;
                                            $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
                                            $total['agree'] = $total['agree'] + count($agree);
                                            $total['followup'] = $total['followup'] + count($followup);
                                            $total['decline'] = $total['decline'] + count($decline);
                                            $total['dc1'] = $total['dc1'] + count($dc1);
                                            $total['dc2'] = $total['dc2'] + count($dc2);
                                            $total['dc3'] = $total['dc3'] + count($dc3);
                                            $total['dc4'] = $total['dc4'] + count($dc4);
                                            $total['dc5'] = $total['dc5'] + count($dc5);
                                            $total['dc6'] = $total['dc6'] + count($dc6);
                                            $total['dc7'] = $total['dc7'] + count($dc7);
                                            $total['dc8'] = $total['dc8'] + count($dc8);
                                            $total['dc9'] = $total['dc9'] + count($dc9);
                                            $total[$ag->tl] = $total[$ag->tl] + count($agree);
                                        }
                                    } else {
                                        $sub_total_contacted = count($contacted);
                                        $sub_total_uncontacted = count($uncontacted);
                                        $total['contacted'] = $total['contacted'] + $sub_total_contacted;
                                        $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
                                        $total['agree'] = $total['agree'] + count($agree);
                                        $total['followup'] = $total['followup'] + count($followup);
                                        $total['decline'] = $total['decline'] + count($decline);
                                        $total['dc1'] = $total['dc1'] + count($dc1);
                                        $total['dc2'] = $total['dc2'] + count($dc2);
                                        $total['dc3'] = $total['dc3'] + count($dc3);
                                        $total['dc4'] = $total['dc4'] + count($dc4);
                                        $total['dc5'] = $total['dc5'] + count($dc5);
                                        $total['dc6'] = $total['dc6'] + count($dc6);
                                        $total['dc7'] = $total['dc7'] + count($dc7);
                                        $total['dc8'] = $total['dc8'] + count($dc8);
                                        $total['dc9'] = $total['dc9'] + count($dc9);
                                        $total[$ag->tl] = $total[$ag->tl] + count($agree);
                                    }
                            ?>

                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td style="text-align:left;"><?php echo $ag->nama; ?></td>
                                        <td style="text-align:left;"><?php echo $ag->agentid; ?></td>
                                        <td><?php echo number_format(count($agree)); ?></td>
                                        <td><?php echo number_format(count($followup)); ?></td>
                                        <td><?php echo number_format(count($decline)); ?></td>
                                        <td><?php echo number_format(count($dc1)); ?></td>
                                        <td><?php echo number_format(count($dc2)); ?></td>
                                        <td><?php echo number_format(count($dc3)); ?></td>
                                        <td><?php echo number_format(count($dc4)); ?></td>
                                        <td><?php echo number_format(count($dc5)); ?></td>
                                        <td><?php echo number_format(count($dc6)); ?></td>
                                        <td><?php echo number_format(count($dc7)); ?></td>
                                        <td><?php echo number_format(count($dc8)); ?></td>
                                        <td><?php echo number_format(count($dc9)); ?></td>

                                    </tr>
                            <?php
                                    if ($sub_total_contacted > 0 || $sub_total_uncontacted > 0) {
                                        $total['agent_online']++;
                                    }
                                    $no++;
                                }
                            }

                            ?>
                        </tbody>
                    </table>

                </small>
            </div>
        </div>
    </div>
</div>
<?php echo _js('datatables,icheck') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#order_call").text('<?php echo number_format($total['contacted'] + $total['uncontacted']); ?>');
        $("#agree").text('<?php echo number_format($total['agree']); ?>');
        $("#followup").text('<?php echo number_format($total['followup']); ?>');
        $("#decline").text('<?php echo number_format($total['decline']); ?>');

        $("#connected").text('<?php echo number_format($total['contacted']); ?>');
        $("#notconnected").text('<?php echo number_format($total['uncontacted']); ?>');
        $("#TLLM").text('<?php echo number_format($total['TLLM']); ?>');
        $("#TLRGA").text('<?php echo number_format($total['TLRGA']); ?>');
        $("#TLAMR").text('<?php echo number_format($total['TLAMR']); ?>');
        $("#report_table_reg").DataTable();
        $("#report_table_moss").DataTable();
        $("#panel-form-reguler").show();
        $("#panel-form-moss").hide();

        $(".selectgroup-input").change(function() {
            if ($(this).val() == "1") {
                $("#panel-form-reguler").show();
                $("#panel-form-moss").hide();
            } else {
                $("#panel-form-reguler").hide();
                $("#panel-form-moss").show();
            }
        });
    });
</script>
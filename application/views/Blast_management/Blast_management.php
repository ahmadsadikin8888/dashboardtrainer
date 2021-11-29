<?php echo _css('datatables,icheck') ?>
<script type="text/javascript">
  function change_campaign() {
    var campaign = $("#campaign").val();
    var url = window.location.href;
    url += '?campaign=' + campaign;
    window.location.href = '<?php echo base_url();?>Blast_management/Blast_management?campaign=' + campaign;
  }
</script>
<div class="container-fluid site">
  <div class="row row-eq-height">
    <div class="col-12 mt-3">
      <div class="card mb-3">
        <div class="card-content">
          <div class="card-body">
            <form method="POST" action="<?php echo base_url(); ?>Blast_management/Blast_management/proses_blast">
              <div class="d-flex">
                <div class="media-body pt-1 ">
                  <span class="mb-0 h5 font-w-600">Summary Targetted Campaign</span>
                </div>
                <!-- <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0">$</span></div> -->

                <div class="form-group row">
                  <div class="col-12">
                    <select style="width:100%;" class='form-control' name="campaign" id="campaign" onchange="change_campaign();" required>
                      <option label="Choose Rules">Choose Rules</option>
                      <?php
                      if (count($campaign) > 0) {
                        foreach ($campaign['results'] as $cg) {
                          $selected = "";
                          if (isset($_GET['campaign']) && $_GET['campaign'] == $cg->id) {
                            $selected = "selected";
                          }
                          echo "<option value='" . $cg->id . "' $selected>" . $cg->nama_campaign . "</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

              </div>

              <!-- akan muncul secara default jika belum memilih rules, setelah pemilihan rules langsung muncul matrix dari data rules yg dipilih -->
              <?php
              if (isset($_GET['blast'])) {
              ?>
                <p>
                <div class="alert alert-success text-center" role="alert">
                  <h5>Digital Sales Berhasil diproses</h5>
                </div>
                </p>
              <?php
              }
              ?>

              <div class="row">
                <div class="col-md-3">
                  <div class="border-0 outline-badge-info p-2 rounded text-center">
                    <span class="h5 mb-0">
                      Total Data
                    </span>
                    <br />
                    <?php echo number_format($channel_dapros['total']); ?>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="border-0 outline-badge-success p-2 rounded ml-2 text-center">
                    <span class="h5 mb-0">
                      Channel Whatsapp</span>
                    <br />
                    <?php echo number_format($channel_dapros['WA']); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="border-0 outline-badge-primary p-2 rounded text-center">
                    <span class="h5 mb-0">
                      Channel Email
                    </span>
                    <br />
                    <?php echo number_format($channel_dapros['EMAIL']); ?>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="border-0 outline-badge-warning p-2 rounded ml-2 text-center">
                    <span class="h5 mb-0">
                      Channel SMS
                    </span>
                    <br />
                    <?php echo number_format($channel_dapros['SMS']); ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="border-0 outline-badge-success p-2 rounded ml-2 text-center">
                    <span class="h5 mb-0">
                      Total Data Lead</span>
                    <br />
                    <?php echo number_format(count($customer)); ?>
                  </div>
                </div>


              </div>
              <?php
              if (isset($_GET['campaign'])) {


              ?>
                <div class="row">
                  <div class="col-md-3 mb-4 mt-4">
                    <input type="date" class='form-control' name="date_blast" required value="<?php echo date("d/m/Y"); ?>">
                  </div>
                  <div class="col-md-3 mb-4 mt-4">
                    <select name="data_lead" id="data_lead" class='form-control'>
                      <option value="1">Blast From Data Lead</option>
                      <option value="2">Blast All Data</option>
                      <option value="3">Minimal score</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-4 mt-4">
                    <input type="number" style="display:none;" class='form-control' placeholder="*If choose By Minimal Score" name="min_score" id="min_score" value="0">
                  </div>
                  <div class="col-md-2 mb-4 mt-4">
                    <button class="btn btn-success btn-block" type="submit">Simpan Data Lead</button>
                  </div>
                  <div class="col-md-1 mb-4 mt-4">
                    <a class="btn btn-primary btn-block" href='<?php echo base_url('/Approve/Approve/preview/' . $_GET['campaign']); ?>' target="_blank">Preview</a>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <table class='display ' id="example" style="width: 100%;">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>SND</th>
                        <th nowrap>Segmentasi area</th>
                        <th nowrap>History View</th>
                        <th nowrap>Paket</th>
                        <th nowrap>MOSS</th>
                        <th nowrap>Last Blast</th>
                        <th nowrap>Last Campaign</th>
                        <th nowrap>CTP(147 & socmed)</th>
                        <th nowrap>Keyword</th>
                        <th nowrap>Score</th>
                      </tr>

                    </thead>
                    <tbody>
                      <?php
                      $n = 0;
                      if (count($customer) > 0) {
                        foreach ($customer as $cs => $val) {
                          $n++;
                      ?>
                          <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $customer[$cs]['snd']; ?></td>
                            <td><?php echo number_format($customer[$cs]['param_1']); ?></td>
                            <td><?php echo 0; ?></td>
                            <td><?php echo number_format($customer[$cs]['param_2']); ?></td>
                            <td><?php echo number_format($customer[$cs]['param_3']); ?></td>
                            <td><?php echo 0; ?></td>
                            <td><?php echo 0; ?></td>
                            <td><?php echo number_format($customer[$cs]['param_4']); ?></td>
                            <td><?php echo number_format($customer[$cs]['param_5']); ?></td>
                            <td><?php echo number_format($customer[$cs]['total']); ?></td>
                          </tr>
                      <?php
                        }
                      }
                      ?>

                    </tbody>
                  </table>
                </div>
              <?php
              }
              ?>
              <!-- START: Card Data-->

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php echo _js('datatables,icheck') ?>
  <script>
    var page_version = "1.0.8";
    $(document).ready(function() {
      $('#example').DataTable({
        "order": [
          [1, "DESC"]
        ],
        responsive: true
      });
      $("#data_lead").on("change", function() {
        if ($(this).val() == "3") {
          $("#min_score").show();
        } else {
          $("#min_score").hide();
        }

      });
    });
  </script>
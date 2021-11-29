<!-- START: Template CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.theme.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/simple-line-icons/css/simple-line-icons.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/flags-icon/css/flag-icon.min.css" />
<!-- END Template CSS-->

<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/datatable/DataTables/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/datatable/DataTables/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/select2/css/select2-bootstrap.min.css" />

<!-- START: Custom CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/css/main2.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/quill/quill.snow.css" />
<link
      rel="stylesheet"
      href="<?php echo base_url() ?>assets/temp_1/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css"
    />
   <!-- START: Pre Loader-->
    <!-- START: Main Content-->
      <div class="container-fluid site">

        
          <!-- Modal -->
          <div class="modal fade" id="preview-attach" tabindex="-1" role="dialog" aria-labelledby="preview-attachTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="preview-attachgTitle">Preview</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          </button>
                      </div>
                      <div class="modal-body">
                        <div class="preview-image-md">
                          <img src="<?= base_url('images/sample/dropzone_script.png')?>" alt="Preview Image" style="width:100%;max-height:400px;height:auto;">
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>

        <!-- START: Breadcrumbs-->
        <div class="row">
          <div class="col-12 align-self-center">
            <div
              class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded"
            >
              <div class="w-sm-100 mr-auto">
                <h4 class="mb-0">Campaign Management</h4>
              </div>

              <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item">App</li>
                <li class="breadcrumb-item active">
                  <a href="#">Campaign Management</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
          <div class="col-12 mt-3">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <nav>
                    <div
                      class="nav nav-tabs font-weight-bold"
                      id="nav-tab"
                      role="tablist"
                    >
                      <a
                        class="nav-item nav-link active"
                        id="nav-add-rules-tab"
                        data-toggle="tab"
                        href="#nav-add-rules"
                        role="tab"
                        aria-controls="nav-add-rules"
                        aria-selected="true"
                        >Add Rules</a
                      >
                      <a
                        class="nav-item nav-link"
                        id="nav-list-rules-tab"
                        data-toggle="tab"
                        href="#nav-list-rules"
                        role="tab"
                        aria-controls="nav-list-rules"
                        aria-selected="false"
                        >List Rules</a
                      >
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div
                      class="tab-pane fade show active"
                      id="nav-add-rules"
                      role="tabpanel"
                      aria-labelledby="nav-add-rules-tab"
                    >
                      <div class="py-3 border-bottom border-primary">
                        <div class="row">
                          <div class="col-12">
                            <form class="needs-validation" action="<?=base_url()?>Campaign_management/rules/simpan_rule" method="post" novalidate>
                              <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <input
                                    type="hidden"
                                    class="form-control"
                                    id="id"
                                    name="id"
                                  />
                                  <input
                                    type="hidden"
                                    class="form-control"
                                    id="status"
                                    name="status"
                                    value="1"
                                  />
                                  <label for="rule_name">Rules Name</label>
                                  <input
                                    type="text"
                                    class="form-control"
                                    id="rule_name"
                                    name="rule_name"
                                    placeholder="Rules Name"
                                    value=""
                                    required
                                  />
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label for="periode_from"
                                    >Periode From</label
                                  >
                                  <input
                                    type="datetime-local"
                                    class="form-control"
                                    id="periode_from"
                                    name="periode_from"
                                    required
                                  />
                                  <div class="valid-feedback">Looks good!</div>
                                </div>

                                <div class="col-md-3 mb-3">
                                  <label for="periode_end"
                                    >Periode Until</label
                                  >
                                  <input
                                    type="datetime-local"
                                    class="form-control"
                                    id="periode_end"
                                    name="periode_end"
                                    required
                                  />
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label for="validationCustomUsername"
                                    >Cust Segment</label
                                  >
                                  <select
                                    data-allow-clear="1"
                                    name="customer_kriteria"
                                    required
                                  >
                                    <option value="">-- Pilih Customer Kriteria --</option>
                                    <?php foreach($tampil_customer as $tc): ?>
                                      <option value="<?=$tc->id?>"><?=$tc->nama_kriteria?></option>
                                    <?php endforeach; ?>
                                  </select>
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label for="validationCustomUsername"
                                    >Product</label
                                  >
                                  <select
                                    data-allow-clear="1"
                                    name="produk"
                                    required
                                  >
                                  <option value="">-- Pilih Produk --</option>
                                    <?php foreach($tampil_produk as $tp): ?>
                                      <option value="<?=$tp->produk_key?>"><?=$tp->produk_value?></option>
                                    <?php endforeach; ?>
                                  </select>
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                  <label for="validationCustomUsername"
                                    >Wording</label
                                  >
                                  <select
                                    multiple
                                    data-allow-clear="1"
                                    name = "template[]"
                                    required
                                  >
                                  <option label="Choose Wording">
                                Choose Wording
                              </option>
                                <option>WA</option>
                                <option>Email</option>
                                  </select>
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                              </div>
                              
                              <button class="btn btn-primary float-right" type="submit">
                                Submit form
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="nav-list-rules"
                      role="tabpanel"
                      aria-labelledby="nav-list-rules-tab"
                    >
                      <div class="py-3 border-bottom border-primary">
                        <div class="table-responsive">
                          <table
                            id="exampleRule"
                            class="display table dataTable table-striped table-bordered"
                          >
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Rules Name</th>
                                <th>Periode From</th>
                                <th>Periode Until</th>
                                <th>Cust Segment</th>
                                <th>Product</th>
                                <th>Wording</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 5%">Tools</th>
                              </tr>
                            </thead>
                            <tbody id="showAllRule">
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add Contact -->
            <div class="modal fade" id="newcontact">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">
                      <i class="icon-pencil"></i> Edit Rule
                    </h5>
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <i class="icon-close"></i>
                    </button>
                  </div>
                  <form class="add-contact-form" action="<?=base_url()?>Campaign_management/rules/simpan_rule" method="post">
                    <div class="modal-body">
                      <form class="needs-validation" novalidate>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <input
                              type="hidden"
                              class="form-control"
                              id="id_edit"
                              name="id_edit"
                            />
                            <input
                                    type="hidden"
                                    class="form-control"
                                    id="status_edit"
                                    name="status_edit"
                                    value="1"
                                  />
                            <label for="rule_name_edit">Rules Name</label>
                            <input
                              type="text"
                              class="form-control"
                              id="rule_name_edit"
                              name="rule_name_edit"
                              placeholder="Rules Name"
                              value=""
                              required
                            />
                            <div class="valid-feedback">Looks good!</div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="periode_from_edit"
                              >Periode From</label
                            >
                            <input
                              type="datetime-local"
                              class="form-control"
                              id="periode_from_edit"
                              name="periode_from_edit"
                              required
                            />
                            <div class="valid-feedback">Looks good!</div>
                          </div>

                          <div class="col-md-3 mb-3">
                            <label for="periode_end_edit"
                              >Periode Until</label
                            >
                            <input
                              type="datetime-local"
                              class="form-control"
                              id="periode_end_edit"
                              name="periode_end_edit"
                              required
                            />
                            <div class="valid-feedback">Looks good!</div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="customer_kriteria_edit"
                              >Cust Segment</label
                            >
                            <select
                              data-allow-clear="1"
                              name="customer_kriteria_edit"
                              id="customer_kriteria_edit"
                              required
                            >
                              <option value="">-- Pilih Customer Kriteria --</option>
                              <?php foreach($tampil_customer as $tc): ?>
                                <option value="<?=$tc->id?>"><?=$tc->nama_kriteria?></option>
                              <?php endforeach; ?>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="produk_edit"
                              >Product</label
                            >
                            <select
                              data-allow-clear="1"
                              name="produk_edit"
                              id="produk_edit"
                              required
                            >
                            <option value="">-- Pilih Produk --</option>
                              <?php foreach($tampil_produk as $tp): ?>
                                <option value="<?=$tp->produk_key?>"><?=$tp->produk_value?></option>
                              <?php endforeach; ?>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="template_edit"
                              >Wording</label
                            >
                            <select
                              multiple
                              data-allow-clear="1"
                              name = "template_edit[]"
                              id="template_edit"
                              required
                            >
                              <option label="Choose Wording">
                                Choose Wording
                              </option>
                                <option>WA</option>
                                <option>Email</option>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                          </div>
                          
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary add-todo">
                        Add Contact
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Card DATA-->
      </div>
    <!-- END: Content-->

  <!-- START: Template JS-->
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/bootstrap/js/bootstrap.bundle.min.js.map"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/jQuery/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/jQuery/jquery-3.3.1.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/moment/moment.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/slimscroll/jquery.slimscroll.min.js"></script>
  <!-- END: Template JS-->

  <!-- START: APP JS-->
  <script src="<?php echo base_url() ?>assets/temp_1/js/app.js"></script>
  <!-- END: APP JS-->

  <!-- START: Page Vendor JS-->
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/DataTables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/DataTables/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
  <!-- END: Page Vendor JS-->

  <!-- START: Page JS-->

  <!-- <script src="<?php echo base_url() ?>assets/temp_1/js/datatable.script.js"></script> -->
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/select2/js/select2.full.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/quill/quill.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/js/select2.script.js"></script>
  <!-- END: Content-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
var datatable;
showAllRule();

function mutateForm(id,rule_name,periode_from,periode_end,id_customer_kriteria,product_key,id_template,status, nama_template) {
        document.getElementById('id_edit').value = id;
        console.log(document.getElementById('id_edit').value);
        document.getElementById('rule_name_edit').value = rule_name;
        var format_date_from = new Date(periode_from).toISOString().slice(0, 16);
        document.getElementById('periode_from_edit').value = format_date_from;

        var format_date_end = new Date(periode_end).toISOString().slice(0, 16);
        document.getElementById('periode_end_edit').value = format_date_end;

        $("#customer_kriteria_edit").val(id_customer_kriteria).trigger('change');
        $("#produk_edit").val(product_key).trigger('change');

        var nama_template_select = nama_template.split(',');
        $('#template_edit').val(nama_template_select).trigger('change');

      };

      function editStatus(id, status) {
        var data = `id=${id}&status=${status}`;
        $(`#status-${id}`).empty();
        if(status == "0") {
          $(`#status-${id}`).html(`<div class="toggle btn btn-light btn-xs off" data-toggle="toggle" role="button" style="width: 50px; height: 3px;"><input type="checkbox" checked data-toggle="toggle" data-width="50" data-size="xs" data-height="3"><div class="toggle-group"><label for="" class="btn btn-primary btn-xs toggle-on">On</label><label for="" class="btn btn-light btn-xs toggle-off">Off</label><span class="toggle-handle btn btn-light btn-xs"></span></div></div>`);
          $(`#status-${id}`).attr("onclick", `editStatus('${id}', '1')`);
        } else if(status == "1") {
          $(`#status-${id}`).html(`<div class="toggle btn btn-primary btn-xs" data-toggle="toggle" role="button" style="width: 50px; height: 3px;"><input type="checkbox" checked data-toggle="toggle" data-width="50" data-size="xs" data-height="3"><div class="toggle-group"><label for="" class="btn btn-primary btn-xs toggle-on">On</label><label for="" class="btn btn-light btn-xs toggle-off">Off</label><span class="toggle-handle btn btn-light btn-xs"></span></div></div>`);
          $(`#status-${id}`).attr("onclick", `editStatus('${id}', '0')`);
        }
        $.ajax({
          url: '<?= base_url() ?>Campaign_management/rules/edit_status',
          type: 'post',
          dataType: 'json',
          async: true,
          data: data,
          success: function(data) {
                
            
          },
          error: function(err) {
            console.log(err);
          }
        });
      }

function showAllRule() {
        var dataRes;
        $.ajax({
          url: '<?= base_url() ?>Campaign_management/rules/showAllRule',
          type: 'post',
          contentType: 'application/json',
          dataType: 'json',
          async: true,
          success: function(data) {
            dataRes = data;
            let html = '';
            let no = 1;
            datatable = $('#exampleRule').DataTable({
              "data": data.posts,
              "columns": [
                {
                  "render": function() {
                    return html = no++;
                  }
                },
                // {
                //   "data": "code_product"
                // },
                {
                  "data": "rule_name"
                },
                {
                  "data": "periode_from"
                }
                ,
                {
                  "data": "periode_end"
                }
                ,
                {
                  "data": "nama_kriteria"
                }
                ,
                {
                  "data": "produk_value"
                }
                ,
                {
                  "data": "nama_template"
                }
                ,
                {
                  "render": function(data,type,row,meta) {
                    
                      html = `<div id="status-${row.id_rule}" onclick="editStatus('${row.id_rule}', '${row.status == "1" ? "0": "1"}')"><div class="toggle btn ${row.status == "1" ? "btn-primary" : "btn-light"} btn-xs ${row.status == "1" ? "" : "off"}" data-toggle="toggle" role="button" style="width: 50px; height: 3px;"><input type="checkbox" checked data-toggle="toggle" data-width="50" data-size="xs" data-height="3"><div class="toggle-group"><label for="" class="btn btn-primary btn-xs toggle-on">On</label><label for="" class="btn btn-light btn-xs toggle-off">Off</label><span class="toggle-handle btn btn-light btn-xs"></span></div></div></div>`;
                    
                    //html = `<input class="toggle btn btn-primary btn-xs" type="checkbox" ${row.status == "1" ? "checked" : ""} data-toggle="toggle" data-width="50" data-size="xs" data-height="3" onclick="editStatus('${row.id_rule}', '${row.status == "1" ? 0: 1}')" />`;
                    return html;
                  }
                }
                ,
                {
                  "render": function(data, type, row, meta) {
                    html = `<a href="javascript:void(0)" data-toggle="modal" data-target="#newcontact" onclick="mutateForm('${row.id_rule}','${row.rule_name}','${row.periode_from}','${row.periode_end}','${row.id_customer_kriteria}','${row.product_key}','${row.id_template}','${row.status}', '${row.nama_template}');" 
                    class = "ml-2"><i class = "icon-pencil"></i></a >`;
                    return html;
                  }
                }
              ]
            });
            // for (i = 0; i < data.length; i++) {
            //   html += '<tr>' +
            //             '<td>' + (no++) + '</td>' +
            //             '<td>' + data[i].code_product + '</td>' + 
            //             '<td>' + data[i].name_product + '</td>' + 
            //             '<td>' + data[i].price + '</td>' + 
            //             '<td>' + data[i].name_product + '</td>' + 
            //             '<td>' + 
            //               '<a href = "<?= base_url() ?>Campaign_management/resources/get_resource_product/' + data[i].id + 
            //               '"class = "ml-2"><i class = "icon-pencil"></i></a >' +
            //             '</td>' +
            //           '</tr>';
            // }
            // $('#showDataProduct').html(html);
          },
          error: function() {
            alert('Could not get Data From Database');
          }
        });
      }
      
</script>
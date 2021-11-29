<!-- START: Template CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/jquery-ui/jquery-ui.theme.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/simple-line-icons/css/simple-line-icons.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/flags-icon/css/flag-icon.min.css" />
<!-- END Template CSS-->

<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/datatable/DataTables/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/css/buttons.bootstrap4.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/select2/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/select2/css/select2-bootstrap.min.css" />

<!-- START: Custom CSS-->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/css/main2.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>assets/temp_1/vendors/quill/quill.snow.css" />
<!-- START: Pre Loader-->
<!-- START: Main Content-->
<div class="container-fluid site">
  <!-- START: Breadcrumbs-->
  <div class="row">
    <div class="col-12 align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto">
          <h4 class="mb-0">Resources Controller</h4>
        </div>

        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">App</li>
          <li class="breadcrumb-item active">
            <a href="#">Resources Controller</a>
          </li>
        </ol>
      </div>
    </div>
  </div>
  <!-- END: Breadcrumbs-->

  <!-- START: Card Data-->
  <div class="row row-eq-height">
    <div class="col-12 mt-3">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <nav>
              <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-product-tab" data-toggle="tab" href="#nav-product" role="tab" aria-controls="nav-product-rules" aria-selected="false">Product</a>
                <a class="nav-item nav-link" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer-rules" aria-selected="true">Customer</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                <div class="py-3">
                  <div class="row">
                    <div class="col-12">
                      <div class="card mb-3">
                        <div class="card-header">
                          <h4 class="card-title">Add Product</h4>
                        </div>
                          <div id="success">
                          </div>
                          <div id="error">
                          </div>
                        <div class="card-body">
                          <form id="myForm1" class="needs-validation" method="POST" novalidate>
                            <div class="form-row">
                              <div class="col-md-5">
                                <div class="row">
                                  <input hidden name="produk_key" class="form-control" id="produk_key"/>
                                  <div class="col-md-12 mb-3">
                                    <label for="produk_value">Name Produk</label>
                                    <input type="text" name="produk_value" class="form-control" id="produk_value" placeholder="Name Produk" required />
                                    <div class="valid-feedback">Looks good!</div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label for="category_produk_value">Nama Category Produk</label>
                                    <select name="category_produk_value" class="form-control" id="category_produk_value" required>
                                    <option value="">-- Pilih Nama Category Produk --</option>
                                     <?php foreach($category_produk as $cp): ?>
                                      <option value="<?=$cp->category_produk_key?>" ><?=$cp->category_produk_value?></option>
                                     <?php endforeach; ?>
                                    </select>                                                                                                       
                                    <div class="valid-feedback">Looks good!</div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                  <label for="category_produk_description">Category Produk Description</label>
                                    <input type="text" name="category_produk_description" class="form-control" id="category_produk_description" placeholder="Category Produk Description" required disabled />
                                    <div class="valid-feedback">Looks good!</div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-7">
                                <div class="col-md-12 mb-3">
                                    <label for="produk_description">Produk Description</label>
                                    <!-- <input type="text" name="produk_description" id="produk_description"/> -->
                                    <div class="form-control" id="snow-container" name="quill_produk_description" cols="30" rows="10" required style="min-height: 143px;"></div>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                              </div>
                            </div>
                            <button class="btn btn-primary float-right" type="button" onclick="saveForm()">
                              Submit form
                            </button>
                            <button class="btn btn-danger float-right" type="button" onclick="resetForm()" style="margin-right:10px">
                              Reset Form
                            </button>
                          </form>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">List Product</h4>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Name Produk</th>
                                  <th>Produk Description</th>
                                  <th>Nama Category Produk</th>
                                  <th>Category Produk Description</th>
                                  <!-- <th>Code</th>
                                  <th>Price</th> -->
                                  <th style="width: 5%">Tools</th>
                                </tr>
                              </thead>
                              <tbody id="showDataProduct">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                <div class="py-3">
                  <div class="row">
                    <div class="col-12">
                      <div class="card mb-3">
                        <div class="card-header">
                          <h4 class="card-title">Add Cust Kriteria</h4>
                        </div>
                        <div class="card-body">
                          <form class="needs-validation" action="<?=base_url()?>Campaign_management/resources/simpan_resource_customer" method="post" novalidate>
                          <div class="form-row">
                                  <div class="col-md-5">
                                    <div class="row">
                                      <div class="col-md-12 mb-3">
                                      <input hidden name="id_customer" class="form-control" id="id_customer" />
                                      <label for="nama_kriteria">Nama Kriteria</label>
                                    <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" required />
                                    <div class="valid-feedback">Looks good!</div>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="regional">Area</label>
                                        <select name="regional" id="regional" required>
                                          <option value="">-- Pilih Area --</option>
                                          <?php foreach($tampil_regional as $tr): ?>
                                          <option value="<?=$tr->regional_key?>"><?=$tr->regional_value?></option>
                                        <?php endforeach; ?>
                                        </select>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="paket">Paket</label>
                                        <select multiple data-allow-clear="1" class="form-control multiple-paket" name="paket[]" id="paket" required>
                                        <option value="">-- Pilih Paket --</option>
                                          <?php foreach($tampil_category_produk as $tcp): ?>
                                          <option><?=$tcp->category_produk_value?></option>
                                        <?php endforeach; ?>
                                        </select>
                                      </div>
                                      <div class="col-md-6 mb-6">
                                      <label for="channel">History View Channel</label>
                                      <select name="channel" id="channel" required>
                                      <option value="">-- Pilih Channel --</option>
                                        <?php foreach($tampil_channel as $tc): ?>
                                        <option value="<?=$tc->produk_key?>"><?=$tc->produk_value?></option>
                                      <?php endforeach; ?>
                                      </select>
                                        <div class="valid-feedback">Looks good!</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-7">
                                    <div class="row">
                                      <div class="col-md-6 mb-3">
                                        <label for="last_campaign_time">Last Campaign Time</label>
                                        <input type="datetime-local" name="last_campaign_time" class="form-control" id="last_campaign_time" placeholder="Last Campaign Time" required />
                                        <div class="valid-feedback">Looks good!</div>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="layanan">AddOn Information</label>
                                        <select name="layanan" id="layanan" required>
                                        <option value="">-- Pilih AddOn Information --</option>
                                            <?php foreach($tampil_layanan as $tl): ?>
                                            <option value="<?=$tl->layanan_key?>"><?=$tl->layanan_value?></option>
                                          <?php endforeach; ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="type_interaction">Type Interaction</label>
                                        <select multiple data-allow-clear="1" id="type_interaction" name="type_interaction[]" required>
                                          <option label="">-- Choose on thing --</option>
                                          <option>Information</option>
                                          <option>Registration</option>
                                          <option>ComplainMyindiHome</option>
                                          <option>Profiing</option>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                      </div>
                                      <div class="col-md-12 mb-3">
                                        <label for="tag_interaction">Tag Interaction</label>
                                        <input type="text" name="tag_interaction[]" id="tag_interaction" class="form-control" required>
                                        <!-- <select class="tokenizationSelect2" multiple data-allow-clear="1" name="tag_interaction[]" id="tag_interaction" required>
                                        </select> -->
                                        <div class="valid-feedback">Looks good!</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>  
                          <!-- <div class="form-row">
                              <div class="col-md-5">
                                <div class="row">
                                  <input type="hiddden" name="id_customer" class="form-control" id="id_customer" />
                                  <div class="col-md-12 mb-3">
                                    <label for="nama_kriteria">Nama Kriteria</label>
                                    <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" placeholder="Nama Kriteria" required />
                                    <div class="valid-feedback">Looks good!</div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label for="area">Area</label>
                                    <select name="regional" id="regional" required>
                                      <option value="">-- Pilih Regional --</option>
                                      <?php foreach($tampil_regional as $tr): ?>
                                      <option value="<?=$tr->regional_key?>"><?=$tr->regional_value?></option>
                                     <?php endforeach; ?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label for="paket">Paket</label>
                                    <select multiple data-allow-clear="1" class="form-control multiple-paket" name="paket[]" id="paket" required>
                                      <option value="Pkg 1">Pkg 1</option>
                                      <option value="Pkg 2">Pkg 2</option>
                                      <option value="Pkg 3">Pkg 3</option>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <label for="channel">History View Channel</label>
                                    <select name="channel" id="channel" required>
                                    <option value="">-- Pilih Channel --</option>
                                      <?php foreach($tampil_channel as $tc): ?>
                                      <option value="<?=$tc->produk_key?>"><?=$tc->produk_value?></option>
                                     <?php endforeach; ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-7">
                                <div class="col-md-12 mb-3">
                                  <label for="moss_subs_notps">Subscription</label>
                                  <select name="moss_subs_notps" id="moss_subs_notps" required>
                                  <option value="">-- Pilih Subscription --</option>
                                    <option value="Sub 1">Sub 1</option>
                                    <option value="Sub 2">Sub 2</option>
                                    <option value="Sub 3">Sub 3</option>
                                    <option value="Sub 4">Sub 4</option>
                                    <option value="Sub 5">Sub 5</option>
                                  </select>
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-12 mb-3">
                                  <label for="last_campaign_time">Last Campaign Time</label>
                                  <input type="datetime-local" name="last_campaign_time" class="form-control" id="last_campaign_time" placeholder="Last Campaign Time" required />
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-12 mb-3">
                                  <label for="history_campaign_topic">History Campaign Topic</label>
                                  <select name="history_campaign_topic" id="history_campaign_topic" required>
                                  <option value="">-- Pilih History Campaign Topic --</option>
                                    <option value="History 1">History 1</option>
                                    <option value="History 2">History 2</option>
                                    <option value="History 3">History 3</option>
                                    <option value="History 4">History 4</option>
                                  </select>
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-md-12 mb-3">
                                  <label for="layanan">Layanan</label>
                                  <select name="layanan" id="layanan" required>
                                  <option value="">-- Pilih Layanan --</option>
                                      <?php foreach($tampil_layanan as $tl): ?>
                                      <option value="<?=$tl->layanan_key?>"><?=$tl->layanan_value?></option>
                                     <?php endforeach; ?>
                                  </select>
                                  <div class="valid-feedback">Looks good!</div>
                                </div>
                              </div>
                            </div> -->
                            <button class="btn btn-primary float-right" type="submit">
                              Submit form
                            </button>
                          </form>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">List Cust Kriteria</h4>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="exampleCustomer" class="display table dataTable table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama Kriteria</th>
                                  <th>Regional</th>
                                  <th>Package</th>
                                  <th>History View Channel</th>
                                  <th style="width: 5%">Last Campaign</th>
                                  <th>AddOn Info</th>
                                  <th>Type Interaction</th>
                                  <th>Tag Interaction</th>
                                  <th style="width: 5%">Tools</th>
                                </tr>
                              </thead>
                              <tbody id="showDataCustomer">

                              </tbody>
                            </table>
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
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>assets/temp_1/vendors/datatable/buttons/js/buttons.print.min.js"></script>

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

    var quill = new Quill('#snow-container', {
      theme: 'snow'
    });
    $('#channel').select2();
    
    showAllProduct();
    showDataCustomer();
    var datatable;
      
    // $(document).ready(function(){
    //   $("#quill_product_description").keyup(function(){
    //     var produk_description = document.querySelector('input[name=produk_description]');
    //     produk_description.value = JSON.stringify(quill.getContents())
    //   });
    // });
    
      function mutateForm(produk_key, produk_value, produk_description, category_produk_key, category_produk_value, category_produk_description) {
        quill.root.innerHTML = produk_description;
        document.getElementById('produk_key').value = produk_key;
        // document.getElementById("produk_key").value = produk_key;
        document.getElementById("produk_value").value = produk_value;
        // document.getElementById("quill_produk_description").value = quill.root.innerHTML;
        document.getElementById("category_produk_description").value = category_produk_description;

        var selectCategory = $("#category_produk_value");
        selectCategory.val(category_produk_key).trigger("change");
        // document.getElementById("category_produk_key").value = category_produk_key;
      }

      function resetForm() {
        quill.root.innerHTML = "";
        var produk_key = document.getElementById("produk_key");
        var inputVal = "";
        if (produk_key) {
            inputVal = produk_key.value;
          }
        document.getElementById("produk_value").value = "";
        // var produk_description = document.getElementById("produk_description");
        // var inputVal = "";
        // if (produk_description) {
          //     inputVal = produk_description.value;
          // }
          var selectCategory = $("#category_produk_value");
        selectCategory.val("").trigger("change");

        console.log(document.getElementById("category_produk_description").selectedIndex);
        document.getElementById("category_produk_description").value = "";
        
      }

      function saveForm() {
        var produk_key,
        element = document.getElementById('produk_key');
        if (element != null) {
          produk_key = element.value;
        }
        else {
          produk_key = null;
        }
        var produk_value = document.getElementById("produk_value").value;
        var produk_description = quill.root.innerHTML;
        var category_produk_key = parseInt(document.getElementById("category_produk_value").value);
        var category_produk_description = parseInt(document.getElementById("category_produk_description").value);
        var x = document.getElementById("category_produk_value").selectedIndex;
        var y = document.getElementById("category_produk_value").options;
        var category_produk_value = y[x].text;

        var form = $("#myForm1").serialize() + '&produk_description=' + quill.root.innerHTML;
        console.log(form);

        var tosubmit = {
            "produk_key": produk_key,
            "produk_value": produk_value,
            "produk_description": quill.root.innerHTML,
            "category_produk_key": category_produk_key
          };
        $.ajax({
          url: "<?= base_url() ?>Campaign_management/resources/simpan_resource_product",
          type: 'POST',
          dataType: 'json',
          async: true,
          data: form,
          success: function(data) {
            console.log(data.status);
            if(data.status == "OK") {
              document.getElementById("success").innerHTML = `<div class="alert alert-success">${data.message}</div>`;
              datatable.row.add({
                "produk_key": produk_key,
                "produk_value": produk_value,
                "produk_description": produk_description,
                "category_produk_value": category_produk_value,
                "category_produk_description": category_produk_description
            });
            datatable.destroy();
            showAllProduct();
            resetForm();
            } else {
              document.getElementById("error").innerHTML = `<div class="alert alert-error">${data.message}</div>`;
            }
            
          },
          error: function(xhr, status, error) {
            console.error(status, error);
          },
        });
      }

      function showAllProduct() {
        var dataRes;
        $.ajax({
          url: '<?= base_url() ?>Campaign_management/resources/showAllProduct',
          type: 'post',
          contentType: 'application/json',
          dataType: 'json',
          async: true,
          success: function(data) {
            dataRes = data;
            let html = '';
            let no = 1;
            console.log(data);
            datatable = $('#example').DataTable({
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
                  "data": "produk_value"
                },
                {
                  "data": "produk_description"
                }
                ,
                {
                  "data": "category_produk_value"
                }
                ,
                {
                  "data": "category_produk_description"
                }
                ,
                {
                  "render": function(data, type, row, meta) {
                    html = `<a href="javascript:void(0)" onclick="mutateForm('${row.produk_key}','${row.produk_value}','${row.produk_description}',${row.category_produk_key},'${row.category_produk_value}','${row.category_produk_description}');" 
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
      
      $('#category_produk_value').change(function(){ 
              var category_produk_key = parseInt(document.getElementById("category_produk_value").value);
              $.ajax({
                  url : "<?= base_url() ?>Campaign_management/resources/showSelectCategoryProduk",
                  method : "POST",
                  // data : {"category_produk_key": category_produk_key},
                  data: $("#myForm1").serialize(),
                  dataType : 'json',
                  success: function(data){
                    if(data.posts.category_produk_description == null){
                      document.getElementById("category_produk_description").value = data.posts;
                    }
                    else{
                      document.getElementById("category_produk_description").value = data.posts.category_produk_description;
                    }
                  }
              });
              return false;
          }); 
      
      function saveForm() {
        var produk_key,
        element = document.getElementById('produk_key');
        if (element != null) {
          produk_key = element.value;
        }
        else {
          produk_key = null;
        }
        var produk_value = document.getElementById("produk_value").value;
        var produk_description = quill.root.innerHTML;
        var category_produk_key = parseInt(document.getElementById("category_produk_value").value);
        var category_produk_description = parseInt(document.getElementById("category_produk_description").value);
        var x = document.getElementById("category_produk_value").selectedIndex;
        var y = document.getElementById("category_produk_value").options;
        var category_produk_value = y[x].text;

        var form = $("#myForm1").serialize() + '&produk_description=' + quill.root.innerHTML;

        var tosubmit = {
            "produk_key": produk_key,
            "produk_value": produk_value,
            "produk_description": quill.root.innerHTML,
            "category_produk_key": category_produk_key
          };
        $.ajax({
          url: "<?= base_url() ?>Campaign_management/resources/simpan_resource_product",
          type: 'POST',
          dataType: 'json',
          async: true,
          data: form,
          success: function(data) {
            console.log(data.status);
            if(data.status == "OK") {
              document.getElementById("success").innerHTML = `<div class="alert alert-success">${data.message}</div>`;
              datatable.row.add({
                "produk_key": produk_key,
                "produk_value": produk_value,
                "produk_description": produk_description,
                "category_produk_value": category_produk_value,
                "category_produk_description": category_produk_description
            });
            datatable.destroy();
            showAllProduct();
            resetForm();
            } else {
              document.getElementById("error").innerHTML = `<div class="alert alert-error">${data.message}</div>`;
            }
            
          },
          error: function(xhr, status, error) {
            console.error(status, error);
          },
        });
      }


      //Customer
      function mutateFormCustomer(id, nama_kriteria, regional_key, paket_key, produk_key, moss_subs_notps, last_campaign_time, history_campaign_topic, layanan_key, type_interaction,tag_interaction, nama_paket) {
        document.getElementById('id_customer').value = id;
        document.getElementById("nama_kriteria").value = nama_kriteria;
        $("#regional").val(regional_key).trigger('change');
        var nama_paket_select = nama_paket.split(',');
        $("#paket").val(nama_paket_select).trigger('change');
        $("#channel").val(produk_key).trigger('change');

        var format_date = new Date(last_campaign_time).toISOString().slice(0, 16);
        document.getElementById("last_campaign_time").value = format_date;

        $('#layanan').val(layanan_key).trigger('change');

        var type_interaction_select = type_interaction.split(',');
        $('#type_interaction').val(type_interaction_select).trigger('change');

        var tag_interaction_select = tag_interaction.split(',');
        $('#tag_interaction').val(tag_interaction_select).trigger('change');
      }
      
      function showDataCustomer() {
        var dataRes;
        $.ajax({
          url: '<?= base_url() ?>Campaign_management/resources/showAllCustomer',
          type: 'post',
          contentType: 'application/json',
          dataType: 'json',
          async: true,
          success: function(data) {
            dataRes = data;
            let html = '';
            let no = 1;
            datatable = $('#exampleCustomer').DataTable({
              "data": data.posts,
              "columns": [
                {
                  "render": function() {
                    return html = no++;
                  }
                },
                {
                  "data": "nama_kriteria"
                },
                {
                  "data": "regional_value"
                },
                {
                  "data": "nama_paket"
                }
                ,
                {
                  "data": "produk_value"
                }
                ,
                {
                  "data": "last_campaign_time"
                }
                ,
                {
                  "data": "layanan_value"
                }
                ,
                {
                  "data": "type_interaction"
                }
                ,
                {
                  "data": "tag_interaction"
                }
                ,
                {
                  "render": function(data, type, row, meta) {
                    html = `<a href="javascript:void(0)" onclick="mutateFormCustomer('${row.id}','${row.nama_kriteria}','${row.regional_key}','${row.paket_key}','${row.produk_key}','${row.moss_subs_notps}','${row.last_campaign_time}','${row.history_campaign_topic}','${row.layanan_key}','${row.type_interaction}','${row.tag_interaction}', '${row.nama_paket}');" 
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
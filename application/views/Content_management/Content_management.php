<div class="container-fluid site-width">
  <!-- START: Breadcrumbs-->
  <div class="row">
    <div class="col-12 align-self-center">
      <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
        <div class="w-sm-100 mr-auto">
          <h4 class="mb-0">Generator</h4>
        </div>

        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">App</li>
          <li class="breadcrumb-item active">
            <a href="#">Generator</a>
          </li>
        </ol>
      </div>
    </div>
  </div>
  <!-- END: Breadcrumbs-->

  <!-- START: Card Data-->
  <div class="row">

    <div class="col-5 mt-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <nav>
            <div class="nav nav-tabs font-weight-bold" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-email-tab" data-toggle="tab" href="#nav-email" role="tab" aria-controls="nav-email" aria-selected="true">Email</a>

              <a class="nav-item nav-link ml-2" id="nav-whatsapp-tab" data-toggle="tab" href="#nav-whatsapp" role="tab" aria-controls="nav-whatsapp" aria-selected="false">Whatsapp</a>

              <a class="nav-item nav-link ml-2" id="nav-sms-tab" data-toggle="tab" href="#nav-sms" role="tab" aria-controls="nav-sms" aria-selected="false">SMS</a>
            </div>
          </nav>
        </div>
        <div class="card-body">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-email" role="tabpanel" aria-labelledby="nav-email-tab">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputState">Nama Campaign</label>
                  <input type="text" class="form-control" id="validationCustom01" placeholder="Nama Campaign" value="" required />
                </div>

                <div class="form-group">
                  <label for="validationCustomUsername">Choose Campaign Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                </div>

                <div class="form-group">
                  <!-- disini load snow container quill textarea -->
                  <label for="inputState">Email Desc</label>
                  <div id="snow-container" class="height-175 snow-container"></div>
                </div>

                <div class="form-group">
                  <label for="inputState">Button Link</label>
                  <input type="text" class="form-control" id="validationCustom01" placeholder="Button Link" value="" required />
                </div>

                <button class="btn btn-info btn-block" type="submit">Preview</button>
                <button class="btn btn-success btn-block" type="submit">Submit</button>
              </form>
            </div>

            <div class="tab-pane fade" id="nav-whatsapp" role="tabpanel" aria-labelledby="nav-whatsapp-tab">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputState">Nama Campaign</label>
                  <input type="text" class="form-control" id="validationCustom01" placeholder="Nama Campaign" value="" required />
                </div>

                <div class="form-group">
                  <label for="validationCustomUsername">Choose Image Whatsapp</label>

                  <!-- choose file hanya muncul ketika dropdown wording di pilih wa -->
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                </div>

                <div class="form-group">
                  <!-- disini load snow container quill textarea -->
                  <label for="inputState">Whatsapp Desc</label>
                  <div id="snow-container1" class="height-175 snow-container"></div>
                </div>

                <button class="btn btn-info btn-block" type="submit">Submit</button>
              </form>
            </div>

            <div class="tab-pane fade" id="nav-sms" role="tabpanel" aria-labelledby="nav-sms-tab">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputState">Nama Campaign</label>
                  <input type="text" class="form-control" id="validationCustom01" placeholder="Nama Campaign" value="" required />
                </div>
                <div class="form-group">
                  <!-- disini load snow container quill textarea -->
                  <label for="inputState">SMS Desc</label>
                  <div id="snow-container2" class="height-175 snow-container"></div>
                </div>

                <button class="btn btn-info btn-block" type="submit">Submit</button>
              </form>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-7 mt-3">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Preview</h4>
        </div>
        <div class="card-content">
          <div class="card-image business-card">
            <div class="background-image-maker"></div>
            <div class="holder-image">
              <img src="assets/img-landing-page.jpeg" alt="" class="img-fluid">
            </div>
            <!-- <div class="like"> 10:30am to 11:00pm</div> -->
          </div>
          <div class="card-body">
            <!-- <h5 class="card-title mb-3 mt-2">Vintage Italian Restaurant</h5> -->
            <p class="card-text">
              Isi Form disamping untuk melihat Preview Content
            </p>
            <p class="text-center">
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </p>
          </div>
          <img src="assets/footer.jpg" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </div>
  <!-- END: Card DATA-->
</div>
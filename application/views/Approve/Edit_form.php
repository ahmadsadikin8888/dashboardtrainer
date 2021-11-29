<link rel="stylesheet" href="<?php echo base_url(); ?>assets/new_theme/dist/vendors/quill/quill.snow.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/summernote/summernote-lite.min.css" />
<script src="<?php echo base_url(); ?>assets/summernote/summernote-lite.min.js"></script>
<?php echo _css('datatables,selectize,multiselect') ?>
<?php echo card_open('Approval Content & Campaign', 'bg-green', true) ?>
<form action="<?php echo base_url('Approve/Approve/save'); ?>" method="post" enctype="multipart/form-data" id="generator_template_email">

    <div class="container-fluid site">

        <div class="form-group">
            <label for="inputState">Nama Campaign</label>
            <input required type="text" class="form-control" id="nama_campaign" readonly placeholder="Nama Campaign" value="<?php echo $data->nama_campaign; ?>" required name="nama_campaign" />
        </div>
        <div class="form-group">
            <label for="inputState">Landing Page</label>
            <select required class="form-control custom-select" id="landing_page_key" readonly name="landing_page_key">
                <?php
                foreach ($landing_page->result() as $lp) {
                    $selected = "";
                    if ($lp->landing_page_key == $data->landing_page_key) {
                        $selected = "selected";
                    }
                    echo "<option value='$lp->landing_page_key' $selected>$lp->campaign_name</option>";
                }
                ?>

            </select>
            <!-- <input type="text" class="form-control" id="produk_asli" placeholder="Nama Produk" value="" required name="name_produk" /> -->
        </div>
        <div class="form-group">
            <label for="inputState">Produk yang akan dicampaign</label>
            <select required class="form-control custom-select" id="nama_produk" readonly name="nama_produk[]" multiple="multiple">
                <?php
                foreach ($nama_produk->result() as $produk) {
                    $selected = "";
                    $list_selpro = explode('|', $data->id_produk);
                    if (in_array($produk->produk_value, $list_selpro)) {
                        $selected = "selected";
                    }
                    echo "<option value='$produk->produk_value' $selected>$produk->produk_description</option>";
                }
                ?>

            </select>
            <!-- <input type="text" class="form-control" id="produk_asli" placeholder="Nama Produk" value="" required name="name_produk" /> -->
        </div>

    </div>
    <?php echo card_close() ?>

    <?php echo card_open(' Rule', 'bg-green', true) ?>
    <div class="form-group">
        <label for="inputState">Area</label>
        <select class="form-control  custom-select" readonly id="area" name="area[]" multiple="multiple">
            <?php
            foreach ($area as $dataarea) {
                $selected = "";
                $list_selpro = explode(',', $data->r_area);
                if (in_array($dataarea->regional_key, $list_selpro)) {
                    $selected = "selected";
                }
                echo "<option value='$dataarea->regional_key' $selected>$dataarea->regional_value</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputState">Paket</label>
        <select class="form-control custom-select" readonly id="paket" name="paket[]" multiple="multiple">
            <?php
            $paket = array('Paket Entry', 'Paket Intro', 'Paket Basic');
            foreach ($paket as $pk) {
                $selected = "";
                $list_selpro = explode(',', $data->r_paket);
                if (in_array($pk, $list_selpro)) {
                    $selected = "selected";
                }
                echo "<option value='$pk' $selected>$pk</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputState">Historical View Channel</label>
        <select class="form-control custom-select" readonly id="history" name="history[]" multiple="multiple">
            <?php
            foreach ($nama_produk->result() as $datana) {
                $list_selpro = explode(',', $data->r_history);
                if (in_array($datana->produk_key, $list_selpro)) {
                    $selected = "selected";
                }
                echo "<option value='$datana->produk_key' $selected>$datana->produk_description</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputState">Subscribe Minipack RNA / Not PS</label><br>
        <input type="radio" id="yes" name="subscribe" readonly value="1" <?php echo ($data->r_subscribe == 1 ? 'checked' : ''); ?>>
        <label for="male">Yes</label><br>
        <input type="radio" id="no" name="subscribe" readonly value="0" <?php echo ($data->r_subscribe == 0 ? 'checked' : ''); ?>>
        <label for="female">No</label><br>
    </div>
    <div class="form-group">
        <label for="inputState">Waktu Blast Terakhir Dikirim</label>
        <input type="date" id="last_timesend" readonly name="last_timesend" class="form-control col-3" value="<?php echo $data->r_waktu_blast; ?>">
    </div>
    <div class="form-group">
        <label for="inputState">Campaign terakhir dikirim</label>
        <select class="form-control custom-select" readonly id="last_campaign" name="last_campaign[]" multiple="multiple">
            <?php
            foreach ($nama_produk->result() as $datana) {
                $list_selpro = explode(',', $data->r_campaign_last);
                if (in_array($datana->produk_key, $list_selpro)) {
                    $selected = "selected";
                }
                echo "<option value='$datana->produk_key' $selected>$datana->produk_description</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputState">Informasi Paket Melalui Channel</label>
        <select class="form-control custom-select" readonly id="infoctp" name="infoctp[]" multiple="multiple">
            <?php
            $paket = array(1 => 'Informasi', 2 => 'Complain', 5 => 'Registrasi');
            foreach ($paket as $pk => $val) {
                $selected = "";
                $list_selpro = explode(',', $data->r_infopaket);
                if (in_array($pk, $list_selpro)) {
                    $selected = "selected";
                }
                echo "<option value='$pk' $selected>$val</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputState">Keyword</label>
        <input required type="text" class="form-control" readonly id="keyword" name="keyword" value="<?php echo $data->r_keyword; ?>">
    </div>
    <div class="form-group">
        <label for="inputState">Status Approve</label>
        <select class="form-control" id="status_approve" name="status_approve">
            <?php
            $paket = array(1 => 'Approve', 2 => 'Decline',3=>'Pending Approval');
            foreach ($paket as $pk => $val) {
                $selected = "";
                $list_selpro = explode(',', $data->status_approve);
                if (in_array($pk, $list_selpro)) {
                    $selected = "selected";
                }
                echo "<option value='$pk' $selected>$val</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputState">Feedback</label>
        <textarea class="form-control" name="feedback" id="feedback"><?php echo $data->feedback; ?></textarea>
    </div>

    <input type="hidden" class="form-control" readonly id="id" name="id" value="<?php echo $data->id; ?>">

    <button class="btn btn-info btn-block" type="submit">Submit</button>
</form>
<?php echo card_close() ?>

<?php echo _js('datatables,selectize,multiselect') ?>

<!-- START: Template JS-->
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->

<!-- START: Page JS-->
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/js/app.filemanager.js"></script>
<script src="<?php echo base_url(); ?>assets/new_theme/dist/vendors/quill/quill.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/new_theme/dist/js/mail.script.js"></script> -->
<!-- END: Page JS-->
<script type="text/javascript">
    $(document).ready(function() {
        $("#table_data").DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]
        });
        $('#summernote_email').summernote({
            callbacks: {
                onChange: function() {
                    document.getElementById('previewEmail').innerHTML = $("#summernote_email").summernote('code');
                }
            },
        });
    });
</script>
<script type="text/javascript">
    var quill = new Quill('#snow-container', {
        theme: 'snow'
    });

    var quill1 = new Quill('#snow-container1', {
        theme: 'snow'
    });

    var quill2 = new Quill('#snow-container2', {
        theme: 'snow'
    });

    // On Form Submit nambahin hasil text Editor
    // $("#generator_template_email").on("submit", function() {
    // 	var hvalue = quill.container.firstChild.innerHTML;
    // 	$(this).append("<textarea name='contentemail' style='display:none'>" + hvalue + "</textarea>");
    // 	return true;
    // });
    $('form').submit(function() {

        var paket = $.trim($('#paket').val());
        var area = $.trim($('#area').val());
        var history = $.trim($('#history').val());
        var last_campaign = $.trim($('#last_campaign').val());
        var infoctp = $.trim($('#infoctp').val());
        var landing_page_key = $.trim($('#landing_page_key').val());
        var contentemail = $("#summernote_email").summernote('code');
        $(this).append("<textarea name='contentemail' style='display:none'>" + contentemail + "</textarea>");
        jQuery.fn.preventDoubleSubmission = function() {
            $(this).on('submit', function(e) {
                var $form = $(this);

                if ($form.data('submitted') === true) {
                    // Previously submitted - don't submit again
                    e.preventDefault();
                } else {
                    // Mark it so that the next submit can be ignored
                    $form.data('submitted', true);

                }
            });
            return this;
        };


    });

    // Ketika ada perubahan tab active bikin preview nya jadi default wording
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        // newly activated tab
        // e.target 
        // previous active tab
        // e.relatedTarget 
        console.log(e.target.hash)
        $('#preview_campaign_image').attr("src", '');
        $('#preview_content').html('');
        $('#preview_button_link').attr("href", '');
    })

    // Ketika ada Event pada Quill di form
    quill.on('text-change', function(t) {
        // $("#preview_campaign_image").html('');
        console.log('ada yg berubah')
        $('#preview_content').html(quill.root.innerHTML);
    });
    quill1.on('text-change', function() {
        // $("#preview_campaign_image").html('');
        console.log('ada yg berubah 1')
        $('#preview_content').html(quill1.root.innerHTML);
    });
    quill2.on('text-change', function() {
        // $("#preview_campaign_image").html('');
        console.log('ada yg berubah 2')
        $('#preview_content').html(quill2.root.innerHTML);
    });


    // Ketika ada perubahan pada input button for link
    $("input[name=button_for_link]").change(function() {
        $('#preview_button_link').attr("href", $(this).val());
    });



    // Func untuk Preview Image
    function previewFile(input, idx) {
        var file = $("input[type=file]").get(idx).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $("#preview_campaign_image").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
</script>
<script type="text/javascript">
    $('#paket').selectize({});
    $('#area').selectize({});
    $('#history').selectize({});
    $('#last_campaign').selectize({});
    $('#infoctp').selectize({});
    $('#nama_produk').selectize({});
</script>
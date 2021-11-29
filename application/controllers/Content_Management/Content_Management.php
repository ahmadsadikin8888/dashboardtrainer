<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content_Management extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ContentManagementModel');
	}

	public function index()
	{
		// pake template Syanida nya
		$data = array();
		$data['nama_produk'] = $this->db->query("SELECT * FROM dim_produk");
		$data['landing_page'] = $this->db->query("SELECT * FROM dim_landingpage");
		$data['list_data'] = $this->db->query("SELECT * FROM trx_campaign")->result();
		$data['area'] = $this->db->query("SELECT * FROM dim_regional")->result();
		$this->template->load('Content_management/list_template', $data);
	}

	public function update($id = false)
	{
		$data['data'] = $this->db->query("SELECT * FROM trx_campaign WHERE id='$id'")->row();
		$data['landing_page'] = $this->db->query("SELECT * FROM dim_landingpage");
		$data['area'] = $this->db->query("SELECT * FROM dim_regional")->result();
		$data['nama_produk'] = $this->db->query("SELECT * FROM dim_produk");
		$this->template->load('Content_management/edit_campaign', $data);
	}
	public function save()
	{

		///gambar email
		$ext = pathinfo($_FILES["image_email"]['name'], PATHINFO_EXTENSION);
		$new_name_email = time() . "email." . $ext;
		// File Path
		$file_path_email = 'assets/images/campaign/';
		// Load library Upload
		$configs['upload_path'] = './' . $file_path_email;
		$configs['allowed_types'] = 'jpg|gif|png';
		$configs['file_name'] = $new_name_email;
		$this->load->library('upload', $configs);
		$this->upload->initialize($configs);
		if (!$this->upload->do_upload('image_email')) {
			$error = array('error' => $this->upload->display_errors());
			// $this->load->view('upload_form', $error);
			$new_name_email = "";
		} else {


			$this->send_ftp_syanida($new_name_email);
		}

		if ($_POST['type_content_wa'] == 2) {
			///gambar wa
			$ext = pathinfo($_FILES["image_whatsapp"]['name'], PATHINFO_EXTENSION);
			$new_name_wa = time() . "wa." . $ext;

			// File Path
			$file_path_wa = 'assets/images/campaign/';
			// Load library Upload
			$configs['upload_path'] = './' . $file_path_wa;
			$configs['allowed_types'] = 'jpeg|jpg|gif|png';
			$configs['file_name'] = $new_name_wa;
			$this->load->library('upload', $configs);
			$this->upload->initialize($configs);
			if (!$this->upload->do_upload('image_whatsapp')) {
				$error = array('error' => $this->upload->display_errors());
			} else {

				$this->send_ftp_syanida($new_name_wa);
			}
		}

		if ($_POST['type_content_wa'] == 3) {
			///gambar wa
			$ext = pathinfo($_FILES["video_whatsapp"]['name'], PATHINFO_EXTENSION);
			$new_name_wa = time() . "wa." . $ext;
			// File Path
			$file_path_wa = 'assets/images/campaign/';
			// Load library Upload
			$configs['upload_path'] = './' . $file_path_wa;
			$configs['allowed_types'] = 'mp4';
			$configs['file_name'] = $new_name_wa;
			$this->load->library('upload', $configs);
			$this->upload->initialize($configs);
			if (!$this->upload->do_upload('video_whatsapp')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$this->send_ftp_syanida($new_name_wa);
			}
		}


		$area = implode(", ", $_POST['area']);
		$history = implode(", ", $_POST['history']);
		$last_campaign = implode(", ",  $_POST['last_campaign']);
		$infoctp = implode(", ",  $_POST['infoctp']);
		$paket = implode(", ",  $_POST['paket']);
		$nama_produk = implode("|",  $_POST['nama_produk']);
		$datetime = NOW();
		$data = array(
			'nama_campaign' => $_POST['nama_campaign'],
			'id_produk' =>  $nama_produk,
			'email_content' => $_POST['contentemail'],
			'email_btn_link' => $_POST['button_for_link'],
			'email_image' => $new_name_email,
			'wa_image' => $new_name_wa,
			'wa_video' => $new_name_wa,
			'wa_des' => $_POST['wa_desc'],
			'sms_desc' => $_POST['sms_desc'],
			'r_area' => $area,
			'r_paket' => $paket,
			'r_history' => $history,
			'r_subscribe' => $_POST['subscribe'],
			'r_waktu_blast' =>  $_POST['last_timesend'],
			'r_campaign_last' => $last_campaign,
			'r_infopaket' => $infoctp,
			'r_keyword' => $_POST['keyword'],
			'landing_page_key' => $_POST['landing_page_key'],
			'type_content_wa' => $_POST['type_content_wa'],
			'tgl_insert' => $datetime,
		);
		if (isset($_POST['id'])) {
			$this->db->where(array("id" => $_POST['id']));
			$this->db->update('trx_campaign', $data);
		} else {
			$this->db->insert('trx_campaign', $data);
		}

		redirect('/Content_Management/Content_Management', 'refresh');
	}
	public function send_ftp_syanida($image_name = false)
	{
		$this->load->library('ftp');

		$config['hostname'] = 'ftp.sy-anida.com';
		$config['username'] = 'image_public@sy-anida.com';
		$config['password'] = 'q9Y=B,0G8SBh';
		$config['debug']        = TRUE;
		$dest = "/public_html/image_public/";
		$sourcena = $image_name;
		$source = "./assets/images/campaign/" . $sourcena;
		$this->ftp->connect($config);

		$this->ftp->upload($source, $sourcena, 'auto', 0775);

		$this->ftp->close();
	}

	public function save_email_template()
	{

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_campaign', 'Nama Campaign', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		// Check kalo files dikirim ga, kalo ga dikirim bikin rules agar ada report errornya
		if (empty($_FILES['campaign_image']['name'])) {
			$this->form_validation->set_rules('campaign_image', 'Campaign Image', 'required');
		}

		$this->form_validation->set_rules('button_for_link', 'Link for Button', 'required');

		// Check Validation dari Form
		if ($this->form_validation->run() == FALSE) {
			// Kembalikan ke View Index
			echo validation_errors('<span class="error">', '</span>');
			// Harusnya kasih variabel Error disini
			redirect('/Content_Management/Content_Management/index#error_on_form', 'refresh');
		} else {

			// Upload Gambar Campaign
			// Ambil file name dan simpan di variabel
			$new_name = time() . 'email_' . $this->input->post('nama_campaign') . '_' . $_FILES["campaign_image"]['name'];
			// File Path
			$file_path = 'images/campaign_image/';
			// Load library Upload
			$config['upload_path'] = './' . $file_path;
			$config['allowed_types'] = 'jpg|gif|png';
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('campaign_image')) {
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				// $this->load->view('upload_form', $error);
				redirect('/Content_Management/Content_Management/index#error_on_uploading_image', 'refresh');
				// echo $config['upload_path'];
			}

			$template_content[] = array('content' => $this->input->post('content'));
			$template_content[] = array('campaign_image' => $file_path . $new_name . '.jpg');
			$template_content[] = array('button_for_link' => $this->input->post('button_for_link'));
			// Bungkus sebagai JSON untuk Template Content
			// panggil fungsi untuk save data
			$namacampaign = $this->input->post('nama_campaign');
			$namaproduk = $this->input->post('nama_produk');
			$this->ContentManagementModel->save_template('email', $this->input->post('nama_campaign'), json_encode($template_content), $namaproduk);
			redirect('/Content_Management/Content_management?nama_campaign=' . $namacampaign . '&nama_produk=' . $namaproduk . '&ci_csrf_token=', 'refresh');
		}
	}

	// Save Generator Whatsapp
	public function save_whatsapp_template()
	{
		/*var_dump ($this->input->post('nama_campaign'));
		var_dump ($this->input->post('content'));
		var_dump ($this->input->post('campaign_image'));
		die();*/
		// Pasang Form Validation
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_campaign', 'Nama Campaign', 'required');
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
		$this->form_validation->set_rules('wa_desc', 'wa_desc', 'required');

		// Check Validation dari Form
		if ($this->form_validation->run() == FALSE) {
			// Kembalikan ke View Index
			echo validation_errors('<span class="error">', '</span>');
			// Harusnya kasih variabel Error disini
			// redirect('/Content_Management/Content_Management/index#error_on_form', 'refresh');
		} else {
			// Upload Gambar Campaign
			// Ambil file name dan simpan di variabel
			$new_name = time() . 'whatsapp_' . $this->input->post('nama_campaign') . '_' . $_FILES["campaign_image"]['name'];
			// File Path
			$file_path = 'images/campaign_image/';
			// Load library Upload
			$config['upload_path'] = './' . $file_path;
			$config['allowed_types'] = 'jpg|gif|png';
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('campaign_image')) {
				$error = array('error' => $this->upload->display_errors());
				print_r($error);

				$this->load->view('upload_form', $error);
				// redirect('/Content_Management/Content_Management/index#error_on_uploading_image', 'refresh');
			}

			$template_content[] = array('content' => $this->input->post('wa_desc'));
			$template_content[] = array('campaign_image' => $file_path . $new_name . '.jpg');
			// Bungkus sebagai JSON untuk Template Content
			// panggil fungsi untuk save data
			$namacampaign = $this->input->post('nama_campaign');
			$namaproduk = $this->input->post('nama_produk');
			$this->ContentManagementModel->save_template('whatsapp', $this->input->post('nama_campaign'), json_encode($template_content), $namaproduk);
			redirect('/Content_Management/Content_management?nama_campaign=' . $namacampaign . '&nama_produk=' . $namaproduk . '&ci_csrf_token=', 'refresh');
		}
	}

	// Save Generator SMS
	public function save_sms_template()
	{

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_campaign', 'Nama Campaign', 'required');
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
		$this->form_validation->set_rules('sms_desc', 'sms_desc', 'required');

		// Check Validation dari Form
		if ($this->form_validation->run() == FALSE) {
			// Kembalikan ke View Index
			// Harusnya kasih variabel Error disini
			redirect('/Content_Management/Content_Management/index#error_on_form', 'refresh');
		} else {
			$template_content = $this->input->post('sms_desc');
			$namacampaign = $this->input->post('nama_campaign');
			$namaproduk = $this->input->post('nama_produk');
			$this->ContentManagementModel->save_template('sms', $namacampaign, $template_content, $namaproduk);
			redirect('/Content_Management/Content_management?nama_campaign=' . $namacampaign . '&nama_produk=' . $namaproduk . '&ci_csrf_token=', 'refresh');
		}
	}
}

/* End of file content_Management.php */
/* Location: ./application/controllers/content_Management.php */
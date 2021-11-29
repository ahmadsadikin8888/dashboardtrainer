<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resources extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Product/Product_model', 'product_model');
		$this->load->model('Customer/Customer_model', 'customer_model');
	}

	public function index()
	{
		$data['category_produk'] = $this->product_model->getAllCategoryProduk();
		$data['max'] = $this->customer_model->maxPaket();

		$data['tampil_regional'] = $this->customer_model->getRegional();
		$data['tampil_channel'] = $this->customer_model->getChannel();
		$data['tampil_category'] = $this->customer_model->getCustCategoryProduk();
		$data['tampil_produk'] = $this->customer_model->get_product();
		$data['tampil_layanan'] = $this->customer_model->getLayanan();

		$this->template->load('Campaign_management/resource_page',$data);
	}

	public function showAllProduct() {
		if ($this->input->is_ajax_request()) {
		$product = $this->product_model->getAll();
		$hasil = array('response' => 'success', 'posts' => $product);
		echo json_encode($hasil);
		} else {
			echo "No direct script access allowed";
		}
	}

	public function showSelectCategoryProduk() {
		if ($this->input->is_ajax_request()) {
			$category_produk_key = $this->input->post('category_produk_value');
			if($category_produk_key != null) {
				$Category_Produk_desc = $this->product_model->getIdCategoryProduk($category_produk_key);
				$hasil = array('response' => 'success', 'posts' => $Category_Produk_desc);
				echo json_encode($hasil);
			}
			else {
				$hasil = array('response' => 'success', 'posts' => "");
				echo json_encode($hasil);
			}
		} else {
			echo "No direct script access allowed";
		}
	}

	function simpan_resource_product()
	{
		$product = $this->product_model;
		// $data = json_decode(file_get_contents('php://input'), true);
		// $this->product_id = uniqid();
		$id = $this->input->post("produk_key");
		if ($id == null) {
			
			if($product->save()) {
					echo json_encode(["message" => "Berhasil disimpan", "status" => "OK"]);
				} else {
					echo json_encode(["message" => "Gagal disimpan", "status" => "ERROR"]);
				}
			} else {
				if($product->update()){
					echo json_encode(["message" => "Berhasil diupdate", "status" => "OK"]);
				} else {
					echo json_encode(["message" => "Gagal diupdate", "status" => "ERROR"]);
				}
			}
	}

	public function showAllCustomer() {
		if ($this->input->is_ajax_request()) {
		$customer = $this->customer_model->getAllCustomer();
		$hasil = array('response' => 'success', 'posts' => $customer);
		echo json_encode($hasil);
		} else {
			echo "No direct script access allowed";
		}
	}

	function simpan_resource_customer()
	{
		$customer = $this->customer_model;
		// $data = json_decode(file_get_contents('php://input'), true);
		// $this->customer_id = uniqid();
		$id = $this->input->post("id_customer");
		if ($id == null) {	
			$customer->saveCustomer();
		} else {
			$customer->updateCustomer();
		}
		$this->index();
		redirect("Campaign_management/resources");
	}
}

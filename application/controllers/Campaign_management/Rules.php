<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Product/Product_model', 'product_model');
		$this->load->model('Customer/Customer_model', 'customer_model');
		$this->load->model('Rule/Rule_model', 'rule_model');
	}

	public function index()
	{
		$data['tampil_produk'] = $this->product_model->getAll();
		$data['tampil_customer'] = $this->customer_model->getAllCustomer();

		$this->template->load('Campaign_management/rule_page',$data);
	}

	public function showAllRule() {
		if ($this->input->is_ajax_request()) {
		$rule = $this->rule_model->getAllRule();
		$hasil = array('response' => 'success', 'posts' => $rule);
		echo json_encode($hasil);
		} else {
			echo "No direct script access allowed";
		}
	}

	function simpan_rule()
	{
		$rule = $this->rule_model;
		// $data = json_decode(file_get_contents('php://input'), true);
		// $this->rule_id = uniqid();
		$id = $this->input->post("id_edit");
		if ($id == null) {	
			$rule->save();
		} else {
			$rule->update();
		}
		//$this->index();
		redirect("Campaign_management/rules");
	}

	public function edit_status() {
		$rule = $this->rule_model;

		return json_encode($rule->edit_status());
		//redirect("Campaign_management/rules");
	}

	
}

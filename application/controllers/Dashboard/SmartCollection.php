<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SmartCollection extends CI_Controller {

	private $log_key,$log_temp,$title;
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Dashboard/SmartCollectionModel');
	}


	public function index()
	{
		$curdate = date('Y-m-d', strtotime("2021-03-07"));
		$getDateData = $this->SmartCollectionModel->get_date_data($curdate);
		$data = array(
			'title_page_big'		=> 'Dashboard Monitoring Smart Collection',
			'title'					=> $this->title,
			'total_order_by_channel' => $this->SmartCollectionModel->get_total_order_by_channel_and_status_today($getDateData[0]['date_value']),
			'total_order_by_regional' => $this->SmartCollectionModel->get_total_order_by_regional_and_status_today($getDateData[0]['date_value']),
			'summary_order' => $this->SmartCollectionModel->get_summary_order_today($getDateData[0]['date_value']),
			'summary_unique_customer' => $this->SmartCollectionModel->get_summary_unique_customer_today($getDateData[0]['date_value']),
			'summary_success_by_channel' => $this->SmartCollectionModel->get_summary_success_by_channel_today($getDateData[0]['date_value']),
			'summary_order_by_unique_customer' => $this->SmartCollectionModel->get_summary_order_by_unique_customer_today($getDateData[0]['date_value']),
		);
		$data['controller'] = $this;
		$data['pencairan_h1'] = $this->SmartCollectionModel->get_total_pencairan_filter_by_date( date_format(date_sub(date_create( $getDateData[0]['date_value'] ), date_interval_create_from_date_string('1 days')),"Y-m-d") , date_format(date_sub(date_create( $getDateData[0]['date_value'] ), date_interval_create_from_date_string('1 days')),"Y-m-d"));
		$data['pencairan_seminggu'] = $this->SmartCollectionModel->get_total_pencairan_filter_by_date( date_format(date_sub(date_create( $getDateData[0]['date_value'] ), date_interval_create_from_date_string('7 days')),"Y-m-d") , $getDateData[0]['date_value'] );
		$data['pencairan_sebulan'] = $this->SmartCollectionModel->get_total_pencairan_filter_by_date( date('Y-m-01', strtotime($getDateData[0]['date_value'])), date('Y-m-t', strtotime($getDateData[0]['date_value'])) );

		$this->load->view('Dashboard/SmartCollection', $data);
		
	}

	public function perfomance()
	{
		if (isset($_POST['template']) ) {
			$sel_template = $this->input->post('template');
			$sel_date = $this->input->post('datena');
		}
		else{
			$sel_template = 'daily';
			$sel_date = date('Y-m-d');
		}

		$data = array(
			'title_page_big'		=> 'Dashboard Performance Smart Collection',
			'title'					=> $this->title,
			'sel_date'				=> $sel_date,
			'sel_template'			=> $sel_template,
		);
		$data['controller'] = $this;
		// load query dan tampung ke data
		$getDateData = $this->SmartCollectionModel->get_date_data($sel_date);
		$l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
		switch ($sel_template) {
			case 'monthly':
				$f_date = date('Y-m-01', strtotime($getDateData[0]['date_value']));
				// $l_date = date('Y-m-t', strtotime($getDateData[0]['date_value']));
				break;
			case 'weekly':
				$f_date = date_format(date_sub(date_create($l_date),date_interval_create_from_date_string("7 days")), 'Y-m-d');
				// $l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				break;
			case 'daily':
				$f_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				// $l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				break;
			default:
				$f_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				// $l_date = date('Y-m-d', strtotime($getDateData[0]['date_value']));
				break;
		}

		$data['summary_order_by_date'] = $this->SmartCollectionModel->get_summary_order_by_date($f_date, $l_date);
		$data['summary_unique_customer_by_date'] = $this->SmartCollectionModel->get_summary_unique_customer_by_date($f_date, $l_date);
		$data['summary_payment_by_regional'] = $this->SmartCollectionModel->get_summary_payment_by_regional($f_date, $l_date);
		// Perilakuan Khusus untuk Summary Order by Date Chart
		if ($sel_template == 'daily') {
			$f_date = date_format(date_sub(date_create($l_date),date_interval_create_from_date_string("1 months")), 'Y-m-d');
		}
		$data['summary_order_by_date_chart'] = $this->SmartCollectionModel->get_summary_order_by_date_chart($f_date, $l_date);

		$this->load->view('Dashboard/SmartCollection_Perfomance', $data);
	}

}

/* End of file smartCollection.php */
/* Location: ./application/controllers/smartCollection.php */
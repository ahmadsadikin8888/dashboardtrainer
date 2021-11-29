<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/History_call_model', 'history_call');
		$this->load->model('Custom_model/Trans_model', 'trans');
	}




	////render by ajax
	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Report Call',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}

		$this->template->load('Report/general', $data);
	}
	public function dashboard()
	{
		$data = array(
			'title_page_big'		=> 'Report Call',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}

		$this->load->view('Report/sc_dashboard', $data);
	}
	public function report_call()
	{
		$data = array(
			'title_page_big'		=> 'Report Call',
			'title'					=> $this->title,
		);
		$data['controller'] = $this;
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$data['call_history'] = $this->history_call->live_query("
			SELECT
				a.*,
				b.BA,
				b.CID,
				b.NAMA_MASTER,
				b.NO_KONTAK,
				b.ALAMAT_MASTER,
				b.UPD_AGENT,
				b.TGL_ORDER,
				b.CSAREA,
				b.DETAIL_STATUS,
				b.TIPE_CALL,
				b.CSID 
			FROM
				HISTORY_CALL a,
				trans b 
			WHERE
				a.TRANS_ID = b.TRANS_ID 
				AND a.trans_id != '0' 
			ORDER BY
				a.TRANS_ID ASC 
			")->result();
		}

		$this->template->load('Report/general', $data);
	}
};

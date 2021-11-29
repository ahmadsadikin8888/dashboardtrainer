<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SmartCollectionModel extends CI_Model {

	// #Monitoring
	// Query untuk Pie Chart Summary Order (Today)
	public function get_summary_order_today($f_date)
	{
		$this->db->select('(CASE WHEN dapros.customer_key IS NULL THEN "Progress" WHEN dim_status.status_call = 1 THEN "Success" WHEN dim_status.status_call = 0 THEN "UnSuccess" END) AS label
			, COUNT(*) AS status_count ', false);
		$this->db->from('dapros');
		$this->db->join('dim_date', 'dapros.date_key = dim_date.date_key', 'left');
		$this->db->join('fact_interaction', 'dapros.customer_key = fact_interaction.customer_key AND dapros.date_key = fact_interaction.date_key', 'left');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->where('DATE(dim_date.date_value) = CAST("'.$f_date.'" AS DATE)');
		$this->db->group_by('label');
		$result = $this->db->get();

		return $result->result_array();;
	}

	// Query untuk Bar Chart Summary Success by Channel (today)
	public function get_summary_success_by_channel_today($f_date)
	{
		$this->db->select('dim_channel.channel_value AS label
			, COUNT(fact_interaction.channel_key) AS channel_count', false);
		$this->db->from('fact_interaction');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->join('dim_channel', 'fact_interaction.channel_key = dim_channel.channel_key');
		$this->db->join('dim_date', 'fact_interaction.date_key = dim_date.date_key');
		$this->db->where('DATE(dim_date.date_value) = CAST("'.$f_date.'" AS DATE)');
		$this->db->where('dim_status.status_call = 1'); 
		$this->db->group_by('fact_interaction.channel_key');
		$result = $this->db->get();

		return $result->result_array();
	}

	// Query untuk Pie Chart Summary Unique Customer (Today)
	public function get_summary_unique_customer_today($f_date)
	{
		$this->db->select('IF( DATE_FORMAT(dim_date.date_value,"%m-%Y") = DATE_FORMAT(dim_date2.date_value,"%m-%Y")
			, IF( DAY(dim_date2.date_value) < 20, "Lancar", "Tidak Lancar" )
			, "Menunggak" ) AS label
			, COUNT(*) AS count_status
			, SUM(IF( DATE_FORMAT(dim_date.date_value,"%m-%Y") = DATE_FORMAT(dim_date2.date_value,"%m-%Y")
			, dim_bayar.bayar_value
			, fact_interaction.biling_value )) AS sum_bayar', false);
		$this->db->from('dim_bayar');
		$this->db->join('dim_periode', 'dim_periode.periode_key = dim_bayar.periode_key');
		$this->db->join('dim_date', 'dim_periode.date_key = dim_date.date_key');
		// Dim Date 2 untuk Tanggal Bayar
		$this->db->join('dim_date dim_date2', 'dim_bayar.date_key = dim_date2.date_key', 'left');
		// Join ke Fact Interaction untuk ambil value biling apabila statusnya Menunggak
		$this->db->join('fact_interaction', 'dim_bayar.customer_key = fact_interaction.customer_key AND fact_interaction.periode_key = dim_bayar.periode_key', 'right');
		$this->db->join('dim_date AS dim_date3 ', 'fact_interaction.date_key = dim_date3.date_key');
		$this->db->where('DATE(dim_date3.date_value) = CAST("'.$f_date.'" AS DATE)');
		$this->db->group_by('label');
		$result = $this->db->get();

		return $result->result_array();;

	}

	// Query Order Succcess dengan by Unique Customer Today
	public function get_summary_order_by_unique_customer_today($f_date)
	{
		$this->db->select('IF( DATE_FORMAT(dim_date.date_value,"%m-%Y") = DATE_FORMAT(dim_date2.date_value,"%m-%Y")
			, IF( DAY(dim_date2.date_value) < 20, "Lancar", "Tidak Lancar" )
			, "Menunggak" ) AS label_2
			, COUNT(*) AS count_order', false);
		$this->db->from('dim_bayar');
		$this->db->join('dim_periode', 'dim_periode.periode_key = dim_bayar.periode_key');
		$this->db->join('dim_date', 'dim_periode.date_key = dim_date.date_key');
		// Dim Date 2 untuk Tanggal Bayar
		$this->db->join('dim_date dim_date2', 'dim_bayar.date_key = dim_date2.date_key', 'left');
		// Join ke Fact Interaction untuk ambil value biling apabila statusnya Menunggak
		$this->db->join('fact_interaction', 'dim_bayar.customer_key = fact_interaction.customer_key AND fact_interaction.periode_key = dim_bayar.periode_key', 'right');
		$this->db->join('dim_date AS dim_date3 ', 'fact_interaction.date_key = dim_date3.date_key');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->where('DATE(dim_date3.date_value) = CAST("'.$f_date.'" AS DATE)');
		$this->db->where('dim_status.status_call = 1');
		$this->db->group_by('label_2');
		$result = $this->db->get();

		return $result->result_array();
	}

	// Query Order by Channel dengan Status Today
	public function get_total_order_by_channel_and_status_today($f_date)
	{
		// sudah di definie success dan unsuccess berdasarkan dim_status_call sdan progress bagi yg customer_key nya masih null di dapros
		$this->db->select('dim_channel.channel_value AS label_channel
			, SUM(CASE WHEN dapros.customer_key IS NULL THEN 1 ELSE 0 END) AS counting_progress
			, SUM(CASE WHEN dim_status.status_call = 1 THEN 1 ELSE 0 END) AS counting_success
			, SUM(CASE WHEN dim_status.status_call = 0 THEN 1 ELSE 0 END) AS counting_unsuccess
			, COUNT(fact_interaction.fi_key) AS total_order', false); 
		$this->db->from('dapros');
		$this->db->join('dim_date', 'dapros.date_key = dim_date.date_key');
		$this->db->join('fact_interaction', 'dapros.customer_key = fact_interaction.customer_key AND dapros.date_key = fact_interaction.date_key', 'left');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->join('dim_channel', 'fact_interaction.channel_key = dim_channel.channel_key');
		$this->db->where('DATE(dim_date.date_value) = CAST("'.$f_date.'" AS DATE)');
		$this->db->group_by('fact_interaction.channel_key');
		$this->db->order_by('fact_interaction.channel_key');
		$result = $this->db->get();

		return $result->result_array();
	}

	// Query Order by Regioanl dengan Status Today
	public function get_total_order_by_regional_and_status_today($f_date)
	{
		$this->db->select('dim_regional.regional_value AS label_regional
			, SUM(CASE WHEN dapros.customer_key IS NULL THEN 1 ELSE 0 END) AS counting_progress
			, SUM(CASE WHEN dim_status.status_call = 1 THEN 1 ELSE 0 END) AS counting_success
			, SUM(CASE WHEN dim_status.status_call = 0 THEN 1 ELSE 0 END) AS counting_unsuccess
			, COUNT(fact_interaction.fi_key) AS total_order', false); 
		$this->db->from('dapros');
		$this->db->join('dim_date', 'dapros.date_key = dim_date.date_key');
		$this->db->join('fact_interaction', 'dapros.customer_key = fact_interaction.customer_key AND dapros.date_key = fact_interaction.date_key', 'left');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->join('dim_regional', 'fact_interaction.regional_key = dim_regional.regional_key');
		$this->db->where('DATE(dim_date.date_value) = CAST("'.$f_date.'" AS DATE)');
		$this->db->group_by('fact_interaction.regional_key');
		$this->db->order_by('fact_interaction.regional_key');		
		$result = $this->db->get();

		return $result->result_array();
	}

	// Query untuk nyari Total Pencairan berdasarkan tanggal yang diberikan
	public function get_total_pencairan_filter_by_date($f_date, $l_date)
	{
		$this->db->select('COUNT(dim_bayar.bayar_key) AS unique_customer 
			, SUM(dim_bayar.bayar_value) AS total_tagihan');
		$this->db->from('dim_bayar');
		$this->db->join('dim_date', 'dim_bayar.date_key = dim_date.date_key');
		$this->db->where('DATE(dim_date.date_value) BETWEEN CAST("'.$f_date.'" AS DATE) AND CAST("'.$l_date.'" AS DATE)');
		$result = $this->db->get();

		return $result->result_array();
	}

	// #Perfomance
	// Get Summary Order by Status berdasarkan Daterange
	public function get_summary_order_by_date($f_date, $l_date)
	{
		$this->db->select('(CASE WHEN dapros.customer_key IS NULL THEN "Progress" WHEN dim_status.status_call = 1 THEN "Success" WHEN dim_status.status_call = 0 THEN "UnSuccess" END) AS label
			, COUNT(*) AS status_count ', false);
		$this->db->from('dapros');
		$this->db->join('dim_date', 'dapros.date_key = dim_date.date_key');
		$this->db->join('fact_interaction', 'dapros.customer_key = fact_interaction.customer_key AND dapros.date_key = fact_interaction.date_key', 'left');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->where('DATE(dim_date.date_value) BETWEEN CAST("'.$f_date.'" AS DATE) AND CAST("'.$l_date.'" AS DATE)');
		$this->db->group_by('label');
		// $this->db->order_by('fact_interaction.status_key');
		$result = $this->db->get();

		return $result->result_array();
	}

	// Get Unique Customer berdasarkan Daterange
	// Untuk Unique Customer nya perlu di tambahin quqery lagi (?) 
	public function get_summary_unique_customer_by_date($f_date, $l_date)
	{
		$this->db->select('COUNT(fact_interaction.fi_key) AS count_customer
			, SUM(CASE WHEN dim_bayar.date_key IS NOT NULL THEN 1 ELSE 0 END) AS count_pay
			, SUM(CASE WHEN dim_bayar.date_key IS NOT NULL THEN 0 ELSE 1 END) AS count_nopay
			, SUM(CASE WHEN dim_bayar.date_key IS NOT NULL THEN dim_bayar.bayar_value ELSE 0 END) AS sum_payment', false);
		$this->db->from('dim_bayar');
		$this->db->join('dim_periode', 'dim_periode.periode_key = dim_bayar.periode_key');
		$this->db->join('dim_date', 'dim_periode.date_key = dim_date.date_key');
		$this->db->join('dim_date AS dim_date2 ', 'dim_bayar.date_key = dim_date2.date_key', 'left');
		$this->db->join('fact_interaction', 'dim_bayar.customer_key = fact_interaction.customer_key AND fact_interaction.periode_key = dim_bayar.periode_key', 'right');
		$this->db->join('dim_date AS dim_date3 ', 'fact_interaction.date_key = dim_date3.date_key');
		$this->db->where('DATE(dim_date3.date_value) BETWEEN CAST("'.$f_date.'" AS DATE) AND CAST("'.$l_date.'" AS DATE)');
		$result = $this->db->get();

		return $result->result_array();
	}

	// Get Summary Order untuk Barchart + LineAxis, dg hasil order(all fact interaction), success dan yang lakukan payment
	public function get_summary_order_by_date_chart($f_date, $l_date)
	{
		// Anggap status success == 1
		$this->db->select('dim_date.date_value AS label_date
			, COUNT(fact_interaction.fi_key) AS count_order
			, SUM(CASE WHEN dim_status.status_call = 1 THEN 1 ELSE 0 END) AS count_success
			, COUNT(dim_bayar.date_key) AS count_pay', false);
		$this->db->from('fact_interaction');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->join('dim_bayar', 'dim_bayar.customer_key = fact_interaction.customer_key AND fact_interaction.periode_key = dim_bayar.periode_key', 'left');
		$this->db->join('dim_date', 'fact_interaction.date_key = dim_date.date_key', 'right');
		$this->db->where('DATE(dim_date.date_value) BETWEEN CAST("'.$f_date.'" AS DATE) AND CAST("'.$l_date.'" AS DATE)');
		$this->db->group_by('dim_date.date_key');
		$this->db->order_by('dim_date.date_key');
		$result = $this->db->get();

		return $result->result_array();
	}

	// Get Summary Payemnt by Regional
	public function get_summary_payment_by_regional($f_date, $l_date)
	{
		// Anggap success key = 1
		// untuk hitung count customer masih agak bermasalah sih karena harus hitung parameter yg mana
		$this->db->select('CONCAT("Regional ", dim_regional.regional_value) AS label_regional
			, COUNT(fact_interaction.fi_key) AS count_order
			, SUM(CASE WHEN dim_status.status_call = 1 THEN 1 ELSE 0 END) AS count_success
			, COUNT(fact_interaction.customer_key) AS count_customer 
			, IFNULL(SUM(CASE WHEN dim_bayar.date_key IS NOT NULL THEN dim_bayar.bayar_value ELSE 0 END), 0) AS sum_payment', false);
		$this->db->from('fact_interaction');
		$this->db->join('dim_date ', 'fact_interaction.date_key = dim_date.date_key');
		$this->db->join('dim_status', 'fact_interaction.status_key = dim_status.status_key');
		$this->db->join('dim_regional', 'fact_interaction.regional_key = dim_regional.regional_key', 'right');
		$this->db->join('dim_bayar', 'fact_interaction.customer_key = dim_bayar.customer_key AND fact_interaction.periode_key = dim_bayar.periode_key', 'left');
		$this->db->where('DATE(dim_date.date_value) BETWEEN CAST("'.$f_date.'" AS DATE) AND CAST("'.$l_date.'" AS DATE)');
		$this->db->group_by('dim_regional.regional_key');
		$this->db->order_by('dim_regional.regional_key');
		$result = $this->db->get();

		return $result->result_array();
	}

	// Utilities Model
	// Query untuk nyari data tanggal
	public function get_date_data($f_date)
	{
		// $this->db->select('date_value');
		$this->db->from('dim_date');
		$this->db->where('DATE(date_value) = CAST("'.$f_date.'" AS DATE)');
		$result = $this->db->get();

		return $result->result_array();
	}
}

/* End of file smartCollectionModel.php */
/* Location: ./application/models/smartCollectionModel.php */
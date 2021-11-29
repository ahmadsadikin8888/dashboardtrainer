<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_digital_sales extends CI_Controller
{
	public function index()
	{
		$get_start = $_GET["start"];
		$get_end = $_GET["end"];
		$campaign = $_GET["campaign_id"];
		$data = array();
		$filter_campaign = "";
		if (isset($_GET["campaign_id"]) && $_GET['campaign_id'] != 'all') {
			$filter_campaign = " AND fact_interaction.campaign_id = '$campaign' ";
		}
		if(!isset($_GET["start"])) {
			$get_start = DATE('Y-m-d');
			$get_end = DATE('Y-m-d');
		}
		$data['raw'] = $this->db->query("
			select 
			trx_campaign.nama_campaign,
			dim_customer.nama,dim_customer.snd,dim_customer.no_gsm,dim_customer.email,dim_channel.channel_value,dim_status.status_value,f1.channel_value as channel_value_2,sf1.status_value as status_value_2,f2.channel_value as channel_value_3,sf2.status_value status_value_3
			FROM fact_interaction 
			JOIN dim_date ON dim_date.date_key = fact_interaction.date_key
			JOIN trx_campaign ON trx_campaign.id = fact_interaction.campaign_id
			JOIN dim_customer ON dim_customer.customer_key = fact_interaction.customer_key
			JOIN dim_channel ON dim_channel.channel_key = fact_interaction.channel_key
			JOIN dim_status ON dim_status.status_key = fact_interaction.status_key
			LEFT JOIN dim_channel f1 ON f1.channel_key = fact_interaction.channel_key_2
			LEFT JOIN dim_status sf1 ON sf1.status_key = fact_interaction.status_key_2
			LEFT JOIN dim_channel f2 ON f2.channel_key = fact_interaction.channel_key_3
			LEFT JOIN dim_status sf2 ON sf2.status_key = fact_interaction.status_key_3
			WHERE 
			fact_interaction.layanan_key=4 
			AND DATE(dim_date.date_value) >= '$get_start' AND DATE(dim_date.date_value) <= '$get_end'
			$filter_campaign
		")->result();
		$data['campaign_list']=$this->db->query("select * FROM trx_campaign")->result();
		$data["controller"] = $this;
		$this->template->load('Report/Report_ds_list', $data);
	}
	public function index_2()
	{
		$get_start = $_GET["start"];
		$get_end = $_GET["end"];
		$data = array();
		$sumaryqr = $this->db->query("
		SELECT
	channel_key,
	status_key,
	count(*) as jml,
	dim_date.date_key AS kdate,
	dim_date.date_value AS vdate	
FROM
	fact_interaction
	INNER JOIN dim_date ON fact_interaction.date_key = dim_date.date_key 
WHERE
	layanan_key = '4' 
	AND DATE(dim_date.date_value) >= '$get_start' AND DATE(dim_date.date_value) <='$get_end'
GROUP BY
	channel_key,
	status_key
		");
		$regional = $this->db->query("
		SELECT
	regional_key,
	status_key,
	count(*) as jml,
	dim_date.date_key AS kdate,
	dim_date.date_value AS vdate	
FROM
	fact_interaction
	INNER JOIN dim_date ON fact_interaction.date_key = dim_date.date_key 
WHERE
	layanan_key = '4' 
	AND DATE(dim_date.date_value) >= '$get_start' AND DATE(dim_date.date_value) <= '$get_end'
GROUP BY
	regional_key,
	status_key
		");
		$data['list_customer'] = $this->db->query("
		SELECT
	dim_customer.*,
	channel_key,
	status_key,
	dim_date.date_key AS kdate,
	dim_date.date_value AS vdate 
FROM
	fact_interaction
	INNER JOIN dim_date ON fact_interaction.date_key = dim_date.date_key 
	inner join dim_customer ON fact_interaction.customer_key = dim_customer.customer_key
WHERE
	layanan_key = '4' 
	AND DATE(dim_date.date_value) >= '$get_start' 
	AND '$get_end'
		")->result();
		$data["summary"] = $this->summary($sumaryqr->result());
		$data["regional"] = $this->regional($regional->result());
		$data["controller"] = $this;
		$this->template->load('Report/Report_ds_list', $data);
	}
	public function get_channel($channelkey)
	{
		$dataquery = $this->db->query("SELECT * FROM dim_channel WHERE channel_key='$channelkey'")->row()->channel_value;
		return $dataquery;
	}
	public function get_time($timekey)
	{
		$dataquery = $this->db->query("SELECT * FROM dim_time WHERE time_key='$timekey'")->row()->time_value;
		return $dataquery;
	}
	public function get_status($status_key)
	{
		$dataquery = $this->db->query("SELECT * FROM dim_status WHERE status_key='$status_key'")->row()->status_value;
		return $dataquery;
	}
	function summary($sum)
	{
		foreach ($sum as $datasum) {
			$data['summary'][$datasum->channel_key][$datasum->status_key] = $datasum->jml;
		}
		return $data;
	}
	function regional($reg)
	{
		foreach ($reg as $datasum) {
			$data['regional'][$datasum->status_key][$datasum->regional_key] = $datasum->jml;
		}
		return $data;
	}
}

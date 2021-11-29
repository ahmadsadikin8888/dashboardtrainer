<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_campaign extends CI_Controller
{
	public function index()
	{
		$get_start = $_GET["start"];
		$get_end = $_GET["end"];
		$data = array();
		$summaryqr = $this->db->query("
		SELECT
	trx_campaign.nama_campaign,
	dapros.channel_key,	
	dapros.campaign_id,
	dapros.status_send,
	count(*) as jml
FROM
	dapros
	INNER JOIN trx_campaign ON trx_campaign.id = dapros.campaign_id
	INNER JOIN dim_date ON dapros.date_key = dim_date.date_key 
WHERE
	dim_date.date_value BETWEEN '$get_start'
	AND '$get_end'
GROUP BY
campaign_id, channel_key, status_send
		");
		$data["summary"] = $this->summary($summaryqr->result());
		$data["controller"] = $this;
		$this->template->load('Report/Report_campaign_list', $data);
	}
	public function get_channel($channelkey)
	{
		$dataquery = $this->db->query("SELECT * FROM dim_channel WHERE channel_key='$channelkey'")->row()->channel_value;
		return $dataquery;
	}
	public function get_dapros($kum, $start, $end)
	{
		$dataquery = $this->db->query("
		SELECT
	count(*) AS jml 
FROM
	dapros
	INNER JOIN dim_date ON dapros.date_key = dim_date.date_key 
WHERE
	campaign_id = '$kum'
	AND dim_date.date_value BETWEEN '$start' AND '$end'
		")->row()->jml;
		return $dataquery;
	}
	public function get_processed($kum, $start, $end)
	{
		$dataquery = $this->db->query("
		SELECT
	count(*) AS jml 
FROM
	dapros
	INNER JOIN dim_date ON dapros.date_key = dim_date.date_key 
WHERE
	campaign_id = '$kum' 
	AND status_send > 0
	AND dim_date.date_value BETWEEN '$start' AND '$end'
		")->row()->jml;
		return $dataquery;
	}
	public function get_namacampaign($idcm)
	{
		$dataquery = $this->db->query("SELECT * FROM trx_campaign WHERE id='$idcm'")->row()->nama_campaign;
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
			$data['summary'][$datasum->campaign_id][$datasum->channel_key] = $datasum->jml;
			$data['status'][$datasum->campaign_id][$datasum->status_key] = $data['status'][$datasum->campaign_id][$datasum->status_send] + 1;
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

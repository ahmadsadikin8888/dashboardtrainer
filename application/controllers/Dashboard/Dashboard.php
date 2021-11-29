<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
{

	// public function index()

	// {
	// 	$this->template->load('Dashboard/blast_management');
	// }
	public function blast_management()
	{
		$this->load->view('Dashboard/blasting_management');
	}

	public function index()

	{
		$this->load->model('Custom_model/Fact_interaction_model', 'Fact_interaction');
		$this->load->model('Custom_model/Dapros_model', 'Dapros');

		$data = array();

		$data['wo'] = $this->Dapros->get_count();


		////status read
		$data['status_read']['wa'] = $this->Dapros->live_query("
		SELECT
		sum(case when f.status_read = '1' then 1 else 0 end) as read_status,
		sum(case when f.status_click = '1' then 1 else 0 end) as click,
		sum(case when f.status_activated = '1' then 1 else 0 end) as activated,
		sum(case when f.status_ps = '1' then 1 else 0 end) as ps
	FROM
		fact_interaction f
		JOIN dim_status ds1 ON ds1.status_key = f.status_key
		JOIN dim_status ds2 ON ds2.status_key = f.status_key_2
		JOIN dim_status ds3 ON ds3.status_key = f.status_key_3 
	WHERE
		(
			(f.channel_key = '1' AND ds1.flaging = 1 ) 
			OR ( f.channel_key_2 = '1' AND ds2.flaging = 1 ) 
			OR (f.channel_key_3 = '1' AND ds3.flaging = 1)
		) 
		
		")->row();
		$data['status_read']['sms'] = $this->Dapros->live_query("
		SELECT
		sum(case when f.status_read = '1' then 1 else 0 end) as read_status,
		sum(case when f.status_click = '1' then 1 else 0 end) as click,
		sum(case when f.status_activated = '1' then 1 else 0 end) as activated,
		sum(case when f.status_ps = '1' then 1 else 0 end) as ps
	FROM
		fact_interaction f
		JOIN dim_status ds1 ON ds1.status_key = f.status_key
		JOIN dim_status ds2 ON ds2.status_key = f.status_key_2
		JOIN dim_status ds3 ON ds3.status_key = f.status_key_3 
	WHERE
		(
			(f.channel_key = '2' AND ds1.flaging = 1 ) 
			OR ( f.channel_key_2 = '2' AND ds2.flaging = 1 ) 
			OR (f.channel_key_3 = '2' AND ds3.flaging = 1)
		) 
		")->row();
		$data['status_read']['email'] = $this->Dapros->live_query("
		SELECT
		sum(case when f.status_read = '1' then 1 else 0 end) as read_status,
		sum(case when f.status_click = '1' then 1 else 0 end) as click,
		sum(case when f.status_activated = '1' then 1 else 0 end) as activated,
		sum(case when f.status_ps = '1' then 1 else 0 end) as ps
	FROM
		fact_interaction f
		JOIN dim_status ds1 ON ds1.status_key = f.status_key
		JOIN dim_status ds2 ON ds2.status_key = f.status_key_2
		JOIN dim_status ds3 ON ds3.status_key = f.status_key_3 
	WHERE
		(
			(f.channel_key = '3' AND ds1.flaging = 1 ) 
			OR ( f.channel_key_2 = '3' AND ds2.flaging = 1 ) 
			OR (f.channel_key_3 = '3' AND ds3.flaging = 1)
		) 
		")->row();

		////status click


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
GROUP BY
	channel_key,
	status_key
		");
		$data['tot_prospect'] = $this->db->query('SELECT count(*) as jml FROM dapros WHERE status_send=0')->row()->jml;
		$data['jml_prdct_prospect'] = $this->db->query('SELECT campaign_id,count(*) as jml FROM dapros WHERE status_send > 0 GROUP BY campaign_id ORDER BY count(*) DESC limit 3')->result();
		$data['jml_blast'] = $this->db->query('SELECT count(*) as jml FROM dapros WHERE status_send > 0 ')->row()->jml;
		$data['channel_blasting'] = $this->summary($sumaryqr->result());
		// $data['linechart'] = $this->get_linechart();


		////failover
		$opsi_channel_1 = $this->Fact_interaction->live_query(
			"SELECT fact_interaction.channel_key as channelna,ds.flaging as flagingna,count(fi_key) as numna FROM fact_interaction 
            JOIN dim_status ds ON ds.status_key = fact_interaction.status_key
              GROUP BY fact_interaction.channel_key,ds.flaging"
		)->result();
		$data['opsi_channel']["channel_1"]['failed']['numna'] = 0;
		$data['opsi_channel']["channel_1"]['success']['numna'] = 0;
		$data['opsi_channel_2']["channel_2"]['failed']['numna'] = 0;
		$data['opsi_channel_2']["channel_2"]['success']['numna'] = 0;
		$data['opsi_channel_3']["channel_3"]['failed']['numna'] = 0;
		$data['opsi_channel_3']["channel_3"]['success']['numna'] = 0;
		if (count($opsi_channel_1) > 0) {
			foreach ($opsi_channel_1 as $oc1) {
				// if ($oc1->flagingna < 2) {
				$data['opsi_channel']["channel_" . $oc1->channelna . $oc1->flagingna] = $oc1->numna + $data['opsi_channel']["channel_" . $oc1->channelna . $oc1->flagingna];
				// } else {
				// $data['opsi_channel']["channel_" . $oc1->channelna]['failed'] = $oc1->numna;
				// }
				$data['summary_channel']['channel' . $oc1->channelna . $oc1->flagingna] = $oc1->numna + $data['summary_channel']['channel' . $oc1->channelna . $oc1->flagingna];


				$opsi_channel_2_1 = $this->Fact_interaction->live_query(
					"SELECT fact_interaction.channel_key_2,ds2.flaging as flagingna,count(*) as numna FROM fact_interaction 
                    JOIN dim_status ds ON ds.status_key = fact_interaction.status_key
                    JOIN dim_status ds2 ON ds2.status_key = fact_interaction.status_key_2
                     WHERE  fact_interaction.channel_key = '$oc1->channelna' GROUP BY fact_interaction.channel_key_2,ds2.flaging"
				)->result();
				if (count($opsi_channel_2_1) > 0) {
					foreach ($opsi_channel_2_1 as $oc21) {
						$data['opsi_channel_2']["channel_" . $oc1->channelna . $oc21->channel_key_2 . $oc21->flagingna] = $oc21->numna;
						$data['summary_channel']['channel' . $oc21->channel_key_2 . $oc21->flagingna] = $oc21->numna + $data['summary_channel']['channel' .  $oc21->channel_key_2 . $oc21->flagingna];
					}
				}

				$opsi_channel_3_1 = $this->Fact_interaction->live_query(
					"SELECT fact_interaction.channel_key_3,ds3.flaging as flagingna,count(*) as numna FROM fact_interaction 
                    JOIN dim_status ds ON ds.status_key = fact_interaction.status_key
                    JOIN dim_status ds2 ON ds2.status_key = fact_interaction.status_key_2
                    JOIN dim_status ds3 ON ds3.status_key = fact_interaction.status_key_3
                    -- JOIN dim_channel ch ON ch.channel_key = fact_interaction.channel_key_3
                     WHERE  fact_interaction.channel_key = '$oc1->channelna'  GROUP BY fact_interaction.channel_key_2,ds3.flaging"
				)->result();
				if (count($opsi_channel_3_1) > 0) {
					foreach ($opsi_channel_3_1 as $oc31) {
						// echo  $oc1->channelna . "-" . $oc31->channel_key_3 . "-" . $oc31->flagingna . "<br>";
						// $data['opsi_channel_3']["channel_" . $oc1->channelna]['success']['channel'] = $oc31->channel_value;
						$data['opsi_channel_3']["channel_" .  $oc1->channelna . $oc31->channel_key_3 . $oc31->flagingna] =  $oc31->numna;
						$data['summary_channel']["channel" .  $oc31->channel_key_3 . $oc31->flagingna] = $oc31->numna + $data['summary_channel']["channel" .  $oc31->channel_key_3 . $oc31->flagingna];
					}
				}
			}
		}
		$data['controller'] = $this;
		$this->load->view('Dashboard/dashboard_page', $data);
	}
	public function get_namacampaign($idcm)
	{
		$dataquery = $this->db->query("SELECT * FROM trx_campaign WHERE id='$idcm'")->row()->nama_campaign;
		return $dataquery;
	}
	function summary($sum)
	{
		foreach ($sum as $datasum) {
			$data['summary'][$datasum->channel_key][$datasum->status_key] = $datasum->jml;
		}
		return $data;
	}
	public function get_linechart()
	{
		$m = date("m");
		$de = date("d");
		$y = date("Y");
		for ($i = 14; $i > 0; $i -= 1) {
			$tanggal = date('Y-m-d', mktime(0, 0, 0, $m, ($de - ($i - 1)), $y));
			$blast = $this->db->query("SELECT COUNT(*) AS jml FROM	fact_interaction INNER JOIN dim_date ON dim_date.date_key = fact_interaction.date_key WHERE	layanan_key = 4 AND DATE( dim_date.date_value )= '$tanggal'	AND (status_key = 1 OR status_key = 4 OR status_key = 45)	")->row()->jml;
			$deliver = $this->db->query("SELECT COUNT(*) AS jml FROM	fact_interaction INNER JOIN dim_date ON dim_date.date_key = fact_interaction.date_key WHERE	layanan_key = 4 AND DATE( dim_date.date_value )= '$tanggal'	AND(status_key = 1 OR status_key = 4 OR status_key = 45)	")->row()->jml;
			$klicked = $this->db->query("SELECT COUNT(*) AS jml FROM	fact_interaction INNER JOIN dim_date ON dim_date.date_key = fact_interaction.date_key WHERE	layanan_key = 4 AND DATE( dim_date.date_value )= '$tanggal'	AND status_key = 47	")->row()->jml;
			$read = $this->db->query("SELECT COUNT(*) AS jml FROM	fact_interaction INNER JOIN dim_date ON dim_date.date_key = fact_interaction.date_key WHERE	layanan_key = 4 AND DATE( dim_date.date_value )= '$tanggal'	AND status_key = 48	")->row()->jml;
			$activated = $this->db->query("SELECT COUNT(*) AS jml FROM	fact_interaction INNER JOIN dim_date ON dim_date.date_key = fact_interaction.date_key WHERE	layanan_key = 4 AND DATE( dim_date.date_value )= '$tanggal'	AND status_key = 49	")->row()->jml;
			$ps = $this->db->query("SELECT COUNT(*) AS jml FROM	fact_interaction INNER JOIN dim_date ON dim_date.date_key = fact_interaction.date_key WHERE	layanan_key = 4 AND DATE( dim_date.date_value )= '$tanggal'	AND status_key = 49	")->row()->jml;
			$data['blast'][$tanggal] = $blast;
			$data['deliver'][$tanggal] = $deliver;
			$data['klicked'][$tanggal] = $klicked;
			$data['read'][$tanggal] = $read;
			$data['activated'][$tanggal] = $activated;
			$data['ps'][$tanggal] = $ps;
			$data['tanggal'][$tanggal] = $ps;
		}

		return $data;
	}
}

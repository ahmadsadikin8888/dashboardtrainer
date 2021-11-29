<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blast_management extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Custom_model/Dapros_model', 'dapros');
		$this->load->model('Custom_model/Trx_campaign_model', 'campaign');
	}

	public function index()
	{
		$data = array();
		$data['dapros'] = $this->dapros->live_query("
		SELECT
			b.channel_value as channelna,count(*) as numna 
		FROM
			dapros
		LEFT JOIN dim_channel b ON b.channel_key = dapros.channel_key 
		where status_send = 0 AND dapros.date_key IS NULL
		GROUP BY b.channel_value
		")->result();
		$data['channel'] = $this->dapros->live_query("
		SELECT
			channel_value 
		FROM
		dim_channel
		")->result();
		if (count($data['dapros']) > 0) {
			$data['channel_dapros']['total'] = 0;
			foreach ($data['dapros'] as $d) {
				$data['channel_dapros'][$d->channelna] = $d->numna;
				$data['channel_dapros']['total'] = $d->numna + $data['channel_dapros']['total'];
			}
		}
		$data['campaign'] = $this->campaign->get_results(array("status_approve"=>1));
		if (isset($_GET['campaign'])) {
			$campaign_detail = $this->campaign->get_row(array("id" => $_GET['campaign']));
			$param_regional = "";
			if ($campaign_detail->r_area != "") {
				$param_regional = " AND dim_customer.regional_key IN (" . $campaign_detail->r_area . ") ";
			}
			$param_1 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.snd FROM dapros
				JOIN dim_customer ON dim_customer.customer_key = dapros.customer_key
				WHERE dapros.status_send = 0 $param_regional  AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
			")->result();

			$param_paket = "";
			if ($campaign_detail->r_paket != "") {

				$new_paket = implode("','", $campaign_detail->r_paket);
				$param_paket = " AND dim_customer.paket_key IN ('" . $new_paket . "') ";
				// $param_paket = " AND dim_customer.paket_key IN (" . $campaign_detail->r_paket . ") ";
				$param_2 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.snd FROM dapros
				JOIN dim_customer ON dim_customer.customer_key = dapros.customer_key
				WHERE dapros.status_send = 0 $param_paket  AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
			")->result();
			}

			$select_subscribe = "";
			$param_3 = "";
			if ($campaign_detail->r_subscribe == 1) {
				$select_subscribe = " ,(SELECT COUNT(*) FROM fact_interaction
				WHERE customer_key = dapros.customer_key
				AND layanan_key = 5 AND status_key = 30
				) AS mosscount ";
				$param_3 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.snd $select_subscribe FROM dapros
				WHERE dapros.status_send = 0 AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
				HAVING mosscount > 0
				")->result();
			}

			$select_infopaket = "";
			if ($campaign_detail->r_infopaket != "") {
				$select_infopaket = " AND fact_interaction.cat_key IN (" . $campaign_detail->r_infopaket . ") ";
				$param_4 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.snd FROM dapros
				JOIN dim_customer ON dim_customer.customer_key = dapros.customer_key
				JOIN fact_interaction ON fact_interaction.customer_key = dapros.customer_key
				WHERE dapros.status_send = 0 $select_infopaket AND (layanan_key = 2 OR layanan_key = 3)
				AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
			")->result();
			}

			$select_keyword = "";
			if ($campaign_detail->r_keyword != "") {
				$list_keyword = explode(",",  $campaign_detail->r_keyword);
				if (count($list_keyword) > 0) {
					$select_keyword = "AND (";
					$n = 0;
					foreach ($list_keyword as $val) {
						if ($n == 0) {
							$select_keyword .= " interaction_value LIKE '%$val%' ";
						} else {
							$select_keyword .= " OR interaction_value LIKE '%$val%' ";
						}
						$n++;
					}
					$select_keyword .= ")";
				}
				$param_5 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.snd FROM dapros
				JOIN fact_interaction ON dapros.customer_key = fact_interaction.customer_key 
				WHERE dapros.status_send = 0 $select_keyword AND dapros.date_key IS NULL
			")->result();
				// $select_keyword=" AND interaction_value LIKE IN (".$campaign_detail->r_keyword.") ";
			}

			if (count($param_1) > 0) {
				foreach ($param_1 as $r1) {
					$data['customer'][$r1->customer_key]['snd'] = $r1->snd;
					$data['customer'][$r1->customer_key]['param_1'] = 10;
					$data['customer'][$r1->customer_key]['total'] = $data['customer'][$r1->customer_key]['total'] + 10;
				}
			}
			if (count($param_2) > 0) {
				foreach ($param_2 as $r2) {
					$data['customer'][$r2->customer_key]['snd'] = $r2->snd;
					$data['customer'][$r2->customer_key]['param_2'] = 15;
					$data['customer'][$r2->customer_key]['total'] = $data['customer'][$r2->customer_key]['total'] + 15;
				}
			}
			if (count($param_3) > 0) {
				foreach ($param_3 as $r3) {
					$data['customer'][$r3->customer_key]['snd'] = $r3->snd;
					$data['customer'][$r3->customer_key]['param_3'] = 25;
					$data['customer'][$r3->customer_key]['total'] = $data['customer'][$r3->customer_key]['total'] + 25;
				}
			}
			if (count($param_4) > 0) {
				foreach ($param_4 as $r4) {
					$data['customer'][$r4->customer_key]['snd'] = $r4->snd;
					$data['customer'][$r4->customer_key]['param_4'] = 20;
					$data['customer'][$r4->customer_key]['total'] = $data['customer'][$r4->customer_key]['total'] + 20;
				}
			}
			if (count($param_5) > 0) {
				foreach ($param_5 as $r5) {
					$data['customer'][$r5->customer_key]['snd'] = $r5->snd;
					$data['customer'][$r5->customer_key]['param_5'] = 20;
					$data['customer'][$r5->customer_key]['total'] = $data['customer'][$r5->customer_key]['total'] + 20;
				}
			}
		}
		$this->template->load('Blast_management/Blast_management', $data);
	}
	public function proses_blast()
	{
		if (isset($_POST['campaign'])) {
			$campaign = $_POST['campaign'];
			$date_blast = $_POST['date_blast'];
			$date_key = $this->campaign->live_query("SELECT date_key FROM dim_date WHERE date_value='$date_blast' ")->row()->date_key;

			if ($_POST['data_lead'] == 1 || $_POST['data_lead'] == 3) {
				$campaign_detail = $this->campaign->get_row(array("id" => $_POST['campaign']));
				$param_regional = "";
				if ($campaign_detail->r_area != "") {
					$param_regional = " AND dim_customer.regional_key IN (" . $campaign_detail->r_area . ") ";
				}
				$param_1 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.id FROM dapros
				JOIN dim_customer ON dim_customer.customer_key = dapros.customer_key
				WHERE dapros.status_send = 0 $param_regional  AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
			")->result();

				$param_paket = "";
				if ($campaign_detail->r_paket != "") {
					$new_paket = implode("','", $campaign_detail->r_paket);
					$param_paket = " AND dim_customer.paket_key IN ('" . $new_paket . "') ";
					$param_2 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.id FROM dapros
				JOIN dim_customer ON dim_customer.customer_key = dapros.customer_key
				WHERE dapros.status_send = 0 $param_paket  AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
			")->result();
				}

				$select_subscribe = "";
				$param_3 = "";
				if ($campaign_detail->r_subscribe == 1) {
					$select_subscribe = " ,(SELECT COUNT(*) FROM fact_interaction
				WHERE customer_key = dapros.customer_key
				AND layanan_key = 5 AND status_key = 30
				) AS mosscount ";
					$param_3 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.id $select_subscribe FROM dapros
				WHERE dapros.status_send = 0 AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
				HAVING mosscount > 0
				")->result();
				}

				$select_infopaket = "";
				if ($campaign_detail->r_infopaket != "") {
					$select_infopaket = " AND fact_interaction.cat_key IN (" . $campaign_detail->r_infopaket . ") ";
					$param_4 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.id FROM dapros
				JOIN dim_customer ON dim_customer.customer_key = dapros.customer_key
				JOIN fact_interaction ON fact_interaction.customer_key = dapros.customer_key
				WHERE dapros.status_send = 0 $select_infopaket AND (layanan_key = 2 OR layanan_key = 3)
				AND dapros.date_key IS NULL
				GROUP BY dapros.customer_key
			")->result();
				}

				$select_keyword = "";
				if ($campaign_detail->r_keyword != "") {
					$list_keyword = explode(",",  $campaign_detail->r_keyword);
					if (count($list_keyword) > 0) {
						$select_keyword = "AND (";
						$n = 0;
						foreach ($list_keyword as $val) {
							if ($n == 0) {
								$select_keyword .= " interaction_value LIKE '%$val%' ";
							} else {
								$select_keyword .= " OR interaction_value LIKE '%$val%' ";
							}
							$n++;
						}
						$select_keyword .= ")";
					}
					$param_5 = $this->campaign->live_query("
				SELECT dapros.customer_key,dapros.id FROM dapros
				JOIN fact_interaction ON dapros.customer_key = fact_interaction.customer_key 
				WHERE dapros.status_send = 0 $select_keyword AND dapros.date_key IS NULL
			")->result();
					// $select_keyword=" AND interaction_value LIKE IN (".$campaign_detail->r_keyword.") ";
				}
				if ($_POST['data_lead'] == 3) {
					if (count($param_1) > 0) {
						foreach ($param_1 as $r1) {
							$data['customer'][$r1->id]['id'] = $r1->id;
							$data['customer'][$r1->id]['snd'] = $r1->snd;
							$data['customer'][$r1->id]['total'] = $data['customer'][$r1->customer_key]['total'] + 10;
						}
					}
					if (count($param_2) > 0) {
						foreach ($param_2 as $r2) {
							$data['customer'][$r2->id]['id'] = $r2->id;
							$data['customer'][$r2->id]['snd'] = $r2->snd;
							$data['customer'][$r2->id]['total'] = $data['customer'][$r2->customer_key]['total'] + 15;
						}
					}
					if (count($param_3) > 0) {
						foreach ($param_3 as $r3) {
							$data['customer'][$r3->id]['id'] = $r3->id;
							$data['customer'][$r3->id]['snd'] = $r3->snd;
							$data['customer'][$r3->id]['total'] = $data['customer'][$r3->customer_key]['total'] + 25;
						}
					}
					if (count($param_4) > 0) {
						foreach ($param_4 as $r4) {
							$data['customer'][$r4->id]['id'] = $r4->id;
							$data['customer'][$r4->id]['snd'] = $r4->snd;
							$data['customer'][$r4->id]['total'] = $data['customer'][$r4->customer_key]['total'] + 20;
						}
					}
					if (count($param_5) > 0) {
						foreach ($param_5 as $r5) {
							$data['customer'][$r5->id]['id'] = $r5->id;
							$data['customer'][$r5->id]['snd'] = $r5->snd;
							$data['customer'][$r5->id]['total'] = $data['customer'][$r5->customer_key]['total'] + 20;
						}
					}
					foreach ($data['customer'] as $sc) {
						if ($sc['total'] >= $_POST['min_score']) {
							$this->dapros->edit(array("id" => $sc['id']), array("date_key" => $date_key, "campaign_id" => $campaign));
						}
					}
				} else {
					if (count($param_1) > 0) {
						foreach ($param_1 as $r1) {
							$this->dapros->edit(array("id" => $r1->id), array("date_key" => $date_key, "campaign_id" => $campaign));
						}
					}
					if (count($param_2) > 0) {
						foreach ($param_2 as $r2) {
							$this->dapros->edit(array("id" => $r2->id), array("date_key" => $date_key, "campaign_id" => $campaign));
						}
					}
					if (count($param_3) > 0) {
						foreach ($param_3 as $r3) {
							$this->dapros->edit(array("id" => $r3->id), array("date_key" => $date_key, "campaign_id" => $campaign));
						}
					}
					if (count($param_4) > 0) {
						foreach ($param_4 as $r4) {
							$this->dapros->edit(array("id" => $r4->id), array("date_key" => $date_key, "campaign_id" => $campaign));
						}
					}
					if (count($param_5) > 0) {
						foreach ($param_5 as $r5) {
							$this->dapros->edit(array("id" => $r5->id), array("date_key" => $date_key, "campaign_id" => $campaign));
						}
					}
				}
			} else {

				$this->dapros->edit(array("status_send" => 0), array("date_key" => $date_key, "campaign_id" => $campaign));
			}
		}
		redirect('/Blast_management/Blast_management?blast=1', 'refresh');
	}
	public function get_tot_prospect()
	{
		$tot = $this->db->query("SELECT COUNT(*) as jml FROM trx_blast WHERE status is null")->row()->jml;
		return $tot;
	}
	public function get_perchannelblast()
	{
		$tot['wa'] = $this->db->query("SELECT
		channel_key,
		( SELECT count(*) FROM trx_blast WHERE tgl_deliver IS NOT NULL AND channel_key=1) AS jmldeliver,
		( SELECT count(*) FROM trx_blast WHERE tgl_klicked IS NOT NULL AND channel_key=1) AS jml_klicked,
		( SELECT count(*) FROM trx_blast WHERE tgl_read IS NOT NULL AND channel_key=1) AS tgl_read,
		( SELECT count(*) FROM trx_blast WHERE tgl_activated IS NOT NULL AND channel_key=1) AS tgl_activated,
		( SELECT count(*) FROM trx_blast WHERE tgl_ps IS NOT NULL AND channel_key=1) AS tgl_ps,
		( SELECT count(*) FROM trx_blast WHERE tgl_blast IS NOT NULL AND channel_key=1 ) AS tgl_blast,
		count(*) AS tot 
	FROM
		trx_blast 
	WHERE
	STATUS IS NULL AND channel_key=1
	GROUP BY
		channel_key")->row();
		$tot['sms'] = $this->db->query("SELECT
		channel_key,
		( SELECT count(*) FROM trx_blast WHERE tgl_deliver IS NOT NULL   AND channel_key=2) AS jmldeliver,
		( SELECT count(*) FROM trx_blast WHERE tgl_klicked IS NOT NULL  AND channel_key=2) AS jml_klicked,
		( SELECT count(*) FROM trx_blast WHERE tgl_read IS NOT NULL  AND channel_key=2) AS tgl_read,
		( SELECT count(*) FROM trx_blast WHERE tgl_activated IS NOT NULL  AND channel_key=2) AS tgl_activated,
		( SELECT count(*) FROM trx_blast WHERE tgl_ps IS NOT NULL  AND channel_key=2) AS tgl_ps,
		( SELECT count(*) FROM trx_blast WHERE tgl_blast IS NOT NULL  AND channel_key=2) AS tgl_blast,
		count(*) AS tot 
	FROM
		trx_blast 
	WHERE
	STATUS IS NULL AND channel_key=2
	GROUP BY
		channel_key")->row();
		$tot['email'] = $this->db->query("SELECT
		channel_key,
		( SELECT count(*) FROM trx_blast WHERE tgl_deliver IS NOT NULL AND channel_key=3) AS jmldeliver,
		( SELECT count(*) FROM trx_blast WHERE tgl_klicked IS NOT NULL  AND channel_key=3 ) AS jml_klicked,
		( SELECT count(*) FROM trx_blast WHERE tgl_read IS NOT NULL  AND channel_key=3) AS tgl_read,
		( SELECT count(*) FROM trx_blast WHERE tgl_activated IS NOT NULL AND channel_key=3 ) AS tgl_activated,
		( SELECT count(*) FROM trx_blast WHERE tgl_ps IS NOT NULL AND channel_key=3) AS tgl_ps,
		( SELECT count(*) FROM trx_blast WHERE tgl_blast IS NOT NULL  AND channel_key=3) AS tgl_blast,
		count(*) AS tot 
	FROM
		trx_blast 
	WHERE
	STATUS IS NULL AND channel_key=3
	GROUP BY
		channel_key")->row();
		$tot['total'] = $this->db->query("SELECT
		channel_key,
		( SELECT count(*) FROM trx_blast WHERE tgl_deliver IS NOT NULL  ) AS jmldeliver,
		( SELECT count(*) FROM trx_blast WHERE tgl_klicked IS NOT NULL  ) AS jml_klicked,
		( SELECT count(*) FROM trx_blast WHERE tgl_read IS NOT NULL   ) AS tgl_read,
		( SELECT count(*) FROM trx_blast WHERE tgl_activated IS NOT NULL ) AS tgl_activated,
		( SELECT count(*) FROM trx_blast WHERE tgl_ps IS NOT NULL   ) AS tgl_ps,
		( SELECT count(*) FROM trx_blast WHERE tgl_blast IS NOT NULL) AS tgl_blast,
		count(*) AS tot 
	FROM
		trx_blast 
	WHERE
	STATUS IS NULL")->row();
		return $tot;
	}

	public function get_jml_prdct_prospect()
	{
		$tot = $this->db->query("SELECT
		trx_rule.product_key as product,
		dim_produk.produk_value,
		count(*) as jml
	FROM
		trx_blast
		JOIN trx_rule ON trx_blast.id_rules = trx_rule.id
		JOIN dim_produk ON trx_rule.product_key = dim_produk.produk_key
		GROUP BY product
		limit 5")->result();
		return $tot;
	}
	public function get_processed_blast()
	{
		$tot = $this->db->query("SELECT
		trx_rule.product_key as product,
		dim_produk.produk_value,
		count(*) as jml
	FROM
		trx_blast
		JOIN trx_rule ON trx_blast.id_rules = trx_rule.id
		JOIN dim_produk ON trx_rule.product_key = dim_produk.produk_key
		GROUP BY product
		limit 5")->result();
		return $tot;
	}
}

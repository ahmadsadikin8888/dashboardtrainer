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
		$data = array();
		$data['tot_prospect'] = $this->get_tot_prospect();
		$data['perchannelblast'] = $this->get_perchannelblast();
		$data['jml_prdct_prospect'] = $this->get_jml_prdct_prospect();
		$data['processed_blast'] = $this->get_processed_blast();
		$data['line_chart'] = $this->get_linechart();

		$this->load->view('Dashboard/dashboard_page', $data);
	}
	public function get_linechart()
	{
		$m = date("m");
		$de = date("d");
		$y = date("Y");
		for ($i = 14; $i > 0; $i-=1) {
			$tanggal = date('Y-m-d', mktime(0, 0, 0, $m, ($de - $i), $y));
			$blast = $this->db->query("SELECT COUNT(*) as jml FROM trx_blast WHERE DATE(tgl_blast)='$tanggal'")->row()->jml;
			$deliver = $this->db->query("SELECT COUNT(*) as jml FROM trx_blast WHERE DATE(tgl_deliver)='$tanggal'")->row()->jml;
			$klicked = $this->db->query("SELECT COUNT(*) as jml FROM trx_blast WHERE DATE(tgl_klicked)='$tanggal'")->row()->jml;
			$read = $this->db->query("SELECT COUNT(*) as jml FROM trx_blast WHERE DATE(tgl_read)='$tanggal'")->row()->jml;
			$activated = $this->db->query("SELECT COUNT(*) as jml FROM trx_blast WHERE DATE(tgl_activated)='$tanggal'")->row()->jml;
			$ps = $this->db->query("SELECT COUNT(*) as jml FROM trx_blast WHERE DATE(tgl_ps)='$tanggal'")->row()->jml;
			$data['blast'][$tanggal] = $blast;
			$data['deliver'][$tanggal] = $deliver;
			$data['klicked'][$tanggal] = $klicked;
			$data['read'][$tanggal] = $read;
			$data['activated'][$tanggal] = $activated;
			$data['ps'][$tanggal] = $ps;
		}

		return $data;
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

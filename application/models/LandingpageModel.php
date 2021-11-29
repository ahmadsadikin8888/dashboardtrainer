<?php
defined('BASEPATH') || exit('No direct script access allowed');

class LandingpageModel extends CI_Model
{

	public function save_template(string $jenis_template, string $campaign_name, string $template_content)
	{
		$this->db->insert('dim_landingpage', array(
			'template_type' => $jenis_template, 'campaign_name' => $campaign_name, 'template_content' => $template_content
		));
		return true;
	}
	public function get_blast_data() // get data yg mau di blast dari DB
	{
		return $this->db->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(stage_data, CONCAT('$[',stage_flag+1,']')),'$.media')) AS media,cust_id,content_id,unique_link,target FROM content_customer_blast WHERE unique_link IS NOT NULL AND FROM_UNIXTIME(JSON_EXTRACT(JSON_EXTRACT(stage_data, CONCAT('$[',stage_flag+1,']')),'$.schedule')) <= NOW();")->result();
	}
	public function get_not_responding_data() //Ambil data blast yg sudah selesai di blast, tapi tanpa respon, untuk di konsumsi TAM
	{
		return $this->db->query("SELECT cust_id,content_id,unique_link FROM content_customer_blast WHERE unique_link IS NOT NULL AND JSON_EXTRACT(stage_data, CONCAT('$[',stage_flag+1,']')) IS NULL;")->result();
	}
	public function update_blast_result(string $unique_link) //Bilamana blast sukses dieksekusi (bukan blast agree)
	{
		return $this->db->query("UPDATE content_customer_blast SET stage_flag = stage_flag + 1 WHERE unique_link = " . $unique_link . ";");
	}
	public function clear_blast_link(string $unique_link) //Final Function, kalau pelanggan agree, disagree, tidak ada respon sama sekali
	{
		return $this->db->query("UPDATE content_customer_blast SET unique_link = NULL WHERE unique_link = " . $unique_link . ";");
	}
	public function unique_link_access(string $unique_link) //Ambil data saat customer click unique link
	{
		return $this->db->query("SELECT cust_id,content_id FROM content_customer_blast WHERE unique_link = " . $unique_link . ";")->result();
	}
	public function insert_cust_blast(integer $content_id, array $parameter)
	{
		$sql = 'INSERT INTO 
		content_customer_blast (stage_data,unique_link,content_id) 
		SELECT CONCAT("[",IF(email IS NOT NULL,CONCAT(\'{"media":"email","target":"\',email,\'","schedule":\',UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 0 DAY)),\'}\'),""),IF(LENGTH(SUBSTRING(ani,LOCATE("8",ani),LENGTH(ani)-LOCATE("8",ani)+1))>10 , CONCAT(IF(email IS NOT NULL,",",""),\'{"media":"sms","target":"\',ani,\'","schedule":\',UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 3 DAY)),\'},{"media":"whatsapp","target":"\',ani,\'","schedule":\',UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 6 DAY)),\'}\'), ""),"]") AS stage_data, SHA2(CONCAT(cust_id,' . $content_id . '), 512) AS unique_link,' . $content_id . ' AS content_id FROM (;';
		$sql .= 'SELECT cust_id,ani_number,email FROM db_profiling WHERE true';
		foreach ($parameter as $param) {
			$sql .= " AND cust_id IN (SELECT cust_id FROM " . $param->database_name . " WHERE " . $param->filter . ")";
		}
		$sql .= ') temp';
		$this->db->query($sql);
		// JSON_ARRAY_INSERT('[]', '$[0]', 'x')
		// [{"media":"whatsapp","target":"09212345678","schedule":1618652735},{"media":"sms","target":"08212345678","schedule":1618652735},{"media":"email","target":"customer@email.com","schedule":1618652735}]
	}
}

/* End of file contentManagementModel.php */
/* Location: ./application/models/contentManagementModel.php */
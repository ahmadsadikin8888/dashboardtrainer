<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ContentManagementModel extends CI_Model
{

	public function save_template(string $jenis_template, string $campaign_name, string $template_content, $deskripsi)
	{
		$this->db->insert('content_management', array(
			'template_type' => $jenis_template, 'campaign_name' => $campaign_name, 'template_content' => $template_content, 'produk_name' => $deskripsi
		));
		return true;
	}
}

/* End of file contentManagementModel.php */
/* Location: ./application/models/contentManagementModel.php */
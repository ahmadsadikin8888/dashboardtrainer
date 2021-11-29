<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_model extends CI_Model {
    private $_table = "trx_customer_kriteria";
    private $_table_paket = "trx_paket";

    public $id;

    public function getAllCustomer()
    {
        $this->db->join('dim_regional', 'trx_customer_kriteria.regional_key = dim_regional.regional_key');
        $this->db->join('dim_produk', 'trx_customer_kriteria.channel_key = dim_produk.produk_key');
        $this->db->join('dim_layanan', 'trx_customer_kriteria.layanan_key = dim_layanan.layanan_key');
        $customer_paket = $this->db->get($this->_table)->result();
        for($i = 0; $i<count($customer_paket); $i++) {
            $with_paket = $this->db->get_where($this->_table_paket, ["id" => $customer_paket[$i]->paket_key])->result();
            for($j = 0; $j < count($with_paket); $j++) {
                $customer_paket[$i]->nama_paket[$j] = $with_paket[$j]->nama_paket;
            }


        }

        return $customer_paket;

        // $this->db->join($this->_table, $this->_table_paket, 'trx_customer_criteria.paket_key=trx_paket.id');
        // $this->db->get($this->_table)->result();
        // var_dump($this->db->get($this->_table)->result());
    }

    public function saveCustomer()
    {
        $id_paket = $this->maxPaket();
        $paket = count($this->input->post('paket'));
        $data_paket = [];

        for ($i=0; $i < $paket; $i++) { 
            $data_paket[$i] = array(
              'id' => $id_paket,
              'nama_paket' => $this->input->post('paket')[$i]  
            );
            $this->db->insert('trx_paket',$data_paket[$i]);
        }
        // $this->product_id = uniqid();
        // $data = json_decode(file_get_contents('php://input'), true);
        $data_type = [];
        for($j = 0; $j < count($this->input->post('type_interaction')); $j++) {
            $data_type[$j] = $this->input->post('type_interaction')[$j];

        }
        $insert_data_type = implode(",", $data_type);

        $data_tag = [];
        for($j = 0; $j < count($this->input->post('tag_interaction')); $j++) {
            $data_tag[$j] = $this->input->post('tag_interaction')[$j];
        }
        $insert_data_tag = implode(",", $data_tag);
        
        $data = array(
            'nama_kriteria' => $this->input->post("nama_kriteria"),
            'regional_key' => $this->input->post('regional'),
            'paket_key' => $id_paket,
            'channel_key' => $this->input->post("channel"),
            'last_campaign_time' => $this->input->post("last_campaign_time"),
            'layanan_key' => $this->input->post('layanan'),
            'type_interaction' => $insert_data_type,
            'tag_interaction' => $insert_data_tag
        );
        return $this->db->insert($this->_table, $data);
    }

    public function updateCustomer()
    {
        $id_paket = $this->maxPaket();
        $paket = count($this->input->post('paket'));

        $customer_data = $this->db->get_where("trx_customer_kriteria", ["id" => $this->input->post("id_customer")])->row();
        
        $this->db->delete("trx_paket", ["id"=>$customer_data->paket_key]);

        $data_paket = [];
        for ($i=0; $i < $paket; $i++) { 
            $data_paket[$i] = array(
              'id' => $id_paket,
              'nama_paket' => $this->input->post('paket')[$i]  
            );
            $this->db->insert('trx_paket',$data_paket[$i]);
        }
        // $this->product_id = uniqid();
        // $data = json_decode(file_get_contents('php://input'), true);
        $this->id = $this->input->post("id_customer");

        $data_type = [];
        for($j = 0; $j < count($this->input->post('type_interaction')); $j++) {
            $data_type[$j] = $this->input->post('type_interaction')[$j];

        }
        $insert_data_type = implode(",", $data_type);

        $data_tag = [];
        for($j = 0; $j < count($this->input->post('tag_interaction')); $j++) {
            $data_tag[$j] = $this->input->post('tag_interaction')[$j];
        }
        $insert_data_tag = implode(",", $data_tag);
        

        $data = array(
            'nama_kriteria' => $this->input->post("nama_kriteria"),
            'regional_key' => $this->input->post('regional'),
            'paket_key' => $id_paket,
            'channel_key' => $this->input->post("channel"),
            'last_campaign_time' => $this->input->post("last_campaign_time"),
            'layanan_key' => $this->input->post('layanan'),
            'type_interaction' => $insert_data_type,
            'tag_interaction' => $insert_data_tag
        );
        return $this->db->update($this->_table, $data, array('id' => $this->id));
    }

    function maxPaket() {
        $this->db->select_max('id');
        $id_paket = $this->db->get('trx_paket')->row_array()['id'];
        $id_paket += 1;
        return $id_paket; 
    }

    public function getRegional(){
        return $this->db->get('dim_regional')->result();
    }

    public function getChannel(){
        return $this->db->get('dim_produk')->result();
    }
    public function getCustCategoryProduk(){
        return $this->db->get('dim_category_produk')->result();
    }

    public function getLayanan(){
        return $this->db->get('dim_layanan')->result();
    }
    public function get_product(){
        return $this->db->get('dim_produk')->result();
    }
}
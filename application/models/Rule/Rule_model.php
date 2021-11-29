<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rule_model extends CI_Model {
    private $_table = "trx_rule";

    public $id;

    public function getAllRule()
    {
        $this->db->select("trx_rule.id AS id_rule, trx_rule.rule_name, trx_rule.periode_from, trx_rule.periode_end, trx_rule.id_customer_kriteria, trx_customer_kriteria.nama_kriteria, trx_rule.product_key, dim_produk.produk_value, trx_rule.id_template, trx_rule.status");
        $this->db->join('trx_customer_kriteria', 'trx_customer_kriteria.id = trx_rule.id_customer_kriteria');
        $this->db->join('dim_produk', 'dim_produk.produk_key = trx_rule.product_key');
        $rule = $this->db->get($this->_table)->result();
        for($i = 0; $i < count($rule); $i++) {
            $with_template = $this->db->get_where('trx_template',["id" => $rule[$i]->id_template])->result();

            for($j = 0; $j < count($with_template); $j++) {
                $rule[$i]->nama_template[$j] = $with_template[$j]->nama_template;
            }
        }
        return $rule;
    }

    public function save()
    {
        // $this->product_id = uniqid();
        // $data = json_decode(file_get_contents('php://input'), true);
        $id_template = $this->maxTemplate();
        $template = count($this->input->post('template'));
        $data_template = [];

        for ($i=0; $i < $template; $i++) { 
            $data_template[$i] = array(
              'id' => $id_template,
              'nama_template' => $this->input->post('template')[$i]  
            );
            $this->db->insert('trx_template',$data_template[$i]);
        }

        $data = array(
            'rule_name' => $this->input->post("rule_name"),
            'periode_from' => $this->input->post('periode_from'),
            'periode_end' => $this->input->post("periode_end"),
            'id_customer_kriteria' => $this->input->post('customer_kriteria'),
            'product_key' => $this->input->post("produk"),
            'id_template' => $id_template,
            'status' => $this->input->post("status")
        );
        return $this->db->insert($this->_table, $data);
    }

    public function update() {
        $id_template = $this->maxTemplate();

        $template = count($this->input->post('template_edit'));
        $data_template = [];

        $rule_data = $this->db->get_where("trx_rule", ["id" => $this->input->post("id_edit")])->row();
        
        $this->db->delete("trx_template", ["id"=>$rule_data->id_template]);

        for ($i=0; $i < $template; $i++) { 
            $data_template[$i] = array(
              'id' => $id_template,
              'nama_template' => $this->input->post('template_edit')[$i]  
            );
            $this->db->insert('trx_template',$data_template[$i]);
        }

        $data = array(
            'rule_name' => $this->input->post("rule_name_edit"),
            'periode_from' => $this->input->post('periode_from_edit'),
            'periode_end' => $this->input->post("periode_end_edit"),
            'id_customer_kriteria' => $this->input->post('customer_kriteria_edit'),
            'product_key' => $this->input->post("produk_edit"),
            'id_template' => $id_template,
        );
        return $this->db->update($this->_table, $data, ["id" => $this->input->post("id_edit")]);
    }

    public function edit_status () {
        $data = array(
            "status" => $this->input->post('status')
        ); 

        return $this->db->update($this->_table, $data, ["id" => $this->input->post("id")]);
    }

    function maxTemplate() {
        $this->db->select_max('id');
        $id_template = $this->db->get('trx_template')->row_array()['id'];
        $id_template += 1;
        return $id_template; 
    }
}
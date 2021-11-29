<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_model extends CI_Model {
    private $_table = "r_area";

    public $id;
    public $nama_area;
    public $value;
    
    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->product_id = uniqid();
        $this->code_product = $post["nama_area"];
        $this->name_product = $post["value"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->code_product = $post["nama_area"];
        $this->name_product = $post["value"];
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }
}
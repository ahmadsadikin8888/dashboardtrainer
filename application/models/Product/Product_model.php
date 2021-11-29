<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model {
    private $_table = "dim_produk";

    public $id;
    public $code_product;
    public $name_product;
    // public $price;
    public $product_desc;

    public $produk_key;
    public $produk_value;
    public $produk_description;
    public $category_produk_key;

    public function getAll()
    {
        return $this->db->query("SELECT DISTINCT dim_produk.produk_key, dim_produk.produk_value, dim_produk.produk_description, 
        dim_produk.category_produk_key, dim_category_produk.category_produk_value, dim_category_produk.category_produk_description FROM dim_produk 
        LEFT JOIN dim_category_produk ON dim_produk.category_produk_key = dim_category_produk.category_produk_key")->result();
    }

    public function getAllCategoryProduk(){
        return $this->db->get('dim_category_produk')->result();
    }

    public function getIdCategoryProduk($category_produk_key){
        return $this->db->get_where('dim_category_produk',array('category_produk_key' => $category_produk_key))->row();
    }
    
    public function getById($id)
    {
        return $this->db->query("SELECT DISTINCT dim_produk.produk_key, dim_produk.produk_value, dim_produk.produk_description, 
        dim_category_produk.category_produk_value, dim_category_produk.category_produk_description FROM dim_produk 
        LEFT JOIN dim_category_produk ON dim_produk.category_produk_key = dim_category_produk.category_produk_key where produk_key='$id'")->row();
    }

    public function save()
    {
        // $this->product_id = uniqid();
        // $data = json_decode(file_get_contents('php://input'), true);
        $data = array(
            'produk_value' => $this->input->post("produk_value"),
            'produk_description' => $this->input->post('produk_description'),
            'category_produk_key' => $this->input->post("category_produk_value")
        );
        return $this->db->insert($this->_table, $data);
    }

    public function update()
    {
        // $data = json_decode(file_get_contents('php://input'), true);
        $this->id = $this->input->post("produk_key");
        $data = array(
            'produk_value' => $this->input->post("produk_value"),
            'produk_description' => $this->input->post('produk_description'),
            'category_produk_key' => $this->input->post("category_produk_value")
        );
        return $this->db->update($this->_table, $data, array('produk_key' => $this->id));
    }
}
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_dapros_model extends CI_Model
{

    public $table = 'dapros_helpdesk_va';
    public $id = 'id';
    public $order = 'DESC';

    private $id_super_admin = 1;

    function __construct()
    {
        parent::__construct();
    }

    function insert_multiple($data)
    {
        $this->db->trans_start();

        $this->db->insert_batch($this->table, $data);


        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    function update_multiple($data, $param = array())
    {
        $this->db->trans_start();
        $this->db->update_batch($this->table, $data, $param);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    function if_exist($id, $data)
    {

        // $this->db->where_not_in($this->table . '.' . 'id', $id);
        $q = $this->db->get_where($this->table, $data)->result_array();
        if (count($q) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

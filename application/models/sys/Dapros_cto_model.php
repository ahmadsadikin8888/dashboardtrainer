<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dapros_cto_model extends CI_Model
{

    public $table = 'dapros_cto';
    public $id = 'id';
    public $order = 'DESC';
	

    function __construct()
    {
        parent::__construct();
    }

	public function json(){
		$this->datatables->select('
			 *
		');
		
		$this->datatables->from('dapros_cto');
		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	
	
	
	function insert_multiple($data){
		$this->db->trans_start();

		 $this->db->insert_batch($this->table, $data);
		
		
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}

	
}

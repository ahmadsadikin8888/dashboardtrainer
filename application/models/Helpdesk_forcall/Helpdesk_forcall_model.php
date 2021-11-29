<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Helpdesk_forcall_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			helpdesk_forcall.id as id,
			helpdesk_forcall.PETUGAS as PETUGAS,
			helpdesk_forcall.ADDON as ADDON,
			helpdesk_forcall.STATUS_SC as STATUS_SC,
			helpdesk_forcall.NDEM as NDEM,
			helpdesk_forcall.COPER as COPER,
			helpdesk_forcall.CAGENT as CAGENT,
			helpdesk_forcall.KAWASAN as KAWASAN,
			helpdesk_forcall.WITEL as WITEL,
			helpdesk_forcall.C_WITEL as C_WITEL,
			helpdesk_forcall.C_DATEL_NEW as C_DATEL_NEW,
			helpdesk_forcall.STO as STO,
			helpdesk_forcall.CHANEL as CHANEL,
			helpdesk_forcall.ALPRO as ALPRO,
			helpdesk_forcall.TGL_VA as TGL_VA,
			helpdesk_forcall.umur as umur,
			helpdesk_forcall.cek as cek,
			helpdesk_forcall.CGEST as CGEST,
			helpdesk_forcall.CSEG as CSEG,
			helpdesk_forcall.CCAT as CCAT,
			helpdesk_forcall.LINECATS_FAMILY_LNAME as LINECATS_FAMILY_LNAME,
			helpdesk_forcall.TEMATIK as TEMATIK,
			helpdesk_forcall.ITEM as ITEM,
			helpdesk_forcall.CPACK as CPACK,
			helpdesk_forcall.PSB as PSB,
			helpdesk_forcall.CBT as CBT,
			helpdesk_forcall.MIG as MIG,
			helpdesk_forcall.PRICE_PSB as PRICE_PSB,
			helpdesk_forcall.PRICE_CBT as PRICE_CBT,
			helpdesk_forcall.PRICE_MIG as PRICE_MIG,
			helpdesk_forcall.FLAG_BUNDLING as FLAG_BUNDLING,
			helpdesk_forcall.BUNDLING_2P3P as BUNDLING_2P3P,
			helpdesk_forcall.BUNDLING_STB as BUNDLING_STB,
			helpdesk_forcall.BUNDLING_WIFIEXT as BUNDLING_WIFIEXT,
			helpdesk_forcall.EXTERNAL_ORDER_ID as EXTERNAL_ORDER_ID,
			helpdesk_forcall.BUNDLING_INDIBOX as BUNDLING_INDIBOX,
			helpdesk_forcall.ND_SPEEDY as ND_SPEEDY,
			helpdesk_forcall.KCONTACT as KCONTACT,
			helpdesk_forcall.XS6 as XS6,
			helpdesk_forcall.HASIL as HASIL,
			helpdesk_forcall.KETERANGAN as KETERANGAN,
		');
		
		$this->datatables->from('helpdesk_forcall');

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'helpdesk_forcall.id as id',
			'helpdesk_forcall.PETUGAS as PETUGAS',
			'helpdesk_forcall.ADDON as ADDON',
			'helpdesk_forcall.STATUS_SC as STATUS_SC',
			'helpdesk_forcall.NDEM as NDEM',
			'helpdesk_forcall.COPER as COPER',
			'helpdesk_forcall.CAGENT as CAGENT',
			'helpdesk_forcall.KAWASAN as KAWASAN',
			'helpdesk_forcall.WITEL as WITEL',
			'helpdesk_forcall.C_WITEL as C_WITEL',
			'helpdesk_forcall.C_DATEL_NEW as C_DATEL_NEW',
			'helpdesk_forcall.STO as STO',
			'helpdesk_forcall.CHANEL as CHANEL',
			'helpdesk_forcall.ALPRO as ALPRO',
			'helpdesk_forcall.TGL_VA as TGL_VA',
			'helpdesk_forcall.umur as umur',
			'helpdesk_forcall.cek as cek',
			'helpdesk_forcall.CGEST as CGEST',
			'helpdesk_forcall.CSEG as CSEG',
			'helpdesk_forcall.CCAT as CCAT',
			'helpdesk_forcall.LINECATS_FAMILY_LNAME as LINECATS_FAMILY_LNAME',
			'helpdesk_forcall.TEMATIK as TEMATIK',
			'helpdesk_forcall.ITEM as ITEM',
			'helpdesk_forcall.CPACK as CPACK',
			'helpdesk_forcall.PSB as PSB',
			'helpdesk_forcall.CBT as CBT',
			'helpdesk_forcall.MIG as MIG',
			'helpdesk_forcall.PRICE_PSB as PRICE_PSB',
			'helpdesk_forcall.PRICE_CBT as PRICE_CBT',
			'helpdesk_forcall.PRICE_MIG as PRICE_MIG',
			'helpdesk_forcall.FLAG_BUNDLING as FLAG_BUNDLING',
			'helpdesk_forcall.BUNDLING_2P3P as BUNDLING_2P3P',
			'helpdesk_forcall.BUNDLING_STB as BUNDLING_STB',
			'helpdesk_forcall.BUNDLING_WIFIEXT as BUNDLING_WIFIEXT',
			'helpdesk_forcall.EXTERNAL_ORDER_ID as EXTERNAL_ORDER_ID',
			'helpdesk_forcall.BUNDLING_INDIBOX as BUNDLING_INDIBOX',
			'helpdesk_forcall.ND_SPEEDY as ND_SPEEDY',
			'helpdesk_forcall.KCONTACT as KCONTACT',
			'helpdesk_forcall.XS6 as XS6',
			'helpdesk_forcall.HASIL as HASIL',
			'helpdesk_forcall.KETERANGAN as KETERANGAN',
		
		);
		$this->db->select($afield);

		$this->db->order_by('helpdesk_forcall.id', 'ASC');
		return $this->db->get('helpdesk_forcall')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'helpdesk_forcall.id as id',
			'helpdesk_forcall.PETUGAS as PETUGAS',
			'helpdesk_forcall.ADDON as ADDON',
			'helpdesk_forcall.STATUS_SC as STATUS_SC',
			'helpdesk_forcall.NDEM as NDEM',
			'helpdesk_forcall.COPER as COPER',
			'helpdesk_forcall.CAGENT as CAGENT',
			'helpdesk_forcall.KAWASAN as KAWASAN',
			'helpdesk_forcall.WITEL as WITEL',
			'helpdesk_forcall.C_WITEL as C_WITEL',
			'helpdesk_forcall.C_DATEL_NEW as C_DATEL_NEW',
			'helpdesk_forcall.STO as STO',
			'helpdesk_forcall.CHANEL as CHANEL',
			'helpdesk_forcall.ALPRO as ALPRO',
			'helpdesk_forcall.TGL_VA as TGL_VA',
			'helpdesk_forcall.umur as umur',
			'helpdesk_forcall.cek as cek',
			'helpdesk_forcall.CGEST as CGEST',
			'helpdesk_forcall.CSEG as CSEG',
			'helpdesk_forcall.CCAT as CCAT',
			'helpdesk_forcall.LINECATS_FAMILY_LNAME as LINECATS_FAMILY_LNAME',
			'helpdesk_forcall.TEMATIK as TEMATIK',
			'helpdesk_forcall.ITEM as ITEM',
			'helpdesk_forcall.CPACK as CPACK',
			'helpdesk_forcall.PSB as PSB',
			'helpdesk_forcall.CBT as CBT',
			'helpdesk_forcall.MIG as MIG',
			'helpdesk_forcall.PRICE_PSB as PRICE_PSB',
			'helpdesk_forcall.PRICE_CBT as PRICE_CBT',
			'helpdesk_forcall.PRICE_MIG as PRICE_MIG',
			'helpdesk_forcall.FLAG_BUNDLING as FLAG_BUNDLING',
			'helpdesk_forcall.BUNDLING_2P3P as BUNDLING_2P3P',
			'helpdesk_forcall.BUNDLING_STB as BUNDLING_STB',
			'helpdesk_forcall.BUNDLING_WIFIEXT as BUNDLING_WIFIEXT',
			'helpdesk_forcall.EXTERNAL_ORDER_ID as EXTERNAL_ORDER_ID',
			'helpdesk_forcall.BUNDLING_INDIBOX as BUNDLING_INDIBOX',
			'helpdesk_forcall.ND_SPEEDY as ND_SPEEDY',
			'helpdesk_forcall.KCONTACT as KCONTACT',
			'helpdesk_forcall.XS6 as XS6',
			'helpdesk_forcall.HASIL as HASIL',
			'helpdesk_forcall.KETERANGAN as KETERANGAN',
		
		);
		$this->db->select($afield);

		$this->db->where('helpdesk_forcall.id', $id);
		$this->db->order_by('helpdesk_forcall.id', 'ASC');
		return $this->db->get('helpdesk_forcall')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('helpdesk_forcall.id <>',$id);

		$q = $this->db->get_where('helpdesk_forcall', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('helpdesk_forcall', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('helpdesk_forcall.id', $id);
		$this->db->update('helpdesk_forcall', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('helpdesk_forcall.id',$data);	
	
			$this->db->delete('helpdesk_forcall');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-11-09 06:32:14 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

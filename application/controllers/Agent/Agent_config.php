<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agent_config {
	


   function __construct(){
	   /* title */
	    $this->general		= new General_title();
		$this->agent_id	= 'ID';
		$this->agent_nama	= 'NAMA';
		$this->agent_tl	= 'TL';
		$this->agent_status	= 'STATUS';

		
		
		
		/*field_alias_database db*/
		$this->f_id	= 'id';
		$this->f_nama	= 'nama';
		$this->f_tl	= 'tl';
		$this->f_status	= 'status';

		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => $title */	
		$this->table_column =array(
			$this->f_id	=> $this->agent_id,
			$this->f_nama	=> $this->agent_nama,
			$this->f_tl	=> $this->agent_tl,
			$this->f_status	=> $this->agent_status,
		);

	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2021-11-29 15:29:20 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

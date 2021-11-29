<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class page1 extends CI_Controller {



	public function index()
	
	{
		
		$this->template->load('Page/Page1',[
            'test' => 'Testing'
        ]);
	}
	

	
	
}

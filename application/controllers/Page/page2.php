<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class page2 extends CI_Controller {



	public function index()
	
	{
		
		$this->template->load('Page/Page2',[
            'test' => 'Testing2 2'
        ]);
	}
	

	
	
}

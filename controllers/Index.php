<?php 
/**
* 
*/
class Controller_index extends Libs_Controller
{
	
	function __construct()
	{
		Parent::__construct();
	}
	public function index(){		
		$this->view->render('index/index');
	}
	public function login(){
		$this->view->render('index/index');
	}
}
 ?>
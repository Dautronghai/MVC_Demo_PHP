<?php 
include_once 'models/doccument.php';
/**
* 
*/
class Controller_doccument extends Libs_Controller
{	
	public function __construct()
	{
		Parent::__construct();
	}
	public function index(){		
		//echo 'day la trang document';
		$doc = new Model_Doccument();
		$this->view->listdoc = $doc->getAllDoccument();
		$this->view->render('document/doccument');
	}
	public function file(){
		//echo 'day la trang document';
		$this->view->render('document/file');
	}
}
<?php 
class Controller_building extends Libs_Controller
{
	public function __construct()
	{
		Parent::__construct();
	}
	public function index(){		
		//echo 'day la trang document';
		$this->view->render('building/building');
	}
}
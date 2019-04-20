<?php include_once 'models/nhatkithietbi.php';
class Controller_nhatkithietbi extends Libs_Controller
{
	public function __construct()
	{
		Parent::__construct();
	}
	//xem thông tin nhật kí thiết bị
	//parameter: id thiết bị
	public function xemnhatkithietbi($thietbi){
		$nhatki = new Model_nhatkithietbi();
		//return ($nhatki->xemnhatkithietbi($thietbi));
		$this->view->nhatki = $nhatki->xemnhatkithietbi($thietbi);
		if($_SESSION['user_vaitro'] >= 0){
			$this->view->render('nhatkithietbi/adminxemnhatkithietbi',false);	
		}else{
			$this->view->render('nhatkithietbi/xemnhatkithietbi',false);
		}
	}
	// Thêm nhật kí của thiết bị
	// parameter: id thiết bị.
	public function addnhatkithietbi($thietbi){
		$nhatki = new Model_nhatkithietbi();
		echo $nhatki->addnhatkithietbi(1,'aaaaaa');
		//$query = 'insert into nhatkithietbi values ('')'
		//return ($nhatki->xemnhatkithietbi($thietbi));
		$this->view->nhatki = $nhatki->xemnhatkithietbi($thietbi);
		if($_SESSION['user_vaitro'] >= 0){
			//$this->view->render('nhatkithietbi/adminxemnhatkithietbi',false);	
		}else{
			//$this->view->render('nhatkithietbi/xemnhatkithietbi',false);
		}
	}
}
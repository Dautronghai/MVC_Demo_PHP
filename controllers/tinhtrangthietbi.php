<?php include_once 'models/tinhtrangthietbi.php';
/**
* 
*/
class Controller_tinhtrangthietbi extends Libs_Controller
{
	
	function __construct()
	{
		Parent::__construct();
	}
	//Thêm mới tình trạng của thiết bị
	public function themmoi(){	

		if(isset($_POST['tentinhtrang'])){	
			if($_POST['tentinhtrang'] !== ''){
				$tinhtrang = new Model_tinhtrangthietbi();
				$query = 'insert into tinhtrangthietbi(tinhtrang) values ("'.
					$_POST['tentinhtrang'].'")';				
				$tinhtrang->thucthi($query);
			}
		}
	}
	//Cập nhật thông tin thiết bị
	public function capnhat(){	

		if(isset($_POST['tentinhtrang'])){	
			if($_POST['tentinhtrang'] !== ''){
				$tinhtrang = new Model_tinhtrangthietbi();
				$query = 'update tinhtrangthietbi SET tinhtrang = "'. $_POST['tentinhtrang'] .'" where id = '. $_POST['id_tinhtrang'];				
				$tinhtrang->thucthi($query);
			}
		}
	}

	public function viewCapnhattinhtrang()
	{
		if(isset($_POST['tinhtrang_id'])){
			$tinhtrang = new Model_tinhtrangthietbi();
			$query = 'select * from tinhtrangthietbi where id = '.$_POST['tinhtrang_id'];
			//$this->view->query =$query;
			$infor = $tinhtrang->thucthi($query);
			if(count($infor)>0){
				$this->view->infor = $tinhtrang->thucthi($query)[0];
				return $this->view->render('popup/popuptinhtrang',false);
			}			
		}
		
	}

	public function viewthemtinhtrang()
	{	
		return $this->view->render('popup/popuptinhtrang',false);
	}
	public function cbotinhtranghietbi($idselected){
		$tinhtrang = new Model_tinhtrangthietbi();		
		$this->view->tinhtrang = $tinhtrang->cbotinhtranghietbi();
		$this->view->selected = $idselected[0];		
		return $this->view->render('tinhtrangthietbi/cbotinhtranghietbi',false);
	}
	
}
 ?>
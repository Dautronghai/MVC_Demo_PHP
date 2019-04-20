<?php include_once 'models/nguoidung.php';
include_once 'models/thietbi.php';
class Controller_nguoidung extends Libs_Controller
{
	
	function __construct()
	{
		Parent::__construct();
	}
	public function index(){		
		header('Location: '.PATH);
	}
	//Include Select-Option vào các trang khác
	//parameter: id người dùng
	public function cbo_nguoidung($idselected)
	{
		$nguoidung = new Model_nguoidung();
		$this->view->nguoidung = $nguoidung->thucthi('select * from nguoidung');
		$this->view->selected = $idselected;
		return $this->view->render('nguoidung/cbo_nguoidung',false);
	}

	//Submit dang nhap he thong
	public function dangnhap(){
		$nguoidung = new Model_nguoidung();
		$kq = $nguoidung->dangnhap($_POST["email"],$_POST["password"]);		

		if((count($kq)>0) && ($_POST["email"] === $kq[0]->email)){			
			
	     	$_SESSION['user_id'] = $kq[0]->id;
	     	$_SESSION['user_vaitro'] = $kq[0]->vaitro;
	     	//$this->view->render('nguoidung');     	
	     	$this->taikhoandangnhap($kq[0]->id);
		}
		else {			
			$this->view->error = "Kiem tra lai dang nhap";
			$this->view->render('nguoidung/dangnhap');
		}
				
	}
	//Thoát khỏi hệ thống
	public function thoat(){
		//session_start(); 
		unset($_SESSION['user_id']);
		unset($_SESSION['user_vaitro']);
		header('Location: '.PATH.'/nguoidung/trangdangnhap/');
		//$this->trangdangnhap();
	}
	//Trang dang nhap he thong
	public function trangdangnhap(){
		
		$this->view->render('nguoidung/dangnhap');
	}
	//Trang hien thi thong tin tai khoan dang nhap
	//parameter id người đăng nhập
	public function taikhoandangnhap($thongtin){		
		$nguoidung = new Model_nguoidung();
		$tt = $nguoidung->timkiemuser($thongtin);
		//echo 'ban da dang nhap vao he thong';
		$this->view->thongtin = $tt[0];
		$this->view->render('nguoidung/thongtindangnhap');
	}

	//Xem thông tin chi tiết của một người dùng
	//parameter: id người dùng hệ thống
	public function chitietnguoidung($thongtin){	
		if($_SESSION['user_vaitro'] > 0){
			$nguoidung = new Model_nguoidung();
			$tt = $nguoidung->timkiemuser($thongtin);
			//echo 'ban da dang nhap vao he thong';
			$this->view->thongtin = $tt[0];
			$this->view->render('nguoidung/chitietnguoidung');
		}else{
			$nguoidung = new Model_nguoidung();
			$tt = $nguoidung->timkiemuser($_SESSION['user_id']);
			//echo 'ban da dang nhap vao he thong';
			$this->view->thongtin = $tt[0];
			$this->view->render('nguoidung/chitietnguoidung');
			//header('Location: '.PATH.'/nguoidung/taikhoandangnhap/'.$_SESSION['user_id']);
		}
	}
	//Lưu thay đổi cập nhật thông tin người dùng.
	//
	public function luuthongtin(){
		if(isset($_SESSION['user_id'])){
			$hoten = $_POST['hoten'];
			$gioitinh = $_POST['gioitinh'];
			$ngaysinh = $_POST['ngaysinh'];
			$diachi = $_POST['diachi'];			
			$email = $_POST['email'];
			$sdt = $_POST['sdt'];			 							
			if(isset($_FILES['file_hinh'])){
				if($_FILES['file_hinh']['error'] > 0){				
					$hinhdaidien = $_POST['hinhdaidien'];
				}else{		
					$root = explode('\\',dirname(__FILE__));
					array_pop($root);
					$dir = implode('\\',$root);
					
					$typee = '.'.explode('/',$_FILES['file_hinh']['type'])[1];
					$tenfile = ($this->vietnamenglish($_SESSION['user_id'])).$typee;
					if(move_uploaded_file($_FILES['file_hinh']['tmp_name'],$dir.'\media\hinhanh\\'.$tenfile)){
						$hinhdaidien = $tenfile;
					}
					else{
						$hinhdaidien = $_POST['hinhdaidien'];
					}
				}
			}
			//echo $hinhdaidien;
			$nguoidung = new Model_nguoidung();
			//echo $_SESSION['user_vaitro'];
			if((int)$_SESSION['user_vaitro'] > 0){
				$chucvu = $_POST['chucvu'];	
				$vaitro = $_POST['ravaitro'];	
				$id = $_POST['id'];	
				$query = 'update nguoidung set email="'.$email.'",Hoten="'.$hoten.'",gioitinh='.$gioitinh.',diachi="'.$diachi.'",chucvu="'.$chucvu.'",ngaysinh="'.$ngaysinh.'",sodienthoai="'.$sdt.'",hinhdaidien="'.$hinhdaidien.'",vaitro='.$vaitro.' WHERE id = '.$id;
				//echo $query;
				$nguoidung->thucthi($query);			
			}else{
				$query2 = 'update nguoidung set email="'.$email.'",Hoten="'.$hoten.'",gioitinh='.$gioitinh.',diachi="'.$diachi.'",ngaysinh="'.$ngaysinh.'",sodienthoai="'.$sdt.'",hinhdaidien="'.$hinhdaidien.'" WHERE id = '.$_SESSION['user_id'];
				//echo $query2;
				$nguoidung->thucthi($query2);
				//echo 'aaaaaaaaaaaaaaa';
			}
			header('Location: '.PATH.'/nguoidung/chitietnguoidung/'.$id);
		}else{
			header('Location: '.PATH.'/nguoidung/taikhoandangnhap/'.$_SESSION['user_id']);
		}
	}

	//return: Danh sach người dùng hệ thống
	//parameter: Trang hiện tại
	public function dsnguoidung($pagenum = null){
		$this->paginate($result,$tongsotrang,$trangso,$search,$pagenum);
		$this->view->result = $result;
		$this->view->tongsotrang = $tongsotrang;
		$this->view->trangso = $trangso;		
		$this->view->search = $search;
		return $this->view->render('nguoidung/danhsachnguoidung');
	}
	// Return: Danh sach người dùng, su dung ajax
	////parameter: Trang hiện tại
	public function dsnguoidungjax($pagenum = null){
		
		$this->paginate($result,$tongsotrang,$trangso,$search,$pagenum);
		$this->view->result = $result;
		$this->view->tongsotrang = $tongsotrang;
		$this->view->trangso = $trangso;		
		$this->view->search = $search;
		return $this->view->render('nguoidung/danhsachnguoidung',false);		
	}

	//tim tong so luong trang,
	//Chức năng phân trang trong danh sách người dùng
	public function paginate(&$re,&$tsotrang,&$ttrangso,&$tsearch,$pagenum = null){
		if(isset($_SESSION['user_id'])){	
			if(count($pagenum)>0){
				$trangso = $pagenum[0];			
			}
			else {
				$trangso = 0;
			}
			if(isset($pagenum[1]))
					$search = '%'.$pagenum[1].'%';
				else 
					$search = '%';
			//$thietbi = new Model_thietbi();
			$nguoidung = new Model_nguoidung();
			//$tongbantin = $thietbi->count($search)[0]->t;
			if($_SESSION['user_vaitro'] < 0){
				// $tongbantin = count($thietbi->thucthi('select * from thietbi where nhom_id like "'.$search.'" and nguoidung_id = '.$_SESSION['user_id']. ' or nguoidung_id is null'));	
				//chuyển về trang thông tin người dùng
				header('Location:'. PATH.'/nguoidung/trangdangnhap/');
			}else{
				// $tongbantin = count($thietbi->thucthi('select * from thietbi where nhom_id like "'.$search .'"'));
				$tongbantin = count($nguoidung->thucthi('select * from nguoidung where Hoten like "'.$search .'"'));
			}	

			if($tongbantin%num == 0){
				$tongsotrang = (int)($tongbantin/num);
			}else {
				$tongsotrang = (int)($tongbantin/num) + 1;
			}			
			$skip = $trangso*num;
			//$result = $thietbi->danhsachthietbi($skip,3,$search);
			if($_SESSION['user_id'] == 1){//quyen admin	
				$query = 'select * from nguoidung where Hoten like "'.$search .'" limit '. $skip .','.num;
			}else{
	
				header('Location:'. PATH.'/nguoidung/trangdangnhap/');
			}
			//echo $result;
			$result = $nguoidung->thucthi($query);
			$re = $result;
			$tsotrang = $tongsotrang;
			$ttrangso = $trangso;		
			$tsearch = $search;
		}else	{
			header('Location:'. PATH.'/nguoidung/trangdangnhap/');		
		}
	}

	//popup thêm người dùng
	// Trả về form thêm người dùng
	public function viewthemnguoidung(){
		if(isset($_SESSION['user_id']) && ($_SESSION['user_vaitro']>0)){
			$this->view->render('popup/popthemnguoidung',false);	
		}		
	}
	//Xác nhận thêm mới người dùng
	public function themmoi(){
		if(isset($_SESSION['user_id']) && ($_SESSION['user_vaitro']>0)){
			$mail = $_POST['nametxt_email'];
			$matkhau = '1234@1234';
			$hoten = 'nguoi dung moi';
			$chucvu = 'nhân viên';
			$vaitro = -1;
			$query = 'insert into nguoidung (email, matkhau, Hoten, chucvu, vaitro) '.
					'values ("'.$mail.'","'.$matkhau.'","'.$hoten.'","'.$chucvu.'",'.$vaitro.')';
			$nguoidung = new Model_nguoidung();
			$nguoidung->thucthi($query);
//			$this->view->render('popup/popthemnguoidung',false);	
		}			
	}
}
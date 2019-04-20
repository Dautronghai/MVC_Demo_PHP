<?php include_once 'models/thietbi.php';
include_once 'models/nhomthietbi.php';
include_once 'models/nhatkithietbi.php';
/**
* 
*/
class Controller_thietbi extends Libs_Controller
{
	
	function __construct()
	{
		Parent::__construct();
	}
	//Trang thêm mới đối tượng
	public function Themmoidoituong(){
		if($_SESSION['user_vaitro'] >= 0){		
			$this->view->capnhat= 'capnhat';	
			return $this->view->render('thietbi/adminthongtinchitiet');	
		}
		else {
			header('Location:'. PATH .'/nguoidung/taikhoandangnhap/'.$_SESSION['user_id']);	
		}
	}
	//Thực hiện Thêm mới thiết bị
	public function themdoituong_submit(){
		if($_SESSION['user_vaitro'] >= 0){		
			$thietbi = new Model_thietbi();
			if(isset($_FILES['file_hinh'])){
				if($_FILES['file_hinh']['error'] > 0){				
					$hinhdaidien = $_POST['txt_hinhdaidien'];
				}else
				{		
					$root = explode('\\',dirname(__FILE__));
					array_pop($root);
					$dir = implode('\\',$root);
					
					$typee = '.'.explode('/',$_FILES['file_hinh']['type'])[1];
					$tenfile = ($this->vietnamenglish($_POST["tenthietbi"])).$typee;
					if(move_uploaded_file($_FILES['file_hinh']['tmp_name'],$dir.'\media\hinhanh\\'.$tenfile)){
						$hinhdaidien = $tenfile;
					}
					else{
						$hinhdaidien = $_POST['txt_hinhdaidien'];
					}
				}
			}
			
			$query = 'insert into thietbi (tenthietbi,hangsanxuat,motachung,nhom_id,nguoidung_id,tg_batdaudung,tinhtrang_id,hinhdaidien,vitridat) values ("'.
				$_POST["tenthietbi"].'","'.$_POST["hangsanxuat"].'","'.
				trim($_POST["txt_motachung"]).'",'.$_POST["cbo_nhomtb"].','.
				$_POST["cbo_nguoidungthietbi"].',"'.$_POST["dta_ngaysudung"].'",'.
				$_POST["cbo_tinhtrangthietbi"].',"'.$hinhdaidien.'","'.
				$_POST["txt_vitridat"].'")';
			//echo $query;
			// $this->view->query =  $query;
			// return $this->view->render('popup/popuptinhtrang');
			$thietbi->thucthi($query);
			$newid = $thietbi->thucthi("select max(id) as m from thietbi")[0]->m;
			$nhatki = new Model_nhatkithietbi();
			$nhatki->addnhatkithietbi($newid,'thêm mới thiết bị: ');			
			//$this->thongtinchitiettb($newid);
			header('Location:'. PATH .'/thietbi/thongtinchitiettb/'.$newid);			
		}else {
			header('Location:'. PATH .'/nguoidung/taikhoandangnhap/'.$_SESSION['user_id']);	
		}
	}
	//Cập nhật thông tin thiết bị
	//Đối số: id thiết bị
	public function adminthongtinchitiet_submit($id){
		$thietbi = new Model_thietbi();			

		if(isset($_FILES['file_hinh'])){
			if($_FILES['file_hinh']['error'] > 0){				
				$hinhdaidien = $_POST['txt_hinhdaidien'];
			}else
			{		
				$root = explode('\\',dirname(__FILE__));
				array_pop($root);
				$dir = implode('\\',$root);
				
				$typee = '.'.explode('/',$_FILES['file_hinh']['type'])[1];
				$tenfile = ($this->vietnamenglish($_POST["tenthietbi"])).$typee;
				if(move_uploaded_file($_FILES['file_hinh']['tmp_name'],$dir.'\media\hinhanh\\'.$tenfile)){
					$hinhdaidien = $tenfile;
				}
				else{
					$hinhdaidien = $_POST['txt_hinhdaidien'];
				}
			}
		}
		$old =(array)$thietbi->thucthi('select * from thietbi where id ='.$id[0])[0];			
		//echo 'select * form thietbi where id ='.$id[0];
		$query = 'update thietbi '.
				'set tenthietbi = "'.$_POST["tenthietbi"].
				'", hangsanxuat = "'.$_POST["hangsanxuat"].
				'", motachung = "'. trim($_POST["txt_motachung"]).
				'", nhom_id = '.$_POST["cbo_nhomtb"] .
				', nguoidung_id = '. $_POST["cbo_nguoidungthietbi"]. 
				', tg_batdaudung = "'. $_POST["dta_ngaysudung"].
				'", tinhtrang_id = '. $_POST["cbo_tinhtrangthietbi"].
				', hinhdaidien = "'.$hinhdaidien. 
				'", vitridat = "'. $_POST["txt_vitridat"]. 
				'" WHERE id = '. $id[0];
		// $this->view->query =  $query;
		// return $this->view->render('popup/popuptinhtrang');
		$thietbi->thucthi($query);
		$new =(array)$thietbi->thucthi('select * from thietbi where id ='.$id[0])[0];
		//$a = array_merge($old, $new);
		$b = array_diff($old, $new);
		$update='Cập nhật thông tin: ';
		foreach ($b as $key=>$value) {			
			$t = $key.' : '. $value.', ';
			$update.=$t;
		}

		$nhatki = new Model_nhatkithietbi();
		$nhatki->addnhatkithietbi($id[0],$update);
		//$this->thongtinchitiettb($id);
		//$this->thongtinchitiettb($id);
		header('Location:'. PATH .'/thietbi/thongtinchitiettb/'.$id[0]);
	}
	//include Select nhom thiet bi
	public function cbo_nhomthietbi($checkid){
		$thietbi = new Model_nhomthietbi();
		$this->view->dsnhom = $thietbi->danhsachnhomthietbi();
		$this->view->idchecked = $checkid[0];
        return $this->view->render('nhomthietbi/cbonhomthietbi',false);
	}

	//Danh sach nhom thiet bi
	//return: tag: select option.
	public function dsNhomthietbi(){
		$thietbi = new Model_nhomthietbi();
		$kq = $thietbi->danhsachnhomthietbi();
		$view = '<label>Nhóm thiết bị: </label>'.
                '<select id="id_nhomtb" name="nhomtb" class="form-control" >'.
                '<option value=""> Tat Ca </option>';
                            foreach ($kq as $key => $value) {
                            	$view.= '<option value="'.$value->id.'">'.$value->tennhom .'</option>';
                            }
        $view.= '</select>';
        return $view;
	}
	//return: Danh sach thiet bi
	//đối số: Trang hiện tại và id nhóm của thiết bị
	public function dsthietbi($pagenum = null){
		$this->paginate($result,$tongsotrang,$trangso,$search,$pagenum);
		$this->view->result = $result;
		$this->view->tongsotrang = $tongsotrang;
		$this->view->trangso = $trangso;		
		$this->view->search = $search;
		return $this->view->render('thietbi/danhsachthietbi');
	}
	// Return: Danh sach thiet bi, su dung ajax
	//đối số: Trang hiện tại và id nhóm của thiết bị
	public function dsthietbiajax($pagenum = null){
		
		$this->paginate($result,$tongsotrang,$trangso,$search,$pagenum);
		$this->view->result = $result;
		$this->view->tongsotrang = $tongsotrang;
		$this->view->trangso = $trangso;		
		$this->view->search = $search;
		if($_SESSION['user_vaitro'] >= 0){

			return $this->view->render('thietbi/danhsachthietbi',false);}
		else {			
			return $this->view->render('thietbi/danhsachthietbi',false);	
		}
		
	}

	//tim tong so luong trang,
	//PHân trang
	public function paginate(&$re,&$tsotrang,&$ttrangso,&$tsearch,$pagenum = null){
		if(isset($_SESSION['user_id'])){	
			if(count($pagenum)>0){
				$trangso = $pagenum[0];			
			}
			else {
				$trangso = 0;
			}
			if(isset($pagenum[1]))
					$search = $pagenum[1];
				else 
					$search = '%';
			$thietbi = new Model_thietbi();
			//$tongbantin = $thietbi->count($search)[0]->t;
			if($_SESSION['user_vaitro'] < 0){
				$tongbantin = count($thietbi->thucthi('select * from thietbi where nhom_id like "'.$search.'" and nguoidung_id = '.$_SESSION['user_id']. ' or nguoidung_id is null'));	
			}else{
				$tongbantin = count($thietbi->thucthi('select * from thietbi where nhom_id like "'.$search .'"'));
			}	

			if($tongbantin%num == 0){
				$tongsotrang = (int)($tongbantin/num);
			}else {
				$tongsotrang = (int)($tongbantin/num) + 1;
			}			
			$skip = $trangso*num;
			//$result = $thietbi->danhsachthietbi($skip,3,$search);
			if($_SESSION['user_id'] == 1){//quyen admin
				$query = 'select * from thietbi where nhom_id like "'.$search .'" limit '. $skip .','.num;
			}else{
				$query = 'select * from thietbi where  nguoidung_id is null or nguoidung_id = '.$_SESSION['user_id'].'  and nhom_id like "'.$search .'" limit '. $skip .','.num;
			}
			//echo $result;
			$result = $thietbi->thucthi($query);
			$re = $result;
			$tsotrang = $tongsotrang;
			$ttrangso = $trangso;		
			$tsearch = $search;
		}else	{
			header('Location:'. PATH.'/nguoidung/trangdangnhap/');		
		}
	}
	//Thông tin chi tiết của thiết bị.
	//Parameter: id thiết bị
	public function thongtinchitiettb($id){
		$thietbi = new Model_thietbi();
		$query = 'select tb.*, ndtb.hoten as hoten, ntb.tennhom as tennhom, trtb.tinhtrang as tinhtrang '.
			'from thietbi as tb left join nhomthietbi as ntb on tb.nhom_id = ntb.id '.
				'left join tinhtrangthietbi as trtb on tb.tinhtrang_id = trtb.id  '.
    			'left join nguoidung as ndtb on tb.nguoidung_id = ndtb.id '.
				'where tb.id = '.$id[0];
		//$kq = $thietbi->thongtinchitiet($query);
		$kq = $thietbi->thucthi($query);
		//echo $kq;
		$this->view->infor = $kq;		
		if($_SESSION['user_vaitro'] >= 0){		
			$this->view->capnhat= 'capnhat';	
			return $this->view->render('thietbi/adminthongtinchitiet');	
		}else {
			return $this->view->render('thietbi/thongtinchitet');	
		}
	}
	
}
 ?>
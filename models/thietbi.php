<?php 
/**
* 
*/
class Model_thietbi extends Libs_Model
{
	
	function __construct()
	{
		Parent::__construct();
	}
	//Dem so luong thiet bi cua mot nhom
	//parameter: id_nhom
	//return so luong thiet bi cua nhom
	public function count($nhom){
		$this->db->connect();
		$query = 'select count(*) as t from thietbi where `nhom_id` like "'. $nhom .'"';
		$list = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $list;
	}
	/* Danh sach thiet bi
	*	parameter: $skip: vi tri bat dau lay cua thiet bi, $take: so luong dong can lay, $search: ma nhom
	*/
	public function danhsachthietbi($skip,$take,$search){
		//session_start(); 
		if(isset($_SESSION['user_id'])){
			$this->db->connect();
			$query = 'select * from thietbi where nhom_id like "'.$search .'" limit '. $skip .','.$take;
			//return $query; 
			$list = $this->db->executeQuery($query);
			$this->db->disconnect();
			return $list;			
		}else	{
			header('Location:'. PATH.'/nguoidung/trangdangnhap/');
				//window.location.href = "nguoidung/trangdangnhap/";
		}
		
	}
	//Thuc thi query
	public function thucthi($query){	
		$this->db->connect();
		//$query = 'select * from thietbi where nhom_id like "'.$search .'" limit '. $skip .','.$take;
		//return $query; 
		$list = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $list;			
	}

	/* thong tin chi tet cua thiet bi
	* parameter: $id: ma thiet bi
	*/
	public function thongtinchitiet($id)
	{
		$this->db->connect();
		$query = 'select tb.*, ndtb.hoten as hoten, ntb.tennhom as tennhom, trtb.tinhtrang as tinhtrang '.
			'from thietbi as tb left join nhomthietbi as ntb on tb.nhom_id = ntb.id '.
				'left join tinhtrangthietbi as trtb on tb.tinhtrang_id = trtb.id  '.
    			'left join nguoidung as ndtb on tb.nguoidung_id = ndtb.id '.
				'where tb.id = '.$id[0];
		//return $query; 
		$list = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $list;
	}
}
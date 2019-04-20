<?php
/**
* 
*/
class Model_nhatkithietbi extends Libs_Model
{
	
	function __construct()
	{
		Parent::__construct();
	}
	public function xemnhatkithietbi($idthietbi){	
		$this->db->connect();
		$query = 'select * from nhatkithietbi where thietbi_id = '. $idthietbi[0];
		//return $query;
		$result = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $result;
	}
	public function addnhatkithietbi($id,$thongtin){
		if(isset($_SESSION['user_id'])){
			//$this->db->connect();
			$nguoidung = $this->thucthi('select * from nguoidung where id = '.$_SESSION['user_id'])[0];
			$thietbi = $this->thucthi('select * from thietbi where id = '.$id)[0];

			$thongtinsave = 'Người dùng: '.$nguoidung->Hoten.'-Email: '.$nguoidung->email. ' '.$thongtin. ' '. $thietbi->tenthietbi;
			$date = $this->mygetdate();
			$que = 'insert INTO nhatkithietbi(thietbi_id, thoigian, thongtinnhatki)'.
					'values ('. $id .',"'.$date.'","'. $thongtinsave.'")';
					//return $que;
			$this->thucthi($que);
			//$this->db->disconnect();
		//	return $result;	
		}
		
	}
	public function thucthi($query){	
		$this->db->connect();		
		$result = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $result;
	}
	

}
<?php
/**
* 
*/
class Model_nguoidung extends Libs_Model
{
	
	function __construct()
	{
		Parent::__construct();
	}
	public function thucthi($query){
		$this->db->connect();		
		$result = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $result;
	}
	public function dangnhap($mail,$pass){	
		$this->db->connect();
		$query = 'select * from (SELECT * FROM nguoidung WHERE email like "'.$mail.'") a where a.matkhau like "'. $pass.'"';	
		//echo $query;	
		$result = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $result;
	}
	public function timkiemuser($id){

		$this->db->connect();
		$query = 'select * from nguoidung WHERE id = '. $id[0];
		$result = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $result;
	}
}
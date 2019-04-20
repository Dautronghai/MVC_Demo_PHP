<?php 
/**
* 
*/
class Model_nhomthietbi extends Libs_Model
{
	
	function __construct()
	{
		Parent::__construct();
	}
	public function danhsachnhomthietbi(){
		$this->db->connect();
		$query = 'select * from nhomthietbi';
		$list = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $list;
	}
	public function thucthi($query){
		$this->db->connect();		
		$list = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $list;	
	}
}
<?php 
/**
* 
*/
class Model_tinhtrangthietbi extends Libs_Model
{
	
	function __construct()
	{
		Parent::__construct();
	}
	public function thucthi($query){
		$this->db->connect();		
		$list = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $list;
	}
	public function cbotinhtranghietbi(){
		$this->db->connect();
		$query = 'select * from tinhtrangthietbi';
		$list = $this->db->executeQuery($query);
		$this->db->disconnect();
		return $list;
	}
}
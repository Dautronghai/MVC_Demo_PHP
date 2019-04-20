<?php 
/**
* 
*/
class Model_Doccument extends Libs_Model
{
	
	function __construct()
	{
		Parent::__construct();
	}
	public function getAllDoccument(){
		$this->db->connect();	
		$listdocument = $this->db->executeQuery('select * from documents');
		$this->db->disconnect();
		return $listdocument;
	}
}
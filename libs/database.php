<?php 
/**
* 
*/
class Libs_Database
{
	private $conn;
	public function __construct()
	{		
	}
	
	/*Ham kiem tra ket noi du lieu
	*/
	public function connect(){		
		
	 	//mysqli_connect(BD_HOST,BD_USER,BD_PASS,BD_DATA);		 	
		if(@mysqli_connect(BD_HOST, BD_USER, BD_PASS)){			
			$this->conn = @mysqli_connect(BD_HOST, BD_USER, BD_PASS);
			@mysqli_query("SET NAMES 'UTF8'");
			if(!mysqli_select_db($this->conn,BD_DATA)){				
				die('Khong the ket noi toi co so du lieu');
			}
		}
		else {

			die('Khong the ket noi serve');
		}
	}
	/* Ham thuc thi chuoi truy van
	*/
	public function executeQuery($quer){		
		@mysqli_query("SET NAMES 'UTF8'");
		$list = new ArrayObject();		//Danh sach tam luu tru ket qua tra ve
		//$this->conn = @mysqli_connect(BD_HOST, BD_USER, BD_PASS);
		$result = @mysqli_query($this->conn,$quer);//thuc thi chuoi truy van
		//var_dump($result);	

		if(mysqli_num_rows($result) > 0){//Neu co ket qua truy van		
		
			while($row = @mysqli_fetch_object($result)){
				$list->append($row);
			}
		}		
		return $list;
	}
	/*Thuc hien ngat ket noi khi thuc hien xong truy van tranh viec tran bo dem*/
	public function disconnect(){
		mysqli_close($this->conn);
	}
}
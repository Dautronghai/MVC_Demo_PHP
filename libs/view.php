<?php 
/**
* 
*/
class Libs_View
{
	
	public  function __construct()
	{
		
	}
	/*Ham render thuc hien include cac thanh phan cua trang.
	*/
	public function render($name,$inc = true){
		if($inc){
			
			include_once 'views/banner.php';
			include_once 'views/'.$name .'.php';
			include_once 'views/footer.php';
		}else {
			include_once 'views/'.$name .'.php';
		}
	}
}
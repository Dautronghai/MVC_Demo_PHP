<?php 
/**
* 
*/
//class Libs_Bootstrap
class Libs_routeconfig
{
	/*Lop khoi tao
	* Thuc thi cac action tu controller duoc lay tu URL.
	*/
	public function __construct()
	{
		$this->delegate();
	}
	/* Hàm parseUrl trả về tên controller, tên action
	* Tham bien controller, action
	*/
	public function parseUrl(&$controller,&$action,&$param=null){	
		if (isset($_GET['url'])) {		
			$arr_url = explode('/', rtrim($_GET['url'],'/'));
			if(file_exists('controllers/'.$arr_url[0].'.php')){												
				$controller = $arr_url[0];
				array_shift($arr_url);
			}else {				
				$controller='Index';
				$action='index';
			}			
			if(isset($arr_url[0])){				

				$classname = 'Controller_'.$controller;
				include_once 'controllers/'.$controller.'.php';
				$class = new $classname();
				//Kiem tra action $arr_url[0] co trong controller $class hay khong?
				if(is_callable(array($class, $arr_url[0]))){					
					$action = $arr_url[0];
					array_shift($arr_url);
				}else {//Neu khong co thi gan mac dinh la action index								
					$action = 'index';
				}
				if(count($arr_url)>0){//Neu action co su dung tham so thi can truyen vao tham so
					$param = $arr_url;
				}
			} else {
				$action = 'index';
			}
		}else {			
			 $controller = 'Index';
			 $action = 'index';
		}
	}
	/*Ham delegate
	* Ham nay thuc hien viec khoi tao lop controller va thuc thi cac action trong controller
	* Ten controller va action duoc lay tu tham bien truyen vao ham parseUrl.
	*/
	public function delegate(){
		$this->parseUrl($controller,$action,$param);				
		$nameClass = 'Controller_'.$controller;
		//echo 	':::ten: '. $action. '//';
		include_once 'Controllers/'.$controller.'.php';					
		$controller = new $nameClass();//Khoi tao lop controller de thuc hien action
		$controller->$action($param);
		
	}
}
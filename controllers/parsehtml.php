<?php 
include_once 'libs/simple_html_dom.php';
class Controller_parsehtml extends Libs_Controller
{
	public function __construct()
	{
		Parent::__construct();
	}
	public function index(){		
		$page1 = file_get_html('https://www.trumtuvung.com/bo-tu-vung-anh-van-giao-tiep-trung-cap/page-1');
		foreach ($page1->find('.service-item') as $key) {
			echo $key->innertext;
		}
	}
}
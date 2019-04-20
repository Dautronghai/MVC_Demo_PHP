<?php 
	//session_start(); 
	if(isset($_SESSION['user_id'])){
		header('Location:'. PATH .'/nguoidung/taikhoandangnhap/'.$_SESSION['user_id']);				
	}else	{
		header('Location:'. PATH.'/nguoidung/trangdangnhap/');
			//window.location.href = "nguoidung/trangdangnhap/";
	}
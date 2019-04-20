<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MVC in PHP</title>
	<!-- <link rel="stylesheet" href="/media/bootstrap.min.css" type="text/css"> -->
	<script src="<?php echo PATH; ?>/media/jquery.js" type="text/javascript" charset="utf-8" async defer></script>

	<link rel="stylesheet" href="<?php echo PATH; ?>/media/style/style.css" type="text/css">
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" type="text/css">
	
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>

	<script src="<?php echo PATH; ?>/media/jquery.js" type="text/javascript" charset="utf-8" async defer></script>
	<!--script src="/media/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script-->
	
</head>
<body>
	<div class='waraper'>		
		<header>
			<div class="banner">
				<img src="https://scontent.fdad3-2.fna.fbcdn.net/v/t1.0-9/18446514_1097530660379024_1534564777597992161_n.jpg?oh=a16ae6e87d131af764dc0448015bf044&oe=59B31D76" alt="">
			</div>
			<nav>
			<label for="show-menu" class="show-menu">Show Menu</label>
			<input type="checkbox" id="show-menu" role="button">
				<ul id="menu">
					<li><a href="<?php echo PATH; ?>/" title="">TRANG CHỦ</a></li>
					<li><a href="<?php echo PATH; ?>/thietbi/dsthietbi/" title="trang quản lý thiết bị">QL/THIẾT BỊ</a></li>

					<li><a href="<?php echo PATH; ?>/nguoidung/dsnguoidung" title="trang quản lý người dùng">QL/NGƯỜI DÙNG</a></li>
					<li><a href="<?php echo PATH; ?>/doccument/" title="trang tài liệu cá nhân">CV</a></li>
					<!-- <li><a href="<?php echo PATH; ?>/building/" title="quá trình xây dựng ứng dụng">ỨNG DỤNG</a></li> -->
					
				</ul>
			</nav>
		</header><!-- /header -->		
		<div class="contents">
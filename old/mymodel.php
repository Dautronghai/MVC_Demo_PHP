<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Model</title>
</head>

<body>
<?php
	function dbconnect() 
	{ 
	static $connect = null; 
	if ($connect === null) { 
		$connect = mysql_connect('localhost', 'root', ''); 
		mysql_select_db('db_mvc'); 
	} 
	return $connect; 
	} 
	
	function get_news($news_id) 
	{ 
	$news_req = mysql_query("SELECT * FROM news WHERE news_id='$news_id'",dbconnect()); 
	return mysql_fetch_array($news_req); 
	} 

	function get_comments($news_id) 
	{ 
		$comment_req = mysql_query("SELECT * FROM commentaires WHERE news_id='$news_id'",dbconnect()); 
		$result = array(); 
		while ($comment = mysql_fetch_array($comment_req)) { 
			$result[] = $comment; 
		} 
		return $result; 
	} 
	
	function insert_comment($comment) 
	{ 
		mysql_query("INSERT INTO commentaires SET news_id='".$comment['news_id']."', auteur='".$comment['auteur']."', texte='".$comment['texte']."', date=NOW()" ,dbconnect()); 
	} 



?>
</body>
</html>

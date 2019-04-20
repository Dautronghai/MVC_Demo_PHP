<?php 
$connect = mysql_connect('localhost', 'root', ''); 
mysql_select_db('db_mvc'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $news_id = $_POST['news_id']; 
    mysql_query("INSERT INTO commentaires SET news_id='$news_id', 
                                              auteur='".mysql_escape_string($_POST['auteur'])."', 
                                              texte='".mysql_escape_string($_POST['texte'])."', 
                                              date=NOW()" 
               ); 
    header("location: ".$_SERVER['PHP_SELF']."?news_id=$news_id"); 
    exit; 
} else { 
    $news_id = $_GET['news_id']; 
} 
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Demo MVC</title>
</head>

<body> 
    <h1>Tin tức</h1> 
    <div id="news"> 
        <?php 
        $news_req = mysql_query("SELECT * FROM news WHERE news_id='$news_id'"); 
        $news = mysql_fetch_array($news_req); 
        ?> 
    <h2><?php echo $news['titre'] ?> - <?php echo $news['date'] ?></h2> 
    <p><?php echo $news['texte_nouvelle'] ?> </p> 
        <?php 
        $comment_req = mysql_query("SELECT * FROM commentaires WHERE news_id='$news_id'"); 
        $nbre_comment = mysql_num_rows($comment_req); 
        ?> 
    <h3><?php echo $nbre_comment ?> Bình luận mới về điều này</h3> 
        <?php while ($comment = mysql_fetch_array($comment_req)) {?> 
            <h3><?php echo $comment['auteur'] ?> a écrit le <?php echo $comment['date'] ?></h3> 
            <p><?php echo $comment['texte'] ?></p> 
        <?php } ?> 
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="ajoutcomment"> 
        <input type="hidden" name="news_id" value="<?php echo $news_id ?>"> 
        <input type="text" name="auteur" value="Tên bạn" size="35"><br /> 
        <textarea name="texte" rows="5" cols="30">Nội dung bình luận</textarea><br /> 
        <input type="submit" name="submit" value="Gởi bình luận"> 
    </form> 
    </div> 
    </body> 
</html> 
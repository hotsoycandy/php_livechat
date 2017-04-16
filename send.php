<?php
    include("dbcon.php");
    if(isset($_POST['text'])&&isset($_POST['name'])){
        $text = $_POST['text'];
        $name = $_POST['name'];
    }else{
        exit("<script>alert('비정상접근'); location.replace('index.php');</script>");
    }
    $text = str_replace("<","&#60",$text);
    $text = str_replace(">","&#62",$text);
    $text = str_replace("'","&#39",$text);
    $text = str_replace('"',"&#34",$text);
    $name = str_replace("<","&#60",$name);
    $name = str_replace(">","&#62",$name);
    $name = str_replace("'","&#39",$name);
    $name = str_replace('"',"&#34",$name);
    $sql = "INSERT INTO chat SET text='{$text}', name='{$name}', wdate=now()";
    $db->query($sql);
?>
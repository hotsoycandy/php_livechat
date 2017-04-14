<?php
    include("dbcon.php");
    $text = $_POST['text'];
    $name = $_POST['name'];
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
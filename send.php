<?php
    include("dbcon.php");
    $text = $_POST['text'];
    $name = $_POST['name'];
    $text = str_replace($text,"<","&#60");
    $text = str_replace($text,">","&#62");
    $text = str_replace($text,"'","&#39");
    $text = str_replace($text,'"',"&#64");
    $name = str_replace($name,"<","&#60");
    $name = str_replace($name,">","&#62");
    $name = str_replace($name,"'","&#39");
    $name = str_replace($name,'"',"&#64");
    $sql = "INSERT INTO chat SET text='{$text}', name='{$name}', wdate=now()";
    $db->query($sql);
?>
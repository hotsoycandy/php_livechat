<?php
    include("dbcon.php");
    $text = $_POST['text'];
    $name = $_POST['name'];
    $sql = "INSERT INTO chat SET text='{$text}', name='{$name}', wdate=now()";
    $db->query($sql);
?>
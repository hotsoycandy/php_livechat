<?php
    include("dbcon.php");
    if(empty($user = $_POST['user'])){
        exit("<script>location.replace('index.php');</script>");
    }
    $sql = "SELECT * FROM user WHERE username='{$user}'";
    $rs = $db->query($sql);
    if($rs->rowcount()>0){
        $sql = "UPDATE user SET usertime=now() WHERE username='{$user}'";
        $db->query($sql);
    }else{
        $sql = "INSERT INTO user SET username='{$user}', usertime=now()";
        $db->query($sql);
    }
    date_default_timezone_set("Asia/Seoul");
    $now = date('Y-m-d G:i:s',time()-5);
    $sql = "SELECT * FROM user WHERE usertime > '{$now}'";
    $rs = $db->query($sql);
    $list='';
    foreach($rs as $row){
        $list .= "<li>{$row['username']}</li>";
    }
    $sql = "DELETE FROM user WHERE usertime < '{$now}'";
    $rs = $db->query($sql);
    echo $list;
?>
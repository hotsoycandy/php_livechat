<?php
    include('dbcon.php');
    $final = "now()";
    if($_GET['final']!=0){
        $final = "'".$_GET['final']."'";
    }
    while(1){
        $sql = "SELECT * FROM chat WHERE wdate > {$final} order by wdate asc limit 1";
        $rs = $db->query($sql);
        if($rs->rowcount()>0){
            echo json_encode($rs->fetch());
            break;
        }
        usleep(100000);
    }
?>
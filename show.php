<?php
    include('dbcon.php');
    if(isset($_POST['final'])){
        $final = "'".$_POST['final']."'";
    }else{
        exit("<script>alert('비정상접근'); location.replace('index.php');</script>");
    }
    while(1){
        $sql = "SELECT * FROM chat WHERE wdate > {$final} order by wdate desc limit 1";
        $rs = $db->query($sql);
        if($rs->rowcount()>0){
            echo json_encode($rs->fetch());
            break;
        }
        usleep(100000);
    }
?>
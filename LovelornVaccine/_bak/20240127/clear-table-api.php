<?php
    $p_TableType = $_POST["TableType"];

    require_once "connect-db-api.php";

    $sql="";
    switch($p_TableType)
    {
        case "1": $sql="TRUNCATE TABLE student;"; break;
        case "2": $sql="TRUNCATE TABLE member;"; break;
        case "3": $sql="TRUNCATE TABLE active;"; break;
        case "4": $sql="TRUNCATE TABLE popular;"; break;
        case "5": $sql="TRUNCATE TABLE passive;"; break;
        case "6": $sql="TRUNCATE TABLE result;"; break;
        case "99": $sql="TRUNCATE TABLE student; TRUNCATE TABLE member; TRUNCATE TABLE active;TRUNCATE TABLE popular;TRUNCATE TABLE passive;TRUNCATE TABLE result;"; break;
        //default:  $p_ClearTable="未選擇"; break;
    }

    //$sql = "TRUNCATE TABLE projectLove.'$p_ClearTable'";
   // echo $sql;

    if(mysqli_query($conn, $sql)){
        echo '{"state":true, "message":"清空資料表成功"}';
    }else{
        echo '{"state":false, "message":"清空資料表失敗'.$sql.mysqli_errno($conn).'"}';
    }

    mysqli_close($conn);
?>
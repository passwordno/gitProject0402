<?php
    // 資料庫
    $serverNmae ="localhost";
    $userName = "owner01";
    $password ="123456";
    $dbName = "projectLove";

    // 建立連線
    $conn = mysqli_connect($serverNmae, $userName, $password, $dbName);

    // 確認連線
    if(!$conn)
        die("連線錯誤!".mysqli_connect_error());
    else
        echo "連線成功";

    // 更改active回初始狀態
    $sql="UPDATE active
    SET Possibly = 'Y', State = 'N';
    ";
    
    mysqli_query($conn, $sql);

    // 更改passive回初始狀態
    $sql="UPDATE passive
    SET Possibly = 'Y', State = 'N';
    ";
    
    mysqli_query($conn, $sql);

    // 更改student flag回初始狀態
    $sql="UPDATE student
    SET Flag = NULL, PassiveCount = NULL, ActiveCount = NULL;
    ";
    
    mysqli_query($conn, $sql);

    echo '{"state":true, "message":"更新update-repair資料成功"}';
    // if(mysqli_query($conn, $sql)){
    //     echo '{"state":true, "message":"清空資料表成功"}';
    // }else{
    //     echo '{"state":false, "message":"清空資料表失敗'.$sql.mysqli_errno($conn).'"}';
    // }
    mysqli_close($conn);
?>
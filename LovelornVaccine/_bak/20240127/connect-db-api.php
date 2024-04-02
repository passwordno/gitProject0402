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
    // else
    //     echo "連線成功";
?>
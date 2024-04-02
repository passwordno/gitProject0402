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

    // 查詢互相為第一的結果，儲存進入result
    $sql="INSERT INTO result (LaunchID, ObjectID, flag)
        SELECT a.LaunchID, a.ObjectID, 1
        FROM active a, active b 
        WHERE a.Grade = 1 
        AND b.Grade = 1 
        AND a.LaunchID = b.ObjectID 
        AND a.ObjectID = b.LaunchID 
        AND a.Possibly = 'Y' 
        AND b.Possibly = 'Y';
    ";
    
    mysqli_query($conn, $sql);
    
    // 將查詢後的性別放入，被告白者性別根據告白者性別相反放入，若不是M,F則放NULL(空值)
    $sqlGender="UPDATE result r
        JOIN student s ON r.LaunchID = s.StudentID
        SET r.LaunchGender = s.Gender,
        r.ObjectGender = CASE
            WHEN s.Gender = 'M' THEN 'F'
            WHEN s.Gender = 'F' THEN 'M'
            ELSE NULL
        END;
    ";

    mysqli_query($conn, $sqlGender);
    
    // 更新告白者姓名
    $sqlLName="UPDATE result r
    JOIN student s ON r.LaunchID = s.StudentID
    SET r.LaunchName = s.Name;
    ";
    
    mysqli_query($conn, $sqlLName);

    // 更新被告白者姓名
    $sqlOName="UPDATE result r
    JOIN student s ON r.ObjectID = s.StudentID
    SET r.ObjectName = s.Name;
    ";
    
    mysqli_query($conn, $sqlOName);

    // 更改Active配對狀態
    $sqlAState1="UPDATE active a
    JOIN result r ON a.LaunchID = r.LaunchID
    SET a.Possibly = 'N', a.State = 'Y';
    ";

    mysqli_query($conn, $sqlAState1);

    $sqlAState2="UPDATE active a
    JOIN result r ON a.ObjectID = r.ObjectID
    SET a.Possibly = 'N', a.State = 'Y';
    ";

    mysqli_query($conn, $sqlAState2);

    // 更改Passive配對狀態
    $sqlPState1="UPDATE passive p
    JOIN result r ON p.GeterID = r.ObjectID
    SET p.Possibly = 'N', p.State = 'Y';
    ";

    mysqli_query($conn, $sqlPState1);

    $sqlPState2="UPDATE passive p
    JOIN result r ON p.LaunchID = r.LaunchID
    SET p.Possibly = 'N', p.State = 'Y';
    ";

    mysqli_query($conn, $sqlPState2);

    echo '{"state":true, "message":"新增result-flag1資料成功"}';
    // if(mysqli_query($conn, $sql)){
    //     echo '{"state":true, "message":"清空資料表成功"}';
    // }else{
    //     echo '{"state":false, "message":"清空資料表失敗'.$sql.mysqli_errno($conn).'"}';
    // }
    mysqli_close($conn);
?>
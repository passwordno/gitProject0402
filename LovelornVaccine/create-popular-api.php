<?php

    require_once "connect-db-api.php";

    // 統計所有票數
    $sql="SELECT a.ObjectID, COUNT(*) Votes FROM active a group BY a.ObjectID";
    $result = mysqli_query($conn, $sql);
    $countData = mysqli_num_rows($result);
    if($countData>0)
    {
        while($row=$result->fetch_assoc())
        {
            $p_id = $row["ObjectID"];
            $p_num = $row["Votes"];
            $sqlAdd = "INSERT INTO popular (StudentID, Votes) VALUES ('$p_id', '$p_num')";
            mysqli_query($conn, $sqlAdd);
        }
    }

    // 將沒有得票的給於0的數字
    $sql ="SELECT s.StudentID, p.Votes FROM student s LEFT JOIN popular p on s.StudentID = p.StudentID WHERE p.Votes is null";
    $result = mysqli_query($conn, $sql);
    $countData = mysqli_num_rows($result);
    if($countData>0)
    {
        while($row=$result->fetch_assoc())
        {
            $p_id = $row["StudentID"];
            $sqlAdd = "INSERT INTO popular (StudentID, Votes) VALUES ('$p_id', 0)";
            mysqli_query($conn, $sqlAdd);
        }
    }

    echo '{"state":true, "message":"新增popular資料成功"}';
    // if(mysqli_query($conn, $sql)){
    //     echo '{"state":true, "message":"清空資料表成功"}';
    // }else{
    //     echo '{"state":false, "message":"清空資料表失敗'.$sql.mysqli_errno($conn).'"}';
    // }
    mysqli_close($conn);
?>
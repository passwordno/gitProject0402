<?php

    require_once "connect-db-api.php";

    // 統計所有票數
    $sql="SELECT * FROM active";
    $result = mysqli_query($conn, $sql);
    $countData = mysqli_num_rows($result);
    if($countData>0)
    {
        while($row=$result->fetch_assoc())
        {
            $p_ObjectID = $row["ObjectID"];
            $p_LaunchID = $row["LaunchID"];
            $sqlAdd = "INSERT INTO passive (GeterID, LaunchID, GetRank, Possibly, State) VALUES ('$p_ObjectID', '$p_LaunchID', -1, 'Y', 'N')";
            mysqli_query($conn, $sqlAdd);
        }
    }

    echo '{"state":true, "message":"新增passive資料成功"}';
    // if(mysqli_query($conn, $sql)){
    //     echo '{"state":true, "message":"清空資料表成功"}';
    // }else{
    //     echo '{"state":false, "message":"清空資料表失敗'.$sql.mysqli_errno($conn).'"}';
    // }
    mysqli_close($conn);
?>
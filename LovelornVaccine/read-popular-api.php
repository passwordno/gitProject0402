<?php
    require_once "connect-db-api.php";

    $sql = "SELECT s.Class, s.SetNo, s.StudentID , s.Name, s.Gender, p.Votes FROM student s JOIN popular p on s.StudentID = p.StudentID;";
    $result = mysqli_query($conn, $sql);
    $countData = mysqli_num_rows($result);
    $mydata = array();
    if($countData>0){
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        echo '{"state":true, "data":'.json_encode($mydata).', "message":"查詢資料成功!"}';
    }
    else{
        //echo "查無資料";
       echo '{"state":false, "message":"查詢資料失敗, 查無資料!"}';
    }
    mysqli_close($conn);
?>
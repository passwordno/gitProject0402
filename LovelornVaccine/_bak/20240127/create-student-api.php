<?php
    // {"別":"男", "因 1-1":"她會轉魔術方塊", "因 1-2":"她很聰明", "因 1-3":"", "因 2-1":"人很好", "因 2-2":"很聰明", "因 2-3":"", "因 3-1":"人好", "因 3-2":"聰明", "因 3-3":"", "因 4-1":"會轉魔術方塊", "因 4-2":"成績很好", "因 4-3":"", "因 5-1":"成績好", "因 5-2":"很冷靜", "因 5-3":"",  "因 6-1":"很適合聊天", "因 6-2":"英文好", "因 6-3":"", "姓名":"高翊恩", "姓名1":"曾于倢", "姓名2":"許硯涵", "姓名3":"陳雋月", "姓名4":"高勻庭", "姓名5":"趙沛璇", "姓名6":"簡培娜", "班":"1", "班1":"5",  "班2":"1", "班3":"1", "班4":"1", "班5":"1", "班6":"1", "號":"1", "號1":"26", "號2":"21", "號3":"23", "號4":"22", "號5":"27", "號6":"20"}

    //$p_Name = "高翊恩";
    //$p_Gender = "M";
    //$p_Class = "1";
    //$p_SetNo = "1";
    // $p_Type = "N";
    // $p_Addent ="Y";    


    $data = file_get_contents("php://input", "r");
     if($data !="")
     {
        $mydata = array();
        $mydata = json_decode($data, true);
        if(     isset($mydata["別"]) && 
                isset($mydata["姓名"]) && 
                isset($mydata["班"]) && 
                isset($mydata["號"]) &&                 
                ($mydata["別"]!="") &&
                ($mydata["姓名"]!="") &&
                ($mydata["班"]!="") &&
                ($mydata["號"]!=""))
        {
            $p_Name = $mydata["姓名"];
            $p_Gender = "M";
            if($mydata["別"]=="女")
                $p_Gender = "F";
            $p_Class = $mydata["班"];
            $p_SetNo = $mydata["號"];
            $p_Type = "N";
            $p_Addent ="Y";  
            $p_StudentID = "6000"+$p_Class*100+$p_SetNo;  

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

            // student
            $sql = "INSERT INTO student(Name, Gender, Class, SetNo, Type, Addent, StudentID) VALUES('$p_Name', '$p_Gender', '$p_Class', '$p_SetNo', '$p_Type', '$p_Addent', '$p_StudentID')";

            if(mysqli_query($conn, $sql)){
                echo '{"state":true, "message":"新增學生成功"}';
            }else{
                echo '{"state":false, "message":"新增學生失敗'.$sql.mysqli_errno($conn).'"}';
            }

            // member
            $sqlMember = "INSERT INTO member(StudentID)  VALUES ('$p_StudentID')";  

            if(mysqli_query($conn, $sqlMember)){
                echo '{"state":true, "message":"新增成員成功"}';
            }else{
                echo '{"state":false, "message":"新增成員失敗'.$sqlMember.mysqli_errno($conn).'"}';
            }

            // active

            
            mysqli_close($conn);
        }else{
            echo '{"state":false, "message":"傳遞參數格式錯誤"}';
        }

    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
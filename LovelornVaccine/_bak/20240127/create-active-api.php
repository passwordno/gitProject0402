<?php
    // {"別":"男", "因 1-1":"她會轉魔術方塊", "因 1-2":"她很聰明", "因 1-3":"", "因 2-1":"人很好", "因 2-2":"很聰明", "因 2-3":"", "因 3-1":"人好", "因 3-2":"聰明", "因 3-3":"", "因 4-1":"會轉魔術方塊", "因 4-2":"成績很好", "因 4-3":"", "因 5-1":"成績好", "因 5-2":"很冷靜", "因 5-3":"",  "因 6-1":"很適合聊天", "因 6-2":"英文好", "因 6-3":"", "姓名":"高翊恩", "姓名1":"曾于倢", "姓名2":"許硯涵", "姓名3":"陳雋月", "姓名4":"高勻庭", "姓名5":"趙沛璇", "姓名6":"簡培娜", "班":"1", "班1":"5",  "班2":"1", "班3":"1", "班4":"1", "班5":"1", "班6":"1", "號":"1", "號1":"26", "號2":"21", "號3":"23", "號4":"22", "號5":"27", "號6":"20"}

    $data = file_get_contents("php://input", "r");
     if($data !="")
     {
        $mydata = array();
        $mydata = json_decode($data, true);
        if(     
                isset($mydata["班"]) && 
                isset($mydata["號"]))
                
        {
            // 告白者
            $p_Class = $mydata["班"];
            $p_SetNo = $mydata["號"];
            $p_LaunchID = 6000+$p_Class*100+$p_SetNo;

            // 志願序01
            $p_Class01 = $mydata["班1"];
            $p_SetNo01 = $mydata["號1"];
            $p_Feature0101 = $mydata["因 1-1"];
            $p_Feature0102 = $mydata["因 1-2"];
            $p_Feature0103 = $mydata["因 1-3"];
            $p_ObjectID01 = 6000+$p_Class01*100+$p_SetNo01;
            $p_OtherClass01 = "N";
            if($p_Class != $p_Class01)
                $p_OtherClass01 = "Y";

            // 志願序02
            $p_Class02 = $mydata["班2"];
            $p_SetNo02 = $mydata["號2"];
            $p_Feature0201 = $mydata["因 2-1"];
            $p_Feature0202 = $mydata["因 2-2"];
            $p_Feature0203 = $mydata["因 2-3"];
            $p_ObjectID02 = 6000+$p_Class02*100+$p_SetNo02;
            $p_OtherClass02 = "N";
            if($p_Class != $p_Class02)
                $p_OtherClass02 = "Y";

            // 志願序03
            $p_Class03 = $mydata["班3"];
            $p_SetNo03 = $mydata["號3"];
            $p_Feature0301 = $mydata["因 3-1"];
            $p_Feature0302 = $mydata["因 3-2"];
            $p_Feature0303 = $mydata["因 3-3"];
            $p_ObjectID03 = 6000+$p_Class03*100+$p_SetNo03;
            $p_OtherClass03 = "N";
            if($p_Class != $p_Class03)
                $p_OtherClass03 = "Y";

            // 志願序04
            $p_Class04 = $mydata["班4"];
            $p_SetNo04 = $mydata["號4"];
            $p_Feature0401 = $mydata["因 4-1"];
            $p_Feature0402 = $mydata["因 4-2"];
            $p_Feature0403 = $mydata["因 4-3"];
            $p_ObjectID04 = 6000+$p_Class04*100+$p_SetNo04;
            $p_OtherClass04 = "N";
            if($p_Class != $p_Class04)
                $p_OtherClass04 = "Y";

            // 志願序05
            $p_Class05 = $mydata["班5"];
            $p_SetNo05 = $mydata["號5"];
            $p_Feature0501 = $mydata["因 5-1"];
            $p_Feature0502 = $mydata["因 5-2"];
            $p_Feature0503 = $mydata["因 5-3"];
            $p_ObjectID05 = 6000+$p_Class05*100+$p_SetNo05;
            $p_OtherClass05 = "N";
            if($p_Class != $p_Class05)
                $p_OtherClass05 = "Y";

            // 志願序06
            $p_Class06 = $mydata["班6"];
            $p_SetNo06 = $mydata["號6"];
            $p_Feature0601 = $mydata["因 6-1"];
            $p_Feature0602 = $mydata["因 6-2"];
            $p_Feature0603 = $mydata["因 6-3"];
            $p_ObjectID06 = 6000+$p_Class06*100+$p_SetNo06;
            $p_OtherClass06 = "N";
            if($p_Class != $p_Class06)
                $p_OtherClass06 = "Y";

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

            // active 
            $sql = "INSERT INTO active(LaunchID, ObjectID, Grade, GradeOrg, OtherClass, Possibly, Feature1, Feature2, Feature3, State) VALUES('$p_LaunchID', '$p_ObjectID01', '1', '1', '$p_OtherClass01', 'Y', '$p_Feature0101', '$p_Feature0102', '$p_Feature0103', 'N'), ('$p_LaunchID', '$p_ObjectID02', '2', '2', '$p_OtherClass02', 'Y', '$p_Feature0201', '$p_Feature0202', '$p_Feature0203', 'N'), ('$p_LaunchID', '$p_ObjectID03', '3', '3', '$p_OtherClass03', 'Y', '$p_Feature0301', '$p_Feature0302', '$p_Feature0303', 'N'), ('$p_LaunchID', '$p_ObjectID04', '4', '4', '$p_OtherClass04', 'Y', '$p_Feature0401', '$p_Feature0402', '$p_Feature0403', 'N'), ('$p_LaunchID', '$p_ObjectID05', '5', '5', '$p_OtherClass05', 'Y', '$p_Feature0501', '$p_Feature0502', '$p_Feature0503', 'N'), ('$p_LaunchID', '$p_ObjectID06', '6', '6', '$p_OtherClass06', 'Y', '$p_Feature0601', '$p_Feature0602', '$p_Feature0603', 'N')";

            if(mysqli_query($conn, $sql)){
                echo '{"state":true, "message":"新增志願序_step01成功"}';
            }else{
                echo '{"state":false, "message":"新增志願序_step02失敗'.$sql.mysqli_errno($conn).'"}';
            }

            // 刪除空白名單
            $sql = "DELETE FROM active WHERE ObjectID=6000";
            if(mysqli_query($conn, $sql)){
                echo '{"state":true, "message":"新增志願序_step02成功"}';
            }else{
                echo '{"state":false, "message":"新增志願序_step02失敗'.$sql.mysqli_errno($conn).'"}';
            }

            // passive
            

            mysqli_close($conn);
        }else{
            echo '{"state":false, "message":"傳遞參數格式錯誤"}';
        }

    }else{
        echo '{"state":false, "message":"未傳遞任何參數"}';
    }
?>
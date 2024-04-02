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

    // echo "連線成功";


    // // 被告白者只有一位告白者且依告白者順序優先
    // $sql="INSERT INTO result (LaunchID, ObjectID)
    // SELECT LaunchID, GeterID
    // FROM (
    //     SELECT LaunchID, MIN(GeterID) AS GeterID
    //     FROM passive
    //     WHERE Possibly = 'Y'
    //       AND GeterID IN (
    //         SELECT GeterID
    //         FROM passive
    //         WHERE Possibly = 'Y'
    //         GROUP BY GeterID
    //         HAVING COUNT(*) = 1
    //       )
    //     GROUP BY LaunchID
    // ) AS unique_records;
    // ";


    // // 被告白者剩餘最少告白者且依告白者順序優先
    // $sql="INSERT INTO result (LaunchID, ObjectID)
    // SELECT LaunchID, GeterID
    // FROM (
    //     SELECT LaunchID, GeterID,
    //            ROW_NUMBER() OVER (PARTITION BY GeterID ORDER BY RAND()) AS rn
    //     FROM (
    //         SELECT LaunchID, MIN(GeterID) AS GeterID
    //         FROM passive
    //         WHERE Possibly = 'Y'
    //           AND GeterID IN (
    //             SELECT GeterID
    //             FROM passive
    //             WHERE Possibly = 'Y'
    //             GROUP BY GeterID
    //             HAVING COUNT(*) = (
    //               SELECT MIN(cnt)
    //               FROM (
    //                 SELECT COUNT(*) AS cnt
    //                 FROM passive
    //                 WHERE Possibly = 'Y'
    //                 GROUP BY GeterID
    //               ) AS subquery
    //             )
    //           )
    //         GROUP BY LaunchID
    //     ) AS unique_records
    // ) ranked
    // WHERE rn = 1;
    // ";
    
    // // 執行sql
    // mysqli_query($conn, $sql);



    // // 獲取上一個 INSERT 查詢影響的行數
    // $inserted_rows = mysqli_affected_rows($conn);

    // // 檢查是否有行被插入
    // if ($inserted_rows > 0) {
    //     // 若有行被插入，則回傳成功訊息
    //     echo '{"state":true, "message":"flag4新增資料成功"}';
    // } else {
    //     // 若沒有行被插入，則回傳失敗訊息
    //     echo '{"state":false, "message":"flag4未傳入資料"}';
    // }

    // // 將查詢後的性別放入，被告白者性別根據告白者性別相反放入，若不是M,F則放NULL(空值)
    // $sqlGender="UPDATE result r
    //     JOIN student s ON r.LaunchID = s.StudentID
    //     SET r.LaunchGender = s.Gender,
    //     r.ObjectGender = CASE
    //         WHEN s.Gender = 'M' THEN 'F'
    //         WHEN s.Gender = 'F' THEN 'M'
    //         ELSE NULL
    //     END;
    // ";

    // mysqli_query($conn, $sqlGender);

    // // 更新告白者姓名
    // $sqlLName="UPDATE result r
    // JOIN student s ON r.LaunchID = s.StudentID
    // SET r.LaunchName = s.Name;
    // ";
    
    // mysqli_query($conn, $sqlLName);

    // // 更新被告白者姓名
    // $sqlOName="UPDATE result r
    // JOIN student s ON r.ObjectID = s.StudentID
    // SET r.ObjectName = s.Name;
    // ";
    
    // mysqli_query($conn, $sqlOName);

    // // 更改Active配對狀態
    // $sqlAState1="UPDATE active a
    // JOIN result r ON a.LaunchID = r.LaunchID
    // SET a.Possibly = 'N', a.State = 'Y';
    // ";

    // mysqli_query($conn, $sqlAState1);

    // $sqlAState2="UPDATE active a
    // JOIN result r ON a.ObjectID = r.ObjectID
    // SET a.Possibly = 'N', a.State = 'Y';
    // ";

    // mysqli_query($conn, $sqlAState2);

    // // 更改Passive配對狀態
    // $sqlPState1="UPDATE passive p
    // JOIN result r ON p.GeterID = r.ObjectID
    // SET p.Possibly = 'N', p.State = 'Y';
    // ";

    // mysqli_query($conn, $sqlPState1);

    // $sqlPState2="UPDATE passive p
    // JOIN result r ON p.LaunchID = r.LaunchID
    // SET p.Possibly = 'N', p.State = 'Y';
    // ";

    mysqli_query($conn, $sqlPState2);

    do {
        $sql="INSERT INTO result (LaunchID, ObjectID)
        SELECT LaunchID, GeterID
        FROM (
            SELECT LaunchID, GeterID,
                ROW_NUMBER() OVER (PARTITION BY GeterID ORDER BY RAND()) AS rn
            FROM (
                SELECT LaunchID, MIN(GeterID) AS GeterID
                FROM passive
                WHERE Possibly = 'Y'
                AND GeterID IN (
                    SELECT GeterID
                    FROM passive
                    WHERE Possibly = 'Y'
                    GROUP BY GeterID
                    HAVING COUNT(*) = (
                    SELECT MIN(cnt)
                    FROM (
                        SELECT COUNT(*) AS cnt
                        FROM passive
                        WHERE Possibly = 'Y'
                        GROUP BY GeterID
                    ) AS subquery
                    )
                )
                GROUP BY LaunchID
            ) AS unique_records
        ) ranked
        WHERE rn = 1;
        ";
    
        mysqli_query($conn, $sql);
    
        // 獲取上一個 INSERT 查詢影響的行數
        $inserted_rows = mysqli_affected_rows($conn);
    
        if ($inserted_rows > 0) {
            // 若有資料被插入，則繼續執行後續的 UPDATE 查詢
            $sqlGender = "UPDATE result r
                          JOIN student s ON r.LaunchID = s.StudentID
                          SET r.LaunchGender = s.Gender,
                              r.ObjectGender = CASE
                                  WHEN s.Gender = 'M' THEN 'F'
                                  WHEN s.Gender = 'F' THEN 'M'
                                  ELSE NULL
                              END";
            mysqli_query($conn, $sqlGender);
    
            // 更新告白者姓名
            $sqlLName = "UPDATE result r
                         JOIN student s ON r.LaunchID = s.StudentID
                         SET r.LaunchName = s.Name";
            mysqli_query($conn, $sqlLName);
    
            // 更新被告白者姓名
            $sqlOName = "UPDATE result r
                         JOIN student s ON r.ObjectID = s.StudentID
                         SET r.ObjectName = s.Name";
            mysqli_query($conn, $sqlOName);
    
            // 更改Active配對狀態
            $sqlAState1 = "UPDATE active a
                           JOIN result r ON a.LaunchID = r.LaunchID
                           SET a.Possibly = 'N', a.State = 'Y'";
            mysqli_query($conn, $sqlAState1);
    
            $sqlAState2 = "UPDATE active a
                           JOIN result r ON a.ObjectID = r.ObjectID
                           SET a.Possibly = 'N', a.State = 'Y'";
            mysqli_query($conn, $sqlAState2);
    
            // 更改Passive配對狀態
            $sqlPState1 = "UPDATE passive p
                           JOIN result r ON p.GeterID = r.ObjectID
                           SET p.Possibly = 'N', p.State = 'Y'";
            mysqli_query($conn, $sqlPState1);
    
            $sqlPState2 = "UPDATE passive p
                           JOIN result r ON p.LaunchID = r.LaunchID
                           SET p.Possibly = 'N', p.State = 'Y'";
            mysqli_query($conn, $sqlPState2);
        }
    
    } while ($inserted_rows > 0);
    
    // 關閉連線
    mysqli_close($conn);
?>
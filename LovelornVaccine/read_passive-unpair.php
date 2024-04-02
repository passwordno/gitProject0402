<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>被關注者</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<?php
    $p_GeterID = $_GET["userId"];
    require_once "connect-db-api.php";

    $sql = "SELECT * FROM student WHERE StudentID='$p_GeterID'";
    $resultLaunch = mysqli_query($conn, $sql);
    $rowLaunch=$resultLaunch->fetch_assoc();

    $sql = "SELECT DISTINCT p.GeterID, p.LaunchID, a.GradeOrg, s.Name, s2.Name, s2.Class, s2.SetNo FROM passive p INNER JOIN active a on p.LaunchID = a.LaunchID and p.GeterID = a.ObjectID INNER JOIN student s on p.GeterID = s.StudentID INNER JOIN student s2 on p.LaunchID = s2.StudentID WHERE p.GeterID = '$p_GeterID' ORDER BY a.GradeOrg;";
    $result = mysqli_query($conn, $sql);
    $countData = mysqli_num_rows($result);
?>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand fw-900 text-white" href="#">失戀疫苗</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- me-auto:往右邊推 -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="homeManager.html">首頁</a>
                  </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    設定
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="create.html">建立資料庫</a></li>
                    <li><a class="dropdown-item" href="clear-table.html">刪除資料欄位</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">其他</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    查詢
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="read-student.html">學生名單</a></li>
                    <li><a class="dropdown-item" href="read-popular.html">得票數</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">其他</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    配對查詢
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="create-result.html">配對程序</a></li>
                    <li><a class="dropdown-item" href="read-result.html">配對結果</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">其他</a></li>
                    </ul>
                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">搜尋</button>
            </form> -->
          </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 7%;">
        <div class="row mt-3">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="text-center">班級</th>
                        <th class="text-center">座號</th>
                        <th class="text-center">姓名</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><?php echo $rowLaunch["Class"]; ?></td>
                        <td class="text-center"><?php echo $rowLaunch["SetNo"]; ?></td>
                        <td class="text-center"><?php echo $rowLaunch["Name"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row m-3">
            <div class="display-6 mb-3 text-primary">被關注者</div>
            <div class="row">
                <div class="col-1">人數</div>
                <div class="col-2 border border-2">
                    <label for=""><?php echo $result->num_rows; ?></label>
                </div>
            </div>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="text-center">班級</th>
                        <th class="text-center">座號</th>
                        <th class="text-center">姓名</th>    
                        <th class="text-center">志願序</th>   
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($result->num_rows>0)  
                        { 
                            while($row=$result->fetch_assoc())
                            {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $row["Class"]; ?></td>
                        <td class="text-center"><?php echo $row["SetNo"]; ?></td>
                        <td class="text-center"><?php echo $row["Name"]; ?></td> 
                        <td class="text-center"><?php echo $row["GradeOrg"]; ?></td> 

                    </tr>
                    <?php
                            }    
                        }
                    ?> 
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
</body>
</html>
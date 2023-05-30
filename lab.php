<?php 
include 'config.php';
define('PAGE', basename(__FILE__, '.php'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <title>ค้นหาข้อมูลหัตถการ - พยาธิวิทยา</title>
</head>
<body>
<div class="container">
<?php 
include 'menu.php';
?>
</div>
<style>
    label:hover{
        cursor: pointer;
    }
</style>
<div class="container mt-3">
    <form class="row g-3 mx-3" action="lab.php" method="POST" >
        <div class="col-sm-10">
            <label for="searchText" class="visually-hidden">ค้นหา</label>
            <input type="text" class="form-control" name="searchText" id="searchText" placeholder="ค้นหาจากรหัสและรายการ">
        </div>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="depart" id="inline1" value="ALL" checked="checked">
                <label class="form-check-label" for="inline1">ทั้งหมด</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="depart" id="inline2" value="DENTA">
                <label class="form-check-label" for="inline2">ฟัน</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="depart" id="inline3" value="EMER">
                <label class="form-check-label" for="inline3">ฉุกเฉิน</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="depart" id="inline4" value="HEMO">
                <label class="form-check-label" for="inline4">ฟอกไต</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="depart" id="inline5" value="NID">
                <label class="form-check-label" for="inline5">ฝังเข็ม</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="depart" id="inline6" value="PATHO">
                <label class="form-check-label" for="inline6">แลป</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="depart" id="inline7" value="OTHER">
                <label class="form-check-label" for="inline7">อื่นๆ</label>
            </div>
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
</div>
<div class="">
    <?php 
    $action = sprintf("%s", $_POST['action']);
    if ($action==='search') {
        
        $depart = sprintf("%s", $_POST['depart']);
        $searchText = sprintf("%s", $_POST['searchText']);

        $where_depart = "";
        if($depart !== 'ALL'){
            $where_depart = " AND `depart` = '$depart'";
        }

        $where_detail = "";
        if(!empty($searchText)){
            $where_detail = " AND 
            ( `code` LIKE '%$searchText%' 
            -- OR `detail` LIKE '%$searchText%' 
            -- OR `olddetail` LIKE '%$searchText%' 
            OR `codelab` LIKE '%$searchText%' ) ";
        }

        $sql = "SELECT * FROM `labcare` WHERE 1 $where_depart $where_detail";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){
            ?>
            <table class="table table-striped">
                <tr>
                    <th>รหัสคิดเงิน</th>
                    <th>รหัสกรมบัญชีกลาง</th>
                    <th>รหัส Sticker</th>
                    <th>รายการ</th>
                    <th>แผนก</th>
                    <th>ราคาเต็ม</th>
                    <th>ราคาเบิกได้</th>
                    <th>ราคาเบิกไม่ได้</th>
                    <th>code LAB</th>
                    <th>chkup</th>
                    <th>report Labno.</th>
                    <th>Part</th>
                    <th>บริษัท</th>
                    <th>ประเภท</th>
                </tr>
            <?php
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><?=$a['code'];?></td>
                    <td><?=$a['codex'];?></td>
                    <td><?=$a['codelab'];?></td>
                    <td><?=$a['detail'];?></td>
                    <td><?=$a['depart'];?></td>
                    <td><?=$a['price'];?></td>
                    <td><?=$a['yprice'];?></td>
                    <td><?=$a['nprice'];?></td>
                    <td><?=$a['codelab'];?></td>
                    <td><?=$a['chkup'];?></td>
                    <td><?=$a['reportlabno'];?></td>
                    <td><?=$a['labpart'];?></td>
                    <td><?=$a['outlab_name'];?></td>
                    <td><?=$a['labtype'];?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }

    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
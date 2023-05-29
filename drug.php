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
    
    <title>ค้นหาข้อมูลยา - ห้องยา</title>
</head>
<body>
<div class="container">
<?php 
include 'menu.php';
?>
    <form class="row g-3 mx-3" action="drug.php" method="POST" style="margin-top:1em;">
        <div class="col-sm-10">
            <label for="searchText" class="visually-hidden">ค้นหา</label>
            <input type="text" class="form-control" name="searchText" id="searchText" placeholder="ค้นหาจากรหัส/ชื่อทางการค้า/ชื่อสามัญ">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
</div>
<div class="">
    
    <?php 
    $action = sprintf("%s", $_POST['action']);
    if ($action==='search') {
        
        $searchText = sprintf("%s", $_POST['searchText']);
        if(empty($searchText)){
            echo "ไม่พบข้อมูล";
            exit;
        }

        $sql = "SELECT * FROM `druglst` WHERE ( `drugcode` LIKE '%$searchText%' OR `tradname` LIKE '%$searchText%' OR `genname` LIKE '%$searchText%' ) ";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){

            ?>
            <table class="table table-striped">
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อการค้า</th>
                    <th>ชื่อสามัญ</th>
                    <th>ราคาขาย</th>
                    <th>PART</th>
                    <th>ห้องจ่าย</th>
                    <th>ในคลัง</th>
                    <th>สุทธิ</th>
                    <th>packing</th>
                    <th>ราคา/แพค</th>
                    <th>(รวม VAT)</th>
                    <th>ราคากลาง</th>
                    <th>ราคาทุน</th>
                    <th>รหัสบริษัท</th>
                    <th>ชื่อบริษัท</th>
                    <th>24 หลัก</th>
                    <th>สป<br>สายแพทย์</th>
                </tr>
                
            
            <?php

            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><?=$a['drugcode'];?></td>
                    <td><?=$a['tradname'];?></td>
                    <td><?=$a['genname'];?></td>
                    <td>ราคาขาย</td>
                    <td><?=$a['part'];?></td>
                    <td>ห้องจ่าย</td>
                    <td>ในคลัง</td>
                    <td>สุทธิ</td>
                    <td>packing</td>
                    <td>ราคา/แพค</td>
                    <td>(รวม VAT)</td>
                    <td>ราคากลาง</td>
                    <td>ราคาทุน</td>
                    <td>รหัสบริษัท</td>
                    <td>ชื่อบริษัท</td>
                    <td>24 หลัก</td>
                    <td>สป<br>สายแพทย์</td>
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
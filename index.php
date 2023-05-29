<?php 
include 'config.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>ค้นหาข้อมูลผู้มารับบริการ - แผนกทะเบียน</title>
</head>
<body>
<div class="container">
<?php 
include 'menu.php';
?>
</div>
<div class="container mt-3">
    <form class="row g-3 mx-3" action="index.php" method="POST">
        <div class="col-sm-10">
            <label for="searchText" class="visually-hidden">ค้นหา</label>
            <input type="text" class="form-control" name="searchText" id="searchText" placeholder="ค้นหาข้อมูลจากเลขบัตรปชช / ชื่อ-สกุล">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
    <?php 
    $action = sprintf("%s", $_POST['action']);
    if ($action==='search') {
        
        $searchText = sprintf("%s", $_POST['searchText']);

        $q = $dbi->query("SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` 
        FROM `opcard` 
        WHERE `hn` = '$searchText' OR ( `idcard` LIKE '%$searchText%' OR `name` LIKE '%$searchText%' OR `surname` LIKE '%$searchText%' ) 
        ORDER BY `row_id` DESC");
        if ($q->num_rows > 0) {

            ?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>เลขบัตรปชช</th>
                    <th>ชื่อ-สกุล</th>
                    <th>สิทธิ</th>
                    <th>ประเภท</th>
                </tr>
                <?php 
                $i = 1;
                while ($a = $q->fetch_assoc()) {
                    $idguard = substr($a['idguard'],0,4);
                    $tr_color = '';
                    if($idguard=='MX07'){
                        $tr_color = 'table-danger';
                    }
                    ?>
                    <tr class="<?=$tr_color;?>">
                        <td><?=$i;?></td>
                        <td><?=$a['hn'];?></td>
                        <td><a href="opcard_detail.php?hn=<?=$a['hn'];?>" target="_blank"><?=$a['idcard'];?></a></td>
                        <td><?=$a['ptname'];?></td>
                        <td><?=$a['ptright'];?></td>
                        <td><?=$a['goup'];?></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                
            </table>
            <?php
        }else{
            ?>
            <div>
                <p>ไม่พบข้อมูล</p>
            </div>
            <?php
        }
    ?>
    
    <?php 
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
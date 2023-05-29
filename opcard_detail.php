<?php 
include 'config.php';
$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = sprintf("%s", $_GET['hn']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <title>Document</title>
</head>
<body>

<?php 

$sql = "SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1 ";
$q = $dbi->query($sql);
if($q->num_rows > 0){
    $a = $q->fetch_assoc();
?>

<div class="container-md">
    <fieldset>
        <legend>ประวัติส่วนตัว</legend>
        <table class="table table-striped">
            <tr>
                <td rowspan="3">IMAGE</td>
                <td><b>ชื่อ-สกุล:</b> <?=$a['ptname'];?></td>
                <td><b>HN:</b> <?=$a['hn'];?></td>
                <td><b>บัตรประชาชน:</b> <?=$a['idguard'];?></td>
                
            </tr>
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                
            </tr>
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                
            </tr>
            <tr>
                <td><b>XXXX</b> YYYYYYYYY</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                
            </tr>
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend>ข้อมูลการติดต่อ</legend>
        <table class="table table-striped">
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
            </tr>
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend>ข้อมูลการรักษา</legend>
        <table class="table table-striped">
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
            </tr>
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend>ข้อมูลผู้พิการ</legend>
        <table class="table table-striped">
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
            </tr>
            <tr>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
                <td>XXXX</td>
            </tr>
        </table>
    </fieldset>
</div>
<?php 
}else{
    ?>
    <p>ไม่พบข้อมูล</p>
    <?php
}
?>
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
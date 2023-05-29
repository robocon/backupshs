<?php 
include 'config.php';
$hn = sprintf("%s", $_GET['hn']);

$sql = "SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1 ";
$q = $dbi->query($sql);
if($q->num_rows > 0){
    $a = $q->fetch_assoc();

}else{
    ?><p>ไม่พบข้อมูล</p><?php
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <title>ประวัติส่วนตัว - <?=$a['ptname'];?></title>
</head>
<body>
<?php 

$education_list = array('00' => 'ไม่ได้ศึกษา/ไม่มีวุฒิการศึกษา', '01' => 'ก่อนประถมศึกษา', '02' => 'ประถมศึกษา', '03' => 'มัธยมศึกษา', '04' => 'อนุปริญญา', '05' => 'ปริญญาตรี', '06' => 'สูงกว่าปริญญาตรี', '09' => 'ไม่ระบุ/ไม่ทราบ');
$typearea_list = array(
    1 => 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบและอยู่จริง',
    2 => 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบแต่ตัวไม่อยู่จริง',
    3 => 'มาอาศัยอยู่ในเขตรับผิดชอบแต่ทะเบียนบ้านอยู่นอกเขตรับผิดชอบ',
    4 => 'ที่อาศัยอยู่นอกเขตรับผิดชอบและเข้ามารับบริการ',
    5 => 'มาอาศัยในเขตรับผิดชอบแต่ไม่ได้อยู่ตามทะเบียนบ้านในเขตรับผิดชอบ เช่น คนเร่ร่อน ไม่มีที่พักอาศัย เป็นต้น'
);

?>
<div class="container-md">
    <fieldset>
        <legend>ประวัติส่วนตัว (<?=$a['hn'];?>)</legend>
        <table class="table table-striped">
            <tr>
                <td><b>ชื่อ-สกุล:</b> <?=$a['ptname'];?></td>
                <td><b>บัตรประชาชน:</b> <?=$a['idcard'];?></td>
                <td><b>ว/ด/ป เกิด:</b> <?=$a['dbirth'];?></td>
                <td><b>เพศ:</b> <?=$a['sex'];?></td>
            </tr>
            <tr>
                <td><b>เชื้อชาติ:</b> <?=$a['race'];?></td>
                <td><b>สัญชาติ:</b> <?=$a['nation'];?></td>
                <td><b>ศาสนา:</b> <?=$a['religion'];?></td>
                <td><b>สถานะภาพ:</b> <?=$a['married'];?></td>
            </tr>
            <tr>
                <td><b>อาชีพ:</b> <?=$a['career'];?></td>
                <td><b>ระดับการศึกษา:</b> <?=$education_list[$a['education']];?></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="margin-top:1em;">
        <legend>ข้อมูลการติดต่อ</legend>
        <?php 
        $full_address = $a['address'];
        if(!empty($a['tambol'])){
            $full_address .= ' ต.'.$a['tambol'];
        }
        if(!empty($a['ampur'])){
            $full_address .= ' อ.'.$a['ampur'];
        }
        if(!empty($a['changwat'])){
            $full_address .= ' จ.'.$a['changwat'];
        }
        ?>
        <table class="table table-striped">
            <tr>
                <td colspan="2"><b>ที่อยู่:</b> <?=$full_address;?></td>
                <td><b>โทรศัพท์บ้าน:</b> <?=$a['hphone'];?></td>
                <td><b>มือถือ:</b> <?=$a['phone'];?></td>
            </tr>
            <tr>
                <td><b>บิดา:</b> <?=$a['father'];?></td>
                <td><b>มารดา:</b> <?=$a['mother'];?></td>
                <td><b>คู่สมรส:</b> <?=$a['couple'];?></td>
                <td></td>
            </tr>
            <tr>
                <td><b>ผู้ที่สามารถติดต่อได้:</b> <?=$a['ptf'];?></td>
                <td><b>เกี่ยวข้องเป็น:</b> <?=$a['ptfadd'];?></td>
                <td><b>โทรศัพท์:</b> <?=$a['ptffone'];?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><b>สถานะบุคคล:</b> <?=$typearea_list[$a['typearea']];?></td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="margin-top:1em;">
        <legend>ข้อมูลการรักษา</legend>
        <table class="table table-striped">
            <tr>
                <td><b>ประเภท:</b> <?=$a['goup'];?></td>
                <td><b>สังกัด:</b> <?=$a['camp'];?></td>
                <td><b>สิทธิการรักษา:</b> <?=$a['ptright1'];?></td>
                <td><b>ประเภทสิทธิ:</b> <?=$a['ptrightdetail'];?></td>
            </tr>
            <tr>
                <td><b>เบิกจาก:</b> <?=$a['ptfmon'];?></td>
                <td><b>หน่วยงาน:</b> <?=$a['guardian'];?></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="margin-top:1em;">
        <legend>ข้อมูลผู้พิการ</legend>
        <table class="table table-striped">
            <tr>
                <td colspan="2"><b>เลขทะเบียนผู้พิการ:</b> <?=$a['disabid'];?></td>
                <td colspan="2"><b>รหัสสภาวะสุขภาพ:</b> <?=$a['icf'];?></td>
            </tr>
            <tr>
                <td colspan="2"><b>ประเภทความพิการ:</b> <?=$a['disabtype'];?></td>
                <td colspan="2"><b>สาเหตุความพิการ:</b> <?=$a['disabcause'];?></td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="margin-top:1em;">
        <legend>ข้อมูล อื่นๆ</legend>
        <table class="table table-striped">
            <tr>
                <td><b>กลุ่มเลือด:</b> <?=$a['blood'];?></td>
                <td><b>แพ้ยา:</b> <?=$a['drugreact'];?></td>
                <td><b>รพ.ต้นสังกัด:</b> <?=$a['hospcode'];?></td>
                <td><b>หมายเหตุ:</b> <?=$a['note'];?></td>
            </tr>
        </table>
    </fieldset>
</div> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>
<?php
include dirname(__FILE__).'/connect.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>งานทะเบียน</title>
    <!-- โหลด Bootstrap 5.3 CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="sweetalert2@11.js"></script>
    <style>
        /* ใช้ font-family ตามที่กำหนดโดยไม่ต้องสร้าง class ใหม่ */
        body {
            font-family: "TH SarabunPSK", sans-serif;
            font-size: 22px; /* ปรับขนาดฟอนต์ให้เหมาะสมกับ TH SarabunPSK */
        }
        h1 {
            font-family: "TH SarabunPSK", sans-serif;
        }
        th {
            background-color: #13795b !important;
            color: white !important;
        }
        label:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- บรรทัดแรก: จัดกึ่งกลาง ตัวหนังสือขนาด h1 -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">งานทะเบียน</h1>
        </div>

        <!-- บรรทัดที่สอง: ฟอร์ม Post -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-auto">
                            <input type="text" name="search" class="form-control" placeholder="คำค้นหา..." value="<?= $_POST['search'] ?>" required>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-check-inline">
                                <?php
                                $check_hn = ($_POST['type']==='hn') ? 'checked="checked"' : '';
                                ?>
                                <input class="form-check-input" type="radio" name="type" id="radioHN" value="hn" <?= $check_hn ?>>
                                <label class="form-check-label" for="radioHN">HN</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?php
                                $check_name = ($_POST['type']==='name') ? 'checked="checked"' : '';
                                ?>
                                <input class="form-check-input" type="radio" name="type" id="radioName" value="name" <?= $check_name ?>>
                                <label class="form-check-label" for="radioName">ชื่อ-สกุล</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?php
                                $check_idcard = ($_POST['type']==='idcard') ? 'checked="checked"' : '';
                                ?>
                                <input class="form-check-input" type="radio" name="type" id="radioIdcard" value="idcard" <?= $check_idcard ?>>
                                <label class="form-check-label" for="radioIdcard">เลขบัตรประชาชน</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-4">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        if(!empty($_POST['search'])){
            $search = sprintf("%s", $dbi->real_escape_string($_POST['search']));
            $type = sprintf("%s", $dbi->real_escape_string($_POST['type']));

            $where = '';
            if($type==='hn'){
                $where = "`hn` = '$search'";
            }elseif ($type==='name') {
                $where = "`name` LIKE '%$search%' OR `surname` LIKE '%$search%'";
            }elseif ($type==='idcard') {
                $where = "`idcard` = '$search'";
            }
            
            $sql = "SELECT * FROM `opcard` WHERE $where ORDER BY `row_id` DESC";
            $q = $dbi->query($sql);
            $num = $q->num_rows;
            if($num>0){
            ?>
            <!-- บรรทัดที่สาม: ตารางแสดงข้อมูล -->
            <div class="table-responsive shadow-sm">
                <table class="table table-sm table-bordered table-striped table-hover align-middle mb-0">
                    <thead class="text-center">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col" style="width: 10%;">HN</th>
                            <th scope="col" style="width: 20%;">ยศ ชื่อ-สกุล</th>
                            <th scope="col" style="width: 15%;">เลขบัตรประชาชน</th>
                            <th scope="col" style="width: 15%;">สิทธิการรักษา</th>
                            <th scope="col" style="width: 15%;">ประเภททหาร</th>
                            <th scope="col" style="width: 20%;">สังกัด</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    while ($a = $q->fetch_assoc()) {
                        $idguardCode = substr($a['idguard'],0,4);
                        $idguardStyle = '';
                        if($idguardCode=='MX04' OR $idguardCode=='MX07'){
                            $idguardStyle = 'table-danger';
                        }
                    ?>
                        <tr class="<?= $idguardStyle; ?>" style="background-color: red important!">
                            <td class="text-center"><?= $i; ?></td>
                            <td><a href="javascript:void(0);" class="open-detail" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showDetail('<?= $a['hn']; ?>')"><?= $a['hn']; ?></a> <?= (!empty($idguardStyle)) ? $a['idguard'] : ''; ?></td>
                            <td><?= $a['prefix'].$a['name'].' '.$a['surname']; ?></td>
                            <td><?= $a['idcard']; ?></td>
                            <td><?= $a['ptright']; ?></td>
                            <td><?= $a['goup']; ?></td>
                            <td><?= $a['camp']; ?></td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            }else{
            ?>
            <div>
                <div class="alert alert-warning" role="alert">ไม่พบข้อมูล</div>
            </div>
            <?php
            }
        }
        ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">เวชระเบียน / MEDICAL RECORD</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody"></div>
    </div>
  </div>
</div>


    </div>
    <!-- โหลด Bootstrap 5.3 JS -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>

        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })

        function showDetail(hn){
            loadContent(hn).then((res)=>{
                console.log(res);
                // show modal here
                document.getElementById('modalBody').innerHTML = res;
            });
        }
        async function loadContent(hn){
            const response = await fetch('register_detail.php?hn='+hn);
            const body = await response.text();
            return body;
        }
    </script>
</body>
</html>

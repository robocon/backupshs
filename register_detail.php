<?php
include dirname(__FILE__).'/connect.php';
$hn = sprintf("%s", $_GET['hn']);
$q = $dbi->query("SELECT * FROM `opcard` WHERE `hn` = '$hn'");
$a = $q->fetch_assoc();
?>
<div class="container my-4">
        
        <div class="card mb-4 border-success shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title"><i class="bi bi-person-fill"></i> ข้อมูลประวัติส่วนตัว</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row g-3">
                            <div class="col">
                                <label for="yot" class="form-label fw-bold">HN</label>
                                <div><?= $a['hn'] ?></div>
                            </div>
                            <div class="col">
                                <label for="idcard" class="form-label fw-bold">เลขประจำตัวประชาชน</label>
                                <div><?= $a['idcard'] ?></div>
                            </div>
                            <div class="col">
                                <label for="name" class="form-label fw-bold">ชื่อ-นามสกุล</label>
                                <div><?= $a['yot'].$a['name'].' '.$a['surname'] ?></div>
                            </div>
                            <div class="col">
                                <label for="sex" class="form-label fw-bold">เพศ</label>
                                <div><?= $a['sex']=='ช' ? 'ชาย' : 'หญิง' ?></div>
                            </div>
                            <div class="col">
                                <label class="form-label fw-bold">วัน-เดือน-ปี เกิด</label>
                                <div>
                                    <?php
                                    list($y, $m, $d) = explode('-', $a['dbirth']);
                                    echo $d.'-'.$m.'-'.$y;
                                    ?>
                                </div>
                            </div>
                            <div class="col">
                                <label for="race" class="form-label fw-bold">เชื้อชาติ</label>
                                <div><?= $a['race'] ?></div>
                            </div>
                            <div class="col">
                                <label for="nation" class="form-label fw-bold">สัญชาติ</label>
                                <div><?= $a['nation'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col">
                        <label for="blood" class="form-label fw-bold">กลุ่มเลือด</label>
                        <div><?= $a['blood'] ?></div>
                    </div>
                    <div class="col">
                        <label for="religion" class="form-label fw-bold">ศาสนา</label>
                        <div><?= $a['religion'] ?></div>
                    </div>
                    <div class="col">
                        <label for="married" class="form-label fw-bold">สถานภาพ</label>
                        <div><?= $a['married'] ?></div>
                    </div>
                    <div class="col">
                        <label for="career" class="form-label fw-bold">อาชีพ</label>
                        <div><?= $a['career'] ?></div>
                    </div>
                    <div class="col">
                        <label for="education" class="form-label fw-bold">ระดับการศึกษา </label>
                        <div>
                            <?php
                            $educations = array('00'=>'ไม่ได้ศึกษา/ไม่มีวุฒิการศึกษา','01'=>'ก่อนประถมศึกษา','02'=>'ประถมศึกษา','03'=>'มัธยมศึกษา','04'=>'อนุปริญญา','05'=>'ปริญญาตรี','06'=>'สูงกว่าปริญญาตรี','09'=>'ไม่ระบุ/ไม่ทราบ');
                            $eduCode = $a['education'];
                            echo $educations[$eduCode];
                            ?>
                        </div>
                    </div>
                    <div class="col">
                        <label for="mid" class="form-label fw-bold">หมายเลขประจำตัวทหาร</label>
                        <div><?= $a['mid'] ?></div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    
                </div>

                <div class="row g-3 mt-1">
                    
                </div>
            </div>
        </div>

        <div class="card mb-4 border-success shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0 card-title"><i class="bi bi-geo-alt-fill"></i> ข้อมูลการติดต่อ (ที่อยู่ปัจจุบัน)</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col">
                        <label for="address" class="form-label fw-bold">บ้านเลขที่</label>
                        <div><?= $a['address'] ?></div>
                    </div>
                    <div class="col position-relative">
                        <label for="tambol" class="form-label fw-bold">ตำบล</label>
                        <div><?= $a['tambol'] ?></div>
                    </div>
                    <div class="col">
                        <label for="ampur" class="form-label fw-bold">อำเภอ</label>
                        <div><?= $a['ampur'] ?></div>
                    </div>
                    <div class="col">
                        <label for="changwat" class="form-label fw-bold">จังหวัด</label>
                        <div><?= $a['changwat'] ?></div>
                    </div>
                    <div class="col">
                        <label for="hphone" class="form-label fw-bold">โทรศัพท์บ้าน</label>
                        <div><?= $a['hphone'] ?></div>
                    </div>
                    
                    <div class="col">
                        <label for="phone" class="form-label fw-bold">มือถือ</label>
                        <div><?= $a['phone'] ?></div>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col">
                        <label for="father" class="form-label fw-bold">บิดา</label>
                        <div><?= $a['father'] ?></div>
                    </div>
                    <div class="col">
                        <label for="mother" class="form-label fw-bold">มารดา</label>
                        <div><?= $a['mother'] ?></div>
                    </div>
                    <div class="col">
                        <label for="couple" class="form-label fw-bold">คู่สมรส</label>
                        <div><?= $a['couple'] ?></div>
                    </div>
                    <div class="col">
                        <label for="ptf" class="form-label fw-bold">ผู้ที่สามารถติดต่อได้</label>
                        <div><?= $a['ptf'] ?></div>
                    </div>
                    <div class="col">
                        <label for="ptfadd" class="form-label fw-bold">เกี่ยวข้องเป็น</label>
                        <div><?= $a['ptfadd'] ?></div>
                    </div>
                    <div class="col">
                        <label for="ptffone" class="form-label fw-bold">โทรศัพท์</label>
                        <div><?= $a['ptffone'] ?></div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col2">
                        <?php
                        $areaList = array('1' => '1 - มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบและอยู่จริง',
                        '2' => '2 - มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบแต่ตัวไม่อยู่จริง',
                        '3' => '3 - มาอาศัยอยู่ในเขตรับผิดชอบแต่ทะเบียนบ้านอยู่นอกเขตรับผิดชอบ',
                        '4' => '4 - ที่อาศัยอยู่นอกเขตรับผิดชอบและเข้ามารับบริการ',
                        '5' => '5 - มาอาศัยในเขตรับผิดชอบแต่ไม่ได้อยู่ตามทะเบียนบ้านในเขตรับผิดชอบ เช่น คนเร่ร่อน ไม่มีที่พักอาศัย เป็นต้น');
                        $typearea = $a['typearea'];
                        ?>
                        <label for="typearea" class="form-label fw-bold">สถานะบุคคล </label>
                        <div><?= $areaList[$typearea] ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 border-success shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0 card-title">💳 ที่อยู่ตามบัตรประชาชน</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col">
                        <label for="card_address" class="form-label fw-bold">ที่อยู่</label>
                        <div><?= $a['card_address'] ?></div>
                    </div>
                    <div class="col">
                        <label for="card_moo" class="form-label fw-bold">หมู่ที่</label>
                        <div><?= $a['card_moo'] ?></div>
                    </div>
                    <div class="col">
                        <label for="card_tambol" class="form-label fw-bold">ตำบล</label>
                        <div><?= $a['card_tambol'] ?></div>
                    </div>
                    <div class="col">
                        <label for="card_amphur" class="form-label fw-bold">อำเภอ</label>
                        <div><?= $a['card_amphur'] ?></div>
                    </div>
                    <div class="col">
                        <label for="card_province" class="form-label fw-bold">จังหวัด</label>
                        <div><?= $a['card_province'] ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 border-success shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0 card-title">🩺 ข้อมูลสิทธิการรักษา</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col">
                        <label for="goup" class="form-label fw-bold">ประเภท</label>
                        <div><?= $a['goup'] ?></div>
                    </div>
                    <div class="col">
                        <label for="camp" class="form-label fw-bold">สังกัด</label>
                        <div><?= $a['camp'] ?></div>
                    </div>
                    <div class="col">
                        <label for="ptright1" class="form-label fw-bold">สิทธิการรักษา</label>
                        <div><?= $a['ptright1'] ?></div>
                    </div>
                    <div class="col">
                        <label for="ptrightdetail" class="form-label fw-bold">ประเภทสิทธิ</label>
                        <div><?= $a['ptrightdetail'] ?></div>
                    </div>
                    <div class="col">
                        <label for="ptfmon" class="form-label fw-bold">เบิกจาก</label>
                        <div><?= $a['ptfmon'] ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 border-success shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0 card-title">♿ ข้อมูลผู้พิการ</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center mb-3">
                    <div class="col">
                        <label for="disabid" class="form-label fw-bold">เลขทะเบียนผู้พิการ</label>
                        <div><?= $a['disabid'] ?></div>
                    </div>
                    <div class="col">
                        <label for="icf" class="form-label fw-bold">รหัสสภาวะสุขภาพ(ICF)</label>
                        <div><?= $a['icf'] ?></div>
                    </div>
                    <div class="col">
                        <label for="disabtype" class="form-label fw-bold">ประเภทความพิการ</label>
                        <div><?= $a['disabtype'] ?></div>
                    </div>
                    <div class="col">
                        <label for="disabcause" class="form-label fw-bold">สาเหตุความพิการ</label>
                        <div><?= $a['disabcause'] ?></div>
                    </div>
                </div>
            </div>
        </div>

</div>
<?php
date_default_timezone_set('Asia/Bangkok');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');

function dump($t){
    echo '<pre>';
    var_dump($t);
    echo '</pre>';
}
function getTokenValue($t){
    list($key,$value) = explode('=', $t);
    return $value;
}

$baseUsers = "C:/Users";
$dirLists = scandir("C:/Users");
$inActiveDir = array('.','..','All Users','Default','Default User','Public','desktop.ini');
foreach ($dirLists as $dir) {
    if(!in_array($dir, $inActiveDir) && is_dir($baseUsers.'/'.$dir)===true){
        $userProfile = $dir;
    }
}

$srmTokenPath = $baseUsers.'/'.$userProfile.'/SRM Smart Card Single Sign-On/token.txt';
if(!file_exists($srmTokenPath)){
    ?>
    <p><b>ไม่เจอไฟล์:</b> <?= $srmTokenPath; ?></p>
    <p>แน่ใจว่าติดตั้ง SRM Smart Card Single Sign-On เรียบร้อยใช่รึป่าว</p>
    <?php
    exit();
}

$srmTokenContent = file_get_contents(trim($srmTokenPath));
$srmTokenContentList = preg_split('/\r\n|\r|\n/', $srmTokenContent);
$accessToken = $refreshToken = '';
foreach ($srmTokenContentList as $c) {
    if(strpos($c, 'access-token')!==false){
        $accessToken = getTokenValue($c);
    }else if(strpos($c, 'refresh-token')!==false){
        $refreshToken = getTokenValue($c);
    }
}

header('Content-Type: application/json');
echo json_encode(array(
    'srmAccessToken' => $accessToken,
    'srmRefreshToken' => $refreshToken
));
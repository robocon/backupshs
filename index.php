<?php
include dirname(__FILE__).'/connect.php';
if(__DEFAULT__==='REGISTER'){
    header("Location: register.php");
}
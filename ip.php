<?php
if(isset($_GET['ip'])){
    $ip = $_GET['ip'];
    $res = file_get_contents("http://ip-api.com/json/" . $ip);
    echo $res;
}
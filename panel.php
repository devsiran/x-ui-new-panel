<?php

if(!isset($p)){
    exit("404");
}

///////////////////////////////////// Start Login
@session_start();
$login = false;
if(isset($_GET['logout'])){
    $_SESSION['adusername'] = "";
    $_SESSION['adpassword'] = "";
}
if(isset($_POST['adusername'],$_POST['adpassword'])){
    $_SESSION['adusername'] = $_POST['adusername'];
    $_SESSION['adpassword'] = $_POST['adpassword'];
}
if(isset($_SESSION['adusername'],$_SESSION['adpassword'])){
    $adusername = $_SESSION['adusername'];
    $adpassword = $_SESSION['adpassword'];
    
    if(isset($admins[$adusername]) && $adpassword==$admins[$adusername][0]){
        $login = true;
        $usfolder = $admins[$adusername][1];
    }
}
if(!$login){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
    <style>
        .customBG{
            background: #8e44ad !important;
            border-color: #8e44ad !important;
        }
        .customBG:focus{
            background: #9b59b6 !important;
            border-color: #9b59b6 !important;
        }
    </style>
</head>
<body class="bg-warning customBG">
    <canvas id='canv' style="position: fixed;left: 0;top: 0;right: 0;bottom: 0;"></canvas>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-4"></div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <img src="login.gif" style="max-width: 100%;filter: hue-rotate(220deg);">
                        <h3 class="text-center">LOGIN</h3>
                        <br>
                        <form action="<?php echo $adminPage; ?>" method="post">
                            <label class="w-100">
                                Username
                                <input type="text" class="form-control" placeholder="Enter Username" name="adusername">
                            </label>
                            <br><br>
                            <label class="w-100">
                                Password
                                <input type="password" class="form-control" placeholder="Enter Password" name="adpassword">
                            </label>
                            <br><br>
                            <button class="btn btn-warning text-white customBG d-block w-100" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <script>
        var c = document.getElementById('canv'), 
    $ = c.getContext("2d");
var w = c.width = window.innerWidth, 
    h = c.height = window.innerHeight;

Snowy();
function Snowy() {
  var snow, arr = [];
  var num = 600, tsc = 1, sp = 1;
  var sc = 1.3, t = 0, mv = 20, min = 1;
    for (var i = 0; i < num; ++i) {
      snow = new Flake();
      snow.y = Math.random() * (h + 50);
      snow.x = Math.random() * w;
      snow.t = Math.random() * (Math.PI * 2);
      snow.sz = (100 / (10 + (Math.random() * 100))) * sc;
      snow.sp = (Math.pow(snow.sz * .8, 2) * .15) * sp;
      snow.sp = snow.sp < min ? min : snow.sp;
      arr.push(snow);
    }
  go();
  function go(){
    window.requestAnimationFrame(go);
      $.clearRect(0, 0, w, h);
      
      $.fillRect(0, 0, w, h);
      $.fill();
        for (var i = 0; i < arr.length; ++i) {
          f = arr[i];
          f.t += .05;
          f.t = f.t >= Math.PI * 2 ? 0 : f.t;
          f.y += f.sp;
          f.x += Math.sin(f.t * tsc) * (f.sz * .3);
          if (f.y > h + 50) f.y = -10 - Math.random() * mv;
          if (f.x > w + mv) f.x = - mv;
          if (f.x < - mv) f.x = w + mv;
          f.draw();}
 }
 function Flake() {
   this.draw = function() {
      this.g = $.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.sz);
      this.g.addColorStop(0, 'hsla(255,255%,255%,1)');
      this.g.addColorStop(1, 'hsla(255,255%,255%,0)');
      $.moveTo(this.x, this.y);
      $.fillStyle = this.g;
      $.beginPath();
      $.arc(this.x, this.y, this.sz, 0, Math.PI * 2, true);
      $.fill();}
  }
}
/*________________________________________*/
window.addEventListener('resize', function(){
  c.width = w = window.innerWidth;
  c.height = h = window.innerHeight;
}, false);
    </script>
</body>
</html>
    <?php
    exit();
}
////////////////////////////////// End Login

if(!file_exists($usfolder)){
    file_put_contents($usfolder,"[]");
}

function sendBackup($file){
    
    // global $uriAsli;
    // global $pre_mark_connection;
    
    
    // $data = [
    //     "text" => $file,
    //     "caption" => "بکاپ از سرور : " . $pre_mark_connection . "\n\nآدرس سرور: " . $uriAsli
    // ];
    

    // $CHAT_ID = 'Admin Chat ID';
    // $BOT = 'Telegram Bot Token';

    // $FILENAME = $file;

    // // Create CURL object
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$BOT."/sendDocument?chat_id=" . $CHAT_ID);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_POST, 1);

    // // Create CURLFile
    // $finfo = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $FILENAME);
    // $cFile = new CURLFile($FILENAME, $finfo);

    // // Add CURLFile to CURL request
    // curl_setopt($ch, CURLOPT_POSTFIELDS, [
    //     "document" => $cFile
    // ]);

    // // Call
    // $result = curl_exec($ch);

    // // Show result and close curl
    // var_dump($result);
    // curl_close($ch);
}


function getUsers(){
    global $panelAddress;
    global $panelCookie;
    global $connectionsFolder;
    global $uriAsli;
    global $uriMostaghim;
    global $uriNimBaha;
    global $pre_mark_connection;
    global $xuiaddress;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://' . $panelAddress . $xuiaddress . 'inbound/list');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Accept: application/json, text/plain, */*';
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Length: 0';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = $panelCookie;
    $headers[] = 'Origin: https://' . $panelAddress;
    $headers[] = 'Referer: https://' . $panelAddress . $xuiaddress . 'inbounds';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.41';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'Sec-Ch-Ua: ^^Microsoft';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        return json_decode(json_encode([
            "success" => false,
            "msg" => "Error"
        ]));
    }
    curl_close($ch);
    
    
    if(!file_exists("back/" . $uriAsli . "_" . date("y_m_d") . ".txt")){
        file_put_contents("back/" . $uriAsli . "_" . date("y_m_d") . ".txt",$result);
        sendBackup("./back/" . $uriAsli . "_" . date("y_m_d") . ".txt");
    }
    
    return json_decode($result);
}

function addUser($remark,$password,$port,$expire,$traffic=0){
    
    global $panelAddress;
    global $panelCookie;
    global $connectionsFolder;
    global $uriAsli;
    global $uriMostaghim;
    global $uriNimBaha;
    global $pre_mark_connection;
    global $xuiaddress;
    
    $ch = curl_init();
    
    $traffic = (intval($traffic * (1024*1024*1024)));

    curl_setopt($ch, CURLOPT_URL, 'https://' . $panelAddress . $xuiaddress . 'inbound/add');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "up=0&down=0&total=$traffic&remark=$remark&enable=true&expiryTime=" . (strtotime("+" . $expire . " days")*1000) . "&listen=&port=$port&protocol=trojan&settings={\"clients\": [ {\"password\": \"$password\", \"flow\": \"xtls-rprx-direct\"}],\"fallbacks\": []}&streamSettings={\n  \"network\": \"tcp\",\n  \"security\": \"tls\",\n  \"tlsSettings\": {\n    \"serverName\": \"\",\n    \"certificates\": [\n      {\n        \"certificateFile\": \"/root/cert.crt\",\n        \"keyFile\": \"/root/private.key\"\n      }\n    ],\n    \"alpn\": []\n  },\n  \"tcpSettings\": {\n    \"acceptProxyProtocol\": false,\n    \"header\": {\n      \"type\": \"none\"\n    }\n  }\n}&sniffing={\n  \"enabled\": true,\n  \"destOverride\": [\n    \"http\",\n    \"tls\"\n  ]\n}");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Accept: application/json, text/plain, */*';
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = $panelCookie;
    $headers[] = 'Origin: https://' . $panelAddress;
    $headers[] = 'Referer: https://' . $panelAddress . $xuiaddress . 'inbounds';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.41';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'Sec-Ch-Ua: \"Microsoft Edge\";v=\"111\", \"Not(A:Brand\";v=\"8\", \"Chromium\";v=\"111\"';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        return json_decode(json_encode([
            "success" => false,
            "msg" => "Error"
        ]));
    }
    curl_close($ch);
    return json_decode($result);
}
function updateUser($id,$enable,$expire,$traffic=-1){

    global $panelAddress;
    global $panelCookie;
    global $connectionsFolder;
    global $uriAsli;
    global $uriMostaghim;
    global $uriNimBaha;
    global $pre_mark_connection;
    global $xuiaddress;
    
    
    $user = null;

    $list = getUsers()->obj;
    foreach($list as $u){
        if($u->id==$id){
            $user = $u;
            break;
        }
    }
    if($user==null){
        exit("user not found!");
    }

    if($expire==-1){
        $expire = $user->expiryTime;
    }
    else{
        $expire = intval(strtotime("+" . $expire . " days")*1000) - 10;
    }
    
    if($traffic==-1){
        $traffic = $user->total;
    }
    else{
        $traffic = (intval($traffic * (1024*1024*1024)));
    }

    $ch = curl_init();
    
    

    curl_setopt($ch, CURLOPT_URL, 'https://' . $panelAddress . $xuiaddress . 'inbound/update/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "up=" . $user->up . "&down=" . $user->down . "&total=" . $traffic . "&remark=" . $user->remark . "&enable=" . $enable . "&expiryTime=" . $expire . "&listen=&port=" . $user->port . "&protocol=trojan&settings={\"clients\": [ {\"password\": \"" . $user->remark . "\", \"flow\": \"xtls-rprx-direct\"}],\"fallbacks\": []}&streamSettings={\n  \"network\": \"tcp\",\n  \"security\": \"tls\",\n  \"tlsSettings\": {\n    \"serverName\": \"\",\n    \"certificates\": [\n      {\n        \"certificateFile\": \"/root/cert.crt\",\n        \"keyFile\": \"/root/private.key\"\n      }\n    ],\n    \"alpn\": []\n  },\n  \"tcpSettings\": {\n    \"acceptProxyProtocol\": false,\n    \"header\": {\n      \"type\": \"none\"\n    }\n  }\n}&sniffing={\n  \"enabled\": true,\n  \"destOverride\": [\n    \"http\",\n    \"tls\"\n  ]\n}");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Accept: application/json, text/plain, */*';
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = $panelCookie;
    $headers[] = 'Origin: https://' . $panelAddress;
    $headers[] = 'Referer: https://' . $panelAddress . $xuiaddress . 'inbounds';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.41';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'Sec-Ch-Ua: ^^Microsoft';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}

function deleteUser($id){
    
    global $panelAddress;
    global $panelCookie;
    global $connectionsFolder;
    global $uriAsli;
    global $uriMostaghim;
    global $uriNimBaha;
    global $pre_mark_connection;
    global $xuiaddress;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://' . $panelAddress . $xuiaddress . 'inbound/del/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    
    $headers = array();
    $headers[] = 'Accept: application/json, text/plain, */*';
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Length: 0';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = $panelCookie;
    $headers[] = 'Origin: https://' . $panelAddress;
    $headers[] = 'Referer: https://' . $panelAddress . $xuiaddress . 'inbounds';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Sec-Fetch-Site: same-origin';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.54';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'Sec-Ch-Ua: ^^Microsoft';
    $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
    $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}

function getByteText($b){
    $b = $b / (1024 * 1024);
    if($b<1024){
        return round($b,2) . " MB";
    }
    $b /= 1024;
    if($b<1024){
        return round($b,2) . " GB";
    }
    $b /= 1024;
    return '<span style="color:red;font-weight:bold;">' . round($b,2) . " TB</span>";
}


if(isset($_POST['deactiveUser'])){
    $id = $_POST['deactiveUser'];
    updateUser($id,false,-1);
}
if(isset($_POST['activeUser'])){
    $id = $_POST['activeUser'];
    updateUser($id,true,-1);
}
if(isset($_POST['ccid'],$_POST['cctime'])){
    $ccid = $_POST['ccid'];
    $cctime = $_POST['cctime'];
    updateUser($ccid,true,$cctime);
}
if(isset($_POST['clid'],$_POST['clval'])){
    $ccid = $_POST['clid'];
    $cctime = $_POST['clval'];
    $traffic = $cctime;
    updateUser($ccid,true,-1,$traffic);
}
if(isset($_POST['deleteUser'])){
    $id = $_POST['deleteUser'];
    deleteUser($id);
}
if(isset($_POST['restartServer'])){
    restartServer();
}

$logs = [];

if(isset($_POST['newusername'],$_POST['newuserexpire'],$_POST['port'],$_POST['newuserTotal'])){
    $newusername = strtolower(preg_replace("/[^A-Za-z0-9]/","",$_POST['newusername']));
    $newuserexpire = intval($_POST['newuserexpire']);
    $port = intval($_POST['port']);
    $total = intval($_POST['newuserTotal']);
    // Add New User   
    $res = addUser($newusername,$newusername,$port,$newuserexpire,$total);
    if($res->success == true){
        $newUser = [
            "id" => $res->obj->id,
            "created" => date("Y-m-d H:i:s")
        ];
        $myUsers = json_decode(file_get_contents($usfolder));
        array_push($myUsers,$newUser);
        file_put_contents($usfolder,json_encode($myUsers));
        array_push($logs,["success","کاربر با موفقیت ایجاد شد"]);
    }
    else{
        array_push($logs,["danger",$res->msg]);
    }
}


$users = getUsers();
if($users->success==true){
    $users = $users->obj;
}
else{
    $users = [];
    array_push($logs,["danger","Error Load Users - " . $res->msg]);
}
$allUserPorts = [];
foreach($users as $u){
    array_push($allUserPorts,$u->port);
}
$newPort = rand(1000,65530);
while(in_array($newPort,$allUserPorts)){
    $newPort = rand(1000,65530);
}


$aduserlist = [];
foreach($admins as $aname=>$ad){
    $adUsers = json_decode(file_get_contents($ad[1]));
    $aduserlist[$aname] = [];
    foreach($adUsers as $mu){
        array_push($aduserlist[$aname],$mu->id);
    }
}
$myUsers = json_decode(file_get_contents($usfolder));
$myUserIds = [];
foreach($myUsers as $mu){
    array_push($myUserIds,$mu->id);
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>مدیریت</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
    <style>
        .customBG{
            background: #8e44ad !important;
            border-color: #8e44ad !important;
        }
        .customBG:focus{
            background: #9b59b6 !important;
            border-color: #9b59b6 !important;
        }
    </style>
</head>
<body class="customBG text-right">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-2" style="padding-left:0">
                <div class="card">
                    <div class="card-body">
                        کاربر جدید
                        <hr>
                        <img src="newuser.gif" style="max-width: 100%">
                        <form id="formNewUser" action="<?php echo $adminPage; ?>" method="post">
                            <label class="w-100">
                                <small>نام کاربری (انگلیسی و اعداد)</small>
                                <input type="text" class="form-control" dir="ltr" name="newusername">
                            </label><br>
                            <label class="w-100">
                                <small>انقضا (روز)</small>
                                <input type="number" class="form-control" dir="ltr" name="newuserexpire">
                            </label><br>
                            <label class="w-100">
                                <small>محدودیت (GB)</small>
                                <input type="number" value="0" class="form-control" dir="ltr" name="newuserTotal">
                            </label><br>
                            <input type="hidden" name="port" value="<?php echo $newPort; ?>">
                            <button class="btn btn-danger customBG w-100 d-block">ایجاد کاربر جدید</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <?php
                        try{
                            @session_start();
                            $showNewVer = false;
                            if(isset($_SESSION['isNewVer']) && $_SESSION['isNewVer']==true){
                                $showNewVer = true;
                            }
                            else if(!isset($_SESSION['isNewVer'])){
                                $lastver = file_get_contents("https://raw.githubusercontent.com/devsiran/x-ui-new-panel/main/ver.txt");
                                $lastver = floatval($lastver);
                                $curver = file_get_contents("ver.txt");
                                $curver = floatval($curver);
                                if($lastver>$curver){
                                    $showNewVer = true;
                                }
                                $_SESSION['isNewVer'] = $showNewVer;
                            }
                            
                            if($showNewVer == true){
                                ?>
                                <div class="alert alert-info">New Version Available > <a href="https://github.com/devsiran/x-ui-new-panel" target="_blank">https://github.com/devsiran/x-ui-new-panel</a></div>
                                <?php
                            }
                        }
                        catch (Exception $e){
        
                        }
                            foreach($logs as $l){
                                echo '<div class="alert alert-' . $l[0] . '">' . $l[1] . '</div>';
                            }
                        ?>
                        <!-- <div style="float:left"> 
                            <form method="post" action="<?php echo $adminPage; ?>" onsubmit="return confirm('مطمئنید؟')">
                                <input type="hidden" name="restartServer" value="1">
                                <button type="submit" class="btn text-white customBG btn-sm">ری استارت سرور</button>
                            </form>
                        </div> -->
                        <?php
                            $cfiles = array_diff(scandir("./connections/"), array('.', '..'));
                            if(count($cfiles)<2){
                                ?>
                        <div style="float:left"> 
                            <a href="servinst.php" target="_blank" class="mx-2 btn text-white customBG btn-sm">نصب سیستم تحلیل آی پی</a>
                        </div>
                                <?php
                            }
                        ?>
                        لیست کاربران
                        (<strong id="myusercount"></strong> / <?php echo $admins[$adusername][2]; ?>)
                        <hr>
                        <?php
                            if($_SESSION['adusername']=="admin"){
                                ?>
                                <div class="btn-group btn-group-sm w-100 mb-2" dir="ltr">
                                    <button onclick="changeAdmin(this)" id="admin_all" class="iiadmin btn btn-secondary customBG">همه</button>
                                    <?php
                                    foreach($admins as $k=>$v){
                                        ?>
                                        <button onclick="changeAdmin(this)" id="admin_<?php echo $k; ?>" class="iiadmin btn btn-light"><?php echo $k; ?></button>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <div>
                                <input onkeyup="doSearch(this)" class="form-control" type="text" placeholder="جستجو" />
                            </div>
                            <div class="btn-group btn-group-sm" dir="ltr">
                                <button onclick="changeFilter(this)" id="filter_expire" class="btn btn-light">پایان انقضا</button>
                                <button onclick="changeFilter(this)" id="filter_volume" class="btn btn-light">پایان حجم</button>
                                <button onclick="changeFilter(this)" id="filter_disabled" class="btn btn-light">غیرفعال</button>
                                <button onclick="changeFilter(this)" id="filter_enabled" class="btn btn-light">فعال</button>
                                <button onclick="changeFilter(this)" id="filter_all" class="btn btn-secondary customBG">همه</button>
                            </div>
                        </div>
                        <style id="filter_style"></style>
                        <style id="search_style"></style>
                        <style id="admin_style"></style>
                        <script>
                            function changeAdmin(e){
                                $(".iiadmin").attr('class', 'iiadmin btn btn-light')
                                e.className = "iiadmin btn btn-secondary customBG";
                                if(e.id=="admin_all"){
                                    document.getElementById("admin_style").innerHTML="";
                                }
                                else{
                                    document.getElementById("admin_style").innerHTML=".itbl tbody tr:not([admin='" + e.id + "']){display:none;}";
                                }
                            }
                            function changeFilter(e){
                                document.getElementById("filter_all").className = "btn btn-light";
                                document.getElementById("filter_enabled").className = "btn btn-light";
                                document.getElementById("filter_disabled").className = "btn btn-light";
                                document.getElementById("filter_volume").className = "btn btn-light";
                                document.getElementById("filter_expire").className = "btn btn-light";
                                e.className = "btn btn-secondary customBG";
                                if(e.id=="filter_all"){
                                    document.getElementById("filter_style").innerHTML="";
                                }
                                else{
                                    document.getElementById("filter_style").innerHTML=".itbl tbody tr:not([" + e.id + "]){display:none;}";
                                }
                            }
                            function doSearch(e){
                                if(e.value==""){
                                    document.getElementById("search_style").innerHTML="";
                                }
                                else{
                                    document.getElementById("search_style").innerHTML=".itbl tbody tr:not([remark*='" + e.value + "']){display:none;}";
                                }
                            }
                        </script>
                        <br>
                        <div class="table-responsive">
                            <table class="itbl table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th>ID</th>-->
                                        <th>نام</th>
                                        <th>پورت</th>
                                        <th>انقضا</th>
                                        <th>حجم مصرفی</th>
                                        <th>محدودیت</th>
                                        <th>ب ا</th>
                                        <th>آ ا</th>
                                        <th>وضعیت</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $muser = "";
                                    foreach($users as $u){
                                        $coName = $pre_mark_connection . $u->remark;
                                        if($_SESSION['adusername']=="zahra"){
                                            $coName = "%F0%9F%87%A9%F0%9F%87%AA%20%D8%A2%D9%84%D9%85%D8%A7%D9%86%20%40vpnttu";
                                        }
                                        if(!in_array($u->id,$myUserIds) && $_SESSION['adusername']!="admin"){continue;}
                                        $i++;
                                        
                                        if(file_exists($connectionsFolder . $u->port . ".cnt")){
                                            $rr = json_decode(file_get_contents($connectionsFolder . $u->port . ".cnt"));
                                            if (($key = array_search("91.247.171.133", $rr)) !== false) {
                                                unset($rr[$key]);
                                            }
                                            $n_all = json_encode($rr);
                                            $noc_all =  count($rr);
                                        }
                                        else{
                                            $n_all = json_encode([]);
                                            $noc_all = "-";
                                        }
                                        
                                        if(file_exists($connectionsFolder . $u->port . ".last")){
                                            $rr = json_decode(file_get_contents($connectionsFolder . $u->port . ".last"));
                                            if (($key = array_search("91.247.171.133", $rr)) !== false) {
                                                unset($rr[$key]);
                                            }
                                            $n_last = json_encode($rr);
                                            $noc_last = count($rr);
                                        }
                                        else{
                                            $n_last = json_encode([]);
                                            $noc_last = "-";
                                        }
                                        
                                        foreach($aduserlist as $n=>$v){
                                            if(in_array($u->id,$v)){
                                                $muser = "<small class='text-danger'>" . $n . "</small>";
                                                $nuser = $n;
                                            }
                                        }
                                        ?>
                                    <tr admin="admin_<?php echo $nuser; ?>" remark="<?php echo $u->remark; ?>" <?php if($u->enable){echo "filter_enabled";} ?> <?php if(!$u->enable){echo "filter_disabled";} ?> <?php if(intval(($u->total==0?0:(($u->up + $u->down)/($u->total))) * 100)>99){echo "filter_volume";} ?> <?php if($u->expiryTime!=0 && ((intval((($u->expiryTime/1000) - time()) / (60*60*24))+1)<=0)){echo "filter_expire";} ?> uuid="<?php echo $u->id; ?>" onclick="this.classList.toggle('selecteddd')" <?php if($_SESSION['adusername']=="admin"){
                                        
                                        if($muser=="<small class='text-danger'>admin</small>"){
                                            echo "style='background: #fff'";
                                        }
                                        else{
                                            echo "style='background: #0000ff11'";
                                        }
                                    } ?>>
                                    <td><?php echo $i; ?></td>
                                    <!--<td><?php echo $u->id; ?></td>-->
                                    <td><?php echo $u->remark . "<br>" . $muser; ?></td>
                                    <td><?php echo $u->port; ?></td>
                                    <td><?php echo ($u->expiryTime==0?'بی نهایت':((intval((($u->expiryTime/1000) - time()) / (60*60*24))+1) . " روز")); ?>&nbsp;<a href="javascript:;" onclick="editExpire(<?php echo $u->id; ?>,<?php echo intval(((($u->expiryTime/1000) - time()) / (60*60*24))+1); ?>)">✏️</a></td>
                                    <td style="background: #9b59b6<?php
                                        if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 10){
                                            echo "00";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 20){
                                            echo "11";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 30){
                                            echo "22";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 40){
                                            echo "33";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 50){
                                            echo "44";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 60){
                                            echo "55";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 70){
                                            echo "66";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 80){
                                            echo "77";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 90){
                                            echo "88";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 100){
                                            echo "99";
                                        }
                                        else if((($u->up + $u->down) / (1024 * 1024 * 1024)) < 200){
                                            echo "aa";
                                        }
                                        else{
                                            echo "ff";
                                        }
                                    ?>" dir="ltr" style="text-align: left;">
                                        ↑ <?php echo getByteText($u->up); ?><br>
                                        ↓ <?php echo getByteText($u->down); ?><br>
                                        ↕️ <?php echo getByteText($u->up + $u->down); ?><br>
                                    </td>
                                    <?php
                                        if($u->total!=0){
                                            $percent = intval((($u->up + $u->down)/$u->total) * 100);
                                            if($percent>100){
                                                $percent = 100;
                                            }
                                        }
                                        else{
                                            $percent = 0;
                                        } 
                                        ?>
                                    <td dir="ltr" style="background: <?php if($percent>=99){echo '#ff000099';}else if($percent>80){echo '#ffff0077';} ?>">
                                        <?php echo ($u->total==0?'نامحدود':getByteText($u->total)); ?>
                                        &nbsp;<a href="javascript:;" onclick="editTotal(<?php echo $u->id; ?>,<?php echo intval(($u->total/(1024*1024*1024))); ?>)">✏️</a>
                                        <?php
                                        if($u->total!=0){
                                            $percent = intval((($u->up + $u->down)/$u->total) * 100);
                                            if($percent>100){
                                                $percent = 100;
                                            }
                                            ?>
                                            <div class="progress" style="height: 3px;box-shadow: 0 0 5px #00000033">
                                              <div class="progress-bar" role="progressbar" style="width: <?php echo $percent; ?>%;" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td data-toggle="modal" data-target="#exampleModal" onclick='showIpInfo(<?php echo $n_all; ?>)' style="<?php
                                        if(intval($noc_all)>=10){
                                            echo 'background: #e74c3c';
                                        }
                                        else if(intval($noc_all)>=7){
                                            echo 'background: #9b59b6';
                                        }
                                        else if(intval($noc_all)>=5){
                                            echo 'background: #9b59b6aa';
                                        }
                                        else if(intval($noc_all)>=4){
                                            echo 'background: #9b59b677';
                                        }
                                        else if(intval($noc_all)>=3){
                                            echo 'background: #9b59b644';
                                        }
                                        else if(intval($noc_all)>=2){
                                            echo 'background: #9b59b622';
                                        }
                                    ?>">
                                        <?php
                                        echo $noc_all;
                                        ?>
                                    </td>
                                    <td data-toggle="modal" data-target="#exampleModal" onclick='showIpInfo(<?php echo $n_last; ?>)' style="<?php
                                        if(intval($noc_last)>=10){
                                            echo 'background: #e74c3c';
                                        }
                                        else if(intval($noc_last)>=7){
                                            echo 'background: #9b59b6';
                                        }
                                        else if(intval($noc_last)>=5){
                                            echo 'background: #9b59b6aa';
                                        }
                                        else if(intval($noc_last)>=4){
                                            echo 'background: #9b59b677';
                                        }
                                        else if(intval($noc_last)>=3){
                                            echo 'background: #9b59b644';
                                        }
                                        else if(intval($noc_last)>=2){
                                            echo 'background: #9b59b622';
                                        }
                                    ?>">
                                        <?php
                                        echo $noc_last;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($u->enable){
                                                ?>
                                                <form method="post" action="<?php echo $adminPage; ?>">
                                                    <input type="hidden" name="deactiveUser" value="<?php echo $u->id; ?>">
                                                    <button type="submit" class="btn btn-outline-success btn-sm">فعال</button>
                                                </form>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <form method="post" action="<?php echo $adminPage; ?>">
                                                    <input type="hidden" name="activeUser" value="<?php echo $u->id; ?>">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">غیرفعال</button>
                                                </form>
                                                <?php
                                            }
                                        ?>
                                        <form method="post" action="<?php echo $adminPage; ?>" onsubmit="return confirm('حذف شود؟');">
                                            <input type="hidden" name="deleteUser" value="<?php echo $u->id; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>
                                        </form>
                                    </td>
                                    <td class="ilinks"> 
                                        <div class="nimBahaLinks">
                                            <button onclick="setConfInfos('<?php echo $u->remark; ?>',<?php echo $u->port; ?>)" type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalConfig">
                                              کانفیگ
                                            </button>
                                            <!--<a style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" href="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=<?php echo urlencode('trojan://' . $u->remark . '@' . $uriAsli . ':' . $u->port . '?security=tls&alpn=h2,http/1.1&host=speedtest.net&fp=safari&type=tcp&sni=speedtest.net&allowInsecure=true#' . $pre_mark_connection . $u->remark); ?>_NEW" target="_blank" class="btn btn-sm btn-dark">QR</a>  -->
                                            <!--<button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" class="btn btn-sm btn-dark" onClick="copyToClipboard('trojan://<?php echo $u->remark; ?>@<?php echo $uriAsli; ?>:<?php echo $u->port; ?>?security=tls&alpn=h2,http/1.1&host=speedtest.net&fp=safari&type=tcp&sni=speedtest.net&allowInsecure=true#<?php echo ($pre_mark_connection . $u->remark); ?>_NEW')">کپی</button>-->
                                            <!--<button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" class="btn btn-sm" onclick="this.parentNode.classList.remove('ushow');$('.allLinksOrig').show();">⬅</button>-->
                                        </div>
                                        <div style="display:none;" class="fullLinks">
                                            <a style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" href="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=<?php echo urlencode('trojan://' . $u->remark . '@' . $uriMostaghim . ':' . $u->port . '?security=tls&headerType=none&type=tcp&sni=' . $uriAsli . '#' . $coName); ?>" target="_blank" class="btn btn-sm btn-light">QR</a>
                                            <button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" class="btn btn-sm btn-light" onClick="copyToClipboard('trojan://<?php echo $u->remark; ?>@<?php echo $uriMostaghim; ?>:<?php echo $u->port; ?>?security=tls&headerType=none&type=tcp&sni=<?php echo $uriAsli; ?>#<?php echo ($coName); ?>')">کپی</button>
                                            <button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" class="btn btn-sm" onclick="this.parentNode.classList.remove('ushow');$('.allLinksOrig').show();">⬅</button>
                                        </div>
                                        <div style="display:none" class="allLinks">
                                            <a style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" href="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=<?php echo urlencode('trojan://' . $u->remark . '@' . $uriMostaghim . ':' . $u->port . '?security=tls&headerType=none&type=tcp&sni=' . $uriAsli . '#' . $pre_mark_connection . $u->remark . "_MTN\n" . 'trojan://' . $u->remark . '@' . $uriNimBaha . ':' . $u->port . '?security=tls&headerType=none&type=tcp&sni=' . $uriAsli . '#' . $pre_mark_connection . $u->remark); ?>_MCI" target="_blank" class="btn btn-sm btn-light">QR</a>
                                            <button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" class="btn btn-sm btn-light" onClick="copyToClipboard('trojan://<?php echo $u->remark; ?>@<?php echo $uriMostaghim; ?>:<?php echo $u->port; ?>?security=tls&headerType=none&type=tcp&sni=<?php echo $uriAsli; ?>#<?php echo ($pre_mark_connection . $u->remark); ?>_MTN\ntrojan://<?php echo $u->remark; ?>@<?php echo $uriNimBaha; ?>:<?php echo $u->port; ?>?security=tls&headerType=none&type=tcp&sni=<?php echo $uriAsli; ?>#<?php echo ($pre_mark_connection . $u->remark); ?>_MCI')">کپی</button>
                                            <button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" class="btn btn-sm" onclick="this.parentNode.classList.remove('ushow');$('.allLinksOrig').show();">⬅</button>
                                        </div>
                                        <div style="display:none;" class="allLinks allLinksOrig">
                                            <button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" onclick="this.parentNode.style.display='none';this.parentNode.parentNode.getElementsByClassName('fullLinks')[0].classList.add('ushow')" class="btn btn-sm btn-light">ایرانسل</button>
                                            <button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" onclick="this.parentNode.style.display='none';this.parentNode.parentNode.getElementsByClassName('nimBahaLinks')[0].classList.add('ushow')" class="btn btn-sm btn-dark">همراه اول</button>
                                            <button style="min-width: 30px;display:inline-block;font-size: 11px;padding: 5px 2px;" onclick="this.parentNode.style.display='none';this.parentNode.parentNode.getElementsByClassName('allLinks')[0].classList.add('ushow')" class="btn btn-sm btn-dark">هردو</button>
                                        </div>
                                    </td>
                                    </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("myusercount").innerHTML = <?php echo $i; ?>;
        if(<?php echo $i; ?>>=<?php echo $admins[$adusername][2]; ?>){
            document.getElementById("formNewUser").innerHTML = '<div class="alert alert-warning">حداکثر تعداد کاربر</div>';
        }
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">آی پی های متصل</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -1rem !important">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <th>#</th>
                    <th>آی پی</th>
                    <th>کشور</th>
                    <th>سرویس</th>
                </thead>
                <tbody id="myModalBody">
                    
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div style="display:none;">
        <form action="<?php echo $adminPage; ?>" method="post" id="ccchange">
            <input type="text" name="ccid" id="ccid">
            <input type="text" name="cctime" id="cctime">
            <button type="submit">ok</button>
        </form>
    </div>
    <div style="display:none;">
        <form action="<?php echo $adminPage; ?>" method="post" id="clchange">
            <input type="text" name="clid" id="clid">
            <input type="text" name="clval" id="clval">
            <button type="submit">ok</button>
        </form>
    </div>
    
    
    
    
    <div dir="ltr" class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="modalConfigLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalConfigLabel">ایجاد کانفیگ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div dir="ltr" class="modal-body">
            <label class="w-100">
                sni:
                <select onchange="updateConfigButtons()" id="confOptSNI" class="form-control">
                    <option selected>aparat.com</option>
                    <option>speedtest.net</option>
                    <option>dl.yasdl.com</option>
                    <option>arvancloud.ir</option>
                    <option>nobitex.ir</option>
                    <option>facenama.com</option>
                </select>
            </label>
            <br><br>
            <label class="w-100">
                FingerPrint:
                <select onchange="updateConfigButtons()" id="confOptFP" class="form-control">
                    <option selected>chrome</option>
                    <option>firefox</option>
                    <option>safari</option>
                    <option>random</option>
                </select>
            </label>
          </div>
          <div class="modal-footer">
              <input type="text" id="showConfCpy" class="form-control" readonly />  
            <button onClick="gotoCopy()" type="button" class="btn btn-primary btn-sm">کپی</button>
            <a href="#" target="_blank" id="showConfQR" type="button" class="btn btn-primary btn-sm">QR</a>
          </div>
        </div>
      </div>
    </div>




        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <input type="hidden" id="userRemark" />
    <input type="hidden" id="userPort" />
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        setInterval(function(){
            updateConfigButtons();
        },2000);
        function gotoCopy(){
            var $temp = $("#showConfCpy");
            $temp.select();
            document.execCommand("copy");
        }
        function setConfInfos(rem,por){
            document.getElementById("userRemark").value = rem;
            document.getElementById("userPort").value = por;
            updateConfigButtons();
        } 
        function updateConfigButtons(){
            var userRemark = document.getElementById("userRemark").value;
            var userPort = document.getElementById("userPort").value;
            document.getElementById("showConfQR").href="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=trojan%3A%2F%2F" + userRemark + "%40<?php echo $uriAsli; ?>%3A" + userPort + "%3Fsecurity%3Dtls%26alpn%3Dh2%2Chttp%2F1.1%26host%3D" + document.getElementById("confOptSNI").value + "%26fp%3D" + document.getElementById("confOptFP").value + "%26type%3Dtcp%26sni%3D" + document.getElementById("confOptSNI").value + "%26allowInsecure%3Dtrue%23<?php echo $serverName; ?>_" + userRemark
            document.getElementById("showConfCpy").value = "trojan://" + userRemark + "@<?php echo $uriAsli; ?>:" + userPort + "?security=tls&alpn=h2,http/1.1&host=" + document.getElementById("confOptSNI").value + "&fp=" + document.getElementById("confOptFP").value + "&type=tcp&sni=" + document.getElementById("confOptSNI").value + "&allowInsecure=true#<?php echo $serverName; ?>_" + userRemark;
        }
        function copyToClipboard(txt) {
                var $temp = $("<textarea>");
                $("body").append($temp);
                $temp.val(txt).select();
                document.execCommand("copy");
                $temp.remove();
            }
        function editExpire(id,def){
            let res = prompt("Set Expire (days)", def);
            if (res != null) {
                document.getElementById("ccid").value = id;
                document.getElementById("cctime").value = res;
                document.getElementById("ccchange").submit();
            }
        }
        function editTotal(id,def){
            let res = prompt("Edit Limit (GB)", def);
            if(res != null){
                document.getElementById("clid").value = id;
                document.getElementById("clval").value = res;
                document.getElementById("clchange").submit();
            }
        }
        function showIpInfo(ips){
            $("#myModalBody").html("");
            let h;
            for(let i=0;i<ips.length;i++){
                h = '<tr>';
                h += '<td>' + (i+1) + '</td>';
                h += '<td>' + ips[i] + '</td>';
                h += '<td id="iploc_' + i + '"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></td>';
                h += '<td id="ipser_' + i + '"><div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div></td>';
                h += '</tr>';
                $("#myModalBody").append(h);
                getIpDetails(ips[i],i);
                
            }
        }
        function getIpDetails(ip,i){
            if(i>10){
                $("#iploc_" + i).html("-");
                $("#ipser_" + i).html("-");
                return false;
            }
            $.get("/ip.php?ip=" + ip, function(data, status){
                data = JSON.parse(data);
                if(data.status=='success'){
                    $("#iploc_" + i).html(data.country + " / " + data.city);
                    $("#ipser_" + i).html(data.isp);
                }
                else{
                    $("#iploc_" + i).html("-");
                    $("#ipser_" + i).html("-");
                }
            });
        }
        
        function showConf(){
            let list = document.getElementsByClassName("selecteddd")
            let res = [];
            for(let i=0;i<list.length;i++){
                res.push({
                    id: list[i].getAttribute("uuid"),
                    created: "2023-03-18 13:37:53"
                });
            }
            $("body").html(JSON.stringify(res));
        }
    </script>
    <style>
        .ilinks .btn{
            min-width: 60px;
        }
        @keyframes showWithBlur{
            0%{ 
                filter: blur(10px);
            }
            100%{
                filter: blur(0); 
            }
        }
        .ushow{
            animation: showWithBlur 1s 0s ease 1;
            display: block !important;
        }
        /*.selecteddd{*/
        /*    background: red !important; */
        /*}*/
    </style>
    <!--<button onclick="showConf()">OOO</button>-->
</body>
</html>
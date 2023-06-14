<?php
$conf = file_get_contents("serverconfig.php");

// Check XUI Panel
if(str_contains($conf,"{xuiPanel:Port}")){
    if(isset($_POST['xuiaddress'],$_POST['xuiusername'],$_POST['xuipassword'])){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $_POST['xuiaddress'] . '/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=" . $_POST['xuiusername'] . "&password=" . $_POST['xuipassword']);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        $headers = array();
        $headers[] = 'Accept: application/json, text/plain, */*';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Cookie: lang=en-US';
        $headers[] = 'Origin: https://' . $_POST['xuiaddress'];
        $headers[] = 'Referer: https://' . $_POST['xuiaddress'] . '/';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.43';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'Sec-Ch-Ua: ^^Not.A/Brand^^\";v=^^\"8^^\",';
        $headers[] = 'Sec-Ch-Ua-Mobile: ?0';
        $headers[] = 'Sec-Ch-Ua-Platform: ^^Windows^^\"\"';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        list($header, $result) = explode("\r\n\r\n", $response, 2);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $result = json_decode($result);
        if($result->success){
            $icookie = explode(";",explode("Set-Cookie:",$header)[1])[0];
            $conf = str_replace("{xuiCookie}",$icookie,$conf);
            $conf = str_replace("{xuiPanel:Port}",$_POST['xuiaddress'],$conf);
            $conf = str_replace("{serverDNS}",explode(":",$_POST['xuiaddress'])[0],$conf);
            file_put_contents("serverconfig.php",$conf);
        }
        else{
            echo 'Login failed! <a href="">Try Again</a>';
            exit();
        }
    }
    else{
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        Connect X-Ui Panel
                        <hr>
                        <form action="" method="post">
                            <small class="text-black-50">x-ui panel address:port without www and http</small>
                            <input name="xuiaddress" type="text" class="form-control form-control-sm" placeholder="ex: panel.site.com:888">
                            <br>
                            <small class="text-black-50">x-ui panel Login username</small>
                            <input name="xuiusername" type="text" class="form-control form-control-sm" placeholder="ex: admin">
                            <br>
                            <small class="text-black-50">x-ui panel Login password</small>
                            <input name="xuipassword" type="text" class="form-control form-control-sm" placeholder="ex: 1234">
                            <br>
                            <button class="btn btn-success w-100 d-block btn-sm">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    <?php
    exit("");
    }
}

if(str_contains($conf,"{adminPassword}") || str_contains($conf,"{xui-address}")){
    if(isset($_POST['adminPassword'],$_POST['xuifolderaddress'])){
        $conf = str_replace("{xui-address}",$_POST['xuifolderaddress'],$conf);
        $conf = str_replace("{adminPassword}",$_POST['adminPassword'],$conf);
        file_put_contents("serverconfig.php",$conf);
    }
    else{
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        Setup
                        <hr>
                        <form action="" method="post">
                            <small class="text-black-50">x-ui Folder Address</small>
                            <input name="xuifolderaddress" type="text" class="form-control form-control-sm" placeholder="ex: /xui/" value="/xui/">
                            <br>
                            <small class="text-black-50">x-ui admin password</small>
                            <input name="adminPassword" type="password" class="form-control form-control-sm" placeholder="ex: 1234">
                            <br>
                            <button class="btn btn-success w-100 d-block btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    <?php
    exit("");
    }
}
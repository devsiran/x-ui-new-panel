<?php

if(isset($_POST['log'])){
    $log = $_POST['log'];
    // file_put_contents("ssss.txt",$log);
    try{
        if(file_exists("./servinst.php")){
            unlink("./servinst.php");
        }
        if(file_exists("./ser.sh")){
            unlink("./ser.sh");
        }
    }
    catch (Exception $e){
        
    }
    $log = json_decode($log);
    foreach($log as $key=>$value){
        file_put_contents("./connections/" . $key . ".last",json_encode($value));
        if(count($value)>0){
            if(file_exists("./connections/" . $key . ".cnt")){
                $res = json_decode(file_get_contents("./connections/" . $key . ".cnt"));
                if(count($value)>count($res)){
                    file_put_contents("./connections/" . $key . ".cnt",json_encode($value));
                }
            }
            else{
                file_put_contents("./connections/" . $key . ".cnt",json_encode($value));
            }
        }
    }
}
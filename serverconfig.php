<?php

global $panelAddress;
global $panelCookie;
global $connectionsFolder;
global $uriAsli;
global $uriMostaghim;
global $uriNimBaha;
global $pre_mark_connection;
global $panelAddress;
global $xuiaddress;
global $serverName;

$serverName = "VPN";

$xuiaddress = "{xui-address}";
$adminPage = "index.php";

$panelAddress = "{xuiPanel:Port}";
$panelCookie = "Cookie: {xuiCookie}";

$connectionsFolder = "./connections/";

$uriAsli = "{serverDNS}";
$uriMostaghim = "{serverDNS}";
$uriNimBaha = "{serverDNS}";

$pre_mark_connection = "VPN_";


$admins = [
    "admin" => ["{adminPassword}","ad.users",500]
];


function restartServer(){
    echo "function to restart server";
}
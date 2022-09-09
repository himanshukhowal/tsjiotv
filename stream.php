<?php
require('token.php');

$crm = $creds['sessionAttributes']['user']['subscriberId'];
$uniqueId = $creds['sessionAttributes']['user']['unique'];

if (@$_REQUEST["key"] != "") {
    $headers = array(
        'appkey' => 'NzNiMDhlYzQyNjJm',
        'channelid' => '0',
        'crmid' => "$crm",
        'deviceId' => '3022048329094879',
        'devicetype' => 'phone',
        'isott' => 'true',
        'languageId' => '6',
        'lbcookie' => '1',
        'os' => 'android',
        'osVersion' => '5.1.1',
        'srno' => '200206173037',
        'ssotoken' => "$ssoToken",
        'subscriberId' => "$crm",
        'uniqueId' => "$uniqueId",
        'User-Agent' => 'plaYtv/6.0.9 (Linux; Android 5.1.1) ExoPlayerLib/2.13.2',
        'True-Client-IP' => '205.254.172.105',
        'CLIENT-IP' => '205.254.172.105',
        'X-FORWARDED-FOR' => '205.254.172.105',
        'X-Real-IP' => '205.254.172.105',
        'CF-Connecting-IP' => '205.254.172.105',
        'x-original-forwarded-for' => '205.254.172.105',
        'usergroup' => 'tvYR7NSNn7rymo3F',
        'versionCode' => '260'
    );
    $opts = ['http' => ['method' => 'GET', 'header' => "appkey: NzNiMDhlYzQyNjJm\r\nchannelid: 0\r\ncrmid: " . $crm . ",deviceId: 3022048329094879\r\ndevicetype: phone\r\nisott: true\r\nlanguageId: 6\r\nlbcookie: 1\r\nos: android\r\nosVersion: 5.1.1\r\nsrno: 200206173037\r\nssotoken: " . $ssoToken . ",subscriberId: " . $crm . ",uniqueId: " . $uniqueId . ",User-Agent: plaYtv/6.0.9 (Linux; Android 5.1.1) ExoPlayerLib/2.13.2\r\nTrue-Client-IP: 205.254.172.105\r\nCLIENT-IP: 205.254.172.105\r\nX-FORWARDED-FOR: 205.254.172.105\r\nX-Real-IP: 205.254.172.105\r\nCF-Connecting-IP: 205.254.172.105\r\nx-original-forwarded-for: 205.254.172.105\r\nusergroup: tvYR7NSNn7rymo3F\r\nversionCode: 260"]];

    $cache = str_replace("/", "_", $_REQUEST["key"]);

    if (!file_exists($cache)) {
        $context = stream_context_create($opts);
        error_log(print_r($opts, TRUE)); 
        $haystack = file_get_contents("https://tv.media.jio.com/streams_live/" . $_REQUEST["key"] . $token, false, $context);
    } else {
        $haystack = file_get_contents($cache);

    }
    echo $haystack;
}

if (@$_REQUEST["ts"] != "") {
    header("Content-Type: video/mp2t");
    header("Connection: keep-alive");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Expose-Headers: Content-Length,Content-Range");
    header("Access-Control-Allow-Headers: Range");
    header("Accept-Ranges: bytes");
    $opts = ["http" => ["method" => "GET", "header" => "User-Agent: plaYtv/6.0.9 (Linux; Android 5.1.1) ExoPlayerLib/2.13.2\r\nCLIENT-IP: 205.254.172.105\r\nX-FORWARDED-FOR: 205.254.172.105"]];

    $context = stream_context_create($opts);
    $haystack = file_get_contents("https://jiotv.live.cdn.jio.com/" . $_REQUEST["ts"], false, $context);
    echo $haystack;
}
?>
<?php
header('Content-Type: application/json; charset=utf-8');

$lineId = $_GET['lineId'];

if ($lineId == 'A') {
    $url = 'https://api-public.odpt.org/api/v4/odpt:Train?'
        .'odpt:operator=odpt.Operator:Toei&odpt:railway=odpt.Railway:Toei.Asakusa';
    echo http_get($url);
} else {
    echo '{}';
}

function http_get($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
?>

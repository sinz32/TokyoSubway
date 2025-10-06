<?php
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');

$lineId = $_GET['lineId'];

if ($lineId == 'A') {
    $url = 'https://api-public.odpt.org/api/v4/odpt:Train?'
        .'odpt:operator=odpt.Operator:Toei&odpt:railway=odpt.Railway:Toei.Asakusa';
    $data = json_decode(http_get($url), true);
    $stn_ist = ['NishiMagome','Magome','Nakanobu','Togoshi','Gotanda','Takanawadai','Sengakuji','Mita','Daimon','Shimbashi','HigashiGinza','Takaracho','Nihombashi','Ningyocho','HigashiNihombashi','Asakusabashi','Kuramae','Asakusa','HonjoAzumabashi','Oshiage'];
    $stn_ist_ja = ['西馬込','馬込','中延','戸越','五反田','高輪台','泉寺','三田','大門','新橋','東銀座','宝町','日本橋','人形町','東日本橋','浅草橋','蔵前','浅草','本所吾橋','押上'];
    $stn_ist_ko = ['니시마고메','마고메','나카노부','토고시','고탄다','타카나와다이','센가쿠지','미타','다이몬','신바시','히가시긴자','타카라초','니혼바시','닌교초','히가시니혼바시','아사쿠사바시','쿠라마에','아사쿠사','혼조아즈마바시','오시아게'];

    for($n=0;$n<count($data);$n++){
        $datum = $data[$n];
        $stn = $data[$n]['odpt:toStation'];
        $sts = '접근';
        if ($stn == null) {
            $stn = $data[$n]['odpt:fromStation'];
            $sts = '도착';
        }
        $stn = explode('.', $stn);
        $stn = $stn[count($stn)-1];
        $terminal = explode('.', $data[$n]['odpt:destinationStation']);
        $data[$n] = array(
            'no' => $data[$n]['odpt:trainNumber'],
            'stn' => $stn,
            'sts' => $sts,
            'terminal' => $terminal[count($terminal)-1]
        );
    }

    $result = array();
    for($n=0;$n<count($stn_ist);$n++){
        $result[$n] = array(
            'stn' => $stn_ist_ja[$n].' ('.$stn_ist_ko[$n].')',
            'up' => array(),
            'down' => array()
        );

    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);

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

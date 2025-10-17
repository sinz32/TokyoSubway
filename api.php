<?php
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Asia/Seoul');

$lineId = $_GET['lineId'];

if ($lineId == 'A' || $lineId == 'I' || $lineId == 'S' || $lineId == 'E') {
    $railway = array(
        'A' => 'Asakusa',
        'I' => 'Mita',
        'S' => 'Shinjuku',
        'E' => 'Oedo'
    );
    $url = 'https://api-public.odpt.org/api/v4/odpt:Train?'
        .'odpt:operator=odpt.Operator:Toei&odpt:railway=odpt.Railway:Toei.'.$railway[$lineId];
    $data = json_decode(http_get($url), true);

    if ($lineId == 'A') {
        $stn_list = ['NishiMagome','Magome','Nakanobu','Togoshi','Gotanda','Takanawadai','Sengakuji','Mita','Daimon','Shimbashi','HigashiGinza','Takaracho','Nihombashi','Ningyocho','HigashiNihombashi','Asakusabashi','Kuramae','Asakusa','HonjoAzumabashi','Oshiage'];
        $stn_list_ja = ['西馬込','馬込','中延','戸越','五反田','高輪台','泉寺','三田','大門','新橋','東銀座','宝町','日本橋','人形町','東日本橋','浅草橋','蔵前','浅草','本所吾橋','押上'];
        $stn_list_ko = ['니시마고메','마고메','나카노부','토고시','고탄다','타카나와다이','센가쿠지','미타','다이몬','신바시','히가시긴자','타카라초','니혼바시','닌교초','히가시니혼바시','아사쿠사바시','쿠라마에','아사쿠사','혼조아즈마바시','오시아게'];
    }
    if ($lineId == 'I') {
        $stn_list = ['Meguro','Shirokanedai','ShirokaneTakanawa','Mita','Shibakoen','Onarimon','Uchisaiwaicho','Hibiya','Otemachi','Jimbocho','Suidobashi','Kasuga','Hakusan','Sengoku','Sugamo','NishiSugamo','ShinItabashi','ItabashiKuyakushomae','Itabashihoncho','Motohasunuma','ShimuraSakaue','ShimuraSanchome','Hasune','Nishidai','Takashimadaira','ShinTakashimadaira','NishiTakashimadaira'];
        $stn_list_ja = ['目黒','白金台','白金高輪','三田','芝公園','御成門','内幸町','日比谷','大手町','神保町','水道橋','春日','白山','千石','巣鴨','西巣鴨','新板橋','板橋区役所前','板橋本町','本蓮沼','志村坂上','志村三丁目','蓮根','西台','高島平','新高島平','西高島平'];
        $stn_list_ko = ['메구로','시로카네다이','시로카네타카나와','미타','시바코엔','오나리몬','우치사이와이초','히비야','오테마치','진보초','스이도바시','카스가','하쿠산','센고쿠','스가모','니시스가모','신이타바시','이타바시쿠야쿠쇼마에','이타바시혼초','모토하스누마','시무라사카우에','시무라산초메','하스네','니시다이','타카시마다이라','신타카시마다이라','니시타카시마다이라'];
    }
    if ($lineId == 'S') {
        $stn_list = ['Shinjuku','ShinjukuSanchome','Akebonobashi','Ichigaya','Kudanshita','Jimbocho','Ogawamachi','Iwamotocho','BakuroYokoyama','Hamacho','Morishita','Kikukawa','Sumiyoshi','NishiOjima','Ojima','HigashiOjima','Funabori','Ichinoe','Mizue','Shinozaki','Motoyawata'];
        $stn_list_ja = ['新宿','新宿三丁目','曙橋','市ヶ谷','九段下','神保町','小川町','岩本町','馬喰横山','浜町','森下','菊川','住吉','西大島','大島','東大島','船堀','一之江','江','篠崎','本八幡'];
        $stn_list_ko = ['신주쿠','신주쿠산초메','아케보노바시','이치가야','쿠단시타','진보초','오가와마치','이와모토초','바쿠로요코야마','하마초','모리시타','키쿠카와','스미요시','니시오지마','오지마','히가시오지마','후나보리','이치노에','미즈에','시노자키','모토야와타'];
    }
    if ($lineId == 'E') {
        $stn_list = ['Tochomae','ShinjukuNishiguchi','HigashiShinjuku','WakamatsuKawada','UshigomeYanagicho','UshigomeKagurazaka','Iidabashi','Kasuga','HongoSanchome','UenoOkachimachi','ShinOkachimachi','Kuramae','Ryogoku','Morishita','KiyosumiShirakawa','MonzenNakacho','Tsukishima','Kachidoki','Tsukijishijo','Shiodome','Daimon','Akabanebashi','AzabuJuban','Roppongi','AoyamaItchome','KokuritsuKyogijo','Yoyogi','Shinjuku','Tochomae','NishiShinjukuGochome','NakanoSakaue','HigashiNakano','Nakai','OchiaiMinamiNagasaki','ShinEgota','Nerima','Toshimaen','NerimaKasugacho','Hikarigaoka'];
        $stn_list_ja = ['都庁前','新宿西口','東新宿','若松河田','牛込柳町','牛込神楽坂','飯田橋','春日','本郷三丁目','上野御徒町','新御徒町','蔵前','両国','森下','清澄白河','門前仲町','月島','勝どき','築地市場','汐留','大門','赤羽橋','麻布十番','六本木','青山一丁目','国立競技場','代々木','新宿','都庁前','西新宿五丁目','中野坂上','東中野','中井','落合南長崎','新江古田','練馬','豊島園','練馬春日町','光が丘'];
        $stn_list_ko = ['도초마에','신주쿠니시구치','히가시신주쿠','와카마츠카와다','우시고메야나기초','우시고메카구라자카','이다바시','카스가','혼고산초메','우에노오카치마치','신오카치마치','쿠라마에','료고쿠','모리시타','키요스미시라카와','몬젠나카쵸','츠키시마','카치도키','츠키지시조','시오도메','다이몬','아카바네바시','아자부쥬반','롯폰기','아오야마잇초메','코쿠리츠쿄기죠','요요기','신주쿠','도초마에','니시신주쿠고초메','나카노사카우에','히가시나카노','나카이','오치아이미나미나가사키','신에고타','네리마','토시마엔','네리마카스가초','히카리가오카'];
    }

    include('toei_terminals.php');
    $is_up = array(
        'A' => 'odpt.RailDirection:Southbound',
        'I' => 'odpt.RailDirection:Southbound',
        'S' => 'odpt.RailDirection:Westbound',
        'E' => 'odpt.RailDirection:InnerLoop'
    );

    for($n=0;$n<count($data);$n++){
        $stn = $data[$n]['odpt:toStation'];
        $sts = '접근';
        if ($stn == null) {
            $stn = $data[$n]['odpt:fromStation'];
            $sts = '도착';
        }

        $stn = explode('.', $stn);
        $stn = $stn[count($stn)-1];

        $terminal = explode('.', $data[$n]['odpt:destinationStation'][0]);
        $terminal = $terminal[count($terminal)-1];
        if(isset($terminals[$terminal])) {
            $terminal = $terminals[$terminal];
        }

        $dir = 'down';
        if ($is_up[$lineId] == $data[$n]['odpt:railDirection']) {
            $dir = 'up';
        }

        $data[$n] = array(
            'no' => $data[$n]['odpt:trainNumber'],
            'stn' => $stn,
            'sts' => $sts,
            'terminal' => $terminal,
            'dir' => $dir 
        );
    }


    $result = array();
    for($n=0;$n<count($stn_list);$n++){
        $result[$n] = array(
            'stn' => $stn_list_ja[$n].' ('.$stn_list_ko[$n].')',
            'up' => array(),
            'down' => array()
        );
        for($m=0;$m<count($data);$m++){
            if ($stn_list[$n] == $data[$m]['stn']) {
                $result[$n][$data[$m]['dir']][] = array(
                    'no' => $data[$m]['no'],
                    'sts' => $data[$m]['sts'],
                    'terminal' => $data[$m]['terminal']
                );
            }
        }
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);

} else if ($lineId == 'H') {

    $stn_list = ['나카메구로','에비스','히로오','롯폰기','카미야쵸','토라노몬힐즈','카스미가세키','히비야','긴자','히가시긴자','츠키지','핫쵸보리','카야바쵸','닌교초','코덴마쵸','아키하바라','나카오카치마치','우에노','이리야','미노와','미나미센쥬','키타센쥬'];
    $result = [];


    $day = date('N');
    if ($day > 5) $file_name = $lineId.'_e'; //주말
    else $file_name = $lineId.'_d';          //평일

    $data = file_get_contents('./timetable/'.$file_name.'.json');
    $data = json_decode($data, true);

    $now = t2m(date('H:i'));
    $trains = [];
    for ($n = 0; $n < count($data); $n++) {
        //아직 출발하지 않은 열차
        $t1 = $data[$n]['time'][0]['t'];
        if ($now < t2m($t1)) continue;

        //운행이 끝난 열차
        $t2 = $data[$n]['time'][count($data[$n]['time']) - 1]['t'];
        if (t2m($t2) < $now) continue;

        //열차가 있어야 할 위치 찾기
        $time = $data[$n]['time'];
        for ($m = count($time) - 1; $m >= 0; $m--) {
            $t = t2m($time[$m]['t']);
            if ($now == $t) { //역 도착
                $stn = $time[$m]['s'];
                break;
            }
            if ($now > $t) { //역 접근
                $stn = $time[$m + 1]['s'];
                break;
            }
        }

        //운행 중인 열차 목록에 열차 추가
        $trains[] = array(
            'no' => $data[$n]['no'],
            'terminal' => $data[$n]['terminal'],
            'type' => $data[$n]['type'],
            'dir' => $data[$n]['dir'],
            'stn' => $stn
        );
    }

    $result = array();
    for($n=0;$n<count($stn_list);$n++){
        $result[$n] = array(
            // 'stn' => $stn_list_ja[$n].' ('.$stn_list_ko[$n].')',
            'stn' => $stn_list[$n],
            'up' => array(),
            'down' => array()
        );
        for($m=0;$m<count($trains);$m++){
            if ($stn_list[$n] == $trains[$m]['stn']) {
                $result[$n][$trains[$m]['dir']][] = array(
                    'no' => $trains[$m]['no'],
                    'terminal' => $trains[$m]['terminal'],
                    'type' => $trains[$m]['type']
                );
            }
        }
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

function t2m($time){ //time to minutes. h:mm -> min
    $t = explode(':', $time);
    return (int)$t[0]*60 + (int)$t[1];
}

?>

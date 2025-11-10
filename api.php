<?php
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *'); //임시로 넣음
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

} else if ($lineId == 'H' || $lineId == 'G' || $lineId == 'M'
    || $lineId == 'T' || $lineId == 'N' || $lineId == 'Y'
    || $lineId == 'C' || $lineId == 'Z' || $lineId == 'F') {

        
    if ($lineId == 'H') {
        $stn_list = ['나카메구로','에비스','히로오','롯폰기','카미야쵸','토라노몬힐즈','카스미가세키','히비야','긴자','히가시긴자','츠키지','핫쵸보리','카야바쵸','닌교초','코덴마쵸','아키하바라','나카오카치마치','우에노','이리야','미노와','미나미센쥬','키타센쥬'];
        $stn_list_ja = ['中目黒','恵比寿','広尾','六本木','神谷町','虎ノ門ヒルズ','霞ケ関','日比谷','銀座','東銀座','築地','八丁堀','茅場町','人形町','小伝馬町','秋葉原','仲御徒町','上野','入谷','三ノ輪','南千住','北千住'];
    }
    if ($lineId == 'G') {
        $stn_list = ["시부야","오모테산도","가이엔마에","아오야마잇초메","아카사카미츠케","타메이케산노","토라노몬","신바시","긴자","쿄바시","니혼바시","미츠코시마에","칸다","스에히로쵸","우에노히로코지","우에노","이나리초","타와라마치","아사쿠사"];
        $stn_list_ja = ["渋谷","表参道","外苑前","青山一丁目","赤坂見附","溜池山王","虎ノ門","新橋","銀座","京橋","日本橋","三越前","神田","末広町","上野広小路","上野","稲荷町","田原町","浅草"];
    }
    if ($lineId == 'M') {
        $stn_list = ['오기쿠보','미나미아사가야','신코엔지','히가시코엔지','신나카노','나카노사카우에','니시신주쿠','신주쿠','신주쿠산초메','신주쿠교엔마에','요츠야산초메','요츠야','아카사카미츠케','콧카이기지도마에','카스미가세키','긴자','도쿄','오테마치','아와지초','오차노미즈','혼고산초메','코라쿠엔','묘가다니','신오츠카','이케부쿠로',
            '나카노신바시', '나카노후지미초', '호난초'];
        $stn_list_ja = ['荻窪','南阿佐ケ谷','新高円寺','東高円寺','新中野','中野坂上','西新宿','新宿','新宿三丁目','新宿御苑前','四谷三丁目','四ツ谷','赤坂見附','国会議事堂前','霞ケ関','銀座','東京','大手町','淡路町','御茶ノ水','本郷三丁目','後楽園','茗荷谷','新大塚','池袋',
        '中野新橋', '中野富士見町', '方南町'];
    }
    if ($lineId == 'T') {
        $stn_list = ['나카노','오치아이','타카다노바바','와세다','카구라자카','이다바시','쿠단시타','타케바시','오테마치','니혼바시','카야바쵸','몬젠나카쵸','키바','토요쵸','미나미스나마치','니시카사이','카사이','우라야스','미나미교토쿠','교토쿠','묘덴','바라키나카야마','니시후나바시'];
        $stn_list_ja = ['中野','落合','高田馬場','早稲田','神楽坂','飯田橋','九段下','竹橋','大手町','日本橋','茅場町','門前仲町','木場','東陽町','南砂町','西葛西','葛西','浦安','南行徳','行徳','妙典','原木中山','西船橋'];
    }
    if ($lineId == 'N') {
        $stn_list = ['메구로','시로카네다이','시로카네타카나와','아자부쥬반','롯폰기잇초메','타메이케산노','나가타쵸','요츠야','이치가야','이다바시','코라쿠엔','토다이마에','혼코마고메','코마고메','니시가하라','오지','오지카미야','시모','아카바네이와부치'];
        $stn_list_ja = ['目黒','白金台','白金高輪','麻布十番','六本木一丁目','溜池山王','永田町','四ツ谷','市ケ谷','飯田橋','後楽園','東大前','本駒込','駒込','西ケ原','王子','王子神谷','志茂','赤羽岩淵'];
    }
    if ($lineId == 'Y') {
        $stn_list = ['와코시','치카테츠나리마스','치카테츠아카츠카','헤이와다이','히카와다이','코타케무카이하라','센카와','카나메초','이케부쿠로','히가시이케부쿠로','고코쿠지','에도가와바시','이다바시','이치가야','코지마치','나가타쵸','사쿠라다몬','유라쿠초','긴자잇초메','신토미초','츠키시마','토요스','타츠미','신키바'];
        $stn_list_ja = ['和光市','地下鉄成増','地下鉄赤塚','平和台','氷川台','小竹向原','千川','要町','池袋','東池袋','護国寺','江戸川橋','飯田橋','市ケ谷','麴町','永田町','桜田門','有楽町','銀座一丁目','新富町','月島','豊洲','辰巳','新木場'];
    }
    if ($lineId == 'C') {
        $stn_list = ['요요기우에하라','요요기코엔','메이지진구마에<하라주쿠>','오모테산도','노기자카','아카사카','콧카이기지도마에','카스미가세키','히비야','니주바시마에<마루노우치>','오테마치','신오차노미즈','유시마','네즈','센다기','니시닛포리','마치야','키타센쥬','아야세','키타아야세'];
        $stn_list_ja = ['代々木上原','代々木公園','明治神宮前<原宿>','表参道','乃木坂','赤坂','国会議事堂前','霞ヶ関','日比谷','二重橋前<丸の内>','大手町','新御茶ノ水','湯島','根津','千駄木','西日暮里','町屋','北千住','綾瀬','北綾瀬'];
    }
    if ($lineId == 'Z') {
        $stn_list = ['시부야','오모테산도','아오야마잇초메','나가타쵸','한조몬','쿠단시타','진보초','오테마치','미츠코시마에','스이텐구마에','키요스미시라카와','스미요시','킨시쵸','오시아게<스카이트리마에>'];
        $stn_list_ja = ['渋谷','表参道','青山一丁目','永田町','半蔵門','九段下','神保町','大手町','三越前','水天宮前','清澄白河','住吉','錦糸町','押上<スカイツリー前>'];
    }
    if ($lineId == 'F') {
        $stn_list = ['와코시','치카테츠나리마스','치카테츠아카츠카','헤이와다이','히카와다이','코타케무카이하라','센카와','카나메초','이케부쿠로','조시가야','니시와세다','히가시신주쿠','신주쿠산초메','키타산도','메이지진구마에<하라주쿠>','시부야'];
        $stn_list_ja = ['和光市','地下鉄成増','地下鉄赤塚','平和台','氷川台','小竹向原','千川','要町','池袋','雑司が谷','西早稲田','東新宿','新宿三丁目','北参道','明治神宮前<原宿>','渋谷'];
    }

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

    $result = [];
    for($n=0;$n<count($stn_list);$n++){
        $result[$n] = array(
            'stn' => $stn_list_ja[$n].' ('.$stn_list[$n].')',
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

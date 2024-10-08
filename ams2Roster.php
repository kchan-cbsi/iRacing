<?php


// Define a function that converts array to xml.
function arrayToXml($array, $rootElement = null, $xml = null, $driverNbr = null, $carClass=null, $crazy=false) {
    $_xml = $xml;

    $liveries = [
        "GT3" => [
            "Nissan Nismo GT-R GT3 #201",
            "BMW M6 GT3 #2",
            "Mercedes-AMG GT3 #01",
            "Porsche 911 GT3 R #05",
            "McLaren 720S GT3 #04",
            "Nissan Nismo GT-R GT3 #203",
            "BMW M6 GT3 #11",
            "Mercedes-AMG GT3 #09",
            "Porsche 911 GT3 R #10",
            "McLaren 720S GT3 #12",
            "Nissan Nismo GT-R GT3 #205",
            "BMW M6 GT3 #61",
            "Mercedes-AMG GT3 #60",
            "Porsche 911 GT3 R #17",
            "McLaren 720S GT3 #27",
            "Nissan Nismo GT-R GT3 #207",
            "BMW M6 GT3 #83",
            "Mercedes-AMG GT3 #77",
            "Porsche 911 GT3 R #41",
            "McLaren 720S GT3 #90",
            "Nissan Nismo GT-R GT3 #209",
            "BMW M6 GT3 #91",
            "Mercedes-AMG GT3 #81",
            "Porsche 911 GT3 R #75",
            "McLaren 720S GT3 #92",
            "Nissan Nismo GT-R GT3 #211",
            "BMW M6 GT3 #96",
            "Mercedes-AMG GT3 #85",
            "Porsche 911 GT3 R #82",
            "McLaren 720S GT3 #94",
            "Nissan Nismo GT-R GT3 #212",
            "Mercedes-AMG GT3 #99",
            "Porsche 911 GT3 R #93",
        ],
        "F-Ultimate_Gen2" => [
            "Team Virystone #15",
            "Team Virystone #2",
            "Bond G.P. #3",
            "Bond G.P. #5",
            "DNA-US #4",
            "DNA-US #7",
            "Full Force Racing #8",
            "Full Force Racing #10",
            "McLean G.P. #22",
            "McLean G.P. #32",
            "energyX Faenza #98",
            "Strike G.P. #63",
            "Strike G.P. #85",
            "Didcot Racing #1",
            "Didcot Racing #6",
            "Starward G.P. #9",
            "Starward G.P. #18",
            "Scuderia Milano #17",
            "Scuderia Milano #28",
            "energyX Racing #24",
            "energyX Racing #51",
            "Scuderia Forza #45",
            "Scuderia Forza #72",
        ],
        "Cat_Academy" => [
            "Caterham Academy - Tim Childress #00",
            "Caterham Academy - Jim Elvery #03",
            "Caterham Academy - Dave Ripley #05",
            "Caterham Academy - Ben Gilles #05",
            "Caterham Academy - Mike OReilly #33",
            "Caterham Academy - Erick Tyler #41",
            "Caterham Academy - Darin Phillips #99",
        ],
        "Indy" => [
            "A.J Foyt Enterprises #14",
            "A.J Foyt Enterprises #55",
            "Andretti Autosport #26",
            "Andretti Autosport #27",
            "Andretti Autosport #28",
            "Andretti Autosport #29",
            "Arrow McLaren #5",
            "Arrow McLaren #6",
            "Arrow McLaren #7",
            "Chip Ganassi Racing #8",
            "Chip Ganassi Racing #9",
            "Chip Ganassi Racing #10",
            "Chip Ganassi Racing #11",
            "Dale Coyne Racing #18",
            "Dale Coyne Racing #51",
            "Ed Carpenter Racing #20",
            "Ed Carpenter Racing #21",
            "Juncos Hollinger Racing #77",
            "Juncos Hollinger Racing #78",
            "Meyer Shank Racing #06",
            "Meyer Shank Racing #60",
            "Rahal Letterman Lanigan Racing #15",
            "Rahal Letterman Lanigan Racing #30",
            "Rahal Letterman Lanigan Racing #45",
            "Team Penske #2",
            "Team Penske #3",
            "Team Penske #12"
        ],
        "P1" => [
            "JLM Racing #28",
            "JLM Racing #175",
            "JLM Racing #43",
            "JLM Racing #113",
            "JLM Racing #11",
            "JLM Racing #29",
            "MM AJR #58 - S.Rogers Skin",
            "AJR Tubarao #5",
            "NC Racing #65",
            "MM AJR #37 - H.Blom Skin",
            "PMotor Brasil #2",
            "Motikov Sport #15",
            "Motikov Sport #13",
            "Mottin Racing #46",
            "MM AJR #22 - F.Castelloes Skin",
            "MM AJR #62 - R.Sandstorm Skin",
            "MM AJR #40 - D.Emerson Skin",
            "Reiza Engineering #7",
            "VX Endurance #8",
            "MM AJR #30 - P.Tiago Skin",
            "MM AJR #52 - E.Mesquita Skin",
            "MM AJR #84 - J.Billing Skin",
            "Padole Racing #21",
            "Padole Racing #17",
            "MM AJR ##35 - A.Mocanu Skin",
            "Kia Power Imports Racing #80",
            "MM AJR ##55 - P.Papaioannou Skin",
            "MM AJR #10 - E.Sackbauer Skin",
            "Laponi Racing #73",
            "Ginetta G58 #1",
            "Ginetta G58 #22",
            "Ginetta G58 #20",
            "Ginetta G58 #53",
            "Ginetta G58 #21",
            "Ginetta G58 #54",
        ],
        "LMDH" => [
            "Porsche 963 #63",
            "Porsche 963 #64",
            "Porsche 963 #85",
            "Porsche 963 #91",
            "BMW M Hybrid V8 #24",
            "BMW M Hybrid V8 #25",
            "BMW M Hybrid V8 #42",
            "BMW M Hybrid V8 #43",
            "Cadillac V-Series.R #4",
            "Cadillac V-Series.R #5",
            "Cadillac V-Series.R #8",
            "Cadillac V-Series.R #9",
            "Porsche 963 #63",
            "Porsche 963 #64",
            "Porsche 963 #85",
            "Porsche 963 #91",
            "BMW M Hybrid V8 #24",
            "BMW M Hybrid V8 #25",
            "BMW M Hybrid V8 #42",
            "BMW M Hybrid V8 #43",
            "Cadillac V-Series.R #4",
            "Cadillac V-Series.R #5",
            "Cadillac V-Series.R #8",
            "Cadillac V-Series.R #9",
            "Porsche 963 #63",
            "Porsche 963 #64",
            "Porsche 963 #85",
            "Porsche 963 #91",
            "BMW M Hybrid V8 #24",
            "BMW M Hybrid V8 #25",
            "BMW M Hybrid V8 #42",
            "BMW M Hybrid V8 #43",
            "Cadillac V-Series.R #4",
            "Cadillac V-Series.R #5",
            "Cadillac V-Series.R #8",
            "Cadillac V-Series.R #9",
        ],
        "F-Hitech_Gen2" => [
            "Scuderia Forza #3",
            "Scuderia Forza #4",
            "DLA Scuderia Italia #11",
            "DLA Scuderia Italia #12",
            "AntLar Racing #19",
            "AntLar Racing #20",
            "Didcot Racing #0",
            "Didcot Racing #6",
            "Surrey Racing #13",
            "Surrey Racing #14",
            "Bolt-Work G.P. #15",
            "Bolt-Work G.P. #16",
            "Paddy G.P. #17",
            "Paddy G.P. #18",
            "Zir-Win Motorsport #29",
            "Zir-Win Motorsport #30",
            "Lione G.P. #31",
            "Lione G.P. #32",
            "United Racing #9",
            "United Racing #10",
            "Team Hornsey #24",
            "Team Hornsey #25",
            "Scuderia Faenza Girardi #26",
            "Scuderia Faenza Girardi #27",
            "McLaren MP4/8 #7",
            "McLaren MP4/8 #8",
        ],
        "F-Hitech_Gen1" => [
            "Scuderia Forza #3",
            "Scuderia Forza #4",
            "DLA Scuderia Italia #11",
            "DLA Scuderia Italia #12",
            "Didcot Racing #5",
            "Didcot Racing #6",
            "Surrey Racing #13",
            "Surrey Racing #14",
            "Bolt-Work G.P. #15",
            "Bolt-Work G.P. #16",
            "Paddy G.P. #7",
            "Paddy G.P. #8",
            "United Racing #9",
            "United Racing #10",
            "Team Hornsey #17",
            "Team Hornsey #18",
            "Scuderia Faenza Girardi #19",
            "Scuderia Faenza Girardi #20",
            "McLaren MP4/7 #1",
            "McLaren MP4/7 #2",
            "Fontel G.P. #22",
            "Fontel G.P. #23",
            "Newcyan Racing #24",
            "Newcyan Racing #25",
            "Bradley Motorsports #26",
            "Bradley Motorsports #27",
        ],
        "GT3_Gen2" => [
            "McLaren 720S GT3 Evo #76",
            "McLaren 720S GT3 Evo #00",
            "McLaren 720S GT3 Evo #25",
            "McLaren 720S GT3 Evo #32",
            "McLaren 720S GT3 Evo #41",
            "McLaren 720S GT3 Evo #59",
            "Porsche 992 GT3 R #992",
            "Porsche 992 GT3 R #03",
            "Porsche 992 GT3 R #14",
            "Porsche 992 GT3 R #20",
            "Porsche 992 GT3 R #30",
            "Porsche 992 GT3 R #40",
            "Mercedes-AMG GT3 Evo #01",
            "Mercedes-AMG GT3 Evo #22",
            "Mercedes-AMG GT3 Evo #68",
            "Mercedes-AMG GT3 Evo #69",
            "Mercedes-AMG GT3 Evo #70",
            "Mercedes-AMG GT3 Evo #71",
            "BMW M4 GT3 #55",
            "BMW M4 GT3 #07",
            "BMW M4 GT3 #10",
            "BMW M4 GT3 #12",
            "BMW M4 GT3 #13",
            "BMW M4 GT3 #28"
        ]
    ];


    //in case we need to duplicate liveries
    //we want to shuffle the liveries
    //shuffle($liveries[$carClass]);

    if ($driverNbr !== null && !empty($carClass)) {
                $_xml->addAttribute('livery_name', $liveries[$carClass][$driverNbr]);
    }

    // If there is no Root Element then insert root
    if ($_xml === null) {
        shuffle($liveries[$carClass]);
        sort($liveries[$carClass]);
        $_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
    }

    // Visit all key value pair
    foreach ($array as $k => $v) {
        $nbr = null;

        // If there is nested array then
        if (is_array($v)) {
            //adding driver livery attribute
            if (strpos($k, "driver_") !== false) {
                $driverParts = explode("_", $k);
                $k = 'driver';
                $nbr = $driverParts[1];

                if (empty($liveries[$carClass][$nbr])) {
                    continue;
                }
            }

            // Call function for nested array
            arrayToXml($v, $k, $_xml->addChild($k), $nbr, $carClass);

        }

        else {

            // Simply add child element.
            $_xml->addChild($k, $v);
        }
    }

    return $_xml->asXML();
}

function buildArr($crazy = false, $driverCount = 24) {
    $arr  = [];
    $names = [
        "Tony Stewart",
        "Jeff Gordon",
        "Kyle Larson",
        "Lewis Hamilton",
        "Jeff Burton",
        "Lando Norris",
        "Ross Chastain",
        "Kennedy Chan",
        "Lea Matic",
        "Phoebe Chan",
        "Butters Chan",
        "Tiny Chan",
        "Danica Patrick",
        "Max Verstappen",
        "Sergio Perez",
        "Zhou Guanyu",
        "Alexander Albon",
        "Dale Earnhardt Jr.",
        "Denny Hamlin",
        "Kevin Harvik",
        "Max Power",
        "George Russell",
        "Yuki Tsunoda",
        "Daniel Riccardo",
        "Dale Jarrett",
        "Peddy Khatami",
        "Dan Chau",
        "Brooks Robertson",
        "Erick Kim",
        "Sam Chan",
        "David Chan",
        "Brock Purdy",
        "Jerry Rice",
        "Michael Shumacher",
        "Michael Andretti",
        "Joe Montana",
        "Steve Young",
        "Pato O'Ward",
        "Scott Dixon",
        "Romain Grosjean",
        "Colton Herta",
        "Josef Newgarden",
        "Felix Rosenqvist",
        "Kyle Kirkwood",
        "Christian Lundgaard",
        "Scott McLaughlin",
        "William Byron",
        "Tyler Reddick",
        "Christopher Bell",
        "Boosted Media",
        "SimRacing Garage",
        "OC Racing",
        "Random Callsign",
        "Karl Gosling"
    ];

    shuffle($names);

    foreach($names as $i=>$name) {
        if($i == $driverCount) {
            break;
        }

        $driver = "driver_" . $i;
        $temp = [
            "name"                         => $name,
            "country"                      => "USA",
            "race_skill"                   => getRand(880, 1000),
            "qualifying_skill"             => getRand(880, 1000),
            "aggression"                   => getRand(880, 1000),
            "defending"                    => getRand(880, 1000),
            "stamina"                      => ($crazy === false) ? getRand(500, 1000) : 0.001,
            "consistency"                  => ($crazy === false) ? getRand(500, 1000) : 0.001,
            "start_reactions"              => getRand(500, 1000),
            "tyre_management"              => getRand(500, 1000),
            "fuel_management"              => getRand(500, 1000),
            "blue_flag_conceding"          => .999,
            "weather_tyre_changes"         => getRand(500, 1000),
            "avoidance_of_mistakes"        => ($crazy === false) ? getRand(500, 1000) : 0.01,
            "avoidance_of_forced_mistakes" => ($crazy === false) ? getRand(500, 1000) : 0.01,
            "vehicle_reliability"          => getRand(800, 1000),

        ];

        $arr[$driver] = $temp;
    }

    return $arr;
}

function getRand($min=500, $max=1000) {
    return rand($min, $max) / $max;
}

if (empty($argv[1])) {
    $carClass = 'GT3';
} else {
    $carClass = $argv[1];
}

if (empty($argv[2])) {
    $crazy = false;
} else {
    $crazy = true;
}

if (empty($argv[3])) {
    $driverCount = 24;
} else {
    $driverCount = $argv[3];
}

$ai = buildArr($crazy, $driverCount);
$string = arrayToXml($ai, '<custom_ai_drivers/>', null, null, $carClass);
file_put_contents($carClass .".xml", $string);
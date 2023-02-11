<?php


// Define a function that converts array to xml.
function arrayToXml($array, $rootElement = null, $xml = null, $driverNbr = null, $carClass=null) {
    $_xml = $xml;

    $liveries = [
        "GT3" => [
            "Nissan Nismo GT-R GT3 #201",
            "BMW M6 GT3 #2",
            "Mercedes-AMG #01",
            "Porsche 911 GT3 R #05",
            "McLaren 720S GT3 #04",
            "Nissan Nismo GT-R GT3 #203",
            "BMW M6 GT3 #11",
            "Mercedes-AMG #09",
            "Porsche 911 GT3 R #10",
            "McLaren 720S GT3 #12",
            "Nissan Nismo GT-R GT3 #205",
            "BMW M6 GT3 #61",
            "Mercedes-AMG #60",
            "Porsche 911 GT3 R #17",
            "McLaren 720S GT3 #27",
            "Nissan Nismo GT-R GT3 #207",
            "BMW M6 GT3 #83",
            "Mercedes-AMG #77",
            "Porsche 911 GT3 R #41",
            "McLaren 720S GT3 #90",
            "Nissan Nismo GT-R GT3 #209",
            "BMW M6 GT3 #91",
            "Mercedes-AMG #81",
            "Porsche 911 GT3 R #75",
            "McLaren 720S GT3 #92",
            "Nissan Nismo GT-R GT3 #211",
            "BMW M6 GT3 #96",
            "Mercedes-AMG #85",
            "Porsche 911 GT3 R #82",
            "McLaren 720S GT3 #94",
            "Nissan Nismo GT-R GT3 #212",
            "Mercedes-AMG #99",
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
        ]
    ];

    if ($driverNbr !== null && !empty($carClass)) {
                $_xml->addAttribute('livery_name', $liveries[$carClass][$driverNbr]);
    }

    // If there is no Root Element then insert root
    if ($_xml === null) {
        shuffle($liveries[$carClass]);
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

function buildArr($iter=21, $livery=null) {
    $used = [];
    $arr  = [];
    $names = [
        "Tony Stewart",
        "Jeff Gordon",
        "Kyle Larson",
        "Lewis Hamilton",
        "Jeff Burton",
        "Lando Norris",
        "Nera Marti",
        "Kennedy Chan",
        "Lea Matic",
        "Phoebe Chan",
        "Butters Chan",
        "Tiny Chan",
        "Danica Patrick",
        "Max Verstappen",
        "Sergio Perez", //15
        "Zhou Guanyu",
        "Alexander Albon",
        "Dale Earnhardt Jr.",
        "Denny Hamlin",
        "Kevin Harvik",
        "Max Power",
    ];

    shuffle($names);

    for($i=0; $i<$iter; $i++) {
        $driver = "driver_" . $i;
        $temp = [
            "name"                         => $names[$i],
            "country"                      => "USA",
            "race_skill"                   => getRand(500, 1000),
            "qualifying_skill"             => getRand(500, 1000),
            "aggression"                   => getRand(500, 1000),
            "defending"                    => getRand(500, 1000),
            "stamina"                      => getRand(500, 1000),
            "consistency"                  => getRand(500, 1000),
            "start_reactions"              => getRand(500, 1000),
            "tyre_management"              => getRand(500, 1000),
            "fuel_management"              => getRand(500, 1000),
            "blue_flag_conceding"          => 1.0,
            "weather_tyre_changes"         => getRand(500, 1000),
            "avoidance_of_mistakes"        => getRand(500, 1000),
            "avoidance_of_forced_mistakes" => getRand(500, 1000),
            "vehicle_reliability"          => getRand(780, 1000),

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

$ai = buildArr();
$string = arrayToXml($ai, '<custom_ai_drivers/>', null, null, $carClass);
file_put_contents($carClass .".xml", $string);
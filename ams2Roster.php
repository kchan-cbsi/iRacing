<?php




// Define a function that converts array to xml.
function arrayToXml($array, $rootElement = null, $xml = null, $driverNbr = null) {
    $_xml = $xml;

    if (!empty($driverNbr)) {
        $attr = 'Test Livery #' . $driverNbr;
        $_xml->addAttribute('livery_name', $attr);
    }

    // If there is no Root Element then insert root
    if ($_xml === null) {
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
            arrayToXml($v, $k, $_xml->addChild($k), $nbr);

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

    for($i=0; $i<$iter; $i++) {
        $driverNbr = rand(0, 99);
        while(in_array($driverNbr, $used)) {
            $driverNbr = rand(0, 99);
        }

        $used[] = $driverNbr;
        $driver = "driver_" . $i+1;
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

$ai = buildArr();
$string = arrayToXml($ai, '<custom_ai_drivers/>');
file_put_contents("myxmlfile.xml", $string);
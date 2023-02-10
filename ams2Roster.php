<?php
$ai = [
        "driver_2" => [
            "country" => "USA",
            "race_skill" => rand(500, 1000) / 1000
        ]
];



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



$string = arrayToXml($ai, '<custom_ai_drivers/>');
file_put_contents("myxmlfile.xml", $string);
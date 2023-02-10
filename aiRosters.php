<?php

$path = null;
$opponents = [];

if (empty($argv[1])) {
    echo "Path of roster is not set";
}

$rosterStr = file_get_contents($path, true);
$roster = json_decode($rosterStr, true);

foreach($roster['drivers'] as $key=>$driver) {
    $roster['drivers'][$key]['driverSkill'] = rand(80, 100);
    $roster['drivers'][$key]['driverAggression'] = rand(90, 100);
}


file_put_contents($path, json_encode($roster));
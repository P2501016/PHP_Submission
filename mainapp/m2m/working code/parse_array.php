<?php




$string = "Number of messages: 9 Message: 44781781414944781781414930/01/2023 04:51:26SMS0Team_name:22-3110-AI, sw1:on, sw2:on, sw3:off, sw4:on, fan:forward, heater:45'C, keypad:2 Message: 44781781414944781781414930/01/2023 05:05:29SMS0Team_name:22-3110-AI, sw1:on, sw2:on, sw3:off, sw4:on, fan:forward, heater:45'C, keypad:2 Message: 44781781414944781781414930/01/2023 05:55:10SMS0Team_name:22-3110-AI, sw1:on, sw2:on, sw3:off, sw4:on, fan:forward, heater:45'C, keypad:2 Message: 44781781414944781781414930/01/2023 05:55:10SMS0Team_name:22-3110-AI, sw1:on, sw2:on, sw3:off, sw4:on, fan:forward, heater:45'C, keypad:2";

$messages = explode("Message:", $string);
$results = array();

foreach ($messages as $message) {
    if (strlen(trim($message)) > 0) {
        $parts = explode(",", $message);
        $result = array();
        foreach ($parts as $part) {
            if (strpos($part, "Team_name:") !== false) {
                $result["Team_name"] = trim(str_replace("Team_name:", "", $part));
            } else if (strpos($part, "sw1:") !== false) {
                $result["sw1"] = trim(str_replace("sw1:", "", $part));
            } else if (strpos($part, "sw2:") !== false) {
                $result["sw2"] = trim(str_replace("sw2:", "", $part));
            } else if (strpos($part, "sw3:") !== false) {
                $result["sw3"] = trim(str_replace("sw3:", "", $part));
            } else if (strpos($part, "sw4:") !== false) {
                $result["sw4"] = trim(str_replace("sw4:", "", $part));
            } else if (strpos($part, "fan:") !== false) {
                $result["fan"] = trim(str_replace("fan:", "", $part));
            } else if (strpos($part, "heater:") !== false) {
                $result["heater"] = trim(str_replace("heater:", "", $part));
            }else if (strpos($part, "keypad:") !== false) {
                $result["keypad"] = trim(str_replace("keypad:", "", $part));
            }
        }
        $results[] = $result;
    }
}

print_r($results);

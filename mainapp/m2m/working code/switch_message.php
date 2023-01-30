<?php


    try {
        $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
        $client = new SoapClient($wsdl);

        $username = '22_2621996';
        $password = 'EEm2mpleasework';
        $recipient = '07817814149';
        $Team_name = "22-3110-AI";
        $switch1 = "on";
        $switch2 = "on";
        $switch3 = "off";
        $switch4 = "on";
        $fan = "forward";
        $heater = "45'C";
        $keypad = "2";
        $message = "Team_name:{$Team_name},
        sw1:{$switch1},
        sw2:{$switch2},
        sw3:{$switch3},
        sw4:{$switch4},
        fan:{$fan},
        heater:{$heater},
        keypad:{$keypad}";
        $deliveryReports = false;
        $type = 'SMS';

        $result = $client->sendMessage($username, $password, $recipient, $message, $deliveryReports, $type);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

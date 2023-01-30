<?php

require __DIR__ . '/vendor/autoload.php';
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

while ($x < 10) {
    try {
        $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
        $client = new SoapClient($wsdl);

        $username = '22_2621996';
        $password = 'EEm2mpleasework';
        $recipient = '07817814149';
        $group_name = "Team A";
        $switch1 = "off";
        $switch2 = "on";
        $switch3 = "off";
        $switch4 = "on";
        $fan = "forward";
        $heater = "70°C";
        $keypad = "1234";
        $message = "<msg>group_name: {$group_name}, switch1: {$switch1}, switch2: {$switch2}, switch3: {$switch3}, switch4: {$switch4}, fan: {$fan}, heater: {$heater}, keypad: {$keypad}</msg>";
        $deliveryReports = false;
        $type = 'SMS';

        $result = $client->sendMessage($username, $password, $recipient, $message, $deliveryReports, $type);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    $app->get('/sendmessage', function (Request $request, Response $response, $args) use ($result) {
        $this->get('view')->render($response, 'sendmessage.twig', [
            'referenceId' => $result
        ]);
        return $response;
    });
    $x++;
}


<?php

try {
    $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
    $client = new SoapClient($wsdl);

    $username = '22_2621996';
    $password = 'EEm2mpleasework';
    $count = 10;
    $deviceMsisdn = '';
    $countryCode = '';

    $result = $client->peekMessages($username, $password, $count, $deviceMsisdn, $countryCode);

    if (!empty($result)) {
        echo "Number of messages: " . count($result) . "\n\n";

        foreach ($result as $message) {
            echo "Message: " . $message . "\n\n";
        }
    } else {
        echo "No messages found.";
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
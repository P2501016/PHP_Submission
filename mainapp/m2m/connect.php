<?php
try {
    $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
    $client = new SoapClient($wsdl);
    echo "Successfully connected to M2MConnect.";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

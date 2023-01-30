<?php
// Initialize the SOAP client
$wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
$client = new SoapClient($wsdl);

// Define the authentication credentials and message retrieval parameters
$username = '22_2621996';
$password = 'EEm2mpleasework';
$count = 10;
$deviceMsisdn = '';
$countryCode = '';

// Call the 'peekMessages' method and retrieve the messages
$new_messages = $client->peekMessages($username, $password, $count, $deviceMsisdn, $countryCode);

// Display the messages in a table
if (!empty($new_messages)) {
    echo '<table width="100%">';
    echo '<tr><td width="30%">Message Number</td><td width="70%">Message</td></tr>';

    $i = 1;
    foreach ($new_messages as $message) {
        echo '<tr><td>' . $i . '</td><td>' . $message . '</td></tr>';
        $i++;
    }

    echo '</table>';
} else {
    echo "No new messages found.";
}
?>

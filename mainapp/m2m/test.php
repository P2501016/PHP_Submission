<?php
function read_message(){
    try {
        // URL of the SOAP service
        $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
        // Create a SOAP client instance
        $client = new SoapClient($wsdl);

        // Login credentials for the service
        $username = '22_2621996';
        $password = 'EEm2mpleasework';
        // Number of messages to retrieve
        $count = 10;
        // MSISDN and country code to retrieve messages from
        $deviceMsisdn = '';
        $countryCode = '';

        // Call the 'peekMessages' method of the SOAP client
        $result = $client->peekMessages($username, $password, $count, $deviceMsisdn, $countryCode);

        // Check if the result is not empty
        if (!empty($result)) {
            // Print the number of messages retrieved
            echo "Number of messages: " . count($result) . "\n\n";
            // Initialize an array to store the messages
            $content = "";
            // Loop through each message
            foreach ($result as $message) {
                // Check if the message contains the string 'AI'
                if (strpos($message, 'AI') !== false) {
                    // Add the message to the array
                    $content = $message;
                }
            }
        } else {
            // Print a message if no messages were found
            echo "No messages found.";
        }
    } catch (Exception $e) {
        // Print an error message if an exception is thrown
        echo 'Error: ' . $e->getMessage();
    }
    // Return the array of messages
    return $content;
}

$lol = read_message();
print_r($lol);

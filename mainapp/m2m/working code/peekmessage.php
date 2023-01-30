<?php
class peekMessages
{
    function read_message()
    {
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
                $content = array();
                foreach ($result as $message) {
                    if (strpos($message, 'AI') !== false) {
                        $content[] = $message;
                    }
                }
            } else {
                echo "No messages found.";
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $content;
    }
}
;

print_r($read_message());

?>
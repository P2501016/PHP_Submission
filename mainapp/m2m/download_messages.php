<?php

function download_messages() {
    // URL of the M2M server
    $url = "https://m2m.server.com/api/messages";

    // Create a new instance of the SOAP client
    $client = new SoapClient($url);

    // Call the method to download the SMS messages
    $messages = $client->getMessages();

    // Return the downloaded SMS messages
    return $messages;
}

<?php
$wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
$client = new SoapClient($wsdl);
$result = $client->peekmessages();
$content = $result->peekmessagesResult;

$lines = explode("SMS0", $content);

// Remove the first element of the $lines array, which is not needed
array_shift($lines);

// Initialize an empty array to store the parsed data
$data = array();

// Split the line into individual values
foreach ($lines as $line) {
    // Split the line into individual values
    $line = explode(", ", $line);

    // Extract the values for each field
    $team_name = explode(":", $line[0])[1];
    $sw1 = explode(":", $line[1])[1];
    $sw2 = explode(":", $line[2])[1];
    $sw3 = explode(":", $line[3])[1];
    $sw4 = explode(":", $line[4])[1];
    $fan = explode(":", $line[5])[1];
    $heater = explode(":", $line[6])[1];
    $keypad = explode(":", $line[7])[1];

    // Add the extracted values to the $data array
    $data[] = array(
        'Team_name' => $team_name,
        'sw1' => $sw1,
        'sw2' => $sw2,
        'sw3' => $sw3,
        'sw4' => $sw4,
        'fan' => $fan,
        'heater' => $heater,
        'keypad' => $keypad
    );
}

// Print the $data array for testing purposes
print_r($data);

$host = "localhost";
$dbname = "eem2m";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO messages (Team_name, sw1, sw2, sw3, sw4, fan, heater, keypad) VALUES (:team_name, :sw1, :sw2, :sw3, :sw4, :fan, :heater, :keypad)");

    foreach ($data as $row) {
        $stmt->execute(array(
            ':team_name' => $row['Team_name'],
            ':sw1' => $row['sw1'],
            ':sw2' => $row['sw2'],
            ':sw3' => $row['sw3'],
            ':sw4' => $row['sw4'],
            ':fan' => $row['fan'],
            ':heater' => $row['heater'],
            ':keypad' => $row['keypad']
        ));
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>
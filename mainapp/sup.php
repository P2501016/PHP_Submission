<?php

function retrieveSMSFromM2MServer(){  
    try {
    $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';

     $client = new SoapClient($wsdl);
     $username = '22_2621996';
    $password = 'EEm2mpleasework';
    $count = 4;
    $deviceMsisdn = '';
    $countryCode = '';

    $result = $client->peekMessages($username, $password, $count, $deviceMsisdn, $countryCode);
    $content = '';
    if (!empty($result)) {
    echo "Number of messages: " . count($result) . "\n\n";
    
    foreach ($result as $message) {
        if (strpos($message, 'AI') !== false) {
        $content .= $message . "\n";
            }  
        }
        return $content;
    } else {
            echo "No messages found.";
    }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

 


$string = retrieveSMSFromM2MServer();
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


$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "eem2m";

// Connect to the database
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Could not connect to the database: ' . $e->getMessage());
}

// loop through each result in the $results array
foreach ($results as $result) {
    // store the value of each field from the result array into a separate variable
    $team_name = $result['Team_name'];
    $sw1 = $result['sw1'];
    $sw2 = $result['sw2'];
    $sw3 = $result['sw3'];
    $sw4 = $result['sw4'];
    $fan = $result['fan'];
    $heater = $result['heater'];
    $keypad = $result['keypad'];
  
    // prepare an SQL statement to insert a new record into the messages table
    $sql = "INSERT INTO messages (team_name, sw1, sw2, sw3, sw4, fan, heater, keypad)
            VALUES (:team_name, :sw1, :sw2, :sw3, :sw4, :fan, :heater, :keypad)";
    $stmt = $conn->prepare($sql);
  
    // bind each variable to its corresponding placeholder in the SQL statement
    $stmt->bindParam(':team_name', $team_name);
    $stmt->bindParam(':sw1', $sw1);
    $stmt->bindParam(':sw2', $sw2);
    $stmt->bindParam(':sw3', $sw3);
    $stmt->bindParam(':sw4', $sw4);
    $stmt->bindParam(':fan', $fan);
    $stmt->bindParam(':heater', $heater);
    $stmt->bindParam(':keypad', $keypad);
  
    // execute the SQL statement and check if it was successful
    if ($stmt->execute() === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

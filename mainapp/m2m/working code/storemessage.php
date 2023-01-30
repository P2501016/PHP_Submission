<?php
try {
  $wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';
  $client = new SoapClient($wsdl);

  $username = '22_2621996';
  $password = 'EEm2mpleasework';
  $count = 1;
  $deviceMsisdn = '';
  $countryCode = '';

  $result = $client->peekMessages($username, $password, $count, $deviceMsisdn, $countryCode);

  storeMessageInDb($result);

} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}

function storeMessageInDb($result){
    // Code to store the message in the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eem2m";
  
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      echo "Connected to database 'eem2m'";
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  
    if (!empty($result)) {
      foreach ($result as $message) {
        $content = array(
          'sender' => $message->sender,
          'receiver' => $message->receiver,
          'message' => $message->content,
          'timestamp' => $message->timestamp
        );
  
        $sql = "INSERT INTO messages (sender, receiver, message, timestamp)
                    VALUES (:sender, :receiver, :message, :timestamp)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':sender', $content['sender']);
        $stmt->bindParam(':receiver', $content['receiver']);
        $stmt->bindParam(':message', $content['message']);
        $stmt->bindParam(':timestamp', $content['timestamp']);
  
        if ($stmt->execute()) {
          echo "Message stored in the database successfully";
        } else {
          echo "Error: " . implode(", ", $stmt->errorInfo());
        }
      }
    } else {
      echo "No messages found.";
    }
  }

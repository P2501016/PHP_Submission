// Create the SQL statement to add a new record
$sql = "INSERT INTO messages (team_name, sw1, sw2, sw3, sw4, fan, heater, keypad)
        VALUES (:team_name, :sw1, :sw2, :sw3, :sw4, :fan, :heater, :keypad)";
$stmt = $conn->prepare($sql);

// Link each value to its placeholder in the SQL statement
$stmt->bindParam(':team_name', $team_name);
$stmt->bindParam(':sw1', $sw1);
$stmt->bindParam(':sw2', $sw2);
$stmt->bindParam(':sw3', $sw3);
$stmt->bindParam(':sw4', $sw4);
$stmt->bindParam(':fan', $fan);
$stmt->bindParam(':heater', $heater);
$stmt->bindParam(':keypad', $keypad);

// Execute the SQL statement and check if it was successful
if ($stmt->execute() === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $conn->error;
}

CREATE DATABASE eem2m

use eem2m

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  team_name VARCHAR(255) NOT NULL,
  sw1 VARCHAR(255) NOT NULL,
  sw2 VARCHAR(255) NOT NULL,
  sw3 VARCHAR(255) NOT NULL,
  sw4 VARCHAR(255) NOT NULL,
  fan VARCHAR(255) NOT NULL,
  heater INT(255) NOT NULL,
  keypad INT(1) NOT NULL
);

<?php
$servername = " sql5.freemysqlhosting.net";
$username = "sql5687781";
$password = "LZuWfXvCg5";
$db = "sql5687781";
$conn = "";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

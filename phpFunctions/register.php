<?php


require "../DatabaseConnection/connectionForDB.php";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);







 // prepare sql and bind parameters
 $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, usersPassword) VALUES (:firstname, :lastname, :email, :password)";
 $stmt->bindParam(':firstname', $firstname);
 $stmt->bindParam(':lastname', $lastname);
 $stmt->bindParam(':email', $email);
 $stmt->bindParam(':email', $password);


  $stmt->execute();
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

?>



  
<?php
session_start();

require "../DatabaseConnection/connectionForDB.php";

try {
 


 // prepare sql and bind parameters
 $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, usersPassword) VALUES (:firstname, :lastname, :email, :password)");
 $stmt->bindParam(':firstname', $_SESSION["firstName"]);
 $stmt->bindParam(':lastname', $lastname);
 $stmt->bindParam(':email', $email);
 $stmt->bindParam(':password', $password);


  $stmt->execute();
  echo "New record created successfully";

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

?>



  
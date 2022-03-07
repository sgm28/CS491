<?php


require "../DatabaseConnection/connectionForDB.php";

try {
 


 // prepare sql and bind parameters
 $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, usersPassword) VALUES (:firstname, :lastname, :email, :password)");

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

?>



  
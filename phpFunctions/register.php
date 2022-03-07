<?php
session_start();

require "../DatabaseConnection/connectionForDB.php";

try {
 


 // prepare sql and bind parameters
 $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, usersPassword) VALUES (:firstname, :lastname, :email, :password)");
 $stmt->bindParam(':firstname', $_SESSION["firstName"]);
 $stmt->bindParam(':lastname', $_SESSION["lastName"]);
 $stmt->bindParam(':email', $_SESSION["email"]);


$hashPassword = password_hash($_SESSION["password"], PASSWORD_DEFAULT);
$stmt->bindParam(':password', $hashPassword);


    
$stmt2 = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt2->bindParam(':email', $_SESSION["email"]);
$stmt2->execute();


if( $stmt2->rowCount() > 0 )
{
  echo $_SESSION["email"] . " already exists please chose another";
}
else {

  $stmt->execute();
  echo "New record created successfully";
}

  

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

?>



  
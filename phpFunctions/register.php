<?php
session_start();

require "../DatabaseConnection/connectionForDB.php";

try {
 
//Defining Admins constant
//Argument 1 constant name
//Argument 2 constant value
//Arguemnt 3 case-insensitive
  echo "Made it to line 12";
define("ADMIN1", "Jennifer", true);
define("ADMIN2","Peter", true);
define("ADMIN3", "Austin", true);
define("ADMIN4", "Sakar", true);
echo "Made it to line 16";
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

//Admin registration

if ($_SESSION['firstname'] == ADMIN1 || ADMIN2 || ADMIN3 || ADMIN4)
{
echo "Made it to line 44";
  $stmt3 = $conn->prepare("INSERT INTO users (firstname, lastname, email, usersPassword, user_type) VALUES (:firstname, :lastname, :email, :password, :user_type)");
 $stmt3->bindParam(':firstname', $_SESSION["firstName"]);
 $stmt3->bindParam(':lastname', $_SESSION["lastName"]);
 $stmt3->bindParam(':email', $_SESSION["email"]);
 //$stmt3->bindParam(':user_type', "admin");
 $stmt3->bindValue(':user_type',"admin",PDO::PARAM_STR);
 $stmt3->execute();
 echo "New Admin record created successfully";
 exit();

}



  $stmt->execute();
  echo "New record created successfully";
  header("location: ../home.php");
}

  

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

?>



  
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

if ($_SESSION['firstname'] == ADMIN1 || $_SESSION['firstname'] == ADMIN2 || $_SESSION['firstname'] ==ADMIN3 || $_SESSION['firstname'] == ADMIN4)
{
  $admin ="admin";
   echo "Made it to line 44";
  $stmt3 = $conn->prepare("INSERT INTO users (firstname, lastname, email, usersPassword, user_type) VALUES (:firstname, :lastname, :email, :password, :user_type)");
 $stmt3->bindParam(':firstname', $_SESSION["firstName"]);
 echo "Made it to line 49";
 $stmt3->bindParam(':lastname', $_SESSION["lastName"]);
 echo "Made it to line 51";
 $stmt3->bindParam(':email', $_SESSION["email"]);
 echo "Made it to line 52";
$stmt3->bindParam(':password', $hashPassword);
 $stmt3->bindParam(':user_type', $admin);
 echo "Made it to line 55";
 $stmt3->execute();
 echo "Made it to line 57";
 echo "New Admin record created successfully";

  //header("location: ./adminHome.php");
  exit();

}

else if (isset($_SESSION['user_type']))
{
  $stmt4 = $conn->prepare("INSERT INTO users (firstname, lastname, email, usersPassword, user_type) VALUES (:firstname, :lastname, :email, :password, :user_type)");

   $stmt4->bindParam(':firstname', $_SESSION["firstName"]);
   $stmt4->bindParam(':lastname', $_SESSION["lastName"]);
 $stmt4->bindParam(':email', $_SESSION["email"]);
$stmt4->bindParam(':password', $hashPassword);
 $stmt4->bindParam(':user_type', $_SESSION['user_type']);
 $stmt4->execute();
 
 echo  $_SESSION['user_type'] . "record created successfully";

 if ($_SESSION['user_type'] == "admin")
 {
    echo "Line 81";
    //header("location: ./adminHome.php");
    exit();
 }
 else 
 {
  echo "Line 87";
   //header("location: ../home.php");
   exit();
 }

  

}



  $stmt->execute();
  echo "Line 99";
  echo "New record created successfully";
  //header("location: ../home.php");
}

  

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}


$conn = null;

?>



  
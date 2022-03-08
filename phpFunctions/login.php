<?php
	session_start();

	require "../DatabaseConnection/connectionForDB.php";

	if(isset($_POST['submit']))
	{
		echo "Good";
		$email = $_POST['email'];
		$password = $_POST['password'];




		try {

		$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
		$stmt->bindParam(':email', $email);
		$stmt->execute();


  		$result = $stmt->fetch(PDO::FETCH_ASSOC);


		print_r($result);
		print("\n");
	}
	catch(PDOException $e) {
  			echo $sql . "<br>" . $e->getMessage();
	}





	}
	else
	{
		echo "Not Good";
	}



?>
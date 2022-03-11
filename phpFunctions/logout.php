<?php

	session_start();
	seesion_unset();
	session_destroy();
	header("location: ../index.php");
?>
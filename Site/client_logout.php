<?php
	session_name('Client');
	session_start();
	session_destroy();
	header("Location: client_connexion.php");
?>
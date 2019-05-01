<?php
	session_name('Admin');
	session_start();
	session_destroy();
	header("Location: admin_connexion.php");
?>
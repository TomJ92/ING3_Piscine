<?php
	session_name('Vendeur');
	session_start();
	session_destroy();
	header("Location: vendeur_connexion.php");
?>
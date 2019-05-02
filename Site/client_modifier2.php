<?php 
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$mdp1 = $_POST['mdp1'];
	$mdp2 = $_POST['mdp2'];
	$adresse1 = $_POST['adresse1'];
	$adresse2 = $_POST['adresse2'];
	$ville = $_POST['ville'];
	$poste = $_POST['poste'];
	$pays = $_POST['pays'];
	$nom_carte = $_POST['nom_carte'];
	$num_carte = $_POST['num_carte'];
	$type_carte = $_POST['type_carte'];
	$cvv = $_POST['cvv'];
	$mois = $_POST['mois'];
	$annee = $_POST['annee'];
	session_name('Client');
	session_start();
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	$db_found=mysqli_select_db($db_handle,$database);
	if($mdp1!=$mdp2)
	{
			echo "mdp diff";
			header('Location: client_modifier.php');
			exit();
		}
	if(empty($nom)||empty($prenom)||empty($email)||empty($mdp1)||empty($mdp2)||empty($adresse1)||empty($ville)||empty($poste)||empty($pays)||empty($nom_carte)||empty($num_carte)||empty($type_carte)||empty($cvv)||empty($mois)||empty($annee))
	{
		header('Location: client_modifier.php');
		exit();
		
	}
	else
	{
		if($db_found){	
			if($nom!=$_SESSION['Nom']){
				// lancement de la requête
				$sql = "UPDATE Client SET Nom='$nom' WHERE Email_Client='$email'";

					// on exécute la requête (mysql_query)
					mysqli_query($db_handle,$sql);
			}
		}
			
	}
	
	mysqli_close($db_handle);
	
?>
<?php 
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$mdp1 = $_POST['mdp1'];
	$mdp2 = $_POST['mdp2'];
	$adresse1 = $_POST['adresse1'];
	$adresse2 = $_POST['adresse2'];
	if(!empty($adresse2)){
		$adresse = $adresse1.", ".$adresse2;
	}
	else{
		$adresse = $adresse1;
	}
	$ville = $_POST['ville'];
	$poste = $_POST['poste'];
	$pays = $_POST['pays'];
	$phone = $_POST['phone'];
	$nom_carte = $_POST['nom_carte'];
	$num_carte = $_POST['num_carte'];
	$type_carte = $_POST['type_carte'];
	$cvv = $_POST['cvv'];
	$mois = $_POST['mois'];
	$annee = $_POST['annee'];
	
	if($mois<10){
		$date_carte=$annee ."-0". $mois . "-01";
	}
	else if ($mois>9){
		$date_carte=$annee ."-". $mois . "-01";
	}
	
	session_name('Client');
	session_start();
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	$db_found=mysqli_select_db($db_handle,$database);
	$sql = "SELECT * FROM Client WHERE Email_Client = '".$_SESSION['Email_Client']."'";
	$req = mysqli_query($db_handle, $sql);
	$data = mysqli_fetch_assoc($req);
	if($mdp1!=$mdp2){
			echo "mdp diff";
			header('Location: client_modifier.php');
			exit();
	}
	else{
		if($db_found){	
			if($nom!=$data['Nom']){
				// lancement de la requête
				$sql = "UPDATE Client SET Nom='$nom' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($prenom!=$data['Prenom']){
				// lancement de la requête
				$sql = "UPDATE Client SET Prenom='$prenom' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($mdp1!=$data['Password']){
				// lancement de la requête
				$sql = "UPDATE Client SET Password='$mdp1' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($adresse!=$data['Adresse']){
				// lancement de la requête
				$sql = "UPDATE Client SET Adresse='$adresse' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($ville!=$data['Ville']){
				// lancement de la requête
				$sql = "UPDATE Client SET Ville='$ville' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($poste!=$data['Code_postal']){
				// lancement de la requête
				$sql = "UPDATE Client SET Code_postal='$poste' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($pays!=$data['Pays']){
				// lancement de la requête
				$sql = "UPDATE Client SET Pays='$pays' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($phone!=$data['Telephone']){
				// lancement de la requête
				$sql = "UPDATE Client SET Telephone='$phone' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($type_carte!=$data['Type_carte']){
				// lancement de la requête
				$sql = "UPDATE Client SET Type_carte='$type_carte' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($num_carte!=$data['Numero_carte']){
				// lancement de la requête
				$sql = "UPDATE Client SET Numero_carte='$num_carte' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($nom_carte!=$data['Nom_carte']){
				// lancement de la requête
				$sql = "UPDATE Client SET Nom_carte='$nom_carte' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($date_carte!=$data['Date_carte']){
				// lancement de la requête
				$sql = "UPDATE Client SET Date_carte='$date_carte' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			if($cvv!=$data['Code_carte']){
				// lancement de la requête
				$sql = "UPDATE Client SET Code_carte='$cvv' WHERE Email_Client='$email'";
				// on exécute la requête (mysql_query)
				mysqli_query($db_handle,$sql);
			}
			
			header('Location: client_compte.php');
			exit();
		}
	}
	
	mysqli_close($db_handle);
	
?>
<?php
	session_name('Client');
	session_start();
	if(empty($_SESSION['Email_client']))
	{
		header('Location: client_connexion.php');
	}else{
		if (isset($_POST["id"])){
			$id = $_POST["id"];
		}
		if (isset($_POST["nombre"])){
			$nombre = $_POST["nombre"];
		}
		echo($_SESSION['Email_client']." ".$id." ".$nombre);
		
		//Connection to the database
		$database='commerce';
		$db_handle=mysqli_connect('localhost','root','');
		//Connection to database
		$db_found=mysqli_select_db($db_handle,$database);
		if($db_found){	
			$id_panier = 0;
			// on Recherche les infos
			$sql = "SELECT * FROM panier WHERE Email_client LIKE '".$_SESSION['Email_client']."'";
			
			$req = mysqli_query($db_handle, $sql);
			while($data = mysqli_fetch_assoc($req)){
				if($data['Id_item'] == $id){
					$quantite = $data['Quantite_panier'] + $nombre;
					$sql = "UPDATE panier SET Quantite_panier = '".$quantite."' WHERE  Id_item = ".$id;
					$req = mysqli_query($db_handle, $sql);
					$id_panier =1;		
					break;
				}
			}
			if($id_panier == 0){
				$sql = "INSERT INTO panier (Email_client, Id_item, Quantite_panier) VALUES ('".$_SESSION['Email_client']."', '".$id."', '".$nombre."')";
				echo($sql);
				$req = mysqli_query($db_handle, $sql);
			}
		}
		mysqli_close($db_handle);
		header('Location: panier.php');
	}
	
?>
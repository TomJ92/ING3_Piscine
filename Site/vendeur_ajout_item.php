<?php
	session_name('Vendeur');
	session_start();
	if(empty($_SESSION['Email_ECE'])){
		header('Location: vendeur_connexion.php');
	}
	else{
		$database='commerce';
		$db_handle=mysqli_connect('localhost','root','');
		$db_found=mysqli_select_db($db_handle,$database);
		$ajouter = $_POST['ajouter'];
		$ids = $_POST['ids'];
		$quantite = $_POST['quantite'];
		if($db_found){	
			if(isset($_POST['submit_ad'])){//to run PHP script on submit
				if(!empty($ajouter) && !empty($ids)){
					// Loop to store and display values of individual checked checkbox.
					for($i =0 ; $i<count($ajouter) ; $i++){
						echo("il faut ajouter ".$ajouter[$i]." item d'id ".$ids[$i].". Stock avant ajout = ".$quantite[$i]."</br>");
						if(!empty($ajouter[$i])){
							if($ajouter[$i] > 0 && $quantite[$i] > 0)
							{
								$new = $quantite[$i]+$ajouter[$i];
								echo("ajout de ".$ajouter[$i]." items d'id ".$ids[$i]."</br>");
								$sql = "UPDATE vendre SET Quantite_vendeur = '".$new."' WHERE Email_ECE = '".$_SESSION['Email_ECE']."' AND Id_item= ".$ids[$i] ;
								$req = mysqli_query($db_handle, $sql);
								$sql = "UPDATE item SET Quantite = Quantite+".$ajouter[$i]." WHERE Id_item='".$ids[$i]."'";
								$req = mysqli_query($db_handle, $sql);
							}
							if($ajouter[$i] > 0 && $quantite[$i] == 0)	
							{
								$new = $ajouter[$i];
								echo("ajout de ".$ajouter[$i]." items d'id ".$ids[$i]."</br>");
								$sql = "INSERT INTO vendre (Email_ECE, Id_item, Quantite_vendeur) VALUES ('".$_SESSION['Email_ECE']."', '".$ids[$i]."', '".$new."')" ;
								echo($sql);
								$req = mysqli_query($db_handle, $sql);
								$sql = "UPDATE item SET Quantite = Quantite+".$ajouter[$i]." WHERE Id_item='".$ids[$i]."'";
								$req = mysqli_query($db_handle, $sql);
							}
						}
					}
				}
			}
			mysqli_close($db_handle);
			header('Location: vendeur_ajouter_item.php');
		}
	}
?>
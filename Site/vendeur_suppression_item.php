<?php
	session_name('Vendeur');
	session_start();
	if(empty($_SESSION['Email_ECE']))
	{
		header('Location: vendeur_connexion.php');
	}else{
		$database='commerce';
		$db_handle=mysqli_connect('localhost','root','');
		$db_found=mysqli_select_db($db_handle,$database);
		$supprimer = $_POST['supprimer'];
		$ids = $_POST['ids'];
		$quantite = $_POST['quantite'];
		if($db_found){	
			if(isset($_POST['submit_sup'])){//to run PHP script on submit
				if(!empty($supprimer) && !empty($ids)){
					// Loop to store and display values of individual checked checkbox.
					for($i =0 ; $i<count($supprimer) ; $i++){
						if(!empty($supprimer[$i])){
							if($supprimer[$i] > 0 && $supprimer[$i]<$quantite[$i])
							{
								$new = $quantite[$i]-$supprimer[$i];
								echo("suppression de ".$supprimer[$i]." items d'id ".$ids[$i]);
								$sql = "UPDATE vendre SET Quantite_vendeur = '".$new."' WHERE Email_ECE = '".$_SESSION['Email_ECE']."' AND Id_item= ".$ids[$i] ;
								$req = mysqli_query($db_handle, $sql);
							
								$sql = "UPDATE item SET Quantite = Quantite-".$supprimer[$i]." WHERE Id_item='".$ids[$i]."'";
								echo($sql);
								$req = mysqli_query($db_handle, $sql);
							}else if($supprimer[$i]>=$quantite[$i]){
								echo("suppression totale d'item d'id ".$ids[$i]);
								$sql = "DELETE FROM vendre WHERE Email_ECE = '".$_SESSION['Email_ECE']."' AND Id_item= ".$ids[$i] ;
								$req = mysqli_query($db_handle, $sql);
								$sql = "UPDATE item SET Quantite = Quantite-".$quantite[$i]." WHERE Id_item='".$ids[$i]."'";
								$req = mysqli_query($db_handle, $sql);
							}
						}
						
					}
				}
			}
		}
		mysqli_close($db_handle);
		header('Location: vendeur_supprimer_item.php');
	}
?>
<?php
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	$db_found=mysqli_select_db($db_handle,$database);
	if($db_found){	
		if(isset($_POST['submit_sup'])){//to run PHP script on submit
			if(!empty($_POST['supprimer'])){
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['supprimer'] as $selected){
					$sql = "DELETE FROM item WHERE Id_item = '".$selected."'";
					$req = mysqli_query($db_handle, $sql);
					$sql = "SELECT * FROM imgitem WHERE Id_item = '".$selected."'";
					$req = mysqli_query($db_handle, $sql);
					while($data = mysqli_fetch_assoc($req)){
						$result = unlink($data['Nom_img']);
						echo($data['Nom_img']);
					}
					
					$sql = "DELETE FROM imgitem WHERE Id_item = '".$selected."'";
					$req = mysqli_query($db_handle, $sql);
				}
			}
		}
	}
	mysqli_close($db_handle);
	header('Location: admin_supprimer_items.php');
	
?>
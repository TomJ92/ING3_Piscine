<?php 
	session_name('Vendeur');
	session_start();
	if(empty($_SESSION['Email_ECE']))
	{
		header('Location: vendeur_connexion.php');
	}else{
		// Database
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	$db_found=mysqli_select_db($db_handle,$database);
	$submit=0;
		//Profile file
		if(isset($_FILES['profile']['name'])){
			$fichier = basename($_FILES['profile']['name']);
			$extensions = array('.png', '.gif', '.jpg', '.jpeg');
			$extension = strrchr($_FILES['profile']['name'], '.'); 
			//Début des vérifications de sécurité...
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{
				$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
			}
			$fichier = strtr($fichier, 
			 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
			$dossier="Pictures/Vendeurs/".$fichier;
			if(move_uploaded_file($_FILES['profile']['tmp_name'], $dossier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			{
				$sql="SELECT Nom_vendeur FROM imgvendeur WHERE Email_ECE = '".$_SESSION['Email_ECE']."' AND isProfil='1'";
				$req = mysqli_query($db_handle,$sql);
				$data = mysqli_fetch_assoc($req);
				$result = unlink($data['Nom_vendeur']);
				$sql = "UPDATE imgvendeur SET Nom_vendeur = '".$dossier."' WHERE Email_ECE = '".$_SESSION['Email_ECE']."' AND isProfil='1'";
				$req = mysqli_query($db_handle,$sql);
				echo('Upload Success');
			}
			else{
				echo( "Upload failed");
			}						
			$submit = 1;
		}
		
		//Background file
		if(isset($_FILES['background']['name'])){
			
			$fichier = basename($_FILES['background']['name']);
			$extensions = array('.png', '.gif', '.jpg', '.jpeg');
			$extension = strrchr($_FILES['background']['name'], '.'); 
			//Début des vérifications de sécurité...
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{
				$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
			}
			$fichier = strtr($fichier, 
			 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
			$dossier="Pictures/Vendeurs/".$fichier;
			if(move_uploaded_file($_FILES['background']['tmp_name'], $dossier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			{
				$sql="SELECT Nom_vendeur FROM imgvendeur WHERE Email_ECE = '".$_SESSION['Email_ECE']."' AND isProfil='0'";
				$req = mysqli_query($db_handle,$sql);
				$data = mysqli_fetch_assoc($req);
				$result = unlink($data['Nom_vendeur']);
				
				$sql = "UPDATE imgvendeur SET Nom_vendeur = '".$dossier."' WHERE Email_ECE = '".$_SESSION['Email_ECE']."' AND isProfil='0'";
				$req = mysqli_query($db_handle,$sql);
				echo('Upload Success');
			}
			else{
				echo( "erreur");
			}					
			$submit = 1;
			
		
		}	
		if($submit == 1){
			mysqli_close($db_handle);
			header('Location: vendeur_compte.php');
		}
	}
	
	
	
 ?>

<html>
	<head>
		<title>ECE Market Place | Espace Vendeur Modification</title>
		<meta charset="utf-8"/>
		
		<!-- Feuilles de style CSS -->
		<link href="styleVenteFlash.css" rel="stylesheet" type="text/css"/>
		
		<!-- Bootstrap content -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</head>
	
	<body>
	
		
		<nav class="navbar navbar-expand-md navbar-dark bg-dark" id="navigation">	
						
			<!-- bouton de toggle du menu -->
			<button class="btn btn-light" id="toggler">Menu</button>

			
			<!-- Brand image -->
			<a class="navbar-brand" href="home.php" id="brand">
				<img src="Pictures/Logo.png" width="130px" height="60px">
			</a>


			<!--  Menu -->
			<div class="collapse navbar-collapse justify-content-end">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="admin_connexion.php">Admin</a></li>
					<li class="nav-item"><a class="nav-link" href="vendeur_connexion.php">Vendre</a></li>
					<li class="nav-item"><a class="nav-link" href="client_connexion.php">Votre Compte <img src="Pictures/Compte.png" width="30" height="30"></a></li>
					<li class="nav-item"><a class="nav-link" href="panier.php">Panier <img src="Pictures/Panier.png" width="30" height="30"></a></li>
				</ul>
			</div>
		</nav>
		
		<div class="d-flex" id="wrapper">
		
			<!-- Sidebar -->
			<div class="bg-light border-right" id="sidebar-wrapper">
				<div class="list-group list-group-flush">
					<a href="categories.php" class="list-group-item list-group-item-action bg-light"><h3>Catégories</h3></a>
					<a href="livres.php" class="list-group-item list-group-item-action bg-light">Livres</a>
					<a href="musique.php" class="list-group-item list-group-item-action bg-light">Musique</a>
					<a href="sports.php" class="list-group-item list-group-item-action bg-light">Sports & Loisirs</a>
					<a href="vetements.php" class="list-group-item list-group-item-action bg-light">Vêtements</a>
					<a href="ventes_flash.php" class="list-group-item list-group-item-action bg-light"><h3>Ventes Flash</h3></a>
				</div>
			</div>

		<!-- /#sidebar-wrapper -->
		
		<!-- Page Content -->

			<div id="page-content-wrapper">
				<div class="container-fluid">
					<h1 style="font-weight: bold; text-align: center;">Renseignez les champs à Modifier</h1><br>
					<form action="vendeur_modifier.php" method="post" enctype="multipart/form-data">		
							<div class="card" style="width: 70%; margin:auto;">
								
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Importer Images</h3>
								</div>
								
								<div class="card-body bg-light">
									<!-- Photos upload -->
									<div style="display: inline-block; width: 100%; ">
										<p style="text-align: left;">Photo de profil :</p>
										<input type="file" style="margin-bottom:1rem; width:100%;" name="profile"/>	
									</div>
									<!-- video upload -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Fond d'écran :</p>
										<input type="file" style="margin-bottom:1rem; width:100%;" name="background"/>										
									</div>
									
									<!-- Validation -->
									<div style="text-align: center">
										<div style="display: inline-block;"><button type="submit" class="btn btn-success" style="font-size: 1.5rem; margin-top:1rem;">Modifier</button></div>
										<div style="display: inline-block; width:10%;"></div>
										<div style="display: inline-block;"><a href="vendeur_compte.php"><button type="button" class="btn btn-danger" style="font-size: 1.5rem; margin-top:1rem;">Annuler</button></div>
									</div>
								</div>
							</div><br>
					</form>
				</div>
			</div>
			<!-- /#page-content-wrapper -->
		</div>
		<!-- /#wrapper -->


		<!-- JS Code to Toggle Menu -->
		<script>
		$("#toggler").click(function(e) {
			$("#wrapper").toggleClass("toggled");
		});
		</script>
		

		
		<!-- Footer Navbar --> 
		<footer class="navbar navbar-expand-sm bg-dark navbar-dark fixed-bottom" id="footer">
			<div class="collapse navbar-collapse justify-content-end">
				  <!-- Navbar text-->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a  href="mailto:louis.deveze@edu.ece.fr"><h5>Contact</h5></a>
					</li>
				</ul>
			</div>
		</footer> 
	</body>
</html>
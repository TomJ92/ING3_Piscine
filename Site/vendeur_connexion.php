<?php 
$mail = isset($_POST["email"])? $_POST["email"] : "";
$pseudo = isset($_POST["pseudo"])? $_POST["pseudo"] : "";
$validation=false;
$message='';
$database='commerce';
$db_handle=mysqli_connect('localhost','root','');
$db_found=mysqli_select_db($db_handle,$database);
session_name('Vendeur');
session_start();
if(!empty($_SESSION['Email_ECE']))
{
	header('Location: vendeur_compte.php');
}
//si il y a un champ vide
if(empty($mail)||empty($pseudo))
{	
	$message ='<p> Un champ est vide, remplissez tous les champs s\'il-vous-plaît </p>' ;
}
//aucun champ vide
else
{
	//si on trouve la database
	if($db_found)
	{
		//commande SQL
		$sql="SELECT * FROM Vendeur";
		//on effectue la commande SQL
		$result=mysqli_query($db_handle,$sql);
		while($data=mysqli_fetch_assoc($result))
		{
			if(($mail==$data['Email_ECE']) && ($pseudo==$data['Pseudo']))
			{
				$validation=true;
				$_SESSION = array();
				$_SESSION=$data;
			}
		}
	}
	else
	{
		$message= 'BDD non trouvé';
	}
	if($validation)
	{
		$message= 'Bienvenue, vous êtes connecté ' . $_SESSION['Prenom'].' '. $_SESSION['Nom'];
		header('Location: vendeur_compte.php');
	}
	else
	{
		$message= '<p> Identifiants incorrects </p>';
	}
}
mysqli_close($db_handle);
 ?>
<html>
	<head>
		<title>ECE Market Place | Vendeur connexion</title>
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
					<li class="nav-item active"><a class="nav-link" href="vendeur_connexion.php">Vendre</a></li>
					<li class="nav-item"><a class="nav-link" href="client_compte.php">Votre Compte <img src="Pictures/Compte.png" width="30" height="30"></a></li>
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
					<h1 style="font-weight: bold; text-align: center;">Connection au profil de vendeur</h1><br>				
					
					<!-- Table de recherche -->
					<div style="text-align: center">
						<form action="vendeur_connexion.php" method="post">
							<div class="card" style="width: 70%; margin:auto;">
								
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Veuillez saisir les informations necessaires</h3>
								</div>
								
								<div class="card-body bg-light">
									<!-- pseudo -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Pseudo :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre pseudo " name="pseudo" />
									</div>
									<!-- email -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Email :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre email " name="email" />
									</div>
								
									<!-- Validation -->
									<div style="text-align: center">
										<button type="submit" class="btn btn-success" style="font-size: 1.5rem; margin-top:1rem;">Connexion</button>
										<?php
										echo $message;
										 ?>
									</div>
								</div>
							</div>
						</form>
					</div>			
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
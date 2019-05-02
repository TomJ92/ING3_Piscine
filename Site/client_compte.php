<?php
session_name('Client');
session_start();
if(empty($_SESSION['Email_client']))
{
	header('Location: client_connexion.php');
}else{
	//Connection to the database
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	//Connection to database
	$db_found=mysqli_select_db($db_handle,$database);
	if($db_found){	
		// on Recherche les infos
		$sql = "SELECT * FROM client WHERE Email_client LIKE '".$_SESSION['Email_client']."'";
		$req = mysqli_query($db_handle, $sql);
		$data = mysqli_fetch_assoc($req);
	}
	mysqli_close($db_handle);
}
?>
<html>
	<head>
		<title>ECE Market Place | Votre Compte</title>
		<meta charset="utf-8"/>
		
		<!-- Feuilles de style CSS -->
		<link href="styleHome.css" rel="stylesheet" type="text/css"/>
		
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
					<li class="nav-item active"><a class="nav-link" href="client_connexion.php">Votre Compte <img src="Pictures/Compte.png" width="30" height="30"></a></li>
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
					<h1 style="font-weight: bold; text-align: center;">Mes informations</h1><br>
					<!-- Informations -->
					<div id="informations" style="text-align: center;">
						<div style="width:48%; display: inline-block; text-align:left;">
							<!-- Identifiants  enregistrée-->
							<div class="card" style="width: 90%; margin:auto;">
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem; text-align: center">Identifiants</h3>
								</div>
								
								<div class="card-body bg-light">
									<h3 style="font-weight: bold; color: black; font-size:1.4rem; display: inline-block">Nom : </h3> 
									<p style="font-weight: bold; color: #696969; font-size:1.25rem; display: inline-block" id="nom"><?php echo($data['Nom']); ?></p><br>
									<h3 style="font-weight: bold; color: black; font-size:1.4rem; display: inline-block">Prénom : </h3> 
									<p style="font-weight: bold; color: #696969; font-size:1.25rem; display: inline-block" id="prenom"><?php echo($data['Prenom']); ?></p><br>
									<h3 style="font-weight: bold; color: black; font-size:1.4rem; display: inline-block">E-mail : </h3> 
									<p style="font-weight: bold; color: #696969; font-size:1.25rem; display: inline-block" id="email"><?php echo($data['Email_client']); ?></p><br>
								</div>
							</div><br>
							<!-- Carte enregistrée-->
							<div class="card" style="width: 90%; margin:auto;">
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Carte enregistrée </h3>
								</div>
								<div class="card-body bg-light">
									<p style="font-weight: bold; color: #696969; font-size:1.25rem;">
										<img  src="Pictures/Mastercard.png" width="100" height="70" alt="" id="carte"> 
										|  <?php echo($data['Nom_carte']); ?>  |  Carte : <?php echo(substr($data['Numero_carte'],0, 4)); ?> XXXX XXXX XXXX
									</p>
								</div>
							</div><br>
						</div>
						
						<div style="width:48%; display: inline-block;  vertical-align: top; text-align:left;">
							<!-- Adresse  enregistrée-->
							<div class="card" style="width: 90%; margin:auto;">
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem; text-align: center">Adresse</h3>
								</div>
								
								<div class="card-body bg-light">
									<h3 style="font-weight: bold; color: black; font-size:1.4rem; display: inline-block">Adresse : </h3> 
									<p style="font-weight: bold; color: #696969; font-size:1.25rem; display: inline-block" id="adresse"><?php echo($data['Adresse']); ?></p><br>
									<h3 style="font-weight: bold; color: black; font-size:1.4rem; display: inline-block">Ville : </h3> 
									<p style="font-weight: bold; color: #696969; font-size:1.25rem; display: inline-block" id="ville"><?php echo($data['Ville']); ?></p><br>
									<h3 style="font-weight: bold; color: black; font-size:1.4rem; display: inline-block">Code Postale : </h3> 
									<p style="font-weight: bold; color: #696969; font-size:1.25rem; display: inline-block" id="poste"><?php echo($data['Code_postal']); ?></p><br>
									<h3 style="font-weight: bold; color: black; font-size:1.4rem; display: inline-block">Pays : </h3> 
									<p style="font-weight: bold; color: #696969; font-size:1.25rem; display: inline-block" id="pays"><?php echo($data['Pays']); ?></p><br>
								</div>
							</div><br>
						</div>
					</div>
					<div id="informations" style="text-align: center; ">
						<div style="display: inline-block; width:48%; text-align: center; ">
							<a href="client_modifier.html" ><button type="button" class="btn btn-success" style="font-size: 1.5rem; display: inline-block">Modifier les Informations</button></a>
						</div>
						<div style="display: inline-block;  width:48%;   text-align: center; ">
							<a href="client_logout.php" class="btn btn-danger" style="font-size: 1.5rem; display: inline-block">Se Déconnecter</a>
						</div>
						
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
<?php
session_name('Admin');
session_start();
if($_SESSION['Pseudo']!='root')
{
	header('Location: admin_connexion.php');
}
?>
<html>
	<head>
		<title>ECE Market Place | Espace Administrateur</title>
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
					<li class="nav-item active"><a class="nav-link" href="compte_client.php">Votre Compte <img src="Pictures/Compte.png" width="30" height="30"></a></li>
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
					<h1 style="font-weight: bold; text-align: center;">Panneau de Contrôle Administrateur</h1><br>
					<!-- Informations -->
					<div style="text-align: center; margin-top: 3rem;">
						<div style="display: inline-block; width: 45%;">
							<div class="card" style="width: 60%; margin:auto;">
								<!-- Gestion des items -->
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Gestion des Items</h3>
								</div>
								<div class="card-body bg-light">
										<div style="padding-bottom: 2rem;"> <a href="admin_ajouter_items.php" style="text-decoration:none;"><button type="button" class="btn btn-success btn-lg btn-block">Ajouter</button></a></div>
										<div style="padding-bottom: 2rem;"><a href="admin_consulter_items.php" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-lg btn-block">Consulter</button></a></div>
										<div style="padding-bottom: 2rem;"><a href="admin_supprimer_items.php" style="text-decoration:none;"><button type="button" class="btn btn-danger btn-lg btn-block">Supprimer</button></a></div>
								</div>
							</div><br>
						</div>
						<div style="display: inline-block; vertical-align: top; width: 45%;">
							<div class="card" style="width: 60%; margin:auto;;">
								<!-- Gestion des Vendeurs -->
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Gestion des Vendeurs</h3>
								</div>
								<div class="card-body bg-light">
									<div style="padding-bottom: 2rem;"> <a href="admin_ajouter_vendeurs.php" style="text-decoration:none;"><button type="button" class="btn btn-success btn-lg btn-block">Ajouter</button></a></div>
									<div style="padding-bottom: 2rem;"><a href="admin_consulter_vendeurs.php" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-lg btn-block">Consulter</button></a></div>
									<div style="padding-bottom: 2rem;"><a href="admin_supprimer_vendeurs.php" style="text-decoration:none;"><button type="button" class="btn btn-danger btn-lg btn-block">Supprimer</button></a></div>
								</div>
							</div><br>
						</div>
						<div style="display: inline-block; margin-top: 2rem; width: 100%;">
							<a href="admin_logout.php" class="btn btn-danger btn-lg">Se Déconnecter</a>
						</div>
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
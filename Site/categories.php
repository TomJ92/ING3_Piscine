<html>
	<head>
		<title>ECE Market Place | Catégories</title>
		<meta charset="utf-8"/>
		
		<!-- Feuilles de style CSS -->
		<link href="styleCategorie.css" rel="stylesheet" type="text/css"/>
		
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
				<!-- Text decoration to none pour enlever le surlignage du lien -->
					
					<!-- Lien pour les categories -->
					<a href="categories.php" style="text-decoration: none"><h1>Catégories</h1></a><br>
						
					<div class="card-deck" id="categories" style="width: 85%; margin-bottom: 4rem; margin-left: auto; margin-right: auto; text-align: center">
						<!--  Livre -->
						<div class="card" >
							<div class="card-header"> <a class="card-title" href="livres.php" style="font-size: 1.2rem; text-decoration:none; color: black">Livres</a> </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Livres.png" alt="Card image">
								<p class="card-text" style="font-size: 0.75rem; text-align: left">Venez découvrir notre large sélection de livres pour les petits comme pour les grands</p>
								<a href="livres.php" class="btn btn-secondary" style="font-size: 0.75rem">Découvrir</a>
							</div>
						</div>						
						
						<!-- Musique -->
						<div class="card " >
							<div class="card-header"> <a class="card-title" href="musique.php" style="font-size: 1.2rem; text-decoration:none; color: black">Musique</a>  </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Musique.png" alt="Card image">
								<p class="card-text" style="font-size: 0.75rem; text-align: left">Ecoutez notre sélection de musiques et nos divers artistes sélectionnés rien que pour vous</p>
								<a href="musique.php" class="btn btn-secondary" style="font-size: 0.75rem">Découvrir</a>
							</div>
						</div>						
						
						<!-- Sport & Loisirs -->
						<div class="card " >
							<div class="card-header"> <a class="card-title" href="sports.php" style="font-size: 1.2rem; text-decoration:none; color: black">Sports & Loisirs</a>  </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Sports.png" alt="Card image">
								<p class="card-text" style="font-size: 0.75rem; text-align: left">Gardez la forme avec notre panel d'équipements de sports et articles de loisirs en plein air </p>
								<a href="sports.php" class="btn btn-secondary" style="font-size: 0.75rem">Découvrir</a>
							</div>
						</div>						
						
						<!-- Vetements -->
						<div class="card" >
							<div class="card-header"> <a class="card-title" href="vetements.php" style="font-size: 1.2rem; text-decoration:none; color: black">Vêtements</a>  </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Vetements.png" alt="Card image">
								<p class="card-text" style="font-size: 0.75rem; text-align: left">Affichez un style unique avec notre selection mode de première qualité</p>
								<a href="vetements.php" class="btn btn-secondary" style="font-size: 0.75rem">Découvrir</a>
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
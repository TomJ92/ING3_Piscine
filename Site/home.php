<?php
	//Connection to the database
    $base = mysqli_connect ('localhost', 'root', ''); 
	//Connection to the table Item
    mysqli_select_db ("commerce", $base); 
       
    // on Capte le best seller musique
    $sql = "SELECT `nom`, MAX(`Vendu`)  FROM `item` WHERE `Categorie` = 'Musique'"; 
    $req = mysqli_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error()); 
    $data = mysqli_fetch_array($req); 
    mysqli_free_result($req); 
    mysqli_close(); 
	$bslivre = $req;

 
?>

<html>
	<head>
		<title>ECE Market Place | Home</title>
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
			<a class="navbar-brand" href="home.html" id="brand">
				<img src="Pictures/Logo.png" width="130px" height="60px">
			</a>


			<!--  Menu -->
			<div class="collapse navbar-collapse justify-content-end">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="#">Admin</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Vendre</a></li>
					<li class="nav-item"><a class="nav-link" href="compte_client.html">Votre Compte <img src="Pictures/Compte.png" width="30" height="30"></a></li>
					<li class="nav-item"><a class="nav-link" href="panier.html">Panier <img src="Pictures/Panier.png" width="30" height="30"></a></li>
				</ul>
			</div>
		</nav>
		
		<div class="d-flex" id="wrapper">
		
			<!-- Sidebar -->
			<div class="bg-light border-right" id="sidebar-wrapper">
				<div class="list-group list-group-flush">
					<a href="categories.html" class="list-group-item list-group-item-action bg-light"><h3>Catégories</h3></a>
					<a href="livres.html" class="list-group-item list-group-item-action bg-light">Livres</a>
					<a href="musique.html" class="list-group-item list-group-item-action bg-light">Musique</a>
					<a href="sports.html" class="list-group-item list-group-item-action bg-light">Sports & Loisirs</a>
					<a href="vetements.html" class="list-group-item list-group-item-action bg-light">Vêtements</a>
					<a href="ventes_flash.html" class="list-group-item list-group-item-action bg-light"><h3>Ventes Flash</h3></a>
				</div>
			</div>

		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->

			<div id="page-content-wrapper">
				<div class="container-fluid">
				<!-- Text decoration to none pour enlever le surlignage du lien -->
					
					<!-- Lien pour les Ventes flash -->
					<a href="ventes_flash.html" style="text-decoration: none" ><h1>Ventes Flash</h1></a>
					
					<div class="card-deck" id="flash" style="width: 85%; margin: auto;">
						<!-- Best seller Livre -->
						<div class="card" >
							<div class="card-header"> <h4 class="card-title" style="font-size: 1.2rem; text-align: center">Best Seller Livres</h4> </div>
							<img class="card-img" src="" alt="Card image">
							<div class="card-body" >
								<p class="card-text" style="font-size: 0.75rem">Description du produit a charger dans la base de données</p>
								<a href="#" class="btn btn-secondary" style="font-size: 0.75rem">Plus d'informations</a>
								<p style="display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;">75€</p>
							</div>
						</div>						
						
						<!-- Best seller Musique -->
						<div class="card" >
							<div class="card-header"> <h4 class="card-title" style="font-size: 1.2rem; text-align: center"><?php echo(CACA); ?></h4> </div>
							<img class="card-img" src="" alt="Card image">
							<div class="card-body" >
								<p class="card-text" style="font-size: 0.75rem">Description du produit a charger dans la base de données</p>
								<a href="#" class="btn btn-secondary" style="font-size: 0.75rem">Plus d'informations</a>
								<p style="display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;">75€</p>
							</div>
						</div>						
						
						<!-- Best seller Sport -->
						<div class="card " >
							<div class="card-header"> <h4 class="card-title" style="font-size: 1.2rem; text-align: center">Best Seller Sports</h4> </div>
							<img class="card-img" src="" alt="Card image">
							<div class="card-body" >
								<p class="card-text" style="font-size: 0.75rem">Description du produit a charger dans la base de données</p>
								<a href="#" class="btn btn-secondary" style="font-size: 0.75rem">Plus d'informations</a>
								<p style="display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;">75€</p>
							</div>
						</div>						
						
						<!-- Best seller Vetements -->
						<div class="card " >
							<div class="card-header"> <h4 class="card-title" style="font-size: 1.2rem; text-align: center">Best Seller Vêtements</h4> </div>
							<img class="card-img" src="" alt="Card image">
							<div class="card-body" >
								<p class="card-text" style="font-size: 0.75rem">Description du produit a charger dans la base de données</p>
								<a href="#" class="btn btn-secondary" style="font-size: 0.75rem">Plus d'informations</a>
								<p style="display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;">75€</p>
							</div>
						</div>
						
					</div>
					
					<!-- Lien pour les categories -->
					<a href="categories.html" style="text-decoration: none"><h1>Catégories</h1><a><br>
						
					<div class="card-deck" id="categories" style="width: 85%; margin-bottom: 4rem; margin-left: auto; margin-right: auto; text-align: center">
						<!--  Livre -->
						<div class="card" >
							<div class="card-header"> <a class="card-title" href="#" style="font-size: 1.2rem; text-decoration:none; color: black">Livres</a> </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Livres.png" alt="Card image">
							</div>
						</div>						
						
						<!-- Musique -->
						<div class="card " >
							<div class="card-header"> <a class="card-title" href="#" style="font-size: 1.2rem; text-decoration:none; color: black">Musique</a>  </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Musique.png" alt="Card image">
							</div>
						</div>						
						
						<!-- Sport & Loisirs -->
						<div class="card " >
							<div class="card-header"> <a class="card-title" href="#" style="font-size: 1.2rem; text-decoration:none; color: black">Sports & Loisirs</a>  </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Sports.png" alt="Card image">
							</div>
						</div>						
						
						<!-- Vetements -->
						<div class="card" >
							<div class="card-header"> <a class="card-title" href="#" style="font-size: 1.2rem; text-decoration:none; color: black">Vêtements</a>  </div>
							<div class="card-body" >
								<img class="card-img" src="Pictures/Vetements.png" alt="Card image">
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
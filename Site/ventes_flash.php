<html>
	<head>
		<title>ECE Market Place | Ventes Flash</title>

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
			<a class="navbar-brand" href="home.html" id="brand">
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
					<a href="categories.html" class="list-group-item list-group-item-action bg-light"><h3>Catégories</h3></a>
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
					
					<!-- Lien pour les ventes flash-->
					<a href="ventes_flash.html" style="text-decoration: none"><h1 style="text-align:center">Ventes Flash</h1></a>
					<!-- Lien pour les ventes de livre-->

					<!-- Lien pour livres -->
					<a href="livres.php" style="text-decoration: none"><h2 style="text-align:center">Livres</h2></a>
					<!-- Best sellers livres -->
					<div class="card-deck" id="livres" style="width: 85%; margin-bottom: 4rem; margin-left: auto; margin-right: auto; text-align: center">
						<!-- on decrit les differentes cartes livre à partir de la base de donnée-->
						<?php
							//Connection to the database
							$database='commerce';
							$db_handle=mysqli_connect('localhost','root','');
							//Connection to database
							$db_found=mysqli_select_db($db_handle,$database);
							if($db_found){	
								
								// on Capte la collection de livres
								$sql = "SELECT item.nom, item.description, item.prix, imgitem.nom_img FROM item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' AND Categorie='Livres' ORDER BY item.vendu DESC LIMIT 4"; 
								$req = mysqli_query($db_handle, $sql);
								while($data=mysqli_fetch_assoc($req))
								{
									echo("<div class=\"card\" ><div class=\"card-header\"> <h4 class=\"card-title\" style=\"font-size: 1.2rem; text-align: center\">");
									echo($data['nom']);
									echo("</h4> </div><img class=\"card-img\" src=\"");
									echo($data['nom_img']);
									echo("\" alt=\"Card image\"><div class=\"card-body\" ><p class=\"card-text\" style=\"font-size: 0.75rem\">");
									echo($data['description']);
									echo("</p><a href=\"#\" class=\"btn btn-secondary\" style=\"font-size: 0.75rem\">Plus d'informations</a><p style=\"display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;\">");
									echo($data['prix']);
									echo("€</p></div></div>");
								}
							}	
							mysqli_close($db_handle);
						?>
						
						
					</div>
					
					<!-- Lien pour les ventes d'albums -->
					<a href="musique.php" style="text-decoration: none"><h2 style="text-align:center">Musique</h2></a>
					<!-- Best sellers musique -->
					<div class="card-deck" id="musique" style="width: 85%; margin-bottom: 4rem; margin-left: auto; margin-right: auto; text-align: center">
						<!-- on decrit les differentes cartes album à partir de la base de donnée-->
						<?php
							//Connection to the database
							$database='commerce';
							$db_handle=mysqli_connect('localhost','root','');
							//Connection to database
							$db_found=mysqli_select_db($db_handle,$database);
							if($db_found){	
								
								// on Capte la collection de musiques
								$sql = "SELECT item.nom, item.description, item.prix, imgitem.nom_img FROM item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' AND Categorie='Musique' ORDER BY item.vendu DESC LIMIT 4"; 
								$req = mysqli_query($db_handle, $sql);
								while($data=mysqli_fetch_assoc($req))
								{
									echo("<div class=\"card\" ><div class=\"card-header\"> <h4 class=\"card-title\" style=\"font-size: 1.2rem; text-align: center\">");
									echo($data['nom']);
									echo("</h4> </div><img class=\"card-img\" src=\"");
									echo($data['nom_img']);
									echo("\" alt=\"Card image\"><div class=\"card-body\" ><p class=\"card-text\" style=\"font-size: 0.75rem\">");
									echo($data['description']);
									echo("</p><a href=\"#\" class=\"btn btn-secondary\" style=\"font-size: 0.75rem\">Plus d'informations</a><p style=\"display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;\">");
									echo($data['prix']);
									echo("€</p></div></div>");
								}
							}	
							mysqli_close($db_handle);
						?>
						
						
					</div>
					
					<!-- Lien pour les ventes d'articles sports et loisirs -->
					<a href="sports.php" style="text-decoration: none"><h2 style="text-align:center">Sports et loisirs</h2></a>
					<!-- Best sellers sports et loisirs -->
					<div class="card-deck" id="sports" style="width: 85%; margin-bottom: 4rem; margin-left: auto; margin-right: auto; text-align: center">
						<!-- on decrit les differentes cartes sports et loisirs à partir de la base de donnée-->
						<?php
							//Connection to the database
							$database='commerce';
							$db_handle=mysqli_connect('localhost','root','');
							//Connection to database
							$db_found=mysqli_select_db($db_handle,$database);
							if($db_found){	
								
								// on Capte la collection d'articles sports et loisirs
								$sql = "SELECT item.nom, item.description, item.prix, imgitem.nom_img FROM item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' AND Categorie='Sports' ORDER BY item.vendu DESC LIMIT 4"; 
								$req = mysqli_query($db_handle, $sql); 
								while($data=mysqli_fetch_assoc($req))
								{
									echo("<div class=\"card\" ><div class=\"card-header\"> <h4 class=\"card-title\" style=\"font-size: 1.2rem; text-align: center\">");
									echo($data['nom']);
									echo("</h4> </div><img class=\"card-img\" src=\"");
									echo($data['nom_img']);
									echo("\" alt=\"Card image\"><div class=\"card-body\" ><p class=\"card-text\" style=\"font-size: 0.75rem\">");
									echo($data['description']);
									echo("</p><a href=\"#\" class=\"btn btn-secondary\" style=\"font-size: 0.75rem\">Plus d'informations</a><p style=\"display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;\">");
									echo($data['prix']);
									echo("€</p></div></div>");
								}
							}	
							mysqli_close($db_handle);
						?>
						
						
					</div>	
					
					<!-- Lien pour les ventes d'articles vetements -->
					<a href="vetements.php" style="text-decoration: none"><h2 style="text-align:center">Vêtements</h2></a>
					<!-- Best sellers vetements -->
					<div class="card-deck" id="vetements" style="width: 85%; margin-bottom: 4rem; margin-left: auto; margin-right: auto; text-align: center">
						<!-- on decrit les differentes cartes vetements à partir de la base de donnée-->
						<?php
							//Connection to the database
							$database='commerce';
							$db_handle=mysqli_connect('localhost','root','');
							//Connection to database
							$db_found=mysqli_select_db($db_handle,$database);
							if($db_found){	
								
								// on Capte la collection de vetements
								$sql = "SELECT item.nom, item.description, item.prix, imgitem.nom_img FROM item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' AND Categorie='Vetements' ORDER BY item.vendu DESC LIMIT 4"; 
								$req = mysqli_query($db_handle, $sql);
								while($data=mysqli_fetch_assoc($req))
								{
									echo("<div class=\"card\" ><div class=\"card-header\"> <h4 class=\"card-title\" style=\"font-size: 1.2rem; text-align: center\">");
									echo($data['nom']);
									echo("</h4> </div><img class=\"card-img\" src=\"");
									echo($data['nom_img']);
									echo("\" alt=\"Card image\"><div class=\"card-body\" ><p class=\"card-text\" style=\"font-size: 0.75rem\">");
									echo($data['description']);
									echo("</p><a href=\"#\" class=\"btn btn-secondary\" style=\"font-size: 0.75rem\">Plus d'informations</a><p style=\"display: inline-block; padding-left: 2rem; font-size: 1.5rem; font-weight: bold;\">");
									echo($data['prix']);
									echo("€</p></div></div>");
								}
							}	
							mysqli_close($db_handle);
						?>
						
						
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
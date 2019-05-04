<?php 
	session_name('Vendeur');
	session_start();
	if(empty($_SESSION['Email_ECE'])){
		header('Location: vendeur_connexion.php');
	}
	else{
		//Get the Search request
		$research = isset($_POST["search"])? $_POST["search"] : "";
		// Database
		$database='commerce';
		$db_handle=mysqli_connect('localhost','root','');
		$db_found=mysqli_select_db($db_handle,$database);
	}
?>


<html>
	<head>
		<title>ECE Market Place | Vendeur Ajouter Items</title>
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
					<a href="musique" class="list-group-item list-group-item-action bg-light">Musique</a>
					<a href="sports.html" class="list-group-item list-group-item-action bg-light">Sports & Loisirs</a>
					<a href="vetements.html" class="list-group-item list-group-item-action bg-light">Vêtements</a>
					<a href="ventes_flash.html" class="list-group-item list-group-item-action bg-light"><h3>Ventes Flash</h3></a>
				</div>
			</div>

		<!-- /#sidebar-wrapper -->
		
		<!-- Page Content -->

			<div id="page-content-wrapper">
				<div class="container-fluid">
					
					<h1 style="font-weight: bold; text-align: center;">Choisir la quantité a ajouter de chaque article</h1><br>
					<!-- Recherche -->
					<div style="text-align: center">
						<form action="vendeur_ajouter_item.php" method="post">
							<div style="display: inline-block"><input type="text" class="form-control form-control-lg mb-2 mr-sm-2" placeholder="Rechercher un Item" name="search" ></div>
							<div style="display: inline-block; width:2%"></div>
							<div style="display: inline-block"><button type="submit" class="btn btn-secondary" style="font-size: 1.5rem;">Rechercher</button></div>
						</form>
					</div>	
					
					<form action="vendeur_ajouter_item2.php" method="post">
						
						<div style=" display:inline-block">
							<div style="display: inline-block"><button type="submit" name="submit_ad" class="btn btn-success" style="font-size: 1.5rem;">Valider Ajouts</button></a></div>
						</div>
						
						<table class="table table-striped " style="width:80%; margin: auto">
							<thead class="thead-dark">
								<tr>
									<th scope="col">Image</th>
									<th scope="col">Article</th>
									<th scope="col">Categorie</th>
									<th scope="col">Description</th>
									<th scope="col">Prix Unitaire</th>
									<th scope="col">Quantité a ajouter</th>
								</tr>
							</thead>
							<tbody>
								<?php
									//Get the Search request
									$research = isset($_POST["search"])? $_POST["search"] : "";
									//Connection to the database
									$database='commerce';
									$db_handle=mysqli_connect('localhost','root','');
									$db_found=mysqli_select_db($db_handle,$database);
									if($db_found){	
										if(empty($research)){
											// on select dans la base
											$sql = "SELECT * FROM item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' ORDER BY item.quantite DESC"; 
											$req = mysqli_query($db_handle, $sql); 
											while($data=mysqli_fetch_assoc($req))
											{
												echo("<tr>");
												echo("<td class=\"align-middle\"><img src=\"".$data['Nom_img']."\" style=\"width:6rem; height:6rem\" alt=\"\"></td>");
												echo("<td class=\"align-middle\">".$data['Nom']."</td>");
												echo("<td class=\"align-middle\">".$data['Categorie']."</td>");
												echo("<td class=\"align-middle\">".$data['Description']."</td>");
												echo("<td class=\"align-middle\">".$data['Prix']."€</td>");
												echo('<td class="align-middle"><input type="number" class="form-control mb-2 mr-sm-2" placeholder="qte ajouts" value="0" name="ajouter[]">');
												echo("</tr>");
												echo('<input type="hidden" name="ids[]" value="'.$data['Id_item'].'" placeholder="Nb"/>');
												echo('<input type="hidden" name="quantite[]" value="'.$data['Quantite_vendeur'].'" placeholder="Nb"/>');
												
											}
										}
										else{
											// on select dans la base
											$sql = "SELECT * FROM item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' AND item.nom = '".$research."' ORDER BY item.quantite DESC " ; 
											$req = mysqli_query($db_handle, $sql); 
											while($data=mysqli_fetch_assoc($req)){
												echo("<tr>");
												echo("<td class=\"align-middle\"><img src=\"".$data['Nom_img']."\" style=\"width:6rem; height:6rem\" alt=\"\"></td>");
												echo("<td class=\"align-middle\">".$data['Nom']."</td>");
												echo("<td class=\"align-middle\">".$data['Categorie']."</td>");
												echo("<td class=\"align-middle\">".$data['Description']."</td>");
												echo("<td class=\"align-middle\">".$data['Prix']."€</td>");
												echo('<td class="align-middle"><input type="number" class="form-control mb-2 mr-sm-2" placeholder="qte ajouts" value="0" name="ajouter[]">');
												echo("</tr>");
												echo('<input type="hidden" name="ids[]" value="'.$data['Id_item'].'" placeholder="Nb"/>');
												echo('<input type="hidden" name="quantite[]" value="'.$data['Quantite_vendeur'].'" placeholder="Nb"/>');
											}
											// on select dans la base
											$sql = "SELECT * FROM item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' AND item.categorie = '".$research."' ORDER BY item.quantite DESC "; 
											$req = mysqli_query($db_handle, $sql); 
											while($data=mysqli_fetch_assoc($req)){
												echo("<tr>");
												echo("<td class=\"align-middle\"><img src=\"".$data['Nom_img']."\" style=\"width:6rem; height:6rem\" alt=\"\"></td>");
												echo("<td class=\"align-middle\">".$data['Nom']."</td>");
												echo("<td class=\"align-middle\">".$data['Categorie']."</td>");
												echo("<td class=\"align-middle\">".$data['Description']."</td>");
												echo("<td class=\"align-middle\">".$data['Prix']."€</td>");
												echo('<td class="align-middle"><input type="number" class="form-control mb-2 mr-sm-2" placeholder="qte ajouts" value="0" name="ajouter[]">');
												echo("</tr>");
												echo('<input type="hidden" name="ids[]" value="'.$data['Id_item'].'" placeholder="Nb"/>');
												echo('<input type="hidden" name="quantite[]" value="'.$data['Quantite_vendeur'].'" placeholder="Nb"/>');											
											}
										}
									}
											
									mysqli_close($db_handle);
								?>
							</tbody>
						</table>
					
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
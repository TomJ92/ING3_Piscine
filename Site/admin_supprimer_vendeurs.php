<?php
	//Get the Search request
	$research = isset($_POST["search"])? $_POST["search"] : "";
	echo($research);
	//Connection to the database
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	$db_found=mysqli_select_db($db_handle,$database);
	
	
?>

<html>
	<head>
		<title>ECE Market Place | Supprimer vendeur</title>
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
					<li class="nav-item active"><a class="nav-link" href="admin_connexion.php">Admin</a></li>
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
					<h1 style="font-weight: bold; text-align: center;">Supprimer des vendeurs de la liste</h1><br>
					<!-- Recherche -->
					<div style="text-align: center">
						<form action="admin_supprimer_vendeurs.php" method="Post">
							<div style="display: inline-block"><input type="text" class="form-control form-control-lg mb-2 mr-sm-2" placeholder="Rechercher un Item" name="search" ></div>
							<div style="display: inline-block; width:2%"></div>
							<div style="display: inline-block"><button type="submit" class="btn btn-secondary" style="font-size: 1.5rem;">Rechercher</button></div>
						</form>
						<form action="suppression_vendeurs.php" method="Post">
						<div style=" display:inline-block">
							<div style="display: inline-block"><button type="submit" name="submit_sup" class="btn btn-danger" style="font-size: 1.5rem;">Supprimer des Items</button></a></div>
						</div>	
					</div>					
					
					<!-- Table de recherche -->
					<div style="text-align: center">
						
							<table class="table table-striped " style="width:80%; margin: auto">
								<thead class="thead-dark">
									<tr>
										<th scope="col">Email</th>
										<th scope="col">Pseudo</th>
										<th scope="col">Nom</th>
										<th scope="col">Prenom</th>
										<th scope="col">Supprimer</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if($db_found){	
										
											if(empty($research)){
												// on select dans la base
												$sql = "SELECT * FROM vendeur"; 
												$req = mysqli_query($db_handle, $sql); 
												while($data=mysqli_fetch_assoc($req))
												{
													echo("<tr>");
													echo("<td class=\"align-middle\">".$data['Email_ECE']."</td>");
													echo("<td class=\"align-middle\">".$data['Pseudo']."</td>");
													echo("<td class=\"align-middle\">".$data['Nom']."</td>");
													echo("<td class=\"align-middle\">".$data['Prenom']."</td>");
													echo('<td class="align-middle"><input class="form-check-input" type="checkbox" value="'.$data['Email_ECE'].'" name="supprimer[]">Supprimer</td>');
													echo("</tr>");
												}
											}else{
												// on select dans la base
												$sql = "SELECT * FROM vendeur WHERE Email_ECE = '".$research."' OR Pseudo = '".$research."' OR Nom = '".$research."' OR Prenom = '".$research."'"; 
												
												$req = mysqli_query($db_handle, $sql); 
												while($data=mysqli_fetch_assoc($req))
												{
													echo("<tr>");
													echo("<td class=\"align-middle\">".$data['Email_ECE']."</td>");
													echo("<td class=\"align-middle\">".$data['Pseudo']."</td>");
													echo("<td class=\"align-middle\">".$data['Nom']."</td>");
													echo("<td class=\"align-middle\">".$data['Prenom']."</td>");
													echo('<td class="align-middle"><input class="form-check-input" type="checkbox" value="'.$data['Email_ECE'].'" name="supprimer[]">Supprimer</td>');
													echo("</tr>");
												}
											}
										}	
										mysqli_close($db_handle);
									?>
								</tbody>
							</table><br>
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
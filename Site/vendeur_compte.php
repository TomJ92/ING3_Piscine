<?php
	session_name('Vendeur');
	session_start();
	if(empty($_SESSION['Email_ECE']))
	{
		header('Location: vendeur_connexion.php');
	}else{
		//Connection to the database
		$database='commerce';
		$db_handle=mysqli_connect('localhost','root','');
		//Connection to database
		$db_found=mysqli_select_db($db_handle,$database);
		if($db_found){	
			// on Recherche les infos
			$sql = "SELECT * FROM vendeur INNER JOIN imgvendeur ON vendeur.Email_ECE = imgvendeur.Email_ECE WHERE vendeur.Email_ECE LIKE '".$_SESSION['Email_ECE']."'AND imgvendeur.isProfil LIKE '1'";
			$req = mysqli_query($db_handle, $sql);
			$data = mysqli_fetch_assoc($req);
			
			$sql = "SELECT imgvendeur.Nom_vendeur FROM vendeur INNER JOIN imgvendeur ON vendeur.Email_ECE = imgvendeur.Email_ECE WHERE vendeur.Email_ECE LIKE '".$_SESSION['Email_ECE']."'AND imgvendeur.isProfil LIKE '0'";
			$req = mysqli_query($db_handle, $sql);
			$data2 = mysqli_fetch_assoc($req);
		}
	mysqli_close($db_handle);
	}
?>
<html>
	<head>
		<title>ECE Market Place | Escpace Vendeur</title>
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
		
		<div class="d-flex" id="wrapper" >
		
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

			<div id="page-content-wrapper" >
				<div class="container-fluid" style=" background-image: url('<?php echo($data2['Nom_vendeur']); ?>')">
					<h1 style="font-weight: bold; text-align: center; color:black">Mes informations</h1><br>
					<!-- Informations -->
					<div id="identifiants" style="text-align: center; display: inline-block; width: 48%">
							<!-- Identifiants  enregistrée-->
							<div class="card" style="width: 90%; margin:auto; ">
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem; text-align: center">Identifiants</h3>
								</div>
								
								<div class="card-body bg-light">
									<img class="card-img" src="<?php echo($data['Nom_vendeur']); ?>" alt="Card image" style="width:200px; height:200px; ">
									<div>
										<div>
											<div style="width:48%; display: inline-block">
												<h3 style="font-weight: bold; color: black; font-size:1.4rem; text-align: left">Nom : </h3> 
											</div>
											<div style="width:48%; display: inline-block">
												<h3 style="font-weight: bold; color: #696969; font-size:1.25rem; text-align: left" id="nom"><?php echo($data['Nom']); ?></h3>
											</div>
										</div>
										<div>
											<div style="width:48%; display: inline-block">
												<h3 style="font-weight: bold; color: black; font-size:1.4rem; text-align: left">Pseudo : </h3> 
											</div>
											<div style="width:48%; display: inline-block">
												<h3 style="font-weight: bold; color: #696969; font-size:1.25rem; text-align: left" id="pseudo"><?php echo($data['Pseudo']); ?></h3>
											</div>
										</div>
										<div>
											<div style="width:48%; display: inline-block">
												<h3 style="font-weight: bold; color: black; font-size:1.4rem; text-align: left">E-mail : </h3> 
											</div>
											<div style="width:48%; display: inline-block">
												<h3 style="font-weight: bold; color: #696969; font-size:1.25rem; text-align: left" id="email"><?php echo($data['Email_ECE']); ?></h3>
											</div>
										</div>
										
									</div>
									<div style="margin-top: 2rem">
										<div style="width:48%; display: inline-block">
											<a href="vendeur_modifier.php" ><button type="button" class="btn btn-success" style="font-size: 1.5rem;">Modifier les Informations</button></a>
										</div>
										<div style="width:48%; display: inline-block">
											<a href="vendeur_logout.php" type="submit" class="btn btn-danger" style="font-size: 1.5rem;">Se Déconnecter</a>
										</div>
									</div>
								</div>
							</div><br>
							
					</div>				
					<div id="gestion" style="text-align: center; display: inline-block; vertical-align: top; width: 48%; margin-bottom:45rem">
							
							<div class="card" style="width: 90%; margin:auto; ">
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem; text-align: center">Gérer les Ventes</h3>
								</div>
								
								<div class="card-body bg-light">
									<div style="margin-top: 2rem">
										<div style="width:48%; display: inline-block">
											<a href="vendeur_ajouter_item.php" ><button type="button" class="btn btn-secondary" style="font-size: 1.5rem;">Ajouter à la Vente</button></a>
										</div>
										<div style="width:48%; display: inline-block">
											<a href="vendeur_supprimer_item.php" ><button type="button" class="btn btn-secondary" style="font-size: 1.5rem;">Retirer de la Vente</button></a>
										</div>
									</div>
								</div>
							</div><br>
					</div><br>
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
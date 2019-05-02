<?php
	session_name('Client');
	session_start();
	if(empty($_SESSION['Email_client']))
	{
		header('Location: client_connexion.php');
	}
	else {
		//Connection to the database
		$database='commerce';
		$db_handle=mysqli_connect('localhost','root','');
		//Connection to database
		$db_found=mysqli_select_db($db_handle,$database);
		if($db_found){	
			//on capte les infos client
			$sql = "SELECT Email_Client, Nom, Prenom, Password, Adresse, Ville, Code_postal, Pays, Telephone, Type_carte, Numero_carte, Date_carte, Code_carte FROM Client";
			$req = mysqli_query($db_handle, $sql); 
			$data=mysqli_fetch_assoc($req);
		}
		mysqli_close($db_handle);
	}
	
?>


<html>
	<head>
		<title>ECE Market Place | Modifier Compte</title>
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
					<h1 style="font-weight: bold; text-align: center;">Modifier les Informations</h1><br>
					<!-- Informations -->
					<form class="form" action="client_modifier2.php" method="post">
						<div style="display: inline-block; width: 45%;">
							<div class="card" style="width: 100%; margin:auto;">
								<!-- Informations personelle -->
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Informations personnelles</h3>
								</div>
								<div class="card-body bg-light">
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Nom :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Nom" value="<?php echo($data['Nom']);?>" name="nom" >
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Prénom :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Prénom" value="<?php echo($data['Prenom']);?>" name="prenom" >
									</div>
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">E-Mail :</p>
										<input type="email" class="form-control mb-2 mr-sm-2" readonly value="<?php echo($data['Email_Client']);?>" name="email" >
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Mot de passe :</p>
										<input type="password" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre mot de passe" name="mdp1">
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Répétez Mot de passe :</p>
										<input type="password" class="form-control mb-2 mr-sm-2" placeholder="Répétez votre mot de passe" name="mdp2">
									</div>
								</div>
							</div><br>
							<div class="card" style="width: 100%; margin:auto;;">
								<!-- Domicile -->
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Domicile</h3>
								</div>
								<div class="card-body bg-light">
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Adresse Ligne 1 :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Adresse" value="<?php echo($data['Adresse']);?>" name="adresse1" >
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Adresse Ligne 2 :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Adresse" name="adresse2" >
									</div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Ville :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Ville" value="<?php echo($data['Ville']);?>" name="ville">
									</div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Code Postal :</p>
										<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Code Postal" value="<?php echo($data['Code_postal']);?>" name="poste">
									</div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Pays :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Réentrez votre Pays" value="<?php echo($data['Pays']);?>" name="pays">
									</div>
								</div>
							</div><br>
						</div>
						<div style="display: inline-block; vertical-align: top; width: 45%;  margin-left: 5%">
							
							<!-- Informations de Paiement -->
							<div class="card" style="width: 100%; margin:auto;">
								
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Informations de Paiement</h3>
								</div>
								<div class="card-body bg-light">
									<div style="display: inline-block; width: 35%;">
										<p style="text-align: left;">Titulaire de la carte :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez le nom du titulaire de la carte" name="nom_carte" >
									</div>
									<div style="display: inline-block; width: 60%;">
										<p style="text-align: left;">Numéro de carte :</p>
										<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre numéro de carte" name="num_carte">
									</div>
									<div style="display: inline-block; width: 25%;">
										<p style="text-align: left;">Type de carte :</p>
										<select class="form-control" name="type_carte">
											<option>Mastercard</option>
											<option>Visa</option>
											<option>American Express</option>
											<option>Paypal</option>
										</select>						
									</div>
									<div style="display: inline-block; width: 5%;"></div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left;">CVV :</p>
										<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre CVV" name="cvv">
									</div>
									<div style="display: inline-block; width: 5%;"></div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left;">Date d'expiration :</p>
										<div style="display: inline-block; width: 30%; "><input type="number" class="form-control mb-2 mr-sm-2" placeholder="Mois" name="mois"></div>
										<div style="display: inline-block; "><p>/</p></div>
										<div style="display: inline-block; width: 30%; "><input type="text" class="form-control mb-2 mr-sm-2" placeholder="Année" name="annee"></div>
									</div>
								</div>
							</div><br>
							<!-- S'inscrire -->
							<p style="font-weight: bold; font-size: 1.25rem; text-align: center; "> Modifier les Informations ?</p>
							<div  style=" text-align: center;">
								<div style="display: inline-block; text-align: center; width: 48%">
									<button type="submit" class="btn btn-success" style="font-size: 1.5rem;">Appliquer</button>
								</div>
								<div style="display: inline-block; text-align: center; width: 48%">
									<a href="compte_client.php" ><button type="button" class="btn btn-danger" style="font-size: 1.5rem;">Annuler</button></a>
								</div>
							</div>
						</div>
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
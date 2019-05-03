<?php
session_name('Client');
session_start();
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
session_write_close();

session_name('Livraison');
session_start();
$message1='';
$message2='';
$message2="<p> Informations de livraison : <br>";
$message2.="Nom : ".$_SESSION['Nom']." <br>";
$message2.="Prénom : ".$_SESSION['Prenom']." <br>";
$message2.="Numéro de téléphone : ".$_SESSION['Telephone']." <br>";
$message2.="Adresse : ".$_SESSION['Adresse'].", ".$_SESSION['Code_postal'].", ".$_SESSION['Ville'].", ".$_SESSION['Pays']."</p>";

?>
<html>
	<head>
		<title>ECE Market Place | Paiement</title>
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
				<form class="form" action="paiement.php" method="post">
					<h1 style="font-weight: bold; text-align: center;">Informations relatives au Paiement</h1><br>
					<!-- Carte enregistrée-->
					<div class="card" style="width: 60%; margin:auto;">
						<div class="card-header bg-light">
							<h3 style="font-weight: bold; font-size: 1.5rem ">Carte enregistrée </h3>
						</div>
						<div class="card-body bg-light">
							
							<p style="font-weight: bold; color: #696969; font-size:1.25rem;">
								<img  src="Pictures/Mastercard.png" width="100" height="70" alt="" id="carte"> 
								<?php echo "|  ".$data['Prenom']." ".$data['Nom']."  |  Carte : ".substr($data['Numero_carte'],0, 4) ?> XXXX XXXX XXXX
							</p>
							<p style="text-align: right;"><a href="paiement.php"><button type="submit" name="actuel" class="btn btn-success" style="font-size: 1.5rem;">Utiliser cette carte</button></a></p>
						</div>
					</div><br>
				</form>
					<!-- Utiliser une autre carte-->
					<div class="card" style="width: 60%; margin:auto;">
						<div class="card-header bg-light">
							<h3 style="font-weight: bold; font-size: 1.5rem ">Utiliser une autre Carte ? </h3>
						</div>
						<div class="card-body bg-light">
							<form class="form" action="paiement.php" method="post">
								<div style="display: inline-block; width: 90%;">
									<p style="text-align: left;">Titulaire de la carte :</p>
									<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez le nom du titulaire de la carte" id="nom" >
								</div>
								<div style="display: inline-block; width: 92%;">
									<p style="text-align: left;">Numéro de carte :</p>
									<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre numéro de carte" id="carte">
								</div>
								<div style="display: inline-block; width: 25%;">
									<p style="text-align: left;">Type de carte :</p>
									<select class="form-control" id="card type">
										<option>Mastercard</option>
										<option>Visa</option>
										<option>American Express</option>
										<option>Paypal</option>
									</select>						
								</div>
								<div style="display: inline-block; width: 5%;"></div>
								<div style="display: inline-block; width: 30%;">
									<p style="text-align: left;">CVV :</p>
									<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre CVV" id="cvv">
								</div>
								<div style="display: inline-block; width: 5%;"></div>
								<div style="display: inline-block; width: 30%;">
									<p style="text-align: left;">Date d'expiration :</p>
									<div style="display: inline-block; width: 30%; "><input type="number" class="form-control mb-2 mr-sm-2" placeholder="Mois" id="mois"></div>
									<div style="display: inline-block; "><p>/</p></div>
									<div style="display: inline-block; width: 30%; "><input type="text" class="form-control mb-2 mr-sm-2" placeholder="Année" id="annee"></div>
								</div>
						
								<p style="text-align: right; margin-top: 2rem;"><a href="paiement.php" ><button type="submit" name="nouvelle" class="btn btn-success" style="font-size: 1.5rem;">Utiliser cette carte</button></a></p>
								<?php 
								echo $message2;
								?>
							
							</form> 
							
						</div>
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
<?php 
//Infos personnelles
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$phone = isset($_POST["phone"])? $_POST["phone"] : "";
$mdp1 = isset($_POST["mdp1"])? $_POST["mdp1"] : "";
$mdp2 = isset($_POST["mdp2"])? $_POST["mdp2"] : "";
//Infos domicile
$adresse1 = isset($_POST["adresse1"])? $_POST["adresse1"] : "";
$adresse2 = isset($_POST["adresse2"])? $_POST["adresse2"] : "";
$ville = isset($_POST["ville"])? $_POST["ville"] : "";
$code_postal = isset($_POST["code_postal"])? $_POST["code_postal"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
//Infos CB
$nom_carte = isset($_POST["nom_carte"])? $_POST["nom_carte"] : "";
$numero_carte = isset($_POST["numero_carte"])? $_POST["numero_carte"] : "";
$card_type = isset($_POST["card_type"])? $_POST["card_type"] : "";
$cvv = isset($_POST["cvv"])? $_POST["cvv"] : "";
$mois_carte = isset($_POST["mois_carte"])? $_POST["mois_carte"] : "";
$annee_carte = isset($_POST["annee_carte"])? $_POST["annee_carte"] : "";
///Message d'erreurs
$val1=true;
$val2=true;
$val3=true;
$val4=true;
$val5=true;
$val6=true;
//Vérification mail pas déja inscrit
$val_mail=false;
$message1='';
$message2='';
$message3='';
$message='';
///Connexion database
$database='commerce';
$db_handle=mysqli_connect('localhost','root','');
$db_found=mysqli_select_db($db_handle,$database);
session_name('Client');
session_start();
//si le Client est déjà connecté
/*if(!empty($_SESSION['Email_client']))
{
	header('Location: client_compte.php');
}
*/
//si il y a un champ vide dans informations personelles
if(empty($nom)||empty($prenom)||empty($email)||empty($phone)||empty($mdp1)||empty($mdp2))
{
	$message1 ='<p> Un champ est vide, remplissez tous les champs s\'il-vous-plaît </p>' ;
	$val1=false;
}
//Si il y a un champ vide dans infos domicile
if (empty($adresse1)||empty($ville)||empty($code_postal)||empty($pays)) 
{
	$message2 ='<p> Un champ est vide, remplissez tous les champs s\'il-vous-plaît </p>' ;
	$val2=false;
}
//si champ vide dans infos CB
if (empty($nom_carte)||empty($numero_carte)||empty($cvv)||empty($mois_carte)||empty($annee_carte)) 
{
	$message3 ='<p> Un champ est vide, remplissez tous les champs s\'il-vous-plaît </p>' ;
	$val3=false;

}
//Mauvaise ressaisie de mot de passe
if ($mdp1!=$mdp2)
{
	$message1='<p> Mauvaise resaisie du mot de passe </p>';
	$val4=false;
}
//Mois incorrect
if($mois_carte<1 || $mois_carte>12 )
{
	$message3='<p> Mois compris entre 1 et 12! (Date d\'expiration) </p>';
	$val5=false;
}
///Carte bancaire non valide
if($annee_carte<2019 || ($annee_carte==2019 && $mois_carte<6) || $annee_carte>2025)
{
	$message3='<p> Carte bancaire périmée ou fausse (Date d\'expiration) </p>';
	$val6=false;
}
if($val1&&$val2&&$val3&&$val4&&$val5&&$val6)
{
	if($db_found)
	{
		$adresse=$adresse1.$adresse2;
		$date_carte=$annee_carte ."-0". $mois_carte . "-01";
		$sql="SELECT * FROM Client WHERE Email_client LIKE '%$email'";
		$result=mysqli_query($db_handle,$sql);
		if(mysqli_num_rows($result)!=0)
		{
				$val_mail=true;
		}
		if($val_mail)
		{
			$message="<p> Compte déjà existant ! (mail déjà enregistré) </p>";
		}
		else
		{
		$sql="INSERT INTO Client(Email_client,Nom,Prenom,Password,Adresse,Ville,Code_postal,Pays,Telephone,Type_carte,Numero_carte,Nom_carte,Date_carte,Code_carte) VALUES('$email','$nom','$prenom','$mdp1','$adresse','$ville','$code_postal','$pays','$phone','$card_type','$numero_carte','$nom_carte','$date_carte','$cvv')";
		$result=mysqli_query($db_handle,$sql);
		$message="<p> Inscription confirmée </p>";
		$_SESSION['Email_client']=$email;
		header('Location: client_compte.php');
		}	
	}
	else
	{
		$message= 'BDD non trouvé';
	}
}
mysqli_close($db_handle);
?>
<html>
	<head>
		<title>ECE Market Place | Inscription Client</title>
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
					<h1 style="font-weight: bold; text-align: center;">Bienvenue chez ECE Market Place!</h1><br>
					<!-- Inscription-->
					<form class="form" action="client_inscription.php" method="post">
						<div style="display: inline-block; width: 45%;">
							<div class="card" style="width: 100%; margin:auto;">
								<!-- Informations personelle -->
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Informations personnelles</h3>
								</div>
								<div class="card-body bg-light">
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Nom :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Nom" name="nom" >
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Prénom :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Prénom" name="prenom" >
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">E-Mail :</p>
										<input type="email" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre E-mail" name="email">
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Téléphone :</p>
										<input type="tel" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Numero de Telephone" name="phone">
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Mot de passe :</p>
										<input type="password" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre mot de passe" name="mdp1">
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Répétez Mot de passe :</p>
										<input type="password" class="form-control mb-2 mr-sm-2" placeholder="Répétez votre mot de passe" name="mdp2">
									</div>
									<?php echo $message1;  ?>
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
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Adresse" name="adresse1" >
									</div>
									<div style="display: inline-block; width: 45%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Adresse Ligne 2 :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Adresse" name="adresse2" >
									</div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Ville :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Ville" name="ville">
									</div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Code Postal :</p>
										<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre Code Postal" name="code_postal">
									</div>
									<div style="display: inline-block; width: 30%;">
										<p style="text-align: left; font-weight: bold; font-size: 1.25rem">Pays :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Réentrez votre Pays" name="pays">
									</div>
									<?php echo $message2;  ?>
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
										<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre numéro de carte" name="numero_carte">
									</div>
									<div style="display: inline-block; width: 25%;">
										<p style="text-align: left;">Type de carte :</p>
										<select class="form-control" name="card_type">
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
										<div style="display: inline-block; width: 30%; "><input type="number" class="form-control mb-2 mr-sm-2" placeholder="Mois" name="mois_carte"></div>
										<div style="display: inline-block; "><p>/</p></div>
										<div style="display: inline-block; width: 30%; "><input type="number" class="form-control mb-2 mr-sm-2" placeholder="Année" name="annee_carte"></div>
									</div>
									<?php echo $message3; ?>
								</div>
							</div><br>
							<!-- S'inscrire -->
							<div style="font-weight: bold; font-size: 1.25rem"> Prêt à rejoindre notre communauté !</div>
							<div style="margin-top: 2rem;"><button type="submit" class="btn btn-success" style="font-size: 1.5rem;">S'inscrire</button></div>
							<?php echo $message;  ?>
							
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
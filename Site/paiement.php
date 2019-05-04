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
	if(!empty($_SESSION['Email_client']))
	{
		$sql = "SELECT * FROM client WHERE Email_client LIKE '".$_SESSION['Email_client']."'";
		$req = mysqli_query($db_handle, $sql);
		$data = mysqli_fetch_assoc($req);
	}
}
else
{
	$message2='<p> Erreur BDD </p>';
}
mysqli_close($db_handle);
session_write_close();
session_name('Livraison');
session_start();
$message2='';
$message2="<p> Informations de livraison : <br>";
$message2.="Nom : ".$_SESSION['Nom']." <br>";
$message2.="Prénom : ".$_SESSION['Prenom']." <br>";
$message2.="Numéro de téléphone : ".$_SESSION['Telephone']." <br>";
$message2.="Adresse : ".$_SESSION['Adresse'].", ".$_SESSION['Code_postal'].", ".$_SESSION['Ville'].", ".$_SESSION['Pays']."</p>";
session_write_close();
if(isset($_POST['actuel']))
{
	session_name('Paiement');
	session_start();
	$_SESSION['Numero_carte']=$data['Numero_carte'];
	$_SESSION['Type_carte']=$data['Type_carte'];
	$_SESSION['Nom_carte']=$data['Nom_carte'];
	$_SESSION['Date_carte']=$data['Date_carte'];
	$_SESSION['Code_carte']=$data['Code_carte'];
	session_write_close();
}
if(isset($_POST['nouvelle']))
{
	$nom_carte = isset($_POST["nom_carte"])? $_POST["nom_carte"] : "";
	$numero_carte = isset($_POST["numero_carte"])? $_POST["numero_carte"] : "";
	$cvv = isset($_POST["cvv"])? $_POST["cvv"] : "";
	$card_type = isset($_POST["card_type"])? $_POST["card_type"] : "";
	$mois_carte = isset($_POST["mois_carte"])? $_POST["mois_carte"] : "";
	$annee_carte = isset($_POST["annee_carte"])? $_POST["annee_carte"] : "";
	if(empty($nom_carte)||empty($numero_carte)||empty($cvv)||empty($card_type)||empty($mois_carte)||empty($annee_carte))
	{
		$message2='<p> Un champ est vide, remplissez tous les champs s\'il-vous-plaît </p>';
	}
	else
	{
		switch($mois_carte)
		{
			case "01" : 
			$mois_carte=1;
			break;
			case "02" : 
			$mois_carte=2;
			break;
			case "03" : 
			$mois_carte=3;
			break;
			case "04" : 
			$mois_carte=4;
			break;	
			case "05" : 
			$mois_carte=5;
			break;	
			case "06" : 
			$mois_carte=6;
			break;
			case "07" : 
			$mois_carte=7;
			break;
			case "08" : 
			$mois_carte=8;
			break;
			case "09" : 
			$mois_carte=9;
			break;
		}
	//Date d'expiration incorrecte
		if($mois_carte<1 || $mois_carte>12 || $annee_carte<2019 || ($annee_carte==2019 && $mois_carte<6) || $annee_carte>2025)
		{
			$message2='<p> Carte bancaire périmée ou fausse (Date d\'expiration) </p>';
		}
		///Date expiration correcte
		else
		{

			if($mois_carte<10)
			{
				$date_carte=$annee_carte ."-0". $mois_carte . "-01";
			}
			else if ($mois_carte>9)
			{
				$date_carte=$annee_carte ."-". $mois_carte . "-01";
			}
			session_name('Paiement');
			session_start();
			$_SESSION['Numero_carte']=$numero_carte;
			$_SESSION['Type_carte']=$card_type;
			$_SESSION['Nom_carte']=$nom_carte;
			$_SESSION['Date_carte']=$date_carte;
			$_SESSION['Code_carte']=$cvv;
			session_write_close();
		}
	}
}
///Vérification bancaire
if(isset($_POST['actuel'])||isset($_POST['nouvelle']))
{
	session_name("Paiement");
	session_start();
	$message2="<p> Informations de paiement : <br>";
	$message2.="Numéro de carte: ".$_SESSION['Numero_carte']." <br>";
	$message2.="Type de carte : ".$_SESSION['Type_carte']." <br>";
	$message2.="Titulaire : ".$_SESSION['Nom_carte']." <br>";
	$message2.="Date d'expiration : ".$_SESSION['Date_carte']." <br>";
	$message2.="Code CVV : ".$_SESSION['Code_carte']." <br>";

	//Connection to the database

	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
//Connection to database
	$db_found=mysqli_select_db($db_handle,$database);
	if($db_found){	
		// on Recherche les infos
		$sql = "SELECT * FROM Carte_bancaire WHERE Numero_carte LIKE '".$_SESSION['Numero_carte']."'";
		$req = mysqli_query($db_handle, $sql);
		$data2 = mysqli_fetch_assoc($req);
		if($_SESSION['Numero_carte']==$data2['Numero_carte']&&$_SESSION['Type_carte']==$data2['Type_carte']&&$_SESSION['Nom_carte']==$data2['Nom_carte']&&$_SESSION['Date_carte']==$data2['Date_carte']&&$_SESSION['Code_carte']==$data2['Code_carte'])
		{
			$message2="<p> Achat validé, carte vérifiée </p>";
			session_write_close();
			session_name('Client');
			session_start();
		///Quantité globale baisse, quantité vendue augmente
			$sql2 = "SELECT * FROM Panier WHERE Email_client LIKE '".$_SESSION['Email_client']."'";
			$req2 = mysqli_query($db_handle, $sql2);
			while($data4=mysqli_fetch_assoc($req2))
			{
				$sql = "SELECT * FROM Item WHERE Id_item LIKE '".$data4['Id_item']."'";
				$req = mysqli_query($db_handle, $sql);
				$data5 = mysqli_fetch_assoc($req);
				$quantite_tot=$data5['Quantite']-$data4['Quantite_panier'];
				if($quantite_tot<0)
					$quantite_tot=0;
				$quantite_vendue=$data5['Vendu']-$data4['Quantite_panier'];
				$sql = "UPDATE Item SET Quantite='".$quantite_tot."', Vendu='".$quantite_vendue."' WHERE Id_item LIKE '".$data4['Id_item']."'";
				$req = mysqli_query($db_handle, $sql);
				$sql = "SELECT * FROM Vendre WHERE Id_item LIKE '".$data4['Id_item']."'";
				$req = mysqli_query($db_handle, $sql);
				$data5 = mysqli_fetch_assoc($req);
				$quantite_vendue=$data5['Quantite_vendeur']-$data4['Quantite_panier'];
				$sql = "UPDATE Vendre SET Quantite_vendeur='".$quantite_vendue."' WHERE Id_item LIKE '".$data4['Id_item']."'";
				$req = mysqli_query($db_handle, $sql);
				$sql ="DELETE FROM Panier WHERE Id_item LIKE '".$data4['Id_item']."'";
				$req = mysqli_query($db_handle, $sql);
			}
			session_write_close();


			///Quantité d'items du vendeurs diminue












			
			///Email
			session_name('Paiement');
			session_start();
			$message2="<p> Achat validé, carte vérifiée </p>";
			///Récupérer des infos
			$numero_carte_livraison=$_SESSION['Numero_carte'];
			$type_carte_livraison=$_SESSION['Type_carte'];
			$nom_carte_livraison=$_SESSION['Nom_carte'];
			session_write_close();
			session_name('Livraison');
			session_start();
			///Récuperer des infos
			$nom_livraison=$_SESSION['Nom'];
			$prenom_livraison=$_SESSION['Prenom'];
			$phone_livraison=$_SESSION['Telephone'];
			$adresse_livraison=$_SESSION['Adresse'];
			$ville_livraison=$_SESSION['Ville'];
			$code_postal_livraison=$_SESSION['Code_postal'];
			$pays_livraison=$_SESSION['Pays'];
			session_write_close();
			session_name('Client');
			session_start();
			$mail=$_SESSION['Email_client'];
			$sql="SELECT * FROM Client WHERE Email_client LIKE '".$_SESSION['Email_client']."'";
			$req = mysqli_query($db_handle, $sql);
			$data3 = mysqli_fetch_assoc($req);
			$nom_client_livraison = $data3['Nom'];
			$prenom_client_livraison = $data3['Prenom'];
			/*

			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
			{
				$passage_ligne = "\r\n";
			}
			else
			{
				$passage_ligne = "\n";
			}**/
			//=====Déclaration des messages au format texte et au format HTML.
			$message_txt = "Bonjour ".$prenom_client_livraison." ".$nom_client_livraison.", voilà le récapitulatif de votre achat : Carte bleue utilisée : "."|  ".$nom_carte_livraison."  |  ".$type_carte_livraison.": ".substr($numero_carte_livraison,0, 4)." XXXX XXXX XXXX".". Adresse utilisée : ".$prenom_livraison." ".$nom_livraison." ".$adresse_livraison.", ".$code_postal_livraison.", ".$ville_livraison.", ".$pays_livraison.". Nous vous contacterons au numéro suivant : ".$phone_livraison.".";
			$message_html = "<html><head></head><body><p>"."Bonjour ".$prenom_client_livraison." ".$nom_client_livraison.", voilà le récapitulatif de votre achat :<br> Carte bleue utilisée : "."|  ".$nom_carte_livraison."  |  ".$type_carte_livraison.": ".substr($numero_carte_livraison,0, 4)." XXXX XXXX XXXX".".<br> Adresse utilisée : ".$prenom_livraison." ".$nom_livraison." ".$adresse_livraison.", ".$code_postal_livraison.", ".$ville_livraison.", ".$pays_livraison.".<br> Nous vous contacterons au numéro suivant : ".$phone_livraison."."."</p></body></html>";
			$message2 = $message_html;
			//==========
			/*
			//=====Création de la boundary
			$boundary = "-----=".md5(rand());
			//==========

			//=====Définition du sujet.
			$sujet = "|ECE Amazon] Achat confirmé";
			//=========

			//=====Création du header de l'e-mail.
			$header = "From: \"ECE Amazon\"<ece20192@gmail.com>".$passage_ligne;
			$header.= "Reply-to: \"ECE Amazon\" <ece20192@gmail.com>".$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			//==========

			//=====Création du message.
			$message = $passage_ligne."--".$boundary.$passage_ligne;
			//=====Ajout du message au format texte.
			$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_txt.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$boundary.$passage_ligne;
			//=====Ajout du message au format HTML
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
			//==========

			//=====Envoi de l'e-mail.
			ini_set("SMTP", "smtp.gmail.com");
			ini_set("smtp_port","465");
			ini_set("default_domain", "smtp.gmail.com");
			ini_set("force_sender", "ece20192@gmail.com");
			ini_set("sendmail_from", "ece20192@gmail.com");
			ini_set("auth_username", "ece20192@gmail.com");
			ini_set("auth_password", "");
			ini_set("sendmail_path", "C:\wamp64\sendmail\sendmail.exe -t -i");
			mail($mail,$sujet,$message,$header);
			//==========
			*/
			/*echo "<script language=\"javascript\"> if(alert('".$message_txt."')) document.location.href=\"home.php\"
			; </script>";*/
		}
		else
		{
			$message2="<p> Carte invalide, erreur Vérification bancaire </p>";
		}
	}
	else
	{
		$message2='<p> Erreur BDD </p>';
	}
	mysqli_close($db_handle);
}
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
								<?php echo "|  ".$data['Nom_carte']."  |  Carte : ".substr($data['Numero_carte'],0, 4) ?> XXXX XXXX XXXX
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
								<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez le nom du titulaire de la carte" name="nom_carte" >
							</div>
							<div style="display: inline-block; width: 92%;">
								<p style="text-align: left;">Numéro de carte :</p>
								<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez votre numéro de carte" name="numero_carte">
							</div>
							<div style="display: inline-block; width: 25%;">
								<p style="text-align: left;">Type de carte :</p>
								<select class="form-control" name="card type">
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
								<div style="display: inline-block; width: 30%; "><input type="text" class="form-control mb-2 mr-sm-2" placeholder="Année" name="annee_carte"></div>
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
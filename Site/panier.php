<?php
session_name('Client');
session_start();
if(empty($_SESSION['Email_client']))
{
	header('Location: client_connexion.php');
}else{
		//Connection to the database
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
		//Connection to database
	$db_found=mysqli_select_db($db_handle,$database);
	$prix_total = 0;
}
?>

<html>
<head>
	<title>ECE Market Place | Panier </title>
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
				<li class="nav-item active"><a class="nav-link" href="panier.php">Panier <img src="Pictures/Panier.png" width="30" height="30"></a></li>
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
				<h1 style="text-align:center ">Mon Panier</h1><br>
				<form action="client_suppression_item.php" method="post">
					<table class="table table-striped vertical-align: middle" style="width:70%; margin: auto">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Image</th>
								<th scope="col">Article</th>
								<th scope="col">Prix Unitaire</th>
								<th scope="col">Quantité</th>
								<th scope="col">Quantité en a supprimer</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($db_found){	
									// on Recherche les infos

								$sql = "SELECT item.nom, imgitem.Nom_img, item.Prix, panier.Quantite_panier FROM item INNER JOIN panier ON panier.Id_item = item.Id_item INNER JOIN imgitem ON item.Id_item = imgitem.Id_item WHERE imgitem.Is_main = '1' AND panier.Email_client = '".$_SESSION['Email_client']."'";
								$req = mysqli_query($db_handle, $sql);
								while($data=mysqli_fetch_assoc($req))
								{
									echo("<tr>");
									echo("<td class=\"align-middle\"><img src=\"".$data['Nom_img']."\" style=\"width:6rem; height:6rem\" alt=\"\"></td>");
									echo("<td class=\"align-middle\">".$data['nom']."</td>");
									echo("<td class=\"align-middle\">".$data['Prix']."€</td>");
									echo("<td class=\"align-middle\">".$data['Quantite_panier']."</td>");
									echo('<td class="align-middle"><input type="number" class="form-control mb-2 mr-sm-2" name="supprimer[]" value="0" placeholder="Nb"/></td>');
									echo("</tr>");
									echo('<input type="text" name="ids[]" value="'.$data['id_item'].'" placeholder="Nb"/>');
									echo('<input type="text" name="quantite[]" value="'.$data['Quantite_panier'].'" placeholder="Nb"/>');
									$prix_total += $data['Prix']*$data['Quantite_panier'];
								}
							}
							mysqli_close($db_handle);
							?>
						</tbody>
					</table><br>
					<div id="commande" style = "text-align: center">
						<a href="livraison.php"><button type="button" class="btn btn-success" style="font-size: 1.5rem;">Passer ma commande</button></a>
						<h3 style ="display: inline-block; margin-left: 5rem; font-weight: bold;"> Prix Total : <?php echo($prix_total); ?> €</h3>
				</div>
				<div style=" display:inline-block">
							<div style="display: inline-block"><button type="submit" name="submit_sup" class="btn btn-success" style="font-size: 1.5rem;">Valider Suppression</button></a></div>
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
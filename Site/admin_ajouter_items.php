<?php 
	$nom = isset($_POST["nom"])? $_POST["nom"] : "";
	$description = isset($_POST["description"])? $_POST["description"] : "";
	$video = isset($_POST["video"])? $_POST["video"] : "";
	$categorie = isset($_POST["categorie"])? $_POST["categorie"] : "";
	$prix = isset($_POST["prix"])? $_POST["prix"] : "";
	// Database
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	$db_found=mysqli_select_db($db_handle,$database);
	
	//si il y a un champ vide
	if(empty($nom)||empty($description)||empty($video)||empty($categorie)||empty($prix))
	{
		$message =' Un champ est vide, remplissez tous les champs s\'il-vous-plaît' ;
	}
	//aucun champ vide
	else
	{
		
		//si on trouve la database
		if($db_found)
		{
			if(isset($_FILES['photos']['name'])){
				//Calcul de l'id;
				$sql = "SELECT MAX(Id_item) FROM item";
				$req = mysqli_query($db_handle,$sql);
				$data = mysqli_fetch_array($req);
				$id = $data['MAX(Id_item)']+1;
				echo("id=".$id);
				
				$total_files = count($_FILES['photos']['name']);
				//Looping images
				for($i=0 ; $i<$total_files; $i++)
				{
					$fichier = basename($_FILES['photos']['name'][$i]);
					$extensions = array('.png', '.gif', '.jpg', '.jpeg');
					$extension = strrchr($_FILES['photos']['name'][$i], '.'); 
					//Début des vérifications de sécurité...
					if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
					{
						$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
					}

					$fichier = strtr($fichier, 
					  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
					$dossier="Pictures/".$categorie."/".$fichier;
					
					if(move_uploaded_file($_FILES['photos']['tmp_name'][$i], $dossier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
					{
						if($i==0){$sql = "INSERT INTO imgitem (Nom_img, Id_item , Is_main) VALUES ('".$dossier."', '".$id."', '1')";}
						else{$sql = "INSERT INTO imgitem (Nom_img, Id_item , Is_main) VALUES ('".$dossier."', '".$id."', '0')";}
						$req = mysqli_query($db_handle,$sql);
						echo('Upload Success');
					}
					else{
						echo( "Upload failed");
						
					}				
					$message = "";
				}
				
				if($categorie == "musiques"){$categorie= "Musique";}
				if($categorie == "livres"){$categorie= "Livres";}
				if($categorie == "sports"){$categorie= "Sports";}
				if($categorie == "vetements"){$categorie= "Vetements";}
				
				//Insertion dans la table item
				$sql = "INSERT INTO item (Id_item, Nom, Description, Video, Categorie, Prix, Genre, Taille, Pointure, Couleur, Quantite, Vendu) VALUES ('".$id."', '".$nom."', '".$description."', '".$video."', '".$categorie."', '".$prix."', '0', '0', '0', '0', '0', '0')";
				$req = mysqli_query($db_handle,$sql);
				
			}
			header('Location: admin_compte.php');
		}
	}
	mysqli_close($db_handle);
 ?>

<html>
	<head>
		<title>ECE Market Place | Ajouter Items</title>
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
			<a class="navbar-brand" href="home.php" id="brand">
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
					<h1 style="font-weight: bold; text-align: center;">Renseignez les Informations sur l'Item</h1><br>
					<form action="admin_ajouter_items.php" method="post" enctype="multipart/form-data" >		
							<div class="card" style="width: 70%; margin:auto;">
								
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem ">Ajouter un Item</h3>
								</div>
								
								<div class="card-body bg-light">
									<!-- Nom -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Nom :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez le Nom " name="nom" />
									</div>
									<!-- Description -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Description :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez le Nom " name="description" />
									</div>
									<!-- Photos upload -->
									<div style="display: inline-block; width: 100%; ">
										<p style="text-align: left;">Photos :</p>
										<input type="file" style="margin-bottom:1rem; width:100%;" name="photos[]" accept="image/png, image/jpg" multiple/>	
									
									</div>
									<!-- video upload -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Vidéo :</p>
										<input type="text" class="form-control mb-2 mr-sm-2" placeholder="Entrez le lien de la vidéo " name="video" />										
									</div>
									<!-- Prix -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Prix :</p>
										<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Entrez le Prix" name="prix" />
									</div>
									<!-- Catégorie -->
									<div style="display: inline-block; width: 100%;">
										<p style="text-align: left;">Catégories :</p>
										<select class="form-control" name="categorie">
											<option>livres</option>
											<option>musiques</option>
											<option>sports</option>
											<option>vetements</option>
										</select>	
									</div>
									<!-- Validation -->
									
									<?php echo('<p style="text-align: center; margin-top: 1rem; font-weight : bold">'.$message.'</p>'); ?>
									<div style="text-align: center">
										<button type="submit" class="btn btn-success" style="font-size: 1.5rem; margin-top:1rem;">Ajouter</button>
									</div>
								</div>
							</div><br>
						
					
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
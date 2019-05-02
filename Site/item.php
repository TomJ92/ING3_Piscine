<?php
	//getting the id of the item
	$param = $_GET["param"];
	//Connection to the database
	$database='commerce';
	$db_handle=mysqli_connect('localhost','root','');
	//Connection to database
	$db_found=mysqli_select_db($db_handle,$database);
	if($db_found){	
		// on Recherche les infos
		$sql = "SELECT * FROM item WHERE id_item LIKE '".$param."'";
		$req = mysqli_query($db_handle, $sql);
		$data = mysqli_fetch_assoc($req);
		
	}
	
	
?>

<html>
	<head>
		<title>ECE Market Place | Fiche Produit</title>
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
					<li class="nav-item"><a class="nav-link" href="admin_connexion.php">Admin</a></li>
					<li class="nav-item"><a class="nav-link" href="vendeur_connexion.php">Vendre</a></li>
					<li class="nav-item active"><a class="nav-link" href="client_compte.php">Votre Compte <img src="Pictures/Compte.png" width="30" height="30"></a></li>
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
					<h1 style="font-weight: bold; text-align: center;"><?php echo($data['Nom']);?></h1><br>
					<!-- Informations -->
					<div id="informations" style="text-align: center;">
						<div style="width:30%; display: inline-block; text-align:left;">
							<!-- Carte Carroussel -->
							<div class="card" style="width: 90%; margin:auto;">
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem; text-align: center">Photos</h3>
								</div>
								<!-- Carroussel-->
								<div class="card-body bg-light">
									<div id="demo" class="carousel slide" data-ride="carousel">

									  <!-- Indicators -->
									  <ul class="carousel-indicators">
										<?php 
											$sql = "SELECT Nom_img FROM imgitem WHERE id_item LIKE '".$param."'";
											$req = mysqli_query($db_handle, $sql);
											$num=0;
											while($data2 = mysqli_fetch_assoc($req)){
												if($num==0){
													echo('<li data-target="#" data-slide-to="'.$num.'" class="active"></li>');
												}else{
													echo('<li data-target="#" data-slide-to="'.$num.'"></li>');
												}
												
												$num += 1;
											}
										?>
									  </ul>

									  <!-- The slideshow -->
									  <div class="carousel-inner">
										<?php 
											$sql = "SELECT Nom_img FROM imgitem WHERE id_item LIKE '".$param."'";
											$req = mysqli_query($db_handle, $sql);
											$num=0;
											while($data2 = mysqli_fetch_assoc($req)){
												if($num==0){
													echo('<div class="carousel-item active">
															<img src="'.$data2['Nom_img'].'" alt="Ioda0" style="width:400px; height:400px">
														</div>');
												}else{
													echo('<div class="carousel-item">
															<img src="'.$data2['Nom_img'].'" alt="Ioda0" style="width:400px; height:400px">
														</div>');
												}
												
												$num += 1;
											}
										?>
										
									  </div>

									  <!-- Left and right controls -->
									  <a class="carousel-control-prev" href="#demo" data-slide="prev">
										<span class="carousel-control-prev-icon"></span>
									  </a>
									  <a class="carousel-control-next" href="#demo" data-slide="next">
										<span class="carousel-control-next-icon"></span>
									  </a>

									</div>
								</div>
							</div><br>
							
						</div>
						
						<div style="width:55%; display: inline-block;  vertical-align: top; text-align:left;">
							<!-- Video-->
							<div class="card" style="width: 90%; margin:auto;">
								<div class="card-header bg-light">
									<h3 style="font-weight: bold; font-size: 1.5rem; text-align: center">Video</h3>
								</div>
								
								<div class="card-body bg-light">
									<div class="embed-responsive embed-responsive-16by9" style="height: 400px">
										<iframe class="embed-responsive-item" src="<?php echo($data['Video']);?>" allowfullscreen></iframe>
										
									</div>
									
								</div>
							</div><br>
						</div>
					</div>
					<div id="informations" style="text-align: center; ">
						<div class="card" style="width: 60%; margin:auto;">
							<div class="card-header bg-light">
								<h3 style="display: inline-block; font-size: 1.5rem; font-weight: bold color: #696969"> Prix : </h3> 
								<h3 style="display: inline-block; font-size: 1.5rem; font-weight: bold"> <?php echo($data['Prix']);?> € </h3> 
								<h3 style="display: inline-block; font-size: 1.25rem; margin-left: 2rem; font-weight: bold color: #696969"> Quantité disponible : </h3> 
								<h3 style="display: inline-block; font-size: 1.25rem; font-weight: bold"> <?php echo($data['Quantite']);?> </h3> 
							</div>
								
							<div class="card-body bg-light">
								<p style="font-size: 1.25rem; font-weight: italic"> <?php echo($data['Description']);?> </p>
							</div>
						</div><br>
						<div style="display: inline-block;  text-align: center; ">
							<form action="panier_ajout.php" method="post" id="formulaire">
								<input type="number" class="form-control mb-2 mr-sm-2" placeholder="Saisir la quantité" value="1" id="amount" name="nombre" >
								<input type="hidden" name="id" value="<?php echo ($param); ?>">	
								<button type="submit" class="btn btn-success" style="font-size: 1.5rem; display: inline-block">Ajouter au Panier</button>
							</form>
						</div>
						
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
		
		$('form').submit(function(){
			var input = $('#amount').val();
			if(input == ''){
				$('#amount').val('1');
			}else if( input <1){
				$('#amount').val('1');
			}
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

<?php
mysqli_close($db_handle);
?>
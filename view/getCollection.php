<!doctype html>
<html lang="fr">
	<head>
		<?php echo "<title>".$coll."</title>"?>

		<?php require_once('layouts/header.php') ?>

	 
	</head>
	<body>

		<?php include('layouts/breadcrumb.php'); ?>

		<div class="container">

		<?php

		//Titre de la page

		echo "<h1 class='title text-center font-weight-bold'><i title='Name of collection' class='fa fa-fw fa-server'></i>".$coll."</h1>";

		//Fin du titre de la page

		?>

		<!-- Partie recherche -->
		<?php include('layouts/getCollection/searchByIdOrKeyGetColletion.php'); ?>

		<!-- Fin de la partie recherche -->


		<!-- Tableau des documents de la collection -->

		<div id="DivContentTable">
			<div id="result" class="border bg-light m-auto ">
				<?php include('layouts/tableauDocuments.php'); ?>
			    <hr>
				<div class="row  justify-content-between  mt-3 mx-1">

						<!-- Bouton de retour -->

						<div>
							<?php
							echo '<a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><button class="return btn btn-primary getCollection font-weight-bold">< Collection list</button></a>';
							?>
						</div>

						<!-- Fin du bouton de retour -->


						<!-- Pagination -->
			
						     <?php include('layouts/getCollection/paginationGetCollection.php'); ?>
		                   
					    <!-- Fin de la pagination -->

						</div>
					   		<!-- Bouton nouveau document -->
						<div class="ml-2">
						 <?php echo '<button class="btn btn-dark py-1 font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i title="Create new doc"class="fa fa-fw fa-plus"></i><i title="Create new doc" class="fa fa-file-text-o"></i></a></button>'; ?>
						</div>
					  <!-- Fin du bouton nouveau document -->

				</div>
			</div>
		</div>

		<!-- Fin du tableau des documents de la collection -->

		</div>

		<!-- footer -->

		<?php
			require_once('layouts/footer.php')
		?>

		   <!-- footer -->


		<!-- Fin du tableau des documents de la collection -->

		   

	</body>
</html>

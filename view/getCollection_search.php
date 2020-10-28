<!doctype html>
<html lang="fr">

	<head>
		<?php
		if(isset($recherche_id) and isset($recherche_g)){
			echo "<title>Search results for ";
			if($recherche_id=="" and $recherche_g=="field : content[...]"){echo "\"Aucun critère\"";}
			if($recherche_id!=""){echo "\"".$recherche_id."\"";}
			if($recherche_id!="" and $recherche_g!="field : content[...]"){echo " et ";}
			if($recherche_g!="field : content[...]"){echo "\"".$recherche_g."\"";}
			echo "</title>";
		}
		else{
			echo "<title>".$coll."</title>";
		}
		?>

		

		<?php require_once('layouts/header.php') ?>
	</head>

	<body>

		<?php include('layouts/breadcrumb.php'); ?>

		<div class="container">

		<?php

		//Préparation des variables de recherche pour leur utilisation en JS

		if(isset($recherche_g)){
			echo '<p id="clé" style="display: none">s_g</p>';
			?>
			<input type=hidden id=valeur value=<?php echo urlencode($recherche_g); ?>>
			<?php
		}

		//Fin de la préparation des variables de recherche pour leur utilisation en JS


		//Titre de la page

		if(isset($recherche_g)){
			echo "<h1 class='title text-center font-weight-bold'><span>Search results for </span><i title='Search results for $recherche_g' class='fa fa-fw fa-book'></i> ";
			if($recherche_g==""){echo "\"Aucun critère\""; $p='none';}
			if($recherche_g!=""){
				echo "\"<font color='#62a252'>".$recherche_g."</font>\"";
			}
			echo "</h1>";
		}
		else{
			echo "<h1 class='title text-center font-weight-bold'><i class='fa fa-fw fa-server'></i>".$coll."</h1>";
		}
		?>

		<!-- Fin du sous-titre -->


		<!-- Partie recherche -->

		<?php include('layouts/searchByIdOrKeyInGetCollectionsearch.php'); ?>
		<!-- Fin de la partie recherche -->


		<!-- Tableau des documents de la collection -->
		<div id="DivContentTable">
			<div id="result" class="border bg-light m-auto getCollSearchDiv">
				<?php include('layouts/tableauDocuments.php'); ?>

			   <div class="row justify-content-between m-1">

						<!-- Bouton de retour -->

						<div>
							<?php
							echo '<a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><button class="return btn btn-primary getCollection font-weight-bold">< Collection list</button></a>';
							?>
						</div>

						<!-- Fin du bouton de retour -->


						<!-- Pagination -->
						<?php include('layouts/paginationGetCollectionSearch.php'); ?>
				 		

				    <!-- Fin de la pagination -->
				
				    	<!-- Bouton nouveau document -->
						<div class="ml-2">
						  <?php echo '<button class="btn btn-dark py-1 font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i title="Create new doc" class="fa fa-fw fa-plus"></i><i title="Create new doc" class="fa fa-fw fa-book"></i></a></button>'; ?>
						</div>
				 		 <!-- Fin du bouton nouveau document -->

				</div>

			</div>


		<!-- Fin du tableau des documents de la collection -->
		</div>

		</div>

		<!-- footer -->

		<?php
			require_once('layouts/footer.php')
		?>

		   <!-- footer -->
  </body>
</html>

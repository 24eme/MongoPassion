<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$coll."</title>"?>

	<?php require_once('layouts/header.php') ?>

 
</head>

<?php include('layouts/breadcrumb.php'); ?>

<div class="container">

<?php

//Titre de la page

echo "<h1 class='title text-center font-weight-bold'><i title='Name of collection' class='fa fa-fw fa-server'></i>".$coll."</h1>";

//Fin du titre de la page

?>

<!-- Partie recherche -->

<div class="card">
  <div class="card-body">
	<!-- Formulaire de recherche par id et clé:valeur -->

		<div id="options" class="text-center my-2">

		</div>
		<div id="searchId">
			<?php echo '<form class="col-md-12" autocomplete="off" method="post" action="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'">'; ?>
				<div class="input-group mb-1">
					<input type="search" autofocus="autofocus"  list="browsers" placeholder="Search by document id or key:value" required="required"  class="flexdatalist form-control border border-success" name="recherche_g" id="recherche_g" />

					<!-- Autocomplétion des champs -->

					<datalist id="browsers">
				        <?php
				        	foreach ($docs[0] as $key => $value) {
				        		echo  "<option value=".$key.":>";
							}
							foreach ($docs as $key => $value) {
			        		echo  "<option value=".$value['_id'].">";
						    }

				        ?>

			 		</datalist>


			 		<!-- Fin de l'autocomplétion des champs -->
					<div class="input-group-append">
					<input class="btn bg-success text-light "  type="submit" name="search" id="search" value="Search"/>
					</div>
				</div>
				<div class="text-right">
				<a class="btn btn-link btn-sm" href="?action=advancedSearch&serve=<?php echo $serve ?>&db=<?php echo $db ?>&coll=<?php echo $coll ?>"><i class="fa fa-fw fa-search"></i>Advanced Search</a>
				</div>
			</form>
		</div>

		<!-- Fin du formulaire de recherche par id et clé:valeur -->

  </div>
</div>

<!-- Fin de la partie recherche -->

<br/>
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
	

				<!-- 	<?php if($page!=1): ?>
					<a href="index.php?action=getCollection&serve=".<?= $serve ?>."&db=".<?= $db ?>."&coll=".<?= $coll ?>."&page=".<?= ($page-1) ?>."&bypage=".<?= $bypage ?>."\" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>
				         <?php else : ?>
				            <span id="prev"><span aria-hidden="true">&laquo;</span></span>
				         <?php endif ?> -->

				     <?php include('layouts/paginationGetCollection.php'); ?>
                   
			    <!-- Fin de la pagination -->

				</div>
			   		<!-- Bouton nouveau document -->
				<div class="ml-2">
					    <?php echo '<button class="btn btn-dark py-1 font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i title="Create new doc"class="fa fa-fw fa-plus"></i><i title="Create new doc" class="fa fa-fw fa-book"></i></a></button>'; ?>
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

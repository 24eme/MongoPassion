<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$coll."</title>"?>

	<?php require_once('header.php') ?>
</head>

<?php include('breadcrumb.php'); ?>

<?php

//Titre de la page

echo "<h1 class='title text-center font-weight-bold'><i title='Name of collection' class='fa fa-fw fa-server'></i>".$coll."</h1>";

//Fin du titre de la page

?>

<!-- Partie recherche -->

<nav class="mb-2">

	<!-- Formulaire de recherche par id et clé:valeur -->

	<div  class="border col-lg-8 offset-lg-2 bg-light m-auto mb-2">
		<div id="options" class="text-center my-2">

		</div>
		<div id="searchId" class="mt-1">
			<?php echo '<form autocomplete="off" method="post" action="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'">'; ?>
				<div class="input-group mb-1">
					<input type="search" autofocus="autofocus"  list="browsers" placeholder="Search by document id or key:value" required="required" class="form-control border border-success" name="recherche_g" id="recherche_g" />

					<!-- Autocomplétion des champs -->

					<datalist id="browsers">
				        <?php
				        	foreach ($docs[0] as $key => $value) {
				        		echo  "<option value=".$key.":>";
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
</nav>

<!-- Fin de la partie recherche -->


<!-- Tableau des documents de la collection -->

<div id="DivContentTable">
	<div id="main" class="border col-lg-8 offset-lg-2 bg-light m-auto getCollDiv">
		<?php include('tableauDocuments.php'); ?>
	    <hr>
		<div class="row  justify-content-between m-1">

				<!-- Bouton de retour -->

				<div>
					<?php
					echo '<a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><button class="return btn btn-primary getCollection font-weight-bold">< Collection list</button></a>';
					?>
				</div>

				<!-- Fin du bouton de retour -->


				<!-- Pagination -->
				<div class="row mr-2">
					<div >
					<?php if($page!=1): ?>
					<a href="index.php?action=getCollection&serve=".<?= $serve ?>."&db=".<?= $db ?>."&coll=".<?= $coll ?>."&page=".<?= ($page-1) ?>."&bypage=".<?= $bypage ?>."\" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>
				         <?php else : ?>
				            <span id="prev"><span aria-hidden="true">&laquo;</span></span>
				         <?php endif ?>

					 <h6 class="mr-2 pt-2">Documents <?= (1+(($page-1)*$bypage)) ?> -
						<?php if(($page*$bypage)<$nbDocs): ?>
							<?= $page*$bypage; ?>
						<?php else: ?>
							<?= $nbDocs . ' of '.$nbDocs ?>
						<?php endif; ?>
					</h6>
					</div>
					<div class="text-center" aria-label="pagination" >
				        <ul class="pagination">


				            <span  class="text-center bg-light font-weight-bold mr-1">
								<select id="select_pagination" name="bypage" onchange="bypage(this)">
                    <?php foreach([10, 20, 30, 50] as $nb) : ?>
                      <option value="<?= $nb ?>" <?= ($bypage == $nb) ? 'selected="selected"': '' ?>><?= $nb ?></option>
                    <?php endforeach ?>
								</select>
							</span>

				            <?php if($page!=$nbPages){
				            	echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page+1).'&bypage='.$bypage.'" id="next" aria-current="page"><span aria-hidden="true">&raquo;</span></a>';
				            }
				            else{
				            	echo '<span id="next"><span aria-hidden="true">&raquo;</span></span>';
				            }
				        ?>
				        </ul>
				    </div>

			    <!-- Fin de la pagination -->

				</div>
			   		<!-- Bouton nouveau document -->
				<div class="ml-2">
					    <?php echo '<button class="btn btn-dark py-1 font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i title="Create new doc"class="fa fa-fw fa-plus"></i><i title="Create new doc" class="fa fa-fw fa-file"></i></a></button>'; ?>
				</div>
			  <!-- Fin du bouton nouveau document -->

		</div>
	</div>
</div>

<!-- Fin du tableau des documents de la collection -->

<!-- footer -->

<?php
	require_once('footer.php')
?>

   <!-- footer -->


<!-- Fin du tableau des documents de la collection -->

</body>
</html>

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

	<?php require_once('header.php') ?>
</head>

<body>

<?php include('breadcrumb.php'); ?>

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
	echo "<h1 class='title text-center font-weight-bold'><span>Search results for </span><i title='Search results for $recherche_g' class='fa fa-fw fa-file'></i> ";
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

<div class="card">
	<div  class="card-body">

	<!-- Barre de boutons -->

		<?php echo '<form autocomplete="off" method="post" action="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'">'; ?>

	        <div class="input-group mb-1">
	        	<?php
	        		if(isset($recherche_g)){
	        			echo '<input type="search"  list="browsers" placeholder="Search by id or key:value" required="required" class="form-control border border-success" name="recherche_g" id="recherche_g" value="'.$recherche_g.'" />';
	        		}
	        		else{
	        			echo '<input type="search"  list="browsers" placeholder="Search by id or key:value" required="required" class="form-control border border-success" name="recherche_g" id="recherche_g" />';
	        		}
	        	?>

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
				   <a href="index.php?action=getCollection&serve=<?php echo $serve ?>&db=<?php echo $db ?>&coll=<?php echo $coll ?>" class="btn bg-secondary text-light" type="button"><i title="Reset and return to the getCollection page" class="fa fa-fw fa-remove"></i></a>
				   <input class="btn bg-success text-light" type="submit" name="search" id="search" value="Search"/>
			   	</div>
			</div>
			<div class="text-right">
			<a class="btn btn-link btn-sm" href="?action=advancedSearch&serve=<?php echo $serve ?>&db=<?php echo $db ?>&coll=<?php echo $coll ?>&s_g=<?php echo urlencode($recherche_g) ?>"><i class="fa fa-fw fa-search"></i>Advanced Search</a>
			</div>
		</form>
	</div>
		<!-- Fin du formulaire de recherche par id et clé:valeur -->
</div>

<!-- Fin de la partie recherche -->
<br>


<div id="DivContentTable">
	<div id="result" class="border bg-light m-auto getCollSearchDiv">
		<?php include('tableauDocuments.php'); ?>

	   <div class="row justify-content-between m-1">

				<!-- Bouton de retour -->

				<div>
					<?php
					echo '<a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><button class="return btn btn-primary getCollection font-weight-bold">< Collection list</button></a>';
					?>
				</div>

				<!-- Fin du bouton de retour -->


				<!-- Pagination -->
		 		<div class="row mr-2">

		 			<div aria-label="pagination" >
				        <ul class="pagination">

					        <?php
					            if($page!=1){
					            	echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page-1).'&bypage='.$bypage.'&s_g='.urlencode($recherche_g).'" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>';
					            }
					            else{
					            	echo '<span id="prev"><span aria-hidden="true">&laquo;</span></span>';
					            } ?>

				          </ul>
			        </div>

					<div class="mx-1">
						<?php

						echo '<h6 class="pt-2">Documents '.(1+(($page-1)*$bypage)).'-';
							if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
							else{echo $nbDocs;}
							echo ' of '.$nbDocs.'</h6>';
							?>
					</div>
				
                    <div>
			            <span  class="text-center bg-light font-weight-bold mr-1">
                                <select id="select_pagination" class="py-1" name="bypage" onchange="bypage_search(this)">
                                <?php foreach([10, 20, 30, 50] as $nb) : ?>
                                  <option value="<?= $nb ?>" <?= ($bypage == $nb) ? 'selected="selected"': '' ?>><?= $nb ?></option>
                                <?php endforeach ?>
                                </select>
						</span>
					</div>
					<div aria-label="pagination" class="ml-2">
				        <ul class="pagination">

				            <?php if($page!=$nbPages){
				            	echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page+1).'&bypage='.$bypage.'&s_g='.urlencode($recherche_g).'" id="next" aria-current="page"><span aria-hidden="true">&raquo;</span></a>';
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
	require_once('footer.php')
?>

   <!-- footer -->

</body>
</html>

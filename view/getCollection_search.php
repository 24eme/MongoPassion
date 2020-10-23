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

//Fin du titre de la page


//Sous-titre

echo '<h2 class="subtitle text-center">Documents '.(1+(($page-1)*$bypage)).'-';
if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
else{echo $nbDocs;}
echo ' of '.$nbDocs.'</h2>';
?>

<!-- Fin du sous-titre -->


<!-- Partie recherche -->

<nav class="mb-2">
	<div  class="border col-lg-8 offset-lg-2 bg-light m-auto mb-2">

	<!-- Barre de boutons -->

	<div id="searchIdS" class="mt-1">
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
</nav>

<!-- Fin de la partie recherche -->



<div id="DivContentTable">
	<div id="main" class="border col-lg-8 offset-lg-2 bg-light m-auto getCollSearchDiv">

	  <table class="table table-sm table-striped">

				 <?php 

					echo '<h3 class="text-center mb-1 bg-success text-light"><span><strong>Documents '.(1+(($page-1)*$bypage)).'-';
						if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
						else{echo $nbDocs;}
						echo ' of '.$nbDocs.'
						<span>
							 <button class="btn btn-dark align-items-center py-1 float-right new_doc font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i title="Create new doc" class="fa fa-fw fa-plus"></i><i title="Create new doc" class="fa fa-fw fa-file"></i></a></button>
						</span>

					</h3>';

			?>
			<?php
				if($nbDocs==0){
					echo 'Aucun document ne correspond à votre recherche.';
				}
				else{
					foreach ($docs as $doc) {
						echo '<tr class="mr-5">';
						$type_id = gettype($doc['_id']);
						if ($type_id=='object'){
							$id = (string)$doc['_id'];
						}
						else{
							$id = $doc['_id'];
						}
						$content = array();
						foreach($doc as $x => $x_value) {
					 		if(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\ObjectId'){
					 			$value = $x_value;
					 		}
					 		elseif(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\UTCDateTime'){
					 			$value = $x_value->toDateTime();
					 		}
					 		else{
					 	  		$value = printable($x_value);
					 		}
					 		$content[$x] =  improved_var_export($value);
					 	}
					 	$content = init_json($content);
					 	unset($content['_id']);
					 	$json = stripslashes(json_encode($content));
					 	// $jsonView = stripslashes(json_encode($content,JSON_PRETTY_PRINT));

						//Liens des options de gestion des documents

						if(isset($recherche_g)){
							$link_v = 'index.php?action=editDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&page='.$page;
						}

							//Affichage du tableau

							echo "<td id='d'><a class='text-success'   data-toggle='tooltip' title='".$json."' href=".$link_v."><i class=' text-dark fa fa-fw fa-file'></i>".$id."</a></td>";
							echo '<td id="json">'.substr($json, 0, 100).'';
							if(strlen($json)>100){echo ' [...] }';}
							echo '</td>';
							echo '</tr>';
						}
					}
				?>
		</table>
	   <div class="row justify-content-between m-1">

				<!-- Bouton de retour -->

				<div>
					<?php
					echo '<a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><button class="return btn btn-primary getCollection font-weight-bold">< Database</button></a>';
					?>
				</div>

				<!-- Fin du bouton de retour -->


				<!-- Pagination -->
		 		<div class="row mr-2">

					<div >
						<?php

						echo '<h6 class="mr-2 pt-2">Documents '.(1+(($page-1)*$bypage)).'-';
							if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
							else{echo $nbDocs;}
							echo ' of '.$nbDocs.'</h2>';
							?>
					</div>
				<div aria-label="pagination" >
			        <ul class="pagination">

			        <?php
			            if($page!=1){
			            	echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page-1).'&bypage='.$bypage.'&s_g='.urlencode($recherche_g).'" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>';
			            }
			            else{
			            	echo '<span id="prev"><span aria-hidden="true">&laquo;</span></span>';
			            } ?>

			            <span  class="text-center bg-light font-weight-bold mr-1">
                                <select id="select_pagination" name="bypage" onchange="bypage_search(this)">
                                <?php foreach([10, 20, 30, 50] as $nb) : ?>
                                  <option value="<?= $nb ?>" <?= ($bypage == $nb) ? 'selected="selected"': '' ?>><?= $nb ?></option>
                                <?php endforeach ?>
                                </select>
						</span>

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
					    <?php echo '<button class="btn btn-dark py-1 font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i title="Create new doc" class="fa fa-fw fa-plus"></i><i title="Create new doc" class="fa fa-fw fa-file"></i></a></button>'; ?>
				</div>
		 		 <!-- Fin du bouton nouveau document -->

		</div>

	</div>


<!-- Fin du tableau des documents de la collection -->
</div>

</body>


<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->

</html>

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

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/getCollection_search.css" rel="stylesheet" type="text/css">
	<link href="public/css/pagination.css" rel="stylesheet" type="text/css">

	<script src="public/js/db.js"></script>
 	<script src="public/js/radio.js"></script>
</head>

<body>

<?php

//Fil d'Ariane

echo "<div class='container border-top  border-success bg-success col-lg-8 sticky-top' >";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($serve)){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$serve.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i class="fa fa-fw fa-desktop"></i> '.$serve.'</a></li>';
			}
		}
		if(isset($db)){
			if($_GET['action']=='getDb'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-database"></i>'.$db.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><i class="fa fa-fw fa-database"></i>'.$db.'</a></li>';
			}
		}
		if(isset($coll)){
			if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-server"></i>'.$coll.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i class="fa fa-fw fa-server"></i>'.$coll.'</a></li>';
			}
		}
		if(isset($doc)){
			echo '<li class="breadcrumb-item active"><i class="icon-book"></i>'.$doc.'</li>';
		}
	echo '</ol>';
echo '</div>';

//Fin fil d'Ariane


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
	echo "<h1 class='title text-center font-weight-bold mt-5'><span>Search results for </span><i class='fa fa-fw fa-book'></i> ";
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

	<div id="options" class="text-center my-2">
		<?php echo '<a href="?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'">' ?>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">
				<i class="fa fa-fw fa-search"></i>Advanced Search
			</button>
		</a>
		<?php echo '<button class="btn bg-secondary class=""><a class="text-light" href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i class="fa fa-fw fa-history"></i></a></button>'; ?> 
	</div>
	

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

				<input class="btn bg-success text-light "  type="submit" name="search" id="search" value="Search"/>
			</div>
		</form>
	</div>
		<!-- Fin du formulaire de recherche par id et clé:valeur -->
</nav>

<!-- Fin de la partie recherche -->




<div id="main" class="border col-lg-8 offset-lg-2 bg-light m-auto ">

	<table class="table table-sm table-striped">

		 <?php 

			echo '<h3 class="text-center mb-1 bg-success text-light"><span><strong>Documents '.(1+(($page-1)*$bypage)).'-';
				if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
				else{echo $nbDocs;}
				echo ' of '.$nbDocs.'
				<span>
					 <button class="btn btn-dark align-items-center py-0 float-right new_doc font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i class="fa fa-fw fa-plus"></i><i class="fa fa-fw fa-book"></i></a></button>
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

					//Liens des options de gestion des documents

					if(isset($recherche_g)){
						$link_v = 'index.php?action=viewDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&page='.$page;
						$link_e = 'index.php?action=editDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&page='.$page;
						$link_d = 'index.php?action=deleteDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$id.'&type_id='.$type_id.'&page='.$page.'&s_g='.urlencode($recherche_g);
					}

					//Affichage du tableau

					echo "<td id='d'><a class='text-success' href=".$link_v."><i class=' text-dark fa fa-fw fa-book'></i>".$id."</a></td>";
					echo '<td id="json">'.substr($json, 0, 100).'';
					if(strlen($json)>100){echo ' [...] }';}
					echo '</td>';
					echo '</tr>';
				}
			}
		?>
	</table>
	<div class="row justify-content-around">

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

	            <span  class="text-center bg-light font-weight-bold">
					<select name="bypage" onchange="bypage_search()">
					    <option value="10" id="10" <?php if($bypage==10){echo 'selected="selected"';}?>>10</option>
					    <option value="20" id="20" <?php if($bypage==20){echo 'selected="selected"';}?>>20</option>
					    <option value="30" id="30" <?php if($bypage==30){echo 'selected="selected"';}?>>30</option>
					    <option value="50" id="50" <?php if($bypage==50){echo 'selected="selected"';}?>>50</option>
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
	<div class="float-right pt-2">
		    <?php echo '<button class="btn btn-dark   py-0 font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i class="fa fa-fw fa-plus"></i><i class="fa fa-fw fa-book"></i></a></button>'; ?>
	</div>
	  <!-- Fin du bouton nouveau document -->

</div><br></div><br>
<!-- Fin du tableau des documents de la collection -->

</body>
</html>
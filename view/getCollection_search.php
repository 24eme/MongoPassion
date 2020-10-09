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

echo "<div class='container col-lg-8 sticky-top' >";
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

if(isset($s_search)){
	echo '<p id="clé" style="display: none">s_s</p>';
	?>
	<input type=hidden id=valeur value=<?php echo urlencode($s_search); ?>>
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
elseif(isset($s_search)){
	echo "<h1 class='title text-center font-weight-bold mt-5'><span>Search results for </span><i class='fa fa-fw fa-book'></i> ";
	if($s_search=="find([])"){echo "\"Aucun critère\""; $p='none';}
	if($s_search!="find([])"){
		echo "\"<font color='#62a252'>".$s_search."</font>\"";
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

	


	<div  class="border col-lg-6 offset-lg-3 bg-light m-auto mb-2">
		<!-- <hr> -->
	<!-- Barre de boutons -->

	<div id="options" class="text-center my-2">
		<span>
			<?php echo '<button class="btn btn-dark new_doc font-weight-bold mr-5"><a class=text-light href="index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$recherche_g.'"><i class="fa fa-fw fa-plus"></i><i class="fa fa-fw fa-book"></i></a></button>'; ?>
		</span>

		<button type="button" class="btn btn-success " onclick="myFunctionSearchGet()" data-toggle="modal" data-target="#myModal">
	
			<i class="fa fa-fw fa-search"></i>Search by Id or Key : Value
		</button>
		<?php echo '<a href="?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'">' ?>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">
				<i class="fa fa-fw fa-search"></i>Search by command
			</button>
		</a>
		<?php echo '<button class="btn bg-secondary class=""><a class="text-light" href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i class="fa fa-fw fa-history"></i></a></button>'; ?> 
	</div>
	

	<div id="searchIdS" class="mt-1">
		<?php echo '<form autocomplete="off" method="post" action="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'">'; ?>

	        <div class="input-group mb-3">
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
	<br>
	<table class="table table-sm table-striped">
		<?php 
			echo"<h3 class=\"text-center bg-success text-light\"><span><strong><i class=\"fa fa-fw fa-book\"></i>Documents of ".$coll." </strong></span></h3>"; 
			if($nbDocs==0){
				echo 'Aucun document ne correspond à votre recherche.';
			}
			else{
				// foreach ($docs as $doc) {
				// 	$type_id = gettype($doc['_id']);
				// 	if ($type_id=='object'){
				// 		$id = (string)$doc['_id'];
				// 	}
				// 	else{
				// 	 $id = $doc['_id'];
				// 	}
				echo '<tr class="bg-dark text-light">';
				echo '<th class="text-center">Id</th>';
				$keys = array();
				$i=0;
					foreach ($docs[0] as $key => $value) {
					$type = gettype($value);
					if ($key !== '_id' && $type !=='object') {
						 echo '<th class="text-center">'.$key.'</th>';
						  array_push($keys, $key);
	                	 $i++;
	                 	if($i==3){
	                 		break;
	                 	}
             		}
			}
			echo '<th class="text-center">Action</th>';
			echo '</tr>';
			foreach ($docs as $doc) {
				echo '<tr class="mr-5">';
				$type_id = gettype($doc['_id']);
				if ($type_id=='object'){
					$id = (string)$doc['_id'];
				}
				else{
					$id = $doc['_id'];
				}



					//Liens des options de gestion des documents

					if(isset($recherche_g)){
						$link_v = 'index.php?action=viewDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&page='.$page;
						$link_e = 'index.php?action=editDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&page='.$page;
						$link_d = 'index.php?action=deleteDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$id.'&type_id='.$type_id.'&page='.$page.'&s_g='.urlencode($recherche_g);
					}

					//Affichage du tableau

					echo "<td class='text-center' id='d'><a class='text-success text-center' href=".$link_v."><i class=' text-dark fa fa-fw fa-book'></i>".$id."</a></td>";

					foreach ($keys as $k) {
					echo '<td class="text-center">'.(array_key_exists($k, $doc) ? $doc[$k] : '').'</td>';	

			        }
				
					echo "<td class='text-center'><button  class='btn py-0'><a class='text-dark text-center' href=".$link_v."><i class='fa fa-eye'></a></button></td>";	
					echo '</tr>';
				}
			}
		?>
	</table>


	<div id="radio" class="text-center font-weight-bold">
		<i class="fa fa-fw fa-book mr-3"></i>
		<input type="radio" name="bypage" value="10" id="10" <?php if($bypage==10){echo 'checked="checked"';}?> onclick="bypage_search()" /> <label for="10">10</label>
		<input type="radio" name="bypage" value="20" id="20" <?php if($bypage==20){echo 'checked="checked"';}?> onclick="bypage_search()" /> <label for="20">20</label>
		<input type="radio" name="bypage" value="30" id="30" <?php if($bypage==30){echo 'checked="checked"';}?> onclick="bypage_search()" /> <label for="30">30</label>
		<input type="radio" name="bypage" value="50" id="50" <?php if($bypage==50){echo 'checked="checked"';}?> onclick="bypage_search()" /> <label for="50">50</label>
	</div>

	<!-- Bouton de retour -->

    <?php
		echo '<br><a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><button class="return btn btn-primary getCollection font-weight-bold">< Database</button></a>';
	?>
</div>

<!-- Fin du tableau des documents de la collection -->


<!-- Pagination -->

<?php
if($nbDocs==0){
	echo '<footer></footer>';
}
else{	
	echo '<footer>';
	    echo '<nav aria-label="pagination">
	            <ul class="pagination">';
            if($page!=1 and $page!=2 and $page !=3){echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span><span class="visuallyhidden">previous set of pages</span></a></li>';}
            for ($i=1;$i<=$nbPages;$i++){
                if($page==1){
                    switch ($i) {
                        case $page:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'" aria-current="page"><span class="visuallyhidden">page </span>'.$page.'</a></li>';
                        break;
                        case $page+1:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+1).'</a></li>';
                        break;
                        case $page+2:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+2).'</a></li>';
                            echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
                        break;
                        case $nbPages:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.$nbPages.'</a></li>';
                        break;
                    }
                }
                elseif ($page==$nbPages) {
                    switch ($i) {
                        case 1:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>1</a></li>';
                            echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
                        break;
                        case $page-2:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-2).'</a></li>';
                        break;
                        case $page-1:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-1).'</a></li>';
                        break;
                        case $page:
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'" aria-current="page"><span class="visuallyhidden">page </span>'.$page.'</a></li>';
                        break;
                    }
                }
                else{
                    if($i==1){
                        if((null!=($page-1) and ($page-1)!=1) and (null!=($page-2) and ($page-2)!=1)){
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>1</a></li>';
                            echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
                        }
                    }
                    if(null!=($page-2) and $i==($page-2)){
                        echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-2).'</a></li>';
                    }
                    if(null!=($page-1) and $i==($page-1)){
                        echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-1).'</a></li>';
                    }
                    if($i==$page){
                        echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'" aria-current="page"><span class="visuallyhidden">page </span>'.$page.'</a></li>';
                    }
                    if(null!=($page+1) and $i==($page+1)){
                        echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+1).'</a></li>';
                    }
                    if(null!=($page+2) and $i==($page+2)){
                        echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+2).'</a></li>';
                        echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
                    }
                    if($i==$nbPages){
                        if((($page+1)!=$nbPages) and ($page+2)!=$nbPages){
                            echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.$i.'"><span class="visuallyhidden">page </span>'.$nbPages.'</a></li>';
                        }
                    }
                }
            }
            if($page!=$nbPages and $page!=($nbPages-1) and $page!=($nbPages-2) and $p!='none'){echo '<li><a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.urlencode($recherche_g).'&page='.($page+1).'"><span class="visuallyhidden">next set of pages</span><span aria-hidden="true">&raquo;</span></a></li>';}

echo '</ul>
    </nav>
</footer>';
}
?>

<!-- Fin de la pagination -->

</body>
</html>
<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Advanced Search</title>"?>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/advancedSearch.css" rel="stylesheet" type="text/css">
	<link href="public/css/pagination.css" rel="stylesheet" type="text/css">

 	<script src="public/js/radio.js"></script>
</head>

<body>

<?php

//Fil d'Ariane

echo "<div  class='container col-lg-8 sticky-top' style='margin-left: 100px;'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($serve)){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$serve.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i class="fa fa-fw fa-desktop"></i>'.$serve.'</a></li>';
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
		if(isset($_GET['doc'])){
			echo '<li class="breadcrumb-item active"><i class="icon-book"></i>'.$_GET['doc'].'</li>';
		}
	echo '</ol>';
echo '</div>';

//Fin fil d'Ariane


//Préparation des variables de recherche pour leur utilisation en JS

if(isset($a_s)){
	echo '<p id="clé" style="display: none">a_s</p>';
	?>
	<input type=hidden id=valeur value=<?php echo urlencode($a_s); ?>>
	<?php
}

//Fin de la préparation des variables de recherche pour leur utilisation en JS

?>

<!-- Titre de la page -->

<?php
	if(isset($a_s)){
		echo '<h1 class = "title font-weight-bold" align="center"><i class="fa fa-fw fa-search"></i>Search results for "'.$a_s.'"</h1>';
	}
	else{
?>
<h1 class='title font-weight-bold'align="center"><i class="fa fa-fw fa-search"></i>Advanced Search</h1>
<?php } ?>

<!-- Fin du titre de la page -->


<!-- Partie recherche -->

<div class="mt-1">
	<?php echo '<form method="post" action="'.$link_search.'">';
		echo '<label for="a_s">Execute a query in '.$coll.':</label>';
		if(isset($a_s)){
			echo '<textarea name="a_s" id="a_" rows="5" cols="100">'.$a_s.'</textarea>';
		}
		else{
			echo '<textarea name="a_s" id="a_" rows="5" cols="100">db.'.$coll.'.find()</textarea>';
		} ?>
		<input type="submit" class="btn btn-success" name="a_search" id="a_search" value="Execute">
	</form>
	<?php echo '<button class="btn bg-secondary"><a class="text-light" href="'.$link_reinit.'"><i class="fa fa-fw fa-history"></i></a></button>'; ?> 
</div>

<!-- Fin de la partie recherche -->


<!-- Tableau des résulats -->

<?php if(isset($a_s)){?>
	<div id='result' align="center">
		<?php echo '<h5>Search results for "'.$a_s.'" ('.(1+(($page-1)*$bypage)).'-';
					if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
					else{echo $nbDocs;}
					echo ' of '.$nbDocs.') :</h5><br>'?>
		<table class="table table-sm table-striped">
			<?php if(empty($result)){
				echo 'No document matches your search';
			}
			else{
			?>
				<?php
				foreach ($result as $key=>$entry) {
					$link_v = '?action=viewDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$entry['_id'].'&type_id='.gettype($entry['_id']).'&a_s='.urlencode($a_s).'&page='.$page;
					echo '<tr><td><a href="'.$link_v.'">'.$entry['_id'].'</a></td></tr>';
					if(isset($docs)){
						echo '<tr><td class="json"><pre>'.$docs[$key].'</pre></td></tr>';
					}
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
	</div>
<?php } ?>
	


<!-- Fin du tableau des résultats -->


<!-- Pagination -->

<?php

if(isset($nbDocs)){	
	echo '<footer>';
	    echo '<nav aria-label="pagination">
	            <ul class="pagination">';
            if($page!=1 and $page!=2 and $page !=3){echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.($page-1).'"><span aria-hidden="true">&laquo;</span><span class="visuallyhidden">previous set of pages</span></a></li>';}
            for ($i=1;$i<=$nbPages;$i++){
                if($page==1){
                    switch ($i) {
                        case $page:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'" aria-current="page"><span class="visuallyhidden">page </span>'.$page.'</a></li>';
                        break;
                        case $page+1:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+1).'</a></li>';
                        break;
                        case $page+2:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+2).'</a></li>';
                            echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
                        break;
                        case $nbPages:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.$nbPages.'</a></li>';
                        break;
                    }
                }
                elseif ($page==$nbPages) {
                    switch ($i) {
                        case 1:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>1</a></li>';
                            if($page!=2 and $page=!3){
	                            echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
	                        }
                        break;
                        case $page-2:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-2).'</a></li>';
                        break;
                        case $page-1:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-1).'</a></li>';
                        break;
                        case $page:
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'" aria-current="page"><span class="visuallyhidden">page </span>'.$page.'</a></li>';
                        break;
                    }
                }
                else{
                    if($i==1){
                        if((null!=($page-1) and ($page-1)!=1) and (null!=($page-2) and ($page-2)!=1)){
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>1</a></li>';
                            echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
                        }
                    }
                    if(null!=($page-2) and $i==($page-2)){
                        echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-2).'</a></li>';
                    }
                    if(null!=($page-1) and $i==($page-1)){
                        echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page-1).'</a></li>';
                    }
                    if($i==$page){
                        echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'" aria-current="page"><span class="visuallyhidden">page </span>'.$page.'</a></li>';
                    }
                    if(null!=($page+1) and $i==($page+1)){
                        echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+1).'</a></li>';
                    }
                    if(null!=($page+2) and $i==($page+2)){
                        echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.($page+2).'</a></li>';
                        echo '<li><a href=""><span class="visuallyhidden">page </span>...</a></li>';
                    }
                    if($i==$nbPages){
                        if((($page+1)!=$nbPages) and ($page+2)!=$nbPages){
                            echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$i.'"><span class="visuallyhidden">page </span>'.$nbPages.'</a></li>';
                        }
                    }
                }
            }
            if($page!=$nbPages and $page!=($nbPages-1) and $page!=($nbPages-2) and $p!='none'){echo '<li><a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.($page+1).'"><span class="visuallyhidden">next set of pages</span><span aria-hidden="true">&raquo;</span></a></li>';}

echo '</ul>
    </nav>
</footer><br>';
}
?>

<!-- Fin de la pagination -->

</body>
</html>
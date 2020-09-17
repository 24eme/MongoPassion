<!doctype html>
<html lang="fr">
<head>
	<?php
	if(isset($recherche_id) and isset($recherche_g)){
		echo "<title>Résultat de la recherche pour ";
		if($recherche_id=="" and $recherche_g=="field : content[...]"){echo "\"Aucun critère\"";}
		if($recherche_id!=""){echo "\"".$recherche_id."\"";}
		if($recherche_id!="" and $recherche_g!="field : content[...]"){echo " et ";}
		if($recherche_g!="field : content[...]"){echo "\"".$recherche_g."\"";}
		echo "</title>";
	}
	else{
		echo "<title>".$_GET['coll']."</title>";
	}
	?>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/getCollection_search.css" rel="stylesheet" type="text/css">

	<script src="public/js/db.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script type="text/javascript">

$(document).ready(function(){
	// alert('bonjour');
   $('#recherche_gss').hide();

  $('#Rs').on('change', function(e){

  	// $('#recherche_g').show();
   //  $('#recherche_id').hide();
   if (this.value=='Rkeys'){
   	$('#recherche_gss').show();
     $('#recherche_ids').hide();

   }
   else {
   	if (this.value=='Rids'){ 
   	 $('#recherche_gss').hide();
     $('#recherche_ids').show();

     }
   }

  });
  
});


// $("#Rkey").click(function(){
//   $('#recherche_g').hide();
// });

// $("#Rid").click(function(){
//   $('#recherche_g').show();
// });
</script>

</head>

<body>

<?php


	//Fil d'Ariane

	echo '<nav>';
		echo '<ol class="breadcrumb">';
			echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
			if(isset($_GET['serve'])){
				if($_GET['action']=='getServer'){
					echo '<li class="breadcrumb-item active">'.$_GET['serve'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><i class="fa fa-fw fa-desktop"></i>'.$_GET['serve'].'</a></li>';
				}
			}
			if(isset($_GET['db'])){
				if($_GET['action']=='getDb'){
					echo '<li class="breadcrumb-item active">'.$_GET['db'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'"><i class="fa fa-fw fa-database"></i>'.$_GET['db'].'</a></li>';
				}
			}
			if(isset($_GET['coll'])){
				if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'){
					echo '<li class="breadcrumb-item active">'.$_GET['coll'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'"><i class="fa fa-fw fa-server"></i>'.$_GET['coll'].'</a></li>';
				}
			}
			if(isset($_GET['doc'])){
				echo '<li class="breadcrumb-item active">'.$_GET['doc'].'</li>';
			}
		echo '</ol>';
	echo '</nav>';

// echo '<span>';
// echo '<form method="post" action="index.php?action=thread">';
// echo '<input type="hidden" name="action_thread" value="'.$_GET['action'].'"></input>';
// if(isset($_GET['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_GET['serve'].'"/>';}
// else{echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread"/>';}
// if(isset($_GET['db'])){echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread" value="'.$_GET['db'].'"/>';}
// else{echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread"/>';}
// if(isset($_GET['coll'])){echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread" value="'.$_GET['coll'].'"/>';}
// else{echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread"/>';}
// if(isset($_GET['doc'])){echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread" value="'.$_GET['doc'].'"/>';}
// else{echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread"/>';}
// echo '<input type="submit" name="go" id="go" value="Go"/>';
// echo '</form>';
// echo '</span>';

if(isset($recherche_id) and isset($recherche_g)){
	echo "<h1 align='center' class='title'>Résultat de la recherche pour ";
	if($recherche_id=="" and $recherche_g=="field = content[...]"){echo "\"Aucun critère\"";}
	if($recherche_id!=""){echo "\"".$recherche_id."\"";}
	if($recherche_id!="" and $recherche_g!="field = content[...]"){
		echo " et ";
	}
	if($recherche_g!="field = content[...]"){
			echo "\"".$recherche_g."\"";
		}
	echo "</h1>";
}
else{
	echo "<h1 class='title'>".$_GET['coll']."</h1>";
}
echo '<h2 class="subtitle">Documents '.(1+(($page-1)*$bypage)).'-';
if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
else{echo $nbDocs;}
echo ' sur '.$nbDocs.'</h2>';
?>

<nav>
	<div id="options">
		<span>
			<?php echo '<button class="btn new_doc"><a class="text-light" href="index.php?action=createDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$recherche_id.'&s_g='.$recherche_g.'&search='.$page.'">Nouveau Document</a></button>'; ?>
		</span>
	</div>


</nav>
<hr>

<div id="row">

<div id="recherche">
	<br>
	<div id="search_content">
	<label for="pet-select">Recherche:</label>
		<br>
		<select name="pets" id="Rs">

		    <option id="Rids"  value="Rids">Recherche par ID</option>
		    <option id="Rkeys" value="Rkeys">Par clé : valeur</option>
		</select>
	<?php echo '<form method="post" action="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; ?>
		<input type="search" class="form-control" name="recherche_id" id="recherche_ids" placeholder="Search by id"/>
		<!-- <input type="search" name="recherche_g"  id="recherche_gss" placeholder="Search by id"/> -->
		<input type="search" name="recherche_g" id="recherche_gss" value="field : content[...]"/>
		<input class="btn bg-success text-light m-1" type="submit" name="search" id="search" value="Search"/>
		<?php echo '<button class="btn bg-secondary"><a class="text-light" href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">Reinit</a></button>'; ?>
	</form>
	</div>
	<div id="special_search_content">
		<?php echo '<form method="post" action="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; ?>
		<input type="search" class="form-control" name="special_search" id="special_search" size=100 value="$collection->find( ['_id'=>'CONTRAT-000013-20130812-0001'], ['skip'=>$skip,'limit'=>$bypage] )->toArray();"/>
		<input type="submit" class="btn  bg-success text-light m-1" name="search" id="search" value="Search"/>
	</form>
</div>
</div>
<hr>
<div id="main" class="border col-lg-5 bg-light mt-1">
	<br>
	<table class="table">
		<?php
			if($nbDocs==0){
				echo 'Aucun document ne correspond à votre recherche.';
			}
			else{
				foreach ($docs as $doc) {
					$type_id = gettype($doc['_id']);
					if ($type_id=='object'){
						$id = (string)$doc['_id'];
					}
					else{
						$id = $doc['_id'];
					}

					$link_v = 'index.php?action=viewDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&search='.$page;
					$link_e = 'index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&search='.$page;
					// $link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'type_id='.$type_id.'&search='.$page;
					$link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id.'&search='.$page.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g);

					echo '<tr>';
					echo "<td id='d'><a class='text-dark' href=".$link_v.">".$id."</a></td>";
					echo "<td id='edit'><button  class='btn'><a class='text-primary' href=".$link_e."><i class='fa fa-edit'></i></a></button></td>";
					// echo '<td id="suppr"><a  href='.$link_d.'>Delete</a></td>';
					echo  "<td id='suppr'><button  class='btn'><a class='text-danger' href=".$link_d." onclick='return confirmDelete()' ><i class='fa fa-trash'></i></a></button></td>";
					echo '</tr>';
				}

				// echo "<td id='d'><a class='text-dark' href=".$link_v.">".$id."</a></td>";
					// echo "<td id='id'><button  class='btn'><a class='text-primary' href=".$link_v."><i class='fa fa-eye'></a></button></td>";
					// echo "<td id='edit'><button  class='btn'><a class='text-primary' href=".$link_e."><i class='fa fa-edit'></a></button></td>";
					// // echo '<td id="suppr"><a href='.$link_d.'>Delete</a></td>';
					// echo  "<td id='suppr'><button  class='btn'><a class='text-danger'href=".$link_d." onclick='return confirmDelete()' ><i class='fa fa-trash'></i></a></button></td>";

				// <i class="fa fa-trash"></i>
				// <button><a href="blabla.html">Texte du bouton</a></button>
			}
		?>
	</table>

</div>
	<?php
	echo '<br><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'"><button class="return btn btn-primary getCollection">< Database</button></a>';
	?>
</div>
<footer>
	<?php
	echo '<br>';

	for ($i=1;$i<=$nbPages;$i++) {
		echo '<a href="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'&page='.$i.'">'.$i.'</a>';
		if($i!=$nbPages){echo '-';}
	}
	?>
</footer>
</body>
</html>
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
if(isset($recherche_id) and isset($recherche_g)){
	echo "<h1 class='title'>Résultat de la recherche pour ";
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
echo '<br>';
echo '<h2 class="subtitle">Documents '.(1+(($page-1)*$bypage)).'-';
if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
else{echo $nbDocs;}
echo ' sur '.$nbDocs.'</h2>';
?>

<nav>
	<div id="options">
		<span>
			<?php echo '<a href="index.php?action=createDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$recherche_id.'&s_g='.$recherche_g.'&search='.$page.'">Nouveau Document</a>'; ?>
		</span>
	</div>
</nav>

<div class="recherche">
	<br>
	<label for="pet-select">Recherche:</label>

		<select name="pets" id="Rs">

		    <option id="Rids"  value="Rids">Recherche par ID</option>
		    <option id="Rkeys" value="Rkeys">Par clé : valeur</option>
		</select>
	<?php echo '<form method="post" action="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; ?>
		<input type="search" name="recherche_id" id="recherche_ids" placeholder="Search by id"/>
		<!-- <input type="search" name="recherche_g"  id="recherche_gss" placeholder="Search by id"/> -->
		<input type="search" name="recherche_g" id="recherche_gss" value="field : content[...]"/>
		<input type="submit" name="search" id="search" value="Search"/>
		<?php echo '<a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">Reinit</a>'; ?>
	</form>
</div>

<div id="main">
	<br>
	<table>
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
					echo '<td id="id"><a href='.$link_v.'>'.$id.'</a></td>';
					echo "<td id='edit'><button  class='btn'><a href=".$link_e."><i class='fa fa-edit'></i></a></button></td>";
					// echo '<td id="suppr"><a  href='.$link_d.'>Delete</a></td>';
					echo  "<td id='suppr'><button  class='btn'><a href=".$link_d." onclick='return confirmDelete()' ><i class='fa fa-trash'></i></a></button></td>";
					echo '</tr>';
				}
				// <i class="fa fa-trash"></i>
				// <button><a href="blabla.html">Texte du bouton</a></button>
			}
		?>
	</table>
	<?php
	echo '<br><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'">< Database</a>';
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
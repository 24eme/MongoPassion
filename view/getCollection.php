<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$_GET['coll']."</title>"?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 	<script src="public/js/db.js"></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- 
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> -->
<script type="text/javascript">

$(document).ready(function(){
  $('#recherche_g').hide();
  
  $('#R').on('change', function(e){

   if (this.value=='Rkey'){
   	$('#recherche_g').show();
     $('#recherche_id').hide();

   }
   else {
   	if (this.value=='Rid'){ 
   	 $('#recherche_g').hide();
     $('#recherche_id').show();

     }
   }

  });
  
});

</script>


</head>

<body style="background-color:#A48340;">

<?php

echo '<span>';
echo '<form method="post" action="index.php?action=thread">';
echo '<input type="hidden" name="action_thread" value="'.$_GET['action'].'"></input>';
if(isset($_GET['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_GET['serve'].'"/>';}
else{echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread"/>';}
if(isset($_GET['db'])){echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread" value="'.$_GET['db'].'"/>';}
else{echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread"/>';}
if(isset($_GET['coll'])){echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread" value="'.$_GET['coll'].'"/>';}
else{echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread"/>';}
if(isset($_GET['doc'])){echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread" value="'.$_GET['doc'].'"/>';}
else{echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread"/>';}
echo '<input type="submit" name="go" id="go" value="Go"/>';
echo '</form>';
echo '</span>';

if(isset($_POST['recherche_id']) and isset($_POST['recherche_g'])){
	echo "<h1 class='title'>Résultat de la recherche pour ";
	if($_POST['recherche_id']=="" and $_POST['recherche_g']=="field : content[...]"){echo "\"Aucun critère\"";}
	if($_POST['recherche_id']!=""){echo "\"".$_POST['recherche_id']."\"";}
	if($_POST['recherche_id']!="" and $_POST['recherche_g']!="field : content[...]"){echo " et ";}
	if($_POST['recherche_g']!="field : content[...]"){echo "\"".$_POST['recherche_g']."\"";}
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
			<?php echo '<a href="index.php?action=createDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">Nouveau Document</a>'; ?>
		</span>
	</div>
</nav>

<div class="recherche">
	<br>
	<label for="pet-select">Recherche:</label>

		<select name="pets" id="R">

		    <option id="Rid"  value="Rid">Recherche par ID</option>
		    <option id="Rkey" value="Rkey">Par clé : valeur</option>
		</select>
	<?php echo '<form method="post" action="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; ?>
		<input type="search" name="recherche_id" id="recherche_id" placeholder="Search by id"/>
		<input type="search" name="recherche_g" id="recherche_g" value="field : content[...]"/>
		<input type="submit" name="search" id="search" value="Search"/>
		<?php echo '<a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">Reinit</a>'; ?>
	</form>
	<?php echo '<form method="post" action="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; ?>
		<input type="search" name="special_search" id="special_search" size=100 value="$collection->find( ['_id'=>'CONTRAT-000013-20130812-0001'], ['skip'=>$skip,'limit'=>$bypage] )->toArray();"/>
		<input type="submit" name="search" id="search" value="Search"/>
	</form>
</div>

<div id="main" class="border border-dark col-lg-4 offset-lg-4 bg-light mt-1">
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
					$link_v = 'index.php?action=viewDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id.'&page='.$page;
					$link_e = 'index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id.'&page='.$page;
					$link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id.'&page='.$page;

					echo '<tr>';
					echo "<td id='d'><a class='text-dark' href=".$link_v.">".$id."</a></td>";
					echo "<td id='id'><button  class='btn'><a class='text-primary' href=".$link_v."><i class='fa fa-eye'></a></button></td>";
					echo "<td id='edit'><button  class='btn'><a class='text-primary'href=".$link_e."><i class='fa fa-edit'></a></button></td>";
					// echo '<td id="suppr"><a href='.$link_d.'>Delete</a></td>';
					echo  "<td id='suppr'><button  class='btn'><a class='text-danger'href=".$link_d." onclick='return confirmDelete()' ><i class='fa fa-trash'></i></a></button></td>";

					echo '</tr>';
					 
				}


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
		echo '<a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&page='.$i.'">'.$i.'</a>';
		if($i!=$nbPages){echo '-';}
	}
	?>
</footer>

	
	

</body>
</html>
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
	<script src="public/js/db.js"></script>
</head>

<body>

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

if(isset($recherche_id) and isset($recherche_g)){
	echo "<h1 class='title'>Résultat de la recherche pour ";
	if($recherche_id=="" and $recherche_g=="field = content[...]"){echo "\"Aucun critère\"";}
	if($recherche_id!=""){echo "\"".$recherche_id."\"";}
	if($recherche_id!="" and $recherche_g!="field = content[...]"){echo " et ";}
	if($recherche_g!="field = content[...]"){echo "\"".$recherche_g."\"";}
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
			<?php echo '<a href="index.php?action=createDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$recherche_id.'&s_g='.$recherche_g.'&search='.$page.'">Nouveau Document</a>'; ?>
		</span>
	</div>
</nav>

<div class="recherche">
	<br>
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

					if(isset($_POST['special_search'])){
						$link_v = 'index.php?action=viewDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_s='.urlencode($_POST['special_search']).'&type_id='.$type_id.'&page='.$page;
						$link_e = 'index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_s='.urlencode($_POST['special_search']).'&type_id='.$type_id.'&page='.$page;
						$link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id.'&page='.$page;
					}

					elseif(isset($_GET['s_s'])){
						$link_v = 'index.php?action=viewDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_s='.urlencode($_GET['s_s']).'&type_id='.$type_id.'&page='.$page;
						$link_e = 'index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_s='.urlencode($_GET['s_s']).'&type_id='.$type_id.'&page='.$page;
						$link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id.'&page='.$page;
					}

					else{
						$link_v = 'index.php?action=viewDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&search='.$page;
						$link_e = 'index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'&type_id='.$type_id.'&search='.$page;
						// $link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'type_id='.$type_id.'&search='.$page;
						$link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id.'&search='.$page.'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g);
					}

					echo '<tr>';
					echo '<td id="id"><a href='.$link_v.'>'.$id.'</a></td>';
					echo '<td id="edit"><a href='.$link_e.'>Edit</a></td>';
					// echo '<td id="suppr"><a  href='.$link_d.'>Delete</a></td>';
					echo  "<td id='suppr'><a href=".$link_d." onclick='return confirmDelete()' >Delete</a></td>";
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
		echo '<a href="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$recherche_id.'&s_g='.urlencode($recherche_g).'&page='.$i.'">'.$i.'</a>';
		if($i!=$nbPages){echo '-';}
	}
	?>
</footer>
</body>
</html>
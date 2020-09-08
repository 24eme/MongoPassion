<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$_GET['coll']."</title>"?>
	<meta charset="UTF-8">
</head>

<body>

<?php
if(isset($_POST['recherche_id']) and isset($_POST['recherche_g'])){
	echo "<h1 class='title'>Résultat de la recherche pour ";
	if($_POST['recherche_id']=="" and $_POST['recherche_g']=="field = content[...]"){echo "\"Aucun critère\"";}
	if($_POST['recherche_id']!=""){echo "\"".$_POST['recherche_id']."\"";}
	if($_POST['recherche_id']!="" and $_POST['recherche_g']!="field = content[...]"){echo " et ";}
	if($_POST['recherche_g']!="field = content[...]"){echo "\"".$_POST['recherche_g']."\"";}
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
			<?php echo '<a href="index.php?action=createDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">Nouveau Document</a>'; ?>
		</span>
	</div>
</nav>

<div class="recherche">
	<br>
	<?php echo '<form method="post" action="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; ?>
		<input type="search" name="recherche_id" id="recherche_id" placeholder="Search by id"/>
		<input type="search" name="recherche_g" id="recherche_g" value="field = content[...]"/>
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
					$link_v = 'index.php?action=viewDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id;
					$link_e = 'index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id;
					$link_d = 'index.php?action=deleteDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$id.'&type_id='.$type_id;

					echo '<tr>';
					echo '<td id="id"><a href='.$link_v.'>'.$id.'</a></td>';
					echo '<td id="edit"><a href='.$link_e.'>Edit</a></td>';
					echo '<td id="suppr"><a href='.$link_d.'>Delete</a></td>';
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
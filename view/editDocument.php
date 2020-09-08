<!doctype html>
<html lang="fr">
<head>
	<title>Edit Document</title>
	<meta charset="UTF-8">
</head>

<body>

<?php echo "<h1 class='title'>".$_GET['doc']."</h1>" ?>

<div id="main">
	<?php
		foreach ($result as $entry) {
			$doc=array();
			$date_array=array();
			$up_date_array=array();
		    foreach($entry as $x => $x_value) {
		 		if(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\ObjectId'){
		 			$value = $x_value;
		 		}
		 		elseif(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\UTCDateTime'){
		 			$value = $x_value->toDateTime();
		 			$date_array[$x]=intval((string)$x_value);
		 			$temp=strtotime((improved_var_export(printable($value))['date']))*1000;
		 			$up_date_array[$x]=$temp;
		 		}
		 		else{
		 	  		$value = printable($x_value);
		 		}
		 		$doc[$x] = improved_var_export($value);
		 	}
		 		$doc = init_json($doc);
		 		$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
	 	}
	 	echo '<form method="post" action="'.$link_doc.'">';
	 	echo '<input type="hidden" name="date_array" value="'.htmlspecialchars(serialize($date_array)).'"></input>';
	 	echo '<input type="hidden" name="up_date_array" value="'.htmlspecialchars(serialize($up_date_array)).'"></input>';
	 	echo '<textarea name="doc_text" id="doc_text" rows="20" cols="200" required>'.$docs.'</textarea>';
	 	echo '<input type="submit" name="update" id="update" value="Update">';
	 	echo '</form>';
	 	echo '<br>';
	 	if(isset($_GET['search'])){
	 		echo '<a href="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$_GET['s_id'].'&s_g='.$_GET['s_g'].'&page='.$_GET['search'].'">< Collection</a>';
	 	}
	 	else{
	 		echo '<a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&page='.$_GET['page'].'">< Collection</a>';
	 	}
	?>
</div>

</body>
</html>
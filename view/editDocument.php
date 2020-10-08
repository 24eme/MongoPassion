<!doctype html>
<html lang="fr">
<head>
	<?php echo '<title>Edit '.$doc.'</title>'; ?>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="jsoneditor/dist/jsoneditor.min.css" rel="stylesheet" type="text/css">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/editDocument.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">

	<script src="jsoneditor/dist/jsoneditor.min.js"></script>
    <script src="public/js/switch.js"></script>
</head>

<body>

<?php 

//Fil d'Ariane

echo "<div class='container col-lg-7 sticky-top'>";
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


//Titre de la page

echo "<h1 class='title text-center'>Edit <i class='fa fa-fw fa-book'></i>".$doc."</h1>";

//Fin du titre de la page


//Bouton de retour

echo '<div id="nav_view">';
	if(isset($s_g)){
		echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'&page='.$page.'"><button class="return text-center btn btn-primary">< Collection</button></a>';
	}
	elseif(isset($a_s)){
		echo '<a class="text-center" href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.$a_s.'&page='.$page.'"><button class="return  btn btn-primary">< Collection</button></a>';
	}
	elseif(isset($search_db)){
		echo '<a href="index.php?action=getDb_search&serve='.$serve.'&db='.$db.'&search_db='.$search_db.'"><button class="return btn btn-primary">< Collection</button></a>';
	}
	else{
		echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.$page.'"><button class="return btn btn-primary">< Collection</button></a>';
	} 
echo '</div>';
?>

<!-- Fin du bouton de retour -->


<!-- Bouton switch JsonEditor -->

<div id="switch">
	<label id="switch_json">JSONEditor</label>
	<label class="switch">
	  <input type="checkbox" id="myCheck" checked onclick="switchJ()">
	  <span class="slider round"></span>
	</label>
</div>

<!-- Fin du bouton switch JsonEditor -->


<!-- Formulaire mode édition classique -->

<div id="main" style="display: none">
	<?php

		//Formatage des données du document en JSON

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

	 	//Affichage du formulaire

	 	echo '<form method="post" action="'.$link_doc.'">';
	 		echo '<input type="hidden" name="date_array" value="'.htmlspecialchars(serialize($date_array)).'"></input>';
	 		echo '<input type="hidden" name="up_date_array" value="'.htmlspecialchars(serialize($up_date_array)).'"></input>';
	 		echo '<div id="update_content"><input type="submit" class="btn btn-secondary" name="update" id="update" value="Update"></div>';
	 		echo '<div id="doc_content"><textarea name="doc_text" id="doc_text" rows="20" cols="200" required>'.$docs.'</textarea></div>';
	 	echo '</form>';
	 	echo '<br>'
	?>
</div>

<!-- Fin du formulaire mode édition classique -->


<!-- Formulaire mode édition JsonEditor -->

<!-- Affichage du formulaire -->

<div id="json" style="display: block;">
     <div id="getJson_content"><button class="btn btn-secondary" id="getJSON">Update</button></div>
     <span id="nC"></span>
	<div id="jsoneditor" style="width: 50%; height: 700px;"></div>
</div>

<!-- Script de création et d'envoi du formulaire -->

<script type="text/javascript">
    const container = document.getElementById("jsoneditor")
    const options = {}
    const editor = new JSONEditor(container, options)
    var variableRecuperee = <?php echo stripslashes(json_encode($doc)); ?>;
    var link_doc = <?php echo (json_encode($link_doc)); ?>;

    /* Création du formulaire */

    const initialJson = variableRecuperee;
    editor.set(initialJson)

    /* Fonction d'envoi du formulaire */

    document.getElementById('getJSON').onclick = function () {
        const json = editor.get()
        var updatedJson = JSON.stringify(json, null, 2)

        var f = document.createElement("form");
        f.setAttribute('method',"post");
        f.setAttribute('action',link_doc);
        f.setAttribute('id',"idFormulaire");

        var i = document.createElement("input"); //input element, text
        i.setAttribute('type',"hidden");
        i.setAttribute('name',"doc_text");
        i.setAttribute('value',updatedJson);

        f.appendChild(i);

        var span = document.getElementById("nC");

        span.appendChild(f);

        document.getElementById("idFormulaire").submit();

    }
</script>

<!-- Fin du formulaire mode édition JsonEditor -->

</body>
</html>
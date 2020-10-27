<!doctype html>
<html lang="fr">
<head>
	<?php echo '<title>Edit '.$doc.'</title>'; ?>

	<?php require_once('layouts/header.php') ?>
</head>

<body>

<?php include('layouts/breadcrumb.php'); ?>

<div class="container">

<?php

$link_d = 'index.php?action=deleteDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$doc.'&page='.$page;


//Titre de la page

echo "<h2 class='title text-center'>Edit <i title='id of document' class='fa fa-fw fa-file'></i>".$doc."<button  class=\"btn \"><a class=\"text-danger font-weight-bold\" href=".$link_d." onclick=\"return confirmDelete()\"><i title='Delete this document'class='fa fa-2x fa-trash'></i></a></button></h2>";

//Fin du titre de la page


//Message d'erreur

if(isset($_GET['msg'])){

  echo '<div id="cacherAlert" class="text-center alert alert-danger alert-dismissible fade show" role="alert">';
   echo $_GET['msg'];
  echo '<button type="button" class="close" onclick="cacherAlert()" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>';
  echo '</div>';


}

//Fin Messagege d'erreur

if(isset($type_id)){

	$link_d=$link_d.'&type_id='.$type_id;
}
if(isset($a_s)){

	$link_d=$link_d.'&a_s='.$a_s;
}
if(isset($s_g)){

	$link_d=$link_d.'&s_g='.$s_g;
}
if(isset($search_db)){

	$link_d=$link_d.'&search_db='.$search_db;
}
?>

<!-- Fin du bouton de retour -->


<!-- Bouton switch JsonEditor -->

<?php if($jsoneditor){?>
<div id="switch">
	<label id="switch_json">JSONEditor</label>
	<label class="switch">
		<?php
		if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
	  		echo '<input type="checkbox" id="myCheck" onclick="switchJ()">';
	  	} else {
	  		echo '<input type="checkbox" id="myCheck" checked onclick="switchJ()">';
	  	}
	  ?>
	  <span class="slider round"></span>
	</label>
</div>
<?php }?>

<!-- Fin du bouton switch JsonEditor -->


<!-- Formulaire mode édition classique -->
<!--
<div id="main"  style="display: none"> -->
	<?php
	if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
		echo '<div id="main"  style="display: block">';
	} else {
		if($jsoneditor){
			echo '<div id="main" style="display: none">';
		}
		else{
			echo '<div id="main">';
		}
	}
	?>
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
		 	//contenu de l'erreur
		 	 if(isset($_GET['doc_text'])){
		 		$docs= $_GET['doc_text'];
		 		$docs = json_decode($docs);
		 		$docs = $docs->data;
		 	 }else{
		 	 	$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
		 	 }

	 	}

	 	//Affichage du formulaire

	 	echo '<form method="post" action="'.$link_doc.'">';
	 		echo '<input type="hidden" name="date_array" value="'.htmlspecialchars(serialize($date_array)).'"></input>';
	 		echo '<input type="hidden" name="up_date_array" value="'.htmlspecialchars(serialize($up_date_array)).'"></input>';
	 		echo '<div id="update_content"><input type="submit" class="btn btn-secondary" name="update" id="update" value="Save"></div>';
	 		echo '<div id="doc_content"><textarea autofocus="autofocus" name="doc_text" id="doc_text"  rows="20" cols="200" required>'.$docs.'</textarea></div>';
	 	echo '</form>';
	 	echo '<br>'
	?>
<!-- Fin du formulaire mode édition classique -->
</div>

<!-- Formulaire mode édition JsonEditor -->

<!-- Affichage du formulaire -->

<?php if($jsoneditor){?>
<div id="DivContentTable">
		<?php
			if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
				echo '<div id="json"  style="display: none;">';
			} else {
				echo '<div id="json"  style="display: block;">';
			}
		?>
	    <div  id="getJson_content">
	     	<button class="btn btn-secondary" id="getJSON">Save</button>
	    </div>
	    <span id="nC"></span>
		<div id="DivContentTable">
			<div id="jsoneditor" style="height: 750px;"></div>
		</div>
	</div>
</div>
<?php }?>

<!-- Script de création et d'envoi du formulaire -->

<script type="text/javascript">
    const container = document.getElementById("jsoneditor")
    const options = {}
    const editor = new JSONEditor(container, options)
    var variableRecuperee = <?php echo stripslashes(json_encode($doc)); ?>;
    var link_doc = <?php echo (json_encode($link_doc)); ?>;

    /* Création du formulaire */

    const initialJson = variableRecuperee;
    editor.set(initialJson);
    editor.expandAll();

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

<?php
//Bouton de retour
echo '<div id="nav_view float-left">';
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
		echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.$page.'"><button class="return btn btn-primary">< list of docs</button></a>';
	}
echo '</div>';
?>

<!-- Fin du formulaire mode édition JsonEditor -->
<div  id="getJson_content">
	<button class="btn btn-success" id="getJSON">Save</button>
</div>

</div>

<!-- footer -->
<br><br>
<?php
	require_once('layouts/footer.php')
?>

   <!-- footer -->


</body>
</html>

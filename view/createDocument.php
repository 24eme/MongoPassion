<!doctype html>
<html lang="fr">
<head>
	<title>Create Document</title>

	<?php require_once('header.php') ?>
</head>

<body>

<?php include('breadcrumb.php'); ?>

<?php
//Titre de la page

echo '<h1 class = "title text-center font-weight-bold"><i class="fa fa-fw fa-book"></i> New Document</h1>';

//Fin titre de la page
if(isset($_GET['msg'])){

  echo '<div id="cacherAlert" class="text-center alert col-lg-8 offset-lg-2 alert-danger alert-dismissible fade show" role="alert">';
   echo $_GET['msg'];
  echo '<button type="button" class="close" onclick="cacherAlert()" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>';
  echo '</div>';


}

//Bouton de retour

echo '<div id="nav_view">';
	if(isset($s_g)){
	 	echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'"><button class="return btn btn-primary">< Collection</button></a>';
	}
	else{
	 	echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><button class="return btn btn-primary">< Collection</button></a>';
	}
echo '</div>';
?>

<!-- Fin du bouton de retour -->


<!-- Bouton switch JsonEditor -->

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

<!-- Fin du bouton switch JsonEditor -->


<!-- Zone de texte -->

<div id="DivContentTable">
	<?php
	if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
		echo '<div id="main" class="creatDocDiv" style="display: block">';
	} else {
		echo '<div id="main" class="creatDocDiv" style="display: none">';
	}
	?>
		<?php
			$link_doc = 'index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'';
		 	$doc = array();
		 	$doc['example_field']='content[...]';
		    if(isset($_GET['doc_text'])){
		 		$docs= $_GET['doc_text'];
		 		$docs = json_decode($docs);
		 		$docs = $docs->data;
			} else {
		 		$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
		    }
		 	echo '<form method="post" action="index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'">';
		 	echo '<div id="create_content"><input type="submit" class="btn btn-primary" name="create" id="create" value="Create"></div>';
		 	echo '<div id="doc_content"><textarea class="col-lg-8 offset-lg-2" name="doc_text" id="doc_text" rows="20" cols="200" style="height: 750px;" required>'.$docs.'</textarea></div>';
		 	echo '</form>';
		?>
	</div>
</div>

<!-- Fin de la zone de texte -->


<!-- Formulaire mode édition JsonEditor -->

<!-- Affichage du formulaire -->

<div id="DivContentTable">
	<?php
	if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
		echo '<div id="json"  style="display: none;">';
	} else {
		echo '<div id="json"  style="display: block;">';
	}
	?>
	     <div id="create_content">
	     	<button class="btn btn-primary" id="create">Create</button>
	    </div>
	     <span id="nC"></span>
	 <div id="DivContentTable">
		<div id="jsoneditor" class="col-lg-8 offset-lg-2" style="height: 750px;"></div>
	 </div>

	</div>
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

<!-- Fin du formulaire mode édition JsonEditor -->


<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->


</body>
</html>
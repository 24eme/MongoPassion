<!doctype html>
<html lang="fr">
	<head>
		<title>Create Document</title>
		<?php require_once('layouts/header.php') ?>
	</head>

	<body>

		<?php include('layouts/breadcrumb.php'); ?>

		<div class="container">

		<?php

		//Titre de la page

		echo '<h1 class = "title text-center font-weight-bold"><i title="Create new document" class="fa fa-file-text-o"></i> New Document</h1>';

		//Fin titre de la page


		// alert message  d'erreur
		if(isset($_GET['msg'])){

		  echo '<div id="cacherAlert" class="text-center alert col-lg-8 offset-lg-2 alert-danger alert-dismissible fade show" role="alert">';
		   echo $_GET['msg'];
		  echo '<button type="button" class="close" onclick="cacherAlert()" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>';
		  echo '</div>';

		}
		// fin alert message  d'erreur

		?>

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

		</div>

		<!-- Zone de texte -->


		<?php include('layouts/createDocument/zoneTextareaInCreateDocument.php'); ?>


		<!-- Fin de la zone de texte -->


		<!-- Formulaire mode édition JsonEditor -->

		<!-- Affichage du formulaire jsonEdition -->

		<?php if($jsoneditor){?>
			<div id="DivContentTable">
				<?php
					if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
						echo '<div id="json" class="createDoc" style="display: none;">';
					} else {
						echo '<div id="json" class="createDoc" style="display: block;">';
					}
				?>
						     <div id="create_content">
						     	<button class="btn btn-primary" id="getJSON" style="background-color: #4CAF50;border:none; margin-left: auto; margin-right: 350px;">Create</button>
						    </div>
						     <span id="nC"></span>
						 	<div id="DivContentTable">
								<div id="jsoneditor" class="col-lg-8 offset-lg-2" style="height: 750px;"></div>
							</div>
						 	<div id="create_content">
						    	<button class="btn btn-primary" id="getJSON2" style="background-color: #4CAF50;border:none; margin-left: auto; margin-right: 350px;">Create</button>
						 	</div>
				    </div>

		 <!-- fin Affichage du formulaire JsonEdition -->



			</div>
		<?php }?>



		<!-- Script de création et d'envoi du formulaire -->

		<?php include('layouts/scriptOfCreateFormModeJsonEdition.php'); ?>

		<!-- Fin du formulaire mode édition JsonEditor -->


		<div class="container">

		<?php

		//Bouton de retour

		echo '<div id="nav_view float-left">';
			if(isset($s_g)){
			 	echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'"><button class="return btn btn-primary">< list of docs</button></a>';
			}
			else{
			 	echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><button class="return btn btn-primary">< list of docs</button></a>';
			}
		echo '</div>';
		?>

		<!-- Fin du bouton de retour -->



		</div>

		<!-- footer -->

		<?php 
			require_once('layouts/footer.php')
		?>

		   <!-- footer -->


	</body>
</html>
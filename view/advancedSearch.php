<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>MongoDoAllCRUDAdvanced Search</title>"?>
	<?php require_once('header.php') ?>
</head>

<body>

<?php include('breadcrumb.php'); ?>

<div id="advancedSearch">

<?php

//Préparation des variables de recherche pour leur utilisation en JS

if(isset($a_s)){
	echo '<p id="clé" style="display: none">a_s</p>';
	?>
	<input type=hidden id=valeur value=<?php echo urlencode($a_s); ?>>
	<?php
}

//Fin de la préparation des variables de recherche pour leur utilisation en JS

?>

<!-- Titre de la page -->

<h1 class = "title font-weight-bold" align="center"><i title="title of search" class="fa fa-fw fa-search"></i>
    <?php echo (isset($a_s)) ? 'Search results' : 'Advanced Search' ?>
</h1>

<!-- Fin du titre de la page -->


<!-- Partie recherche -->

<div class="mt-1 col-lg-8">
	<?php if ($flash_error): ?>
	<div class="alert alert-danger">
		<?php echo $flash_error; ?>
	</div>
  <?php endif; ?>
	<?php echo '<form action="'.$link_search.'">';
		echo '<label>Execute a query in '.$coll.':</label>'; ?>
		<input type="hidden" name="action" value="advancedSearch">
		<?php echo'<input type="hidden" name="serve" value='.$serve.'>';
		echo'<input type="hidden" name="db" value='.$db.'>';
		echo'<input type="hidden" name="coll" value='.$coll.'>'; ?>
		<?php if(isset($a_s)){
			echo '<textarea name="a_s" id="a_s" rows="5" cols="100" autofocus="autofocus">'.$a_s.'</textarea>';
		}
		else{
			echo '<textarea name="a_s" id="a_s" rows="5" cols="100" autofocus="autofocus">db.'.$coll.'.find({})</textarea>';
		} ?>
		<input type="submit" class="btn btn-success float-right" value="Execute">

	</form>
		<?php echo '<button class="btn bg-secondary float-right mr-2"><a class="text-light" href="'.$link_reinit.'"><i title="reset" class="fa fa-fw fa-remove"></i></a></button>'; ?> 
			
	
</div>

<!-- Fin de la partie recherche -->


<!-- Tableau des résulats -->

<?php if(isset($a_s)){?>
	<div id="DivContentTable">
			<div id='result' class="col-lg-8">
				<div id="head_content">
					<?php echo '<h5 align="center">Search results '.(1+(($page-1)*$bypage)).'-';
								if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
								else{echo $nbDocs;}
								echo ' of '.$nbDocs.' :</h5>'?>
					<div class="dropdown">
					  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  <i class="text-light fa fa-fw fa-download"></i>
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <button class="dropdown-item" <?php if (!isset($docs)): ?>disabled=disabled<?php endif; ?> id="export_csv" href="#">CSV</button>
					    <button class="dropdown-item" <?php if (isset($docs)): ?>disabled=disabled<?php endif; ?>  id="export_json" href="#">JSON</button>
					  </div>
					</div>
				</div>
				<table class="table table-sm table-striped">
					<?php if(empty($result)){
						echo '<p align="center">No document matches your search</p>';
					}
					else{
					?>
						<?php
						if(isset($docs)){
							$export_json = "";
							echo '<tr>';
							foreach ($docs[0] as $key => $value) {
								echo '<th>'.$key.'</th>';
							}
							echo '</tr>';
							foreach ($docs as $entry) {
								$link_v = '?action=editDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$entry['_id'].'&type_id='.gettype($entry['_id']).'&a_s='.urlencode($a_s).'&page='.$page;
								echo '<tr>';
								foreach ($entry as $value) {
									echo '<td><a href="'.$link_v.'">'.$value.'</a></td>';
								}
								echo '</tr>';
							}
						}
						else{
							$export_json = "[";
							foreach ($result as $entry) {
								$link_v = '?action=editDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$entry['_id'].'&type_id='.gettype($entry['_id']).'&a_s='.urlencode($a_s).'&page='.$page;
								$content = array();
								foreach ($entry as $x => $x_value) {
									if(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\ObjectId'){
							 			$value = $x_value;
							 		}
							 		elseif(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\UTCDateTime'){
							 			$value = $x_value->toDateTime();
							 		}
							 		else{
							 	  		$value = printable($x_value);
							 		}
							 		$content[$x] =  improved_var_export($value);
								}
								$content = init_json($content);
								$json_exp = json_encode($content);
								unset($content['_id']);
					 			$json = stripslashes(json_encode($content));
					 			$export_json = $export_json.$json_exp.',';
								echo '<tr><td class="classic"><a class="text-success text-center" href="'.$link_v.'"><i title="id of document"class="text-dark fa fa-fw fa-file"></i>'.$entry['_id'].'</a></td>';
								echo '<td id="json" class="text-left">'.substr($json, 0, 100).'';
								if(strlen($json)>100){echo ' [...] }';}
								echo '</td>';
								echo '</tr>';
							}
							$export_json = substr($export_json, 0, -1);
							$export_json = $export_json.']';
						}
					} 
					?>
				</table>
				<div style="width: 100%;">

				<!-- Pagination -->

				<nav aria-label="pagination" style="width: 16%; margin: auto; padding-left: 0;">
			        <ul class="pagination">
			        <?php
			            if($page!=1){
			            	echo '<a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page-1).'&bypage='.$bypage.'&a_s='.urlencode($a_s).'" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>';
			            }
			            else{
			            	echo '<span id="prev"><span aria-hidden="true">&laquo;</span></span>';
			            } ?>

			            <span id="radio" class="text-center font-weight-bold">
                                <select id="select_pagination" name="bypage" onchange="bypage_search(this)">
                                <?php foreach([10, 20, 30, 50] as $nb) : ?>
                                  <option value="<?= $nb ?>" <?= ($bypage == $nb) ? 'selected="selected"': '' ?>><?= $nb ?></option>
                                <?php endforeach ?>
                                </select>
						</span>

			            <?php if($page!=$nbPages){
			            	echo '<a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page+1).'&bypage='.$bypage.'&a_s='.urlencode($a_s).'" id="next" aria-current="page"><span aria-hidden="true">&raquo;</span></a>';
			            }
			            else{
			            	echo '<span id="next"><span aria-hidden="true">&raquo;</span></span>';
			            }
			        ?>
			        </ul>
			    </nav>

			    <!-- Fin de la pagination -->

			</div>
			</div>
</div>
	<br>
<?php } ?>


<!-- Fin du tableau des résultats -->


<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->

</body>
</html>

<script type="text/javascript">

	function download_json()
  {
  	var element = document.createElement('a');
  	var random = (Math.floor(Math.random() * Math.floor(100000000))).toString(16);
  	var filename = "json_"+random+".json";
  	var text = '<?php echo $export_json; ?>';
  	var jsonPretty = JSON.stringify(JSON.parse(text),null,2);
  	element.setAttribute('href', 'data:application/json;charset=utf-8,' + encodeURIComponent(jsonPretty));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
  }

	// Export CSV
  function download_csv(csv, filename) {
      var csvFile;
      var downloadLink;

      // CSV FILE
      csvFile = new Blob([csv], {type: "text/csv"});

      // Download link
      downloadLink = document.createElement("a");

      // File name
      downloadLink.download = filename;

      // We have to create a link to the file
      downloadLink.href = window.URL.createObjectURL(csvFile);

      // Make sure that the link is not displayed
      downloadLink.style.display = "none";

      // Add the link to your DOM
      document.body.appendChild(downloadLink);

      // Lanzamos
      downloadLink.click();
  }

  function export_table_to_csv(html, filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");

      for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll("td, th");

          for (var j = 0; j < cols.length; j++)
              row.push(cols[j].innerText);

      csv.push(row.join(","));
    }

      // Download CSV
      download_csv(csv.join("\n"), filename);
  }

  document.querySelector("#export_csv").addEventListener("click", function () {
  	var random = (Math.floor(Math.random() * Math.floor(100000000))).toString(16);
    var html = document.querySelector("table").outerHTML;
    export_table_to_csv(html, "result_"+random+".csv");
  });

  document.querySelector("#export_json").addEventListener("click", download_json);

  // Fin de l'export CSV

</script>

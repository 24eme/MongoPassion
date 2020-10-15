<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Advanced Search</title>"?>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/advancedSearch.css" rel="stylesheet" type="text/css">
	<link href="public/css/pagination.css" rel="stylesheet" type="text/css">

 	<script src="public/js/radio.js"></script>
</head>

<body>

<?php

//Fil d'Ariane

echo "<div  class='container border-top  border-success bg-success col-lg-8 sticky-top'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($serve)){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$serve.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i class="fa fa-fw fa-desktop"></i>'.$serve.'</a></li>';
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

<?php
	if(isset($a_s)){
		echo '<h1 class = "title font-weight-bold" align="center"><i class="fa fa-fw fa-search"></i>Search results for "'.$a_s.'"</h1>';
	}
	else{
?>
<h1 class='title font-weight-bold'align="center"><i class="fa fa-fw fa-search"></i>Advanced Search</h1>
<?php } ?>

<!-- Fin du titre de la page -->


<!-- Partie recherche -->

<div class="mt-1">
	<?php echo '<form method="post" action="'.$link_search.'">';
		echo '<label for="a_s">Execute a query in '.$coll.':</label>';
		if(isset($a_s)){
			echo '<textarea name="a_s" id="a_" rows="5" cols="100">'.$a_s.'</textarea>';
		}
		else{
			echo '<textarea name="a_s" id="a_" rows="5" cols="100">db.'.$coll.'.find({})</textarea>';
		} ?>
		<input type="submit" class="btn btn-success float-right" name="a_search" id="a_search" value="Execute">
	
	</form>
		<?php echo '<button class="btn bg-secondary float-right mr-2"><a class="text-light" href="'.$link_reinit.'"><i class="fa fa-fw fa-history"></i></a></button>'; ?> 
			
	
</div>

<!-- Fin de la partie recherche -->


<!-- Tableau des résulats -->

<?php if(isset($a_s)){?>
	<div id='result'>
		<?php echo '<h5>Search results for "'.$a_s.'" ('.(1+(($page-1)*$bypage)).'-';
					if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
					else{echo $nbDocs;}
					echo ' of '.$nbDocs.') :</h5>'?>
		<?php if(!empty($result)){ ?>
		<button id="test_csv"><i class="text-light fa fa-fw fa-download"></i></button>
	<?php } ?>
		<table class="table table-sm table-striped">
			<?php if(empty($result)){
				echo '<p align="center">No document matches your search</p>';
			}
			else{
			?>
				<?php
				if(isset($docs)){
					echo '<tr>';
					foreach ($docs[0] as $key => $value) {
						echo '<th>'.$key.'</th>';
					}
					echo '</tr>';
					foreach ($docs as $entry) {
						$link_v = '?action=viewDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$entry['_id'].'&type_id='.gettype($entry['_id']).'&a_s='.urlencode($a_s).'&page='.$page;
						echo '<tr>';
						foreach ($entry as $value) {
							echo '<td><a href="'.$link_v.'">'.$value.'</a></td>';
						}
						echo '</tr>';
					}
				}
				else{
					foreach ($result as $key=>$entry) {
						$link_v = '?action=viewDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$entry['_id'].'&type_id='.gettype($entry['_id']).'&a_s='.urlencode($a_s).'&page='.$page;
						echo '<tr><td><a href="'.$link_v.'">'.$entry['_id'].'</a></td></tr>';
					}
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
	            	echo '<a href="" id="prev"><span aria-hidden="true">&laquo;</span></a>';
	            } ?>

	            <span id="radio" class="text-center font-weight-bold">
					<select name="bypage" onchange="bypage_search()">
					    <option value="10" id="10" <?php if($bypage==10){echo 'selected="selected"';}?>>10</option>
					    <option value="20" id="20" <?php if($bypage==20){echo 'selected="selected"';}?>>20</option>
					    <option value="30" id="30" <?php if($bypage==30){echo 'selected="selected"';}?>>30</option>
					    <option value="50" id="50" <?php if($bypage==50){echo 'selected="selected"';}?>>50</option>
					</select>
				</span>

	            <?php if($page!=$nbPages){
	            	echo '<a href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page+1).'&bypage='.$bypage.'&a_s='.urlencode($a_s).'" id="next" aria-current="page"><span aria-hidden="true">&raquo;</span></a>';
	            }
	            else{
	            	echo '<a href="" id="next"><span aria-hidden="true">&raquo;</span></a>';
	            }
	        ?>
	        </ul>
	    </nav>

	    <!-- Fin de la pagination -->

	</div>
	</div>
<?php } ?>


<!-- Fin du tableau des résultats -->

</body>
</html>

<script type="text/javascript">
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

  document.querySelector("#test_csv").addEventListener("click", function () {
  	var random = (Math.floor(Math.random() * Math.floor(100000000))).toString(16);
    var html = document.querySelector("table").outerHTML;
    export_table_to_csv(html, "result_"+random+".csv");
  });
</script>
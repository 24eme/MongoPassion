<?php
		foreach ($result as $entry) {
			$doc=array();
			$date_array=array();
		    foreach($entry as $x => $x_value) {
		 		if(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\ObjectId'){
		 			$value = $x_value;
		 		}
		 		elseif(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\UTCDateTime'){
		 			$value = $x_value->toDateTime();
		 			$date_array[$x]=intval((string)$x_value);
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
	 	
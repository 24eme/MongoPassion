<table class="table table-sm table-striped">
		<?php if(empty($result)){
			echo '<p align="center">No document matches your search</p>';
		}
		else{
			if(isset($docs)){
				echo '<tr>';
				foreach ($docs[0] as $key => $value) {
					echo '<th class="text-left">'.$key.'</th>';
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
				$link_csv = '?action=export&serve='.$serve.'&db='.$db.'&form=csv&req='.urlencode($a_s).'&ret='.urlencode($current_query);
			}
			else{
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
					unset($content['_id']);
		 			$json = stripslashes(json_encode($content));
					echo '<tr><td class="classic"><a class="text-success text-center" href="'.$link_v.'"><i title="id of document"class="text-dark fa fa-file-text-o"></i>'.$entry['_id'].'</a></td>';
					echo '<td id="json" class="text-left">'.substr($json, 0, 100).'';
					if(strlen($json)>100){echo ' [...] }';}
					echo '</td>';
					echo '</tr>';
				}
				$link_json = '?action=export&serve='.$serve.'&db='.$db.'&form=json&req='.urlencode($a_s).'&ret='.urlencode($current_query);
			}
		}
		?>
</table>
<table class="table table-sm table-striped">
	<?php if(empty($result)){ ?>
		<p align="center">No document matches your search</p>
	<?php }
	else{ 
		if(isset($docs)){ ?>
			<tr>
				<?php foreach ($docs[0] as $key => $value) { ?>
					<th class="text-left"><?php echo $key ?></th>
				<?php } ?>
			</tr>
			<?php foreach ($docs as $entry) { 
				$link_v = '?action=editDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$entry['_id'].'&type_id='.gettype($entry['_id']).'&a_s='.urlencode($a_s).'&page='.$page; ?>
				<tr>
					<?php foreach ($entry as $value) { ?>
						<td><a href="<?php echo $link_v ?>"><?php echo $value ?></a></td>
					<?php } ?>
				</tr>
			<?php }
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
				$json = stripslashes(json_encode($content)); ?>
				<tr>
					<td class="classic"><a class="text-success text-center" href="'.$link_v.'"><i title="id of document"class="text-dark  fa fa-file-text-o"></i><?php echo $entry['_id'] ?></a></td>
					<td id="json" class="text-left"><?php echo substr($json, 0, 100) ?>
					<?php if(strlen($json)>100){echo ' [...] }';} ?>
					</td>
				</tr>
			<?php }
			$link_json = '?action=export&serve='.$serve.'&db='.$db.'&form=json&req='.urlencode($a_s).'&ret='.urlencode($current_query);
		}
	}?>
</table>
<?php

function getManager($serve)
{
	$manager = new MongoDB\Driver\Manager('mongodb://'.$serve.'');
	return $manager;
}

function getClient($serve)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$serve.'');
	return $client;
}

function getAuthClient($serve,$user,$passwd,$auth_db){
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$user.':'.$passwd.'@'.$serve.'/'.$auth_db.'');
	return $client;
}

function formatResult($result)
{
	$result_format = array();

	foreach ($result as $document) {
		array_push($result_format, (array) $document);
	}

	return $result_format;
}

function toJSON($cursor){
	$docs_array = array();
	foreach ($cursor as $entry) {
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
		array_push($docs_array, $docs);
	}
	return $docs_array;
}

function testProjection($search,$serve,$db)
{
	$manager = getManager($serve);

	$jscode = $search;

	$command = new MongoDB\Driver\Command(['eval'=>$jscode]);

	$cursor = $manager->executeCommand($db, $command)->toArray();

	$temp = (array) $cursor[0];
	$test = (array) $temp['retval'];

	$fields = (array) $test['_fields'];

	if(empty($fields)){
		return false;
	}

	else{
		return true;
	}

}

function getDocument($doc,$type_id,$coll,$db,$serve)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;

	if(isset($type_id)){
		if($type_id=='object'){
			$id = new MongoDB\BSON\ObjectId($doc);
		}
		else{
			$id = $doc;
		}
	}
	else{
		try{
			$id = new MongoDB\BSON\ObjectId($doc);
		}
		catch (Exception $e){
			$id = $doc;
		}
	}

	$result = $collection->find(['_id'=>$id]);
	return $result;
}

function improved_var_export ($variable) {
	$send = $variable;
    if($variable instanceof stdClass){
    	$sendable=false;
    	while ($sendable==false) {
    		$send = array();
    		if(empty((array) $variable)){
    			$sendable=true;
    		}
    		else{
	    		foreach ($variable as $key => $value) {
		    		$send[$key]=improved_var_export($value);
	    			$sendable=true;
	    		}
	    	}
    	}
    }
    if(gettype($variable)=='array'){
    	foreach ($variable as $key => $value) {
    			$send[$key]=improved_var_export($value);
    			$sendable=true;
    	}
    }
    $sendable=true;
	return $send;
}

function printable($obj){
	$print = $obj;
	if(gettype($obj)=='object'){
		if(get_class($obj)=='MongoDB\Model\BSONDocument'){
			$printable=false;
			while($printable==false){
				$print = array();
				foreach($obj as $x => $x_value) {
					$print[$x]=printable($x_value);
					$printable=true;
				}
			}
		}		
		$docs = json_encode($print);
		$print = json_decode($docs);
	}
	$printable=true;
	return $print;
}

function getColor($num) {
	$doc = $num;
	if(gettype($num)=='array'){
		$doc=array();
		foreach ($num as $key => $value) {
			$doc[$key]=getColor($value);
		}
	}
	elseif(gettype($num)=='object'){
		$doc=$num;
	}
	else{
		$doc = "<font color='#62a252'>$num</font>";
	}
	return $doc;
}

function getLink_doc($search_db,$a_s,$s_g,$doc,$type_id,$coll,$db,$serve,$page)
{
	if(isset($s_g)){
		$link_doc='index.php?action=traitement_uD&serve='.$serve.'&db='.$db.'&coll='.$coll.'&id='.$doc.'&type_id='.$type_id.'&s_g='.urlencode($s_g).'&page='.$page;
	}
	elseif(isset($a_s)){
		$link_doc='index.php?action=traitement_uD&serve='.$serve.'&db='.$db.'&coll='.$coll.'&id='.$doc.'&type_id='.$type_id.'&a_s='.urlencode($a_s).'&page='.$page;
	}
	elseif(isset($search_db)){
		$link_doc='index.php?action=traitement_uD&serve='.$serve.'&db='.$db.'&coll='.$coll.'&id='.$doc.'&type_id='.$type_id.'&search_db='.urlencode($search_db).'&page='.$page;
	}
	else{
		$link_doc='index.php?action=traitement_uD&serve='.$serve.'&db='.$db.'&coll='.$coll.'&id='.$doc.'&type_id='.$type_id.'&page='.$page;
	}
	return $link_doc;
}


function searchError_doc_id()
{
	$error_id = false;

	$dec = json_decode($_POST['doc_text']);
	$test = improved_var_export($dec);

	if(htmlspecialchars($_GET['type_id'])=='object'){
		if(gettype($test['_id'])!='array'){
			$error_id = true;
		}
	}
	else{
		if($test['_id']!=htmlspecialchars($_GET['id'])){
			$error_id = true;
		}
	}
	return $error_id;
}


function getUpdate_doc($doc_text,$date_array,$up_date_array)
{
	$dec = json_decode($doc_text);
	$test = improved_var_export($dec);

	unset($test['_id']);

	$date_array = htmlspecialchars($date_array);
	$up_date_array = htmlspecialchars($up_date_array);
	if(!empty($date_array)){
		foreach ($date_array as $x=>$x_value) {
			$temp = strtotime($test[$x]['date'])*1000;
			$diff = $up_date_array[$x]-$temp;
			$time = $x_value - $diff;
			$date = new MongoDB\BSON\UTCDateTime($time);
			$test[$x] = $date;
		}
	}
	return $test;
}

function getDoc_id($doc,$type_id)
{
	if($type_id=='object'){
		$id = new MongoDB\BSON\ObjectId($doc);
	}
	else{
		$id = htmlspecialchars($doc);
	}
	return $id;
}

function updateDoc($id,$doc,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;
	$collection->updateOne(
    [ '_id' => $id ],
    [ '$set' => $doc]);
}

function init_json($doc){
	if(gettype($doc)=="array"){
		$ok=false;
		while($ok==false){
			if(empty($doc)){
				$ok=true;
			}
			else{
				foreach ($doc as $key => $value) {
					$doc[$key]=init_json($value);
					$ok=true;
				}
			}
		}
	}
	elseif (gettype($doc)=="string") {
		if(strpos($doc, "\\")!==false){
			$doc = addslashes($doc);
		}
		$ok = true;
	}
	$ok=true;
	return $doc;
}

function getDocs($page,$bypage,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;

	$skip = ($page-1)*$bypage;

	$result = $collection->find([],['skip'=>$skip,'limit'=>$bypage])->toArray();

	return $result;
}

function countDocs($serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;
	$result = $collection->count([]);
	return $result;

}

function getNew_doc($doc_text)
{
	$dec = json_decode($doc_text);
	$test = improved_var_export($dec);
	return $test;
}

function insertDoc($doc,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;

	$collection->insertOne($doc);
}

function deleteDoc($serve,$db,$coll,$doc,$type_id)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;

	if(isset($type_id)){
		if($type_id=='object'){
			$id = new MongoDB\BSON\ObjectId($doc);
		}
		else{
			$id = $doc;
		}
	}
	else{
		try{
			$id = new MongoDB\BSON\ObjectId($doc);
		}
		catch (Exception $e){
			$id = $doc;
		}
	}

	$collection->deleteOne(['_id'=>$id]);
}

function getSearch_id($search,$page,$bypage,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;

	$skip = ($page-1)*$bypage;
	
	$regex = new MongoDB\BSON\Regex ($search);
	$result1 = $collection->find(['_id'=>$regex],['skip'=>$skip,'limit'=>$bypage])->toArray();

	try{
		$test = new MongoDB\BSON\ObjectId($search);
		$result2 = $collection->find(['_id'=>$test],['skip'=>$skip,'limit'=>$bypage])->toArray();
	}
	catch(Exception $e){
		$result2 = array();
	}

	$result = array_merge($result1,$result2);

	return $result;
}

function getSearch_g($search,$page,$bypage,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;

	$skip = ($page-1)*$bypage;

	$tab_search = explode(':', $search);

	$tab_find = array();

	foreach ($tab_search as $x) {
		$y = trim($x);
		array_push($tab_find, $y);
	}

	$result = $collection->find([$tab_find[0] => $tab_find[1]],['skip'=>$skip,'limit'=>$bypage])->toArray();


	return $result;
}

function getSearch($search_g,$page,$bypage,$serve,$db,$coll){
	if ($search_g !=='') {
		$tab_search = explode(':', $search_g);
		if (count($tab_search) === 2) {
			$key = $tab_search[0];
			$value = $tab_search[1];
		} else {
			$key = '_id';
			$value = $tab_search[0];
		}
		$key = trim($key);
		$value = trim($value);
		if ($key === '_id') {
			$result = getSearch_id($value,$page,$bypage,$serve,$db,$coll);
		} else {
			$result = getSearch_g($search_g,$page,$bypage,$serve,$db,$coll);
		}
	}

	return $result;

}

function getSpecialSearch($command,$page,$bypage)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.htmlspecialchars($_GET['serve']).':27017');
	$db = strval(htmlspecialchars($_GET['db']));
	$collec = strval(htmlspecialchars($_GET['coll']));
	$collection = $client->$db->$collec;

	$skip = ($page-1)*$bypage;

	$command=str_replace(')', '', $command);

	$command = '$result = $collection->'.$command.', [\'skip\'=>$skip,\'limit\'=>$bypage] )->toArray();';

	eval(strip_tags(htmlspecialchars_decode($command)));

	return $result;
}

function getAdvancedSearch($search,$page,$bypage,$serve,$db,$coll)
{
	$manager = getManager($serve);

	$skip = ($page-1)*$bypage;

	$jscode=$search;

	$command = new MongoDB\Driver\Command(['eval'=>$jscode]);

	$cursor = $manager->executeCommand($db, $command)->toArray();

	$temp = (array) $cursor[0];
	$test = (array) $temp['retval'];
	$ns = $test['_ns'];
	$filter = (array) $test['_query'];
	$fields = (array) $test['_fields'];

	$options = ['projection'=>$fields,'skip'=>$skip,'limit'=>$bypage];

	$query = new \MongoDB\Driver\Query($filter, $options);
	$rows   = $manager->executeQuery($ns, $query)->toArray();

	$rows = formatResult($rows);

	return $rows;
}

function getNbPages($result,$pages)
{
	$temp = $result/$pages;
	if(intval($temp)==$temp){
		$nb=$temp;
	}
	else{
		$nb = intval($result/$pages)+1;
	}
	return $nb;
}

function getNbPages_search($result,$pages){
	$nb = intval(sizeof($result)/$pages)+1;
	return $nb;
}

function countSearch_id($search,$serve,$db,$coll){
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;
	
	$regex = new MongoDB\BSON\Regex ($search);
	$result1 = $collection->count(['_id'=>$regex]);

	try{
		$test = new MongoDB\BSON\ObjectId($search);
		$result2 = $collection->count(['_id'=>$test]);
	}
	catch(Exception $e){
		$result2 = 0;
	}

	$result = $result1+$result2;

	return $result;
}

function countAdvancedSearch($search,$serve,$db,$coll)
{
	$manager = getManager($serve);

	$jscode = str_replace('find', 'count', $search);

	$command = new MongoDB\Driver\Command(['eval'=>$jscode]);

	$cursor = $manager->executeCommand($db, $command)->toArray();

	$temp = (array) $cursor[0];
	$test = $temp['retval'];

	return $test;
}

function countSearch_g($search,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$db = strval($db);
	$collec = strval($coll);
	$collection = $client->$db->$collec;

	$tab_search = explode(':', $search);

	$tab_find = array();

	foreach ($tab_search as $x) {
		$y = trim($x);
		array_push($tab_find, $y);
	}

	$result = $collection->count([$tab_find[0] => $tab_find[1]]);


	return $result;
}
 
function countSearch($search_g,$serve,$db,$coll)
{
	if ($search_g !=='field : content[...]') {
		$tab_search = explode(':', $search_g);
		if (count($tab_search) === 2) {
			$key = $tab_search[0];
			$value = $tab_search[1];
		} else {
			$key = '_id';
			$value = $tab_search[0];
		}
		$key = trim($key);
		$value = trim($value);
		if ($key === '_id') {
			$result = countSearch_id($value,$serve,$db,$coll);
		} else {
			$result = countSearch_g($search_g,$serve,$db,$coll);
		}
	}

	else{
		if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
			$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
		}
		else{
			$client = getClient($serve);
		}
		$db = strval($db);
		$collec = strval($coll);
		$collection = $client->$db->$collec;

		$tab_search = explode('=', $search_g);

		$tab_find = array();

		foreach ($tab_search as $x) {
			$y = trim($x);
			array_push($tab_find, $y);
		}

		$regex = new MongoDB\BSON\Regex ($search_id);
		$result1 = $collection->count(['_id'=>$regex,$tab_find[0] => $tab_find[1]]);

		try{
			$test = new MongoDB\BSON\ObjectId($search_id);
			$result2 = $collection->count(['_id'=>$test,$tab_find[0] => $tab_find[1]]);
		}
		catch(Exception $e){
			$result2 = 0;
		}

		$result = $result1 + $result2;
	}

	return $result;
}

function getCollections($serve,$db)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$database = $client->$db;

	$result = $database->listCollections();
	
	return $result;
}

function getSearch_db($search,$db,$serve)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}
	$database = $client->$db;

	$collections = $database->listCollections();

	$result = array();

	foreach ($collections as $collectionInfo) {
		$coll = strval($collectionInfo['name']);
		$collection = $database->$coll;
		try{
			$test = new MongoDB\BSON\ObjectId($search);
			$result_temp = $collection->find(['_id'=>$test])->toArray();
		}
		catch(Exception $e){
			$result_temp = $collection->find(['_id'=>$search])->toArray();
		}
		$result[$coll] = $result_temp;
	}

	return $result;
}

function getDbs($serve,$user=null,$passwd=null,$auth_db=null)
{
	if(isset($user) and isset($passwd) and isset($auth_db)){
		$client = getAuthClient($serve,$user,$passwd,$auth_db);
	}
	else{
		$client = getClient($serve);
	}
	$result = $client->listDatabases();

	return $result;
}

function renameCollec($newName,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}

	$database = $client->admin;

	$database->command(array('renameCollection'=>$db.'.'.$coll,'to'=>$db.'.'.$newName));
}

function createCollec($name,$serve,$db)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}

	$db = strval($db);

	$database = $client->$db;

	$database->createCollection($name);
}

function deleteColl($serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}

	$db = strval($db);

	$database = $client->$db;

	$database->dropCollection(htmlspecialchars($coll));
}


function moveCollec($newdb,$serve,$db,$coll)
{
	if(isset($_COOKIE['user']) and isset($_COOKIE['passwd']) and isset($_COOKIE['auth_db'])){
		$client = getAuthClient($serve,$_COOKIE['user'],$_COOKIE['passwd'],$_COOKIE['auth_db']);
	}
	else{
		$client = getClient($serve);
	}

	$database = $client->admin;

	$database->command(array('renameCollection'=>$db.'.'.$coll,'to'=>$newdb.'.'.$coll));
}

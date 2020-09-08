<?php

function getDocument()
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;

	// $documents = $client->$db->request("db.getCollection(".$collection.").find(".$requete")";

	if($_GET['type_id']=='object'){
		$id = new MongoDB\BSON\ObjectId($_GET['doc']);
	}
	else{
		$id = $_GET['doc'];
	}

	$_SESSION['doc'] = $_GET['doc'];

	$result = $collection->find(['_id'=>$id]);
	return $result;
}

function improved_var_export ($variable) {
	$send = $variable;
    if($variable instanceof stdClass){
    	$sendable=false;
    	while ($sendable==false) {
    		$send = array();
    		foreach ($variable as $key => $value) {
    			$send[$key]=improved_var_export($value);
    			$sendable=true;
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

function getLink_doc()
{
	if(isset($_GET['search'])){
		$link_doc='index.php?action=traitement_uD&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&id='.$_GET['doc'].'&type_id='.$_GET['type_id'].'&search=&s_id='.$_GET['s_id'].'&s_g='.$_GET['s_g'].'&page='.$_GET['search'];
	}
	else{
		$link_doc='index.php?action=traitement_uD&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&id='.$_GET['doc'].'&type_id='.$_GET['type_id'];
	}
	return $link_doc;
}


function searchError_doc_id()
{
	$error_id = false;

	$dec = json_decode($_POST['doc_text']);
	$test = improved_var_export($dec);

	if($_GET['type_id']=='object'){
		if(gettype($test['_id'])!='array'){
			$error_id = true;
		}
	}
	else{
		if($test['_id']!=$_GET['id']){
			$error_id = true;
		}
	}
	return $error_id;
}


function getUpdate_doc()
{
	$dec = json_decode($_POST['doc_text']);
	$test = improved_var_export($dec);

	unset($test['_id']);

	$date_array = unserialize($_POST['date_array']);
	$up_date_array = unserialize($_POST['up_date_array']);
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

function getDoc_id()
{
	if($_GET['type_id']=='object'){
		$id = new MongoDB\BSON\ObjectId($_GET['id']);
	}
	else{
		$id = $_GET['id'];
	}
	return $id;
}

function updateDoc($id,$doc)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;
	$collection->updateOne(
    [ '_id' => $id ],
    [ '$set' => $doc]);
}

function init_json($doc){
	if(gettype($doc)=="array"){
		$ok=false;
		while($ok==false){
			foreach ($doc as $key => $value) {
				$doc[$key]=init_json($value);
				$ok=true;
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

function getDocs($page,$bypage)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;

	$skip = ($page-1)*$bypage;

	$result = $collection->find([],['skip'=>$skip,'limit'=>$bypage])->toArray();

	return $result;
}

function countDocs()
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;
	$result = $collection->count([]);
	return $result;

}

function getNew_doc()
{
	$dec = json_decode($_POST['doc_text']);
	$test = improved_var_export($dec);
	return $test;
}

function insertDoc($doc)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;

	$collection->insertOne($doc);
}

function deleteDoc()
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;

	if($_GET['type_id']=='object'){
		$id = new MongoDB\BSON\ObjectId($_GET['doc']);
	}
	else{
		$id = $_GET['doc'];
	}

	$collection->deleteOne(['_id'=>$id]);
}

function getSearch_id($search,$page,$bypage){
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
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

function getSearch_g($search,$page,$bypage){
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;

	$skip = ($page-1)*$bypage;

	$tab_search = explode('=', $search);

	$tab_find = array();

	foreach ($tab_search as $x) {
		$y = trim($x);
		array_push($tab_find, $y);
	}

	$result = $collection->find([$tab_find[0] => $tab_find[1]],['skip'=>$skip,'limit'=>$bypage])->toArray();


	return $result;
}

function getSearch($search_id,$search_g,$page,$bypage){

	if($search_id == ''){

		$result = getSearch_g($search_g,$page,$bypage);
	}

	elseif($search_g=='field = content[...]'){
		$result = getSearch_id($search_id,$page,$bypage);;
	}

	else{

		require 'vendor/autoload.php';
		$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
		$db = strval($_GET['db']);
		$collec = strval($_GET['coll']);
		$collection = $client->$db->$collec;

		$skip = ($page-1)*$bypage;

		$tab_search = explode('=', $search_g);

		$tab_find = array();

		foreach ($tab_search as $x) {
			$y = trim($x);
			array_push($tab_find, $y);
		}

		$regex = new MongoDB\BSON\Regex ($search_id);
		$result1 = $collection->find(['_id'=>$regex,$tab_find[0] => $tab_find[1]],['skip'=>$skip,'limit'=>$bypage])->toArray();

		try{
			$test = new MongoDB\BSON\ObjectId($search_id);
			$result2 = $collection->find(['_id'=>$test,$tab_find[0] => $tab_find[1]],['skip'=>$skip,'limit'=>$bypage])->toArray();
		}
		catch(Exception $e){
			$result2 = array();
		}

		$result = array_merge($result1,$result2);
	}

	return $result;

}

function getNbPages($result,$pages){
	$nb = intval($result/$pages)+1;
	return $nb;
}

function getNbPages_search($result,$pages){
	$nb = intval(sizeof($result)/$pages)+1;
	return $nb;
}

function countSearch_id($search){
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
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

function countSearch_g($search)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$db = strval($_GET['db']);
	$collec = strval($_GET['coll']);
	$collection = $client->$db->$collec;

	$tab_search = explode('=', $search);

	$tab_find = array();

	foreach ($tab_search as $x) {
		$y = trim($x);
		array_push($tab_find, $y);
	}

	$result = $collection->count([$tab_find[0] => $tab_find[1]]);


	return $result;
}


function countSearch($search_id,$search_g)
{
	if($search_id == ''){

		$result = countSearch_g($search_g);
	}

	elseif($search_g=='field = content[...]'){
		$result = countSearch_id($search_id);
	}

	else{

		require 'vendor/autoload.php';
		$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
		$db = strval($_GET['db']);
		$collec = strval($_GET['coll']);
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

function getCollections($db)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');
	$database = $client->$db;

	$result = $database->listCollections();
	
	return $result;
}

function getDbs($serve)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$serve.':27017');

	$result = $client->listDatabases();

	return $result;
}

function renameCollec($newName)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');

	$database = $client->admin;

	$database->command(array('renameCollection'=>$_GET['db'].'.'.$_GET['coll'],'to'=>$_GET['db'].'.'.$newName));
}

function createCollec($name)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');

	$db = strval($_GET['db']);

	$database = $client->$db;

	$database->createCollection($name);
}

function deleteColl()
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');

	$db = strval($_GET['db']);

	$database = $client->$db;

	$database->dropCollection($_GET['coll']);
}


function moveCollec($db)
{
	require 'vendor/autoload.php';
	$client = new MongoDB\Client('mongodb://'.$_GET['serve'].':27017');

	$database = $client->admin;

	$database->command(array('renameCollection'=>$_GET['db'].'.'.$_GET['coll'],'to'=>$db.'.'.$_GET['coll']));
}
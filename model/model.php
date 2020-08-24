<?php

function getDocument()
{
	require 'vendor/autoload.php';
	$test = "mongodb://localhost:27017";
	$client = new MongoDB\Client(strval($test));
	$collection = $client->insert_test->insert;
	$id = new MongoDB\BSON\ObjectId("5f3fa61fc8d24006841d3802");
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
	$link_doc='index.php?action=traitement_uD&id=5f3fa61fc8d24006841d3802';

	return $link_doc;
}


function updateDoc()
{
	
}
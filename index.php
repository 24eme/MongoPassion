<?php

error_reporting(E_ALL ^ E_DEPRECATED);


if(!isset($_COOKIE['serve_list'])){
	$_COOKIE['serve_list'] = json_encode(array('localhost:27017'));
}

require('controler/controler.php');

try{
    if(isset($_GET['action']))
    {
    	switch($_GET['action'])
    	{
            case 'traitement_uD':
                traitement_uD();
            break;
            case 'editDocument':
                editDocument();
            break;
            case 'getCollection':
                getCollection();
            break;
            case 'editCollection':
                editCollection();
            break;
            case 'moveCollection':
                moveCollection();
            break;
            case 'renameCollection':
                renameCollection();
            break;
            case 'deleteCollection':
                deleteCollection();
            break;
            case 'createCollection':
                createCollection();
            break;
            case 'getDb':
                getDb();
            break;
            case 'getServer':
                getServer();
            break;
            case 'getCollection_search':
                getCollection_search();
            break;
            case 'getDb_search':
                getDb_search();
            break;
            case 'createDocument':
                createDocument();
            break;
            case 'traitement_nD':
                traitement_nD();
            break;
            case 'deleteDocument':
                deleteDocument();
            break;
            case 'viewDocument':
                viewDocument();
            break;
            case 'error':
                error();
            break;
            case 'home':
                home();
            break;
            case 'advancedSearch':
                advancedSearch();
            break;
            default:
                error();
            break;
    	}
    }
    
    else
    {
    	home();
    }
}
catch(Exception $e){
    echo 'Erreur' . $e->getMessage();
}
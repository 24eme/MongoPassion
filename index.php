<?php

session_start();

require('controler/controler.php');

try{
    if(isset($_GET['action']))
    {
    	switch($_GET['action'])
    	{
            case 'traitement_uD':
                traitement_uD();
            break;
    	}
    }

    else
    {
    	editDocument();
    }
}
catch(Exception $e){
    echo 'Erreur' . $e->getMessage();
}
<?php

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_WARNING);


if(!isset($_COOKIE['serve_list'])){
	$_COOKIE['serve_list'] = json_encode(array('localhost:27017'));
}

require('controler/controler.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

try {
    if (isset($action)) {
        if (function_exists($action)) {
            $action();
        } else {
            error();
        }
    } else {
        home();
    }
} catch(Exception $e){
    echo 'Erreur' . $e->getMessage();
}

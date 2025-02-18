<?php 

use \Zuz\User;
use \Zuz\Router;
use \Zuz\Config;

$section = "signin";
if( User::isAdmin() ) {
    if ( !Router::hasParams(array('section')) ){
        header("location: " . Config::BASEURL . "cp/dashboard?redirect=1"); exit;
    }
    $section = Router::getParams()->section;    
}

include( __DIR__ . "/cover.php");
include(__DIR__ . '/admin/' . $section . '.php');
?>
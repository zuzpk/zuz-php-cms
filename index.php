<?php

/**
 * App Front. This file doesn't do anything, but loads loader.php
 */
require( __DIR__ . "/vendor/autoload.php" );
require( __DIR__ . "/plugins/stripe/vendor/autoload.php" );

if( function_exists('error_reporting') ) {
    error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR ); 
}

@ini_set( "display_errors", \Zuz\Config::DEBUG );

\Zuz\Builder::Build(array(
    'DEBUG' => 1,
    'ROUTES' => array(
        "/" => "index",
        "/u/:section" => "account",
        "/app/:id/:slug" => "apps",
        "/apps" => "apps",
        "/services" => "services",
        "/cart/:section" => "cart",
        "/cart" => "cart",
        "/profile" => "profile",
        "/my-apps" => "myapps",
        "/help/:section" => "help",
        "/team" => "team",

        "/cp/:section" => "admin",
        "/cp" => "admin",
        "/cp/dashboard" => "admin/dashboard",
        // "/help/about" => "about"
    )
));

?>

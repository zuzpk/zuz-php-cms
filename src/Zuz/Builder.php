<?php 
namespace Zuz;

use \Zuz\Config;
use \Zuz\Core;
use \Zuz\Router;

class Builder {

    public static function Build($Config = array()) {

        Core::Timer();

        @ini_set( "memory_limit", Config::MEMORY_LIMIT );
        @set_time_limit( Config::TIME_LIMIT );
        @date_default_timezone_set( Config::TIME_ZONE );        
        
        Router::Build( Core::Has( $Config, "ROUTES" ) ? $Config['ROUTES'] : array() );

    }


}

?>
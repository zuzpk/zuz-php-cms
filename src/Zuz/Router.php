<?php 
namespace Zuz;

use \Zuz\Core;

class Router {

protected static $_ROUTES = [];
protected static $_REQUEST_PARAMS = [];
protected static $_PAGE = "/";
protected static $_UI = "/";

public static $_BASEPATH = "/";

public static function setBase(){
    self::$_BASEPATH = dirname( __DIR__, 2 ) . '/';
    self::$_UI = self::$_BASEPATH . "ui/";
}

public static function getBase(){
    return self::$_BASEPATH;
}

public static function Url(){
    $HTTP = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || strtolower($_SERVER['HTTPS'] == '1')) ? 'https' : 'http');
    $PROTOCOL = $_SERVER['SERVER_PROTOCOL'];
    if(!in_array($PROTOCOL, array('HTTP/1.1','HTTP/2','HTTP/2.0'))){ $PROTOCOL = 'HTTP/1.0'; }
    return "$HTTP://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";         
}

public static function RestApi(){
    
    self::setBase();

    $urlPath = parse_url(Router::Url(), PHP_URL_PATH);
    $urlParts = explode("/", $urlPath);
    @list($xyz, $API_KEY, $API_METHOD, $API_ACTION, $API_FUNCTION) = $urlParts;

    if(
        isset($API_KEY) && 
        $API_KEY == Config::API_URL_KEY && 
        isset($API_METHOD) &&
        !empty($API_METHOD)
    ){

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        header("Content-Type: application/json; charset=UTF-8");

        $_PARAMS = [];
        if(count($urlParts) > 4){
            for($n = 4; $n < count($urlParts); $n++):
                @list($k, $v) = explode(":", $urlParts[$n]);
                $_PARAMS[$k] = $v;
            endfor;
        }
    
        self::$_REQUEST_PARAMS = Core::JSON($_PARAMS, true);

        try{

            $namespace = $API_METHOD == "u" ? "\\Zuz" : "\\App";
            $API_METHOD = $API_METHOD == "u" ? "user" : $API_METHOD;

            if(isset($API_FUNCTION)){
                $func = $namespace . "\\" . Core::CamelCase($API_ACTION) . "::" . Core::CamelCase($API_FUNCTION);
            }else{
                $func = $namespace . "\\" . Core::CamelCase($API_METHOD) . "::" . Core::CamelCase($API_ACTION);    
            }

            if(is_callable($func)){
                call_user_func($func);
            }else{
                Core::Respond(array( 'error' => true, 'message' => 'Well that was a good try. But you are not that good ;)'));
            }

		}catch(Exception $e){
			Core::Respond(array( 'error' => true, 'message' => 'Method `' . ( isset($API_ACTION) && !empty($API_ACTION) ? $API_ACTION : $API_METHOD ) . '` does not exist!'));
		} 

        exit;
    }

}

public static function getCurrentPage(){
    return self::$_PAGE;
}

public static function hasParams(array $keys = array()){
    $ps = self::$_REQUEST_PARAMS;
    if(!is_array(self::$_REQUEST_PARAMS)){
        $ps = @json_decode(@json_encode(self::$_REQUEST_PARAMS), true);
    }
    $c = 0;
    foreach($keys as $k):
        if ( array_key_exists( $k, $ps ) && !empty($ps[$k]) ){
            $c++;
        }
    endforeach;
    return $c == count($keys);
}

public static function getParams(){
    $n = is_array(self::$_REQUEST_PARAMS) ? @json_decode(@json_encode(self::$_REQUEST_PARAMS)) : self::$_REQUEST_PARAMS;
    return is_array($n) && count($n) == 0 ? (object)[] : $n;
}

public static function UI(){

    ob_start();

    $PARAMS = self::$_REQUEST_PARAMS;
    $PAGE = self::$_PAGE;
    $UI = self::$_UI;

    if( file_exists( self::$_UI . "header.php" ) ){
        include( self::$_UI . "header.php" );
    }
    if( file_exists( self::$_UI . self::$_PAGE . ".php" ) ){
        include( self::$_UI . self::$_PAGE . ".php" );
    }else{
        if ( file_exists( self::$_UI . "404.php" ) ){
            include( self::$_UI . "404.php" );
        }
        else {
            echo '<div class="error-404" style="height: 80vh;display: flex;align-items: center;justify-content: center;">
                <h2 style="font-size: 30px;font-weight: 900;border-right: 1px #000 solid;padding-right: 30px;margin-right: 30px;">404</h2>
                <p style="font-size: 24px;">Page not found.</p>
            </div>';
        }
    }
    if( file_exists( self::$_UI . "footer.php" ) ){
        include( self::$_UI . "footer.php" );
    }
    
    ob_flush();

}

public static function Build(array $defaultRoutes = array()) {
    
    self::RestApi();

    if(Config::APP_TYPE == "API"){
        echo 'You have reached a dead end sparky!'; exit;
    }

    if( count($defaultRoutes) > 0 ){
        self::$_ROUTES = $defaultRoutes;
    }

    $url = strtok( $_SERVER['REQUEST_URI'], '?' );

    if(count(self::$_ROUTES) > 0){

        foreach (self::$_ROUTES as $routeUrl => $ID) :
            // Use named subpatterns in the regular expression pattern to capture each parameter value separately
            $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUrl);
            if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                // Pass the captured parameter values as named arguments to the target function
                self::$_PAGE = $ID;
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY); // Only keep named subpattern matches
                $prs = array();
                foreach($params as $param => $value):
                    $prs[$param] = strtok ( $value, "?" );
                endforeach;
                if(count($prs) > 0){
                    self::$_REQUEST_PARAMS = @json_decode(@json_encode($prs));
                }
            }
        endforeach;

        if(is_array(self::$_REQUEST_PARAMS)){
            self::$_REQUEST_PARAMS = @json_decode(@json_encode(self::$_REQUEST_PARAMS));
        }
        
    }else{
        self::$_PAGE = "index";
    }

    if(self::$_PAGE == "orphan"){
        header("HTTP/1.1 301 Moved Permanently");
        header("location: https://$_SERVER[HTTP_HOST]/search"); exit;
    }

    self::UI();

}

}
?>
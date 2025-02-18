<?php

namespace Zuz;

use \Zuz\Config;
use \Zuz\Core;

class DB{
	
static $DBA;

public static function Database(){
    if(Config::DEBUG === 0){
        \mysqli_report(MYSQLI_REPORT_STRICT);
    }
    if(!isset(self::$DBA)){
        self::$DBA = new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME, Config::DB_PORT);
        if(self::$DBA->connect_error){
            die("Error in establishing Database Connection..."); exit;	
        }
        self::SET_CHARSET( Config::DB_CHARSET );
    }
}

private static function TypeOf($v){
    return match(gettype($v)){
        "boolean" => "s",
        "integer" => "i",
        "double" => "d",
        "string" => "s",
        "NULL" => "s",
        default => "s"
    };
}

private static function buildTypes($arr){
    $s = "";
    foreach($arr as $v):
        $s .= self::TypeOf($v);
    endforeach;
    return $s;
}


public static function SET_CHARSET($set){
    self::$DBA->set_charset($set);
}

public static function SELECT($query, $values){
    self::Database();
    self::SET_CHARSET( Config::DB_CHARSET );		
    if($q = self::$DBA->prepare($query)){
        $q->bind_param(self::buildTypes($values), ...$values);
        $q->execute();
        $_COUNT = -1; $_ROW = ''; $_FETCH = array(); 		
        try{
            $result = $q->get_result();		
            if($result->num_rows>0){
                $n = 0;
                while($fo = $result->fetch_array()):
                    if($n==0){ $_ROW = $fo; }
                    $_FETCH[] = $fo;
                    $n++;
                endwhile;
                $_COUNT = $result->num_rows;				
            }
        }catch(Exception $e){
            $meta = $q->result_metadata();
            $fields = $results = array();
            while ($field = $meta->fetch_field()) : 
                $var = $field->name; 
                $$var = null; 
                $fields[$var] = &$$var; 
            endwhile;
            call_user_func_array(array($q,'bind_result'),$fields);			
            $q->store_result();
            if($q->num_rows > 0){
                $i = 0;
                while ($q->fetch()):
                    $_FETCH[$i] = array();
                    foreach($fields as $k => $v):
                        $_FETCH[$i][$k] = $v;
                    endforeach;
                    $i++;
                endwhile;	
                $_COUNT = $q->num_rows;	
                $_ROW = $fields;
            }
        }
        
        if($_COUNT > 0){
            return Core::JSON(array(
                'hasRows' => true,
                'count' => $_COUNT,
                'row' => $_ROW,
                'fetch' => $_FETCH			
            ), true);
        }else{
            return Core::JSON(array(
                'hasRows' => false,
                'count' => 0
            ), true);	
        }

    }else{
        $error = self::$DBA->errno . ' ' . self::$DBA->error;
        return Core::JSON(array(
            'hasRows' => false,
            'count' => 0,
            'err' => Core::DEBUG ? $error : 'NOBUG'
        ), true);
    }
    
}

public static function INSERT($query, $values){
    self::Database();
    self::SET_CHARSET('utf8');
    if($q = self::$DBA->prepare($query)){
        $_bnd = $q->bind_param(self::buildTypes($values), ...$values);		
        if(!$q){
            return Core::JSON(array(
                'saved' => false
            ), true);
        }
        if($q->execute()){
            return Core::JSON(array(
                'saved' => true,
                'ID' => $q->insert_id
            ), true);
        }else{
            return Core::JSON(array(
                'saved' => false,
                'error' => self::$DBA->errno
            ), true);
        }
    }else{
        return Core::JSON(array(
            'saved' => false,
            'error' => self::$DBA->errno . ' ' . self::$DBA->error
        ), true);
    }
}

public static function UPDATE($query, $value){
    self::Database();
    self::SET_CHARSET('utf8');
    $q = self::$DBA->prepare($query);
    $q->bind_param(self::buildTypes($value), ...$value);
    if($q->execute()){
        return Core::JSON(array('updated' => true), true);
    }else{
        return Core::JSON(array('updated' => false, 'error' => $q->errno), true);
    }
}

public static function DELETE($query, $value){
    self::Database();
    self::SET_CHARSET('utf8');
    $q = self::$DBA->prepare($query);
    $q->bind_param(self::buildTypes($values), ...$value);
    if($q->execute()){
        return Core::JSON(array('deleted' => true), true);
    }else{
        return Core::JSON(array('deleted' => false, 'error' => $q->errno), true);
    }
}
	
}
?>
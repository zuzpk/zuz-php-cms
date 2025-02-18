<?php 

namespace App;

use \Zuz\Config;
use \Zuz\Core;
use \Zuz\User;
use \Zuz\DB;
use \Zuz\Router;

class Download{

public static function Get(){
    $you = User::Session();
    $get = Core::withGet();

    $uid = Core::fromHash($you->id);
    @list($appID, $fileid, $ip, $expiry) = explode(Config::SEPERATOR, Core::Decode($get->token));
    
    if($ip != Core::IP() || $expiry < time()){ header("location: " . Config::BASEURL . "my-apps?with=ip-exp"); exit; }

    $get = DB::SELECT("SELECT ID FROM myapps WHERE uid=? AND aid=? AND status=?", array($uid, $appID, 1));
    if($get->hasRows){
        $app = DB::SELECT("SELECT title, fileid FROM apps WHERE ID=? LIMIT 1", array($appID))->row;
        $fileName = stripslashes($app->title);
        $iext = pathinfo($app->fileid, PATHINFO_EXTENSION);
        $fileName .= '.' . $iext;
        self::Download($fileName, $app->fileid);
    }
}

private function setRange($range, $filesize, &$first, &$last){
    $dash=strpos($range,'-');
    $first=trim(substr($range,0,$dash));
    $last=trim(substr($range,$dash+1));
    if ($first=='') {
      //suffix byte range: gets last n bytes
      $suffix=$last;
      $last=$filesize-1;
      $first=$filesize-$suffix;
      if($first<0) $first=0;
    } else {
      if ($last=='' || $last>$filesize-1) $last=$filesize-1;
    }
    if($first>$last){
      //unsatisfiable range
      header("Status: 416 Requested range not satisfiable");
      header("Content-Range: */$filesize");
      exit;
    }
}

private function bufferedRead($file, $bytes, $buffer_size=1024000){
    $bytes_left=$bytes;
    while($bytes_left>0 && !feof($file)){
      if($bytes_left>$buffer_size)
        $bytes_to_read=$buffer_size;
      else
        $bytes_to_read=$bytes_left;
      $bytes_left-=$bytes_to_read;
      $contents=fread($file, $bytes_to_read);
      echo $contents;
      flush();
   }
}

private static function Download($title, $fileid){
    $afile = Router::$_BASEPATH . 'ui/files/'. $fileid;

    $filesize = @filesize($afile); 
    $file = fopen($afile,"rb") or die('file not exists');
    $bytes_sent = 0;
    $ranges=NULL;
    if ($_SERVER['REQUEST_METHOD']=='GET' && isset($_SERVER['HTTP_RANGE']) && $range=stristr(trim($_SERVER['HTTP_RANGE']),'bytes=')){
        $range=substr($range,6);
        $boundary='g45d64df96bmdf4sdgh45hf5';//set a random boundary
        $ranges=explode(',',$range);
    }

    if($ranges && count($ranges)){

        header("HTTP/1.1 206 Partial content");
        header("Accept-Ranges: bytes");
        if(count($ranges)>1){

          //compute content length
          $content_length=0;
          foreach ($ranges as $range){
            self::setRange($range, $filesize, $first, $last);
            $content_length+=strlen("\r\n--$boundary\r\n");
            $content_length+=strlen("Content-type: application/octet-stream\r\n");
            $content_length+=strlen("Content-range: bytes $first-$last/$filesize\r\n\r\n");
            $content_length+=$last-$first+1;          
          }
          $content_length+=strlen("\r\n--$boundary--\r\n");

          //output headers
          header("Content-Length: $content_length");
          //see http://httpd.apache.org/docs/misc/known_client_problems.html for an discussion of x-byteranges vs. byteranges
          header("Content-Type: multipart/x-byteranges; boundary=$boundary");

          //output the content


          foreach ($ranges as $range){
            self::setRange($range, $filesize, $first, $last);
            echo "\r\n--$boundary\r\n";
            echo "Content-type: application/octet-stream\r\n";
            echo "Content-range: bytes $first-$last/$filesize\r\n\r\n";
            fseek($file,$first);
            self::bufferedRead($file, $last-$first+1); 		
          }
          echo "\r\n--$boundary--\r\n";
        } else {
          /*
          A single range is requested.
          */
          $range=$ranges[0];
          self::setRange($range, $filesize, $first, $last);  
          header("Content-Length: ".($last-$first+1) );
          header("Content-Range: bytes $first-$last/$filesize");
          header("Content-Type: application/octet-stream");  
          header("Content-Disposition: attachment; filename=\"$title\"");
          fseek($file,$first);
          self::bufferedRead($file, $last-$first+1);
        }
    }else{
        //no byteserving
        header("Accept-Ranges: bytes"); 
        header("Content-Length: $filesize");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$title\"");
        // readfile($afile); exit;		
        while($chunk = fread($file, 1024000)) {
            if(connection_status() != CONNECTION_NORMAL){
                break;
            }
            if(!connection_aborted()) {
                // Send $chunk to buffer (if any), then flush() buffers:
                $bytes_sent += strlen($chunk);
                echo $chunk;
                flush();
                // Add $chunk length to $bytes_sent
            }else{
                flush();
            }		
        }
    } 
    fclose($file);
}


}
?>
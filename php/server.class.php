<?php  
 class Server{

    public function __construct(){
      $path = __DIR__."../../config/server.json";
      if (file_exists($path)) {
        $array = json_decode(file_get_contents($path)); 
        $ip = $this->ifnotnull($array->{'server'}->{'ip'})?$array->{'server'}->{'ip'}:false;
        $port = $this->ifnotnull($array->{'server'}->{'port'})?$array->{'server'}->{'port'}:false;
        $password = $this->ifnotnull($array->{'server'}->{'password'})?$array->{'server'}->{'password'}:"";
        if ($ip && $port) {
          echo '<p><a href="steam://connect/'; 
          echo $ip.":";
          echo $port."/";
          echo $password; 
          echo'" class="btn btn-default btn-block"><span class="glyphicon glyphicon-fire"></span> Connect</a></p>';

          echo "<p> connect ".$ip.":".$port.";password ".$password."</p>";
        }
      }
    }  

    public function ifnotnull($array){
      return !empty($array);
    }
 }
?>
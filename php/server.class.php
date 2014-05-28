<?php  
 class Server{

    public function __construct(){
      $server = __DIR__."../../config/server.ini";
      if(@$server_array = parse_ini_file($server)){
        $array_keys = array_keys($server_array);
        $key = array('IP', 'Port', 'Password');
        foreach ($key as $value) {
          if(in_array($value, $array_keys)){
            $verifkey = true;
          }else{
            $verifkey = false;
            break;
          }
        }

        if($verifkey){

          foreach ($server_array as  $value) {
            if($value !="")
              $verifvalue = true;
            else{
              $verifvalue = false;
              break;
            }
          }

          if($verifvalue){
            echo '<p><a href="steam://connect/'; 
            echo $server_array['IP'].":";
            echo $server_array['Port']."/";
            echo $server_array['Password']; 
            echo'" class="btn btn-default btn-block"><span class="glyphicon glyphicon-fire"></span> Connect</a></p>';

            echo "<p> connect ".$server_array['IP'].":".$server_array['Port']."/".$server_array['Password']."</p>";
          } 
        }      
      }
    }  
 }
?>
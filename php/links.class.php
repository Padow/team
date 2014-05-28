<?php  
 class Links{

    public function __construct(){
      $links = __DIR__."../../config/liens.ini";
      if(@$links_array = parse_ini_file($links)){
        foreach ($links_array as $key => $value) {
           if ($value === end($links_array))
            echo '<a href="'.$value.'" target="_blank">'.htmlspecialchars($key).'</a>';
          else
           echo '<a href="'.$value.'" target="_blank">'.htmlspecialchars($key).'</a> / ';
        }
      }
    } 
 }
?>
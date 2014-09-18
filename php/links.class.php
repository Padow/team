<?php  
class Links{

  public function __construct(){
    $path = __DIR__;
    $path = substr($path, 0, -3);
    $path .= "config/links.json";
    if (file_exists($path)) {
      $array = json_decode(file_get_contents($path));
      foreach ($array->{'links'} as $value) {
        if ($value === end($array->{'links'}))
          echo '<a href="'.$value->{'link'}.'" target="_blank">'.htmlspecialchars($value->{'name'}).'</a>';
        else
         echo '<a href="'.$value->{'link'}.'" target="_blank">'.htmlspecialchars($value->{'name'}).'</a> / ';
      }
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta HTTP-EQUIV="Expires" CONTENT="Tue, 01 Jan 1980 1:00:00 GMT">
   <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
     <title><?= $this->titulo?></title>
<?php
if(isset($_layoutParams['css']) && count($_layoutParams['css'])){
   for($i=0; $i< count($_layoutParams['css']); $i++)
      echo "\t".'<link href="'. $_layoutParams['ruta_css'].$_layoutParams['css'][$i]. '" rel="stylesheet" type="text/css" />'.PHP_EOL;
}

if(isset($_layoutParams['js']) && count($_layoutParams['js'])){
   for($i=0; $i< count($_layoutParams['js']); $i++)
      echo "\t".'<script src="'. $_layoutParams['ruta_js'].$_layoutParams['js'][$i]. '"></script>'.PHP_EOL;
}
?>
   </head>
   
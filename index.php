<?php

require_once("includes/database.php");

databaseSetUp();

$id = array_keys($_GET)[0];

$name = databaseGetName($id);

if(is_null($name)) {
  die("Couldn't find that download!");
}

//echo $id. " ". $name;



$file_url = 'uploads/'.$id;
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"".$name."\"");
readfile($file_url); // do the double-download-dance (dirty but worky)



?>

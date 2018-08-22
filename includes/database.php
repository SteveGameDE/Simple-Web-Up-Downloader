<?php

class MyDB extends SQLite3 {
   function __construct() {
      $this->open('includes/database.db');
   }
}
$db = new MyDB();
if(!$db) {
   die($db->lastErrorMsg());
} else {
   //echo "Opened database successfully\n";
}

databaseSetUp();

function databaseCloseConn() {
  $db->close();
}

function databaseSetUp() {
  global $db;
  $ret = $db->exec("CREATE TABLE IF NOT EXISTS `files` ( `ID` VARCHAR(16), `Name` TEXT, PRIMARY KEY(`ID`) );");
  if(!$ret){
    die($db->lastErrorMsg());
  } else {
    //echo "Table created successfully\n";
  }
}

function databaseAddFile($id, $name) {
  global $db;
  $ret = $db->exec("INSERT INTO files (ID,Name) VALUES ('$id', '$name');");
  if(!$ret){
     die($db->lastErrorMsg());
  } else {
     //echo "Data stored successfully\n";
  }
}

function databaseGetName($id) {
  global $db;
  //echo "Searching for $id";
  $ret = $db->query("SELECT Name FROM files WHERE ID = '$id';");

  $row = $ret->fetchArray(SQLITE3_ASSOC);

  if(!is_null($row)) {
    return $row['Name'];
  }

  return NULL;
}

function createNewID() {
		$chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789";

    do {
      $pass = '';
      for ($i=0; $i < 16; $i++)
        $pass .= $chars[random_int(0, 61)];
    } while(!is_null(databaseGetName($pass)));

    return $pass;
}


?>

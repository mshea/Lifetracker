<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('lifetracker.sqlite3', 0666, $error);
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }
   $sql =<<<EOF
      CREATE TABLE LIFEDATA
      (DATETIME TEXT,
      KEY TEXT,
      VALUE TEXT);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
   $db->close();

?>
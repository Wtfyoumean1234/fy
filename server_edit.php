<?php

$db = new SQLite3('accounts.db');

$version = $db->querySingle('SELECT SQLITE_VERSION()');

//$db->exec('CREATE TABLE accounts("account" TEXT PRIMARY KEY, "password" TEXT,"POWER" INT)');

//$db->exec('insert into accounts values("Patrick","691804",0);');

//$people=$db->query('select * from "accounts"');

//while($row=$people->fetchArray()){
//    echo "Account: ".$row['account']."<br>Password: ".$row['password']."<br>Power: ".$row['POWER']."<br>";
//}
//$db->exec('create table "ques"("ques" TEXT,"id" INT PRIMARY KEY,"ans" TEXT)');
?>
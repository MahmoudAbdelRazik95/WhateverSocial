<?php
$serverName =  'mysql5006.mywindowshosting.com';
$userName = 'a15748_dbproj';
$password = 'fistbump12345';
$databaseName = 'db_a15748_dbproj';


//$serverName =  'localhost';
//$userName = 'root';
//$password = '';
//$databaseName = 'db_project';
$connection = new mysqli($serverName,$userName,$password,$databaseName);
?>
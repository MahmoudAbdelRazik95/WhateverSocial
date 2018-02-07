<?php
session_start();
include 'dbconnection.php';
$search = $_POST['userid'];
$_SESSION['uid']=$search;
?>
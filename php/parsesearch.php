<?php
session_start();
include 'dbconnection.php';
$search = $_POST['search'];
$_SESSION['lastSearch']=$search;
?>
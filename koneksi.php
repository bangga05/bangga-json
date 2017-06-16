<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "bangga-json";

$connect = mysql_connect("$host", "$user","$pass");
$data = mysql_select_db("$db", $connect);
?>
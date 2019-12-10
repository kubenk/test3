<?php
    // plik z połączeniem do bazy danych i wywoływany za pomocą require_once "config.php";

		$dbhost='localhost'; 
		$dbuser="00203112_zadanie7"; 
		$dbpassword="zadanie77";
		$dbname="00203112_zadanie7";
		

$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); 
if(!$polaczenie) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } 
mysqli_query($polaczenie, "SET NAMES 'utf8'"); 
?>
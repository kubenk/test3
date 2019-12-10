<?php
require_once "config.php";
ob_start ();
echo "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>";
$file = $_POST['pobieranie'];
$user=$_COOKIE['user'];
$sciezka ="/".$user."/".$file;
$cookie='sciezka';
$cookie_value=$sciezka;
setcookie($cookie, $cookie_value, time() + (86400*30), "/");
$_COOKIE['sciezka'];
//wypisywanie nazwy katalogu w którym dany uzytkownik sie znajduje
if($file=='')
{
	echo "Katalog Główny ";
}else
{
	echo "Katalog: ".$file;
}

// przesyłanie za pomocą przerzut.php informacji o pliku jaki ma zostać wysłany
echo"<form method='POST' action='przerzut.php'>";
echo"<select name='pobieranie'>";

$result = mysqli_query($polaczenie, "SELECT nazwa_pliku FROM pliki where sciezka='$sciezka'");
while ($wiersz = mysqli_fetch_array ($result)) 	
			{ 	
				 $id=$wiersz[0];
			echo"<option value='$id'>$id</option>";
			}
echo"<input type='submit' name='nadus' value='Pobierz Wybrany Plik'/>";
echo"</form>";
?>

<?php
// sprawdzenie czy są ciasteczka, jeśli to nie to przekieruj do logowania
if(!isset($_COOKIE['user'])) {
	header('Location: http://www.jakublenz.pl/Z7/logowanie.php/');
} else {
require_once "config.php";
$user=$_COOKIE['user'];
$rezultat5 = mysqli_query($polaczenie, "SELECT * from logi Where login = '$user' ORDER BY idlogi DESC LIMIT 1,1");
// pobieranie rekordu o logowaniu i wyświetlanie na czerwono czasu ostatniego złego zalogowania po poprawnym zalogowniu
while ($wiersz = mysqli_fetch_array ($rezultat5)) 	
			{ 	
				 $ostrzezenie = $wiersz[3];
				 $aktywne=$aktywne+$ostrzezenie;
					
				if($aktywne==1)
				{	
					
					
					$wynik=mysqli_query($polaczenie, "SELECT data from logi Where login = '$user' and komunikat='1' ORDER BY idlogi DESC LIMIT 1") or die("Problem z czyms");
					if ($wiersz = mysqli_fetch_array ($wynik)) 	
					{ 	
				 
							$alarm = $wiersz[0];
							
							echo("<font color=\"#FF0000\">$user: Nieudana próba logowania:$alarm</font>");
							echo"<br></br>";
					}
				}
			}
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
<title>Lenz</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<BODY>
PANEL Uzytkownika
<a href="logowanie.php">Wyloguj</a></br>

<form method="POST" action="panel.php">
<br>
Podaj nazwe folderu:
<input type="text" name="nazwa_folderu" maxlength="20" size="10"><br>
<input type="submit" value="Utwórz"/>
</form>
<?php
$nazwa= $_POST['nazwa_folderu'];
$przegladarka=$dane['name'];
$system=$dane['platform'];
$ip_odwiedzajacego = $_SERVER["REMOTE_ADDR"];
$czas_obecny = date("y:m:d:H:i:s", time());


		
		//tworzenie katalogu przez uzytkownika w panelu
		 if ( isset ( $_POST['nazwa_folderu'] ) )
		{
			$katalog = $nazwa;
			if(!file_exists("./$user/$katalog"))

			{
				mkdir("./$user/$katalog", 0777);
				echo "<br>Utworzono folder o nazwie $nazwa</br>";
				mysqli_query($polaczenie, "INSERT INTO foldery (nazwa,user) values ('$katalog','$user')"); 
				
			}else
			{
				echo "<br>Folder o podanej nazwie juz istnieje</br>";
			}					
		}


$result = mysqli_query($polaczenie, "SELECT nazwa FROM foldery where user='$user'");

//formularz pozwalajacy wybrac katalog do ktorego
//uzytkownik moze wrzucic pliki
echo"Wybierz katalog";
echo"<form action='odbierz.php' method='POST'ENCTYPE='multipart/form-data'>";

echo"<select name='problemo'>";

echo"<option  selected='selected' value=''>Obecny</option>";
echo"<br></br>";
while ($wiersz = mysqli_fetch_array ($result)) 	
			{ 	
				echo $id=$wiersz[0];
			echo"<option  value='$id'>$id</option>";
			}
echo"<input type='file' name='plik'/>";
echo"<input type='submit' value='Wyślij plik'/>";
echo"</form>";
//formularz pozwalajacy wejsc/
//do wybranego przez uzytownika folderu
echo"<form method='POST' action='pobieranie.php'>";
echo"<select name='pobieranie'>";
echo"<option  selected='selected' value=''>Macierzysty</option>";
$result = mysqli_query($polaczenie, "SELECT nazwa FROM foldery where user='$user'");
while ($wiersz = mysqli_fetch_array ($result)) 	
			{ 	
				echo $id=$wiersz[0];
			echo"<option  value='$id'>$id</option>";
			}
echo"<input type='submit' value='Przejdz do katalogu'/>";
echo"</form>";

echo 'Zalogowany jako: '.$_COOKIE['user'];

?>
</BODY>
</HTML>
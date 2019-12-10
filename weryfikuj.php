<?php
$user=$_POST['user']; 
$pass=$_POST['pass']; 
$cookie='user';
$cookie_value=$user;
setcookie($cookie, $cookie_value, time() + (86400*30), "/");
$czas_obecny = date("y:m:d:H:i:s", time());

require_once "config.php";

$result = mysqli_query($polaczenie, "SELECT * FROM users WHERE user='$user'"); 
$rekord = mysqli_fetch_array($result); 
if(!$rekord) 
{mysqli_close($polaczenie); 
echo "Login lub hasło są nie poprawne";
}
else
{ // Jeśli $rekord istnieje

if($rekord['stan']==1)
{
	
	//pobieranie czasu zablokowania uzytkownika
	$rezultat = mysqli_query($polaczenie, "SELECT czas FROM users where user='$user'");
	if ($wiersz = mysqli_fetch_array ($rezultat)) 	
			{ 	
			
			$czas_blokowania=$wiersz[0];
			 $ts = strtotime($czas_blokowania);
			 $odblokowanie= time();
		
			
			
				//jezeli czas zablokowania jest o minute wiekszy to odblokuj
				if($odblokowanie > $ts + 60)
				{	//zmiana stanu konta z 1 - zablokowane na 0 - niezablokowane
					mysqli_query($polaczenie, "UPDATE users SET stan= '0',czas='now()' WHERE user='$user'") or die("Problem z czasem");
					
					echo "Konto zostalo odblokowane";
					echo "<a href='logowanie.php'>Wróc do logowania</a></br>";
					exit();
				}else
				{
			
					echo"Konto zablokowane na czas 1 minuty. Spróbuj ponownie później";
					exit();
				}
			
			}
	
}
if($rekord['pass']==$pass) // czy hasło zgadza się z BD
{	
    // jeśli hasło się zgadza to przekieruj do panelu
	mysqli_query($polaczenie, "INSERT INTO logi (login,data,komunikat) values ('$user','$czas_obecny','0')") or die ("connection lost");
 
    header('Location: http://www.jakublenz.pl/Z7/panel.php');


}
else
{
	//pobieranie 3 ostatnich rekordów logowań
	//jesli wykryje 3 nieudane próby konto zostaje zablokowane
	//zmiana stanu konta z 0 na 1 - zablokowane
mysqli_query($polaczenie, "INSERT INTO logi (login,data,komunikat) values ('$user','$czas_obecny','1')");
$rezultat = mysqli_query($polaczenie, "SELECT * FROM logi ORDER BY idlogi DESC LIMIT 0,3");

while ($wiersz = mysqli_fetch_array ($rezultat)) 	
			{ 	
				 $liczba = $wiersz[3];
				 $proby=$proby+$liczba;
				
				if($proby==3)
				{	
					echo"Konto zostało zablokowane. Popros Administratora o jego odblokowanie";
					
					mysqli_query($polaczenie, "UPDATE users SET stan= '1',czas='$czas_obecny' WHERE user='$user'") or die("Problem z czasem");
					
					exit();
				}
			}
			

			
			
			
			


mysqli_close($polaczenie);
echo "Login lub hasło są nie poprawne"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
}
}
?>
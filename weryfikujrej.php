<?php
// połączenie z bazą danych za pomocą config.php
require_once "config.php";

		$czas_obecny = date("y:m:d:H:i:s", time());
		$user = $_POST['uzytkownik'];
		$pass = $_POST['haslo'];
		$pass_again=$_POST['haslo_again'];
			
			if(!empty($user) && !empty($pass))
				{	
					$wynik=mysqli_query($polaczenie, "SELECT user FROM users WHERE user='$user'");
					$rekord = mysqli_fetch_array($wynik);
					if($rekord) 
					{
						mysqli_close($polaczenie); 
						echo "Dany uzytkownik istnieje"; 
					}
				 
					else
					{	if($pass==$pass_again)
						{
							mysqli_query($polaczenie, "INSERT INTO users (user,pass,stan,data_rej) values ('$user','$pass','0','$czas_obecny')"); 
							echo "<br>Utworzono nowego uzytkownika</br>";
							echo "Rejestracja przebiegla pomyslnie. Mozesz teraz przejsc do <a href='logowanie.php'>Logowania</a>";
							$katalog = $user;
							
							//zakładanie katalogu uzytkownika przy udanej rejestracji
								mkdir("./$katalog", 0777);
								echo "Folder uzytkownika został utworzony";
							
							
							mysqli_close($polaczenie);
						}else
						{
							echo "Hasła nie sa rowne";
						}
					}
				}
				else
				{
					echo "Conajmniej jedno pole zostało puste. Upewnij się ze uzupełniłeś wszystkie pola";
				}	

		//umieszczenie do bazy danych pobranych z formularza i daty
		
		
		
		
	
		

		

?>

</body>
</html>
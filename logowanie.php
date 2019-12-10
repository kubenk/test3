<?php
// ustawienie ciasteczek
$cookie='user';
$cookie_value='';
setcookie($cookie, $cookie_value, time() + (86400*30), "/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lenz</title>
    <!-- stylizacja formularza za pomocą bootstrapa -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ display: inline-block;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 400px;
    height: 400px;
    margin: auto;}
    </style>
</head>
<body>
    <div class="wrapper">
    <!-- formularz logowania -->
        <h2>Zaloguj się</h2>
        <p>Podaj swoje dane logowania, aby się zalogować.</p>
        <form action="http://www.jakublenz.pl/Z7/weryfikuj.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user" class="form-control">
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Zaloguj">
            </div>
            <p>Nie masz jeszcze konta? <a href="http://www.jakublenz.pl/Z7/rejestracja.php">Zarejestruj się</a>.</p>
        </form>
    </div>    
</body>
</html>
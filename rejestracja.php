<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lenz</title>
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
        <h2>Zarejestruj się</h2>
        <p>Wypełnij ten formularz, aby utworzyć konto.</p>
        <form action="weryfikujrej.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="uzytkownik" class="form-control">
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="haslo" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="haslo_again" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Zarejestruj">
            </div>
            <p>Posiadasz już konto? <a href="logowanie.php">Zaloguj się tutaj</a>.</p>
        </form>
    </div>    
</body>
</html>
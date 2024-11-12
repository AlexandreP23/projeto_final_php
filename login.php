<?php require_once "functions.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start up</title>
</head>
<body>
    <form action="login.php" method="post">
        <fieldset>
            <legend>Painel de Login</legend>
            <input type="email" name="email" placeholder="Informe seu E-mail" required>

            <input type="password" name="senha" placeholder="Informe sua Senha" required>

            <input type="submit" name="acessar" value="Acessar">
        </fieldset>
    </form>

    <?php 
        if(isset($_POST['acessar'])){
            login($conn);
        }
    ?>
</body>
</html>
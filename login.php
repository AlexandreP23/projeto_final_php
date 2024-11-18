<?php require_once "functions.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Login</title>
    <style>
        /* Background igual ao index_frontend.php */
        body {
            background-color: #2E3B4E; /* Substitua por sua cor de fundo da index_frontend.php */
            margin: 0;
            padding: 0;
        }

        /* Caixa do Painel de Login */
        form {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: none;
        }

        legend {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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

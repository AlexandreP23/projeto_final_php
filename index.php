<?php session_start(); 
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
</head>
<body>
    <?php if ($seguranca){ ?>          

    <h1>Painel Administrativo</h1>
    <h3>Bem-vindo, <?php echo $_SESSION['nome']; ?></h3>
   

    <nav>
        <div>
            <a href="index.php">Painel</a>
            <a href="users.php">Gerenciar Usuários</a>
            <a href="logout.php">Sair</a>
        </div>
    </nav>

<?php  } ?>

</body>
</html>
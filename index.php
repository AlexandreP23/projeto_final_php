<?php 
session_start(); 
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <style>
        
        body {
            background-color: #2E3B4E; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        
        .container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        
        h1, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 1.5rem;
        }

        h3 {
            color: #333;
            font-size: 1.2rem;
        }

        
        nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        nav a {
            text-decoration: none;
            color: #007BFF;
            font-size: 1rem;
            text-align: center;
            padding: 10px 20px;
            border: 1px solid #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #007BFF;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php if ($seguranca): ?>          
    <div class="container">
        <h1>Painel Administrativo</h1>
        <h3>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?></h3>

        <nav>
            <a href="index.php">Painel</a>
            <a href="users.php">Gerenciar Usuários</a>
            <a href="logout.php">Sair</a>
        </nav>
    </div>
    <?php endif; ?>
</body>
</html>

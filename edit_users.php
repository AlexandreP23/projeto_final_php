<?php
session_start(); 
include 'functions.php';
$conn = connect(); 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $usuario = searchUnique($conn, "users", $id);
    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }
    upDateUser($conn);
} else {
    echo "ID do usuário não fornecido.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        
        body {
            background-color: #2E3B4E; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }

        
        .container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 1.5rem;
        }

        h2 {
            color: #007BFF;
            font-size: 1.2rem;
        }

        h3 {
            color: #333;
            font-size: 1rem;
        }

        
        nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        nav a {
            text-decoration: none;
            color: #007BFF;
            font-size: 1rem;
            padding: 10px 20px;
            border: 1px solid #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #007BFF;
            color: #fff;
        }

        
        form {
            margin: 20px 0;
        }

        form fieldset {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }

        form legend {
            font-size: 1.2rem;
            color: #333;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="date"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Painel Administrativo</h1>
        <h3>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?></h3>
        <h2>Gerenciador de Usuários</h2>

        <nav>
            <a href="index.php">Painel</a>
            <a href="users.php">Gerenciar Usuários</a>
            <a href="logout.php">Sair</a>
        </nav>

        <h2>Editando o usuário <?php echo htmlspecialchars($usuario['nome']); ?></h2>

        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Editar Usuário</legend>
                <input value="<?php echo htmlspecialchars($usuario['id']); ?>" type="hidden" name="id" required>
                <input value="<?php echo htmlspecialchars($usuario['nome']); ?>" type="text" name="nome" placeholder="Nome" required>
                <input value="<?php echo htmlspecialchars($usuario['email']); ?>" type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="senha" placeholder="Senha">
                <input type="password" name="repetesenha" placeholder="Confirme sua senha">
                <input value="<?php echo htmlspecialchars($usuario['data_cadastro']); ?>" type="date" name="data_cadastro" required>
                <input type="file" name="foto" accept="image/*">
                <input type="submit" name="atualizar" value="Atualizar">
            </fieldset>
        </form>
    </div>
</body>
</html>
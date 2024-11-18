<?php 
session_start(); 
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("Location: login.php");
require_once "functions.php";
$conn = connect(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Usuários</title>
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
        form input[type="password"] {
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

        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #007BFF;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table a {
            text-decoration: none;
            color: #007BFF;
        }

        table a:hover {
            text-decoration: underline;
        }

        table img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php if ($seguranca): ?>          
    <div class="container">
        <h1>Painel Administrativo</h1>
        <h3>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?></h3>
        <h2>Gerenciador de Usuários</h2>

        <nav>
            <a href="index.php">Painel</a>
            <a href="users.php">Gerenciar Usuários</a>
            <a href="logout.php">Sair</a>
        </nav>

        <?php
        $tabela = "users";
        $order = "nome";
        $usuarios = search($conn, $tabela, 1, $order);    
        insertUsers($conn);
        
        if (isset($_GET['id'])): ?>
            <h2>Tem certeza que deseja excluir o usuário <?php echo htmlspecialchars($_GET['nome']); ?>?</h2>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                <input type="submit" name="deletar" value="Deletar">
            </form>
        <?php endif; ?>

        <?php 
        if (isset($_POST['deletar'])) {
            if ($_SESSION['id'] != $_POST['id']) {
                delete($conn, "users", $_POST['id']);    
            } else {
                echo "<p>Você não pode excluir seu próprio usuário</p>";
            }
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Inserir Usuários</legend>
                <input type="text" name="nome" placeholder="Nome">
                <input type="email" name="email" placeholder="E-mail">
                <input type="password" name="senha" placeholder="Senha">
                <input type="password" name="repetesenha" placeholder="Confirme sua senha">
                <input type="file" name="foto" accept="image/*">
                <input type="submit" name="cadastrar" value="Cadastrar">
            </fieldset>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data Cadastro</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?> 
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['data_cadastro']; ?></td>
                        <td><img src="<?php echo $usuario['foto']; ?>" alt="Foto de <?php echo htmlspecialchars($usuario['nome']); ?>"></td>
                        <td>
                            <a href="users.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo urlencode($usuario['nome']); ?>">Excluir</a>
                            <a href="edit_users.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo urlencode($usuario['nome']); ?>">Atualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</body>
</html>
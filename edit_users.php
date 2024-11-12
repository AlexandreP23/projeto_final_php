<?php 
session_start(); 
if (!isset($_SESSION['ativa'])) {
    header("Location: login.php");
    exit();
}
require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Usuários</title>
</head>
<body>
    <h1>Painel Administrativo</h1>
    <h3>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?></h3>
    <h2>Gerenciador de Usuários</h2>

    <nav>
        <div>
            <a href="index.php">Painel</a>
            <a href="users.php">Gerenciar Usuários</a>
            <a href="logout.php">Sair</a>
        </div>
    </nav>

<?php
    $tabela = "users";
    $order = "nome";
    $usuarios = search($conn, $tabela, 1, $order);    
           
    if (isset($_GET['id'])){ 
        $id = $_GET['id'];
        $usuario = searchUnique($conn, "users", $id);
        upDateUser($conn);
    ?>
        <h2>Editando o usuário <?php echo htmlspecialchars($_GET['nome']); ?></h2>            
    <?php } ?>

    <form action="" method="post">
        <fieldset>
            <legend>Editar Usuário</legend>
            <input value="<?php echo htmlspecialchars($usuario['id']); ?>" type="hidden" name="id" required>
            <input value="<?php echo htmlspecialchars($usuario['nome']); ?>" type="text" name="nome" placeholder="Nome" required>
            <input value="<?php echo htmlspecialchars($usuario['email']); ?>" type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha">
            <input type="password" name="repetesenha" placeholder="Confirme sua senha">
            <input value="<?php echo htmlspecialchars($usuario['data_cadastro']); ?>" type="date" name="data_cadastro" required>
            <input type="submit" name="atualizar" value="Atualizar">
        </fieldset>
    </form>
</body>
</html>
<?php session_start(); 
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("Location: login.php");
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
    <?php if ($seguranca){ ?>          

    <h1>Painel Administrativo</h1>
    <h3>Bem-vindo, <?php echo $_SESSION['nome']; ?></h3>
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
    insertUsers($conn);
    
    if(isset($_GET['id'])){ ?>
        <h2>Tem certeza que deseja excluir o usuário <?php echo $_GET['nome']; ?>?</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
            <input type="submit" name="deletar" value="Deletar">
        </form>

    <?php } ?>

    <?php 
        if(isset($_POST['deletar'])){
            if($_SESSION['id'] != $_POST['id']){
                delete($conn, "users", $_POST['id']);    
            }else{
                echo "Você não pode excluir seu próprio usuário";
            }
        }
    ?>

    <form action="" method="post">
        <fieldset>
            <legend>Inserir Usuários</legend>
            <input type="text" name="nome" placeholder="Nome">
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="senha" placeholder="Senha">
            <input type="password" name="repetesenha" placeholder="Confirme sua senha">
            <input type="submit" name="cadastrar" value="Cadastrar">
        </fieldset>
    </form>

    <div class="container">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data Cadastro</th>
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
                        <td>
                            <a href="users.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo $usuario['nome']; ?>">Excluir</a>

                            <a href="edit_user.php?id=<?php echo $usuario['id']; ?>&nome=<?php echo $usuario['nome']; ?>">Atualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

<?php  } ?>

</body>
</html>
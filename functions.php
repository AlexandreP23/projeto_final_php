<?php
function connect() {
    $host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "project_db";

    $conn = new mysqli($host, $db_user, $db_password, $db_name);
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    return $conn;
}

function login($conn){
    if(isset($_POST['acessar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $senha = sha1($_POST['senha']);

        $query = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
        $execute = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($execute);

        if(!empty($result)){
            session_start();
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['ativa'] = TRUE;
            header("Location: index.php");
        }else{
            echo "Usuário ou Senha não encontrados";
        }
    }
}

function logout(){
    session_start();
    session_destroy();
    header("Location: login.php");
}

function searchUnique($conn, $tabela, $id){
    $query = "SELECT * FROM $tabela WHERE id =". (int) $id;
    $execute = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($execute);
    return $result;
}

function search($conn, $tabela, $where = 1, $order = ""){
    if (!empty($order)){
        $order = "ORDER BY $order";
    }
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $execute = mysqli_query($conn, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    return $results;
}

function insertUsers($conn){
    if(isset($_POST['cadastrar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){
        $erros = array();
        
        if ($_POST['senha'] != $_POST['repetesenha']){
            $erros[] = "As senhas não conferem";
        }

        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            $erros[] = "Email inválido";
        }

        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $senha = sha1($_POST['senha']);

        $queryEmail = "SELECT email FROM users WHERE email = '$email'";
        $buscaEmail = mysqli_query($conn, $queryEmail);
        $verifica = mysqli_num_rows($buscaEmail);

        if ($verifica > 0){
            $erros[] = "E-mail já cadastrado";            
        }

        $foto = "";
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $foto = $uploadDir . basename($_FILES['foto']['name']);
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
                $erros[] = "Erro ao enviar a foto.";
            }
        }

        if (empty($erros)){
            $query = "INSERT INTO users (nome, email, senha, data_cadastro, foto) VALUES ('$nome', '$email', '$senha', NOW(), '$foto')";
            $execute = mysqli_query($conn, $query);
            if ($execute){
                echo "Usuário cadastrado com sucesso";
            } else{
                echo "Erro ao cadastrar usuário";
            }
        } else{
            foreach ($erros as $erro){
                echo "<p>$erro</p>";
            }
        }
    }
}

function delete($conn, $tabela, $id){
    if (!empty($id)){
        $query = "DELETE FROM $tabela WHERE id =". (int) $id;
        $execute = mysqli_query($conn, $query);        
    }

    if ($execute){
        echo "Dado deletado com sucesso!";
    } else{
        echo "Erro ao deletar dado!";
    }
}

function upDateUser($conn){
    if(isset($_POST['atualizar']) AND !empty($_POST['email']) AND !empty($_POST['nome'])){
        $erros = array();
        $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $senha = "";
        $data = mysqli_real_escape_string($conn, $_POST['data_cadastro']);
        if (empty($data)){
            $erros[] = "Preencha a data de cadastro";
        }
        if (strlen($nome) < 3){
            $erros[] = "Preencha seu nome completo";
        }

        $foto = "";
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $foto = $uploadDir . basename($_FILES['foto']['name']);
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
                $erros[] = "Erro ao enviar a foto.";
            }
        }

        if (empty($erros)){
            if (!empty($_POST['senha'])){
                $senha = sha1($_POST['senha']);
                $query = "UPDATE users SET nome = '$nome', email = '$email', senha = '$senha', data_cadastro = '$data', foto = '$foto' WHERE id =" . $id;
            } else{
                $query = "UPDATE users SET nome = '$nome', email = '$email', data_cadastro = '$data', foto = '$foto' WHERE id =" . $id;
            }
            $execute = mysqli_query($conn, $query);
            if ($execute){
                header("Location: users.php"); 
                exit();
            } else{
                echo "Erro ao atualizar usuário";
            }
        } else{
            foreach ($erros as $erro){
                echo "<p>$erro</p>";
            }
        }
    }
}
?>
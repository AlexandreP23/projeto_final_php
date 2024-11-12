<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "project_db";

$conn = new mysqli($host, $db_user, $db_password, $db_name);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

function login($conn){
    if(isset($_POST['acessar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $senha = sha1($_POST['senha']);

        $query = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
        $execute = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($execute);

        if(!empty($result)){
            //echo "Bem-vindo " . $return['nome'];

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

//seleciona(busca) no bd apenas um resultado com base no id
function searchUnique($conn, $tabela, $id){
    $query = "SELECT * FROM $tabela WHERE id =". (int) $id;
    $execute = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($execute);
    return $result;
}

//seleciona(busca) no bd todos os resultados com base no WHERE 
function search($conn, $tabela, $where = 1, $order = ""){
    if (!empty($order)){
        $order = "ORDER BY $order";
    }
    $query = "SELECT * FROM $tabela WHERE $where $order";
    $execute = mysqli_query($conn, $query);
    $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
    return $results;
}


?>
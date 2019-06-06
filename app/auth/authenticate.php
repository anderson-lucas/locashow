<?php

require '../database.php';

$login = trim($_POST['login']);
$password = trim($_POST['password']);

if (empty($login) || empty($password)) {
  header('Location: ../../login.php');
}

$password = md5($password);

$sql = "SELECT md5(id) AS hash_id
            , id
            , login
            , nome
            , email
        FROM usuario
        WHERE login = '{$login}'
        AND password = '{$password}'";

if ($result = $mysqli->query($sql)) {

    $usuario = [];
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $row['nome'] = utf8_encode($row['nome']);
        $usuario = $row;
    }

    if (count($usuario) > 0) {
        //criar sessao e redirecionar para o sistema
        session_start();

        $_SESSION = [
            'id' => $usuario['hash_id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
        ];

        $sql_log = "INSERT INTO log_acesso (usuario_id) VALUES ({$usuario['id']})";
        $mysqli->query($sql_log);
        $mysqli->close();
        header('Location: ../../sistema.php?page=home');
        exit;
    } else {
        //redirecionar de volta para o login, informando usuario ou senha incorretos;
        header('Location: ../../login.php?error=1');
        exit;
    }
}

$mysqli->close();

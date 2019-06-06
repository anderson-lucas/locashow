<?php 
    $dados = [
        'id' => $_POST['id'],
        'login' => utf8_decode($_POST['login']),
        'email' => utf8_decode($_POST['email']),
        'nome' => utf8_decode($_POST['nome']),
    ];

    require '../database.php';

    if ($dados['id'] == 0) {
        $sql = "INSERT INTO usuario (login, password, email, nome)
                VALUES 
                ('{$dados['login']}', md5('mudar123'), '{$dados['email']}', '{$dados['nome']}')";
    } else {
        $sql = "UPDATE usuario SET
                login = '{$dados['login']}',
                email = '{$dados['email']}',
                nome = '{$dados['nome']}'
                WHERE id = {$dados['id']}";
    }

    if ($result = $mysqli->query($sql)) {
        $mysqli->close();
        header('Location: ../../sistema.php?page=usuarios');
    } else {
        $mysqli->close();

        if($dados['id'] == 0) {
            header('Location: ../../sistema.php?page=cadastro_usuario&code=2');
        } else {
            header('Location: ../../sistema.php?page=cadastro_usuario&id='.md5($dados['id']).'&code=2');
        }
    }
?>
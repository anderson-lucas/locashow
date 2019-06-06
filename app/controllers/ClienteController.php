<?php 
    $dados = [
        'id' => $_POST['id'],
        'nome' => utf8_decode($_POST['nome']),
        'cpf_cnpj' => utf8_decode($_POST['cpf_cnpj']),
        'email' => utf8_decode($_POST['email']),
        'telefone' => utf8_decode($_POST['telefone']),
    ];

    require '../database.php';

    if ($dados['id'] == 0) {
        $sql = "INSERT INTO cliente (nome, cpf_cnpj, email, telefone)
                VALUES 
                ('{$dados['nome']}', '{$dados['cpf_cnpj']}', '{$dados['email']}', '{$dados['telefone']}')";
    } else {
        $sql = "UPDATE cliente SET
                nome = '{$dados['nome']}',
                cpf_cnpj = '{$dados['cpf_cnpj']}',
                email = '{$dados['email']}',
                telefone = '{$dados['telefone']}'
                WHERE id = {$dados['id']}";
    }

    if ($result = $mysqli->query($sql)) {
        $mysqli->close();
        header('Location: ../../sistema.php?page=clientes');
    } else {
        $mysqli->close();

        if($dados['id'] == 0) {
            header('Location: ../../sistema.php?page=cadastro_cliente&code=2');
        } else {
            header('Location: ../../sistema.php?page=cadastro_cliente&id='.md5($dados['id']).'&code=2');
        }
    }
?>
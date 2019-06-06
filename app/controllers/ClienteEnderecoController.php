<?php 
    $dados = [
        'id' => $_POST['id'],
        'cliente_id' => $_POST['cliente_id'],
        'cep' => $_POST['cep'],
        'logradouro' => $_POST['logradouro'],
        'complemento' => $_POST['complemento'],
        'bairro' => $_POST['bairro'],
        'localidade' => $_POST['localidade'],
        'uf' => $_POST['uf']
    ];

    require '../database.php';

    if ($dados['id'] == 0) {
        $sql = "INSERT INTO cliente_endereco (cliente_id, cep, logradouro, complemento, bairro, localidade, uf)
                VALUES 
                ('{$dados['cliente_id']}', '{$dados['cep']}', '{$dados['logradouro']}', '{$dados['complemento']}', '{$dados['bairro']}', '{$dados['localidade']}', '{$dados['uf']}')";
    } else {
        $sql = "UPDATE cliente_endereco SET
                cliente_id = '{$dados['cliente_id']}',
                cep = '{$dados['cep']}',
                logradouro = '{$dados['logradouro']}',
                complemento = '{$dados['complemento']}',
                bairro = '{$dados['bairro']}',
                localidade = '{$dados['localidade']}',
                uf = '{$dados['uf']}'
                WHERE id = {$dados['id']}";

    }

    if ($result = $mysqli->query($sql)) {
        $mysqli->close();
        header('Location: ../../sistema.php?page=cadastro_cliente_endereco&id='.md5($dados['cliente_id']));
    } else {
        $mysqli->close();

        if($dados['id'] == 0) {
            header('Location: ../../sistema.php?page=cadastro_cliente_endereco&id='.md5($dados['cliente_id']));
        } else {
            header('Location: ../../sistema.php?page=cadastro_cliente_endereco&id='.md5($dados['cliente_id']));
        }
    }
?>
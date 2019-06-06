<?php 
    $dados = [
        'id' => $_POST['id'],
        'cliente_id' => $_POST['cliente_id'],
        'descricao' => utf8_decode($_POST['descricao']),
        'cep' => utf8_decode($_POST['cep']),
        'logradouro' => utf8_decode($_POST['logradouro']),
        'complemento' => utf8_decode($_POST['complemento']),
        'bairro' => utf8_decode($_POST['bairro']),
        'localidade' => utf8_decode($_POST['localidade']),
        'uf' => $_POST['uf'],
    ];

    require '../database.php';

    if ($dados['id'] == 0) {
        $sql = "INSERT INTO imovel (cliente_id, descricao, cep, logradouro, complemento, bairro, localidade, uf)
                VALUES 
                ({$dados['cliente_id']}, '{$dados['descricao']}', '{$dados['cep']}', '{$dados['logradouro']}',
                '{$dados['complemento']}', '{$dados['bairro']}', '{$dados['localidade']}', '{$dados['uf']}')";
    } else {
        $sql = "UPDATE imovel SET
                cliente_id = '{$dados['cliente_id']}',
                descricao = '{$dados['descricao']}',
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
        header('Location: ../../sistema.php?page=imoveis');
    }
?>
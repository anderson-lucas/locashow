<?php 
    $dados = [
        'id' => $_POST['id'],
        'cliente_id' => $_POST['cliente_id'],
        'descricao' => $_POST['descricao'],
        'cep' => $_POST['cep'],
        'logradouro' => $_POST['logradouro'],
        'complemento' => $_POST['complemento'],
        'bairro' => $_POST['bairro'],
        'localidade' => $_POST['localidade'],
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
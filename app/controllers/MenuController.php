<?php 
    $dados = [
        'id' => $_POST['id'],
        'nome' => utf8_decode($_POST['nome']),
        'link' => utf8_decode($_POST['link']),
        'icone' => utf8_decode($_POST['icone']),
        'ordem' => utf8_decode($_POST['ordem']),
    ];

    require '../database.php';

    if ($dados['id'] == 0) {
        $sql = "INSERT INTO menu (nome, link, icone, ordem)
                VALUES 
                ('{$dados['nome']}', '{$dados['link']}', '{$dados['icone']}', {$dados['ordem']})";
    } else {
        $sql = "UPDATE menu SET
                nome = '{$dados['nome']}',
                link = '{$dados['link']}',
                icone = '{$dados['icone']}',
                ordem = {$dados['ordem']}
                WHERE id = {$dados['id']}";
    }

    if ($result = $mysqli->query($sql)) {
        $mysqli->close();
        header('Location: ../../sistema.php?page=menus');
    }
?>
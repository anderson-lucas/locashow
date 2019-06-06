<?php 
    $dados = [
        'id' => $_POST['id'],
        'nome' => utf8_decode($_POST['nome'])
    ];

    require '../database.php';

    if ($dados['id'] == 0) {
        $sql = "INSERT INTO grupo (nome)
                VALUES 
                ('{$dados['nome']}')";
    } else {
        $sql = "UPDATE grupo SET nome = '{$dados['nome']}' WHERE id = {$dados['id']}";
    }

    if ($result = $mysqli->query($sql)) {
        $mysqli->close();
        header('Location: ../../sistema.php?page=grupos');
    }
?>
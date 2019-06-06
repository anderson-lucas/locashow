<?php 
    $dados = [
        'id' => $_POST['id'],
        'cliente_id' => $_POST['cliente_id'],
        'imovel_id' => $_POST['imovel_id'],
        'tipo' => $_POST['tipo'],
        'valor' => $_POST['valor'],
        'dt_vencimento' => $_POST['dt_vencimento'],
        'status' => $_POST['status']
    ];

    require '../database.php';


    if($dados['cliente_id'] != '' && $dados['imovel_id'] != ''){
        if ($dados['id'] == 0) {
            $sql = "INSERT INTO contrato (cliente_id, imovel_id, tipo, valor, dt_vencimento, status)
                    VALUES 
                    ('{$dados['cliente_id']}', '{$dados['imovel_id']}', '{$dados['tipo']}', '{$dados['valor']}', '{$dados['dt_vencimento']}', '{$dados['status']}')";
        } else {
            $sql = "UPDATE contrato SET
                    cliente_id = '{$dados['cliente_id']}',
                    imovel_id = '{$dados['imovel_id']}',
                    tipo = '{$dados['tipo']}',
                    valor = '{$dados['valor']}',
                    dt_vencimento = '{$dados['dt_vencimento']}',
                    status = '{$dados['status']}'
                    WHERE id = {$dados['id']}";

        }

        if ($result = $mysqli->query($sql)) {
            $mysqli->close();
            header('Location: ../../sistema.php?page=contratos');
        } else {
            $mysqli->close();

            if($dados['id'] == 0) {
                header('Location: ../../sistema.php?page=cadastro_contrato&code=2');
            } else {
                header('Location: ../../sistema.php?page=cadastro_contrato&id='.md5($dados['id']).'&code=2');
            }
        }
    } else {
        header('Location: ../../sistema.php?page=cadastro_contrato&code=3');
    }
?>
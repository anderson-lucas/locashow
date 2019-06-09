<?php

function getContrato($id = NULL, $filter = NULL)
{
    global $mysqli;

    $where = '';
    if ($id) {
        $where = "WHERE co.id = {$id}";
    }

    if ($filter) {
        $filter = trim($filter);
        $where = "WHERE (cl.nome LIKE '%{$filter}%' OR im.descricao LIKE '%{$filter}%')";
    }

    $sql = "SELECT co.id as id
                , cl.nome as nome_cliente
                , im.descricao as descricao
                , CASE co.tipo 
                WHEN 'L' THEN 'Locação'
                WHEN 'V' THEN 'Venda'
                END AS tipo
                , co.valor
                , DATE_FORMAT(co.created_at, '%d/%m/%Y %H:%i:%s') AS created
            FROM contrato as co
            JOIN cliente as cl ON cl.id = co.cliente_id
            JOIN imovel as im ON im.id = co.imovel_id
            {$where}
            ORDER BY im.created_at DESC";

    $contratos = [];
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $contratos[] = $row;
        }
        $result->free();
    }

    return $contratos;
}

function getContratoSearch($filter = '')
{
    return getContrato(NULL, $filter);
}

function deleteContrato($id)
{
    global $mysqli;

    $sql = "DELETE FROM contrato WHERE id = {$id}";

    $status = 200;
    $message = [];
    if (! $mysqli->query($sql)) {
        $message = 'O registro não pode ser deletado!';
        $status = 400;
    } else {
        $message = 'Deletado com sucesso!';
    }

    return ['message' => $message, 'status' => $status];
}

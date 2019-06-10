<?php

function getContrato($id = NULL, $filter = NULL)
{
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
    $contratos = get($sql);

    return ['data' => $contratos, 'status' => 200]; 
}

function getContratoSearch($filter = '')
{
    return getContrato(NULL, $filter);
}

function setContrato($data)
{
    $return = set('contrato', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteContrato($id)
{
    $where = "WHERE id = {$id}";
    $return = delete('contrato', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

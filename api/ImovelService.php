<?php

function getImovel($id = NULL, $filter = NULL)
{
    $where = '';
    if ($id) {
        $where = "WHERE imovel.id = {$id}";
    }

    if ($filter) {
        $filter = trim($filter);
        $where = "WHERE (imovel.descricao LIKE '%{$filter}%' OR cliente.nome LIKE '%{$filter}%')";
    }

    $sql = "SELECT nome AS nome_cliente
                , upper(left(sha1(imovel.id), 8)) as codigo
                , imovel.*
                , DATE_FORMAT(imovel.created_at, '%d/%m/%Y %H:%i:%s') AS created
            FROM imovel 
            JOIN cliente ON imovel.cliente_id = cliente.id
            {$where} 
            ORDER BY descricao";
    $imoveis = get($sql);

    return ['data' => $imoveis, 'status' => 200]; 
}

function getImovelSearch($filter = '')
{
    return getImovel(NULL, $filter);
}

function setImovel($data)
{
    $return = set('imovel', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteImovel($id)
{
    $where = "WHERE id = {$id}";
    $return = delete('imovel', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

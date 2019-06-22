<?php

function getImovel(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE imovel.id = {$data['id']}";
    }

    if (isset($data['search'])) {
        $where = "WHERE (imovel.descricao LIKE '%{$data['search']}%' OR cliente.nome LIKE '%{$data['search']}%')";
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

function setImovel(array $data)
{
    $return = set('imovel', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteImovel(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('imovel', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

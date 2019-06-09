<?php

function getImovel($id = NULL, $filter = NULL)
{
    global $mysqli;

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

    $imoveis = [];
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $imoveis[] = $row;
        }
        $result->free();
    }

    return $imoveis;
}

function getImovelSearch($filter = '')
{
    return getImovel(NULL, $filter);
}

function deleteImovel($id)
{
    global $mysqli;

    $sql = "DELETE FROM imovel WHERE id = {$id}";

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

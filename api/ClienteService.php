<?php

function getCliente($id = NULL, $filter = NULL)
{
    $where = '';
    if ($id) {
        $where = "WHERE id = {$id}";
    }

    if ($filter) {
        $filter = trim($filter);
        $where = "WHERE nome LIKE '%{$filter}%'";
    }

    $sql = "SELECT DATE_FORMAT(cliente.created_at, '%d/%m/%Y %H:%i:%s') AS created
                , cliente.* 
            FROM cliente 
            {$where}
            ORDER BY nome";
    $clientes = get($sql);

    return ['data' => $clientes, 'status' => 200]; 
}

function getClienteSearch($filter = '')
{
    return getCliente(NULL, $filter);
}

function setCliente($data)
{
    $return = set('cliente', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteCliente($id)
{
    $where = "WHERE id = {$id}";
    $return = delete('cliente', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

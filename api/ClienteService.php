<?php

function getCliente(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE id = {$data['id']}";
    }

    if (isset($data['search'])) {
        $where = "WHERE nome LIKE '%{$data['search']}%'";
    }

    $sql = "SELECT DATE_FORMAT(cliente.created_at, '%d/%m/%Y %H:%i:%s') AS created
                , cliente.* 
            FROM cliente 
            {$where}
            ORDER BY nome";
    $clientes = get($sql);
    return ['data' => $clientes, 'status' => 200]; 
}

function setCliente(array $data)
{
    $return = set('cliente', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteCliente(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('cliente', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

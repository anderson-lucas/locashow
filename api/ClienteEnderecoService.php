<?php

function getClienteEndereco(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE id = {$data['id']}";
    }

    if (isset($data['cliente_id'])) {
        $where = "WHERE cliente_id = {$data['cliente_id']}";
    }

    $sql = "SELECT * FROM cliente_endereco {$where} ORDER BY created_at DESC";
    $enderecos = get($sql);
    return ['data' => $enderecos, 'status' => 200];
}

function setClienteEndereco(array $data)
{
    $return = set('cliente_endereco', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteEndereco(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('cliente_endereco', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

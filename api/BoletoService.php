<?php

function getBoleto(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE boleto_cliente.id = {$data['id']}";
    }

    if (isset($data['contrato_id'])) {
        $where = "WHERE boleto_cliente.contrato_id = {$data['contrato_id']}";
    }

    $sql = "SELECT boleto_cliente.id as boleto_id 
                , boleto_cliente.*
                , contrato.*
                , cliente.*
                , DATE_FORMAT(boleto_cliente.dt_vencimento, '%d/%m/%Y') AS dt_vencimento
                , DATE_FORMAT(boleto_cliente.created_at, '%d/%m/%Y %H:%i:%s') AS created
            FROM boleto_cliente
            JOIN contrato ON boleto_cliente.contrato_id = contrato.id
            JOIN cliente ON contrato.cliente_id = cliente.id
            {$where} 
            ORDER BY boleto_cliente.dt_vencimento";
    $boletos = get($sql);
    return ['data' => $boletos, 'status' => 200]; 
}

function setBoleto(array $data)
{
    $return = set('boleto_cliente', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteBoleto(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('boleto_cliente', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

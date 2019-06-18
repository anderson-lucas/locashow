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

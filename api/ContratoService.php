<?php

function getContrato(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE co.id = {$data['id']}";
    }

    if (isset($data['search'])) {
        $where = "WHERE (cl.nome LIKE '%{$data['search']}%' OR im.descricao LIKE '%{$data['search']}%')";
    }

    $sql = "SELECT co.id as id
                , cl.nome as nome_cliente
                , im.descricao as descricao
                , CASE co.tipo 
                WHEN 'L' THEN 'Locação'
                WHEN 'V' THEN 'Venda'
                END AS desc_tipo
                , CASE co.status 
                WHEN 'A' THEN 'Ativo'
                WHEN 'I' THEN 'Inativo'
                END AS desc_status
                , co.valor
                , DATE_FORMAT(co.created_at, '%d/%m/%Y %H:%i:%s') AS created
                , cl.id as cliente_id
                , im.id as imovel_id
                , co.tipo
                , co.status
                , DATE_FORMAT(co.dt_vencimento, '%d/%m/%Y') AS dt_vencimento
            FROM contrato as co
            JOIN cliente as cl ON cl.id = co.cliente_id
            JOIN imovel as im ON im.id = co.imovel_id
            {$where}
            ORDER BY im.created_at DESC";
    $contratos = get($sql);
    return ['data' => $contratos, 'status' => 200]; 
}

function setContrato(array $data)
{
    global $mysqli;
    $data['dt_vencimento'] = $data['tipo'] == 'L' ? date('Y-m-d', strtotime($data['dt_vencimento'])) : null;
    $return = set('contrato', $data);
    $data['contrato_id'] = $mysqli->insert_id;
    geraBoletos($data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteContrato(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('contrato', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function geraBoletos(array $data) {
    $dt_vencimento = strtotime('+1 month', strtotime(date('Y-m-d')));
    if ($data['tipo'] == 'V') {
        $data['dt_vencimento'] = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))));
    }

    while($dt_vencimento <= strtotime($data['dt_vencimento'])) {
        $boleto_cliente = [
            'contrato_id' => $data['contrato_id'],
            'cliente_id' => $data['cliente_id'],
            'valor' => $data['valor'],
            'dt_vencimento' => date('Y-m-d', $dt_vencimento)
        ];
        $dt_vencimento = strtotime('+1 month', $dt_vencimento);
        set('boleto_cliente', $boleto_cliente);
    }
}

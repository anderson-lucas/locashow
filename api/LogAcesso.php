<?php

function getLogAcesso(array $data = [])
{
    $where = '';
    if (isset($data['search'])) {
        $where = "WHERE (usuario.nome LIKE '%{$data['search']}%'
                        OR DATE_FORMAT(log_acesso.created_at, '%d/%m/%Y %H:%i') LIKE '%{$data['search']}%')";
    }

    $sql = "SELECT DATE_FORMAT(log_acesso.created_at, '%d/%m/%Y %H:%i') AS created
                , usuario.nome
                , count(1) AS qtd
            FROM log_acesso
            INNER JOIN usuario ON usuario.id = log_acesso.usuario_id
            {$where}
            GROUP BY DATE_FORMAT(log_acesso.created_at, '%d/%m/%Y')
            ORDER BY log_acesso.created_at DESC, usuario.nome";
    $logs_acesso = get($sql);
    return ['data' => $logs_acesso, 'status' => 200];
}
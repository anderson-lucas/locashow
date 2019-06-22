<?php

function getGrupo(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE id = {$data['id']}";
    }

    if (isset($data['search'])) {
        $where = "WHERE nome LIKE '%{$data['search']}%'";
    }

    $sql = "SELECT DATE_FORMAT(grupo.created_at, '%d/%m/%Y %H:%i') AS created
                , grupo.* 
            FROM grupo 
            {$where}
            ORDER BY grupo.created_at DESC, grupo.nome";
    $grupos = get($sql);
    return ['data' => $grupos, 'status' => 200];
}

function setGrupo(array $data)
{
    $return = set('grupo', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteGrupo(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('grupo', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

<?php

function createGrupoMenu($data)
{
    global $mysqli;

    $sql_count = "SELECT 1 FROM grupo_menu WHERE grupo_id = {$data['grupo_id']} AND menu_id = {$data['menu_id']}";
    if ($result = $mysqli->query($sql_count)) {
        if ($result->num_rows > 0) {
            $result->free();
            return ['message' => 'Menu já vinculado!', 'status' => 200];
        }
    }

    $sql = "INSERT INTO grupo_menu (grupo_id, menu_id) VALUES ({$data['grupo_id']}, {$data['menu_id']})";
    $status = 200;
    $message = [];
    if (! $mysqli->query($sql)) {
        $message = 'Erro ao inserir! ERRO: '.$mysqli->error;
        $status = 400;
    } else {
        $message = 'Sucesso!';
    }

    return ['data' => $message, 'status' => $status];
}

function deleteGrupoMenu($parameters)
{
    $params = explode('/', $parameters['id']);
    $grupo_id = $params[0];
    $menu_id = $params[1];

    $where = "WHERE grupo_id = {$grupo_id} AND menu_id = {$menu_id}";
    $return = delete('grupo_menu', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}
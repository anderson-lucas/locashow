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

    return ['message' => $message, 'status' => $status];
}

function deleteGrupoMenu($grupo_id, $menu_id)
{
    global $mysqli;

    $sql = "DELETE FROM grupo_menu WHERE grupo_id = {$grupo_id} AND menu_id = {$menu_id}";
    if ($mysqli->query($sql)) {
        return ['message' => 'Deletado com sucesso!'];
    }

    return ['message' => 'Ocorreu um erro ao deletar o registro!'];
}
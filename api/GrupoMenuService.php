<?php

function getGrupoMenu(array $data)
{
    $sql = "SELECT menu.id
                , menu.nome
                , COALESCE((SELECT 1 FROM grupo_menu WHERE grupo_menu.menu_id = menu.id AND grupo_menu.grupo_id = {$data['grupo_id']}),0) AS vinculado
            FROM menu";
    $grupo_menu = get($sql);
    return ['data' => $grupo_menu, 'status' => 200];
}

function setGrupoMenu(array $data)
{
    $return = set('grupo_menu', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
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

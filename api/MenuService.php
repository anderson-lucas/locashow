<?php

function getMenus()
{
    global $mysqli;

    $sql = "SELECT DISTINCT(menu.id), menu.nome, menu.link, menu.icone, menu.ordem, menu.created_at
            FROM usuario_grupo
            JOIN grupo ON grupo.id = usuario_grupo.grupo_id
            JOIN grupo_menu ON grupo_menu.grupo_id = grupo.id
            JOIN menu ON menu.id = grupo_menu.menu_id
            WHERE usuario_grupo.usuario_id = {$_SESSION['id']}
            ORDER BY menu.ordem, menu.nome, menu.created_at desc";

    $menus = [];
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $menus[] = $row;
        }
        $result->free();
    }

    return $menus;
}

function getMenu(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE id = {$data['id']}";
    }

    if (isset($data['search'])) {
        $where = "WHERE nome LIKE '%{$data['search']}%'";
    }

    $sql = "SELECT DATE_FORMAT(menu.created_at, '%d/%m/%Y %H:%i') AS created
                , menu.* 
            FROM menu 
            {$where}
            ORDER BY menu.ordem, menu.nome";
    $menus = get($sql);
    return ['data' => $menus, 'status' => 200]; 
}

function setMenu(array $data)
{
    $return = set('menu', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteMenu(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('menu', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

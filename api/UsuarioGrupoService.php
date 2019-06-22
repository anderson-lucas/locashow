<?php

function getUsuarioGrupo(array $data)
{
    $sql = "SELECT grupo.id
                , grupo.nome
                , COALESCE((SELECT 1 FROM usuario_grupo WHERE usuario_grupo.grupo_id = grupo.id AND usuario_grupo.usuario_id = {$data['usuario_id']}),0) AS vinculado
            FROM grupo";
    $usuario_grupo = get($sql);
    return ['data' => $usuario_grupo, 'status' => 200];
}

function setUsuarioGrupo(array $data)
{
    $return = set('usuario_grupo', $data);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteUsuarioGrupo($parameters)
{
    $params = explode('/', $parameters['id']);
    $usuario_id = $params[0];
    $grupo_id = $params[1];

    $where = "WHERE usuario_id = {$usuario_id} AND grupo_id = {$grupo_id}";
    $return = delete('usuario_grupo', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

<?php

function createUsuarioGrupo($data)
{
    global $mysqli;

    $sql_count = "SELECT 1 FROM usuario_grupo WHERE usuario_id = {$data['usuario_id']} AND grupo_id = {$data['grupo_id']}";
    if ($result = $mysqli->query($sql_count)) {
        if ($result->num_rows > 0) {
            $result->free();
            return ['message' => 'Grupo já vinculado!', 'status' => 200];
        }
    }

    $sql = "INSERT INTO usuario_grupo (usuario_id, grupo_id) VALUES ({$data['usuario_id']}, {$data['grupo_id']})";
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

function deleteUsuarioGrupo($parameters)
{
    $params = explode('/', $parameters['id']);
    $usuario_id = $params[0];
    $grupo_id = $params[1];

    $where = "WHERE usuario_id = {$usuario_id} AND grupo_id = {$grupo_id}";
    $return = delete('usuario_grupo', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

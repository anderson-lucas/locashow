<?php
session_start();

function getUsuario(array $data = [])
{
    $where = '';
    if (isset($data['id'])) {
        $where = "WHERE id = {$data['id']}";
    }

    if (isset($data['search'])) {
        $where = "WHERE nome LIKE '%{$data['search']}%'";
    }

    $sql = "SELECT DATE_FORMAT(usuario.created_at, '%d/%m/%Y %H:%i') AS created
                , usuario.* 
            FROM usuario 
            {$where}
            ORDER BY usuario.created_at DESC, usuario.nome";
    $usuarios = get($sql);
    return ['data' => $usuarios, 'status' => 200];
}

function setUsuario(array $data)
{
    if (! isset($data['id'])) $data['password'] = md5('mudar123');
    $self_edit = isset($data['self_edit']) ? true : false;
    unset($data['self_edit']);
    $return = set('usuario', $data);
    if ($self_edit && isset($data['nome'])) $_SESSION['nome'] = strtoupper($data['nome']);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function deleteUsuario(array $data)
{
    $where = "WHERE id = {$data['id']}";
    $return = delete('usuario', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

function changePassword(array $data)
{
    $senha_atual = $data['senha_atual'];
    $senha_nova = $data['senha_nova'];
    $senha_atual_md5 = md5($senha_atual);

    $sql = "SELECT 1 FROM usuario WHERE id = {$data['id']} AND password = '{$senha_atual_md5}'";
    $result = get($sql);

    if (count($result) > 0) {
        $update = ['id' => $data['id'], 'password' => md5($senha_nova)];
        $return = set('usuario', $update);
        return ['data' => $return['message'], 'status' => $return['status']];
    } else {
        return ['data' => 'Senha atual informada incorreta!', 'status' => 400];
    }
}

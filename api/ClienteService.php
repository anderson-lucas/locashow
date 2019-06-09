<?php

function getCliente($id = NULL, $filter = NULL)
{
    global $mysqli;

    $where = '';
    if ($id) {
        $where = "WHERE id = {$id}";
    }

    if ($filter) {
        $filter = trim($filter);
        $where = "WHERE nome LIKE '%{$filter}%'";
    }

    $sql = "SELECT DATE_FORMAT(cliente.created_at, '%d/%m/%Y %H:%i:%s') AS created, cliente.* FROM cliente {$where} ORDER BY nome";

    $clientes = [];
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $clientes[] = $row;
        }
        $result->free();
    }

    return $clientes;
}

function getClienteSearch($filter = '')
{
    return getCliente(NULL, $filter);
}

function createOrUpdateCliente($data)
{
    global $mysqli;

    if (isset($data['id']) && $data['id'] != 0) {
        $sql = "UPDATE cliente SET ";
        $i = 1;
        foreach ($data as $key => $value) {
            $sql .= "{$key} = '{$value}'";
            if ($i != count($data)) $sql .= ', ';
            $i++;
        }
        $sql .= " WHERE id = {$data['id']}";
    } else {
        $sql = "INSERT INTO cliente ";
        $fields = '(';
        $values = '(';
        $i = 1;
        foreach ($data as $key => $value) {
            $fields .= "{$key}";
            $values .= "'{$value}'";
            if ($i != count($data)) {
                $fields .= ', ';
                $values .= ', ';
            }
            $i++;
        }
        $sql .= "{$fields}) VALUES {$values})";
    }

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

function deleteCliente($id)
{
    global $mysqli;

    $sql = "DELETE FROM cliente WHERE id = {$id}";

    $status = 200;
    $message = [];
    if (! $mysqli->query($sql)) {
        $message = 'O registro não pode ser deletado!';
        $status = 400;
    } else {
        $message = 'Deletado com sucesso!';
    }

    return ['message' => $message, 'status' => $status];
}

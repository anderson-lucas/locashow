<?php

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'db_locashow';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mysqli->set_charset("utf8");

if (mysqli_connect_errno()) {
    printf("Conexão com o banco de dados falhou: %s\n", mysqli_connect_error());
    exit;
}

function get($sql)
{
    global $mysqli;

    $return = [];
    if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $return[] = $row;
      }
      $result->free();
    }

    return $return;
}

function set($table, $data)
{
    global $mysqli;

    if (isset($data['id']) && $data['id'] != 0) {
        $sql = "UPDATE {$table} SET ";
        $i = 1;
        foreach ($data as $key => $value) {
            $sql .= "{$key} = '{$value}'";
            if ($i != count($data)) $sql .= ', ';
            $i++;
        }
        $sql .= " WHERE id = {$data['id']}";
    } else {
        $sql = "INSERT INTO {$table} ";
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

function delete($table, $where)
{
    global $mysqli;

    $sql = "DELETE FROM {$table} {$where}";

    $status = 200;
    $message = [];
    if (! $mysqli->query($sql)) {
        $message = 'O registro não pode ser deletado pois possui vínculos ativos.';
        $status = 400;
    } else {
        $message = 'Deletado com sucesso!';
    }

    return ['message' => $message, 'status' => $status];
}

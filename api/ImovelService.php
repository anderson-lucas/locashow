<?php

function getImovel($id = NULL, $filter = NULL)
{
    global $mysqli;

    $where = '';
    if ($id) {
        $where = "WHERE imovel.id = {$id}";
    }

    if ($filter) {
        $filter = trim($filter);
        $where = "WHERE (imovel.descricao LIKE '%{$filter}%' OR cliente.nome LIKE '%{$filter}%')";
    }

    $sql = "SELECT nome AS nome_cliente
                , upper(left(sha1(imovel.id), 8)) as codigo
                , imovel.*
                , DATE_FORMAT(imovel.created_at, '%d/%m/%Y %H:%i:%s') AS created
            FROM imovel 
            JOIN cliente ON imovel.cliente_id = cliente.id
            {$where} 
            ORDER BY descricao";

    $imoveis = [];
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $imoveis[] = $row;
        }
        $result->free();
    }

    return $imoveis;
}

function getImovelSearch($filter = '')
{
    return getImovel(NULL, $filter);
}

// function createOrUpdateCliente($data)
// {
//     global $mysqli;

//     if (isset($data['id']) && $data['id'] != 0) {
//         $sql = "UPDATE cliente SET ";
//         $i = 1;
//         foreach ($data as $key => $value) {
//             $sql .= "{$key} = '{$value}'";
//             if ($i != count($data)) $sql .= ', ';
//             $i++;
//         }
//         $sql .= " WHERE id = {$data['id']}";
//     } else {
//         $sql = "INSERT INTO cliente ";
//         $fields = '(';
//         $values = '(';
//         $i = 1;
//         foreach ($data as $key => $value) {
//             $fields .= "{$key}";
//             $values .= "'{$value}'";
//             if ($i != count($data)) {
//                 $fields .= ', ';
//                 $values .= ', ';
//             }
//             $i++;
//         }
//         $sql .= "{$fields}) VALUES {$values})";
//     }

//     $status = 200;
//     $message = [];
//     if (! $mysqli->query($sql)) {
//         $message = 'Erro ao inserir! ERRO: '.$mysqli->error;
//         $status = 400;
//     } else {
//         $message = 'Sucesso!';
//     }

//     return ['message' => $message, 'status' => $status];
// }

function deleteImovel($id)
{
    global $mysqli;

    $sql = "DELETE FROM imovel WHERE id = {$id}";

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

<?php

function deleteEndereco($id)
{
    $where = "WHERE id = {$id}";
    $return = delete('cliente_endereco', $where);
    return ['data' => $return['message'], 'status' => $return['status']];
}

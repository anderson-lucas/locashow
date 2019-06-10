<?php

function deleteImovelImagem($id)
{
    $sql = "SELECT * FROM imovel_imagem WHERE id = $id";
    $imagem = get($sql);

    $path_images = $_SERVER['DOCUMENT_ROOT'].
                    DIRECTORY_SEPARATOR.
                    'locashow'.
                    DIRECTORY_SEPARATOR;

    $where = "WHERE id = {$id}";
    $return = delete('imovel_imagem', $where);
    if ($return['status'] == 200) unlink($path_images.$imagem[0]['full_path']);
    return ['data' => $return['message'], 'status' => $return['status']];
}

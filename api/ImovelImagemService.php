<?php

function getImovelImagem(array $data = [])
{
    $where = '';
    if (isset($data['imovel_id'])) {
        $where = "WHERE imovel_id = {$data['imovel_id']}";
    }

    $sql = "SELECT * FROM imovel_imagem {$where} ORDER BY created_at DESC";
    $imovel_imagens = get($sql);
    return ['data' => $imovel_imagens, 'status' => 200];
}

function setImovelImagem(array $data)
{
    $path_images = $_SERVER['DOCUMENT_ROOT'].
                    DIRECTORY_SEPARATOR.
                    'locashow'.
                    DIRECTORY_SEPARATOR.
                    'imoveis'.
                    DIRECTORY_SEPARATOR;

    if (! is_dir($path_images)) {
        mkdir($path_images, 0777, TRUE);
    }

    if (! is_dir($path_images.$data['imovel_id'].DIRECTORY_SEPARATOR)) {
        mkdir($path_images.$data['imovel_id'].DIRECTORY_SEPARATOR);
    }

    $full_path = $path_images.$data['imovel_id'].DIRECTORY_SEPARATOR;

    $image_name = md5($data['imovel_id'].date('YmdHis')).'.jpg';
    $image_with_path = $full_path.$image_name;

    $full_path_insert = 'imoveis/'.$data['imovel_id'].'/'.$image_name;

    if (move_uploaded_file($data['files']['foto']['tmp_name'], $image_with_path)) {
        $insert = ['imovel_id' => $data['imovel_id'], 'full_path' => $full_path_insert];
        $return = set('imovel_imagem', $insert);
        return ['data' => $return['message'], 'status' => $return['status']];
    } else {
        return ['data' => 'Erro ao realizar o upload da imagem!', 'status' => 400];
    }
}

function deleteImovelImagem(array $data)
{
    $sql = "SELECT * FROM imovel_imagem WHERE id = {$data['id']}";
    $imagem = get($sql);

    $path_images = $_SERVER['DOCUMENT_ROOT'].
                    DIRECTORY_SEPARATOR.
                    'locashow'.
                    DIRECTORY_SEPARATOR;

    $where = "WHERE id = {$data['id']}";
    $return = delete('imovel_imagem', $where);
    if ($return['status'] == 200) unlink($path_images.$imagem[0]['full_path']);
    return ['data' => $return['message'], 'status' => $return['status']];
}

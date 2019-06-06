<?php

function deleteImovelImagem($id)
{
    global $mysqli;

    $imagem = [];
    $sql = "SELECT * FROM imovel_imagem WHERE id = $id";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $imagem = $row;
        }
        $result->free();
    }

    $path_images = $_SERVER['DOCUMENT_ROOT'].
                    DIRECTORY_SEPARATOR.
                    'locashow'.
                    DIRECTORY_SEPARATOR;

    $sql = "DELETE FROM imovel_imagem WHERE id = {$id}";
    if ($mysqli->query($sql)) {
        unlink($path_images.$imagem['full_path']);
        return ['message' => 'Deletado com sucesso!'];
    }

    return ['message' => 'Ocorreu um erro ao deletar o registro!'];
}

<?php

    $path_images = $_SERVER['DOCUMENT_ROOT'].
                    DIRECTORY_SEPARATOR.
                    'locashow'.
                    DIRECTORY_SEPARATOR.
                    'imoveis'.
                    DIRECTORY_SEPARATOR;

    if (! is_dir($path_images)) {
        mkdir($path_images, 0777, TRUE);
    }

    require '../database.php';

    if (! is_dir($path_images.$_POST['imovel_id'].DIRECTORY_SEPARATOR)) {
        mkdir($path_images.$_POST['imovel_id'].DIRECTORY_SEPARATOR);
    }

    $full_path = $path_images.$_POST['imovel_id'].DIRECTORY_SEPARATOR;

    if (count($_FILES['foto']) > 0) {

        $image_name = md5($_POST['imovel_id'].date('YmdHis')).'.jpg';
        $image_with_path = $full_path.$image_name;

        $full_path_insert = 'imoveis/'.$_POST['imovel_id'].'/'.$image_name;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $image_with_path)) {
            $sql = "INSERT INTO imovel_imagem (imovel_id, full_path) VALUES ({$_POST['imovel_id']}, '{$full_path_insert}')";
            if ($result = $mysqli->query($sql)) {
                $mysqli->close();
                header('Location: ../../sistema.php?page=cadastro_imovel_imagem&id='.md5($_POST['imovel_id']));
            } else {
                echo "Erro ao inserir a foto!";
                exit;
            }
        }

    }

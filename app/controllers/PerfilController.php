<?php 
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    require '../database.php';

    $mudou_senha = false;
    if (!empty($_POST['senha_atual']) && !empty($_POST['senha_nova'])) {
        $senha_atual = $_POST['senha_atual'];
        $senha_nova = $_POST['senha_nova'];
        $senha_atual_md5 = md5($senha_atual);

        $sql = "SELECT 1 FROM usuario WHERE id = $id AND password = '{$senha_atual_md5}'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $senha_nova_md5 = md5($senha_nova);
            if ($result = $mysqli->query("UPDATE usuario SET password = '{$senha_nova_md5}' WHERE id = $id")) {
                $mudou_senha = true;
            }
        }     
    }

    $sql = "UPDATE usuario SET nome = '{$nome}', email = '{$email}' WHERE id = $id";

    if ($result = $mysqli->query($sql)) {
        session_start();
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        $code = 1;
        if ($mudou_senha) {
            $code = 3;
        }
        
        header('Location: ../../sistema.php?page=perfil&id='.md5($id)."&code={$code}");
    } else {
        header('Location: ../../sistema.php?page=perfil&id='.md5($id).'&code=2');
    }
?>
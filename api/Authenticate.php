<?php

function auth($data)
{
	$login = trim($_POST['login']);
	$password = md5(trim($_POST['password']));

	$sql = "SELECT md5(id) AS hash_id
	            , id
	            , login
	            , nome
	            , email
	        FROM usuario
	        WHERE login = '{$login}'
	        AND password = '{$password}'";
	$usuario = get($sql);

	if (count($usuario) > 0) {
		session_start();
        $_SESSION = [
            'id' => $usuario[0]['id'],
            'nome' => $usuario[0]['nome'],
            'email' => $usuario[0]['email'],
        ];
        set('log_acesso', ['usuario_id' => $usuario[0]['id']]);
        $data = "ok";
        $status = 200;
	} else {
		$data = "Usuário ou senha incorretos!";
		$status = 401;
	}

	return ['data' => $data, 'status' => $status];
}


<?php

header('Content-type: application/json');

// DATABASE
require 'app/database.php';

// SERVICES
require 'api/ClienteService.php';
require 'api/GrupoMenuService.php';
require 'api/UsuarioGrupoService.php';
require 'api/ImovelImagemService.php';
require 'api/ClienteEnderecoService.php';

const PAGE = 3;
const ID = 4;

$allowed_methods = ['GET', 'POST', 'DELETE'];
$request = explode('/', $_SERVER['REQUEST_URI'], 5);
$method = $_SERVER['REQUEST_METHOD'];

if (! in_array($method, $allowed_methods)) {
	return response(['message' => 'Method Not Allowed'], 405);
}

switch ($request[PAGE]) {
	case 'clientes':
		if ($method == 'GET') {
			$id = NULL;
			if (isset($request[ID])) $id = $request[ID];
			return response(getCliente($id));
		}

		if ($method == 'POST') {
			$return = createOrUpdateCliente($_POST);
			return response(['message' => $return['message']], $return['status']);
		}

		if ($method == 'DELETE') {
			if (isset($request[ID])) {
				return response(deleteCliente($request[ID]));
			} else {
				return response(['message' => 'Bad Request'], 400);
			}
		}
		break;
	case 'clientesSearch':
		if ($method == 'GET') {
			$filter = NULL;
			if (isset($request[ID])) $filter = $request[ID];
			return response(getClienteSearch($filter));
		}
		break;
	case 'grupo-menu':
		if ($method == 'POST') {
			$return = createGrupoMenu($_POST);
			return response(['message' => $return['message']], $return['status']);
		}

		if ($method == 'DELETE') {
			$ids = explode('/', $request[ID]);
			if (isset($request[ID])) {
				return response(deleteGrupoMenu($ids[0], $ids[1]));
			} else {
				return response(['message' => 'Bad Request'], 400);
			}
		}
		break;
	case 'usuario-grupo':
		if ($method == 'POST') {
			$return = createUsuarioGrupo($_POST);
			return response(['message' => $return['message']], $return['status']);
		}

		if ($method == 'DELETE') {
			$ids = explode('/', $request[ID]);
			if (isset($request[ID])) {
				return response(deleteUsuarioGrupo($ids[0], $ids[1]));
			} else {
				return response(['message' => 'Bad Request'], 400);
			}
		}
		break;
	case 'imovel_imagens':
		if ($method == 'DELETE') {
			if (isset($request[ID])) {
				return response(deleteImovelImagem($request[ID]));
			} else {
				return response(['message' => 'Bad Request'], 400);
			}
		}
		break;
	case 'cliente_endereco':
		if ($method == 'DELETE') {
			if (isset($request[ID])) {
				return response(deleteEndereco($request[ID]));
			} else {
				return response(['message' => 'Bad Request'], 400);
			}
		}
		break;
	default:
		response(['message' => 'Not Found'], 404);
		break;
}

function response($data, $status = 200) {
	echo json_encode(['status' => $status, 'data' => $data]);
}
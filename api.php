<?php

header('Content-type: application/json');

require 'app/database.php';
require 'routes.php';

const ROUTE = 3;
const PARAMS = 4;

$request = explode('/', $_SERVER['REQUEST_URI'], 5);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (isset($request[PARAMS])) {
	$request[PARAMS] = str_replace('%20', ' ', $request[PARAMS]);
}

$params = $requestMethod == 'POST' ? $_POST : (isset($request[PARAMS]) ? $request[PARAMS] : NULL);

$found = FALSE;
foreach ($routes as $group => $routeList) {
	foreach ($routeList as $route) {
		if ($requestMethod == $route['method'] && $request[ROUTE] == $route['route']) {
			$found = TRUE;
			require $route['service'];
			$return = call_user_func($route['function'], $params);
			response($return['data'], $return['status']);
		}
	}
}

if (! $found) response(NULL, 404);

function response($data = NULL, $status = 200) {
	http_response_code($status);
	echo json_encode(['status' => $status, 'data' => $data]);
}
<?php

header('Content-type: application/json');

require 'app/database.php';
require 'routes.php';

const ROUTE = 3;
const PARAMS = 4;

$request = explode('/', $_SERVER['REQUEST_URI'], 5);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$params = [];
if ($requestMethod != 'POST') {
	if (isset($request[PARAMS])) {
		$params['id'] = str_replace('%20', ' ', $request[PARAMS]);
	} else {
		$queryString = $_SERVER['QUERY_STRING'];

		if (count($queryString) > 0) {
			$parameters[] = $queryString;
			if (strpos($queryString, '&') !== FALSE) {
				$parameters = explode('&', $queryString);
			}

			$params = [];
			foreach ($parameters as $p) {
				$arr = explode('=', $p);
				$params[$arr[0]] = str_replace('%20', ' ', $arr[1]);
			}

			$request[ROUTE] = explode('?', $request[ROUTE])[0];
		}
	}
} else {
	$params = $_POST;
}

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
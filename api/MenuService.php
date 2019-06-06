<?php

function getMenus()
{
	global $mysqli;

	$menus = [];
	$sql = "SELECT DISTINCT(menu.id), menu.nome, menu.link, menu.icone, menu.ordem
			FROM usuario_grupo
			JOIN grupo ON grupo.id = usuario_grupo.grupo_id
			JOIN grupo_menu ON grupo_menu.grupo_id = grupo.id
			JOIN menu ON menu.id = grupo_menu.menu_id
			WHERE md5(usuario_grupo.usuario_id) = '{$_SESSION['id']}'";
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		  $menus[] = $row;
		}
		$result->free();
	}

	return $menus;
}
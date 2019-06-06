<?php

function deleteEndereco($id)
{
	global $mysqli;
	$sql = "DELETE FROM cliente_endereco WHERE id = {$id}";
	if ($mysqli->query($sql)) {
		return ['message' => 'Deletado com sucesso!'];
	}

	return ['message' => 'Ocorreu um erro ao deletar o registro!'];
}
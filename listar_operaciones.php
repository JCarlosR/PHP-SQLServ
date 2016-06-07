<?php
	/*
		Este WS nos permite obtener un listado
		de clientes, consultando la tabla PERSONA.
	*/

	require 'conexion.php';
	header('Content-Type: application/json');

	$sql = "SELECT * FROM OPERACION";
	$params = [];

	$result_set = sqlsrv_query($conexion, $sql, $params);

	if( $result_set === false ) {
		$data['success'] = false;
		$data['message'] = sqlsrv_errors()[0]['message'];
		die( json_encode($data) );
	}

	echo resultSetToJson('operaciones', $result_set);

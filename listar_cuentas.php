<?php
	/*
		Este WS nos permite obtener un listado
		de clientes, consultando la tabla PERSONA.
	*/

	require 'conexion.php';
	header('Content-Type: application/json');
	
	if ( isset($_GET['idPersona']) ) {
		$idPersona = $_GET['idPersona'];	
	} else {
		$data['success'] = false;
		$data['message'] = 'No se ha indicado un cliente válido.';
		die( json_encode($data) );
	}

	$sql = "SELECT * FROM CUENTA WHERE idPersona = (?)";
	$params = [ $idPersona ];

	$result_set = sqlsrv_query($conexion, $sql, $params);

	if( $result_set === false ) {
		$data['success'] = false;
		$data['message'] = sqlsrv_errors()[0]['message'];
		die( json_encode($data) );
	}

	echo resultSetToJson('cuentas', $result_set);

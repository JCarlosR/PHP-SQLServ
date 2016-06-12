<?php
/*
	Este WS nos permite registrar un movimiento
	usando SP_InsertarMovimiento.
*/
	require 'conexion.php';
	//header('Content-Type: application/json');

	$sql_SP = "{ CALL SP_InsertarMovimiento(?, ?, ?, ?, NULL, ?) }";
/*
   200,
   'CTA1',
   600,
   'RE',
   1
*/
   	if ( !isset($_GET['idMovimiento']) || !isset($_GET['idCuenta'])
   		|| !isset($_GET['importe']) || !isset($_GET['idOperacion']) || !isset($_GET['tipo']) ) {
   		$data['success'] = false;
   		$data['message'] = 'No se han indicado todos los parámetros requeridos.';
   		die( json_encode($data) );
   	}

	$idMovimiento = $_GET['idMovimiento'];
	$idCuenta = $_GET['idCuenta'];
	$importe = $_GET['importe'];
	$idOperacion = $_GET['idOperacion'];
	$tipo = $_GET['tipo'];

	$params = [
		$idMovimiento,
		$idCuenta,
		$importe,
		$idOperacion,
		$tipo
	];

	$result_set = sqlsrv_query( $conexion, $sql_SP, $params );

	if( $result_set === false ) {
		$data['success'] = false;
		$message = sqlsrv_errors()[0]['message'];
		$position = strrpos($message, ']');
		$data['message'] = substr($message, $position+1);
		die( json_encode($data) );
	}

	echo resultSetToJson('cuentas', $result_set);

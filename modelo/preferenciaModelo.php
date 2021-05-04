<?php

require_once 'conexion.php';

class Preferencia{

    /*=============================================
	INSERTAR PREFERENCIA
	=============================================*/

	static public function insertarPreferencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( id_preferencia, descripcion, ip) VALUES ( :id_preferencia, :descripcion, :ip)");

		$stmt -> bindParam(":id_preferencia", $datos["id_preferencia"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ip", $datos["ip"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();

		$stmt = null;

	}


	static public function updatePreferencia($tabla, $campo, $valor, $id_preferencia){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $campo = :$campo WHERE id_preferencia = :id_preferencia");

		$stmt -> bindParam(":$campo", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_preferencia", $id_preferencia, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
    		print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();

		$stmt = null;

	}

}
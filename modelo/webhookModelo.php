<?php

require_once 'conexion.php';

class WebHook{

	/**==============================================
	 GET ALL WEBHOOK
	 *=============================================**/
	static public function allWebHook($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY wid DESC ");
		$stmt -> execute();
		return $stmt -> fetchAll();
	} 
	
    /*=============================================
	INSERTAR WEBHOOK
	=============================================*/

	static public function insertarWebHook($tabla, $datos){

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

}
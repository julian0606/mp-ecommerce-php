<?php

class Conexion{

	static public function conectar(){
		$host_url = 'localhost';
		if($_SERVER['HTTP_HOST'] == 'localhost'){
			$host_url = '192.254.185.180';
		}

		$link = new PDO("mysql:host=$host_url;dbname=cuboieas_mp",
						"cuboieas_cuboiea",
						"Mercado123*");

		$link->exec("set names utf8");

		return $link;

	}


}
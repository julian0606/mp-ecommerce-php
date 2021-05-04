<?php

class ControladorWebHook{

    static public function ctrInsertarWebHook($datos){
        $tabla = 'webhook';
        $respuesta = WebHook::insertarWebHook($tabla, $datos);
        return $respuesta;
    }

    static public function ctrAllWebHook(){
        $tabla = 'webhook';
        $respuesta = WebHook::allWebHook($tabla);
        return $respuesta;
    }

    static public function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }
}
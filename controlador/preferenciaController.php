<?php

class ControladorPreferencia{

    static public function ctrUpdateRespuesta($valor, $id_preferencia){
        $tabla = 'preferencia';
        $respuesta = Preferencia::updatePreferencia($tabla, 'respuesta', $valor, $id_preferencia);
        return $respuesta;
    }
}
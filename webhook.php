<?

require_once 'modelo/webhookModelo.php';
require_once 'controlador/webHookController.php';


/**========================================================================
 *?                           DATOS DE INSERCIION
 *========================================================================**/
$data_json = json_decode(file_get_contents('php://input'), true);
$datos= array();
$datos['ip'] = ControladorWebHook::getRealIP();
$datos['id_preferencia'] = NULL;
$datos['descripcion'] = json_encode($data_json , JSON_UNESCAPED_SLASHES );
// json_encode( $_REQUEST, JSON_UNESCAPED_SLASHES );

$respuesta = ControladorWebHook::ctrInsertarWebHook($datos);
if($respuesta == 'ok'){
    echo "WebHook Registrado correctamente";
}else{
    echo "Error insertando WebHook";
}
<?
/**--------------------------------------------
 *               checkout
 *---------------------------------------------**/


function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}

$url = $_SERVER['HTTP_REFERER'];

$imgProducto = $url.$_POST['img'];
$nombreProducto = $_POST['title'];
$precioUnitario = (int)$_POST['price'];
$cantidad = (int)$_POST['unit'];

require 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken(PROD_ACCESS_TOKEN);
MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Pagador
$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_83958037@testuser.com";
$payer->phone = array(
    "area_code" => "52",
    "number" => "5549737300"
);
$payer->address = array(
    "street_name" => "Insurgentes Sur",
    "street_number" => 1602,
    "zip_code" => "03940"
);
$preference->payer = $payer;

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = 1234;
$item->title = $nombreProducto;
$item->description = "Dispositivo móvil de Tienda e-commerce";
$item->picture_url = $imgProducto;
$item->quantity = $cantidad;
$item->unit_price = $precioUnitario;

//Agregar item a la preferencia
$preference->items = array($item);

/**================================================================================================
 *                                         BACK URL
 *================================================================================================**/
$preference->back_urls = array(
    "success" => $url."success.php",
    "pending" => $url."pending.php",
    "failure" => $url."failure.php"
);

$preference->auto_return = 'approved';

/**==================================================================
 *    EXCLUSIONES DE PAGO
 * 
 * 1. NO Tarjeta de credito american express
 * 2. NO Tipo de pago por cajero automatico
 * 3. Maximo 6 cuotas
 * 
 *====================================================================**/

$preference->payment_methods = array(
    "excluded_payment_methods" => array(
      array("id" => "amex")
    ),
    "excluded_payment_types" => array(
      array("id" => "atm")
    ),
    "installments" => 6
);

/**==================================================================
 *    EXTERNAL REFERENCIA AUTOR
 *====================================================================**/
$preference->external_reference = 'julian0606@gmail.com';

/**------------------------------------------------------------------------
 **                            WEBHOOK
 *------------------------------------------------------------------------**/
$preference->notification_url =  $url."webhook.php";


$preference->save();

//no funciona para localhost
$ip = getRealIP();

$idPreferencia = $preference->id;
$sandboxInitPoint = $preference->sandbox_init_point;
$initPoint = $preference->init_point;

/**------------------------------------------------------------------------
 **                            GUARDAR INFORMACION DE LA PREFERENCIA EN BD
 *------------------------------------------------------------------------**/
$dataSave = array();
$dataSave['id_preferencia'] = $idPreferencia; 
$dataSave['descripcion'] = json_encode( $preference->getAttributes(), JSON_UNESCAPED_SLASHES ); 
$dataSave['ip'] = $ip;

Preferencia::insertarPreferencia('preferencia', $dataSave);

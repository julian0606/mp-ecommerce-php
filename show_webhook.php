<?

require_once 'modelo/webhookModelo.php';
require_once 'controlador/webHookController.php';


/**========================================================================
 *?                          OBTENER DATOS
 *========================================================================**/
$datos = ControladorWebHook::ctrAllWebHook();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- BOOTSTRAP JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <title>Show Webhook</title>
</head>
<body>
    <h1 >Show Webhook</h1>
    <br>
    <div class="accordion" id="accordionExample">
        <?php 
        foreach($datos as $i => $valor)
        {
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_<?=$i?>">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?=$i?>" aria-expanded="true" aria-controls="collapse_<?=$i?>">
                    <?= $valor['fecha_web'] ?>
                </button>
                </h2>
                <div id="collapse_<?=$i?>" class="accordion-collapse collapse <?=($i==0)?'show':'';?>" aria-labelledby="heading_<?=$i?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <pre><?= $valor['descripcion'] ?></pre>
                </div>
                </div>
            </div>
            <?
        }
        ?>


    </div>
</body>
</html>
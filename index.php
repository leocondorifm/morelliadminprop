	
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "controller/template.controller.php";

//require_once "model/template.model.php";

//require_once "modelos/rutas.php";

//require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
//require_once "extensiones/vendor/autoload.php";

$template = new ControllerTemplate();
$template -> template();
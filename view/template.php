<?php 
    session_start();
    $_SESSION["login"]=false;

    $rutas = array();
    if(isset($_GET["ruta"])){
        $rutas = explode("/", $_GET["ruta"]);
        $ruta = $rutas[0];
    }else{
        $ruta = "start";
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Morelli - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="view/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="view/assets/css/sb-admin-2.min.css" rel="stylesheet">
    
    <link href="view/assets/css/index.css?v=1.2" rel="stylesheet">

</head>
<?php
    if(isset($_SESSION["login"]) && $_SESSION["login"]===true){
        include_once("cards/home.php");
    }else{
        if($ruta==="forgot"){
            include_once("cards/forgot.php");
        }else{
            include_once("cards/login.php");
        }
        
    }
?>
    <!-- Bootstrap core JavaScript-->
    <script src="view/assets/vendor/jquery/jquery.min.js"></script>
    <script src="view/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="view/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="view/assets/js/sb-admin-2.min.js"></script>

</html>
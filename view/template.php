<?php 
    session_start();
   
    $rutas = array();
    if(isset($_GET["ruta"])){
        $rutas = explode("/", $_GET["ruta"]);
        $ruta = $rutas[0];
    }else{
        $ruta = "start";
    }
    $data = parse_ini_file('./_dev.ini');
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
    <base href="http://localhost/morelliadminprop/" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <link href="view/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="view/assets/css/styles.css" rel="stylesheet">
    <link href="view/assets/css/sb-admin-2.min.css?v=1.1" rel="stylesheet">
    <link href="view/assets/css/index.css?v=2.6" rel="stylesheet">

    <script data-search-pseudo-elements="" defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>

</head>
<?php
    if(isset($_SESSION["login"]) && $_SESSION["login"]===true){

        $session = $_SESSION["fk_exp_admin"];
        if($ruta==="logout"){
            include_once("cards/logout.php");
        }else{
            include_once("cards/home.php");
        }
    }else{

        $session = "anonymous";
        if($ruta==="forgot"){
            include_once("cards/forgot.php");
        }
        if($ruta==="start"){
            include_once("cards/login.php");
        }
        if($ruta==="changepass"){
            include_once("cards/changepass.php");
        }

    }
    
?>

    <input type="hidden" id="url_base" value="<?php echo $data["route"];?>">
    <input type="hidden" id="fk_exp_u" value="<?php echo $session;?>">
    <!-- Bootstrap core JavaScript-->
    <script src="view/assets/vendor/jquery/jquery.min.js"></script>
    <script src="view/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="view/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="view/assets/js/sb-admin-2.min.js"></script>


    <script data-cfasync="false" src="view/assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="view/assets/js/scripts.js"></script>
    <!--<script src="https://assets.startbootstrap.com/js/sb-customizer.js"></script>-->
    <!-- Setting Coustom <sb-customizer project="sb-admin-pro"></sb-customizer>-->
    
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- Admin. SESSION -->
    <script src="view/assets/js/login/login.js?v=4.3"></script>
    <script src="view/assets/js/location/getlocation.js?v=1.3"></script>
    <script src="view/assets/js/settings/index.js?v=1.3"></script>
</html>
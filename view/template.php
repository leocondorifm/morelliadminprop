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
        if($ruta==="logout"){
            include_once("cards/logout.php");
        }else{
            include_once("cards/home.php");
        }
    }else{
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

    <!-- Bootstrap core JavaScript-->
    <script src="view/assets/vendor/jquery/jquery.min.js"></script>
    <script src="view/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="view/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="view/assets/js/sb-admin-2.min.js"></script>


    <script data-cfasync="false" src="view/assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="view/assets/js/scripts.js"></script>
    <script src="https://assets.startbootstrap.com/js/sb-customizer.js"></script>
    <sb-customizer project="sb-admin-pro"></sb-customizer>
    <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'89f3c6751954b528',t:'MTcyMDMxMjc0My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"89f3c6751954b528","b":1,"version":"2024.4.1","token":"6e2c2575ac8f44ed824cef7899ba8463"}' crossorigin="anonymous"></script>

    <!-- Admin. SESSION -->
    <script src="view/assets/js/login/login.js?v=4.3"></script>

</html>
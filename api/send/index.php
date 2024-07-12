<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires'); 

    /* TEMPORAL */
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    /* FIN TEMPORAL */
    
    include('../library/app.php');

    $data = parse_ini_file('../../_dev.ini');
    
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Selective\BasePath\BasePathMiddleware;
    use Psr\Http\Message\ResponseInterface;
    use Slim\Exception\HttpNotFoundException;
    use Slim\Factory\AppFactory;
    use Selective\BasePath\BasePathDetector;
  //require_once('/var/www/public_html/config.php'); 
    require_once('../vendor/autoload.php');

    $app = AppFactory::create();

    // Add Slim routing middleware
    $app->addRoutingMiddleware();
    $app->setBasePath("/morelliadminprop/api/send");
    $app->addErrorMiddleware(true, true, true);

    $servername = "localhost"; // Nombre del servidor
    $username = "root"; // Nombre de usuario
    $password = ""; // Contraseña
    $dbname = "MORELLI"; // Nombre de la base de datos

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        //echo "Connection failed: " . $e->getMessage();
    }

    //TEST
    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) use ($conn) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });
    //FIN TEST

    /* OBETENER */
    $app->get('/property/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_admin = $args['id'];
        $stmt = $conn->prepare("SELECT f.fk_exp_building, b.short_name  FROM `EXP_FILES` f JOIN EXP_BUILDING b on f.fk_exp_building=b.id WHERE f.fk_exp_admin = '".$fk_exp_admin."' GROUP BY f.fk_exp_building");

        if($stmt->execute()){
            $tipProp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //writeLN('Petición de tip_prop. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$tipProp, "count"=>count($tipProp))));
            return $response;
        }else{
            //writeLN('Petición de tip_prop. No satisfactorio.');
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/file/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_admin = $args['id'];
        $stmt = $conn->prepare("SELECT f.fk_exp_building, b.short_name  FROM `EXP_FILES` f JOIN EXP_BUILDING b on f.fk_exp_building=b.id WHERE f.fk_exp_admin = '".$fk_exp_admin."' GROUP BY f.fk_exp_building");

        if($stmt->execute()){
            $tipProp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //writeLN('Petición de tip_prop. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$tipProp, "count"=>count($tipProp))));
            return $response;
        }else{
            //writeLN('Petición de tip_prop. No satisfactorio.');
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->run();

?>
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
    $app->setBasePath("/morelliadminprop/api/settings");
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
        $app->get('/', function (Request $request, Response $response) {
            $response->getBody()->write("Hello, world!");
            return $response;
        });

        $app->get('/hello/{name}', function (Request $request, Response $response, array $args) use ($conn) {
            $name = $args['name'];
            $response->getBody()->write("Hello, $name");
            return $response;
        });
    //FIN TEST

    /*ALTA*/
    $app->post('/', function (Request $request, Response $response, array $args) use ($conn) {
        
        $data = $request->getParsedBody();

        $fk_exp_admin = $data['fk_exp_u'];//User
        $description = $data['description'];

		$stmt = $conn->prepare("INSERT INTO EXP_TIP_PRO (description, fk_exp_admin ) VALUES (:description, :fk_exp_admin )");
        
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);

        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Propiedad creada con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

        return $response->withHeader('Content-Type', 'application/json');

    });

    /* OBETENER */
    $app->get('/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_admin = $args['id'];
        $stmt = $conn->prepare("SELECT * FROM EXP_TIP_PRO WHERE fk_exp_admin = '".$fk_exp_admin."' ORDER BY ID DESC");

        if($stmt->execute()){
            $tipProp = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //writeLN('Petición de tip_prop. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$tipProp)));
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
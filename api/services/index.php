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
    
    require_once('../vendor/autoload.php');

    $app = AppFactory::create();

    if($_SERVER['HTTP_HOST']=="localhost"){
        $servername = $data["dbd.config.host"]; // Nombre del servidor
        $username = $data["dbd.config.username"]; // Nombre de usuario
        $password = $data["dbd.config.password"]; // Contraseña
        $dbname = $data["dbd.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_desa"].$data["api_services"];
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_prod"].$data["api_services"];
    }

    // Add Slim routing middleware
    $app->addRoutingMiddleware();
    $app->setBasePath($basepath);
    $app->addErrorMiddleware(true, true, true);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        //echo "Connection failed: " . $e->getMessage();
    }


    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) use ($conn) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });
    //FIN TEST


    /* SERVICES */
    $app->get('/{id}', function (Request $request, Response $response, array $args) use ($conn) {

        $fk_exp_admin = $args['id'];

        $stmt = $conn->prepare("SELECT * FROM `EXP_SERVICE` WHERE fk_exp_admin = '".$fk_exp_admin."' AND status='0' ");

        if($stmt->execute()){
            $service = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$service)));
            return $response;
        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    /* POST CURRENCY */
    $app->post('/', function (Request $request, Response $response, array $args) use ($conn) {
            
        $data = $request->getParsedBody();

        $fk_exp_admin = $data['fk_exp_u'];//User
        $serurl = $data['ser-url'];
        $sertit = $data['ser-tit'];
        $serdes = $data['ser-des'];
        $sercon = $data['ser-con'];
        $sertel = $data['ser-tel'];

        $stmt = $conn->prepare("INSERT INTO EXP_SERVICE (url_image, title, description, contacto, telefono, fk_exp_admin ) VALUES (:url_image, :title, :description, :contacto, :telefono, :fk_exp_admin )");
        
        $stmt->bindParam(":url_image", $serurl, PDO::PARAM_STR);
        $stmt->bindParam(":title", $sertit, PDO::PARAM_STR);
        $stmt->bindParam(":description", $serdes, PDO::PARAM_STR);
        $stmt->bindParam(":contacto", $sercon, PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $sertel, PDO::PARAM_STR);
        $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);

        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Servicio creado con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

        return $response->withHeader('Content-Type', 'application/json');

    });

    $app->put('/{id}/{fk_exp_admin}', function (Request $request, Response $response, array $args) use ($conn) {
        
        //$data = $request->getParsedBody();

        $id = $args['id'];
        $fk_exp_admin = $args['fk_exp_admin'];

        $stmt = $conn->prepare("UPDATE EXP_SERVICE SET status = '1' WHERE id='".$id."' and fk_exp_admin = '".$fk_exp_admin."' ");

        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Servicio eliminado con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

        return $response->withHeader('Content-Type', 'application/json');

    });

    $app->run();

?>
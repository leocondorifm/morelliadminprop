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

    if($data["modo"]=="desarrollo"){
        $servername = $data["dbd.config.host"]; // Nombre del servidor
        $username = $data["dbd.config.username"]; // Nombre de usuario
        $password = $data["dbd.config.password"]; // Contraseña
        $dbname = $data["dbd.config.dbname"]; // Nombre de la base de datos
        $basepath = "/morelliadminprop/api/newsletter";
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = "/api/newsletter";
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

    //TEST
    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) use ($conn) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });
    //FIN TEST

    /* GET */
    $app->get('/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_admin = $args['id'];
        $stmt = $conn->prepare("SELECT id, short_name FROM EXP_BUILDING WHERE fk_exp_admin = '".$fk_exp_admin."' ORDER BY ID ASC");
        $property = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($stmt->execute()){
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$property,"count"=>count($property))));
            return $response;
        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });
 
    /*ALTA*/
    $app->post('/', function (Request $request, Response $response, array $args) use ($conn) {
        
        $data = $request->getParsedBody();

        
        $description = $data['description'];
        $fk_exp_building = $data['fk_exp_building'];
        $body_mail = $data['body_mail'];
        $email = $data['email'];
        $fk_exp_admin = $data['fk_exp_u'];//User

		$stmt = $conn->prepare("INSERT INTO EXP_NEWSLETTER (description, fk_exp_building, body_mail, email, fk_exp_admin ) VALUES (:description, :fk_exp_building, :email, :body_mail, :fk_exp_admin )");
        
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":fk_exp_building", $fk_exp_building, PDO::PARAM_INT);
        $stmt->bindParam(":body_mail", $body_mail, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);//user

        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Newsletter creado con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

        return $response->withHeader('Content-Type', 'application/json');

    });

    /* OBETENER */
    $app->get('/plain/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_admin = $args['id'];
        $stmt = $conn->prepare("SELECT id, description FROM EXP_NEWSLETTER WHERE fk_exp_admin = '".$fk_exp_admin."' ORDER BY ID DESC");

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
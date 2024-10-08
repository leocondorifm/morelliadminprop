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

    if($_SERVER['HTTP_HOST']=="localhost"){
        $servername = $data["dbd.config.host"]; // Nombre del servidor
        $username = $data["dbd.config.username"]; // Nombre de usuario
        $password = $data["dbd.config.password"]; // Contraseña
        $dbname = $data["dbd.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_desa"].$data["api_send"];
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_prod"].$data["api_send"];
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

    /* OBETENER */
    $app->get('/property/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_admin = $args['id'];
        $stmt = $conn->prepare("SELECT f.*, b.* FROM `EXP_FILES` f JOIN EXP_BUILDING b on f.fk_exp_building=b.id WHERE f.fk_exp_admin = '".$fk_exp_admin."'  and b.status='0' GROUP BY f.fk_exp_building");

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
        $stmt = $conn->prepare("SELECT f.fk_exp_building, b.short_name  FROM `EXP_FILES` f JOIN EXP_BUILDING b on f.fk_exp_building=b.id WHERE f.fk_exp_admin = '".$fk_exp_admin."' and status='0' GROUP BY f.fk_exp_building");

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

    $app->get('/property/newsletter/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_building = $args['id'];
        $stmt = $conn->prepare("SELECT * FROM `EXP_NEWSLETTER` WHERE fk_exp_building = '".$fk_exp_building."' ");

        if($stmt->execute()){
            $getData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //writeLN('Petición de tip_prop. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$getData, "count"=>count($getData))));
            return $response;
        }else{
            //writeLN('Petición de tip_prop. No satisfactorio.');
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/property/remitentes/{id}/{idp}/{idu}', function (Request $request, Response $response, array $args) use ($conn) {
        $id = $args['id'];
        $idp = $args['idp'];
        $idu = $args['idu'];

        $stmt = $conn->prepare("SELECT * FROM `EXP_NEWSLETTER` WHERE fk_exp_building = '".$idp."' and id = '".$id."' and fk_exp_admin = '".$idu."' ");

        if($stmt->execute()){
            $getData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //writeLN('Petición de tip_prop. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$getData, "count"=>count($getData))));
            return $response;
        }else{
            //writeLN('Petición de tip_prop. No satisfactorio.');
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/data/{idp}/{idn}/{user}', function (Request $request, Response $response, array $args) use ($conn) {

        $idp = $args['idp'];
        $idn = $args['idn'];
        $fk_exp_admin = $args['user'];

        $stmt = $conn->prepare("SELECT * FROM `EXP_FILES` WHERE fk_exp_building = '".$idp."' and fk_exp_newsletter = '".$idn."' and fk_exp_admin = '".$fk_exp_admin."' ");

        if($stmt->execute()){
            $tipProp = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$tipProp, "count"=>count($tipProp), "query"=>$stmt )));

        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }); 

    $app->get('/{owner}', function (Request $request, Response $response, array $args) use ($conn) {

        $id = $args['owner'];

        $stmt = $conn->prepare("SELECT
                                P.id,
                                B.short_name,
                                N.description as newsletter,
                                F.description as filename,
                                P.last_modify as date
                                FROM `EXP_PLANING` P
                                JOIN `EXP_BUILDING` B on B.id=P.fk_exp_property
                                JOIN `EXP_NEWSLETTER` N on N.id=P.fk_exp_newsletter
                                JOIN `EXP_FILES` F on F.id=P.fk_exp_files
                                WHERE P.fk_exp_admin = '".$id."' and B.status='0' ");

        if($stmt->execute()){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$data, "count"=>count($data) )));

        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }); 

    $app->run();

?>
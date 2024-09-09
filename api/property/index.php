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
        $basepath = $data["api_base_desa"].$data["api_property"];
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_prod"].$data["api_property"];
    }

    // Add Slim routing middleware
    $app->addRoutingMiddleware();
    $app->setBasePath($basepath);
    $app->addErrorMiddleware(true, true, true);

    try{
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

        $short_name = $data['short_name'];
        $fk_exp_tip_pro = $data['fk_exp_tip_pro'];
        $address = $data['address'];
        $number = $data['number'];
        $cp = $data['cp'];

        $fk_sp_provincias = $data['fk_sp_provincias'];
        $fk_sp_partidos = $data['fk_sp_partidos'];
        $fk_sp_localidades = $data['fk_sp_localidades'];

        $building_user = $data['building_user'];
        $building_pass = $data['building_pass'];

        $num_floors = $data['num_floors'];
        $num_dep_start = $data['num_dep_start'];
        $num_dep_end = $data['num_dep_end'];

        //$response->getBody()->write(json_encode(array("status" => 0, "message" => $fk_exp_u)));
        //return $response;
		$stmt = $conn->prepare("INSERT INTO EXP_BUILDING (fk_exp_admin, short_name, fk_exp_tip_pro, address, number, cp, fk_sp_provincias, fk_sp_partidos, fk_sp_localidades, building_user, building_pass, num_floors, num_dep_start, num_dep_end ) VALUES (:fk_exp_admin, :short_name, :fk_exp_tip_pro, :address, :number, :cp, :fk_sp_provincias, :fk_sp_partidos, :fk_sp_localidades, :building_user, :building_pass, :num_floors, :num_dep_start, :num_dep_end )");
        
        $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);
        $stmt->bindParam(":short_name", $short_name, PDO::PARAM_STR);
        $stmt->bindParam(":fk_exp_tip_pro", $fk_exp_tip_pro, PDO::PARAM_INT);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":number", $number, PDO::PARAM_INT);
        $stmt->bindParam(":cp", $cp, PDO::PARAM_INT);
        $stmt->bindParam(":fk_sp_provincias", $fk_sp_provincias, PDO::PARAM_INT);
        $stmt->bindParam(":fk_sp_partidos", $fk_sp_partidos, PDO::PARAM_INT);
        $stmt->bindParam(":fk_sp_localidades", $fk_sp_localidades, PDO::PARAM_INT);
        $stmt->bindParam(":building_user", $building_user, PDO::PARAM_STR);
        $stmt->bindParam(":building_pass", $building_pass, PDO::PARAM_STR);
        $stmt->bindParam(":num_floors", $num_floors, PDO::PARAM_STR);
        $stmt->bindParam(":num_dep_start", $num_dep_start, PDO::PARAM_STR);
        $stmt->bindParam(":num_dep_end", $num_dep_end, PDO::PARAM_STR);

        if($stmt->execute()){
            $property = $stmt->fetch(PDO::FETCH_ASSOC);
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
        $stmt = $conn->prepare("SELECT * FROM EXP_BUILDING WHERE fk_exp_admin = '".$fk_exp_admin."' and status='0' ORDER BY ID DESC");

        if($stmt->execute()){
            $getProperty = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$getProperty)));
            return $response;
        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    /* OBETENER POR ID */
    $app->get('/{id}/{idprop}', function (Request $request, Response $response, array $args) use ($conn) {
        $fk_exp_admin = $args['id'];
        $idprop = $args['idprop'];
        $stmt = $conn->prepare("SELECT * FROM EXP_BUILDING WHERE fk_exp_admin = '".$fk_exp_admin."' and id='".$idprop."' and status='0' ORDER BY ID DESC");

        if($stmt->execute()){
            $getProperty = $stmt->fetch(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$getProperty)));
            return $response;
        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->put('/update', function (Request $request, Response $response, array $args) use ($conn) {
        $data = $request->getParsedBody();

        $id = $data['id_property'];
        $fk_exp_u = $data['fk_exp_u'];

        $shortname = $data['shortname'];
        $typeproperty = $data['typeproperty'];
        $street = $data['street'];
        $numberaddress = $data['numberaddress'];
        $cpaddress = $data['cpaddress'];
        $province = $data['province'];
        $partido = $data['partido'];
        $localidad = $data['localidad'];
        $num_floors = $data['num_floors'];
        $num_dep_start = $data['num_dep_start'];
        $num_dep_end = $data['num_dep_end'];
        $userbuild = $data['userbuild'];
        $passbuild = $data['passbuild'];

        $stmt = $conn->prepare("UPDATE EXP_BUILDING 
                                SET 
                                short_name = '".$shortname."',
                                fk_exp_tip_pro = '".$typeproperty."',
                                address = '".$street."',
                                number = '".$numberaddress."',
                                cp='".$cpaddress."',
                                fk_sp_provincias='".$province."',
                                fk_sp_partidos='".$partido."',
                                fk_sp_localidades='".$localidad."',
                                building_user='".$userbuild."',
                                building_pass='".$passbuild."',
                                num_floors='".$num_floors."',
                                num_dep_start='".$num_dep_start."',
                                num_dep_end = '".$num_dep_end."'
                                WHERE id='".$id."' and fk_exp_admin = '".$fk_exp_u."' ");

        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Servicio actualizado con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

    });

    $app->get('/scan/{folder}', function (Request $request, Response $response, array $args) use ($conn) {

        $folder = $args['folder'];
        // Ruta del directorio que quieres explorar
        $dir = __DIR__ . '/uploads/'.$folder;
        
        // Comprobar si la ruta es un directorio válido
        if (is_dir($dir)) {
            $storage = [];
            // Obtener el contenido del directorio
            $files = scandir($dir);

            // Recorrer y mostrar el contenido del directorio
            foreach ($files as $file) {
                // Omitir los elementos '.' y '..'
                if ($file != "." && $file != ".." && $file != "__MACOSX") {
                    array_push($storage, $file);
                }
            }

            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Acceso correcto", "data"=>$storage, "base"=>$folder, "count"=>count($storage))));
        } else {
            $response->getBody()->write(json_encode( array ("status" => 1, "message" => "La ruta especificada no es un directorio válido") ));
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->put('/update/delete', function (Request $request, Response $response, array $args) use ($conn) {
        $data = $request->getParsedBody();

        $id = $data['id_property'];
        $fk_exp_u = $data['fk_exp_u'];
        $status = $data['status'];

        $stmt = $conn->prepare("UPDATE EXP_BUILDING 
                                SET 
                                status = '".$status."'
                                WHERE id='".$id."' and fk_exp_admin = '".$fk_exp_u."' ");

        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Propiedad eliminada con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

    });

    $app->run();
?>
<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires'); 

    /* TEMPORAL */
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    /* FIN TEMPORAL */
    
    include('library/app.php');

    $data = parse_ini_file('../_dev.ini');
    
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Selective\BasePath\BasePathMiddleware;
    use Psr\Http\Message\ResponseInterface;
    use Slim\Exception\HttpNotFoundException;
    use Slim\Factory\AppFactory;
    use Selective\BasePath\BasePathDetector;

    require_once __DIR__ . '/vendor/autoload.php';

    $app = AppFactory::create();


    if($_SERVER['HTTP_HOST']=="localhost"){
        $servername = $data["dbd.config.host"]; // Nombre del servidor
        $username = $data["dbd.config.username"]; // Nombre de usuario
        $password = $data["dbd.config.password"]; // Contraseña
        $dbname = $data["dbd.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_desa"].$data["api"];
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_prod"].$data["api"];
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
        echo "Connection failed:".$data["modo"]." " . $e->getMessage();
    }

    // Define app routes
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write("Hello, world!");
        return $response;
    });

    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) use ($conn) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });

    /* LOCATION */
    $app->get('/province', function (Request $request, Response $response, array $args) use ($conn) {
        $stmt = $conn->prepare("SELECT * FROM sp_provincias");
        $stmt->execute();
        $location = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($location){
            writeLN('Petición de procincias. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$location)));
            return $response;
        }else{
            writeLN('Petición de procincias. No satisfactorio.');
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/province/partido/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $id_provincia = $args['id'];
        $stmt = $conn->prepare("SELECT * FROM `sp_partidos` WHERE fk_sp_provincias = '".$id_provincia."' ");
        $stmt->execute();
        $partido = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($partido){
            writeLN('Petición de partido. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$partido)));
            return $response;
        }else{
            writeLN('Petición de partido. No satisfactorio.');
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/province/partido/localidad/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        $id_partido = $args['id'];
        $stmt = $conn->prepare("SELECT * FROM `sp_localidades` WHERE fk_sp_partidos = '".$id_partido."' ");
        $stmt->execute();
        $localidad = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($localidad){
            writeLN('Petición de partido. Satisfactorio.');
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$localidad)));
            return $response;
        }else{
            writeLN('Petición de partido. No satisfactorio.');
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });
    /* FIN LOCATION */

    /* USUARIO*/
    $app->get('/user/validate/{user}', function (Request $request, Response $response, array $args) use ($conn) {

        $user = $args['user'];
        $stmt = $conn->prepare("SELECT * FROM EXP_ADMIN WHERE admin_user = :admin_user AND validado = '1' ");
        $stmt -> bindParam(":admin_user", $user, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->execute()){
            $users = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($users){
                writeLN('entra Admin: '.$args['user']);//Log de evento
                $response->getBody()->write(json_encode(array("status" => 0, "message" => "Usuario admin existente.")));
                return $response;
            }else{//Entro acá porque el admin no lo encontré, quizá sea uno del consorcio.
                $stmt = $conn->prepare("SELECT * FROM EXP_BUILDING WHERE building_user = :building_user");
                $stmt -> bindParam(":building_user", $user, PDO::PARAM_STR);
                
                if($stmt->execute()){
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($user) {
                        writeLN('entra Consorcio: '.$args['user']);//Log de evento
                        $response->getBody()->write(json_encode(array("status" => 0, "message" => "Usuario final existente.")));
                        return $response;
                    }else{
                        writeLN('intento de ingreso como consorcio: '.$args['user']);//Log de evento
                        $response->getBody()->write(json_encode( array("status" => 1, "message" => "Usuario inexistente o no autorizado.")));
                        return $response;
                    }
                
                }else{//No encontré usuario como admin ni como consorcio.
                    writeLN('intento de ingreso como consorcio: '.$args['user']);//Log de evento
                    $response->getBody()->write(json_encode( array("status" => 1, "message" => "Usuario no autorizado.")));
                    return $response;
                }
            }
        }
        
        return $response->withHeader('Content-Type', 'application/json');

    });

    $app->get('/email/validate/{email}', function (Request $request, Response $response, array $args) use ($conn) {

        $user = $args['email'];
        $stmt = $conn->prepare("SELECT * FROM EXP_ADMIN WHERE email = :email AND validado = '1' ");
        $stmt -> bindParam(":email", $user, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            writeLN('Intento de reset pass. Si: '.$args['email']);//Log de evento
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Usuario existente.")));
            return $response;
        } else {
            writeLN('Intento de reset pass. No: '.$args['email']);//Log de evento
            $response->getBody()->write(json_encode( array("status" => 1, "message" => "Usuario existente o no autorizado.")));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');

    });    

    $app->post('/user/login', function (Request $request, Response $response, array $args) use ($conn) {

        $data = $request->getParsedBody();
        $user = $data['user'];
        $pass = $data['pass'];

        $stmt = $conn->prepare("SELECT * FROM EXP_ADMIN WHERE admin_user = :admin_user AND admin_pass = :admin_pass AND validado = '1' ");
        $stmt -> bindParam(":admin_user", $user, PDO::PARAM_STR);
        $stmt -> bindParam(":admin_pass", $pass, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user){
                writeLN('entra: '.$data['user'].'-'.$data['pass'].' Cantidad: '.count($user));//Log de evento
                session_start();
                $_SESSION["login"]=true;
                $_SESSION["email_session"]=$user["email"];
                $_SESSION["fk_exp_admin"]=$user["id"];
                $_SESSION["admin"]=true;
                $response->getBody()->write(json_encode(array("status" => 0, "message" => "Usuario existente.")));
                return $response;
            }else{//Entro acá porque el admin no lo encontré
                $stmt = $conn->prepare("SELECT * FROM EXP_BUILDING WHERE building_user = :building_user and building_pass = :building_pass");
                $stmt -> bindParam(":building_user", $data['user'], PDO::PARAM_STR);
                $stmt -> bindParam(":building_pass", $data['pass'], PDO::PARAM_STR);
                if($stmt->execute()){
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($user){
                        session_start();
                        $_SESSION["login"]=true;
                        $_SESSION["id_building"]=$user["id"];
                        $_SESSION["email_session"]=$user["short_name"];
                        $_SESSION["num_floors"]=$user["num_floors"];
                        $_SESSION["fk_exp_admin"]=$user["fk_exp_admin"];
                        $_SESSION["admin"]=false;
                        $response->getBody()->write(json_encode(array("status" => 0, "message" => "Usuario existente.")));
                        return $response;
                    }else{
                        writeLN('intento de ingreso como consorcio: '.$data['user']);//Log de evento
                        $response->getBody()->write(json_encode( array("status" => 1, "message" => "dice Usuario inexistente o no autorizado.")));
                        return $response;
                    }
                }
            }
        } else {

            writeLN('No entra: '.$data['user'].'-'.$data['pass']);//Log de evento
            session_start();
            $_SESSION["login"]=false;

            $response->getBody()->write(json_encode( array("status" => 1, "message" => "Usuario inexistente o no autorizado.")));
            return $response;

        }

        return $response->withHeader('Content-Type', 'application/json');

    });

    $app->post('/user/setpass', function (Request $request, Response $response, array $args) use ($conn) {

        $data = $request->getParsedBody();
        $pass1 = $data['pass1'];
        $pass2 = $data['pass2'];
        $uri_hash = $data['uri_hash'];
        $uri_mail = $data['uri_mail'];
        $md5Has = md5($uri_mail);

        if($uri_hash!=$md5Has){
            writeLN('Error en hash para cambiar la contraseña: '.$uri_hash.'-'.$uri_mail);
            $response->getBody()->write(json_encode(array("status" => 1, "message" => "Existe un problema con la validación de la petición.")));
            return $response;  
        }

        $stmt = $conn->prepare("UPDATE EXP_ADMIN SET admin_pass = :admin_pass WHERE email = :email");
		$stmt->bindParam(":admin_pass", $pass1, PDO::PARAM_STR);
        $stmt->bindParam(":email", $uri_mail, PDO::PARAM_STR);

		if($stmt->execute()){
            writeLN('Se cambió la contraseña : '.$uri_hash.'-'.$uri_mail);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "¡Contraseña actualizada con éxito!")));
            return $response;
		}else{
            writeLN('NO se cambió la contraseña : '.$uri_hash.'-'.$uri_mail.'===> '.$stmt->errorInfo());
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
		}

		$stmt->close();
		$stmt = null;

    });
    /* FIN USUARIOS */
    $app->run();
?>

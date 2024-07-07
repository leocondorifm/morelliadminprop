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

    // Add Slim routing middleware
    $app->addRoutingMiddleware();
    $app->setBasePath("/morelliadminprop/api");
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

    $app->get('/user/validate/{user}', function (Request $request, Response $response, array $args) use ($conn) {

        $user = $args['user'];
        $stmt = $conn->prepare("SELECT * FROM EXP_ADMIN WHERE admin_user = :admin_user AND validado = '1' ");
        $stmt -> bindParam(":admin_user", $user, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            writeLN('entra: '.$args['user']);//Log de evento
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Usuario existente.")));
            return $response;
        } else {
            writeLN('intento de ingreso: '.$args['user']);//Log de evento
            $response->getBody()->write(json_encode( array("status" => 1, "message" => "Usuario existente o no autorizado.")));
            return $response;
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
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            writeLN('entra: '.$data['user'].'-'.$data['pass']);//Log de evento
            session_start();
            $_SESSION["login"]=true;
            $_SESSION["email_session"]=$user["email"];
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Usuario existente.")));
            return $response;

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

    $app->run();
?>

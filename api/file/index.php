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
        $basepath = $data["api_base_desa"].$data["api_file"];
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_prod"].$data["api_file"];
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
        $response->getBody()->write("Hello, ".$name);
        return $response;
    });
    //FIN TEST

    /* GET */
    /*ALTA*/
    $app->put('/', function (Request $request, Response $response, array $args) use ($conn) {
        
        $data = $request->getParsedBody();

        $description = $data['description'];
        $fk_exp_building = $data['fk_exp_building'];
        $fk_exp_newsletter = $data['fk_exp_newsletter'];
        $patch_file = $data['patch_file'];
        $month = $data['month'];
        $year = $data['year'];

        $fk_exp_admin = $data['fk_exp_u'];//User

		$stmt = $conn->prepare("INSERT INTO EXP_FILES (description, fk_exp_building, fk_exp_newsletter, patch_file, month, year ) VALUES (:description, :fk_exp_building, :fk_exp_newsletter, :patch_file, :patch_file, :month, :year )");
        
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":fk_exp_building", $fk_exp_building, PDO::PARAM_INT);
        $stmt->bindParam(":fk_exp_newsletter", $body_mail, PDO::PARAM_INT);
        $stmt->bindParam(":patch_file", $email, PDO::PARAM_STR);
        $stmt->bindParam(":month", $email, PDO::PARAM_INT);
        $stmt->bindParam(":year", $email, PDO::PARAM_INT);
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

    $app->post('/upload', function (Request $request, Response $response, $args) use ($conn) {
        
        function getFilenameWithoutExtension($filePath) {
            // Utiliza pathinfo para obtener la información del archivo
            $pathInfo = pathinfo($filePath);
        
            // Devuelve el nombre del archivo sin la extensión
            return $pathInfo['filename'];
        }

        $directory = __DIR__ . '/uploads';
        
        // Ensure the uploads directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $data = $request->getParsedBody();
        $description = $data['description'];
        $fk_exp_building = $data['fk_exp_building'];
        $fk_exp_newsletter = $data['fk_exp_newsletter'];
        $month = $data['month'];
        $year = $data['year'];
        $uploadedFiles = $request->getUploadedFiles();

        $fk_exp_admin = $data['fk_exp_u'];//User

        if (isset($uploadedFiles['file'])) {
            $uploadedFile = $uploadedFiles['file'];
            $fileSize = $uploadedFile->getSize();
            $fileType = $uploadedFile->getClientMediaType();
            $fileFullName = $uploadedFile->getClientFilename();


            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                //$fileFullName = $uploadedFile->getClientFilename();
                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $fileFullName);
    
                // Extract ZIP file
                $zip = new ZipArchive;
                $zipPath = $directory . DIRECTORY_SEPARATOR . $fileFullName;
                $filenameWithoutExtension = getFilenameWithoutExtension($zipPath);

                if ($zip->open($zipPath) === TRUE) {
                    $zip->extractTo($directory.'/'.$filenameWithoutExtension);
                    $zip->close();
                    unlink($zipPath); // Optionally delete the ZIP file after extraction
                    //$response->getBody()->write("File uploaded and extracted successfully");
                    //$response->getBody()->write(json_encode(array("status" => 0, "message" => "Archivo cargado y extraído exitosamente.".$patch_file)));

                    $stmt = $conn->prepare("INSERT INTO EXP_FILES (description, fk_exp_building, fk_exp_newsletter, patch_file, month, year, fk_exp_admin ) VALUES (:description, :fk_exp_building, :fk_exp_newsletter, :patch_file, :month, :year, :fk_exp_admin )");
        
                    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                    $stmt->bindParam(":fk_exp_building", $fk_exp_building, PDO::PARAM_INT);
                    $stmt->bindParam(":fk_exp_newsletter", $fk_exp_newsletter, PDO::PARAM_INT);
                    $stmt->bindParam(":patch_file", $filenameWithoutExtension, PDO::PARAM_STR);
                    $stmt->bindParam(":month", $month, PDO::PARAM_INT);
                    $stmt->bindParam(":year", $year, PDO::PARAM_INT);
                    $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);//user

                    if($stmt->execute()){
                        $response->getBody()->write(json_encode(array("status" => 0, "message" => "Newsletter creado con éxito.".$filenameWithoutExtension)));
                    }else{
                        $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
                    }
                    
                } else {
                    $response->getBody()->write(json_encode(array("status" => 1, "message" => "No se pudo abrir el archivo .ZIP")));
                }
            } else {
                $response->getBody()->write(json_encode(array("status" => 1, "message" => "No se pudo subir el archivo")));
            }
        } else {
            $response->getBody()->write(json_encode(array("status" => 1, "message" => "Archivo no subido")));
        }
    
        return $response;
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

    $app->put('/delete/{folder}/{data}', function (Request $request, Response $response, array $args) use ($conn) {
        $folder = $args['folder'];
        $file = $args['data'];

        // Ruta del directorio que quieres explorar
        $dir = __DIR__ . '/uploads/'.$folder;
        $fil  = __DIR__ . '/uploads/'.$folder.'/'.$file;

        // Comprobar si la ruta es un directorio válido
        if (is_dir($dir)) {

            if(file_exists($fil)){//¿Existe el archivo?

                if(unlink($fil)){
                    $response->getBody()->write(json_encode(array("status" => 0, "message" => "Borrado correcto. ".$fil)));
                }else{
                    $response->getBody()->write(json_encode( array ("status" => 1, "message" => "No se pudo borrar el archivo: ".$fil) ));
                }

                
            }else{
                $response->getBody()->write(json_encode( array ("status" => 1, "message" => "No se pudo borrar el directorio") ));
            }

        } else {
            $response->getBody()->write(json_encode( array ("status" => 1, "message" => "La ruta especificada no es un directorio válido") ));
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/{id}', function (Request $request, Response $response, array $args) use ($conn) {
        
        $fk_exp_admin = $args['id'];
        
        $stmt = $conn->prepare("SELECT * FROM `EXP_FILES` WHERE fk_exp_admin = '".$fk_exp_admin."' ");
        $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($stmt->execute()){
            $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$files,"count"=>count($files))));
        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));

        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/edit/{id}/{idoc}', function (Request $request, Response $response, array $args) use ($conn) {
        
        $fk_exp_admin = $args['id'];
        $idoc = $args['idoc'];
        
        $stmt = $conn->prepare("SELECT * FROM `EXP_FILES` WHERE fk_exp_admin = '".$fk_exp_admin."' and id = '".$idoc."' ");
        $files = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->execute()){
            $files = $stmt->fetch(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$files,"count"=>count($files))));
        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));

        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->run();

?>
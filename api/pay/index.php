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
        $basepath = $data["api_base_desa"].$data["api_pay"];
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_prod"].$data["api_pay"];
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
    $app->get('/', function (Request $request, Response $response, array $args) use ($conn) {
        $response->getBody()->write("Hello");
        return $response;
    });

    $app->get('/hello/{name}', function (Request $request, Response $response, array $args) use ($conn) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });
    //FIN TEST

    $app->post('/upload', function (Request $request, Response $response, $args) use ($conn) {
        
        function getFilenameWithoutExtension($filePath) {
            // Utiliza pathinfo para obtener la información del archivo
            $pathInfo = pathinfo($filePath);
        
            // Devuelve el nombre del archivo sin la extensión
            return $pathInfo['filename'];
        }

        $data = $request->getParsedBody();
        $payproperty = $data['payproperty'];
        $paydata = $data['paydata'];
        $month = $data['month'];
        $year = $data['year'];
        $floors = $data['floors'];
        $depto = $data['depto'];
        $ufun = $data['ufun'];
        $paynote = $data['paynote'];
        
        $uploadedFiles = $request->getUploadedFiles();

        $fk_exp_admin = $data['fk_exp_u'];//User


        $directory = __DIR__ . '/comprobantes/propiedad/'.$year.'/'.$payproperty.'/'.$month.'/'.$floors.$depto;
        
        // Ensure the uploads directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (isset($uploadedFiles['filepay'])) {
            $uploadedFile = $uploadedFiles['filepay'];
            $fileSize = $uploadedFile->getSize();
            $fileType = $uploadedFile->getClientMediaType();
            $fileFullName = $uploadedFile->getClientFilename();
            $fileFullName = preg_replace("/[^a-zA-Z0-9.]/", "", $fileFullName);

            if($fileType=="application/zip"){
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

                        $stmt = $conn->prepare("INSERT INTO EXP_PAY (month, year, fk_exp_building, pay_method, num_floor, num_dep, ufun, patch_file, typemime, comment, fk_exp_admin ) VALUES (:month, :year, :fk_exp_building, :pay_method, :num_floor, :num_dep, :ufun, :patch_file, :typemime, :comment, :fk_exp_admin )");
            
                        // Cadena original con caracteres especiales y espacios
                        //$cadena = "Hola Mundo! ¿Cómo estás? 2024@";

                        // Reemplazar caracteres especiales y espacios, dejando solo letras y números
                        //$name_path = preg_replace("/[^a-zA-Z0-9]/", "", $fileFullName);

                        // Mostrar la cadena resultante
                        //echo $cadenaLimpia; // Salida: HolaMundoComoestas2024

                        $stmt->bindParam(":month", $month, PDO::PARAM_INT);
                        $stmt->bindParam(":year", $year, PDO::PARAM_INT);
                        $stmt->bindParam(":fk_exp_building", $payproperty, PDO::PARAM_INT);
                        $stmt->bindParam(":pay_method", $paydata, PDO::PARAM_INT);
                        $stmt->bindParam(":num_floor", $floors, PDO::PARAM_STR);
                        $stmt->bindParam(":num_dep", $depto, PDO::PARAM_STR);
                        $stmt->bindParam(":ufun", $ufun, PDO::PARAM_STR);
                        $stmt->bindParam(":patch_file", $fileFullName, PDO::PARAM_STR);
                        $stmt->bindParam(":typemime", $fileType, PDO::PARAM_STR);
                        $stmt->bindParam(":comment", $paynote, PDO::PARAM_STR);
                        $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);//user

                        if($stmt->execute()){
                            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Pago creado con éxito.")));
                        }else{
                            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
                        }
                        
                    } else {
                        $response->getBody()->write(json_encode(array("status" => 1, "message" => "No se pudo abrir el archivo .ZIP")));
                    }
                }else{
                    $response->getBody()->write(json_encode(array("status" => 1, "message" => "No se pudo subir el archivo")));
                }
            }else{

                // Verificar si la subida fue exitosa
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $uploadFileName = $uploadedFile->getClientFilename();
                    $uploadFileName = preg_replace("/[^a-zA-Z0-9.]/", "", $uploadFileName);
                    $uploadedFile->moveTo($directory.'/'.$uploadFileName);
                    //$response->getBody()->write('File uploaded successfully');
                    //return $response->withStatus(200);

                    $stmt = $conn->prepare("INSERT INTO EXP_PAY (month, year, fk_exp_building, pay_method, num_floor, num_dep, ufun, patch_file, typemime, comment, fk_exp_admin ) VALUES (:month, :year, :fk_exp_building, :pay_method, :num_floor, :num_dep, :ufun, :patch_file, :typemime, :comment, :fk_exp_admin )");
            
                    $stmt->bindParam(":month", $month, PDO::PARAM_INT);
                    $stmt->bindParam(":year", $year, PDO::PARAM_INT);
                    $stmt->bindParam(":fk_exp_building", $payproperty, PDO::PARAM_INT);
                    $stmt->bindParam(":pay_method", $paydata, PDO::PARAM_INT);
                    $stmt->bindParam(":num_floor", $floors, PDO::PARAM_STR);
                    $stmt->bindParam(":num_dep", $depto, PDO::PARAM_STR);
                    $stmt->bindParam(":ufun", $ufun, PDO::PARAM_STR);
                    $stmt->bindParam(":patch_file", $uploadFileName, PDO::PARAM_STR);
                    $stmt->bindParam(":typemime", $fileType, PDO::PARAM_STR);
                    $stmt->bindParam(":comment", $paynote, PDO::PARAM_STR);
                    $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);//user

                    if($stmt->execute()){
                        $response->getBody()->write(json_encode(array("status" => 0, "message" => "Pago creado con éxito.")));
                    }else{
                        $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
                    }


                } else {
                    $response->getBody()->write(json_encode(array("status" => 1, "message" => "Error uploading file: 500")));
                }

            }

        } else {
            $response->getBody()->write(json_encode(array("status" => 1, "message" => "Archivo no subido")));
        }
    
        return $response;
    });

    $app->get('/data/{owner}/{filter}', function (Request $request, Response $response, array $args) use ($conn) {

        $id = $args['owner'];

        $filter = $args['filter'];
 
        if($filter==="all"){
            $filtro = " WHERE P.fk_exp_admin = '".$id."' ";
        }else{
            $filtro = " WHERE P.fk_exp_admin = '".$id."' and P.fk_exp_building = '".$filter."' ";
        }


        $stmt = $conn->prepare("SELECT
                                    B.short_name,
                                    P.*
                                    FROM `EXP_PAY` P
                                    JOIN `EXP_BUILDING`B on B.id=P.fk_exp_building
                                    WHERE B.status = '0' ".
                                    $filtro);

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
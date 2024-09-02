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
        $basepath = $data["api_base_desa"].$data["api_publication"];
    }else{
        $servername = $data["db.config.host"]; // Nombre del servidor
        $username = $data["db.config.username"]; // Nombre de usuario
        $password = $data["db.config.password"]; // Contraseña
        $dbname = $data["db.config.dbname"]; // Nombre de la base de datos
        $basepath = $data["api_base_prod"].$data["api_publication"];
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

    /*ALTA*/
    $app->post('/create', function (Request $request, Response $response, array $args) use ($conn) {
        
        function getFilenameWithoutExtension($filePath) {
            // Utiliza pathinfo para obtener la información del archivo
            $pathInfo = pathinfo($filePath);
        
            // Devuelve el nombre del archivo sin la extensión
            return $pathInfo['filename'];
        }

        $data = $request->getParsedBody();

        $fk_exp_admin = $data['fk_exp_u'];//User

        $description = $data['description'];
        $long_description = $data['long_description'];
        $address = $data['address'];
        $num = $data['numcalle'];
        $street_one = $data['street_one'];
        $street_two = $data['street_two'];

        $fk_sp_provincia = $data['province'];
        $fk_sp_partido = $data['partido'];
        $fk_sp_localidad = $data['localidad'];

        $price = $data['price'];
        $currency = $data['currency'];
        $date_publish = $data['date_publish'];

        $count_bedrooms = $data['count_bedrooms'];
        $count_bathrooms = $data['count_bathrooms'];
        $square_meter = $data['square_meter'];

        $amoblado = $data['amoblado'];
        $ascensor = $data['ascensor'];
        $terraza = $data['terraza'];
        $cocheras = $data['cocheras'];
        $laundry = $data['laundry'];
        $pileta = $data['pileta'];
        $mascota = $data['mascota'];
        $bauleras = $data['bauleras'];
        $aa = $data['aa'];
        $ap = $data['ap'];
        $barrioc = $data['barrioc'];
        $sum = $data['sum'];

        $date = strtotime($date_publish);

        /************* FILE ****************/

        $uploadedFiles = $request->getUploadedFiles();
        $directory = __DIR__ . '/public';
        
        // Ensure the uploads directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (isset($uploadedFiles['filepublish'])) {
            $uploadedFile = $uploadedFiles['filepublish'];
            $fileSize = $uploadedFile->getSize();
            $fileType = $uploadedFile->getClientMediaType();
            $fileFullName = $uploadedFile->getClientFilename();

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
                        $path = $filenameWithoutExtension;
                    } else {
                        $response->getBody()->write(json_encode(array("status" => 1, "message" => "No se pudo abrir el archivo .ZIP")));
                    }
                }else{
                    $response->getBody()->write(json_encode(array("status" => 1, "message" => "No se pudo subir el archivo")));
                }
            }else{
                $response->getBody()->write(json_encode(array("status" => 1, "message" => "No es un archivo ZIP")));
            }

        }
        /************* FILE ****************/

		$stmt = $conn->prepare("INSERT INTO EXP_PROPERTY (fk_exp_admin, description, long_description, address, number, street_one, street_two, fk_sp_provincia, fk_sp_partido, fk_sp_localidad, price, currency, date_publish, count_bedrooms, count_bathrooms, square_meter, amoblado, ascensor, terraza, cocheras, laundry, pileta, mascota, bauleras, aa, ap, barrioc, sum, path ) VALUES (:fk_exp_admin, :description, :long_description, :address, :number, :street_one, :street_two, :fk_sp_provincia, :fk_sp_partido, :fk_sp_localidad, :price, :currency, :date_publish, :count_bedrooms, :count_bathrooms, :square_meter, :amoblado, :ascensor, :terraza, :cocheras, :laundry, :pileta, :mascota, :bauleras, :aa, :ap, :barrioc, :sum, :path )");
        
        $stmt->bindParam(":fk_exp_admin", $fk_exp_admin, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":long_description", $long_description, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":number", $num, PDO::PARAM_INT);
        $stmt->bindParam(":street_one", $street_one, PDO::PARAM_STR);
        $stmt->bindParam(":street_two", $street_two, PDO::PARAM_STR);

        $stmt->bindParam(":fk_sp_provincia", $fk_sp_provincia, PDO::PARAM_INT);
        $stmt->bindParam(":fk_sp_partido", $fk_sp_partido, PDO::PARAM_INT);
        $stmt->bindParam(":fk_sp_localidad", $fk_sp_localidad, PDO::PARAM_INT);
        
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":currency", $currency, PDO::PARAM_INT);
        $stmt->bindParam(":date_publish",$date_publish , PDO::PARAM_STR);
        $stmt->bindParam(":count_bedrooms", $count_bedrooms, PDO::PARAM_INT);
        $stmt->bindParam(":count_bathrooms", $count_bathrooms, PDO::PARAM_INT);
        $stmt->bindParam(":square_meter", $square_meter, PDO::PARAM_INT);

        $stmt->bindParam(":amoblado", $amoblado, PDO::PARAM_STR);
        $stmt->bindParam(":ascensor", $ascensor, PDO::PARAM_STR);
        $stmt->bindParam(":terraza", $terraza, PDO::PARAM_STR);
        $stmt->bindParam(":cocheras", $cocheras, PDO::PARAM_STR);
        $stmt->bindParam(":laundry", $laundry, PDO::PARAM_STR);
        $stmt->bindParam(":pileta", $pileta, PDO::PARAM_STR);
        $stmt->bindParam(":mascota", $mascota, PDO::PARAM_STR);
        $stmt->bindParam(":bauleras", $bauleras, PDO::PARAM_STR);
        $stmt->bindParam(":aa", $aa, PDO::PARAM_STR);
        $stmt->bindParam(":ap", $ap, PDO::PARAM_STR);
        $stmt->bindParam(":barrioc", $barrioc, PDO::PARAM_STR);
        $stmt->bindParam(":sum", $sum, PDO::PARAM_STR);
        $stmt->bindParam(":path", $path, PDO::PARAM_STR);

        if($stmt->execute()){
            $property = $stmt->fetch(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Publicación creada con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

        return $response->withHeader('Content-Type', 'application/json');

    });

    /* SERVICES */
    $app->get('/{id}', function (Request $request, Response $response, array $args) use ($conn) {

        $fk_exp_admin = $args['id'];

        $stmt = $conn->prepare("SELECT * FROM `EXP_PROPERTY` WHERE fk_exp_admin = '".$fk_exp_admin."' ");

        if($stmt->execute()){
            $service = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $count = count($service);
            $storage = array();
            for($i=0;$i<$count;$i++){
                $dir = __DIR__ . '/public/'.$service[$i]["path"];
                // Comprobar si la ruta es un directorio válido
                
                if (is_dir($dir)){
                    
                    // Obtener el contenido del directorio
                    $files = scandir($dir);
        
                    // Recorrer y mostrar el contenido del directorio
                    foreach ($files as $file) {
                        
                        // Omitir los elementos '.' y '..'
                        if ($file != "." && $file != ".." && $file != "__MACOSX" && $file != ".DS_Store") {
                            $storage[] = array("id"=>$service[$i]["id"],"file"=>$file);
                        }
                    }
                }
            }

            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$service, "images"=>$storage, "cantidad"=>$count)));
            return $response;
        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/data/{owner}', function (Request $request, Response $response, array $args) use ($conn) {

        $id = $args['owner'];

        $stmt = $conn->prepare("SELECT * FROM `EXP_PROPERTY` WHERE fk_exp_admin = '".$id."' ");

        if($stmt->execute()){
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$data, "count"=>count($data) )));

        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }); 

    /* EDIT */
    $app->get('/edit/{owner}/{idpub}', function (Request $request, Response $response, array $args) use ($conn) {

        $id = $args['owner'];
        $idpub = $args['idpub'];

        $stmt = $conn->prepare("SELECT * FROM `EXP_PROPERTY` WHERE fk_exp_admin = '".$id."' and id = '".$idpub."' ");

        if($stmt->execute()){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Query correcto.", "data"=>$data, "count"=>count($data) )));

        }else{
            $response->getBody()->write(json_encode( array("status" => 1, "message" => $stmt->errorInfo())));
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }); 

    $app->put('/update', function (Request $request, Response $response, array $args) use ($conn) {
        $data = $request->getParsedBody();

        $id = $data['id_pub'];
        $fk_exp_u = $data['fk_exp_u'];

        $description = $data['description'];
        $long_description = $data['long_description'];
        $address = $data['address'];
        $numcalle = $data['numcalle'];
        $street_one = $data['street_one'];
        $street_two = $data['street_two'];

        $province = $data['province'];
        $partido = $data['partido'];
        $localidad = $data['localidad'];

        $price = $data['price'];
        $currency = $data['currency'];
        $date_publish = $data['date_publish'];
        $square_meter = $data['square_meter'];
        $count_bedrooms = $data['count_bedrooms'];
        $count_bathrooms = $data['count_bathrooms'];

        $amoblado = $data['amoblado'];
        $ascensor = $data['ascensor'];
        $terraza = $data['terraza'];
        $cocheras = $data['cocheras'];
        $laundry = $data['laundry'];
        $pileta = $data['pileta'];
        $mascota = $data['mascota'];
        $bauleras = $data['bauleras'];
        $aa = $data['aa'];
        $ap = $data['ap'];
        $barrioc = $data['barrioc'];
        $sum = $data['sum'];

        $stmt = $conn->prepare("UPDATE EXP_PROPERTY 
                                SET 
                                description = '".$description."',
                                long_description = '".$long_description."',
                                address = '".$address."',
                                number = '".$numcalle."',
                                street_one='".$street_one."',
                                street_two='".$street_two."',
                                fk_sp_provincia='".$province."',
                                fk_sp_partido='".$partido."',
                                fk_sp_localidad='".$localidad."',
                                price='".$price."',
                                currency='".$currency."',
                                date_publish='".$date_publish."',
                                square_meter='".$square_meter."',
                                count_bedrooms = '".$count_bedrooms."',
                                count_bathrooms = '".$count_bathrooms."',
                                amoblado = '".$amoblado."',
                                ascensor = '".$ascensor."',
                                terraza = '".$terraza."',
                                cocheras = '".$cocheras."',
                                laundry = '".$laundry."',
                                pileta = '".$pileta."',
                                mascota = '".$mascota."',
                                bauleras = '".$bauleras."',
                                aa = '".$aa."',
                                ap = '".$ap."',
                                barrioc = '".$barrioc."',
                                sum = '".$sum."'
                                WHERE id='".$id."' and fk_exp_admin = '".$fk_exp_u."' ");

        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Publicación actualizada con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

    });

    //SETEAR PICTURES PRIMARY
    $app->put('/update/picture', function (Request $request, Response $response, array $args) use ($conn) {
        $data = $request->getParsedBody();
        $id = $data['id_pub'];
        $fk_exp_u = $data['fk_exp_u'];

        $pic_primary = $data['pic_primary'];

        $stmt = $conn->prepare("UPDATE EXP_PROPERTY 
                                SET 
                                pic_primary = '".$pic_primary."'
                                WHERE id='".$id."' and fk_exp_admin = '".$fk_exp_u."' ");
        if($stmt->execute()){
            $response->getBody()->write(json_encode(array("status" => 0, "message" => "Publicación actualizada con éxito.")));
            return $response;
        }else{
            $response->getBody()->write(json_encode(array("status" => 1, "message" => $stmt->errorInfo())));
            return $response;
        }

    });
    //FIN SETEAR PICTURES PRIMARY

    $app->get('/scan/{folder}', function (Request $request, Response $response, array $args) use ($conn) {

        $folder = $args['folder'];
        // Ruta del directorio que quieres explorar
        $dir = __DIR__ . '/public/'.$folder;
        
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

    $app->run();

?>
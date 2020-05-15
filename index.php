<?php

require __DIR__ . '/cliente.php';

require __DIR__ . '/profesor.php';

require __DIR__ . '/materias.php';

require_once 'vendor/autoload.php';

$request_Method = $_SERVER["REQUEST_METHOD"];




$path_info = $_SERVER["PATH_INFO"] ?? false;

session_start();
$session = $_SESSION ?? false;
if($path_info != false){


    switch ($path_info) {

        case '/usuario':
    
            if ($request_Method == 'POST') {
    
                $email = $_POST['email'] ?? null;
    
                $clave = $_POST['clave'] ?? null;
    
                if ($email != null && $clave != null) {
    
                    // $cliente = new cliente($email, $clave);
    

                    $cliente = new cliente(array('email' =>$email, 'clave' => $clave));


                    var_dump($cliente);
                    $cliente->guardarCliente();
    
                }
            } else {
    
                echo 'Method not allowed';
            }
            break;
        case '/login':
            if ($request_Method == 'POST') {
    
                $email = $_POST['email'] ?? null;
                $clave = $_POST['clave'] ?? null;
    
                if ($email != null && $clave != null) { 
                echo cliente::buscarCliente($email);
                // $key = "Mi_clave";
                // $payload = cliente::crearToken($clave, $email);
                // $jwt = JWT::encode($payload, $key);
    
                // $decoded = JWT::decode($jwt, $key, array('HS256'));
                // $decoded_array = (array) $decoded;
                // print_r($jwt);
                // print_r($jwt);
                // $_SESSION['token'] = $jwt;
    
                // $header = getallheaders();
                // var_dump($header);
    
    
                } else {
    
                    echo 'Por favor complete los campos que faltan';
                }
            } else {
    
                echo 'Method not allowed';
            }
            break;
        case '/profesor':
    
            if ($request_Method == 'POST') {
    
                $nombre = $_POST['nombre'] ?? null;
                $legajo = $_POST['legajo'] ?? null; //validar que sea unico
    
                $foto = $_FILES['foto'] ?? null;
    
                if ($nombre != null && $legajo != null && $foto != null) {
    
                    $file = fopen("profesores.json", "w");
                    $profesor = new profesor($nombre, $legajo, $foto['name']);
    
                    var_dump($profesor);
                    $profesor->guardarProfesor();  
                    // $json = json_encode($profesor);
                    // fwrite($file, $json);
    
                    // fclose($file);
    
                    // profesor::GuardarFoto($foto);
    
                }
    
            }
            if ($request_Method == 'GET') {
    
                //leerJSON("profesores.json");

                $arrayJSON = profesor::leerJSON();

                $array = explode(";", $arrayJSON);

      
                foreach ($array as $value2) {
        
                    $personaEncontrada = json_decode($value2, true);


                    print_r($personaEncontrada);
        
                        // if($personaEncontrada['email'] == $email){
        
                        //     return $email;
                        // }
                
                }
               
    
            }
            break;
    
    //     case '/materia':
    
    //         if ($request_Method == 'POST') {
    
    //             $nombre = $_POST['nombre'] ?? null;
    //             $cuatrimestre = $_POST['cuatrimestre'] ?? null; //validar que sea unico
    
    //             if ($nombre != null && $cuatrimestre != null) {
    
    //                 $file = fopen("materias.json", "w");
    //                 $materia = new materia($nombre, $cuatrimestre);
    
    //                 $json = json_encode($materia);
    //                 fwrite($file, $json);
    
    //                 fclose($file);
    
    //             }
    //         } else {
    
    //             if ($request_Method == 'GET') {
    
    //                 leerJSON("materias.json");
    
    //             } else {
    
    //                 echo 'Method not allowed';
    
    //             }
    //         }
    //         break;
    
    }
    
}

// function leerJSON($archivo)
// {

//     $file = fopen($archivo, 'r');

//     $arrayString = fread($file, filesize($archivo));

//     $arrayJSON = json_decode($arrayString);

//     fclose($file);

//     return $arrayJSON;
// }

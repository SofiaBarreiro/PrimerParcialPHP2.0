<?php

class cliente{


   
    public $email;
   
    public $clave;



    public function __construct(array $data)    
    {  
        $this->email = $data['email'];
       
        $this->clave = $data['clave'];

    }   

    public function guardarCliente ()    
    {  
        $fp = fopen("users.json", "a+");
        fwrite($fp, json_encode($this) . ";");

        fclose($fp);

    }  

    public static function crearToken($clave, $email){

    
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "clave" => $clave,
            "nombre" => $email,
    
        );
    
    
        return $payload;
    }


    public static function buscarCliente($email)
    {

        
        $arrayJSON = cliente::leerJSON();


        $array = explode(";", $arrayJSON);

      
        foreach ($array as $value2) {

            $personaEncontrada = json_decode($value2, true);

                if($personaEncontrada['email'] == $email){

                    return $email;
                }
        
        }
       
      

        return "";
    }
 





    static public function leerJSON()
    {
        $file = fopen('users.json', 'r');

        $arrayString = fread($file, filesize('users.json'));

        return $arrayString;



       
    }

}



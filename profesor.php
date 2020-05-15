<?php

class profesor{


   
    public $nombre;
   
    public $legajo;
      
    public $foto;

    

    public function __construct($nombre, $legajo, $foto)    
    {  
        $this->nombre = $nombre;
        $this->legajo = $legajo;
        $this->foto = $foto;


        echo $this->nombre;
        echo $this->legajo;
        echo $this->foto;

    } 


    public static function GuardarFoto($file)
    {

        list($txt, $ext) = explode(".", $_FILES['foto']['name']);

        $archivo = (isset($_FILES['foto'])) ? $_FILES['foto'] : null;
        if ($archivo) {
            $ruta_destino_archivo = "imagenes/{$archivo['name']}"; 
                       
            $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);

        }

    
    }
    public function guardarProfesor ()    
    {  
        $fp = fopen("profesores.json", "a+");
        fwrite($fp, json_encode($this) . ";");

        fclose($fp);

    }  

    static public function leerJSON()
    {
        $file = fopen('profesores.json', 'r');

        $arrayString = fread($file, filesize('profesores.json'));

        return $arrayString;
       
    }


}
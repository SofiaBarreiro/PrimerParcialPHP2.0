<?php

class materia{


    public $nombre;
    public $cuatrimestre;
    public $id;

    

    public function __construct($nombre, $cuatrimestre, $id)    
    {  
        $this->nombre = $nombre;
        $this->cuatrimestre = $cuatrimestre;
        $this->id = $id;


    } 


}
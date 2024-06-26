<?php

namespace App\Models;

use CodeIgniter\Model;

//Modelo para trabajar con la tabla usuarios

class personasModel extends Model
{
    protected $table = 'personas'; //nombre de la tabla
    protected $primarykey = 'cedula_personas'; //lalve primaria
    protected $allowedFields = ['cedula_personas','nombres_personas', 'apellidos_personas','operadora_personas','telefono_personas', 'correo_personas', 'clave']; //campos que se usaran

}



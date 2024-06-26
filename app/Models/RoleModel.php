<?php

namespace App\Models;

use CodeIgniter\Model;

//Modelo para trabajar con la tabla usuarios

class RoleModel extends Model
{
    protected $table = 'roles_personas'; //nombre de la tabla
    protected $primaryKey = 'id_Rolespersonas'; //lalve primaria
    protected $allowedFields = ['nombre_rolesPersonas']; //campos que se usaran

    public function getRoleByName($roleName)
    {
        return $this->where('nombre_rolesPersonas', $roleName)->first();
    }


}


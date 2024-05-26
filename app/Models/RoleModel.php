<?php

namespace App\Models;

use CodeIgniter\Model;

//Modelo para trabajar con la tabla usuarios

class RoleModel extends Model
{
    protected $table = 'roles'; //nombre de la tabla
    protected $primarykey = 'id'; //lalve primaria
    protected $allowedFields = ['rolename']; //campos que se usaran

    public function getRoleByName($roleName)
    {
        return $this->where('role_name', $roleName)->first();
    }


}


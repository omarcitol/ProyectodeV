<?php

namespace App\Controllers;

use App\Libraries\PasswordHash;
use App\Models\personasModel;
use App\Models\RoleModel;
use Config\App;

class Login extends BaseController
{   
    
    public function __construct()
    {
        helper(['url', 'form']);
        
    }
    public function index(): string
    {

        return view('login/login');
    }

    //validacion de inicio de sesion

    public function check(){

        $validation = $this->validate([

            'correo_personas'=>[
                'rules'=>'required|valid_email|is_not_unique[personas.correo_personas]',
                'errors'=>[
                    'required'=>'Se necesita el correo',
                    'valid_email'=>'Ingrese un correo valido',
                    'is_not_unique'=>'Este correo no se encuentra registrado'
                ]
                ],
                 'clave'=>[
                    'rules'=>'required|min_length[5]|max_length[12]',
                    'errors'=>[
                        'required'=>'se necesita la contraseña',
                        'min_length'=>'La contraseña debe tener al menos 5 caracteres',
                        'max_length'=>'la contraseña debe ser menor a 12 caracteres',
                ]
                ]
        ]);

        if(!$validation){
            return view('login/login',['validation'=>$this->validator]);
        }else{
            
            $email = $this->request->getPost('correo_personas');
            $password = $this->request->getPost('clave');

            $usersModel = new \App\Models\personasModel();
            $user_info = $usersModel->where('correo_personas', $email)->first();
            $check_password = PasswordHash::check($password, $user_info['clave']);   

            if(!$check_password){
                session()->setFlashdata('fail', 'Contraseña incorrecta');
                return redirect()->to('login')->withInput();
            }else{
                
               $user_id = $user_info['cedula_personas'];

                /*session()->set('Usuario logueado', $user_id);
                return redirect()->to('alumnos'); */
                // Obtener el rol del usuario desde la tabla roles
            $rol_personas = $user_info['rol_personas'];
            $rolesModel = new RoleModel(); // Suponiendo que tienes un modelo para la tabla roles
            $role_info = $rolesModel->find($rol_personas);

            // Redireccionar a diferentes vistas dependiendo del rol
           /* switch ($role_info['role_name']) {

                case 'Profesor': // Si es administrador
                    session()->set('usuario Logueado', $user_id);
                    return redirect()->to('profesor');
                    break;
                case 'Usuario': // Si es alumno
                    session()->set('usuario Logueado', $user_id);
                    return redirect()->to('alumnos');
                    break;
                default: // Si el rol no está definido
                    return redirect()->to('login');
                    break; */

                    if ($role_info !== null && array_key_exists('nombre_rolesPersonas', $role_info)) {
                        switch ($role_info['nombre_rolesPersonas']) {
                            case 'Profesor':
                                session()->set('usuario Logueado', $user_id);
                                return redirect()->to('profesor');
                                break;
                            case 'Usuario':
                                session()->set('usuario Logueado', $user_id);
                                return redirect()->to('alumnos');
                                break;
                            default:
                                return redirect()->to('register');
                                break;
                        }

                }else {
                    // Manejar el caso en el que no se pueda determinar el rol
                    return redirect()->to('login');
                }
        
            }
     }
}

}
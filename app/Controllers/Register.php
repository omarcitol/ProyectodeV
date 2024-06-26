<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\App;
use App\Libraries\PasswordHash;

class Register extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
        
    }
    public function index(): string
 
    { 
    $vistas =  view('login/register');

    return $vistas;

     }

     public function save(){
       /* $validation = $this->validate([
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|valid_email|is_unique[users.email]',
            'password'=>'required|min_length[5]|max_length[12]',
            'cpassword'=>'required|min_length[5]|max_length[12]|matches[password]'
        ]);
        */

        //Validaciones de seguridad para que no se dejen espacios en blanco
        $validation = $this->validate([
            'nombres_personas'=>[
                'rules'=>'required',
                'errors'=>[
                       'required'=>'Se require tu nombre' 
                ]
                ],
                'apellidos_personas'=>[
                    'rules'=>'required',
                    'errors'=>[
                           'required'=>'Se require tu apellido' 
                    ]
                    ],
                    'cedula_personas'=>[
                        'rules'=>'required',
                        'errors'=>[
                               'required'=>'Se require tu cedula' 
                        ]
                        ],
                        'operadora_personas'=>[
                            'rules'=>'required',
                            'errors'=>[
                                   'required'=>'Se require la operadora del numero telefonico' 
                            ]
                            ],
                            'telefono_personas'=>[
                                'rules'=>'required',
                                'errors'=>[
                                       'required'=>'Se require tu numero telefonico' 
                                ]
                                ],
                    'correo_personas'=>[
                        'rules'=>'required|valid_email|is_unique[personas.correo_personas]',
                        'errors'=>[
                               'required'=>'Se require tu correo',
                                'valid_email'=>'Debes ingresar un correo valido',
                                'is_unique'=>'El correo ya esta tomado'
                        ]
                        ],
                        'clave'=>[
                            'rules'=>'required|min_length[5]|max_length[12]',
                            'errors'=>[
                                   'required'=>'Se requiere la contraseña',
                                   'min_length'=>'La contraseña debe tener al menos 5 caracteres',
                                   'max_length'=>'la contraseña debe ser menor a 12 caracteres',
                            ]
                            ], 
                            'cclave'=>[
                                'rules'=>'required|min_length[5]|max_length[12]|matches[clave]',
                                'errors'=>[
                                       'required'=>'Se require la confirmacion de la contraseña',
                                       'min_length'=>'La contraseña debe tener al menos 5 caracteres',
                                        'max_length'=>'la contraseña debe ser menor a 12 caracteres',
                                        'matches'=>'Las contraseñas no coinciden'
                                ]
                                ]

        ]);

        //validacione final, si no da bien la vaina, de vuelve a la vista
        if(!$validation){
            return view('login/register',['validation'=>$this->validator]);
        }else{
        //si da bien la vaina se toman los datos de los campos y se guardan en las siguientes variables:
            $name = $this->request->getPost('nombres_personas');
            $surname = $this->request->getPost('apellidos_personas');
            $cedula = $this->request->getPost('cedula_personas');
            $operadora = $this->request->getPost('operadora_personas');
            $telefono = $this->request->getPost('telefono_personas');
            $email = $this->request->getPost('correo_personas');
            $password = $this->request->getPost('clave');
            
            /*Esta es la funcion de la una libreria que hice para que hashee la contraseña
        el problema es que no se pq retorna un 0 */
            //actualizacion: ya funciona
            $hashedPassword = PasswordHash::hash($password);
            

            //guardo todo en un array
            $values = [
                'nombres_personas'=>$name,
                'apellidos_personas'=>$surname,
                'cedula_personas'=>$cedula,
                'operadora_personas'=>$operadora,
                'telefono_personas'=>$telefono,
                'correo_personas'=>$email,
                'clave'=>$hashedPassword 
            ];
            //insercion de datos en la db
            $personasModel = new \App\Models\personasModel(); 
            $querry = $personasModel->insert($values);
            if(!$querry){
                return redirect()->back()->with('fail','Algo fallo');
                //return redirect()->to('register')->with('fail','Algo fallo');    
            }else{
                return redirect()->to('login')->with('success','¡Te has registrado con exito!');   
            };


        
        }
     }

}

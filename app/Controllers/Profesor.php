<?php

namespace App\Controllers;

class Profesor extends BaseController
{ 
	public function index2()
	{
		$vistas =  view('profesor/cabecera').	
	   $vistas =  view('profesor/inicio').
	   $vistas =  view('profesor/pie');
	

		 return $vistas; 
	}

	public function notificaciones2()
	{
		
		$vistas =  view('profesor/cabecera').	
		
		$vistas =  view('profesor/notificaciones').
		$vistas =  view('profesor/pie');

		 return $vistas; 
	}

	public function cargarnotas()
	{
		
		$vistas =  view('profesor/cabecera').	
		$vistas =  view('profesor/cargarnotas').
		$vistas =  view('profesor/pie');

		 return $vistas; 
	}

	public function crearcurso()
	{
		
		$vistas =  view('profesor/cabecera').	
		$vistas =  view('profesor/inicio').
		$vistas =  view('profesor/pie');

		 return $vistas; 
	}

	public function configuracion2()
	{
		
		$vistas =  view('profesor/cabecera').	
		$vistas =  view('profesor/inicio').
		$vistas =  view('profesor/pie');

		 return $vistas; 
	}

	public function cerrarsesion2(){ 

	
		$vistas =  view('profesor/cabecera').	
	   	$vistas =  view('profesor/inicio').
	   	$vistas =  view('profesor/pie');

	   return $vistas; 
     }
	}
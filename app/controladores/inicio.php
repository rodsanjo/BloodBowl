<?php
namespace controladores;

class inicio extends \core\Controlador {
	
    public function index(array $datos = array()) {

        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos, true);
        $http_body = \core\Vista_Plantilla::generar('plantilla_principal',$datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }
    
    public function oficiales(array $datos = array()){
        $oficial_teams = new \controladores\teams();
        $actived_teams = true;
        $datos = $oficial_teams->index($datos, $actived_teams);
        
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }
	
	
} // Fin de la clase
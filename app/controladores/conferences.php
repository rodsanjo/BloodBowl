<?php
namespace controladores;
class conferences extends \core\Controlador {
    
    private static $tabla_c = 'conferencias';
    private static $tabla_j = 'jugadores';
    private static $tabla_je = 'jugadores_equipos';
    
    public static $controlador = 'conferences';
    
    public function index(array $datos = array() ){
        //\core\http_requermiento::request_come_by_post();
        $this->siglas( $datos, 'TMU');
    }    
    
    /**
     * Función que muestra un único inmueble con todos sus detalles pasando una referencia.
     * @param array $datos
     * @return type
     */
    public function siglas(array $datos = array(), $conf_default = 'TMU') {
        
        //\core\http_requermiento::request_come_by_post();
        $get = \core\HTTP_Requerimiento::get();
        //var_dump($get);
        
        $conf_default = isset($get['p3']) ? $get['p3'] : $conf_default ;

        $conf_obj = new \modelos\conferences( $conf_default );
        //$conf['conf'] = $conf_obj->conf;
        $conf['conf'] = $conf_obj->getConference();
        $conf['equipos'] = $conf_obj->teams;
        
        //$datos['conferences'] = $conf_obj::getConferences();
        $datos['conferences'] = \modelos\conferences::getConferences();

        //$datos['equipos'] = $conf::getTeams_byConferenceSiglas( $get['p3'] );
        //var_dump($conf);
        if ( empty( $conf['conf'] )) {
            $datos['mensaje'] = 'La conferencia es incorrecta, seleccione una de los indicados en el menú por favor';
            \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        }else{
            //var_dump($filas);
            $datos['conf'] = $conf['conf'][0];
            foreach ($conf['equipos'] as $key => $equipo) {  //For if it comes with several teams,
                $datos['equipos'][$key]['equipo'] = $equipo; // $equipo = $filas[$key];        
                $datos['equipos'][$key]['jugadores'] = \modelos\teams::getPlayers_by_team($equipo);
            }
        }
        
        //var_dump($datos);
        
        //Mostramos los datos a modificar en formato europeo. Convertimos el formato de MySQL a europeo para su visualización
        \modelos\players::convertir_formato_mysql_a_ususario_pt($datos['equipos'], false);
        
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
        
    }
    
        
    
	
} // Fin de la clase
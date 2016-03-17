<?php
namespace controladores;
class conferences extends \core\Controlador {
    
    private static $tabla_c = 'conferencias';
    private static $tabla_j = 'jugadores';
    private static $tabla_je = 'jugadores_equipos';
    
    public static $controlador = 'conferences';
    
    public function index(array $datos = array() ){
        //\core\http_requermiento::request_come_by_post();
        
        if( isset($_POST['id']) && is_int($_POST['id']) ){ //viene el id
            $clausulas['where'] = " id = {$_POST['id']} ";
        }elseif( isset($_GET['p3']) ){ //no viene el id, han escrito la url a mano
            $raza = str_replace('-',' ', $_GET['p3'] );
            $clausulas['where'] = " raza like '%$raza%' ";
        }else{
            $clausulas['where'] = " 1=1 ";   //Por si alguien maneja la URL sin introducir referencia, mostrará el primero
        }

        $clausulas['where'] .= " and is_active = true ";

        if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla_e)) {
            $datos['mensaje'] = 'El equipo no existe, seleccione uno de los indicados en el menú por favor';
            \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        }else{
            //var_dump($filas);
            foreach ($filas as $key => $equipo) {  //For if it comes with several teams,
                $datos['equipos'][$key]['equipo'] = $equipo; // $equipo = $filas[$key];        
                $datos['equipos'][$key]['jugadores'] = \modelos\teams::getPlayers_by_team($equipo);
            }
            /*
            //Usando equipo_id como FK buscamos los detalles de los jugadores
            $equipo_id = $filas[0]['id'];
            $clausulas['where'] = " equipo_id = $equipo_id ";
            $datos['jugadores'] = \modelos\Modelo_SQL::table(self::$tabla_j)->select($clausulas);
             */
        }
        
        //var_dump($datos);
        
        //Mostramos los datos a modificar en formato europeo. Convertimos el formato de MySQL a europeo para su visualización
        \modelos\players::convertir_formato_mysql_a_ususario_pt($datos['equipos'], false);
        
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }    
    
    /**
     * Función que muestra un único inmueble con todos sus detalles pasando una referencia.
     * @param array $datos
     * @return type
     */
    public function siglas(array $datos = array()) {
        
        //\core\http_requermiento::request_come_by_post();
        $get = \core\HTTP_Requerimiento::get();
        //var_dump($get);
        
        if(isset($get['p3']) ){
            
            $conf_obj = new \modelos\conferences( $get['p3'] );
            $conf['conf'] = $conf_obj::$confs;
            $conf['equipos'] = $conf_obj::$teams;
            
            //$datos['equipos'] = $conf::getTeams_byConferenceSiglas( $get['p3'] );
        }
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
<?php
namespace controladores;

class search extends \core\Controlador {
    
    private static $table_j = 'jugadores';
    private static $table_s = 'habilidades';
    private static $table_e = 'equipos';
    private static $table_h = 'habilidades';

public function index(array $datos = array()){
        
        //Realizamos la busqueda
        $post = \core\HTTP_Requerimiento::post();
        var_dump($post);
        
        if( isset($post['buscar_en'])){
            $clausula = self::getTabla($post, $tabla);
            $vista = $post['buscar_en'];
        }else{
            $tabla = self::$table_j;
            $clausula['where'] = " nombre like '%{$post['nombre']}%' ";
            $vista = 'players';
        }

        $filas = \modelos\Datos_SQL::select( $clausula, $tabla);
        $datos[$tabla] = $filas;
        
        if($tabla == 'jugadores'){
            $jugador['equipos'] = \modelos\players::getTeamsOfPlayers($datos);
        }elseif($tabla == 'equipos'){
            foreach ($filas as $key => $equipo) {  //For if it comes with several teams,
                $datos['equipos'][$key]['equipo'] = $equipo; // $equipo = $filas[$key];        
                $datos['equipos'][$key]['jugadores'] = \modelos\teams::getPlayers_by_team($equipo);
            }
        }
        
        //Search tiene 3 posibles vistas: players, teams y skills
        $datos['view_content'] = \core\Vista::generar($vista, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT',$datos);
        \core\HTTP_Respuesta::enviar($http_body);
        
    }
    
    private static function getTabla( array $post, &$tabla){
        switch ($post['buscar_en']){
            case 'players':
                $tabla = self::$table_j;
                $clausula['where'] = " nombre like '%{$post['nombre']}%' ";
                break;
            case 'teams':
                $tabla = self::$table_e;
                $clausula['where'] = " raza like '%{$post['nombre']}%' ";
                break;
            case 'skills':
                $tabla = self::$table_s;
                $clausula['where'] = " nombre like '%{$post['nombre']}%' ";
                $clausula['where'] .= " or descripcion like '%{$post['nombre']}%' ";
                break;
            default:
                $tabla = self::$table_j;
                $clausula['where'] = " nombre like '%{$post['nombre']}%' ";
        }
        return $clausula;
    }

    private static function buscarInmuebles(array $post = array()){
        //var_dump($post);
        //Clausulas para la busqueda:
        if( isset($post['referencia']) && $post['referencia'] != '' ){
            $post['referencia'] = trim( $post['referencia'] ); //Eliminamos los espacios en blanco del inicio y final 
            $clausulas['where'] = " referencia like '%{$post['referencia']}%'";
        }else{
            $clausulas['where'] = " 1 ";    //Siempre es true
            if( isset( $post['tipo_inmueble'] ) && $post['tipo_inmueble'] != '' ){
                $clausulas['where'] .= " and tipo like '{$post['tipo_inmueble']}'";
            }
            if( isset( $post['buscar_nombre'] ) ){
                $clausulas['where'] .= " and ( localidad like '%{$post['buscar_nombre']}%' or provincia like '%{$post['buscar_nombre']}%' or cp = '{$post['buscar_nombre']}' )";
            }        
            
            //Si precio_venta es igual a cero quiere decir que esta para alquilar y viceversa. Si amboa son cero saldrá en ambas consultas.
            if( isset($post['tipo_transacion']) && $post['tipo_transacion'] != '' ){
                if( $post['tipo_transacion'] === 'venta'){
                    $clausulas['where'] .= " and (precio_alquiler = 0 or precio_venta > 0)";
                    if( isset($post['precio_max']) && $post['precio_max'] != '' ){
                       $clausulas['where'] .= " and precio_venta <= '{$post['precio_max']}'";
                    }
                }elseif ( $post['tipo_transacion'] === 'alquiler'){
                     $clausulas['where'] .= " and (precio_venta = 0 or precio_alquiler > 0)";
                     if( isset($post['precio_max']) && $post['precio_max'] != '' ){
                         $clausulas['where'] .= " and precio_alquiler <= '{$post['precio_max']}'";
                     }
                 }
                 
            }elseif( isset($post['precio_max']) && $post['precio_max'] != '' ){
                $clausulas['where'] .= " and (  precio_venta <= '{$post['precio_max']}' ";
                $clausulas['where'] .= " or ( precio_alquiler <= '{$post['precio_max']}' and precio_alquiler <> 0 ) ) ";
                
            }
            $clausulas['order_by']= ' rand()';
        }
        
        
        $datos["bienes"] = \modelos\Modelo_SQL::table(self::$tabla)->select($clausulas); // Recupera todas las filas ordenadas
        //$datos["bienes"] = \modelos\Modelo_SQL::execute($sql);
        //var_dump($datos);
        
        //¡¡OJO!! no hacemos la conversión y habrá que hacerla luego en la vista mediante el modelo
        
        return $datos['bienes'];
    }
}

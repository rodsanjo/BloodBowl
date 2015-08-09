<?php
namespace controladores;
class players extends \core\Controlador {
    
    private static $tabla_e = 'equipos';
    private static $tabla_j = 'jugadores';
    
    private static $controlador = 'teams';
    
    public function index(array $datos = array() ){
            //header("Location: ".\core\URL::generar("self::$controlador/index"));
            \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar("inicio/index"));
            \core\HTTP_Respuesta::enviar();
    }   
    
    /**
    * Mediante este método, y utilizando el método de la burbuja, ordenamos el array de jugadores
    *  respecto al campo enviado de forma ascendente o descendente en función del tercer parámetro.
    * @param $elemenos array
    * @param $campo tipo String
    * @param $asc boolean Si es true ordenaremos de forma ascendente, descendentemente en caso de false
    */
    private static function ordenarArray(array &$elemenos, $campo, $asc = true ){
       $aux = array();
       $n = count($elemenos);
       //var_dump($elemenos);
       
        if($asc){
            for($k=0; $k<$n-1; $k++){
                for( $i=0; $i< $n-1-$k; $i++){
                    if( $elemenos[$i][$campo] > $elemenos[$i+1][$campo] ){
                        $aux = $elemenos[$i];
                        $elemenos[$i] = $elemenos[$i+1];
                        $elemenos[$i+1] = $aux;
                    }
                }
            }
       }else{
            for($k=0; $k<$n-1; $k++){
                for( $i=0; $i< $n-1-$k; $i++){
                    if( $elemenos[$i][$campo] < $elemenos[$i+1][$campo] ){
                        $aux = $elemenos[$i];
                        $elemenos[$i] = $elemenos[$i+1];
                        $elemenos[$i+1] = $aux;
                    }
                }
            }
       }
   }
    
    /**
     * Presenta un formulario para insertar nuevas filas a la tabla
     * @param array $datos
     */
    public function form_insertar(array $datos=array()) {

        $datos["form_name"] = __FUNCTION__;
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT', $datos);
        \core\HTTP_Respuesta::enviar($http_body);

    }
    
    /**
     * Valida los datos insertados por el usuario. Si estos son correctos mostrará la lista de bienes con 
     * la nueva inserción, sino mostrará los errores por los que nos se admitió los datos introducidos.
     * @param array $datos
     */
    public function validar_form_insertar(array $datos=array()) {

        $validaciones = \modelos\bienes::$validaciones_insert;
        
        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)){  //validaciones en PHP
            $datos["errores"]["errores_validacion"]="Corrija los errores, por favor.";
        }else{
            $validacion = self::comprobar_files($datos);
            if ($validacion) {
                //Convertimos a formato MySQL
                self::convertir_a_formato_mysql($datos['values']);
                
                $datos['values']['referencia'] = self::ponerRef($datos['values']['provincia']);
                
                //if ( ! $validacion = \modelos\Modelo_SQL::insert($datos["values"], self::$tabla)) // Devuelve true o false
                if ( ! $validacion = \modelos\Datos_SQL::table(self::$tabla)->insert($datos["values"])) // Devuelve true o false
                    $datos["errores"]["errores_validacion"]="No se han podido grabar los datos en la bd.";
                else {
                    //Como insertamos un nuevo articulo es necesario extraer el id antes de persistir en la base de datos las ficheros multimedia
                    $sql = 'select(last_insert_id())';
                    $last_insert_id = \core\Modelo_SQL::execute($sql);
                    //var_dump($last_insert_id[0]['(last_insert_id())']);
                    $last_insert_id = $last_insert_id[0]['(last_insert_id())'];
                    $tabla = \core\Modelo_SQL::get_prefix_tabla(self::$tabla);
                    $sql = 'select * from '.$tabla.' where id = '.$last_insert_id;
                    $consulta = \core\Modelo_SQL::execute($sql);
                    $datos["values"]['id'] = $consulta[0]['id'];
                    $datos["values"]['referencia'] = $consulta[0]['referencia'];
                    //var_dump($consulta);
                    //var_dump($datos);
                    //A continuacion con el id ya conseguido procedemos a grabar en la base de datos la imagen y el manual del articulo
                    self::mover_files($datos);
                }
            }
        }
        if ( ! $validacion){ //Devolvemos el formulario para que lo intente corregir de nuevo
            \core\Distribuidor::cargar_controlador(self::$controlador, 'form_insertar', $datos);
            //$this->cargar_controlador(self::$controlador, 'form_insertar',$datos);
        }else{
            // Se ha grabado la modificación. Devolvemos el control al la situacion anterior a la petición del form_modificar
            //$datos = array("alerta" => "Se han grabado correctamente los detalles");
            // Definir el controlador que responderá después de la inserción
            //\core\Distribuidor::cargar_controlador(self::$tabla, 'index', $datos);
            $_SESSION["alerta"] = "Se han grabado correctamente los detalles";
            //header("Location: ".\core\URL::generar("self::$controlador/index"));
            \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar(self::$controlador."/index"));
            \core\HTTP_Respuesta::enviar();
        }
    }
    
    /**
     * Recoge el artículo a modificar de la BD y presenta un formulario con los datos actuales del artículo a modificar
     * @param array $datos
     */
    public function form_modificar(array $datos = array()) {

        $datos["form_name"] = __FUNCTION__;

         \core\HTTP_Requerimiento::request_come_by_post();  //Si viene por POST sigue adelante
        
        if ( ! isset($datos["errores"])) { // Si no es un reenvío desde una validación fallida
            $validaciones=array(
                "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla."/id"
            );
            if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
                $datos['mensaje'] = 'Datos erróneos para identificar el elemento a modificar';
                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            }else{
                $clausulas['where'] = " id = {$datos['values']['id']} ";
                if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla)) {
                    $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                    \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                    return;
                }else{   
                    $datos['values'] = $filas[0];

                }
            }
        }
        
        //Mostramos los datos a modificar en formato europeo. Convertimos el formato de MySQL a europeo
        self::convertir_formato_mysql_a_ususario($datos['values']);
                
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }

    /**
     * Valida los datos insertados por el usuario al realizar una modificación. Si estos son correctos mostrará la lista de bienes con 
     * la nueva inserción, sino mostrará los errores por los que nos se admitió los datos introducidos.
     * @param array $datos
     */
    public function validar_form_modificar(array $datos=array()) {
        
         \core\HTTP_Requerimiento::request_come_by_post();

        $validaciones = \modelos\bienes::$validaciones_update;

        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)){  //validaciones en PHP
            $datos["errores"]["errores_validacion"]="Corrija los errores, por favor.";
        }else{
            $validacion = self::comprobar_files($datos);
            if ($validacion) {
                //Convertimos a formato MySQL
                self::convertir_a_formato_mysql($datos['values']);
                //if ( ! $validacion = \modelos\Modelo_SQL::insert($datos["values"], self::$tabla)) // Devuelve true o false
                if ( ! $validacion = \modelos\Datos_SQL::table(self::$tabla)->update($datos["values"])) // Devuelve true o false
                    $datos["errores"]["errores_validacion"]="No se han podido grabar los datos en la bd.";
                else {
                    self::mover_files($datos);
                }
            }
        }
/*
        if ( ! $validacion) //Devolvemos el formulario para que lo intente corregir de nuevo
                \core\Distribuidor::cargar_controlador(self::$controlador, 'form_modificar', $datos);
        else {
                $datos = array("alerta" => "Se han modificado correctamente.");
                // Definir el controlador que responderá después de la inserción
                \core\Distribuidor::cargar_controlador(self::$controlador, 'index', $datos);		
        }
 */       

        if ( ! $validacion) //Devolvemos el formulario para que lo intente corregir de nuevo
                $this->cargar_controlador(self::$controlador, 'form_modificar',$datos);
        else 		{
                $_SESSION["alerta"] = "Se han modificado correctamente los datos";
                \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar(\core\Distribuidor::get_controlador_instanciado()));
                \core\HTTP_Respuesta::enviar();
        }  
        

    }



    public function form_borrar(array $datos=array()) {
        
        $datos["form_name"] = __FUNCTION__;

        \core\HTTP_Requerimiento::request_come_by_post();

        $validaciones= \modelos\bienes::$validaciones_delete;
        
        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
            $datos['mensaje'] = 'Datos erróneos para identificar el artículo a borrar';
            $datos['url_continuar'] = \core\URL::http('?menu='.self::$tabla.'');
            \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        }
        else {
            $clausulas['where'] = " id = {$datos['values']['id']} ";
            if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla)) {
                $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            }else {
                $datos['values'] = $filas[0];
            }
        }

        //Mostramos los datos a modificar en formato europeo. Convertimos el formato de MySQL a europeo
        self::convertir_formato_mysql_a_ususario($datos['values']);

        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('DEFAULT', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }

    
    public function validar_form_borrar(array $datos=array()) {	
        
         \core\HTTP_Requerimiento::request_come_by_post();

        $validaciones=array(
            "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla."/id"
        );
        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
            $datos['mensaje'] = 'Datos erróneos para identificar el artículo a borrar';
            $datos['url_continuar'] = \core\URL::http('?menu='.self::$tabla.'');
            \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        }else{
            //Eliminamos la foto y el manual de nuestra carpeta, debemos de hacerlo lo primero    
            self::borrar_files($datos);
            
            if ( ! $validacion = \modelos\Datos_SQL::delete($datos["values"], self::$tabla)) {// Devuelve true o false
                $datos['mensaje'] = 'Error al borrar en la bd';
                $datos['url_continuar'] = \core\URL::http('?menu='.self::$tabla.'');
                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            }else{               
                $datos = array("alerta" => "Se ha borrado correctamente.");
                \core\Distribuidor::cargar_controlador(self::$controlador, 'index', $datos);		
            }
        }
    }
    
    /**
     * Fución que realiza las conversiones de los campos que muestran las tablas del formato utilizado por MySQL al formato europeo.
     * Convertimos a formato MySQL
     * @author Jorge Rodriguez Sanz <jergo23@gmail.com>
     * @param array $param Se corresponderá por regla general con datos['values'] y lo pasamos por referencia, para que modificque el valor
     */
    public static function convertir_formato_mysql_a_ususario(array &$param) {  //$param = datos['values'] o $param = datos['filas'] si enviamos toda la tabla, y lo pasamos por referencia, para que modifique el valor
        //var_dump($param);
        foreach ($param as $key => $value) {
            $param[$key]['equipo']['coste_SO']=  \core\Conversiones::decimal_punto_a_coma_y_miles($value['equipo']['coste_SO']);
            foreach ($value['jugadores'] as $key_ => $fila) {
                if(isset($fila['coste']))
                    $param[$key]['jugadores'][$key_]['coste']=  \core\Conversiones::decimal_punto_a_coma_y_miles($fila['coste']);
            }    
        }        
        //var_dump($param);
    }
}
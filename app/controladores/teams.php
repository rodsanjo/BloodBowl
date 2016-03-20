<?php
namespace controladores;
class teams extends \core\Controlador {
    
    private static $tabla_e = 'equipos';
    private static $tabla_j = 'jugadores';
    private static $tabla_je = 'jugadores_equipos';
    
    public static $controlador = 'teams';
    
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
    public function raza(array $datos = array()) {
        
        //\core\http_requermiento::request_come_by_post();
        
        if( isset($_POST['id']) && is_int($_POST['id']) ){ //viene el id
            $clausulas['where'] = " id = {$_POST['id']} ";
        }elseif( isset($_GET['p3']) ){ //no viene el id, han escrito la url a mano
            $raza = str_replace('-',' ', $_GET['p3'] );
            $clausulas['where'] = " raza like '%$raza%' ";
        }else{
            $clausulas['where'] = " 1=1 ";   //Por si alguien maneja la URL sin introducir referencia, mostrará el primero
        }
        
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
     * Recoge el artículo a modificar de la BD y presenta un formulario con los datos actuales del artículo a modificar
     * @param array $datos
     */
    public function form_modificar(array $datos = array()) {

        $datos["form_name"] = __FUNCTION__;

         //\core\HTTP_Requerimiento::request_come_by_post();  //Si viene por POST sigue adelante
        
        if ( ! isset($datos["errores"])) { // Si no es un reenvío desde una validación fallida
            $validaciones=array(
                "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla_e."/id"
            );
            if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
                $datos['mensaje'] = 'Datos erróneos para identificar el elemento a modificar';
                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            }else{
                $clausulas['where'] = " id = {$datos['values']['id']} ";
                if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla_e)) {
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
             
        //Abriremos el formulario en una ventana nueva
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('view_content', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }

    /**
     * Valida los datos insertados por el usuario al realizar una modificación. Si estos son correctos mostrará la lista de bienes con 
     * la nueva inserción, sino mostrará los errores por los que nos se admitió los datos introducidos.
     * @param array $datos
     */
    public function validar_form_modificar(array $datos=array()) {
        
         \core\HTTP_Requerimiento::request_come_by_post();
         
        $validaciones = \modelos\teams::$validaciones_update;

        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)){  //validaciones en PHP
            $datos["errores"]["errores_validacion"]="Corrija los errores, por favor.";
        }else{
            $validacion = self::comprobar_files($datos);
            if ($validacion) {
                //Convertimos a formato MySQL
                self::convertir_a_formato_mysql($datos['values']);
                //var_dump($datos['values']);
                //if ( ! $validacion = \modelos\Modelo_SQL::insert($datos["values"], self::$tabla)) // Devuelve true o false
                if ( ! $validacion = \modelos\Datos_SQL::table(self::$tabla_e)->update($datos["values"])) // Devuelve true o false
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
        else{
            $_SESSION["alerta"] = "Se han modificado correctamente los datos";
//                $_SESSION["alerta"] = "Se han modificado correctamente los datos";
//                \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar(\core\Distribuidor::get_controlador_instanciado()));
//                \core\HTTP_Respuesta::enviar();
            //Para que se cierre la ventana al obtener el exitp
            $datos['view_content'] = \core\Vista::generar('index', $datos);
            $http_body = \core\Vista_Plantilla::generar('view_content', $datos);
            \core\HTTP_Respuesta::enviar($http_body);
        }  
        

    }
    
    /**
     * Comprueba que los ficheros que el usuario intenta subir a la aplicación cumple con los requerimietnos exigidos.
     * @param array $datos
     * @return boolean
     */
    private static function comprobar_files(array &$datos){
        $validacion = true;
        //var_dump($_FILES);
        if ( !empty( $_FILES["escudo"]["size"]) ) {
            if ($_FILES["escudo"]["error"] > 0 ) {
                $datos["errores"]["escudo"] = $_FILES["escudo"]["error"];
            }elseif ( ! preg_match("/image/", $_FILES["escudo"]["type"])) {
                $datos["errores"]["escudo"] = "El fichero no es una imagen.";
            }elseif ($_FILES["escudo"]["size"] > 512*512*1) {
                $datos["errores"]["escudo"] = "El tamaño de la imagen debe ser menor que 0,5MB.";
            }
            if (isset($datos["errores"]["escudo"])) {
                $validacion = false;
            }
        }
        return $validacion;
    }
    
        
    /**
     * Función que a través del id de un artículo guarda en la BD la referencia de los archivos multimedia del mismo que serán guardados en los recusros de la aplicación.  
     * @param array $datos
     */
    private static function mover_files(array $datos){
        //var_dump($datos);
        $id = $datos["values"]['id'];
        //var_dump($_FILES);
        if(isset($_FILES["escudo"]["size"])) {
            if ($datos["values"]["escudo"] = self::mover_imagen($id)) {
                $validacion = \modelos\Modelo_SQL::tabla(self::$tabla_e)->update($datos["values"]);
            }
        }
        //Creamos una carpeta para guardar más fotos en ella al añadir detalles
        $nombre = \modelos\ficheros::getNombreCarpeta($id);
        $file_path = PATH_APPLICATION."recursos".DS."ficheros".DS."teams";
        \modelos\ficheros::crearCarpeta($file_path, $nombre);
    }
    /**
     * Guarda un archivo jpg en nuestros recursos en función del id del artículo
     * Además crea una carpeta para añadir ficheros
     * @param $id
     * @return nombre del archivo o false
     */
    private static function mover_imagen($id, $ref = null) {
        // Ahora hay que añadir la foto
        $extension = substr($_FILES["escudo"]["type"], stripos($_FILES["escudo"]["type"], "/")+1);
        $nombre = \modelos\ficheros::getNombreCarpeta($id);
        $path_imagenes = PATH_APPLICATION."recursos".DS."ficheros".DS."teams";
        if( ! is_dir($path_imagenes.DS.$nombre) ){
            mkdir($path_imagenes.DS.$nombre);
        }
        $foto_path = $path_imagenes.DS.$nombre.DS.$nombre.".".$extension;
//					echo __METHOD__;echo $_FILES["foto"]["tmp_name"];  echo $foto_path; exit;
        // Si existe el fichero lo borramos
        if (is_file($foto_path)) {
            unlink($foto_path);
        }
        
        $validacion = move_uploaded_file($_FILES["escudo"]["tmp_name"], $foto_path);
        return ($validacion ? $nombre.".".$extension : false);
    }
    
     /**
     * Guarda un archivo pdf en nuestros recursos en función del id del artículo
     * @param  $id
     * @param  $articulo_nombre = null
     * @return nombre del archivo o false
     */
    private static function mover_manual($id, $articulo_nombre = null) {
        // Ahora hay que añadir la manual
        $extension = substr($_FILES["manual"]["type"], stripos($_FILES["manual"]["type"], "/")+1);
        if($articulo_nombre){
            $nombre = str_replace(" ", "-", $articulo_nombre);
        }else{
            $nombre = (string)$id;
            $nombre = "art".str_repeat("0", 5 - strlen($nombre)).$nombre;
        }
        $manual_path = PATH_APPLICATION."recursos".DS."ficheros".DS."manuales".DS.$nombre.".".$extension;
//					echo __METHOD__;echo $_FILES["manual"]["tmp_name"];  echo $manual_path; exit;
        // Si existe el fichero lo borramos
        if (is_file($manual_path)) {
            unlink($manual_path);
        }
        $validacion = move_uploaded_file($_FILES["manual"]["tmp_name"], $manual_path);
        return ($validacion ? $nombre.".".$extension : false);
    }
    /**
     * Elimina los ficheros guardados en nuestra aplicación.
     * @author Jorge Rodríguez <jergo23@gmail.com>
     * @param array $datos
     */
    private static function borrar_files(array $datos){
        $id = $datos["values"]['id'];
        
        $sql = 'select * from '.\core\Modelo_SQL::get_prefix_tabla(self::$tabla).' where id = '.$id;
        $fila = \core\Modelo_SQL::execute($sql);
        
        $foto = $fila[0]['escudo'];
        //$plano = $fila[0]['plano'];
        
        self::borrar_foto($foto);
        //self::borrar_manual($plano);
        
        //Borramos la carpeta creada al crear el inmueble para meter las fotos de los detalles
        $ficherosBienes_path = PATH_APPLICATION."recursos".DS."ficheros".DS."bienes";
        $nombre_carpeta = \modelos\ficheros::getNombreCarpeta($id); //$nombre_carpeta = substr($foto, 0, stripos($foto, '.' ) ); No funciona cuanod no existe la foto 
        //var_dump($nombre_carpeta);
        \modelos\ficheros::borrarCarpeta($ficherosBienes_path, $nombre_carpeta);
        
    }
    /**
     * Elimina una foto de la ruta recursos/imagenes/bienes
     * @param string $foto
     * @return null
     */
    private static function borrar_foto($foto) {
                
        $foto_path = PATH_APPLICATION."recursos".DS."imagenes".DS."bienes".DS.$foto;
        // Si existe el fichero lo borramos
        if (is_file($foto_path)) {
            return unlink($foto_path);
        }
        else {
            return null;
        }
    }
    /**
     * Fución que realiza las conversiones de los campos usados en está aplicación al formato utilizado por MySQL.
     * Convertimos a formato MySQL
     * @author Jorge Rodriguez Sanz
     * @param array $param Se corresponderá por regla general con datos['values'] y lo pasamos por referencia, para que modifique el valor
     */
    private static function convertir_a_formato_mysql(array &$param) {  //$param = datos['values'] y lo pasamos por referencia, para que modifique el valor        
        $param['coste_SO'] = \core\Conversiones::decimal_coma_a_punto($param['coste_SO']);
    }
    
     /**
     * Fución que realiza las conversiones de los campos que muestran las tablas del formato utilizado por MySQL al formato europeo.
     * Convertimos a formato MySQL
     * @author Jorge Rodriguez Sanz <jergo23@gmail.com>
     * @param array $param Se corresponderá por regla general con datos['values'] y lo pasamos por referencia, para que modificque el valor
     */
    private static function convertir_formato_mysql_a_ususario(array &$param) {  //$param = datos['values'] o $param = datos['filas'] si enviamos toda la tabla, y lo pasamos por referencia, para que modifique el valor
        //var_dump($param);
        $param['coste_SO']=  \core\Conversiones::decimal_punto_a_coma_y_miles($param['coste_SO']);        
        //var_dump($param);
    }
    
    public static function form_modificar_relacion(array $datos = array()) {

        $datos["form_name"] = __FUNCTION__;

        \core\HTTP_Requerimiento::request_come_by_post();  //Si viene por POST sigue adelante
        
        $relacion = explode('-',$_POST['id']);
        //var_dump($relacion);
        $jugador_id = $relacion[0];
        $equipo_id = $relacion[1];
        $_POST['jugador_id'] = $relacion[0];
        $_POST['$equipo_id'] = $relacion[1];
        $id = \modelos\teams::getId_Relatioship_PlayerTeam($jugador_id,$equipo_id);
        
        
        if ( ! isset($datos["errores"])) { // Si no es un reenvío desde una validación fallida
            $validaciones = \modelos\teams::$validaciones_update_relationship;
//            $validaciones=array(
//                "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla_je."/id"
//            );
//            if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
//                $datos['mensaje'] = 'Datos erróneos para identificar el elemento a modificar';
//                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
//                return;
//            }else{
                //$clausulas['where'] = " id = {$datos['values']['id']} ";
                $clausulas['where'] = " id = $id ";
                if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla_je)) {
                    $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                    \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                    return;
                }else{   
                    $datos['values'] = $filas[0];

                }
//            }
        }
             
        //Abriremos el formulario en una ventana nueva
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('view_content', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }
    
    public static function validar_form_modificar_relacion(array $datos = array()) {

        \core\HTTP_Requerimiento::request_come_by_post();
        $post = \core\HTTP_Requerimiento::post();
        //var_dump($post);
        $validaciones = \modelos\teams::$validaciones_update_relationship;
        
        if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)){  //validaciones en PHP
            $datos["errores"]["errores_validacion"]="Corrija los errores, por favor.";
        }else{
            //$validacion = self::comprobar_files($datos);
            if ($validacion) {
                
                if ( ! $validacion = \modelos\teams::update_Relatioship_PlayerTeam($post) ){ // Devuelve true o false
                    $datos["errores"]["errores_validacion"]="No se han podido grabar los datos en la bd.";
                }
                
            }
        }var_dump($datos);
        //exit;
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
                $this->cargar_controlador(self::$controlador, 'form_modificar_relacion',$datos);
        else {
                $_SESSION["alerta"] = "Se han modificado correctamente los datos";
                \core\HTTP_Respuesta::set_header_line("location", \core\URL::generar(\core\Distribuidor::get_controlador_instanciado()));
                \core\HTTP_Respuesta::enviar();
        }
        
        
        $datos["form_name"] = __FUNCTION__;

        \core\HTTP_Requerimiento::request_come_by_post();  //Si viene por POST sigue adelante

        $validaciones = \modelos\teams::$validaciones_update_relationship;
        
        if ( ! isset($datos["errores"])) { // Si no es un reenvío desde una validación fallida
            $validaciones=array(
                "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/".self::$tabla_e."/id"
            );
            if ( ! $validacion = ! \core\Validaciones::errores_validacion_request($validaciones, $datos)) {
                $datos['mensaje'] = 'Datos erróneos para identificar el elemento a modificar';
                \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                return;
            }else{
                $clausulas['where'] = " id = {$datos['values']['id']} ";
                if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$tabla_e)) {
                    $datos['mensaje'] = 'Error al recuperar la fila de la base de datos';
                    \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
                    return;
                }else{   
                    $datos['values'] = $filas[0];

                }
            }
        }
        
        //Mostramos los datos a modificar en formato europeo. Convertimos el formato de MySQL a europeo
             
        //Abriremos el formulario en una ventana nueva
        $datos['view_content'] = \core\Vista::generar(__FUNCTION__, $datos);
        $http_body = \core\Vista_Plantilla::generar('view_content', $datos);
        \core\HTTP_Respuesta::enviar($http_body);
    }
	
} // Fin de la clase
<?php
namespace modelos;
class players{    //la clase se tiene que llamar igual que el archivo
    
    private static $teams = array();
    private static $table_j = 'jugadores';
    private static $table_pos = 'posiciones';
    private static $table_e = 'equipos';
    private static $table_je = 'jugadores_equipos';

    public function __construct(){
        self::setTeams();
    }
    
    private static function setTeams(){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table );
        $sql = "select id, raza from $table";

        $razas = \modelos\Modelo_SQL::execute($sql);
        //$razas = \modelos\Modelo_SQL::table(self::$tabla)->select($clausulas);
        
        //var_dump($razas);
        self::$teams = $razas;
    }
    
    public static function getTeams(){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_e );
        $sql = "select * from $table order by raza";
        return \core\sgbd\mysqli::execute($sql);
    }
    
    public static function getPosiciones(){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_pos );
        $sql = "select * from $table order by id";
        return \core\sgbd\mysqli::execute($sql);
    }

    public static function altasCSV(){
        
    }
    
    public static $validaciones_insert = array(
        "nombre" => "errores_requerido && errores_texto"
        ,"posicion_id" => "errores_texto && errores_referencia:posicion_id/posiciones/id"
        ,"equipo_id[]" => "errores_numero_entero_positivo && errores_referencia:equipo_id/equipos/id"
        ,"mo" => "errores_requerido && errores_numero_entero_positivo"
        ,"fu" => "errores_requerido && errores_numero_entero_positivo"
        ,"ag" => "errores_requerido && errores_numero_entero_positivo"
        ,"ar" => "errores_requerido && errores_numero_entero_positivo"
        ,"habilidades" => "errores_texto"
        ,"tipo_hab_normal[]" => "errores_texto"
        ,"tipo_hab_doble[]" => "errores_texto"
        ,"coste" => "errores_precio_entero"
        ,"num_min" => "errores_numero_entero_positivo"
        ,"num_max" => "errores_numero_entero_positivo"
        ,"jugador_estrella" => "errores_numero_entero_positivo"
    );
    
    public static $validaciones_update = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/jugadores/id"
        ,"nombre" => "errores_requerido && errores_texto"
        ,"posicion_id" => "errores_texto && errores_referencia:posicion_id/posiciones/id"
        ,"equipo_id[]" => "errores_numero_entero_positivo && errores_referencia:equipo_id/equipos/id"
        ,"mo" => "errores_requerido && errores_numero_entero_positivo"
        ,"fu" => "errores_requerido && errores_numero_entero_positivo"
        ,"ag" => "errores_requerido && errores_numero_entero_positivo"
        ,"ar" => "errores_requerido && errores_numero_entero_positivo"
        ,"habilidades" => "errores_texto"
        ,"tipo_hab_normal[]" => "errores_texto"
        ,"tipo_hab_doble[]" => "errores_texto"
        ,"coste" => "errores_precio_entero"
        ,"num_min" => "errores_numero_entero_positivo"
        ,"num_max" => "errores_numero_entero_positivo"
        ,"jugador_estrella" => "errores_numero_entero_positivo"
        
    );


    public static $validaciones_delete = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/jugadores/id"
    );
    
    public static function insertDatos($data){
        //contruimos el array para insertar los datos en la tabla jugadores
        $insertPlayer = self::insertPlayer($data['values']);
        
        $data['values']['jugador_id'] = \modelos\Modelo_SQL::last_insert_id();
        $insertPlayerTeams = self::insertPlayerTeams($data['values']);
        
        return $insertPlayer && $insertPlayer;
    }

    private static function insertPlayer($data){
        $player = array();
        foreach ($data as $key => $value) {
            if( in_array( $key , array('nombre','posicion_id','mo', 'fu','ag','ar','habilidades','tipo_hab_normal','tipo_hab_doble','coste','jugador_estrella') ) )
                $player[$key] = $value;
        }
        
        if(isset($player['tipo_hab_normal'])){
            $tipo_hab_normal = $player['tipo_hab_normal'];
            $player['tipo_hab_normal'] = null;
            foreach ($tipo_hab_normal as $tipo_hab) {
                $player['tipo_hab_normal'] .= $tipo_hab;
            }
        }
        
        if(isset($player['tipo_hab_doble'])){
            $tipo_hab_normal = null;
            foreach ($player['tipo_hab_doble'] as $tipo_hab) {
                $tipo_hab_normal .= $tipo_hab;
            }
            $player['tipo_hab_doble'] = $tipo_hab_normal;
        }
        
        if(isset($data['is_active']))
            $player['is_active'] = $data['is_active'];
        
        return \modelos\Modelo_SQL::insert($player, self::$table_j);
        //return \modelos\Datos_SQL::table(self::$tabla_j)->insert($player);
    }
    
    private static function insertPlayerTeams($data){
        $playerTeam = array();
        foreach ($data as $key => $value) {
            if( in_array( $key , array('jugador_id','equipo_id','num_min','num_max') ) )
                $playerTeam[$key] = $value;
        }
        //var_dump($playerTeam);
        $teams = $playerTeam['equipo_id'];
        foreach ($teams as $equipo_id) {
            $playerTeam['equipo_id'] = $equipo_id;
            if( ! \modelos\Modelo_SQL::insert($playerTeam, self::$table_je) )
                return false;
        }
        return true;
    }
    
    public static function updateDatos($data){
        //contruimos el array para actualizar los datos en la tabla jugadores
        $updatePlayer = self::updatePlayer($data['values']);
        
        $data['values']['jugador_id'] = \modelos\Modelo_SQL::last_insert_id();
        $updatePlayerTeams = self::updatePlayerTeams($data['values']);
        
        return $updatePlayer && $updatePlayerTeams;
    }
    
    private static function updatePlayer($data){
        $player = array();
        foreach ($data as $key => $value) {
            if( in_array( $key , array('id','nombre','posicion_id','mo', 'fu','ag','ar','habilidades','tipo_hab_normal','tipo_hab_doble','coste','jugador_estrella') ) )
                $player[$key] = $value;
        }
        
        if(isset($player['tipo_hab_normal'])){
            $tipo_hab_normal = $player['tipo_hab_normal'];
            $player['tipo_hab_normal'] = null;
            foreach ($tipo_hab_normal as $tipo_hab) {
                $player['tipo_hab_normal'] .= $tipo_hab;
            }
        }
        
        if(isset($player['tipo_hab_doble'])){
            $tipo_hab_normal = null;
            foreach ($player['tipo_hab_doble'] as $tipo_hab) {
                $tipo_hab_normal .= $tipo_hab;
            }
            $player['tipo_hab_doble'] = $tipo_hab_normal;
        }

        if(isset($data['is_active']))
            $player['is_active'] = $data['is_active'];
        
        return \modelos\Modelo_SQL::update($player, self::$table_j);
        //return \modelos\Datos_SQL::table(self::$tabla_j)->insert($player);
    }
    
    private static function updatePlayerTeams($data){
        //var_dump($data);
        $playerTeam = array();
        foreach ($data as $key => $value) {
            if( in_array( $key , array('jugador_id','equipos') ) )
                $playerTeam[$key] = $value;
        }
        //Vamos a extraer los datos de la DB
        $table_je = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_je );
        $sql = "select * from $table_je where jugador_id = {$data['id']}";
        $rows = \modelos\Modelo_SQL::execute($sql);
        //Diferencia entre la DB y la modificacion
        $equipos_jugador = array();
        foreach ($rows as $row) {
            $equipos_jugador[] = $row['equipo_id'];
        }
        $teams_to_add = array_diff($data['equipo_id'], $equipos_jugador);
        $teams_to_delete = array_udiff($equipos_jugador, $data['equipo_id'], 'strcasecmp');

        //borramos
        foreach ($teams_to_delete as $equipo_id) {
            $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_je );
            $sql = "delete from $table where jugador_id = {$data['id']} and equipo_id = $equipo_id";
            if( ! \modelos\Modelo_SQL::execute($sql) )
                return false;
        }
        //Añadimos
        $playerTeam['jugador_id'] = $data['id'];
        foreach ($teams_to_add as $equipo_id) {
            $playerTeam['equipo_id'] = $equipo_id;
            //var_dump($playerTeam);
            if( ! \modelos\Modelo_SQL::insert($playerTeam, self::$table_je ) )
                return false;
        }
        return true;
    }
    
    /**
     * Fución que realiza las conversiones de los campos que muestran las tablas del formato utilizado por MySQL al formato europeo.
     * Convertimos a formato MySQL
     * @author Jorge Rodriguez Sanz <jergo23@gmail.com>
     * @param array $param Se corresponderá por regla general con datos['values'] y lo pasamos por referencia, para que modificque el valor
     */
    public static function convertir_formato_mysql_a_ususario_pt(array &$param) {  //$param = datos['values'] o $param = datos['filas'] si enviamos toda la tabla, y lo pasamos por referencia, para que modifique el valor
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
    
    public static function getTeamsFromPlayer($player_id){
//        $table = self::$table_je;
//        $clausulas['where'] = "jugador_id = $player_id";
//        
//        return \core\sgbd\mysqli::select($clausulas, $table);
        /*Otra forma*/
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_je );
        $sql = "select equipo_id from $table";
        $sql .= " where jugador_id = $player_id";
        
        $ids = \core\sgbd\mysqli::execute($sql);
        $equipos = null;
        foreach ($ids as $value) {
            $equipos[] = $value['equipo_id'];
        }
        //var_dump($equipos);
        return $equipos;
    }
    
    public static function selectPlayers(array $clausulas = array()){
        //var_dump($post);
        $clausulas['where'] = "is_active = true";
        $clausulas['order_by'] = "nombre";
        //$clausulas['group_by'] = "id";
        
        if ( ! $filas = \modelos\Datos_SQL::select( $clausulas, self::$table_j)) {
            $datos['mensaje'] = 'Lista no disponibe, sentimos las molestias';
            \core\Distribuidor::cargar_controlador('mensajes', 'mensaje', $datos);
            return;
        }
        
        return $filas;
    }
}
?>

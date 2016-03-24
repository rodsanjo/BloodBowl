<?php
namespace modelos;
class teams{    //la clase se tiene que llamar igual que el archivo
    
    private static $teams = array();
    private static $table_team = 'equipos';
    private static $table_conf = 'conferencias';
    private static $vista_razas = 'v_equipo_jugador';
    private static $table_je = 'jugadores_equipos';

    public function __construct(){
        self::setTeams();
    }
    
    private static function setTeams(){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_team );
        $sql = "select id, raza from $table order by raza";

        $razas = \modelos\Modelo_SQL::execute($sql);
        //$razas = \modelos\Modelo_SQL::table(self::$tabla)->select($clausulas);
        
        //var_dump($razas);
        self::$teams = $razas;
    }
    
    public static function getTeams(){
        return self::$teams;
    }
    
    public static function getPlayers_by_team($equipo){
        $equipo_id = $equipo['id'];
        $clausulas['where'] = " equipo_id = $equipo_id ";
        $clausulas['where'] .= " and is_active = 1 ";
        $clausulas['order_by'] = " posicion_id ";

        return \modelos\Modelo_SQL::table(self::$vista_razas)->select($clausulas);       
    }

    public static function getConferences(){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_conf );
        $sql = "select * from $table";
        $conferencias = \core\sgbd\mysqli::execute($sql);
        return $conferencias;
    }
    
    public function getTeams_byConferenceName( $conf_nombre_es ){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_conf );
        $sql = "select * from $table where nombre_es = $conf_nombre_es";
        $conferencia = \core\sgbd\mysqli::execute($sql);
        
        $clausulas['where'] = " {$conferencia['siglas']}";
        $teams = \modelos\Modelo_SQL::table(self::$table_team)->select($clausulas);
        
        return $teams;
    }

    public static function altasCSV(){
        
    }
    
    public static $validaciones_update = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/equipos/id"
        ,"raza" => "errores_texto"
        ,"especies" => "errores_texto"
        //,"escudo" => "errores_texto" //¡¡OJO!! no se debe poner aqui porque borra la imagen si no se envia
        ,"coste_SO" => "errores_precio_entero"
        ,"conferencia_siglas" => "errores_texto"
        ,"lado_oscuro" => "errores_texto"
        ,"is_active" => "errores_texto"
    );
    
    public static $validaciones_update_relationship = array(
        "jugador_id" => "errores_requerido && errores_numero_entero_positivo"
        ,"equipo_id" => "errores_requerido && errores_numero_entero_positivo"
    );
    
    public static function getId_Relatioship_PlayerTeam($jugador_id, $equipo_id){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_je );
        $sql = "select id from $table where jugador_id=$jugador_id and equipo_id=$equipo_id";
        $id = \core\sgbd\mysqli::execute($sql);
        return $id[0]['id'];
    }
    public static function update_Relatioship_PlayerTeam($post){
        var_dump($post);
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_je );
        $sql = "update $table
            set num_min={$post['num_min']}, num_max={$post['num_max']}
            where id={$post['id']} and
           (equipo_id={$post['equipo_id']} and jugador_id={$post['jugador_id']})
           ";
           echo $sql;
        return \core\sgbd\mysqli::execute($sql);
    }
}
?>

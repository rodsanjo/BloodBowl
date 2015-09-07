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
        ,"hab_norm" => "errores_texto"
        ,"hab_dbl" => "errores_texto"
        ,"coste" => "errores_precio_entero"
        ,"num_min" => "errores_numero_entero_positivo"
        ,"num_max" => "errores_numero_entero_positivo"
        ,"jug_estrella" => "errores_numero_entero_positivo"
    );
    
    public static $validaciones_update = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/jugadores/id"
        
    );


    public static $validaciones_delete = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/jugadores/id"
    );
    
    public static function insertPlayer($datos){
        var_dump($datos);
        \modelos\Modelo_SQL::insert($datos["values"], self::$tabla);
        \modelos\Datos_SQL::table(self::$tabla_j)->insert($datos["values"]);
        return false;
    }
}
?>

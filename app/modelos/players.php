<?php
namespace modelos;
class players{    //la clase se tiene que llamar igual que el archivo
    
    private static $teams = array();
    private static $table_j = 'jugadores';
    private static $table_pos = 'posiciones';
    private static $table_e = 'equipos';

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
    
    public static $validaciones_update = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/equipos/id"
        , "raza" => "errores_texto"
        , "escudo" => "errores_texto"
        , "coste_SO" => "errores_precio_entero"
        , "conferencia_siglas" => "errores_texto"
        ,"lado_oscuro" => "errores_texto"
    );
}
?>

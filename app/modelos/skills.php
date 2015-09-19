<?php
namespace modelos;
class skills{    //la clase se tiene que llamar igual que el archivo
    
    private static $teams = array();
    private static $table = 'habilidades';
    private static $table_conf = 'conferencias';
    private static $vista_razas = 'v_equipo_jugador';

    public static function getNombreTipo($sigla){
        if($sigla == 'A'){
            return 'Agilidad';
        }elseif($sigla == 'F'){
            return 'Fuerza';
        }elseif($sigla == 'P'){
            return 'Pase';
        }elseif($sigla == 'M'){
            return 'Mutación';
        }else{
            return 'General';
        }
    }
    
    public static function getTipos(){
        $table = \modelos\Modelo_SQL::get_prefix_tabla( self::$table );
        $sql = "select distinct tipo from $table";
        $siglasTipos = \modelos\Modelo_SQL::execute($sql);
        return $siglasTipos;
    }
    
    public static $validaciones_insert = array(
        "nombre" => "errores_requerido && errores_texto"
        ,"tipo" => "errores_texto"
        ,"descripcion" => "errores_texto"
    );

    public static $validaciones_update = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/jugadores/id"
        ,"nombre" => "errores_requerido && errores_texto"
        ,"tipo" => "errores_texto"
        ,"descripcion" => "errores_texto"
        
    );

    public static $validaciones_delete = array(
        "id" => "errores_requerido && errores_numero_entero_positivo && errores_referencia:id/habilidades/id"
    );

    
}
?>

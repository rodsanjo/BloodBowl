<?php
namespace modelos;
class conferences{    //la clase se tiene que llamar igual que el archivo
    
    public static $confs = array();
    public static $teams = array();
    private static $table_teams = 'equipos';
    private static $table_confs = 'conferencias';
    private static $vista_razas = 'v_equipo_jugador';
    private static $table_je = 'jugadores_equipos';

    public function __construct( $siglas = null ){
        self::setConferences( $siglas );
    }
    
    private static function setConferences( $siglas = null ){
       
        if( !empty($siglas) ){
            $clausulas['where'] = " siglas = '$siglas'";
                        
            self::setTeams_byConferenceSiglas( $siglas );
        }
        self::$confs = \modelos\Modelo_SQL::table(self::$table_confs)->select($clausulas);
        
    }
    
    public static function getConferences(){
        return self::$confs;
    }
    
    public static function setTeams_byConferenceSiglas( $siglas = null ){

        if( $siglas == 'TMU' ){ //Todos los equipos afiliados
            $clausulas['where'] = "conferencia_siglas != ''";
        }elseif ( $siglas == 'na' ) {
            $clausulas['where'] = "conferencia_siglas is null";
        }else{
            $clausulas['where'] = "conferencia_siglas = '$siglas'";
        }
        
        self::$teams = \modelos\Modelo_SQL::table(self::$table_teams)->select($clausulas);
        
    }
    
    public function getTeams_byConferenceName( $conf_nombre_es ){
        $table_conf = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_confs );
        $sql = "select * from $table_conf where nombre_es = $conf_nombre_es";
        $conferencia = \core\sgbd\mysqli::execute($sql);
        
        $clausulas['where'] = " {$conferencia['siglas']}";
        $teams = \modelos\Modelo_SQL::table(self::$table_teams)->select($clausulas);
        
        return $teams;
    }
}
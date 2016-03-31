<?php
namespace modelos;
class conferences{    //la clase se tiene que llamar igual que el archivo
    
    public $conf = array();
    public static $confs = array();
    public $teams = array();
    private static $table_teams = 'equipos';
    private static $table_confs = 'conferencias';
    private static $vista_razas = 'v_equipo_jugador';
    private static $table_je = 'jugadores_equipos';

    public function __construct( $siglas = null ){
        self::setConference( $siglas );
    }
    
    private function setConference( $siglas = null ){
       
        if( !empty($siglas) ){
            $clausulas['where'] = " siglas = '$siglas'";
                        
            self::setTeams_byConferenceSiglas( $siglas );
        }
        $this->conf = \modelos\Modelo_SQL::table(self::$table_confs)->select($clausulas);
        
    }
    
    public function getConference(){
        return $this->conf;
    }
    
    public static function getConferences(){
        $table_conf = \modelos\Modelo_SQL::get_prefix_tabla( self::$table_confs );
        $sql = "select distinct siglas, nombre from $table_conf 
            where siglas not like 'TMU'";
        self::$confs = \core\sgbd\mysqli::execute($sql);
        return self::$confs;
    }
    
    public function setTeams_byConferenceSiglas( $siglas = null ){

        if( $siglas == 'TMU' ){ //Todos los equipos afiliados
            $clausulas['where'] = "conferencia_siglas != ''";
        }elseif ( $siglas == 'na' ) {
            $clausulas['where'] = "conferencia_siglas is null";
        }else{
            $clausulas['where'] = "conferencia_siglas = '$siglas'";
        }
        
        $clausulas['order_by'] = " conferencia_siglas";
        
        $this->teams = \modelos\Modelo_SQL::table(self::$table_teams)->select($clausulas);
        
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
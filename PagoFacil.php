<?php
/**
 * Created by Vendetta.
 * User: abelolguinchavez
 * Date: 29/07/16
 * Time: 11:19
 */

namespace pagofacilconsume;

include __DIR__."/Rest.php";

class PagoFacil
{
    public static $id_sucursal;
    public static $id_usuario;
    private static $develop     = false;
    private static $api_dev     = "https://www.pagofacil.net/st/public/";
    private static $api_prod    = "https://www.pagofacil.net/ws/public/";

    /**
     * @param $id_sucursal
     * @param $id_usuario
     *
     * Inicializa las llaves
     *
     * Inicializa las llaves de la sucursal y el usuario
     */
    public static function initialize($id_sucursal,$id_usuario){
        self::$id_sucursal  = $id_sucursal;
        self::$id_usuario   = $id_usuario;
    }

    /**
     * Cambio a modo desarrollo
     */
    public static function develop_mode(){
        self::$develop = true;
    }

    /**
     * @return bool
     *
     * Si estamos en desarrollo
     *
     * Retorna si el consumo esta en modo desarrollo
     */
    public static function is_develop_mode(){
        return self::$develop;
    }


    /**
     * @param $params
     * @return mixed
     *
     * Generar un cargo
     *
     * Genera un cargo en dinerofacil
     */
    public static function card_charge($params){
        $internal_values = ["data[idSucursal]" => self::$id_sucursal,
                            "data[idUsuario]"  => self::$id_usuario,
                            "method"           => "transaccion"];

        $data = array_merge($internal_values,$params);

        return Rest::call("get",self::get_api_url()."Wsrtransaccion/index/format/json",$data);
    }

    public static function cash_charge($params){
        $internal_values = [
            "branch_key"    => self::$id_sucursal,
            "user_key"      => self::$id_usuario
        ];

        $data = array_merge($internal_values,$params);

        return Rest::call("post",self::get_api_url()."cash/charge",$data);
    }
    /**
     * @return string
     *
     * Devuelve la url del api
     *
     * Depende si estamos en desarrollo o produccion
     */
    private static function get_api_url(){
        return self::is_develop_mode()?self::$api_dev:self::$api_prod;
    }

}

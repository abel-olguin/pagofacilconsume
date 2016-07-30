<?php
/**
 * Created by Vendetta.
 * User: abelolguinchavez
 * Date: 29/07/16
 * Time: 21:36
 */

include __DIR__."/../PagoFacil.php";
use \pagofacilconsume\PagoFacil as PagoFacil;

PagoFacil::initialize(1,1);

PagoFacil::develop_mode();


$data = [
    "data[nombre]"          => "Juan",
    "data[apellidos]"       => "Lopez",
    "data[numeroTarjeta]"   => "5579567890123456",
    "data[cvt]"             => "123",
    "data[cp]"              => 11560,
    "data[mesExpiracion]"   => 10,
    "data[anyoExpiracion]"  => 15,
    "data[monto]"           => 100,
    "data[idServicio]"      => 3,
    "data[email]"           => "comprador@correo.com",
    "data[telefono]"        => 5550220910,
    "data[celular]"         => 5550123456,
    "data[calleyNumero]"    => "AnatoleFrance311",
    "data[colonia]"         => "Polanco",
    "data[municipio]"       => "MiguelHidalgo",
    "data[estado]"          => "DistritoFederal",
    "data[pais]"            => "Mexico"];

var_dump(PagoFacil::charge($data));

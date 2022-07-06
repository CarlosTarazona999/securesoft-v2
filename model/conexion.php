<?php
//require_once ( $_SERVER['DOCUMENT_ROOT'].'/atm/ctrl/checklogin.php' );
ini_set('display_errors', true);
date_default_timezone_set('America/Lima');

class Database
{
    public static function iniciarConexion()
    {
        $servidor = "127.0.0.1:3306";
        $base_de_datos = "bdform";
        $usuario = "root";
        $clave = "";

        try {

            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            );

            $pdo = new PDO("mysql:host=$servidor;dbname=$base_de_datos", $usuario, $clave, $options);

            return $pdo;
            echo "Conectado!";
        } catch (PDOException $e) {
            echo "No conectado " . $e->getMessage() . "<br />";
            die();
        }
    }
}

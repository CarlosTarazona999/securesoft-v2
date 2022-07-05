<?php
include_once ("conexion.php");

class usersModelo{

function mostrarUsersdeBD(){
         
    try
    {
        $this->pdo = DatabaseJoomla::iniciarConexionJoomla();
        $arrayData=array();
        $statement = $this->pdo->prepare("SELECT * FROM qai0x_users");
        $statement->execute();
        $arrayData = $statement->fetchAll(PDO::FETCH_OBJ);
         
        return  $arrayData;

}

catch(Exception $e)
{
    die($e->getMessage());
}

}


function traerUserxIDdesdeBD($param){
    
    $this->pdo = DatabaseJoomla::iniciarConexionJoomla();
        $busquedaxid=array();
        $statement = $this->pdo->prepare("SELECT *
        FROM qai0x_users where id=:id_joomla");
        $statement->bindValue(":id_joomla", $param);
        $statement->execute();
        $busquedaxid = $statement->fetchAll(PDO::FETCH_OBJ);
         
        return $busquedaxid;


}


}
/*
$key=477;
$userObj=new usersModelo;
//$arrayDataUser1= $userObj->mostrarUsersdeBD();
$arrayDataUser= $userObj->traerUserxIDdesdeBD($key);

print_r ($arrayDataUser);
//rint_r ($arrayDataUser1);*/

?>
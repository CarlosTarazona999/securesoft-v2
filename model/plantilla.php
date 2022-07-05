<?php
include_once ("conexion.php");

class  PlantillaModelo  
{
  private $plantilla_id;
  private $plantillla_nombre;
 private $plantilla_sigla;
  private $plantilla_doc;
  private $plantilla_fcrea;
  private $plantilla_fact;
  private $plantilla_createdBy;
  private $plantilla_updatedBy; 
  

  public function setId($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_id = $entrada;
}
public function setNombre($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_nombre = $entrada;
}
public function setDocumento($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_doc = $entrada;
}

public function setFcrea($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_fcrea = $entrada;
}
public function setFact($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_fact = $entrada;
}
public function setCreatedBy($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_createdBy = $entrada;
}
public function setUpdatedBy($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_updatedBy = $entrada;
}

public function setSigla($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->plantilla_sigla=$entrada ;
}
 //get
 public function getId(){ //Añadir nueva informacion a la variable / Elemento
    return $this->plantilla_id;
 }
 public function getNombre(){ //Añadir nueva informacion a la variable / Elemento
   return $this->plantilla_nombre;
}

public function getDocumento(){ //Añadir nueva informacion a la variable / Elemento
   return  $this->plantilla_doc;
}

public function getFcrea(){ //Añadir nueva informacion a la variable / Elemento
    return $this->plantilla_fcrea ;
}
public function getFact(){ //Añadir nueva informacion a la variable / Elemento
    return  $this->plantilla_fact ;
}
public function getCreatedBy(){ //Añadir nueva informacion a la variable / Elemento
    return $this->plantilla_createdBy;
}
public function getUpdatedBy(){ //Añadir nueva informacion a la variable / Elemento
    return $this->plantilla_updatedBy ;
}


public function getSigla(){ //Añadir nueva informacion a la variable / Elemento
    return $this->plantilla_sigla ;
}
//funciones




function mostrarPlantilladesdeBD(){
         
    try
    {
        $this->pdo = Database::iniciarConexion();
        $arrayCategoria=array();
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_plantillas");
        $statement->execute();
        $arrayCategoria = $statement->fetchAll(PDO::FETCH_OBJ);
         
        return $arrayCategoria;

}

catch(Exception $e)
{
    die($e->getMessage());
}

}

function mostrarReportedesdeBD(){
         
    try
    {
        $this->pdo = Database::iniciarConexion();
        $array=array();
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_reporte");
        $statement->execute();
        $array = $statement->fetchAll(PDO::FETCH_OBJ);
         
        return $array;

}

catch(Exception $e)
{
    die($e->getMessage());
}

}


function mostrarProductodesdeBD(){
         
    try
    {
        $this->pdo = Database::iniciarConexion();
        $arrayProductos=array();
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_Producto");
        $statement->execute();
        $arrayProductos = $statement->fetchAll(PDO::FETCH_OBJ);
         
        return  $arrayProductos;

}

catch(Exception $e)
{
    die($e->getMessage());
}

}


function insertarPlantillaenBD($plantilla){

    try
    {
    
    $this->pdo = Database::iniciarConexion();
    $statement = $this->pdo->prepare("INSERT INTO mgmzbx_plantillas(plantilla_sigla,plantilla_nombre,plantilla_doc,plantila_fcrea,plantilla_fact,plantilla_createdBy,plantilla_updatedBy) VALUES (:p1,:p2,:p3,:p4,:p5,:p6,:p7)");
    $statement->bindValue(":p1", $plantilla->getSigla());
    $statement->bindValue(":p2", $plantilla->getNombre());
    $statement->bindValue(":p3", $plantilla->getDocumento());
    $statement->bindValue(":p4", $plantilla->getFcrea());
    $statement->bindValue(":p5", $plantilla->getFact());
    $statement->bindValue(":p6", $plantilla->getCreatedBy());
    $statement->bindValue(":p7", $plantilla->getUpdatedBy());

    $resultset = $statement->execute();
     //Ejecuta en la base de datos
    $msje = "Datos insertados correctamente";  
    
   // echo $msje,"estamos en el model";
    return $msje;

   }

   catch(Exception $e)
   {
       die($e->getMessage());
   }



}


function   mostrarBusquedadesdeBD($formBusqueda){


    try
    {

        $this->pdo = Database::iniciarConexion();
        $arrayBusqueda=array();

        $query = '%'.$formBusqueda.'%';
    
        $statement = $this->pdo->prepare("SELECT  * FROM mgmzbx_plantillas WHERE plantilla_nombre  LIKE :query order by plantilla_id asc LIMIT 999 ");
        $statement->bindValue(':query', $query);//variable de sql
        $statement->execute();

        $arrayBusqueda = $statement->fetchAll(PDO::FETCH_OBJ);

        return $arrayBusqueda;

}
     
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }



}

  //actualizar en Base de datos //insertarActualizacionBD

  function insertarActualizacionBD($plantilla){   
    try
    {
        $this->pdo = Database::iniciarConexion();
       // $arrayPersonal=array();
        $statement = $this->pdo->prepare("UPDATE mgmzbx_plantillas SET 
        plantilla_sigla=:sigla,
        plantilla_doc=:doc,
        plantila_fcrea=:fcrea,
        plantilla_fact=:fact,
        plantilla_createdBy=:createdBy,
        plantilla_updatedBy=:updatedBy
        WHERE  plantilla_nombre=:nombre");
        $statement->bindValue(":sigla", $plantilla->getSigla());
        $statement->bindValue(":nombre", $plantilla->getNombre());
        $statement->bindValue(":doc", $plantilla->getDocumento());
        $statement->bindValue(":fcrea", $plantilla->getFcrea());
        $statement->bindValue(":fact", $plantilla->getFact());  
        $statement->bindValue(":createdBy", $plantilla->getCreatedBy());
        $statement->bindValue(":updatedBy", $plantilla->getUpdatedBy());
 
        $resultset = $statement->execute();
        //Ejecuta en la base de datos
        $msje = "Datos actualizados correctamente";  
       
      // echo $msje,"estamos en el model";
        return $msje;


}

catch(Exception $e)
{
    die($e->getMessage());
}

}


function   buscarProductoxId($formBusqueda){


    try
    {

        $this->pdo = Database::iniciarConexion();
        $arrayBusqueda=array();

        $query = $formBusqueda;
    
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_Producto WHERE ProductoZb_id LIKE :query");
        $statement->bindValue(':query', $query);//variable de sql
        $statement->execute();

        $arrayBusqueda = $statement->fetchAll(PDO::FETCH_OBJ);

        return $arrayBusqueda;

}
     
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }



}
//

function  mostrarBqdFrecuenciadeBD($formBusqueda){


    try
    {

        $this->pdo = Database::iniciarConexion();
        $arrayBusqueda=array();

        $query = $formBusqueda;
    
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_reporte WHERE reporte_id LIKE :query");
        $statement->bindValue(':query', $query);//variable de sql
        $statement->execute();

        $arrayBusqueda = $statement->fetchAll(PDO::FETCH_OBJ);

        return $arrayBusqueda;

}
     
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }



}



function   mostrarBqdPlantillaBD($formBusqueda){


    try
    {

        $this->pdo = Database::iniciarConexion();
        $arrayBusqueda=array();

        $query = $formBusqueda;
    
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_plantillas WHERE plantilla_id LIKE :query");
        $statement->bindValue(':query', $query);//variable de sql
        $statement->execute();

        $arrayBusqueda = $statement->fetchAll(PDO::FETCH_OBJ);

        return $arrayBusqueda;

}
     
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }



}

function   mostrarBqdPlantillaNameBD($formBusqueda){


    try
    {

        $this->pdo = Database::iniciarConexion();
        $arrayBusqueda=array();

        $query = '%'.$formBusqueda.'%';
    
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_plantillas WHERE plantilla_doc LIKE :query");
        $statement->bindValue(':query', $query);//variable de sql
        $statement->execute();

        $arrayBusqueda = $statement->fetchAll(PDO::FETCH_OBJ);

        return $arrayBusqueda;

}
     
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }



}




}

/*
$obj=new PlantillaModelo;
$array=$obj->mostrarReportedesdeBD();
print_r($array);*/

?>


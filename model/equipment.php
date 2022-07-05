<?php

include_once ("conexion.php");
class equipoModelo{

private $equipo_id,$equipo_fk_Producto,$equipo_grafico,$equipo_detalle,$equipo_fk_categoria;


public function setId($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->equipo_id = $entrada;
}

public function setProducto($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->equipo_fk_Producto= $entrada;
}

public function setGrafico($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->equipo_grafico= $entrada;
}

public function setDetalle($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->equipo_detalle= $entrada;
}

public function setCategoria($entrada){ //Añadir nueva informacion a la variable / Elemento
    $this->equipo_fk_categoria= $entrada;
}


//get

public function getId(){ //Añadir nueva informacion a la variable / Elemento
  return  $this->equipo_id ;
}

public function getProducto(){ //Añadir nueva informacion a la variable / Elemento
  return  $this->equipo_fk_Producto;
}

public function getGrafico(){ //Añadir nueva informacion a la variable / Elemento
  return  $this->equipo_grafico;
}

public function getDetalle(){ //Añadir nueva informacion a la variable / Elemento
  return  $this->equipo_detalle;
}

public function getCategoria(){ //Añadir nueva informacion a la variable / Elemento
  return  $this->equipo_fk_categoria;
}


    function mostrarCategoriadeBD(){
         
        try
        {
            $this->pdo = Database::iniciarConexion();
            $arrayData=array();
            $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_categoria");
            $statement->execute();
            $arrayData = $statement->fetchAll(PDO::FETCH_OBJ);
             
            return  $arrayData;
    
    }
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }
    
    }

    function mostrarEquiposdeBD(){
         
        try
        {
            $this->pdo = Database::iniciarConexion();
            $arrayData=array();
            $statement = $this->pdo->prepare("SELECT e.equipo_id,c.ProductoZb_sigla,e.equipo_grafico,e.equipo_detalle
            FROM mgmzbx_equipo e
            INNER JOIN mgmzbx_Producto c ON e.equipo_fk_Producto = c.ProductoZb_id ");
            $statement->execute();
            $arrayData = $statement->fetchAll(PDO::FETCH_OBJ);
             
            return  $arrayData;
    
    }
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }
    
    }

    function   mostrarEquipoxIdBD($formBusqueda){

        try
        {
    
            $this->pdo = Database::iniciarConexion();
            $arrayBusqueda=array();
    
            $query = $formBusqueda;
        
            $statement = $this->pdo->prepare("SELECT  e.equipo_id,e.equipo_fk_Producto,c.ProductoZb_nombre,e.equipo_grafico,e.equipo_detalle,t.categoria_nombre,e.equipo_fk_categoria
            FROM mgmzbx_equipo e
            INNER JOIN mgmzbx_Producto c ON e.equipo_fk_Producto = c.ProductoZb_id
            INNER JOIN mgmzbx_categoria t ON e.equipo_fk_categoria = t.categoria_id
             WHERE e.equipo_id  LIKE :query");
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
   
function   mostrarBqdEquipoxIdBD($formBusqueda){

    try
    {

        $this->pdo = Database::iniciarConexion();
        $arrayBusqueda=array();

        $query = $formBusqueda;
    
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_equipo WHERE equipo_id  LIKE :query");
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





function   mostrarBqdEquipoxGraficoBD($formBusqueda){

    try
    {

        $this->pdo = Database::iniciarConexion();
        $arrayBusqueda=array();

        $query = '%'.$formBusqueda.'%';
    
        $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_equipo WHERE equipo_grafico  LIKE :query");
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

    function mostrarEquipodeBD(){
         
        try
        {
            $this->pdo = Database::iniciarConexion();
            $arrayData=array();
            $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_equipo");
            $statement->execute();
            $arrayData = $statement->fetchAll(PDO::FETCH_OBJ);
             
            return  $arrayData;
    
    }
    
    catch(Exception $e)
    {
        die($e->getMessage());
    }
    
    }


    function insertarEquipoenBD($equipo){

        try
        {
        
        $this->pdo = Database::iniciarConexion();
        $statement = $this->pdo->prepare("INSERT INTO mgmzbx_equipo(equipo_fk_Producto,equipo_grafico,equipo_detalle,equipo_fk_categoria) VALUES (:p1,:p2,:p3,:p4)");
        $statement->bindValue(":p1", $equipo->getProducto());
        $statement->bindValue(":p2", $equipo->getGrafico());
        $statement->bindValue(":p3", $equipo->getDetalle());
        $statement->bindValue(":p4", $equipo->getCategoria());
    
    
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


    function mostrarBqdEquipodesdeBD($formBusqueda){

        try
        {
    
            $this->pdo = Database::iniciarConexion();
            $arrayBusqueda=array();
    
            $query = '%'.$formBusqueda.'%';
        
            $statement = $this->pdo->prepare("SELECT p.equipo_id,c.ProductoZb_nombre,p.equipo_grafico,p.equipo_detalle,t.categoria_nombre,c.ProductoZb_url
            FROM mgmzbx_equipo p
            INNER JOIN mgmzbx_Producto c ON p.equipo_fk_Producto = c.ProductoZb_id
            INNER JOIN mgmzbx_categoria t ON p.equipo_fk_categoria = t.categoria_id
            WHERE c.ProductoZb_nombre LIKE :query ORDER BY p.equipo_id asc  LIMIT 999 ");
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
  
 
    function actualizarEquipoenBD($equipoNuevo){
         
        try
        {
            $this->pdo = Database::iniciarConexion();
           // $arrayPersonal=array();
            $statement = $this->pdo->prepare("UPDATE mgmzbx_equipo SET 

            equipo_fk_Producto=:cli,
            equipo_grafico=:graf,
            equipo_detalle=:det,
            equipo_fk_categoria=:cat

            WHERE   equipo_id=:id");
            $statement->bindValue(":id", $equipoNuevo->getId()); 
            $statement->bindValue(":cli", $equipoNuevo->getProducto());
            $statement->bindValue(":graf", $equipoNuevo->getGrafico());
            $statement->bindValue(":det", $equipoNuevo->getDetalle());
            $statement->bindValue(":cat", $equipoNuevo->getCategoria());
            
      
     
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


}
/*
$x="fffff";
$obj=new equipoModelo;
$array=$obj->mostrarBqdEquipodesdeBD($x);
print_r($array);*/

?>
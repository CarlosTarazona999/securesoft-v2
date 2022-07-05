<?php

include_once("../model/conexion.php");

class Producto
{

  private $Id, $Producto, $Categoria, $Precio, $Stock, $Imagen;
  // private $db;
  //get
  function getId()
  {
    return $this->Id;
  }
  function getProducto()
  {
    return $this->Producto;
  }
  function getCategoria()
  {
    return $this->Categoria;
  }
  function getPrecio()
  {
    return $this->Precio;
  }
  function getStock()
  {
    return $this->Stock;
  }
  function getImagen()
  {
    return $this->Imagen;
  }
  //set
  function setId($Input)
  {
    return $this->Id = $Input;
  }
  function setProducto($Input)
  {
    return $this->Producto = $Input;
  }
  function setCategoria($Input)
  {
    return $this->Categoria = $Input;
  }
  function setPrecio($Input)
  {
    return $this->Precio = $Input;
  }
  function setStock($Input)
  {
    return $this->Stock = $Input;
  }
  function setImagen($Input)
  {
    return $this->Imagen = $Input;
  }


  // function updateProducto($Producto)
  // {


  //   try {
  //     $this->pdo = Database::iniciarConexion();
  //     // $arrayPersonal=array();
  //     $statement = $this->pdo->prepare("UPDATE mgmzbx_Producto SET 

  //       ProductoZb_pais=:p1,
  //       ProductoZb_sigla=:p2,
  //       ProductoZb_nombre=:p3,
  //       ProductoZb_ip=:p4,
  //       ProductoZb_url=:p5,
  //       ProductoZb_dateUpdate=:p6,
  //       ProductoZb_UpdateBy=:p7

  //       WHERE   ProductoZb_id=:id");

  //     $statement->bindValue(":id", $Producto->getId());
  //     $statement->bindValue(":p1", $Producto->getPais());
  //     $statement->bindValue(":p2", $Producto->getSigla());
  //     $statement->bindValue(":p3", $Producto->getNombre());
  //     $statement->bindValue(":p4", $Producto->getIP());
  //     $statement->bindValue(":p5", $Producto->getURL());
  //     $statement->bindValue(":p6", $Producto->getDateUpdate());
  //     $statement->bindValue(":p7", $Producto->getUpdateBy());
  //     $resultset = $statement->execute();
  //     //Ejecuta en la base de datos
  //     $msje = "Datos actualizados correctamente";
  //     // echo $msje,"estamos en el model";
  //     return $msje;
  //   } catch (Exception $e) {
  //     die($e->getMessage());
  //   }
  // }


  function ProductoxId($id)
  {

    try {

      $this->pdo = Database::iniciarConexion();
      $array = array();

      $query = $id;

      $statement = $this->pdo->prepare("SELECT * FROM mgmzbx_Producto WHERE ProductoZb_id  LIKE :query");
      $statement->bindValue(':query', $query); //variable de sql
      $statement->execute();

      $array = $statement->fetchAll(PDO::FETCH_OBJ);

      return $array;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  function guardarProducto($Producto)
  {

    try {

      $this->pdo = Database::iniciarConexion();
      $statement = $this->pdo->prepare("INSERT INTO mgmzbx_Producto(ProductoZb_pais,ProductoZb_sigla,ProductoZb_nombre,ProductoZb_ip,ProductoZb_url,ProductoZb_dateCreacion,ProductoZb_dateUpdate,ProductoZb_creadoBy,ProductoZb_UpdateBy) VALUES (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9)");
      $statement->bindValue(":p1", $Producto->getPais());
      $statement->bindValue(":p2", $Producto->getSigla());
      $statement->bindValue(":p3", $Producto->getNombre());
      $statement->bindValue(":p4", $Producto->getIP());
      $statement->bindValue(":p5", $Producto->getURL());
      $statement->bindValue(":p6", $Producto->getDateCreado());
      $statement->bindValue(":p7", $Producto->getDateUpdate());
      $statement->bindValue(":p8", $Producto->getCreadoBy());
      $statement->bindValue(":p9", $Producto->getUpdateBy());


      $resultset = $statement->execute();
      //Ejecuta en la base de datos
      $msje = "Datos insertados correctamente";

      // echo $msje,"estamos en el model";
      return $msje;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  function allProducto()
  {

    try {

      $this->pdo = Database::iniciarConexion();
      $array = array();

      $statement = $this->pdo->prepare("SELECT  c.Producto_id,c.Producto_name,c.Producto_sigla,c.Producto_pais
            FROM mgmcu_Productos c
            ORDER BY c.Producto_name asc  LIMIT 999 ");

      $statement->execute();

      $array = $statement->fetchAll(PDO::FETCH_OBJ);

      return $array;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  function allProductos()
  {

    try {

      $this->pdo = Database::iniciarConexion();
      $array = array();

      $statement = $this->pdo->prepare("SELECT  Id,Producto, Categoria, Precio, Stock, Imagen
            FROM productos
            ORDER BY Producto  LIMIT 999 ");

      $statement->execute();

      $array = $statement->fetchAll(PDO::FETCH_OBJ);

      return $array;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}

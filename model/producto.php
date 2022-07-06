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


  function updateProducto($Producto)
  {


    try {
      $this->pdo = Database::iniciarConexion();
      // $arrayPersonal=array();
      $statement = $this->pdo->prepare("UPDATE Producto SET 

        Producto=:p1,
        Categoria=:p2,
        Precio=:p3,
        Stock=:p4,
        Imagen=:p5

        WHERE   Id=:id");

      $statement->bindValue(":id", $Producto->getId());
      $statement->bindValue(":p1", $Producto->getProducto());
      $statement->bindValue(":p2", $Producto->getCategoria());
      $statement->bindValue(":p3", $Producto->getPrecio());
      $statement->bindValue(":p4", $Producto->getStock());
      $statement->bindValue(":p5", $Producto->getImagen());
      $resultset = $statement->execute();
      //Ejecuta en la base de datos
      $msje = "Datos actualizados correctamente";
      // echo $msje,"estamos en el model";
      return $msje;
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }


  function ProductoxId($id)
  {

    try {

      $this->pdo = Database::iniciarConexion();
      $array = array();

      $query = $id;

      $statement = $this->pdo->prepare("SELECT * FROM productos WHERE Id  LIKE :query");
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
      $statement = $this->pdo->prepare("INSERT INTO productos(Producto, Categoria, Precio, Stock, Imagen) VALUES (:p1,:p2,:p3,:p4,:p5)");
      $statement->bindValue(":p1", $Producto->getProducto());
      $statement->bindValue(":p2", $Producto->getCategoria());
      $statement->bindValue(":p3", $Producto->getPrecio());
      $statement->bindValue(":p4", $Producto->getStock());
      $nameImg=$Producto->getImagen();
      $statement->bindValue(":p5", $nameImg["name"]);


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

      $statement = $this->pdo->prepare("SELECT  Id,Producto, Categoria, Precio, Stock, Imagen
            FROM productos
            ORDER BY Producto asc  LIMIT 999 ");

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

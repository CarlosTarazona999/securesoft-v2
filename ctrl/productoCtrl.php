<?php
include_once("../model/Producto.php");

//include("checklogin.php");
date_default_timezone_set('America/Lima');


class ProductoCtrl
{

  function guardarProductoCtrl()
  {

    $formProducto = trim($_POST["ajaxProducto"]);
    $formStock = trim($_POST["ajaxStock"]);
    $formCategoria = trim($_POST["ajaxCategoria"]);
    $formImagen = ($_FILES["ajaxImagen"]);
    $formPrecio = trim($_POST["ajaxPrecio"]);

    // $formURL="http:";
    $ok = true; //Si es true, debemos registrar, si es false, debe mostrar los errores

    $resul = "";

    if (empty($formProducto)) {
      $resul .= "Ingrese el nombre del producto";
      $resul .= PHP_EOL;
      $ok = false;
    }

    if (empty($formStock)) {
      $resul .= "Ingrese la stock";
      $resul .= PHP_EOL;
      $ok = false;
    }

    if (empty($formCategoria)) {
      $resul .= "Ingrese la categoria";
      $resul .= PHP_EOL;
      $ok = false;
    }
    if (empty($formImagen)) {
      $resul .= "Ingrese la imagen";
      $resul .= PHP_EOL;
      $ok = false;
    }
    if (!isset($_FILES["ajaxImagen"])) {
      $resul .= "Ingrese la imagen";
      $resul .= PHP_EOL;
      $ok = false;
    } else {
      $arrayImagen = $_FILES["ajaxImagen"];

      $nameImage = $arrayImagen["name"]; // [name] => MyFile.txt
    }

    if (empty($formPrecio)) {
      $resul .= "Ingrese el precio";
      $resul .= PHP_EOL;
      $ok = false;
    }


    if ($ok == true) {

      // $formCreadoBy = 477;
      // $formDateCreado = date("Y-m-d H:i:s");
      // $formDateUpdate = null;
      // $formUpdateBy = null;
      //$resul="hola";
      move_uploaded_file($_FILES['ajaxImagen']['tmp_name'], '../images/' . $nameImage);

      $Obj = new Producto();

      $Obj->setProducto($formProducto);
      $Obj->setStock($formStock);
      $Obj->setCategoria($formCategoria);
      $Obj->setImagen($formImagen);
      $Obj->setPrecio($formPrecio);
      // $Obj->setDateCreado($formDateCreado);
      // $Obj->setDateUpdate($formDateUpdate);
      // $Obj->setCreadoBy($formCreadoBy);
      // $Obj->setUpdateBy($formUpdateBy);
      //$resul="holaAAA";
      $resul = $Obj->guardarProducto($Obj);
    }

    return $resul;
  }


  // function allProducto()
  // {

  //   $obj = new Producto();
  //   $Productos = $obj->allProducto();
  //   return $Productos;
  // }
  function ProductoxId($id)
  {
    $obj = new Producto();
    $Productos = $obj->ProductoxId($id);
    return $Productos;
  }

  function allProductos()
  {

    $obj = new Producto();
    $Productos = $obj->allProductos();
    return $Productos;
  }

  function traerCategoriadeBD(){

    $categoriaObj=new Producto;
    $array=$categoriaObj->mostrarCategoriadeBD();
     return $array;
 
 }

  function mostrarProducto()
  { //bd de zabbix

    $obj = new Producto();
    $array_Productos = $obj->allProductos();
    // var_dump($array_Productos);

    $resultado = '';
    $resultado .= '<table style="width:100%"  border="2" class="table table-bordered table-hover">
        <tr>
        <th style="width:80px">&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</th>
        <th>Producto</th>
        <th style="width:50px">Categoria</th>
        <th style="width:150px">Precio</th>
        <th>Stock</th>
        <th>Imagen</th>
        </tr>';

    $ix = 1;
    for ($fila = 0; $fila < count($array_Productos); $fila++) {
      $resultado .= '<tr> ';
      $Producto = $array_Productos[$fila];
      $resultado .= '<td><a style="width: 45px;" class="btn btn-danger"  href="#">' . $ix++ . '</a><a class="btn btn-info" style="margin: 1px"  href="upCli.php?Id=' . $Producto->Id . '">Editar</a></td>';

      foreach ($Producto as $key => $atributo) {

        if ($key == 'Id') {

          $resultado .= "";
        } elseif ($key == 'Imagen') {
          $resultado .= "<td><img width='50' height='50'  src='../images/$Producto->Imagen'></td>";
        } else {

          $resultado .= '<td>' . $atributo . '</td>';
        }
      }
    }

    $resultado .= '</table>';

    return $resultado;
  }



  function updateProducto()
  {

    $formID = trim($_POST["ajaxId"]); //SIGLA DIA
    $formProducto = trim($_POST["ajaxProducto"]); //SIGLA DIA
    $formStock = trim($_POST["ajaxStock"]); //SIGLA APP
    $formCategoria = trim($_POST["ajaxCategoria"]); //SIGLA APP
    $formImagen = ($_FILES["ajaxImagen"]); //SIGLA APP
    $formPrecio = trim($_POST["ajaxPrecio"]);
    //  $obj=new Producto();
    //$Productos=$obj->allProducto();

    $ok = true; //Si es true, debemos registrar, si es false, debe mostrar los errores

    $resul = "";

    if (empty($formProducto)) {
      $resul .= "Ingrese el nombre del producto";
      $resul .= PHP_EOL;
      $ok = false;
    }

    if (empty($formStock)) {
      $resul .= "Ingrese la stock";
      $resul .= PHP_EOL;
      $ok = false;
    }

    if (empty($formCategoria)) {
      $resul .= "Ingrese la categoria";
      $resul .= PHP_EOL;
      $ok = false;
    }
    if (empty($formImagen)) {
      $resul .= "Ingrese la imagen";
      $resul .= PHP_EOL;
      $ok = false;
    }
    if (!isset($_FILES["ajaxImagen"])) {
      $resul .= "Ingrese la imagen";
      $resul .= PHP_EOL;
      $ok = false;
    } else {
      $arrayImagen = $_FILES["ajaxImagen"];

      $nameImage = $arrayImagen["name"]; // [name] => MyFile.txt
    }

    if (empty($formPrecio)) {
      $resul .= "Ingrese el precio";
      $resul .= PHP_EOL;
      $ok = false;
    }


    if ($ok == true) {

      // $formDateUpdate = date("Y-m-d H:i:s");
      // $formUpdateBy = 477;
      //$resul="hola";
      move_uploaded_file($_FILES['ajaxImagen']['tmp_name'], '../images/' . $nameImage);

      $Obj = new Producto();
      $Obj->setId($formID);
      $Obj->setProducto($formProducto);
      $Obj->setStock($formStock);
      $Obj->setCategoria($formCategoria);
      $Obj->setImagen($formImagen);
      $Obj->setPrecio($formPrecio);
      $resul = $Obj->updateProducto($Obj);
    }

    return $resul;
  }
}

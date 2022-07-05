<?php
include_once("../model/Producto.php");

//include("checklogin.php");
date_default_timezone_set('America/Lima');


class ProductoCtrl
{

  function guardarProductoCtrl()
  {

    $formProducto = trim($_POST["ajaxProducto"]); //SIGLA DIA
    $formStock = trim($_POST["ajaxStock"]); //SIGLA APP
    $formCategoria = trim($_POST["ajaxCategoria"]); //SIGLA APP
    $formImagen = trim($_POST["ajaxImagen"]); //SIGLA APP
    $formPrecio = trim($_POST["ajaxPrecio"]); //SIGLA APP

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

    if (empty($formSigla)) {
      $resul .= "Ingrese la sigla del Producto";
      $resul .= PHP_EOL;
      $ok = false;
    } elseif (isset($formSigla)) {

      $obj = new Producto();
      $lista_Producto = $obj->allProductoZabbix();

      for ($i = 0; $i < count($lista_Producto); $i++) {
        $fila = $lista_Producto[$i];
        foreach ($fila as $key => $value) {
          if ($key == "ProductoZb_sigla") {
            $siglas[] = $value;
          }
        }
      }
      //  $lista=[];//aca me quede{e}
      if (in_array($formSigla, $siglas)) {
        $resul .= "La sigla ya se encuentra registrada";
        $resul .= PHP_EOL;
        $ok = false;
      }
      if (strlen($formSigla) >= 3 and strlen($formSigla) <= 4) {
        $resul .= "La sigla debe tener 3 caracteres";
        $resul .= PHP_EOL;
        $ok = false;
      }
    }

    if (empty($formPais)) {
      $resul .= "Ingrese el país";
      $resul .= PHP_EOL;
      $ok = false;
    }



    if ($ok == true) {

      $formCreadoBy = 477;
      $formDateCreado = date("Y-m-d H:i:s");
      $formDateUpdate = null;
      $formUpdateBy = null;
      //$resul="hola";

      $Obj = new Producto();

      $Obj->setPais($formPais);
      $Obj->setSigla($formSigla);
      $Obj->setNombre($formProducto);
      $Obj->setIP($formIP);
      $Obj->setURL($formURL);
      $Obj->setDateCreado($formDateCreado);
      $Obj->setDateUpdate($formDateUpdate);
      $Obj->setCreadoBy($formCreadoBy);
      $Obj->setUpdateBy($formUpdateBy);
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
  // function ProductoxId($id)
  // {
  //   $obj = new Producto();
  //   $Productos = $obj->ProductoxId($id);
  //   return $Productos;
  // }

  // function allProductoZabbix()
  // {

  //   $obj = new Producto();
  //   $Productos = $obj->allProductoZabbix();
  //   return $Productos;
  // }


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
      $resultado .= '<td><a style="width: 45px;" class="btn btn-danger"  href="#">' . $ix++ . '</a><a class="btn btn-info" style="margin: 1px"  href="upCli.php?id=' . $Producto->Id . '">Editar</a></td>';

      foreach ($Producto as $key => $atributo) {

        if ($key == 'Id') {

          $resultado .= "";
        }
        elseif ($key=='Imagen') {
          $resultado .= "<td><img width='50' height='50'  src='../images/$Producto->Imagen'></td>";
        }
        else {

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
    $formIP = trim($_POST["ajaxIP"]); //SIGLA APP
    $formSigla = trim($_POST["ajaxSigla"]); //SIGLA APP
    $formPais = trim($_POST["ajaxPais"]); //SIGLA APP
    //  $obj=new Producto();
    //$Productos=$obj->allProducto();

    $formURL = "http://" . $formIP . "/zabbix/";

    $ok = true; //Si es true, debemos registrar, si es false, debe mostrar los errores

    $resul = "";

    if (empty($formProducto)) {
      $resul .= "Ingrese el nombre del Producto";
      $resul .= PHP_EOL;
      $ok = false;
    }

    if (empty($formIP)) {
      $resul .= "Ingrese la IP";
      $resul .= PHP_EOL;
      $ok = false;
    }

    if (empty($formSigla)) {
      $resul .= "Ingrese la sigla del Producto";
      $resul .= PHP_EOL;
      $ok = false;
    } elseif (isset($formSigla)) {

      if (strlen($formSigla) != 3) {
        $resul .= "La sigla debe tener 3 caracteres";
        $resul .= PHP_EOL;
        $ok = false;
      }
    }

    if (empty($formPais)) {
      $resul .= "Ingrese el país";
      $resul .= PHP_EOL;
      $ok = false;
    }



    if ($ok == true) {

      $formDateUpdate = date("Y-m-d H:i:s");
      $formUpdateBy = 477;
      //$resul="hola";

      $Obj = new Producto();
      $Obj->setId($formID);
      $Obj->setPais($formPais);
      $Obj->setSigla($formSigla);
      $Obj->setNombre($formProducto);
      $Obj->setIP($formIP);
      $Obj->setURL($formURL);
      $Obj->setDateUpdate($formDateUpdate);
      $Obj->setUpdateBy($formUpdateBy);
      $resul = $Obj->updateProducto($Obj);
    }

    return $resul;
  }
}

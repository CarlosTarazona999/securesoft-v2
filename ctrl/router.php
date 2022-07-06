<?php

include_once("plantillaCtrl.php");
include_once("equipoCtrl.php");
include_once("ProductoCtrl.php");
//include_once("vacacionesControl.php");


if (isset($_POST["ajaxBoton"])) { //si he echo chic en algunos d elos botones

  $accionBoton = trim(strip_tags($_POST["ajaxBoton"]));

  switch ($accionBoton) {

      // case "Guardar":   echo EnviarEquipoCtrl();    break;   

      // case "Buscar Producto":   echo EnviarEquipoBqdCtrl();    break;   

      //   case "Registrar":   echo EnviarPlantillaCtrl();    break;   

      //   case "Buscar":      echo EnviarPlantillaBqdCtrl();    break; 

      //   case "Actualizar":   echo EnviarPlantillaActCtrl();    break; 

      //   case "Actualizar Equipo":   echo EnviarActualizacionEquipoCtrl();    break; 

    case "Guardar Producto":
      echo guardarProducto();
      break;
    case "Actualizar Producto":
      echo updateProducto();
      break;

    default:

      break;
  }
} else {
  echo mostrarProductos();
}

function updateProducto()
{

  $Obj = new ProductoCtrl();
  $resultado = $Obj->updateProducto();

  return $resultado; //mensaje de actualizacion de model

}


function guardarProducto()
{

  $Obj = new ProductoCtrl();
  $resultado = $Obj->guardarProductoCtrl();

  return $resultado; //mensaje de actualizacion de model

}

function mostrarProductos()
{

  $Obj = new ProductoCtrl();
  $resul = $Obj->mostrarProducto();

  return $resul; //mensaje de actualizacion de model

}

//  function EnviarActualizacionEquipoCtrl(){

//    $equipoCtrlObj=new equipoCtrl(); 
//    $resultado= $equipoCtrlObj->enviarActualizacionEquipoalModel();
 
//     return $resultado;//mensaje de actualizacion de model
 
//  }

//  function EnviarEquipoBqdCtrl(){

//   $equipoCtrlObj=new equipoCtrl(); 
//   $resultado= $equipoCtrlObj->enviarBusquedaEquipoalModel();

//    return $resultado;//mensaje de actualizacion de model

// }

//  function EnviarEquipoCtrl(){

//   $equipoCtrlObj=new equipoCtrl(); 
//   $resultado= $equipoCtrlObj->enviarEquipoalModel();

//    return $resultado;//mensaje de actualizacion de model

// }




//  function EnviarPlantillaCtrl(){

//     $plantillaCtrlObj=new plantillaCtrl(); 
//     $resultado= $plantillaCtrlObj->enviarPlantillaalModel();

//      return $resultado;//mensaje de vacaciones progamadas del model
   

//    }


// function EnviarPlantillaBqdCtrl(){
//     $plantillaCtrlObj=new plantillaCtrl(); 
//     $resultado= $plantillaCtrlObj->enviarBusquedaalModel();
//     return $resultado;
// }

// function EnviarPlantillaActCtrl(){

//     $plantillaCtrlObj=new plantillaCtrl(); 
//     $resultado= $plantillaCtrlObj->enviarActualizacionalModel();

//      return $resultado;//mensaje de actualizacion de model

// }

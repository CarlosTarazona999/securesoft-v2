
<?php
include_once("../model/users.php");
include_once("../model/equipment.php");
include("checklogin.php");

date_default_timezone_set('America/Lima');

class equipoCtrl
{

  
  function bqdEquipoxGrafico($id){

    $reporteObj = new equipoModelo(); //instanciar a clase famoso que está en modelo
    $array = $reporteObj->mostrarBqdEquipoxGraficoBD($id); //Para llenar la tabla
     return  $array;

  }

 
  function EquipoxId($id){

    $reporteObj = new equipoModelo(); //instanciar a clase famoso que está en modelo
    $array = $reporteObj->mostrarEquipoxIdBD($id); //Para llenar la tabla
     return  $array;

  }

  function buscarEquipoxId($id){

    $reporteObj = new equipoModelo(); //instanciar a clase famoso que está en modelo
    $array = $reporteObj->mostrarBqdEquipoxIdBD($id); //Para llenar la tabla
     return  $array;

  }

//mostrarCategoriadeBD
function traerCategoriadeBD(){

   $categoriaObj=new equipoModelo;
   $array=$categoriaObj->mostrarCategoriadeBD();
    return $array;

}

function traerEquiposdeModel(){

  $equipoObj=new equipoModelo;
  $array=$equipoObj->mostrarEquiposdeBD();
   return $array;

}

function traerEquipodeModel(){

  $equipoObj=new equipoModelo;
  $array=$equipoObj->mostrarEquipodeBD();
   return $array;

}

function enviarEquipoalModel(){

 //  $formDni=$_POST["ajaxDni"];
 $formProducto=trim($_POST["ajaxProducto"]);//SIGLA DIA
 $formGrafico=trim($_POST["ajaxGrafico"]);//SIGLA APP
 $formEquipo=trim($_POST["ajaxEquipo"]);//SIGLA APP
 $formCategoria=trim($_POST["ajaxCategoria"]);//SIGLA APP
 

 $ok = true;//Si es true, debemos registrar, si es false, debe mostrar los errores

 $resultado="";  



if(empty($formProducto) or $formProducto=="")
{$resultado.="Ingrese el Producto";
  $resultado.=PHP_EOL;
  $ok=false;}

if($formGrafico=="" or empty($formGrafico))
{$resultado.="Ingrese el Id de gráfico";
  $resultado.=PHP_EOL;
  $ok=false;}

  if($formEquipo=="" or empty($formEquipo))
  {$resultado.="Ingrese el nombre del equipo";
    $resultado.=PHP_EOL;
    $ok=false;}

    if($formCategoria=="" or empty($formCategoria))
  {$resultado.="Ingrese la categoria del equipo";
    $resultado.=PHP_EOL;
    $ok=false;}

   // strlen($formGrafico)!=5 or
    if (!preg_match('/^[0-9]*$/',$formGrafico)) {
      $resultado.="Ingrese el ID de grafico correcto";
      $resultado.=PHP_EOL;
      $ok=false;
    }


 if($ok == true){
  

  $equipoModeloObj=new equipoModelo();
  $equipoModeloObj->setProducto($formProducto);
  $equipoModeloObj->setGrafico($formGrafico);
  $equipoModeloObj->setDetalle($formEquipo);
  $equipoModeloObj->setCategoria($formCategoria);

  $resultado= $equipoModeloObj->insertarEquipoenBD($equipoModeloObj);
  
 }

// echo $_FILES["ajaxImagen"];
 return $resultado;


}

function enviarActualizacionEquipoalModel(){

 //  $formDni=$_POST["ajaxDni"];
 $formId=trim($_POST["ajaxId"]);//SIGLA DIA
 $formProducto=trim($_POST["ajaxProducto"]);//SIGLA DIA
 $formGrafico=trim($_POST["ajaxGrafico"]);//SIGLA APP
 $formEquipo=trim($_POST["ajaxDetalle"]);//SIGLA APP
 $formCategoria=trim($_POST["ajaxCategoria"]);//SIGLA APP


 $ok = true;//Si es true, debemos registrar, si es false, debe mostrar los errores

 $resultado="";  


if($formGrafico=="" or empty($formGrafico))
{$resultado.="Ingrese el ID de gráfico";
  $resultado.=PHP_EOL;
  $ok=false;}

  if($formEquipo=="" or empty($formEquipo))
  {$resultado.="Ingrese el nombre del equipo";
    $resultado.=PHP_EOL;
    $ok=false;}

    if($formCategoria=="" or empty($formCategoria))
  {$resultado.="Ingrese la categoria del equipo";
    $resultado.=PHP_EOL;
    $ok=false;}



    if (!preg_match('/^[0-9]*$/',$formGrafico)) {
      $resultado.="Igrese el ID de grafico correcto";
      $resultado.=PHP_EOL;
      $ok=false;
    }

    

   

 if($ok == true){
  

  $equipoModeloObj=new equipoModelo();
  $equipoModeloObj->setId($formId);
  $equipoModeloObj->setProducto($formProducto);
  $equipoModeloObj->setGrafico($formGrafico);
  $equipoModeloObj->setDetalle($formEquipo);
  $equipoModeloObj->setCategoria($formCategoria);

  $resultado= $equipoModeloObj->actualizarEquipoenBD($equipoModeloObj);
  
 }

// echo $_FILES["ajaxImagen"];
 return $resultado;

}



function enviarBusquedaEquipoalModel(){

    $inicio = $_SERVER['DOCUMENT_ROOT'].'/zabbiX'; 
    $formBusqueda = $_POST['ajaxBuscar'];

    $equipoModeloObj=new equipoModelo(); 

    $arrayBusqueda = $equipoModeloObj->mostrarBqdEquipodesdeBD($formBusqueda); //Para llenar la tabla
    $archivoCSV="";
    $archivoCSV="#,CLIENTE,ID DE GRAFICO,NOMBRE DE EQUIPO,CATEGORIA,URL ZABBIX CLIENTE";
    $archivoCSV.=PHP_EOL;

    for ($fila=0; $fila <count($arrayBusqueda) ; $fila++) { 
      $plantilla=  $arrayBusqueda[$fila];
      foreach ($plantilla as $key => $atributo) {

            $archivoCSV.= utf8_decode($atributo).",";
          
      }
      $archivoCSV.=PHP_EOL;

    }

          $db = JFactory::getDbo();
		$user = JFactory::getUser();
		$user_id=$user->id;

    $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/zabbiX/files/descargarEquipo'.$user_id.'.csv', 'w') or die("Error al crear el archivo");
    fputs($fp,$archivoCSV);
    fclose($fp);
   // file_put_contents($_SERVER['DOCUMENT_ROOT']."/zabbiX/files/descargarEquipo'.$user_id.'.csv",$archivoCSV);
    $resultado = '';
    echo " Hay ".count($arrayBusqueda)." registros";echo"<br><br>";
               
    $resultado.='<a download="descargarEquipo'.$user_id.'.csv" class="btn btn-warning" href="/zabbiX/files/descargarEquipo'.$user_id.'.csv">Descargar como CSV</a>';
   
    $resultado.= '<table style="width:100%"  border="2" class="table table-bordered table-hover">
    <tr><th style="width:80px">#</th>
    <th>Producto</th>
    <th style="width:50px">Id de Gráfico</th>
    <th style="width:150px">Equipo</th>
    <th>Categria</th>
    <th>Url Zabbix Producto</th></tr>';
 

    for ($fila=0; $fila < count($arrayBusqueda) ; $fila++) { 
        $resultado.= '<tr> ';
        $equipo = $arrayBusqueda[$fila];

        foreach ($equipo as $key => $atributo) {

          if ($key=='equipo_id') {

            $resultado.= '<td> <a style="width: 45px;" class="btn btn-danger"  href="#">'.$atributo.'</a><a class="btn btn-info" style="margin: 10px"  href="editEquipo.php?id='.$atributo.'">Editar</a>';
                  
          }
               else{

                if($key=='equipo_fk_Producto'){

                 $resultado.= '<td>'.$arrayBusqueda[$fila]->ProductoZb_nombre.'</td>';
                 $resultado.= '<td>'.$arrayBusqueda[$fila]->ProductoZb_url.'</td>';
       
               }
            else {  
              
              if ($key=='equipo_fk_categoria') {

                $resultado.= '<td>'.$arrayBusqueda[$fila]->categoria_nombre.'</td>';
  
           }else {

          
              $resultado.= '<td>'.$atributo.'</td>';
         
           
           }
                   
         }
        }

        }

    }
            
    $resultado.= '</table>';

    return $resultado;


}

}
/*
$x=new equipoCtrl;
$t=$x->traerEquiposdeModel();
print_r($t);*/

?>
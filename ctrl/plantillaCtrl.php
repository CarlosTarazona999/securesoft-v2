<?php
include_once("../model/plantilla.php");
include_once("../model/users.php");
date_default_timezone_set('America/Lima');

class plantillaCtrl
{  

  function bqdPlantillaxName($value){

    $reporteObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
    $plantilla = $reporteObj->mostrarBqdPlantillaNameBD($value); //Para llenar la tabla
     return  $plantilla;

  }

  function buscarPlantillaxId($id_plantilla){

    $reporteObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
    $plantilla = $reporteObj->mostrarBqdPlantillaBD($id_plantilla); //Para llenar la tabla
     return  $plantilla;

  }

  //traerBqdSiglaxId(
  /*  function traerBqdSiglaxId($id_plantilla){

      $reporteObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
      $sigla = $reporteObj->mostrarBqdSiglaBD($id_plantilla); //Para llenar la tabla
       return  $sigla;

    }*/
  
  function traerBqdFrecuenciadeModel($fre){
        $reporteObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
        $frec = $reporteObj->mostrarBqdFrecuenciadeBD($fre); //Para llenar la tabla
         return  $frec;


  }
  
    function traerReportedeModel() {
        $reporteObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
        $arrayReporte = $reporteObj->mostrarReportedesdeBD(); //Para llenar la tabla
         return  $arrayReporte;
        }


    function BuscarProductoxId($id) {
            $ProductoObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
            $arrayProducto =  $ProductoObj->buscarProductoxId($id); //Para llenar la tabla
             return  $arrayProducto;
            }

            function traerProductodeModel() {
              $ProductoObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
              $arrayProducto =  $ProductoObj->mostrarProductodesdeBD(); //Para llenar la tabla
               return  $arrayProducto;
              }
  

    function traerPlantilladeModel() {
              $plantillaObj = new PlantillaModelo(); //instanciar a clase famoso que está en modelo
              $arrayPlantilla =  $plantillaObj->mostrarPlantilladesdeBD(); //Para llenar la tabla
               return  $arrayPlantilla;
              }

            function enviarPlantillaalModel(){

                  //  $formDni=$_POST["ajaxDni"];
                    $formProducto=trim($_POST["ajaxProducto"]);//SIGLA DIA
                    $formFrecuencia=trim($_POST["ajaxFrec"]);//SIGLA APP
                  

                    $ok = true;//Si es true, debemos registrar, si es false, debe mostrar los errores

                    $resultado="";  

                   if(empty($formProducto) or $formProducto=="")
                   {$resultado.="Ingrese el Producto";
                     $resultado.=PHP_EOL;
                     $ok=false;}

                if($formFrecuencia=="" or empty($formFrecuencia))
                   {$resultado.="Ingrese la frecuencia";
                     $resultado.=PHP_EOL;
                     $ok=false;}
 
                   if(!isset($_FILES["ajaxPlantilla"]))
                   {$resultado.="Ingrese plantilla"; 
                     $resultado.=PHP_EOL;
                     $ok=false;
                   }
                
                   else{
                      $arrayPlantilla=$_FILES["ajaxPlantilla"]; 

                      $formPlantilla= $arrayPlantilla["name"];// [name] => MyFile.txt
                 
            
                    //  if($_FILES['ajaxPlantilla']['type']!='.doc,.docx')
                      //{$resultado.= "Debe seleccionar una documento WORD";$resultado.=PHP_EOL;$ok=false;}
                   }
                   
                    //generar nombre de plantilla -.-¡
                    $z=0;
                    if (isset($formProducto) and isset($formFrecuencia) and isset($_FILES["ajaxPlantilla"])) {
                        
                        $formNombrePlantilla="PLANTILLA_".$formFrecuencia."_".$formProducto;
                        $formPlantilla=$formNombrePlantilla.".docx";
                        $formSigla=$formFrecuencia."_".$formProducto;
        
                        $plantillaObjt=new PlantillaModelo;
                        $arrayPlantilla= $plantillaObjt->mostrarPlantilladesdeBD();
                      
                        for ($i=0; $i <count($arrayPlantilla) ; $i++) { 
                        $name_plantilla=$arrayPlantilla[$i]->plantilla_nombre;
                        
                        if ($name_plantilla==$formNombrePlantilla) {
                           
                           $fecha_creacion_plant=$arrayPlantilla[$i]->plantila_fcrea;
                           $CreatedBy=$arrayPlantilla[$i]->plantilla_createdBy;
                           $z++;
                           break;
                        }
                           
                        }
                    }

                    //fecha de creación -.-¡
                     
                     if ($z!=0) {

                        $resultado.="Plantilla ya registrada,debe actualizarla"; 
                        $resultado.=PHP_EOL;
                        $ok=false;

                         //si existe en la BD
                      //  $formFechaCreacion=$fecha_creacion_plant;
                      //  $formCreatedBy= $CreatedBy;
                       // $formUpdatedBy=$CreatedBy;
                      //  $formFechaAct= date("Y-m-d H:i:s");//$user->name   de Checlogin 
 
                     }
                     elseif ($z==0) {
                    $db = JFactory::getDbo();
		    $user = JFactory::getUser();
		    $user_id=$user->id;

                        $formFechaCreacion=date("Y-m-d H:i:s");
                        $formFechaAct=date("Y-m-d H:i:s");
                        $formCreatedBy= $user_id;
                        $formUpdatedBy=$user_id;   
                     }


                    if($ok == true){
                     

                     move_uploaded_file($_FILES['ajaxPlantilla']['tmp_name'],'../plantilla/'. $formPlantilla);
                 
                     $plantillaModeloObj=new PlantillaModelo();
                     $plantillaModeloObj->setSigla($formSigla);
                     $plantillaModeloObj->setNombre($formNombrePlantilla);
                     $plantillaModeloObj->setDocumento($formPlantilla);
                     $plantillaModeloObj->setFcrea($formFechaCreacion);
                     $plantillaModeloObj->setFact($formFechaAct);
                     $plantillaModeloObj->setCreatedBy($formCreatedBy);
                     $plantillaModeloObj->setUpdatedBy($formUpdatedBy);
                   
                     $resultado= $plantillaModeloObj-> insertarPlantillaenBD($plantillaModeloObj);
                     
                    }

                   // echo $_FILES["ajaxImagen"];
                    return $resultado;
            }

  //
            function enviarBusquedaalModel(){ 
                
                $inicio = $_SERVER['DOCUMENT_ROOT'].'/zabbiX'; 
                $formBusqueda = trim($_POST['ajaxBuscar']);
        
                $plantillaModeloObj=new PlantillaModelo(); 
        
                $arrayBusqueda = $plantillaModeloObj->mostrarBusquedadesdeBD($formBusqueda); //Para llenar la tabla
                $archivoCSV="";
                $archivoCSV="#,SIGLA DE PLANTILLA,NOMBRE DE PLANTILLA,PLANTILLA DOCX,FECHA DE CREACI�N,FECHA DE ACTUALIZACI�N,CREADOR POR,ACTUALIZADO POR";
                $archivoCSV.=PHP_EOL;
        
                for ($fila=0; $fila <count($arrayBusqueda) ; $fila++) { 
                  $plantilla=  $arrayBusqueda[$fila];
                  foreach ($plantilla as $key => $atributo) {

                    if ($key=='plantilla_createdBy') {
                      $userObj=new usersModelo;
                      $arrayDataUser= $userObj->traerUserxIDdesdeBD($atributo);
                      $archivoCSV.= $arrayDataUser[0]->name.",";

                    }else {
                      if ($key=='plantilla_updatedBy') {
                        $userObj=new usersModelo;
                        $arrayDataUser= $userObj->traerUserxIDdesdeBD($atributo);
                        $archivoCSV.= $arrayDataUser[0]->name.",";
                      }
                      else {
                       $archivoCSV.= $atributo.",";
                        
                      }
                      
                    }
        
                       
                      
                  }
                  $archivoCSV.=PHP_EOL;
        
                }
                 $db = JFactory::getDbo();
		$user = JFactory::getUser();
		$user_id=$user->id;

                $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/zabbiX/files/descargarPlantilla'.$user_id.'.csv', 'w') or die("Error al crear el archivo");
               fputs($fp,$archivoCSV);
                fclose($fp);

              //  file_put_contents($_SERVER['DOCUMENT_ROOT']."/zabbiX/files/descargar.csv",$archivoCSV);
                $resultado = '';
           //  echo "Hay ".count($arrayBusqueda)." plantillas registradas.";echo"<br>";echo"<br>";
               $resultado.='<a download="descargarPlantilla'.$user_id.'.csv" class="btn btn-warning" href="/zabbiX/files/descargarPlantilla'.$user_id.'.csv">Descargar como CSV</a>';
  //
                $resultado.= '<table border="2" class="table table-bordered table-hover">
                <tr>
                <th>#</th>
                <th>Sigla de plantilla</th>
                <th>Nombre de plantilla</th>
                <th>Plantilla docx</th>
                <th>Fecha de creacion</th>
                <th>Fecha de actualizacion</th>
                <th>Creador por:</th>
                <th>Actualizador por:</th></tr>';
        
                for ($fila=0; $fila < count($arrayBusqueda) ; $fila++) { 
                    $resultado.= '<tr> ';
                    $plantilla = $arrayBusqueda[$fila];
        
                    foreach ($plantilla as $key => $atributo) {

                      if($key=='plantilla_doc'){
        
                   //  $resultado.= '<td><a  href="/zabbix/plantilla/'.$atributo.'"><img width="40px" src="/zabbix/files/1234567.jpg"></a></td>';
                    // $resultado.= '<td><a download="CV.pdf" href="Cv/'.$atributo.'"><img width="50px" src="/files/1234567.jpg"></a></td>';
                    $resultado.= '<td><a  href="/zabbiX/plantilla/'.$atributo.'"><center><img width="40px" src="/zabbiX/files/123.jpg"></a></td></center>';
                   
                    }
                        else {  
                          
                          if ($key=='plantilla_createdBy') {

                          $userObj=new usersModelo;
                          $arrayDataUser= $userObj->traerUserxIDdesdeBD($atributo);

                          
                          $resultado.= '<td>'.$arrayDataUser[0]->name.'</td>';
              
                       }else {
                        if ($key=='plantilla_updatedBy') {
                          $userObj=new usersModelo;
                       $arrayDataUser= $userObj->traerUserxIDdesdeBD($atributo);

                       $resultado.= '<td>'.$arrayDataUser[0]->name.'</td>';
                       }
                         else {
                          $resultado.= '<td>'.$atributo.'</td>';
                         }
                       
                       }
                               
                     }
        
                    }

                }
                        
                $resultado.= '</table>';
        
                return $resultado;
            }
            
            
            //enviarActualizacionalModel

            function enviarActualizacionalModel(){

             
                  $formProducto=trim($_POST["ajaxProducto"]);
                  $formFrecuencia=trim($_POST["ajaxFrec"]);
                
                 
                  $ok = true;//Si es true, debemos registrar, si es false, debe mostrar los errores

                  $resultado="";  

                 if(empty($formProducto) or $formProducto=="")
                 {$resultado.="Ingrese el Producto";
                   $resultado.=PHP_EOL;
                   $ok=false;}

              if($formFrecuencia=="" or empty($formFrecuencia))
                 {$resultado.="Ingrese la frecuencia";
                   $resultado.=PHP_EOL;
                   $ok=false;}

                 if(!isset($_FILES["ajaxPlantilla"]))
                 {$resultado.="Ingrese plantilla"; 
                   $resultado.=PHP_EOL;
                   $ok=false;
                 }
              
                 else{
                     
                    $arrayPlantilla=$_FILES["ajaxPlantilla"]; 
               
                    $formPlantilla= $arrayPlantilla["name"];// [name] => MyFile.txt

                 }
                 
                  //generar nombre de plantilla -.-¡
                  $z=0;
                  if (isset($formProducto) and isset($formFrecuencia) and isset($_FILES["ajaxPlantilla"])) {
                      
                      $formNombrePlantilla="PLANTILLA_".$formFrecuencia."_".$formProducto;
                      $formPlantilla=$formNombrePlantilla.".docx";
                      $formSigla=$formFrecuencia."_".$formProducto;

                      $plantillaObjt=new PlantillaModelo;
                      $arrayPlantilla= $plantillaObjt->mostrarPlantilladesdeBD();
                    
                      for ($i=0; $i <count($arrayPlantilla) ; $i++) { 
                      $name_plantilla=$arrayPlantilla[$i]->plantilla_nombre;
                      
                      if ($name_plantilla==$formNombrePlantilla) {
                         
                         $fecha_creacion_plant=$arrayPlantilla[$i]->plantila_fcrea;
                         $CreatedBy=$arrayPlantilla[$i]->plantilla_createdBy;
                         $z++;
                         break;
                      }
                         
                      }

                      if ($z==0) {

                        $resultado.="Registre la plantilla"; 
                        $resultado.=PHP_EOL;
                        $ok=false;
    
                       }

                   
                  }


                  //fecha de creación -.-¡
                   
                   if ($z!=0) {
                    $db = JFactory::getDbo();
		    $user = JFactory::getUser();
		    $user_id=$user->id;

                  //  $CreatedBy=$arrayPlantilla[$i]->plantilla_createdBy;
                   //actualizacion
                    $formFechaCreacion=$fecha_creacion_plant;
                     $formCreatedBy=$CreatedBy;
                     $formUpdatedBy=$user_id;
                    $formFechaAct= date("Y-m-d H:i:s");

                   }
                


                  if($ok == true){
                   
                   move_uploaded_file($_FILES['ajaxPlantilla']['tmp_name'],'../plantilla/'. $formPlantilla);
               
                   $plantillaModeloObj=new PlantillaModelo(); 
                   $plantillaModeloObj->setSigla($formSigla);
                   $plantillaModeloObj->setNombre($formNombrePlantilla);
                   $plantillaModeloObj->setDocumento($formPlantilla);
                   $plantillaModeloObj->setFcrea($formFechaCreacion);
                   $plantillaModeloObj->setFact($formFechaAct);
                   $plantillaModeloObj->setCreatedBy($formCreatedBy);
                   $plantillaModeloObj->setUpdatedBy($formUpdatedBy);
                 
                   $resultado= $plantillaModeloObj->insertarActualizacionBD($plantillaModeloObj);
                  }

                 // echo $_FILES["ajaxImagen"];
                  return $resultado;
          }


}
/*
$reportCtrl=new plantillaCtrl;
$frecu=$reportCtrl->traerBqdFrecuenciadeModel(102)[0]->reporte_sigla;
echo $frecu;*/
?>
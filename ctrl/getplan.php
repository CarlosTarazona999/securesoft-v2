<?php
  // require_once ('../model/database.php');
   // include_once("../ctrl/imgCtrl.php");
    include_once("../ctrl/plantillaCtrl.php");
    include_once("../ctrl/equipoCtrl.php");
     $option="";
      $plantilla_id=trim($_POST["plan"]);//id
    //$plantilla_id=2;
    
      $reportCtrl=new plantillaCtrl;
      $equipoCtrl=new equipoCtrl;
  
      $arrayEquipos=$equipoCtrl->traerEquiposdeModel();//FOR
      $plantilla_nombre=$reportCtrl->buscarPlantillaxId($plantilla_id)[0]->plantilla_doc;

      $r=explode("_",$plantilla_nombre);//PLANTILLA_RPS_APM.docx
      $c=explode(".",$r[2]);
    
      $cli=$c[0];//PAM
     //  echo $cli;echo "<br>";
      $cant=count($arrayEquipos);
      for ($i=0; $i <count($arrayEquipos) ; $i++) { 
       $fila=$arrayEquipos[$i];
       $t=0;
       foreach ($fila as $key => $value) {
       
         if ($key=="ProductoZb_sigla") {
          $result[$i][$t]=$value;
         }
  
         if ($key=="equipo_grafico") {
          $result[$i][$t+1]=$value;
         }
  
         if ($key=="equipo_detalle") {
          $result[$i][$t+2]=$value;
         }
  
       }
      }
  
      $result=array_unique($result, SORT_REGULAR);
      $t=0; $y=0;
      for ($i=0; $i < $cant ; $i++) { 
   
      if (!empty($result[$i][$y]) and !empty($result[$i][$y+1])) {
       
      $graphs[$t][$y]=$result[$i][$y];
      $graphs[$t][$y+1]=$result[$i][$y+1];
      $graphs[$t][$y+2]=$result[$i][$y+2];
      $t++;
        }
       }
    
       /*
  for ($i=0; $i <count($graphs) ; $i++) { 
    $variable=$graphs[$i];
    foreach ($variable as $key => $value) {
      echo $key."=>".$value;echo "<br>";
    }
  }*/
  //print_r($graphs);
  
       if($cli=="NONE"){
          $option="<option value='NONE'>No definido </option>";
      }
      else{
          for ($i=0; $i<count($graphs); $i++) { //$graphs cantidad de plantillas registradas
              if($graphs[$i][0]==$cli){
             
                  $option.="<option value=".$graphs[$i][1]."-".$graphs[$i][2].">".$graphs[$i][1]."-".$graphs[$i][2]."</option>";
              }
          }
      }
      echo $option;

      
?>
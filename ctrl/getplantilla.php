<?php
  // require_once ('../model/database.php');
    include_once("../ctrl/imgCtrl.php");
    include_once("../ctrl/plantillaCtrl.php");
    $option="";
    $Producto_id=$_POST["cli"];
    $imgCtrlObj=new imagenCtrl;
    $reportCtrl=new plantillaCtrl;

    $arrayGraphs=$imgCtrlObj->traerDatadeBD();
    $arrayProducto=$reportCtrl->BuscarProductoxId($Producto_id);
    $cli=$arrayProducto[0]->ProductoZb_sigla;
//Array ( [0] => stdClass Object ( [data_id] => 145 [data_fk_plantilla] => 2 [data_fk_imagen] => 2 [data_largo] => 585 [data_ancho] => 254 [data_fecha_creado] => 2022-03-11 14:26:13 [data_fecha_actualizado] => 2022-03-11 14:26:13 [data_CreateBy] => 477 [data_UpdateBy] => 477 ) )
   // print_r( $arrayGraphs);  echo "<br>";

   $cant=count($arrayGraphs);
    for ($i=0; $i <count($arrayGraphs) ; $i++) { 
     $fila=$arrayGraphs[$i];
     $t=0;
     foreach ($fila as $key => $value) {
     
       if ($key=="plantilla_sigla") {
        $result[$i][$t]=$value;
       }

       if ($key=="plantilla_doc") {
        $result[$i][$t+1]=$value;
       }
     }
    }

  //  print_r($result);  echo "<br>";
$result=array_unique($result, SORT_REGULAR);//quita duplicados de array

//echo count($result);
//print_r($result);echo "<br>";

//echo $result[0][1];echo "<br>";
//echo $result[5][1];echo "<br>";
$t=0; $y=0;
for ($i=0; $i < $cant ; $i++) { 
 
  if (!empty($result[$i][$y]) and !empty($result[$i][$y+1])) {
    
    $graphs[$t][$y]=$result[$i][$y];
    $graphs[$t][$y+1]=$result[$i][$y+1];
    $t++;
  }
}

//prueba
/*
for ($i=0; $i <count($graphs) ; $i++) { 
  $variable=$graphs[$i];
  foreach ($variable as $key => $value) {
    echo $key."=>".$value;echo "<br>";
  }
}*/
//print_r($graphs);
/*echo "<br>";
echo $graphs[0][0];echo "<br>";//RPS_APM
echo substr($graphs[0][0],4,3);*/

  
    if($cli=="NONE"){
        $option="<option value='NONE'>No definido </option>";
    }
    else{
     //  $r=explode("_",$graphs[$i][0]);
      // $r[1]
        for ($i=0; $i<count($graphs); $i++) { //$graphs cantidad de plantillas registradas
          $r=explode("_",$graphs[$i][0]);

            if($r[1]==$cli){
           
                $option.="<option value=".$graphs[$i][0].">".$graphs[$i][1]."</option>";
            }
        }
    }
    echo $option;

?>


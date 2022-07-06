<?php
include_once("../ctrl/ProductoCtrl.php");

$obj = new ProductoCtrl;
$listaProducto = $obj->allProductos();

//print_r($listaProducto);
//print_r($listaequipos);

if (isset($_GET["Id"])) {

  $id_Producto = $_GET["Id"];
  $obj = new ProductoCtrl;
  $Productos = $obj->ProductoxId($id_Producto);
  var_dump($Productos);
  //$lista_categorias = $imgCtrlObj->traerCategoriasdesdeModel();
}


?>

<!doctype html>
<html lang="en">

<head>
  <title>Reportes de Productos</title>
  <?php
  include_once('Extras/head.php');
  date_default_timezone_set('America/Lima');
  ?>
</head>

<body>
  <fieldset>
    <legend>Actualizar Producto</legend>
    <div class="form-group row">

      <div class="col-sm-1">
        <label class="form-label" style="font-weight: bold;" for="Id"> Id</label>
        <input class="form-control" type="text" id="Id" name="Id" value="<?php echo $Productos[0]->Id; ?>" disabled></input>
      </div>


      <div class="col-sm-3">
        <label class="form-label" style="font-weight: bold;" for="Producto"> Producto</label>
        <input class="form-control" type="text" id="Producto" name="inputProducto" value="<?php echo $Productos[0]->Producto; ?>"></input>

      </div>

      <div class="col-sm-2">
        <label class="form-label" style="font-weight: bold;" for="Stock">Stock</label>
        <input required type="number" min="1" max="1000" class="form-control" name="Stock" id="Stock" placeholder="1,2,3,.." value="<?php echo $Productos[0]->Stock; ?>"></input>

      </div>

      <div class="col-sm-2">
        <label class="form-label" style="font-weight: bold;" for="Categoria">Categoría</label>
        <input required class="form-control" name="Categoria" id="Categoria" placeholder="Lacteos" value="<?php echo $Productos[0]->Categoria; ?>"></input>

      </div>

      <div class="col-sm-2">
        <label class="form-label" style="font-weight: bold;" for="Precio">Precio</label>
        <input required type="number" min="1" class="form-control" name="Precio" id="Precio" placeholder="1" value="<?php echo $Productos[0]->Precio; ?>"></input>
      </div>
      <div class="col-sm-2">
        <label class="form-label font-weight-bold">Imagen</label>
        <input class="form-control" type="file" id="Imagen" name="Imagen" accept="image/jpg, image/png" />
      </div>

      <div class="col-sm-2">

        <input class="btn btn-danger" style="padding: 10px 15px;font-family: arial black;margin:15px 10px 5px 0px" type="button" id="btnActualizar" name="btnActualizar" value="Actualizar Producto"></input>

      </div>

    </div>
  </fieldset>

</body>

</html>


<script>
  jQuery('input[type=button][name=btnActualizar]').on('click', function() {


    var formData = new FormData();

    var id = $("#Id").val();
    var producto = $("#Producto").val();
    var stock = $("#Stock").val();
    var categoria = $("#Categoria").val();
    var imagen = $("#Imagen")[0].files[0];
    var precio = $("#Precio").val();

    formData.append("ajaxId", id);
    formData.append("ajaxProducto", producto);
    formData.append("ajaxStock", stock);
    formData.append("ajaxCategoria", categoria);
    formData.append("ajaxImagen", imagen);
    formData.append("ajaxPrecio", precio);
    formData.append("ajaxBoton", $("#btnActualizar").val());

    jQuery.ajax({
      url: '../ctrl/router.php',
      data: formData,
      contentType: false,
      processData: false,
      type: "POST",

      success: function(r) { // si todo esta correcto imprimir --todo lo de router se almacena en r


        var x = r.length;
        // alert (x);

        if (x === 35) {
          swal({
            title: "Mensaje de sistema",
            html: r,
            text: r,
            icon: "success",
            button: "OK!",
          });
        } else {
          swal({
            title: "Mensaje de sistema",
            html: r,
            text: r,
            icon: "error",
            button: "OK!",
          });
        }
        // mostrarTabla();
      }

    });

  });
</script>
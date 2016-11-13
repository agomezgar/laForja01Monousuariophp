<?php session_start(); 
if (!isset ($_SESSION['identificado'])){echo "error; me has querido engañar";echo "<meta http-equiv=\"refresh\" content=\"5;URL=index.php\">";}
?>
<script src="./js/jquery-3.1.1.min.js"></script>
<script src="./scriptComplementario.js" language="javascript"></script>
<script>
$(document).ready(function(){
    $("#nivel").change(function(){
         $("#materia").prop("disabled", false);
curso=$("#nivel").val();


           $.ajax({
      url:"cargaMaterias.php",
      type: "POST",
      data: {curso: curso},
      success: function(opciones){
        $("#materia").html(opciones);
      },
   error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });

    });


    $("#materia").change(function(){

$("#trimestre").prop("disabled", false);
profesor=$("#profesor").val();
materia=$("#materia").val();
curso=$("#nivel").val();
  $.ajax({
      url:"verProfesor.php",
      type: "POST",
      data: {profesor:profesor,materia:materia},
      success: function(opciones){
        if (opciones==0){
alert("El profesor "+profesor+" no tiene permisos para esta materia.");
$("#trimestre").prop("disabled", true);
}else{
$("#trimestre").prop("disabled", false);
}
      }
  
    });
$.ajax({
      url:"compruebaMateriaCurso.php",
      type: "POST",
      data: {materia:materia,curso:curso},
      success: function(opciones){
        if (opciones==0){
alert("No hay programación grabada para esta materia en este nivel");
$("#trimestre").prop("disabled", true);
}else{
$("#trimestre").prop("disabled", false);
}
      }
  
    });
    });
  $("#trimestre").change(function(){
//$("#instrumento").prop("disabled", false);
materia=$("#materia").val();
curso=$("#nivel").val();

trimestre=$("#trimestre").val();


//alert(materia+", "+curso+", "+trimestre);

         $.ajax({
      url:"procesaEstandares.php",
      type: "POST",
      data: {curso: curso,materia: materia, trimestre: trimestre},
      success: function(opciones){
        $("#tablaEstandares").html(opciones);
      },
   error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
  
    });
/*
    $("#instrumento").change(function(){
instrumento=$("#instrumento").val();
 $.ajax({
      url:"procesaExamen.php",
      type: "POST",
      data: {grupo: grupo,materia: materia, trimestre: trimestre,curso:curso,instrumento:instrumento},
      success: function(opciones){
        $("#tablaExamen").html(opciones);
      }
 });
    });
*/
    });
$(document).on('change', '.cambiaTrimestre', function() {

valor=$(this).val();
estandar=$(this).attr('id');
//alert("Cambia Estandar "+estandar+"al trimestre "+valor);
 $.ajax({
      url:"cambiaTrimestreEstandar.php",
      type: "POST",
      data: { estandar:estandar, materia: materia, trimestre: valor,curso: curso},
      success: function(opciones){
       alert(opciones);
      },
   error: function (xhr, ajaxOptions, thrownError) {
alert ("Error");
        alert(xhr.status);
        alert(thrownError);
      }

 });
 });
});
</script>
<?php require ('config.php'); ?>
<div id="elige">

<?php

//cargamos materias en select materia
   include('conectarse.php');
   $link=Conectarse();


$opcionesMateria="";
 $result = mysqli_query($link,"SELECT * FROM materias")or die (mysqli_error($link));
while($encuentraMaterias = mysqli_fetch_array($result)) {
$opcionesMateria.='<option value="'.$encuentraMaterias["codigo"].'">'.utf8_encode($encuentraMaterias["materia"]).'</option>';

}
?>
<input type="hidden" id="profesor" value="<?php echo $_SESSION['profesor'];?>">
<select name="nivel" id="nivel">
<option  value="" selected="selected">Seleccione nivel</option>
<option  value="1" >1ºESO</option>
<option  value="2" >2ºESO</option>
<option  value="3" >3ºESO</option>
<option  value="4" >4ºESO</option>
<option  value="5" >1ºBACH</option>
<option  value="6" >2ºBACH</option>
<option  value="7" >1ºFPB</option>
<option  value="8" >2ºFPB</option>
</select>
<select name="materia" id="materia" disabled="disabled">
<option value="">Seleccione materia</option>
<?php echo $opcionesMateria;?>
</select>
<select name="trimestre" id="trimestre" disabled="disabled">
<option value="">Seleccione trimestre</option>
<option value="1">1º</option>
<option value="2">2º</option>
<option value="3">3º</option>
</select>

</div>
<div id="tablaEstandares">

</div>

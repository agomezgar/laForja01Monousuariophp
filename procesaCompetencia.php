<?php
session_start();
   include("conectarse.php");
   $link=Conectarse();

$contenido=$_POST['contenido'];
$competencia=$_POST['competencia'];
$activado=$_POST['activado'];
$tabla="competencias".$_SESSION['materia'];
$curso=$_SESSION['curso'];
echo $tabla;
if ($activado=="0"){
echo "borrando competencia...";
mysqli_query($link,"DELETE FROM $tabla WHERE contenido=$contenido AND competencia=$competencia")or die (mysqli_query($link));
}else{
echo "grabando competencia...";
mysqli_query($link,"INSERT INTO $tabla (curso,contenido,competencia) VALUES ('$curso','$contenido','$competencia')")or die (mysqli_error($link));
}
//echo $contenido.$competencia.$activado.$tabla;

mysqli_free_result;


?>

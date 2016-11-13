
<?php require ('config.php'); ?>
</head>
<body>

<?php
session_start();
include("conectarse.php");
  $link=Conectarse();
$trimestre=$_POST['trimestre'];
$materia=$_POST['materia'];
$curso=$_POST['curso'];
$contenido=$_POST['contenido'];
$instrumento=utf8_decode($_POST['instrumento']);
$nombreTablaInstrumentos=$materia."Instrumentos".$curso;
$nombreTablaEstandares= "estandares".$materia;
$nombreOrganizacionEstandares=$materia."organizacionestandares".$curso;
echo "<h2>Relacione los estándares correspondientes al bloque de contenidos con los instrumentos</h2>";
//echo $trimestre;
//echo $nombreTablaEstandares;
$grabaInstrumento=mysqli_query($link,"INSERT INTO ".$nombreTablaInstrumentos." (contenido, instrumento, trimestre) VALUES ('$contenido','$instrumento','$trimestre')")or die (mysqli_error($link));
$buscaEstandares=mysqli_query($link,"SELECT DISTINCT idestandar FROM ".$nombreOrganizacionEstandares." WHERE trimestre=".$trimestre) or die (mysqli_error($link));
echo"<table border=\"1\">";
while ($encEst=mysqli_fetch_array($buscaEstandares)){
$idestandar=$encEst['idestandar'];
$estandar=mysqli_query($link,"SELECT * FROM ".$nombreTablaEstandares." WHERE id=".$idestandar)or die(mysqli_error($link));
while($buscaNombre=mysqli_fetch_array($estandar)){
//El estandar solo puede corresponder al contenido indicado
if (substr($idestandar,-3,1)==$contenido){
echo "<tr><td>".utf8_encode($buscaNombre['estandar'])."</td><td>";
$buscaInstrumentos=mysqli_query($link,"SELECT * FROM ".$nombreTablaInstrumentos." WHERE contenido=".$contenido)or die (mysqli_error($link));
while($encuentraInst=mysqli_fetch_array($buscaInstrumentos)){
$idInst=$encuentraInst['id'];
$instrumento=$encuentraInst['instrumento'];
$compruebaInst=mysqli_query($link,"SELECT * FROM ".$nombreOrganizacionEstandares." WHERE idestandar=".$idestandar." AND idinstrumento=".$idInst) or die (mysqli_error($link));

$buscaPrioridad=mysqli_query($link,"SELECT * FROM ".$nombreOrganizacionEstandares." WHERE idestandar=".$idestandar) or die (mysqli_error($link));
while($encuentraPrioridad=mysqli_fetch_array($buscaPrioridad)){
$prioridad=$encuentraPrioridad['prioridad'];
}
if (mysqli_num_rows($compruebaInst)>0){

$concuerda='checked=\"checked\"';}
else{
$concuerda='';}
echo"<p> <input type=\"checkbox\" ".$concuerda." id=\"".$prioridad."\" name=\"".$idInst."\" class=\"$idestandar\">".utf8_encode($instrumento)." <input type=\"hidden\" name=\"".$idInst."\" value=\"".$prioridad."\"></p>";

}
echo "</td></tr>";
}

}
//Buscamos los instrumentos para ese contenido



}
echo "</table>";
 echo "<input type=\"submit\" id=\"nuevoInstrumentoGrabado\" value=\"He terminado\">";
?>

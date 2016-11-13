<?php
session_start();
   include("conectarse.php");
   $link=Conectarse();

$curso=$_POST['curso'];
$materia=$_POST['materia'];
$trimestre=$_POST['trimestre'];
$estandar=$_POST['estandar'];


//$nombre=$_SESSION['profesor'];
$nombreTablaInstrumentos=$materia."Instrumentos".$curso;
$nombreTablaOrganizacionEstandares=$materia."organizacionestandares".$curso;
$nombreTablaEstandares="estandares".$materia;

//Buscamos el estandar y los instrumentos que lo miden a cambiar
$buscaEstandar=mysqli_query($link,"SELECT * FROM $nombreTablaOrganizacionEstandares WHERE idestandar=$estandar");
while ($encuentraEstandar=mysqli_fetch_array($buscaEstandar)){
$idInstrumento=$encuentraEstandar['idinstrumento'];
$prioridad=$encuentraEstandar['prioridad'];
$idOrganizacion=$encuentraEstandar['id'];
$buscaNombreInst=mysqli_query($link,"SELECT * FROM $nombreTablaInstrumentos WHERE id=$idInstrumento");
while($dame=mysqli_fetch_array($buscaNombreInst)){
$textInst=$dame['instrumento'];


//echo $textInst;
//Compruebo que no exista una copia previa del instrumento al nuevo trimestre
$hayCopia=mysqli_query($link,"SELECT * FROM $nombreTablaInstrumentos WHERE instrumento='".$textInst."' AND trimestre=$trimestre");

if (mysqli_num_rows($hayCopia)<1){
//No hay copia del instrumento al nuevo trimestre, así que realizamos la copia
$nombreInstrumento=mysqli_query($link,"SELECT * FROM $nombreTablaInstrumentos WHERE id=$idInstrumento");
while($encNombInst=mysqli_fetch_array($nombreInstrumento)){
$textoInstrumento=$encNombInst['instrumento'];
$contenido=$encNombInst['contenido'];
//Insertamos copia del instrumento en la tabla de instrumentos
$sql = "INSERT INTO $nombreTablaInstrumentos (contenido, instrumento, trimestre)
VALUES ('$contenido', '".$textoInstrumento."', '$trimestre')";
if(mysqli_query($link,$sql)){
echo "Se ha hecho copia del instrumento ".utf8_encode($textoInstrumento)." al trimestre ".$trimestre."\n";
//Reasigno trimestre al estandar con la última id de instrumentos (la que acabamos de crear)
$ultimoInstrumento=mysqli_query($link,"select * from $nombreTablaInstrumentos order by id desc limit 1");
while ($encontrado=mysqli_fetch_array($ultimoInstrumento)){
$idCopiaInstrumento=$encontrado['id'];

$sql = "UPDATE $nombreTablaOrganizacionEstandares SET trimestre=$trimestre , idinstrumento=$idCopiaInstrumento WHERE id=$idOrganizacion";

mysqli_query($link,$sql)or die (mysqli_error($link));
}

}

}
}else{
//echo "El instrumento ".utf8_encode($textInst)." ya constaba para el trimestre ".$trimestre."\n";
while($nuevaIdInst=mysqli_fetch_array($hayCopia)){
//Ya había una copia del instrumento en ese trimestre
//Cambiamos la tabla de estandares asignando 
$idCopiaInstrumento2=$nuevaIdInst['id'];
$sql = "UPDATE $nombreTablaOrganizacionEstandares SET trimestre=$trimestre , idinstrumento=$idCopiaInstrumento2 WHERE id=$idOrganizacion";
mysqli_query($link,$sql);

}
}
}

}
echo "Estandar cambiado a trimestre ".$trimestre;
?>

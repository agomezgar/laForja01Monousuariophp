<?php 
if (!file_exists("config.php")){
header ("Location: ./admin/");
}?>
<?php
/*
 *    
 *      Copyright 2016 Antonio Gomez Garcia <agomeztron@yahoo.es>
 *      
 * Este programa es software libre; lo puedes redistribuir y/o modificar
 * bajo los terminos de la licencia publica GNU, publicada por la Free 
 * Software Foundation; ya sea la version 2 de la licencia, o cualquier 
 * version posterior.
 * 
 * Este programa se esta distribuyendo con la esperanza de que sea util 
 * a la comunidad, pero SIN NINGUNA GARANTIA, ˇRECLAMACIONES, AL MAESTRO 
 * ARMERO!, que decian en la mili. Si te quedas con la duda, examina los
 * terminos de la licencia GNU
 * 
 * Deberias haber recibido una copia de la Licencia Publica General GNU 
 * junto con esta aplicacion. Si no es asi, y te da pereza tirar de In-
 * ternet, escribe a: Free Software Foundation, Inc., 51 Franklin Street
 * , Fifth Floor, Boston, MA 02110-1301,USA.
 * 
 */
?>

<html>
<head>
<meta charset="UTF-8">
<title>Proyecto laForja</title>
</head>

<body>
<?php
session_start(); // start session.
	$_SESSION["perfil"] = "jefe"; 

        $_SESSION["identificado"] = "SI";
	$_SESSION["profesor"] = "root"; 
	echo "<meta http-equiv=\"refresh\" content=\"1;URL=seleccionar.php\">";
?>

</body>
</html>

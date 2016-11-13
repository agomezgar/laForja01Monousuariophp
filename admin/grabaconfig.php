<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php

$abro_fichero = fopen('../config.php','w');
$servidor='localhost';
$base='laForja';
$usuario='root';
$contra='';

	$salto = "\n";
		
	$linea_1 = '<?php'; 
	fputs($abro_fichero,$linea_1); 
	fputs($abro_fichero,$salto);

	$linea_2 = '$servidor = \''.$servidor.'\';'; 
	fputs($abro_fichero,$linea_2); 
	fputs($abro_fichero,$salto);
		$linea_3 = '$base = \''.$base.'\';'; 
	fputs($abro_fichero,$linea_3); 
	fputs($abro_fichero,$salto);
		$linea_4 = '$usuario = \''.$usuario.'\';'; 
	fputs($abro_fichero,$linea_4); 
	fputs($abro_fichero,$salto);
		$linea_5 = '$contra = \''.$contra.'\';'; 
	fputs($abro_fichero,$linea_5); 
	fputs($abro_fichero,$salto);
			
	$linea_8 = '?>'; 
	fputs($abro_fichero,$linea_8); 
		fputs($abro_fichero,$salto);

	fclose($abro_fichero);
	
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=creatablas.php\">";
	?>
</body>
</html>
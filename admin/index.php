<?php 
if (file_exists("../config.php")){
header ("Location: elige.php");
}?>

<!DOCTYPE html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Administración </title>
</head>

<body>
 <?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS laforja;";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada correctamente";
} else {
    echo "Error en la creación de la base de datos: " . $conn->error;
}

$conn->close();
?> 
<?php
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=grabaconfig.php\">";
	?>
</body>
</html>

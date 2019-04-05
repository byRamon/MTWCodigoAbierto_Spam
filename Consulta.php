<?php	
	if(sizeof($_POST) > 0 && isset($_POST["txtNumeroTelefonico"]))
	{
		$mensaje = "";
		$expReg = "/^[0-9]{10}$/"; 
		//leer de teclado
		$numeroTelefono = $_POST["txtNumeroTelefonico"];		
		if(!preg_match($expReg, $numeroTelefono))
			$mensaje = "No de telefono no valido";
		else {
			require_once $_SERVER['DOCUMENT_ROOT']."/Clases/MiConexion.php";
			$db = new Miconexion();	
			$query = "SELECT * FROM `tbldirectorio` WHERE TELEFONO = '". $numeroTelefono . "'";
			$result = $db->Consulta($query);
			$count = $db->registrosAfectados;
			if($count > 0)
			{
				$telefono = $db->ObtenerFilas();
				header('location:Registro.php?encontrado=' . $telefono['Entidad']);
				exit;
			}
			header('location:Registro.php?txtNumeroTelefonico=' . (string)$numeroTelefono);
			exit;
		}
	}
	else
	{
		$mensaje = "Por favor ingresa el número de telefono";
	}
?>
<html lang="es-Mx">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Proyecto spam</title>
</head>
<body>
	<center>
		<form method="POST" action="Consulta.php">
			<span>Escriba el número telefonico:</span>
			<input type="text" id="txtNumeroTelefonico" name="txtNumeroTelefonico" size="10" placeholder="# telefonico"></input> 
			<input type="submit" id="btnButton" value="Consultar"/>
		</form>
		<span><?php echo $mensaje; ?></span>
	</center>
</body>
</html>
<?php 
if(isset($db))
{
    if(isset($result))
        $result->free();
    $db->con->close();
}
?>
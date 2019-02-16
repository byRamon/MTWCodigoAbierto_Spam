<?php		
	if(sizeof($_POST) > 0 && isset($_POST["txtNumeroTelefonico"]))
	{
		$mensaje = "";
		$file = str_replace("Consulta.php", "flNumerosTelefono.txt", __FILE__);
		$expReg = "/^[0-9]{10}$/"; 
		//leer de teclado
		$numeroTelefono = $_POST["txtNumeroTelefonico"];
		
		if(!preg_match($expReg, $numeroTelefono))
			$mensaje = "No de telefono no valido";
		else {
			header('location:registro.php?encontrado=false&txtNumeroTelefonico=' . (string)$numeroTelefono);
			//se carga el archivo en un arreglo		
			$lstTelefonos = file($file);
			foreach ($lstTelefonos as $telefono)
			{
				//limpiamos la cadena de caracteres extraños
				if($numeroTelefono == trim($telefono))
				{
					header('location:registro.php?encontrado=true');
					exit;
				}
			}
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
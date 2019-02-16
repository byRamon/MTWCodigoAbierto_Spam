<?php
    $sistema = false;
    $display = "block";
    $noTelefonico = "";
    $mensaje = "";
    $enable = "";
    if(sizeof($_GET) > 0)
    {
        if(isset($_GET["encontrado"]))
            $encontrado = $_GET["encontrado"];
        if(isset($_GET["txtNumeroTelefonico"]))
            $noTelefonico = $_GET["txtNumeroTelefonico"];
        if(isset($encontrado))
        {
            $enable = "readonly";
            if($encontrado == "true")
            {
                $mensaje = "el número ya existe";
                $display = "none";
            }
            else 
            {
                $mensaje = "el número no existe deseas registrarlo?";
            }
        }
        else
        {
        }
        $sistema = true;
    }
    if(sizeof($_POST) > 0 && isset($_POST["txtNumeroTelefonico"]))
    {
        $enable = "readonly";
        if(isset($_POST["txtNumeroTelefonico"]))
            $postNoTelefonico = $_POST["txtNumeroTelefonico"];
        $sistema = true;
        $display = "none";
    }
    if(!$sistema)
    {
        //si no viene de consulta o de registro lo mandamos a consulta
        //echo "real" . $sistema;
        header('location:consulta.php');
        exit;
    }
	if(isset($postNoTelefonico))
	{
        $numeroTelefono;
        $file = str_replace("Registro.php", "flNumerosTelefono.txt", __FILE__);
		$expReg = "/^[0-9]{10}$/"; 
		//validacion de numero telefonico
        if(!preg_match($expReg, $postNoTelefonico))
        {
            $mensaje = "validar numero";
        }
        else {
            $myfile = fopen($file, "a") or die("Unable to open file!");
            fwrite($myfile, "".$postNoTelefonico."\n");
            fclose($myfile);
            $mensaje = "número valido y almacenado :) ";
		}
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
        <span><?php echo $mensaje; ?></span>
        <br/>
        <div style="display:<?php echo $display; ?>">
            <form method="POST" action="Registro.php">
                <span>Escriba el número telefonico:</span>
                <input type="text" id="txtNumeroTelefonico" name="txtNumeroTelefonico" size="10" placeholder="# telefonico" 
                    value="<?php echo $noTelefonico; ?>" <?php echo $enable; ?>></input> 
                <input type="submit" id="btnButton" value="Registrar"/>
            </form>
        </div>
    </center>
</body>
</html>
<?php
    $id ="";
    $sistema = false;
    $display = "block";
    $noTelefonico = "";
    $mensaje = "";
    $enable = "";
    $encontrado = "";
    $accion = "Registrar";
    if(sizeof($_GET) > 0)
    {
        $Entidad = "";
        if(isset($_GET["encontrado"]))
            $encontrado = $_GET["encontrado"];
        if(isset($_GET["txtNumeroTelefonico"]))
        {
            $noTelefonico = $_GET["txtNumeroTelefonico"];
            $enable = "readonly";
        }
        if(isset($_GET["id"]))
        {
            $id = $_GET["id"];            
            require_once "Clases/Miconexion.php";
            $db = new Miconexion();
            $query = "SELECT * FROM `tbldirectorio` WHERE `ID_Directorio`= ".$id;
            
            if (!$result = $db->Consulta($query)) {
                echo "Lo sentimos, este sitio web está experimentando problemas.";
                exit;
            }
            else{
                $count = mysqli_num_rows($result);
                $telefono = $result->fetch_assoc();
                $Entidad = $telefono['Entidad'];
                $noTelefonico = $telefono['Telefono'];
            }
            $accion = "Actualizar";
        }
        if(isset($encontrado))
        {
            if($encontrado != "")
            {
                $mensaje = "el número ya existe es de ".$encontrado;
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
        if(isset($_POST["txtNumeroTelefonico"]))
            $postNoTelefonico = $_POST["txtNumeroTelefonico"];
        $sistema = true;
        $display = "none";
    }
    if(!$sistema)
    {
        //si no viene de consulta o de registro lo mandamos a consulta
        header('location:consulta.php');
        exit;
    }
	if(isset($postNoTelefonico))
	{
        $numeroTelefono;
		$expReg = "/^[0-9]{10}$/"; 
		//validacion de numero telefonico
        if(!preg_match($expReg, $postNoTelefonico))
        {
            $mensaje = "validar numero";
        }
        else {
            $Entidad = "";
            require_once "Clases/Miconexion.php";
            $db = new Miconexion();
            if(isset($_POST["id"]))
            {
                $id = $_POST["id"];
                $Entidad = $_POST["txtEntidad"];   
                $Entidad = filter_var($Entidad,FILTER_SANITIZE_SPECIAL_CHARS);
                if(strlen($id) < 1)
                {            
                    $query = "INSERT INTO `tbldirectorio`(`ID_Directorio`, `Entidad`, `Telefono`) VALUES ('','". $Entidad ."','". $postNoTelefonico ."') ";
                }
                else
                {    
                    $query = "UPDATE `tbldirectorio` SET `Entidad`='". $Entidad ."',`Telefono`='". $postNoTelefonico ."' WHERE `ID_Directorio`= ".$id;
                }
                $count = $db->registrosAfectados;
                if (!$result = $db->Consulta($query)) {
                    echo "Lo sentimos, este sitio web está experimentando problemas.";
                    exit;
                }
                if(strlen($id) > 0)
                {
                    header('location:Admon.php');
                    exit;
                }
                $mensaje = "número valido y almacenado :) ";
            }
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
                <span>Entidad:</span>
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
                <input type="text" id="txtEntidad" name="txtEntidad" size="10" placeholder="Quien es?" value="<?php echo $Entidad; ?>"></input> 
                <span>No. Telefono:</span>
                <input type="text" id="txtNumeroTelefonico" name="txtNumeroTelefonico" size="10" placeholder="# telefonico" 
                    value="<?php echo $noTelefonico; ?>" <?php echo $enable; ?>></input> 
                <input type="submit" id="btnButton" value="<?php echo $accion; ?>"/>
            </form>
        </div>
    </center>
</body>
</html>
<?php 
if(isset($db))
{
    $db->con->close();
}
?>
<?php
    $mensaje = '';
    if(sizeof($_POST) > 0 && isset($_POST["txtUsuario"]))
    {
        if(isset($_POST["txtUsuario"]))
            $txtUsuario = $_POST["txtUsuario"];
        if(isset($_POST["txtPassword"]))
            $txtPassword = $_POST["txtPassword"];
        if( $txtUsuario == 'admin' && $txtPassword == 'admin'){
            header('location:Admon.php');
            exit;
        }
        else 
        {
            $mensaje = 'usuario y password incorrecto';
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
        <div>
            <form method="POST" action="Acceso.php">
                <span>Usuario:</span>
                <input type="text" id="txtUsuario" name="txtUsuario" size="10" placeholder="Usuario"></input>                 
                <span>Password:</span>
                <input type="password" id="txtPassword" name="txtPassword" size="10" placeholder="Password"></input> 
                <input type="submit" id="btnButton" value="Entrar"/>
            </form>
        </div>
        <br/>
        <span><?php echo $mensaje; ?></span>
    </center>
</body>
</html>
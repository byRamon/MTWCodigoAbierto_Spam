<?php 
	$file = str_replace("Admon.php", "flNumerosTelefono.txt", __FILE__);
	$lstTelefonos = file($file);
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
        <h1>Admon</h1>
        <br/>
        <table border="1">
            <tr>
                <th>No. telefonico</th>
                <th>Quien llama</th>
                <th>Editar</th>
            </tr>
            <?php 
                foreach ($lstTelefonos as $telefono)
                {
                    ?>
                    <tr>
                        <td><?php echo $telefono; ?></td>
                        <td></td>
                        <td><input type="submit" value="Editar" onclick="window.location.assign('./Registro.php?txtNumeroTelefonico=<?php echo trim($telefono); ?>');"/></td>
                    </tr>
                    <?php 
                }
            ?>
        </table>
        </div>
    </center>
</body>
</html>
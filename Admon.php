<?php 
	$file = str_replace("Admon.php", "flNumerosTelefono.txt", __FILE__);
    $lstTelefonos = file($file);
    if(sizeof($_GET) > 0)
    {
        if(isset($_GET["Delete"]))
        {
            $ind = $_GET["Delete"];
            $lstTelefonos[$ind] = "";
            $texto = "";
            foreach ($lstTelefonos as $telefono)
            {
                //echo ($telefono);
                if(trim($telefono) != "")
                {
                    $registro = explode("|", trim($telefono));
                    $texto = $texto."".$registro[0]."|".$registro[1] . "\n";
                }
            }
            $fp = fopen($file, "w");
            fwrite($fp, $texto);
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
        <h1>Admon</h1>
        <br/>
        <table border="1">
            <tr>
                <th>No. telefonico</th>
                <th>Quien llama</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
            <?php 
                $Ind = 0;
                foreach ($lstTelefonos as $telefono)
                {
                    if($telefono != "")
                    {
                        $registro = explode("|", $telefono);
                        ?>
                        <tr>
                            <td><?php echo $registro[0]; ?></td>
                            <td><?php echo $registro[1]; ?></td>
                            <td><input type="submit" value="Editar" onclick="window.location.assign('./Registro.php?txtNumeroTelefonico=<?php echo trim($registro[0]); ?>&txtEntidad=<?php echo trim($registro[1]); ?>');"/></td>
                            <td><input type="submit" value="Delete" onclick="window.location.assign('./Admon.php?Delete=<?php echo $Ind; ?>');"/></td>
                        </tr>
                        <?php 
                        $Ind = $Ind + 1;
                    }
                }
            ?>
        </table>
        </div>
    </center>
</body>
</html>
<?php 
    require_once "Clases/Miconexion.php";
    $db = new Miconexion();
    if(sizeof($_GET) > 0)
    {   
        if(isset($_GET["Delete"]))
        {            
            $ind = $_GET["Delete"];
            $query = "DELETE FROM `tbldirectorio` WHERE ID_Directorio = ". $ind;
            if (!$result = $db->Consulta($query)) {
                echo "Lo sentimos, este sitio web está experimentando problemas.";
                exit;
            }
        }
    }
    $query = "SELECT * FROM `tbldirectorio`";
    $result = $db->Consulta($query);
    $count = mysqli_num_rows($result);
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
                <th>Entidad</th>
                <th>No. telefonico</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
            <?php                 
                if ($count > 0) {
                    while($fila = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $fila["Entidad"]; ?></td>
                            <td><?php echo $fila["Telefono"]; ?></td>
                            <td><input type="submit" value="Editar" onclick="window.location.assign('./Registro.php?id=<?php echo $fila["ID_Directorio"]; ?>');"/></td>
                            <td><input type="submit" value="Delete" onclick="window.location.assign('./Admon.php?Delete=<?php echo $fila["ID_Directorio"]; ?>');"/></td>
                        </tr>
                        <?php 
                    }
                }
            ?>
        </table>
        <?php echo "Se han encontrado ".$count." registros" ?>        
        </div>
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
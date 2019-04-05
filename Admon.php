<?php 
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT']."/Clases/MiConexion.php";
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
            $count = $db->registrosAfectados;
        }
    }
    $query = "SELECT * FROM `tbldirectorio`";
    $result = $db->Consulta($query);
    $count = $db->registrosAfectados;
    //require_once "Html_Encabezado.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/HtmlLibrerias.php";
    HtmlEncabezado();
    if(!isset($_SESSION["EmpleadoID"])){        
        echo "<script>location.replace('Consulta.php')</script>";
        exit;
    }
?>
<body>
<div align="right">
    id Empleado: <?php echo ' '.$_SESSION["EmpleadoID"] ?><br/>
    Empleado: <?php echo ' '.$_SESSION["Nombre"] ?><br/>
	<a href="./index.php">Logout</a>
</div>
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
                    while($fila = $db->ObtenerFilas()){
                        extract($fila);
                        ?>
                        <tr>
                            <td><?php echo $Entidad; ?></td>
                            <td><?php echo $Telefono; ?></td>
                            <td><input type="submit" value="Editar" onclick="window.location.assign('./Registro.php?id=<?php echo $ID_Directorio; ?>');"/></td>
                            <td><input type="submit" value="Delete" onclick="window.location.assign('./Admon.php?Delete=<?php echo $ID_Directorio; ?>');"/></td>
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
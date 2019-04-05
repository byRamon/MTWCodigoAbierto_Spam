<?php 
    session_start();
    unset($_SESSION['EmpleadoID']);
    echo "<script>location.replace('Consulta.php')</script>";
?>

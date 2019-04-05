<?php
    class MiConexion
    {
        // Atributos
        var $con = null;
        var $servername = "localhost";
        var $username = "sa";
        var $password = "P@ssw0rd";
        var $baseDatos = "id9054944_spamdb";
        var $respuestaQuery = null;
        var $registrosAfectados = null;

        public function __construct()
        {
            // Create connection
            $this->con = new mysqli($this->servername, $this->username, $this->password, $this->baseDatos);
            if ($this->con->connect_error) {
                die("Connection failed: " . $this->con->connect_errno . " -> " . $this->con->connect_error);
            }
        }
        public function Consulta($consulta)
        {
             $consulta = trim($consulta);
             //echo $consulta;
             $this->respuestaQuery = $this->con->query($consulta);
             if(strtoupper(explode(' ', $consulta)[0]) != "SELECT")
                $this->registrosAfectados = mysqli_affected_rows($this->con);
             else
                $this->registrosAfectados = mysqli_num_rows($this->respuestaQuery);
             return $this->respuestaQuery;
        }
        public function ObtenerFilas(){
             return mysqli_fetch_assoc($this->respuestaQuery);
        }
    }
?>
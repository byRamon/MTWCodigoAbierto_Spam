<?php
    class MiConexion
    {
        // Atributos
        var $con = null;
        var $servername = "localhost";
        var $username = "sa";
        var $password = "as";
        var $baseDatos = "spamDb";

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
             $resp = $this->con->query($consulta);
             return $resp;
        }
    }
?>
<?php 
    session_start(); 
    $mensaje = "";
    if(isset($_POST["captcha_code"]))
    {
        //$_SERVER['DOCUMENT_ROOT']
        include_once 'librerias/securimage/securimage.php';
        $securimage = new Securimage();
        if ($securimage->check($_POST['captcha_code']) == false) {
            $mensaje = "</br>Captcha incorrecto";
        }
        //if(false !== filter_var($_POST['userName'], FILTER_VALIDATE_EMAIL))
        //    $mensaje = "</br>Usuario y/o contraseña incorrecto, favor de verificar";
        else{
            require_once "Clases/Miconexion.php";
            $db = new Miconexion();
            //limpiar datos
            $email = $_POST['userName'];
            $password = $_POST['userPassword'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $password = filter_var($password,FILTER_SANITIZE_SPECIAL_CHARS);
                $query = "SELECT * FROM `tblempleados` 
                                WHERE `EMAIL`='".$email."' AND `Password` ='" . $password. "'";
                $result = $db->Consulta($query);
                if($db->registrosAfectados > 0){
                    extract($db->ObtenerFilas());
                    $_SESSION["EmpleadoID"] = (string)$EmpleadoID;
                    $_SESSION["Nombre"] = $Nombre;
                    header('location:Admon.php');
                    exit;
                }
                else
                {
                    $mensaje = "</br>Usuario y/o contraseña incorrecto, favor de verificar";
                }
            }
            else
            {
                $mensaje = "</br>Usuario y/o contraseña incorrecto, favor de verificar";
            }

        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>    
    <form method="POST" action="Acceso.php"> 
    <div class="container">
        <div class="row">
            <div class="col-md-offset-5 col-md-3">
                <div class="form-login">
                    <h4>Bienvenid@</h4>
                    <input type="email" id="userName" name="userName" class="form-control input-sm chat-input" placeholder="Correo" required/>
                    </br>
                    <input type="password" id="userPassword" name="userPassword" class="form-control input-sm chat-input" placeholder="Contraseña" required/>
                    </br>
                    <img id="captcha" src="./librerias/securimage/securimage_show.php" alt="CAPTCHA Image" />
                    </br>
                    <input type="text" name="captcha_code" size="10" maxlength="6" required/>
                    <a href="#" onclick="document.getElementById('captcha').src = './librerias/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
                    </br></br>
                    <div class="wrapper">
                        <span class="group-btn">   
                            <button type="submit" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
                        </span>
                    </div>                    
                    <?php echo $mensaje ?>
                </div>            
            </div>
        </div>
    </div>
</body>
</html>

<link href="./estilos/Estilo.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!--Pulling Awesome Font -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

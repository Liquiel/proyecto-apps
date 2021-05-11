<?php

    require_once 'conexion.php';

    //variables inicializadas con valor 0
    $username = $email = $password = "";
    $username_e = $email_e = $password_e = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //validando input de usuario
        
        if (empty(trim($_POST["username"]))) {
            $username_e = "Debe ingresar un usuario. ";
        }else{
            $sql = "SELEC id FROM usuarios WHERE usuario = ?";

            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = trim($_POST["username"]);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_e = "Este usuario ya está en uso.";
                    }else{
                        $username = trim($_POST["username"]);
                    }

                }else{
                    echo "Algo salió mal :c";
                }
            }
        }

          //validando input de email
        
          if (empty(trim($_POST["email"]))) {
            $email_e = "Debe ingresar un email. ";
        }else{
            $sql = "SELEC id FROM usuarios WHERE email = ?";

            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param($stmt, "S", $param_email);

                $param_email = trim($_POST["email"]);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $email_e = "Este email ya está en uso.";
                    }else{
                        $email = trim($_POST["email"]);
                    }

                }else{
                    echo "Algo salió mal :c";
                }
            }
        }

        //validando contraseña

        if (empty(trim($_POST["password"]))) {
            $password_e = "Debe ingresar una contraseña.";
        }elseif(strlen(trim($_POST["password"])) < 4){
            $password_e = "Contraseña debe tener un mínimo de 4 caracteres.";
        }else{
            $password = trim($_POST["password"]);
        }

        //comprobación errores de entrada antes de insertar datos.

        if (empty($username_e) && empty($email_e) && empty($password_e)) {
            $sql = "INSERT INTO usuarios (usuario, email, clave) VALUE (?, ?, ?)";
            
            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

                //estableciendo paràmetros

                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); //ENCRIPTANDO CONTRASEÑA


                if (mysqli_stmt_execute($stmt)) {
                    header("location: index.php");
                }else{
                    echo "Algo salió mal :c";
                }
            }
        }

        mysqli_close($conexion);


    }



?>
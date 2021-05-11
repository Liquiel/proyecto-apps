<?php 
    require_once 'conexion.php';
    //Iniciando sesión
    session_start();

    if (isset($_SESSION["Loggedin"]) && $_SESSION["Loggedin"] === true){
        header("location: index2.php");
        exit;
    }

    require_once "conexion.php";

    $email = $password = " ";
    $email_e = $password_e = " ";

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        if (empty(trim($_POST["email"]))) {
            $email_e = "Debe ingresar su correo electrónico";
        }else{
            $email = trim($_POST["email"]);
        }
        if (empty(trim($_POST["password"]))) {
            $password_e = "Debe ingresar una contraseña";
        }else{
            $password = trim($_POST["password"]);
        }






        //validando credenciales
        if (empty($email_e) && empty($password_e)){

            $sql = "SELECT usuario, email, clave FROM usuarios WHERE email =?";

            if($stmt = mysqli_prepare($conexion, $sql)){

                mysqli_stmt_bind_param($stmt, "s", $param_email);

                $param_email = $email;

                if (mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                }

                if(mysqli_stmt_num_rows($stmt) == 1){ 
                    mysqli_stmt_bind_result($stmt, $id, $usuario, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)){
                        if ($password_verify($password, $hashed_password)) {
                            session_start();

                            //almacenando datos en variables de sesiòn.
                            $_SESSION["Loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            
                            header("location: index.php");
                        }else{
                            $password_e = "La contraseña no es válida";
                        }
                    }else{
                        $email_e = "Su correo no existe, intente crear una nueva cuenta.";
                    }
                }else{
                    echo "Algo salió mal.";
                }
            }   
        }

        mysqli_close($conexion);

    }



?>
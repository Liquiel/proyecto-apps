<?php 

    include 'code-registro.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Los Farallones</title>
</head>

<body>
    <div class="container-all">
        <div class="ctn-form">
            <img src="img/logo.jpg" class="logo" >
            <h1 class="title">Registrarse</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="">Usuario</label>
                <input type="text" name="username" required>
                <span class="msg-error"><?php echo $username_e; ?></span>

                <label for="">Correo electrónico</label>
                <input type="email" name="email" required>
                <span class="msg-error"><?php echo $username_e; ?></span>

                <label for="">Contraseña</label>
                <input type="password" name="password" id="password" required>
                <span class="msg-error"><?php echo $password_e; ?></span>
                
                <input type="submit" value="Registrarme">
            </form>
            <span class="text-footer">¿Ya posees una cuenta?<a href="index.php"> Inicia Sesión ahora</a></span>
        </div>

        <div class="ctn-text">
            <div class="capa">
                <h1 class="title-description">Los Farallones - Hotel</h1>
                <p class="text-description">Hotel Los Farallones se encuentra en La Libertad, en una playa privada. La
                    belleza natural de la zona se puede apreciar en Playa El Majahual y Playa Sunzal. Explore todo lo
                    que la zona tiene para ofrecer con ecoturismo y tirolesa. Los huéspedes aprecian la ubicación del
                    hotel para hacer turismo.</p>
            </div>
        </div>
    </div>



</body>

</html>
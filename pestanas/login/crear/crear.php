<?php
include '../../php/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = connection();
    if (isset($_POST["submit"])) {
        $nombre=test_input($_POST['usuario']);
        $apellido=test_input($_POST['apellido']);
        $email=test_input($_POST['email']);
        $direc=test_input($_POST['direccion']);
        $telef=test_input($_POST['telefono']);
        insertClient($conn,$nombre,$apellido,$email,$direc,$telef);
        //CREAR SESION DE UUSARIO!!!! sin necesidad de volver a logearse ????
        $_SESSION['number']=getIdNewClient($conn,$nombre,$apellido);
        //createUserCookie(getIdNewClient($conn,$nombre,$apellido));
        createBasketCookie();
        echo "<script>window.open('../../basket/basket.php')</script>";
        $conn=closeConn($conn);
    }else{
        echo "Por favor, introduzca un calor correcto </br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="contenedor">

    <div id="contenedorcentrado">
        <div id="login">
            <form id="loginform" method='post' action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="usuario">Nombre</label>
                <input id="usuario" type="text" name="usuario" placeholder=Nombre required>

                <label for="apellido">Apellido
                    <input id="apellido" type="text" name="apellido" placeholder="Apellido" required>
                </label>
                <label for="apellido">Email
                    <input class="email" type="email" name="email" placeholder="Tu Email">
                </label>
                <label>Telefono
                    <input class="telefono" type="text"  name="telefono" placeholder="Tu Telefono">
                </label>
                <label>Direccion
                    <input class="direccion" type="text" name="direccion" placeholder="Tu Direccion">
                </label>

                <button type="submit" title="Ingresar" name="submit">Registrarse</button>
            </form>

        </div>
        <div id="derecho">
            <div class="titulo">
                Bienvenido
            </div>
            <hr>
            <div class="pie-form">
                <a href="../registrar/registrar.php">¿Ya tienes cuenta? Incia Sesion</a>
                <hr>
                <a href="../login.php">« Volver</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>




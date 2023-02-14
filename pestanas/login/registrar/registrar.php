<?php
include '../../php/functions.php';
var_dump($_COOKIE);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = connection();
    if (isset($_POST["submit"])) {
        $user = test_input($_POST['usuario']);
        $password = test_input($_POST['password']);
        echo $user;
        echo $password;
        $result = getNumberUserIfExists($conn, $user, $password);
        echo $result;
        if ($result == 0) {

            echo "No existe registro de este usuario";
        } else {
            createUserCookie($user);
            //aqui creamos cookie de carrito de compra
            //la creo nada mas iniciar sesion
            if (!basketCookieExists()) {
                createBasketCookie();
            }
            //llevar al menu del cliente
            echo "<script>window.open('../../streetwear/streetwear.html')</script>";
            //echo $link;
        }
        $conn = closeConn($conn);
    } else {
        echo "Por favor, introduzca sus credenciales </br>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div id="contenedor">

    <div id="contenedorcentrado">
        <div id="login">
            <form id="loginform"  method='post' action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="usuario">Usuario</label>
                <input id="usuario" type="text" name="usuario" placeholder="Usuario" required>

                <label for="password">Contraseña</label>
                <input id="password" type="password" placeholder="Contraseña" name="password" required>

                <button type="submit" title="Ingresar" name="submit">Login</button>
            </form>

        </div>
        <div id="derecho">
            <div class="titulo">
                Bienvenido
            </div>
            <hr>
            <div class="pie-form">
                <a href="#">¿Perdiste tu contraseña?</a>
                <a href="#">¿No tienes Cuenta? Registrate</a>
                <hr>
                <a href="../login.php">« Volver</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>


<?php
include '../php/functions.php';
if(!isUserLogged() || !basketCookieExists()){
    echo "<script>location.href='../login/login.php'</script>";
    echo "hola";
}
var_dump($_SESSION['number']);
var_dump($_COOKIE['basket']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrontEnd Store</title>
    <!--    <link rel="stylesheet" href="css/normalize.css">-->
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Archivos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title></title>
</head>

<body>
<header class="header">
    <a href="../../index.html">
        <img class="header__logo" src="img/logo.png" alt="Logotipo">
    </a>
</header>
<nav class="navegacion">
    <a class="navegacion__enlace" href="../../index.html">Home</a>
    <a class="navegacion__enlace" href="../streetwear/streetwear.html">Streetwear</a>
    <a class="navegacion__enlace" href="../servicios/servicios.html">Servicios</a>
    <a class="navegacion__enlace" href="../deporte/deporte.html">Ropa Deportiva</a>
    <a class="navegacion__enlace" href="../nosotros/nosotros.html">Nosotros</a>
    <a href="../login/login.php" id="icon-login" class="log navegacion__enlace"><i
                class="bi bi-person-fill"></i></a>
    <a href="basket.php" id="icon-basket" class="log navegacion__enlace navegacion__enlace--activo"><i class="bi bi-cart-fill"></i></a>
</nav>

<main class="contenedor">
    <div class="grid">
        <div class="producto">
            <img src="img/clothes.jpg" alt="clothes">
        </div>

        <div class="producto">
            <p>Cesta de la Compra</p>
            <p><i class="bi bi-cart-fill"></i></p>
        </div>
        <br>
        <div class="producto" id="parrafo1">
            <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
            </p>
        </div>
    </div>
</main>
<footer class="footer">
    <ul class="social-icons">
        <li>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
        </li>
    </ul>

    <p class="footer__texto">Front End Store - Todos los derechos Reservados 2022.</p>
</footer>
</body>

</html>


//programacion para desplegar formulario registrar de sesion o regstro
$(window).on("load", inicio);

function inicio() {
    $("#registrar-sesion").on("click",login_usuario)
}
function login_usuario() {
    console.log("hola");
    $("#login-registrar").show();
}



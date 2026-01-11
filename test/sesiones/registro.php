<?php
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /sesiones/registro.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------
require_once '../recursos/funciones.php';

/*
   - ./registro.php
        Permite registrarse en la bbdd.
        Pide como minimo usuario y contraseña.
        Al registrarse, redirige a /sesiones/inicio.php.
        
    Contiene un boton para confirmar el registro y otro para cancelar, nos lleva al index sin iniciar sesion
    Tiene 2 campos para usuario y contraseña, otro grande para añadir una descripcion
    Tambien puedes añadir una foto de perfil pero no es requerido

*/


#UPDATE usuarios SET password = diferente where id = idbuscado



#CONEXION SQL
#-----------------------------------------------------------------

#-----------------------------------------------------------------

#Inicia todo
function iniciar(){
    global $control_errores;
echo $control_errores==1 ? "DEBUG funciones_php_pre_html": "";
funciones_php_pre_html();

echo $control_errores==1 ? "DEBUG cabecera_html": "";
cabecera_html();

echo $control_errores==1 ? "DEBUG cuerpo_html": "";
cuerpo_html();
}

function funciones_php_pre_html(){
    global $control_errores;

}

#Control de sesion
#---------------------------------------------------------------------------------

function sesion_iniciada(){
    $_SESSION['sesion_iniciada'] = 1;
}

function sesion_no_iniciada(){
    $_SESSION['sesion_iniciada'] = 0;
}

function sesiones(){
session_start();
if (isset($_SESSION['sesion_iniciada'])) {
    sesion_iniciada();
}
else{
    sesion_no_iniciada();
}

}
#---------------------------------------------------------------------------------

#Control de cookies
#---------------------------------------------------------------------------------

function sets_de_cookies(){

setcookie(name: 'usuario', value: $_POST['usuario']);
setcookie(name: 'contraseña', value: $_POST['contraseña']);
header('Location: http://localhost/RUTA_ACTUAL/');
}
#---------------------------------------------------------------------------------


#Llamada de funciones de php, establece orden en el que se ejecutan las funciones
function funciones_php(){
    global $control_errores;    
    if($control_errores==1){
    echo("FUNCIONES PHP");
    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
    echo $control_errores==1 ? "<br>": "";
    }

    formulario_registro();
    #recoge_form_registro();

    if($control_errores==1){
    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
}
}

function formulario_registro(){
    ?>
    <div>Registro de usuario</div>
    <form action="../recursos/carga.php" method="post" enctype="multipart/form-data">
        <label for="nombre">(Requerido) Nombre: </label>
        <input type="text" name="nombre" required><br>
        <label for="contrasena">(Requerido) Contraseña: </label>
        <input type="password" name="contrasena" required><br>
        <label for="descripcion">(Opcional) Descripcion: </label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>
        <label for="foto">(Opcional) Foto de perfil: </label>
        <input type="file" name="foto"><br>       
        <input type="submit" name="btn_enviar_registro" value="Enviar"> 
    </form> 
    <form action="../index.php" method="post">
        <input type="submit" name="btn_cancelar" value="Cancelar"> 
    </form> 
    <?php
}



#Funciones de html
#---------------------------------------------------------------------------------


#Cabecera html generica
function cabecera_html(){
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/registro.css">
        <title>Registro de usuario</title>
    </head>
    <body>
    <?php
}

#Cuerpo html generico
function cuerpo_html(){
    global $control_errores
    ?> 
    <body> 
    <?php
    funciones_php()
    ?>
    <br><br>
   <?php echo $control_errores==1 ? "FIN DOCUMENTO": ""; ?>

    </body>
    </html>
    <?php
}
#---------------------------------------------------------------------------------








































iniciar();
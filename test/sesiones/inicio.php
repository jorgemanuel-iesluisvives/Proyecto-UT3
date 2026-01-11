<?php
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /sesiones/inicio.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------

/*
    - ./inicio.php
        Permite iniciar sesion al usuario, compara los datos introducidos con los de la bbdd.
        Si los datos son correctos, se inicia una sesion y redirige a /principal/feed.php

    Tendra 2 botones, uno lleva a la pagina de registro, el otro inicia sesion y te lleva a feed
    Tiene 2 campos para meter usuario y contraseña
*/

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


#Llamada de funciones de php
function funciones_php(){
    global $control_errores;
    if($control_errores==1){
    echo("FUNCIONES PHP");
    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
    echo ("<br>"); 
    }
    formulario_inicio_sesion();
   
    if($control_errores==1){
    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
    }
}

#Funciones php
#---------------------------------------------------------------------------------
function formulario_inicio_sesion(){
?>
<form action="../recursos/carga.php" method="post">
    <label for="nombre">Nombre:     </label>
    <input type="text" name="nombre" required><br>
    <label for="contrasena">Contraseña: </label>
    <input type="password" name="contrasena" required><br><br>
    <input type="submit" name="btn_enviar_inicio_sesion" value="Iniciar sesion" formaction="../recursos/carga.php"> 
</form> 
<form action="registro.php" method="post">
<div>Necesitas una cuenta para entrar.</div>
<input type="submit" name="btn_registrarse" value="Registarse" formaction="registro.php"> 
</form> 

<?php
}
#---------------------------------------------------------------------------------


#Funciones de html
#---------------------------------------------------------------------------------

#Cabecera html 
function cabecera_html(){
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inicio.css">
    <title>Inicio de sesion</title>
    
</head>

<?php
}

#Cuerpo html generico
function cuerpo_html(){
?> 
<body> 
<h1>Inicio de sesion</h1>
<?php
funciones_php()
?>
<br><br>
</body>
</html>
<?php
}
#---------------------------------------------------------------------------------



















iniciar();
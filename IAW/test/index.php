<?php
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " index.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------
require_once './recursos/funciones.php';



cabecera_html();
cuerpo_html();


#Cabecera html
function cabecera_html(){
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenida</title>
        <link rel="stylesheet" href="./css/base.css">

    </head>
    <body>
    <?php
}

#Cuerpo html generico
function cuerpo_html(){
    ?> 
    <body> 
    <?php
    
   # funciones_php()
    ?>
    <div>¡Hola! Inicia sesion para entrar en el foro: <div>
    <br><br>
    </body>
    </html>
    <?php
}


function formulario_generico(){
    ?>
     <form action="/test/sesiones/inicio.php" method="post">
        <input type="submit" name="btn1" value="Iniciar sesion"> 
    </form> 
    <?php
}
formulario_generico();
muestra_imagen("./recursos/imagenes/gameboy.jpg");
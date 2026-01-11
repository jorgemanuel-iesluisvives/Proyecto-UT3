<?php
session_start();
require_once '../recursos/funciones.php';
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /principal/perfil.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------



/*
    - ./perfil.php
        Permite al usuario ver sus datos y modificarlos; se recoge de la bbdd
        
    Muestra los datos del usuario, se puede modificar y enviar los nuevos datos con un boton 
    Un boton permite desconectarse de la sesion
    otro boton/enlace nos lleva a feed
        
*/

#DATOS DE USUARIO
#-------------------------------------------------

$id_usuario= $_SESSION['id_usuario'];
$nombre_usuario= $_SESSION['nombre_usuario'];
$rango_usuario= $_SESSION['rango_usuario'];
$estado_usuario= $_SESSION['estado_usuario'];
$ruta_foto_usuario= busca_por_id_foto_usuario_BBDD($id_usuario);
$descripcion_usuario= busca_por_id_descripcion_usuario_BBDD($id_usuario);
$fecha_creacion_usuario= busca_por_id_fecha_creacion_usuario_BBDD($id_usuario);


if($control_errores==1){
    echo ("<br> <br>");
    echo ("------------------DEBUG-------------------------------");
    echo ("id_usuario <br> $id_usuario <br>");
    echo ("nombre_usuario <br> $nombre_usuario <br>");
    echo ("rango_usuario <br> $rango_usuario <br>");
    echo ("estado_usuario <br> $estado_usuario <br>");
    echo ("descripcion_usuario <br> $descripcion_usuario <br>");
    echo ("fecha_creacion_usuario <br> $fecha_creacion_usuario <br>");
    echo ("ruta_foto_usuario <br> $ruta_foto_usuario <br>");
    echo ("<br> <br>");
    muestra_imagen($ruta_foto_usuario);
    echo ("<br> <br>");

    echo ("------------------DEBUG-------------------------------");
    echo ("<br> <br>");

}




#-------------------------------------------------
#   
#
#function muestra_imagen($ruta_de_imagen){
#    echo '<img src="'.$ruta_de_imagen.'">'; 
#}

#Inicia las funciones del fichero
function iniciar(){

    muestra_datos_de_perfil();
    muestra_formularios_de_modificacion();
    formulario_btn_moddatos();
    formulario_btn_cierra_sesion();
    muestra_cierra_sesion();
    formulario_btn_vuelve_feed();

}







/*
#Cierra sesion de usuario
#-------------------------------------------------
function formulario_btn_cierra_sesion(){
    ?>
    <form action="" method="post">
        <input type="submit" name="btn_formulario_btn_cierra_sesion" value="Cerrar sesion de usuario"> 
    </form> 
    <?php
}

function muestra_cierra_sesion(){
    if (isset($_POST['btn_formulario_btn_cierra_sesion'])){
        cierra_sesion_de_usuario();
    }
}
#-------------------------------------------------
*/
#Muestra los datos del perfil
#-------------------------------------------------
function muestra_datos_de_perfil(){
    global $nombre_usuario , $rango_usuario ,  $ruta_foto_usuario,   $descripcion_usuario,    $fecha_creacion_usuario;
    
    muestra_imagen($ruta_foto_usuario);
    $mensaje_de_nombre_usuario="Hola $nombre_usuario ";
    $mensaje_de_rango_usuario=" Eres un $rango_usuario del foro";
    $mensaje_de_fecha_creacion_usuario="Te uniste en fecha: $fecha_creacion_usuario";
    $mensaje_de_descripcion="Tu descripcion es: ";
    
    echo ("<br> $mensaje_de_nombre_usuario");
    echo ("<br> $mensaje_de_rango_usuario");
    echo ("<br> $mensaje_de_fecha_creacion_usuario");
    echo ("<br> $mensaje_de_descripcion");
    echo("<br> $descripcion_usuario <br>");  
    echo ("<br>");
}
#-------------------------------------------------


#Formularios de modificacion de usuario
#-------------------------------------------------
function formulario_btn_moddatos(){
    if (!isset($_POST['btn_formulario_btn_moddatos'])){
    ?>
    <form action="" method="post">
        <input type="submit" name="btn_formulario_btn_moddatos" value="Modificar Datos de usuario"> 
    </form> 
    <?php
    }else{
        ?>
        <br>
        <form action="" method="post">
            <input type="submit" name="btn_nada" value="Ocultar modificar datos de usuario"> 
        </form> 
        <?php
    }
}


function muestra_formularios_de_modificacion(){
    if (isset($_POST['btn_formulario_btn_moddatos'])){

        echo (" <br> ");
        formulario_modificar_usuario_nombre();
        echo (" <br> ");
        formulario_modificar_usuario_contrasena();
        echo (" <br> ");
        formulario_modificar_usuario_foto();
        echo (" <br> ");
        formulario_modificar_usuario_descripcion();
        echo (" <br> ");
        formulario_desactivar_usuario();
        echo (" <br> ");

        }
    }
    

function formulario_modificar_usuario_nombre(){
    ?>
    <div>Cambiar nombre de usuario</div>
    <form action="../recursos/carga.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" required><br>
        <input type="submit" name="btn_enviar_modusuarionombre" value="Enviar"> 
    </form> 
    <?php
}

function formulario_modificar_usuario_contrasena(){
    ?>
    <div>Cambiar Contraseña de usuario</div>
    <form action="../recursos/carga.php" method="post" enctype="multipart/form-data">
    
    <label for="contrasena">Contraseña: </label>
    <input type="password" name="contrasena" required><br>    
        <input type="submit" name="btn_enviar_modusuariocontrasena" value="Enviar"> 
    </form> 
    <?php
}

function formulario_modificar_usuario_foto(){
    ?>
    <div>Cambiar Foto de usuario</div>
    <form action="../recursos/carga.php" method="post" enctype="multipart/form-data">

    <label for="foto">Foto de perfil: </label>
    <input type="file" name="foto"><br>       
        <input type="submit" name="btn_enviar_modusuariofoto" value="Enviar"> 
    </form> 

    <?php
}

function formulario_modificar_usuario_descripcion(){
    ?>
    <div>Cambiar Descripcion de usuario</div>
    <form action="../recursos/carga.php" method="post" enctype="multipart/form-data">

    <label for="descripcion">Descripcion: </label><br>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>    
        <input type="submit" name="btn_enviar_modusuariodescripcion" value="Enviar"> 
    </form> 
    <?php
}

function formulario_desactivar_usuario(){
    ?>
    <form action="../recursos/carga.php" method="post">
        <input type="submit" name="btn_desactivar_usuario" value="Desactivar usuario"> 
    </form> 
    <?php
}
#-------------------------------------------------



#Cabecera html
function cabecera_html(){
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil</title>
        <link rel="stylesheet" href="../css/perfil.css">

    </head>
    <body>
    <?php
}

#Cuerpo html generico
function cuerpo_html(){
    ?> 
    <body> 
    <?php
    iniciar();

   # funciones_php()
    ?>
    <br><br>
    </body>
    </html>
    <?php
}
cabecera_html();
cuerpo_html();
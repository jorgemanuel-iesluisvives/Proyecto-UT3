<?php
session_start();
require_once '../recursos/funciones.php';
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /principal/creapost.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------

function iniciar(){
    formulario_crea_datos_post();
    recoge_formulario_crea_datos_post();
}

function formulario_crea_datos_post(){
    ?>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo" required><br>

        <label for="texto">Texto: </label><br>
        <textarea id="texto" name="texto" rows="4" cols="50"  required></textarea><br><br>

        <label for="foto">Imagen de post: </label>
        <input type="file" name="foto"  required><br>  

        <input type="submit" name="btn_crea_datos_post" value="Publicar post"> 

    </form> 
    <?php
}

function recoge_formulario_crea_datos_post(){
    global $control_errores;
    if (isset($_POST['btn_crea_datos_post'])){
        $titulo=$_POST["titulo"];
        $texto=$_POST["texto"];
        $usuario=$_SESSION['nombre_usuario'];
        $hora_creacion=time();


        if($_FILES["foto"]["error"] != 0) {
            echo $control_errores==1 ? "SIN FOTO ": "";
            $fotoenviada=0;
            $ruta_foto_de_perfil="../recursos/imagenes/default.gif";
        } 
    else{
        echo $control_errores==1 ? "FOTO ENVIADA": ""; 
        $imagen = $_FILES['foto']['name'];
        if (move_uploaded_file(from: $_FILES['foto']['tmp_name'], to: '../recursos/imagenes/'."$imagen".$hora_creacion.".gif"))
        { $fotoenviada=1; }
        $ruta_foto_de_perfil="../recursos/imagenes/$imagen"."$hora_creacion".".gif";
    }

        inserta_post_BBDD($titulo,$usuario,$texto,$ruta_foto_de_perfil);
        header('Location: http://localhost/test/principal/feed.php');

    }
}


#Cabecera html
function cabecera_html(){
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crea post</title>
        <link rel="stylesheet" href="../css/creapost.css">

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
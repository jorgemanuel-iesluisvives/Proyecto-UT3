<?php
session_start();
require_once '../recursos/funciones.php';
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /principal/post.php ";
    echo "<br>";
}


if (isset($_POST['btn_publica_comentario']))
{
$idpost=$_SESSION['idpost_actual'];
header("http://localhost/test/principal/post.php?id="."$idpost"."&btn_enviar_de_feed_a_post=Ver+contenido+del+post");

}
#---------------------------------------------------------------------------------

/*

    - ./post.php
        Muestra un post selecionado desde feed, 
        la informacion del post se recoge de la bbdd
        tambien muestra hilos de comentarios de un post y permite crearlos; se recoge de la bbdd

*/
/*
---------------
TITULO    busca_por_id_titulo_post_BBDD($idbuscado)

----------------
----
USUARIO  busca_por_id_usuario_post_BBDD($idbuscado)

FECHA  busca_por_id_fecha_post_BBDD($idbuscado)

----



----------------------------------------------
IMAGEN  busca_por_id_imagenes_post_BBDD($idbuscado)


TEXTO  busca_por_id_texto_post_BBDD($idbuscado)



Hilos comentarios del post

*/



function iniciar(){

    formulario_btn_vuelve_feed();
    formulario_btn_vuelve_perfil();
    muestra_post();
    formulario_crear_comentario();
    muestra_comentarios();
    crea_comentario();
}


function muestra_post(){
    global $titulo_post, $usuario_post, $fecha_post, $texto_post, $imagenes_post;

    echo "<br> $titulo_post";
    echo "<br> <br> Post creado por: $usuario_post";
    echo "<br> Publicado el dia: $fecha_post";
    echo "<br> <br> $texto_post";
    echo "<br> <br> <br> ";
    muestra_imagen($imagenes_post);
    echo "<br> <br> <br> ";

}





function formulario_crear_comentario(){
    global $idpost;
    ?>
    <form action="" method="post">
        <label for="texto">Escribe un comentario: </label><br>
        <textarea id="texto" name="texto" rows="4" cols="50" required></textarea><br>     
        <input type="submit" name="btn_publica_comentario" value="Publicar comentario"> 

    </form> 

    <?php
    }

    function crea_comentario(){
        global $idpost;

        if (isset($_POST['btn_publica_comentario'])){
        $texto=$_POST["texto"];
        $post="$idpost";
        $usuario=$_SESSION['nombre_usuario'];
        $anterior="0";
        inserta_hilo_BBDD($post,$usuario,$anterior,$texto);
            
    }     
}

    function muestra_comentarios(){
        global $idpost;
        $conexion = mysqli_connect('10.5.0.5','root','','foro',3306,'');
        $sql = "SELECT * FROM hilos where post="."$idpost"." ;";
        
        $resultado = mysqli_query($conexion, $sql);
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $idcomentario=$fila['id'];
            echo ("Usuario: ".$fila['usuario']);
            echo ("  ".$fila['fecha']);  
            echo ("<br>");  
            echo ($fila['texto']);  
            echo ("<br> <br>");
        }
    }
     



#Cabecera html
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Post</title>
        <link rel="stylesheet" href="../css/post.css">

    </head>
    <body>
    <?php

#Cuerpo html generico
    ?> 
    <body> 
    <?php


if ( (isset($_GET['btn_enviar_de_feed_a_post'])) || (isset($_POST['btn_publica_comentario'])) ){
    
    if (isset($_GET['btn_enviar_de_feed_a_post']))
    {
    $idpost=$_GET["id"];
    $_SESSION['idpost_actual'] = $idpost;

}
if (isset($_POST['btn_publica_comentario']))
{
$idpost=$_SESSION['idpost_actual'];
header("http://localhost/test/principal/post.php?id="."$idpost"."&btn_enviar_de_feed_a_post=Ver+contenido+del+post");

}

    $titulo_post=busca_por_id_titulo_post_BBDD($idpost);
    $usuario_post=busca_por_id_usuario_post_BBDD($idpost);
    $fecha_post=busca_por_id_fecha_post_BBDD($idpost);
    $texto_post=busca_por_id_texto_post_BBDD($idpost);
    $imagenes_post=busca_por_id_imagenes_post_BBDD($idpost);
    

    if($control_errores==1){
    
        echo "<br> titulo_post";
        echo "<br> $titulo_post";
        echo "<br> usuario_post";
        echo "<br> $usuario_post";
        echo "<br> fecha_post";
        echo "<br> $fecha_post";
        echo "<br> texto_post";
        echo "<br> $texto_post";
        echo "<br> RUTA imagenes_post";
        echo "<br> $imagenes_post <br>" ;
        muestra_imagen($imagenes_post);
    
    
    
    
    
    echo ("<br> <br> <br> <br> <br> <br>");
    echo ("-----------------------------------------------------------------------");
    echo ("HILOS");
    echo ("-----------------------------------------------------------------------");
    }

    iniciar();

}else{
    echo("ERROR: POST NO ENCONTRADO");
}


   # funciones_php()
    ?>
    <br><br>
    </body>
    </html>
    <?php





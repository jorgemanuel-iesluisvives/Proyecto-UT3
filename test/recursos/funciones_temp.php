<?php
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=1;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /recursos/funciones.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------
/*
Funciones comunes
*/

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




function recoge_form_registro(){
    global $control_errores;
    if (isset($_POST['btn_enviar_registro'])){
        $nombre=$_POST["nombre"];
        $contrasena=$_POST["contrasena"];
        $descripcion=$_POST["descripcion"];

        #Comprueba si hay errores al subir FOTO
        if($_FILES["foto"]["error"] != 0) {
            echo $control_errores==1 ? "SIN FOTO ": "";
            $fotoenviada=0;
        } 
    else{
        echo $control_errores==1 ? "FOTO ENVIADA": ""; 
        $imagen = $_FILES['foto']['name'];
        if (move_uploaded_file(from: $_FILES['foto']['tmp_name'], to: "../recursos/imagenes/$imagen"))
        { $fotoenviada=1; }
        $ruta_foto_de_perfil="../recursos/imagenes/$imagen";
    }

    #MUESTRA DATOS
    if($control_errores==1){
        echo ("<br> <br> <br>");
        echo ("DATOS");
        echo ("$nombre");
        echo ("$contrasena");
        echo ("$descripcion");
        if ($fotoenviada=1){    
            echo '<img src="../recursos/imagenes/'.$imagen.'">'; 
        }
        echo ("DATOS");
        echo ("<br> <br> <br>");
    }
    #INSERTA EN BBDD
    $rango="Usuario";
    $estado="Activada";
    inserta_usuario_BBDD($contrasena,$nombre,$ruta_foto_de_perfil,$descripcion,$rango,$estado);

    }
}









#Llamada de funciones de php, establece orden en el que se ejecutan las funciones
function funciones_php(){
    global $control_errores;
    if($control_errores==1){
    echo("FUNCIONES PHP");
    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
    echo $control_errores==1 ? "<br>": "";
    }


    if($control_errores==1){
    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
}
}





#Funciones de html
#---------------------------------------------------------------------------------



function formulario_generico(){
    ?>
    <div>Inicio de sesión</div>
    <form action="" method="post">
        <label for="campo1">campo1: </label>
        <input type="text" name="campo1"><br>
        <label for="campo2">campo2: </label>
        <input type="text" name="campo2"><br>
        <input type="submit" name="btn1" value="btn1"> 
        <input type="submit" name="btn2" value="btn2" formaction="RUTA"> 
    </form> 
    <?php
}



#Cabecera html generica
function cabecera_html_generica(){
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <div>CABECERA HTML</div>
    <?php
}

#Cuerpo html generico
function cuerpo_html(){
    ?> 
    <body> 
    <?php
    funciones_php()
    ?>
    <br><br>
    <div>FIN DOCUMENTO</div>
    </body>
    </html>
    <?php
}
#---------------------------------------------------------------------------------







#Funciones de BBDD
#---------------------------------------------------------------------------------

#Tabla usuarios
#------------------------------------------
function inserta_usuario_BBDD($password,$nombre,$foto,$descripcion,$rango,$estado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "INSERT INTO usuarios (password, nombre, foto, descripcion, fecha_creacion, rango, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="sssssss";
    $fecha_creacion=date('Y/m/d h:i:s a', time());
    mysqli_stmt_bind_param($stmt,$tipos,$password,$nombre,$foto,$descripcion,$fecha_creacion,$rango,$estado);
    mysqli_stmt_execute($stmt);
}

#cambios
#------------
function cambia_contra_usuario_BBDD($passwordnueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE usuarios SET password = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$passwordnueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_nombre_usuario_BBDD($nombrenueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE usuarios SET nombre = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$nombrenueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_foto_usuario_BBDD($fotonueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE usuarios SET foto = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$fotonueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_descripcion_usuario_BBDD($descripcionnueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE usuarios SET descripcion = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$descripcionnueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_rango_usuario_BBDD($rangonueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE usuarios SET rango = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$rangonueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_estado_usuario_BBDD($estadonueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE usuarios SET estado = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$estadonueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}
#------------

#busquedas
#------------
function busca_por_id_nombre_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT nombre FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['nombre'];
    }
    return $vuelve;
}

function busca_por_id_foto_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT foto FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['foto'];
    }
    return $vuelve;
}

function busca_por_id_descripcion_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT descripcion FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['descripcion'];
    }
    return $vuelve;
}
function busca_por_id_fecha_creacion_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT fecha_creacion FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['fecha_creacion'];
    }
    return $vuelve;
}
function busca_por_id_rango_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT rango FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['rango'];
    }
    return $vuelve;
}
function busca_por_id_estado_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT estado FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['estado'];
    }
    return $vuelve;
}
#------------
#------------------------------------------


#Tabla posts
#------------------------------------------
function inserta_post_BBDD($titulo,$usuario,$texto,$imagenes){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "INSERT INTO posts (titulo, usuario, fecha, texto, imagenes) VALUES (?, ?, ?, ?, ?)";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="sssssss";
    $fecha=date('Y/m/d h:i:s a', time());
    mysqli_stmt_bind_param($stmt,$tipos,$titulo,$usuario,$fecha,$texto,$imagenes);
    mysqli_stmt_execute($stmt);
}

#Cambios
#------------
function cambia_titulo_post_BBDD($titulonueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE posts SET titulo = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$titulonueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

#NO SE CAMBIA USUARIO DE UN POST

function cambia_fecha_post_BBDD($fechanueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE posts SET fecha = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$fechanueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_texto_post_BBDD($textonueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE posts SET texto = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$textonueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_imagenes_post_BBDD($imagenesnueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE posts SET imagenes = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$imagenesnueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}
#------------

#busquedas
#------------
function busca_por_id_titulo_post_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT titulo FROM posts WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['titulo'];
    }
    return $vuelve;
}

function busca_por_id_usuario_post_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT usuario FROM posts WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['usuario'];
    }
    return $vuelve;
}

function busca_por_id_fecha_post_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT fecha FROM posts WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['fecha'];
    }
    return $vuelve;
}

function busca_por_id_texto_post_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT texto FROM posts WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['texto'];
    }
    return $vuelve;
}

function busca_por_id_imagenes_post_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT imagenes FROM posts WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['imagenes'];
    }
    return $vuelve;
}
#------------
#------------------------------------------

#Tabla hilos
#------------------------------------------
function inserta_hilo_BBDD($post,$usuario,$anterior,$texto){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "INSERT INTO hilos (post, usuario, anterior, fecha, texto) VALUES (?, ?, ?, ?, ?)";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="isiss";
    $fecha=date('Y/m/d h:i:s a', time());
    mysqli_stmt_bind_param($stmt,$tipos,$post,$usuario,$anterior,$fecha,$texto);
    mysqli_stmt_execute($stmt);
}

#Cambios
#------------
    #NO SE CAMBIAN post, usuario, anterior

function cambia_fecha_hilo_BBDD($fechanueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE hilos SET fecha = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$fechanueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}

function cambia_texto_hilo_BBDD($textonueva,$idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "UPDATE hilos SET texto = ? where id = ? ";
    $stmt= mysqli_prepare(mysql: $conexion,query: $sql);
    $tipos="si";
    mysqli_stmt_bind_param($stmt,$tipos,$textonueva,$idbuscado);
    mysqli_stmt_execute($stmt);
}
#------------

#busquedas
#------------
function busca_por_id_usuario_hilo_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT usuario FROM hilos WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['usuario'];
    }
    return $vuelve;
}

function busca_por_id_fecha_hilo_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT fecha FROM hilos WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['fecha'];
    }
    return $vuelve;
}

function busca_por_id_texto_hilo_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT texto FROM hilo WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['texto'];
    }
    return $vuelve;
}

function busca_por_id_anterior_hilo_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT anterior FROM hilos WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['anterior'];
    }
    return $vuelve;
}
#------------
#------------------------------------------


#---------------------------------------------------------------------------------
<?php
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
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
function devuelve_hora(){
        $fecha_creacion=date('Y/m/d h:i:s a', time());
    return $fecha_creacion;
}
function muestra_imagen($ruta_de_imagen){
    echo '<img src="'.$ruta_de_imagen.'">'; 
}

function formulario_btn_vuelve_perfil(){
    ?>
     <form action="perfil.php" method="post">
        <input type="submit" name="btn-profile" value="Ver mi perfil"> 
    </form> 
    <?php
}

function formulario_btn_vuelve_feed(){
    ?>
     <form action="feed.php" method="post">
        <input type="submit" name="btn1" value="Volver a feed"> 
    </form> 
    <?php
}
function formulario_btn_ir_a_crear_post(){
    ?>
     <form action="creapost.php" method="post">
        <input type="submit" name="btn_ir_a_crear_post" value="Crear nuevo post"> 
    </form> 
    <?php
}

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



#Cambios de datos de la BBDD, el nombre de la funcion indica, por orden, que se cambia y en que tabla.
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

#Comprobar contrasena
#------------
function comprueba_nombre_contrasena($inicionombre,$iniciocontrasena){
    global $control_errores;

    echo $control_errores==1 ? "<br> ": "";
    echo $control_errores==1 ? "comprueba_nombre_contrasena ": "";
    echo $control_errores==1 ? "<br> ": "";


    $BBDDid=busca_por_nombre_id_usuario_BBDD($inicionombre);

    echo $control_errores==1 ? "<br> ": "";
    echo $control_errores==1 ? "busca_por_nombre_id_usuario_BBDD ": "";
    echo $control_errores==1 ? "<br> ": "";


    $BBDDnombre= busca_por_id_nombre_usuario_BBDD($BBDDid);


    echo $control_errores==1 ? "<br> ": "";
    echo $control_errores==1 ? "busca_por_id_nombre_usuario_BBDD ": "";
    echo $control_errores==1 ? "<br> ": "";

    $BBDDcontrasena=busca_por_id_contrasena_usuario_BBDD($BBDDid);

    echo $control_errores==1 ? "<br> ": "";
    echo $control_errores==1 ? "busca_por_id_contrasena_usuario_BBDD ": "";
    echo $control_errores==1 ? "<br> ": "";



    if ( ($inicionombre==$BBDDnombre) && ($iniciocontrasena==$BBDDcontrasena) )
    {
        return 1;
    }
    else{
        return 0;
    }
}
#------------



#busquedas de datos de la BBDD, el nombre de la funcion indica, por orden, que se usa para buscar, que se busca, y en que tabla.
#------------

function busca_por_nombre_id_usuario_BBDD($nombre){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT id FROM usuarios WHERE nombre='$nombre'" ;
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    $vuelve=0;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['id'];
    }
    return $vuelve;
}

function busca_por_id_nombre_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT nombre FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    $vuelve=0;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['nombre'];
    }
    return $vuelve;
}

function busca_por_id_contrasena_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT password FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    $vuelve=0;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['password'];
    }
    return $vuelve;
}

function busca_por_id_foto_usuario_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT foto FROM usuarios WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
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
    $tipos="sssss";
    $fecha=date('Y/m/d h:i:s a', time());
    mysqli_stmt_bind_param($stmt,$tipos,$titulo,$usuario,$fecha,$texto,$imagenes);
    mysqli_stmt_execute($stmt);
}

#Cambios de datos de la BBDD, el nombre de la funcion indica, por orden, que se cambia y en que tabla.
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

#busquedas de datos de la BBDD, el nombre de la funcion indica, por orden, que se usa para buscar, que se busca, y en que tabla.
#------------
function busca_por_id_titulo_post_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT titulo FROM posts WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
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

#busquedas de datos de la BBDD, el nombre de la funcion indica, por orden, que se usa para buscar, que se busca, y en que tabla.
#------------
function busca_por_id_usuario_hilo_BBDD($idbuscado){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT usuario FROM hilos WHERE id = $idbuscado ";
    $resultado= mysqli_query($conexion, $sql);
    $modo=MYSQLI_ASSOC;
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
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
    $vuelve=0;
    while ($fila = mysqli_fetch_array($resultado,$modo)) {
        $vuelve=$fila['anterior'];
    }
    return $vuelve;
}
#------------
#------------------------------------------


#Funciones de sesion
#---------------------------------------------------------------------------------
#Inicia una sesion de usuario cogiendo el nombre como parametro
function iniciar_sesion($usuariodeinicio){
    session_start();
    $_SESSION['sesion_iniciada'] = 1;
    #recuperar datos de bbdd
    # id usuario
    # nombre
    # rango
    # estado
    # meterlos en $_session

    $id_usuario = busca_por_nombre_id_usuario_BBDD($usuariodeinicio);
    $nombre_usuario = busca_por_id_nombre_usuario_BBDD($id_usuario);
    $rango_usuario = busca_por_id_rango_usuario_BBDD($id_usuario);
    $estado_usuario = busca_por_id_estado_usuario_BBDD($id_usuario);

    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    $_SESSION['rango_usuario'] = $rango_usuario;
    $_SESSION['estado_usuario'] = $estado_usuario;


}
#Comprueba si la sesion esta iniciada, devuelve 0 si no esta iniciada, 1 en caso contrario
function comprobar_estado_de_sesion(){
    if (!isset($_SESSION['sesion_iniciada'])) {
        return 0;
    }
    else{
        return 1;
    }
}
#Maneja las sesiones, las inicia si no lo estan
function manejo_de_sesion($usuariodeinicio){
    global $control_errores;
    if (comprobar_estado_de_sesion() == 0) {
        iniciar_sesion($usuariodeinicio);
    }else{
        echo $control_errores==1 ? "SESION YA INICIADA ": "";
        session_start();
        }
}

#Vuelve a cargar las variables de la sesion
function recarga_variables_basicas_de_sesion(){
    $id_usuario= $_SESSION['id_usuario'];
    $nombre_usuario = busca_por_id_nombre_usuario_BBDD($id_usuario);
    $rango_usuario = busca_por_id_rango_usuario_BBDD($id_usuario);
    $estado_usuario = busca_por_id_estado_usuario_BBDD($id_usuario);
     
    $_SESSION['nombre_usuario'] = $nombre_usuario;
    $_SESSION['rango_usuario'] = $rango_usuario;
    $_SESSION['estado_usuario'] = $estado_usuario;

}

#Destruye la sesion actual
function destruye_sesion(){
    session_start();
    $_SESSION['id_usuario'] = 0;
    $_SESSION['nombre_usuario'] = 0;
    $_SESSION['rango_usuario'] = 0;
    $_SESSION['estado_usuario'] = 0;
    $_SESSION= array();
    session_regenerate_id(true);
    session_destroy();
}

#Cierra la sesion y vuelve al index
function cierra_sesion_de_usuario(){
    destruye_sesion();
    header('Location: http://localhost/test/index.php');

}

#Boton para cerrar sesion de usuario
function formulario_btn_cierra_sesion(){
    ?>
    <form action="" method="post">
        <input type="submit" name="btn_formulario_btn_cierra_sesion" value="Cerrar sesion de usuario"> 
    </form> 
    <?php
}
#Comprueba si se ha pulsado el boton de cerrar sesion
function muestra_cierra_sesion(){
    if (isset($_POST['btn_formulario_btn_cierra_sesion'])){
        cierra_sesion_de_usuario();
    }
}
#-------------------------------------------------

#---------------------------------------------------------------------------------
<?php
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=1;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /recursos/carga.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------
require_once '../recursos/funciones.php';


function recoge_form_registro(){
    global $control_errores;
    if (isset($_POST['btn_enviar_registro'])){
        $nombre=$_POST["nombre"];
        $contrasena=$_POST["contrasena"];
        $descripcion=$_POST["descripcion"];
        $hora_creacion=time();
        #Comprueba si hay errores al subir FOTO
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
    #MUESTRA DATOS
    if($control_errores==1){
        echo ("<br> <br> <br>");
        echo ("DATOS");
        echo ("$nombre");
        echo ("$contrasena");
        echo ("$descripcion");
        if ($fotoenviada=1){    
            echo '<img src="'.$ruta_foto_de_perfil.'">'; 
        }
        
        echo ("DATOS");
        echo ("<br> <br> <br>");
    }
    #INSERTA EN BBDD
    $rango="Usuario";
    $estado="Activada";
    inserta_usuario_BBDD($contrasena,$nombre,$ruta_foto_de_perfil,$descripcion,$rango,$estado);

    header('Location: http://localhost/test/sesiones/inicio.php');
    #CAMBIAR /2/TEST-1 POR /

    }
    echo ("<br> <br> <br>");
    echo ("ERROR");

}




function recoge_form_inicio_sesion(){
    global $control_errores;
    if (isset($_POST['btn_enviar_inicio_sesion'])){
        $nombre=$_POST["nombre"];
        $contrasena=$_POST["contrasena"];
        $hora_creacion=time();
        

    #COMPRUEBA EN BBDD
    $existe=comprueba_nombre_contrasena($nombre,$contrasena);
    
    #MUESTRA DATOS
    if($control_errores==1){
        echo ("<br> <br> <br>");
        echo ("DATOS");
        echo ("<br>");
        echo ("$nombre");
                echo ("<br>");

        echo ("$contrasena");
                echo ("<br>");

        echo ("Existe: $existe");
                echo ("<br>");

        echo ("DATOS");
        echo ("<br> <br> <br>");
    }

    if ($existe == 1){

    #MANEJAR SESIONES
    manejo_de_sesion($nombre);
    $idcuenta=busca_por_nombre_id_usuario_BBDD($nombre);
    $estadocuenta=busca_por_id_estado_usuario_BBDD($idcuenta);
        if($estadocuenta=="Desactivada"){
            echo(" <br> No se puede iniciar sesion, la cuenta esta desactivada <br>");
            formulario_btn_cierra_sesion();
        }else{
            header('Location: http://localhost/test/principal/feed.php');
        }
#CAMBIAR IF ELSE CONDICION
    
    
    }else {
    echo ("<br> <br> <br>");
    echo ("ERROR USUARIO O CONTRASEÑA NO VALIDOS");

    }
    }
    echo ("<br> <br> <br>");
    echo ("ERROR");


}







#IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII

function recoge_form_modificar_usuario_nombre(){
    global $control_errores;
    session_start();
    $id_usuario= $_SESSION['id_usuario'];
    if (isset($_POST['btn_enviar_modusuarionombre'])){
        $nombre=$_POST["nombre"];

    #MUESTRA DATOS
    if($control_errores==1){
        echo ("<br> <br> <br>");
        echo ("DATOS");
        echo ("$nombre");
        echo ("$id_usuario");
        echo ("DATOS");
        echo ("<br> <br> <br>");
    }
    #CAMBIA DATOS EN BBDD
    cambia_nombre_usuario_BBDD($nombre,$id_usuario);
    recarga_variables_basicas_de_sesion();
    #Volvemos a perfil
    header('Location: http://localhost/test/principal/perfil.php');
    }
    echo ("<br> <br> <br>");
    echo ("ERROR");

}

function recoge_form_modificar_usuario_contrasena(){
    global $control_errores;
    session_start();
    $id_usuario= $_SESSION['id_usuario'];
    if (isset($_POST['btn_enviar_modusuariocontrasena'])){
        $contrasena=$_POST["contrasena"];

    #MUESTRA DATOS
    if($control_errores==1){
        echo ("<br> <br> <br>");
        echo ("DATOS");
        echo ("$contrasena");
        echo ("$id_usuario");
        echo ("DATOS");
        echo ("<br> <br> <br>");
    }
    #CAMBIA DATOS EN BBDD
    cambia_contra_usuario_BBDD($contrasena,$id_usuario);
    recarga_variables_basicas_de_sesion();
    #Volvemos a perfil
    header('Location: http://localhost/test/principal/perfil.php');
    }
    echo ("<br> <br> <br>");
    echo ("ERROR");

}

function recoge_form_modificar_usuario_foto(){
    global $control_errores;
    session_start();
    $id_usuario= $_SESSION['id_usuario'];
    $hora_creacion=time();

    if (isset($_POST['btn_enviar_modusuariofoto'])){

        #Comprueba si hay errores al subir FOTO
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

    #MUESTRA DATOS
    if($control_errores==1){
        echo ("<br> <br> <br>");
        echo ("DATOS");
        echo ("$ruta_foto_de_perfil");
        if ($fotoenviada=1){    
            echo '<img src="'.$ruta_foto_de_perfil.'">'; 
        } 
        echo ("$id_usuario");
        echo ("DATOS");
        echo ("<br> <br> <br>");
    }
    #CAMBIA DATOS EN BBDD
    cambia_foto_usuario_BBDD($ruta_foto_de_perfil,$id_usuario);
    recarga_variables_basicas_de_sesion();
    #Volvemos a perfil
    header('Location: http://localhost/test/principal/perfil.php');
    }
    echo ("<br> <br> <br>");
    echo ("ERROR");

}


function recoge_form_modificar_usuario_descripcion(){
    global $control_errores;
    echo $control_errores==1 ? "DEBUG recoge_form_modificar_usuario_descripcion": "";

    session_start();
    $id_usuario= $_SESSION['id_usuario'];
    if (isset($_POST['btn_enviar_modusuariodescripcion'])){
        $descripcion=$_POST["descripcion"];

    #MUESTRA DATOS
    if($control_errores==1){
        echo ("<br> <br> <br>");
        echo ("DATOS");
        echo ("$descripcion");
        echo ("$id_usuario");
        echo ("DATOS");
        echo ("<br> <br> <br>");
    }
    #CAMBIA DATOS EN BBDD
    echo $control_errores==1 ? "DEBUG CAMBIA DATOS EN BBDD": "";

    cambia_descripcion_usuario_BBDD($descripcion,$id_usuario);
    recarga_variables_basicas_de_sesion();
    #Volvemos a perfil
    header('Location: http://localhost/test/principal/perfil.php');
    }
    echo ("<br> <br> <br>");
    echo ("ERROR");

}

function recoge_formulario_desactivar_usuario(){
    global $control_errores;
    echo $control_errores==1 ? "DEBUG recoge_formulario_desactivar_usuario": "";

    session_start();
    $id_usuario= $_SESSION['id_usuario'];
    if (isset($_POST['btn_desactivar_usuario'])){

    #CAMBIA DATOS EN BBDD
    echo $control_errores==1 ? "DEBUG CAMBIA DATOS EN BBDD": "";

    cambia_estado_usuario_BBDD("Desactivada",$id_usuario);
    recarga_variables_basicas_de_sesion();
    
    #Cierra sesion del usuario
    cierra_sesion_de_usuario();
    }
    echo ("<br> <br> <br>");
    echo ("ERROR");

}



#IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII


#FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF

/*

 

function formulario_desactivar_usuario(){
    ?>
    <form action="" method="post">
        <input type="submit" name="btn_desactivar_usuario" value="Desactivar usuario"> 
    </form> 
    <?php
}



*/


#FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF





recoge_form_inicio_sesion();
recoge_form_registro();
recoge_form_modificar_usuario_nombre();
recoge_form_modificar_usuario_contrasena();
recoge_form_modificar_usuario_foto();
recoge_form_modificar_usuario_descripcion();
recoge_formulario_desactivar_usuario();
muestra_cierra_sesion();
<?php
#http://localhost/test/index.php

require_once '../recursos/funciones.php';
$control_errores=1;
/*
    - ./inicio.php
        Permite iniciar sesion al usuario, compara los datos introducidos con los de la bbdd.
        Si los datos son correctos, se inicia una sesion y redirige a /principal/feed.php

    Tendra 2 botones, uno lleva a la pagina de registro, el otro inicia sesion y te lleva a feed
    Tiene 2 campos para meter usuario y contraseña
*/
#Control de sesion
#---------------------------------------------------------------------------------

function sesion_iniciada(){
    $_SESSION['sesion_iniciada'] = 1;
}

function sesion_no_iniciada(){
    $_SESSION['sesion_iniciada'] = 0;
}
#adas
function sesiones(){
session_start();
if (!isset($_SESSION['sesion_iniciada'])) {
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

#


function formulario_inicio_sesion(){


?>

<div>Inicio de sesión</div>
<form action="" method="post">
    <label for="nombre">Nombre: </label>
    <input type="text" name="nombre"><br>
    <label for="estado">Estado: </label>
    <input type='radio' name='estado' value="Desactivada" required><br>
    <input type='radio' name='estado' required><br>
    <input type='radio' name='estado' required><br>
    <label for="contrasena">Contraseña: </label>
    <input type="password" name="contrasena"><br>
    <label for="descripcion">(opcional) Descripcion: </label><br>
    <textarea id="descripcion" name="descripcion" rows="4" cols="50">Add your inquiry</textarea><br> 
        <label for="foto">(opcional) Foto de perfil: </label>
        <input type="file" name="foto"><br>   <br>      
    <input type="submit" name="btn_inicio_sesion" value="Iniciar sesion" formaction="../principal/feed.php"> 
    <input type="submit" name="btn" value="Registarse" formaction="registro.php"> 
</form> 
<?php
}


if (isset($_POST['btn_inicio_sesion'])){
$nombre=$_POST["nombre"];
$contrasena=$_POST["contrasena"];
echo "nombre: $nombre <br>";
echo "contrasena: $contrasena <br>";
}


#Estas funciones se ejecutan antes del html
function funciones_php_pre_html(){

}





#Llamada de funciones de php
function funciones_php(){
    global $patata;
    echo("FUNCIONES PHP");
    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
    echo ("<br>");
formulario_inicio_sesion();
$fecha=date('d/m/Y h:i:s a', time());
    echo($fecha);
   $nombrebusca=busca_por_id_nombre_usuario_BBDD("2");
   echo ($nombrebusca);

    echo ("<br>");
    echo ("<br>");


echo("LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL");
    echo ("<br>");
    echo ("<br>");


    $titulo="Titulo de post2";
    $usuario="Nombre123";
    $texto="lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
    $imagenes="../recursos/imagenes/default.gif";
echo (comprueba_nombre_contrasena("usuario3434","contraaaa34234"));
#inserta_post_BBDD($titulo,$usuario,$texto,$imagenes);
 echo("LLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL");
    echo ("<br>");
    echo ("<br>");



    echo ("<br>");
    echo ("---------------------------------------------------------------------------------");
}






#Funciones de html
#---------------------------------------------------------------------------------

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
global $control_errores;

    if($control_errores==1){
    echo("AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA PHP");
echo (time());
    }

    
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


cabecera_html_generica();
cuerpo_html();



<?php
session_start();
require_once '../recursos/funciones.php';
#DEBUG
#---------------------------------------------------------------------------------
$control_errores=0;
echo $control_errores==1 ? "DEBUG ": "";
if($control_errores==1){
    echo ("ACTIVADO");
    echo " /principal/feed.php ";
    echo "<br>";
}
#---------------------------------------------------------------------------------
/*
    - ./feed.php
        Muestra resumen de los posts y/o publicaciones del foro. ; se recoge de la bbdd
        Para ver un post, este se ve en principal/post.php.


se filtran posts
como mínimo de una forma.

    Muestra lista de enlaces a los posts. 
    Un boton permite desconectarse de la sesion
    
        
*/
cabecera_html();
cuerpo_html();
function iniciar(){

    formulario_btn_vuelve_perfil();
    formulario_btn_ir_a_crear_post();
    muestra_posts();
}


function muestra_posts(){
    $conexion = mysqli_connect('10.5.0.5','root','','foro',3306,'');
    $sql = "SELECT * FROM posts;";
    
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $idpost=$fila['id'];
        echo " ".$fila['titulo']."<br>";
        echo ($fila['fecha']);  
        formulario_ir_a_ver_post($idpost);


        echo ("<br> <br>");
    }
}
 

function formulario_ir_a_ver_post($idpost){
    ?>
    <form action="post.php" method="get">
    <input type="hidden" name="id" value="<?php echo($idpost) ?>">
        <input type="submit" name="btn_enviar_de_feed_a_post" value="Ver contenido del post"> 
    </form> 
    <?php
}



#Cabecera html
function cabecera_html(){
    ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foro retro</title>
        <link rel="stylesheet" href="../css/base.css">

    </head>
    <body>
    <?php
}

#Cuerpo html generico
function cuerpo_html(){
    ?> 
    <body> 
        <div>Bienvenido al foro!</div>
    <?php
    iniciar();

   # funciones_php()
    ?>
    <br><br>
    </body>
    </html>
    <?php
}

/*
?>

#---------------------------------------------------------------------------------------------


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
</head>
<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "twitter", 3306, "");
    if (isset($_POST['post'])) {
        $usuario = $_POST['user'];
        $contenido = $_POST['content'];
        $sql = "INSERT INTO timeline (arroba_usuario, contenido) VALUES ('$usuario', '$contenido')";
        mysqli_query($con, $sql);
    }
    if (isset($_POST['like'])) {
        $id = $_POST['id'];
        $sql = "UPDATE timeline SET likes = likes + 1 WHERE id = $id";
        mysqli_query($con, $sql);
    }
    if (isset($_POST['del'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM timeline WHERE id = $id";
        mysqli_query($con, $sql);
    }
    ?>
    <form action="#" method="post">
        <label for="user">Usuario:</label>
        <input type="text" name="user"required><br>
        <label for="content">Contenido del tweet</label>
        <input type="text" name="content" required><br>
        <input type="submit" name="post" value="Publicar">
    </form>
    <?php
    $sql = "SELECT * FROM timeline;";
    $resultado = mysqli_query($con, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "Usuario: ".$fila['arroba_usuario']."<br>";
        echo $fila['contenido']."<br>";
        echo "Likes: ".$fila['likes'];
        echo '
        <form action="#" method="post">
            <input type="hidden" name="id" value="'.$fila['id'].'">
            <input type="submit" name="like" value="Like"><br>
            <input type="submit" name="del" value="Eliminar">
        </form>';
    }


function muestra_posts(){
    $conexion = mysqli_connect('localhost','root','','foro',3306,'');
    $sql = "SELECT * FROM posts;";
    
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo " ".$fila['titulo']."<br>";
        echo ($fila['fecha']);  
    }
}






    ?>
</body>
</html>

*/
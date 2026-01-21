# Proyecto-UT3
Este proyecto consiste en el desarrollo de una página web, haciendo uso de la estructura clásica de un foro
La temática del foro sera de juegos retro.

Esta versión esta diseñada para desplegarse en contenedores de podman.
Contiene 2 ficheros Containerfile:
 - En la raiz se encuentra el Containerfile de la imagen de la web.
 - En bbdd se encuentra el Containerfile de la imagen de la bbdd.

Instrucciones de la version de release:
1- Llevar el fichero IAW.zip a una maquina con Ubuntu/Linux y descomprimirlo con unzip.

2- Moverse hasta IAW/

3- Ejecutar el comando "bash script.sh"

4- En un navegador escribir en la barra de direcciones "http://IPDESERVIDOR:8080/test/"

Nota: Se debe sustituir "IPDESERVIDOR" con la ip de tu servidor

Nota2: Se recomienda usar antes el comando "podman system prune --all --force && podman rmi --all" para limpiar el servidor de imagenes y contenedores

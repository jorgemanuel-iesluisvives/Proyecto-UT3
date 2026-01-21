#!/bin/bash
podman build -t localhost/webserver:v1 .
read -p "Construida imagen localhost/webserver:v1, pulsa ENTER para continuar" entrada
cd bbdd
pwd
podman build -t localhost/bbdd:v1 .
read -p "Construida imagen localhost/bbdd:v1, pulsa ENTER para continuar" entrada
cd ..
pwd
podman-compose up -d
read -p "Levantados contenedores, pulsa ENTER para continuar" entrada
watch "podman ps"

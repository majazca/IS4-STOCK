<?php
    define("DIR",getcwd());
    if (isset($_GET["v"]) && $_GET["v"] == 'usuarios') {
        include "vistas/usuarios.php";
    }elseif (isset($_GET["v"]) && $_GET["v"] == 'productos') {
        include "vistas/productos.php";
    }elseif (isset($_GET["v"]) && $_GET["v"] == 'categorias') {
        include "vistas/categorias.php";
    }elseif (isset($_GET["v"]) && $_GET["v"] == 'productos') {
        include "vistas/productos.php";
    }elseif (isset($_GET["v"]) && $_GET["v"] == 'proveedores') {
        include "vistas/proveedores.php";
    }elseif (isset($_GET["v"]) && $_GET["v"] == 'entradas') {
        include "vistas/entradas.php";
    }elseif (isset($_GET["v"]) && $_GET["v"] == 'salidas') {
        include "vistas/salidas.php";
    }else {
        include "vistas/home.php"; 
        //include "vistas/usuarios.php";
    }

?>
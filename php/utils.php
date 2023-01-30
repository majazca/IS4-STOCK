<?php
    function estaSeteado($valor){
        return isset($valor) ? $valor: '';
    }

    if (!defined("DIRECTORIO")) {
        define("DIRECTORIO", getcwd()."/../");
    }
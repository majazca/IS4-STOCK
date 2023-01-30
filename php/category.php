<?php
    //echo json_encode($_POST);

    require '../vendor/autoload.php';
    
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;


    require_once './conexion.php';
    require_once './utils.php';

    if (!isset($_POST)) {
        exit;
    }
    //var_dump($conexion_pg);  ---> funciona
    $user = estaSeteado($_POST['user']);
    $categoryName = estaSeteado($_POST['categoryName']);
    $categoryCode = estaSeteado($_POST['categoryCode']);
    $categoryDescription = estaSeteado($_POST['categoryDescription']);
    $action = estaSeteado($_POST['action']);
    $categoryId = estaSeteado($_POST['categoryId']);

    if ($action == 'addCategory') {
        if ($userPassword == $userRePassword) {
            $sql = "INSERT INTO categorias (nombre, codigo, descripcion) values ((?), (?), (?))";
            $stmt = $conexion_pg->prepare($sql);
            $datos = [$categoryName, $categoryCode, $categoryDescription];
            $stmt->execute($datos);
            echo json_encode(["respuesta" => true]);
        }
    }elseif ($action == 'editCategory') {
        if ($userPassword == $userRePassword) {
            $sql = "UPDATE categorias SET nombre = (?), codigo = (?), descripcion = ? where id = ?";
            $stmt = $conexion_pg->prepare($sql);
            $datos = [$categoryName, $categoryCode, $categoryDescription, $categoryId];
            echo json_encode(["respuesta" => true]);
        }
    }
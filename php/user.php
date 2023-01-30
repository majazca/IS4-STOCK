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
    $userName = estaSeteado($_POST['userName']);
    $userLastName = estaSeteado($_POST['userLastName']);
    $userPassword = estaSeteado($_POST['userPassword']);
    $userRePassword = estaSeteado($_POST['userRePassword']);
    $action = estaSeteado($_POST['action']);
    $userId = estaSeteado($_POST['userId']);

    if ($action == 'addUser') {
        if ($userPassword == $userRePassword) {
            $sql = "INSERT INTO users (name, nombre, apellido, password) values ((?), (?), (?), (?))";
            $stmt = $conexion_pg->prepare($sql);
            $datos = [$userName, $userLastName, md5($userPassword), "$userId"];
            $stmt->execute($datos);
            echo json_encode(["respuesta" => true]);
        }
    }elseif ($action == 'editUser') {
        if ($userPassword == $userRePassword) {
            $sql = "UPDATE users SET nombre = (?), apellido = (?), password = ? where id = ?";
            //$sql = "INSERT INTO users (name, nombre, apellido, password) values ((?), (?), (?), (?))";
            $stmt = $conexion_pg->prepare($sql);
            $datos = [$userName, $userLastName, md5($userPassword), "$userId"];
            $stmt->execute($datos);
            echo json_encode(["respuesta" => true]);
        }
    }
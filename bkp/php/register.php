<?php
    //echo json_encode($_POST);
    require_once './conexion.php';
    require_once './utils.php';

    if (!isset($_POST)) {
        exit;
    }

    $fullName = estaSeteado($_POST['fullname-r']);
    $email = estaSeteado($_POST['email-r']);
    $password = estaSeteado($_POST['password-r']);
    $rPassword = estaSeteado($_POST['rpassword-r']);
    
    if ($password !== $rPassword) {
        echo json_encode([
            'res' => 'La contraseñas no coinciden',
            'id' => null
        ]);
        exit;
    }

    //$verificarEmail = "SELECT id FROM usuario WHERE mail = '$email'";
    $verificarEmail = "SELECT id FROM users WHERE name = ?";
    $stmt = $conexion_pg->prepare($verificarEmail);
    $stmt->execute([$email]);
    $usuarioExistente = $stmt->fetchAll( PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    /* $res= $conexion->query($verificarEmail);
    $usuarioExistente = $res->fetch_assoc(); */
    if(
        is_array($usuarioExistente) && sizeof($usuarioExistente)
    ){
        echo json_encode([
            'res' => 'usuario creado anteriormente',
            'id' => null
        ]);
        exit();
    }

    $password = md5($password);
    //$sql = "INSERT INTO usuario (name, mail, passowrd) values ('$fullName', '$email', '$password')";
    $na =explode(" ",$fullName);
    $sql = "INSERT INTO users (name, nombre, apellido, password) values ((?), (?), (?), (?))";
    $stmt = $conexion_pg->prepare($sql);
    $nombre = estaSeteado($na[0]);
    $apellido = estaSeteado($na[1]);
    $stmt->execute(["$email", "$nombre", "$apellido", "$password"]);
    //$res = $conexion->query($sql);

    if ($conexion_pg->lastInsertId()) {
        echo json_encode([
            'res' => 'usuario creado',
            'id' => $conexion_pg->lastInsertId()
        ]);
    }else{
        echo json_encode([
            'res' => 'error al crear usuario',
            'id' => $sql
        ]);
    }
    $stmt->closeCursor();
    $conexion_pg = null;
    //$conexion->close();
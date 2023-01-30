<?php
    //echo json_encode($_POST);

    
    
    require_once './conexion.php';
    require_once './utils.php';
    
    /* require '../vendor/autoload.php';*/
    
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;
    
    if (!isset($_POST)) {
        exit;
    }
    //var_dump($conexion_pg);  ---> funciona
    $email = estaSeteado($_POST['email']);
    $password = estaSeteado($_POST['password']);
    //$verificarEmail = "SELECT id, mail, name FROM usuario WHERE mail = '".$email."' and passowrd = '".md5(htmlspecialchars($password))."'";
    $verificarEmail = "SELECT id, name, nombre, apellido FROM users WHERE name = ? and password = ? ";
    $stmt = $conexion_pg->prepare($verificarEmail);
    $contrasenha = md5(htmlspecialchars($password));
    $credenciales = ["$email", "$contrasenha"];
    $stmt->execute($credenciales);
    /* $res= $conexion->query($verificarEmail);
    $usuarioExistente = $res->fetch_assoc(); */
    $usuarioExistente = $stmt->fetchAll( PDO::FETCH_ASSOC);
    //print_r($usuarioExistente);
    if(
        is_array($usuarioExistente) && 
        sizeof($usuarioExistente)
    ){  
        session_start(
        /*    ['use_only_cookies'=>0,
            'use_trans_sid'=>1]*/
        );
        $_SESSION['id'] = $usuarioExistente[0]['id'];
        $_SESSION['email'] = $usuarioExistente[0]['name'];
        $_SESSION['nombre'] = $usuarioExistente[0]['nombre'];
        $_SESSION['tiempo'] = date("Y-m-d H:i:s");
        $logger = new Logger('APP');
        $logger->pushHandler(new StreamHandler(DIRECTORIO.'/app.log', Logger::DEBUG));
        $logger->info('Logueo de usuario', ['user_id' => $usuarioExistente[0]['id']]);
    
        echo json_encode([
            'res' => 'credenciales correctas',
            'login' => true
        ]);
        //if(!isset($_SESSION['id'])){
            //session_start();
        //}
        //session_start();
        //exit();
    }else{
        echo json_encode([
            'res' => 'credenciales incorrectas',
            'id' => false,
            'sql' => $verificarEmail
        ]);
        $logger = new Logger('APP');
        $logger->pushHandler(new StreamHandler(DIRECTORIO.'/app.log', Logger::DEBUG));
        $logger->info('Intento fallido de inicio de sesion', ['correo' => $credenciales[0]]);
        exit();
    }
    $stmt->closeCursor();
    $conexion_pg = null;
    //$conexion->close();
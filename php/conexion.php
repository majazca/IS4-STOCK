<?php
    
    if (!defined("RUTA")) { 
        define("RUTA","/home/majazca/actions-runner/uca/IS4-STOCK/IS4-STOCK/");  
    }

    require RUTA.'/vendor/autoload.php';
    
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
    //$dotenv->load();
    $dotenv->safeLoad();

    /*$conexion = new mysqli(
        $_ENV['MYSQL_HOST'],
        $_ENV['MYSQL_USER'],
        $_ENV['MYSQL_PASS'],
        $_ENV['MYSQL_DB']);
    */
    /* $config = [
        'dsn' => 'pgsql:host=172.17.0.3;port=5432;dbname=mydb',
        'username' => 'postgres',
        'password' => 'password',
    ]; */
    $cadena = "pgsql:host={$_ENV['POSTGRESQL_HOST']};port={$_ENV['POSTGRESQL_PORT']};dbname={$_ENV['POSTGRESQL_DB']}";
    
    try {
        $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
        $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $logger = new Logger('APP');
        $logger->pushHandler(new StreamHandler(RUTA. '/app.log', Logger::DEBUG));
        $logger->info('Conexion exitosa');
    } catch (\PDOException $e) {
        if ($_ENV['ENVIRONMENT'] != "production") {
            die("DataBase Error: Database failed.<br>{$e->getMessage()}");
        } else {
            //echo "we";
            /* $log = new Logger('App');
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/errors.log', Logger::ERROR));

            $log->error($e->getMessage(), $e->getTrace()); */
        }
    }

    //var_dump($conexion_pg);
    /* var_dump($_ENV); *//*
    $sql = 'select * from usuario';
    $res = $conexion->query($sql);
    print_r($res->fetch_assoc());*/
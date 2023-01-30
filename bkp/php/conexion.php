<?php
    require '../vendor/autoload.php';
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
    $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
    $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*var_dump($conexion);
    $sql = 'select * from usuario';
    $res = $conexion->query($sql);
    print_r($res->fetch_assoc());*/
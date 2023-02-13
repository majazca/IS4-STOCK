<?php
    //echo json_encode($_POST);

    require '../vendor/autoload.php';
    
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;


    require_once './conexion.php';
    require_once './utils.php';

    if(isset($_GET["obtener"]) && $_GET["obtener"] == "listado"){
        $sql = "SELECT 
                p.id,
                p.RUC,
                p.nombre
            FROM
            proveedores p";
        $stmt = $conexion_pg->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll( PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $stmt->closeCursor();   
        echo json_encode($data);
    }
<?php
    //echo json_encode($_POST);

    require '../vendor/autoload.php';
    
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;


    require_once './conexion.php';
    require_once './utils.php';

    if(isset($_GET["obtener"]) && $_GET["obtener"] == "listado"){
        header("Content-type: application/json");
        $sql = "SELECT 
                p.id,
                p.categoria_id,
                p.nombre,
                p.codigo,
                p.descripcion
            FROM
            productos p";
        $stmt = $conexion_pg->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll( PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        $stmt->closeCursor();   
        echo json_encode($data);
        die();
    }

    function getIdbyProduct(){
        global $conexion_pg;
        $sql = "SELECT 
                p.id,
                p.codigo
            FROM
            productos p";
        $stmt = $conexion_pg->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll( PDO::FETCH_ASSOC);
        $listado = [];
        foreach ($data as $key => $value) {
            $listado[$value['codigo']] = $value['id'];
        }
        return $listado;
    }

    if (isset($_POST['action']) && trim($_POST['action']) !== "") {
        $logger = new Logger('APP');
        $logger->pushHandler(new StreamHandler(RUTA.'/app.log', Logger::DEBUG));
        $logger->info('Logueo de usuario', ['Movimiento_Stock' => $_POST]);
        if($_POST['action'] == "addEntrada"){
            $claves = getIdbyProduct();
            $entrada = [
                "cabecera" => '',
                "detalle" => ''
            ];
            $entrada["cabecera"] = "INSERT INTO entradas_cabeceras (proveedor_id, codigo,fecha, factura_nro, remision_nro, entregado_por, monto_total, monto_letras, descripcion) values ((?), (?), (?), (?), (?), (?), (?), (?), (?))";
            $stmt = $conexion_pg->prepare($entrada["cabecera"]);

            $datos["cabecera"] = [ (int) $_POST["supplierId"], $_POST['code'],"{$_POST['date']}", "{$_POST['invoiceNro']}", "{$_POST['remissionNro']}", "{$_POST['deliveredBy']}", $_POST["amountTotal"], $_POST["amountLetters"], "{$_POST['description']}"];
            echo json_encode([
                $datos["cabecera"],
                $entrada["cabecera"],
            ]);
            //die();
            $stmt = $conexion_pg->prepare($entrada['cabecera']);
            $stmt->execute($datos["cabecera"]);
            $id = $conexion_pg->lastInsertId();
            $productosId = explode(",",$_POST['product-id']);
            $aUsar = array_filter($productosId, function($item){
                return trim($item) !== "";
            });
            if (sizeof($aUsar) > 0) {
                # code...
                $productosQty = explode(",", $_POST['product-qty']);
                $productosLote = explode(",", $_POST['product-lote']);
                $productosVence = explode(",", $_POST['product-vence']);
                $productosPunit = explode(",", $_POST['product-punit']);
                $productosPtotal = explode(",", $_POST['product-ptotal']);
                $entrada["detalle"] = "INSERT INTO entradas_detalles (entrada_cabecera_id, producto_id, cantidad, lote, precio_individual, precio_total, fecha_vencimiento) values ";
                // actualizar existencias
                $sqlUpdate = [];
                $datosUpdate = [];
                $dataTest = "";
                $toInsert = [];
                $iterar = 0;
                foreach ($aUsar as $key => $value) {
                    # code...
                    $dataTest .= "((?), (?), (?), (?), (?), (?), (?)),";
                    $toInsert[] = $id;
                    $toInsert[] = $claves[$productosId[$key]];
                    $toInsert[] = $productosQty[$key];
                    $toInsert[] = $productosLote[$key];
                    $toInsert[] = $productosPunit[$key];
                    $toInsert[] = $productosPtotal[$key];
                    $toInsert[] = $productosVence[$key];
                    $sqlUpdate[$iterar] = "UPDATE existencias SET cantidad_total= cantidad_total + ?, 
                    lote=?, 
                    fecha_vencimiento=?, 
                    precio_individual = ?,	
                    precio_total =? WHERE producto_id=?";
                    $datosUpdate[$iterar] = [
                        $productosQty[$key], $productosLote[$key], 
                        $productosVence[$key], $productosPunit[$key],
                        $productosPtotal[$key],$claves[$productosId[$key]]
                    ];
                    $stmtU = $conexion_pg->prepare($sqlUpdate[$iterar]);
                    $stmtU->execute($datosUpdate[$iterar]);
                    $iterar++;
                }
                $dataTest = substr($dataTest, 0, -1);
                $entrada["detalle"] .= $dataTest;
                echo json_encode([$entrada['detalle'], $toInsert]);
                $stmt = $conexion_pg->prepare($entrada["detalle"]);
                $stmt->execute($toInsert);
                echo json_encode(["respuesta" => true]);
                die();
            }
            echo json_encode(["respuesta" => false]);
        }elseif ($_POST['action'] == "addSalida") {
            # sanitize_title_with_dashes( 
                $claves = getIdbyProduct();
            $entrada = [
                "cabecera" => '',
                "detalle" => ''
            ];
            $entrada["cabecera"] = "INSERT INTO salidas_cabeceras ( codigo_salida,fecha, monto_total, monto_letras, descripcion) values ((?), (?), (?), (?), (?))";
            $stmt = $conexion_pg->prepare($entrada["cabecera"]);

            $datos["cabecera"] = [ $_POST['code'],"{$_POST['date']}", $_POST["amountTotal"], $_POST["amountLetters"], "{$_POST['description']}"];
            echo json_encode([
                $datos["cabecera"],
                $entrada["cabecera"],
            ]);
            //die();
            $stmt = $conexion_pg->prepare($entrada['cabecera']);
            $stmt->execute($datos["cabecera"]);
            $id = $conexion_pg->lastInsertId();
            $productosId = explode(",",$_POST['product-id']);
            $aUsar = array_filter($productosId, function($item){
                return trim($item) !== "";
            });
            if (sizeof($aUsar) > 0) {
                # code...
                $productosQty = explode(",", $_POST['product-qty']);
                $productosLote = explode(",", $_POST['product-lote']);
                $productosVence = explode(",", $_POST['product-vence']);
                $productosPunit = explode(",", $_POST['product-punit']);
                $productosPtotal = explode(",", $_POST['product-ptotal']);
                $entrada["detalle"] = "INSERT INTO salidas_detalles (salida_cabecera_id, producto_id, cantidad, lote, precio_individual, precio_total, fecha_vencimiento) values ";
                // actualizar existencias
                $sqlUpdate = [];
                $datosUpdate = [];
                $dataTest = "";
                $toInsert = [];
                $iterar = 0;
                foreach ($aUsar as $key => $value) {
                    # code...
                    $dataTest .= "((?), (?), (?), (?), (?), (?), (?)),";
                    $toInsert[] = $id;
                    $toInsert[] = $claves[$productosId[$key]];
                    $toInsert[] = $productosQty[$key];
                    $toInsert[] = $productosLote[$key];
                    $toInsert[] = $productosPunit[$key];
                    $toInsert[] = $productosPtotal[$key];
                    $toInsert[] = $productosVence[$key];
                    $sqlUpdate[$iterar] = "UPDATE existencias SET cantidad_total= cantidad_total - (?), 
                    lote=?, 
                    fecha_vencimiento=?, 
                    precio_individual = ?,	
                    precio_total =? WHERE producto_id=?";
                    $datosUpdate[$iterar] = [
                        $productosQty[$key], $productosLote[$key], 
                        $productosVence[$key], $productosPunit[$key],
                        $productosPtotal[$key],$claves[$productosId[$key]]
                    ];
                    $stmtU = $conexion_pg->prepare($sqlUpdate[$iterar]);
                    $stmtU->execute($datosUpdate[$iterar]);
                    $iterar++;
                }
                $dataTest = substr($dataTest, 0, -1);
                $entrada["detalle"] .= $dataTest;
                echo json_encode([$entrada['detalle'], $toInsert]);
                $stmt = $conexion_pg->prepare($entrada["detalle"]);
                $stmt->execute($toInsert);
                echo json_encode(["respuesta" => true]);
            }
            echo json_encode(["respuesta" => false]);
            // fin salida
        }
        # code...
        elseif ($_POST['action'] == "editProduct") {
            //$_POST["supplierId"]
            $sqlUpdate = "UPDATE productos SET categoria_id = ?, 
                    nombre =?, 
                    codigo=?, 
                    descripcion =? WHERE id=?";
            $stmtU = $conexion_pg->prepare($sqlUpdate);
            $stmtU->execute([
                $_POST['productCategoryOk'],
                $_POST['productName'],
                $_POST['productCode'],
                $_POST['productDescription'],
                $_POST['productId']
            ]);
            echo json_encode(["respuesta" => true]);
        }
        elseif ($_POST['action'] == "addProduct") {
            # code...
            
            $sqlInsert = "INSERT INTO productos (nombre, codigo, descripcion, categoria_id) VALUES ((?),(?),(?),(?))";
            $stmtI = $conexion_pg->prepare($sqlInsert);
            $stmtI->execute([
                $_POST['productName'],
                $_POST['productCode'],
                $_POST['codeDescription'],
                $_POST['productCategoryOk']
            ]);
            $id = $conexion_pg->lastInsertId();
            // se agrega la existencia
            $sql = "INSERT INTO existencias (
                producto_id,
                cantidad_total,
                lote,
                fecha_vencimiento,
                precio_individual,
                precio_total
            ) 
            values ((?), 0, '', '2023-12-31', 0, 0)";
            $stmtI2 = $conexion_pg->prepare($sql);
            $stmtI2->execute([$id]);
            echo json_encode(["respuesta" => true]);
        }elseif ($_POST['action'] == "deleteProduct") {
            $sqlDel = "DELETE FROM productos WHERE id = (?)";
            $stmtD = $conexion_pg->prepare($sqlDel);
            $stmtD->execute([
                $_POST['productIdDelete']
            ]);
            echo json_encode(["respuesta" => true]);
        }
    }
    

        
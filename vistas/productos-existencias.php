<?php
if ($conexion_pg == NULL) {
    $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
    $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password)
/*
producto_id INTEGER  NOT NULL,
    cantidad_total INTEGER  NOT NULL,
    lote CHARACTER VARYING(150)  NOT NULL,
    fecha_vencimiento DATE  NOT NULL,
    precio_individual MONEY  NOT NULL,
    precio_total CHARACTER(40)  NOT NULL,

*/ 
$sql = "SELECT 
        p.id,
        p.nombre as prd_nombre,
        p.codigo,
        p.descripcion,
        e.lote,
        e.cantidad_total,
        e.fecha_vencimiento,
        e.precio_individual,
        e.precio_total
    FROM
    productos p
    INNER JOIN 
    categorias c
    ON p.categoria_id = c.id
    INNER JOIN 
    existencias e
    ON e.producto_id = p.id
    ";
$stmt = $conexion_pg->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll( PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
$stmt->closeCursor();
//print_r($data);
?>
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de existencias</h3>

            <div class="card-tools">
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse"
                    title="Collapse"
                >
                    <i class="fas fa-minus"></i>
                </button>
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="remove"
                    title="Remove"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 10%">producto</th>
                        <th style="width: 20%">descripcion</th>
                        <th style="width: 10%">cantidad total</th>
                        <th style="width: 20%">lote</th>
                        <th style="width: 10%">fecha vencimiento</th>
                        <th style="width: 14%">precio individual</th>
                        <th style="width: 15%">precio total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($data as $pos => $producto) {
                        echo "<tr>
                            <td>#</td>
                            <td>
                            {$producto["codigo"]}
                            </td>
                            <td>
                            {$producto["nombre"]}
                            </td>
                            <td>
                            {$producto["cantidad_total"]}
                            </td>
                            <td>
                            {$producto["lote"]}
                            </td>
                            <td>
                            {$producto['fecha_vencimiento']}
                            </td>
                            <td>
                            {$producto["precio_individual"]}
                            </td>
                            <td>
                            {$producto["precio_total"]}
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
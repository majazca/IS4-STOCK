<?php
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
/*
CREATE TABLE entradas_cabeceras (
    id SERIAL  NOT NULL,
    proveedor_id INTEGER  NOT NULL,
    codigo CHARACTER VARYING(40)  NOT NULL,
    fecha DATE  NOT NULL,
    factura_nro CHARACTER VARYING(40),
    remision_nro CHARACTER VARYING(40),
    entregado_por CHARACTER VARYING(40),
    monto_total MONEY,
    monto_letras CHARACTER VARYING(250),
    descripcion TEXT,
    CONSTRAINT PK_entradas_cabeceras PRIMARY KEY (id)
);
*/

$sql = "SELECT 
ec.id, ec.proveedor_id, ec.codigo, ec.fecha, 
ec.factura_nro, ec.remision_nro, ec.entregado_por, ec.monto_total,
ec.monto_letras, ec.descripcion, p.nombre as proveedor
FROM entradas_cabeceras ec
INNER JOIN 
proveedores p
ON p.id = ec.proveedor_id";
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
            <h3 class="card-title">Listado</h3>

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
                        <!-- ec.id, ec.proveedor_id, ec.codigo, ec.fecha, 
ec.factura_nro, ec.remision_nro, ec.entregado_por, ec.monto_total,
ec.monto_letras, ec.descripcion -->
                        <th>#</th>
                        <th>Proveedor</th>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Factura</th>
                        <th>Remision</th>
                        <th>Entragado por</th>
                        <th>Monto total</th>
                        <th style="width: 25%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($data as $pos => $entrada) {
                        echo "<tr>
                            <td>#</td>
                            <td>
                            {$entrada["proveedor"]}
                            </td>
                            <td>
                            {$entrada["codigo"]}
                            </td>
                            <td>
                            {$entrada["fecha"]}
                            </td>
                            <td>
                            {$entrada["factura"]}
                            </td>
                            <td>
                            {$entrada["remision"]}
                            </td>
                            <td>
                            {$entrada["entragado_por"]}
                            </td>
                            <td>
                            {$entrada["monto_total"]}
                            </td>
                            <td class='project-actions text-right'>
                                <a
                                    class='btn btn-info btn-sm'
                                    href='/home.php?v=entradas&action=editar&code={$entrada["id"]}'
                                >
                                    <i class='fas fa-pencil-alt'>
                                    </i>
                                    Edit
                                </a>
                                <a
                                    class='btn btn-danger btn-sm'
                                    href='#'
                                >
                                    <i class='fas fa-trash'> </i>
                                    Delete
                                </a>
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
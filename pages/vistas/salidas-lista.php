<?php
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
/*
CREATE TABLE salidas_cabeceras (
    id SERIAL  NOT NULL,
    codigo_salida CHARACTER VARYING(150)  NOT NULL,
    fecha DATE  NOT NULL,
    monto_total MONEY  NOT NULL,
    monto_letras CHARACTER VARYING(150)  NOT NULL,
    descripcion TEXT,
    CONSTRAINT PK_salidas_cabeceras PRIMARY KEY (id)
*/

$sql = "SELECT 
sc.id, sc.codigo_salida, sc.fecha, sc.monto_total, sc.descripcion
FROM salidas_cabeceras sc";
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
                        <!-- sc.id, sc.codigo_salida, sc.fecha, sc.monto_total, sc.descripcion -->
                        <th>#</th>
                        <th>ID</th>
                        <th>Codigo salida</th>
                        <th>Fecha</th>
                        <th>Monto total</th>
                        <th>Descripcion</th>
                        <th style="width: 25%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($data as $pos => $salida) {
                        echo "<tr>
                            <td>#</td>
                            <td>
                            {$salida["id"]}
                            </td>
                            <td>
                            {$salida["codigo_salida"]}
                            </td>
                            <td>
                            {$salida["fecha"]}
                            </td>
                            <td>
                            {$salida["monto_total"]}
                            </td>
                            <td>
                            {$salida["descripcion"]}
                            </td>
                            <td class='project-actions text-right'>
                                <a
                                    class='btn btn-info btn-sm'
                                    href='/home.php?v=salidas&action=editar&code={$salida["id"]}'
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
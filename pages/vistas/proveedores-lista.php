<?php
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
$sql = "SELECT 
        p.id,
        p.nombre,
        p.RUC
    FROM
    proveedores p";
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
                        <th style="width: 1%">#</th>
                        <th style="width: 40%">nombre</th>
                        <th style="width: 20%">RUC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($data as $pos => $proveedor) {
                        echo "<tr>
                            <td>
                            {$proveedor["id"]}
                            </td>
                            <td>
                            {$proveedor["nombre"]}
                            </td>
                            <td>
                            {$proveedor["ruc"]}
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
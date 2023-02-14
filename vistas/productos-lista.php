<?php
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
$sql = "SELECT 
        p.id,
        c.nombre as cat_nombre,
        p.nombre as prd_nombre,
        p.codigo,
        p.descripcion
    FROM
    productos p
    INNER JOIN 
    categorias c
    ON p.categoria_id = c.id";
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
            <table class="table table-striped listado-productos">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">nombre</th>
                        <th style="width: 10%">codigo</th>
                        <th
                            style="width: 40%"
                            class="text-center"
                        >
                            descripcion
                        </th>
                        <th style="width: 10%">categoria</th>
                        <th style="width: 25%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($data as $pos => $producto) {
                        echo "<tr>
                            <td>#</td>
                            <td>
                            {$producto["prd_nombre"]}
                            </td>
                            <td>
                            {$producto["codigo"]}
                            </td>
                            <td>
                            {$producto["descripcion"]}
                            </td>
                            <td>
                            {$producto["cat_nombre"]}
                            </td>
                            <td class='project-actions text-right'>
                                <a
                                    class='btn btn-info btn-sm'
                                    href='/home.php?v=productos&action=editar&sku={$producto["id"]}'
                                >
                                    <i class='fas fa-pencil-alt'>
                                    </i>
                                    Edit
                                </a>
                                <button
                                    class='btn btn-danger btn-sm deleteProduct' data-id='{$producto["id"]}'
                                >
                                    <i class='fas fa-trash'> </i>
                                    Delete
                                </button>
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
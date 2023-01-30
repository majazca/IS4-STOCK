<?php
$usuario = (int) $_GET["user"];
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
$stmt = $conexion_pg->prepare( "SELECT id, name, nombre, apellido from users");
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
                        <th style="width: 20%">Usuario</th>
                        <th style="width: 30%">Nombre y Apellido</th>
                        <th
                            style="width: 8%"
                            class="text-center"
                        >
                            <!-- Status -->
                        </th>
                        <th style="width: 25%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($data as $pos => $usuario) {
                        echo "<tr>
                            <td>#</td>
                            <td>
                            {$usuario["name"]}
                            </td>
                            <td>
                            {$usuario["nombre"]} {$usuario["apellido"]}
                            </td>
                            <td class='project-state'>
                                
                            </td>
                            <td class='project-actions text-right'>
                                <a
                                    class='btn btn-info btn-sm'
                                    href='/home.php?v=usuarios&action=editar&user={$usuario["id"]}'
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
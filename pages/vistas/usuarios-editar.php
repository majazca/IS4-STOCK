<?php
$usuario = (int) $_GET["user"];
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
$stmt = $conexion_pg->prepare( "SELECT id, name, nombre, apellido from users where id = (?)");
$stmt->execute([$usuario]);
$data = $stmt->fetchAll( PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
$stmt->closeCursor();
//print_r($data);
?>
<section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body form-user">
              <div class="form-group">
                <label for="user">usuario</label>
                <!-- <input type="text" id="user" class="form-control" required> -->
                <input type="hidden" id="userId" value="<?php echo $data[0]["id"]; //$usuario["id"]; ?>">
              </div>
              <div class="form-group">
                <label for="userName">Nombre</label>
                <input type="text" id="userName" class="form-control" value="<?php echo $data[0]["nombre"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="userLastName">Apellido</label>
                <input id="userLastName" class="form-control" value="<?php echo $data[0]["apellido"]; ?>" required>
              </div>
              <div class="form-group">
              <label for="userPassword">Contraseña</label>
                <input id="userPassword" class="form-control" required>
              </div>
              <div class="form-group">
              <label for="userRePassword">Repetir contraseña</label>
                <input id="userRePassword" class="form-control" required>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancelar</a>
          <input id="editUser" type="submit" value="Guardar cambios" class="btn btn-success float-right user-action">
        </div>
      </div>
    </section>
<?php
$categoria = (int) $_GET["categ"];
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
$stmt = $conexion_pg->prepare( "SELECT id, nombre, codigo, descripcion from categorias where id = (?)");
$stmt->execute([$categoria]);
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
            <div class="card-body form-category">
              <div class="form-group">
                <label for="categoryId">Categoria</label>
                <input type="hidden" id="categoryId" value="<?php echo $data[0]["id"]; //$usuario["id"]; ?>">
              </div>
              <div class="form-group">
                <label for="categoryName">Nombre</label>
                <input type="text" id="categoryName" class="form-control" value="<?php echo $data[0]["nombre"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="categoryCode">Codigo</label>
                <input id="categoryCode" class="form-control" value="<?php echo $data[0]["codigo"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="categoryDescription">descripcion</label>
                <textarea id="categoryDescription" class="form-control" required><?php echo $data[0]["descripcion"]; ?></textarea>
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
          <input id="editCategory" type="submit" value="Guardar cambios" class="btn btn-success float-right category-action">
        </div>
      </div>
    </section>
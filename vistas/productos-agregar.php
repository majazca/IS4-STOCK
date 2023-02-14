<?php
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
$sql = "SELECT 
        c.id,
        c.nombre,
        c.codigo,
        c.descripcion
    FROM
    categorias c";
$stmt = $conexion_pg->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll( PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
$stmt->closeCursor();
//print_r($data);
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- CREATE TABLE productos (
    id SERIAL  NOT NULL,
    categoria_id INTEGER  NOT NULL,
    nombre CHARACTER VARYING(150)  NOT NULL,
    codigo CHARACTER VARYING(40)  NOT NULL,
    descripcion TEXT,
    CONSTRAINT PK_productos PRIMARY KEY (id)
); -->

    <!-- Main content -->
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
            <div class="card-body form-product datos-productos">
              <div class="form-group">
                <label for="productName">Nombre</label>
                <input type="text" id="productName" class="form-control">
              </div>
              <div class="form-group">
                <label for="productCode">Codigo</label>
                <input type="text" id="productCode" class="form-control">
              </div>
              <div class="form-group">
                <label for="codeDescription">Descripcion</label>
                <input id="codeDescription" class="form-control" >
              </div>
              <div class="form-group">
                <label for="productCategory">Categoria</label>
                <input type="hidden" id="productCategoryOk" value="">
                <select id="productCategory" class="form-control custom-select">
                  <option selected disabled>Seleccione uno</option>
                  <?php foreach ($data as $key => $value) {
                    echo "<option value='{$value['id']}'>{$value['nombre']}</option>";
                  } ?>
                  <!-- <option>On Hold</option>
                  <option>Canceled</option>
                  <option>Success</option> -->
                </select>
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
          <!-- <input type="submit" value="Crear nuevo Producto" class="btn btn-success float-right"> -->
          <button class="btn btn-success float-right product-action" id="addProduct">Crear nuevo Producto</button>
        </div>
      </div>
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
<?php
$sku = (int) $_GET["sku"];
if ($conexion_pg == NULL) {
  $conexion_pg = new PDO( $cadena, $_ENV['POSTGRESQL_USER'], $_ENV['POSTGRESQL_PASS']);
  $conexion_pg->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
//  users (name, nombre, apellido, password) 
$sql = "SELECT id, nombre, codigo, descripcion, categoria_id from productos where id = (?)";
$stmt = $conexion_pg->prepare($sql);
$stmt->execute([$sku]);
$data = $stmt->fetchAll( PDO::FETCH_ASSOC);
$sql = "SELECT id, nombre, codigo from categorias";
$stmt = $conexion_pg->prepare($sql);
$stmt->execute();
$dataCateg = $stmt->fetchAll( PDO::FETCH_ASSOC);
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
            <div class="card-body form-product">
              <div class="form-group">
                <label for="productId">producto</label>
                <!-- <input type="text" id="user" class="form-control" required> -->
                <input type="hidden" id="productId" value="<?php echo $data[0]["id"]; //$usuario["id"]; ?>">
              </div>
              <div class="form-group">
                <label for="productName">Nombre</label>
                <input type="text" id="productName" class="form-control" value="<?php echo $data[0]["nombre"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="productCode">Codigo</label>
                <input id="productCode" class="form-control" value="<?php echo $data[0]["codigo"]; ?>" required>
              </div>
              <div class="form-group">
                <label for="productCategory">Categoria</label>
                <input type="hidden" id="productCategoryOk" value="<?php echo $data[0]["categoria_id"]; ?>">
                <select id="productCategory" class="form-control custom-select">
                    <option disabled="">Selecciona uno</option>
                    <?php $filtro = "";foreach ($dataCateg as $key => $value) {
                        if ($value["id"] == $data[0]["categoria_id"]) {
                            $filtro = " selected='' ";
                        }else{
                            $filtro = '';
                        }
                        echo  "<option {$filtro} value='{$value['nombre']}'>{$value['nombre']}</option>";
                    } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="productDescription">Descripcion</label>
                <textarea id="productDescription" class="form-control" required><?php echo $data[0]["descripcion"]; ?></textarea>
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
          <input id="editProduct" type="submit" value="Guardar cambios" class="btn btn-success float-right product-action">
        </div>
      </div>
    </section>
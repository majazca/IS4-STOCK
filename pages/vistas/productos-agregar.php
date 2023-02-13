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
            <div class="card-body">
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
                <textarea id="codeDescription" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="categoryProduct">Categoria</label>
                <select id="categoryProduct" class="form-control custom-select">
                  <option selected disabled>Seleccione uno</option>
                  <option>On Hold</option>
                  <option>Canceled</option>
                  <option>Success</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6" style="display: none;">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Budget</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">Estimated budget</label>
                <input type="number" id="inputEstimatedBudget" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">Total amount spent</label>
                <input type="number" id="inputSpentBudget" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Estimated project duration</label>
                <input type="number" id="inputEstimatedDuration" class="form-control">
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
          <input type="submit" value="Crear nuevo Producto" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

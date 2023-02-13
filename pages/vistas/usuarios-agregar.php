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
                <input type="text" id="user" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="userName">Nombre</label>
                <input type="text" id="userName" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="userLastName">Apellido</label>
                <input id="userLastName" class="form-control" required>
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
          <button id="addUser" class="btn btn-success float-right user-action">Crear nuevo usuario</button>
        </div>
      </div>
    </section>
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?php echo count(ClientData::getAll()); ?> </div>
                    <div>Clientes</div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?php echo count(ProductData::getAll()); ?> </div>
                    <div>Productos</div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?php echo count(CategoryData::getAll()); ?> </div>
                    <div>Categorías</div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?php echo count(UserData::getAll()); ?> </div>
                    <div>Usuarios</div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>




            <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-header">Bienvenido</div>
                <div class="card-body">
                  <p>Bienvenido al Sistema.</p>

                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
<?php
$buy = BuyData::getById($_GET["id"]);
?>
        <!-- Main Content -->

          <div class="row">
            <div class="col-md-12">
  <!-- Button trigger modal -->

            <h2>HISTORIAL</h2>
            <h4>Compra #<?php echo $buy->id;?></h4>
            </div>
            </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-th-list"></i> Operaciones
                </div>
                <div class="widget-body medium no-padding">
<?php
$categories = HistoryData::getAllByBuyId($_GET["id"]);
 if(count($categories)>0):?>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tbody>

<thead>
  <th>Estado</th>
  <th>Fecha</th>

</thead>
<?php foreach($categories as $cat):?>
                        <tr>
                        <td><?php echo $cat->getStatus()->name; ?></td>
                        <td><?php echo $cat->created_at; ?></td>
                        </tr>
<?php endforeach; ?>

                      </tbody>
                    </table>
                  </div> 

<?php else:?>
  <div class="panel-body">
  <p class="alert alert-warning">No hay clientes por mostrar, agregar uno o espera a que se registren.</p>
  </div>
<?php endif; ?>
                </div>
              </div>
            </div>

          </div>

        <!-- Main Content -->

          <div class="row">
            <div class="col-md-12">
                  <a href="./?view=newcoupon" class="pull-right btn-sm btn btn-default">Agregar Cupon</a>

            <h1>Cupones</h1>
            </div>
            </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <i class="fa fa-ticket"></i> Cupones
                </div>
                <div class="widget-body medium no-padding">

                  <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                      <th>Codigo</th>
                      <th>Producto</th>
                      <th>Valor</th>
                      <th>INICIO/FIN</th>
                      <th>Activo</th>
                      <th></th>
                    </thead>
                      <tbody>
<?php
$categories = CouponData::getAll();
 if(count($categories)>0):?>
<?php foreach($categories as $cat):?>
                        <tr>
                        <td><?php echo $cat->name; ?></td>
                        <td><?php  if($cat->product_id==null){ echo "CUALQUIERA"; }else{ echo $cat->getProduct()->name;} ?></td>
                        <td><?php echo $cat->val; ?></td>
                        <td><?php 
                        echo $cat->start_at!="0000-00-00" ? date("d-M-Y",strtotime($cat->start_at)):"----";
                        echo "/";
                        echo $cat->finish_at!="0000-00-00" ? date("d-M-Y",strtotime($cat->finish_at)):"----";
                        ?>
                        <td style="width:90px;"><center><?php if($cat->is_active):?><i class="fa fa-check"></i><?php else: ?><i class="fa fa-remove"></i><?php endif; ?></center> </td>
                        <td style="width:90px;">
                        <a data-toggle="modal" href="./?view=editcoupon&id=<?php echo $cat->id;?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a> 
                        <a href="index.php?action=delcoupon&id=<?php echo $cat->id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> 
                        </td>

                        </tr>
<?php endforeach; ?>
 <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>

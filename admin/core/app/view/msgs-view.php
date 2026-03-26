<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
          <h6 class="m-0 font-weight-bold text-primary">Mensajes (Contacto)</h6>
        </div>
        <div class="card-body p-0">
          <?php
          $msgs = ContactData::getAll();
          if(count($msgs)>0):?>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="ps-3" style="width: 80px;">ID</th>
                  <th>Mensaje</th>
                  <th>Producto</th>
                  <th>Usuario</th>
                  <th>Tipo</th>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($msgs as $msg): 
                  $product = ProductData::getById($msg->product_id);
                  $user = UserData::getById($msg->user_id);
                  $type = "General";
                  $badge = "secondary";
                  if($msg->is_question) { $type = "Pregunta"; $badge = "info"; }
                  if($msg->is_answer) { $type = "Respuesta"; $badge = "success"; }
                ?>
                <tr>
                  <td class="ps-3"><span class="badge bg-secondary">#<?php echo $msg->id; ?></span></td>
                  <td><?php echo $msg->message; ?></td>
                  <td>
                    <?php if($product): ?>
                      <a href="../index.php?view=producto&product_id=<?php echo $product->id; ?>" target="_blank" class="text-decoration-none fw-bold">
                        <?php echo $product->name; ?>
                      </a>
                    <?php else: ?>
                      <span class="text-muted">N/A</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($user): ?>
                      <div class="fw-bold"><?php echo $user->name." ".$user->lastname; ?></div>
                      <div class="small text-muted"><?php echo $user->email; ?></div>
                    <?php else: ?>
                      <span class="text-muted">N/A</span>
                    <?php endif; ?>
                  </td>
                  <td><span class="badge bg-<?php echo $badge; ?>"><?php echo $type; ?></span></td>
                  <td><span class="small"><?php echo $msg->created_at; ?></span></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
          <div class="text-center py-5">
            <i class="fa fa-envelope-o fa-3x mb-3 text-muted opacity-25"></i>
            <p class="mb-0 text-muted">No hay mensajes registrados.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

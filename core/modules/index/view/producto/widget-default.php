<?php 
$p = ProductData::getById($_GET["product_id"]);
if($p->s_id!=3){ Core::redir("./");}
$img_default = ConfigurationData::getByPreffix("general_img_default")->val;
$coin_symbol = ConfigurationData::getByPreffix("general_coin")->val;

Viewer::addView($p->id,"product_id","product_view");

 ?>
<section>
  <div class="container">

  <div class="row">
  <div class="col-md-3">
          <div class="panel panel-primary">
        <div class="panel-heading">Categorias</div>

<?php
$cats = CategoryData::getPublics();
?>
<?php if(count($cats)>0):?>
<div class="list-group">
<?php foreach($cats as $cat):?>

  <a href="index.php?view=productos&cat=<?php echo $cat->short_name; ?>" class="list-group-item"><i class="fa fa-chevron-right"></i>  <?php echo $cat->name; ?></a>
<?php endforeach; ?>
</div>
<?php endif; ?>
      </div>
  </div>
  <div class="col-md-9">
    <div style="background:#3498db;font-size:25px;color:white;padding:5px;"><?php echo $p->name; ?></div>
<br>
<?php if($p!=null):
$img = "admin/storage/products/".$p->image;
if($p->image==""){
  $img=$img_default;
}
?>
  <div class="row">
  <div class="col-md-8">
 <center>   <img src="<?php echo $img; ?>"  style="width:180px;height:180px;"></center>

  </div>
  <div class="col-md-4">
 <h1 class="text-primary"><?php echo $coin_symbol; ?> <?php echo number_format($p->price,2,".",","); ?></h1>
<?php 
$in_cart=false;
if(isset($_SESSION["cart"])){
  foreach ($_SESSION["cart"] as $pc) {
    if($pc["product_id"]==$p->id){ $in_cart=true;  }
  }
  }

  ?>
<!--<?php// if(!$p->in_existence):?>
 <a href="javascript:void()" class="btn btn-labeled btn-warning tip" title="No Disponible">
                <span class="btn-label"><i class="glyphicon glyphicon-shopping-cart"></i></span>No Disponible</a>
-->
<?php if(!$in_cart):?>
<a data-toggle="modal" data-target="#myModal" class="btn btn-labeled btn-primary">
                <span class="btn-label"><i class="glyphicon glyphicon-envelope"></i></span>Contactar</a>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Contactar</h4>
      </div>
      <div class="modal-body">

<?php if(isset($_SESSION["client_id"]) && $_SESSION["client_id"]!=""):?>
  <?php if($p->user_id!=$_SESSION["client_id"]):?>
<form class="form-horizontal" role="form" method="post" action="index.php?action=productcontact">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">*Mensaje</label>
    <div class="col-lg-10">
      <textarea required name="message" class="form-control" id="inputEmail1" placeholder="Mensaje" rows="5"></textarea>
    </div>
  </div>
  <input type="hidden" name="product_id" value="<?php echo $p->id; ?>">


  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-block btn-default">Contactar</button>
    </div>
  </div>
</form>
<?php else:?>
  <p class="alert alert-warning">Necesitas te puedes contactar a ti mismo.</p>
<?php endif;?>
<?php else:?>
  <p class="alert alert-warning">Necesitas registrarte e iniciar sesion.</p>
<?php endif;?>

      </div>

    </div>
  </div>
</div>




<?php else:?>

<?php endif; ?>    
    <!--
    <?php if($p->in_existence):?>
      <p class="text-success">Producto en Existencia</p>
    <?php else:?>
      <p class="text-warning">Producto no disponible</p>
    <?php endif; ?>
    -->
  </div>
  </div>
  <br><br>
  <div class="row">
  <div class="col-md-12">
  <?php if($p->image2!="" || $p->image3!="" || $p->image4!=""):?>
    <h4>Mas Imagenes</h4>
  <div class="row">
  <?php if($p->image2!=""):?>
  <div class="col-md-4" >
  <img src="admin/storage/products/<?php echo $p->image2; ?>" class="img-responsive">
  </div>
<?php endif; ?>
  <?php if($p->image3!=""):?>
  <div class="col-md-4" >
  <img src="admin/storage/products/<?php echo $p->image3; ?>" class="img-responsive">
  </div>
<?php endif; ?>
  <?php if($p->image4!=""):?>
  <div class="col-md-4" >
  <img src="admin/storage/products/<?php echo $p->image4; ?>" class="img-responsive">
  </div>
<?php endif; ?>
  </div>
  <?php endif; ?>
  <hr>
  <h4>Codigo: <?php echo $p->code; ?></h4>
  <h4>Descripcion</h4>
  <p><?php echo $p->description; ?></p>
  <?php if($p->comments!=""):?>
  <h4>Comentarios</h4>
  <p><?php echo $p->comments; ?></p>
<?php endif; ?>
  <?php if($p->brand!=""):?>
  <h4>Marca</h4>
  <p><?php echo $p->brand; ?></p>
<?php endif; ?>

  <?php if($p->model!=""):?>
  <h4>Modelo</h4>
  <p><?php echo $p->model; ?></p>
<?php endif; ?>

  <?php if($p->y!=""):?>
  <h4>A&ntile;o de facribacion</h4>
  <p><?php echo $p->y; ?></p>
<?php endif; ?>

  <hr>
  <?php if(isset($_SESSION["client_id"])):?>
    <?php if($p->user_id!=$_SESSION["client_id"]):?>
  <h4>Hacer Pregunta</h4>
<form class="form-horizontal" role="form" method="post" action="index.php?action=productcontact">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">*Pregunta</label>
    <div class="col-lg-10">
      <textarea required name="message" class="form-control" id="inputEmail1" placeholder="Pregunta" rows="5"></textarea>
    </div>
  </div>
  <input type="hidden" name="product_id" value="<?php echo $p->id; ?>">


  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="is_question" value="1">
      <button type="submit" class="btn btn-block btn-default">Hacer Pregunta</button>
    </div>
  </div>
</form>
</div>
</div>
<hr>
<?php else:?>
  <p class="alert alert-warning">No puedes hacer preguntas en tus propios productos.</p>
<?php endif; ?>
<?php else:?>
  <p class="alert alert-warning">Necesitas estar registrado y loggeado para escribir preguntas.</p>
<?php endif; ?>
<?php endif; ?>
  <h4>Preguntas</h4>

<?php
$questions = ContactData::getQuestionsByProduct($p->id);
?>
<?php if(count($questions)>0):?>
<?php foreach($questions as $qs):
$u = $qs->getUser();
$answers = ContactData::getAnswersByContact($qs->id);
?>
  <p> <span class="text-muted"><?php echo $qs->created_at; ?></span> <b><?php echo $u->name." ".$u->lastname; ?></b>: <?php echo $qs->message; ?> </p>
<?php if(count($answers)>0):?>
  <blockquote>
<?php foreach($answers as $ans):
$ux = UserData::getById($p->user_id);
?>
  <p> <span class="text-muted"><?php echo $ans->created_at; ?></span> <b><?php echo $ux->name." ".$ux->lastname; ?></b>: <?php echo $ans->message; ?> </p>
  <?php endforeach; ?>
  </blockquote>
<?php endif; ?>

  <?php endforeach; ?>
<?php else:?>
  <p class="alert alert-info">Aun no hay preguntas para este producto.</p>
  <?php endif; ?>



  </div>
  </div>


  </div>
  </section>
